function stopAllvideo(){
	jQuery('.video-js:not(.play-slient)').each(function(i, obj) {
		var $player = jQuery(this).attr('id');
		videojs.getPlayer($player).pause();
	});
}

function playSilentVideo($wrapper){
	stopAllvideo();

	if($wrapper.find('.video-js').hasClass('play-slient')){
		if($wrapper.find('.video-js video').length > 0){
			$player = $wrapper.find('.video-js video').attr('id');
			var autoplay = false;
			var video_autoplay = jQuery('#interactive_video_autoplay').prop('checked');
			var is_splash = $wrapper.find('.video-js').hasClass('video-has-thumb');
			if(video_autoplay == true && is_splash){
                    autoplay = false;
                }else if(video_autoplay == true && !is_splash){
                    autoplay = true;
                }else if(video_autoplay != true && !is_splash){
                    autoplay = false;
                }

			if(autoplay){
				setTimeout(function() {
					videojs.getPlayer($player).play();
				},100);
			}
			
			setTimeout(function() {
				$wrapper.find('.video-js .vjs-big-play-button').show();
			},400);
		}
	}
}

function question_video_delete_action(){
	outcomescreen_value = jQuery('.sqb_question_no.active .Quiz-Template9-left-side').find('input[name="video_id"]').val();
	if (typeof outcomescreen_value !== "undefined" && outcomescreen_value != ''){
		jQuery('.sqb_delete_question_screen_video_template9').addClass('sqb-has-video');
	}else{
		jQuery('.sqb_delete_question_screen_video_template9').removeClass('sqb-has-video');
	}
}

jQuery(document).ready(function(){ 
	var get_selected_temp = jQuery('input[name="select_temp"]:checked').val();
	if(get_selected_temp == 'template6'){
		jQuery('.question_details').removeAttr('style');
	}

	jQuery(document).on('change', 'input[name="sqb-email-template-use"]', function(){
		if(jQuery(this).val() == 'default'){
			jQuery('#sqb-email-template-custom-options').hide();
		}else{
			jQuery('#sqb-email-template-custom-options').show();
		}
	});

	jQuery(document).on('click', '.replace-img-btn', function(){
		jQuery('.upload-emailtemp-banner-img-btn').trigger('click');
	});

	jQuery(document).on('click', '#sqb-email-template-logo-inner .delete-quiz-img', function(){
		jQuery('#sqb-email-template-logo-inner .sqb-default-upload-wrapper').addClass('active');
	    jQuery('#sqb-email-template-logo-inner .sqb-default-upload-wrapper-has-img').removeClass('active');
	    jQuery('#sqb-email-template-logo-inner .quiz-emailtemp-preview-img img').attr('src','');
	    jQuery('#sqb-email-template-logo-inner #sqb-email-template-logo-file').val('');
	});

	jQuery(document).on('click', '#sqb-email-template-banner-image .delete-quiz-img', function(){
		jQuery('#sqb-email-template-banner-image .sqb-default-upload-wrapper').addClass('active');
	    jQuery('#sqb-email-template-banner-image .sqb-default-upload-wrapper-has-img').removeClass('active');
	    jQuery('#sqb-email-template-banner-image .quiz-emailtemp-preview-img img').attr('src','');
	    jQuery('#sqb-email-template-banner-image #sqb-email-template-banner-file').val('');
	});

	jQuery(document).on('click', '.sqb-one-click', function(){
    	jQuery('.sqb-one-click-smartlogin-popup').show();
    	jQuery('.sqb-one-click-smartlogin-popup').addClass('active_Side_Popup');
    	jQuery('body').addClass('sidepopup-active');

    });
    
    jQuery(document).on('click', '.matrix-tag-wrapper-close', function(){
		jQuery('.matrix-tags-table').hide('slow');
		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		if(quiz_type == 'personality'){
			if(jQuery('.answer_matrix_options_wrapper .outcome-option-connect').hasClass('outcome-option-active')){

				jQuery('.answer_matrix_options_wrapper .matrix-outcome-table').show('slow');
				jQuery('.answer_matrix_options_wrapper .sqb_add_more_question_section').show('slow');
			}
		}
	});
    
	var tab = sqb_getUrlVars()["tab"];
	if(tab == 'OpenAI'){

		jQuery('body').addClass('sqb-aiq-option');
		jQuery('.have-no-quiz').hide('slow');
		jQuery('.Manage--Quiz-section').hide('slow');
		jQuery('.sqb_select_quiz_types').hide('slow');
		jQuery('.sqb_create_quiz_using_import').hide();
		jQuery('.sqb_create_quiz_using_chatgpt').show();
	}

	question_video_delete_action();
	jQuery(document).on('click','.vjs-big-play-button',function(evt){
		var vid_id = jQuery(this).closest('.video-js').attr('id');
		jQuery(this).hide();
		jQuery(this).closest('.video-js').find('video').prop('muted', false);
	   
		if(jQuery(this).closest('.video-js').hasClass('play-slient')){
			 video1 = document.getElementById(vid_id+"");
			 video1.currentTime = 0;
		}
		jQuery(this).closest('.video-js').removeClass('play-slient');
	 });

	jQuery('.video-js').each(function(i, obj) {
		var options = {};
	  	var player = videojs(jQuery(this).attr('id'), options, function onPlayerReady() {
    		
			//this.play();

			this.on('pause', function(t) {
				jQuery(t.target).find('.vjs-big-play-button').show();
			});
			
			this.on('ended', function() {
				videojs.log('Awww...over so soon?!');
			});
	  	});
	});

	jQuery('.template9-video-dropdown').on('change', function(){
		var selected_value = jQuery(this).val();

		var current_source_type = jQuery('.sqb_question_no.active .question-screen input[name="video_source"]').val();
        if(selected_value == 'upload' && (current_source_type == 'link' || typeof current_source_type == 'undefined')){
           jQuery('.sqb_question_no.active .Quiz-Template9-left-side').html('');
           jQuery('.sqb_delete_question_screen_video_template9').removeClass('sqb-has-video');
        }

		if(selected_value == 'link'){
			jQuery('.template9-link-option').show();
			jQuery('.template9-upload-option').hide();
			jQuery('.sqb_question_no.active .Quiz-Template9-left-side').find('.video_source').val('link');
			jQuery('input[name="video-upload-url"]').trigger('keyup');
		}else{
			jQuery('.template9-upload-option').show();
			jQuery('.template9-link-option').hide();
			jQuery('.sqb_question_no.active .Quiz-Template9-left-side').find('.video_source').val('upload');
			jQuery('.sqb_question_no.active .question-screen').addClass('sqb-no-video-found');
			jQuery('.question_screen_extension_error').hide();
			jQuery('.question_screen_video_upload_url_outer').hide();
		}
	});

	jQuery(document).on('click','.sqb_change_question_screen_video_template9',function() {
		
		var data = jQuery(this);
	   	var sqb_mediauploader;
	   	window.sqb_img_class = jQuery(this).attr('data-class');	 
		if (sqb_mediauploader) {
			sqb_mediauploader.open();
			return;
		}
		sqb_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Video',
			button: {
				text: 'Choose Video'
			},
			library: {
		            type: [ 'video' ]
		    },
			multiple: false
		});
		
		sqb_mediauploader.on('select', function() {
			attachment = sqb_mediauploader.state().get('selection').first().toJSON();

			if(attachment.filesizeInBytes > 25000000){
				swal({
			      title: "Please note: File size has exceeded max limit of 25MB.",
			      html: "As it's a large video, you cannot upload it through SQB. We recommend using the \"link\" option instead of the \"upload\" option.<br><br>Upload it to Amazon S3 (make it a public link) or upload to your server directly via FTP/file manager and enter the link here. Don't use the video upload option. ",
			      customClass: "swal-750-width sqb-swal-left-alignment"
			   });
				return false;
			}

			jQuery('.sqb_delete_question_screen_video_template9').addClass('sqb-has-video');

			var attachment_url = attachment.url;
			var video_dropdown = jQuery('.template9-video-dropdown').val();

			var splash_image = jQuery('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side').find('input[name="splash_image"]').val();
			if(splash_image){
				template9_video_option('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side', video_dropdown, attachment_url, splash_image);
			}else{
				template9_video_option('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side', video_dropdown, attachment_url);
			}

			jQuery('.question_screen_video_upload_url_outer').show();
			jQuery('.question_screen_video_upload_url').html(attachment_url);
			jQuery('input[name="question_screen_video_hidden"]').val(attachment_url);
			jQuery('.splash_image_option').show();
		});
		
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','.sqb_delete_question_screen_video_template9',function() {
		swal({
			title: "Are you sure you want to delete this video?",
			text: "It'll NOT be removed from WP media library but it'll be removed from SQB",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Delete!",
			customClass: '',
		}).then((result) => {
			if (result.value) {
				jQuery('.sqb_delete_question_screen_video_template9').removeClass('sqb-has-video');
				jQuery('.sqb_question_no.active .Quiz-Template9-left-side').html('');
				jQuery('.sqb_question_no.active .Quiz-Template9-left-side').addClass('sqb-no-video-found');
				jQuery('#template9_video_controls_question').prop('checked', false);
				jQuery('#template9_question_video_captions').prop('checked', false);
				jQuery('.template9_question_add_caption').hide();
				jQuery('.question_screen_video_upload_url_outer').hide();
				jQuery('.question_screen_video_upload_url').html('');
			}
		});	
	});

	
	jQuery(document).on('click','.sqb_change_outcome_screen_bg_image_template9',function() {
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
			jQuery('.res_data_cont.active .outcome-section .outcome-Screen-Quiz-Template9-left-side').css('background-image', 'url('+attachment.url+')');
			jQuery('.res_data_cont.active').find('.outcome-section').addClass('outcome_screen_has_image');
			jQuery('.res_data_cont.active').find('.outcome-section').removeClass('sqb-no-video-found, sqb-no-img-found');
		});
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','.sqb_change_outcome_screen_splash_image_template9',function() {
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
			jQuery('.res_data_cont.active .outcome-section .outcome-Screen-Quiz-Template9-left-side .splash_image').val(attachment.url);
			var outcome_screen_video = jQuery('.res_data_cont.active .outcome-section .outcome-Screen-Quiz-Template9-left-side').find('input[name="video_id"]').val();
			var video_dropdown = jQuery('.template9-outcome-screen-video-dropdown').val();
			template9_video_option('.res_data_cont.active .outcome-section .outcome-Screen-Quiz-Template9-left-side', video_dropdown, outcome_screen_video, attachment.url);
		});
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','.sqb_remove_outcome_screen_bg_image_template9',function() {
		jQuery('.res_data_cont.active .outcome-section .outcome-Screen-Quiz-Template9-left-side').css('background-image', '');
		jQuery('.res_data_cont.active').find('.outcome-section').removeClass('outcome_screen_has_image');
		jQuery('.res_data_cont.active').find('.outcome-section').addClass('sqb-no-img-found');
	});

	jQuery(document).on('click','.sqb_remove_outcome_screen_splash_image_template9',function() {
		jQuery('.res_data_cont.active .outcome-section .outcome-Screen-Quiz-Template9-left-side .splash_image').val('');
		var outcome_screen_video = jQuery('.res_data_cont.active .outcome-section .outcome-Screen-Quiz-Template9-left-side').find('input[name="video_id"]').val();
		var video_dropdown = jQuery('.template9-outcome-screen-video-dropdown').val();
		template9_video_option('.res_data_cont.active .outcome-section .outcome-Screen-Quiz-Template9-left-side', video_dropdown, outcome_screen_video, '');
	});

	jQuery('input[name="video-upload-url"]').on('keyup blur paste', function(){
		var input_val = jQuery(this);
		setTimeout(function(){
			var selected_template = jQuery('input[name="select_temp"]:checked').val();
			if(selected_template == 'template9'){
				var split_option = jQuery('input[name="template9_question_screen_split_option"]:checked').val();
				if(split_option == "video_left" || split_option == "video_right"){
					var video_option = jQuery('.template9-video-dropdown').val();
					/*if(video_option == 'link'){
						var fileExtension = ['mp4', 'mov', 'webm'];
						 if (jQuery.inArray(input_val.val().split('.').pop().toLowerCase(), fileExtension) == -1) {
						 	jQuery('.question_screen_extension_error').show();
				            return false;
				        }else{
						 	jQuery('.question_screen_extension_error').hide();
				        }
					}*/
				}
			}
			var number = Math.floor(1000 + Math.random() * 9000);
			var video_dropdown = jQuery('.template9-video-dropdown').val();
			template9_video_option('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side',video_dropdown, input_val.val());
			jQuery('.splash_image_option').show();
		},500);
		
	});

	sqb_tiny_editor();
	sqb_mediauploader();
	sqb_tom_menu_ordering_change_by_quiz_type();
	sqb_connect_to_outcome_btn_action();
	sqb_placeholder_editable();
	sqb_quiz_optin_field_placeholder_update();
	//sqb_placeholder_editable(); 
	load_file_upload_settings_popup();
//	dragdrop_bgimg();
	sqb_skip_button_actions();
	
	var selected_temp = jQuery('input[name="select_temp"]:checked').val();
	if(selected_temp == 'template8'){
		if(jQuery('.start_temp_container .quiz_comon_template').hasClass('Start-template-withbutton') == true){
			jQuery('.start-screen-button-options').hide();
		}else{
			jQuery('.start-screen-button-options').show();
		}
	}else if(selected_temp == "template1" || selected_temp == "template2" || selected_temp == "template3" || selected_temp == "template4" || selected_temp == "template5"){
		if(jQuery('.start_temp_container .Quiz-Start-Template2').hasClass('Start-template-withbutton') == true){
			jQuery('.start-screen-button-options').hide();
		}else{
			jQuery('.start-screen-button-options').show();
		}
	}
	

	function sqb_skip_button_actions(){
		/*jQuery(document).on('click','input[name="allow_skip_ques"]',function(){
			if(jQuery(this).prop('checked')){
				jQuery('#Quiz-Screen-Settings .sqb_question_no.active').find('.skip-question-action').show();
			} else {
				jQuery('#Quiz-Screen-Settings .sqb_question_no.active').find('.skip-question-action').hide();
			}
		});*/
		jQuery(document).on('click','input[name="skipquestion"]',function(){
			var select_temp = jQuery('input[name="select_temp"]:checked').val();
			if(jQuery(this).prop('checked')){
				if(select_temp == 'template7'){
					var enable_branching = jQuery('input[name="enable_branching"]').prop('checked');
					if(enable_branching == true){
						swal('','Sorry, can\'t enable skip button as  branching (quiz funnel) is enabled for this quiz.','');
						jQuery('input[name="allow_skip_ques"]').prop('checked', false);
						return false;
					}
					var enabled_advanced = jQuery("#enabled_advanced").prop('checked');
					if(enabled_advanced == true){
						swal('','Sorry, can\'t enable skip button as  Advanced outcome rules is enabled for this quiz.','');
						jQuery('input[name="allow_skip_ques"]').prop('checked', false);
						return false;
					}
				}
				
				jQuery('#Quiz-Screen-Settings .sqb_question_no.active').find('.skip-question-action').show();
			} else {
				jQuery('#Quiz-Screen-Settings .sqb_question_no.active').find('.skip-question-action').hide();
			}
		});
		
		jQuery(document).on('click','input[name="allow_skip_ques"]',function(){
			var select_temp = jQuery('input[name="select_temp"]:checked').val();
			if(jQuery(this).prop('checked') == true){
				var enable_branching = jQuery('input[name="enable_branching"]').prop('checked');
				if(enable_branching == true){
					swal('','Sorry, can\'t enable skip button as  branching (quiz funnel) is enabled for this quiz.','');
					jQuery('input[name="allow_skip_ques"]').prop('checked', false);
					return false;
				}
				var enabled_advanced = jQuery("#enabled_advanced").prop('checked');
				if(enabled_advanced == true){
					swal('','Sorry, can\'t enable skip button as advanced outcome rules is enabled for this quiz.','');
					jQuery('input[name="allow_skip_ques"]').prop('checked', false);
					return false;
				}
			}
			var selected_temp = jQuery('input[name="select_temp"]:checked').val();
			if(jQuery(this).prop('checked')){
				jQuery('#Quiz-Screen-Settings .sqb_question_no.active').find('.skip-question-action').show();
			} else {
				jQuery('#Quiz-Screen-Settings .sqb_question_no.active').find('.skip-question-action').hide();
			}
		});
		
		jQuery(document).on('click','.answer_tags_wrapper .add-tag-content',function(){
			jQuery('.answer_tags_wrapper .add_tag_form').show();
			jQuery('.answer_tags_wrapper .existing-div-show-hide').show();
		});
	}
	 
	function load_file_upload_settings_popup(){

		jQuery('#question_file_upload').find('input[type="checkbox"]').prop('checked',false);
		var file_settings = jQuery('.sqb_question_no.active').find('input[name="question_file_upload_settings"]').val();
		
		jQuery('.sqb_save_question_file_upload_setting').on('click',function(){
			var documents_type = [];
			jQuery('.file_type_doc_common').each(function(){
			documents_type.push(jQuery(this).find('input[type="checkbox"]:Checked').val());
			}); 
			documents_type.join();
			
			var images_type = [];
			jQuery('.file_type_image_common').each(function(){
			images_type.push(jQuery(this).find('input[type="checkbox"]:Checked').val());
			}); 
			images_type.join();
			
			var video_type = [];
			jQuery('.videoTypeFileCommon').each(function(){
			video_type.push(jQuery(this).find('input[type="checkbox"]:Checked').val());
			}); 
			video_type.join();
			
			var audio_type = [];
			jQuery('.audioTypeFileCommon').each(function(){
			audio_type.push(jQuery(this).find('input[type="checkbox"]:Checked').val());
			}); 
			audio_type.join();
			
			var maxFileUploadSize = jQuery('#maxFileUploadSize').val();
			var upload_file_settings = documents_type+'|'+images_type+'|'+video_type+'|'+audio_type+'|'+maxFileUploadSize;
			jQuery('.sqb_question_no.active').find('input[name="question_file_upload_settings"]').val(upload_file_settings);
			
			jQuery('#question_file_upload').modal('hide');
			//jQuery('.quiz-save-btn').trigger('click');
			//sqb_save_quiz();
			
		});
		
	}

	jQuery('.add_ques').click(function(){
		jQuery('.have_noques').hide("slow");
		jQuery('.ques_ans_contain').show("slow");

		setTimeout(function(){setQuestionCustmizerValues();}, 500);

	});
	jQuery('.add_ans').click(function(){
		jQuery('.add_ans').hide();
		jQuery('.ans_container').show();
		var htmldata ='<div class="answer-input-card answer_container" id ="answer_id"><div class="quiz-answer-textarea-block"><textarea class="sqb_tiny_editor ans_text" name="ques_desc"></textarea></div><div class="quiz-answer-points-block"><input type="text" name="ans_ponits" class="points_cls" /><input type="hidden" name="aid" class="aid_cls"  placeholder="points"></div><div class="quiz-answer-correct-block quiz-answer-correct-check"><div class="custom-checkbox-style"><input name="correct" class="correct_cls" type="checkbox" data-type="" classs="custom-checkbox-input"><label class="custom-checkbox-label"></label></div></div> </div>';
		jQuery( ".answer_container_inner_div").append(htmldata );
		
		var chktrue= jQuery('#answer_points_chk').prop("checked");
		if(chktrue == true) {
			jQuery('.quiz-answer-points-block, .quiz-answer-points-block').show();
		}else{
			jQuery('.quiz-answer-points-block , .quiz-answer-points-block').hide();
		} 			 
	 
		sqb_tiny_editor();
	});
	
	jQuery('#answer_points_chk').change(function(){
		if(jQuery(this).is(':checked')) {
			jQuery('.quiz-answer-points-block, .quiz-answer-points-block').show();
		}else{
			jQuery('.quiz-answer-points-block , .quiz-answer-points-block').hide();
		} 			 
	}); 
	jQuery('#upload_image').change(function(){
		if(jQuery(this).is(':checked')) {
			jQuery('.ques_image').show();
		}else{
			jQuery('.ques_image').hide();
		} 			 
	}); 
	jQuery('.add_more_ans').click(function(){
		 sqb_add_more_ans();
		/* var htmldata = sqb_add_more_ans();
		 jQuery( ".answer_container_div").append(htmldata );
		 sqb_tiny_editor();*/
	});
	
	jQuery('.remove_ans').click(function(){
		var del_id = jQuery(this).attr("id");		 
		var del_id =  del_id.split("_id");		 
		var getid = del_id[1];		 
		jQuery("#answer_id"+getid).remove();		 
	});
	jQuery(document).on('click', '.save_ans' , function(){
		 sqb_save_answer();
	});
	 
});

function sqb_placeholder_editable(){
	jQuery(document).on('focus', '.sqb_textarea_ans_field',function(){
		var text = jQuery(this).attr('placeholder');
		jQuery(this).val(text);
	});
	
	jQuery(document).on('focusout', '.sqb_textarea_ans_field',function(){
		var text = jQuery(this).val();
		jQuery(this).attr('placeholder', text);
		jQuery(this).val('');
	});
	
}


function sqb_quiz_optin_field_placeholder_update() {
	
		jQuery(document).on('focus','.optin_template_html_preview_outer input[type="text"], .optin_template_html_preview_outer  textarea', function(){ 
			var text = jQuery(this).attr('placeholder');
			jQuery(this).val(text);
		});
		
		jQuery(document).on('focusout','.optin_template_html_preview_outer input[type="text"], optin_template_html_preview_outer  textarea', function(){ 
			var text = jQuery(this).val();
			jQuery(this).attr('placeholder', text);
			jQuery(this).val('');
		});
		
		jQuery(document).on('focus','.optin_template_html_preview_outer input[name="email"]', function(){ 
			var text = jQuery(this).attr('placeholder');
			jQuery(this).val(text);
		});
		
		jQuery(document).on('focusout','.optin_template_html_preview_outer input[name="email"]', function(){ 
			var text = jQuery(this).val();
			jQuery(this).attr('placeholder', text);
			jQuery(this).val('');
		});
	
}


function sqb_connect_to_outcome_btn_action(){
	
	jQuery(document).on('click','.personality_outcome_connect_btn .outcome-option-skip', function (e) {
		var parent_selector = jQuery(this).closest('.question_div_inner');
		jQuery(this).addClass('outcome-option-active');
		jQuery(this).closest('.personality_outcome_connect_btn').find('.outcome-option-connect').removeClass('outcome-option-active');

		var question_type = jQuery('.sqb_question_no.active').find('.question_type_wrapper .dropdown-custom-style .dropdown-toggle').attr('data-value');

		if(question_type == 'matrix'){
			jQuery('.matrix-outcome-table').hide('slow');
			jQuery('.sqb_question_no.active').find('.question_add_answer_btn_div .outcome-option-connect').removeClass('outcome-option-active');
			jQuery('.sqb_question_no.active').find('.question_add_answer_btn_div .outcome-option-skip').addClass('outcome-option-active');
		}else{
			parent_selector.find('.assessment_outcome_connect_wrapper').hide('slow');
		}

	});


	jQuery(document).on('click','.add-matrix-tags', function () {
		if(jQuery('.answer_matrix_options_wrapper .sqb_ans_item').attr('data-id') == '%%ANSWERID%%'){
			swal('You need to first save the question and then you can map answers to outcomes.');
			return false;
		}

		var question_id = jQuery('.sqb_question_no.active').find('.sqb_question_enable_drag_drop').attr('data-id');
		var top_titles = "";
		var all_outcome = "";
		var outcome_names = "";

		SQBShowLoader();
		jQuery.post(ajaxurl, {
			action: 'sqb_load_all_tags',
			question_id: question_id
		}, function(response) {
			SQBHideLoader();
			response = JSON.parse(response);
			var tags_name = response.all_tags_data;
			var all_listed_tags = response.all_listed_tags;

			
			var html_data = "";

			if(tags_name){
				html_data = tags_name;
			}else{
				jQuery('#sqb-answer-matrix-table-scroll .SQB-main-table tr').find('th').each(function(){
					var ans_top_headings =jQuery(this).find('.matrix_label_text').text();
					if(ans_top_headings != ''){
						all_outcome += '<li><div class="outcome-tags-layout">'+ans_top_headings+'</div><div class="js-select2-multiple-wrapper"><select class="tag-select-box" multiple>'+all_listed_tags+'</select></div></li>';
					}
				});

				jQuery('#sqb-answer-matrix-table-scroll').find('.sqb_ans_item').each(function(){
					var ans_id = jQuery(this).attr('data-id');
					var ans_title = jQuery(this).find('.sql_ans_text').text();
					
					html_data += '<tr data-ans-id="'+ans_id+'"><td class="question-title">'+ans_title+'</td><td class="answer-title"><ul>'+all_outcome+'</ul> </td>';
				});
			}
			
			jQuery('.answer_matrix_options_wrapper .matrix-tags-table').show();
			jQuery('.answer_matrix_options_wrapper .append-matrix-tags-data').html(html_data);

			jQuery('#sqb-answer-matrix-table-scroll .SQB-main-table tr').find('th').each(function(index){
			    var ans_top_headings =jQuery(this).find('.matrix_label_text').text();
			    if(ans_top_headings != ''){
			        jQuery('.sqb-column-index-'+index).text(ans_top_headings);
			    }
			});

			jQuery('.tag-select-box').select2({
			    placeholder: 'Select options',
			    theme: 'default',
			    width: '100%'
			  });

			jQuery('.answer_matrix_options_wrapper .matrix-outcome-table').hide();
			jQuery('.answer_matrix_options_wrapper .sqb_add_more_question_section').hide();

		});
	});



	jQuery(document).on('click','.personality_outcome_connect_btn .outcome-option-connect', function (e) {
		var check_default_title = 0;

		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template == 'template1' || selected_template == 'template2' || selected_template == 'template3' || selected_template == 'template4' || selected_template == 'template7'){
			var question_type = jQuery('.sqb_question_no.active').find('.question-screen .question_type_wrapper .dropdown-custom-style').find('button').attr('data-value');
		}else if(selected_template == 'template5'){
			var question_type = jQuery('.sqb_question_no.active').find('.question_type_wrapper .dropdown-custom-style').find('button').attr('data-value');
		}else{
			var question_type = jQuery('.sqb_question_no.active').find('.template8_question_screen_setting_options_wrapper .question_type_wrapper .dropdown-custom-style').find('button').attr('data-value');
		}
		if(question_type == 'matrix'){
			if(jQuery('.answer_matrix_options_wrapper .sqb_ans_item').attr('data-id') == '%%ANSWERID%%'){
				swal('You need to first save the question and then you can map answers to outcomes.');
				return false;
			}

			jQuery('.sqb_question_no.active').find('.question_add_answer_btn_div .outcome-option-connect').addClass('outcome-option-active');
			jQuery('.sqb_question_no.active').find('.question_add_answer_btn_div .outcome-option-skip').removeClass('outcome-option-active');

			jQuery(this).addClass('outcome-option-active');
			jQuery('.answer_matrix_options_wrapper').find('.outcome-option-skip').removeClass('outcome-option-active');
			jQuery('.matrix-outcome-table').show('slow');
			

			if(jQuery('.answer_matrix_options_wrapper .append-outcome-data tr').length == 0){
				var top_titles = "";
				var all_outcome = "";
				var outcome_names = "";
				jQuery('.res_data_cont').each(function(){
					var outcome_name = jQuery(this).find('input[name="outcome_name"]').val();
					var outcome_id = jQuery(this).attr('data-outcome-id');
					outcome_names += ' <option value="'+outcome_id+'" data-outcome-id="'+outcome_id+'">'+outcome_name+'</option>';
				});

				jQuery('#sqb-answer-matrix-table-scroll .SQB-main-table tr').find('th').each(function(index){
					var ans_top_headings =jQuery(this).find('.matrix_label_text').text();
					if(ans_top_headings != ''){
						all_outcome += '<li><div class="sqb-column-index-'+index+' outcome-tags-layout">'+ans_top_headings+'</div><div class="js-select2-multiple-wrapper"><select class="mapping-select-box" multiple>'+outcome_names+'</select></div></li>';
					}
				});
				var html_data = "";
				jQuery('#sqb-answer-matrix-table-scroll').find('.sqb_ans_item').each(function(){
					var ans_id = jQuery(this).attr('data-id');
					var ans_title = jQuery(this).find('.sql_ans_text').text();
					
					html_data += '<tr data-ans-id="'+ans_id+'"><td>'+ans_title+'</td><td><ul>'+all_outcome+'</ul> </td>';
				});

				jQuery('.answer_matrix_options_wrapper .append-outcome-data').html(html_data);

				jQuery('.mapping-select-box').select2({
				    placeholder: 'Select options',
				    theme: 'default',
				    width: '100%'
				  });
			}


			
			return false;
		}

		var parent_selector = jQuery(this).closest('.question_div_inner');
		parent_selector.find('.question_add_answer_outer_div .sqb_ans_item').each(function(){
			var sqb_ans_title = jQuery(this).find('.sql_ans_text').text();
			/*if(sqb_ans_title == 'Type Answer Here'){
				check_default_title = 1;

				if(!jQuery('.personality_outcome_connect_btn .outcome-option-connect').hasClass('outcome-option-active')){
					swal('','To "connect to outcome", you need to enter answer text for all answer choices. We noticed you have not entered the answer text for some or all of the answer choices. Please enter the answer text for all answer choices.',"");
				}
				jQuery('.personality_outcome_connect_btn .outcome-option-skip').click();
				return false;
			}*/
		});


		
		if(check_default_title == 1){
				
		}else{
			jQuery(this).addClass('outcome-option-active');
			jQuery(this).closest('.personality_outcome_connect_btn').find('.outcome-option-skip').removeClass('outcome-option-active');
		

			var ans_list_has = parent_selector.find('.question_add_answer_outer_div .sqb_ans_item').length;
			if(ans_list_has == 0){
				sqb_sweet_message('','Please add answer','');
				return false;
			}
			var outcome_result_clone_list  = jQuery('.outcome_result_clone_list').html();
			parent_selector.find('.assessment_outcome_connect_wrapper').show('slow');	
			parent_selector.find('.assessment_outcome_connect_wrapper').find('.assessment_outcome_connect').show();
			//parent_selector.find('.assessment_outcome_connect').html('');
			var outcome_html = '';
			var outcome_index_count    = 0 ;
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div .sqb_ans_item').each(function(){
			   
			   var answer_id =  jQuery(this).attr('data-id');
			   var alredy_has = 0;
				 var answer_id_attr =  jQuery(this).attr('id');
				 var alerady_hsa_by = '';
			 
			   if(isNaN(answer_id)){
					   alredy_has = parent_selector.find('.quiz-content-card.ans_id_attr_'+answer_id_attr).length; 
					   alerady_hsa_by = 'by_answer_id';	
						
				}else{
					 
					 
					
					 alredy_has = parent_selector.find('.quiz-content-card[data-answer-id="'+answer_id+'"]').length;
						 alerady_hsa_by = 'by_answer_class';	
					
				}
				
			  
			   outcome_index_count = outcome_index_count + 1;
			   var sqb_datetime = new Date();
			   var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_cotcome_item_'+Math.floor(Math.random() * 10000);
			   var questiontype = jQuery('.sqb_question_no.active').find('.question_type_wrapper .dropdown-custom-style .dropdown-toggle').attr('data-value');
			   if(questiontype == 'date'){
			   	 var sql_ans_text = 'Date';
			   }else{
				   var sql_ans_text = jQuery(this).find('.sql_ans_text').html();
			   }
			   if(alredy_has == 0){
				outcome_html   = outcome_html + '<div class="quiz-content-card ans_id_attr_'+answer_id_attr+'" data-id="%%OUTCOMEMAPPINGID%%" data-answer-id="'+answer_id+'" data-answer-index-id = "'+outcome_index_count+'" id="'+sqb_round_no+'"><label for="" class="quiz_label">'+sql_ans_text+' </label><div class="quiz_right-content"><div class="multi-select-dropdown select_outcome_result_wrapper"><div class="multi-select-dropdown-link select_outcome_result_list">Select Outcomes <i class="fa fa-angle-down"></i></div>'+outcome_result_clone_list+'</div></div></div>';
				}else{
					/*if(alerady_hsa_by == 'by_answer_id'){
						 alredy_has = jQuery('.quiz-content-card.ans_id_attr_'+answer_id_attr). outcome_result_checkbox;
						 jQuery('.outcome_result_clone_list ..').
						 
						
					}else if(alerady_hsa_by == 'by_answer_id'){
						
					}*/
					
				}
			   
			   //parent_selector
			   
			});  

			/* if(outcome_html != ''){
			   outcome_html = '<div class="question_tab_outcome_heading">Connect to Outcome</div>'+outcome_html;
			}*/

          
           
			parent_selector.find('.assessment_outcome_connect').append(outcome_html);

		}
		
	}); 

	jQuery('body').on('click', '.save_ads_questions_btn', function(){
		SQBShowLoader();
		var ads_data = [];
		jQuery('.Manage_Side_Popup_content_innner .card').each(function(){

			var quiz_id =jQuery('#edit_id').val(); 
			var ques_id = jQuery(this).attr('data-question-id');
			var ads_enable = jQuery(this).find('input[name="ads_enable"]').prop('checked');
			if(ads_enable){
				var ads_val = 'Y';
			}else{
				var ads_val = 'N';
			}
			var content = jQuery(this).find('.card-body').html();	
			jQuery('.sqb_quiz_type_insert_ads_questions_wrapper .ans_recommendation_result_title').removeAttr('id');
			jQuery('.sqb_quiz_type_insert_ads_questions_wrapper .ans_recommendation_description').removeAttr('id');
			ads_data.push({
				'quiz_id':quiz_id,
				'ques_id':ques_id,
				'ads_val':ads_val,
				'content':content,
			});
		});

			jQuery.post(ajaxurl, {
				action: 'sqb_adsdata',
				ads_data: ads_data ,
				ads_action: "save",		
			}, function(response) {
				SQBHideLoader();
				jQuery('.saved-ads').show();
				setTimeout(function(){
					jQuery('.saved-ads').hide();
				},5000);
			});
	});	


	jQuery(document).on('click','.personality_outcome_connect_btn',function(){
	
		return false;
	  var parent_selector = jQuery(this).closest('.question_div_inner');	
	  
	   var ans_list_has = parent_selector.find('.question_add_answer_outer_div .sqb_ans_item').length;
	   if(ans_list_has == 0){
		   sqb_sweet_message('','Please add answer','');
		   return false;
	   }
	   var outcome_result_clone_list  = jQuery('.outcome_result_clone_list').html();
	   
	   
	  
	   parent_selector.find('.assessment_outcome_connect_wrapper').show('slow');	
	   parent_selector.find('.assessment_outcome_connect_wrapper').find('input[name="skip_outcome_mapping"]').prop('checked',false);	
	   parent_selector.find('.assessment_outcome_connect_wrapper').find('.haveskipmapping').hide();
	   parent_selector.find('.assessment_outcome_connect_wrapper').find('.assessment_outcome_connect').show();
	   //parent_selector.find('.assessment_outcome_connect').html('');
	   var outcome_html = '';
	   var outcome_index_count    = 0 ;
	   jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div .sqb_ans_item').each(function(){
		   
		   var answer_id =  jQuery(this).attr('data-id');
		   var alredy_has = 0;
		     var answer_id_attr =  jQuery(this).attr('id');
		     var alerady_hsa_by = '';
		 
		   if(isNaN(answer_id)){
		  		   alredy_has = jQuery('.quiz-content-card.ans_id_attr_'+answer_id_attr).length;
				   alerady_hsa_by = 'by_answer_id';	
					
			}else{
				 
				 
				
				 alredy_has = jQuery('.quiz-content-card[data-answer-id="'+answer_id+'"]').length;
					 alerady_hsa_by = 'by_answer_class';	
				
			}
			
		  
		   outcome_index_count = outcome_index_count + 1;
		   var sqb_datetime = new Date();
		   var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_cotcome_item_'+Math.floor(Math.random() * 10000);
		   var sql_ans_text = jQuery(this).find('.sql_ans_text').html();
		   if(alredy_has == 0){
			outcome_html   = outcome_html + '<div class="quiz-content-card ans_id_attr_'+answer_id_attr+'" data-id="%%OUTCOMEMAPPINGID%%" data-answer-id="'+answer_id+'" data-answer-index-id = "'+outcome_index_count+'" id="'+sqb_round_no+'"><label for="" class="quiz_label">'+sql_ans_text+' </label><div class="quiz_right-content"><div class="multi-select-dropdown select_outcome_result_wrapper"><div class="multi-select-dropdown-link select_outcome_result_list">Select Outcomes <i class="fa fa-angle-down"></i></div>'+outcome_result_clone_list+'</div></div></div>';
			}else{
				/*if(alerady_hsa_by == 'by_answer_id'){
					 alredy_has = jQuery('.quiz-content-card.ans_id_attr_'+answer_id_attr). outcome_result_checkbox;
					 jQuery('.outcome_result_clone_list ..').
					 
					
				}else if(alerady_hsa_by == 'by_answer_id'){
					
				}*/
				
			}
		   
		   //parent_selector
		   
	   });  
	   
	  /* if(outcome_html != ''){
		   outcome_html = '<div class="question_tab_outcome_heading">Connect to Outcome</div>'+outcome_html;
	   }*/
	   
	    
		
	   parent_selector.find('.assessment_outcome_connect').append(outcome_html);
	   
	    
		
	});
		
}

function sqb_question_template_customizer(){
	
 
	// start tempalte customzier 	
	var start_temp_preview_obj = jQuery('.start_template_html_preview_outer');
	
	if(jQuery('#sqb_template_selected').val() == 'template6'){
		jQuery('#start_temp_width').bootstrapSlider().change(function() {
			start_temp_preview_obj.find('.start_temp_outer').css('max-width', +this.value + 'px');
		});
		jQuery('.start_temp_width').parent('.Template5_customizer').css('display','none');
		jQuery('.start_temp_width').parent('.Template5_customizer.sqb_common_customizer').show();
	 	jQuery('.Quiz-Template-title').css('background','none');
	 	//jQuery('#start_temp_br_wid').bootstrapSlider('setValue', 0);
	 	//start_temp_preview_obj.find('.start_temp_outer').css('opacity','0.3');	
	} else {

		jQuery('#start_temp_width').bootstrapSlider().change(function() {
			jQuery('.start_temp_width_input').val(this.value);
			if(jQuery('#sqb_template_selected').val() == 'template7'){
				jQuery('#start_temp_static_div_id').css('max-width', +this.value + 'px');
			} else if(jQuery('#sqb_template_selected').val() == 'template8'){
			} else {
				start_temp_preview_obj.find('.start_temp_outer').css('max-width', +this.value + 'px');
			}
		});
	
	}
	
	jQuery('#start_temp_br_wid').bootstrapSlider().change(function() {
		if(jQuery('#sqb_template_selected').val() == 'template7'){
			jQuery('#start_temp_static_div_id').css('border-width', +this.value + 'px');
		} else {
			start_temp_preview_obj.find('.start_temp_outer').css('border-width', +this.value + 'px');
		}
	});
		
	jQuery('#start_temp_alignment').on('change',function() {
				start_temp_preview_obj.find('.start_temp_outer').css('text-align', this.value);
	});

	jQuery('#start-animation').on('change',function() {
		const element = document.querySelector('.take-quiz-btn');
		var animation_effect = this.value;
		
		if(jQuery('.save-animation-effect').length){
			jQuery(start_temp_preview_obj.find('.save-animation-effect').remove());
			jQuery(start_temp_preview_obj.append('<input type="hidden" name="save-animation-effect" class="save-animation-effect" value="'+animation_effect+'"></input>'));
		}else{
			jQuery(start_temp_preview_obj.append('<input type="hidden" name="save-animation-effect" class="save-animation-effect" value="'+animation_effect+'"></input>'));
		}

		element.classList.add('animated', animation_effect);
		setTimeout(function() {
			element.classList.remove(animation_effect);
		}, 1000);
	});


	jQuery('#start_temp_br_style').on('change',function() {
		if(jQuery('#sqb_template_selected').val() == 'template7'){
			jQuery('#start_temp_static_div_id').css('border-style', this.value);
		} else {
			start_temp_preview_obj.find('.start_temp_outer').css('border-style', this.value);
		}
	});   

	jQuery('#start_temp_backgroud_color,#start_temp_backgroud_color_div').colorpicker().on('changeColor', function() { 
		if(jQuery('#sqb_template_selected').val() == 'template7'){
		jQuery('#start_temp_static_div_id').css('background-color', jQuery(this).colorpicker('getValue'));	
		} else {
		start_temp_preview_obj.find('.start_temp_outer').css('background-color', jQuery(this).colorpicker('getValue'));
		}		
	});

	jQuery('#start_temp_backgroud_color_bw_customizer,#start_temp_backgroud_color_bw_customizer_div').colorpicker().on('changeColor', function() { 
				var color = jQuery('#start_temp_backgroud_color_bw_customizer').val();
				
				//start_temp_preview_obj.find('.start_temp_outer').css('background-color', jQuery(this).colorpicker('getValue'));
			jQuery('#start_temp_backgroud_color_question').val(color);
			//jQuery("#start_temp_backgroud_color_question").trigger('change');
			jQuery('#start_temp_backgroud_color_question_div span.input-group-addon i').css('background-color', color);
			
			jQuery('#start_temp_backgroud_color_outcome').val(color);
			//jQuery("#start_temp_backgroud_color_outcome").trigger('change');
			jQuery('#start_temp_backgroud_color_outcome_div span.input-group-addon i').css('background-color', color);


			// jQuery('#start_temp_backgroud_color_question_div').val('color');

			var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
		    + ',' + parseInt(color.slice(-4,-2),16)
		    + ',' + parseInt(color.slice(-2),16)
		    +','+'0.3' +')';				
	    	jQuery('.start_temp_outer').css('background-color', rgbaCol);
			jQuery('.result_temp_outer').css('background-color', rgbaCol);
			jQuery('.quiz_comon_template.sqb_question_enable_drag_drop').css('background-color', rgbaCol);
			jQuery('.Quiz-Optin-Template.quiz_comon_template').css('background-color', rgbaCol);
			
			
			if(jQuery('#sqb_template_selected').val() == 'template6'){
				var sqb_remaining_style = jQuery('.start_temp_outer').attr('style');
				//jQuery('#bg_imge_style_inner').val(sqb_remaining_style);
			}
			
	});
	
	jQuery('#start_temp_outer_backgroud_color_bw_customizer,#start_temp_outer_backgroud_color_bw_customizer_div').colorpicker().on('changeColor', function() { 
			var color = jQuery('#start_temp_outer_backgroud_color_bw_customizer').val();
			/*var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
		    + ',' + parseInt(color.slice(-4,-2),16)
		    + ',' + parseInt(color.slice(-2),16)
		    +','+'0.3' +')';	*/			
			jQuery('#Start-Screen-Settings .start_temp_static_div').css('background-color', color);
			jQuery('#Outcome-Display .outcome-section').css('background-color', color);
			jQuery('#Quiz-Screen-Settings .question-screen').css('background-color', color);
			jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').css('background-color', color);
			
			var sqb_remaining_style = jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(sqb_remaining_style);
			
			jQuery('#start_temp_outer_backgroud_color_outcome, #start_temp_outer_backgroud_color_outcome_div').val(color);
			jQuery('#start_temp_outer_backgroud_color_question, #start_temp_outer_backgroud_color_question_div').val(color);
	});
	
	jQuery('#start_temp_outer_backgroud_color_outcome,#start_temp_outer_backgroud_color_outcome_div').colorpicker().on('changeColor', function() { 
			var color = jQuery('#start_temp_outer_backgroud_color_outcome').val();
			var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
		    + ',' + parseInt(color.slice(-4,-2),16)
		    + ',' + parseInt(color.slice(-2),16)
		    +','+'0.3' +')';	
		    var sqb_bg_img = jQuery('#start_temp_static_div_id').css('background-image');
			if(sqb_bg_img != 'none'){
				jQuery('#Start-Screen-Settings .start_temp_static_div').css('background-color', rgbaCol);
			}
			
			jQuery('#Outcome-Display .outcome-section').css('background-color', rgbaCol);
			jQuery('#Quiz-Screen-Settings .question-screen').css('background-color', rgbaCol);
			jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').css('background-color', rgbaCol);
			
			var sqb_remaining_style = jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(sqb_remaining_style);
			jQuery('#start_temp_outer_backgroud_color_bw_customizer, #start_temp_outer_backgroud_color_bw_customizer_div').val(color);
	});

	jQuery('#start_temp_outer_backgroud_color_question,#start_temp_outer_backgroud_color_question_div').colorpicker().on('changeColor', function() { 
			var color = jQuery('#start_temp_outer_backgroud_color_question').val();
			/*var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
		    + ',' + parseInt(color.slice(-4,-2),16)
		    + ',' + parseInt(color.slice(-2),16)
		    +','+'0.3' +')';*/	
		    jQuery('#start_temp_outer_backgroud_color_outcome').val(color);
		    var sqb_bg_img = jQuery('#start_temp_static_div_id').css('background-image');
			//if(sqb_bg_img != 'none'){
				jQuery('#Start-Screen-Settings .start_temp_static_div').css('background-color', color);
			//}
			
			jQuery('#Outcome-Display .outcome-section').css('background-color', color);
			jQuery('#Quiz-Screen-Settings .question-screen').css('background-color', color);
			jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').css('background-color', color);
			
			var sqb_remaining_style = jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(sqb_remaining_style);
			jQuery('#start_temp_outer_backgroud_color_bw_customizer, #start_temp_outer_backgroud_color_bw_customizer_div').val(color);
	});
	
	jQuery('#start_temp_backgroud_color_outcome,#start_temp_backgroud_color_outcome_div').colorpicker().on('changeColor', function() { 
				var color = jQuery('#start_temp_backgroud_color_outcome').val();
				
				//start_temp_preview_obj.find('.start_temp_outer').css('background-color', jQuery(this).colorpicker('getValue'));
				
			var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
		    + ',' + parseInt(color.slice(-4,-2),16)
		    + ',' + parseInt(color.slice(-2),16)
		    +','+'0.3' +')';

		    jQuery('#start_temp_backgroud_color_question').val(color);
		    jQuery('#start_temp_backgroud_color_question_div span.input-group-addon i').css('background-color', color);
			/*jQuery("#start_temp_backgroud_color_question").trigger('change');*/

			jQuery('#start_temp_backgroud_color_bw_customizer').val(color);
			jQuery('#start_temp_backgroud_color_bw_customizer_div span.input-group-addon i').css('background-color', color);
			/*jQuery("#start_temp_backgroud_color_bw_customizer").trigger('change');*/


		    if(jQuery('input[name="select_temp"]:checked').val() == 'template6'){				
	    	jQuery('.start_temp_outer').css('background-color', rgbaCol);
			jQuery('.result_temp_outer').css('background-color', rgbaCol);
			jQuery('.Quiz-Optin-Template.quiz_comon_template').css('background-color', rgbaCol);
			jQuery('.question-screen .Quiz-Template.quiz_comon_template').css('background-color', rgbaCol);
			
			var sqb_remaining_style = jQuery('#Result-Screen-Settings .res_data_cont.active .result_temp_outer').attr('style');
			//jQuery('#bg_imge_style_inner').val(sqb_remaining_style);
			
			} else {
				var sqb_bg_img = jQuery('#start_temp_static_div_id').css('background-image');
				if (sqb_bg_img != 'none'){
					var sqb_bg_img = sqb_bg_img.split(/[, ]+/).pop();
					var sqb_linear_gradient = 'linear-gradient('+rgbaCol+','+ rgbaCol+'),'+sqb_bg_img;
					jQuery('#start_temp_static_div_id').css('background-image', sqb_linear_gradient);
					jQuery('#Result-Screen-Settings .outcome-section').css('background-image', sqb_linear_gradient);
					jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-image', sqb_linear_gradient);
					jQuery('.optin_template_html_preview_outer').css('background-image', sqb_linear_gradient);
					
					jQuery('#start_temp_static_div_id').css('background-color', rgbaCol);
					jQuery('#Result-Screen-Settings .outcome-section').css('background-color', rgbaCol);
					jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-color', rgbaCol);
					jQuery('.optin_template_html_preview_outer').css('background-color', rgbaCol);
				} else {
					jQuery('#start_temp_static_div_id').css('background-color', rgbaCol);
					jQuery('#Result-Screen-Settings .outcome-section').css('background-color', rgbaCol);
					jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-color', rgbaCol);
					jQuery('.optin_template_html_preview_outer').css('background-color', rgbaCol);
				}
			}
			
	});

	jQuery('#start_temp_backgroud_color_question,#start_temp_backgroud_color_question_div').colorpicker().on('changeColor', function() { 
			var color = jQuery('#start_temp_backgroud_color_question').val();
			var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
		    + ',' + parseInt(color.slice(-4,-2),16)
		    + ',' + parseInt(color.slice(-2),16)
		    +','+'0.3' +')';

			jQuery('#start_temp_backgroud_color_outcome').val(color);
			jQuery('#start_temp_backgroud_color_outcome_div span.input-group-addon i').css('background-color', color);
			//jQuery("#start_temp_backgroud_color_outcome").trigger('change');

			jQuery('#start_temp_backgroud_color_bw_customizer').val(color);
			jQuery('#start_temp_backgroud_color_bw_customizer_div span.input-group-addon i').css('background-color', color);
			//jQuery("#start_temp_backgroud_color_bw_customizer").trigger('change');


		    if(jQuery('input[name="select_temp"]:checked').val() == 'template6'){				
	    		jQuery('.start_temp_outer').css('background-color', rgbaCol);
				jQuery('.result_temp_outer').css('background-color', rgbaCol);
				jQuery('.question-screen .quiz_comon_template').css('background-color', rgbaCol);
				jQuery('.Quiz-Optin-Template.quiz_comon_template').css('background-color', rgbaCol);
			
				var sqb_remaining_style = jQuery('#Result-Screen-Settings .res_data_cont.active .result_temp_outer').attr('style');
				//jQuery('#bg_imge_style_inner').val(sqb_remaining_style);
			} else {
				var sqb_bg_img = jQuery('#start_temp_static_div_id').css('background-image');
				if (sqb_bg_img != 'none'){
					var sqb_bg_img = sqb_bg_img.split(/[, ]+/).pop();
					var sqb_linear_gradient = 'linear-gradient('+rgbaCol+','+ rgbaCol+'),'+sqb_bg_img;
					jQuery('#start_temp_static_div_id').css('background-image', sqb_linear_gradient);
					jQuery('#Result-Screen-Settings .outcome-section').css('background-image', sqb_linear_gradient);
					jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-image', sqb_linear_gradient);
					jQuery('.optin_template_html_preview_outer').css('background-image', sqb_linear_gradient);
					
					jQuery('#start_temp_static_div_id').css('background-color', rgbaCol);
					jQuery('#Result-Screen-Settings .outcome-section').css('background-color', rgbaCol);
					jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-color', rgbaCol);
					jQuery('.optin_template_html_preview_outer').css('background-color', rgbaCol);
				} else {
					jQuery('#start_temp_static_div_id').css('background-color', rgbaCol);
					jQuery('#Result-Screen-Settings .outcome-section').css('background-color', rgbaCol);
					jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-color', rgbaCol);
					jQuery('.optin_template_html_preview_outer').css('background-color', rgbaCol);
				}
			}
			
	});
	

	
	

	/*Main Width*/

	/*In Pixels*/
	jQuery('#background_width').bootstrapSlider().change(function() {
			jQuery('.start_temp_static_div').css('width', +this.value);
			jQuery('.start_temp_static_div').css('max-width', '100%');
			jQuery('input[name=select_background_width]').val(this.value);
			jQuery('.outcome-section').css('width', +this.value);
			jQuery('.question-screen').css('width', +this.value);
			jQuery('.optin_template_html_preview_outer').css('width', +this.value);
			jQuery('#background_width_question').bootstrapSlider('setValue',parseFloat(+this.value));
			jQuery('#background_width_outcome').bootstrapSlider('setValue',parseFloat(+this.value));

			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);

	});

	jQuery('#background_width_outcome').bootstrapSlider().change(function() {
			jQuery('.start_temp_static_div').css('width', +this.value);
			jQuery('.start_temp_static_div').css('max-width', '100%');
			jQuery('input[name=select_background_width]').val(this.value);
			jQuery('.outcome-section').css('width', +this.value);
			jQuery('.question-screen').css('width', +this.value);
			jQuery('.optin_template_html_preview_outer').css('width', +this.value);
			jQuery('#background_width_question').bootstrapSlider('setValue',parseFloat(+this.value));
			jQuery('#background_width').bootstrapSlider('setValue',parseFloat(+this.value));

			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);

	});

	jQuery('#background_width_question').bootstrapSlider().change(function() {
			jQuery('.start_temp_static_div').css('width', +this.value);
			jQuery('.start_temp_static_div').css('max-width', '100%');
			jQuery('input[name=select_background_width]').val(this.value);
			jQuery('.outcome-section').css('width', +this.value);
			jQuery('.question-screen').css('width', +this.value);
			jQuery('.optin_template_html_preview_outer').css('width', +this.value);
			jQuery('#background_width_outcome').bootstrapSlider('setValue',parseFloat(+this.value));
			jQuery('#background_width').bootstrapSlider('setValue',parseFloat(+this.value));

			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);

	});

	/*In Percentage*/
	jQuery('#background_width_percentage').bootstrapSlider().change(function() {
			jQuery('.start_temp_static_div').css('max-width', +this.value+'%');
			jQuery('input[name=background_width_percentage]').val(this.value);
			jQuery('.outcome-section').css('max-width', +this.value+'%');
			jQuery('.question-screen').css('max-width', +this.value+'%');
			jQuery('.optin_template_html_preview_outer').css('max-width', +this.value+'%');
			jQuery('#background_width_percentage_question').bootstrapSlider('setValue',parseFloat(+this.value));
			jQuery('#background_width_percentage_outcome').bootstrapSlider('setValue',parseFloat(+this.value));
			
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
	});

	jQuery('#background_width_percentage_outcome').bootstrapSlider().change(function() {
			jQuery('.start_temp_static_div').css('max-width', +this.value+'%');
			jQuery('input[name=background_width_percentage]').val(this.value);
			jQuery('.outcome-section').css('max-width', +this.value+'%');
			jQuery('.question-screen').css('max-width', +this.value+'%');
			jQuery('.optin_template_html_preview_outer').css('max-width', +this.value+'%');
			jQuery('#background_width_percentage_question').bootstrapSlider('setValue',parseFloat(+this.value));
			jQuery('#background_width_percentage').bootstrapSlider('setValue',parseFloat(+this.value));
			
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
	});

	jQuery('#background_width_percentage_question').bootstrapSlider().change(function() {
			jQuery('.start_temp_static_div').css('max-width', +this.value+'%');
			jQuery('input[name=background_width_percentage]').val(this.value);
			jQuery('.outcome-section').css('max-width', +this.value+'%');
			jQuery('.question-screen').css('max-width', +this.value+'%');
			jQuery('.optin_template_html_preview_outer').css('max-width', +this.value+'%');
			jQuery('#background_width_percentage_outcome').bootstrapSlider('setValue',parseFloat(+this.value));
			jQuery('#background_width_percentage').bootstrapSlider('setValue',parseFloat(+this.value));
			
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
	});

	jQuery('body').on('change','.select-background-width-option', function() {
	  	if(this.value == 'px'){
	  		jQuery('.width-show-in-px').show();
	  		jQuery('#background_width').bootstrapSlider('setValue',1800);
	  		jQuery('input[name="select_background_width"]').val(1800);
	  		jQuery('.width-show-in-percentage').hide();
	  		jQuery('.start_temp_static_div').css('max-width','');
	  		jQuery('.select_background_width').val('');
	  		jQuery(".select-background-width-option option").removeAttr('selected');
	  		jQuery(".select-background-width-option option[value='"+this.value+"']").attr("selected","selected");

	  		jQuery('.start_temp_static_div').css('width', '1800px');
	  		jQuery('.start_temp_static_div').css('max-width', '100%');

	  		/*Outcome Screen*/
	  		jQuery('.outcome-section').css('width', '1800px');
	  		jQuery('.outcome-section').css('max-width', '100%');

	  		jQuery('.question-screen').css('width', '1800px');
	  		jQuery('.question-screen').css('max-width', '100%');

	  		jQuery('.optin_template_html_preview_outer').css('width', '1800px');
	  		jQuery('.optin_template_html_preview_outer').css('max-width', '100%');

	  		jQuery('.outcome-section').css('max-width','');
	  		jQuery('.question-screen').css('max-width','');
	  		jQuery('.optin_template_html_preview_outer').css('max-width','');


	  	}else if(this.value =='percentage'){
	  		jQuery('#background_width_percentage').bootstrapSlider('setValue',100);
	  		jQuery('input[name="background_width_percentage"]').val(100);
	  		jQuery('.width-show-in-percentage').show();
	  		jQuery('.width-show-in-px').hide();
	  		jQuery('.start_temp_static_div').css('width','');
	  		jQuery('.select_background_width').val('');
	  		jQuery(".select-background-width-option option").removeAttr('selected');
	  		jQuery(".select-background-width-option option[value='"+this.value+"']").attr("selected","selected");

	  		jQuery('.start_temp_static_div').css('max-width', '100%');
	  		jQuery('.question-screen').css('max-width', '100%');
	  		jQuery('.optin_template_html_preview_outer').css('max-width', '100%');
	  		/*Outcome Screen*/
	  		jQuery('.outcome-section').css('width','');
	  		jQuery('.question-screen').css('width','');
	  		jQuery('.optin_template_html_preview_outer').css('width','');
	  	}
	  	
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
	});


	/*Main Height*/

	/*In Pixels*/

	jQuery('#background_height').bootstrapSlider().change(function() {
		jQuery('.start_temp_static_div').css('min-height', this.value+'px');
		jQuery('.start_temp_static_div').css('display', 'flex');
		jQuery('.start_temp_static_div').css('justify-content', 'center');
		jQuery('.start_temp_static_div').css('align-items', 'center');
		jQuery('input[name=select_background_height]').val(this.value);

		jQuery('#background_height_question').bootstrapSlider('setValue', this.value);
		jQuery('#background_height_outcome').bootstrapSlider('setValue', this.value);

		/*Outcome*/
		jQuery('.outcome-section').css('min-height', this.value+'px');
		//jQuery('.outcome-section').css('min-height', total_height);
		jQuery('.outcome-section').css('display', 'flex');
		jQuery('.outcome-section').css('justify-content', 'center');
		jQuery('.outcome-section').css('align-items', 'center');

		jQuery('.question-screen').css('min-height', this.value+'px');
		//jQuery('.question-screen').css('min-height', total_height);
		jQuery('.question-screen').css('display', 'flex');
		jQuery('.question-screen').css('justify-content', 'center');
		jQuery('.question-screen').css('align-items', 'center');

		jQuery('.optin_template_html_preview_outer').css('min-height', this.value+'px');
		//jQuery('.optin_template_html_preview_outer').css('min-height', total_height);
		jQuery('.optin_template_html_preview_outer').css('display', 'flex');
		jQuery('.optin_template_html_preview_outer').css('justify-content', 'center');
		jQuery('.optin_template_html_preview_outer').css('align-items', 'center');
		
		var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
		jQuery('#bg_imge_style').val(bg_style);
		var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
		jQuery('#bg_imge_style_inner').val(get_inner_style);
	});

	jQuery('#background_height_outcome').bootstrapSlider().change(function() {
			jQuery('.start_temp_static_div').css('min-height', this.value+'px');
			jQuery('.start_temp_static_div').css('display', 'flex');
			jQuery('.start_temp_static_div').css('justify-content', 'center');
			jQuery('.start_temp_static_div').css('align-items', 'center');
			jQuery('.start_temp_static_div').css('padding','')
			jQuery('input[name=select_background_height]').val(this.value);

			jQuery('#background_height').bootstrapSlider('setValue', this.value);
			jQuery('#background_height_question').bootstrapSlider('setValue', this.value);

			/*Outcome*/
			jQuery('.outcome-section').css('min-height', this.value+'px');
			jQuery('.outcome-section').css('display', 'flex');
			jQuery('.outcome-section').css('justify-content', 'center');
			jQuery('.outcome-section').css('align-items', 'center');
			jQuery('.outcome-section').css('padding','');

			jQuery('.question-screen').css('min-height', this.value+'px');
			jQuery('.question-screen').css('display', 'flex');
			jQuery('.question-screen').css('justify-content', 'center');
			jQuery('.question-screen').css('align-items', 'center');
			jQuery('.question-screen').css('padding','');

			jQuery('.optin_template_html_preview_outer').css('min-height', this.value+'px');
			jQuery('.optin_template_html_preview_outer').css('display', 'flex');
			jQuery('.optin_template_html_preview_outer').css('justify-content', 'center');
			jQuery('.optin_template_html_preview_outer').css('align-items', 'center');
			jQuery('.optin_template_html_preview_outer').css('padding','');
			
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
	});

	jQuery('#background_height_question').bootstrapSlider().change(function() {
			
			jQuery('.start_temp_static_div').css('min-height', this.value+'px');
			//jQuery('.start_temp_static_div').css('min-height', total_height);
			jQuery('.start_temp_static_div').css('display', 'flex');
			jQuery('.start_temp_static_div').css('justify-content', 'center');
			jQuery('.start_temp_static_div').css('align-items', 'center');
			jQuery('input[name=select_background_height]').val(this.value);

			jQuery('#background_height_vh').bootstrapSlider('setValue', this.value);
			jQuery('#select_background_height').bootstrapSlider('setValue', this.value);

			/*Outcome*/
			jQuery('.outcome-section').css('min-height', this.value+'px');
			//jQuery('.outcome-section').css('min-height', total_height);
			jQuery('.outcome-section').css('display', 'flex');
			jQuery('.outcome-section').css('justify-content', 'center');
			jQuery('.outcome-section').css('align-items', 'center');

			jQuery('.question-screen').css('min-height', this.value+'px');
			//jQuery('.question-screen').css('min-height', total_height);
			jQuery('.question-screen').css('display', 'flex');
			jQuery('.question-screen').css('justify-content', 'center');
			jQuery('.question-screen').css('align-items', 'center');

			jQuery('.optin_template_html_preview_outer').css('min-height', this.value+'px');
			//jQuery('.optin_template_html_preview_outer').css('min-height', total_height);
			jQuery('.optin_template_html_preview_outer').css('display', 'flex');
			jQuery('.optin_template_html_preview_outer').css('justify-content', 'center');
			jQuery('.optin_template_html_preview_outer').css('align-items', 'center');
			
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
	});

	/*In Vh*/

	jQuery('#background_height_vh').bootstrapSlider().change(function() {
			var get_height = jQuery('.start_temp_outer').height();
			var total_height = get_height + 200;
			jQuery('.start_temp_static_div').css('min-height', this.value+'vh');
			//jQuery('.start_temp_static_div').css('min-height', total_height);
			jQuery('.start_temp_static_div').css('display', 'flex');
			jQuery('.start_temp_static_div').css('justify-content', 'center');
			jQuery('.start_temp_static_div').css('align-items', 'center');
			jQuery('.start_temp_static_div').css('padding','')
			jQuery('input[name=select_background_height_vh]').val(this.value);

			jQuery('#background_height_vh_question').bootstrapSlider('setValue', this.value);
			jQuery('#background_height_vh_outcome').bootstrapSlider('setValue', this.value);

			/*Outcome*/
			jQuery('.outcome-section').css('min-height', this.value+'vh');
			//jQuery('.outcome-section').css('min-height', total_height);
			jQuery('.outcome-section').css('display', 'flex');
			jQuery('.outcome-section').css('justify-content', 'center');
			jQuery('.outcome-section').css('align-items', 'center');
			jQuery('.outcome-section').css('padding','');

			jQuery('.question-screen').css('min-height', this.value+'vh');
			//jQuery('.question-screen').css('min-height', total_height);
			jQuery('.question-screen').css('display', 'flex');
			jQuery('.question-screen').css('justify-content', 'center');
			jQuery('.question-screen').css('align-items', 'center');
			jQuery('.question-screen').css('padding','');

			jQuery('.optin_template_html_preview_outer').css('min-height', this.value+'vh');
			//jQuery('.optin_template_html_preview_outer').css('min-height', total_height);
			jQuery('.optin_template_html_preview_outer').css('display', 'flex');
			jQuery('.optin_template_html_preview_outer').css('justify-content', 'center');
			jQuery('.optin_template_html_preview_outer').css('align-items', 'center');
			jQuery('.optin_template_html_preview_outer').css('padding','');
			
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
	});


	/*New Height option*/

	jQuery('.background_height_question_v2').slider().on('change', function(event) {
			jQuery('.background_height_question_v2').bootstrapSlider('setValue', this.value);
			jQuery('.start_temp_static_div').css('min-height', this.value);
			jQuery('.start_temp_static_div').removeClass('vh-height-apply-v2');
			jQuery('.select_background_height_v2').val(this.value);

			var select_temp = jQuery('input[name="select_temp"]:checked').val();
			if(select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4'){
				jQuery('.sqb_question_enable_drag_drop, .outcome-section .result_temp_outer, .optin_template_html_preview_outer .Quiz-Optin-Template, .start_temp_static_div .start_temp_outer').css('min-height', +this.value);
				jQuery('.sqb_question_enable_drag_drop, .outcome-section .result_temp_outer, .optin_template_html_preview_outer .Quiz-Optin-Template, .start_temp_static_div .start_temp_outer').removeClass('vh-height-apply-v2');
			}else{
				jQuery('.sqb_question_enable_drag_drop, .outcome-section, .optin_template_html_preview_outer, .start_temp_static_div, .outcome-section, .optin_template_html_preview_outer').css('min-height', +this.value);
				jQuery('.sqb_question_enable_drag_drop, .outcome-section, .optin_template_html_preview_outer, .start_temp_static_div, .outcome-section, .optin_template_html_preview_outer').removeClass('vh-height-apply-v2');
			}

			

	});

	jQuery('.template9-start-screen-background_height_question_v2').slider().on('change', function(event) {	
		jQuery('.template9-start-screen-select_background_height_v2').val(this.value);
		jQuery("body").get(0).style.setProperty("--template9_temp_height", jQuery(this).val()+'px');

		jQuery('.template9_background_height_question_v2').bootstrapSlider('setValue', this.value);
		jQuery('.template9_select_background_height_v2').val(this.value);
	});

	jQuery('.template9_background_height_question_v2').slider().on('change', function(event) {	
		jQuery('.template9-start-screen-select_background_height_v2').val(this.value);
		jQuery("body").get(0).style.setProperty("--template9_temp_height", jQuery(this).val()+'px');

		jQuery('.template9-start-screen-background_height_question_v2').bootstrapSlider('setValue', this.value);
		jQuery('.template9_select_background_height_v2').val(this.value);
	});

	jQuery('.template9-start-screen-background_height_vh_question_v2').slider().on('change', function(event) {	
		jQuery('input[name="template9-start-screen-select_background_height_vh_v2"]').val(this.value);
		jQuery("body").get(0).style.setProperty("--template9_temp_height", jQuery(this).val()+'vh');

		jQuery('input[name="template9_select_background_height_vh_v2"]').val(this.value);
		jQuery('.template9_background_height_vh_question_v2').bootstrapSlider('setValue', this.value);
	});

	jQuery('.template9_background_height_vh_question_v2').slider().on('change', function(event) {	
		jQuery('input[name="template9-start-screen-select_background_height_vh_v2"]').val(this.value);
		jQuery("body").get(0).style.setProperty("--template9_temp_height", jQuery(this).val()+'vh');

		jQuery('input[name="template9_select_background_height_vh_v2"]').val(this.value);
		jQuery('.template9-start-screen-background_height_vh_question_v2').bootstrapSlider('setValue', this.value);
	});

	
	/*In Vh*/

	jQuery('.background_height_vh_question_v2').slider().on('change', function(event) {
			jQuery('.background_height_vh_question_v2').bootstrapSlider('setValue', this.value);

			jQuery('.start_temp_static_div').css('min-height', this.value+'vh');
			jQuery('.start_temp_static_div').addClass('vh-height-apply-v2');
			jQuery('input[name=select_background_height_vh_v2]').val(this.value);

			var select_temp = jQuery('input[name="select_temp"]:checked').val();
			if(select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4'){
				jQuery('.sqb_question_enable_drag_drop, .outcome-section .result_temp_outer, .optin_template_html_preview_outer .Quiz-Optin-Template, .start_temp_static_div .start_temp_outer').css('min-height', this.value+'vh');
				jQuery('.sqb_question_enable_drag_drop, .outcome-section .result_temp_outer, .optin_template_html_preview_outer .Quiz-Optin-Template, .start_temp_static_div .start_temp_outer').addClass('vh-height-apply-v2');
			}else{
				jQuery('.question-screen .sqb_question_enable_drag_drop, .outcome-section, .optin_template_html_preview_outer, .start_temp_static_div, .outcome-section, .optin_template_html_preview_outer').css('min-height', this.value+'vh');
				jQuery('.question-screen .sqb_question_enable_drag_drop, .outcome-section, .optin_template_html_preview_outer, .start_temp_static_div, .outcome-section, .optin_template_html_preview_outer').addClass('vh-height-apply-v2');
			}
			

	});

	/*New Padding option*/
	jQuery('.input_padding_option_v2').slider().on('change', function(event) {
			jQuery('.input_padding_option_v2').bootstrapSlider('setValue', this.value);
			
			jQuery('.start_temp_static_div, .outcome-section, .question-screen').css('padding-top', +this.value+'px');
			jQuery('.start_temp_static_div, .outcome-section, .question-screen').css('padding-bottom', +this.value+'px');
	});

	/*Template6 Background opacity*/
	jQuery('.template6_background_image_opacity').slider().on('change', function(event) {
		var get_val = jQuery(this).val();
		var rev_val = opacity_reverse(get_val);
 		jQuery("body").get(0).style.setProperty("--template6_background_image_opacity", rev_val);

 		jQuery('.template6_background_image_opacity').bootstrapSlider('setValue',parseFloat(+this.value));
	});

	function opacity_reverse(opacity_val){
	    var opacity_cal = 1 - opacity_val;
	    return opacity_cal;
	}

	jQuery('body').on('change','.select-background-width-percentage-option', function() {
		var cp = jQuery(this).val();

		jQuery(".select-background-width-px-option option").removeAttr('selected');
		jQuery(".select-background-width-percentage-option option").removeAttr('selected');

		if(cp == 'px'){
			jQuery('.global-width-px').show();
			jQuery('.global-width-percentage').hide();
			jQuery('.sqb_global_outer_width_input').val('2000');
			jQuery('#sqb_global_outer_width').bootstrapSlider('setValue', '2000');
			jQuery(".select-background-width-px-option option[value='px']").attr("selected","selected");
		}else{
			jQuery('.global-width-px').hide();
			jQuery('.global-width-percentage').show();
			jQuery('.sqb_global_outer_width_percentage_input').val('100');
			jQuery('#sqb_global_outer_width_percentage').bootstrapSlider('setValue', '100');
			jQuery(".select-background-width-px-option option[value='percentage']").attr("selected","selected");
		}
	});
	jQuery('body').on('change','.select-background-width-px-option', function() {
		var cp = jQuery(this).val();
		jQuery(".select-background-width-px-option option").removeAttr('selected');
		jQuery(".select-background-width-percentage-option option").removeAttr('selected');

		if(cp == 'percentage'){
			jQuery('.global-width-px').hide();
			jQuery('.global-width-percentage').show();

			jQuery('.sqb_global_outer_width_percentage_input').val('100');
			jQuery('#sqb_global_outer_width_percentage').bootstrapSlider('setValue', '100');
			jQuery(".select-background-width-percentage-option option[value='percentage']").attr("selected","selected");
		}else{
			jQuery('.global-width-px').show();
			jQuery('.global-width-percentage').hide();
			jQuery('.sqb_global_outer_width_input').val('2000');
			jQuery('#sqb_global_outer_width').bootstrapSlider('setValue', '2000');
			jQuery(".select-background-width-percentage-option option[value='px']").attr("selected","selected");
		}
	});

	jQuery('body').on('change','.sqb_select_global_height', function() {
	  	jQuery(".sqb_select_global_height option").removeAttr('selected');

		jQuery(".sqb_select_global_height option[value='"+this.value+"']").attr("selected","selected");
		if(this.value == 'px'){
			jQuery('.sqb_global_height_input').val('1200');
			jQuery('#sqb_global_height').bootstrapSlider('setValue', '1200');
			jQuery("body").get(0).style.setProperty("--sqb_global_height", '1200px');
			jQuery('.global-height-px').show();
	  		jQuery('.global-height-vh').hide();
		}else{
			jQuery('.sqb_global_height_vh_input').val('100');
			jQuery('#sqb_global_height_vh').bootstrapSlider('setValue', '100');
			jQuery("body").get(0).style.setProperty("--sqb_global_height", '100vh');
			jQuery('.global-height-px').hide();
	  		jQuery('.global-height-vh').show();
		}
	});

	jQuery('body').on('change','.select-background-height_v2', function() {
	  	if(this.value == 'px'){
	  		jQuery('input[name="select_background_height_v2"]').val(200);
	  		jQuery('.background-height-px_v2').show();
	  		jQuery('.background-height-vh_v2').hide();
	  		
	  		jQuery(".select-background-height_v2 option").removeAttr('selected');
	  		jQuery(".select-background-height_v2 option[value='"+this.value+"']").attr("selected","selected");

			

			var select_temp = jQuery('input[name="select_temp"]:checked').val();
			if(select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4'){
				jQuery('.sqb_question_enable_drag_drop, .outcome-section .result_temp_outer, .optin_template_html_preview_outer .Quiz-Optin-Template, .start_temp_static_div .start_temp_outer').css('min-height', '200px');
				jQuery('.sqb_question_enable_drag_drop, .outcome-section .result_temp_outer, .optin_template_html_preview_outer .Quiz-Optin-Template, .start_temp_static_div .start_temp_outer').removeClass('vh-height-apply-v2');
			}else{
				jQuery('.question-screen, .outcome-section, .optin_template_html_preview_outer, .start_temp_static_div, .outcome-section, .optin_template_html_preview_outer').css('min-height', '200px');
				jQuery('.question-screen, .outcome-section, .optin_template_html_preview_outer, .start_temp_static_div, .outcome-section, .optin_template_html_preview_outer').removeClass('vh-height-apply-v2');
			}


	  	}else if(this.value =='vh'){

	  		jQuery('input[name="select_background_height_vh_v2"]').val(100);
	  		jQuery('.background-height-vh_v2').show();
	  		jQuery('.background-height-px_v2').hide();
	  		
	  		jQuery(".select-background-height_v2 option").removeAttr('selected');
	  		jQuery(".select-background-height_v2 option[value='"+this.value+"']").attr("selected","selected");

	  		var select_temp = jQuery('input[name="select_temp"]:checked').val();
			if(select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4'){
				jQuery('.sqb_question_enable_drag_drop, .outcome-section .result_temp_outer, .optin_template_html_preview_outer .Quiz-Optin-Template, .start_temp_static_div .start_temp_outer').css('min-height', '100vh');
				jQuery('.sqb_question_enable_drag_drop, .outcome-section .result_temp_outer, .optin_template_html_preview_outer .Quiz-Optin-Template, .start_temp_static_div .start_temp_outer').addClass('vh-height-apply-v2');
			}else{
				jQuery('.question-screen, .outcome-section, .optin_template_html_preview_outer, .start_temp_static_div, .outcome-section, .optin_template_html_preview_outer').css('min-height', '100vh');
				jQuery('.question-screen, .outcome-section, .optin_template_html_preview_outer, .start_temp_static_div, .outcome-section, .optin_template_html_preview_outer').addClass('vh-height-apply-v2');
			}
			

	  	}
	});

	jQuery('body').on('change','.template9-start-screen-select-background-height_v2', function() {
	  	if(this.value == 'px'){
	  		jQuery('input[name="template9-start-screen-select_background_height_v2"]').val(500);
	  		jQuery('.template9-start-screen-background-height-px_v2').show();
	  		jQuery('.template9-start-screen-background-height-vh_v2').hide();
	  		
	  		jQuery(".template9-start-screen-select-background-height_v2 option").removeAttr('selected');
	  		jQuery(".template9-start-screen-select-background-height_v2 option[value='"+this.value+"']").attr("selected","selected");

			jQuery('.template9_start_temp_outer').css('min-height', '200px');
			jQuery('.template9_start_temp_outer').removeClass('vh-height-apply-v2');

			jQuery("body").get(0).style.setProperty("--template9_temp_height", '500px');

			jQuery('.template9_select_background_height_v2').val(500);
			jQuery('.template9_background_height_question_v2').bootstrapSlider('setValue', 500);
			jQuery('.template9-start-screen-background_height_question_v2').bootstrapSlider('setValue', 500);

	  	}else if(this.value =='vh'){

	  		jQuery('input[name="template9-start-screen-select_background_height_vh_v2"]').val(100);
	  		jQuery('.template9-start-screen-background-height-vh_v2').show();
	  		jQuery('.template9-start-screen-background-height-px_v2').hide();
	  		
	  		jQuery(".template9-start-screen-select-background-height_v2 option").removeAttr('selected');
	  		jQuery(".template9-start-screen-select-background-height_v2 option[value='"+this.value+"']").attr("selected","selected");

			jQuery('.template9_start_temp_outer').css('min-height', '100vh');
			jQuery('.template9_start_temp_outer').addClass('vh-height-apply-v2');

			jQuery("body").get(0).style.setProperty("--template9_temp_height", '100vh');

			jQuery('input[name="template9_select_background_height_vh_v2"]').val(100);
			jQuery('.template9_background_height_vh_question_v2').bootstrapSlider('setValue', 100);
			jQuery('.template9-start-screen-background_height_vh_question_v2').bootstrapSlider('setValue', 100);

	  	}	
	});

	jQuery('#background_height_vh_outcome').bootstrapSlider().change(function() {
			var get_height = jQuery('.start_temp_outer').height();
			var total_height = get_height + 200;
			jQuery('.start_temp_static_div').css('min-height', this.value+'vh');
			//jQuery('.start_temp_static_div').css('min-height', total_height);
			jQuery('.start_temp_static_div').css('display', 'flex');
			jQuery('.start_temp_static_div').css('justify-content', 'center');
			jQuery('.start_temp_static_div').css('align-items', 'center');
			jQuery('.start_temp_static_div').css('padding','')
			jQuery('input[name=select_background_height_vh]').val(this.value);

			jQuery('#background_height_vh').bootstrapSlider('setValue', this.value);
			jQuery('#background_height_vh_question').bootstrapSlider('setValue', this.value);

			/*Outcome*/
			jQuery('.outcome-section').css('min-height', this.value+'vh');
			//jQuery('.outcome-section').css('min-height', total_height);
			jQuery('.outcome-section').css('display', 'flex');
			jQuery('.outcome-section').css('justify-content', 'center');
			jQuery('.outcome-section').css('align-items', 'center');
			jQuery('.outcome-section').css('padding','');

			jQuery('.question-screen').css('min-height', this.value+'vh');
			//jQuery('.question-screen').css('min-height', total_height);
			jQuery('.question-screen').css('display', 'flex');
			jQuery('.question-screen').css('justify-content', 'center');
			jQuery('.question-screen').css('align-items', 'center');
			jQuery('.question-screen').css('padding','');

			jQuery('.optin_template_html_preview_outer').css('min-height', this.value+'vh');
			//jQuery('.optin_template_html_preview_outer').css('min-height', total_height);
			jQuery('.optin_template_html_preview_outer').css('display', 'flex');
			jQuery('.optin_template_html_preview_outer').css('justify-content', 'center');
			jQuery('.optin_template_html_preview_outer').css('align-items', 'center');
			jQuery('.optin_template_html_preview_outer').css('padding','');
			
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
			
	});

	jQuery('#background_height_vh_question').bootstrapSlider().change(function() {
			var get_height = jQuery('.start_temp_outer').height();
			var total_height = get_height + 200;
			jQuery('.start_temp_static_div').css('min-height', this.value+'vh');
			//jQuery('.start_temp_static_div').css('min-height', total_height);
			jQuery('.start_temp_static_div').css('display', 'flex');
			jQuery('.start_temp_static_div').css('justify-content', 'center');
			jQuery('.start_temp_static_div').css('align-items', 'center');
			jQuery('input[name=select_background_height_vh]').val(this.value);

			jQuery('#background_height').bootstrapSlider('setValue', this.value);
			jQuery('#background_height_outcome').bootstrapSlider('setValue', this.value);

			/*Outcome*/
			jQuery('.outcome-section').css('min-height', this.value+'vh');
			//jQuery('.outcome-section').css('min-height', total_height);
			jQuery('.outcome-section').css('display', 'flex');
			jQuery('.outcome-section').css('justify-content', 'center');
			jQuery('.outcome-section').css('align-items', 'center');

			jQuery('.question-screen').css('min-height', this.value+'vh');
			//jQuery('.question-screen').css('min-height', total_height);
			jQuery('.question-screen').css('display', 'flex');
			jQuery('.question-screen').css('justify-content', 'center');
			jQuery('.question-screen').css('align-items', 'center');

			jQuery('.optin_template_html_preview_outer').css('min-height', this.value+'vh');
			//jQuery('.optin_template_html_preview_outer').css('min-height', total_height);
			jQuery('.optin_template_html_preview_outer').css('display', 'flex');
			jQuery('.optin_template_html_preview_outer').css('justify-content', 'center');
			jQuery('.optin_template_html_preview_outer').css('align-items', 'center');
			
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
			
	});


	jQuery('body').on('change','.select-background-height', function() {
	  	if(this.value == 'px'){
	  		jQuery('#background_height').bootstrapSlider('setValue',200);
	  		jQuery('#background_height_outcome').bootstrapSlider('setValue',200);
	  		jQuery('#background_height_question').bootstrapSlider('setValue',200);
	  		jQuery('input[name="select_background_height"]').val(200);
	  		jQuery('.background-height-px').show();
	  		jQuery('.background-height-vh').hide();
	  		jQuery('.select_background_height').val('');
	  		jQuery(".select-background-height option").removeAttr('selected');
	  		jQuery(".select-background-height option[value='"+this.value+"']").attr("selected","selected");
	  		
			jQuery('.outcome-section').css('min-height', '200px');
			jQuery('.outcome-section').css('display', 'flex');
			jQuery('.outcome-section').css('justify-content', 'center');
			jQuery('.outcome-section').css('align-items', 'center');

			
			jQuery('.question-screen').css('min-height', '200px');
			jQuery('.question-screen').css('display', 'flex');
			jQuery('.question-screen').css('justify-content', 'center');
			jQuery('.question-screen').css('align-items', 'center');

			
			jQuery('.optin_template_html_preview_outer').css('min-height', '200px');
			jQuery('.optin_template_html_preview_outer').css('display', 'flex');
			jQuery('.optin_template_html_preview_outer').css('justify-content', 'center');
			jQuery('.optin_template_html_preview_outer').css('align-items', 'center');
	  		
			jQuery('.start_temp_static_div').css('min-height', '200px');
			jQuery('.start_temp_static_div').css('display', 'flex');
			jQuery('.start_temp_static_div').css('justify-content', 'center');
			jQuery('.start_temp_static_div').css('align-items', 'center');
	  	}else if(this.value =='vh'){
	  		jQuery('#background_height_vh').bootstrapSlider('setValue',100);
	  		jQuery('#background_height_vh_outcome').bootstrapSlider('setValue',100);
	  		jQuery('#background_height_vh_question').bootstrapSlider('setValue',100);
	  		jQuery('input[name="select_background_height_vh"]').val(100);
	  		jQuery('.background-height-vh').show();
	  		jQuery('.background-height-px').hide();
	  		jQuery('.select_background_height').val('');
	  		jQuery(".select-background-height option").removeAttr('selected');
	  		jQuery(".select-background-height option[value='"+this.value+"']").attr("selected","selected");

			/*-----------------------*/

			jQuery('.start_temp_static_div').css('min-height', '100vh');
			jQuery('.start_temp_static_div').css('display', 'flex');
			jQuery('.start_temp_static_div').css('justify-content', 'center');
			jQuery('.start_temp_static_div').css('align-items', 'center');
			jQuery('input[name=select_background_height_vh]').val('100');

			/*Outcome*/
			jQuery('.outcome-section').css('min-height', '100vh');
			jQuery('.outcome-section').css('display', 'flex');
			jQuery('.outcome-section').css('justify-content', 'center');
			jQuery('.outcome-section').css('align-items', 'center');

			jQuery('.question-screen').css('min-height', '100vh');
			jQuery('.question-screen').css('display', 'flex');
			jQuery('.question-screen').css('justify-content', 'center');
			jQuery('.question-screen').css('align-items', 'center');

			jQuery('.optin_template_html_preview_outer').css('min-height', '100vh');
			jQuery('.optin_template_html_preview_outer').css('display', 'flex');
			jQuery('.optin_template_html_preview_outer').css('justify-content', 'center');
			jQuery('.optin_template_html_preview_outer').css('align-items', 'center');

	  	}
	  	var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
		jQuery('#bg_imge_style').val(bg_style);
		var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
		jQuery('#bg_imge_style_inner').val(get_inner_style);
	});


	/*Template Width*/

	jQuery('#template_background_width').bootstrapSlider().change(function() {
			start_temp_preview_obj.find('.start_temp_outer').css('max-width', +this.value);
			jQuery('input[name=select_template_background_width]').val(this.value);

			jQuery('.result_temp_outer').css('max-width', +this.value);
			jQuery('.sqb_question_enable_drag_drop').css('max-width', +this.value);
			jQuery('.optin_temp_static_div .quiz_comon_template').css('max-width', +this.value);
			
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
	});

	
	jQuery('#template_background_width_outcome').bootstrapSlider().change(function() {
			start_temp_preview_obj.find('.start_temp_outer').css('max-width', +this.value);
			jQuery('input[name=select_template_background_width]').val(this.value);

			jQuery('.result_temp_outer').css('max-width', +this.value);
			jQuery('.sqb_question_enable_drag_drop').css('max-width', +this.value);
			jQuery('.optin_temp_static_div .quiz_comon_template').css('max-width', +this.value);
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
			jQuery('#template_background_width_question').bootstrapSlider('setValue',parseFloat(+this.value));
			jQuery('#template_background_width').bootstrapSlider('setValue',parseFloat(+this.value));
	});

	jQuery('#template_background_width_question').bootstrapSlider().change(function() {
			start_temp_preview_obj.find('.start_temp_outer').css('max-width', +this.value);
			jQuery('input[name=select_template_background_width]').val(this.value);

			jQuery('.result_temp_outer').css('max-width', +this.value);
			jQuery('.sqb_question_enable_drag_drop').css('max-width', +this.value);
			jQuery('.optin_temp_static_div .quiz_comon_template').css('max-width', +this.value);
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
			jQuery('#template_background_width_question').bootstrapSlider('setValue',parseFloat(+this.value));
			jQuery('#template_background_width_outcome').bootstrapSlider('setValue',parseFloat(+this.value));
	});

	jQuery('#template9_background_width_question').bootstrapSlider().change(function() {
			
	});

	jQuery('#width_percentage_template').bootstrapSlider().change(function() {
			start_temp_preview_obj.find('.start_temp_outer').css('max-width', +this.value+'%');
			jQuery('input[name=select_template_background_width_per]').val(this.value);

			jQuery('.result_temp_outer').css('max-width', +this.value+'%');
			jQuery('.sqb_question_enable_drag_drop').css('max-width', +this.value+'%');
			jQuery('.optin_temp_static_div .quiz_comon_template').css('max-width', +this.value+'%');
			
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
	});

	jQuery('#width_percentage_template_outcome').bootstrapSlider().change(function() {
			start_temp_preview_obj.find('.start_temp_outer').css('max-width', +this.value+'%');
			jQuery('input[name=select_template_background_width_per]').val(this.value);

			jQuery('.result_temp_outer').css('max-width', +this.value+'%');
			jQuery('.sqb_question_enable_drag_drop').css('max-width', +this.value+'%');
			jQuery('.optin_temp_static_div .quiz_comon_template').css('max-width', +this.value+'%');
			
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
	});

	jQuery('#width_percentage_template_question').bootstrapSlider().change(function() {
			start_temp_preview_obj.find('.start_temp_outer').css('max-width', +this.value+'%');
			jQuery('input[name=select_template_background_width_per]').val(this.value);

			jQuery('.result_temp_outer').css('max-width', +this.value+'%');
			jQuery('.sqb_question_enable_drag_drop').css('max-width', +this.value+'%');
			jQuery('.optin_temp_static_div .quiz_comon_template').css('max-width', +this.value+'%');
			
			var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
	});

	jQuery('body').on('change','.select-template-background-width-option', function() {
	  	if(this.value == 'px'){
	  		
	  		jQuery('.background-width-in-px').show();
	  		jQuery('.background-width-in-percentage').hide();
	  		jQuery('.start_temp_outer').css('width','');
	  		jQuery('.select_template_background_width').val('');
	  		jQuery(".select-template-background-width-option option").removeAttr('selected');
	  		jQuery(".select-template-background-width-option option[value='"+this.value+"']").attr("selected","selected");

	  		jQuery('.start_temp_outer').css('max-width','640px');
	  		jQuery('.result_temp_outer').css('max-width', '640px');
			jQuery('.sqb_question_enable_drag_drop').css('max-width', '640px');
			jQuery('.optin_temp_static_div .quiz_comon_template').css('max-width', '640px');

	  		


	  	}else if(this.value =='percentage'){
	  		
	  		jQuery('.background-width-in-percentage').show();
	  		jQuery('.background-width-in-px').hide();
	  		jQuery('.start_temp_outer').css('width','');
	  		jQuery('.select_template_background_width').val('');
	  		jQuery(".select-template-background-width-option option").removeAttr('selected');
	  		jQuery(".select-template-background-width-option option[value='"+this.value+"']").attr("selected","selected");

	  		/*Outcome*/
	  		jQuery('.start_temp_outer').css('width','100%');
			jQuery('.result_temp_outer').css('max-width', '100%');
			jQuery('.sqb_question_enable_drag_drop').css('max-width', '100%');
			jQuery('.optin_temp_static_div .quiz_comon_template').css('max-width', '100%');

	  	}
	  	var bg_style = jQuery('.optin_template_html_preview_outer').attr('style');
		jQuery('#bg_imge_style').val(bg_style);
		var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
		jQuery('#bg_imge_style_inner').val(get_inner_style);
	});

	/*Opacity*/

	jQuery('#background_opacity').bootstrapSlider().change(function() {
		var color = jQuery('#start_temp_backgroud_color_bw_customizer').val();
		var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
		    + ',' + parseInt(color.slice(-4,-2),16)
		    + ',' + parseInt(color.slice(-2),16)
		    +','+this.value +')';


	    jQuery('#background_opacity_question').bootstrapSlider('setValue',parseFloat(+this.value));
		jQuery('#background_opacity_outcome').bootstrapSlider('setValue',parseFloat(+this.value));

		if(jQuery('input[name="select_temp"]:checked').val() == 'template6'){   
		start_temp_preview_obj.find('.start_temp_outer').css('background-color', rgbaCol);
		jQuery('.result_temp_outer').css('background-color', rgbaCol);
		var start_screen_style= jQuery('.start_temp_outer').attr('style');
		jQuery('#bg_imge_style_inner').val(start_screen_style);
		jQuery('.sqb_question_enable_drag_drop').css('background-color', rgbaCol);
		jQuery('.optin_temp_static_div .quiz_comon_template').css('background-color', rgbaCol);
		} else {
		var sqb_bg_img = jQuery('#start_temp_static_div_id').css('background-image');
		if (sqb_bg_img != 'none'){
			var sqb_bg_img = sqb_bg_img.split(/[, ]+/).pop();
			var sqb_linear_gradient = 'linear-gradient('+rgbaCol+','+ rgbaCol+'),'+sqb_bg_img;
			jQuery('#start_temp_static_div_id').css('background-image', sqb_linear_gradient);
			jQuery('#Result-Screen-Settings .outcome-section').css('background-image', sqb_linear_gradient);
			jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-image', sqb_linear_gradient);
			jQuery('.optin_template_html_preview_outer').css('background-image', sqb_linear_gradient);
			
			jQuery('#start_temp_static_div_id').css('background-color', rgbaCol);
			jQuery('#Result-Screen-Settings .outcome-section').css('background-color', rgbaCol);
			jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-color', rgbaCol);
			jQuery('.optin_template_html_preview_outer').css('background-color', rgbaCol);
		} else {
			jQuery('#start_temp_static_div_id').css('background-color', rgbaCol);
			jQuery('#Result-Screen-Settings .outcome-section').css('background-color', rgbaCol);
			jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-color', rgbaCol);
			jQuery('.optin_template_html_preview_outer').css('background-color', rgbaCol);
		}
	 }
	 
	});

	jQuery('#background_opacity_outcome').bootstrapSlider().change(function() {
		if (jQuery(".outcome-screen-background-customizer").is(":visible") == true){
			var color = jQuery('.outcome-screen-background-customizer').find('#start_temp_backgroud_color_outcome').val();
		}else{
			var color = jQuery('#start_temp_backgroud_color').val();
		}
		var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
		    + ',' + parseInt(color.slice(-4,-2),16)
		    + ',' + parseInt(color.slice(-2),16)
		    +','+this.value +')';

	    jQuery('#background_opacity').bootstrapSlider('setValue',parseFloat(+this.value));
		jQuery('#background_opacity_question').bootstrapSlider('setValue',parseFloat(+this.value));

		if(jQuery('input[name="select_temp"]:checked').val() == 'template6'){
				start_temp_preview_obj.find('.start_temp_outer').css('background-color', rgbaCol);
				jQuery('.result_temp_outer').css('background-color', rgbaCol);
				jQuery('.sqb_question_enable_drag_drop').css('background-color', rgbaCol);
				jQuery('.optin_temp_static_div .quiz_comon_template').css('background-color', rgbaCol);

				var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
				jQuery('#bg_imge_style_inner').val(get_inner_style);
			} else {
				var sqb_bg_img = jQuery('#start_temp_static_div_id').css('background-image');
				if (sqb_bg_img != 'none'){
					var sqb_bg_img = sqb_bg_img.split(/[, ]+/).pop();
					var sqb_linear_gradient = 'linear-gradient('+rgbaCol+','+ rgbaCol+'),'+sqb_bg_img;
					jQuery('#start_temp_static_div_id').css('background-image', sqb_linear_gradient);
					jQuery('#Result-Screen-Settings .outcome-section').css('background-image', sqb_linear_gradient);
					jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-image', sqb_linear_gradient);
					jQuery('.optin_template_html_preview_outer').css('background-image', sqb_linear_gradient);
					
					jQuery('#start_temp_static_div_id').css('background-color', rgbaCol);
					jQuery('#Result-Screen-Settings .outcome-section').css('background-color', rgbaCol);
					jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-color', rgbaCol);
					jQuery('.optin_template_html_preview_outer').css('background-color', rgbaCol);
				} else {
					jQuery('#start_temp_static_div_id').css('background-color', rgbaCol);
					jQuery('#Result-Screen-Settings .outcome-section').css('background-color', rgbaCol);
					jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-color', rgbaCol);
					jQuery('.optin_template_html_preview_outer').css('background-color', rgbaCol);
				}
		}
	});

	jQuery('#background_opacity_question').bootstrapSlider().change(function() {
		if (jQuery(".outcome-screen-background-customizer").is(":visible") == true){
			var color = jQuery('.outcome-screen-background-customizer').find('#start_temp_backgroud_color_outcome').val();
		}else{
			var color = jQuery('#start_temp_backgroud_color').val();
		}
		var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
		    + ',' + parseInt(color.slice(-4,-2),16)
		    + ',' + parseInt(color.slice(-2),16)
		    +','+this.value +')';

	    jQuery('#background_opacity').bootstrapSlider('setValue',parseFloat(+this.value));
		jQuery('#background_opacity_outcome').bootstrapSlider('setValue',parseFloat(+this.value));

		if(jQuery('input[name="select_temp"]:checked').val() == 'template6'){
				start_temp_preview_obj.find('.start_temp_outer').css('background-color', rgbaCol);
				jQuery('.result_temp_outer').css('background-color', rgbaCol);
				jQuery('.sqb_question_enable_drag_drop').css('background-color', rgbaCol);
				jQuery('.optin_temp_static_div .quiz_comon_template').css('background-color', rgbaCol);

				var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
				jQuery('#bg_imge_style_inner').val(get_inner_style);
			} else {
				var sqb_bg_img = jQuery('#start_temp_static_div_id').css('background-image');
				if (sqb_bg_img != 'none'){
					var sqb_bg_img = sqb_bg_img.split(/[, ]+/).pop();
					var sqb_linear_gradient = 'linear-gradient('+rgbaCol+','+ rgbaCol+'),'+sqb_bg_img;
					jQuery('#start_temp_static_div_id').css('background-image', sqb_linear_gradient);
					jQuery('#Result-Screen-Settings .outcome-section').css('background-image', sqb_linear_gradient);
					jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-image', sqb_linear_gradient);
					jQuery('.optin_template_html_preview_outer').css('background-image', sqb_linear_gradient);
					
					jQuery('#start_temp_static_div_id').css('background-color', rgbaCol);
					jQuery('#Result-Screen-Settings .outcome-section').css('background-color', rgbaCol);
					jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-color', rgbaCol);
					jQuery('.optin_template_html_preview_outer').css('background-color', rgbaCol);
				} else {
					jQuery('#start_temp_static_div_id').css('background-color', rgbaCol);
					jQuery('#Result-Screen-Settings .outcome-section').css('background-color', rgbaCol);
					jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.question-screen').css('background-color', rgbaCol);
					jQuery('.optin_template_html_preview_outer').css('background-color', rgbaCol);
				}
		}
	});
	

	

	

	jQuery('#start_temp_top_frame_backgroud_color,#start_temp_top_frame_backgroud_color_div').colorpicker().on('changeColor', function() {
				jQuery('body').css('--top_bar_background_color',jQuery(this).colorpicker('getValue'));
				start_temp_preview_obj.find('.outer-style2 .Quiz-Template-title').css('background-color', jQuery(this).colorpicker('getValue'));
				start_temp_preview_obj.find('.outer-style3').css('border-top-color', jQuery(this).colorpicker('getValue'));
				start_temp_preview_obj.find('.outer-style3 .outer_style3_span_second').css('border-color', jQuery(this).colorpicker('getValue')+' transparent transparent');
				start_temp_preview_obj.find('.outer-style3 .outer_style3_span_first').css('border-color', jQuery(this).colorpicker('getValue')+' transparent transparent');
	});
	
	jQuery('#outcome_temp_top_frame_backgroud_color,#outcome_temp_top_frame_backgroud_color_div').colorpicker().on('changeColor', function() {
				jQuery('body').css('--top_bar_background_color',jQuery(this).colorpicker('getValue'));
				jQuery('.res_data_cont .outer-style2 .points_scored_result').css('background-color', jQuery(this).colorpicker('getValue'));
				jQuery('.res_data_cont .outer-style3').css('border-top-color', jQuery(this).colorpicker('getValue'));
				jQuery('.res_data_cont .outer-style3 .outer_style3_span_second').css('border-color', jQuery(this).colorpicker('getValue')+' transparent transparent');
				jQuery('.res_data_cont .outer-style3 .outer_style3_span_first').css('border-color', jQuery(this).colorpicker('getValue')+' transparent transparent');
	});
	
	jQuery('#optin_temp_top_frame_backgroud_color,#optin_temp_top_frame_backgroud_color_div').colorpicker().on('changeColor', function() {
				jQuery('body').css('--top_bar_background_color',jQuery(this).colorpicker('getValue'));
				jQuery('.optin_template_html_preview_outer .outer-style2 .Quiz-Template-title').css('background-color', jQuery(this).colorpicker('getValue'));
				jQuery('.optin_template_html_preview_outer .outer-style3').css('border-top-color', jQuery(this).colorpicker('getValue'));
				jQuery('.optin_template_html_preview_outer .outer-style3 .outer_style3_span_second').css('border-color', jQuery(this).colorpicker('getValue')+' transparent transparent');
				jQuery('.optin_template_html_preview_outer .outer-style3 .outer_style3_span_first').css('border-color', jQuery(this).colorpicker('getValue')+' transparent transparent');
	});


	jQuery('#start_temp_br_clr,#start_temp_br_clr_div').colorpicker().on('changeColor', function() {
		if(jQuery('#sqb_template_selected').val() == 'template7'){
			jQuery('#start_temp_static_div_id').css('border-color', jQuery(this).colorpicker('getValue'));
		} else {
			start_temp_preview_obj.find('.start_temp_outer').css('border-color', jQuery(this).colorpicker('getValue'));
		}
	});
	 
	// shadow customizer
	jQuery('#start_temp_blur_radius').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow('start_temp',start_temp_preview_obj);
	});
	
	jQuery('#start_temp_hor_lnth').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow('start_temp',start_temp_preview_obj);
	});
	
	jQuery('#start_temp_ver_lnth').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow( 'start_temp',start_temp_preview_obj);
	});
	jQuery('#start_temp_spread_radius').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow('start_temp',start_temp_preview_obj);
	});
	
	jQuery('#start_temp_shad_clr,#start_temp_shad_clr_div').colorpicker().on('changeColor', function() {
		   sqb_templates_BoxShadow( 'start_temp',start_temp_preview_obj);
	});
	
	jQuery('#start_temp_left_sction_clr,#start_temp_left_sction_clr_div').colorpicker().on('changeColor', function() {
				start_temp_preview_obj.find('.start_temp_outer .Quiz-start-Template5-left').css('background-color', jQuery(this).colorpicker('getValue'));
	});
	jQuery('#start_temp_right_sction_clr,#start_temp_right_sction_clr_div').colorpicker().on('changeColor', function() {
				start_temp_preview_obj.find('.start_temp_outer .Quiz-start-Template5-right').css('background-color', jQuery(this).colorpicker('getValue'));
	});
	
	jQuery('#start_temp_height').bootstrapSlider().change(function() {
		start_temp_preview_obj.find('.Quiz-start-Template5-inner').css('min-height', +this.value + 'px');		
	});
	
	jQuery('#start_screen_background_image_size').bootstrapSlider().change(function() {
		//start_temp_preview_obj.find('.Quiz-start-Template5-left').css('background-size', + this.value + '%' + this.value + '%');		
		start_temp_preview_obj.find('.Quiz-start-Template5-left').css('background-size', + this.value + 'px');			
	});
	
	jQuery('#start_screen_title_bg_clr,#start_screen_title_bg_clr_div').colorpicker().on('changeColor', function() {
		start_temp_preview_obj.find('.sqb_start_screen_background_image .Quiz-Template5-title').css('background-color', jQuery(this).colorpicker('getValue'));
	});
	
	jQuery('#start_screen_bg_image_opacity_clr,#start_screen_bg_image_opacity_clr_divs').colorpicker().on('changeColor', function() {
		var sqb_bg_img = jQuery('.start_template_html_preview_outer').find('.Quiz-start-Template5-left').css('background-image');
		if (sqb_bg_img != 'none' && sqb_bg_img.search("linear-gradient") != -1){
			var sqb_bg_img = sqb_bg_img.split(/[, ]+/).pop();
			var sqb_linear_gradient = 'linear-gradient('+jQuery(this).colorpicker('getValue')+','+ jQuery(this).colorpicker('getValue')+'),'+sqb_bg_img;
			start_temp_preview_obj.find('.Quiz-start-Template5-left').css('background-image', sqb_linear_gradient);
		}
	});
	
	// question template customizer
	
	var question_temp_preview_obj = jQuery('.sqb_questions_wrapper'); 
	var question_add_answer_outer_div = jQuery('.outer-style8').find('.question_add_answer_outer_div').css('max-width');
	question_add_answer_outer_div = parseInt(question_add_answer_outer_div);

	jQuery("#question_temp_inner_width").bootstrapSlider('setValue', question_add_answer_outer_div);
	jQuery('.question_temp_inner_width_val').val(question_add_answer_outer_div);

	jQuery('#question_temp_inner_width').bootstrapSlider().change(function() {
		var template_no = jQuery('input[name="select_temp"]:checked').val();
		if(template_no == 'template8'){
			question_temp_preview_obj.find('.sqb_question_no').find('.Quiz-Template').find('.question_details').css('max-width', +this.value + 'px');
			question_temp_preview_obj.find('.sqb_question_no').find('.Quiz-Template').find('.question_add_answer_outer_div').css('max-width', +this.value + 'px');
			question_temp_preview_obj.find('.sqb_question_no').find('.Quiz-Template').find('.question_rating_lable_div').css('max-width', +this.value + 'px');
			jQuery('.question_temp_inner_width_val').val(this.value);
		}
	});

	jQuery('.question_temp_inner_width_val').on('keyup', function(){
		var template_no = jQuery('input[name="select_temp"]:checked').val();
		if(template_no == 'template8'){
			question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template').find('.question_details').css('max-width', +this.value + 'px');
			question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template').find('.question_add_answer_outer_div').css('max-width', +this.value + 'px');
			question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template').find('.question_rating_lable_div').css('max-width', +this.value + 'px');
			jQuery('#question_temp_inner_width').bootstrapSlider('setValue', this.value);
		}
	});
	   
	jQuery('#question_temp_width').bootstrapSlider().change(function() {
		var template_no = jQuery('input[name="select_temp"]:checked').val();
		jQuery('.question_temp_width_input').val(this.value);
		if( template_no == 'template4'){
			if(jQuery('#question_width_apply_to_all').prop('checked') == true){
				question_temp_preview_obj.find('.sqb_question_no').find('.outer-style3').css('max-width', +this.value + 'px');
			}else{
				question_temp_preview_obj.find('.sqb_question_no:visible').find('.outer-style3').css('max-width', +this.value + 'px');
			}
		}else if(template_no == 'template5'){
			question_temp_preview_obj.find('.sqb_question_no').find('.Quiz-Template').css('max-width', +this.value + 'px');
		}else{

			if(jQuery('#question_width_apply_to_all').prop('checked') == true){
				question_temp_preview_obj.find('.sqb_question_no').find('.Quiz-Template').css('max-width', +this.value + 'px');
			 }else{
				question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template').css('max-width', +this.value + 'px');
			 }
			
		}
	});

	jQuery('#question_temp_br_wid').bootstrapSlider().change(function() {
		var template_no = jQuery('input[name="select_temp"]:checked').val();
		if( template_no == 'template4'){
			question_temp_preview_obj.find('.outer-style3 .Quiz-Template').css('border-width', +this.value + 'px');
		}else{
			question_temp_preview_obj.find('.Quiz-Template').css('border-width', +this.value + 'px');
		}
	});
		
	jQuery('#question_temp_alignment').on('change',function() {
		var template_no = jQuery('input[name="select_temp"]:checked').val();
		if( template_no == 'template4'){
			question_temp_preview_obj.find('.outer-style3').css('text-align', this.value);
		}else{
				question_temp_preview_obj.find('.Quiz-Template').css('text-align', this.value);
		}
	});

	jQuery('#template9-layout-option').on('change',function() {
		if(this.value == 'image_left'){
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-template-bg-image-left');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-template-bg-image-right');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-template-bg-full-width');
		}else if(this.value == 'image_right'){
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-template-bg-image-right');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-template-bg-image-left');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-template-bg-full-width');
		}else if(this.value == 'full_width'){
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-template-bg-image-left');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-template-bg-image-right');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-template-bg-full-width');

		}
	});

	jQuery('#template9_question_temp_inner_section_width_px').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'px';
		question_temp_preview_obj.find('.Quiz-Template9-right-side').css('max-width', get_val);
		// jQuery("body").get(0).style.setProperty("--template9-inner-section-width", get_val);
	});

	jQuery('#template9_question_temp_inner_section_width_percent').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'%';
		question_temp_preview_obj.find('.Quiz-Template9-right-side').css('max-width', get_val);
		// jQuery("body").get(0).style.setProperty("--template9-inner-section-width", get_val);
	});

	jQuery('#template9-inner-section-alignment-option').on('change',function() {
		if(this.value == 'left'){
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('template9-inner-left');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('template9-inner-right');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('template9-inner-center');
		}else if(this.value == 'right'){
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('template9-inner-right');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('template9-inner-center');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('template9-inner-left');
		}else{
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('template9-inner-center');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('template9-inner-right');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('template9-inner-left');
		}
	});

	jQuery('.select-template9-inner-width').on('change', function(){
		if(this.value == 'percent'){
			jQuery('.template9-inner-width-percent').show();
			jQuery('.template9-inner-width-px').hide();
		}else{
			jQuery('.template9-inner-width-percent').hide();
			jQuery('.template9-inner-width-px').show();
		}
	});

	jQuery('#question_temp_br_style').on('change',function() {
		var template_no = jQuery('input[name="select_temp"]:checked').val();
		if( template_no == 'template4'){
			question_temp_preview_obj.find('.outer-style3 .Quiz-Template').css('border-style', this.value);
		}else{
				question_temp_preview_obj.find('.Quiz-Template').css('border-style', this.value);
		}	
	});   

	jQuery('#question_temp_backgroud_color,#question_temp_backgroud_color_div').colorpicker().on('changeColor', function() {
		var template_no = jQuery('input[name="select_temp"]:checked').val();
		if( template_no == 'template4'){
			question_temp_preview_obj.find('.outer-style3 .Quiz-Template').css('background-color', jQuery(this).colorpicker('getValue'));
		}else{
			question_temp_preview_obj.find('.Quiz-Template').css('background-color', jQuery(this).colorpicker('getValue'));
		}
	});

	jQuery('#template9-layout-background-color,#template9-layout-background-color_div').colorpicker().on('changeColor', function() {
		var template_no = jQuery('input[name="select_temp"]:checked').val();
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').css('background-color', jQuery(this).colorpicker('getValue'));

			jQuery("body").get(0).style.setProperty("--template9_question_temp_background_color", jQuery(this).colorpicker('getValue'));
		
	});

	jQuery(document).on('click','.sqb_remove_question_screen_bg_image_template9',function() {
		question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side').css('background-image', '');
		question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('question_screen_has_image');
		question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-no-img-found');
	});

	jQuery(document).on('click','.sqb_remove_question_screen_splash_image_template9',function() {
		question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side .splash_image').val('');
		var question_screen_video = jQuery('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side').find('input[name="video_id"]').val();
		var video_dropdown = jQuery('.template9-video-dropdown').val();
		template9_video_option('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side', video_dropdown, question_screen_video,'');
	});


	jQuery(document).on('click','#template9_video_controls_question',function() {
		if(jQuery(this).prop('checked') == true){
			question_temp_preview_obj.find('.sqb_question_no.active .video_controls').val('Y');
		}else{
			question_temp_preview_obj.find('.sqb_question_no.active .video_controls').val('N');
		}
	});

	jQuery('#template9-play-button-background-color,#template9-play-button-background-color_div').colorpicker().on('changeColor', function() {
		jQuery('.Quiz-Template9-left-side .video_play_btn_color').val(jQuery(this).colorpicker('getValue'));
		jQuery("body").get(0).style.setProperty("--template9_question_screen_play_btn_color", jQuery(this).colorpicker('getValue'));

	});

jQuery(document).on('click','input[name="template9_question_screen_layout_option"]',function() {
	if(jQuery(this).val() == 'split_screen'){
		jQuery('input[name="question_screen_split_value"]').val('sqb-template-bg-video-left');
		jQuery('.template9_split_screen_options').show('slow');
		question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-template-bg-full-width');
		jQuery('.video-settings-show-hide').show('slow');

		if(question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side .video-js').length == 0){
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-no-video-found');
		}
		jQuery('.template9-upload-option').show('slow');

		var question_screen_split_value = jQuery('input[name="question_screen_split_value"]').val();
		if(question_screen_split_value){
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass(question_screen_split_value);
		}

		if(question_screen_split_value == 'sqb-template-bg-video-left' || question_screen_split_value == 'sqb-template-bg-video-right'){
			var question_screen_video = jQuery('input[name="question_screen_video_hidden"]').val();
			if(question_screen_video){
				var splash_image = jQuery('input[name="question_screen_splash_image_hidden"]').val();
				if(splash_image){
					setTimeout(function(){
						template9_video_option('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side', video_source, question_screen_video,template9_start_temp_outer);
					},500);				
				}else{
					setTimeout(function(){
						template9_video_option('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side', video_source, question_screen_video);
					},500);
				}
			}

			var question_video_source= jQuery('input[name="question_screen_video_source_hidden"]').val();
		  	if(question_video_source == 'link'){
		  		jQuery(".template9-video-dropdown").val("link").change();
		  	}else{
		  		jQuery(".template9-video-dropdown").val("upload").change();
		  	}


			if(question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side .video-js').length == 0){
				question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-no-video-found');
			}

			jQuery('.video-settings-show-hide').show();
			jQuery('.image-option-show-hide').hide();
		}else{
			jQuery('.video-settings-show-hide').hide();
			jQuery('.image-option-show-hide').show();
			if(question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side').css('background-image') == 'none'){
				question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-no-img-found');
				question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-no-video-found');
			}
		}

	}else{
		jQuery('.template9_split_screen_options').hide('slow');

		question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side').html('');
		question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-template-bg-full-width');

		question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-template-bg-video-right sqb-template-bg-video-left sqb-template-bg-image-right sqb-template-bg-image-left');
		jQuery('.video-settings-show-hide').hide('slow');

		question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-no-video-found');
		question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-no-img-found');
	}
});

	jQuery(document).on('click','input[name="template9_question_screen_split_option"]',function() {
		question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-template-bg-full-width');
		if(jQuery(this).val() == 'video_left'){ 
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-template-bg-video-left');
			jQuery('input[name="question_screen_split_value"]').val('sqb-template-bg-video-left');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-template-bg-image-left sqb-template-bg-image-right sqb-template-bg-video-right');
			jQuery('.video-settings-show-hide').show('slow');

			if(question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template9-left-side .video-js').length == 0){
				question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-no-video-found');
			}
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-no-img-found');
			jQuery('.template9-upload-option').show('slow');
			jQuery('.template9-link-option').hide('slow');
			jQuery('.template9_question_screen_image_option').hide();
			var question_screen_video = jQuery('input[name="question_screen_video_hidden"]').val();
			var video_dropdown = jQuery('.template9-video-dropdown').val();
			if(question_screen_video){
				template9_video_option('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side', video_dropdown, question_screen_video);
			}
		}else if(jQuery(this).val() == 'video_right'){
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-template-bg-video-right');
			jQuery('input[name="question_screen_split_value"]').val('sqb-template-bg-video-right');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-template-bg-image-left sqb-template-bg-image-right sqb-template-bg-video-left');
			jQuery('.video-settings-show-hide').show('slow');

			if(question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template9-left-side .video-js').length == 0){
				question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-no-video-found');
			}
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-no-img-found');
			jQuery('.template9-upload-option').show('slow');
			jQuery('.template9-link-option').hide('slow');
			jQuery('.template9_question_screen_image_option').hide();
			var question_screen_video = jQuery('input[name="question_screen_video_hidden"]').val();
			var video_dropdown = jQuery('.template9-video-dropdown').val();
			if(question_screen_video){
				template9_video_option('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side', video_dropdown, question_screen_video);
			}
		}else if(jQuery(this).val() == 'image_left'){
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-template-bg-image-left');
			jQuery('input[name="question_screen_split_value"]').val('sqb-template-bg-image-left');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-template-bg-video-left sqb-template-bg-video-right sqb-template-bg-image-right');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side').html('');
			jQuery('.video-settings-show-hide').hide('slow');

			if(question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template9-left-side').css('background-image') == 'none'){
				question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-no-img-found');
			}
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-no-video-found');
			jQuery('.template9_question_screen_image_option').show();
		}else if(jQuery(this).val() == 'image_right'){
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-template-bg-image-right');
			jQuery('input[name="question_screen_split_value"]').val('sqb-template-bg-image-right');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-template-bg-video-left sqb-template-bg-video-right sqb-template-bg-image-left');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side').html('');
			jQuery('.video-settings-show-hide').hide('slow');

			if(question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template9-left-side').css('background-image') == 'none'){
				question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('sqb-no-img-found');
			}
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-no-video-found');
			jQuery('.template9_question_screen_image_option').show();
		}
	});


	jQuery(document).on('click','.sqb_change_question_screen_bg_image_template9',function() {
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
			
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side').css('background-image', 'url('+attachment.url+')');

			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').addClass('question_screen_has_image');
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner').removeClass('sqb-no-video-found, sqb-no-img-found');
		});
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','.sqb_change_question_screen_splash_image_template9',function() {
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
			question_temp_preview_obj.find('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side .splash_image').val(attachment.url);
			var question_screen_video = jQuery('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side').find('input[name="video_id"]').val();
			var dropdown_val = jQuery('.template9-video-dropdown').val();
			template9_video_option('.sqb_question_no.active .Quiz-Template9-inner .Quiz-Template9-left-side', dropdown_val, question_screen_video, attachment.url);
			jQuery('input[name="question_screen_splash_image_hidden"]').val(attachment.url);
		});
		sqb_mediauploader.open();
	});


	jQuery('#temp_one_to_four_answer_backgroud_color,#temp_one_to_four_answer_backgroud_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
		jQuery('.question_add_answer_outer_div .sqb_ans_item').css('background', jQuery(this).colorpicker('getValue'));
	});

	jQuery('#temp_one_to_four_answer_hover_backgroud_color,#temp_one_to_four_answer_hover_backgroud_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
		
	});

	jQuery('#temp_one_to_four_answer_text_color,#temp_one_to_four_answer_text_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
		
	});

	jQuery('#matrix_background_color,#matrix_background_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
		jQuery('.sqb-answer-matrix-table-scroll').css('background', jQuery(this).colorpicker('getValue'))	
	});
	
	jQuery('#radio_button_color,#radio_button_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
		
	});

	jQuery('#radio_button_border_color,#radio_button_border_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
		
	});
     
     
    jQuery('#question_temp_top_backgroud_color,#question_temp_top_backgroud_color_div').colorpicker().on('changeColor', function() {
				  
				var template_no = jQuery('input[name="select_temp"]:checked').val();
				
				if(template_no == 'template3'){
					jQuery('body').css('--top_bar_background_color',jQuery(this).colorpicker('getValue'));
					//question_temp_preview_obj.find('.sqb_question_enable_drag_drop.outer-style2').css('border-color', jQuery(this).colorpicker('getValue'));
					jQuery('.question_div_inner .sqb_question_enable_drag_drop.outer-style2 .Quiz-Template-title').css('background-color', jQuery(this).colorpicker('getValue'));
					jQuery('.question_div_inner .sqb_question_enable_drag_drop.outer-style2 .Quiz-Template-title').css('border-color', jQuery(this).colorpicker('getValue'));
					//question_temp_preview_obj.find('.question_div_inner .sqb_question_enable_drag_drop.outer-style2').css('border-color', jQuery(this).colorpicker('getValue'));
				}else if(template_no == 'template4'){
					jQuery('body').css('--top_bar_background_color',jQuery(this).colorpicker('getValue'));
					jQuery('.question_div_inner .outer-style3').css('border-top-color', jQuery(this).colorpicker('getValue'));
					jQuery('.question_div_inner .outer_style3_span_first').css('border-color', jQuery(this).colorpicker('getValue') +' transparent transparent');
					jQuery('.question_div_inner .outer_style3_span_second').css('border-color', jQuery(this).colorpicker('getValue') +' transparent transparent');
				}
	}); 
     
    jQuery('#answer_temp_br_clr,#answer_temp_br_clr_div').colorpicker();
    jQuery('#answer_temp_shadow_clr,#answer_temp_shadow_clr_div').colorpicker();
    
    jQuery('#continue_button_clr,#continue_button_clr_div').colorpicker();
    jQuery('#skip_button_clr,#skip_button_clr_div').colorpicker();
	
	jQuery('#question_temp_br_clr,#question_temp_br_clr_div').colorpicker().on('changeColor', function() {
		var template_no = jQuery('input[name="select_temp"]:checked').val();
		if( template_no == 'template4'){
			question_temp_preview_obj.find('.outer-style3 .Quiz-Template').css('border-color', jQuery(this).colorpicker('getValue'));
		}else if(template_no == 'template8'){
		}else{	
			question_temp_preview_obj.find('.Quiz-Template').css('border-color', jQuery(this).colorpicker('getValue'));
		}
	});
	// shadow customizer
	jQuery('#question_temp_blur_radius').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow('question_temp',question_temp_preview_obj);
	});
	
	jQuery('#question_temp_hor_lnth').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow('question_temp',question_temp_preview_obj);
	});
	
	jQuery('#question_temp_ver_lnth').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow( 'question_temp',question_temp_preview_obj);
	});
	jQuery('#question_temp_spread_radius').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow('question_temp',question_temp_preview_obj);
	});

	
	jQuery('#question_temp_shad_clr,#question_temp_shad_clr_div').colorpicker().on('changeColor', function() {
		   sqb_templates_BoxShadow( 'question_temp',question_temp_preview_obj);
	});
	
	
	jQuery('#question_temp_left_sction_clr,#question_temp_left_sction_clr_div').colorpicker().on('changeColor', function() {
				question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-color', jQuery(this).colorpicker('getValue'));
	});
	
	jQuery('#question_temp_right_sction_clr,#question_temp_right_sction_clr_div').colorpicker().on('changeColor', function() {
				question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template5-right-side ').css('background-color', jQuery(this).colorpicker('getValue'));
	});
	
	jQuery('#question_next_button_clr,#question_next_button_clr_div').colorpicker().on('changeColor', function() {
				question_temp_preview_obj.find('.sqb_question_no.active').find('.sqb_quiz_template5.sqb_next_btn').css('background-color',jQuery(this).colorpicker('getValue'));
	});
	
	jQuery('#question_progress_bar_clr,#question_progress_bar_clr_div').colorpicker().on('changeColor', function() {
				question_temp_preview_obj.find('.sqb_question_no.active').find('input[name="progress_bar_color"]').val(jQuery(this).colorpicker('getValue'));
	});
	
	jQuery('#question_temp_height').bootstrapSlider().change(function() {
			question_temp_preview_obj.find('.Quiz-Template5-inner').css('min-height', +this.value + 'px');
	});
	
	jQuery('#question_screen_background_image_size').bootstrapSlider().change(function() {
			question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-size', + this.value + 'px');		
	});
	
	jQuery('#question_screen_title_bg_clr,#question_screen_title_bg_clr_div').colorpicker().on('changeColor', function() {
			question_temp_preview_obj.find('.sqb_question_no.active').find('.sqb_start_screen_background_image .question_details').css('background-color', jQuery(this).colorpicker('getValue'));
	});
	
	jQuery('#question_screen_bg_image_opacity_clr,#question_screen_bg_image_opacity_clr_div').colorpicker().on('changeColor', function() {
		var sqb_bg_img = question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-image');
		if (sqb_bg_img != 'none' && sqb_bg_img.search("linear-gradient") != -1){
			var sqb_bg_img = sqb_bg_img.split(/[, ]+/).pop();
			var sqb_linear_gradient = 'linear-gradient('+jQuery(this).colorpicker('getValue')+','+ jQuery(this).colorpicker('getValue')+'),'+sqb_bg_img;
			question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-image', sqb_linear_gradient);
		}
	});
	
	// opt in template customizer
	var optin_temp_preview_obj = jQuery('.optin_template_html_preview_outer');
	jQuery('#opt_in_temp_width').bootstrapSlider().change(function() {
		jQuery('.opt_in_temp_width_input').val(this.value);
			optin_temp_preview_obj.find('.Quiz-Optin-Template').css('max-width', +this.value + 'px');
	});

	/*jQuery('.opt_in_temp_padding').bootstrapSlider().change(function() {
		jQuery('.opt_in_temp_padding_input').val(this.value);
		jQuery("body").get(0).style.setProperty("--first-template-padding-left-right", +this.value + 'px');
	});*/

	jQuery('.opt_in_temp_inner_width_optin').bootstrapSlider().change(function() {
		jQuery('.opt_in_temp_inner_width_optin_input').val(this.value);
		jQuery("body").get(0).style.setProperty("--first-template-inner-width", +this.value + 'px');
	});

	jQuery('#opt_in_temp_br_wid').bootstrapSlider().change(function() {
			optin_temp_preview_obj.find('.Quiz-Optin-Template').css('border-width', +this.value + 'px');
	});
		
	jQuery('#opt_in_temp_alignment').on('change',function() {
				optin_temp_preview_obj.find('.Quiz-Optin-Template').css('text-align', this.value);
	});

	jQuery('#opt_in_temp_br_style').on('change',function() {
				optin_temp_preview_obj.find('.Quiz-Optin-Template').css('border-style', this.value);
	});   

	jQuery('#opt_in_temp_backgroud_color,#opt_in_temp_backgroud_color_div').colorpicker().on('changeColor', function() {
				optin_temp_preview_obj.find('.Quiz-Optin-Template').css('background-color', jQuery(this).colorpicker('getValue'));
	});


	jQuery('#opt_in_temp_br_clr,#opt_in_temp_br_clr_div').colorpicker().on('changeColor', function() {
				optin_temp_preview_obj.find('.Quiz-Optin-Template').css('border-color', jQuery(this).colorpicker('getValue'));
	});
	// shadow customizer
	jQuery('#opt_in_temp_blur_radius').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow('opt_in_temp',optin_temp_preview_obj);
	});
	
	jQuery('#opt_in_temp_hor_lnth').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow('opt_in_temp',optin_temp_preview_obj);
	});
	
	jQuery('#opt_in_temp_ver_lnth').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow( 'opt_in_temp',optin_temp_preview_obj);
	});
	jQuery('#opt_in_temp_spread_radius').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow('opt_in_temp',optin_temp_preview_obj);
	});

	
	jQuery('#opt_in_temp_shad_clr,#opt_in_temp_shad_clr_div').colorpicker().on('changeColor', function() {
	   sqb_templates_BoxShadow( 'opt_in_temp',optin_temp_preview_obj);
	});
	
	
	
	// result template customizer
	var result_temp_preview_obj = jQuery('.result_template_html_preview_outer');
	jQuery('#result_temp_width').bootstrapSlider().change(function() {
			jQuery('.result_temp_width_input').val(this.value);
			result_temp_preview_obj.find('.result_temp_outer').css('max-width', +this.value + 'px');
	});

	jQuery('#result_temp_br_wid').bootstrapSlider().change(function() {
			result_temp_preview_obj.find('.result_temp_outer').css('border-width', +this.value + 'px');
	});
		
	jQuery('#result_temp_alignment').on('change',function() {
				result_temp_preview_obj.find('.result_temp_outer').css('text-align', this.value);
	});

	jQuery('#result_temp_br_style').on('change',function() {
				result_temp_preview_obj.find('.result_temp_outer').css('border-style', this.value);
	});   

	jQuery('#result_temp_backgroud_color,#result_temp_backgroud_color_div').colorpicker().on('changeColor', function() {
				result_temp_preview_obj.find('.result_temp_outer').css('background-color', jQuery(this).colorpicker('getValue'));
	});


	jQuery('#result_temp_br_clr,#result_temp_br_clr_div').colorpicker().on('changeColor', function() {
				result_temp_preview_obj.find('.result_temp_outer').css('border-color', jQuery(this).colorpicker('getValue'));
	});
	// shadow customizer
	jQuery('#result_temp_blur_radius').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow('result_temp',result_temp_preview_obj);
	});
	 
	jQuery('#result_temp_hor_lnth').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow('result_temp',result_temp_preview_obj);
	});
	
	jQuery('#result_temp_ver_lnth').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow( 'result_temp',result_temp_preview_obj);
	});
	jQuery('#result_temp_spread_radius').bootstrapSlider().change(function() {
			sqb_templates_BoxShadow('result_temp',result_temp_preview_obj);
	});

	
	jQuery('#result_temp_shad_clr,#result_temp_shad_clr_div').colorpicker().on('changeColor', function() {
		   sqb_templates_BoxShadow( 'result_temp',result_temp_preview_obj);
	});

	jQuery('#ques_temp_ans_color,#ques_temp_ans_color_div').colorpicker().on('changeColor', function() {
		var color = jQuery(this).colorpicker('getValue');
		var ans_opacity = jQuery('#answer_background').val();
		var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
	    + ',' + parseInt(color.slice(-4,-2),16)
	    + ',' + parseInt(color.slice(-2),16)
	    +','+ans_opacity+')';
		var quiz_temp = jQuery('.question-screen').find('.sqb_ans_item').css("background", rgbaCol);
	});

	jQuery('#template6_answer_border_color, #template6_answer_border_color_select').colorpicker().on('changeColor', function() {
		var get_val = jQuery(this).colorpicker('getValue');
 		jQuery("body").get(0).style.setProperty("--template6_answer_border_color", get_val);
	});

	jQuery('#template6_answer_border_hover_color, #template6_answer_border_hover_color_select').colorpicker().on('changeColor', function() {
		//jQuery('.question-screen').find('.sqb_ans_item').css("border-color", jQuery(this).colorpicker('getValue'));
	});

	jQuery('#ques_temp_ans_text_color,#ques_temp_ans_color_text').colorpicker().on('changeColor', function() {
		jQuery('.sql_ans_text div').css('color','');
		var quiz_temp = jQuery('.question-screen').find('.sql_ans_text,.sql_ans_text span').css("color", jQuery(this).colorpicker('getValue'));
	});
	
	jQuery('#result_temp_height').bootstrapSlider().change(function() {
		result_temp_preview_obj.find('.Quiz-result-Template5-inner').css('min-height', +this.value + 'px');
	});
	jQuery('#result_temp_left_sction_clr,#result_temp_left_sction_clr_div').colorpicker().on('changeColor', function() {
				result_temp_preview_obj.find('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-color', jQuery(this).colorpicker('getValue'));
	});
	jQuery('#result_temp_right_sction_clr,#result_temp_right_sction_clr_div').colorpicker().on('changeColor', function() {
				result_temp_preview_obj.find('.res_data_cont.active').find('.Quiz-result-Template5-right ').css('background-color', jQuery(this).colorpicker('getValue'));
	});
	
	jQuery('#outcome_screen_background_image_size').bootstrapSlider().change(function() {
			result_temp_preview_obj.find('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-size', + this.value + 'px');		
	});
	jQuery('#outcome_screen_title_bg_clr,#outcome_screen_title_bg_clr_div').colorpicker().on('changeColor', function() {
			result_temp_preview_obj.find('.res_data_cont.active').find('.sqb_start_screen_background_image .points_scored_result').css('background-color', jQuery(this).colorpicker('getValue'));
	});
	
	jQuery('#outcome_screen_bg_image_opacity_clr,#outcome_screen_bg_image_opacity_clr_div').colorpicker().on('changeColor', function() {
		var sqb_bg_img = result_temp_preview_obj.find('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-image');
		if (sqb_bg_img != 'none' && sqb_bg_img.search("linear-gradient") != -1){
			var sqb_bg_img = sqb_bg_img.split(/[, ]+/).pop();
			var sqb_linear_gradient = 'linear-gradient('+jQuery(this).colorpicker('getValue')+','+ jQuery(this).colorpicker('getValue')+'),'+sqb_bg_img;
			result_temp_preview_obj.find('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-image', sqb_linear_gradient);
		}
	});
	
	//Recommended Next button customzier 	
	var recommended_next_template_html_preview_outer = jQuery('.recommended_next_template_html_preview_outer');
	jQuery('#sqb_cr_next_button_width').bootstrapSlider().change(function() {
		recommended_next_template_html_preview_outer.find('.sqb_next_btn').css('width', +this.value + 'px');
	});
	jQuery('#sqb_cr_next_button_height').bootstrapSlider().change(function() {
		recommended_next_template_html_preview_outer.find('.sqb_next_btn').css('padding-top', +this.value + 'px');
		recommended_next_template_html_preview_outer.find('.sqb_next_btn').css('padding-bottom', +this.value + 'px');
	});
	jQuery('#sqb_ce_nextbutton_backgroud_color,#sqb_ce_nextbutton_backgroud_color_div').colorpicker().on('changeColor', function() {
		recommended_next_template_html_preview_outer.find('.sqb_next_btn').css('background-color', jQuery(this).colorpicker('getValue'));
	});

	//Recommended Next button customzier 	
	var ads_next_template_html_preview_outer = jQuery('.ads_next_template_html_preview_outer');
	jQuery('#sqb_ads_next_button_width').bootstrapSlider().change(function() {
		ads_next_template_html_preview_outer.find('.sqb_next_btn').css('width', +this.value + 'px');
	});
	jQuery('#sqb_ads_next_button_height').bootstrapSlider().change(function() {
		ads_next_template_html_preview_outer.find('.sqb_next_btn').css('padding-top', +this.value + 'px');
		ads_next_template_html_preview_outer.find('.sqb_next_btn').css('padding-bottom', +this.value + 'px');
	});
	jQuery('#sqb_ads_nextbutton_backgroud_color,#sqb_ads_nextbutton_backgroud_color_div').colorpicker().on('changeColor', function() {
		ads_next_template_html_preview_outer.find('.sqb_next_btn').css('background-color', jQuery(this).colorpicker('getValue'));
	});

	//Outcome PDF Button customzier 	
	var outcome_pdf_template_html_preview_outer = jQuery('.outcome_pdf_template_html_preview_outer');
	jQuery('#sqb_outcome_download_pdf_button_width').bootstrapSlider().change(function() {
		outcome_pdf_template_html_preview_outer.find('.outcome_button_pdf').css('width', +this.value + 'px');
	});
	jQuery('#sqb_outcome_download_pdf_button_height').bootstrapSlider().change(function() {
		outcome_pdf_template_html_preview_outer.find('.outcome_button_pdf').css('padding-top', +this.value + 'px');
		outcome_pdf_template_html_preview_outer.find('.outcome_button_pdf').css('padding-bottom', +this.value + 'px');
	});
	jQuery('#sqb_outcome_download_pdf_button_radius').bootstrapSlider().change(function() {
		outcome_pdf_template_html_preview_outer.find('.outcome_button_pdf').css('border-radius', +this.value + 'px');
	});
	jQuery('#sqb_outcome_download_pdf_backgroud_color,#sqb_outcome_download_pdf_backgroud_color_div').colorpicker().on('changeColor', function() {
		outcome_pdf_template_html_preview_outer.find('.outcome_button_pdf').css('background-color', jQuery(this).colorpicker('getValue'));
	});
	
	//Certificate Button customzier 	
	var certificate_template_html_preview_outer = jQuery('.certificate_template_html_preview_outer');
	jQuery('#sqb_download_certificate_button_width').bootstrapSlider().change(function() {
		certificate_template_html_preview_outer.find('.download_certificate_button').css('width', +this.value + 'px');
	});
	jQuery('#sqb_download_certificate_button_height').bootstrapSlider().change(function() {
		certificate_template_html_preview_outer.find('.download_certificate_button').css('padding-top', +this.value + 'px');
		certificate_template_html_preview_outer.find('.download_certificate_button').css('padding-bottom', +this.value + 'px');
	});
	jQuery('#sqb_download_certificate_button_radius').bootstrapSlider().change(function() {
		certificate_template_html_preview_outer.find('.download_certificate_button').css('border-radius', +this.value + 'px');
	});
	jQuery('#sqb_download_certificate_backgroud_color,#sqb_download_certificate_backgroud_color_div').colorpicker().on('changeColor', function() {
		certificate_template_html_preview_outer.find('.download_certificate_button').css('background-color', jQuery(this).colorpicker('getValue'));
	});

	/*---Speed Timer---*/

	jQuery('#st_background_color,#st_background_color_div').colorpicker().on('changeColor', function() {
		var get_val = jQuery(this).colorpicker('getValue');
		jQuery("body").get(0).style.setProperty("--st-background-color", get_val);
	});

	jQuery('#st_background_color_second,#st_background_color_second_div').colorpicker().on('changeColor', function() {
		var get_val = jQuery(this).colorpicker('getValue');
		jQuery("body").get(0).style.setProperty("--st-background-color-second", get_val);
	});

	jQuery('#st_shadow_background_color,#st_shadow_background_color_div').colorpicker().on('changeColor', function() {
		var get_val = jQuery(this).colorpicker('getValue');
		jQuery("body").get(0).style.setProperty("--st-shadow-background-color", get_val);
	});

	
	jQuery('#st_spread_radius').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'px';
		jQuery("body").get(0).style.setProperty("--st-spread-radius", get_val);
	});
	jQuery('#st_blur_radius').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'px';
		jQuery("body").get(0).style.setProperty("--st-blur-radius", get_val);
	});

	jQuery('#st_horizontal_length').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'px';
		jQuery("body").get(0).style.setProperty("--st-horizontal-length", get_val);
	});

	jQuery('#st_vertical_length').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'px';
		jQuery("body").get(0).style.setProperty("--st-vertical-length", get_val);
	});

	/*------*/
	
	jQuery('#sqb_spider_bar_chart_font_weight').bootstrapSlider().change(function() {
	});
	
	jQuery('#sqb_spider_bar_chart_font_size').bootstrapSlider().change(function() {
	});

	jQuery('#sqb_pie_chart_width').bootstrapSlider().change(function() {
	});
	
	jQuery('#sqb_spider_bar_chart_font_color,#sqb_spider_bar_chart_font_color_div').colorpicker().on('changeColor', function() {
	});
	jQuery('#charts_bar_background_color,#charts_bar_background_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
		jQuery('#charts_bar_background_color_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 
	
}

function sqb_add_more_ans(){
	var ques_id = jQuery('.ans_text').attr('id');
	tinymce.get(ques_id).setContent('');	
	jQuery('.points_cls').val('');
	jQuery('.correct_cls').prop("checked", false);
}	

function sqb_save_question(){
	var id = jQuery('#aid').val();
	var ques_type = jQuery('#ques_type').val();	 
	var ques_id = jQuery('.ans_text').attr('id');
	var answer_info = tinymce.get(ques_id).getContent();	
	var ques_image= "";
	var upload_image = jQuery('#upload_image').prop("checked");
	if(upload_image == true ){
		var ques_image = jQuery('#ques_image').val();
	}
	var answer_hint = jQuery('#answer_hint').val();
	var answer_info = jQuery('#answer_info').val();
	var ans_text = jQuery('.ans_text').val();
	var points_cls = jQuery('.points_cls').val();
	var correct_cls = jQuery('.correct_cls').prop("checked");
	var answer_container = jQuery('.answer_container').length;
	 
	var form_data = {
		id: id,
		ques_type: ques_type ,
		ques_text: ques_text,
		ques_image:  ques_image,
		answer_info:  answer_info,
		answer_hint:answer_hint,
		ans_text: ans_text,	
		points_cls: points_cls,	
		correct_cls: correct_cls,	
	}
	
	sqb_show_loader();
	    
	jQuery.post(ajaxurl, {
			action: 'sqb_save_question',
			form_data: form_data,
	}, function(response) {
			sqb_hide_loader();
			response = JSON.parse(response);
			if(response.success){				 
				
				sqb_sweet_message('',response.success,'');
			}
			
			
	});
		
}

function sqb_save_answer(){
	var id = jQuery('#aid').val();
	var question_id = jQuery('#qid').val();
 
	var answer_hint = jQuery('#answer_hint').val();
	var ques_id = jQuery('.ans_text').attr('id');
	var answer_info = tinymce.get(ques_id).getContent();	
	var ans_text = jQuery('.ans_text').val();
	var points_cls = jQuery('.points_cls').val();
	var correct_cls = jQuery('.correct_cls').prop("checked");
	var answer_container = jQuery('.answer_container').length;
	 
	var form_data = {
		id: id,
		question_id: question_id,		 
		answer_info:  answer_info,
		answer_hint:answer_hint,
		ans_text: ans_text,	
		points_cls: points_cls,	
		correct_cls: correct_cls,	
	}
	
	sqb_show_loader();
	    
	jQuery.post(ajaxurl, {
			action: 'sqb_save_answer',
			form_data: form_data,
	}, function(response) {
			sqb_hide_loader();
			response = JSON.parse(response);
			if(response.success){
				//jQuery('input[name="edit_id"]').val(response.last_id);
				sqb_sweet_message('',response.success,'');
				
				var html_ans = ' <div class="stored-question-list"><div class="stored-drag-icon"><i class="fa fa-arrows" aria-hidden="true"></i></div>	<div class="stored-edit-icon"><i class="fa fa-pencil" aria-hidden="true"></i></div>	<h2>'+answer_info+'</h2><div class="stored-delete-icon"><i class="fa fa-trash" aria-hidden="true"></i></div></div>';
			
				jQuery('.all_answer_container_inn').append(html_ans);
				jQuery('.all_answer_container_inn').show();
			}
			
	});
		
}


function sqb_tiny_editor(){
    tinymce.init({
			mode : "specific_textareas",
            editor_selector : "sqb_tiny_editor",
            resize: "both",
            /*plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste , textcolor"
            ],*/
            fontsize_formats: '8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 20pt 24pt 30pt 36pt',
            font_formats: "Andale Mono=andale mono,times;" + "Arial=arial,helvetica,sans-serif;" + "Arial Black=arial black,avant garde;" + "Book Antiqua=book antiqua,palatino;" + "Comic Sans MS=comic sans ms,sans-serif;" + "Courier New=courier new,courier;" + "Georgia=georgia,palatino;" + "Helvetica=helvetica;" + "Impact=impact,chicago;" + "Symbol=symbol;" + "Tahoma=tahoma,arial,helvetica,sans-serif;" + "Terminal=terminal,monaco;" + "Times New Roman=times new roman,times;" + "Trebuchet MS=trebuchet ms,geneva;" + "Verdana=verdana,geneva;" + "Webdings=webdings;" + "Wingdings=wingdings,zapf dingbats",     
			//toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		    //toolbar2: 'print preview media | forecolor backcolor emoticons ',
		    plugins: [
               "lists link image charmap code",
               "fullscreen",
               "media paste , textcolor"
           ],
 toolbar1: 'insertfile undo redo | styleselect | fontselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
   toolbar2: 'print preview media | forecolor backcolor emoticons ',      
		    
			relative_urls: false,
            remove_script_host: false,
            convert_urls:false,
            templates: [
			   { title: 'Test template 1', content: 'Test 1' },
			   { title: 'Test template 2', content: 'Test 2' }
			   ],
			setup : function(ed) {
                
            }

        });
}

function  sqb_mediauploader(){
	
	var sqb_img;
	
	jQuery(document).on('click','.upload_img',function() {  
		
		if (sqb_img) {
			sqb_img.open();
			return;
		}
		sqb_img = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		sqb_img.on('select', function() {
			attachment = sqb_img.state().get('selection').first().toJSON();	
			jQuery('.ques_image_cls').val(attachment.url);
			
		});
		sqb_img.open();
	});
	
	
} 

function quiz_type_switching(quiz_type){
	var existing_quiz_type = jQuery('#quiz_type_switch').val();
	if(quiz_type == 'personality' || quiz_type == 'survey'){
		jQuery('.cat-outer').css('display','none');
		jQuery('.outcome-option-connect').removeClass('outcome-option-active');
		jQuery('.outcome-option-skip').addClass('outcome-option-active');

		var outcome_title = jQuery('.points_scored_result div').text();
		if(outcome_title == 'You got a score of %%YOURSCORE%% out of %%TOTALSCORE%%'){
			jQuery('.points_scored_result div').text('Your Result Type is [Outcome_Title]');
		}else if(outcome_title == 'You got %%CORRECTANSWERS%% correct out of %%TOTALQUESTIONS%%'){
			jQuery('.points_scored_result div').text('Your Result Type is [Outcome_Title]');
		}
		jQuery('.assessment_range_div').hide();
		jQuery('.assessment_number_div').hide();
	}else if(quiz_type == 'assessment' || quiz_type == 'scoring'){
		jQuery('.cat-outer').css('display','flex');
		jQuery('.cat-outer').css('flex-direction','row');

		var outcome_title = jQuery('.points_scored_result div').text();
		if(outcome_title == 'Your Result Type is [Outcome_Title]'){
			jQuery('.points_scored_result div').text('You got a score of %%YOURSCORE%% out of %%TOTALSCORE%%');
		}
		var outcome_type = jQuery('input[name="outcome_type"]:checked').val();
		if(outcome_type == 'correct_ans'){
			jQuery('.assessment_number_div').show();
			jQuery('.assessment_range_div').hide();
		}else{
			jQuery('.assessment_number_div').hide();
			jQuery('.assessment_range_div').show();
		}
		if(quiz_type == 'scoring'){
			jQuery('.scoring_label_text').show();
			jQuery('.assessment_label_text').hide();
			var outcome_title = jQuery('.points_scored_result div').text();
			if(outcome_title == 'Your Result Type is [Outcome_Title]'){
				jQuery('.points_scored_result div').text('You got %%CORRECTANSWERS%% correct out of %%TOTALQUESTIONS%%');
			}
			
		}else{
			jQuery('.scoring_label_text').hide();
			jQuery('.assessment_label_text').show();
		}
	}
}

function sqb_tom_menu_ordering_change_by_quiz_type(){
	//quiz select
jQuery('input[name="quiz_type"]').change(function(e){
	var input_val = jQuery(this).val();
	var sqb_validation_status = sqb_validate_change_quiz_type(this,e);
	if(sqb_validation_status){
		return false;
	}
	quiz_type_switching(input_val);
	var input_id = jQuery(this).attr("id");
	jQuery('.quiz_type_outer label').removeClass("checked_cls");
	jQuery('.'+input_id+'_cls').addClass("checked_cls");
	var input_val = jQuery(this).val();

	if(input_val == "scoring" || input_val == "assessment"){
		jQuery('#show_next_button').prop("checked", true);
	}else{
		jQuery('#show_next_button').prop("checked", false);
	}

	jQuery('.sqb-form-justbutton-option').addClass('sqb-hide-justbutton');
	jQuery('input[name="form_view_option"][value="vertical"]').prop('checked',true).trigger('change');
	if(input_val == "form"){
		jQuery('.sqb-form-justbutton-option').removeClass('sqb-hide-justbutton');
	}

	jQuery("#tab_switch").val(input_val);
	jQuery("#quiz_type_switch").val(input_val);
	var tab_switch = jQuery("#tab_switch").val();

	if(tab_switch == "none"){
		return false;
	}
	if((input_val == "personality") || (input_val == "survey") ){
		jQuery("#tab_switch").val(1);
		var questions_tab_html = jQuery(".questions_tab").wrap('<p/>').parent().html();
		jQuery(".questions_tab").unwrap();
		//var optin_tab_html = jQuery(".optin_tab").wrap('<p/>').parent().html();
		//jQuery(".optin_tab").unwrap();
		var result_tab_html = jQuery(".result_tab").wrap('<p/>').parent().html();
		jQuery(".result_tab").unwrap();
		
		jQuery(".result_tab").remove();
		jQuery(".questions_tab").remove();
		//jQuery(".optin_tab").remove();
		
		//jQuery('ul.sqb_top_menu_list').find('.start_tab').after(optin_tab_html);
		jQuery('ul.sqb_top_menu_list').find('.opt_screen_before_questions').after(questions_tab_html);
		jQuery('ul.sqb_top_menu_list').find('.start_tab').after(result_tab_html);
		//Calculator Quiz
		jQuery(".formula_tab").hide();	

		/*var questions_tab = jQuery(".questions_tab").html();
		var optin_tab = jQuery(".optin_tab").html();
		var result_tab = jQuery(".result_tab").html();
		
		jQuery(".result_tab").html(optin_tab);
		jQuery(".questions_tab").html(result_tab);
		jQuery(".optin_tab").html(questions_tab);*/

	}else{
		var tab_switch = jQuery("#tab_switch").val();
		if(tab_switch ==2){
		
		} else{
			jQuery("#tab_switch").val(2);
			/*var questions_tab = jQuery(".questions_tab").html();
			var optin_tab = jQuery(".optin_tab").html();
			var result_tab = jQuery(".result_tab").html();
			jQuery(".questions_tab").html(optin_tab);
			jQuery(".optin_tab").html(result_tab);
			jQuery(".result_tab").html(questions_tab);
			*/
			
			var questions_tab_html = jQuery(".questions_tab").wrap('<p/>').parent().html();
			jQuery(".questions_tab").unwrap();
			//var optin_tab_html = jQuery(".optin_tab").wrap('<p/>').parent().html();
			//jQuery(".optin_tab").unwrap();
			var result_tab_html = jQuery(".result_tab").wrap('<p/>').parent().html();
			jQuery(".result_tab").unwrap();
			var formula_tab_html = jQuery(".formula_tab").wrap('<p/>').parent().html();
			jQuery(".result_tab").remove();
			jQuery(".questions_tab").remove();
			//jQuery(".optin_tab").remove();
			//Calculator Quiz
			if(input_val == "calculator") {
				jQuery(".formula_tab").remove();
			}
			
			jQuery('ul.sqb_top_menu_list').find('.opt_screen_after_questions').after(result_tab_html);
			//jQuery('ul.sqb_top_menu_list').find('.start_tab').after(optin_tab_html);
			//Calculator Quiz
			if(input_val == "calculator") {					
				jQuery('ul.sqb_top_menu_list').find('.result_tab').before(formula_tab_html);
				jQuery(".formula_tab").show();
			}
			jQuery('ul.sqb_top_menu_list').find('.opt_screen_before_questions').after(questions_tab_html);
		}
	}

	// quiz type= personality ends
	//sqb_get_result_temp("template2", "result","true");

	if(input_val == "calculator"){
		jQuery('.show-other-outcomes').css('display','none');
		jQuery('.formula-outcome-mapping').css('display','inline-block');
	} else if(input_val == "form"){
		
	}else{
		jQuery('.show-other-outcomes').css('display','inline-block');
		jQuery('.formula-outcome-mapping').css('display','none');
	}

});
	
	
}







function sqbCloneQuiz(quiz_id = 0){
	
	if(quiz_id == '' || quiz_id == 0){
		return false;
	}

		swal({
		title: "Are you sure you want to Clone ?",
		text: "",
		//type: "warning",
		showCancelButton: true,
		showCloseButton: true,
		confirmButtonColor: "#24bd92",
		confirmButtonText: "Yes, Clone!",
		customClass: '',
		
		}).then((result) => {  
			if (result.value) {
				SQBShowLoader();
				jQuery.post(ajaxurl, {
				action: 'sqb_clone_quiz_by_id',
				quiz_id: quiz_id ,
							 
				}, function(response) {		  
					swal('','Clone Completed',"success");
					SQBHideLoader();
					location.reload();		 
					
				});
				
				
				
			}
		});
	
	
	
}


function sqb_get_lead_data(temp, quiz_temp){  
	var main_temp = jQuery('input[name="select_temp"]:checked').val();
	SQBShowLoader();
	var get_title = jQuery('.start_temp_outer .Quiz-Template-title').text();
	var get_content = jQuery('.start_temp_outer .Quiz-Template-content .sqb_content').text();
	jQuery.post(ajaxurl, {
			action: 'sqb_get_temp1',
			temp: temp ,
			quiz_temp: quiz_temp,
			main_temp: main_temp,
	}, function(response) {
			SQBHideLoader();
			response = JSON.parse(response);				
			jQuery('.optin_template_html_preview_outer').html(response);

		});
}

/*****Get the start template******/
function sqb_get_start_temp(temp, quiz_temp){  
	var main_temp = jQuery('input[name="select_temp"]:checked').val();
	SQBShowLoader();
	var get_title = jQuery('#quiz_name').val();
	//var get_title = jQuery('.start_temp_outer .Quiz-Template-title').text();
	// var get_content = jQuery('.start_temp_outer .Quiz-Template-content .sqb_content').text();
	var get_content = jQuery('#quiz_desc').val();
	jQuery.post(ajaxurl, {
			action: 'sqb_get_temp1',
			temp: temp ,
			quiz_temp: quiz_temp,
			main_temp: main_temp,
	}, function(response) {
			SQBHideLoader();
			if (temp == 'template2') {
				jQuery('.start_temp_static_div').removeClass('start_button_template');
				if(main_temp != 'template6' || main_temp != 'template7'){
					jQuery('.start-screen-button-options').show();
				}
				if(main_temp == 'template9'){
					jQuery('.template9-start-screen-customizers').show();
				}
				jQuery('.sqb_template6_selected .template8_question_screen_setting_options_wrapper.start_screen_setting_option_wrapper').show();
			}else{
				if (temp == 'template1') {
					jQuery('.start_temp_static_div').addClass('start_button_template');
				}
				jQuery('.sqb_template6_selected .template8_question_screen_setting_options_wrapper.start_screen_setting_option_wrapper').hide();
				if(main_temp != 'template6' || main_temp != 'template7'){
					jQuery('.start-screen-button-options').hide();
				}
				if(main_temp == 'template9'){
					jQuery('.template9-start-screen-customizers').hide();
					
				}
			}


			response = JSON.parse(response);				
			jQuery('.start_temp_container').html(response);
			jQuery('.start_temp_outer .Quiz-Template-title').text(get_title);
			if(temp != 'template5'){
			jQuery('.start_temp_container').append('<span class="sqb_edit_template "  data-toggle="modal" data-target="#myModalStart" title="Change the Template"><b>...</b></span>');
			}
			var sqb_button_template = jQuery('input[name="sqb_button_template"]:checked').val();
			if(sqb_button_template == 'default'){
				jQuery('#startbutton_backgroud_color_div').colorpicker('setValue', '#ffda5c');
			}
			
			//jQuery('#sqb_template_selected').val(temp);
			var select_temp = jQuery('input[name="select_temp"]:checked').val();
			
			sqb_check_for_template2_with_template6();
			
			sqb_template_related_actions(select_temp);

			var template_start_screen = jQuery('.Quiz-Start-Template2').hasClass('Start-template-withbutton');
			if(template_start_screen){
				jQuery('.button-template-hide').hide();
				jQuery('#Start-Screen-Settings .btn_customizer .customizer_innner_sections').show();
			}else{
				if(select_temp == 'template9'){
					jQuery('.button-template-hide').hide();
				}else{
					//jQuery('.button-template-hide').show();
				}
				jQuery('#Start-Screen-Settings .btn_customizer .customizer_innner_sections').hide();
			}

			if(temp == 'template2'){
				jQuery('.start_temp_container').find('img.start_img').attr('src',jQuery('input[name="start_template_default_img"]').val()); 
			}
			if(main_temp == 'template8'){ 
				jQuery('.Start-template-withbutton').addClass('Quiz-Template2 quiz_comon_template outer-style8');
				
				var template_start_screen = jQuery('.Quiz-Start-Template2').hasClass('Start-template-withbutton');
				if(template_start_screen){
					jQuery('#start_temp_static_div_id').css('background-color', 'transparent');
				}


				jQuery('.start_template_html_preview_outer').find('.take-quiz-btn').css('background-color', '#ff8745');
				jQuery('.start_template_html_preview_outer').find('.take-quiz-btn').css('color', '#ffffff');
				var sqb_button_template = jQuery('input[name="sqb_button_template"]:checked').val();
				if(sqb_button_template == 'default'){
					jQuery('#startbutton_backgroud_color,#startbutton_backgroud_color_div').colorpicker('setValue', '#ff8745');
				}
				jQuery('.start_template_html_preview_outer').find('.take-quiz-btn').text('Continue');
				jQuery('#Start-Screen-Settings .take-quiz-btn').css('max-width','356px');
				jQuery('#Start-Screen-Settings .take-quiz-btn').css('padding-top','19px');
				jQuery('#Start-Screen-Settings .take-quiz-btn').css('padding-bottom','19px');
				jQuery('#startbtn_width').bootstrapSlider('setValue',356);
				jQuery('#startbtn_height').bootstrapSlider('setValue',19);


			}

			if(main_temp == 'template9'){

				jQuery('#startbutton_backgroud_color').colorpicker('setValue', '#000000');
				jQuery('.template9_start_temp_outer .take-quiz-btn').css('color', '#ffffff');

				jQuery('#startbtn_width').bootstrapSlider('setValue', 272).trigger('change');
				jQuery('#startbtn_height').bootstrapSlider('setValue', 16).trigger('change');
				setTimeout(function(){
					jQuery('.start-screen-video-settings-show-hide').show();
					jQuery('.template9_start_temp_outer').addClass('sqb-no-video-found');
				}, 500);
			}

			

			if(temp == 'template1' && select_temp != 'template5'){
				jQuery('.start_temp_container link').remove();
				jQuery('.start_temp_static_div link').remove();
				jQuery('.start_temp_static_div').prepend('<link href="'+sqb_site_url+'/wp-content/plugins/smartquizbuilder/includes/templates/start/template1/template1.css" rel="stylesheet">');
			}else{
				if(select_temp == 'template5'){
					jQuery('.start_temp_container link').remove();
					jQuery('.start_temp_static_div link').remove();
					jQuery('.start_temp_static_div').prepend('<link href="'+sqb_site_url+'/wp-content/plugins/smartquizbuilder/includes/templates/start/template5/template5.css" rel="stylesheet">');
				}else if(select_temp == 'template8'){
					jQuery('.start_temp_container link').remove();
					jQuery('.start_temp_static_div link').remove();
					jQuery('.start_temp_static_div').prepend('<link href="'+sqb_site_url+'/wp-content/plugins/smartquizbuilder/includes/templates/start/template8/template8.css" rel="stylesheet">');
				}else{
					jQuery('.start_temp_container link').remove();
					jQuery('.start_temp_static_div link').remove();
					jQuery('.start_temp_static_div').prepend('<link href="'+sqb_site_url+'/wp-content/plugins/smartquizbuilder/includes/templates/start/template2/template2.css" rel="stylesheet">');
				}
			}

			//jQuery('.close').trigger("click");
			sqb_tiny_mce_editor();
			sqb_button_customizer();
			jQuery('.start_temp_outer .Quiz-Template-content .sqb_content').text(get_content);
			jQuery('input[name="starttemplate"][value="'+temp+'"]').prop('checked', true);

			setTimeout(function(){
				jQuery('#startbutton_backgroud_color').colorpicker('setValue','#ff7777');
				if(temp == 'template1'){
					jQuery('.start_temp_static_div').addClass('sqb_start_display_popup');
				}else{
					jQuery('.start_temp_static_div').removeClass('sqb_start_display_popup');
				}
			},500);
	});
	
}

function sqb_check_for_template2_with_template6(){
	if(jQuery('[name="select_temp"]:checked').val() == 'template6'){
		if(jQuery('#sqb_template_selected').val() == 'template1' || jQuery('.start_template_html_preview_outer .Quiz-Start-Template2').length > 0){
			jQuery('#sortable_screen #start_temp').hide('slow');
			if(jQuery('input[name="defaultpopup_type"]:checked').val() == 'popup'){
				jQuery('.show-start-screen-settings').show();		
				jQuery('.show-quiz-screen-setting').hide();
			}else{
				jQuery('.show-start-screen-settings').hide();		
				jQuery('.show-quiz-screen-setting').show();
			}
			

			jQuery('.back-start-screen-setting').hide();
			jQuery('.back-basic-screen-setting').show();

			jQuery('.ass-prev-start-setting').hide();
			jQuery('.asses-quiz-screen-setting').show();
			
			jQuery('.outcome-screen-background-customizer').show();
			
			setTimeout(function(){ 
			jQuery('.start_screen_background_customizer').hide();
			var bg_style = jQuery('#start_temp_static_div_id').attr('style');
			jQuery('#bg_imge_style').val(bg_style);
			var get_inner_style = jQuery('.Quiz-Optin-Template.quiz_comon_template').attr('style');
			jQuery('#bg_imge_style_inner').val(get_inner_style);
			jQuery('#start_temp_static_div_id').attr('style','');
			var start_btn_bg =  jQuery('.start_template_html_preview_outer').find('.take-quiz-btn').css('background-color');
			var sqb_button_template = jQuery('input[name="sqb_button_template"]:checked').val();
			if(sqb_button_template == 'default'){
				jQuery('#startbutton_backgroud_color,#startbutton_backgroud_color_div').colorpicker('setValue', start_btn_bg);
			}
			}, 700);
		} else {
			jQuery('#sortable_screen #start_temp').show('slow');
			jQuery('.show-start-screen-settings').show();		
			jQuery('.show-quiz-screen-setting').hide();

			jQuery('.back-start-screen-setting').show();
			jQuery('.back-basic-screen-setting').hide();
		
			jQuery('.ass-prev-start-setting').show();
			jQuery('.asses-quiz-screen-setting').hide();
			//jQuery('.outcome-screen-background-customizer').hide();
			
			jQuery('.start_screen_background_customizer').show();
		}
		
		
	}
}


function sqb_template_related_actions(select_temp){
	if(select_temp == 'template1' || select_temp == 'template5') {
		select_temp_template1();
		if(select_temp == 'template5'){
			change_start_screen_to_template5();
			jQuery('.Quiz-Template.Quiz-Template-5').removeAttr('style');
			jQuery('.Quiz-start-Template5-inner').css('min-height','760px');
			jQuery('.sqb_questions_wrapper').find('.Quiz-Template5-inner').css('min-height','760px');
			jQuery('.Quiz-result-Template5-inner').css('min-height','760px');
			
			var starttempSlider = jQuery("#start_temp_width");
			starttempSlider.bootstrapSlider('setAttribute','max', 2000);
			starttempSlider.bootstrapSlider('setValue', 1400);
			jQuery('.start_template_html_preview_outer').find('.start_temp_outer').css('max-width','1400px');
			
			var questiontempSlider = jQuery("#question_temp_width");
			questiontempSlider.bootstrapSlider('setAttribute','max', 2000);
			questiontempSlider.bootstrapSlider('setValue', 1400);
			jQuery('.Template-Customize-content_question').find('.Quiz-Template').css('max-width','1400px');
			
			var outtcometempSlider = jQuery("#result_temp_width");
			outtcometempSlider.bootstrapSlider('setAttribute','max', 2000);
			outtcometempSlider.bootstrapSlider('setValue', 1400);
			jQuery('.result_template_html_preview_outer').find('.result_temp_outer').attr('style','');
			jQuery('.result_template_html_preview_outer').find('.result_temp_outer').css('max-width','1400px');
			
			var optintempSlider = jQuery("#opt_in_temp_width");
			optintempSlider.bootstrapSlider('setAttribute','max', 2000);
			optintempSlider.bootstrapSlider('setValue', 1400);
			jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('max-width','1400px');
			
			jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('background-color','#000');
			jQuery('#opt_in_temp_backgroud_color').colorpicker('setValue', '#000');
			jQuery('#opt_in_temp_backgroud_color_div').colorpicker('setValue', '#000');
			
			jQuery('.optin_template_html_preview_outer').find('.Quiz-Template-title').css('color','#fff');
			jQuery('.optin_template_html_preview_outer').find('.sqb_opt_in_h6').css('color','#fff');
			jQuery('.optin_template_html_preview_outer').find('.text_privacy_policy').css('color','#fff');
			jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('text-align','center');
			jQuery('#opt_in_temp_alignment  option[value="center"]').prop("selected", true);
			
			jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('border','none');
			jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('border-radius','0');
			jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('min-height','760px');
			//jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template .Quiz-Template-title').css('margin-top','12%');
		
		} else {
			jQuery('#enable_outcome_screen_background_image').prop('checked',false);
			jQuery('#enable_question_screen_background_image').prop('checked',false);
			jQuery('#enable_start_screen_background_image').prop('checked',false);
			
			jQuery('[name="enable_question_background_image"]').val('N');
			jQuery('[name="enable_outcome_background_image"]').val('N');
			//jQuery('[name="enable_outcome_background_image"]').val('N');
			jQuery('[name="question_background_image"]').val('');
			
		}
	}
	
	
	if(select_temp == 'template2') {
		select_temp_template2();
	}
	if(select_temp == 'template3') {
		select_temp_template3();
	}
	if(select_temp == 'template4') {
		select_temp_template4();
	}
	if(select_temp == 'template6') {
		if(jQuery('#sqb_template_selected').val() == 'template1' || jQuery('.start_template_html_preview_outer .Quiz-Start-Template2').length > 0){
		} else {
			select_temp_template6();
		}
	}
	if(select_temp == 'template7') {
		select_temp_template7();
	}
}

function onSelectOfTemplate(select_temp){
		var selected_temp_name = jQuery('#sqb_template_selected').val();
		var edit_mode = jQuery('#edit_mode').val();
		var global_style_css = jQuery('#global_style_css').val();

		if(selected_temp_name == 'template9' && (select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4' || select_temp == 'template5' || select_temp == 'template6' || select_temp == 'template7' || select_temp == 'template8')){
			jQuery('#select_template9').prop('checked', true);
			sqb_sweet_message('',"Sorry, currently can't switch to a different template from this template.",'');
			return false;
		}

		if(edit_mode == 'Y'){
			if(select_temp == 'template9' && (selected_temp_name == 'template1' || selected_temp_name == 'template2' || selected_temp_name == 'template3' || selected_temp_name == 'template4' || selected_temp_name == 'template5' || selected_temp_name == 'template6' || selected_temp_name == 'template7' || selected_temp_name == 'template8')){
				jQuery('#select_template9').prop('checked', false);
				jQuery('input[name="select_temp"][value="'+selected_temp_name+'"]').prop('checked', true);
				sqb_sweet_message('',"Sorry, currently can't switch to a different template from this template.",'');
				return false;
			}

			if(jQuery('.left_side_question_list ul li').length != 0){
				if(selected_temp_name == 'template5' && (select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4' || select_temp == 'template6' || select_temp == 'template7' || select_temp == 'template8' || select_temp == 'template9')){
					jQuery('#select_template9').prop('checked', false);
					jQuery('input[name="select_temp"][value="'+selected_temp_name+'"]').prop('checked', true);
					sqb_sweet_message('',"Sorry, currently can't switch to a different template from this template.",'');
					return false;
				}
			}				
		}

		if(edit_mode == 'Y' && global_style_css == 'N'){
			if(selected_temp_name == "template8" && (select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4' || select_temp == 'template5' || select_temp == 'template6' || select_temp == 'template7' || select_temp == 'template9')){
				jQuery('#select_template8').prop('checked', true);
				sqb_sweet_message('',"Sorry, we don't allow template switching for older quizzes.",'');
				return false;
			}

			if(selected_temp_name == "template7" && (select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4' || select_temp == 'template5' || select_temp == 'template6' || select_temp == 'template8' || select_temp == 'template9')){
				jQuery('#select_template7').prop('checked', true);
				sqb_sweet_message('',"Sorry, we don't allow template switching for older quizzes.",'');
				return false;
			}

			if(selected_temp_name == "template6" && (select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4' || select_temp == 'template5' || select_temp == 'template7' || select_temp == 'template8' || select_temp == 'template9')){
				jQuery('#select_template6').prop('checked', true);
				sqb_sweet_message('',"Sorry, we don't allow template switching for older quizzes.",'');
				return false;
			}

			if(selected_temp_name == "template5" && (select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4' || select_temp == 'template6' || select_temp == 'template7' || select_temp == 'template8' || select_temp == 'template9')){
				jQuery('#select_template5').prop('checked', true);
				sqb_sweet_message('',"Sorry, we don't allow template switching for older quizzes.",'');
				return false;
			}
		}

		if(select_temp == 'template5' && selected_temp_name != 'template5'){
			if(jQuery('#ads_or_recommendation:checked').val() == 'Y'){
				jQuery('#select_template5').prop('checked', false);
				sqb_sweet_message('','Sorry "question ads and recommendations" are not supported in this template. Please switch to a different template to use this option.','');
				return false;
			}
		}else if(select_temp == 'template7' && selected_temp_name != 'template7'){
			if(jQuery('#ads_or_recommendation:checked').val() == 'Y'){
				jQuery('#select_template7').prop('checked', false);
				sqb_sweet_message('','Sorry "question ads and recommendations" are not supported in this template. Please switch to a different template to use this option.','');
				return false;
			}
		}

		if(select_temp == 'template6'){
			jQuery('.question_details').removeAttr('style');
		}
		
		/*********for template8******/
		jQuery('.sqb_questions_wrapper .question_div_inner .sqb_question_enable_drag_drop').removeAttr('style');
		jQuery('.templates_images').removeClass('active_template_cls');
		jQuery('#container_'+select_temp).addClass('active_template_cls');
		jQuery('.for_template_4_customizer').hide();
		
		/******for template6*****/
		jQuery('.Quiz--tabs-outer').removeClass('sqb_template6_selected');
		/******for template6*****/
		/******for template7*****/
		jQuery('.Quiz--tabs-outer').removeClass('sqb_template7_selected');
		jQuery('.Quiz--tabs-outer').removeClass('sqb_collapse_left_menu');
		jQuery('#question_ans_empty_img').val(jQuery('#question_ans_empty_img_default').val());
		
		jQuery('.sqb_global_customizer_button').addClass('d-flex').show();
		if(jQuery('#sqb_enable_global_setting_each_screen').prop('checked')){
		//jQuery('#sqb_enable_global_setting_each_screen').trigger('click');	
		} else {
		//jQuery('.global-Customizer-inner').removeClass('sqb_global_theme_sticky_enable').css('display','none');
		}
		/******for template7*****/
		if(selected_temp_name == 'template5'){
			if(select_temp != 'template5'){
				var num_of_questions = jQuery('#Quiz-Screen-Settings .left_side_question_list ul li').length;
				if(num_of_questions > 0){
					swal({
						title: "Are you sure you want to switch to a different template?",
						text: "You'll lose all formatting you have with the current template when you switch.",
						//type: "warning",
						showCancelButton: true,
						showCloseButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Yes, Switch!",
						customClass: '',
					}).then((result) => {
						if (result.value) {
							all_selected_template_data(select_temp, selected_temp_name);
						jQuery('#sqb_template_selected').val(select_temp);
							sqb_get_start_temp('template2', "start");
							change_questions_design_from_template5();
							change_outcome_screen_design_from_template5();
							change_optin_screen_design_from_template5();
						} else {
							jQuery('#select_'+selected_temp_name).trigger('click');
							return false
						}
						applyGlobalLevelSettings();
					});	
				} else {
					sqb_get_start_temp('template2', "start");
					change_questions_design_from_template5();
					change_outcome_screen_design_from_template5();
					change_optin_screen_design_from_template5();
					applyGlobalLevelSettings();
				}
				
				if(select_temp == 'template6'){
					jQuery('.Quiz--tabs-outer').addClass('sqb_template6_selected');
					jQuery('.Quiz--tabs-outer').addClass('sqb_collapse_left_menu');
					jQuery('.sqb_template6_selected .collapse-menu-item').html('<a class="nav-link" href="javascript:void(0)"><label>Collapse Menu</label><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>');
				}
				
			}
			jQuery('.create-quiz-block').removeClass('sqb-1to4-template');
			applyGlobalLevelSettings();
		} else {
			all_selected_template_data(select_temp, selected_temp_name);
			applyGlobalLevelSettings();
		}
		
		var sqb_button_template = jQuery('input[name="sqb_button_template"]:checked').val();
		if(sqb_button_template == 'default'){
			var start_screen = jQuery('.start_template_html_preview_outer .take-quiz-btn').css('background-color');
			jQuery('#startbutton_backgroud_color').colorpicker('setValue', start_screen);
		}

		var outcome_screen = jQuery('.outcome-section .take-quiz-btn').css('background-color');
		var sqb_button_template_outcome = jQuery('input[name="sqb_button_template_outcome"]:checked').val();
		if(sqb_button_template_outcome == 'default'){
			if(outcome_screen){
				jQuery('#outcome_button_backgroud_color').colorpicker('setValue', outcome_screen);
			}else{
				jQuery('#outcome_button_backgroud_color').colorpicker('setValue', 'rgb(255, 99, 77)');
			}
		}

		var lead_screen = jQuery('.optin_template_html_preview_outer .continue_btn').css('background-color');
		jQuery('#opt_button_backgroud_color').colorpicker('setValue', lead_screen);

		jQuery('.continue-question-action').find( "[id^='mce_']" ).each(function(){
		    jQuery(this).removeAttr('id');
		});
		sqb_tiny_mce_editor();
}	

function all_selected_template_data(select_temp, selected_temp_name){

			
		if(select_temp != 'template5'){
			jQuery('#sqb_template_selected').val(select_temp);
		}


		if(select_temp == "template2"){
			jQuery('.create-quiz-block').addClass('sqb-1to4-template');
			var get_global_val = jQuery("#global_style_css").val();
			if(get_global_val == 'Y'){
				jQuery('.sqb_global_bg_customizer').show();
				jQuery('.sqb_global_shadow_customizer').show();
			}

			jQuery('.sqbv2-new-template-styles').removeClass('template1_selected');
			jQuery('.sqbv2-new-template-styles').addClass('template2_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template3_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template4_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template5_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template6_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template7_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template8_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template9_selected');

			select_temp_template2(); 
			change_all_screen_design_from_template7();
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template1_selected');
			jQuery('.Quiz--tabs-outer').addClass('sqb_template2_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template3_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template4_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template5_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template6_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template7_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template8_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template9_selected');

			jQuery('.Quiz--tabs-outer').addClass('sqb_collapse_left_menu');
			jQuery('#question_ans_empty_img').val(jQuery('#question_ans_empty_img_for_template8').val());
			jQuery('.sqb_template2_selected .collapse-menu-item').html('<a class="nav-link" href="javascript:void(0)"><label>Collapse Menu</label><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>');
			
			jQuery('#sqb_global_temp_title_color').colorpicker('setValue', '#000000');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_color", '#000000');
			jQuery('#sqb_global_temp_title_line_height').val('1');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_line_height", '1');

			jQuery('#sqb_global_temp_description_color').colorpicker('setValue', '#000000');
			jQuery("body").get(0).style.setProperty("--sqb_global_description_color", '#000000');

			jQuery('#sqb_global_temp_question_ans_color').colorpicker('setValue', '#000000');
			jQuery("body").get(0).style.setProperty("--sqb_global_question_ans_color", '#000000');

			jQuery('.sqb_global_outer_width_input').val('700');
			jQuery('.sqb_global_outer_width').val('700');
			jQuery("body").get(0).style.setProperty("--sqb_global_outer_width", '700px');
		}else if(select_temp =="template3"){
			jQuery('.create-quiz-block').addClass('sqb-1to4-template');
			var get_global_val = jQuery("#global_style_css").val();
			if(get_global_val == 'Y'){
				jQuery('.sqb_global_bg_customizer').show();
				jQuery('.sqb_global_shadow_customizer').show();
			}

			jQuery('.sqbv2-new-template-styles').removeClass('template1_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template2_selected');
			jQuery('.sqbv2-new-template-styles').addClass('template3_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template4_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template5_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template6_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template7_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template8_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template9_selected');

			jQuery('.Quiz--tabs-outer').removeClass('sqb_template1_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template2_selected');
			jQuery('.Quiz--tabs-outer').addClass('sqb_template3_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template4_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template5_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template6_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template7_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template8_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template9_selected');

			select_temp_template3(); 
			change_all_screen_design_from_template7();

			jQuery('#sqb_global_temp_title_color').colorpicker('setValue', '#ffffff');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_color", '#ffffff');
			jQuery('#sqb_global_temp_title_line_height').val('1.3');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_line_height", '1.3');

			jQuery('#sqb_global_temp_description_color').colorpicker('setValue', '#333333');
			jQuery("body").get(0).style.setProperty("--sqb_global_description_color", '#333333');

			jQuery('#sqb_global_temp_question_ans_color').colorpicker('setValue', '#333333');
			jQuery("body").get(0).style.setProperty("--sqb_global_question_ans_color", '#333333');

			jQuery('#sqb_global_temp_border_color').colorpicker('setValue', 'rgb(255,99,77)');
			jQuery("body").get(0).style.setProperty("--sqb_global_border_color", 'rgb(255,99,77)');

			jQuery('#sqb_global_temp_border_width').bootstrapSlider('setValue', '4');
			jQuery("body").get(0).style.setProperty("--sqb_global_border_width", '4px');

			jQuery('.sqb_global_outer_width_input').val('700');
			jQuery('.sqb_global_outer_width').val('700');
			jQuery("body").get(0).style.setProperty("--sqb_global_outer_width", '700px');
		}else if(select_temp =="template4"){
			jQuery('.create-quiz-block').addClass('sqb-1to4-template');
			var get_global_val = jQuery("#global_style_css").val();
			if(get_global_val == 'Y'){
				jQuery('.sqb_global_bg_customizer').show();
				jQuery('.sqb_global_shadow_customizer').show();
			}

			jQuery('.Quiz--tabs-outer').removeClass('sqb_template1_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template2_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template3_selected');
			jQuery('.Quiz--tabs-outer').addClass('sqb_template4_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template5_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template6_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template7_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template8_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template9_selected');

			jQuery('.sqbv2-new-template-styles').removeClass('template1_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template2_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template3_selected');
			jQuery('.sqbv2-new-template-styles').addClass('template4_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template5_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template6_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template7_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template8_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template9_selected');
			select_temp_template4(); 
			change_all_screen_design_from_template7();
			
			jQuery('#sqb_global_temp_title_color').colorpicker('setValue', '#000000');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_color", '#000000');
			jQuery('#sqb_global_temp_title_line_height').val('1');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_line_height", '1');

			jQuery('#sqb_global_temp_description_color').colorpicker('setValue', '#000000');
			jQuery("body").get(0).style.setProperty("--sqb_global_description_color", '#000000');

			jQuery('#sqb_global_temp_question_ans_color').colorpicker('setValue', '#000000');
			jQuery("body").get(0).style.setProperty("--sqb_global_question_ans_color", '#000000');

			jQuery('.sqb_global_outer_width_input').val('700');
			jQuery('.sqb_global_outer_width').val('700');
			jQuery("body").get(0).style.setProperty("--sqb_global_outer_width", '700px');
		}else if(select_temp =="template5"){
			jQuery('.create-quiz-block').removeClass('sqb-1to4-template');
			var get_global_val = jQuery("#global_style_css").val();
			if(get_global_val == 'Y'){
				jQuery('.sqb_global_bg_customizer').hide();
				jQuery('.sqb_global_shadow_customizer').hide();
			}

			jQuery('.start_temp_static_div').removeClass('sqb_start_screen_background_image');
			jQuery('.outcome-section').removeClass('sqb_start_screen_background_image');

			jQuery('.Quiz--tabs-outer').removeClass('sqb_template1_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template2_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template3_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template4_selected');
			jQuery('.Quiz--tabs-outer').addClass('sqb_template5_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template6_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template7_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template8_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template9_selected');

			jQuery('.sqbv2-new-template-styles').removeClass('template1_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template2_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template3_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template4_selected');
			jQuery('.sqbv2-new-template-styles').addClass('template5_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template6_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template7_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template8_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template9_selected');
			
			if(select_temp != selected_temp_name){
				
				var num_of_questions = jQuery('#Quiz-Screen-Settings .left_side_question_list ul li').length;
				if(num_of_questions > 0){
					swal({
						title: "Are you sure you want to switch to a different template?",
						text: "You'll lose all formatting you have with the current template when you switch.",
						//type: "warning",
						showCancelButton: true,
						showCloseButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Yes, Switch!",
						customClass: '',
					}).then((result) => {
						if (result.value) {
							jQuery('#sqb_template_selected').val(select_temp);
							sqb_get_start_temp(select_temp, "start");
							change_questions_design_to_template5();
							change_outcome_screen_design_to_template5();
							change_optin_screen_design_to_template5();
						} else {
							jQuery('#select_'+selected_temp_name).trigger('click');
							return false
						}
					});
				} else {
					sqb_get_start_temp(select_temp, "start");
					change_questions_design_to_template5();
					change_outcome_screen_design_to_template5();
					change_optin_screen_design_to_template5();
				}	
			}
			change_all_screen_design_from_template7();
			jQuery('.sqb_select_global_height option').removeAttr('selected');
			jQuery('.global-height-px').hide();
			jQuery('.global-height-vh').show();
			jQuery('.sqb_select_global_height option[value=vh]').attr('selected','selected');

			jQuery('.sqb_global_height_vh_input').val('100');
			jQuery('#sqb_global_height_vh').bootstrapSlider('setValue', '100');
			jQuery("body").get(0).style.setProperty("--sqb_global_height", '100vh');
			
			jQuery('#sqb_global_temp_title_color').colorpicker('setValue', '#000000');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_color", '#000000');
			jQuery('#sqb_global_temp_title_line_height').val('1.1');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_line_height", '1.1');

			jQuery('#sqb_global_temp_description_color').colorpicker('setValue', '#ffffff');
			jQuery("body").get(0).style.setProperty("--sqb_global_description_color", '#ffffff');

			jQuery('#sqb_global_temp_question_ans_color').colorpicker('setValue', '#333333');
			jQuery("body").get(0).style.setProperty("--sqb_global_question_ans_color", '#333333');

			jQuery('.sqb_global_outer_width_input').val('2000');
			jQuery('#sqb_global_outer_width').bootstrapSlider('setValue','2000');
			jQuery("body").get(0).style.setProperty("--sqb_global_outer_width", '2000px');

		}else if(select_temp =="template6"){
			jQuery('.create-quiz-block').removeClass('sqb-1to4-template');
			select_temp_template6(); 

			var get_global_val = jQuery("#global_style_css").val();
			if(get_global_val == 'Y'){
				jQuery('.sqb_global_bg_customizer').hide();
				jQuery('.sqb_global_shadow_customizer').hide();
			}

			change_all_screen_design_from_template7();
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template1_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template2_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template3_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template4_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template5_selected');
			jQuery('.Quiz--tabs-outer').addClass('sqb_template6_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template7_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template8_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template9_selected');

			jQuery('.sqbv2-new-template-styles').removeClass('template1_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template2_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template3_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template4_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template5_selected');
			jQuery('.sqbv2-new-template-styles').addClass('template6_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template7_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template8_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template9_selected');

			jQuery('.Quiz--tabs-outer').addClass('sqb_collapse_left_menu');
			jQuery('.sqb_template6_selected .collapse-menu-item').html('<a class="nav-link" href="javascript:void(0)"><label>Collapse Menu</label><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>');
			

			jQuery('#sqb_global_temp_title_color').colorpicker('setValue', '#333333');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_color", '#333333');
			jQuery('#sqb_global_temp_title_line_height').val('1.3');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_line_height", '1.3');

			jQuery('#sqb_global_temp_description_color').colorpicker('setValue', '#333333');
			jQuery("body").get(0).style.setProperty("--sqb_global_description_color", '#333333');

			jQuery('#sqb_global_temp_question_ans_color').colorpicker('setValue', '#333333');
			jQuery("body").get(0).style.setProperty("--sqb_global_question_ans_color", '#333333');

			jQuery('.sqb_select_global_height option').removeAttr('selected');
			jQuery('.global-height-px').hide();
			jQuery('.global-height-vh').show();
			jQuery('.sqb_select_global_height option[value=vh]').attr('selected','selected');
			
			jQuery('.sqb_global_height_vh_input').val('37');
			jQuery('#sqb_global_height_vh').bootstrapSlider('setValue', '37');
			jQuery("body").get(0).style.setProperty("--sqb_global_height", '37vh');

			jQuery('.sqb_global_outer_width_input').val('1020');
			jQuery('#sqb_global_outer_width').bootstrapSlider('setValue','1020');
			jQuery("body").get(0).style.setProperty("--sqb_global_outer_width", '1020px');

			jQuery("body").get(0).style.setProperty("--sqb_global_background", 'rgba(239,243,245,0.1)');
			jQuery("body").get(0).style.setProperty("--sqb_global_background_color", 'rgba(239,243,245,0.48)');

			jQuery('#sqb_global_background_color').colorpicker('setValue', 'rgba(239,243,245,0.1)');
			jQuery('#sqb_global_inner_background_color').colorpicker('setValue', 'rgba(239,243,245,0.48)');
			jQuery('#sqb_global_ans_border_hover_color').colorpicker('setValue', '#000000');

			jQuery('.sqb_global_padding_input').val('69');
			jQuery('#sqb_global_padding').bootstrapSlider('setValue','69');
			jQuery("body").get(0).style.setProperty("--sqb_global_padding", '69px');

			jQuery('.start_temp_static_div').addClass('sqb_start_screen_background_image');
			jQuery('.outcome-section').addClass('sqb_start_screen_background_image');
			jQuery('.question-screen').addClass('sqb_start_screen_background_image');
			jQuery('.optin_template_html_preview_outer').addClass('sqb_start_screen_background_image');

			jQuery('#sqb_global_background_image').text(sqb_site_url+'/wp-content/plugins/smartquizbuilder/includes/images/template6-latest.jpeg');
			jQuery('#sqb_global_background_image_url').val(sqb_site_url+'/wp-content/plugins/smartquizbuilder/includes/images/template6-latest.jpeg');
			setTimeout(function(){
				jQuery("body").get(0).style.setProperty("--sqb_global_background_image", 'url('+sqb_site_url+'/wp-content/plugins/smartquizbuilder/includes/images/template6-latest.jpeg)');
			}, 500);


		}else if(select_temp =="template7"){
			jQuery('.create-quiz-block').removeClass('sqb-1to4-template');
			select_temp_template7(); 
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template1_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template2_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template3_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template4_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template5_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template6_selected');
			jQuery('.Quiz--tabs-outer').addClass('sqb_template7_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template8_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template9_selected');

			jQuery('.sqbv2-new-template-styles').removeClass('template1_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template2_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template3_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template4_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template5_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template6_selected');
			jQuery('.sqbv2-new-template-styles').addClass('template7_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template8_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template9_selected');

			jQuery('.Quiz--tabs-outer').addClass('sqb_collapse_left_menu');
			jQuery('#question_ans_empty_img').val(jQuery('#question_ans_empty_img_for_template7').val());
			jQuery('.sqb_template7_selected .collapse-menu-item').html('<a class="nav-link" href="javascript:void(0)"><label>Collapse Menu</label><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>');
			
			jQuery('.sqb_global_customizer_button').addClass('d-flex').show();
			if(!jQuery('#sqb_enable_global_setting_each_screen').prop('checked')){
			jQuery('#sqb_enable_global_setting_each_screen').prop('checked',true);
			}
			jQuery('.Quiz-Settings-TabContent_inner_first').addClass('sqb_global_theme_enable_each_template');
			jQuery('.sqb_global_customizer_button').removeClass('d-flex');
			jQuery('.sqb_global_customizer_button').hide();
			jQuery('.global-Customizer-inner').addClass('sqb_global_theme_sticky_enable').css('display','inline-flex');
			jQuery('.outcome-section').removeAttr("style");
			jQuery('.optin_template_html_preview_outer').removeAttr("style");
			jQuery('.question_details .sqbHideQuesTemplateImageOuter').hide();
			jQuery('.sqbDeleteQuesTemplateImage').trigger('click');
			jQuery('.template7-skip-question-button').show();
			jQuery('.template7-choose-layout-section').show();

			
			jQuery('#sqb_global_temp_title_color').colorpicker('setValue', '#414b56');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_color", '#414b56');
			jQuery('#sqb_global_temp_title_line_height').val('1.3');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_line_height", '1.3');
			jQuery('#sqb_global_temp_title_font_family').val('Noto Serif Display').trigger('change');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_font_family", 'Noto Serif Display');

			jQuery('#sqb_global_temp_description_color').colorpicker('setValue', '#676f78');
			jQuery("body").get(0).style.setProperty("--sqb_global_description_color", '#676f78');

			jQuery('#sqb_global_temp_question_ans_color').colorpicker('setValue', '#333333');
			jQuery("body").get(0).style.setProperty("--sqb_global_question_ans_color", '#333333');

			jQuery('.sqb_global_outer_width_input').val('2000');
			jQuery('#sqb_global_outer_width').bootstrapSlider('setValue','2000');
			jQuery("body").get(0).style.setProperty("--sqb_global_outer_width", '2000px');
		}else if(select_temp =="template8"){
			jQuery('.create-quiz-block').removeClass('sqb-1to4-template');
			var default_popup_type = jQuery("input[name='defaultpopup_type']:checked").val();
			if(default_popup_type == 'popup'){
				sqb_get_start_temp('template1', 'start');
			}else{
				sqb_get_start_temp(select_temp, "start");
			}
			select_temp_template8(); 
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template1_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template2_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template3_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template4_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template5_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template6_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template7_selected');
			jQuery('.Quiz--tabs-outer').addClass('sqb_template8_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template9_selected');

			jQuery('.sqbv2-new-template-styles').removeClass('template1_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template2_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template3_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template4_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template5_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template6_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template7_selected');
			jQuery('.sqbv2-new-template-styles').addClass('template8_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template9_selected');

			jQuery('.question_details .sqbAddQuesTemplateImageOuter').hide();

			jQuery('.sqb_global_shadow_customizer').show();
			jQuery('.sqbv2_hide_border_for_template8').hide();

			jQuery('.background-color-one-to-four').css('color','#ffffff');

			jQuery('.Quiz--tabs-outer').addClass('sqb_collapse_left_menu');
			jQuery('#question_ans_empty_img').val(jQuery('#question_ans_empty_img_for_template8').val());
			jQuery('.sqb_template8_selected .collapse-menu-item').html('<a class="nav-link" href="javascript:void(0)"><label>Collapse Menu</label><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>');


			jQuery('#sqb_global_background_color').colorpicker('setValue', 'rgba(239,243,245,0.1)');
			jQuery("body").get(0).style.setProperty("--sqb_global_background_color", 'rgba(239,243,245,0.1)');
			
			jQuery('#sqb_global_temp_title_color').colorpicker('setValue', '#000000');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_color", '#000000');
			jQuery('#sqb_global_temp_title_line_height').val('1.2');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_line_height", '1.2');

			jQuery('#sqb_global_temp_description_color').colorpicker('setValue', '#000000');
			jQuery("body").get(0).style.setProperty("--sqb_global_description_color", '#000000');

			jQuery('#sqb_global_temp_question_ans_color').colorpicker('setValue', '#333333');
			jQuery("body").get(0).style.setProperty("--sqb_global_question_ans_color", '#333333');

			jQuery('.sqb_select_global_height option').removeAttr('selected');
			jQuery('.global-height-px').hide();
			jQuery('.global-height-vh').show();
			jQuery('.sqb_select_global_height option[value=vh]').attr('selected','selected');

			jQuery('.sqb_global_height_vh_input').val('50');
			jQuery('#sqb_global_height_vh').bootstrapSlider('setValue', '50');
			jQuery("body").get(0).style.setProperty("--sqb_global_height", '50vh');

			jQuery('.sqb_global_outer_width_input').val('1111');
			jQuery('#sqb_global_outer_width').bootstrapSlider('setValue','1111');
			jQuery("body").get(0).style.setProperty("--sqb_global_outer_width", '1111px');

			jQuery('.sqb_global_padding_input').val('84');
			jQuery('#sqb_global_padding').bootstrapSlider('setValue','84');
			jQuery("body").get(0).style.setProperty("--sqb_global_padding", '84px');

			jQuery('#sqb_global_background_image').text('linear-gradient(rgba(239,243,245,0.1),rgba(239,243,245,0.1)),url("'+sqb_site_url+'/wp-content/plugins/smartquizbuilder/includes/images/template8_ai.jpg")');
			jQuery('#sqb_global_background_image_url').val(sqb_site_url+'/wp-content/plugins/smartquizbuilder/includes/images/template8_ai.jpg');
			setTimeout(function(){
				jQuery("body").get(0).style.setProperty("--sqb_global_background_image", 'linear-gradient(rgba(239,243,245,0.1),rgba(239,243,245,0.1)),url("'+sqb_site_url+'/wp-content/plugins/smartquizbuilder/includes/images/template8_ai.jpg")');

				jQuery('#Start-Screen-Settings .take-quiz-btn').css('max-width','356px');
				jQuery('#sqb_lead_generation .continue_btn').css('width','461px');
				jQuery('#opt_btn_width').bootstrapSlider('setValue', 461);
			}, 500);

			jQuery("#template8_background_image").val('linear-gradient(rgba(239,243,245,0.1),rgba(239,243,245,0.1)),url("'+sqb_site_url+'/wp-content/plugins/smartquizbuilder/includes/images/template8_ai.jpg")');
			jQuery("#template8_background_image_url").val(sqb_site_url+'/wp-content/plugins/smartquizbuilder/includes/images/template8_ai.jpg');

			jQuery('.start_temp_static_div').addClass('sqb_start_screen_background_image');
			jQuery('.optin_template_html_preview_outer').addClass('sqb_start_screen_background_image');

			jQuery('.sqb_global_temp_title_font_weight_input').val('700');
			jQuery('#sqb_global_temp_title_font_weight').bootstrapSlider('setValue','700');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_font_weight", '700');

			/*jQuery('#sqb_global_temp_shadow_spread_radius_enable').trigger('click');
			jQuery('#sqb_global_temp_shadow_spread_radius').bootstrapSlider('setValue','1');
			jQuery("body").get(0).style.setProperty("--sqb_global_shadow_spread_radius", '1px');

			jQuery('#sqb_global_temp_shadow_vertical_length').bootstrapSlider('setValue','1');
			jQuery("body").get(0).style.setProperty("--sqb_global_shadow_vertical_length", '1px')
			
			jQuery('#sqb_global_temp_shadow_blur_radius_enable').trigger('click');
			jQuery('#sqb_global_temp_shadow_blur_radius').bootstrapSlider('setValue','3');
			jQuery("body").get(0).style.setProperty("--sqb_global_shadow_blur_radius", '3px');

			jQuery('#sqb_global_temp_shadow_horizontal_length_enable').trigger('click');
			jQuery('#sqb_global_temp_shadow_background_color_enable').trigger('click');*/

			jQuery('#sqb_global_temp_title_font_weight').bootstrapSlider('setValue',500);
			jQuery('.sqb_global_temp_title_font_weight_input').val('500');

			jQuery('input[name="sqb_button_template"][value="template3"]').trigger('click');
			jQuery('#Start-Screen-Settings .sqbv2-left-side-template').addClass('sqb-btn-template-3');
			jQuery("body").get(0).style.setProperty("--startbutton-background-color",'#ff7777');
			jQuery('#startbutton_backgroud_color').colorpicker('setValue', '#ff7777');

			jQuery('input[name="sqb_button_template_optin"][value="template3"]').trigger('click');
			jQuery('#sqb_lead_generation .sqbv2-left-side-template').addClass('sqb-btn-template-3');
			jQuery("body").get(0).style.setProperty("--optinbutton-background-color", '#ff7777');
			jQuery('#opt_button_backgroud_color').colorpicker('setValue', '#ff7777');

			jQuery('input[name="sqb_button_template_outcome"][value="template3"]').trigger('click');
			jQuery('#Outcome-Display .sqbv2-left-side-template').addClass('sqb-btn-template-3');
			jQuery("body").get(0).style.setProperty("--outcomebutton-background-color", '#ff7777');
			jQuery('#outcome_button_backgroud_color_div').colorpicker('setValue', '#ff7777');

			//jQuery('#sqb_global_temp_shadow_background_color').colorpicker('setValue', '#4b4242');
			jQuery("body").get(0).style.setProperty("--sqb_global_shadow_background_color", '#4b4242');

			jQuery('#continue_button_clr').colorpicker('setValue', '#ff7777');
			jQuery('#continue_button_hover_clr').colorpicker('setValue', '#ff7777');

		}else if(select_temp =="template9"){
			jQuery('.create-quiz-block').removeClass('sqb-1to4-template');
			select_temp_template9(); 

			
			jQuery('.sqbv2-new-template-styles').removeClass('template1_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template2_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template3_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template4_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template5_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template6_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template7_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template8_selected');
			jQuery('.sqbv2-new-template-styles').addClass('template9_selected');

			jQuery('.Element-Customizer-Section').hide();
			jQuery('.template9-customizer-options').show();

			jQuery('#sqb_global_temp_title_color').colorpicker('setValue', '#000000');
			jQuery('#sqb_global_temp_title_line_height').val('1');

			jQuery('.sqb_select_global_height option').removeAttr('selected');
			jQuery('.global-height-px').hide();
			jQuery('.global-height-vh').show();
			jQuery('.sqb_select_global_height option[value=vh]').attr('selected','selected');

			jQuery('.sqb_global_height_vh_input').val('100');
			jQuery('#sqb_global_height_vh').bootstrapSlider('setValue', '100');
			jQuery("body").get(0).style.setProperty("--sqb_global_height", '100vh');

			jQuery('#sqb_global_temp_description_color').colorpicker('setValue', '#000000');

			jQuery('#sqb_global_temp_question_ans_color').colorpicker('setValue', '#000000');
			var quiz_display = jQuery('input[name="quiz_display"]:checked').val();

			if(quiz_display == 'inpage'){
				sqb_get_start_temp('template2', 'start');
			}else{
				sqb_get_start_temp('template1', 'start');
			}
			sqb_get_lead_data('template9', 'lead');

			jQuery('#template9_focus_mode_start_screen').trigger('click');

			jQuery('.Quiz--tabs-outer').removeClass('sqb_template1_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template2_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template3_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template4_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template5_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template6_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template7_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template8_selected');
			jQuery('.Quiz--tabs-outer').addClass('sqb_template9_selected');

			jQuery('input[name="template9_start_screen_layout_option"][value="split_screen"]').trigger('click');
			jQuery('input[name="template9_lead_screen_layout_option"][value="split_screen"]').trigger('click');

			setTimeout(function(){
				jQuery('#startbutton_backgroud_color').colorpicker('setValue', '#000000');
				jQuery('.template9_start_temp_outer .take-quiz-btn').css('color', '#ffffff');
			}, 500);
			
			jQuery('.hide_for_template6').hide();

			var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
			if(quiz_type == 'poll'){
				/*Remove Question*/

				if(jQuery('.sqb_questions_wrapper .sqb_question_no').length == 1){
					var quiz_id = jQuery('#edit_id').val();
					var question_id = jQuery('.sqb_question_no').find('.sqb_question_enable_drag_drop').attr('data-id');
					jQuery.post(ajaxurl, {
						action: 'sqb_quiz_question_delete_single',
						quiz_id: quiz_id,
						question_id: question_id,   
					}, function(response) {	
				});	
				}

				

				jQuery('.left_side_question_list ul li').eq(jQuery('.delete-qa-row').closest('.sqb_question_no').index()).remove();
				 jQuery('.delete-qa-row').closest('.sqb_question_no').remove();
				 jQuery('.left_side_question_list ul .active').remove();
				 var question_id = jQuery('.delete-qa-row').closest('.sqb_question_no').find('.sqb_question_enable_drag_drop').attr('data-id');
				 jQuery('.question-list .dropdown-item[data-value="'+question_id+'"]').remove();
				 /**/
				sqb_add_more_question();

			}else if(quiz_type == 'form'){
				jQuery('#Outcome-Display .res_data_cont').remove();

				jQuery('.add_first_result').trigger('click');
				setTimeout(function(){
					sqb_replace_text('.take-quiz-btn', 'TAKE THIS QUIZ', 'CLICK HERE TO GET INSTANT ACCESS');
					jQuery('.Quiz-Outcome-Answer-outer .SQB-screen-head-info .Template-Customize-content').hide();
					jQuery('.quiz_right-content .outcome_name').val('Thank you for signing up');
					sqb_replace_text('.result_temp_outer .points_scored_result div', 'Your Result Type is [Outcome_Title]', 'Thank you for signing up!');
					jQuery('.sqbHideTemplateImage').trigger('click');
					jQuery('.delete-clone').hide();
					jQuery('.add_new_result').hide();
					jQuery('.save_new_result').hide();
					sqb_replace_text('.outcome_page_show .quiz_label','Outcome Title','Page Title');
					jQuery('#startbutton_backgroud_color_div').colorpicker('setValue', '#c761f8');
					jQuery('#opt_button_backgroud_color_div').colorpicker('setValue', '#c761f8');
					var sqb_button_template_outcome = jQuery('input[name="sqb_button_template_outcome"]:checked').val();
					if(sqb_button_template_outcome == 'default'){
						jQuery('#outcome_button_backgroud_color_div').colorpicker('setValue', '#c761f8');
					}
					jQuery('.Start-template-withbutton .take-quiz-btn').css('width','555px');
					jQuery('#startbtn_width').bootstrapSlider('setValue', '555');
					jQuery('.Start-template-withbutton .take-quiz-btn').css('padding','24px 0');
					jQuery('#startbtn_height').bootstrapSlider('setValue', '24');
					jQuery('.question-next-screen').hide();
					jQuery('.for-form-quiz').show();
					jQuery('.sqbShowTemplateImage').trigger('click');
					jQuery('.result_temp_outer .question_img_div .sqb_img_draggable').css('height','100%');

					jQuery('.result_temp_outer .Quiz-Template-content-inn').removeClass('mt-5');
					jQuery('.result_temp_outer .Quiz-Template-content-inn').addClass('mt-2');
				},3000);
			}

			jQuery('#sqb_global_temp_title_color').colorpicker('setValue', '#ffffff');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_color", '#ffffff');
			jQuery('#sqb_global_temp_title_line_height').val('1.2');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_line_height", '1.2');

			jQuery('#sqb_global_temp_description_color').colorpicker('setValue', '#ffffff');
			jQuery("body").get(0).style.setProperty("--sqb_global_description_color", '#ffffff');

			jQuery('#sqb_global_temp_question_ans_color').colorpicker('setValue', '#333333');
			jQuery("body").get(0).style.setProperty("--sqb_global_question_ans_color", '#333333');

			jQuery('.sqb_global_outer_width_input').val('2000');
			jQuery('#sqb_global_outer_width').bootstrapSlider('setValue','2000');
			jQuery("body").get(0).style.setProperty("--sqb_global_outer_width", '2000px');
		}else{

			jQuery('.sqbv2-new-template-styles').addClass('template1_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template2_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template3_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template4_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template5_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template6_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template7_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template8_selected');
			jQuery('.sqbv2-new-template-styles').removeClass('template9_selected');

			jQuery('.Quiz--tabs-outer').addClass('sqb_template1_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template2_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template3_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template4_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template5_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template6_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template7_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template8_selected');
			jQuery('.Quiz--tabs-outer').removeClass('sqb_template9_selected');

			jQuery('.create-quiz-block').addClass('sqb-1to4-template');
			select_temp_template1(); 
			change_all_screen_design_from_template7();
			jQuery('#sqb_global_temp_title_color').colorpicker('setValue', '#000000');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_color", '#000000');
			jQuery('#sqb_global_temp_title_line_height').val('1');
			jQuery("body").get(0).style.setProperty("--sqb_global_title_line_height", '1');

			jQuery('#sqb_global_temp_description_color').colorpicker('setValue', '#000000');
			jQuery("body").get(0).style.setProperty("--sqb_global_description_color", '#000000');

			jQuery('#sqb_global_temp_question_ans_color').colorpicker('setValue', '#000000');
			jQuery("body").get(0).style.setProperty("--sqb_global_question_ans_color", '#000000');

			jQuery('.sqb_global_outer_width_input').val('700');
			jQuery('.sqb_global_outer_width').val('700');
			jQuery("body").get(0).style.setProperty("--sqb_global_outer_width", '700px');
		}
	
}


function change_start_screen_to_template5(){
	var quiz_title = jQuery('#quiz_name').val();
	var quiz_desc = jQuery('#quiz_desc').val();
	jQuery('.Quiz-start-Template5 .Quiz-Template5-title').html('<div>'+quiz_title+'</div>');
	jQuery('.Quiz-start-Template5 .Quiz-Template5-description').html('<div><p style="font-family: "DM Sans",sans-serif; margin: 0; font-size: 24px; font-weight: 500; color: #fff; text-align: center;" data-mce-style="font-family: "DM Sans",sans-serif; margin: 0; font-size: 24px; font-weight: 500; color: #fff; text-align: center;">'+quiz_desc+'</p></div>');
}

function change_questions_design_to_template5(){
	
jQuery('.sqb_question_no').each(function(){

var ranting_level_count = '1';
if(jQuery(this).find('.Quiz-Template .question_add_answer_outer_div').find('.ans_type_rating').length > 0){
ranting_level_count = jQuery(this).find('.Quiz-Template .question_add_answer_outer_div').find('.sqb_ans_item').length;
}

jQuery(this).find('.outer_style3_span_first').remove();
jQuery(this).find('.outer_style3_span_second').remove();

jQuery(this).find('.Quiz-Template').removeClass('outer-style1');

if(jQuery(this).find('.question_div_outer .outer-style3').length > 0){
jQuery(this).find('.Quiz-Template').unwrap();
}

jQuery(this).find('.Quiz-Template').addClass('Quiz-Template-5');
jQuery(this).find('.Quiz-Template.sqb_question_enable_drag_drop').prepend('<div class="Quiz-Template5-inner"></div>');


jQuery(this).find('.Quiz-Template .Quiz-Template5-inner').prepend('<div class="Quiz-Template5-right-side"></div>');

var selected_question_type = jQuery(this).find('.question-type-card').find('button.dropdown-toggle').attr('data-value');
if(selected_question_type == 'single' || selected_question_type == 'multi') {
var add_answer_button_html = '<div class="question_add_answer_btn_div template5_question_add_answer_btn_div sqb_question_drag_drop_item"><div class="question_add_more_ans_btn" style="">Add New Answer</div></div>';
jQuery(this).find('.Quiz-Template .Quiz-Template5-inner .Quiz-Template5-right-side').prepend(add_answer_button_html);
}

if(jQuery(this).find('input[name="question_file_upload_settings"]').val() == ''){

var template5_next_button_html = '<div class="sqb_quiz_template5_next_button_outer"><div class="sqb_quiz_template5 sqb_next_btn single_next_btn sqb_tiny_mce_editor sqb_disable_tiny_mce_editor mce-content-body" style="display: inline-block; border-radius: 5px; background: rgb(130, 121, 189); color: rgb(255, 255, 255); height: auto; padding: 13px 15px; font-family: &quot;DM Sans&quot;, sans-serif; min-width: 90px; box-shadow: none; margin: 0px; text-decoration: none; line-height: normal; border: none; text-align: center; text-transform: initial; font-size: 16px; font-weight: 600; width: 128px; max-width: 100%; float: right; position: relative;" id="mce_28" contenteditable="true" spellcheck="false"><div>Next</div></div></div>';
jQuery(this).find('.Quiz-Template .Quiz-Template5-inner .Quiz-Template5-right-side').prepend(template5_next_button_html);
}

jQuery(this).find('.Quiz-Template .Quiz-Template5-inner .Quiz-Template5-right-side').prepend('<div class="Quiz-Template5-right-inner"></div>');

var quiz_content_card_html = jQuery(this).find('.Quiz-Template .question-type-card').html();
jQuery(this).find('.Quiz-Template .question-type-card').remove();
var question_rating_lable_div_html = jQuery(this).find('.Quiz-Template .question_rating_lable_div').html();
jQuery(this).find('.Quiz-Template .question_rating_lable_div').remove();

var question_add_answer_outer_div_html = jQuery(this).find('.Quiz-Template .question_add_answer_outer_div').html();
jQuery(this).find('.Quiz-Template .question_add_answer_outer_div').remove();

jQuery(this).find('.Quiz-Template .Quiz-Template5-inner .Quiz-Template5-right-side .Quiz-Template5-right-inner').prepend('<div class="question_add_answer_outer_div sqb_question_drag_drop_item ranting_level_'+ranting_level_count+' ui-sortable" style=""></div>');

jQuery(this).find('.Quiz-Template .Quiz-Template5-inner .Quiz-Template5-right-side .Quiz-Template5-right-inner .question_add_answer_outer_div').prepend(question_add_answer_outer_div_html);

jQuery(this).find('.Quiz-Template .Quiz-Template5-inner .Quiz-Template5-right-side .Quiz-Template5-right-inner').prepend('<div class="question_rating_lable_div sqb_question_drag_drop_item rating_info" style="display:none"></div>');
jQuery(this).find('.Quiz-Template .Quiz-Template5-inner .Quiz-Template5-right-side .Quiz-Template5-right-inner .question_rating_lable_div').prepend(question_rating_lable_div_html);

jQuery(this).find('.Quiz-Template .Quiz-Template5-inner .Quiz-Template5-right-side .Quiz-Template5-right-inner').prepend('<div class="quiz-content-card question-type-card question_type_wrapper 1" style="">');

jQuery(this).find('.Quiz-Template .Quiz-Template5-inner .Quiz-Template5-right-side .Quiz-Template5-right-inner .question-type-card').prepend(quiz_content_card_html);

jQuery(this).find('.sqbHideQuesTemplateImageOuter').remove();
jQuery(this).find('.sqbShowQuesTemplateImageOuter').remove();
jQuery(this).find('.sqbDeleteQuesTemplateImageOuter').remove();
jQuery(this).find('.sqbAddQuesTemplateImageOuter').remove();
jQuery(this).find('.question_img_div').remove();
jQuery(this).find('.questionTemplateVideoOuter').remove();
jQuery(this).find('.sqbHideQuesDescriptionOuter').remove();
jQuery(this).find('.sqbShowQuesDescriptionOuter').remove();
jQuery(this).find('.question_description').remove();
jQuery(this).find('.Quiz-Template .ans_layout_div').remove();

jQuery(this).find('.Quiz-Template .Quiz-Template5-inner').prepend('<div class="Quiz-Template5-left-side"></div>');
var quiz_details_html = '<div class="question_details">'+jQuery(this).find('.Quiz-Template .question_details').html()+'</div>';
jQuery(this).find('.Quiz-Template .question_details').remove();
jQuery(this).find('.Quiz-Template .Quiz-Template5-inner .Quiz-Template5-left-side').prepend(quiz_details_html);
});
jQuery(".sqb_img_draggable").draggable();
sqb_resizeable();
sqb_tiny_mce_editor();
}

function change_questions_design_from_template5(){
	
	jQuery('.sqb_question_no').each(function(){
	
	var ranting_level_count = '1';
	if(jQuery(this).find('.Quiz-Template .question_add_answer_outer_div').find('.ans_type_rating').length > 0){
	ranting_level_count = jQuery(this).find('.Quiz-Template .question_add_answer_outer_div').find('.sqb_ans_item').length;
	}
	
	jQuery(this).find('.Quiz-Template').removeClass('Quiz-Template-5');
	
	
	
	var inside_content = '<span class="sqbHideQuesTemplateImageOuter"><button class="sqbHideQuesTemplateImage">Hide Image</button></span><span class="sqbShowQuesTemplateImageOuter" style="display:none"><button class="sqbShowQuesTemplateImage">Show Image</button></span><span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span><span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'+sqb_plugin_url+'/smartquizbuilder/includes/images/sqb_quiz.png">Add Image</button></span><div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_4_1621848348302_1221"><img class="sqb_img_draggable sbq_img_2021_4_1621848348302_1221 ui-draggable ui-draggable-handle" src="'+sqb_plugin_url+'/smartquizbuilder/includes/images/sqb_quiz.png" style="position: relative;"><span data-class="sbq_img_2021_4_1621848348302_1221" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div><div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="question_video_url" value=""><input type="hidden" class="question_show_video" value="N"><input type="hidden" class="question_video_link_type" value="0"><input type="hidden" class="question_video_link_type_text" value="Source"><input type="hidden" class="question_video_aspect" value="1"><a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a><div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div><span class="sqbHideQuesDescriptionOuter"><button class="sqbHideQuesDescription">Hide Description</button></span><span class="sqbShowQuesDescriptionOuter" style="display:none"><button class="sqbShowQuesDescription">Show Description</button></span><div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" id="mce_20" contenteditable="true" spellcheck="false" style="position: relative;"><div>Enter any additional information about the quiz</div></div>';
	jQuery(this).find('.Quiz-Template .question_details').append(inside_content);
	var quiz_details_html = '<div class="question_details">'+jQuery(this).find('.Quiz-Template .question_details').html()+'</div>';
	var ans_image_settings = '<div class="sqb-ans-image-options"><div class="sqb-image-size-dropdown"><select class="ans-image-size-options" name="ans-image-size-options"><option value="cover">Cover Image</option><option value="contain">Contain</option><option value="100_100" data-height="100" data-width="100">100x100</option><option value="200_200" data-height="200" data-width="200">200x200</option><option value="300_300" data-height="300" data-width="300">300x300</option><option value="custom">Custom Size</option></select></div><div class="sqb-image-custom-size-option sqb-custom-size-cover"><!-- <input id="sqb_image_custom_size" class="slider sqb-range-slider" data-slider-id="sqb_img_size_wrapper" type="text" data-slider-min="100" data-slider-max="1200" data-slider-step="1" data-slider-value="300"> --><div class="sqb-que-img-height-width"><div class="sqb-que-img-width"><label for="sqb_image_custom_width">Width (PX)</label><input type="number" min="80" name="sqb_image_custom_width" id="sqb_image_custom_width" value="150"></div><div class="sqb-que-img-height"><label for="sqb_image_custom_height">Height (PX)</label><input type="number" min="80" name="sqb_image_custom_height" id="sqb_image_custom_height" value="150"></div></div></div><div class="sqb-image-text-on-off"><div class="checkbox-custom-style"><input type="checkbox" class="custom-checkbox-input custom-checkbox-input-hide-ans-label" name="sqb_ans_show_label" value="Y"><span class="custom--checkbox"></span></div><label>Hide answer title in frontend</label></div></div>';
	var ans_layout_div = '<div class="ans_layout_div" style="display:flex"><div class="answer-view-options"><label>Choose layout:</label><div class="sqb_ans_layout_standard  ans_layout_typw  selected-op "><i class="fa fa-bars" aria-hidden="true"></i></div><div class="sqb_ans_layout_mulitple ans_layout_typw  "><i class="fa fa-th-large" aria-hidden="true"></i></div><div class="sqb_ans_layout_three_in_row ans_layout_typw   "><i class="fa fa-th" aria-hidden="true"></i></div></div><div class="sqb_ans_add_image"><div class="checkbox-custom-style"><input type="checkbox" class="custom-checkbox-input" name="sqb_ans_with_img_checkbox" n=""><span class="custom--checkbox"></span></div><label>Answer With Image</label><div class="dropdown-link-style dropdown"><button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#" style="display:none"><div class="checkbox-custom-style"><input type="checkbox" class="custom-checkbox-input " name="multiple_correct_ans"><span class="custom--checkbox"></span></div> Show Multiple Correct Answers</a><a class="dropdown-item" href="#"><div class="checkbox-custom-style"><input type="checkbox" class="custom-checkbox-input " name="allow_skip_ques"><span class="custom--checkbox"></span></div> Allow students to skip questions</a><a class="dropdown-item delete-qa-row" style="display:none"><i class="fa fa-trash" aria-hidden="true"></i></a></div></div>'+ans_image_settings+'</div></div>';
	
	var quiz_content_card_html = jQuery(this).find('.Quiz-Template .question-type-card').html();
	jQuery(this).find('.Quiz-Template .question-type-card').remove();
	var question_rating_lable_div_html = jQuery(this).find('.Quiz-Template .question_rating_lable_div').html();
	jQuery(this).find('.Quiz-Template .question_rating_lable_div').remove();
	var question_add_answer_outer_div_html = jQuery(this).find('.Quiz-Template .question_add_answer_outer_div').html();
	jQuery(this).find('.Quiz-Template .question_add_answer_outer_div').remove();
	
	
	var quiz_details_html = quiz_details_html;
	var ans_layout_div = ans_layout_div;
	var question_type_card = '<div class="quiz-content-card question-type-card question_type_wrapper 1" style="">'+quiz_content_card_html+'</div>';
	var question_rating_lable_div = '<div class="question_rating_lable_div sqb_question_drag_drop_item rating_info" style="display:none">'+question_rating_lable_div_html+'</div>';
	var question_add_answer_outer_div = '<div class="question_add_answer_outer_div sqb_question_drag_drop_item ranting_level_'+ranting_level_count+' ui-sortable" style="">'+question_add_answer_outer_div_html+'</div>';
	
	var final_html =  quiz_details_html+ans_layout_div+question_type_card+question_rating_lable_div+question_add_answer_outer_div;

	jQuery(this).find('.Quiz-Template .Quiz-Template5-inner').remove();
	jQuery(this).find('.Quiz-Template.sqb_question_enable_drag_drop').prepend(final_html);

	});
	jQuery(".sqb_img_draggable").draggable();
	sqb_resizeable();
	sqb_tiny_mce_editor();
}


function change_optin_screen_design_from_template5(){
	var optintempSlider = jQuery("#opt_in_temp_width");
	optintempSlider.bootstrapSlider('setValue', 750);
	jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('max-width','750px');

	jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('background-color','#fff');
	jQuery('#opt_in_temp_backgroud_color').colorpicker('setValue', '#fff');
	jQuery('#opt_in_temp_backgroud_color_div').colorpicker('setValue', '#fff');
	
	jQuery('.optin_template_html_preview_outer').find('.Quiz-Template-title').css('color','#333');
	jQuery('.optin_template_html_preview_outer').find('.sqb_opt_in_h6').css('color','#333');
	jQuery('.optin_template_html_preview_outer').find('.text_privacy_policy').css('color','#333');
	jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('text-align','left');
	jQuery('#opt_in_temp_alignment  option[value="left"]').prop("selected", true);
	
	jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('border','1px solid #ddd');
	jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('border-radius','7px');
	jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('min-height','');
	jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template .Quiz-Template-title').css('margin-top','0px');
	jQuery(".sqb_img_draggable").draggable();
	sqb_resizeable();
	sqb_tiny_mce_editor();
}

function change_optin_screen_design_to_template5(){
	
	var optintempSlider = jQuery("#opt_in_temp_width");
	optintempSlider.bootstrapSlider('setValue', 1800);
	jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('max-width','1800px');

	jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('background-color','#000');
	jQuery('#opt_in_temp_backgroud_color').colorpicker('setValue', '#000');  
	jQuery('#opt_in_temp_backgroud_color_div').colorpicker('setValue', '#000');
	
	jQuery('.optin_template_html_preview_outer').find('.Quiz-Template-title').css('color','#fff');
	jQuery('.optin_template_html_preview_outer').find('.sqb_opt_in_h6').css('color','#fff');
	jQuery('.optin_template_html_preview_outer').find('.text_privacy_policy').css('color','#fff');
	jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('text-align','center');
	
	jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('border','none');
	jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('border-radius','0');
	jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template').css('min-height','760px');
	//jQuery('.optin_template_html_preview_outer').find('.Quiz-Optin-Template .Quiz-Template-title').css('margin-top','12%');
	jQuery(".sqb_img_draggable").draggable();
	sqb_resizeable();
	sqb_tiny_mce_editor();
}

function change_outcome_screen_design_from_template5(){
	
	jQuery('.res_data_cont').each(function(){
	jQuery(this).find('.Quiz-Template').removeClass('Quiz-result-Template5');
	jQuery(this).find('.Quiz-Template').attr('style','');
	
	var outcome_title = jQuery(this).find('.Quiz-result-Template5-left').html();
	var outcome_description = jQuery(this).find('.Quiz-result-Template5-right .Quiz-Template5-description').html();
	var outcome_screen = outcome_title+'<span class="sqbHideTemplateImageOuter"><button class="sqbHideTemplateImage">Hide Image</button></span><span class="sqbShowTemplateImageOuter" style="display:none"><button class="sqbShowTemplateImage">Show Image</button></span><div class="question_img_div Quiz-Template-image img_outer" id="result_temp_id"><img class="%%CURRENTDATETIMERANDOMIMG%% sqb_img_draggable" src="'+sqb_plugin_url+'/smartquizbuilder/includes/images/outcome2.jpg"><span data-class="%%CURRENTDATETIMERANDOMIMG%%" class="question_img_upload sbq_change_img "><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer outcomeTemplateVideoOuter" data-type="outcome" style="display:none"><input type="hidden" class="outcome_video_url" value=""><input type="hidden" class="outcome_show_video" value="N"><input type="hidden" class="outcome_video_link_type" value="0"><input type="hidden" class="outcome_video_link_type_text" value="Source"><input type="hidden" class="outcome_video_aspect" value="1"><a href="javascript:void(0)" class="outcomeTemplateVideoOuterLinkOver insertOutcomeVideo"  data-type="outcome" >1</a><div class="video-add-link outcomeTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertOutcomeVideo"  data-type="outcome" ><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="outcomeTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div><div class="external-videoWrapper outcomeTemplateCommonVideoOuter" style="display:none"><video width="400" controls></video></div></div><div class="Quiz-Template-content"><span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span><span class="sqbShowOutcomeDescriptionOuter" style="display:none"><button class="sqbShowOutcomeDescription">Show Description</button></span><div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid"><div class="sqb_tiny_mce_editor" >'+outcome_description+'</div><br></div><div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"><span class="sqb_backend_show sqb_remove_section" data-id="result_temp_btnid"><i class="fa fa-close" aria-hidden="true"></i></span><div class="take-quiz-btn sqb_tiny_mce_editor" style="position: relative; width: 700px; padding-top: 10px; padding-bottom: 10px; background-color: rgb(255, 99, 77);border-radius: 8px;color: #fff;padding: 14px 15px;font-family: sans-serif;margin: 0 0 15px 0;line-height: normal;text-align: center;text-transform: uppercase;font-size: 22px;font-weight: 600;"><div>Continue</div></div></div></div>';
	jQuery(this).find('.card-body link').attr('href',sqb_plugin_url+'/smartquizbuilder/includes/admin/../../includes/templates/result/template2/template2.css');
	jQuery(this).find('.result_temp_outer').html('');
	jQuery(this).find('.result_temp_outer').append(outcome_screen);
	jQuery(this).find('.result_temp_outer').attr('style','max-width: 700px; border-width: 1px; text-align: left; border-style: solid; border-radius: 7px;padding: 20px 30px;display: inline-block;color: #333;font-size: 16px;font-weight: normal;line-height: 1.4;border: 1px solid #ddd;');
	jQuery(this).find('.points_scored_result').attr('style','line-height: 1;font-size: 22px;color: #f56640;font-weight: 600;padding: 10px 0;text-align: center;margin-bottom: 10px;');
	});
	
	jQuery('.result_temp_outer .Quiz-Template-content p').attr('style','');
	jQuery('.result_temp_outer .Quiz-Template-content p').css('text-align','center');
	
	jQuery(".sqb_img_draggable").draggable();
	sqb_resizeable();
	sqb_tiny_mce_editor();
}

function change_outcome_screen_design_to_template5(){
	jQuery('.res_data_cont').each(function(){
	jQuery(this).find('.Quiz-Template').addClass('Quiz-result-Template5');
	jQuery(this).find('.Quiz-Template').attr('style','max-width: 1800px; text-align: left;');
	
	var outcome_title = jQuery(this).find('.points_scored_result').html();
	var outcome_description = jQuery(this).find('.Quiz-Template-content-inn .sqb_tiny_mce_editor').html();
	
	var  outcome_screen = '<div class="Quiz-result-Template5-inner"><div class="Quiz-result-Template5-left" ><div class="points_scored_result sqb_tiny_mce_editor">'+outcome_title+'</div></div><div class="Quiz-result-Template5-right" id="result_temp_contentid"><input type="hidden" class="outcome_video_url" value=""><input type="hidden" class="outcome_show_video" value="N"><input type="hidden" class="outcome_video_link_type" value="0"><input type="hidden" class="outcome_video_link_type_text" value="Source"><input type="hidden" class="outcome_video_aspect" value="1"><div class="Quiz-Template5-description sqb_tiny_mce_editor">'+outcome_description+'</div><div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"><span class="sqb_backend_show sqb_remove_section" data-id="result_temp_btnid"><i class="fa fa-close" aria-hidden="true"></i></span><div class="quiz-Template5-btn take-quiz-btn sqb_tiny_mce_editor" style="width: 420px;"><div>CONTINUE</div></div></div></div></div></div></div>'; 
	
	jQuery(this).find('.card-body link').attr('href',sqb_plugin_url+'/smartquizbuilder/includes/admin/../../includes/templates/result/template5/template5.css');
	jQuery(this).find('.result_temp_outer').html('');
	jQuery(this).find('.result_temp_outer').addClass('Quiz-result-Template5');
	jQuery(this).find('.result_temp_outer').append(outcome_screen);
	});
	jQuery(".sqb_img_draggable").draggable();
	sqb_resizeable();
	sqb_tiny_mce_editor();	
}

function sqb_check_if_template5_selected(tab_id){
		if(jQuery('input[name="select_temp"]:checked').val() == 'template5'){
			jQuery("#start_temp_width").bootstrapSlider('setAttribute','max', 2000);
			jQuery("#result_temp_width").bootstrapSlider('setAttribute','max', 2000);
			jQuery("#question_temp_width").bootstrapSlider('setAttribute','max', 2000);
			jQuery("#opt_in_temp_width").bootstrapSlider('setAttribute','max', 2000);
			jQuery('.Template5_customizer').show();
		} else {
			jQuery("#start_temp_width").bootstrapSlider('setAttribute','max', 2000);
			jQuery("#result_temp_width").bootstrapSlider('setAttribute','max', 2000);
			jQuery("#question_temp_width").bootstrapSlider('setAttribute','max', 2000);
			jQuery("#opt_in_temp_width").bootstrapSlider('setAttribute','max', 2000);
			jQuery('.Template5_customizer').hide();
			jQuery('.Template5_customizer.sqb_common_customizer').show();
		}
		
		if(tab_id == 'Start-Screen-Settings'){
			  var temp_global_theme_enable = jQuery("#sqb_enable_global_setting_each_screen").prop('checked');
			if(temp_global_theme_enable){
				
			}else{
				setTimeout(function(){setStartCustmizerValues();}, 500);
			}
			var select_temp = jQuery('input[name="select_temp"]:checked').val();
			
			if(select_temp == 'template5'){
					jQuery('#Start-Screen-Settings .Template-Customizer-Section .customizer_innner_sections .Template-Customize-element').hide();
					jQuery('#Start-Screen-Settings .Element-Customizer-Section').hide();
					jQuery('#Start-Screen-Settings .Template-Customizer-Section .customizer_innner_sections .Template5_customizer').show();
					jQuery('#Start-Screen-Settings .btn_customizer .customizer_innner_sections .start-template5-radius').show();
					jQuery('.sqb_edit_template').hide();
					jQuery('.start_template_html_preview_outer').addClass('Quiz-start-Template5-outer');
					jQuery('#Start-Screen-Settings .templates_message').hide();
					jQuery('#Start-Screen-Settings .template5_message').show();
					jQuery('#Start-Screen-Settings .sqb_common_customizer').show();
					jQuery('#Quiz-Screen-Settings .sqb_common_customizer').show();
					jQuery('.template_5_background_img_customizer').show();
					if(jQuery('#enable_start_screen_background_image').prop('checked')){
						jQuery('.start_screen_title_bg_color').parent().show();
						jQuery('.start_screen_change_bg_image').parent().show();
						jQuery('.start_screen_bg_image_size').parent().show();
						//jQuery('.start_screen_title_bg_opacity').parent().show();
					}
				} else {
					jQuery('#Start-Screen-Settings .Template-Customizer-Section .customizer_innner_sections .Template-Customize-element').show();
					jQuery('#Start-Screen-Settings .Template-Customizer-Section .customizer_innner_sections .Template5_customizer').hide();
					jQuery('#Start-Screen-Settings .Template-Customizer-Section .customizer_innner_sections .Template5_customizer.sqb_common_customizer').show();
					
					var template_start_screen = jQuery('.Quiz-Start-Template2').hasClass('Start-template-withbutton');
					if(template_start_screen){
						jQuery('.button-template-hide').hide();
						jQuery('#Start-Screen-Settings .btn_customizer .customizer_innner_sections').show();
					}else{
						//jQuery('#Start-Screen-Settings .btn_customizer .customizer_innner_sections').hide();
						if(select_temp == 'template9'){
							jQuery('#Start-Screen-Settings .Element-Customizer-Section').hide();
							jQuery('.button-template-hide').hide();
						}else{
							//jQuery('.button-template-hide').show();
							//jQuery('#Start-Screen-Settings .Element-Customizer-Section').show();
						}
					}

					
					jQuery('#Start-Screen-Settings .btn_customizer .customizer_innner_sections .start-template5-radius').hide();
					jQuery('.sqb_edit_template').show();
					jQuery('.start_template_html_preview_outer').removeClass('Quiz-start-Template5-outer');
					jQuery('#Start-Screen-Settings .templates_message').show();
					jQuery('#Start-Screen-Settings .template5_message').hide();
					
					if(select_temp == 'template6'){
						jQuery('#Start-Screen-Settings .sqb_common_customizer').hide();
					}else{
						jQuery('#Start-Screen-Settings .sqb_common_customizer').show();
					}

					jQuery('#Quiz-Screen-Settings .sqb_common_customizer').show();
					jQuery('.template_5_background_img_customizer').hide();
					jQuery('.start_screen_title_bg_color').parent().hide();
					jQuery('.start_screen_change_bg_image').parent().hide();
					jQuery('.start_screen_bg_image_size').parent().hide();
					//jQuery('.start_screen_title_bg_opacity').parent().hide();
				}
		}
		
		if(tab_id == 'Quiz-Screen-Settings'){
			var select_temp = jQuery('input[name="select_temp"]:checked').val();
			if(select_temp == 'template5'){
					jQuery('#Quiz-Screen-Settings .Template-Customizer-Section .customizer_innner_sections .Template-Customize-element').hide();
					jQuery('#Quiz-Screen-Settings .Element-Customizer-Section').hide();
					jQuery('#Quiz-Screen-Settings .Template-Customizer-Section .customizer_innner_sections .Template5_customizer').show();
					jQuery('#Start-Screen-Settings .sqb_common_customizer').show();
					jQuery('#Quiz-Screen-Settings .sqb_common_customizer').show();
					
					var question_temp_height = jQuery('.sqb_questions_wrapper').find('.Quiz-Template5-inner').css('min-height');
					if(typeof question_temp_height != 'undefined' && question_temp_height != ''){
					sqb_question_temp_height = parseFloat(question_temp_height);
					jQuery("#question_temp_height").bootstrapSlider('setValue', sqb_question_temp_height);
					}
					jQuery('.question_div_inner .question_add_more_ans_btn').hide();
					jQuery('.Quiz-Template5-inner .template5_question_add_answer_btn_div .question_add_more_ans_btn').show();
					jQuery('.template_5_background_img_customizer').show();
					if(jQuery('#enable_question_screen_background_image').prop('checked')){
						jQuery('.question_screen_title_bg_color').parent().show();
						jQuery('.question_screen_change_bg_image').parent().show();
						jQuery('.question_screen_bg_image_size').parent().show();
					}
				} else {
					jQuery('#Quiz-Screen-Settings .Template-Customizer-Section .customizer_innner_sections .Template-Customize-element').show();
					if(select_temp == 'template9'){
						jQuery('#Quiz-Screen-Settings .Element-Customizer-Section').hide();
					}else{
						jQuery('#Quiz-Screen-Settings .Element-Customizer-Section').show();
					}
					jQuery('#Quiz-Screen-Settings .Template-Customizer-Section .customizer_innner_sections .Template5_customizer').hide();
					jQuery('#Quiz-Screen-Settings .Template-Customizer-Section .customizer_innner_sections .Template5_customizer.sqb_common_customizer').show();

					jQuery('#Start-Screen-Settings .sqb_common_customizer').show();
					jQuery('#Quiz-Screen-Settings .sqb_common_customizer').show();

					//jQuery('.question_div_inner .question_add_more_ans_btn').show();

					jQuery('.template_5_background_img_customizer').hide();
					
					jQuery('.question_screen_title_bg_color').parent().hide();
					jQuery('.question_screen_change_bg_image').parent().hide();
					jQuery('.question_screen_bg_image_size').parent().hide();
				}
		}
		
		if(tab_id == 'Result-Screen-Settings' || tab_id == 'Quiz-Screen-Settings'){
			
			var select_temp = jQuery('input[name="select_temp"]:checked').val();
			if(select_temp == 'template5'){
					jQuery('#Result-Screen-Settings .customizer_innner_sections .Template-Customize-element').hide();
					jQuery('#Result-Screen-Settings .Element-Customizer-Section').hide();
					jQuery('#Result-Screen-Settings .customizer_innner_sections .Template5_customizer').show();
					//jQuery('#Start-Screen-Settings .sqb_common_customizer').show();
					jQuery('#Result-Screen-Settings .sqb_common_customizer').show();
					
					/*var question_temp_height = jQuery('.sqb_questions_wrapper').find('.Quiz-Template5-inner').css('min-height');
					if(typeof question_temp_height != 'undefined' && question_temp_height != ''){
					sqb_question_temp_height = parseFloat(question_temp_height);
					jQuery("#question_temp_height").bootstrapSlider('setValue', sqb_question_temp_height);
					}*/
					jQuery('.template_5_background_img_customizer').show();
					if(jQuery('#enable_outcome_screen_background_image').prop('checked')){
						jQuery('.outcome_screen_title_bg_color').parent().show();
						jQuery('.outcome_screen_change_bg_image').parent().show();
						jQuery('.outcome_screen_bg_image_size').parent().show();
					}
				} else {
					jQuery('#Result-Screen-Settings .customizer_innner_sections .Template-Customize-element').show();
					if(select_temp == 'template9'){
						jQuery('#Quiz-Screen-Settings .Element-Customizer-Section').hide();
					}else{
						jQuery('#Quiz-Screen-Settings .Element-Customizer-Section').show();
					}
					jQuery('#Result-Screen-Settings .customizer_innner_sections .Template5_customizer').hide();
					jQuery('#Result-Screen-Settings .customizer_innner_sections .Template5_customizer.sqb_common_customizer').show();
					//jQuery('#Start-Screen-Settings .sqb_common_customizer').show();
					jQuery('#Result-Screen-Settings .sqb_common_customizer').show();
					
					jQuery('.template_5_background_img_customizer').hide();
					jQuery('.outcome_screen_title_bg_color').parent().hide();
					jQuery('.outcome_screen_change_bg_image').parent().hide();
					jQuery('.outcome_screen_bg_image_size').parent().hide();
				}
		}
		
if(tab_id == 'Opt-Screen-Settings'){
			
			var select_temp = jQuery('input[name="select_temp"]:checked').val();
			if(select_temp == 'template5'){
					jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').addClass('Quiz-Optin-Template5_outer');
					//not showing image and video image options in lead screen
					//jQuery('#Opt-Screen-Settings .customizer_innner_sections .Template-Customize-element').hide();
					jQuery('#Opt-Screen-Settings .Element-Customizer-Section').hide();
					jQuery('#Opt-Screen-Settings .customizer_innner_sections .Template5_customizer').show();
					//jQuery('#Start-Screen-Settings .sqb_common_customizer').show();
					jQuery('#Opt-Screen-Settings .sqb_common_customizer').show();
					
					/*var question_temp_height = jQuery('.sqb_questions_wrapper').find('.Quiz-Template5-inner').css('min-height');
					if(typeof question_temp_height != 'undefined' && question_temp_height != ''){
					sqb_question_temp_height = parseFloat(question_temp_height);
					jQuery("#question_temp_height").bootstrapSlider('setValue', sqb_question_temp_height);
					}*/
				} else {
					jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').removeClass('Quiz-Optin-Template5_outer');
					jQuery('#Opt-Screen-Settings .customizer_innner_sections .Template-Customize-element').show();
					if(select_temp == 'template9'){
						jQuery('#Quiz-Screen-Settings .Element-Customizer-Section').hide();
					}else{
						jQuery('#Quiz-Screen-Settings .Element-Customizer-Section').show();
					}
					jQuery('#Opt-Screen-Settings .customizer_innner_sections .Template5_customizer').hide();
					jQuery('#Opt-Screen-Settings .customizer_innner_sections .Template5_customizer.sqb_common_customizer').show();
					//jQuery('#Start-Screen-Settings .sqb_common_customizer').show();
					jQuery('#Opt-Screen-Settings .sqb_common_customizer').show();
				}
		}
}	

function change_all_screen_design_from_template7(){
	jQuery('#Start-Screen-Settings').find('.start_temp_outer').attr('style','');
	jQuery('#Start-Screen-Settings').find('.start_temp_outer').removeClass('outer-style7');
	//jQuery('#Start-Screen-Settings').find('.sqbShowStartTemplateImage').trigger('click');
	
	jQuery('#Result-Screen-Settings').find('.result_temp_outer').attr('style','');
	jQuery('#Result-Screen-Settings').find('.result_temp_outer').removeClass('outer-style7');
	jQuery('#Result-Screen-Settings').find('.result_temp_outer').find('.outcome_products_section').remove();
	jQuery('#Result-Screen-Settings').find('.result_temp_outer').find('.take-quiz-btn').attr('style','');
	//jQuery('#Result-Screen-Settings').find('.sqbShowTemplateImage').trigger('click');
	
	jQuery('#Opt-Screen-Settings').find('.Quiz-Optin-Template.quiz_comon_template').removeClass('outer-style7');
	jQuery('#Opt-Screen-Settings').find('.Quiz-Optin-Template.quiz_comon_template').attr('style','');

	jQuery('#Quiz-Screen-Settings').find('.skip-questions-div.template7-skip-question-button').hide();
	jQuery('#Quiz-Screen-Settings').find('.choose-layout-div.template7-choose-layout-section').hide();
	jQuery('#Quiz-Screen-Settings').find('.sqb_ans_layout_standard').trigger('click');
	jQuery('#Quiz-Screen-Settings').find('.skip-question-action').hide();
	//jQuery('#Quiz-Screen-Settings').find('.continue-question-action').hide();
	
	jQuery('#Quiz-Screen-Settings').find('.skip-question-action').hide();
	//jQuery('#Quiz-Screen-Settings').find('.continue-question-action').hide();
	
	jQuery('#Quiz-Screen-Settings').find('.Quiz-Template.sqb_question_enable_drag_drop').removeClass('outer-style7');
	
	var prevoius_template = '';
	if(jQuery('#Start-Screen-Settings').find('.start_temp_outer').hasClass('outer-style7') || jQuery('#Result-Screen-Settings').find('.result_temp_outer').hasClass('outer-style7') || jQuery('#Opt-Screen-Settings').find('.Quiz-Optin-Template.quiz_comon_template').hasClass('outer-style7') || jQuery('#Quiz-Screen-Settings').find('.Quiz-Template.sqb_question_enable_drag_drop').hasClass('outer-style7')){
		prevoius_template = "template7";
	}
	
	setTimeout(function(){
		jQuery('#Quiz-Screen-Settings .sqb_question_no').each(function(){
			jQuery(this).find('.sql_ans_text').removeClass('hide_answer_text');
			if(jQuery(this).find('[name="sqb_ans_show_label"]').prop('checked')){
				jQuery(this).find('[name="sqb_ans_show_label"]').trigger('click');
			}
			jQuery(this).find('.sql_ans_text').show();
			
			if(jQuery(this).find('[name="sqb_ans_with_img_checkbox"]').prop('checked')){
				jQuery(this).find('[name="sqb_ans_with_img_checkbox"]').trigger('click');
			}
		}); 
	},1000);
	
}
/***************/

function sqb_delete_outcome_screen_products(element){
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
				jQuery(element).closest('.sqb_ans_item').remove();
			}
		});	
}

function sbq_quiz_any_element_remvoe_by_id(){
	jQuery(document).on('click','.sqb_remove_section',function(){
		var quiz_outcome_num =jQuery("#get_all_outcome_count").val();
		
		if(jQuery(this).hasClass('sqb_remove_outcome_product')){
		sqb_delete_outcome_screen_products(this);
		return false;
		}		
		
		var sqb_delete_obj = this;
		var sqb_element_id = jQuery(this).attr('data-id');		

		if(sqb_element_id == 'result_temp_contentid' || sqb_element_id == 'result_temp_btnid'){
			jQuery('.res_data_cont.active #'+sqb_element_id).html('');
			return;
		}


		var outcome_id = jQuery(this).data('key');		
		var current_obj = jQuery('#'+sqb_element_id);
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
				var oc_count = parseInt(quiz_outcome_num)-1;
				
				jQuery("#get_all_outcome_count").val(oc_count);
				if(jQuery(sqb_delete_obj).hasClass('sqb_ans_delete_btn')){
					var matrix_answer_status = false;
					if(jQuery(sqb_delete_obj).hasClass('sqb-matrix-delete-row')){
						var matrix_answer_status = true;
					}
					
					if(matrix_answer_status){
						var answer_id = jQuery(sqb_delete_obj).closest('.answer_matrix_options_wrapper').find('#'+sqb_element_id).attr('data-id');
					}else{	
						var answer_id = jQuery('.sqb_question_no.active').find('#'+sqb_element_id).attr('data-id');
					}
					
					// hide outcome mapping section on the behafe of answer
					var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
					var has_outcome = 0;
					
					if(isNaN(answer_id))	{
						has_outcome = 0;
					}else{
						if(matrix_answer_status){
							has_outcome = 0;
						}else{	
							has_outcome = jQuery(sqb_delete_obj).closest('.sqb_question_enable_drag_drop').find('.assessment_outcome_connect').find('.quiz-content-card[data-answer-id="'+answer_id+'"]').length;
						}
						//has_outcome = jQuery(sqb_delete_obj).closest('.sqb_question_enable_drag_drop').find('.assessment_outcome_connect').find('.quiz-content-card[data-answer-id="'+answer_id+'"]').length;
					}
					
					if(has_outcome == 0){
						var answer_section_id = jQuery(sqb_delete_obj).closest('.sqb_ans_item').attr('id');
						jQuery('.sqb_question_no.active').find('.assessment_outcome_connect').find('.quiz-content-card.ans_id_attr_'+answer_section_id).remove();
						if(answer_id){
							jQuery('.sqb_question_no.active').find('.assessment_outcome_connect').find('.quiz-content-card[data-answer-id="'+answer_id+'"]').remove();
						}
					}else{
						jQuery('.sqb_question_no.active').find('.assessment_outcome_connect').find('.quiz-content-card[data-answer-id="'+answer_id+'"]').remove();
						if(answer_id){
							jQuery('.sqb_question_no.active').find('.assessment_outcome_connect').find('.quiz-content-card[data-answer-id="'+answer_id+'"]').remove();
						}
					}
					if (typeof answer_id === "undefined") {
							
					}else{
							
							jQuery.post(ajaxurl, {
								action: 'sqb_quiz_answer_delete_single',
								answer_id: answer_id,   
								}, function(response) {	
									response = JSON.parse(response);
							});
							
							
					}		
					if(matrix_answer_status){
						jQuery(sqb_delete_obj).closest('.answer_matrix_options_wrapper').find('#'+sqb_element_id).remove();
					}else{
						jQuery('.sqb_question_no.active').find('#'+sqb_element_id).remove();
					}
					//jQuery('.sqb_question_no.active').find('#'+sqb_element_id).remove();
					return false;
				}
				
				jQuery('.left_side_outcome_list ul .active').parent().remove();	
				jQuery('.left_side_outcome_list ul li a').trigger('click');
				/*var i = 1;
				jQuery('.left_side_outcome_list ul li').each(function(){
					jQuery(this).find('a').text('Outcome '+i);
					if(i == 1){
						jQuery('.left_side_outcome_list ul li a').trigger('click');
					}
					i++;
				})*/

				
				var outcome_action = 'deleteOutcome';
				jQuery(this).closest('.res_data_cont').remove();
				if(jQuery('.res_data_cont').length < 1){
				jQuery('#Result-Screen-Settings .formula-question-list').hide();
				}
				
				if(typeof outcome_id != 'undefined' && outcome_id != '' && outcome_id != 0){
					var quiz_id = jQuery('#edit_id').val();
					jQuery.post(ajaxurl, {
						action: 'sqb_outcometemp',
						id: outcome_id ,
						outcome_action: outcome_action ,
						quiz_id: quiz_id ,
					}, function(response) {

						response = JSON.parse(response);


						if((response.reload_page) && (response.reload_page == 'Y')){
								window.location.href = sqb_get_url_without_edit_quiz_query_string()+"&sqb_outcome_page="+1;
								return false;
							}

                          jQuery('input[name="outcome_result_checkbox"][value="'+outcome_id+'"]').closest('li').remove();
					})
				}
				var check_length = jQuery('.left_side_outcome_list .nav li').length;
				if(check_length == 0){
					jQuery('.quiz_result_inn .no_result').show();
				}
				//jQuery('#'+sqb_element_id).remove();
			}
		});				
	});
	
	jQuery(document).on('click','.hover_close_btn',function(){
		
		var current_obj = jQuery(this).parents('.sqb_question_drag_drop_item');
		
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
				jQuery(current_obj).remove();
				
			}
		});		
		
	});	
}



document.addEventListener('DOMContentLoaded', function() {
    function dragdrop_bgimg() {
        let AttachDragTo = (function() {
            let _AttachDragTo = function(el) {
                this.el = el;
                this.mouse_is_down = false;

                this.init();
            };

            _AttachDragTo.prototype = {
                onMousemove: function(e) {
                    if (!this.mouse_is_down) return;

                    let tg = e.target,
                        x = e.clientX,
                        y = e.clientY,
                        target_width = tg.clientWidth,
                        target_height = tg.clientHeight,
                        image_proportion,
                        image_height = 600, // Change this variable when changing the image.
                        image_width = 400, // Change this variable when changing the image.
                        max_pos_x = 0,
                        max_pos_y = 0;

                    image_proportion = image_width / image_height;

                    if (image_width > target_width && image_height > target_height) {
                        max_pos_y = target_width / image_proportion - target_height;
                    } else {
                        if (target_width - image_width > target_height - image_height) {
                            max_pos_y = target_width / image_proportion - target_height;
                        } else {
                            max_pos_x = target_width / image_proportion - target_width;
                        }
                    }

                    let image_bg_pos_x = x - this.origin_x + this.origin_bg_pos_x;
                    let image_bg_pos_y = y - this.origin_y + this.origin_bg_pos_y;

                    if (image_bg_pos_x < 0 && image_bg_pos_x > -max_pos_x) {
                        tg.style.backgroundPositionX = image_bg_pos_x + 'px';
                    }

                    if (image_bg_pos_y < 0 && image_bg_pos_y > -max_pos_y) {
                        tg.style.backgroundPositionY = image_bg_pos_y + 'px';
                    }
                },

                onMouseleave: function(e) {
                    this.mouse_is_down = false;

                    let tg = e.target,
                        styles = getComputedStyle(tg);

                    this.origin_bg_pos_x = parseInt(
                        styles.getPropertyValue('background-position-x'),
                        10
                    );
                    this.origin_bg_pos_y = parseInt(
                        styles.getPropertyValue('background-position-y'),
                        10
                    );

                    tg.style.cursor = 'grab';
                },

                onMousedown: function(e) {
                    e.target.style.cursor = 'grabbing';

                    this.mouse_is_down = true;
                    this.origin_x = e.clientX;
                    this.origin_y = e.clientY;
                },

                onMouseup: function(e) {
                    let tg = e.target,
                        styles = getComputedStyle(tg);

                    this.mouse_is_down = false;

                    this.origin_bg_pos_x = parseInt(
                        styles.getPropertyValue('background-position-x'),
                        10
                    );
                    this.origin_bg_pos_y = parseInt(
                        styles.getPropertyValue('background-position-y'),
                        10
                    );

                    tg.style.cursor = 'grab';
                },

                init: function() {
                    let styles = getComputedStyle(this.el);
                    this.origin_bg_pos_x = parseInt(
                        styles.getPropertyValue('background-position-x'),
                        10
                    );
                    this.origin_bg_pos_y = parseInt(
                        styles.getPropertyValue('background-position-y'),
                        10
                    );

                    let imageUrl = this.el.style.backgroundImage.replace(/url\((['"])?(.*?)\1\)/gi, '$2');
                    let image = new Image();
                    image.src = imageUrl;

                    image.onload = () => {
                        this.image_width = image.width,
                        this.image_height = image.height;
                    };

                    // Attach events
                    this.el.addEventListener('mousedown', this.onMousedown.bind(this), false);
                    this.el.addEventListener('mouseup', this.onMouseup.bind(this), false);
                    this.el.addEventListener('mousemove', this.onMousemove.bind(this), false);
                    this.el.addEventListener('mouseleave', this.onMouseleave.bind(this), false);
                }
            };

            return function(el) {
                new _AttachDragTo(el);
            };
        })();

        /*** IMPLEMENTATION ***/
        // 1. Get your element.
        const image = document.getElementById('start_temp_static_div_id');

        // 2. Ensure the element exists
        if (image) {
            // 3. Attach the drag if element is found
            AttachDragTo(image);
        } else {
            //console.error("Element with ID 'start_temp_static_div_id' not found.");
        }
    }

    dragdrop_bgimg();
});
