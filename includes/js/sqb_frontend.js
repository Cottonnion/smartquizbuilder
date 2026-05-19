var outcome_ids_array = [];
var outcome_ids_points_array = {};
var sqb_outcome_content_clone = {};
var firstName = '';

function sqbgetUrlVars()
{
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

function sqbSubmitPolls(){

}


function sqb_load_corner_popup_quiz(){
	var sqb_no_of_shortcode =  jQuery('.quiz_start_template_outer').closest(".sqb_quiz_container_outer").length;

	//console.log(iti);
	

	var show_start_screen = jQuery("#show_start_screen").val();
	if(sqb_no_of_shortcode != 0){
		jQuery('.quiz_start_template_outer').closest(".sqb_quiz_container_outer").each(function(){
				
		var sqb_quiz_container_outer_id =  jQuery(this).attr('id');	
		if(jQuery('#'+sqb_quiz_container_outer_id).find('#quiz_display').val() == 'corner_popup'){
			var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();
			var show_firstname_temp = jQuery('#'+sqb_quiz_container_outer_id+ ' #show_firstname_temp').val();	
			if(quiz_display == "corner_popup"){
				var sqb_quiz_container_data = jQuery('#'+sqb_quiz_container_outer_id).html();	
				var template_num = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val();
				jQuery('#'+sqb_quiz_container_outer_id).html('');				 
			 
				jQuery('body').append('<div class="modal_popup_outer sqb_mobile_view_layout_active template_num_'+template_num+'" id="pop'+sqb_quiz_container_outer_id+'"><div class="sqb_quiz_container_outer" id="'+sqb_quiz_container_outer_id+'"> '+sqb_quiz_container_data+'</div></div>');	
				
				if(iti.length != {}){
					jQuery.each( iti, function( key, value ) {
						iti[key].destroy();
					  });
				}
				initPhoneNumberLib();

				var firstname = sqbgetUrlVars()["firstname"];
			 	if(firstname == null){
			 		var firstname = sqbgetUrlVars()["first_name"];
			 	}
				var email = sqbgetUrlVars()["email"];
				
				jQuery('.quiz_optin_template_outer #first_name').val(firstname);
			
				jQuery('.quiz_optin_template_outer #email').val(email);
				
				if(email != ''){
					jQuery('.sqb_email_ans_field').val(email);
				}
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_outer_fe').addClass('modal_popup');
				jQuery('.modal_popup_outer').addClass('show');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_outer_fe').hide();
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer').show();
				if(show_start_screen == 'Y'){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('show_clss ').removeClass('hide_cls');	
				}else{
					/*Optin before first screen*/
					if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() == 'optin-before-questions-screen' && jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val() == 'Y'){

							jQuery('#'+sqb_quiz_container_outer_id+  '.single_cls_div').removeClass('show_cls').addClass('hide_cls');
							
							//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls ').removeClass('hide_cls');
							
							setTimeout(function() {
								//console.log('Test');
								autoSubmitOptin('pop'+sqb_quiz_container_outer_id);
							}, 50); 
							
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').addClass('hide_cls').removeClass('show_cls');
						var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
						/*End*/
						if(sqb_quiz_type == 'form'){
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls ').removeClass('hide_cls');
						}	
					}
				}
			}
		}
			
	 });	
	}
}

function sqb_file_upload_action(){
	jQuery(document).on('click', '.file_upload_button' ,function(e){
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}
		var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
		
		var question_id = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).data("question-id");
		var input_type = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]');
		
		var data = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').prop("files")[0];
		
		var fd = new FormData();
		var files = jQuery(input_type)[0].files;
		if(files.length > 0 ){
		jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.file_upload_button').css("pointer-events","none");
		jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.file_upload_button').css("pointer-events","none");
		
	   var next_btn_text = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.file_upload_button').html();
	   jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.file_upload_button').html('<div class="spinner spinner1"><div class="bounce1"></div><div class="bounce2"></div></div>');
	   
		var elem = jQuery(this);	
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
					var sqb_quiz_container_outer_id = jQuery(elem).closest('.sqb_quiz_container_outer').attr('id');
					var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
					if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
						sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
					}
					var file_uploded = false;
					var parent_ques_div =  jQuery(elem).closest(".question_container").attr('id');
					
					var data = jQuery.parseJSON(response);
					if(data.fileStatus){
						
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.file_upload_cls').attr('data-fileurl',data.fileUrlArr[0]);
						//jQuery(elem).data('fileurl',data.fileUrlArr[0]);
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.file_upload_cls').css("pointer-events","none");
						jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_upload_button ').before('<div class="correctincorrect_ans_div file_uploaded_message_div"><b>'+jQuery('#file_uploaded_message').val()+'</b></div>');
						
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_uploaded_message_div').length > 1){
							jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_uploaded_message_div').hide();
							jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_uploaded_message_div').first().show();
						}
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.file_upload_button').html(next_btn_text);
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.file_upload_button').hide().next().show();
					} else {
						if(data.error != ''){
							if(data.error =='file_extension_err'){
								jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_upload_button ').before('<div class="in_correct_ans correctincorrect_ans_div"><b>'+jQuery('#file_upload_failed_message').val()+'</b></div>');
							}
							if(data.error =='file_size_err'){
								jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_upload_button ').before('<div class="in_correct_ans correctincorrect_ans_div"><b>'+jQuery('#upload_filesize_limit_exceeds_message').val()+'</b></div>');
							}
						}
						jQuery(input_type).val('');
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.file_upload_cls').css("pointer-events","auto");
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.file_upload_button').css("pointer-events","auto");
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.file_upload_button').html(next_btn_text);
						return false;
					}
				},
				error: function (e) {
				
				}
			});
		} else {
			var allow_skip_ques =  jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .allow_skip_ques").val();
			if(allow_skip_ques == 'Y'){
				jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.file_upload_button').hide().next().show().trigger('click');
			} else {
				jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.sqb_uploded_filename').remove();
				jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.correctincorrect_ans_div').remove();
				var incorrect_answer_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #file_upload_validation').val();
				sqb_incorrectmsg_display(incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
			}
		}
	});
}

function sqb_file_upload_check(){
	jQuery(document).on('change', '.sqb_file_upload' ,function(e){
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
		jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_upload_button ').before('<div class="sqb_uploded_filename"><b>'+uploaded_filename_text+' '+data.name+'</b></div>');
		return;
		
	});
}

function sendToScreenTimeElapses(sqb_quiz_container_outer_id){
	//when timer elapses
   var send_to_screen = jQuery('#'+sqb_quiz_container_outer_id+ ' #send_to_screen').val();	
  
    if(send_to_screen == "disable_next_btn_show_msg") {
		//Disable the next button and show a message on the question screen.
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer  .sqb_counter_expired_msg ').show();	
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer  .question_container  ').addClass('question_container_disabled');	
  }else{
	  var lesson_id = jQuery(' #lesson_id').val();		
	  if(lesson_id > 0){
		  enable_see_detail(sqb_quiz_container_outer_id, 'notcount') ;

	  }else{
	 	//Automatically send to opt-in screen (if enabled) or result screen
		//trigger last Question
		var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();	 
		if(sqb_quiz_type == "personality"){
			personality_last_child_calculation(sqb_quiz_container_outer_id,  '', 'notcount');
		}else if(sqb_quiz_type == "assessment"){
			assessment_last_child_calculation(sqb_quiz_container_outer_id, '', 'notcount');
		}else if(sqb_quiz_type == "scoring"){
			scoring_last_child_calculation(sqb_quiz_container_outer_id,  '', 'notcount');
		}else if(sqb_quiz_type == "survey"){			
			survey_last_child_calculation(sqb_quiz_container_outer_id,  '', 'notcount');
		}
	}

   }   
}

function displayMessageInScreens(sqb_quiz_container_outer_id){

	if(jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_outer_fe .sqb_counter_outer1').length > 1){
		return false; 
	}  
	var timer_enable =jQuery('#'+sqb_quiz_container_outer_id+ ' #timer_enable ').val();
	var time_hour= jQuery('#'+sqb_quiz_container_outer_id+ ' #time_hour').val();
	var time_min= jQuery('#'+sqb_quiz_container_outer_id+ ' #time_min').val();
	var time_sec= jQuery('#'+sqb_quiz_container_outer_id+ ' #time_sec').val();
	if(timer_enable =="Y"){	
		if(time_hour < 1 && time_min < 1 && time_sec <  1){
		}else{
 
			//timer
			var count = getCounterData(  jQuery(' .sqb_counter'),sqb_quiz_container_outer_id);
			var timer_spent =2;		
			var timer = setInterval(function() {
				count--;
				if (count == 0) {
					clearInterval(timer);
					return;
				}
				jQuery('#timer_spent').val(timer_spent);	
				timer_spent++;
				
				setCounterData(count,  jQuery(' .sqb_counter') , sqb_quiz_container_outer_id);
			}, 1000);  
			 
			//Where should it be displayed:
			var template_num = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val();
			var show_optin = jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin ').val();
			var sqb_counter_outer_data1 = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_counter_outer ').html();
			var sqb_counter_outer_data = '<div class="sqb_counter_outer1">'+sqb_counter_outer_data1+'</div>';
			var where_should_msg_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #wheretoshow').val();	
			
			if(template_num == 'template5' ){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template5-left-side .sqb_question_progress').after(sqb_counter_outer_data);
			}else if(template_num == 'template3' ){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .question_title ').after(sqb_counter_outer_data);
			}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .progress').before(sqb_counter_outer_data);
			}				
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .quiz_timer_html_data ').hide(); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer  .quiz_timer_html_data ').hide(); 
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .points_scored_result').length){		 
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .points_scored_result').before(sqb_counter_outer_data);	
			}
			
			if(show_optin =="Y"){
				
				if(template_num == 'template3' ){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer  .Quiz-Template-title').after(sqb_counter_outer_data);
				}else{
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer  .Quiz-Template-title').before(sqb_counter_outer_data);
				}
								
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer  .sqb_counter_expired_msg ').hide();	
			}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .sqb_counter_expired_msg ').hide();	
				if(template_num == 'template3'){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .points_scored_result ').after(sqb_counter_outer_data);				
				}else{
					
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .points_scored_result ').before(sqb_counter_outer_data);				
				}
				 
			}		 
		}		 
		 
	} 
	   
}

function getCounterData(obj, sqb_quiz_container_outer_id) {
   // var days = parseInt(jQuery('.e-m-days', obj).text());
    var hours = parseInt(jQuery(' .sqb-hours', obj).text());
    var minutes = parseInt(jQuery(' .sqb-minutes', obj).text());
    var seconds = parseInt(jQuery(' .sqb-seconds', obj).text());
    //return seconds + (minutes * 60) + (hours * 3600) + (days * 3600 * 24);
    return seconds + (minutes * 60) + (hours * 3600) ;
}

function setCounterData(s, obj, sqb_quiz_container_outer_id) {
 
   // var days = Math.floor(s / (3600 * 24));
    var hours = Math.floor((s % (60 * 60 * 24)) / (3600));
    var minutes = Math.floor((s % (60 * 60)) / 60);
    var seconds = Math.floor(s % 60);
        
	jQuery('#timer_count').val(s);	
	if(hours < 10){
		hours = '0'+hours;
	}
	if(minutes < 10){
		minutes = '0'+minutes;
	}
	if(seconds < 10){
		seconds = '0'+seconds;
	}
	
    jQuery(' .sqb-hours', obj).html(hours);
    jQuery(' .sqb-minutes', obj).html(minutes);	
    jQuery( ' .sqb-seconds', obj).html(seconds);
	if(seconds <= 1){
		seconds='00';
		jQuery( ' .sqb-seconds', obj).html(seconds);
	}
	
	if(hours < 1 && minutes < 1 && seconds <= 1){
		var timer_stop = jQuery('#'+sqb_quiz_container_outer_id+ ' #timer_stop').val();
		if(timer_stop < 1){		
			sendToScreenTimeElapses(sqb_quiz_container_outer_id);
		}	
	}
} 
  
function sqb_call_slider_for_answer_events(event_name = ''){
	var slider_type_ans_length  =  jQuery('.Quiz-Template .type-slider-outer').length ; 
	if(slider_type_ans_length != 0 ){
		jQuery(document).find('.Quiz-Template .type-slider-outer').each(function(){
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id).find('#quiz_display').val();
		if(jQuery(this).find('#ex1Slider').length == 0){
			var slider_id = jQuery(this).find('.sqb_ans_slider').attr('id');
			
			if((event_name == 'on_load')){
				return false;
			}
			if(quiz_display == 'popup' || quiz_display == 'exit' || quiz_display == undefined){
				setTimeout(function(){ 	
					sqb_question_type_slider_init(slider_id, sqb_quiz_container_outer_id); 
				}, 100);
			
				
			}else{
				setTimeout(function(){ 	
					sqb_question_type_slider_init_inpage(slider_id, sqb_quiz_container_outer_id); 
				}, 100);	
			}
		}
	})
	}
} 

function sqb_question_type_slider_init_inpage(slider_id = '', sqb_quiz_container_outer_id=""){

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
			
			jQuery("#"+sqb_quiz_container_outer_id).find("#"+slider_id).bootstrapSlider().change(function(e) {
				
				
				jQuery(this).trigger('click');
			 
		});
			jQuery("#"+sqb_quiz_container_outer_id).find("#"+slider_id).bootstrapSlider({formatter: function(value) {
				return prefix_text+' '+ value +' '+suffix_text ;
			}
			});
			
			var slider_selector = jQuery("#"+sqb_quiz_container_outer_id).find("#"+slider_id).closest('.type-slider-outer');
			slider_selector.find('.slider.slider-horizontal .slider-track').css('background-color',slider_b_clr);
			slider_selector.find('.slider.slider-horizontal .slider-handle').css('background-color',complete_bar_b_clr)
			slider_selector.find('.slider.slider-horizontal .slider-track .slider-selection').css('background-color',complete_bar_b_clr)
			slider_selector.find('.slider.slider-horizontal .tooltip .tooltip-inner').css('background-color',top_box_b_clr );
			
}

function sqb_question_type_slider_init(slider_id = '', sqb_quiz_container_outer_id=""){

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
			
			jQuery("#pop"+sqb_quiz_container_outer_id).find("#"+slider_id).bootstrapSlider().change(function(e) {
				
				
				jQuery(this).trigger('click');
			 
		});
			jQuery("#pop"+sqb_quiz_container_outer_id).find("#"+slider_id).bootstrapSlider({formatter: function(value) {
				return prefix_text+' '+ value +' '+suffix_text ;
			}
			});
			
			var slider_selector = jQuery("#pop"+sqb_quiz_container_outer_id).find("#"+slider_id).closest('.type-slider-outer');
			slider_selector.find('.slider.slider-horizontal .slider-track').css('background-color',slider_b_clr);
			slider_selector.find('.slider.slider-horizontal .slider-handle').css('background-color',complete_bar_b_clr)
			slider_selector.find('.slider.slider-horizontal .slider-track .slider-selection').css('background-color',complete_bar_b_clr)
			slider_selector.find('.slider.slider-horizontal .tooltip .tooltip-inner').css('background-color',top_box_b_clr );
			
}

//for mobile dragdrop
function sqb_touchHandler(event) {
    var touch = event.changedTouches[0];

    var simulatedEvent = document.createEvent("MouseEvent");
    simulatedEvent.initMouseEvent({
            touchstart: "mousedown",
            touchmove: "mousemove",
            touchend: "mouseup"
        }[event.type], true, true, window, 1,
        touch.screenX, touch.screenY,
        touch.clientX, touch.clientY, false,
        false, false, false, 0, null);

    touch.target.dispatchEvent(simulatedEvent);
    //event.preventDefault();
}
//for mobile dragdrop
function sqb_init() {
    document.addEventListener("touchstart", sqb_touchHandler,  {passive: true});
    document.addEventListener("touchmove", sqb_touchHandler, {passive: true});
    document.addEventListener("touchend", sqb_touchHandler, {passive: true});
    document.addEventListener("touchcancel", sqb_touchHandler, {passive: true});
}

function sqb_isDate(format, currVal)
{  
	if(format == 'yy-mm-dd'){
		var dtArray = currVal.split('-');
		dtYear = dtArray[0];
  		dtMonth = dtArray[1];
		dtDay= dtArray[2];
	}else if(format == 'yy-dd-mm'){
		var dtArray = currVal.split('-');
		dtYear = dtArray[0];
		dtDay= dtArray[1];
  		dtMonth = dtArray[2];
	}else if(format == 'dd-mm-yy'){
		var dtArray = currVal.split('-');
		dtDay= dtArray[0];
  		dtMonth = dtArray[1];
		dtYear = dtArray[2];
	}else if(format == 'mm-dd-yy'){
		var dtArray = currVal.split('-');
  		dtMonth = dtArray[0];
		dtDay= dtArray[1];
		dtYear = dtArray[2];
	}else if(format == 'yy/mm/dd'){
		var dtArray = currVal.split('/');
		dtYear = dtArray[0];
  		dtMonth = dtArray[1];
		dtDay= dtArray[2];
	}else if(format == 'yy/dd/mm'){
		var dtArray = currVal.split('/');
		dtYear = dtArray[0];
		dtDay= dtArray[1];
  		dtMonth = dtArray[2];
	}else if(format == 'dd/mm/yy'){
		var dtArray = currVal.split('/');
		dtDay= dtArray[0];
  		dtMonth = dtArray[1];
		dtYear = dtArray[2];
	}else if(format == 'mm/dd/yy'){
		var dtArray = currVal.split('/');
  		dtMonth = dtArray[0];
		dtDay= dtArray[1];
		dtYear = dtArray[2];
	}else if(format == 'yy.mm.dd'){
		var dtArray = currVal.split('.');
		dtYear = dtArray[0];
  		dtMonth = dtArray[1];
		dtDay= dtArray[2];
	}else if(format == 'yy.dd.mm'){
		var dtArray = currVal.split('.');
		dtYear = dtArray[0];
		dtDay= dtArray[1];
  		dtMonth = dtArray[2];
	}else if(format == 'dd.mm.yy'){
		var dtArray = currVal.split('.');
		dtDay= dtArray[0];
  		dtMonth = dtArray[1];
		dtYear = dtArray[2];
	}else if(format == 'mm.dd.yy'){
		var dtArray = currVal.split('.');
  		dtMonth = dtArray[0];
		dtDay= dtArray[1];
		dtYear = dtArray[2];
	}

	if (dtMonth < 1 || dtMonth > 12)
		return false;
	else if (dtDay < 1 || dtDay> 31)
		return false;
	else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
		return false;
	else if (dtMonth == 2)
	{
		var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
		if (dtDay> 29 || (dtDay ==29 && !isleap))
		return false;
	}
	return true;
}


function setCookie(cname, cvalue, exdays) {
	console.log(cvalue);
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

function checkCookie() {
  let user = getCookie("username");
  if (user != "") {
    alert("Welcome again " + user);
  } else {
    user = prompt("Please enter your name:", "");
    if (user != "" && user != null) {
      setCookie("username", user, 365);
    }
  }
}



jQuery(document).ready(function(){

 //checkCustomFields();


 jQuery('.sqb_quiz_container_outer').each(function(){
 	var parent = jQuery(this).attr('id');
 	var quiz_display = jQuery('#'+parent).find('#quiz_display').val();
 	if(quiz_display == 'exit' || quiz_display == 'corner_popup'){
 		var cookie_name = "SQB_cp_display_frequency";
 		var quiz_popup_frequency = jQuery('#'+parent).find('#quiz_popup_frequency').val();
 		var cookie_value = quiz_popup_frequency;

 		var quiz_popup_frequency_arr = quiz_popup_frequency.split('|');
 		var set_quiz_popup_frequency = quiz_popup_frequency_arr[0];
 		var display_frequency_value = quiz_popup_frequency_arr[1];
 		if(typeof jQuery.cookie('SQB_cp_display_frequency') === 'undefined'){
 			if(quiz_popup_frequency != 'always' && quiz_popup_frequency != 'display_once'){
 				setCookie(cookie_name, display_frequency_value, display_frequency_value);
 			}else{
 				if(quiz_popup_frequency == 'display_once'){
 					setCookie(cookie_name, cookie_value, '36500');
 				}
 			}
 		}else{
 			if(quiz_popup_frequency == 'always'){
 				jQuery.cookie(cookie_name, null, { path: '/' }); 
 			}else if(quiz_popup_frequency == 'display_once'){
			 	const d = new Date();
			  	d.setTime(d.getTime() + (36500 * 24 * 60 * 60 * 1000));
			  	let expires = "expires="+d.toUTCString();
			  	document.cookie = cookie_name + "=" + quiz_popup_frequency + ";" + expires + ";path=/";
			}else if(set_quiz_popup_frequency == 'set_display_frequency'){
				//setcookie(cookie_name, display_frequency_value, display_frequency_value );
				
				const d = new Date();
			  	d.setTime(d.getTime() + (display_frequency_value * 24 * 60 * 60 * 1000));
			  	let expires = "expires="+d.toUTCString();
			  	document.cookie = cookie_name + "=" + display_frequency_value + ";" + expires + ";path=/";
			}
 		}
 	}
 });

jQuery(document).on('click', '.sqb_ans_item_outer.multiple_correct_checkbox.sqb_ans_selected' , function(evt){
 		
 		evt.stopImmediatePropagation();	
 		 
		jQuery(this).removeClass('sqb_ans_selected');
		if(jQuery(this).hasClass("sqb_ans_selected") == true){
			jQuery(this).find(".sqb_and_field.checkbox_fe").prop("checked" , true); 			
		}else{
			jQuery(this).find(".sqb_and_field.checkbox_fe").prop("checked" , false);			
		}
		
		jQuery('.sqb_and_field.checkbox_fe').each(function(){
			if(jQuery(this).prop("checked") == true){
				 jQuery(this).closest('.sqb_ans_item_outer').addClass('sqb_ans_selected');  			 
			}else{
				jQuery(this).closest('.sqb_ans_item_outer').removeClass('sqb_ans_selected');  			 
			}	
		});

		var quiz_type = jQuery('#sqb_quiz_type').val();

		if(quiz_type == 'poll'){
			if(jQuery('.sqb_ans_selected').length < 1){
				jQuery('.btn-add-vote').attr('disabled',true);
			}
		}

	});


 	if(jQuery('.start_temp_outer').hasClass('remove-border')){
 		jQuery('.quiz_quesans_template_outer .Quiz-Template').addClass('remove-border');
 	}


 	var template = jQuery('#template_num').val();
 	if(template == 'template6'){
 		if(jQuery('.start_temp_outer').hasClass('remove-border') || jQuery('.result_temp_outer').hasClass('remove-border')){
			jQuery('.Quiz-Template-outer .Quiz-Template').addClass('remove-border');
			jQuery('.result_temp_outer').addClass('remove-border');
		}
 	}

 	/*jQuery('.generate_pdf_form').each(function(){
 		var get_title = jQuery(this).find('.outcome_pdf_title').val();
 		jQuery(this).find('.outcome_button_pdf').html(get_title);
 	});*/


 	jQuery('.sqb_quiz_container_outer').each(function(){
 		if(jQuery(this).find('#quiz_pagination').val() == 'all' && jQuery(this).find('#show_start_screen').val() == 'N'){
			if(jQuery(this).find('#lesson_id').val() == ''){
				jQuery(this).find('.Quiz-Template-outer').css('max-width','700px');
				jQuery(this).find('.Quiz-Template-outer').css('margin','0 auto');
			}
			jQuery(this).find('.question_container').addClass("question_container_disabled");
			jQuery(this).find('.question_container').first().removeClass("question_container_disabled");
		}
 	});
 	 	
 	jQuery(document).on('click','.outcome_button_pdf',function(evt){
		evt.stopImmediatePropagation();
		evt.preventDefault();
 		var get_url = jQuery('#get_home_url').val();
 		var pathtopdf = get_url+'/wp-content/plugins/smartquizbuilder/includes/dompdf/outcome_pdf.php';
 		var quiz_id = jQuery('#quiz_id').val();
 		// var outcome_id = jQuery('.generate_pdf_form').attr('data-outcome-id');
 		var outcome_id = jQuery('#outcome_final').val();
 		
 		sqbQuizPdf('sqbQuizForm',quiz_id, outcome_id, pathtopdf)
 	});

 	/*-----------------------------------------*/
 	var firstname = sqbgetUrlVars()["firstname"];
 	if(firstname == null){
 		var firstname = sqbgetUrlVars()["first_name"];
 	}
	var email = sqbgetUrlVars()["email"];

	var dap_login_first_name = jQuery('#dap_login_first_name').val();
	if(jQuery('#show_firstname_temp').val() == 'N'){
		if(firstname != null || email != null){
			jQuery('#first_name').val('%%FIRST%%');
			jQuery('#sqb_direct_signup #email').val('%%EMAIL%%');
			jQuery('#sqb_direct_signup #email').attr('data-email','%%EMAIL%%');
			jQuery('.quiz_quesans_template_outer .question_container').each(function(){
				var data = this;
				var html = jQuery(data).html();
				var count = (html.match(/%%FIRST%%/g) || []).length;				 
				for(i=0; i < count; i++){
					var html = jQuery(data).html();
					jQuery(data).html(html.replaceAll('%%FIRST%%', firstname)); 
				}	
			});
				 
			jQuery('.quiz_quesans_template_outer .sql_ans_text').each(function(){
				var html = jQuery(this).html();
				jQuery(this).html(html.replaceAll('%%FIRST%%', firstname)); 
			});

			jQuery('.quiz_optin_template_outer .quiz_comon_template').each(function(){	
				var html = jQuery(this).html();		 
				jQuery(this).html(html.replaceAll('%%FIRST%%', firstname));
			});

			jQuery('.quiz_optin_template_outer .quiz_comon_template').each(function(){	
				var html = jQuery(this).html();		 
				jQuery(this).html(html.replaceAll('%%EMAIL%%', email));
			});
			
			
			jQuery('.quiz_optin_template_outer #first_name').val(firstname);
			
			jQuery('.quiz_optin_template_outer #email').val(email);

			jQuery('.quiz_result_template_outer .outcome_div').each(function(){
				var html = jQuery(this).html();
				jQuery(this).html(html.replaceAll('%%FIRST%%', firstname));
			});	
			
			jQuery('.quiz_result_template_outer .Quiz-Template-content-inn').each(function(){
				var html = jQuery(this).html();
				jQuery(this).html(html.replaceAll('%%FIRST%%', firstname));
			});	

			jQuery('.quiz_start_template_outer .start_temp_outer').each(function(){
				var html = jQuery(this).html();
				jQuery(this).html(html.replaceAll('%%FIRST%%', firstname));
			});	
		}else if(dap_login_first_name != '' & dap_login_first_name != undefined){
			jQuery('.quiz_start_template_outer .start_temp_outer').each(function(){
				var html = jQuery(this).html();
				jQuery(this).html(html.replaceAll('%%FIRST%%', dap_login_first_name));
			});	

			jQuery('.quiz_result_template_outer .outcome_div').each(function(){
				var html = jQuery(this).html();
				jQuery(this).html(html.replaceAll('%%FIRST%%', dap_login_first_name));
			});	
			
			jQuery('.quiz_result_template_outer .Quiz-Template-content-inn').each(function(){
				var html = jQuery(this).html();
				jQuery(this).html(html.replaceAll('%%FIRST%%', dap_login_first_name));
			});	

			jQuery('.quiz_quesans_template_outer .question_container').each(function(){
				var data = this;
				var html = jQuery(data).html();
				var count = (html.match(/%%FIRST%%/g) || []).length;				 
				for(i=0; i < count; i++){
					var html = jQuery(data).html();
					jQuery(data).html(html.replaceAll('%%FIRST%%', dap_login_first_name)); 
				}	
			});
				 
			jQuery('.quiz_quesans_template_outer .sql_ans_text').each(function(){
				var html = jQuery(this).html();
				jQuery(this).html(html.replaceAll('%%FIRST%%', dap_login_first_name)); 
			});
			
			jQuery('.quiz_optin_template_outer .quiz_comon_template').each(function(){	
				var html = jQuery(this).html();		 
				jQuery(this).html(html.replaceAll('%%FIRST%%', dap_login_first_name));
			});

		}

	}else{
		if(firstname != undefined){
			var style = jQuery('.quiz_start_template_outer .take-quiz-btn').attr('style');
			//jQuery('.show_first_name_screen_temp .sqb_first_name_ok_btn').find('.firstname_ok_btn').attr('style' , style);
			jQuery('.show_first_name_screen_temp .sqb_first_name_ok_btn').find('.firstname_ok_btn').css('display', 'inline-block');
			jQuery('.sqb_first_name').val(firstname);

			jQuery('.quiz_start_template_outer .start_temp_outer').each(function(){
				var html = jQuery(this).html();
				jQuery(this).html(html.replaceAll('%%FIRST%%', firstname));
			});
		}else {
			if(dap_login_first_name != '' & dap_login_first_name != undefined){
				var style = jQuery('.quiz_start_template_outer .take-quiz-btn').attr('style');
				//jQuery('.show_first_name_screen_temp .sqb_first_name_ok_btn').find('.firstname_ok_btn').attr('style' , style);
				jQuery('.show_first_name_screen_temp .sqb_first_name_ok_btn').find('.firstname_ok_btn').css('display', 'inline-block');
				jQuery('.sqb_first_name').val(dap_login_first_name);
				jQuery('.quiz_start_template_outer .start_temp_outer').each(function(){
					var html = jQuery(this).html();
					jQuery(this).html(html.replaceAll('%%FIRST%%', dap_login_first_name));
				});
			}
		}
	}

	if(email != ''){
		jQuery('.sqb_email_ans_field').val(email);
	}

	
	
 	/*-----------------------------------------*/

 	jQuery('.startTemplateYoutubeVideoOuter iframe').css('max-height','100%');
   jQuery('.outcomeTemplateYoutubeVideoOuter iframe').css('max-height','100%');
   jQuery('.questionTemplateYoutubeVideoOuter iframe').css('max-height','100%');

	jQuery(document).on('click','.result_temp_outer .take-quiz-btn', function() { 
		if (jQuery(".result_temp_outer .take-quiz-btn").data('continueurl')) {
			var continue_url = jQuery(this).attr('data-continueurl');
			location.href = continue_url;
		}
	});

	
	jQuery('.slider_cls').each(function(){
		jQuery('.slider_cls').addClass('sqb_ans_selected');
	});

	
	jQuery('.sqb_quiz_container_outer').each(function(){
		var parent = jQuery(this).attr('id');
		var sqb_quiz_type= jQuery('#'+parent).find('#sqb_quiz_type').val();
		var show_next_button = jQuery('#'+parent).find('#show_next_button').val();
    	if (typeof sqb_quiz_type === "undefined") {

    	}else{
    		if(sqb_quiz_type == 'personality' || sqb_quiz_type == 'survey' || sqb_quiz_type == 'calculator'){
			
				if(show_next_button == 'N'){
					jQuery('#'+parent).find('.question_type_single').find('.single_next_btn').hide();
					jQuery('#'+parent).find('.question_type_yes_no').find('.single_next_btn').hide();
				}
			}else if(sqb_quiz_type == 'scoring' || sqb_quiz_type == 'assessment'){
				var display_correctans_options = jQuery('#'+parent).find('#display_correctans_options').val();
			
				if(display_correctans_options == 'both' || display_correctans_options == 'each_page'){
					jQuery('#'+parent).find('.question_type_single').find('.single_next_btn').show();
					jQuery('#'+parent).find('.question_type_yes_no').find('.single_next_btn').show();
				}else{
				     if(show_next_button == 'N'){
    					jQuery('#'+parent).find('.question_type_single').find('.single_next_btn').hide();
    					jQuery('#'+parent).find('.question_type_yes_no').find('.single_next_btn').hide();
    				}
				}
			}
    	}

	});

	var custom_date_field_data = jQuery('#custom_date_field_data').val();
	if(custom_date_field_data){
		var custom_date_field_data = custom_date_field_data.split('|');
		var custom_month_name = custom_date_field_data[0].split(",");
		var custom_day_name = custom_date_field_data[1].split(",");
		var custom_date_format = jQuery('.custom-date-field').attr('data-date-format');

		var home_url = jQuery('#get_home_url').val();
		jQuery('.input-group.date').datepicker({
			dateFormat: custom_date_format,
		 	monthNames: custom_month_name,
	 		dayNamesMin: custom_day_name,
			showOn: "button",
			firstDay:1,
			buttonImage: home_url+"/wp-content/plugins/smartquizbuilder/includes/images/calendar_icon.svg",
			buttonImageOnly: true
		});
	}
	
 		
 	jQuery('.custom_fields_calendar .input-group.date').removeClass('hasDatepicker').datepicker({dateFormat: "mm-dd-yy"}); 
	/*setTimeout(function(){

	},10000);*/
	jQuery('.date-question-type').on('click', function(){
		jQuery(this).parents('.date_cls').find('.ui-datepicker-trigger').trigger('click');
	});

	jQuery('.sqb_quiz_container_outer').each(function(){
		var parent = jQuery(this).attr('id');

	 	jQuery('#'+parent+' .Quiz-Template').each(function(){
	 		if(jQuery('#'+parent+' #quiz_display').val() == 'inpage'){
		 		jQuery(this).find('.date-question-type').each(function(){
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
		 	}
	 	});
	 });
	
	 jQuery('.question_type_phone_number .single_next_btn').on('click', function(){


		var parent_ques_div =  jQuery(this).closest('.question_container').attr('id');
		var parent_ques_id =  jQuery(this).closest('.question_container').attr('data-question-id');
 		var val = jQuery('#'+parent_ques_div).find('.sqb_phone_number_ans_field').val();
 		var phone_error_message = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-errormessage');
 		var phone_required = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-validation');

		 jQuery('#'+parent_ques_div).find(".phone_number_text_cls").addClass('sqb_ans_selected');

		if(phone_required == 'Y'){
			
			if(!iti[parent_ques_id].isValidNumber()){
				jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
				jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+phone_error_message+'</b></div>');
				return false;
			}else{
				
			}

		}

	 });
	jQuery('.question_type_email .single_next_btn').on('click', function(){
		var parent_ques_div =  jQuery(this).closest('.question_container').attr('id');
 		var val = jQuery('#'+parent_ques_div).find('.sqb_email_ans_field').val();
 		var email_error_message = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-emailmessage');
 		var email_required = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-isreq');
 		
		
		if(email_required == 'Y'){
			if(val == ''){
				jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
				jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+email_error_message+'</b></div>');
				return false;
			}else if(!sqbValidateEmail(val)){
				jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
				jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+email_error_message+'</b></div>');
				return false;
			}else{
				
			}
		}
		
	});

 	jQuery('.question_type_date .single_next_btn').on('click', function(){
 		var parent_ques_div =  jQuery(this).closest('.question_container').attr('id');
 		var date_format = jQuery('#'+parent_ques_div).find('.date-question-type').attr('data-date-format');
 		var date_val = jQuery('#'+parent_ques_div).find('.date-question-type').val();
 		if(sqb_isDate(date_format, date_val)){
 			jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
 		}else{
 			var invalid_date = jQuery('#invalid_date_text').val();
 			jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
 			jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+invalid_date+'</b></div>');
 			return false;
 		}

 	});

	 jQuery('.question_type_weight_and_height .single_next_btn').on('click', function(){

		var parent_ques_div =  jQuery(this).closest('.question_container').attr('id');
		jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
		var weight = jQuery('#'+parent_ques_div).find('.weight-input').val();
		var height_feet = jQuery('#'+parent_ques_div).find('.height-feet').val();
		var height_inches = jQuery('#'+parent_ques_div).find('.height-inches').val();

		var validate_message = jQuery('#'+parent_ques_div).find('.hw_incorrect_answer_msg').val();
		var is_valid = true;
		if(weight == '' || isSQBInteger(weight) != true){
			jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+validate_message+'</b></div>');
			is_valid = false;
		}else if(height_feet == '' || isSQBInteger(height_feet) != true){
			jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+validate_message+'</b></div>');
			is_valid = false;
		}
		return is_valid;
	 });
	 jQuery('.question_type_matching_text .single_next_btn').on('click', function(){
		var parent_ques_div =  jQuery(this).closest('.question_container').attr('id');

		var validate = true;
		jQuery('#'+parent_ques_div).find('.sql_ans_text .drag-container').each(function(){
			if(jQuery(this).find('.sqb-match-box .sqb-match-item').length < 1){
				validate = false;
			}
		});

		if(!validate){
			jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
 			jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>Error</b></div>');
			return false;
		}else{
			isSentenceMatch(jQuery('#'+parent_ques_div));
		}
		/*var date_format = jQuery('#'+parent_ques_div).find('.date-question-type').attr('data-date-format');
		var date_val = jQuery('#'+parent_ques_div).find('.date-question-type').val();
		if(sqb_isDate(date_format, date_val)){
			jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
		}else{
			var invalid_date = jQuery('#invalid_date_text').val();
			jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
			jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+invalid_date+'</b></div>');
			return false;
		}*/

	});

 	jQuery(".date-question-type").keyup(function() {
		var date_format = jQuery(this).attr('data-date-format');
		var splitMultiple = (str, ...separator) => {
		   var res = [];
		   let start = 0;
		   for(let i = 0; i < date_format.length; i++){
		      if(!separator.includes(date_format[i])){
		         continue;
		      };
		      res.push(date_format.substring(start, i));
		      start = i+1;
		   };
		   return res;
		};

		var date_split = splitMultiple(date_format, '/', '.', '-');
		if(date_split[0] == 'yy'){
			var specialChars =  "-/.";
			var spArr = [];
			var check = function(string){
			    for(i = 0; i < specialChars.length;i++){
			        if(string.indexOf(specialChars[i]) > -1){
			            spArr.push(specialChars[i]);
			        }
			    }
			}
			check(date_format);
			var val_old = jQuery(this).val();
			var val = val_old.replace(/\D/g, '');
			var len = val.length;
			if (len >= 4){
				val = val.substring(0, 4) + spArr + val.substring(4);
			}
			if (len >= 7){
				val = val.substring(0, 7) + spArr + val.substring(7);
			}
			if (val != val_old){
				jQuery(this).focus().val('').val(val);
			}
			jQuery(this).attr('maxlength', '10');

		}else{
			var specialChars =  "-/.";
			var spArr = [];
			var check = function(string){
			    for(i = 0; i < specialChars.length;i++){
			        if(string.indexOf(specialChars[i]) > -1){
			            spArr.push(specialChars[i]);
			        }
			    }
			}
			check(date_format);

			var val_old = jQuery(this).val();
			var val = val_old.replace(/\D/g, '');
			var len = val.length;
			if (len >= 2){
				val = val.substring(0, 2) + spArr + val.substring(2);
			}
			if (len >= 5){
				val = val.substring(0, 5) + spArr + val.substring(5);
			}
			if (val != val_old){
				jQuery(this).focus().val('').val(val);
			}
			jQuery(this).attr('maxlength', '10');
		}

 		
	});

 	jQuery(".custom-date-field input").keyup(function() {
 		if(this.value.length < 2) {
      	jQuery(this).closest('.custom-date-field').find('.ui-datepicker-trigger').trigger('click');
    	}
		var date_format = jQuery(this).closest('.custom-date-field').attr('data-date-format');
		var splitMultiple = (str, ...separator) => {
		   var res = [];
		   let start = 0;
		   for(let i = 0; i < date_format.length; i++){
		      if(!separator.includes(date_format[i])){
		         continue;
		      };
		      res.push(date_format.substring(start, i));
		      start = i+1;
		   };
		   return res;
		};

		var date_split = splitMultiple(date_format, '/', '.', '-');
		if(date_split[0] == 'yy'){
			var specialChars =  "-/.";
			var spArr = [];
			var check = function(string){
			    for(i = 0; i < specialChars.length;i++){
			        if(string.indexOf(specialChars[i]) > -1){
			            spArr.push(specialChars[i]);
			        }
			    }
			}
			check(date_format);
			var val_old = jQuery(this).val();
			var val = val_old.replace(/\D/g, '');
			var len = val.length;
			if (len >= 4){
				val = val.substring(0, 4) + spArr + val.substring(4);
			}
			if (len >= 7){
				val = val.substring(0, 7) + spArr + val.substring(7);
			}
			if (val != val_old){
				jQuery(this).focus().val('').val(val);
			}
			jQuery(this).attr('maxlength', '10');

		}else{
			var specialChars =  "-/.";
			var spArr = [];
			var check = function(string){
			    for(i = 0; i < specialChars.length;i++){
			        if(string.indexOf(specialChars[i]) > -1){
			            spArr.push(specialChars[i]);
			        }
			    }
			}
			check(date_format);

			var val_old = jQuery(this).val();
			var val = val_old.replace(/\D/g, '');
			var len = val.length;
			if (len >= 2){
				val = val.substring(0, 2) + spArr + val.substring(2);
			}
			if (len >= 5){
				val = val.substring(0, 5) + spArr + val.substring(5);
			}
			if (val != val_old){
				jQuery(this).focus().val('').val(val);
			}
			jQuery(this).attr('maxlength', '10');
		}
	});


	jQuery('.show-date-options').hide();
	jQuery(".custom-phone-number").keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
		var curchr = this.value.length;
		var curval = jQuery(this).val();
		if (curchr == 3 && curval.indexOf("(") <= -1) {
			jQuery(this).val(curval + "-");
			// jQuery(this).val("(" + curval + ")" + "-");
		} else if (curchr == 2 && curval.indexOf("(") > -1) {
			jQuery(this).val(curval + ")-");
		} else if (curchr == 3 && curval.indexOf(")") > -1) {
			jQuery(this).val(curval + "-");
		} else if (curchr == 7) {
			jQuery(this).val(curval + "-");
			jQuery(this).attr('maxlength', '12');
		}
	});

	jQuery(".custom-phone-number").keyup(function() {
	var val_old = jQuery(this).val();
	var val = val_old.replace(/\D/g, '');
	var len = val.length;
	if (len >= 3){
		val = val.substring(0, 3) + '-' + val.substring(3);
	}
	if (len >= 7){
		val = val.substring(0, 7) + '-' + val.substring(7);
	}
	if (val != val_old){
		jQuery(this).focus().val('').val(val);
	}
		jQuery(this).attr('maxlength', '12');
	});

	jQuery(".custom-phone-number").focusout(function() {
		var val_old = jQuery(this).val();
		var val = val_old.replace(/\D/g, '');
		var len = val.length;
		jQuery(".custom_add_fields .sqbwarning_div").remove();
		jQuery(".sqb_custom_field_required_class").hide();
		if(len < 10 ){
			jQuery(this).parent().append('<div class="sqbwarning_div"><b>Number is less than 10 digit</b></div>');
		}else{
			jQuery(".custom_add_fields .sqbwarning_div").remove();
		}
	});


	jQuery('.leadScreenTemplateYoutubeVideoOuter iframe').css('max-height','');
	jQuery('.Quiz-Template.outer-style7 .question_add_answer_outer_div.image_option_has').each(function(){	
		if(jQuery(this).find('.sqb_ans_item_outer').length > 1 && jQuery(this).hasClass('layout-four-in-row-active')){
			if(jQuery(this).find('.sqb_ans_item_outer').length ==2){
				jQuery(this).addClass('grid-layout-active');
				jQuery(this).removeClass('layout-three-in-row-active');
				jQuery(this).removeClass('layout-four-in-row-active');
				jQuery(this).removeClass('layout-five-in-row-active');
				jQuery(this).removeClass('layout-six-in-row-active');
			} else if(jQuery(this).find('.sqb_ans_item_outer').length ==3){
				jQuery(this).addClass('layout-three-in-row-active');
				jQuery(this).removeClass('layout-four-in-row-active');
				jQuery(this).removeClass('layout-five-in-row-active');
				jQuery(this).removeClass('layout-six-in-row-active');
			} else if(jQuery(this).find('.sqb_ans_item_outer').length ==4){
				jQuery(this).addClass('layout-four-in-row-active');
				jQuery(this).removeClass('layout-three-in-row-active');
				jQuery(this).removeClass('layout-five-in-row-active');
				jQuery(this).removeClass('layout-six-in-row-active');
			} else if(jQuery(this).find('.sqb_ans_item_outer').length ==5){
				jQuery(this).addClass('layout-five-in-row-active');
				jQuery(this).removeClass('layout-three-in-row-active');
				jQuery(this).removeClass('layout-four-in-row-active');
				jQuery(this).removeClass('layout-six-in-row-active');
			} else if(jQuery(this).find('.sqb_ans_item_outer').length ==6){
				jQuery(this).addClass('layout-six-in-row-active');
				jQuery(this).removeClass('layout-three-in-row-active');
				jQuery(this).removeClass('layout-four-in-row-active');
				jQuery(this).removeClass('layout-five-in-row-active');
			}
		}		
	});	
		
 	jQuery('.sqb_ans_item_outer .SQB-fixed-side').filter(function() {
		if(jQuery(this).text().trim().length == 0){
			jQuery('.SQB-fixed-side').hide();
		}else{
			jQuery('.SQB-fixed-side').show();
		}
	});

	/*jQuery(document).on('click', '.sqb_audio_play_pause', function(){
		
		var current_obj = jQuery(this);
		jQuery(current_obj).closest('.sqb_player_audio_div').find('.sqb_player_audio').trigger('click');
		
	});*/

	jQuery(document).on('click', '.sqb_player_audio', function(evt){

		evt.stopImmediatePropagation();
		evt.preventDefault();

		if (this.paused == false) {
			this.pause();
		} else {
			this.play();
		}
	
	});

 	/*Set style for template 6 */
 	var template = jQuery('#template_num').val();
 	if(template == 'template6'){
 		var qns_style = jQuery('.single_cls_div').attr("style");
 		jQuery('.analyzing_result_temp').attr("style",qns_style);
		if(jQuery('.Quiz-Start-Template2.Start-template-withbutton').length > 0){
			jQuery('.Quiz-Start-Template2.Start-template-withbutton').closest('.quiz_start_template_outer').attr('style','');
			jQuery('.Quiz-Start-Template2.Start-template-withbutton').closest('.quiz_start_template_outer').find('.background-image-template6').remove();
		}
		//var get_style = jQuery('.start_temp_outer').attr('style');
		//jQuery('.Quiz-Template').attr('style',get_style);
 	}
 	/*----------------------*/
 	
	//checkbox appending using some plugin..removing that
	jQuery('.sqb_quiz_container .checkbox-box').each(function(){	
		if(jQuery(this).length > 0){		 
			jQuery(this).remove();
		}		 
	}); 

 	var quiz_id = jQuery('#quiz_id').val();
	var ajaxurl = jQuery('#sqb_ajaxurl').val();	

	jQuery.post(ajaxurl, {
		action: 'sqbLoadAnswerStyle',
		quiz_id: quiz_id,
		
	}, function(response) {		
		var get_styles = JSON.parse(response);
		if(get_styles){
			var quiz_type = jQuery('input[name="select_temp"]:checked').val();
			if(get_styles.quiz_type == 'template6'){
				if(get_styles.ans_bg){
					jQuery('.sqb_ans_item').css('background', get_styles.ans_bg);
				}
				if(get_styles.ans_text_color){
					jQuery('.sql_ans_text ').css('color', get_styles.ans_text_color);
					jQuery('.sql_ans_text div').css('color','');
			 		jQuery('.sql_ans_text div div').css('color','');
				}
			}
		}else{
			jQuery('.sqb_ans_item').css('background', '#e5f1ff');
			jQuery('.sql_ans_text ').css('color', '#333');
		}
	});


 	/* Remove extra space if tiny mce editor text is empty*/
 	jQuery('.sqb_tiny_mce_editor').filter(function() {
		if(jQuery(this).find('iframe').length != 0){
			return false;
		}
		if(jQuery(this).find('img').length != 0){
			return false;
		}
	  return jQuery(this).text().trim().length == 0;
	}).remove();

	 //added for iframe checkboxes issue
	 if (window!=window.top) {
		jQuery('#sqb_quiz_builder').addClass('iframe_outer');  	
	}else{
	    jQuery('#sqb_quiz_builder').removeClass('iframe_outer');   
	}
	 
	//a tag should redirect to the page inside the iframe
	jQuery('.iframe_outer .quiz_result_template_outer a').each(function(){	
		jQuery(this).attr('target','_parent');		 
	});  
		 
 	var gdpr_value = jQuery('#gdpr_compliance').val();
 	if(gdpr_value == 0){
 		jQuery('.sqb-gdpr-checkbox').hide();
 	}

	//Added for quiz  taking time to load
	jQuery('.quiz_quesans_template_outer').closest(".sqb_quiz_container_outer").each(function(){				
		var sqb_quiz_container_outer_id =  jQuery(this).attr('id');	
		var delay = jQuery('#'+sqb_quiz_container_outer_id).find('#quiz_popup_time_delay').val();
		if(jQuery('#'+sqb_quiz_container_outer_id).find('#quiz_display').val() == 'corner_popup'){			
			setTimeout(function(){ 	
				sqb_load_corner_popup_quiz(); 	 
				jQuery('.sqb_quiz_container_outer').show();

				if(jQuery('#'+sqb_quiz_container_outer_id+' quiz_display' == 'corner_popup')){

					jQuery('.Quiz-Template').each(function(){
		 	
				 		jQuery(this).find('.date-question-type').each(function(){
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
				 	});
				}
			}, delay*500);	
		}else{
			jQuery('.sqb_quiz_container_outer').show();
		}		
	});
	
	sqb_hideloader();	
	//remove Font Tag
	removeFontTag();
	var quiz_type = jQuery('#sqb_quiz_type').val();
	if(template == 'template6' || quiz_type == 'poll'){

	}else{
		removeFontTagNew();
	}

	/*if(template != 'template6' || quiz_type != 'poll'){
		
	}*/
 
	setTimeout(function(){ 		  
		jQuery('.Quiz-Template-overflow .single_next_btn_container').each(function(){
			if(jQuery(this).hasClass('question_type_ranking_choices')) {
				jQuery(this).find('.question_add_answer_outer_div').sortable();
				jQuery(this).find('.sqb_is_right_ans').removeClass('.sqb_and_field');
			}
		});
	}, 500);
	 
	//for mobile device dragdrop 
	var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
	if (isMobile) {  
		sqb_init();		 
		jQuery('.Quiz-Template-overflow .single_next_btn_container').each(function(){
			if(jQuery(this).hasClass('question_type_ranking_choices')) {
				jQuery(this).find('.question_add_answer_outer_div').sortable();
				jQuery(this).find('.sqb_is_right_ans').removeClass('.sqb_and_field');				 
			} 
		});
		
	}else{//for desktop device	
		// Add sortable class in Ranking/Choice
		jQuery('.Quiz-Template-overflow .single_next_btn_container').each(function(){
			if(jQuery(this).hasClass('question_type_ranking_choices')) {
				jQuery(this).find('.question_add_answer_outer_div').sortable();
				jQuery(this).find('.sqb_is_right_ans').removeClass('.sqb_and_field');
			} 
		});
	}  
	
	//added for skip optin
	jQuery(document).on('click','.skip_optin', function() {
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');	
	 	var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
	   if(sqb_quiz_type == 'form'){
	   	jQuery('#'+sqb_quiz_container_outer_id+' .quiz_result_template_outer .outcome_div').show();
	   }

		var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 			  
		 //redirect calculations	
		outcomeRedirectCallBeforeReister(sqb_quiz_container_outer_id);
		
		var site_url = jQuery("#"+sqb_quiz_container_outer_id+ " #get_site_url").val();  
		var email =  "sqbguest@"+site_url;
		// register guest user		
		var sqb_quiz_type =jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();
		if(sqb_quiz_type == 'poll'){
			sqbSubmitVote(sqb_quiz_container_outer_id, "SQBGuest", email, 'no');
		}else{
			sqbRegisterUser(sqb_quiz_container_outer_id, "SQBGuest", email, 'no');
		}
	});


	jQuery(".display_message-popup-close").click(function() {  
		jQuery(".display_message-popup-outer").removeClass("display_message-popup-active");
	});
	
	var quiz_quesans_template_style = jQuery('.quiz_quesans_template1 .Quiz-Template').attr("style");
	jQuery('.quiz_quesans_template_outer .Quiz-Template').attr("style", quiz_quesans_template_style);	
	
	sqb_quiz_outcome_create();
	sqb_call_slider_for_answer_events('on_load');
	//sqbReinitializeBtnClicks();
	 //sqb_call_slider_for_answer_events();
	//append retake to outcome
	sqb_append_retake();
	sqb_file_upload_check();
	sqb_file_upload_action(); 	
	
	//share to unlock
	 sqb_click_to_share_btn();    
	 
	var bgColor =  jQuery('.quiz_start_template_outer .Quiz-Template-title').css('background-color');
	var bdrColor =  jQuery('.quiz_start_template_outer .start_temp_outer').css('border-color');
	var bdr =  jQuery('.quiz_start_template_outer .start_temp_outer').css('border');
	var max_width =  jQuery('.quiz_start_template_outer .start_temp_outer').css('max-width');
	
	jQuery('.quiz_firstname_template_outer .Quiz-Template-title').css('background-color' , bgColor); 
	jQuery('.quiz_firstname_template_outer .start_temp_outer').css('border' , bdr); 
	jQuery('.quiz_firstname_template_outer .start_temp_outer').css('border-color' , bdrColor); 
	jQuery('.quiz_firstname_template_outer .start_temp_outer').css('max-width' , max_width); 
	jQuery('.quiz_optin_template_outer .form_cls input, .quiz_optin_template_outer .form_cls textarea, .quiz_optin_template_outer .form_cls select').css('pointer-events','auto');
	
	
	
	 var show_not_passed_msg = jQuery('.show_not_passed_msg').val();	 
	 
	if(show_not_passed_msg == 'y'){
		jQuery(".markas_completed_btn").addClass("disableMarkBtn"); 	
	}
	
	jQuery( ' .sqb_quiz_container_outer').each(function(){
		jQuery('body').addClass('dap-body-overflow');	
	});
	
	var sqb_quiz_container_info = '';
	jQuery( ' .quiz_quesans_template_outer').each(function(){
			
		var sqb_quiz_id = jQuery(this).find("input[type='hidden'][id='quiz_id']").val();
		if (typeof sqb_quiz_id === "undefined") {
		}else{
			var sqb_quiz_current_page_id = jQuery(this).find("input[type='hidden'][id='sqb_quiz_current_page_id']").val();
			sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_page_visit');
		}
		sqb_save_lead_info_on_click_on_outcome_btn();		
		
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');	
		sqb_quiz_container_info = sqb_quiz_container_outer_id;
		//inblock the  markas completeonpageload
		//unlocking_markas_complete_onpageload();
		disable_ques_ans_lesson(sqb_quiz_container_outer_id);
		
		var element_id = jQuery(this).closest(".sqb_quiz_container_outer").attr('id');
		if(jQuery('#'+element_id).find('#show_start_screen').val() != 'Y'){
			sqb_all_question_view_insert(element_id);
		}

	});
	
	//check if usernot passed the quiz..this input is in lesson_complete
	if(jQuery(".show_not_passed_msg").length > 0){
		 var show_not_passed_msg = jQuery(".show_not_passed_msg").val(); 
		 var markedAsCompleted = jQuery(".markedAsCompleted").val(); 
		 if(show_not_passed_msg =="y" && markedAsCompleted != 'Y'){
			  var not_passed_quiz_msg = jQuery("#not_passed_quiz_msg").val();  
			  jQuery( "  .quiz_quesans_template_outer .Quiz-Template-overflow " ).after('<div class="not_passed_quiz_msg_outer" style="display: inline-block;">'+not_passed_quiz_msg+'</div>'); 
		 }
	 }	
	
	jQuery('.template_num_template6').each(function(){
		var inner_style = jQuery(this).find('.Quiz-Template:first').attr('style');
		if(typeof inner_style != "undefined"){
			jQuery(this).find('.quiz_firstname_template_outer').find('.Quiz-Template2.start_temp_outer').attr('style',inner_style);
		}
	});
	
	
	if(jQuery('#show_start_screen').val() == 'N' && jQuery('#quiz_display').val() == 'inpage'){
		 var sqb_opt_screen_position = jQuery('#sqb_opt_screen_position').val();
		 var sqb_show_optin = jQuery('#show_optin').val();
		 if(sqb_opt_screen_position == 'optin-before-questions-screen' && sqb_show_optin != 'N'){
			jQuery('.quiz_start_template_outer, .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');
			jQuery('.quiz_quesans_template_outer').addClass('hide_cls').removeClass('show_cls');
			//jQuery('.quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
			setTimeout(function() {
				autoSubmitOptin('');
			}, 50); 
		 }

		var sqb_quiz_type = jQuery("#sqb_quiz_type").val();
		if(sqb_quiz_type == 'form'){
			 jQuery('.quiz_start_template_outer, .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');
            jQuery('.quiz_quesans_template_outer').addClass('hide_cls').removeClass('show_cls');
            jQuery('.quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
		}
	}

	var gdpr_value = jQuery('#gdpr_compliance').val();
	var is_googlefont = jQuery('#is_googlefont').val();
	if(gdpr_value == 0 && is_googlefont == 1){

		jQuery(".sqb_quiz_container_outer").each(function( index ) {
			var sqb_quiz_container_outer_id = jQuery(this).attr('id');
			var global_font_family_title = jQuery('#'+sqb_quiz_container_outer_id+'.sqb_global_theme_enable_each_template .Quiz-Template2.start_temp_outer .Quiz-Template-title').css('font-family');
			if(global_font_family_title){
				global_font_family_title = global_font_family_title.replace(/^"(.*)"$/, '$1');
				var font_url = 'https://fonts.googleapis.com/css2?family='+global_font_family_title;
				var stylesheet = jQuery("<link>", {
					rel: "stylesheet",
					type: "text/css",
					href: font_url
				});
				stylesheet.appendTo("head");
			}

			var global_font_family_description = jQuery('#'+sqb_quiz_container_outer_id+'.sqb_global_theme_enable_each_template .Quiz-Template .question_details .question_description *').css('font-family');
			if(global_font_family_description){
				global_font_family_description = global_font_family_description.replace(/^"(.*)"$/, '$1');
				var font_url = 'https://fonts.googleapis.com/css2?family='+global_font_family_description;
				var stylesheet = jQuery("<link>", {
					rel: "stylesheet",
					type: "text/css",
					href: font_url
				});
				stylesheet.appendTo("head");
			}

			var global_font_family_answer_text = jQuery('#'+sqb_quiz_container_outer_id+'.sqb_global_theme_enable_each_template .Quiz-Template .question_add_answer_outer_div .sql_ans_text *').css('font-family');
			if(global_font_family_answer_text){
				global_font_family_answer_text = global_font_family_answer_text.replace(/^"(.*)"$/, '$1');
				var font_url = 'https://fonts.googleapis.com/css2?family='+global_font_family_answer_text;
				var stylesheet = jQuery("<link>", {
					rel: "stylesheet",
					type: "text/css",
					href: font_url
				});
				stylesheet.appendTo("head");
			}

			if(jQuery('#'+sqb_quiz_container_outer_id+' #show_start_screen').val() == 'N' && jQuery('#'+sqb_quiz_container_outer_id+' #quiz_display').val() == 'corner_popup'){

				var sqb_opt_screen_position = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_opt_screen_position').val();
				var sqb_show_optin = jQuery('#'+sqb_quiz_container_outer_id+' #show_optin').val();
				if(sqb_opt_screen_position == 'optin-before-questions-screen' && sqb_show_optin != 'N'){
					jQuery('#'+sqb_quiz_container_outer_id+' .quiz_start_template_outer, .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');
					jQuery('#'+sqb_quiz_container_outer_id+' .quiz_quesans_template_outer').addClass('hide_cls').removeClass('show_cls');
					jQuery('#'+sqb_quiz_container_outer_id+' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
				}
			}
		});
	}

	 var template5_width = jQuery('.sqb_template5-fullWidth').find('.Quiz-start-Template5.start_temp_outer').css('max-width');
	 if(template5_width == '1800px'){
		jQuery('.sqb_template5-fullWidth').find('.Quiz-start-Template5.start_temp_outer').css('max-width','');
	 }
	 
	 if(jQuery('.Quiz-start-Template5-left').hasClass('sqb_start_screen_background_image')){
	 /*var bg_image_size = parseInt(jQuery('.Quiz-start-Template5-left.sqb_start_screen_background_image').css('background-size'));
	 var final_image_size = bg_image_size + 400;	 
	 jQuery('.Quiz-start-Template5-left.sqb_start_screen_background_image').css('background-size',final_image_size+'px');*/
	 
	 var sqb_bg_img = jQuery('.Quiz-start-Template5-left').css('background-image');
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
	 jQuery('.Quiz-start-Template5-left').attr('style','');
	 var bg_img_tag = '<div class="quiz-bg-img" style="opacity:'+final_opacity+';"><img src="'+img_url[1]+'" alt="background"></div>';
	 jQuery('.Quiz-start-Template5-left .Quiz-Template5-title').before(bg_img_tag);
	 jQuery('.Quiz-start-Template5-left').css('background-color',final_color);
	 
	 }
	 
	 jQuery(".sqb_quiz_container_outer").each(function( index ) {
		var sqb_quiz_container_outer_id = jQuery(this).attr('id');
		if(jQuery('#'+sqb_quiz_container_outer_id+' #show_start_screen').val() == 'N'){
			sqb_call_slider_for_answer_events('start_screen_disabled');
		}
	});
	//retake in result page
	/*jQuery(document).on('click', ' .quiz_result_template_outer .retake_button',function(){
		location.reload(true);
	});	*/
	
	//skipped_btn
	/*jQuery(document).on('click', ' .skipped_btn',function(){
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var parent_ques_div = jQuery(this).closest('.question_container').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		if(quiz_display =="popup" ){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}
		jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .answer_container").addClass("answer_container_disabled");				 
		 //scroll to next question
		var next_questionid =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).closest('.Quiz-Template .question_container').next().attr('id');			 
		var display_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .question_container').last().attr('id');					 			 
		if(display_lastchild != parent_ques_div){					 
			sqbScrollToNextQuestion(next_questionid, sqb_quiz_container_outer_id); 
			enableNextButtonForLesson(next_questionid, sqb_quiz_container_outer_id); 						  
		}else{
			enable_see_detail(sqb_quiz_container_outer_id);
		}
		 
	});	*/
 
	/**single question** click*/	 
	//jQuery(document).on('click', '.sqb_quiz_container .single_cls input, .sqb_quiz_container .single_cls ' ,function(){
	jQuery(document).on('click', ' .quiz_ans_recommendation_html .sqb_cr_next_btn_div .sqb_next_btn' ,function(evt){
		evt.stopImmediatePropagation();
 		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
 		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}

 		var ans_attr_id = jQuery(this).closest('.sqb_cr_next_btn_div').attr('data-ans-attr-id');
 		if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
			if(jQuery('#'+sqb_quiz_container_outer_id).find('.ans_recommendation_show .sqb_ans_item[id="'+ans_attr_id+'"]').length != 0){
				jQuery('#'+sqb_quiz_container_outer_id).find('.ans_recommendation_show .sqb_ans_item[id="'+ans_attr_id+'"]').closest('.ans_recommendation_show').removeClass('sqb_ans_selected');
				jQuery('#'+sqb_quiz_container_outer_id).find('.ans_recommendation_show .sqb_ans_item[id="'+ans_attr_id+'"]').closest('.ans_recommendation_show').trigger('click');
				jQuery('#'+sqb_quiz_container_outer_id).find('.ans_recommendation_show .sqb_ans_item[id="'+ans_attr_id+'"]').closest('.Quiz-Template-overflow').show();
				jQuery(this).closest('.quiz_ans_recommendation_html').hide();
				
				/***********Show next Question**************/
				var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 
				
				//var parent_ques_div = jQuery(this).closest(".Quiz-Template").attr('id');
				var parent_ques_div = jQuery(this).closest(".Quiz-Template").find(".question_container").attr('id');
				var display_quesid_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');
				
				var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();	
				if(display_quesid_lastchild == parent_ques_div){
					var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();	 
					if(sqb_quiz_type == "personality"){
						personality_last_child_calculation(sqb_quiz_container_outer_id,  parent_ques_div, '');
					}else if(sqb_quiz_type == "assessment"){
						assessment_last_child_calculation(sqb_quiz_container_outer_id, parent_ques_div, '');
					}else if(sqb_quiz_type == "scoring"){
						scoring_last_child_calculation(sqb_quiz_container_outer_id,  parent_ques_div, '');
					}else if(sqb_quiz_type == "survey" || sqb_quiz_type == "calculator" ){			
						survey_last_child_calculation(sqb_quiz_container_outer_id,  parent_ques_div, '');
					}
				} else {
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
					jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find(".question_container").addClass('hide_cls').removeClass('show_cls');
					jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find(".question_container").next().addClass('show_cls').removeClass('hide_cls');
					if(sqb_quiz_type == 'scoring' || sqb_quiz_type == 'assessment'){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
					}
				}
				
				/***********************/
			}
		} 
	});

	jQuery(document).on('click', ' .quiz_ans_a_d_html_outer .sqb_next_btn' ,function(evt){

		evt.stopImmediatePropagation();
 		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
 		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}

		if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){


			var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 
			//console.log(quiz_temp_id);
			//var parent_ques_div = jQuery(this).closest(".Quiz-Template").attr('id');
			var parent_ques_div = jQuery(this).closest(".Quiz-Template").find(".question_container").attr('id');
			var display_quesid_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');

			jQuery('#'+quiz_temp_id).find('.Quiz-Template-overflow').show();
			jQuery('#'+quiz_temp_id).find('.quiz_ans_a_d_html_outer').hide();

			var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();

			if(display_quesid_lastchild == parent_ques_div){
				var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();	 
				if(sqb_quiz_type == "personality"){
					personality_last_child_calculation(sqb_quiz_container_outer_id,  parent_ques_div, '');
				}else if(sqb_quiz_type == "assessment"){
					assessment_last_child_calculation(sqb_quiz_container_outer_id, parent_ques_div, '');
				}else if(sqb_quiz_type == "scoring"){
					scoring_last_child_calculation(sqb_quiz_container_outer_id,  parent_ques_div, '');
				}else if(sqb_quiz_type == "survey" || sqb_quiz_type == "calculator" ){			
					survey_last_child_calculation(sqb_quiz_container_outer_id,  parent_ques_div, '');
				}
			} else {
				//console.log('test '+parent_ques_div);

				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
					sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
					jQuery('#'+quiz_temp_id).removeClass('is_a_d_active');
				}else{
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
					jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
					jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
					jQuery('#'+quiz_temp_id).removeClass('is_a_d_active');
				}
			}

		}
	});
	
	jQuery(document).on('click', '.quiz_type_poll .multiple_cls' ,function(evt){

		evt.stopImmediatePropagation();
		evt.preventDefault();
		
 		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
 		var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+ ' input#quiz_id').val();
 		var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container #sqb_quiz_type').val();
 		if(sqb_quiz_type =="poll"){

 			jQuery("#"+sqb_quiz_container_outer_id+ "	 .sqb_ans_item_outer input.sqb_and_field:checked");
 			if(jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_ans_item_outer.sqb_ans_selected').length > 0 && jQuery("#"+sqb_quiz_container_outer_id+ "	 .sqb_ans_item_outer input.sqb_and_field:checked").length > 0){
 				jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').removeAttr('disabled');
 			}else{
 				jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').attr('disabled', true);
 			}
 		}
	});

	jQuery(document).on('change', '.quiz_type_poll .multiple_cls.sqb_ans_item_outer input.sqb_and_field' ,function(evt){

		evt.stopImmediatePropagation();
		evt.preventDefault();
		
 		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
 		var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+ ' input#quiz_id').val();
 		var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container #sqb_quiz_type').val();
 		
 		if(sqb_quiz_type =="poll"){

 			if(jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_ans_item_outer.sqb_ans_selected').length > 0 && jQuery("#"+sqb_quiz_container_outer_id+ "	 .sqb_ans_item_outer input.sqb_and_field:checked").length > 0){
 				jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').removeAttr('disabled');
 			}else{
 				jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').attr('disabled', true);
 			}
 		}
	});
	
	var isProcessing = false;
	jQuery(document).on('click', ' .sqb_quiz_container .single_cls' ,function(evt){
		evt.stopImmediatePropagation();
		evt.preventDefault();

		

		console.log('Call');
 		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}
		
		if(jQuery(this).hasClass('ans_recommendation_enable') && jQuery('#'+sqb_quiz_container_outer_id+' #quiz_recommendation_option').val() == 'Y' && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all' && jQuery('#'+sqb_quiz_container_outer_id+' #show_next_button').val() == 'N'){
			jQuery(this).removeClass('ans_recommendation_enable');
			jQuery(this).addClass('ans_recommendation_show'); 
			var cr_ans_id = jQuery(this).find('.sqb_ans_item').attr('id');
			if(jQuery('#'+sqb_quiz_container_outer_id).find('.quiz_ans_recommendation_html').find('.sqb_ans_option_'+cr_ans_id).length != 0){
				var sqb_recommendation_enabled = jQuery('#'+sqb_quiz_container_outer_id).find('.quiz_ans_recommendation_html').find('.sqb_ans_option_'+cr_ans_id).attr('sqb_recommendation_enabled');
				if(sqb_recommendation_enabled == 'Y'){
				jQuery('#'+sqb_quiz_container_outer_id).find('.quiz_ans_recommendation_html').find('.sqb_ans_option_'+cr_ans_id).closest('.quiz_ans_recommendation_html').show().find('.sqb_cr_next_btn_div').attr('data-ans-attr-id',cr_ans_id);
				jQuery(this).closest('.Quiz-Template-overflow').hide();
				return false;
				}
			}
		}else{

			var qid = jQuery(this).attr('data-question-id');
			var qobj = jQuery(this).closest('#quiz_temp_id'+qid);
			//console.log(qobj.find('.quiz_ans_a_d_html_outer'));
			if(qobj.find('.quiz_ans_a_d_html_outer').length > 0 && jQuery('#'+sqb_quiz_container_outer_id+' #show_next_button').val() == 'N'){

				//if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
				//sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);

				qobj.find('.Quiz-Template-overflow').hide();
				qobj.find('.quiz_ans_a_d_html_outer').show();
				//console.log(qobj);
				qobj.addClass('is_a_d_active');
				return false;
			}
			//qobj.find('.Quiz-Template-overflow').hide();
			//qobj.find('.quiz_ans_a_d_html_outer').show();

			//console.log(jQuery(this).parent('#quiz_temp_id'+sqb_question_id));
		}
		
		var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+ ' input#quiz_id').val();
		var sqb_question_id = jQuery(this).attr('data-question-id');
		var sqb_answer_id = jQuery(this).attr('data-answer-id');
		var sqb_other_field = jQuery('#'+sqb_quiz_container_outer_id).find('.custom-other-box').val();
		var sqb_outcome_id = jQuery(this).attr('data-outcome-ids');	
		var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container #sqb_quiz_type').val();
		var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();
		var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();
		var parent_ques_div =  jQuery(this).closest('.question_container').attr('id');	
		var count_manage_lead_data = jQuery('#'+sqb_quiz_container_outer_id+ ' #count_manage_lead_data').val();	
		var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();
		var lesson_quiz =""	;		 
		if( lesson_id !=""  ){
			lesson_id = jQuery.isNumeric(lesson_id);
			if(lesson_id == true){
				display_correctans_options = "yes";
				lesson_quiz ="all";
			}
		}
 		  
		if(jQuery("#"+parent_ques_div).hasClass('single_fillin_text') ==true){
			display_correctans_options = "yes";
		}
		var current_ques_div_hgt = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).height(); 

		


		//if  quiz_type is personality
		if(sqb_quiz_type =="personality"){
			var show_next_button = jQuery('#'+sqb_quiz_container_outer_id+ ' input#show_next_button').val();
			if(show_next_button == 'N'){
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
			//check if the quiz_pagination == all
			if(lesson_quiz =="all"){				 

			}else if(quiz_pagination == 'all'){
				if(show_next_button == 'Y'){}else{
					show_all_questions_in_one_page(sqb_quiz_container_outer_id, parent_ques_div);
				}
			}else{			
				//check if show next button set to yes or not
				if(display_correctans_options == "yes"){	
				
									
				}else{ 			
					var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
					
					var sqbadvancedrule = sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
					if(sqbadvancedrule ==1){
						// progressbar
						sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);	
					}else{ 		
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
							sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
						}else{						
							
							//check if last child
							var display_quesid_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');
							if(display_quesid_lastchild == parent_ques_div){				 
								personality_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div );
							}else{	
								var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id');
								var template_selected = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num' ).val();
								var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
								 
									if(quiz_slider_animation =="Y" || template_selected == 'template5')	{						
										setTimeout(function() {	
											jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
											jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');	 
											jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
											jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');									
										}, 500); 
									}else{
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');	
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
									}
								 
								// progressbar
								sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
					
							}							 
						}							
					} 
					sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id,sqb_other_field);
					sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);
					 
					//function to go to the top of the visible div
					var nextdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).next().attr('id');
					quizScrollToDiv('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id, nextdiv_id, parent_ques_div, current_ques_div_hgt);
					sqb_apply_wid_css(sqb_quiz_container_outer_id); 	
				}			
			}			
		}else if(sqb_quiz_type =="poll"  ){ 
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_ans_item_outer.sqb_ans_selected').length > 0){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').removeAttr('disabled');
			}
			var show_next_button = jQuery('#'+sqb_quiz_container_outer_id+ ' input#show_next_button').val();
			if(show_next_button == 'N'){
				if(jQuery(this).find('.custom-checkbox-input').hasClass('custom_other_box')){
					jQuery(this).closest('.question_type_single').find('.custom-other-box').show();
					var placeholder = jQuery(this).find('.please-elaborate').attr('placeholder');
					jQuery(this).closest('.question_type_single').find('.custom-other-box').attr('placeholder', placeholder);
					jQuery(this).closest('.question_type_single').find('.single_next_btn').show();
					return false;
				}else{
					//jQuery(this).closest('.question_type_single').find('.single_next_btn').hide();
					jQuery(this).closest('.question_type_single').find('.custom-other-box').hide();
				}
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

			if(jQuery(this).find('.custom-checkbox-input').hasClass('custom_other_box')){
				jQuery(this).closest('.question_type_single').find('.custom-other-box').show();
				var placeholder = jQuery(this).find('.please-elaborate').attr('placeholder');
				jQuery(this).closest('.question_type_single').find('.custom-other-box').attr('placeholder', placeholder);
				jQuery(this).closest('.question_type_single').find('.single_next_btn').show();
			}else{
				jQuery(this).closest('.question_type_single').find('.custom-other-box').hide();
			}
			//jQuery('#'+sqb_quiz_container_outer_id+ 'btn-add-vote').removeAttr('disabled');
			
			//console.log(jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_ans_item_outer.sqb_ans_selected').length > 0);
			

			/*var show_next_button = jQuery('#'+sqb_quiz_container_outer_id+ ' input#show_next_button').val();
			if(show_next_button == 'N'){
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
			//check if the quiz_pagination == all
			if(lesson_quiz =="all"){				 

			}else if(quiz_pagination == 'all'){
				
			}else{			
				//check if show next button set to yes or not
				if(display_correctans_options == "yes"){	
				
									
				}else{ 			
					var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
					
					var sqbadvancedrule = sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
					if(sqbadvancedrule ==1){
						// progressbar
						sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);	
					}else{ 		
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
							sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
						}else{						
							
							//check if last child
							var display_quesid_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');
							if(display_quesid_lastchild == parent_ques_div){				 
								poll_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div );
							}else{	
								var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id');
								var template_selected = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num' ).val();
								var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
								 
									if(quiz_slider_animation =="Y" || template_selected == 'template5')	{						
										setTimeout(function() {	
											jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
											jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');	 
											jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
											jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');									
										}, 500); 
									}else{
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');	
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
									}
								 
								// progressbar
								sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
					
							}							 
						}							
					} 

					console.log(sqb_answer_id);
					sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id,sqb_other_field);
					sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);
					 
					//function to go to the top of the visible div
					var nextdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).next().attr('id');
					quizScrollToDiv('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id, nextdiv_id, parent_ques_div, current_ques_div_hgt);
					sqb_apply_wid_css(sqb_quiz_container_outer_id); 	
				}			
			}			
			*/


			return;

			var display_quesid_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');			
			var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');				 	 
			var hascorrect_ans = jQuery("#"+parent_ques_div+" .correct_ans_cls").hasClass('addselected');	

			if(display_quesid_lastchild == parent_ques_div){					 
				poll_last_child_calculation(sqb_quiz_container_outer_id, parent_ques_div);  						  
			}
			sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id,sqb_other_field);
			//sqbSubmitPolls();

		}else if(sqb_quiz_type =="assessment"  ){ //if  quiz_type is assessment 
			
			var show_next_button = jQuery('#'+sqb_quiz_container_outer_id+ ' input#show_next_button').val();
			if(show_next_button == 'N'){
				if(jQuery(this).find('.custom-checkbox-input').hasClass('custom_other_box')){
					jQuery(this).closest('.question_type_single').find('.custom-other-box').show();
					var placeholder = jQuery(this).find('.please-elaborate').attr('placeholder');
					jQuery(this).closest('.question_type_single').find('.custom-other-box').attr('placeholder', placeholder);
					jQuery(this).closest('.question_type_single').find('.single_next_btn').show();
					return false;
				}else{
					//jQuery(this).closest('.question_type_single').find('.single_next_btn').hide();
					jQuery(this).closest('.question_type_single').find('.custom-other-box').hide();
				}
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

			//check if correct answer show or not						 
			var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
			//check if correct answer or not
			var correct_ans_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();				 		 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .single_cls').removeClass('addselected');			 
			jQuery(this).addClass('addselected');				
			var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');				 	 
			var hascorrect_ans = jQuery("#"+parent_ques_div+" .correct_ans_cls").hasClass('addselected');	
			
			//show correct incorrect answer
			var display_ques_id = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
			var correct_answer_msg = jQuery('#'+parent_ques_div).find('.correct_answer_msg').val();
			var incorrect_answer_msg = jQuery('#'+parent_ques_div).find('.incorrect_answer_msg').val();			 
			
			//check if the quiz_pagination == all
			if(lesson_quiz =="all"){				 
				
			}else if(quiz_pagination == 'all'){
				if(show_next_button == 'Y'){}else{
					show_all_questions_in_one_page(sqb_quiz_container_outer_id, parent_ques_div);
				}
			}else{	 //check if the quiz_pagination == one per page
									
				//check if display_correctans_options  is not 	each_page or both
				if(display_correctans_options == "each_page" || display_correctans_options == "both"){					 
					
				}else if(display_correctans_options == "yes"){	//show next set to Y		 
					
				}else{
				if(show_next_button == 'Y'){

				}else{
					var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
					var sqbadvancedrule = sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
					if(sqbadvancedrule ==1){
						// progressbar
						sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);	
					}else{ 	
					
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
							sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
						}else{
							
							//check if last child
							var display_quesid_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');					
							if(display_quesid_lastchild == parent_ques_div){					 
								assessment_last_child_calculation(sqb_quiz_container_outer_id, parent_ques_div);  						  
							}else{
								var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id');
								var template_selected = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num' ).val();
								var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
							 
								if(quiz_slider_animation =="Y" || template_selected == 'template5')	{
									setTimeout(function() {	
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');	
										
									}, 500); 
								}else{
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');	
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
								}
								 
								// progressbar
								sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
					
							}
						}
					}
				}	

				if(show_next_button == 'Y'){

				}else{
						if(hascorrect_ans == true){				 
							var correct_ans_count = parseInt(correct_ans_count) + 1;						 
							jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(correct_ans_count); 		 
						}					
						
							
					sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
					sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);
					//function to go to the top of the visible div
					var nextdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).next().attr('id');
					quizScrollToDiv('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id,  nextdiv_id, parent_ques_div, current_ques_div_hgt);
					sqb_apply_wid_css(sqb_quiz_container_outer_id); 				
					}	
				} 			
			} 			
			
		}else if( sqb_quiz_type =="scoring"){ //if  quiz_type is scoring
				
			var show_next_button = jQuery('#'+sqb_quiz_container_outer_id+ ' input#show_next_button').val();
			if(show_next_button == 'N'){
				if(jQuery(this).find('.custom-checkbox-input').hasClass('custom_other_box')){
					jQuery(this).closest('.question_type_single').find('.custom-other-box').show();
					var placeholder = jQuery(this).find('.please-elaborate').attr('placeholder');
					jQuery(this).closest('.question_type_single').find('.custom-other-box').attr('placeholder', placeholder);
					jQuery(this).closest('.question_type_single').find('.single_next_btn').show();
					return false;
				}else{
					//jQuery(this).closest('.question_type_single').find('.single_next_btn').hide();
					jQuery(this).closest('.question_type_single').find('.custom-other-box').hide();
				}
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

			if(jQuery(this).find('.custom-checkbox-input').hasClass('custom_other_box')){
				jQuery(this).closest('.question_type_single').find('.custom-other-box').show();
				var placeholder = jQuery(this).find('.please-elaborate').attr('placeholder');
				jQuery(this).closest('.question_type_single').find('.custom-other-box').attr('placeholder', placeholder);
				jQuery(this).closest('.question_type_single').find('.single_next_btn').show();
			}else{
				jQuery(this).closest('.question_type_single').find('.custom-other-box').hide();
			}


			//check if correct answer or not
			var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
			var correct_ans_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();	
			var hascorrect_ans = jQuery(this).hasClass('correct_ans');			 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .single_cls').removeClass('addselected');			 
			jQuery(this).addClass('addselected');	
			var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
			//show correct incorrect answer
			var display_ques_id = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
			//var show_correct_incorrect_ans = jQuery('#'+display_ques_id).find('.show_correct_incorrect_ans').val();
			var correct_answer_msg = jQuery('#'+parent_ques_div).find('.correct_answer_msg').val();
			var incorrect_answer_msg = jQuery('#'+parent_ques_div).find('.incorrect_answer_msg').val();
			
			//var show_next_button = 'Y';
			//check if the quiz_pagination == all
			if(lesson_quiz =="all"){				 
			
			}else if(quiz_pagination == 'all'){
				if(show_next_button == 'Y'){}else{

					var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(); 	
					var points_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(); 	
					var hasaddselected = jQuery("#"+parent_ques_div+" .sqb_ans_item_outer").hasClass('addselected');
					if(hasaddselected == true){	
						var data_point = jQuery(this).attr("data-point");				 
						var sqb_points_ans = parseInt(data_point)+ parseInt(sqb_points_ans);
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(sqb_points_ans); 	
						var get_max_points_count = getmaxDataPoints(parent_ques_div, sqb_quiz_container_outer_id) ;
						var points_count = parseInt(get_max_points_count)+ parseInt(points_count);
						jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(points_count);		
							
					}

					show_all_questions_in_one_page(sqb_quiz_container_outer_id, parent_ques_div);
					sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
					if(show_next_button == 'Y'){ 
					}else{
					//condition for quiz_type = scoring				 
					var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(); 	
					var points_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(); 	
					var hasaddselected = jQuery("#"+parent_ques_div+" .sqb_ans_item_outer").hasClass('addselected');
					if(hasaddselected == true){	
						var data_point = jQuery(this).attr("data-point");				 
						var sqb_points_ans = parseInt(data_point)+ parseInt(sqb_points_ans);
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(sqb_points_ans); 	
						var get_max_points_count = getmaxDataPoints(parent_ques_div, sqb_quiz_container_outer_id) ;
						var points_count = parseInt(get_max_points_count)+ parseInt(points_count);
						jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(points_count);		
							
					} 	
				}
				}
				
			}else{	
				//check if display_correctans_options  is not 	each_page or both
				if(display_correctans_options == "each_page" || display_correctans_options == "both"){					 
					
				}else if(display_correctans_options == "yes"){	//show next set to Y			 
					
				}else{	
				if(show_next_button == 'Y'){

				}else{			 
					var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
					var sqbadvancedrule = sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
					if(sqbadvancedrule ==1){
						// progressbar
						sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);	
					}else{ 							
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
							sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
						}else{
							 
							//check if last child
							var display_quesid_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');
							if(display_quesid_lastchild == parent_ques_div){
								jQuery('#'+sqb_quiz_container_outer_id+ ' .single_cls').css('pointer-events', 'none');
								scoring_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div ) ;
							}else{
								var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id');
								var template_selected = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num' ).val();
								var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
								if(quiz_slider_animation =="Y" || template_selected == 'template5')	{
									jQuery('#'+sqb_quiz_container_outer_id+ ' .single_cls').css('pointer-events', 'none');
									setTimeout(function() {	
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' .single_cls').css('pointer-events', 'auto');
									}, 500); 
								}else{
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
									jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
									jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
								}
								// progressbar
								sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
					
							}
							 
						}
					}
				}
					var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');	
					if(show_next_button == 'Y'){ 
					}else{
					//condition for quiz_type = scoring				 
					var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(); 	
					var points_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(); 	
					var hasaddselected = jQuery("#"+parent_ques_div+" .sqb_ans_item_outer").hasClass('addselected');
					if(hasaddselected == true){	
						var data_point = jQuery(this).attr("data-point");				 
						var sqb_points_ans = parseInt(data_point)+ parseInt(sqb_points_ans);
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(sqb_points_ans); 	
						var get_max_points_count = getmaxDataPoints(parent_ques_div, sqb_quiz_container_outer_id) ;
						var points_count = parseInt(get_max_points_count)+ parseInt(points_count);
						jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(points_count);		
							
					} 				
					
					sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
					sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);
					
					//function to go to the top of the visible div
					var nextdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).next().attr('id');

						var quiz_scroll_allow = page_question_animation_visiblity_check(".Quiz-Template.show_cls .question_title");
						if (!quiz_scroll_allow) {
							quizScrollToDiv('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id,  nextdiv_id, parent_ques_div, current_ques_div_hgt);
						}
					sqb_apply_wid_css(sqb_quiz_container_outer_id); 
					}					
				}			
			}			
					
		}else if( sqb_quiz_type =="calculator"){ //if  quiz_type is calculator type
			var show_next_button = jQuery('#'+sqb_quiz_container_outer_id+ ' input#show_next_button').val();
			if(show_next_button == 'N'){
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
			
			//check if correct answer or not
			var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
			var correct_ans_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();				 		 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .single_cls').removeClass('addselected');						 
			jQuery(this).addClass('addselected');	
			var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');	
			if(jQuery("#"+parent_ques_div).hasClass('single_fillin_text') ==true){
				display_correctans_options = "yes";
			}	
			
				//check if the quiz_pagination == all
			if(lesson_quiz =="all"){				 
	
			}else if(quiz_pagination == 'all'){
				if(show_next_button == 'Y'){}else{
					show_all_questions_in_one_page(sqb_quiz_container_outer_id, parent_ques_div);
				}
			}else if(display_correctans_options == "yes"){

			}else{	

				if(show_next_button == 'Y'){

				}else{	
				
				
					 
					var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
					var sqbadvancedrule = sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
					if(sqbadvancedrule ==1){
						// progressbar
						sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);	
					}else{ 	
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
							sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
						}else{				
							
							//check if last child
							var display_quesid_lastchild = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');
							if(display_quesid_lastchild == parent_ques_div){	
								jQuery('#'+sqb_quiz_container_outer_id+ ' .single_cls').css('pointer-events', 'none');		 
								calculator_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div ) ;	      
							}else{	
								var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 
								var template_selected = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num' ).val();
								var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
								 
								if(quiz_slider_animation =="Y" || template_selected == 'template5')	{									 				 
									setTimeout(function() {	
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls ').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
										
									}, 500); 
								}else{	
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');							 
									jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
									jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
								}
								// progressbar
								sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
					
							}
						}
					}
						
					var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');					 	 
					var hascorrect_ans = jQuery("#"+parent_ques_div+" .sqb_ans_item_outer").hasClass('addselected');	
						 
					if(hascorrect_ans == true){				 
						var correct_ans_count = parseInt(correct_ans_count) + 1;						 
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(correct_ans_count); 		 
					}
					 
					
					sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
					sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);
					
					//function to go to the top of the visible div
					var nextdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).next().attr('id');
					quizScrollToDiv('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id,  nextdiv_id, parent_ques_div, current_ques_div_hgt);	
					sqb_apply_wid_css(sqb_quiz_container_outer_id); 
				}
			} 
		}else{ //survey type
			var show_next_button = jQuery('#'+sqb_quiz_container_outer_id+ ' input#show_next_button').val();
			if(show_next_button == 'N'){
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


			//check if correct answer or not
			var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
			var correct_ans_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();				 		 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .single_cls').removeClass('addselected');						 
			jQuery(this).addClass('addselected');	
			var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');	
			if(jQuery("#"+parent_ques_div).hasClass('single_fillin_text') ==true){
				display_correctans_options = "yes";
			}	
			
				//check if the quiz_pagination == all
			if(lesson_quiz =="all"){				 
	
			}else if(quiz_pagination == 'all'){
				if(show_next_button == 'Y'){}else{
					show_all_questions_in_one_page(sqb_quiz_container_outer_id, parent_ques_div);
				}
			}else{	
				
				//check if show nest button set to yes or not
				if(display_correctans_options == "yes"){
				}else{	
					 
					var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
					var sqbadvancedrule = sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
					if(sqbadvancedrule ==1){
						// progressbar
							sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
					}else{
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
							sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
						}else{				
							
							//check if last child
							var display_quesid_lastchild = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');
							if(display_quesid_lastchild == parent_ques_div){				 
								survey_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div ) ;       
							}else{	
								var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 
								var template_selected = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num' ).val();
								var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
								 
								if(quiz_slider_animation =="Y" || template_selected == 'template5')	{									 				 
									setTimeout(function() {	
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls ').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
										
									}, 500); 
								}else{	
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');							 
									jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
									jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
								}
								// progressbar
								sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
					
							}
						}
					}
						
					var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');					 	 
					var hascorrect_ans = jQuery("#"+parent_ques_div+" .sqb_ans_item_outer").hasClass('addselected');	
						 
					if(hascorrect_ans == true){				 
						var correct_ans_count = parseInt(correct_ans_count) + 1;						 
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(correct_ans_count); 		 
					}
					 
					
					sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
					sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);
					
					//function to go to the top of the visible div
					var nextdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).next().attr('id');
					quizScrollToDiv('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id,  nextdiv_id, parent_ques_div, current_ques_div_hgt);	
					sqb_apply_wid_css(sqb_quiz_container_outer_id); 
				}
			}
		}// end of if else
		 
		
		 		
		//for report table
		var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='quiz_id']").val();
		var sqb_quiz_current_page_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='sqb_quiz_current_page_id']").val();
		//sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_last_question_btn_click');
		
		// for manage_lead table
		var user_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #user_id').val();
		
		//sqb_lead_save(user_id,how_many_answed, 'lead_outcome_show');
		isProcessing = false;	
	});
	
	jQuery(document).on('click',' .quiz_type_poll .single_next_btn_container .single_next_btn ' ,function(evt){


		evt.stopImmediatePropagation();


		jQuery('.custom-other-box').hide();
	  	var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');


	  	if(jQuery('#'+sqb_quiz_container_outer_id+ ' .js-is-poll-open-error').val() == 1 || jQuery('#'+sqb_quiz_container_outer_id+ ' .js-is-poll-close-error').val() == 1){
	  		return false;
	  	}

	  	// hide all chart until complete request and get all data

	  	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
				jQuery(this).html(jQuery(this).html().replace('[ShowPollResults]', '<div class="ShowPollResultsChart hide_cls">[ShowPollResults]</div>'));
		});

	  	var is_outcome_redirect =   jQuery('#'+sqb_quiz_container_outer_id+ ' input#poll_redirect').val();

	  	/* Poll T */
	  	if(is_outcome_redirect == 'Y'){

	  		var jthis = this;
	  		var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+ ' input#quiz_id').val();
	  		/*if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').addClass('is-loading');
		  		}else{
					jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').addClass('is-loading');
		  		}*/
			/*jQuery.post(ajaxurl, {
					action: 'sqb_validate_poll',
					quiz_id: sqb_quiz_id,
			
			}, function(response) {
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
							jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').removeClass('is-loading');
				  		}else{
							jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').removeClass('is-loading');
				  		}

				response = JSON.parse(response);
				if(response.status == 'ok'){*/

			

			  		var parent_ques_div =  jQuery(jthis).closest(".question_container").attr('id');
				  	var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container #sqb_quiz_type').val();
					var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
					if(jQuery(jthis).closest(".question_container").hasClass('question_type_matrix')){
					var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected');
					}else{
						var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected');			
					}
					

					var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+ ' input#quiz_id').val();
					var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
					var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');
					var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');
					 
					if(lesson_quiz =="all"){					
						nextbutton_calculation_lesson(sqb_quiz_container_outer_id, parent_ques_div);
					}else if(quiz_pagination == 'all'){
						if(show_next_button == 'Y'){}else{
						show_all_questions_in_one_page(sqb_quiz_container_outer_id, parent_ques_div);
					}
						
					}else{
						
						var sqbadvancedrule = sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
						if(sqbadvancedrule ==1){
							
							// progressbar
							sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
						}else{
							
							if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
								sqb_find_next_question_for_funnel_new(jthis,parent_ques_div, sqb_quiz_container_outer_id);
								
							}else{	
								var show_recommendation_screen = false;
								if(jQuery(jthis).closest('.question_container').find('.sqb_ans_selected').hasClass('ans_recommendation_enable') && jQuery('#'+sqb_quiz_container_outer_id+' #quiz_recommendation_option').val() == 'Y' && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
									show_recommendation_screen = true;
								}

								var ads_screen = false;
								var type = '';
								if(jQuery('#quiz_temp_id'+sqb_question_id).find('.quiz_ans_a_d_html_outer').length > 0 && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
									ads_screen = true;
									type = 'ads';
								}
									 
									//check if last child
									var display_quesid_lastchild = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');

									if(display_quesid_lastchild == parent_ques_div){
										if(show_recommendation_screen || ads_screen){
										sqb_show_recommendation_screen_fn(jthis,sqb_quiz_container_outer_id,type);
										} else {
										sqb_save_question_answer_report_poll(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id,sqb_other_field);

										poll_last_child_calculation(sqb_quiz_container_outer_id, parent_ques_div);
										}
									}else{ //last ques ends
										
										if(show_recommendation_screen || ads_screen){
										sqb_show_recommendation_screen_fn(jthis,sqb_quiz_container_outer_id,type);
										} else {

											

											var quiz_temp_id = jQuery(jthis).closest('.Quiz-Template').attr('id'); 
											//console.log(jQuery(jthis));
											var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
											if(quiz_slider_animation =="Y")	{	
												setTimeout(function() {	
													jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
													jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
													jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
													jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
													
												}, 500); 
											}else{

												jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
												jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
												jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
												jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');

											}
										}
									}
							}
						}

					 
					// enter data in question and answer table
					

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
					} 
					
					if(matrix_cls == true){
						var sqb_answer_id  = getMultipleAnswerIds(parent_ques_div, sqb_quiz_container_outer_id);
					} 
					
					var sqb_other_field = jQuery('#'+parent_ques_div).find('.custom-other-box').val();
					var only_question = '';
					sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id,only_question,only_question,sqb_other_field);
					//sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);
					var quiz_temp_id = jQuery(jthis).closest('.Quiz-Template').attr('id');
					//function to go to the top of the visible div
					var nextdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).next().attr('id');
					quizScrollToDiv('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id,  nextdiv_id, parent_ques_div, current_ques_div_hgt);
					sqb_apply_wid_css(sqb_quiz_container_outer_id); 
				}

			/*}else{
					
					jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-vote-error').show();
					jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-vote-error').html(response.message);
				}
			});*/



	  	/* End Poll T */ 

	  	}else{


			var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
			
			if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
				sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
			}
			
			var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
			var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
			
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.sqb_uploded_filename').remove();
			


			//jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.sqb_ans_item_outer .file-upload-error').hide();
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.sqb_ans_item_outer .file-upload-error-message').hide();
			
			if(jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).hasClass('question_type_file_upload')){
				var filename = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').val();
				var sqb_ans_selected = 0;
				if(filename != ''){
					var sqb_ans_selected = 1;
				}
			} else {
				var sqb_ans_selected = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
			}
			//if multiple correct ans
			
			var parent_hasClass = false;
			var matrix_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('matrix_cls'); 
			var has_multiple_correct_cls =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');
			var has_ranking_cls =  jQuery(this).closest(".question_container").hasClass('question_type_ranking_choices');

			if(matrix_cls){
				parent_hasClass = true;
			}
			if(has_multiple_correct_cls){
				parent_hasClass = true;
			}
			if(has_ranking_cls){
				parent_hasClass = true;
			}
			
			var allow_skip_ques =  jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .allow_skip_ques").val();
			jQuery("#"+sqb_quiz_container_outer_id+ " .correctincorrect_ans_div ").remove();
			var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();
			var count_manage_lead_data = jQuery('#'+sqb_quiz_container_outer_id+ ' #count_manage_lead_data').val();	
			var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();
			var lesson_quiz =""	;	
			
			if( lesson_id !=""  ){	
				/*if( count_manage_lead_data > 0  ){				 
					lesson_quiz ="all";
				}*/	
				lesson_id = jQuery.isNumeric(lesson_id);
				if(lesson_id == true){				 
					lesson_quiz ="all";
				}			
				 
			}
			//allow skip
			if(allow_skip_ques == "Y"){
			}else{
				if(sqb_ans_selected > 0){	
					
					
					if(matrix_cls == true){
						var total_class= jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer").length;
							var selected_class = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
						
							if(total_class > selected_class){
								sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(),   sqb_quiz_container_outer_id , parent_ques_div);
								return false;
							}
					}			
				}else{
					
					
					
					sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(),   sqb_quiz_container_outer_id , parent_ques_div);
					return false;
				} 	
			} 	
			var current_ques_div_hgt = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).height(); 
			
			var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+  ' input#quiz_id').val();


			if(jQuery(this).closest(".question_container").hasClass('question_type_matrix')){
				var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected');
			}else{
				var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected');			
			}



			var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
			var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');
			var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');







			var sqb_other_field = jQuery('#'+parent_ques_div).find('.custom-other-box').val();
			var display_quesid_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');			
			var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');				 	 
			var hascorrect_ans = jQuery("#"+parent_ques_div+" .correct_ans_cls").hasClass('addselected');	

			if(parent_hasClass == true){
				var sqb_answer_id  = getMultipleAnswerIds(parent_ques_div, sqb_quiz_container_outer_id);	 	 
			} 

			/*if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').addClass('is-loading');
	  		}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').addClass('is-loading');
	  		}*/

			sqb_save_question_answer_report_poll(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id,sqb_other_field);
			if(display_quesid_lastchild == parent_ques_div){					 
				poll_last_child_calculation(sqb_quiz_container_outer_id, parent_ques_div);  						  
			}
			
		}

	});



	jQuery('.quiz_quesans_template_outer .Quiz-Template-outer div.Quiz-Template:first').find('.single_back_btn').remove();
	
	//backbutton for personality
	jQuery(document).on('click',' .quiz_type_personality .single_next_btn_container .single_back_btn ' ,function(evt){
		evt.stopImmediatePropagation();
		jQuery('.custom-other-box').hide();
	  	var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		
		if(quiz_display == "popup" || quiz_display == "corner_popup"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}
		var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
		var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
		var current_ques_div_hgt = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).height(); 
		var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+  ' input#quiz_id').val();

		if(jQuery(this).closest(".question_container").hasClass('question_type_matrix')){
			var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected');
		}else{
			var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected');			
		}
		var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
		var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');
		var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');
		var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 


		var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
		if(quiz_slider_animation =="Y")	{	

			jQuery('#'+sqb_quiz_container_outer_id).removeClass('quiz-slide-animation');

			if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
				var prevdiv_id = sqb_find_back_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
				//prevdiv_id = Object.values(prevdiv_id)
				prevdiv_id = "quiz_temp_id"+prevdiv_id;
			}else{
				var prevdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).prev().attr('id');
			}

			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls').removeClass('show_cls');

			jQuery('#'+sqb_quiz_container_outer_id).find("#"+prevdiv_id).addClass('show_cls').removeClass('hide_cls');
			jQuery('#'+sqb_quiz_container_outer_id).find("#"+prevdiv_id).removeClass('done_question');
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer' ).find("#"+prevdiv_id).addClass('show_cls').removeClass('hide_cls');

			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).prev().find('.answer_container').addClass('back-btn-enabled');
			var show_back_button_change = jQuery('#'+sqb_quiz_container_outer_id+ ' #show_back_button_change').val();	
			if(show_back_button_change == 'notallow'){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).prev().find('.answer_container').addClass('disable_answer');
			}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).prev().find('.sqb_ans_item_outer.sqb_ans_selected').each(function(){									
						var question_id = jQuery(this).attr('data-question-id');
						jQuery('.sqb_question_answer_hidden[data-id="'+question_id+'"]').remove();
						jQuery('.sqb_question_answer_hidden_report[data-id="'+question_id+'"]').remove();

				});
			}

			setTimeout(function(){
				jQuery('#'+sqb_quiz_container_outer_id).addClass('quiz-slide-animation');
			}, 500);

		}else{

			if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
				var prevdiv_id = sqb_find_back_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
				//prevdiv_id = Object.values(prevdiv_id)
				prevdiv_id = "quiz_temp_id"+prevdiv_id;
			}else{
				var prevdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).prev().attr('id');
			}
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls').removeClass('show_cls');
			jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
			jQuery('#'+sqb_quiz_container_outer_id).find("#"+prevdiv_id).addClass('show_cls').removeClass('hide_cls');
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer' ).find("#"+prevdiv_id).addClass('show_cls').removeClass('hide_cls');

			var show_back_button_change = jQuery('#'+sqb_quiz_container_outer_id+ ' #show_back_button_change').val();	
			
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).prev().find('.answer_container').addClass('back-btn-enabled');
			if(show_back_button_change == 'notallow'){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).prev().find('.answer_container').addClass('disable_answer');
			}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).prev().find('.sqb_ans_item_outer.sqb_ans_selected').each(function(){									
						var question_id = jQuery(this).attr('data-question-id');
						jQuery('.sqb_question_answer_hidden[data-id="'+question_id+'"]').remove();
						jQuery('.sqb_question_answer_hidden_report[data-id="'+question_id+'"]').remove();

				});
			}
			if(quiz_temp_id != undefined){
				quizScrollToDiv('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id, prevdiv_id, parent_ques_div, current_ques_div_hgt);
			}
			sqb_apply_wid_css(sqb_quiz_container_outer_id); 
		}
	});

	/*............................................................*/


	



	jQuery(document).on('click',' .sqb-return-poll' ,function(evt){
		evt.stopImmediatePropagation();
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').addClass('show_cls').removeClass('hide_cls');
		//jQuery('.question_add_answer_outer_div-result').remove();
		//jQuery('.question_add_answer_outer_div').addClass('show_cls').removeClass('hide_cls');

		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-view-result').addClass('show_cls').removeClass('hide_cls');
		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-return-poll').addClass('hide_cls').removeClass('show_cls');

		setQuestionScreen(sqb_quiz_container_outer_id);

	});
	jQuery(document).on('click',' .sqb-view-result' ,function(evt){
		evt.stopImmediatePropagation();
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
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
				//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('show_cls').removeClass('hide_cls');	
				jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').addClass('hide_cls').removeClass('show_cls');
				//jQuery('#'+sqb_quiz_container_outer_id+ ' .question_add_answer_outer_div-result').remove();
				//jQuery('#'+sqb_quiz_container_outer_id+ ' .question_add_answer_outer_div').after('<div class="question_add_answer_outer_div-result">'+html+'</div>');
				//jQuery('#'+sqb_quiz_container_outer_id+ ' .question_add_answer_outer_div').addClass('hide_cls').removeClass('show_cls');
				setResultScreen(sqb_quiz_container_outer_id,response.counts,'');

				jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-return-poll').addClass('show_cls').removeClass('hide_cls');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-change-vote-count').html(count_vote);
				jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-view-result').addClass('hide_cls').removeClass('show_cls');
			}
		});
	});

	jQuery(document).on('click',' .sqb-change-vote' ,function(evt){
		evt.stopImmediatePropagation();
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
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
				//jQuery('.question_add_answer_outer_div-result').hide();
				
				/*jQuery('.question_add_answer_outer_div-result').remove();
				jQuery('.question_add_answer_outer_div').addClass('show_cls_poll').removeClass('hide_cls');*/
				setQuestionScreen(sqb_quiz_container_outer_id);

				jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-change-vote').addClass('hide_cls').removeClass('show_cls');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').attr('disabled', true);

				if(jQuery('#'+sqb_quiz_container_outer_id+ ' .js-is-poll-view-result').val() == 'Y'){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-view-result').addClass('show_cls').removeClass('hide_cls');
				}

				// Reset selected 
				
			}else{

				jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-vote-error').show();
				jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-vote-error').html(response.message);
			}
		});
			

		});

	//nextbutton for personality
	jQuery(document).on('click',' .quiz_type_personality .single_next_btn_container .single_next_btn ' ,function(evt){
		evt.stopImmediatePropagation();
		jQuery('.custom-other-box').hide();
	  	var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}
		
		var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
		var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
		
		jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.sqb_uploded_filename').remove();
		


		//jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.sqb_ans_item_outer .file-upload-error').hide();
		jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.sqb_ans_item_outer .file-upload-error-message').hide();
		
		if(jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).hasClass('question_type_file_upload')){
			var filename = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').val();
			var sqb_ans_selected = 0;
			if(filename != ''){
				var sqb_ans_selected = 1;
			}
		} else {
			var sqb_ans_selected = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
		}
		//if multiple correct ans
		
		var parent_hasClass = false;
		var matrix_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('matrix_cls'); 
		var has_multiple_correct_cls =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');
		var has_ranking_cls =  jQuery(this).closest(".question_container").hasClass('question_type_ranking_choices');
		var email_class = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('email_cls'); 
		if(email_class){

			var val = jQuery('#'+parent_ques_div).find('.sqb_email_ans_field').val();
	 		var email_error_message = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-emailmessage');
	 		var email_required = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-isreq');
			if(email_required == 'Y'){
				if(val == ''){
					jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
					jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+email_error_message+'</b></div>');
					return false;
				}else if(!sqbValidateEmail(val)){
					jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
					jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+email_error_message+'</b></div>');
					return false;
				}else{
					
				}
			}
			var email_val = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_email_ans_field").val();
 			jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_direct_signup #email").val(email_val);
		}

		if(matrix_cls){
			parent_hasClass = true;
		}
		if(has_multiple_correct_cls){
			parent_hasClass = true;
		}
		if(has_ranking_cls){
			parent_hasClass = true;
		}
		
		var allow_skip_ques =  jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .allow_skip_ques").val();
		jQuery("#"+sqb_quiz_container_outer_id+ " .correctincorrect_ans_div ").remove();
		var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();
		var count_manage_lead_data = jQuery('#'+sqb_quiz_container_outer_id+ ' #count_manage_lead_data').val();	
		var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();
		var lesson_quiz =""	;	
		
		if( lesson_id !=""  ){	
			/*if( count_manage_lead_data > 0  ){				 
				lesson_quiz ="all";
			}*/	
			lesson_id = jQuery.isNumeric(lesson_id);
			if(lesson_id == true){				 
				lesson_quiz ="all";
			}			
			 
		}
		//allow skip
		if(allow_skip_ques == "Y"){
		}else{
			if(sqb_ans_selected > 0){	
				
				
				if(matrix_cls == true){
					var total_class= jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer").length;
						var selected_class = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
					
						if(total_class > selected_class){
							sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(),   sqb_quiz_container_outer_id , parent_ques_div);
							return false;
						}
				}			
			}else{
				
				
				var sqb_email_type  =  jQuery(this).closest(".question_container").hasClass('question_type_email');
				var sqb_phone_type = jQuery(this).closest(".question_container").hasClass('question_type_phone_number');
				
				if(sqb_email_type == true){
				}else if(sqb_phone_type == true){
				}else{
					sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(),   sqb_quiz_container_outer_id , parent_ques_div);
					return false;
				}


			} 	
		} 	
		var current_ques_div_hgt = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).height(); 
		
		var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+  ' input#quiz_id').val();


		if(jQuery(this).closest(".question_container").hasClass('question_type_matrix')){
			var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected');
		}else{
			var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected');			
		}

		var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
		var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');

		var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');

		// Set Rule for Multiple choice Questions, always get first outcome rule
		if(jQuery(this).closest(".question_container").hasClass('question_type_multi')){
			jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected').each(function(){
				if(jQuery(this).attr('data-outcomerule-id') > 0){
					sqb_answer_id = jQuery(this).attr('data-answer-id');
					sqb_outcome_id = jQuery(this).attr('data-outcomerule-id');
					return false;
				}
			});
		}


		if(lesson_quiz =="all"){	
			 nextbutton_calculation_lesson(sqb_quiz_container_outer_id, parent_ques_div);
		}else if(quiz_pagination == 'all'){
			if(show_next_button == 'Y'){}else{
					show_all_questions_in_one_page(sqb_quiz_container_outer_id, parent_ques_div);
				}
		}else{
			var sqbadvancedrule = sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
			if(sqbadvancedrule ==1){
				// progressbar
				sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
			}else{
				var type = '';
				var ads_screen = false;
				if(jQuery('#quiz_temp_id'+sqb_question_id).find('.quiz_ans_a_d_html_outer').length > 0 && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
					ads_screen = true;
					type = 'ads';
				}


				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){

					if(ads_screen){
						sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id, 'ads');
					}else{
						sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
					}

					//sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
				}else{	
					var show_recommendation_screen = false;
					
					//console.log(jQuery(this).closest('.question_container').find('.sqb_ans_selected'));
					//console.log(jQuery('#'+sqb_quiz_container_outer_id+' #quiz_recommendation_option').val());
					if(jQuery(this).closest('.question_container').find('.sqb_ans_selected').hasClass('ans_recommendation_enable') && jQuery('#'+sqb_quiz_container_outer_id+' #quiz_recommendation_option').val() == 'Y' && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
						show_recommendation_screen = true;
					}
					//check if last child

					

					var display_quesid_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');
					if(display_quesid_lastchild == parent_ques_div){
						if(show_recommendation_screen || ads_screen){
							sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id,type);
						} else {

							personality_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div ) ;
						}				
					}else{
								
					if(show_recommendation_screen || ads_screen){
							sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id,type);
					} else {	
							var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 						
							var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
							if(quiz_slider_animation =="Y")	{	
								setTimeout(function() {	
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
									jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
									jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');								

								}, 500); 
							}else{
								jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
								jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
								jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
								jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
							}
						}
						// progressbar
						sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
					}		
				}		
			}		
  
			 
			// enter data in question and answer table			
		 
			var sqb_other_field = jQuery('#'+parent_ques_div).find('.custom-other-box').val();
			if (typeof sqb_question_id === "undefined" || (sqb_question_id == 0)){
				sqb_question_id = jQuery('#'+parent_ques_div).find('.single_cls').attr('data-question-id');
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
			} 

		 	var only_question = '';
			sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id,only_question,only_question,sqb_other_field);
			sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);
			//function to go to the top of the visible div
			if(quiz_temp_id != undefined){
				var nextdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).next().attr('id');
				quizScrollToDiv('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id, nextdiv_id, parent_ques_div, current_ques_div_hgt);
			}
			sqb_apply_wid_css(sqb_quiz_container_outer_id); 
		}
		var slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
		if(slider_animation == 'N'){
			setTimeout(function(){
				jQuery('#'+sqb_quiz_container_outer_id+' .show_cls').find('.numeric_text_cls').addClass('sqb_ans_selected');
	 			jQuery('.numerical_text_cls.show_cls .numeric-value-prefix input').focus();
	 		},500)
		}
		
	});
	
	
	//nextbutton for assessment		 
	jQuery(document).on('click',' .quiz_type_assessment .single_next_btn_container .single_next_btn ' ,function(evt){
			
			evt.stopImmediatePropagation();
			jQuery('.custom-other-box').hide();
			var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
			var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
			
			if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
				sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
			}
			//check if correct answer or not			
			var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
			var correct_ans_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();						
			var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
			
			var parent_hasClass =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');
			var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();
			var display_ques_id = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
			//show correct incorrect answer
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.sqb_uploded_filename').remove();		 
			
			var correct_answer_msg = sqb_correct_msg(parent_ques_div, sqb_quiz_container_outer_id);
			var incorrect_answer_msg = sqb_incorrect_msg(parent_ques_div, sqb_quiz_container_outer_id);

			var hascorrect_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls").length;
			var hascorrect_checkbox_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls .checkbox_fe:checked").length;	

			//check if show correct incorrect answer or next question
			var showfirsttime =jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_quiz_next_button_click").val();
			var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();	
		
 
			jQuery("#"+sqb_quiz_container_outer_id+ " .correctincorrect_ans_div ").remove();
			jQuery('#'+sqb_quiz_container_outer_id+  ' .answer_container').removeClass("answer_container_disabled");
			
			var allow_skip_ques = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .allow_skip_ques").val();	
			var count_manage_lead_data = jQuery('#'+sqb_quiz_container_outer_id+ ' #count_manage_lead_data').val();	
			var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();
			var lesson_quiz =""	; 
			if( lesson_id !=""  ){					 
				lesson_id = jQuery.isNumeric(lesson_id);
				if(lesson_id == true){
					//display_correctans_options = "yes";
					if(display_correctans_options == "yes"){
						display_correctans_options = "result_page";
					} 
					lesson_quiz ="all";
				} 
			} 
			var current_ques_div_hgt = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).height();    
			var fill_in_blank_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('fill_in_blank_cls'); 
			var text_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('text_cls'); 
			var date_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('date_cls'); 
			var email_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('email_cls'); 
			var phone_number_text_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('phone_number_text_cls'); 
			var slider_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('slider_cls'); 
			var file_upload_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('file_upload_cls'); 
			var matrix_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('matrix_cls'); 
			var numeric_text_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('numeric_text_cls');
			var dropdown_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('dropdown_cls');			
			var matching_text_cls   = jQuery("#"+sqb_quiz_container_outer_id+ "  #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('matching_text');
			//for free text
			var numeric_cls_enabled = false;
			var matching_text_enabled = false;	
			
			var email_class = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('email_cls'); 
			if(email_class){

				var val = jQuery('#'+parent_ques_div).find('.sqb_email_ans_field').val();
		 		var email_error_message = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-emailmessage');
		 		var email_required = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-isreq');
				if(email_required == 'Y'){
					if(val == ''){
						jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
						jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+email_error_message+'</b></div>');
						return false;
					}else if(!sqbValidateEmail(val)){
						jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
						jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+email_error_message+'</b></div>');
						return false;
					}else{
						
					}
				}
				var email_val = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_email_ans_field").val();
	 			jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_direct_signup #email").val(email_val);
			}

			if(fill_in_blank_cls ==true){							 
				var gotonext = true;								 					
			}else if(text_cls ==true){								 
				var gotonext = true;
			}else if(email_cls ==true){								 
				var gotonext = true;
			}else if(phone_number_text_cls ==true){								 
				var gotonext = true;														 	
			}else if(date_cls ==true){								 
				var gotonext = true;													 	
			}else if(slider_cls ==true){								 
				var gotonext = true;													 	
			}else if(numeric_text_cls ==true){								 
				//var gotonext = true;
				numeric_cls_enabled = true;
			}else if(matching_text_cls ==true){								 
				var gotonext = false;
				matching_text_enabled = true;															 	
			}else if(dropdown_cls ==true){								 
				var gotonext = true;													 	
			}else if(matrix_cls == true){
				//var gotonext = true;
				 //parent_hasClass = true;
			}else{
				var gotonext = false; 	 
			}
			
			if(file_upload_cls){
				parent_hasClass = false;
			}
			if(jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).hasClass('question_type_file_upload')){
				var filename = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').val();			
				if(filename != ''){
					jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_quiz_next_button_click").val(1);
					var showfirsttime = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_quiz_next_button_click").val();
					sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
				} 
			}
		 
			if(showfirsttime == 0){
			//check if display_correctans_options  is not 	each_page or both
				if(display_correctans_options == "each_page" || display_correctans_options == "both" || display_correctans_options == "yes" || display_correctans_options == "result_page"|| display_correctans_options == "no"){					
						
					if(parent_hasClass == true){
						
						var hascorrect_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls").length;
						var hascorrect_checkbox_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls .checkbox_fe:checked").length;
						var total_checked = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer .checkbox_fe:checked").length;
											 
						if(hascorrect_count == hascorrect_checkbox_count && total_checked == hascorrect_checkbox_count){	
							if(gotonext == true){
								var correct_ans_count = parseInt(correct_ans_count);							 												 	
							}else{
								var correct_ans_count = parseInt(correct_ans_count) + 1;	 
							}			 
																			 
							jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(correct_ans_count); 
							//allow skip
							if(allow_skip_ques == "Y"){
							}else{	
								if( display_correctans_options == "yes" || display_correctans_options == "no"){
									 
								}else{								
									//show correct msg
									sqb_correctmsg_display(correct_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);		
								}						
							}						
						}else{
							var checkbox_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer .checkbox_fe:checked").length;							
							
							//allow skip
							if(allow_skip_ques == "Y"){
							}else{	
								//if(lesson_quiz =="all"){
								//}else{
									
									if(checkbox_count > 0){
										if( display_correctans_options == "yes" || display_correctans_options == "no"){
											 
										}else{	
											if(display_correctans_options =='result_page'){
												 
											}else{
												//show incorrect msg 
												sqb_incorrectmsg_display(incorrect_answer_msg,  sqb_quiz_container_outer_id , parent_ques_div);
											}
										}
									}else{
										if( display_correctans_options == "yes"){	
										}else{	
											sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(), sqb_quiz_container_outer_id, parent_ques_div);
											return false;
										}
									}
								//}	
								
							}
							
						}
						
					}else{
						
						var hascorrect_ans = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .correct_ans_cls").hasClass('addselected');	
						var allow_skip_ques =  jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .allow_skip_ques").val();		 
						 			 
						if(hascorrect_ans == true){				 
							if(gotonext == true){
								var correct_ans_count = parseInt(correct_ans_count);							 												 	
							}else{
								var correct_ans_count = parseInt(correct_ans_count) + 1;	 
							}	
							jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(correct_ans_count); 		
							//allow skip
							if(allow_skip_ques == "Y"){
							}else{
								//if(lesson_quiz =="all"){
								//}else{	
									if(gotonext == true){
									}else{
										if( display_correctans_options == "yes" || display_correctans_options == "no"){
										}else{	
											//show correct msg
											sqb_correctmsg_display(correct_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);	
										}
									}
								//}							
							}							
						}else{
						 
							if(jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).hasClass('question_type_file_upload')){
								var filename = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').val();
								var sqb_ans_selected = 0;
								if(filename != ''){
									var sqb_ans_selected = 1;
								}
							} else {
								var sqb_ans_selected = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
							}
							
							//allow skip
							if(allow_skip_ques == "Y"){
							}else{	
								 
								if(sqb_ans_selected > 0){
									 
									//if(lesson_quiz =="all"){
									//}else{
										 
										if(gotonext == true){
										}else{
											
											if(matrix_cls == true){
												var total_class= jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer").length;
													var selected_class = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
												
													if(total_class > selected_class){
														sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(),   sqb_quiz_container_outer_id , parent_ques_div);
														return false;
														//gotonext = true ;
													}else{
														gotonext = true ;
													}
											
												}else if(matching_text_cls == true){ 

													var mt_correct_answer_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.correct_answer_msg').val();
													var mt_incorrect_answer_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.incorrect_answer_msg').val();
													//isSentenceMatch();
													if(jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer .sqb_input_ans_field").find('.sentence-not-matched').length > 0){
														if(mt_incorrect_answer_msg != ''){
															sqb_incorrectmsg_display(mt_incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
														}else if(incorrect_answer_msg){
															sqb_incorrectmsg_display(incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
														}else{
															gotonext = true ;
														}
														
													}else{
														
														
													var correct_ans_count = parseInt(correct_ans_count);
													var correct_ans_count = parseInt(correct_ans_count) + 1;
													jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(correct_ans_count);

														if(mt_correct_answer_msg != ''){
															sqb_correctmsg_display(mt_correct_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
														}else if(correct_answer_msg){
															sqb_correctmsg_display(correct_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);	
														}else{
															gotonext = true ;
														}
													}


												}else if(numeric_text_cls == true){ 
													var data_correct_value = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer.sqb_ans_selected").attr("data-correct-value");
													var input_text_num = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer .sqb_and_field").val();
													if(input_text_num == data_correct_value){

													var correct_ans_count = parseInt(correct_ans_count);
													var correct_ans_count = parseInt(correct_ans_count) + 1;
													jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(correct_ans_count);
													
														sqb_correctmsg_display(correct_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
													}else{
														sqb_incorrectmsg_display(incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
													}

											}else{
												if( display_correctans_options == "yes" || display_correctans_options == "no"){
												 
												}else{											
													 
													sqb_incorrectmsg_display(incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
																								
												}
											}
											
											/*if( display_correctans_options == "yes"){	
											}else{	
												//show incorrect msg 
												sqb_incorrectmsg_display(incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
											}*/
										//}
									}
								}else{
									 
									if(gotonext == true){
										
									}else{
										 sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(), sqb_quiz_container_outer_id, parent_ques_div);
											return false;
										/*if( display_correctans_options == "yes"){	
										}else{	
											sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(), sqb_quiz_container_outer_id, parent_ques_div);
											return false;
										}*/
									}
								}
								 
							}
						}
					}
					 
					jQuery('#'+sqb_quiz_container_outer_id+  ' #'+parent_ques_div+'  .answer_container').addClass("answer_container_disabled");
					jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_quiz_next_button_click").val(1);
					//check if last child
					var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
					var display_quesid_lastchild = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');
					
					if(lesson_quiz =="all"){
					}else{
						if(display_quesid_lastchild == parent_ques_div){ 
						} else{
							// progressbar
							sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
					
						}
					}
					 
					//allow skip
					if(allow_skip_ques == "Y"){
						jQuery('.correctincorrect_ans_div ').remove();
						jQuery('#'+sqb_quiz_container_outer_id+  ' #'+parent_ques_div+'  .answer_container').removeClass("answer_container_disabled");
					}else{
						/*if(lesson_quiz =="all"){
							jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_quiz_next_button_click").val(0);
							jQuery('.correctincorrect_ans_div ').remove();
							jQuery('#'+sqb_quiz_container_outer_id+ ' .answer_container').removeClass("answer_container_disabled");
						}else{*/
							if(gotonext == true || display_correctans_options == "no"){
							}else{
								if( display_correctans_options == "yes" || display_correctans_options =='result_page'){	
								}else{	
									return false;
								}					 
							}					 
						//}					 
					}					 
					
				}
			} 	
			 
			var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container #sqb_quiz_type').val();
			var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
			if(jQuery(this).closest(".question_container").hasClass('question_type_matrix')){
			var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected');
			}else{
				var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected');			
			}
		
			var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+ ' input#quiz_id').val();
			var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
			var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');
			var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');
			 
			// Set Rule for Multiple choice Questions, always get first outcome rule
			if(jQuery(this).closest(".question_container").hasClass('question_type_multi')){
				jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected').each(function(){
					if(jQuery(this).attr('data-outcomerule-id') > 0){
						sqb_answer_id = jQuery(this).attr('data-answer-id');
						sqb_outcome_id = jQuery(this).attr('data-outcomerule-id');
					}
				});
			}


			if(lesson_quiz =="all"){					
				nextbutton_calculation_lesson(sqb_quiz_container_outer_id, parent_ques_div);
			}else if(quiz_pagination == 'all'){
				if(show_next_button == 'Y'){}else{
					show_all_questions_in_one_page(sqb_quiz_container_outer_id, parent_ques_div);
				}
			}else{
				var sqbadvancedrule = sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
				if(sqbadvancedrule ==1){
					// progressbar
					sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
				}else{

					var ads_screen = false;
					var type = '';
					if(jQuery('#quiz_temp_id'+sqb_question_id).find('.quiz_ans_a_d_html_outer').length > 0 && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
						ads_screen = true;
						type = 'ads';
					}

					if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
						if(ads_screen){
							sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id, 'ads');
						}else{
							sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
						}
						
					}else{	
						var show_recommendation_screen = false;
						if(jQuery(this).closest('.question_container').find('.sqb_ans_selected').hasClass('ans_recommendation_enable') && jQuery('#'+sqb_quiz_container_outer_id+' #quiz_recommendation_option').val() == 'Y' && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
							show_recommendation_screen = true;
						}

							
							 
							//check if last child
							var display_quesid_lastchild = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');

							if(display_quesid_lastchild == parent_ques_div){
								if(show_recommendation_screen || ads_screen){
								sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id,type);
								} else {
								assessment_last_child_calculation(sqb_quiz_container_outer_id, parent_ques_div);
								}
							}else{ //last ques ends
								
								if(show_recommendation_screen || ads_screen){
								sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id,type);
								} else {
									var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 
									var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
									if(quiz_slider_animation =="Y")	{	
										setTimeout(function() {	
											jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
											jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
											jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
											jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
											
										}, 500); 
									}else{
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');

									}
								}
							}
					}
				}

			 
			// enter data in question and answer table
			

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
			} 
			
			if(matrix_cls == true){
				var sqb_answer_id  = getMultipleAnswerIds(parent_ques_div, sqb_quiz_container_outer_id);
			} 
			
			var sqb_other_field = jQuery('#'+parent_ques_div).find('.custom-other-box').val();
			var only_question = '';
			sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id,only_question,only_question,sqb_other_field);
			sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);
			var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id');
			//function to go to the top of the visible div
			var nextdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).next().attr('id');
			quizScrollToDiv('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id,  nextdiv_id, parent_ques_div, current_ques_div_hgt);
			sqb_apply_wid_css(sqb_quiz_container_outer_id); 
		}
		var slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
		if(slider_animation == 'N'){
			setTimeout(function(){
				jQuery('#'+sqb_quiz_container_outer_id+' .show_cls').find('.numeric_text_cls').addClass('sqb_ans_selected');
	 			jQuery('.numerical_text_cls.show_cls .numeric-value-prefix input').focus();
	 		},500)
		}
	});
	
	/*if(jQuery('.sqb_ans_item').hasClass('sqb_ans_item_slider')){
		jQuery('.sqb_ans_slider').bootstrapSlider().change(function(e) {
			jQuery(this).closest('.sqb_ans_item_outer.slider_cls.sqb_ans_selected').attr('data-point', this.value);
		});
	}*/
	


	//nextbutton for scoring	
	 
		 
	jQuery(document).on('click', ' .quiz_type_scoring .single_next_btn_container .single_next_btn ' ,function(evt){
		
		evt.stopImmediatePropagation();	
	 	jQuery('.custom-other-box').hide();
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}	 
		
		//var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
		
		var display_quesid =  jQuery(this).closest(".question_container").attr('id');	
		
		var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();
		var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
		var correct_ans_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();			 
		var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');	
		jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.sqb_uploded_filename').remove();
		 	 
		var hascorrect_ans = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .correct_ans_cls").hasClass('addselected');	
		  
		var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
		var ques_parent_div =  jQuery(this).closest(".question_container").attr('id');
		var parent_hasClass =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');
		
		var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(); 	
		var points_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val();
			
			
		var display_ques_id = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
		//show correct incorrect answer		 
		var correct_answer_msg = sqb_correct_msg(parent_ques_div, sqb_quiz_container_outer_id);
		var incorrect_answer_msg = sqb_incorrect_msg(parent_ques_div, sqb_quiz_container_outer_id);

		var hascorrect_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls").length;
		var hascorrect_checkbox_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls .checkbox_fe:checked").length;	
		//check if show correct incorrect answer or next question
		var showfirsttime = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_quiz_next_button_click").val();
		var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();	
		 
		jQuery("#"+sqb_quiz_container_outer_id+ " .correctincorrect_ans_div ").remove();
		jQuery("#"+sqb_quiz_container_outer_id+ " .answer_container").removeClass("answer_container_disabled");
		var allow_skip_ques = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .allow_skip_ques").val();	
		var count_manage_lead_data = jQuery('#'+sqb_quiz_container_outer_id+ ' #count_manage_lead_data').val();	
		var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();
		var lesson_quiz =""	;	
 
		if(display_correctans_options == "no"){
			display_correctans_options = "result_page";
		} 
		if( lesson_id !=""  ){				 		 
			lesson_id = jQuery.isNumeric(lesson_id);
			if(lesson_id == true){
				//display_correctans_options = "both";
				if(display_correctans_options == "yes"){
						display_correctans_options = "result_page";
				}  
				
				lesson_quiz ="all";
			} 
			 
		}
		
		var current_ques_div_hgt = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).height();  
		var fill_in_blank_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('fill_in_blank_cls'); 
		var text_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('text_cls'); 
		var email_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('email_cls'); 
		var phone_number_text_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('phone_number_text_cls'); 
		var date_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('date_cls'); 
		var slider_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('slider_cls'); 
		var file_upload_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('file_upload_cls');
		var matrix_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('matrix_cls'); 
		var numeric_text_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('numeric_text_cls');
		var matching_text_cls   = jQuery("#"+sqb_quiz_container_outer_id+ "  #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('matching_text');
		var dropdown_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('dropdown_cls');
		var matrix_cls_enabled = false;
		var numeric_cls_enabled = false;
		var matching_text_enabled = false;

		var email_class = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('email_cls'); 
		if(email_class){

			var val = jQuery('#'+parent_ques_div).find('.sqb_email_ans_field').val();
	 		var email_error_message = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-emailmessage');
	 		var email_required = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-isreq');
			if(email_required == 'Y'){
				if(val == ''){
					jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
					jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+email_error_message+'</b></div>');
					return false;
				}else if(!sqbValidateEmail(val)){
					jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
					jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+email_error_message+'</b></div>');
					return false;
				}else{
					
				}
			}
			var email_val = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_email_ans_field").val();
 			jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_direct_signup #email").val(email_val);
		}

		 //for free text
		if(fill_in_blank_cls ==true){							 
			var gotonext = true;								 					
		}else if(text_cls ==true){								 
			var gotonext = true;	
		}else if(email_cls ==true){								 
			var gotonext = true;
		}else if(phone_number_text_cls ==true){								 
			var gotonext = true;													 	
		}else if(date_cls ==true){								 
			var gotonext = true;													 	
		}else if(slider_cls == true){								 
			var gotonext = false;													 	
		}else if(dropdown_cls == true){								 
			var gotonext = false;													 	
		}else if(numeric_text_cls ==true){								 
			var gotonext = false;
			numeric_cls_enabled = true;
		}else if(matching_text_cls ==true){								 
			var gotonext = false;
			matching_text_enabled = true;															 	
		}else if(matrix_cls == true){
			//var gotonext = true;
			 //parent_hasClass = true;
			 matrix_cls_enabled = true;
		}else{
			var gotonext = false; 	 
		}
		
		if(file_upload_cls){
			parent_hasClass = false;
		}

		if(jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).hasClass('question_type_file_upload')){
			var filename = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').val();			
			if(filename != ''){
				jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_quiz_next_button_click").val(1);
				var showfirsttime = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_quiz_next_button_click").val();
				sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
			} 
		} 
						 
		
		if(showfirsttime == 0){
			  
		//check if display_correctans_options  is not 	each_page or both
			if(display_correctans_options == "each_page" || display_correctans_options == "both" || display_correctans_options == "yes" || display_correctans_options == "result_page"|| display_correctans_options == "no"){					 
				   
				if(parent_hasClass == true){		
							 				 
					 
					var hascorrect_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls").length;
					var hascorrect_checkbox_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls .checkbox_fe:checked").length;
					var total_checked = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer .checkbox_fe:checked").length;
						 
					if(hascorrect_count == hascorrect_checkbox_count && total_checked == hascorrect_checkbox_count){	
						if(gotonext == true){
							var correct_ans_count = parseInt(correct_ans_count);	
						}else{				
							var correct_ans_count = parseInt(correct_ans_count) + 1;	
						}				
						 
						//allow skip
						if(allow_skip_ques == "Y"){
						}else{	
							if(lesson_quiz =="all"){
							}else{	
								if(gotonext == true){
								}else{	
									if( display_correctans_options == "yes" || display_correctans_options == "no"){	
									}else{							
										//show correct msg
										sqb_correctmsg_display(correct_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);	
									}							
								}							
							}							
						}							
					}else{
						//show incorrect msg 
						//sqb_incorrectmsg_display(incorrect_answer_msg);
						var checkbox_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer .checkbox_fe:checked").length;
						//allow skip
						if(allow_skip_ques == "Y"){
						}else{								
							if(checkbox_count > 0){
								if(lesson_quiz =="all"){
								}else{
									if(gotonext == true){
									}else{	
									if( display_correctans_options == "yes" || display_correctans_options == "no"){	
									}else{	
										if(display_correctans_options =='result_page'){
											
										}else{
											//show incorrect msg 
											sqb_incorrectmsg_display(incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
											}
										}
									}
								}
							}else{
								/*if(lesson_quiz =="all"){
								}else{*/
									if(gotonext == true){
									}else{
										if( display_correctans_options == "yes" ){	
										}else{	
											sqb_incorrectmsg_display(jQuery("#"+sqb_quiz_container_outer_id+ " #required_answer").val(), sqb_quiz_container_outer_id, parent_ques_div);
											return false;
										}
									}
								//}
							}							 
						}						
					}
					
					//calculate the points 
					var multi_ans_total_points = 0;
					var multi_ans_given_total_points = 0;
					
					//added for matrix	
					if(matrix_cls_enabled == true){		
							
						jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  tr.matrix_cls ").each(function(){	
							var heightnum = [];					 
							jQuery(this).find(".checkbox_fe").each(function(){								 				 
								var multi_ans_points = jQuery(this).attr('data-assigned-value');						 
								heightnum.push(multi_ans_points);
							});
							
							multi_ans_points = Math.max.apply(Math, heightnum);											 
							multi_ans_total_points = multi_ans_total_points + parseInt(multi_ans_points);
						});
	 
						jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .matrix_cls .checkbox_fe:checked").each(function(){
							var multi_ans_given_points = jQuery(this).attr('data-assigned-value');		
							multi_ans_given_total_points = multi_ans_given_total_points + parseInt(multi_ans_given_points);
						}); 
					}else{
						
						jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .multiple_correct_checkbox .checkbox_fe").each(function(){						 
							var multi_ans_points = jQuery(this).closest('.multiple_correct_checkbox').attr('data-point');						 
							multi_ans_total_points = multi_ans_total_points + parseInt(multi_ans_points);
						});
	 
						jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .multiple_correct_checkbox .checkbox_fe:checked").each(function(){
							var multi_ans_given_points = jQuery(this).closest('.multiple_correct_checkbox').attr('data-point');
							multi_ans_given_total_points = multi_ans_given_total_points + parseInt(multi_ans_given_points);
						});
					}	

					 
					var sqb_points_ans = parseInt(multi_ans_given_total_points)+ parseInt(sqb_points_ans);					 
					jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(sqb_points_ans); 			 
					//var get_max_points_count = getmaxDataPoints(parent_ques_div, sqb_quiz_container_outer_id) ;
					var points_count = parseInt(multi_ans_total_points)+ parseInt(points_count);
					jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(points_count);
				
				}else{
				  	
					var hasaddselected =jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('sqb_ans_selected');
					var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(); 	
					
					 
					if(hascorrect_ans == true){	
						
						if(gotonext == true){							 	
						}else{				
							var correct_ans_count = parseInt(correct_ans_count) + 1;	
						}					 
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(correct_ans_count); 	
						//allow skip
						if(allow_skip_ques == "Y"){
						}else{
							//if(lesson_quiz =="all"){
							//}else{
								if(gotonext == true){
								}else{
									if( display_correctans_options == "yes" || display_correctans_options == "no"){	
									}else{	
										if(display_correctans_options =='result_page'){
											
										}else{
											//show correct msg
											sqb_correctmsg_display(correct_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);	
										}
									}							
								}							
							//}							
						}							
					}else{
					
						if(jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).hasClass('question_type_file_upload')){
							var filename = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').val();
							var sqb_ans_selected = 0;
							if(filename != ''){
								var sqb_ans_selected = 1;
							}
						} else {
							var sqb_ans_selected = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
						}				
						
						//allow skip
						if(allow_skip_ques == "Y"){
						}else{
							
								if(sqb_ans_selected > 0){
									//if(lesson_quiz =="all"){
									//}else{
										if(gotonext == true){
										}else{
											
											if(display_correctans_options =='result_page' || display_correctans_options == "no"){
												if(matrix_cls == true){
												
												
												var total_class= jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer").length;
												var selected_class = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
												
												if(total_class > selected_class){
												sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(),   sqb_quiz_container_outer_id , parent_ques_div);
												return false;
												}
												
												}

												if(numeric_text_cls == true){
													console.log('validation here');
												}

											}else{
												
												if(matrix_cls == true){
													var total_class= jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer").length;
													var selected_class = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
												
													if(total_class > selected_class){
														sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(),   sqb_quiz_container_outer_id , parent_ques_div);
														return false;
														//gotonext = true ;
													}else{
														gotonext = true ;
													}
												
												}else if(slider_cls == true){ 
													gotonext = true ;
												}else if(matching_text_cls == true){ 

													var mt_correct_answer_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.correct_answer_msg').val();
													var mt_incorrect_answer_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.incorrect_answer_msg').val();
													//isSentenceMatch();
													if(jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer .sqb_input_ans_field").find('.sentence-not-matched').length > 0){
														if(mt_incorrect_answer_msg != ''){
															sqb_incorrectmsg_display(mt_incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
														}else if(incorrect_answer_msg){
															sqb_incorrectmsg_display(incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
														}else{
															gotonext = true ;
														}
														
													}else{
														if(mt_correct_answer_msg != ''){
															sqb_correctmsg_display(mt_correct_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
														}else if(correct_answer_msg){
															sqb_correctmsg_display(correct_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);	
														}else{
															gotonext = true ;
														}
													}

												}else if(numeric_text_cls == true){ 
													var data_correct_value = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer.sqb_ans_selected").attr("data-correct-value");
													var input_text_num = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer .sqb_and_field").val();
													if(input_text_num == data_correct_value){
														sqb_correctmsg_display(correct_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
													}else{
														sqb_incorrectmsg_display(incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
													}
												}else if(dropdown_cls == true){
													gotonext = true ;
												} else {
													
													sqb_incorrectmsg_display(incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
												}
											}
											/*if( display_correctans_options == "yes"){	
											}else{	
											//show incorrect msg 
												sqb_incorrectmsg_display(incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
											}*/
										}
									//}
									 
								}else{
									if(gotonext == true){
									}else{
										/*if( display_correctans_options == "yes"){	
										}else{	
										
										}*/
										sqb_incorrectmsg_display(jQuery("#"+sqb_quiz_container_outer_id+ " #required_answer").val(), sqb_quiz_container_outer_id, parent_ques_div);
										return false;
									}
								}
							
						}
						 
					}
					
					//if free text then skip the point addition
					if(gotonext == true){
							
					}else{
						
						if(jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).hasClass('question_type_file_upload')){
							var filename = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').val();
							var sqb_ans_selected = 0;
							if(filename != ''){
								var sqb_ans_selected = 1;
							}
						} else {
							var sqb_ans_selected = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
						}
						
						if(matrix_cls_enabled == true){
						var data_point = 0;
						var points_count = 0;		
						var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
						var get_max_points_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val();
						
						jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  tr.matrix_cls ").each(function(){	
							var heightnum = [];					 
							jQuery(this).find(".checkbox_fe").each(function(){								 				 
								var multi_ans_points = jQuery(this).attr('data-assigned-value');
												 
								heightnum.push(multi_ans_points);
							});
							
							multi_ans_points = Math.max.apply(Math, heightnum);											 
							get_max_points_count = parseInt(get_max_points_count) + parseInt(multi_ans_points);
							
						});
	 
						jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .matrix_cls .checkbox_fe:checked").each(function(){
							var multi_ans_given_points = jQuery(this).attr('data-assigned-value');		
							sqb_points_ans = parseInt(sqb_points_ans) + parseInt(multi_ans_given_points);
						}); 
						} else if(slider_cls ==true){							
							var data_point = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+ ' .sqb_ans_item_outer').find('.sqb_ans_slider').attr("data-value");
							var data_points_array = [];		   
						 	jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+ ' .sqb_ans_item_outer').each(function(){
								var data_points = jQuery(this).find('.sqb_ans_slider').attr("data-slider-max");
								data_points_array.push(data_points);	 
							});		 
							var get_max_points_count = Math.max.apply(Math,data_points_array);
						} else if(numeric_text_cls ==true){
							
							var data_point = 0;
							var data_correct_value = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer.sqb_ans_selected").attr("data-correct-value");
							var input_text_num = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer .sqb_and_field").val();
							if(input_text_num == data_correct_value){
								var data_point = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer.sqb_ans_selected").attr("data-point");
							}
							var get_max_points_count = getmaxDataPoints(parent_ques_div, sqb_quiz_container_outer_id) ;
						} else if(matching_text_cls ==true){
							var data_point = calculate_match_points(jQuery(" #"+parent_ques_div));
							var get_max_points_count = getmaxDataPointsForMatchingType(parent_ques_div, sqb_quiz_container_outer_id) ;
						}else{
							var data_point = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer.addselected").attr("data-point");
							var get_max_points_count = getmaxDataPoints(parent_ques_div, sqb_quiz_container_outer_id) ;
						}
						if(typeof(data_point) == 'undefined'){
							data_point = 0;
						}
						if(sqb_ans_selected >0){
							var sqb_points_ans = parseInt(data_point)+ parseInt(sqb_points_ans);		
						 } 
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(sqb_points_ans); 
						
						if(sqb_ans_selected >0){
							var points_count = parseInt(get_max_points_count)+ parseInt(points_count);		
						 } 						 
						jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(points_count);						
					 }
					
				}
				//jQuery('#'+sqb_quiz_container_outer_id+ ' .answer_container').addClass("answer_container_disabled");
				jQuery("#"+sqb_quiz_container_outer_id+" #"+parent_ques_div+" .sqb_quiz_next_button_click").val(1);
				//check if last child
				//var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
				var display_quesid_lastchild = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');
				if(lesson_quiz =="all"){
					}else{
						if(display_quesid_lastchild == parent_ques_div){ 
						} else{
							// progressbar
							sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
					
						}
					}
				//return false;
				//allow skip
				if(allow_skip_ques == "Y"){
					jQuery('.correctincorrect_ans_div ').remove();
					jQuery('.answer_container').removeClass("answer_container_disabled");
				}else{		 
					/*if(lesson_quiz =="all"){
						jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_quiz_next_button_click").val(0);
						jQuery('.correctincorrect_ans_div ').remove();
						jQuery('.answer_container').removeClass("answer_container_disabled");
					}else{*/
						if(gotonext == true){
							
						}else{
							if(slider_cls ==false || dropdown_cls == false){
								if( display_correctans_options == "yes" || display_correctans_options =='result_page'){
								}else{	
									return false;
								}		
							}
						}		
					//}	
				}
			}
			
		}  
		 	 
		    var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container #sqb_quiz_type').val();
			//var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
			jQuery('.answer_container').removeClass("answer_container_disabled");
				if(jQuery(this).closest(".question_container").hasClass('question_type_matrix')){
					var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected');
				}else{
					var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected');			
				}
				var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+ ' input#quiz_id').val();
				var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
				var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');
				var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');
				
				// Set Rule for Multiple choice Questions, always get first outcome rule
				if(jQuery(this).closest(".question_container").hasClass('question_type_multi')){
					jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected').each(function(){
						if(jQuery(this).attr('data-outcomerule-id') > 0){
							sqb_answer_id = jQuery(this).attr('data-answer-id');
							sqb_outcome_id = jQuery(this).attr('data-outcomerule-id');
						}
					});
				}

			//check if the quiz_pagination == all
				if(lesson_quiz =="all"){	
					nextbutton_calculation_lesson(sqb_quiz_container_outer_id, parent_ques_div);
				}else if(quiz_pagination == 'all'){
					if(show_next_button == 'Y'){}else{
						show_all_questions_in_one_page(sqb_quiz_container_outer_id, parent_ques_div);
					}
				}else{
					var sqbadvancedrule = sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
					if(sqbadvancedrule ==1){
						// progressbar
						sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
					}else{
						var ads_screen = false;
						var type = '';
						if(jQuery('#quiz_temp_id'+sqb_question_id).find('.quiz_ans_a_d_html_outer').length > 0 && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
							ads_screen = true;
							type = 'ads';
						}
						// check funnel is active 
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
							if(ads_screen){
								sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id, 'ads');
							}else{
								sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
							}
							
						}else{   
					 		var show_recommendation_screen = false;
							if(jQuery(this).closest('.question_container').find('.sqb_ans_selected').hasClass('ans_recommendation_enable') && jQuery('#'+sqb_quiz_container_outer_id+' #quiz_recommendation_option').val() == 'Y' && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
								show_recommendation_screen = true;
							}					 
							//check if last child
							var display_quesid_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');
							
							
							  
							if(display_quesid_lastchild == parent_ques_div){
								if(show_recommendation_screen || ads_screen){
								sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id,type);
								} else {
								jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_next_btn').css('pointer-events', 'none');
								scoring_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div );
								}	  
							}else{
								if(show_recommendation_screen || ads_screen){
								sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id,type);
								} else {	
									var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 
									var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
									if(quiz_slider_animation =="Y")	{	
										setTimeout(function() {	
											jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
											jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
											jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
											jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
											
										}, 500); 
									}else{
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
									}
								}
							}   
							//check if last child ends		
							 
						}
					}
				
				// enter data in question and answer table
				
				if (typeof sqb_question_id === "undefined" || (sqb_question_id == 0)){
					sqb_question_id =jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.single_cls').attr('data-question-id');
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
				}
				if(matrix_cls == true){
					var sqb_answer_id  = getMultipleAnswerIds(parent_ques_div, sqb_quiz_container_outer_id);
				} 
				var sqb_other_field = jQuery('#'+parent_ques_div).find('.custom-other-box').val();
				var only_question = '';
				sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id,only_question,only_question,sqb_other_field);
				sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);
				var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id');
				//function to go to the top of the visible div
				var nextdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).next().attr('id');
				quizScrollToDiv('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id,  nextdiv_id, parent_ques_div, current_ques_div_hgt);
				sqb_apply_wid_css(sqb_quiz_container_outer_id); 
		}
		var slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
		if(slider_animation == 'N'){
		 	setTimeout(function(){
				jQuery('#'+sqb_quiz_container_outer_id+' .show_cls').find('.numeric_text_cls').addClass('sqb_ans_selected');
	 			jQuery('.numerical_text_cls.show_cls .numeric-value-prefix input').focus();
	 		},500)
		 }
	});
	
	//nextbutton for survey	
	jQuery(document).on('click','  .quiz_type_survey .single_next_btn_container .single_next_btn ,    .quiz_type_survey .multi_next_btn_container .single_next_btn' ,function(evt){
		evt.stopImmediatePropagation();		
		jQuery('.custom-other-box').hide();
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		} 
		var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
		
		jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.sqb_uploded_filename').remove();
		var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
		//var sqb_ans_selected =jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
		if(jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).hasClass('question_type_file_upload')){
			var filename = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').val();
			var sqb_ans_selected = 0;
			if(filename != ''){
				var sqb_ans_selected = 1;
			}
		} else {
			var sqb_ans_selected = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
		}
		//if multiple correct ans
		
		var parent_hasClass =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');
		var allow_skip_ques =  jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .allow_skip_ques").val();
		var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();
		var count_manage_lead_data = jQuery('#'+sqb_quiz_container_outer_id+ ' #count_manage_lead_data').val();	
		var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();
		var lesson_quiz =""	; 
	 
		if( lesson_id !=""  ){				 
			lesson_id = jQuery.isNumeric(lesson_id);
			if(lesson_id == true){				 
				lesson_quiz ="all";
			} 
		}
		jQuery("#"+sqb_quiz_container_outer_id+ " .correctincorrect_ans_div ").remove();
		//allow skip
		if(allow_skip_ques == "Y"){
		}else{			
			if(sqb_ans_selected > 0){
				var matrix_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('matrix_cls'); 
				//show incorrect msg 
				if(matrix_cls == true){
					var total_class= jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer").length;
						var selected_class = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
					
						if(total_class > selected_class){
							sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(),   sqb_quiz_container_outer_id , parent_ques_div);
							return false;
						}
				}			
			}else{
				var sqb_email_type  =  jQuery(this).closest(".question_container").hasClass('question_type_email');
				var sqb_phone_type = jQuery(this).closest(".question_container").hasClass('question_type_phone_number');
				
				if(sqb_email_type == true){
				}else if(sqb_phone_type == true){
				}else{
					sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(),   sqb_quiz_container_outer_id , parent_ques_div);
					return false;
				}
			} 	
		} 	
		
		var email_class = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('email_cls'); 
		if(email_class){

			var val = jQuery('#'+parent_ques_div).find('.sqb_email_ans_field').val();
	 		var email_error_message = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-emailmessage');
	 		var email_required = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-isreq');
			if(email_required == 'Y'){
				if(val == ''){
					jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
					jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+email_error_message+'</b></div>');
					return false;
				}else if(!sqbValidateEmail(val)){
					jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
					jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+email_error_message+'</b></div>');
					return false;
				}else{
					
				}
			}
			var email_val = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_email_ans_field").val();
 			jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_direct_signup #email").val(email_val);
		}
		var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
		if(jQuery(this).closest(".question_container").hasClass('question_type_matrix')){
			var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected');
		}else{
			var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected');			
		}
		var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
		var sqb_quiz_id =  jQuery('#'+sqb_quiz_container_outer_id+  ' input#quiz_id').val();
		var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');
		var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');

		// Set Rule for Multiple choice Questions, always get first outcome rule
		if(jQuery(this).closest(".question_container").hasClass('question_type_multi')){
			jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected').each(function(){
				if(jQuery(this).attr('data-outcomerule-id') > 0){
					sqb_answer_id = jQuery(this).attr('data-answer-id');
					sqb_outcome_id = jQuery(this).attr('data-outcomerule-id');
				}
			});
		}

		 var current_ques_div_hgt = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).height(); 
		if(lesson_quiz =="all"){	
					nextbutton_calculation_lesson(sqb_quiz_container_outer_id, parent_ques_div);
		}else if(quiz_pagination == 'all'){
			if(show_next_button == 'Y'){}else{
					show_all_questions_in_one_page(sqb_quiz_container_outer_id, parent_ques_div);
				}
		}else{
			var sqbadvancedrule = sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
			if(sqbadvancedrule ==1){
				// progressbar
				sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
			}else{ 		

					var ads_screen = false;
					var type = '';
					if(jQuery('#quiz_temp_id'+sqb_question_id).find('.quiz_ans_a_d_html_outer').length > 0 && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
						ads_screen = true;
						type = 'ads';
					}	
					if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
						if(ads_screen){
							sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id, 'ads');
						}else{
							sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
						}
					}else{	
						var show_recommendation_screen = false;
						if(jQuery(this).closest('.question_container').find('.sqb_ans_selected').hasClass('ans_recommendation_enable') && jQuery('#'+sqb_quiz_container_outer_id+' #quiz_recommendation_option').val() == 'Y' && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
							show_recommendation_screen = true;
						}		
						
						

						//check if last child
						var display_quesid_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');
						if(display_quesid_lastchild == parent_ques_div){
							if(show_recommendation_screen || ads_screen){
							sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id, type);
							} else {
							survey_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div );
							}		  
						}else{
							if(show_recommendation_screen || ads_screen){
							sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id,type);
							} else {		
							var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 
							var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
								if(quiz_slider_animation =="Y")	{	
									setTimeout(function() {	
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');		 		 
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');	
										
									}, 500); 
								}else{
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
									jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');		 		 
									jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');	
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
								}
							}
							// progressbar
							sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
							
						
						}	
					}	
				}	
		
				var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
				var correct_ans_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();			 
				var hascorrect_ans = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .correct_ans_cls").hasClass('addselected');			 		 
				if(hascorrect_ans == true){				 
					var correct_ans_count = parseInt(correct_ans_count) + 1;						 
					jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(correct_ans_count); 		 
				}
			 
				//if multiple correct ans
			
				//var parent_hasClass =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');
				var parent_hasClass = false;
				var matrix_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('matrix_cls'); 
				var has_multiple_correct_cls =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');
				var has_ranking_cls =  jQuery(this).closest(".question_container").hasClass('question_type_ranking_choices');

				if(matrix_cls){
					parent_hasClass = true;
				}
				if(has_multiple_correct_cls){
					parent_hasClass = true;
				}
				if(has_ranking_cls){
					parent_hasClass = true;
				}
				
				// enter data in question and answer table
				
				
				if (typeof sqb_question_id === "undefined" || (sqb_question_id == 0)){
					sqb_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.single_cls').attr('data-question-id');
					sqb_answer_id = 0;
					sqb_outcome_id = 0;
					if(matrix_cls == true){
						sqb_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.matrix_cls').attr('data-question-id');
					}
				}
				//if multiple correct ans
				var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
				//var parent_hasClass =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');
		  		
				if(parent_hasClass == true){
					var sqb_answer_id  = getMultipleAnswerIds(parent_ques_div, sqb_quiz_container_outer_id);			 	 
				} 

				var sqb_other_field = jQuery('#'+parent_ques_div).find('.custom-other-box').val();
				var only_question = '';

				sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id,only_question,only_question,sqb_other_field);
				sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);
				var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id');
				//function to go to the top of the visible div
				var nextdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).next().attr('id');
				quizScrollToDiv('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id,  nextdiv_id, parent_ques_div, current_ques_div_hgt);
				sqb_apply_wid_css(sqb_quiz_container_outer_id); 
		}	
	 	var slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
		if(slider_animation == 'N'){
		 	setTimeout(function(){
		 			jQuery('.numerical_text_cls.show_cls .numeric-value-prefix input').focus();
					 jQuery('#'+sqb_quiz_container_outer_id+' .show_cls').find('.numeric_text_cls').addClass('sqb_ans_selected');
		 		},500);
		 }

	});
	
	function sqb_show_recommendation_screen_fn(element,sqb_quiz_container_outer_id,type = ''){
			
			if(type != 'ads'){

				jQuery(element).closest('.question_container').find('.sqb_ans_selected').removeClass('ans_recommendation_enable');
				jQuery(element).closest('.question_container').find('.sqb_ans_selected').addClass('ans_recommendation_show'); 
				var cr_ans_id = jQuery(element).closest('.question_container').find('.sqb_ans_selected').find('.sqb_ans_item').attr('id');
				if(jQuery('#'+sqb_quiz_container_outer_id).find('.quiz_ans_recommendation_html').find('.sqb_ans_option_'+cr_ans_id).length != 0){
					var sqb_recommendation_enabled = jQuery('#'+sqb_quiz_container_outer_id).find('.quiz_ans_recommendation_html').find('.sqb_ans_option_'+cr_ans_id).attr('sqb_recommendation_enabled');
					if(sqb_recommendation_enabled == 'Y'){
					jQuery('#'+sqb_quiz_container_outer_id).find('.quiz_ans_recommendation_html').find('.sqb_ans_option_'+cr_ans_id).closest('.quiz_ans_recommendation_html').show().find('.sqb_cr_next_btn_div').attr('data-ans-attr-id',cr_ans_id);
					jQuery(element).closest('.question_container').find('.sqb_ans_selected').closest('.Quiz-Template-overflow').hide();
					}
				}
			}else{

				if(jQuery(element).closest('.Quiz-Template').find('.quiz_ans_a_d_html_outer').length > 0){
						jQuery(element).closest('.Quiz-Template').find('.Quiz-Template-overflow').hide();
						jQuery(element).closest('.Quiz-Template').find('.quiz_ans_a_d_html_outer').show();
						jQuery(element).closest('.Quiz-Template').addClass('is_a_d_active');
					//return false;
				}
			}
	} 
	//nextbutton for calculator	
	jQuery(document).on('click','  .quiz_type_calculator .single_next_btn_container .single_next_btn ,    .quiz_type_calculator .multi_next_btn_container .single_next_btn' ,function(evt){
		evt.stopImmediatePropagation();	
		jQuery('.custom-other-box').hide();
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		} 
		var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
		
		jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.sqb_uploded_filename').remove();
		var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
		//var sqb_ans_selected =jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
		if(jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).hasClass('question_type_file_upload')){
			var filename = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').val();
			var sqb_ans_selected = 0;
			if(filename != ''){
				var sqb_ans_selected = 1;
			}
		} else {
			var sqb_ans_selected = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
		}
		//if multiple correct ans
		
		var parent_hasClass =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');
		var numeric_text_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('numeric_text_cls');
		var allow_skip_ques =  jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .allow_skip_ques").val();
		var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();
		var count_manage_lead_data = jQuery('#'+sqb_quiz_container_outer_id+ ' #count_manage_lead_data').val();	
		var matching_text_cls   = jQuery("#"+sqb_quiz_container_outer_id+ "  #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('matching_text');
		var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();
		var lesson_quiz =""	; 
	 
		if( lesson_id !=""  ){				 
			lesson_id = jQuery.isNumeric(lesson_id);
			if(lesson_id == true){				 
				lesson_quiz ="all";
			} 
		}
		jQuery("#"+sqb_quiz_container_outer_id+ " .correctincorrect_ans_div ").remove();
		//allow skip
		if(allow_skip_ques == "Y"){
		}else{	
			var matrix_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('matrix_cls'); 
				//show incorrect msg 
				if(matrix_cls == true){
					var total_class= jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer").length;
						var selected_class = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.sqb_ans_selected").length;
					
						if(total_class > selected_class){
							sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(),   sqb_quiz_container_outer_id , parent_ques_div);
							return false;
						}
				}			
			if(sqb_ans_selected > 0){
				//show incorrect msg 
				
								
			}else{
				var sqb_email_type  =  jQuery(this).closest(".question_container").hasClass('question_type_email');
				var sqb_phone_type = jQuery(this).closest(".question_container").hasClass('question_type_phone_number');
				
				if(sqb_email_type == true){
				}else if(sqb_phone_type == true){
				}else{
					sqb_incorrectmsg_display(jQuery('#'+sqb_quiz_container_outer_id+ ' #required_answer').val(),   sqb_quiz_container_outer_id , parent_ques_div);
					return false;
				}
			} 	
		} 	
		
	 
	 	var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
		if(jQuery(this).closest(".question_container").hasClass('question_type_matrix')){
			var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected');
		}else{
			var ans_select_obj =  jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected');			
		}
		
		var email_class = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('email_cls'); 
		if(email_class){

			var val = jQuery('#'+parent_ques_div).find('.sqb_email_ans_field').val();
	 		var email_error_message = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-emailmessage');
	 		var email_required = jQuery('#'+parent_ques_div).find('.sqb_ans_item_outer').attr('data-isreq');
			if(email_required == 'Y'){
				if(val == ''){
					jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
					jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+email_error_message+'</b></div>');
					return false;
				}else if(!sqbValidateEmail(val)){
					jQuery('#'+parent_ques_div).find('.answer_container .date_inorrect_ans_div').remove();
					jQuery('#'+parent_ques_div).find('.answer_container').append('<div class="date_inorrect_ans_div"><b>'+email_error_message+'</b></div>');
					return false;
				}else{
					
				}
			}
			var email_val = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_email_ans_field").val();
 			jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_direct_signup #email").val(email_val);
		}
		
		if(numeric_text_cls){
			var points_count = 0;
			var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
			var get_max_points_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val();
			var data_point = 0;
			var data_correct_value = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer.sqb_ans_selected").attr("data-correct-value");
			var input_text_num = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer .sqb_and_field").val();
			//if(input_text_num == data_correct_value){
				var data_point = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer.sqb_ans_selected").attr("data-point");
			//}
			var get_max_points_count = getmaxDataPoints(parent_ques_div, sqb_quiz_container_outer_id) ;

			var sqb_points_ans = parseInt(data_point)+ parseInt(sqb_points_ans);		
			
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(sqb_points_ans); 
			
			var points_count = parseInt(get_max_points_count)+ parseInt(points_count);		
								 
			jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(points_count);
		}else if(matching_text_cls){
			var points_count = 0;
			var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
			var get_max_points_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val();
			var data_point = 0;

			data_point = calculate_match_points(jQuery(" #"+parent_ques_div));
			var get_max_points_count = getmaxDataPointsForMatchingType(parent_ques_div, sqb_quiz_container_outer_id);

			var sqb_points_ans = parseInt(data_point)+ parseInt(sqb_points_ans);		
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(sqb_points_ans); 
			var points_count = parseInt(get_max_points_count)+ parseInt(points_count);	
			jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(points_count);
		}

		var sqb_quiz_id =  jQuery('#'+sqb_quiz_container_outer_id+  ' input#quiz_id').val();
		var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
		var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');
		var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');

		// Set Rule for Multiple choice Questions, always get first outcome rule
		if(jQuery(this).closest(".question_container").hasClass('question_type_multi')){
			jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected').each(function(){
				if(jQuery(this).attr('data-outcomerule-id') > 0){
					sqb_answer_id = jQuery(this).attr('data-answer-id');
					sqb_outcome_id = jQuery(this).attr('data-outcomerule-id');
				}
			});
		}

		var current_ques_div_hgt = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).height(); 
		if(lesson_quiz =="all"){	
					nextbutton_calculation_lesson(sqb_quiz_container_outer_id, parent_ques_div);
		}else if(quiz_pagination == 'all'){
			if(show_next_button == 'Y'){}else{
					show_all_questions_in_one_page(sqb_quiz_container_outer_id, parent_ques_div);
				}
		}else{ 	
			var sqbadvancedrule = sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
			if(sqbadvancedrule ==1){
				// progressbar
				sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
			}else{	

					var ads_screen = false;
					var type = '';
					if(jQuery('#quiz_temp_id'+sqb_question_id).find('.quiz_ans_a_d_html_outer').length > 0 && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
						ads_screen = true;
						type = 'ads';
					}


					if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
							
							if(ads_screen){
								sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id, 'ads');
							}else{
								sqb_find_next_question_for_funnel_new(this,parent_ques_div, sqb_quiz_container_outer_id);
							}
							
					}else{
						var show_recommendation_screen = false;
						if(jQuery(this).closest('.question_container').find('.sqb_ans_selected').hasClass('ans_recommendation_enable') && jQuery('#'+sqb_quiz_container_outer_id+' #quiz_recommendation_option').val() == 'Y' && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
							show_recommendation_screen = true;
						}	
						 

						//check if last child
						var display_quesid_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').last().attr('id');
						if(display_quesid_lastchild == parent_ques_div){
							if(show_recommendation_screen || ads_screen){
							sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id, type);
							} else { 
							calculator_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div ) ;	
							}	  
						}else{	
							if(show_recommendation_screen || ads_screen){
								sqb_show_recommendation_screen_fn(this,sqb_quiz_container_outer_id,type);
							} else {	
								var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 
								var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
								if(quiz_slider_animation =="Y")	{	
									setTimeout(function() {	
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');		 		 
										jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');	
										
									}, 500); 
								}else{
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
									jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).addClass('hide_cls').removeClass('show_cls');		 		 
									jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).next().addClass('show_cls').removeClass('hide_cls');	
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
								}
							}
							// progressbar
							sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);		
						
						}	
					}	
				}	
		
				var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
				var correct_ans_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();			 
				  
				var hascorrect_ans = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .correct_ans_cls").hasClass('addselected');			 		 
				if(hascorrect_ans == true){				 
					var correct_ans_count = parseInt(correct_ans_count) + 1;						 
					jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(correct_ans_count); 		 
				}
			 
				//if multiple correct ans
				
				//var parent_hasClass =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');
				var parent_hasClass = false;
				var matrix_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('matrix_cls'); 
				var has_multiple_correct_cls =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');
				if(matrix_cls){
					parent_hasClass = true;
				}
				if(has_multiple_correct_cls){
					parent_hasClass = true;
				}
				
				// enter data in question and answer table
				 
				
				if (typeof sqb_question_id === "undefined" || (sqb_question_id == 0)){
					sqb_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.single_cls').attr('data-question-id');
					sqb_answer_id = 0;
					sqb_outcome_id = 0;
					if(matrix_cls == true){
						sqb_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.matrix_cls').attr('data-question-id');
					}
				}
				//if multiple correct ans
				var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
				var parent_hasClass =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');
		  
				if(parent_hasClass == true){
					var sqb_answer_id  = getMultipleAnswerIds(parent_ques_div, sqb_quiz_container_outer_id);			 	 
				} 
				var sqb_other_field = jQuery('#'+parent_ques_div).find('.custom-other-box').val();
				var only_question = '';
				
				sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id,only_question,only_question,sqb_other_field);
				sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);
				var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id');
				//function to go to the top of the visible div
				var nextdiv_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+quiz_temp_id).next().attr('id');
				quizScrollToDiv('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id,  nextdiv_id, parent_ques_div, current_ques_div_hgt);
				
				sqb_apply_wid_css(sqb_quiz_container_outer_id); 
		}	
		var slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
		if(slider_animation == 'N'){ 
		 	setTimeout(function(){
				jQuery('#'+sqb_quiz_container_outer_id+' .show_cls').find('.numeric_text_cls').addClass('sqb_ans_selected');
 				jQuery('.numerical_text_cls.show_cls .numeric-value-prefix input').focus();
 			},500)
		}
	});
	 
		// showing all ques-ans on the same page, next button for that
	  // for lesson thing			  
	 jQuery(document).on('click','.buttondata_outer.multiple_ques_true .dap_see_details_btn' ,   function(evt){
			evt.stopImmediatePropagation();
			 
			var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
			var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
			
			if(quiz_display == "popup" || quiz_display == "corner_popup"){
				sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
			} 
			 				
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
				//if( count_manage_lead_data > 0 && sqb_retake  == "n"  ){					
					if( count_manage_lead_data > 0 && sqb_retake  == "n"  && quiz_attempts_allowed != "unlimited" ){	
						if(show_result_screen =="N"){
						}else{
														 
							// display ques-ans in result page				 
							if(display_correctans_options == "both" || display_correctans_options == "result_page"){					
								sqb_show_ques_ans_in_resultpage(sqb_quiz_container_outer_id);
							} 
							var outcomedata = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer1 .outcome_div_lesson').html(); 
							jQuery('#'+sqb_quiz_container_outer_id+ ' .pagination_all_div .multiple_ques_true' ).after(outcomedata);
							
						} 
					 
				}else{
					  
					//outcome calculations 
					if(sqb_quiz_type == "personality"){						
						 sqb_personality_outcome_calculations(sqb_quiz_container_outer_id);	
					}else  if(sqb_quiz_type == "assessment"){
						sqb_assessment_outcome_calculations(sqb_quiz_container_outer_id);	
						
					}else  if(sqb_quiz_type == "scoring"){
						sqb_scoring_outcome_calculations(sqb_quiz_container_outer_id);	
								
					} else if(sqb_quiz_type == "survey"){
						 sqb_survey_outcome_calculations(sqb_quiz_container_outer_id);	
					}
						
					jQuery('#'+sqb_quiz_container_outer_id).append('<input type="hidden" id="outcome_final" name="outcome_final" value="0"/>');		 
					//replace outcome merge tags
					//replaceOutcomeMergeTags(sqb_quiz_container_outer_id);							
					replaceOutcomeMergeTagsLesson(sqb_quiz_container_outer_id);							
					  					
					//redirect or show
					outcomeRedirectCall(sqb_quiz_container_outer_id);
					 
					//result screen
					if(show_result_screen =="N"){
					}else{						
						//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').show(); 
						// display ques-ans in result page				 
						if(display_correctans_options == "both" || display_correctans_options == "result_page"){					
							sqb_show_ques_ans_in_resultpage(sqb_quiz_container_outer_id);
						}
						
						jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_data_cont ').html(''); 
						var outcomedata1 = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer ').html(); 
						jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_data_cont ').html(outcomedata1);   
						jQuery('.outcome_data_cont .outcome_div').each(function(){		
							 
							 
							//scoring quiz
							if(sqb_quiz_type =="scoring"){			
								var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
								var total_pt = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(); 		 
								if(sqb_points_ans =="NaN"	|| sqb_points_ans =="nan" || sqb_points_ans =="NAN"){
									sqb_points_ans =0;
								}
								jQuery('.outcome_data_cont').html(jQuery('.outcome_data_cont').html().replaceAll('%% TOTALSCORE %%', '%%TOTALSCORE%%'));
								jQuery('.outcome_data_cont').html(jQuery('.outcome_data_cont').html().replaceAll('%% YOURSCORE %% ', '%%YOURSCORE%%'));							 
								jQuery('.outcome_data_cont').html(jQuery('.outcome_data_cont').html().replaceAll('%%TOTALSCORE%%', total_pt));
								jQuery('.outcome_data_cont').html(jQuery('.outcome_data_cont').html().replaceAll('%%YOURSCORE%%', sqb_points_ans));
								
								
									
								jQuery(this).html(jQuery(this).html().replaceAll('[AVERAGE_SCORE]', '<div class="sqb_points_average">'+calculate_average(total_ques,total_ques)+'</div>'));
								
														 
							}
							 
							if(sqb_quiz_type =="assessment"){ //assessment quiz
								var total_ques = jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val();
							 
								var sqb_correct_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();							 
								jQuery('.outcome_data_cont').html(jQuery('.outcome_data_cont').html().replaceAll(' %%TOTALQUESTIONS %% ', '%%TOTALQUESTIONS%%'));
								jQuery('.outcome_data_cont').html(jQuery('.outcome_data_cont').html().replaceAll(' %%CORRECTANSWERS %% ', '%%CORRECTANSWERS%%'));
								jQuery('.outcome_data_cont').html(jQuery('.outcome_data_cont').html().replaceAll('%%TOTALQUESTIONS%%', total_ques));
								jQuery('.outcome_data_cont').html(jQuery('.outcome_data_cont').html().replaceAll('%%CORRECTANSWERS%%', sqb_correct_ans));
								
								jQuery(this).html(jQuery(this).html().replaceAll('[AVERAGE_SCORE]', '<div class="sqb_points_average">'+calculate_average(total_ques,total_ques)+'</div>'));
								
							}	
						});					 
						if(quiz_pagination !="all"){
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .question_container  ').hide();	
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .question_container  ').removeClass('show_cls');		 
						} 
						jQuery('#'+sqb_quiz_container_outer_id+ ' .pagination_all_div .multiple_ques_true' ).after(jQuery('.outcome_data_cont ').html());
												   
					}
					// save lead info
					var user_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #dap_id').val();					 				
					var course_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #course_id').val();					 				
					var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();						 				 				
					var how_many_answed = 0;					
					sqb_lead_save(user_id,how_many_answed, 'see_details_btn_clicked',sqb_quiz_container_outer_id,course_id,lesson_id);  
				 
					// enable/disable retake button
					var total_attempts =jQuery('#'+sqb_quiz_container_outer_id+ ' #total_attempts').val();
					var leads_total_attempts = jQuery('#'+sqb_quiz_container_outer_id+ ' #leads_total_attempts').val();
					var allow_retake = jQuery('#'+sqb_quiz_container_outer_id+ ' #allow_retake').val();
				 
					var leadstotal_attempts_new = parseInt(leads_total_attempts) - 1;
					if(total_attempts == leadstotal_attempts_new){						 
						jQuery('#'+sqb_quiz_container_outer_id+ ' .retake_button').addClass('btn_disabled');		 
					} 
					//for first time
					if( count_manage_lead_data == 0 ){							 
						if(allow_retake == "Y"){  
							jQuery('#'+sqb_quiz_container_outer_id+ ' .retake_button').removeClass('btn_disabled');
						}	
					}
								
					// enable the_markas_completebutton
					unlocking_markas_complete(sqb_quiz_container_outer_id);			 
				} 
				//added to showretake without reload the page, when first time take the quiz
				if(count_manage_lead_data <1){			 
					 jQuery('#'+sqb_quiz_container_outer_id+ ' #count_manage_lead_data').val(1);
					var allow_retake = jQuery('#'+sqb_quiz_container_outer_id+ ' #allow_retake').val();
					var total_attempts = jQuery('#'+sqb_quiz_container_outer_id+ ' #total_attempts').val();
					 
					if(allow_retake =="Y"){
						var retakehtml = jQuery('#'+sqb_quiz_container_outer_id+' .quiz_quesans_template_outer .reake_data_outer ').html();		
						jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div .result_temp_outer ').append('<div class="reake_data_outer retake_data_outer_reload" style="display:block">'+retakehtml+'</div>');
						
					}			 
				 }
				
			}else{
			 
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('hide_cls done_screen').removeClass('show_cls');		
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
				
				if(quiz_pagination =="all"){	
					if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() != 'optin-before-questions-screen'){

						//function to go to the center of the visible div
						quizScrollToDivTop('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer');	
					}
				}
			}
		 
	 });   
	  
	//retake button  
		
	jQuery(document).on('click', ' .retake_button' , function(evt){
		evt.stopImmediatePropagation();
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		
		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container .single_cls').css('pointer-events', 'auto');
		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container .single_next_btn').css('pointer-events', 'auto');
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
				var clone_outcome_id = jQuery(this).attr('data-outcome-id');
			
				if (clone_outcome_id in sqb_outcome_content_clone === true) {
						
						jQuery(this).html(sqb_outcome_content_clone[clone_outcome_id]);
				}
			
		 });
		 
		outcome_ids_array = [];
		outcome_ids_points_array = {};
		sqb_outcome_content_clone = {};
		
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}
		//jQuery.cookie("test", 1, { expires : 10 });		
		var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();
		if (typeof sqb_quiz_container_outer_id == "undefined") {
			var lesson_id = jQuery('.sqb_quiz_container  #lesson_id').val();
		}

		if(jQuery('#'+sqb_quiz_container_outer_id+ ' .ShowCategoryScoreContentClone').length > 0){
			jQuery('#'+sqb_quiz_container_outer_id+ ' .ShowCategoryScoreContentClone').each(function(){
				var id = jQuery(this).attr('data-id');
				var sss_html = jQuery(this).html().replaceAll('CloneShowCategoryScore','ShowCategoryScore');
				jQuery('#'+sqb_quiz_container_outer_id+ ' #sss_'+id).html(sss_html);
			});
		}

		if(jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_data_description_clone').length > 0){
			jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_data_description_clone').each(function(){
				var id = jQuery(this).attr('data-rank');
				var html = jQuery(this).html().replaceAll('ShowOutcomeDescClone','ShowOutcomeDesc');
				jQuery('.outcome_data_description[data-rank="'+id+'"]').html(html);
			});
		}

		if(jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_data_title_clone').length > 0){
			jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_data_title_clone').each(function(){
				var id = jQuery(this).attr('data-rank');
				var html = jQuery(this).html().replaceAll('ShowOutcomeTitleClone','ShowOutcomeTitle');
				jQuery('.outcome_data_title[data-rank="'+id+'"]').html(html);
			});
		}


		//reset timer		
		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_counter_outer1').remove();
		jQuery('#'+sqb_quiz_container_outer_id+ ' #timer_count').val(0);
		jQuery('#'+sqb_quiz_container_outer_id+ ' #time_spent1').val(0);
		jQuery('#'+sqb_quiz_container_outer_id+ ' #timer_spent').val(0);
		jQuery('#'+sqb_quiz_container_outer_id+ ' #timer_stop').val(0);
		var time_hour= jQuery('#'+sqb_quiz_container_outer_id+ ' #time_hour').val();
		var time_min= jQuery('#'+sqb_quiz_container_outer_id+ ' #time_min').val();
		var time_sec= jQuery('#'+sqb_quiz_container_outer_id+ ' #time_sec').val();
		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-hours').text(time_hour);
		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-minutes').text(time_min);
		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-seconds').text(time_sec);
		jQuery('#'+sqb_quiz_container_outer_id+' #quiz_attempted').val('N');
		jQuery('.lesson_container_outer .quiz_quesans_template_outer .single_next_btn  ').removeClass("btn_disabled");
		jQuery('#'+sqb_quiz_container_outer_id+' .sqb_ans_item_outer').addClass('ans_recommendation_enable').removeClass('ans_recommendation_show');

		jQuery('#'+sqb_quiz_container_outer_id+ ' .custom-other-box').val('');
		var social_share_screen_value = jQuery('#'+sqb_quiz_container_outer_id+' #social_share_screen_value').val();
		if(social_share_screen_value == 'Y'){
			jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_social_share_next_btn').addClass('disable_social_share_next_btn');//disable next button
			jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_social_share_message').text('').removeClass('sqbShareSuccess');
		}
		
		//jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-start-Template5 .quiz_firstname_template_outer ').removeClass('hide_cls done_screen').addClass('show_cls');
		 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_formula_data').each(function(){
				var sqb_formula_id = jQuery(this).attr('data-formula'); 
				var sqb_formula_data = jQuery(this).text(sqb_formula_id); //Q1*Q2
			});

		jQuery('#'+sqb_quiz_container_outer_id+ ' #final_cate_val').val(0);

		//jQuery('#'+sqb_quiz_container_outer_id+ ' .question_type_matching_text .sqb-match-box').trigger('click');

		jQuery('#'+sqb_quiz_container_outer_id+ ' .question_type_matching_text .sqb-match-box').each(function(){
			
			var id = jQuery(this).children('.sqb-match-item').attr('data-index');
			jQuery(this).removeClass('sentence-matched').removeClass('sentence-not-matched');
			var html = jQuery(this).html();
			jQuery(this).html('');
			jQuery(this).closest('.question_type_matching_text').find('#sqb-match-'+id).html(html);
			makedraggable3();
			jQuery(this).droppable( 'enable' );
			
		});

	 	jQuery('#final_formula_val').val(0);
		if(lesson_id ==null || lesson_id =="" || typeof lesson_id =="undefined"){	
			//for non-lesson context
			setCookieAndresetValuesInNonLessonContext(sqb_quiz_container_outer_id);
			
		}else{ //if lesson is there	 
			
			
			displayMessageInScreens(sqb_quiz_container_outer_id);
		
			jQuery('.quiz_quesans_template_outer').find('.outcome_div').remove();
			jQuery('.quiz_quesans_template_outer').find('.outcome_data_cont').remove();
			var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
			if(jQuery(this).parent('.reake_data_outer').hasClass('retake_data_outer_reload')){
						 
				var sqb_quiz_container_outer_id = jQuery('.retake_data_outer_reload').closest('.sqb_quiz_container_outer').attr('id');
			}
			 
			if (typeof sqb_quiz_container_outer_id === "undefined") {
				return;
			}
				
			var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();	
			var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
			if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
				sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
			} 
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_retake').val("Y");
			jQuery('#'+sqb_quiz_container_outer_id+ ' .buttondata_outer.multiple_ques_true .dap_see_details_btn').removeClass('btn_disabled');
		
			 
			disable_ques_ans_lesson(sqb_quiz_container_outer_id);
			
			if(quiz_pagination =="all"){
				jQuery('html, body').animate({
				   scrollTop: jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').offset().top - 50
				}, "slow"); 				
				jQuery('#'+sqb_quiz_container_outer_id+ ' .buttondata_outer.multiple_ques_true .dap_see_details_btn').addClass('btn_disabled');
			}		
			jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass("question_container_disabled"); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').first().removeClass("question_container_disabled"); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').removeClass("question_container_disabled1");
			jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container .sqb_ans_item_outer').removeClass("sqb_ans_selected");
			jQuery('.answer_container').removeClass("answer_container_disabled");
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').hide(); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer1').hide(); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .pagination_all_div  .Quiz-Template.result_temp_outer').remove(); 
			 
			//restting the values
			//disable points and correct answers
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(0);		 
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(0);		 
			jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val(0);		 
			jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(0);		 
			jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count_progress').val(0);	
			jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').remove();		 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .not_passed_quiz_msg_outer').remove();		 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_data_cont').html('');		 
						 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_question_answer_hidden').each(function(){
				jQuery(this).remove();	
			});		


			

			
			//resetting the outcome
			jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(){	
			//scoring quiz
				if(sqb_quiz_type =="scoring"){			
					var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
					if(sqb_points_ans =="NaN"	|| sqb_points_ans =="nan" || sqb_points_ans =="NAN"){
						sqb_points_ans =0;
					}
					var total_pt = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(); 	
						 
					jQuery(this).html(jQuery(this).html().replace(total_pt, '%%TOTALSCORE%%'));
					jQuery(this).html(jQuery(this).html().replace(sqb_points_ans, '%%YOURSCORE%%', sqb_points_ans));
					 
				}
				if(sqb_quiz_type =="assessment"){ //assessment quiz
					var total_ques = jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val();
					if(total_ques < 1){
						var total_ques = jQuery('#'+sqb_quiz_container_outer_id+ ' #total_ques').val();
					}
					
					var sqb_correct_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();
					jQuery(this).html(jQuery(this).html().replace(total_ques, '%%TOTALQUESTIONS%%'));
					jQuery(this).html(jQuery(this).html().replace(sqb_correct_ans, '%%CORRECTANSWERS%%'));
				}
				jQuery(this).hide();
				
			});	
			  
			//for one_per_page
			if(quiz_pagination !="all"){
				/*jQuery('html, body').animate({
				   scrollTop: jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').offset().top - 50
				}, "slow");*/
				jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){		
					jQuery('#'+sqb_quiz_container_outer_id+ '  .question_container').removeClass('question_container_disabled');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .question_container').removeClass("show_cls");
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .question_container').addClass("hide_cls");
					jQuery('#'+sqb_quiz_container_outer_id+ '  .question_container').attr('style', '' );
				});	
				 
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').show();
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .question_container').first().removeClass("hide_cls");
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .question_container').first().addClass("show_cls");
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template').removeClass("show_cls").addClass("hide_cls");
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template').first().removeClass("hide_cls");
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template').first().addClass("show_cls");
				
				 
			
				/*if(jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .result_temp_outer .reake_data_outer.retake_data_outer_reload').length >1){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .result_temp_outer .reake_data_outer.retake_data_outer_reload').last().remove();
				}*/
				
			}
			 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){		 
				//reset the textarea and fill_in_the_blank values
				jQuery(this).find(" .sqb_ans_item_outer").removeClass("sqb_ans_selected");
				jQuery(this).find(" .sqb_ans_item_outer").removeClass("addselected"); 
				var fill_in_blank_cls =   jQuery(this).find(" .sqb_ans_item_outer").hasClass('fill_in_blank_cls'); 
				var text_cls = jQuery(this).find(" .sqb_ans_item_outer").hasClass('text_cls'); 
				var date_cls = jQuery(this).find(" .sqb_ans_item_outer").hasClass('date_cls'); 
				var slider_cls = jQuery(this).find(" .sqb_ans_item_outer").hasClass('slider_cls'); 
					
				if(fill_in_blank_cls ==true){												 					
					jQuery(this).find(".fill_in_blank_cls .sqb_ans_item .sqb_and_field").val('');								 					
				}else if(text_cls ==true){				
					jQuery(this).find(".text_cls .sqb_ans_item .sqb_and_field").val('');												 	
				}else if(date_cls ==true){				
					jQuery(this).find(".date_cls .sqb_ans_item .sqb_and_field").val('');												 	
				}else if(slider_cls ==true){				
					
					var slider_id = jQuery(this).find(".slider.sqb_ans_slider").attr('id');	
					var min_value = jQuery(this).find(".slider.sqb_ans_slider").attr('data-slider-min');
					
					jQuery('#'+slider_id).bootstrapSlider('setValue', min_value);											 	
				}else{} 				
			});		 
			
			jQuery('#'+sqb_quiz_container_outer_id).find('#already_given_quiz_status').val(0);
			sqb_all_question_view_insert(sqb_quiz_container_outer_id);
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').addClass('hide_cls').removeClass('show_cls'); 

			if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() == 'optin-before-questions-screen' && jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val() != 'N'){
				jQuery('#'+sqb_quiz_container_outer_id+' .quiz_quesans_template_outer').addClass('show_cls').removeClass('hide_cls');
			}
			
		}
	});
	
	 //sqb checkbox count_increase for checkbox click only single time
 	 jQuery(document).on('change', '  .normal_quiz.quiz_type_survey .multi_next_btn_container .checkbox-custom-style .sqb_and_field ' ,function(evt){
			evt.stopImmediatePropagation();
		 var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		var parent_ques_div =  jQuery(this).closest('.question_container').attr('id');	
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}	
		var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container #sqb_quiz_type').val();
		if(sqb_quiz_type =="survey" || sqb_quiz_type =="personality"){
			var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
			if(jQuery(this).prop("checked") == true){
				jQuery('#'+parent_ques_div).removeClass('disable_nextbutton');
			}
			if(jQuery('#'+parent_ques_div+' .checkbox-custom-style .checkbox_fe:checked').length < 1){
				jQuery('#'+parent_ques_div).addClass('disable_nextbutton');
			}
		 }
	 });  
	  jQuery(document).on('keyup', '  .sqb_quiz_container  input.sqb_and_field ,   .sqb_quiz_container  textarea.sqb_and_field  ' ,function(evt){
			evt.stopImmediatePropagation();  
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}
		var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container #sqb_quiz_type').val();
		 
		var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
		var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
		var allow_skip_ques =   jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .allow_skip_ques").val();
		if(allow_skip_ques =="Y"){
		}else{
			if(!jQuery(this).closest(".question_container").hasClass('question_type_phone_number')){
				if(jQuery(this).val() != ""){
					jQuery('#'+sqb_quiz_container_outer_id+' #'+parent_ques_div).removeClass('disable_nextbutton');
				}else{
					jQuery('#'+sqb_quiz_container_outer_id+' #'+parent_ques_div).addClass('disable_nextbutton');
				}
			}			 
		}			 
		 
	 });



	  jQuery(document).on('change', '.sqb_quiz_container input.date-question-type' ,function(evt){
		evt.stopImmediatePropagation();  
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}
		var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container #sqb_quiz_type').val();
		 
		var display_quesid = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('id');
		var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
		var allow_skip_ques =   jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .allow_skip_ques").val();
		if(allow_skip_ques =="Y"){
		}else{
			if(jQuery(this).val() != ""){
				 jQuery('#'+sqb_quiz_container_outer_id+' #'+parent_ques_div).removeClass('disable_nextbutton');
				 jQuery('#'+sqb_quiz_container_outer_id+' #'+parent_ques_div).find('.sqb_ans_item_outer.date_cls').addClass('sqb_ans_selected');
			}else{
				jQuery('#'+sqb_quiz_container_outer_id+' #'+parent_ques_div).addClass('disable_nextbutton');
				 jQuery('#'+sqb_quiz_container_outer_id+' #'+parent_ques_div).find('.sqb_ans_item_outer.date_cls').removeClass('sqb_ans_selected');
			}			 
		}			 
		 
	 });

	 
	 jQuery('[type="number"]').on('change',function(evt){
			evt.stopImmediatePropagation();  
			var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
			var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
			
			if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
				sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
			}
			var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');
			if(jQuery(this).val() != ""){
				 jQuery('#'+sqb_quiz_container_outer_id+' #'+parent_ques_div).removeClass('disable_nextbutton');
			}else{
				jQuery('#'+sqb_quiz_container_outer_id+' #'+parent_ques_div).addClass('disable_nextbutton');
			}
	 });
	  
	  
	  jQuery(document).on('click','.close_result_Popup div',function(){
		jQuery('.close_Side_Popup').trigger('click');
	  });
	  
	  
	 	//close the popup
		jQuery(document).on('click',' .close_Side_Popup',function(evt){
			evt.stopImmediatePropagation();	    

			

			var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
			var sqb_quiz_container_main_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
			
			var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	

			if(quiz_display != "inpage" && quiz_display != "corner_popup"){
				if(iti.length != {}){
					jQuery.each( iti, function( key, value ) {
						iti[key].destroy();
					});
				}
			}

			if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
				var sqb_quiz_container_outer_inner = sqb_quiz_container_outer_id;
				sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
				jQuery('#'+sqb_quiz_container_outer_id+' .take-quiz-btn').css('display','inline-block');
				jQuery('#'+sqb_quiz_container_outer_id+' .take-quiz-btn').removeClass('show_cls');
			}
			
			var nearbyclass= jQuery(this).closest('.quiz_outer_fe').attr("class"); 
			 
			var last_show_div = '<input type="hidden" class="last_show_div" value="'+nearbyclass+'">';	 
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container .last_show_div').length < 1 ){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container').append(last_show_div);
			}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' .last_show_div').val(nearbyclass); 
			}
			var sqb_quiz_container_data =  jQuery('#'+sqb_quiz_container_outer_id+' .sqb_quiz_container_outer').html();	
			jQuery('#'+sqb_quiz_container_outer_id).html('');
			jQuery('#'+sqb_quiz_container_outer_inner).html(sqb_quiz_container_data);	 
			jQuery( ' .modal_popup_outer' ).remove();
			jQuery('.modal_popup_outer').removeClass('show');	
			jQuery('#'+sqb_quiz_container_outer_inner+ ' .quiz_outer_fe').removeClass('modal_popup');	 
			jQuery('#'+sqb_quiz_container_outer_inner+ ' .quiz_outer_fe').hide();
			 
			if(quiz_display == "popup" || quiz_display == 'entry' || quiz_display == 'exit' || quiz_display == 'time_based' || quiz_display == 'percentage_based'){	
				jQuery('#'+sqb_quiz_container_outer_inner+ ' .quiz_outer_fe').removeClass("show_cls") ;	
				var quiz_type = jQuery('#sqb_quiz_type').val();
				var popup_type = jQuery('#form_quiz_displayed').val();
				/*if(quiz_type == 'form' && (quiz_type == 'entry' || quiz_type == 'exit' || quiz_type == 'time_based') || quiz_type == 'percentage_based'){
						jQuery('#'+sqb_quiz_container_outer_inner+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_inner+ ' .quiz_start_template_outer .take-quiz-btn').hide();
						jQuery('#'+sqb_quiz_container_outer_inner+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_inner+ ' .quiz_start_template_outer .take-quiz-btn').addClass('show_cls ').removeClass('hide_cls');
					
				}else{*/
					
					if(quiz_display == "popup"){

						jQuery('#'+sqb_quiz_container_outer_inner+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_inner+ ' .quiz_start_template_outer .take-quiz-btn').show();
						jQuery('#'+sqb_quiz_container_outer_inner+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_inner+ ' .quiz_start_template_outer .take-quiz-btn').addClass('show_cls ').removeClass('hide_cls');
					}
				/*}	*/			 
			}
			setTimeout(function(){
				jQuery('#exitpopup').val('1');
			},100);
			if(quiz_display == "corner_popup"){
				var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
				jQuery('#'+sqb_quiz_container_outer_id+' .quiz_start_template_outer').removeClass('show_cls');
				jQuery('#'+sqb_quiz_container_outer_id+' .quiz_quesans_template_outer').removeClass('show_cls');
				jQuery('#'+sqb_quiz_container_outer_id+' .quiz_optin_template_outer').removeClass('show_cls');
				jQuery('#'+sqb_quiz_container_outer_id+' .quiz_result_template_outer').removeClass('show_cls');
				
				jQuery('#'+sqb_quiz_container_outer_id+' .quiz_start_template_outer').addClass('hide_cls');
				jQuery('#'+sqb_quiz_container_outer_id+' .quiz_quesans_template_outer').addClass('hide_cls');
				jQuery('#'+sqb_quiz_container_outer_id+' .quiz_optin_template_outer').addClass('hide_cls');
				jQuery('#'+sqb_quiz_container_outer_id+' .quiz_result_template_outer').addClass('hide_cls');
			}
			
			//added for form type quiz
			sqbHideScreensForForm();
		 	if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
				jQuery('#'+sqb_quiz_container_main_id+' .take-quiz-btn').removeClass('show_cls');
			}
		});

	//start button click
	jQuery(document).on('click', ' .quiz_start_template_outer .take-quiz-btn '  ,function(evt){
			evt.stopImmediatePropagation();	 	
			
			var anim_effect = jQuery('.save-animation-effect').val();
			if(anim_effect){
				const element = document.querySelector('.take-quiz-btn');
				element.classList.add('animated', anim_effect);
				setTimeout(function() {
					element.classList.remove(anim_effect);
				}, 1000);
			}

			var sqb_quiz_container_outer_id =  jQuery(this).closest(".sqb_quiz_container_outer").attr('id');	
			
			var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
			if (isMobile) {  
				 jQuery("#"+sqb_quiz_container_outer_id+' #quiz_slider_animation').val("N");	
				 jQuery("#"+sqb_quiz_container_outer_id+' #quiz_slider_animation_option').val("");	
			 }
			
			
			jQuery('#' + sqb_quiz_container_outer_id + ' .form_cls input, #' + sqb_quiz_container_outer_id + ' .form_cls textarea, #'+sqb_quiz_container_outer_id+' .form_cls select').css('pointer-events','auto');
			
			 if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template6'){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer').css('display','none');
					//jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template-outer').css('display','flex');
				}

			var start_hgt = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .quiz_comon_template').height();
			var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();

			if(quiz_display != "inpage" && quiz_display != "corner_popup"){
				if(iti.length != {}){
					jQuery.each( iti, function( key, value ) {
						iti[key].destroy();
					});
				}
			}
			var show_firstname_temp = jQuery('#'+sqb_quiz_container_outer_id+ ' #show_firstname_temp').val();
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template5'){
				var template5_width = jQuery('.sqb_template5-fullWidth').find('.Quiz-start-Template5.start_temp_outer').css('max-width');
				 if(template5_width == 'none'){
					var start_screen_height = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-start-Template5 .Quiz-start-Template5-inner').css('min-height');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template-5').css('max-width','');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template-5 .Quiz-Template5-inner').css('min-height',start_screen_height);
					
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .Quiz-Optin-Template').css('max-width','');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .Quiz-Optin-Template').css('min-height',start_screen_height);
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .result_temp_outer').css('max-width','');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .Quiz-result-Template5-inner').css('min-height',start_screen_height);
				 } else {
					var start_screen_width = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-start-Template5').css('max-width');
					var start_screen_height = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-start-Template5 .Quiz-start-Template5-inner').css('min-height');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template-5').css('max-width',start_screen_width);
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template-5 .Quiz-Template5-inner').css('min-height',start_screen_height);
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .Quiz-Optin-Template').css('max-width',start_screen_width);
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .Quiz-Optin-Template').css('min-height',start_screen_height);
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .result_temp_outer').css('max-width',start_screen_width);
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .Quiz-result-Template5-inner').css('min-height',start_screen_height);
				 }
				 
				 if(jQuery('#'+sqb_quiz_container_outer_id+ ' #show_firstname_temp').val() == 'Y'){
					var is_firstname_screen_added = jQuery('#'+sqb_quiz_container_outer_id+' .quiz_firstname_template_outer .start_temp_outer .Quiz-start-Template5-right .show_first_name_screen_temp ').length;
					if(is_firstname_screen_added < 1){
						var firstname_screen = jQuery('#'+sqb_quiz_container_outer_id+' .show_first_name_screen_temp').html();
						var firstname_screen_html = '<div class="show_first_name_screen_temp">'+firstname_screen+'</div>';
						jQuery('#'+sqb_quiz_container_outer_id+' .quiz_firstname_template_outer  .Quiz-start-Template5-right').html(firstname_screen_html);
					}
					 
				}

				if(jQuery('#'+sqb_quiz_container_outer_id+' .Quiz-Template5-left-side').hasClass('sqb_start_screen_background_image')){
				jQuery('#'+sqb_quiz_container_outer_id+' .Quiz-result-Template5-left').each(function(){
					var sqb_bg_img = jQuery(this).css('background-image');
					if(sqb_bg_img != 'none'){
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
						
						var bg_img_tag = '<div class="quiz-bg-img" style="opacity:'+final_opacity+'"><img src="'+img_url[1]+'" alt="background"></div>';
						jQuery(this).attr('style','');
						jQuery(this).find('.points_scored_result').before(bg_img_tag);
						jQuery(this).css('background-color',final_color);	
					}
					});
				}
				
				if(jQuery('#'+sqb_quiz_container_outer_id+' .sqb_template5-fullWidth').hasClass('enable_branching_quiz')){
				jQuery('#'+sqb_quiz_container_outer_id+' .Quiz-Template5-left-side').find('.sqb_question_progress').hide();
				}
				
			}
			if(quiz_display == "inpage"){
				var template_num = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val();
				if(template_num == 'template1' || template_num == 'template2' || template_num == 'template3' || template_num == 'template4'){
					var max_width_temp = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template.show_cls').find('.temp_wid').val();				 
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template.show_cls').css("max-width",max_width_temp);			
				}
			}
			 
			//if quiz type is popup	
			if(quiz_display == "popup" || quiz_display == "entry" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based" || quiz_display == "corner_popup"){

				if(anim_effect){
					setTimeout(function() {
						if(jQuery('.modal_popup_outer').length < 1){
						var sqb_quiz_container_data = jQuery('#'+sqb_quiz_container_outer_id).html();	
				
				//if(jQuery('.modal_popup_outer').length < 1){
					//var sqb_quiz_id = jQuery('#'+sqb_quiz_container_inner+ ' .sqb_quiz_container').attr("id");	
					//var sqb_quiz_cls = jQuery('#'+sqb_quiz_container_inner+ ' .sqb_quiz_container').attr("class");}	
				jQuery('#'+sqb_quiz_container_outer_id).html('');				 
			 	
			 	var template_num = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val();

				jQuery('body').append('<div class="modal_popup_outer sqb_mobile_view_layout_active " id="pop'+sqb_quiz_container_outer_id+'"><div class="sqb_quiz_container_outer" id="'+sqb_quiz_container_outer_id+'"> '+sqb_quiz_container_data+'</div></div>');	
						sqb_call_slider_for_answer_events('start_screen_click');
						 
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_outer_fe').addClass('modal_popup');
						jQuery('.modal_popup_outer').addClass('show');
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_outer_fe').hide();
						
					}
				 
				 if(jQuery('.last_show_div ').val() == "quiz_result_template_outer quiz_outer_fe modal_popup show_cls") {
		 
					var temp_wid1= jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_result_template_outer .quiz_comon_template ").css("max-width");		
					if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6'){
					jQuery(".quiz_result_template_outer.quiz_outer_fe.modal_popup .modal_pop_inn").css("max-width",temp_wid1);	
					jQuery(".quiz_result_template_outer.quiz_outer_fe.modal_popup .modal_pop_inn").css("width",temp_wid1);
					}	
				}
		
		
				if(show_firstname_temp == 'Y'){ 
					sqb_apply_wid_css_popup("first_name",sqb_quiz_container_outer_id); 
				}else{
					sqb_apply_wid_css_popup("question", sqb_quiz_container_outer_id);
					var temp_wid2 = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template.show_cls').find('.temp_wid').val();
					if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6'){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("max-width",temp_wid2); 
					jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("width",temp_wid2);
					}
				}
				
				if(jQuery('.last_show_div ').val()== "quiz_result_template_outer quiz_outer_fe modal_popup show_cls") {					  	 
					var temp_wid1= jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_result_template_outer .quiz_comon_template ").css("max-width");		
					if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6'){
					jQuery(".quiz_result_template_outer.quiz_outer_fe.modal_popup .modal_pop_inn").css("max-width",temp_wid1);	
					jQuery(".quiz_result_template_outer.quiz_outer_fe.modal_popup .modal_pop_inn").css("width",temp_wid1);	
					}
				}
				
				 
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' .last_show_div').length > 0){
					 
					var nearbyclass = jQuery('#'+sqb_quiz_container_outer_id+ ' .last_show_div').val(); 	
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');
					 
					  jQuery( '#'+sqb_quiz_container_outer_id+ ' .quiz_outer_fe').each(function(){
						 var contianerclass = jQuery(this).attr("class");
						  contianerclass = contianerclass+" show_cls";
						 
						 if(contianerclass ==nearbyclass){
							 jQuery(this).show();
							 jQuery(this).addClass("show_cls");
						 }
					  });
					
				}else{
					
					if(show_firstname_temp == 'Y'){
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');	
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_firstname_template_outer').addClass(' show_cls').removeClass('hide_cls');	
						//function to go to the center of the visible div
						//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id);
					}else{					
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() == 'optin-before-questions-screen' && jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val() != 'N'){
							
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');
							
							autoSubmitOptin('pop'+sqb_quiz_container_outer_id);
							
							//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
						} else { 
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');		
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').addClass('show_cls').removeClass('hide_cls');	
						}							
						
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').length > 0 ){ 
							
							var show_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('data-question-id');
							var sqb_quiz_id =jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='quiz_id']").val();
							sqb_save_question_answer_report(sqb_quiz_id,show_question_id, 0,0, sqb_quiz_container_outer_id,'only_question');

						}					
						
					}
					
				}
					}, 1000);

					setTimeout(function(){
						var template_num = jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val();
						jQuery('.sqb_mobile_view_layout_active').addClass('template_num_'+template_num);
					},1000);
				}else{
					var sqb_quiz_container_data = jQuery('#'+sqb_quiz_container_outer_id).html();	
				
				//if(jQuery('.modal_popup_outer').length < 1){
					//var sqb_quiz_id = jQuery('#'+sqb_quiz_container_inner+ ' .sqb_quiz_container').attr("id");	
					//var sqb_quiz_cls = jQuery('#'+sqb_quiz_container_inner+ ' .sqb_quiz_container').attr("class");}	
			 	var template_num = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val();
				setTimeout(function(){
					jQuery('#'+sqb_quiz_container_outer_id).html('');				 
			 	}, 500);	 
				if(quiz_display == 'corner_popup'){
					if(jQuery('.modal_popup_outer').length < 1){
						jQuery('body').append('<div class="modal_popup_outer sqb_mobile_view_layout_active template_num_'+template_num+'" id="pop'+sqb_quiz_container_outer_id+'"><div class="sqb_quiz_container_outer" id="'+sqb_quiz_container_outer_id+'"> '+sqb_quiz_container_data+'</div></div>');
					}
				} else {
					if(jQuery('.modal_popup_outer').length < 1){
						jQuery('body').append('<div class="modal_popup_outer sqb_mobile_view_layout_active template_num_'+template_num+'" id="pop'+sqb_quiz_container_outer_id+'"><div class="sqb_quiz_container_outer" id="'+sqb_quiz_container_outer_id+'"> '+sqb_quiz_container_data+'</div></div>');

						jQuery('.Quiz-Template').each(function(){	
					 		jQuery(this).find('.date-question-type').each(function(){
					 			var date_format = jQuery(this).attr('data-date-format');
					 			var month_data = jQuery(this).attr('data-month-name');
					 			var month_data = month_data.split(",");
					 			var day_data = jQuery(this).attr('data-day-name');
					 			var day_data = day_data.split(",");
					 			var home_url = jQuery('#get_home_url').val();
					 			//jQuery(this).datepicker('destroy');
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
					 	});

					}
				}
				
				sqb_call_slider_for_answer_events('start_screen_click');
				 
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_outer_fe').addClass('modal_popup');
				jQuery('.modal_popup_outer').addClass('show');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_outer_fe').hide();
				 
				 if(jQuery('.last_show_div ').val() == "quiz_result_template_outer quiz_outer_fe modal_popup show_cls") {
		 
					var temp_wid1= jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_result_template_outer .quiz_comon_template ").css("max-width");		
					if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6'){
					jQuery(".quiz_result_template_outer.quiz_outer_fe.modal_popup .modal_pop_inn").css("max-width",temp_wid1);	
					jQuery(".quiz_result_template_outer.quiz_outer_fe.modal_popup .modal_pop_inn").css("width",temp_wid1);
					}	
				}
		
		
				if(show_firstname_temp == 'Y'){ 
					sqb_apply_wid_css_popup("first_name",sqb_quiz_container_outer_id); 
				}else{
					sqb_apply_wid_css_popup("question", sqb_quiz_container_outer_id);
					var temp_wid2 = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template.show_cls').find('.temp_wid').val();
					if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6'){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("max-width",temp_wid2); 
					jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("width",temp_wid2);
					}
				}
				
				if(jQuery('.last_show_div ').val()== "quiz_result_template_outer quiz_outer_fe modal_popup show_cls") {					  	 
					var temp_wid1= jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_result_template_outer .quiz_comon_template ").css("max-width");		
					if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6'){
					jQuery(".quiz_result_template_outer.quiz_outer_fe.modal_popup .modal_pop_inn").css("max-width",temp_wid1);	
					jQuery(".quiz_result_template_outer.quiz_outer_fe.modal_popup .modal_pop_inn").css("width",temp_wid1);
					}	
				}
				
				 
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' .last_show_div').length > 0){
					 
					var nearbyclass = jQuery('#'+sqb_quiz_container_outer_id+ ' .last_show_div').val(); 	
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');
					 
					  jQuery( '#'+sqb_quiz_container_outer_id+ ' .quiz_outer_fe').each(function(){
						 var contianerclass = jQuery(this).attr("class");
						  contianerclass = contianerclass+" show_cls";
						 
						 if(contianerclass ==nearbyclass){
							 jQuery(this).show();
							 jQuery(this).addClass("show_cls");
						 }
					  });
					
				}else{
					
					if(show_firstname_temp == 'Y'){
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');	
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_firstname_template_outer').addClass(' show_cls').removeClass('hide_cls');	
						//function to go to the center of the visible div
						//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id);
					}else{					
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');		

						var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
						if(sqb_quiz_type == 'form'){
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
						}else{
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').addClass('show_cls').removeClass('hide_cls');								
						}

						
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() == 'optin-before-questions-screen' && jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val() != 'N'){
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').addClass('hide_cls done_screen').removeClass('show_cls');
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
							setTimeout(function() {
								//console.log('Test');
								autoSubmitOptin(sqb_quiz_container_outer_id);
							}, 50); 
						} else { 
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');	
							if(sqb_quiz_type == 'form'){
								jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
							}else{	
								jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').addClass('show_cls').removeClass('hide_cls');	
							}
						}							
						
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').length > 0 ){ 
							
							var show_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('data-question-id');
							var sqb_quiz_id =jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='quiz_id']").val();
							sqb_save_question_answer_report(sqb_quiz_id,show_question_id, 0,0, sqb_quiz_container_outer_id,'only_question');

						}					
						
					}
					
				}
				}

			}else{ //for inpage
				var gotoNextCheck= true;
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #show_firstname_temp').val() != 'Y'){
				sqb_call_slider_for_answer_events('start_screen_click');
				}
				sqb_apply_wid_css(sqb_quiz_container_outer_id);
				//if start scrren has button only
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .Quiz-Start-Template2').length){
					var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
					if (isMobile) {  
					}else{ 						 
						if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() == 'template6'){
							if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation').val() == 'Y'){
							}else{
								
								if(jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer   ').offset().top >0){
									jQuery('html, body').animate({			  
									   scrollTop: jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').offset().top + 500			   
									}, "slow");  
								}
							}
						}
					}
						 
				}

				if(anim_effect){
					gotoNextCheck= false;
					setTimeout(function() {
						if(show_firstname_temp == 'Y'){
									 
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');		
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_firstname_template_outer').addClass('show_cls').removeClass('hide_cls');
							
							//function to go to the center of the visible div
							//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id);
						}else{
							if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() == 'optin-before-questions-screen' && jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val() != 'N'){
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
								} else { 
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');		
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').addClass('show_cls').removeClass('hide_cls');
									sqbScrollToNextScreen(sqb_quiz_container_outer_id);
							}
						}
					}, 1000);
				}else{
					if(show_firstname_temp == 'Y'){
									 
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');		
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_firstname_template_outer').addClass('show_cls').removeClass('hide_cls');
						
						//function to go to the center of the visible div
						//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id);
					}else{
						if(show_firstname_temp == 'Y'){			 
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');		
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_firstname_template_outer').addClass('show_cls').removeClass('hide_cls');
							
							//function to go to the center of the visible div
							//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id);
						}else{
						
							if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() == 'optin-before-questions-screen' && jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val() != 'N'){
								jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');
								//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
								var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();
								if(lesson_id > 0){
									jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').addClass('show_cls').removeClass('hide_cls');
								}else{
									autoSubmitOptin(sqb_quiz_container_outer_id);
								}
								
							} else {
							   jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');		

							    var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
							   if(sqb_quiz_type == 'form'){
							   jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
							   }else{
							   	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').addClass('show_cls').removeClass('hide_cls');
							   }
							   sqbScrollToNextScreen(sqb_quiz_container_outer_id);
							}
						}
					}
			}	
			if(show_firstname_temp == 'Y'){		
				//added for if start screen height is more and personalization screen is there, then we need to scrollto the top  of personalization screen	 
				gotoNextCheck= false;
				if(start_hgt > 700){
					jQuery('html, body').animate({
						scrollTop: jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_firstname_template_outer').offset().top-100
					}, "slow");
				}
			}else{
				displayMessageInScreens(sqb_quiz_container_outer_id); 			
			}
			//added for move question
			if(gotoNextCheck){
				sqbScrollToNextScreenAfterStartScreen(sqb_quiz_container_outer_id);
			}
			
			
			// for reports
			var sqb_quiz_id =jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='quiz_id']").val();
			var sqb_quiz_current_page_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='sqb_quiz_current_page_id']").val();
			sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_start_btn_click');
			
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').length > 0 ){
				var show_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container.show_cls').attr('data-question-id');
				sqb_save_question_answer_report(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_id').val(),show_question_id, 0,0, sqb_quiz_container_outer_id);	
				sqb_all_question_view_insert(sqb_quiz_container_outer_id);
			}
			
			if(jQuery('#'+sqb_quiz_container_outer_id).find('#quiz_pagination').val() == 'all'){
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val() == ''){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template-outer').css('max-width','700px');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template-outer').css('margin','0 auto');
				}
				jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass("question_container_disabled");
				jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').first().removeClass("question_container_disabled");
			}
		} 
		var slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
		if(slider_animation == 'N'){
			setTimeout(function(){
				jQuery('#'+sqb_quiz_container_outer_id+' .show_cls').find('.numeric_text_cls').addClass('sqb_ans_selected');
 				jQuery('.numerical_text_cls.show_cls .numeric-value-prefix input').focus();
	 		},500)
		}
	});
	
	//optin page button
	jQuery(document).on('click','.quiz_optin_template_outer .continue_btn' ,function(evt){
		evt.stopImmediatePropagation();
		evt.preventDefault();
		var continue_btn_text = jQuery(this).html();
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		
		var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
    	if(sqb_quiz_type == 'form'){
     		jQuery('#'+sqb_quiz_container_outer_id+' .quiz_result_template_outer .outcome_div').show();
    	}


		var continue_btn_text = jQuery(this).html();
		
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}
		var sqb_opt_screen_position = jQuery(this).closest('.sqb_quiz_container_outer').find('#sqb_opt_screen_position').val();
		var sqb_quiz_attempted = jQuery(this).closest('.sqb_quiz_container_outer').find('#quiz_attempted').val();
		
		if(sqb_opt_screen_position == 'optin-before-questions-screen' && jQuery('#'+sqb_quiz_container_outer_id+' #quiz_attempted').val() == 'N'){
			
			if(sqb_validate_optin_screen(sqb_quiz_container_outer_id)){
				
				var sbq_email_verify = jQuery('#'+sqb_quiz_container_outer_id+' #quick_email_verification').val();
				if(sbq_email_verify == 'Y'){
					var email = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup #email').val();		
					sqbEmailChecker(email, sqb_quiz_container_outer_id, continue_btn_text, not_call_register = 'Y');
				}else{
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('hide_cls done_screen').removeClass('show_cls');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').addClass('show_cls').removeClass('hide_cls');
				}
			}
			
		} else {
		var sbq_email_verify = jQuery('#'+sqb_quiz_container_outer_id+' #quick_email_verification').val();
		if(sbq_email_verify == 'Y'){
			var email = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup #email').val();		
			sqbEmailChecker(email, sqb_quiz_container_outer_id, continue_btn_text);		
		}else{
			if(sqb_quiz_type == 'poll'){
				var resultdata = sqbSubmitVote(sqb_quiz_container_outer_id, "", "" ,"", continue_btn_text);	
			}else{
				var resultdata = sqbRegisterUser(sqb_quiz_container_outer_id, "", "" ,"", continue_btn_text);	

			}
		}

		if(jQuery("#sqbgdprcheckbox").hasClass('required') && jQuery("#sqbgdprcheckbox").prop('checked') == false){
			jQuery('.sqb-gdpr-checkbox .checkbox-custom-style').addClass('checkbox-focus');
	 	}
	 	var outcome_id= 0;
		if(jQuery("#"+sqb_quiz_container_outer_id+"  #outcome_final").length != 0){
		  outcome_id =  jQuery("#"+sqb_quiz_container_outer_id+"  #outcome_final").val();
		}
		if(outcome_id != 0){
		  sqb_update_outcome_ranking_merge_tag(sqb_quiz_container_outer_id, outcome_id);
		}
	  
		}
		
	});
	
	
	//first name screen on button
	jQuery(document).on('click', ' .firstname_ok_btn',function(evt){
			evt.stopImmediatePropagation();
			
			var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
			var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
			
			var firstName = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_first_name').val();
			if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
				sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
			} 
			
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_first_name').val() == ''){
				var username_empty_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #username_empty_msg').val();	 		 
				return false;
			}else{				 				
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_firstname_template_outer ').addClass('hide_cls done_screen').removeClass('show_cls');
				var selected_template = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val();
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() == 'optin-before-questions-screen' && jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val() != 'N'){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer,  #'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');
					//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
					
					
					setTimeout(function() {
						jQuery('#'+sqb_quiz_container_outer_id).find('#first_name').val(firstName);
						autoSubmitOptin(sqb_quiz_container_outer_id);
					}, 50); 

				} else { 
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').addClass('show_cls').removeClass('hide_cls');	
				}			
			}
			displayMessageInScreens(sqb_quiz_container_outer_id);
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .question_container').each(function(){
				var data = this;
				var html = jQuery(data).html();
				var count = (html.match(/%%FIRST%%/g) || []).length;				 
				for(i=0; i < count; i++){
					var html = jQuery(data).html();
					jQuery(data).html(html.replaceAll('%%FIRST%%', firstName)); 
				}	
				 
			});
			
			setTimeout(function(){
				jQuery('#'+sqb_quiz_container_outer_id).find('#first_name').val(firstName);
			},10);
			

			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .sql_ans_text').each(function(){
				var html = jQuery(this).html();
				jQuery(this).html(html.replaceAll('%%FIRST%%', firstName)); 
			});

			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .quiz_comon_template').each(function(){	
				var html = jQuery(this).html();		 
				jQuery(this).html(html.replaceAll('%%FIRST%%', firstName));
			});
			
			var email = sqbgetUrlVars()["email"];
			if(email != null){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer #email').val(email);
			}
			var show_firstname_outcome = jQuery('#show_firstname_outcome').val();
			if(show_firstname_outcome== 'Y'){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer #first_name').val(firstName);
			}

			//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer #first_name').val(firstName);

			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
				var html = jQuery(this).html();
				jQuery(this).html(html.replaceAll('%%FIRST%%', firstName));
			});	
			
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .Quiz-Template-content-inn').each(function(){
				var html = jQuery(this).html();
				jQuery(this).html(html.replaceAll('%%FIRST%%', firstName));
			});	 

			jQuery('#'+sqb_quiz_container_outer_id+ ' .analyzing_result_temp .analyzing_result_content').each(function(){
				var html = jQuery(this).html();
				jQuery(this).html(html.replaceAll('%%FIRST%%', firstName));
			});	
			
			//function to go to the center of the visible div
			//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id);
			sqb_call_slider_for_answer_events('start_screen_click');
			sqb_apply_wid_css(sqb_quiz_container_outer_id);
			
		});
		 
		jQuery(document).on('keyup','  .sqb_first_name',function(evt){
			evt.stopImmediatePropagation();
		 
			firstName = jQuery(this).val();
			var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
			var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
			
			if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
				sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
			} 
			if(jQuery(this).val() != ''){
				//var style = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').attr('style');
				//jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_first_name_ok_btn').find('.firstname_ok_btn').attr('style' , style);
				jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_first_name_ok_btn').find('.firstname_ok_btn').css('display', 'inline-block');	
			}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_first_name_ok_btn').find('.firstname_ok_btn').hide();		
			}
			
		});
 
 
 
	
 //CHECKBOX CLICK
	jQuery(document).on('click', ' .sqb_and_field.checkbox_fe' , function(evt){
		evt.stopImmediatePropagation();		
		if(jQuery(this).prop("checked") == true){
			 jQuery(this).closest('.sqb_ans_item_outer').addClass('sqb_ans_selected');  			 
		}else{
			jQuery(this).closest('.sqb_ans_item_outer').removeClass('sqb_ans_selected');  			 
		}
		
	});
	//Dropdown Select
	jQuery(document).on('change', ' .sqb_question_dropdown' , function(evt){
		evt.stopImmediatePropagation();		
		if (jQuery(this).val() != ""){
		jQuery(this).closest('.sqb_ans_item_outer').addClass('sqb_ans_selected');  
		} else {
		jQuery(this).closest('.sqb_ans_item_outer').removeClass('sqb_ans_selected'); 
		} 
	});
	//multiple_correct_checkbox click
	jQuery(document).on('click', ' .sqb_ans_item_outer.multiple_correct_checkbox' , function(evt){
		evt.stopImmediatePropagation();	

		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var select_temp = jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val();
		var quiz_display = jQuery("#"+sqb_quiz_container_outer_id+ " #quiz_display").val();

		if(select_temp == 'template6' && quiz_display == 'popup'){
			jQuery(this).addClass('sqb_ans_selected');
			if(jQuery(this).hasClass("sqb_ans_selected") == true){
				jQuery(this).find(".sqb_and_field.checkbox_fe").prop("checked" , true); 			
			}else{
				jQuery(this).find(".sqb_and_field.checkbox_fe").prop("checked" , false);			
			}
			
			jQuery('.sqb_and_field.checkbox_fe').each(function(){		
				if(jQuery(this).prop("checked") == true){
					 jQuery(this).closest('.sqb_ans_item_outer').addClass('sqb_ans_selected');  			 
				}else{
					jQuery(this).closest('.sqb_ans_item_outer').removeClass('sqb_ans_selected');  			 
				}	
			}); 
		}
	});
	



});

function sqb_validate_optin_screen(sqb_quiz_container_outer_id){
	
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ "  input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();

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
	
	var first_name = jQuery("#"+sqb_quiz_container_outer_id+ " #first_name").val();
	var email = jQuery("#"+sqb_quiz_container_outer_id+ " #email").val();
	
	var sqb_required_field = jQuery("#sqb_required_field").val();
	var sqb_gdpr_required_field = jQuery("#sqb_gdpr_required_field").val();
	jQuery('#'+sqb_quiz_container_outer_id+ ' .sqbwarning_div').remove();
		 
	if(first_name == ""){
		var first_name = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup #first_name').val();	
	}
	if(email ==""){		
		var email = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup #email').val();		
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
		//GDPR
	var gdpr_value = jQuery('#gdpr_compliance').val();
	if(gdpr_value == 1){
		var gdpr_condition_req = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup #sqbgdprcheckbox').hasClass('required');
		var gdpr_cond_visi = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup .sqb-gdpr-checkbox').css('display');
	}	
	
	var gdpr_required = '';
	if(gdpr_value == 1){
		if(gdpr_condition_req == true && gdpr_cond_visi != 'none' && jQuery('#'+sqb_quiz_container_outer_id+ ' #sqbgdprcheckbox').prop('checked') !=  true){
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .form_cls').before('<div class="sqbwarning_div"><b>'+sqb_gdpr_required_field+'</b></div>');
			returnFalse = true; 
		}
	}
	if(returnFalse == true){
		return false;	
	} else {
		return true;
	}
}

function sqb_advanced_rule(quiz_id = 0,question_id = 0, answer_id = 0, outcome_id = 0, sqb_quiz_container_outer_id = ''){				
	 var data =0;  
	//advanced rule data
	if(answer_id > 0){ 		
		var question_type ="";
		//if(question_type == "multi" || question_type == "single" || question_type == "yes_no"){ 	
							
			var outcomerule_id = jQuery('#sqb_ans_id'+answer_id).attr('data-outcomerule-id');
			var skipoptin = jQuery('#sqb_ans_id'+answer_id).attr('data-skipoptin-id');		
			var continuequiz = jQuery('#sqb_ans_id'+answer_id).attr('data-continuequiz');		
			
			if(outcomerule_id > 0){

				if(continuequiz == 'N'){

					data =1;	
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template-overflow').after('<div class="spinner spinner1"><div class="bounce1"></div><div class="bounce2"></div></div>'); 
					setTimeout(function(){		 
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template .spinner').remove();  
					}, 3000);

					if(jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val() < 1){
						jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val(outcomerule_id);
					}	
					
					if(skipoptin=="Y"){	//skip optin					 					
						jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val("N");	  
								 
					}else{
						// donotskip optin							
					}
					var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();	 
					if(sqb_quiz_type == "personality"){
						personality_last_child_calculation(sqb_quiz_container_outer_id,  '', 'notcount');
					}else if(sqb_quiz_type == "assessment"){
						assessment_last_child_calculation(sqb_quiz_container_outer_id, '', 'notcount');
					}else if(sqb_quiz_type == "scoring"){
						jQuery('#'+sqb_quiz_container_outer_id+ ' .single_cls').css('pointer-events', 'none');
						scoring_last_child_calculation(sqb_quiz_container_outer_id,  '', 'notcount');
					}else if(sqb_quiz_type == "survey" || sqb_quiz_type == "calculator" ){			
						survey_last_child_calculation(sqb_quiz_container_outer_id,  '', 'notcount');
					}else if(sqb_quiz_type == "poll"){
						sqb_save_question_answer_report_poll(quiz_id,question_id, answer_id,outcome_id, sqb_quiz_container_outer_id);
						poll_last_child_calculation(sqb_quiz_container_outer_id,  '', 'notcount');
					}
					return data;
				}else{

					if(jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val() < 1){

						if(skipoptin=="Y"){	//skip optin					 					
							jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val("N");	  
									 
						}else{
							// donotskip optin							
						}

						jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val(outcomerule_id);	

					}
				}
			
			}
		}
	 return data;
	//advanced rule data ends
}
/*
function sqb_advanced_rule(quiz_id = 0,question_id = 0, answer_id = 0, outcome_id = 0, sqb_quiz_container_outer_id = ''){				
	 var data =0;  
	//advanced rule data
	if(answer_id > 0){ 		
		var question_type ="";
		//if(question_type == "multi" || question_type == "single" || question_type == "yes_no"){ 	
							
			var outcomerule_id = jQuery('#sqb_ans_id'+answer_id).attr('data-outcomerule-id');
			var skipoptin = jQuery('#sqb_ans_id'+answer_id).attr('data-skipoptin-id');		
			 
			if(outcomerule_id > 0){	
				data =1;	
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template-overflow').after('<div class="spinner spinner1"><div class="bounce1"></div><div class="bounce2"></div></div>'); 
				setTimeout(function(){		 
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template .spinner').remove();  
				}, 3000);
						 
				jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val(outcomerule_id);	
				
				if(skipoptin=="Y"){	//skip optin					 					
					jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val("N");	  
							 
				}else{
					// donotskip optin							
				}
				var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();	 
				if(sqb_quiz_type == "personality"){
					personality_last_child_calculation(sqb_quiz_container_outer_id,  '', 'notcount');
				}else if(sqb_quiz_type == "assessment"){
					assessment_last_child_calculation(sqb_quiz_container_outer_id, '', 'notcount');
				}else if(sqb_quiz_type == "scoring"){
					scoring_last_child_calculation(sqb_quiz_container_outer_id,  '', 'notcount');
				}else if(sqb_quiz_type == "survey" || sqb_quiz_type == "calculator" ){			
					survey_last_child_calculation(sqb_quiz_container_outer_id,  '', 'notcount');
				}
				return data;
			}
		}
	 return data;
	//advanced rule data ends
}
*/

function sqb_save_question_answer_report(quiz_id = 0,question_id = 0, answer_id = 0, outcome_id = 0, sqb_quiz_container_outer_id = '',only_question = '',answered='',other_field = ''){
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
		var ajaxurl = jQuery('#sqb_ajaxurl').val();	
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
				var status = returndata.status;
				if(status == 'Y'){
				console.log('status is on');
				  /*fbq('track', event_name, {
					content_name: event_name, 
					content_ids: tags,
					content_type: action_name,
					value: value
				  });*/

				  	var quiz_title = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_quiz_title').val();
				    var question_title = removeTags(jQuery('#'+sqb_quiz_container_outer_id+' #question_id_'+question_id+' .question_title').html());
					console.log(question_title);
					if(action_name == 'question'){
						fbq('trackCustom', 'Question', {
							quiz_title: quiz_title,
							question_title: question_title,
							tag : tag
						});
					}else if(action_name == 'answer'){
						var answer_value = getSelectedAnswer(question_id,answer_id,sqb_quiz_container_outer_id);
						fbq('trackCustom', 'Answer Choice', {
							quiz_title: quiz_title,
							question_title: question_title,
							answer_title: answer_value
						});
					}
				}       
			}

		});		
	}	
}	

var is_global_redirect = false;
//Added where register user is taking time
function outcomeRedirectCallBeforeReister(sqb_quiz_container_outer_id){
	
	var is_redirect = false;
	//if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() != 'optin-before-questions-screen' && jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val() == 'Y'){
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
			if(jQuery(this).css('display') != 'none'){
				var outcome_final_id = jQuery(this).attr('id');
				if(typeof outcome_final_id != 'undefined' && outcome_final_id != '' ){
					var sqb_outcome_max_key = outcome_final_id.split("outcome_id_");
					var outcome_screen =  jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_id_'+sqb_outcome_max_key[1]).find("#outcome_screen").val();
					if(outcome_screen == "redirect"){
						is_redirect = true;
						is_global_redirect = true;
						
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() != 'optin-before-questions-screen' && jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val() == 'Y'){
							jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').html('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
							jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').addClass('is-btn-redirect');
						}else{
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('show_cls').removeClass('hide_cls');
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('fullscreen-loader');
						}
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').addClass('is-redirect');
					}
				}
			}
		});
	//}

	var social_share_screen_value = jQuery('#'+sqb_quiz_container_outer_id+ ' #social_share_screen_value').val();
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
		if(jQuery(this).css('display') != 'none'){
			var outcome_final_id = jQuery(this).attr('id');
			var template_num = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val();
			if(template_num =="template4"){ 
				jQuery("#"+sqb_quiz_container_outer_id+ " #"+outcome_final_id).parent('.outer-style3').css('display','inline-block');
			}
			if(typeof outcome_final_id != 'undefined' && outcome_final_id != '' ){
				var sqb_outcome_max_key = outcome_final_id.split("outcome_id_");				 
				var outcome_screen =  jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_id_'+sqb_outcome_max_key[1]).find("#outcome_screen").val();
				var outcome_redirect =  jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_id_'+sqb_outcome_max_key[1]).find("#outcome_redirect").val();	 
				// append social share section
				if(social_share_screen_value != 'Y'){
				sqb_append_share_btn('outcome_id_'+sqb_outcome_max_key[1]);
				}
				if(outcome_screen == "redirect"){		
					//sqb_showloader();
					
					if(!is_redirect){
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer ').addClass('hide_cls done_screen').removeClass('show_cls');		
					}
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div, #'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer, #'+sqb_quiz_container_outer_id+ ' .quiz_analyzing_template_outer').hide();
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_analyzing_template_outer').addClass('hide_analyzing_cls');	
					if(!is_redirect){		
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .continue_btn ').css('opacity','.5');
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .continue_btn ').css('cursor','not-allowed');
					}
					var sqb_redi_firstName = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer #first_name').val();
					var sqb_redi_email = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup #email').val();
					outcome_redirect = outcome_redirect.replace('%%EMAILID%%', sqb_redi_email); 							 
					outcome_redirect = outcome_redirect.replace('%%FIRSTNAME%%', sqb_redi_firstName); 						
					
					if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() =="all"){						 
							window.top.location.href  = outcome_redirect;
					}else{						 
						jQuery(document).ajaxStop(function(){
							window.top.location.href  = outcome_redirect;
						}); 
					}					
				}else{
					showOutcomeScreen(sqb_quiz_container_outer_id);
				}
			}else{
				//setTimeOutForOutcome(sqb_quiz_container_outer_id);
			}
		}else{
			//setTimeOutForOutcome(sqb_quiz_container_outer_id);
		}

		var str = jQuery('#'+outcome_final_id).html();
     	if(typeof str != 'undefined' && str != ''){
	     	if(str.match(/(^|\W)SHOWALLUSERTAGS($|\W)/)){
         	jQuery('#'+outcome_final_id).html(jQuery('#'+outcome_final_id).html().replaceAll('[SHOWALLUSERTAGS]', '<div class="sqb_tags_content_details_outer" style="display:none;">[SHOWALLUSERTAGS]</div>'));
	     	}
	  	}
	});


	var SQBPreview = jQuery('#SQBPreview').val();
	if(SQBPreview =="Y"){
		var  outcome_screen = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_screen').val();
			if(outcome_screen == "redirect"){	
			outcome_redirect = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_redirect').val();
			window.top.location.href  = outcome_redirect;
			return false;
		}
	}

}

function setTimeOutForOutcome(sqb_quiz_container_outer_id){ 
	setTimeout(function() {		 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer ').addClass('hide_cls done_screen').removeClass('show_cls');		
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').addClass('show_cls').removeClass('hide_cls');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		
		if(quiz_display == "popup" ){				
			var temp_wid2 = jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_result_template_outer  .quiz_comon_template ").css("max-width");
			if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6'){		
			jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_result_template_outer  .Quiz-Template.show_cls").css("max-width",temp_wid2);	
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("max-width",temp_wid2); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("width",temp_wid2);
			}	
		} 
	}, 200); 
}

function outcomeRedirectCall(sqb_quiz_container_outer_id, show_outcome_again=''){
	
	var social_share_screen_value = jQuery('#'+sqb_quiz_container_outer_id+ ' #social_share_screen_value').val();
	outcome_ids_array = [];
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_current_page_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='sqb_quiz_current_page_id']").val();			
	if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_outcome_has').val() != 0){

		var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
		if(sqb_quiz_type != 'poll'){
			sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_outcome_show');
		}
	}
	sqb_apply_wid_css_popup("result", sqb_quiz_container_outer_id); 


	var is_redirect = false;

	//if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() != 'optin-before-questions-screen' && jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val() == 'Y'){
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
			if(jQuery(this).css('display') != 'none'){
				var outcome_final_id = jQuery(this).attr('id');
				if(typeof outcome_final_id != 'undefined' && outcome_final_id != '' ){
					var sqb_outcome_max_key = outcome_final_id.split("outcome_id_");
					var outcome_screen =  jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_id_'+sqb_outcome_max_key[1]).find("#outcome_screen").val();
					if(outcome_screen == "redirect"){
						
						is_redirect = true;
						is_global_redirect = true;
						/*setTimeout(function() {
							jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').html('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');		 
						}, 300); */
						
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() != 'optin-before-questions-screen' && jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val() == 'Y'){
							jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').addClass('is-btn-redirect');
						}else{
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('show_cls').removeClass('hide_cls');
						}
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').addClass('is-redirect');
					}
				}
			}
		});
	//}

	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
		if(jQuery(this).css('display') != 'none'){
			var outcome_final_id = jQuery(this).attr('id');
			var template_num = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val();
			if(template_num =="template4"){ 
				jQuery("#"+sqb_quiz_container_outer_id+ " #"+outcome_final_id).parent('.outer-style3').css('display','inline-block');
			}
			if(typeof outcome_final_id != 'undefined' && outcome_final_id != '' ){
				var sqb_outcome_max_key = outcome_final_id.split("outcome_id_");				 
				var outcome_screen =  jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_id_'+sqb_outcome_max_key[1]).find("#outcome_screen").val();
				var outcome_redirect =  jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_id_'+sqb_outcome_max_key[1]).find("#outcome_redirect").val();	 
				// append social share section
				if(social_share_screen_value != 'Y'){
				sqb_append_share_btn('outcome_id_'+sqb_outcome_max_key[1]);
				}
				if(outcome_screen == "redirect"){
					//sqb_showloader();			 							 
					var sqb_redi_firstName = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer #first_name').val();
					var sqb_redi_email = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup #email').val();
					outcome_redirect = outcome_redirect.replace('%%EMAILID%%', sqb_redi_email); 							 
					outcome_redirect = outcome_redirect.replace('%%FIRSTNAME%%', sqb_redi_firstName); 		
					
					jQuery(document).ajaxStop(function(){	
						window.location = outcome_redirect; 
					}); 
				}else{
					showOutcomeScreen(sqb_quiz_container_outer_id, show_outcome_again);
				}
			}else{
				showOutcomeScreen(sqb_quiz_container_outer_id, show_outcome_again);
			}
		}else{
			showOutcomeScreen(sqb_quiz_container_outer_id, show_outcome_again);
		}
	}); 
	
	
}


function sqb_showloader(){
	jQuery('.sqb_loader_outer').show();
}

function sqb_hideloader(){
	jQuery('.sqb_loader_outer').hide(); 
}

function showOutcomeScreen(sqb_quiz_container_outer_id, show_outcome_again=''){ 
	setTimeout(function() {	
		show_analyzing_result_screen(sqb_quiz_container_outer_id);  
		var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();
		lesson_id = jQuery.isNumeric(lesson_id);
		 if( lesson_id !="" && lesson_id == true){	 
		} else{
			if(show_outcome_again !="N"){
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() == 'optin-before-questions-screen'){
				}else{
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer ').addClass('hide_cls done_screen').removeClass('show_cls');
					var social_share_screen_value = jQuery('#'+sqb_quiz_container_outer_id+ ' #social_share_screen_value').val(); 
					if(social_share_screen_value == 'Y' && jQuery('#'+sqb_quiz_container_outer_id+' .sqb_social_share_next_btn').hasClass('disable_social_share_next_btn')){
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_social_share_template_outer').addClass('show_cls').removeClass('hide_cls');
					} else {
						var show_analysing = true;
						var shown_analysing_screen = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_analyzing_template_outer').hasClass('done_screen');
						if(shown_analysing_screen){
						show_analysing = false;
						}	 
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #show_analyzing_result').val() == 'Y' && show_analysing){
							var show_analyzing_result_time = jQuery("#"+sqb_quiz_container_outer_id+ "  #show_analyzing_time_delay").val();	
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_analyzing_template_outer ').addClass('show_cls').removeClass('hide_cls'); 
							sqb_show_analyze_screen(sqb_quiz_container_outer_id);		
							setTimeout(function() {	
								jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_analyzing_template_outer ').addClass('hide_cls').removeClass('show_cls'); 
								sqb_fun_animation_show(sqb_quiz_container_outer_id);
								jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').addClass('show_cls').removeClass('hide_cls');		
							}, show_analyzing_result_time+'000');	
						}else{
							var allow_retake = jQuery('#'+sqb_quiz_container_outer_id+ ' #allow_retake').val();
							if(allow_retake == 'Y' && social_share_screen_value == 'Y'){
							} else {
							sqb_fun_animation_show(sqb_quiz_container_outer_id);
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').addClass('show_cls').removeClass('hide_cls');
							}	
						}
					}
					//added for move screen
					if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){		 
									
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() != 'optin-before-questions-screen'){
							if(jQuery('#'+sqb_quiz_container_outer_id+ ' #move_question').val() == 'Y'){
								
								if((jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation').val() == 'Y') && (jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation_option').val() == 'tb')){ 
									
								}else{	
									if(jQuery('#'+sqb_quiz_container_outer_id+ ' #show_analyzing_result').val() == 'Y'){
										quizScrollToDivTopResult('#'+sqb_quiz_container_outer_id+ ' .quiz_analyzing_template_outer ', sqb_quiz_container_outer_id, 'analyzing');
									}else{
										quizScrollToDivTopResult('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  ', sqb_quiz_container_outer_id);
									} 	
								} 	
								 
							}
						}
					}
					
					
				}
			}
		}  
	}, 100);
	
}


function show_loader_on_last_child(sqb_quiz_container_outer_id, parent_ques_div){
	jQuery('#'+sqb_quiz_container_outer_id+ '  .question_container').addClass('question_container_disabled');
	if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
	jQuery('#'+sqb_quiz_container_outer_id+ '  .quiz_quesans_template_outer.quiz_outer_fe').hide();
	}
	
	var single_next_btn_len = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.single_next_btn').length;
	 
	if(single_next_btn_len > 0 ){
		var orgi_text = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div+' .single_next_btn').html();	
		jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div+' .single_next_btn').html('<div class="spinner spinner1"><div class="bounce1"></div><div class="bounce2"></div></div>');	
		setTimeout(function(){ 
			//jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div+' .single_next_btn').html(orgi_text);
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div+' .single_next_btn').html('<div class="spinner spinner1"><div class="bounce1"></div><div class="bounce2"></div></div>');
		}, 3000);
		setTimeout(function(){		 
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div+' .single_next_btn').html(orgi_text);
		}, 6000);
	}else{
		jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).after('<div class="spinner spinner1"><div class="bounce1"></div><div class="bounce2"></div></div>');
		setTimeout(function(){		 
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div+'  .spinner').remove();
		}, 6000);		
	}	
}

function gettimer_spent(sqb_quiz_container_outer_id, notcount=''){

	var timer_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #timer_count').val();
	jQuery('#'+sqb_quiz_container_outer_id+ ' #timer_stop').val(1);
 
	var timer_spent = jQuery('#'+sqb_quiz_container_outer_id+ ' #timer_spent').val();
	jQuery('#'+sqb_quiz_container_outer_id+ ' #time_spent1').val(timer_spent);
	var sqb_seconds_text = jQuery('#'+sqb_quiz_container_outer_id+ ' #timer_text_sec_html').text();
	 
	if(jQuery('.quiz_timer_spent_msg').length)
	{
		
		var timer_spent_text = sqbSecondsToDhms(timer_spent) ;
		jQuery('.quiz_timer_spent_msg').html(jQuery('.quiz_timer_spent_msg').html().replace('%%TIMESPENT%%', '<b> '+timer_spent_text+'</b>'));
		jQuery('.quiz_timer_spent_msg').html(jQuery('.quiz_timer_spent_msg').html().replace('%%TIMELEFT%%', '<b> '+timer_spent_text+'</b>')); 
	}	
	var show_optin = jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin ').val();
	var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();
	 	
	if(notcount !="notcount"){	
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer  .sqb_counter_expired_msg ').hide();	
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .sqb_counter_expired_msg ').hide();	
		
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer  .quiz_timer_html_data ').hide();
		if(lesson_id > 0){
			 jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer   .quiz_timer_spent_msg ').show();		 
		}else{ 
			if(show_optin =="Y"){				 				
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer  .quiz_timer_spent_msg ').show();
			}else{			 
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .quiz_timer_spent_msg ').show();
			}
		}
	}else{	
		if(lesson_id > 0){
			 jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer   .sqb_counter_expired_msg ').show();
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer   .quiz_timer_spent_msg ').show();		 
		}else{
			if(show_optin =="Y"){	
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer  .sqb_counter_expired_msg ').show();				
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer  .quiz_timer_spent_msg ').show();
			}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .sqb_counter_expired_msg ').show();
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .quiz_timer_spent_msg ').show();
			}		 
		}
	}
	 
}

function personality_last_child_calculation(sqb_quiz_container_outer_id,  parent_ques_div='', notcount =''){
	 
	var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();	
	
	//time spent
	gettimer_spent(sqb_quiz_container_outer_id, notcount);
	  
	if(notcount =="notcount"){		
	}else{
		// progressbar
		sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div); 
	}
	
	//var sqb_outcome_max_key = sqb_mode(outcome_ids_array, sqb_quiz_container_outer_id); 
	 
	//which outcome to show calculation here	
	var sqb_outcome_max_key =  sqb_personality_outcome_calculations(sqb_quiz_container_outer_id);	
					
	 //replace merge tag in html 
	replaceOutcomeMergeTags(sqb_quiz_container_outer_id);
	if(notcount =="notcount"){		
	}else{
		var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
		if(show_optin == 'N'){
			show_loader_on_last_child(sqb_quiz_container_outer_id, parent_ques_div)
		}
		
	}
	//show_optin or not
	var show_analyzing_result = jQuery('#show_analyzing_result').val();
	
		show_optin_form(sqb_quiz_container_outer_id) ;
		
	// save report info
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ "  input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_current_page_id =jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='sqb_quiz_current_page_id']").val();
	if(notcount =="notcount"){		
	}else{
		sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_last_question_btn_click');
	}
	sqb_generate_share_variable_dynamic(sqb_quiz_container_outer_id,sqb_quiz_id,'personality',sqb_outcome_max_key);	 
}


function assessment_last_child_calculation(sqb_quiz_container_outer_id, parent_ques_div='' , notcount =''){	 
	var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();		//time spent
	 
	gettimer_spent(sqb_quiz_container_outer_id, notcount);
	if(notcount =="notcount"){		
	}else{
		// progressbar
		sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
	}
	//which outcome to show calculation here	
	setTimeout(function(){ 
		sqb_assessment_outcome_calculations(sqb_quiz_container_outer_id, notcount);	
	 }, 500);
	if(notcount =="notcount"){		
	}else{
		var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();	
		if(show_optin == 'N'){
			show_loader_on_last_child(sqb_quiz_container_outer_id, parent_ques_div)
		}
	}
	//show_optin or not
	var show_analyzing_result = jQuery('#show_analyzing_result').val();
	
		show_optin_form(sqb_quiz_container_outer_id) ;
	
	//function to go to the center of the visible div
	//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer', sqb_quiz_container_outer_id);
	setTimeout(function(){ 
		var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
		var num_of_outcomes = jQuery("#"+sqb_quiz_container_outer_id+ " #quiz_outcome_has").val();
		if(show_optin =="N" && num_of_outcomes < 1){
			jQuery('.close_Side_Popup').trigger('click');	
		}
	}, 3000);	
}

function poll_last_child_calculation(sqb_quiz_container_outer_id, parent_ques_div='' , notcount =''){	
 	
	 
	var is_outcome_redirect =   jQuery('#'+sqb_quiz_container_outer_id+ ' input#poll_redirect').val();

	if(is_outcome_redirect == 'Y'){

	/*if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
		jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').addClass('is-loading');
	}else{
		jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').addClass('is-loading');
	}*/
	var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();	
	
	//time spent
	gettimer_spent(sqb_quiz_container_outer_id, notcount);
	  
	if(notcount =="notcount"){		
	}else{
		// progressbar
		sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div); 
	}
	
	//var sqb_outcome_max_key = sqb_mode(outcome_ids_array, sqb_quiz_container_outer_id); 
	 
	//which outcome to show calculation here	
	var sqb_outcome_max_key =  sqb_poll_outcome_calculations(sqb_quiz_container_outer_id);	
					
	 //replace merge tag in html 
	replaceOutcomeMergeTags(sqb_quiz_container_outer_id);
	if(notcount =="notcount"){		
	}else{
		var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
		if(show_optin == 'N'){
			//show_loader_on_last_child(sqb_quiz_container_outer_id, parent_ques_div)
		}
		
	}
	//show_optin or not
	var show_analyzing_result = jQuery('#show_analyzing_result').val();
	
		show_optin_form_poll(sqb_quiz_container_outer_id);
		
	// save report info
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ "  input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_current_page_id =jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='sqb_quiz_current_page_id']").val();
	if(notcount =="notcount"){		
	}else{
		//sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_last_question_btn_click');
	}
	//sqb_generate_share_variable_dynamic(sqb_quiz_container_outer_id,sqb_quiz_id,'poll',sqb_outcome_max_key);	 
}else{

	/*if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
							jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').addClass('is-loading');
				  		}else{
							jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').addClass('is-loading');
				  		}*/
	var show_analyzing_result = jQuery('#show_analyzing_result').val();
	show_optin_form_poll(sqb_quiz_container_outer_id);
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ "  input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_current_page_id =jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='sqb_quiz_current_page_id']").val();


	//sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_last_question_btn_click');
	}
}

function scoring_last_child_calculation(sqb_quiz_container_outer_id,  parent_ques_div='' , notcount =''){	 
	 
	var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();	
	//time spent
	gettimer_spent(sqb_quiz_container_outer_id, notcount);
	if(notcount =="notcount"){		
	}else{
		// progressbar
		sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
	}	
	  
	//replace merge tag in html 
	setTimeout(function(){ 
		sqb_scoring_outcome_calculations(sqb_quiz_container_outer_id);
	}, 500);
	
	 if(notcount =="notcount"){		
	}else{
		var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
		/*var show_analyzing_result = jQuery("#"+sqb_quiz_container_outer_id+ " #show_analyzing_result").val();
		if(show_optin == 'N' && show_analyzing_result == 'Y'){
			sqb_show_analyze_screen();
		}else{
			show_loader_on_last_child(sqb_quiz_container_outer_id, parent_ques_div)
		}*/
		if(show_optin == 'N'){
			show_loader_on_last_child(sqb_quiz_container_outer_id, parent_ques_div)
		}
	} 
	//show_optin or not
	
	show_optin_form(sqb_quiz_container_outer_id) ;
	

	//function to go to the center of the visible div
	//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer', sqb_quiz_container_outer_id);
	setTimeout(function(){ 
			var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
			var num_of_outcomes = jQuery("#"+sqb_quiz_container_outer_id+ " #quiz_outcome_has").val();
			if(show_optin =="N" && num_of_outcomes < 1){
				jQuery('.close_Side_Popup').trigger('click');	
			}
		}, 3000);
} 
  
function calculator_last_child_calculation(sqb_quiz_container_outer_id,  parent_ques_div='' , notcount =''){
	 
	var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();	
	//time spent
	gettimer_spent(sqb_quiz_container_outer_id, notcount);
	if(notcount =="notcount"){		
	}else{
		// progressbar
		sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
	}
	//which outcome to show calculation here	
	 sqb_calculator_outcome_calculations(sqb_quiz_container_outer_id);
	
	
	 //replace merge tag in html 
	replaceOutcomeMergeTags(sqb_quiz_container_outer_id);
	if(notcount =="notcount"){		
	}else{
		var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
		if(show_optin == 'N'){
			show_loader_on_last_child(sqb_quiz_container_outer_id, parent_ques_div)
		}
	}
	//show_optin or not
	
		show_optin_form(sqb_quiz_container_outer_id) ;
	
	 
	 //calculate formula
	sqb_calculator_formula_calculation(sqb_quiz_container_outer_id);
	
	 // save report info
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ "  input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_current_page_id =jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='sqb_quiz_current_page_id']").val();
	if(notcount =="notcount"){		
	}else{
		sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_last_question_btn_click');	
	}
	var outcome_id = jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').attr('data-outcome-id');
	sqb_generate_share_variable_dynamic(sqb_quiz_container_outer_id,sqb_quiz_id,'calculator',outcome_id);
	setTimeout(function(){ 
			var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
			var num_of_outcomes = jQuery("#"+sqb_quiz_container_outer_id+ " #quiz_outcome_has").val();
			if(show_optin =="N" && num_of_outcomes < 1){
				jQuery('.close_Side_Popup').trigger('click');	
			}
		}, 3000);
}
  
function survey_last_child_calculation(sqb_quiz_container_outer_id,  parent_ques_div='' , notcount =''){
	var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();	
	//time spent
	gettimer_spent(sqb_quiz_container_outer_id, notcount);
	if(notcount =="notcount"){		
	}else{
		// progressbar
		sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
	}
	//which outcome to show calculation here	
	 sqb_survey_outcome_calculations(sqb_quiz_container_outer_id);
	
	
	 //replace merge tag in html 
	replaceOutcomeMergeTags(sqb_quiz_container_outer_id);
	if(notcount =="notcount"){		
	}else{
		var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
		if(show_optin == 'N'){
			show_loader_on_last_child(sqb_quiz_container_outer_id, parent_ques_div)
		}
	}
	//show_optin or not
	
		show_optin_form(sqb_quiz_container_outer_id) ;
	
	
	 
	 // save report info
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ "  input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_current_page_id =jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='sqb_quiz_current_page_id']").val();
	if(notcount =="notcount"){		
	}else{
		sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_last_question_btn_click');	
	}
	var outcome_id = jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').attr('data-outcome-id');
	sqb_generate_share_variable_dynamic(sqb_quiz_container_outer_id,sqb_quiz_id,'survey',outcome_id);
	setTimeout(function(){ 
			var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
			var num_of_outcomes = jQuery("#"+sqb_quiz_container_outer_id+ " #quiz_outcome_has").val();
			if(show_optin =="N" && num_of_outcomes < 1){
				jQuery('.close_Side_Popup').trigger('click');	
			}
		}, 3000);
}


function sqb_show_analyze_screen(sqb_quiz_container_outer_id){

	var show_analyzing_result = jQuery("#"+sqb_quiz_container_outer_id+ " #show_analyzing_result").val();
	if(show_analyzing_result =="Y"){
	
		var time_delay = jQuery('#'+sqb_quiz_container_outer_id+ ' .time-delay-hidden').val();						 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .analyzing_result_progress .progress').css('display','block');
		jQuery('#'+sqb_quiz_container_outer_id+ ' .analyzing-progress-bar').css('width','0');							
		jQuery('#'+sqb_quiz_container_outer_id+ ' .analyzing-progress-bar').css('height','100%');
		jQuery('#'+sqb_quiz_container_outer_id+ ' .analyzing-progress-bar').css('-webkit-animation','progress_width '+time_delay+'s linear forwards');
		jQuery('#'+sqb_quiz_container_outer_id+ ' .analyzing-progress-bar').css('animation','progress_width '+time_delay+'s linear forwards');
	}
		 
}
   
function sqb_personality_outcome_calculations(sqb_quiz_container_outer_id){
	var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
	//advanced rule	
	var outcomerule_id = jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val();	
	if(outcomerule_id >0){
		jQuery("#"+sqb_quiz_container_outer_id+ " .outcome_div").hide();	
		jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_id_"+outcomerule_id).show();	
		return outcomerule_id;
	} 
	
	var sqb_outcome_max_key = sqb_mode(outcome_ids_array, sqb_quiz_container_outer_id);  	 
	if(sqb_outcome_max_key > 0 ){
		jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_id_'+sqb_outcome_max_key).show();
	}else{
		jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').first().show();  
		var outcome_id_val = jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').first().attr("id"); 
		sqb_outcome_max_key = outcome_id_val.replace("outcome_id_",""); 		 
	}
	
	//function to go to the center of the visible div
	//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer', sqb_quiz_container_outer_id);
	return sqb_outcome_max_key;
}

function sqb_poll_outcome_calculations(sqb_quiz_container_outer_id){
	var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
	//advanced rule	
	var outcomerule_id = jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val();	
	if(outcomerule_id >0){
		jQuery("#"+sqb_quiz_container_outer_id+ " .outcome_div").hide();	
		jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_id_"+outcomerule_id).show();	
		return outcomerule_id;
	} 
	
	var sqb_outcome_max_key = sqb_mode(outcome_ids_array, sqb_quiz_container_outer_id);  	 
	if(sqb_outcome_max_key > 0 ){
		jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_id_'+sqb_outcome_max_key).show();
	}else{
		jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').first().show();  
		var outcome_id_val = jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').first().attr("id"); 
		sqb_outcome_max_key = outcome_id_val.replace("outcome_id_",""); 		 
	}
	
	//function to go to the center of the visible div
	//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer', sqb_quiz_container_outer_id);
	return sqb_outcome_max_key;
}

function sqb_survey_outcome_calculations(sqb_quiz_container_outer_id){ 
 	//advanced rule	
	var outcomerule_id = jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val();	
	if(outcomerule_id >0){
		jQuery("#"+sqb_quiz_container_outer_id+ " .outcome_div").hide();	
		jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_id_"+outcomerule_id).show();	
		return;
	} 
	var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
	//which outcome to show  	 
	 jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').first().show();  
	 //function to go to the center of the visible div
	//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer', sqb_quiz_container_outer_id);
}
function sqb_calculator_outcome_calculations(sqb_quiz_container_outer_id){ 
 	//advanced rule	
	var outcomerule_id = jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val();	
	if(outcomerule_id >0){
		jQuery("#"+sqb_quiz_container_outer_id+ " .outcome_div").hide();	
		jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_id_"+outcomerule_id).show();	
		return;
	} 
	var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
	//which outcome to show  	 
	 jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').first().show();  
	 //function to go to the center of the visible div
	//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer', sqb_quiz_container_outer_id);
}

//assessment outcome calculations
function sqb_assessment_outcome_calculations(sqb_quiz_container_outer_id, notcount=''){
	
	var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();	
	var correct_ans_count =	jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(); 	
	var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();
	var outcome_div_id= "";
	//advanced rule	
	var outcomerule_id = jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val();	
	if(outcomerule_id >0){
		jQuery("#"+sqb_quiz_container_outer_id+ " .outcome_div").hide();	
		jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_id_"+outcomerule_id).show();	
		return ;
	} 
	
	 if(outcome_type == "correct_ans"){					  
		 jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(){						  
				var data_points = jQuery(this).attr("data-point");	
				var outcome_id = jQuery(this).attr('id');	
				var max_outcome_obj ="#"+outcome_id; 	 		 
				 
				var min_outcome_point = jQuery('#'+sqb_quiz_container_outer_id+ ' #min_outcome_point').val();   
				var max_outcome_point = jQuery('#'+sqb_quiz_container_outer_id+ ' #max_outcome_point').val();
				 min_outcome_point = parseInt(min_outcome_point) ;		 
				max_outcome_point = parseInt(max_outcome_point) ;	
				data_points = parseInt(data_points) ;	
				correct_ans_count = parseInt(correct_ans_count) ;	
				if(data_points == correct_ans_count){	
					jQuery(this).show();	
					outcome_div_id= this;				 
				}else{						
					
					if (jQuery(this).attr('data-point') == max_outcome_point ) {
						if(sqb_points_ans > max_outcome_point){	
							jQuery(this).show();
							outcome_div_id= this;
						} 
					}
					if (jQuery(this).attr('data-point') == min_outcome_point ) {
						if(sqb_points_ans < min_outcome_point){	
							jQuery(this).show();
							outcome_div_id= this;
						} 
					}						 
				}				 
		});

		if(outcome_div_id == ''){
			var outcome_div_id = jQuery('#'+sqb_quiz_container_outer_id+' .outcome_div').first();
			jQuery(outcome_div_id).show();
		}
	  	
	 }else{
		var max_outcome_obj  = 'not_show_outcome';
		var sqb_correct_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();
		var min_outcome_point = jQuery('#'+sqb_quiz_container_outer_id+ ' #min_outcome_point').val();  
		var max_outcome_point = jQuery('#'+sqb_quiz_container_outer_id+ ' #max_outcome_point').val(); 
		
		jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(){						  
			var data_point_min = jQuery(this).attr("data-point-min");	//1	 //correct_ans_count =1				 
			var data_point_max = jQuery(this).attr("data-point-max");	//2	
			var data_points = jQuery(this).attr("data-point");	
			data_point_min = parseInt(data_point_min) ;		 
			data_point_max = parseInt(data_point_max) ;		 
			data_points = parseInt(data_points) ;		 
			sqb_correct_ans = parseInt(sqb_correct_ans) ;				 			 
			if(data_point_min <= sqb_correct_ans){					 							
				if(data_point_max >= sqb_correct_ans){								
					max_outcome_obj = this;				 						 
				}			 
			}
		});
 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').hide();
		if(max_outcome_obj != 'not_show_outcome'){	
			jQuery(max_outcome_obj).show();				 					
		}else{
			jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(){						  
				var data_point_min = jQuery(this).attr("data-point-min");	//1	  
				var data_point_max = jQuery(this).attr("data-point-max");	//2	
				if (data_point_min == min_outcome_point ) {
					max_outcome_obj = this;	
				}else if (data_point_max == max_outcome_point ) {
					max_outcome_obj = this;	
				}else if (sqb_correct_ans > max_outcome_point){
					max_outcome_obj = this;	
				}else if (sqb_correct_ans < min_outcome_point){
					max_outcome_obj = this;	
				}
			});
			jQuery(max_outcome_obj).show();		
		}
	} //else end  

	

	var outcome_names = jQuery(max_outcome_obj).find('#outcome_name').val();
	if(outcome_names == undefined){
		var outcome_name = '';
	}else{
		var outcome_name = outcome_names;
	}
	var optin_position = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_opt_screen_position').val();
	var fname = jQuery('.quiz_optin_template_outer #first_name').val();
	if(optin_position == 'optin-after-questions-screen'){
		if (jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").length  > 0) {
			jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").html(jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").html().replace('%%OUTCOME_TITLE%%', outcome_name));
		}	 

		if(fname != ''){
			jQuery('.quiz_optin_template_outer #first_name').val(fname);
		}
	}	
	// display ques-ans in result page				 
	if(display_correctans_options == "both" || display_correctans_options == "result_page"){					
		sqb_show_ques_ans_in_resultpage(sqb_quiz_container_outer_id);
	} 
	// save report info
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_current_page_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='sqb_quiz_current_page_id']").val();
	if(notcount =="notcount"){		
	}else{
		sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_last_question_btn_click');
	}


	
}

//scoring outcome calculations
function sqb_scoring_outcome_calculations(sqb_quiz_container_outer_id, notcount=''){
	var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();	
	var correct_ans_count =	jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(); 	
	var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
	var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
	var total_pt = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(); 	
	var outcome_div_id= "";
 	//advanced rule	
	var outcomerule_id = jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val(); 
	if(outcomerule_id >0){
		jQuery("#"+sqb_quiz_container_outer_id+ " .outcome_div").hide();	
		jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_id_"+outcomerule_id).show();	
		return;
	} 
	
	//which outcome to show calculation here		
	 if(outcome_type == "correct_ans"){			
		   var get_outcome = false;
			jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(){						  
				var data_points = jQuery(this).attr("data-point");	
				var outcome_id = jQuery(this).attr('id');	
				var max_outcome_obj ="#"+outcome_id; 
				var min_outcome_point = jQuery('#'+sqb_quiz_container_outer_id+ ' #min_outcome_point').val();   
				var max_outcome_point = jQuery('#'+sqb_quiz_container_outer_id+ ' #max_outcome_point').val();
				min_outcome_point = parseInt(min_outcome_point) ;		 
				max_outcome_point = parseInt(max_outcome_point) ;		 
				data_points = parseInt(data_points) ;		 
				sqb_points_ans = parseInt(sqb_points_ans) ;		 
			  				 			 
				if(data_points == sqb_points_ans){	
					jQuery(this).show();	
					get_outcome = true;
					if(get_outcome){
						return false;
					}				 
				}else{						

					if (jQuery(this).attr('data-point') == max_outcome_point ) {
						if(sqb_points_ans > max_outcome_point){	
							jQuery(this).show();
						} 
					}
					if (jQuery(this).attr('data-point') == min_outcome_point ) {
						if(sqb_points_ans < min_outcome_point){	
							jQuery(this).show();
						} 
					}						 
				}
				 
			});

			 	
		}else{
			var max_outcome_obj  = 'not_show_outcome';
			var max_outcome_point = jQuery('#'+sqb_quiz_container_outer_id+ ' #max_outcome_point').val();  	
			var min_outcome_point = jQuery('#'+sqb_quiz_container_outer_id+ ' #min_outcome_point').val(); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(){						  
				var data_point_min = jQuery(this).attr("data-point-min");	//1	 
				var data_point_max = jQuery(this).attr("data-point-max");	//2	
				 var data_points = jQuery(this).attr("data-point");	
				 
				 data_point_min = parseInt(data_point_min);
				 data_point_max = parseInt(data_point_max);
				 sqb_points_ans = parseInt(sqb_points_ans);
				 data_points = parseInt(data_points);
				 	 			 
				if(data_point_min <= sqb_points_ans   ){					 							
					if(data_point_max >= sqb_points_ans){								
						max_outcome_obj = this;								
					} 
				} 
	 	
			});
			 
			     
			if(max_outcome_obj != 'not_show_outcome'){
				jQuery(max_outcome_obj).show();				 						
			}else{
				var outcome_found = false;
				jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(i){					  
					var data_point_min = jQuery(this).attr("data-point-min");	//1	 
					var data_point_max = jQuery(this).attr("data-point-max");	//2	
					
					if(sqb_points_ans > 0){
						if (data_point_min == min_outcome_point ) {
							max_outcome_obj = this;
							outcome_found = true;	
						}else if (data_point_max == max_outcome_point){
							max_outcome_obj = this;	
							outcome_found = true;
						}else if (sqb_points_ans > max_outcome_point){
							max_outcome_obj = this;	
							outcome_found = true;
						}else if (sqb_points_ans < min_outcome_point){
							max_outcome_obj = this;	
							outcome_found = true;
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
							max_outcome_obj = this;	
							outcome_found = true;
						}
					}					
				});
				
				if(!outcome_found){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(i){	
						if(i == 0){
							max_outcome_obj = this;	
						}
					});
				}
				jQuery(max_outcome_obj).show();	
							
			}
		} 
		
		var outcome_names = jQuery(max_outcome_obj).find('#outcome_name').val();
		if(outcome_names == undefined){
			var outcome_name = '';
		}else{
			var outcome_name = outcome_names;
		}
		var optin_position = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_opt_screen_position').val();
		var fname = jQuery('.quiz_optin_template_outer #first_name').val();
		if(optin_position == 'optin-after-questions-screen'){
			if (jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").length  > 0) {
				jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").html(jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").html().replace('%%OUTCOME_TITLE%%', outcome_name));
				if(fname != ''){
					jQuery('.quiz_optin_template_outer #first_name').val(fname);
				}
			}
		}
		var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
		var total_pt = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(); 
		if(optin_position == 'optin-after-questions-screen'){
			if (jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").length  > 0) {
				jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").html(jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").html().replace('%%TOTALSCORE%%', '<div class="sqb_total_points">'+total_pt+'</div>'));

				jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").html(jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").html().replace('%%YOURSCORE%%', '<div class="sqb_total_points">'+sqb_points_ans+'</div>'));
				if(fname != ''){
					jQuery('.quiz_optin_template_outer #first_name').val(fname);
				}
			}
		}
	// display ques-ans in result page				 
	if(display_correctans_options == "both" || display_correctans_options == "result_page"){					
		sqb_show_ques_ans_in_resultpage(sqb_quiz_container_outer_id);
	} 
	// save report info
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_current_page_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='sqb_quiz_current_page_id']").val();
	if(notcount =="notcount"){		
	}else{
		sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_last_question_btn_click');
	}
}

function sqb_find_next_question_for_funnel_rename(sqb_quiz_container_outer_id){
	jQuery(document).on('click','#'+sqb_quiz_container_outer_id+ ' .enable_branching_quiz  .question_add_answer_outer_div .sqb_ans_item_outer, .enable_branching_quiz.quiz_type_survey .single_next_btn_container .single_next_btn,  #'+sqb_quiz_container_outer_id+ ' .enable_branching_quiz.quiz_type_survey .multi_next_btn_container .checkbox-custom-style .sqb_and_field  ',function(){		
		
		if(jQuery(this).find('.sqb_textarea_ans_field').length > 0 ){
			return false;
		}
		  
		if(jQuery(this).find('.sqb_fill_in_blank_ans_field').length > 0 ){
			return false;
		}
		
		
		 
		if(jQuery(this).hasClass('single_next_btn')){
			 
			var data_answer_id =  jQuery(this).closest('.question_container').find('.sqb_ans_item_outer').attr('data-answer-id');
			var data_question_id =  jQuery(this).closest('.question_container').find('.sqb_ans_item_outer').attr('data-question-id');
			
		}else if(jQuery(this).hasClass('sqb_next_btn')){
			var data_answer_id =  jQuery(this).closest('.question_container').find('.sqb_ans_item_outer').attr('data-answer-id');
			var data_question_id =  jQuery(this).closest('.question_container').find('.sqb_ans_item_outer').attr('data-question-id');
			 
		}else{
			 
			var data_answer_id =  jQuery(this).attr('data-answer-id');
			var data_question_id =  jQuery(this).attr('data-question-id');
		}
				 
		var sqb_funnel_json = sqb_funnel_ques_ans_connection_json;
		if(data_question_id in sqb_funnel_json){			
			
			// check next has or not
			if(sqb_funnel_json[data_question_id]['next_question'] == undefined || sqb_funnel_json[data_question_id]['next_question'][data_answer_id] == undefined){				
				  jQuery('.quiz_quesans_template_outer').hide();
				  //show_optin or not
					//show_optin_form() ;
					
				  var sqb_quiz_type = jQuery('#sqb_quiz_type').val();	

				  if(sqb_quiz_type == "personality"){
								 
						personality_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div ) ;	

				  }else  if(sqb_quiz_type == "assessment"){

					  assessment_last_child_calculation(sqb_quiz_container_outer_id, "question_id_"+data_question_id);
					  
				  }else  if(sqb_quiz_type == "scoring"){
					  
					  scoring_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div ) ;
				   } else if(sqb_quiz_type == "survey"){
					  
					  survey_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div ) ;
					} 
				  
			}else{				
					var next_question_id = sqb_funnel_json[data_question_id]['next_question'][data_answer_id];
					var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id');					
					var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
					if(quiz_slider_animation =="Y")	{		
						 setTimeout(function() {
							 jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
							 jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');	
							 jQuery("#"+sqb_quiz_container_outer_id+ " .enable_branching_quiz .question_container").removeClass('show_cls').addClass('hide_cls');
							jQuery("#"+sqb_quiz_container_outer_id+ " .enable_branching_quiz .question_container#question_id_"+next_question_id).addClass('show_cls').removeClass('hide_cls');
							
						}, 500); 
					}else{
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
						jQuery("#"+sqb_quiz_container_outer_id+ " .enable_branching_quiz .question_container").removeClass('show_cls').addClass('hide_cls');
						jQuery("#"+sqb_quiz_container_outer_id+ " .enable_branching_quiz .question_container#question_id_"+next_question_id).addClass('show_cls').removeClass('hide_cls');
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
					}
			}			
		}else {
			 
		}
		
	});
}

function sqb_show_continue_button(sqb_quiz_container_outer_id,elemt){
	var select_temp = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val();
	if(select_temp == 'template7'){
	jQuery(elemt).closest('.question_container').find('.skip-question-action').hide();
	jQuery(elemt).closest('.question_container').find('.continue-question-action').show();
	}
}

  // for personality type quiz
function sqb_quiz_outcome_create(){	
	 
	var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
	var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
	
	if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
		sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
	}
	jQuery(document).on('click','.question_add_answer_outer_div .sqb_ans_item_outer',function(){
		  
			var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
			var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
			
			if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
				sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
			}
			
			if(jQuery(this).hasClass('dropdown_cls')){
				var dropdown_value = jQuery(this).find('.sqb_question_dropdown').val();
				if(dropdown_value != ''){
					jQuery(this).addClass('sqb_ans_selected');
				} else {
					jQuery(this).removeClass('sqb_ans_selected');
				}
			} else if(!jQuery(this).hasClass('matrix_cls')){
				jQuery(this).addClass('sqb_ans_selected');
				sqb_show_continue_button(sqb_quiz_container_outer_id,jQuery(this));
			} 
		
			if(jQuery(this).hasClass('dropdown_cls')){
				
			} else if(!jQuery(this).hasClass('matrix_cls')){
				
				jQuery(this).closest('.question_container').find('.sqb_ans_item_outer').removeClass('sqb_ans_selected');
				if(jQuery(this).hasClass("sqb_ans_selected") == true){
					jQuery(this).find(".sqb_and_field.checkbox_fe").prop("checked" , true); 			
				}else{
					jQuery(this).find(".sqb_and_field.checkbox_fe").prop("checked" , false);			
				}
			
				jQuery('.sqb_and_field.checkbox_fe').each(function(){		
					if(jQuery(this).prop("checked") == true){
						 jQuery(this).closest('.sqb_ans_item_outer').addClass('sqb_ans_selected');  			 
					}else{
						jQuery(this).closest('.sqb_ans_item_outer').removeClass('sqb_ans_selected');  			 
					}	
				});
				
				jQuery(this).closest('.question_container').find('.sqb_ans_item_outer').removeClass('sqb_ans_selected');
				jQuery(this).addClass('sqb_ans_selected');
			
				if(jQuery(this).hasClass("sqb_ans_selected") == true){
					jQuery(this).find(".sqb_and_field.checkbox_fe").prop("checked" , true); 			
				}else{
					jQuery(this).find(".sqb_and_field.checkbox_fe").prop("checked" , false);			
				}

				jQuery('.sqb_and_field.checkbox_fe').each(function(){		
					if(jQuery(this).prop("checked") == true){
						 jQuery(this).closest('.sqb_ans_item_outer').addClass('sqb_ans_selected');  			 
					}else{
						jQuery(this).closest('.sqb_ans_item_outer').removeClass('sqb_ans_selected');  			 
					}	
				});
			}
			
			var input_checked = jQuery(this).find("input.sqb_and_field").prop("checked");
			  
			var question_skipid =  jQuery(this).closest(".question_container").find('.skip_mapping_cls').val();	 
			  
			var parent_hasClass =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');	 
			var data_outcome_ids = jQuery(this).attr('data-outcome-ids');
			 
			if(question_skipid !="Y"){
				if (typeof data_outcome_ids !== typeof undefined && data_outcome_ids !== false) {
					var data_outcome_ids = jQuery(this).attr('data-outcome-ids').split(",");			
					var data_outcome_point = parseInt(jQuery(this).attr('data-point'));			
					jQuery(data_outcome_ids).each(function(index,element){
						//if multiple checkbox
						 if(parent_hasClass == true){ 					 
							if(input_checked == true){						 
								outcome_ids_array.push(element);
								
								if(element in outcome_ids_points_array){
									outcome_ids_points_array[element] = outcome_ids_points_array[element] + data_outcome_point;
								}else{
									outcome_ids_points_array[element] = data_outcome_point;
								}
								
								
							}else{
								var index_outcome = outcome_ids_array.indexOf(element);						 
								if (index_outcome !== -1){							 
									outcome_ids_array.splice(index_outcome, 1);  
								} 
								
								var index_outcome_point = outcome_ids_points_array.indexOf(element);						 
								if (index_outcome_point !== -1){							 
									outcome_ids_points_array.splice(index_outcome_point, 1);  
								} 
							}
										   
						}else{
							outcome_ids_array.push(element);
							if(element in outcome_ids_points_array){
									outcome_ids_points_array[element] = outcome_ids_points_array[element] + data_outcome_point;
							}else{
								outcome_ids_points_array[element] = data_outcome_point;
							}
						}			   
						
					});
					 
				}
				 
			}		
		  
	});	 
	 
	jQuery(document).on('click','.question_add_answer_outer_div .sqb_ans_item_outer .checkbox_fe',function(){
		
		
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		
		if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}
		jQuery(this).closest('.sqb_ans_item_outer').removeClass('sqb_ans_selected');
		jQuery(this).addClass('sqb_ans_selected');
		var input_checked = jQuery(this).prop("checked");
		 
		var parent_hasClass =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');	 
		var data_outcome_ids = jQuery(this).attr('data-outcome-ids');
		if (typeof data_outcome_ids !== typeof undefined && data_outcome_ids !== false) {
			var data_outcome_ids = jQuery(this).attr('data-outcome-ids').split(",");
			var data_outcome_point = parseInt(jQuery(this).closest('.question_container').find('.sqb_ans_item_outer').attr('data-point'));					
			jQuery(data_outcome_ids).each(function(index,element){
				//if multiple checkbox
				 if(parent_hasClass == true){ 					 
						if(input_checked == true){						 
								outcome_ids_array.push(element);
								
								if(element in outcome_ids_points_array){
									outcome_ids_points_array[element] = outcome_ids_points_array[element] + data_outcome_point;
								}else{
									outcome_ids_points_array[element] = data_outcome_point;
								}
								
								
							}else{
								var index_outcome = outcome_ids_array.indexOf(element);						 
								if (index_outcome !== -1){							 
									outcome_ids_array.splice(index_outcome, 1);  
								} 
								
								var index_outcome_point = outcome_ids_points_array.indexOf(element);						 
								if (index_outcome_point !== -1){							 
									outcome_ids_points_array.splice(index_outcome_point, 1);  
								} 
							}
								   
				}else{
					outcome_ids_array.push(element);
				}			   
				
			});
			 
		}
	});	
	
	 
	 
}
      
 
//get the outcome for personality
function sqb_mode(sqbarray,sqb_quiz_container_outer_id){	 
	
	  if(sqbarray.length == 0){
		  var outcome_id = jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').attr('data-outcome-id');
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
	 	
	 	var max_outcome_points = 0;
	 	
	 	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
			var clone_outcome_id = jQuery(this).attr('data-outcome-id');
			var clone_outcome_html = jQuery(this).html();
			sqb_outcome_content_clone[clone_outcome_id] = clone_outcome_html;
			
		});
	 	
	 	if((jQuery('#'+sqb_quiz_container_outer_id).find('input[name="weighted_score"]').length != 0) && (jQuery('#'+sqb_quiz_container_outer_id).find('input[name="weighted_score"]').val() == "Y")){
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
		
		sqb_replace_outcome_rank_data(sqbarray,sqb_quiz_container_outer_id, max_outcome_points,maxEl);
		return maxEl;
 
}
//get all the outcome occurance
function sqb_replace_outcome_rank_data(sqbarray,sqb_quiz_container_outer_id, max_outcome_points = 0,maxEl = ''){
	
	var outcome_ids_array = sqbarray;
	var sqb_rank_outcome_array_with_points = {};
	var sqb_outcome_index = '';
	for (sqb_outcome_index = 0; sqb_outcome_index < outcome_ids_array.length; sqb_outcome_index++) {
		var rank_outcome_id = outcome_ids_array[sqb_outcome_index];
		var outcome_points_default = 1;
		 if((jQuery('#'+sqb_quiz_container_outer_id).find('input[name="weighted_score"]').length != 0) && (jQuery('#'+sqb_quiz_container_outer_id).find('input[name="weighted_score"]').val() == "Y") && outcome_ids_points_array.length != 0 ){
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
	
	 
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div#outcome_id_'+maxEl).each(function(){
		var all_outcome_list_array = {};
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
			
			all_outcome_list_array[parseInt(jQuery(this).find('input[name="outcome_id"]').val())] = jQuery(this).find('#outcome_name').val();
		});
		 
		var all_outcome_list_array_clone = all_outcome_list_array;
		 var sqb_rank_outcome_array_with_points_array_new = [];
		for (var k = 0; k < jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').length; k++) {
			var outcome_points = '';
			var outcome_name = '';
			var kk = k+1;
			 
		   if(sqb_rank_outcome_array_with_points_array[k]){
	
			  var outcome_id = sqb_rank_outcome_array_with_points_array[k][0];
			  delete all_outcome_list_array_clone[outcome_id];
			  outcome_points = sqb_rank_outcome_array_with_points_array[k][1];
			   outcome_name = jQuery('#outcome_id_'+outcome_id).find('#outcome_name').val();
			  
			   if((jQuery('#'+sqb_quiz_container_outer_id).find('input[name="weighted_score"]').length != 0) && (jQuery('#'+sqb_quiz_container_outer_id).find('input[name="weighted_score"]').val() == "Y") && outcome_ids_points_array.length != 0 ){
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
		 
			  
	  for (var j = 0; j < jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').length; j++) {
			var outcome_points = '';
			var outcome_name = '';
			var jj = j+1;
			 
		   if(sqb_rank_outcome_array_with_points_array_new[j]){
	
			  var outcome_id = sqb_rank_outcome_array_with_points_array_new[j][0];
			  delete all_outcome_list_array_clone[outcome_id];
			  outcome_points = sqb_rank_outcome_array_with_points_array_new[j][1];
			   outcome_name = jQuery('#outcome_id_'+outcome_id).find('#outcome_name').val();
			   
		  }else{	  
			    
				var sqb_keys = Object.keys(all_outcome_list_array_clone);
				if(sqb_keys != ''){					
					var sqb_random_key = sqb_keys[Math.floor(Math.random() * sqb_keys.length)];
					
					outcome_name = all_outcome_list_array_clone[sqb_random_key];
					outcome_points = 0;
					delete all_outcome_list_array_clone[sqb_random_key];
				}
							
		  }			  
		  	  
		  jQuery(this).html(jQuery(this).html().replaceAll('[WEIGHTED_SCORE]', max_outcome_points));
		  jQuery(this).html(jQuery(this).html().replaceAll('[RANK'+jj+'_OUTCOME_TITLE]', '<div class="outcome_name_dt">'+outcome_name+'</div>'));
		  jQuery(this).html(jQuery(this).html().replaceAll('[RANK'+jj+'_SCORE]', '<div class="outcome_score_dt">'+outcome_points+'</div>'));
		  
		  var rank_html = jQuery(this).html();
		  jQuery.each(sqb_rank_outcome_array_with_points_array, function(index, value){

			var ot_id = value[0];
			var id = index+1;
			
			if(rank_outcome[ot_id] != undefined && rank_outcome[ot_id] != ''){
				var outcome_title = jQuery('#outcome_id_'+ot_id).find('#outcome_name').val();
				var content = rank_outcome[ot_id]['description'];
				rank_html = rank_html.replaceAll('[ShowOutcomeDesc Rank="'+id+'"]', '<div class="sod-inner">'+content+'</div>');
				rank_html = rank_html.replaceAll('[ShowOutcomeTitle Rank="'+id+'"]', '<div class="sot-inner">'+outcome_title+'</div>');
			}

		  });
		  jQuery(this).html(rank_html);
	  }

	});

	if(jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_data_description').length > 0){
		jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_data_description').each(function(){
			if(jQuery(this).find('.sod-inner').length < 1){
				jQuery(this).html('');
			}
			
		});
	}

	if(jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_data_title').length > 0){
		jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_data_title').each(function(){
			if(jQuery(this).find('.sot-inner').length < 1){
				jQuery(this).html('');
			}
			
		});
	}

	//jQuery(this).find('.outcome_data_description').html();
}

//show question-answer in result page
function sqb_show_ques_ans_in_resultpage(sqb_quiz_container_outer_id){	
	jQuery('.ans_in_resultpage_outer').remove(); 
	var ques_ans_html="";	
	var i =1; 	
	jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){
		if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
			if( jQuery(this).find('.sqb_ans_selected').length == 0){	
				 return true;  
			}
		}
		
		var question_wrapper_id = jQuery(this).attr('id');	
	
		var question_title = jQuery(this).find(".question_title").text();	
		var sqb_correct_ans_text = jQuery(this).find(".correct_ans_cls .sql_ans_text").text();						 
		var sqb_selected_ans_text = jQuery(this).find(".sqb_ans_selected .sql_ans_text").text();						 
		var sqb_ans_correct_cls = jQuery(this).find(".sqb_ans_item_outer").hasClass("correct_ans_cls");						 
		var sqb_ans_selected_cls = jQuery(this).find(".sqb_ans_item_outer.correct_ans_cls").hasClass("sqb_ans_selected");
		var text_cls = jQuery(this).find(".sqb_ans_item_outer").hasClass("text_cls");
		var date_cls = jQuery(this).find(".sqb_ans_item_outer").hasClass("date_cls");
		var phone_number_text_cls = jQuery(this).find(".sqb_ans_item_outer").hasClass("phone_number_text_cls");
		var email_cls = jQuery(this).find(".sqb_ans_item_outer").hasClass("email_cls");
		var slider_cls = jQuery(this).find(".sqb_ans_item_outer").hasClass("slider_cls");
		var numeric_text_cls  = jQuery(this).find(".sqb_ans_item_outer").hasClass("numeric_text_cls");
		var matching_text_cls  = jQuery(this).find(".sqb_ans_item_outer").hasClass("matching_text");
		var fill_in_blank_cls = jQuery(this).find(".sqb_ans_item_outer").hasClass("fill_in_blank_cls");
		var file_upload_cls = jQuery(this).find(".sqb_ans_item_outer").hasClass("file_upload_cls");
		var matrix_cls = jQuery(this).find(".sqb_ans_item_outer").hasClass("matrix_cls");
		var incorrect_answer_msg_exp = jQuery(this).find(".incorrect_answer_msg").val();
		var common_incorrect_answer_msg_exp = jQuery("#common_incorrect_msg").val();		 
		if(incorrect_answer_msg_exp ==""){
			incorrect_answer_msg_exp = common_incorrect_answer_msg_exp;
		}

		var correct_answer_msg_exp = jQuery(this).find(".correct_answer_msg").val();
		var common_correct_answer_msg_exp = jQuery("#common_correct_msg").val();		 
		if(correct_answer_msg_exp ==""){
			correct_answer_msg_exp = common_correct_answer_msg_exp;
		}
		var outcome_screen_answer = jQuery('#sqb_outcome_screen_answer_field').val();
		var outcome_screen_result = jQuery('#sqb_outcome_screen_result_field').val();
		var outcome_screen_correct_answer = jQuery('#sqb_outcome_screen_correct_answer_field').val();
		var outcome_screen_incorrect_answer = jQuery('#sqb_outcome_screen_incorrect_answer_field').val();
	 
		if(text_cls ==true){				
			var sqb_correct_ans_text = jQuery(this).find(".sqb_input_ans_field").val();	 			
			var correct_ans_div  = ' '; 
			var addnewclass  = ' freetext_div '; 
		}else if(date_cls ==true){				
			var sqb_correct_ans_text = jQuery(this).find(".sqb_input_ans_field").val();	 			
			var correct_ans_div  = ' '; 
			var addnewclass  = ' freetext_div '; 
		}else if(phone_number_text_cls ==true){				
			var sqb_correct_ans_text = jQuery(this).find(".sqb_input_ans_field").val();	 			
			var correct_ans_div  = ' '; 
			var addnewclass  = ' freetext_div '; 
		}else if(email_cls ==true){				
			var sqb_correct_ans_text = jQuery(this).find(".sqb_input_ans_field").val();	 			
			var correct_ans_div  = ' '; 
			var addnewclass  = ' freetext_div '; 
		}else if(slider_cls ==true){				
			var sqb_correct_ans_text = jQuery(this).find('.sqb_ans_slider').attr("data-value"); 			
			// var sqb_correct_ans_text = jQuery(this).find(".sqb_input_ans_field").val();	 			
			var correct_ans_div  = ' '; 
			var addnewclass  = ' freetext_div '; 
		}else if(numeric_text_cls ==true){
			var sqb_correct_ans_text = jQuery(this).find('.sqb_and_field').val(); 			 			
			var correct_ans_div  = ' '; 
			var addnewclass  = ' '; 
			var correct_ans_div  = '<div class="result_text"><b>'+outcome_screen_result+' </b>Correct Answer</div><div class="incorrect_answer_exp_cls answer_cls"><b>'+outcome_screen_correct_answer+'</b><div clas="ans_text">'+correct_answer_msg_exp+'</div></div>';
		}else if(matching_text_cls ==true){

			var mhtml = jQuery(this).find(".sqb_input_ans_field").html();
			var div = document.createElement("div");
			div.innerHTML = mhtml;
			var mtext = div.textContent || div.innerText || "";
			var sqb_correct_ans_text = mtext; 			 			
			var correct_ans_div  = ' '; 
			var addnewclass  = ' '; 
			var correct_ans_div  = '<div class="result_text"><b>'+outcome_screen_result+' </b>Correct Answer</div><div class="incorrect_answer_exp_cls answer_cls"><b>'+outcome_screen_correct_answer+'</b><div clas="ans_text">'+correct_answer_msg_exp+'</div></div>';
		}else if(fill_in_blank_cls ==true){
			var sqb_correct_ans_text = jQuery(this).find(".sqb_input_ans_field").val();		
			var correct_ans_div  = ' ';	
			var addnewclass  = ' freetext_div '; 
		}else if(matrix_cls == true){
			var sqb_correct_ans_text = '';
			/*var i = 0;			 
			jQuery(this).find(".matrix_cls .sql_ans_text ").each(function(){
				sqb_correct_ans_text += jQuery(this).text();	


			});*/	


			/*var test = {};

			jQuery(this).find(".matrix_cls").each(function(){
				test['title'] = jQuery(this).find('.sql_ans_text').text();
				jQuery(this).find('.checkbox_fe').each(function(){
					if(jQuery(this).prop('checked') == true){	
						test['id'] = jQuery(this).val();
						var count_val = parseInt(test['id'])+1;
						test['label'] = jQuery('.SQB-main-table tr th:eq('+count_val+')').find(".matrix_label_text").text();
					}
				});
			console.log(test);
			});*/


			sqb_correct_ans_text += '<br>';
			jQuery(this).find(".matrix_cls").each(function(){
				var title= jQuery(this).find('.sql_ans_text').text();
				sqb_correct_ans_text += '<div class="matrix-label">'+title;
				jQuery(this).find('.checkbox_fe').each(function(){
					if(jQuery(this).prop('checked') == true){	
						var count = jQuery(this).val();
						var count_val = parseInt(count)+1;
						var label = jQuery('.SQB-main-table tr th:eq('+count_val+')').find(".matrix_label_text").text();

						sqb_correct_ans_text += ': '+label+'</div>';
					}
				});
			});
 
			//sqb_correct_ans_text = sqb_correct_ans_text.slice(0, -2);	
			var correct_ans_div  = ' ';	
			var addnewclass  = ' freetext_div '; 
		}else if(file_upload_cls ==true){
			var sqb_item =jQuery(this).find(".sqb_file_upload").val();
			var sqb_correct_ans_text ='';			
			if(sqb_item !=""){				 
				var  last_item = sqb_item.split("\\").pop();
				if(typeof sqb_correct_ans_text !="undefined"){
					sqb_correct_ans_text = last_item;
				}	
			} 	
			var correct_ans_div  = ' ';	
			var addnewclass  = ' freetext_div '; 
			  
		}else{
			var sqb_correct_ans_text = jQuery(this).find(".correct_ans_cls .sql_ans_text").text();	
			var correct_ans_div  = '<div class="result_text"><b>'+outcome_screen_result+' </b>Correct Answer</div><div class="incorrect_answer_exp_cls answer_cls"><b>'+outcome_screen_correct_answer+'</b><div clas="ans_text">'+correct_answer_msg_exp+'</div></div>';
			var addnewclass  = ' '; 
		}
		 
		var has_multiple_cls =  jQuery(this).hasClass('multiple_correct_cls');
		
	  
		 //for multiple answer			
		if(has_multiple_cls == true){
			 
			var hascorrect_count = jQuery(this).find(".sqb_ans_item_outer.correct_ans_cls").length;
			var hascorrect_checkbox_count = jQuery(this).find(".sqb_ans_item_outer.correct_ans_cls .checkbox_fe:checked").length;
			var total_checked = jQuery(this).find(" .sqb_ans_item_outer .checkbox_fe:checked").length;
								 
			if(hascorrect_count == hascorrect_checkbox_count && total_checked == hascorrect_checkbox_count){	
				 //correct answer	
				var ansid_text = [];	
				var sqb_selected_ans_text ="";
				var sqb_correct_ans_text ="";	
				var sqb_loop_v_i = 1;			
				jQuery("#"+sqb_quiz_container_outer_id+" #"+question_wrapper_id+"  .sqb_ans_item_outer .checkbox_fe:checked ").each(function(){
					ansid_text.push(sqb_loop_v_i+') '+jQuery(this).closest(".multiple_correct_checkbox").find(".sql_ans_text").text());	
					 sqb_loop_v_i++;						 
				});
				var sqb_correct_ans_text  =  ansid_text.join(", <br>");				
				ques_ans_html += '<div class="ans_in_resultpage correct_ans_div' +addnewclass+'"> <div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+' </b><div class="ans_text">'+sqb_correct_ans_text+'</div></div>'+correct_ans_div+'</div>';				
				 
				
			}else{
				 //incorrect answer	
				 if( jQuery(this).find('.sqb_ans_selected').length == 0){
					 
					 ques_ans_html += '<div class="ans_in_resultpage incorrect_ans_div' +addnewclass+'"><div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+' </b><div class="ans_text">Skipped</div> </div></div>';  
					 
				 }else{
					var sqb_selected_ans_text ="";
					var sqb_correct_ans_text =""; 
					var ansid_text = [];
					var ansid_correcttext = [];
					var sqb_loop_v_i = 1;
					jQuery("#"+sqb_quiz_container_outer_id +" #"+question_wrapper_id+ " .sqb_ans_item_outer.correct_ans_cls").each(function(){						 						  
						 ansid_correcttext.push(sqb_loop_v_i+') '+jQuery(this).find(".sql_ans_text").text());	 
						 sqb_loop_v_i++;					 
					});
					var sqb_loop_v_i = 1;
					jQuery("#"+sqb_quiz_container_outer_id+" #"+question_wrapper_id+ " .sqb_ans_item_outer .checkbox_fe:checked ").each(function(){					 		  
						ansid_text.push(sqb_loop_v_i+') '+jQuery(this).closest(".multiple_correct_checkbox").find(".sql_ans_text").text());
						 sqb_loop_v_i++;						 
					});
					var sqb_correct_ans_text  =  ansid_correcttext.join(", <br>");	
					
					var   sqb_selected_ans_text=  ansid_text.join(", <br>");	
					ques_ans_html += '<div class="ans_in_resultpage incorrect_ans_div"><div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+' </b><div class="ans_text">'+sqb_selected_ans_text+'</div><div class="answer_cls"><b>'+outcome_screen_correct_answer+'</b><div clas="ans_text">'+sqb_correct_ans_text+'</div></div><div class="result_text"><b>'+outcome_screen_result+' </b>Incorrect Answer</div></div> <div class="incorrect_answer_exp_cls answer_cls"><b>'+outcome_screen_incorrect_answer+'</b><div clas="ans_text">'+incorrect_answer_msg_exp+'</div></div></div>';   
									 
				}
			}			
			
		}else{		
		 
			if(numeric_text_cls ==true){
				var data_correct_value = jQuery(this).find(".sqb_ans_item_outer.sqb_ans_selected").attr("data-correct-value");
				var input_text_num = jQuery(this).find(".sqb_ans_item_outer .sqb_and_field").val();
				if(input_text_num == data_correct_value){
					ques_ans_html += '<div class="ans_in_resultpage correct_ans_div' +addnewclass+'"> <div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+' </b><div class="ans_text">'+sqb_correct_ans_text+'</div></div>'+correct_ans_div+'</div>';
				}else{
					if( jQuery(this).find('.sqb_ans_selected').length == 0){
						ques_ans_html += '<div class="ans_in_resultpage incorrect_ans_div' +addnewclass+'"><div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+'</b><div class="ans_text">Skipped</div> </div></div>'; 
					}else{	
						ques_ans_html += '<div class="ans_in_resultpage incorrect_ans_div"><div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+' </b><div class="ans_text">'+sqb_correct_ans_text+'</div><div class="answer_cls"><b>'+outcome_screen_correct_answer+' </b><div clas="ans_text">'+data_correct_value+'</div></div><div class="result_text"><b>'+outcome_screen_result+' </b>Incorrect Answer</div></div> <div class="incorrect_answer_exp_cls answer_cls"><b>'+outcome_screen_incorrect_answer+'</b><div clas="ans_text">'+incorrect_answer_msg_exp+'</div></div></div>';  
					}
				}
			}else if(matching_text_cls == true){

				var data_correct_value = jQuery(this).find(".sqb_ans_item_outer.sqb_ans_selected").attr("data-correct-value");
				var input_text_num = jQuery(this).find(".sqb_ans_item_outer .sqb_and_field").val();

				var invalid =  jQuery(this).find(".sqb_ans_item_outer .sqb_and_field .sentence-not-matched").length;

				if(invalid < 1){
					ques_ans_html += '<div class="ans_in_resultpage correct_ans_div' +addnewclass+'"> <div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+' </b><div class="ans_text">'+sqb_correct_ans_text+'</div></div>'+correct_ans_div+'</div>';
				}else{
					if( jQuery(this).find('.sqb_ans_selected').length == 0){
						ques_ans_html += '<div class="ans_in_resultpage incorrect_ans_div' +addnewclass+'"><div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+'</b><div class="ans_text">Skipped</div> </div></div>'; 
					}else{	
						ques_ans_html += '<div class="ans_in_resultpage incorrect_ans_div"><div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+' </b><div class="ans_text">'+sqb_correct_ans_text+'</div><div class="result_text"><b>'+outcome_screen_result+' </b>Incorrect Answer</div></div> <div class="incorrect_answer_exp_cls answer_cls"><b>'+outcome_screen_incorrect_answer+'</b><div clas="ans_text">'+incorrect_answer_msg_exp+'</div></div></div>';  
					}
				}

			}else{

				if(sqb_ans_correct_cls == sqb_ans_selected_cls){
			 
					ques_ans_html += '<div class="ans_in_resultpage correct_ans_div' +addnewclass+'"> <div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+' </b><div class="ans_text">'+sqb_correct_ans_text+'</div></div>'+correct_ans_div+'</div>';
				}else{
					
					if( jQuery(this).find('.sqb_ans_selected').length == 0){
						ques_ans_html += '<div class="ans_in_resultpage incorrect_ans_div' +addnewclass+'"><div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+'</b><div class="ans_text">Skipped</div> </div></div>';  
					}else{					
						ques_ans_html += '<div class="ans_in_resultpage incorrect_ans_div"><div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+' </b><div class="ans_text">'+sqb_selected_ans_text+'</div><div class="answer_cls"><b>'+outcome_screen_correct_answer+' </b><div clas="ans_text">'+sqb_correct_ans_text+'</div></div><div class="result_text"><b>'+outcome_screen_result+' </b>Incorrect Answer</div></div> <div class="incorrect_answer_exp_cls answer_cls"><b>'+outcome_screen_incorrect_answer+'</b><div clas="ans_text">'+incorrect_answer_msg_exp+'</div></div></div>';  
					}			
				}		

			}

				
					
		}			
		i++;
	});		 
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer #result_temp_btnid').before('<div class="ans_in_resultpage_outer">'+ques_ans_html+'</div>');	
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer1 #result_temp_btnid').before('<div class="ans_in_resultpage_outer">'+ques_ans_html+'</div>');	
	  
}

//show question-answer in exh page for all questions in the same page 
function sqb_show_ques_ans_in_questionscreen(sqb_quiz_container_outer_id){	
	 
	var ques_ans_html="";	
	var i =1; 	
	jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){
		if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
			if( jQuery(this).find('.sqb_ans_selected').length == 0){	
				 return true;  
			}
		}
		
		var question_title = jQuery(this).find(".question_title").text();	
		var sqb_correct_ans_text = jQuery(this).find(".correct_ans_cls .sql_ans_text").text();						 
		var sqb_selected_ans_text = jQuery(this).find(".sqb_ans_selected .sql_ans_text").text();						 
		var sqb_ans_correct_cls = jQuery(this).find(".sqb_ans_item_outer").hasClass("correct_ans_cls");						 
		var sqb_ans_selected_cls = jQuery(this).find(".sqb_ans_item_outer.correct_ans_cls").hasClass("sqb_ans_selected");
		 						 
		if(sqb_ans_correct_cls == sqb_ans_selected_cls){
			ques_ans_html += '<div class="ans_in_resultpage correct_ans_div"> <div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>Your Answer: </b><div class="ans_text">'+sqb_correct_ans_text+'</div></div><div class="result_text"><b>Result: </b>Correct Answer</div></div>'; 
		}else{
			ques_ans_html += '<div class="ans_in_resultpage incorrect_ans_div"><div class="question_cls"><b>Question '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>Your Answer: </b><div class="ans_text">'+sqb_selected_ans_text+'</div><div class="answer_cls"><b>Correct Answer: </b><div clas="ans_text">'+sqb_correct_ans_text+'</div></div><div class="result_text"><b>Result: </b>Incorrect Answer</div></div></div>';  
		}			
		i++;
	});		 
	//jQuery('.quiz_quesans_template_outer .multiple_ques_true').before('<div class="ans_in_resultpage_outer">'+ques_ans_html+'</div>');	 
}


function sqbEmailChecker(email,sqb_quiz_container_outer_id,continue_btn_text='', not_call_register = 'N'){
	
	
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ "  input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();	
	
	if(sqb_quiz_type ==  "scoring" || sqb_quiz_type ==  "assessment" ){
		//replace merge tag in html 
		var optin_position = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_opt_screen_position').val();
		if(optin_position == "optin-after-questions-screen"){
			replaceOutcomeMergeTags(sqb_quiz_container_outer_id);
		}
	}
	//replace merge tag in html 
	//replaceOutcomeMergeTags(sqb_quiz_container_outer_id);
	
	 
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
	
	jQuery('#'+sqb_quiz_container_outer_id+ ' .sqbwarning_div').remove(); 
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
	
	var valid_email = jQuery('#valid_email').val();
	var admin_ajaxurl = jQuery('#sqb_ajaxurl').val();
	
	jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').html('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
	
	jQuery.ajax({
		url: admin_ajaxurl,
		type: "POST",
		//async: false,
		data: {
			'action': 'sqb_email_check_api_ajax',
			'email': email,
		},
		success: function (response) {
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').html(ori_text);
			response = JSON.parse(response);
			var email_verify =  'invalid';
			if(response.result){
				if(response.reason == 'timeout'){
					email_verify =  'valid';
				}else if(response.result == 'valid'){
					email_verify =  'valid';
				}else{
				}	
			}
			
			jQuery("#"+sqb_quiz_container_outer_id).find('#email_verify_result').val(email_verify);
			var sbq_email_verify_response =	jQuery("#"+sqb_quiz_container_outer_id).find('#email_verify_result').val();
			if(sbq_email_verify_response == 'valid'){
				if(not_call_register == 'Y'){
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('hide_cls done_screen').removeClass('show_cls');
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').addClass('show_cls').removeClass('hide_cls');
				}else{
					var resultdata = sqbRegisterUser(sqb_quiz_container_outer_id, "", "" ,"", continue_btn_text);
				}
			}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .form_cls').before('<div class="sqbwarning_div"><b>'+valid_email+'</b></div>'); 
				
				
			}
			
			
		}
	});
	
}



function isValidEmail(emailText) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailText);
}


function sqbRegisterUser(sqb_quiz_container_outer_id, first_name , email , btn_click, continue_btn_text=''){	 	 
	 jQuery('.sqb_custom_field_required_class').hide();
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ "  input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();	
	
	jQuery('#'+sqb_quiz_container_outer_id+' .quiz_result_template_outer').html(jQuery('#'+sqb_quiz_container_outer_id+' .quiz_result_template_outer').html().replaceAll('[SHOWALLUSERTAGS]', '<custom_tag>[SHOWALLUSERTAGS]</custom_tag>'));
		
	if(btn_click =="no"){
		//check if Retake need to show on not for non-lesson
		var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();		 
		if(lesson_id ==null || lesson_id =="" || typeof lesson_id =="undefined"){	
			//for non-lesson context
			setSQBCookieForRetake(sqb_quiz_container_outer_id);			 
		}
	}
	 	
	
	if(sqb_quiz_type ==  "scoring" || sqb_quiz_type ==  "assessment" ){
		//replace merge tag in html 
		replaceOutcomeMergeTags(sqb_quiz_container_outer_id);
	}
	//replace merge tag in html 
	//replaceOutcomeMergeTags(sqb_quiz_container_outer_id);
	
	
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
		var matching_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('matching_text'); 
		var file_upload_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('file_upload_cls');
		var matrix_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('matrix_cls');
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
			var answer_type = 'date';
		}else if(file_upload_cls == true){
			var fileURl =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".file_upload_cls").attr('data-fileurl');
			var answer_text = fileURl;
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
		}else if(phone_number_text_cls == true){

			var country_code =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".iti__country.iti__active .iti__dial-code").html();
			var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".sqb_and_field").val();
			
			if(answer_text != ''){
				answer_text =  country_code+' '+answer_text;
			}else{
				answer_text = '';
			}
		}else if(weight_and_height_cls == true){	
			var answer_text =  getHeightWeightValues(jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id),false);
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
			answer_type = 'numerical_text';
			
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
		var correct_answer_msg_exp = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .correct_answer_msg").val();
		var common_correct_answer_msg_exp = jQuery("#common_correct_msg").val();		 
		if(correct_answer_msg_exp ==""){
			correct_answer_msg_exp = common_correct_answer_msg_exp;
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
				'correct_answer_msg_exp':correct_answer_msg_exp,
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
			outcomeRedirectCallBeforeReister(sqb_quiz_container_outer_id);  
			//check if Retake need to show on not for non-lesson
			var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();		 
			if(lesson_id ==null || lesson_id =="" || typeof lesson_id =="undefined"){
				//for non-lesson context
				setSQBCookieForRetake(sqb_quiz_container_outer_id);			 
			}
		}	

		if(!is_global_redirect){
			if(continue_btn_text !=""){				
				jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').html(continue_btn_text);
			}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').html(ori_text);
			}
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
		var optin_form_fields = jQuery('#'+sqb_quiz_container_outer_id).find("#sqb_direct_signup").find(":input:not(:hidden:not(.cfields-hidden-wrapper input))").serialize();
		jQuery('#'+sqb_quiz_container_outer_id).find('.quiz_optin_template_outer').addClass('hide_cls').removeClass('show_cls');
	} else {
		var auto_submit_optin = jQuery('#'+sqb_quiz_container_outer_id+ " #auto_submit_optin").val();
		if(auto_submit_optin == 'Y'){
			jQuery('#'+sqb_quiz_container_outer_id).find('.quiz_optin_template_outer').removeClass('hide_cls').addClass('show_cls');
		}
		var optin_form_fields = jQuery('#'+sqb_quiz_container_outer_id).find("#sqb_direct_signup").find(":input:not(:hidden:not(.cfields-hidden-wrapper input))").serialize();
		if(auto_submit_optin == 'Y'){
			jQuery('#'+sqb_quiz_container_outer_id).find('.quiz_optin_template_outer').addClass('hide_cls').removeClass('show_cls');
		}
	}
	
	var sqb_custom_fields_array = [];
	jQuery('#'+sqb_quiz_container_outer_id).find('#sqb_direct_signup').find( "[id^='custom_']" ).each(function(){
            var field_name = jQuery(this).attr('id').replace('custom_','');
			sqb_custom_fields_array.push({field_name:field_name,field_value:jQuery(this).val()});
	});
	
	var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
	var double_optin  = jQuery('#'+sqb_quiz_container_outer_id).find("#double_optin").val();
	var nounce = jQuery('#'+sqb_quiz_container_outer_id).find('#sqb_nounce').val();
		//register   user ajax  
		jQuery.ajax({	 
			url: ajaxurl,	 
			type: "POST",
			//	async: true,
			//async: false,
			data: {
				action: 'SQBAddUserAjax',
				nounce : nounce,
				//form_data : form_data
				first_name: first_name,
				firstname_temp: firstname_temp,
				email: email ,		 
				register_way: register_way ,		 
				productId: productId ,	
				signup_way: signup_way ,	
				quizId: quizId ,	
				sqb_quiz_type: sqb_quiz_type ,
				outcome_final: outcome_final ,	
				sqb_question_answer_array: sqb_question_answer_array ,	
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
			},
			success: function (response) {	
				 
				response = JSON.parse(response);
				  
				jQuery('#'+sqb_quiz_container_outer_id+ ' #user_id').val(response.user_id);
				jQuery('#'+sqb_quiz_container_outer_id+ ' #platform').val(register_way);
				if(response.user_id !="" || typeof response.user_id != "undefined"){
							
					//save the data in sqb_users table
					sqbSaveUser(ori_text, sqb_quiz_container_outer_id);
					// save report info
					var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='quiz_id']").val();
					var sqb_quiz_current_page_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='sqb_quiz_current_page_id']").val();
					sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_opt_in_btn_click');
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
                    
					sqb_lead_save(user_id,how_many_answed, 'lead_optin_btn_click', sqb_quiz_container_outer_id,'','',show_outcome_again,gdpr_required, first_name,optin_form_fields);
					//send email notification and send data in external system
					sqb_send_email_notifications(first_name ,email ,register_way ,productId ,signup_way,quizId ,sqb_quiz_type ,	outcome_final,sqb_question_answer_array ,outcome_ids_array,	outcome_desc,gdpr_required,	category_result_list_array, optin_form_fields ,	sqb_custom_fields_array ,catdata ,category_number_percent ,category_number_div ,show_optin,double_optin,firstname_temp);
				} 


				if(!is_global_redirect){
					if(continue_btn_text !=""){	
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').html(continue_btn_text);
					}else{
						jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').html(ori_text);
					}
				}
				
				if(social_share_screen_value == 'Y'){
				//showSocialShareCall(sqb_quiz_container_outer_id);
				}				
				//redirect calculations	
				//outcomeRedirectCall(sqb_quiz_container_outer_id);
				
			}
		});
		// }, show_analyzing_result_time+'000');
	
}

function showSocialShareCall(sqb_quiz_container_outer_id){
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer ').addClass('hide_cls').removeClass('show_cls'); 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').addClass('hide_cls').removeClass('show_cls');
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_social_share_template_outer ').addClass('show_cls').removeClass('hide_cls');
		var share_html =  jQuery("#"+sqb_quiz_container_outer_id+ " .sqb_social_share_html").html();
}

function sqb_social_share_next_btn(){
	jQuery(document).on('click','.sqb_social_share_next_btn' ,function(evt){
	var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
	
	if(jQuery('#'+sqb_quiz_container_outer_id+ ' #show_analyzing_result').val() == 'Y'){
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_analyzing_template_outer ').addClass('show_cls').removeClass('hide_cls done_screen'); 			
		} else {
		sqb_fun_animation_show(sqb_quiz_container_outer_id);	
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').addClass('show_cls').removeClass('hide_cls');
		}
		outcomeRedirectCall(sqb_quiz_container_outer_id);
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_social_share_template_outer ').addClass('hide_cls').removeClass('show_cls');
	});
}
sqb_social_share_next_btn();

// for sqb Progress Bar
function sqbProgressBar(sqb_quiz_container_outer_id, ques_parent_div='' ){	
    
	 var sqb_ans_selected = jQuery("#"+sqb_quiz_container_outer_id+ " "+ques_parent_div+" .sqb_ans_item_outer.sqb_ans_selected").length;	 
	 var ques_count =jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val(); 	
	 var fill_in_blank_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " "+ques_parent_div+" .sqb_ans_item_outer").hasClass('fill_in_blank_cls'); 
	 var text_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " "+ques_parent_div+" .sqb_ans_item_outer").hasClass('text_cls'); 
	 var date_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " "+ques_parent_div+" .sqb_ans_item_outer").hasClass('date_cls'); 
	 var slider_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " "+ques_parent_div+" .sqb_ans_item_outer").hasClass('slider_cls'); 
							
	if(fill_in_blank_cls ==true){ 								 					
	}else if(text_cls ==true){			 								 	
	}else if(date_cls ==true){			 								 	
	}else if(slider_cls ==true){			 								 	
	}else{
		if(sqb_ans_selected >0){
			var ques_count= parseInt(ques_count) + 1;		
		}  
	}				 

	if(jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer'+' '+ ques_parent_div).find('.answer_container').hasClass('back-btn-enabled')){
	}else{
		jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val(ques_count);	 
		var ques_count_progress =jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count_progress').val(); 
		var ques_count_progress= parseInt(ques_count_progress) + 1
		jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count_progress').val(ques_count_progress);

		var total_ques = jQuery('#'+sqb_quiz_container_outer_id+ ' #total_ques').val();
		var final_count = parseInt(total_ques, 10) / ques_count_progress;			 
		var final_val = parseFloat(parseInt(ques_count_progress, 10) * 100) / parseInt(total_ques, 10);

		final_val = (Math.round(final_val * 100) / 100).toFixed(0);  
		jQuery('#'+sqb_quiz_container_outer_id+ ' .progress-bar').val(final_val);
		jQuery('#'+sqb_quiz_container_outer_id+ ' .progress-bar').css("width",final_val+"%");
		jQuery('#'+sqb_quiz_container_outer_id+ ' .progress_percent').text(final_val+"%");
	}

	 

	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer ').addClass('hide_cls').removeClass('show_cls');	
}

function sqbPrevProgressBar(sqb_quiz_container_outer_id, ques_parent_div='' ){	
    
	 var sqb_ans_selected = jQuery("#"+sqb_quiz_container_outer_id+ " "+ques_parent_div+" .sqb_ans_item_outer.sqb_ans_selected").length;	 
	 var ques_count =jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val(); 	

	 var fill_in_blank_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " "+ques_parent_div+" .sqb_ans_item_outer").hasClass('fill_in_blank_cls'); 
	 var text_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " "+ques_parent_div+" .sqb_ans_item_outer").hasClass('text_cls'); 
	 var date_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " "+ques_parent_div+" .sqb_ans_item_outer").hasClass('date_cls'); 
	 var slider_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " "+ques_parent_div+" .sqb_ans_item_outer").hasClass('slider_cls'); 
							
	if(fill_in_blank_cls ==true){ 								 					
	}else if(text_cls ==true){			 								 	
	}else if(date_cls ==true){			 								 	
	}else if(slider_cls ==true){			 								 	
	}else{
		//if(sqb_ans_selected >0){
			var ques_count= parseInt(ques_count) - 1;		
		//}  
	}				 
	  
	 jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val(ques_count);	 
	 var ques_count_progress =jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count_progress').val(); 
	 var ques_count_progress= parseInt(ques_count_progress) - 1
	 jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count_progress').val(ques_count_progress);
		
	var total_ques = jQuery('#'+sqb_quiz_container_outer_id+ ' #total_ques').val();
	var final_count = parseInt(total_ques, 10) / ques_count_progress;			 
	var final_val = parseFloat(parseInt(ques_count_progress, 10) * 100) / parseInt(total_ques, 10);
	      
	final_val = (Math.round(final_val * 100) / 100).toFixed(0);  
	jQuery('#'+sqb_quiz_container_outer_id+ ' .progress-bar').val(final_val);
	jQuery('#'+sqb_quiz_container_outer_id+ ' .progress-bar').css("width",final_val+"%");
	jQuery('#'+sqb_quiz_container_outer_id+ ' .progress_percent').text(final_val+"%");

	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer ').addClass('hide_cls').removeClass('show_cls');	
}

// for Save user
function sqbSaveUser(ori_text = '', sqb_quiz_container_outer_id){
	var id = "";			
	var quiz_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_id').val();			
	var user_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #user_id').val();			
	var platform = jQuery('#'+sqb_quiz_container_outer_id+ ' #platform').val();			
	var total_ques = jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val();			
	var correct_answer = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();			
	var incorrect_answer = parseInt(total_ques)- parseInt(correct_answer);			
	var answer_points = jQuery('#'+sqb_quiz_container_outer_id+ ' #answer_points').val();			
	var percentage = jQuery('#'+sqb_quiz_container_outer_id+ ' #percentage').val();			
	var ajaxurl = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_ajaxurl').val();	
	//added for the backend preview	
	var SQBPreview = jQuery('#SQBPreview').val();
	if(SQBPreview =="Y"){
		return false;
	}
	jQuery.ajax({	 
		url: ajaxurl,	 
		type: "POST",
		data: {
			action: 'SQBSaveUserAjax',
			id: id,
			quiz_id: quiz_id,
			user_id: user_id,
			platform: platform,
			total_ques: total_ques ,		 
			correct_answer: correct_answer ,		 
			incorrect_answer: incorrect_answer ,		 
			answer_points: answer_points ,		 
			percentage: percentage+"%" ,		 

		},
		success: function (response) {	
			response = JSON.parse(response);	
 
			if(response.msg =="success"){ 		
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .form_cls').before('<div class="sqbwarning_div"><b>User Already Exist With This Email</b></div>'); 
			}else{					  
				
			}
		}
	});	 
}

function sqb_append_share_btn_rename(outcome_id = ''){
	var share_html = "<div class='sqb_fb_share' data-outcome-id='"+outcome_id+"'>fb share</div><div class='sqb_tw_share'>tw share</div>";  
	if(jQuery('#'+outcome_id).find('.sqb_fb_share').length == 0){
		jQuery('#'+outcome_id).append(share_html);	
	}
}

function sqb_append_retake(outcome_id = ''){
	/*var show_retake = jQuery('#show_retake').val(); 
	var reake_data_outer='';
	if(show_retake == "yes"){
		reake_data_outer = jQuery('.reake_data_outer').html(); 
	} 
	var reake_data_outer= jQuery('.reake_data_outer').html(); 
	var reake_data_outer1 ='<div class="reake_data_outer1">'+reake_data_outer+'</div>';
	jQuery('.quiz_result_template_outer .outcome_div .result_temp_outer').append(reake_data_outer1);	*/			
}

//replace merge tag in html		  
function replaceOutcomeMergeTags(sqb_quiz_container_outer_id){
	removeFontTag();
	jQuery('#'+sqb_quiz_container_outer_id).append('<input type="hidden" id="outcome_final" name="outcome_final" value="0"/>');		 
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
		if(jQuery(this).css('display') != 'none'){
			var outcome_final_id = jQuery(this).attr('id');
			if(typeof outcome_final_id != 'undefined' && outcome_final_id != '' ){
				var sqb_outcome_max_key = outcome_final_id.split("outcome_id_");
				var outcome_id = sqb_outcome_max_key[1];				 
				jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val(outcome_id);
				//for social share
				if(sqb_quiz_type =="assessment"){
					var total_ques = jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val();
					var sqb_correct_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();	 					 
					sqb_generate_share_variable_dynamic(sqb_quiz_container_outer_id,sqb_quiz_id,'assessment',outcome_id,total_ques,sqb_correct_ans);
				}
				if(sqb_quiz_type =="scoring"){
					var total_pt = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val();
					var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
					sqb_generate_share_variable_dynamic(sqb_quiz_container_outer_id,sqb_quiz_id,'scoring',outcome_id,total_pt,sqb_points_ans);
				}
				
				var matrix_total_cheked_values = jQuery('#'+sqb_quiz_container_outer_id+ ' .matrix_values_added .sqb_and_field.matrix_answer_value:checked').length;
				var sum_of_values = 0;
				jQuery('#'+sqb_quiz_container_outer_id+ ' .matrix_values_added .sqb_and_field.matrix_answer_value:checked').each(function(index){
					sum_of_values += parseInt(jQuery(this).attr('data-assigned-value'));					
				});
				var average_matrix_values = sum_of_values/matrix_total_cheked_values;
				jQuery(this).html(jQuery(this).html().replace('[AVGMATRIXVALUE]', '<div class="sqb_average_matrix_value">'+average_matrix_values.toFixed(2)+'</div>'));
				jQuery(this).html(jQuery(this).html().replace('[TOTALMATRIXVALUE]', '<div class="sqb_total_matrix_value">'+sum_of_values+'</div>'));
				
				var loader_html= '<div class="sqb_loader_outer_chart " style="display: none;"><div class="sqb_loader_inner"></div></div>';
				if(jQuery(this).find('.sqb_loader_outer_chart').length != 0){
					//loader_html = '';
				}
				jQuery(this).html(jQuery(this).html().replace('[CHART_HEADING]', loader_html+'<div class="sqb_char_heading_class"></div>'));
				if(jQuery(this).find('.sqb_loader_outer_chart').length != 0){
					//loader_html = '';
				}
				
				
				var sqb_spider_chart_shortcode = '[OUTCOME_SPIDER_CHART]';
				var sqb_bar_chart_shortcode = '[OUTCOME_BAR_CHART]';
				
				if(jQuery('#'+sqb_quiz_container_outer_id+' #outcome_screen_charts_settings').length > 0){	
					var charts_settings = decodeURIComponent(jQuery('#'+sqb_quiz_container_outer_id+' #outcome_screen_charts_settings').val());
					var final_charts_settings = charts_settings.split('|');
					if(final_charts_settings[15] != '' && final_charts_settings[15] == 'outcome_based'){
					 sqb_spider_chart_shortcode = '[OUTCOME_SPIDER_CHART]';
					 sqb_bar_chart_shortcode = '[OUTCOME_BAR_CHART]';
					}
					if(final_charts_settings[15] != '' && final_charts_settings[15] == 'category_based') {
					 sqb_spider_chart_shortcode = '[CATEGORY_SPIDER_CHART]';
					 sqb_bar_chart_shortcode = '[CATEGORY_BAR_CHART]';
					}
					if(final_charts_settings[15] != '' && final_charts_settings[15] == 'outcome_ranking') {
					 sqb_spider_chart_shortcode = '[PERSONALITY_SPIDER_CHART]';
					 sqb_bar_chart_shortcode = '[PERSONALITY_BAR_CHART]';
					}
				}
				
				var loader_html= '<div class="sqb_loader_outer_chart OUTCOME_SPIDER_CHART_loader" style="display: none;"><div class="sqb_loader_inner"></div></div>';
				jQuery(this).html(jQuery(this).html().replace(sqb_spider_chart_shortcode, loader_html+'<div class="ans_in_resultpage_outer sqb_charts_outer_section"><div class="chart-container spiderChartOutcomeClass"><canvas id="spiderChartOutcome"></canvas></div></div>'));
				if(jQuery(this).find('.sqb_loader_outer_chart').length != 0){
					//loader_html = '';
				}	
				var loader_html= '<div class="sqb_loader_outer_chart OUTCOME_BAR_CHART_loader" style="display: none;"><div class="sqb_loader_inner"></div></div>';
				jQuery(this).html(jQuery(this).html().replace(sqb_bar_chart_shortcode , loader_html+'<div class="ans_in_resultpage_outer sqb_charts_outer_section"><div class="chart-container spiderChartOutcomeClass1"><canvas id="spiderChartOutcome1"></canvas></div></div>'));
				if(jQuery(this).find('.sqb_loader_outer_chart').length != 0){
					//loader_html = '';
				}
					
				var loader_html= '<div class="sqb_loader_outer_chart QUESTION_ANSWER_DATA_CHART_loader" style="display: none;"><div class="sqb_loader_inner"></div></div>';
				jQuery(this).html(jQuery(this).html().replace('[QUESTION_ANSWER_DATA_CHART]', loader_html+'<div id="question_answer_chart"></div>'));
				
				
			}
		}
	});
	 
	jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(){	
		 var sqb_quiz_category_enable = jQuery('#'+sqb_quiz_container_outer_id).find('input[name="sqb_quiz_category_enable"]').val();  
		//if(jQuery(this).css('display') != 'none'){
			//scoring quiz
			if(sqb_quiz_type =="scoring"){			
				var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
				var total_pt = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(); 		 
				if(sqb_points_ans =="NaN"	|| sqb_points_ans =="nan" || sqb_points_ans =="NAN"){
					sqb_points_ans =0;
				}	
				jQuery(this).html(jQuery(this).html().replaceAll('%% TOTALSCORE %%', '%%TOTALSCORE%%'));
				jQuery(this).html(jQuery(this).html().replaceAll('%% YOURSCORE %% ', '%%YOURSCORE%%'));
				jQuery(this).html(jQuery(this).html().replaceAll('%%TOTALSCORE%%', '<div class="sqb_total_points">'+total_pt+'</div>'));
				jQuery(this).html(jQuery(this).html().replaceAll('%%YOURSCORE%%', '<div class="sqb_points_earned">'+sqb_points_ans+'</div>'));

				
				var total_ques = jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val();
				jQuery(this).html(jQuery(this).html().replaceAll('[AVERAGE_SCORE]', '<div class="sqb_points_average">'+calculate_average(sqb_points_ans,total_ques)+'</div>'));
				

				
				
	 
				if(sqb_quiz_category_enable == 'Y'){
					sqb_show_category_details(sqb_quiz_container_outer_id, this, 'scoring');
				}
				
				
			}
			if(sqb_quiz_type =="assessment"){ //assessment quiz
				var total_ques = jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val();
				var sqb_correct_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();
				
				jQuery(this).html(jQuery(this).html().replaceAll('%% TOTALQUESTIONS %%', '%%TOTALQUESTIONS%%'));
				jQuery(this).html(jQuery(this).html().replaceAll('%% CORRECTANSWERS %%', '%%CORRECTANSWERS%%'));
				jQuery(this).html(jQuery(this).html().replaceAll('%%TOTALQUESTIONS%%', '<div class="sqb_total_points">'+total_ques+'</div>'));
				jQuery(this).html(jQuery(this).html().replaceAll('%%CORRECTANSWERS%%', '<div class="sqb_points_earned">'+sqb_correct_ans+'</div>'));

				
				jQuery(this).html(jQuery(this).html().replaceAll('[AVERAGE_SCORE]', '<div class="sqb_points_average">'+calculate_average(total_ques,total_ques)+'</div>'));
				

				sqb_show_category_details(sqb_quiz_container_outer_id, this, 'assessment');
			}
			
			jQuery(this).find(".sqb_category_details").each(function(){	
				if( jQuery(this).html() ==''){
					jQuery(this).hide();
				}
			});	
		//}
	});	
	
}

function checkifsetSQBCookieForRetake(sqb_quiz_container_outer_id){	

	var quiz_display =  jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();
	var quiz_id =  jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_id').val();
	var allow_retake = jQuery('#'+sqb_quiz_container_outer_id+ ' #allow_retake_new').val();
	var total_attempts = jQuery('#'+sqb_quiz_container_outer_id+ ' #total_attempts_new').val();
	var quiz_attempts_allowed = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_attempts_allowed_new').val();
	var showRetake = false;  
	if(allow_retake="Y" && quiz_display !="corner_popup" ){
		if(quiz_attempts_allowed !="Limited" ){		 
			showRetake = true;
			//don't set the cookie , always show the retake
		}else{
			var cookieValue = jQuery.cookie("SQBRetake_"+quiz_id);
			 
			//if(cookieValue !="" || cookieValue !=null || typeof cookieValue != 'undefined' ||   cookieValue !=  undefined ){ 
			if(  typeof cookieValue != 'undefined' ){ 
				if(parseInt(cookieValue) < parseInt(total_attempts)){	 
					var cookieValueNew = parseInt(cookieValue)+1;					 
					//jQuery.cookie("SQBRetake_"+quiz_id, cookieValueNew);					
					showRetake = true;
				}
			}else{
				showRetake = true;
				var cookieValueNew =1;
				//jQuery.cookie("SQBRetake_"+quiz_id, cookieValueNew);
			}   
			 
		}		
	}
	
	return showRetake+"||"+cookieValueNew+"||"+quiz_attempts_allowed;	  
}

function setSQBCookieForRetake(sqb_quiz_container_outer_id){
	var getshowRetakeAndCookie = checkifsetSQBCookieForRetake(sqb_quiz_container_outer_id);
	var getRetakeAndCookie = getshowRetakeAndCookie.split("||");
	var showRetake = getRetakeAndCookie[0];
	var allow_retake = jQuery('#'+sqb_quiz_container_outer_id+ ' #allow_retake_new').val();
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .result_temp_outer .retake_without_lesson_div').each(function(){
		jQuery(this).remove();
	});		 
	  
	if(showRetake =='true' && allow_retake == 'Y'){
		
		var retake_html= jQuery('.retake_without_lesson_div').html();
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .result_temp_outer').each(function(){
			jQuery(this).append('<div class="reake_data_outer retake_without_lesson_div disable_retakebutton">'+retake_html+'</div>');
		});		
		var quiz_display =  jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();
		if(quiz_display =="popup" ){						
		}else{
			//jQuery('#'+sqb_quiz_container_outer_id+ ' .retake_without_lesson_div').removeClass('showhide_retake');
			//jQuery('#'+sqb_quiz_container_outer_id+ ' .retake_without_lesson_div').css('display','inline-block');
		}
		setTimeout(function(){
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .result_temp_outer').find('.retake_without_lesson_div').removeClass('disable_retakebutton');
		}, 1000);
		
	}
}

function setCookieAndresetValuesInNonLessonContext(sqb_quiz_container_outer_id){
	
	//check if need to set the cookie
	var getshowRetakeAndCookie = checkifsetSQBCookieForRetake(sqb_quiz_container_outer_id);
	var getRetakeAndCookie = getshowRetakeAndCookie.split("||");
	var showRetake = getRetakeAndCookie[0];
	var cookieValueNew = getRetakeAndCookie[1];
	var quiz_attempts_allowed = getRetakeAndCookie[2];
	if(showRetake =='true'){
		var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
		//jQuery('#'+sqb_quiz_container_outer_id+ ' .retake_without_lesson_div').addClass('showhide_retake');		
		var quiz_id =  jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_id').val();
		if(quiz_attempts_allowed =="Limited" ){
			jQuery.cookie("SQBRetake_"+quiz_id, cookieValueNew);
		}			
		var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();	
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		if(quiz_display == "inpage"){ 
			
			jQuery('html, body').animate({
			   scrollTop: jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').offset().top - 50
			});
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer ').addClass("show_cls").removeClass("hide_cls"); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn').removeClass("hide_cls"); 

			var show_start_screen = jQuery('#'+sqb_quiz_container_outer_id+ ' #show_start_screen').val(); 
			if(show_start_screen != "Y"){
				jQuery( '#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer .take-quiz-btn ').trigger('click');
			}
 
		}else{
			jQuery(".quiz_outer_fe").removeClass("show_cls") ;					 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').show();	
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').addClass('show_cls ').removeClass('hide_cls');
			var show_firstname_temp = jQuery('#'+sqb_quiz_container_outer_id+ ' #show_firstname_temp').val(); 
		}			
		  
		 //reset the classes
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_outer_fe  ').removeClass("done_screen"); 		
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer ').addClass("hide_cls").removeClass("show_cls"); 	
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer  ').addClass("hide_cls").removeClass("show_cls"); 		 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass("question_container_disabled"); 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').first().removeClass("question_container_disabled"); 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').removeClass("question_container_disabled1");		 
		jQuery('.answer_container').removeClass("answer_container_disabled");
		 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').find('.checkbox_fe.matrix_answer_value').removeClass("sqb_ans_selected");
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').find('.checkbox_fe.matrix_answer_value').prop("checked",false);
		 		 
		//resetting the outcome
		jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div  ').each(function(){	
		 
		//scoring quiz
			if(sqb_quiz_type =="scoring"){
				var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
				var total_pt = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val();
				 
				jQuery(this).find(".sqb_total_points").html('%%TOTALSCORE%%');
				jQuery(this).find(".sqb_points_earned").html('%%YOURSCORE%%');
				jQuery(this).find(".sqb_points_average").html('[AVERAGE_SCORE]');
			}
			if(sqb_quiz_type =="assessment"){ //assessment quiz
				var total_ques = jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val();
				var sqb_correct_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();
				jQuery(this).find(".sqb_total_points").html('%%TOTALQUESTIONS%%');
				jQuery(this).find(".sqb_points_earned").html('%%CORRECTANSWERS%%');				
			}
			
			jQuery(this).find(".sqb_average_matrix_value").html('[AVGMATRIXVALUE]');
			jQuery(this).find(".sqb_total_matrix_value").html('[TOTALMATRIXVALUE]');
			
			jQuery(this).find('.sqb_tags_content_details_outer').html('[SHOWALLUSERTAGS]').hide();
			jQuery(this).hide();
			
		});	
		  
		//for one_per_page
		if(quiz_pagination !="all"){
			
			jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').each(function(){
				jQuery(this).removeClass("done_question");
			});
			
			jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){	
				jQuery('#'+sqb_quiz_container_outer_id+ '  .question_container').removeClass('question_container_disabled');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .question_container').removeClass("show_cls");				
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .question_container').addClass("hide_cls");
				jQuery('#'+sqb_quiz_container_outer_id+ '  .question_container').attr('style', '' );
			});	
			
			//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').show();
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .question_container').first().removeClass("hide_cls");
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .question_container').first().addClass("show_cls");
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template').removeClass("show_cls").addClass("hide_cls");
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template').first().removeClass("hide_cls");
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template').first().addClass("show_cls");	 	 
			
		}else{
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .question_container').first().addClass("show_cls");
		}
		 
		 
		//restting the values
		//disable points and correct answers
		jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(0);		 
		jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(0);		 
		jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val(0);		 
		jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(0);		 
		jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count_progress').val(0); 
		jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val('');	  

		jQuery('#'+sqb_quiz_container_outer_id+ ' .skip-question-action').show();
		jQuery('.quiz_quesans_template_outer .Quiz-Template.outer-style7').each(function(){
			if(jQuery(this).find('.skip-question-action').length > 0){
				jQuery(this).find('.continue-question-action').hide();
			} else {
				jQuery(this).find('.continue-question-action').show();
			}
		});
		
		/*if(jQuery('#'+sqb_quiz_container_outer_id+ ' .skip-question-action').length > 0){
			jQuery('#'+sqb_quiz_container_outer_id+ ' .continue-question-action').hide();
		} else {
			jQuery('#'+sqb_quiz_container_outer_id+ ' .continue-question-action').show();
		}*/
		
		jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').remove();		 
		//jQuery('#'+sqb_quiz_container_outer_id+ ' .not_passed_quiz_msg_outer').remove();		 
		//jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_data_cont').html('');		 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_ans_item_outer').removeClass("sqb_ans_selected"); 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .multiple_correct_checkbox .checkbox_fe').prop('checked', false); 			 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_question_answer_hidden').each(function(){
			jQuery(this).remove();	
		});		
		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_next_button_click').each(function(){
			 jQuery(this).val(0);	
		});
		
		//resetting the progressbar
		jQuery('#'+sqb_quiz_container_outer_id+ ' .progress-bar').val(0);
		jQuery('#'+sqb_quiz_container_outer_id+ ' .progress-bar').css("width", "0%");
		jQuery('#'+sqb_quiz_container_outer_id+ ' .progress_percent').text("");
		
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .result_temp_outer .retake_without_lesson_div').each(function(){
			jQuery(this).remove();
		});			
		jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){		 
			//reset the textarea and fill_in_the_blank values
			jQuery(this).find(" .sqb_ans_item_outer").removeClass("sqb_ans_selected");
			jQuery(this).find(" .sqb_ans_item_outer").removeClass("addselected"); 
			var fill_in_blank_cls =   jQuery(this).find(" .sqb_ans_item_outer").hasClass('fill_in_blank_cls'); 
			var text_cls = jQuery(this).find(" .sqb_ans_item_outer").hasClass('text_cls'); 
			var date_cls = jQuery(this).find(" .sqb_ans_item_outer").hasClass('date_cls'); 
			var slider_cls = jQuery(this).find(" .sqb_ans_item_outer").hasClass('slider_cls'); 
			var file_upload_cls = jQuery(this).find(" .sqb_ans_item_outer").hasClass('file_upload_cls'); 
			var dropdown_cls = jQuery(this).find(" .sqb_ans_item_outer").hasClass('dropdown_cls'); 
			var phone_number_cls = jQuery(this).find(" .sqb_ans_item_outer").hasClass('phone_number_text_cls'); 
			 
			if(fill_in_blank_cls ==true){												 					
				jQuery(this).find(".fill_in_blank_cls .sqb_ans_item .sqb_and_field").val('');jQuery(this).addClass('disable_nextbutton');									 					
			}else if(file_upload_cls ==true){
				jQuery(this).find(" .file_upload_button").html('Upload'); 
			}else if(phone_number_cls ==true){
				
			}else if(text_cls ==true){				
				jQuery(this).find(".text_cls .sqb_ans_item .sqb_and_field").val('');
				jQuery(this).addClass('disable_nextbutton');													 	
			}else if(date_cls ==true){				
				jQuery(this).find(".date_cls .sqb_ans_item .sqb_and_field").val('');
				jQuery(this).addClass('disable_nextbutton');		
				jQuery(this).find(".date_cls").addClass('sqb_ans_selected');
			}else if(dropdown_cls == true){
			}else if(slider_cls ==true){				
					var slider_id = jQuery(this).find(".slider.sqb_ans_slider").attr('id');	
					var min_value = jQuery(this).find(".slider.sqb_ans_slider").attr('data-slider-min');	
					jQuery('#'+slider_id).bootstrapSlider('setValue', min_value);	
					//jQuery(this).addClass('disable_nextbutton');													 	
			}else{}
			
			var wrapper = jQuery(this).find('.question_add_answer_outer_div');
			wrapper.find('.ranking_choices').sort(function (a, b) {
				return +a.dataset.answer - +b.dataset.answer;
			}).appendTo(wrapper);
			wrapper.find('.ranking_choices').addClass('sqb_ans_selected'); 
			
		});		 
		
		if(quiz_display == "inpage"){ 
			
		}else{
			if(show_firstname_temp == 'Y'){ 
					sqb_apply_wid_css_popup("first_name",sqb_quiz_container_outer_id); 
			}else{
					sqb_apply_wid_css_popup("question", sqb_quiz_container_outer_id);
			}
		}
		//replace formula	
		sqb_formula_putback_values(sqb_quiz_container_outer_id) ;
			
		jQuery('#'+sqb_quiz_container_outer_id).find('.file_upload_cls').css("pointer-events","auto");
		jQuery('#'+sqb_quiz_container_outer_id).find('.file_upload_button').css("pointer-events","auto");
		jQuery('#'+sqb_quiz_container_outer_id).find('.file_upload_button').show().next().hide();
		jQuery('#'+sqb_quiz_container_outer_id+ ' .file_upload_cls input[name="sqb_file_upload"]').val('');

		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer ').addClass('hide_cls').removeClass('show_cls');
		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_ans_item.ans_type_numeric_text input[type="number"]').val('');	 
		/*jQuery(sqb_quiz_container_outer_id).find('.question_container').each(function(){
			var question_id = jQuery(this).attr('data-question-id');			
			sqb_save_question_answer_report(quiz_id,question_id,0,0,sqb_quiz_container_outer_id,'only_question');			
		});	*/	
		 //var temp_wid = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template.show_cls').find('.temp_wid').val();
         //jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_quesans_template_outer .Quiz-Template.show_cls").css("max-width",temp_wid);	
	}
}

//replace merge tag in html		
function replaceOutcomeMergeTagsLesson(sqb_quiz_container_outer_id){
	
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
		if(jQuery(this).css('display') != 'none'){
			var outcome_final_id = jQuery(this).attr('id');
			if(typeof outcome_final_id != 'undefined' && outcome_final_id != '' ){
				var sqb_outcome_max_key = outcome_final_id.split("outcome_id_");
				var outcome_id = sqb_outcome_max_key[1];
				jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val(sqb_outcome_max_key[1]);
				//for social share
				if(sqb_quiz_type =="assessment"){
					var total_ques = jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val();
					var sqb_correct_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();	 
					sqb_generate_share_variable_dynamic(sqb_quiz_container_outer_id,sqb_quiz_id,'assessment',outcome_id,total_ques,sqb_correct_ans);
				}
				if(sqb_quiz_type =="scoring"){
					var total_pt = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val();
					var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
					sqb_generate_share_variable_dynamic(sqb_quiz_container_outer_id,sqb_quiz_id,'scoring',outcome_id,total_pt,sqb_points_ans);
				}
				
			}
		}
	});
	 
 	 
}

function sqb_click_to_share_btn_rename(sqb_quiz_container_outer_id){
	jQuery(document).on('click','#'+sqb_quiz_container_outer_id+ ' .sqb_fb_share',function(){
		 
		var outcome_id = jQuery(this).attr('data-outcome-id');
		FB.init({ 
				appId: '2017701201819944',
				status: true, 
				cookie: true,
				xfbml: true,
				oauth: true,
				version  : "v2.2"
			});
			  // Load the SDK Asynchronously
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, "script", "facebook-jssdk"));
			
			var sqb_share_url_generate = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_share_url_generate').val()+'&outcome_id='+outcome_id+'&'+Math.random();
			 
			FB.ui({
					
					method: "share",
					href:sqb_share_url_generate,
					}, 	function(response){
						if ((typeof(response) == "undefined") || (response === null) || (typeof(response.error_code) != "undefined" && response.error_code != "")) {
							
						} else {
							
						}
					}
			);
	});
	
	jQuery(document).on('click','.sqb_tw_share',function(){

	});
}
 
function sqb_apply_wid_css(sqb_quiz_container_outer_id){	
	
	if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template5' ){
	} else if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
	} else {
		var temp_wid = jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template.show_cls').find('.temp_wid').val();
		var temp_wid1 = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template.show_cls').next().find('.temp_wid').val();
		//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template.show_cls').closest(".quiz_quesans_template_outer .Quiz-Template ").css("max-width",temp_wid);
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .Quiz-Template.show_cls').next().css("max-width",temp_wid1);
	}
	
	//for popup  
	var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	 
	
	if(quiz_display == "popup"){
		//jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("width","100%");
		if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6' && jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template8'){
		jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("max-width",temp_wid);	 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("width",temp_wid);
		}	 
	}
}

function sqb_apply_wid_css_popup(screenname, sqb_quiz_container_outer_id){
	if(screenname =="first_name" ){	
		var temp_wid = jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_firstname_template_outer .quiz_comon_template ").css("max-width");		
		var q_max_width =        jQuery("#"+sqb_quiz_container_outer_id+ " .modal_pop_inn .Quiz-Template").css('max-width');
		var q_background_color = jQuery("#"+sqb_quiz_container_outer_id+ " .modal_pop_inn .Quiz-Template").css('background-color');
		var q_border =           jQuery("#"+sqb_quiz_container_outer_id+ " .modal_pop_inn .Quiz-Template").css('border');
			
	}else if(screenname =="optin" ){	
		var temp_wid = jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").css("max-width");			
	}else if(screenname =="result" ){	
		var temp_wid = jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_result_template_outer .quiz_comon_template ").css("max-width");			
	}else{
		var temp_wid = jQuery("#"+sqb_quiz_container_outer_id+ " .question_container.show_cls").find('.temp_wid').val();	
	}
	 
	//for popup 
	var quiz_display = jQuery("#quiz_display").val();	   
	if(quiz_display == "popup" || quiz_display == "corner_popup" || quiz_display == "exit" || quiz_display == "time_based" || quiz_display == "percentage_based"){
		if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6' && jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template8'){			 
		jQuery("#"+sqb_quiz_container_outer_id+ " .modal_pop_inn").css("max-width",temp_wid);	
		jQuery("#"+sqb_quiz_container_outer_id+ " .modal_pop_inn").css("width",temp_wid);	
		jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_quesans_template_outer .Quiz-Template.show_cls").css("max-width",temp_wid);	
		} 
		setTimeout(function() {				 
		 	 //jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_quesans_template_outer .Quiz-Template.show_cls").css("max-width",temp_wid);			 
		}, 100); 
		
		if(screenname =="first_name" ){	
		
		    jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_firstname_template_outer  .modal_pop_inn").css("padding",'12px');
		    jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_firstname_template_outer  .modal_pop_inn").css("padding-top",'30px');
		    jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_firstname_template_outer  .modal_pop_inn").css("padding-bottom",'30px');
			jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_firstname_template_outer  .modal_pop_inn").css('border',q_border);
			jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_firstname_template_outer  .modal_pop_inn").css('max-width',q_max_width);
			jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_firstname_template_outer  .modal_pop_inn").css('width',q_max_width);
			jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_firstname_template_outer  .modal_pop_inn").css('background-color',q_background_color);    			
		}
		
		var template_num = jQuery('#'+sqb_quiz_container_outer_id+ " #template_num").val();
		if(template_num == 'template5'){
			//setTimeout(function() {
				var temp_width = jQuery("#"+sqb_quiz_container_outer_id+ " .Quiz-Template-5").find('.temp_wid').val();
				jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_quesans_template_outer .Quiz-Template.show_cls").css("max-width",temp_width);
				jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_quesans_template_outer  .modal_pop_inn").css('max-width',temp_width);
				jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_quesans_template_outer  .modal_pop_inn").css('width',temp_width);
			//}, 10); 
		}
	} 		
}

//get correct msg 
function sqb_correct_msg(display_ques_id, sqb_quiz_container_outer_id){
	var correct_answer_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+display_ques_id).find('.correct_answer_msg').val();		 
	if(correct_answer_msg == ""){
		var correct_answer_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #common_correct_msg').val();
	}	 
	return correct_answer_msg;	 	
}
 
//get incorrect msg 
function sqb_incorrect_msg(display_ques_id, sqb_quiz_container_outer_id){	 
	var incorrect_answer_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+display_ques_id).find('.incorrect_answer_msg').val();	
	if(incorrect_answer_msg == ""){
		var incorrect_answer_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #common_incorrect_msg').val();				
	}
	return incorrect_answer_msg;	 
}

//show correct msg 
 function sqb_correctmsg_display(correct_answer_msg, sqb_quiz_container_outer_id, parent_ques_div){
 	var sqb_template = jQuery('#'+sqb_quiz_container_outer_id +' #template_num').val();
	if(sqb_template == 'template8'){
 		jQuery('#'+sqb_quiz_container_outer_id+' #'+parent_ques_div+' .answer_container ').after('<div class="correctincorrect_ans_div"><b>'+correct_answer_msg+' </b></div>'); 
 	}else{
		jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .answer_container,  #'+sqb_quiz_container_outer_id+' #'+parent_ques_div+' .answer_container ').after('<div class="correctincorrect_ans_div"><b>'+correct_answer_msg+' </b></div>'); 
 	}
}
 
 //show incorrect msg  
 function sqb_incorrectmsg_display(incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div){		 
	var sqb_template = jQuery('#'+sqb_quiz_container_outer_id +' #template_num').val();
	if(sqb_template == 'template8'){
		var inner_max_width = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .answer_container').css('max-width');
		var inner_width_style = '';
		if(typeof inner_max_width != 'undefined' && inner_max_width != ''){
		inner_width_style = 'style="max-width:'+inner_max_width+'"';
		}
		jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .answer_container,  #'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .answer_container ').after('<div class="in_correct_ans correctincorrect_ans_div" '+inner_width_style+'><b>'+incorrect_answer_msg+'</b></div>');
	} else {
		//if(jQuery('#'+sqb_quiz_container_outer_id).find('.show_cls').hasClass('question_type_file_upload'))	{
		if(jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).hasClass('question_type_file_upload')){
		jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_upload_button,  #'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_upload_button ').before('<div class="in_correct_ans correctincorrect_ans_div"><b>'+jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #file_upload_validation').val()+'</b></div>');
		} else { 
		jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .answer_container,  #'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .answer_container ').after('<div class="in_correct_ans correctincorrect_ans_div"><b>'+incorrect_answer_msg+'</b></div>');
		}
	}
} 
  
  
  function sqbScrollToNextScreen(sqb_quiz_container_outer_id){ 
	if(quiz_display == "inpage"){			 
		var quiz_pagination = jQuery("#"+sqb_quiz_container_outer_id+' #quiz_pagination').val();	
		if(quiz_pagination =="all"){
			if(show_firstname_temp != 'Y'){ 
				jQuery('html, body').animate({
					scrollTop: jQuery("#"+sqb_quiz_container_outer_id+" .quiz_quesans_template_outer").offset().top-120
				}, "slow");
			
			}
		}
	}		
 }
 
 function sqbScrollToNextScreenAfterStartScreen(sqb_quiz_container_outer_id){ 
	if(jQuery("#"+sqb_quiz_container_outer_id+' #quiz_display').val() == "inpage"){			 
		if(jQuery('#'+sqb_quiz_container_outer_id+ ' #move_question').val() == 'Y'){	
			if(jQuery("#"+sqb_quiz_container_outer_id+' #quiz_pagination').val() !="all"){
				if((jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation').val() == 'Y') && (jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation_option').val() == 'tb')){
				}else{ 

					var quiz_scroll_allow = page_question_animation_visiblity_check(".Quiz-Template.show_cls .question_title");
					var is_opt_in_screen = page_question_animation_visiblity_check(".show_cls .Quiz-Optin-Template .Quiz-Template-title");
					var is_opt_in_screen_check = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer.quiz_outer_fe').hasClass('show_cls');
					if (!quiz_scroll_allow) {
						if (is_opt_in_screen_check) {
							if (!is_opt_in_screen) {
								jQuery('html, body').animate({
									scrollTop: jQuery("#"+sqb_quiz_container_outer_id+" .quiz_optin_template_outer").offset().top-120
								}, "slow");	
							}
						}else{
							jQuery('html, body').animate({
								scrollTop: jQuery("#"+sqb_quiz_container_outer_id+" .quiz_quesans_template_outer").offset().top-120
							}, "slow");	
						}
					}			 
									 
				}
			}
		}		
	}		
 }
 
//function to go to the top of the div
function sqbScrollToNextQuestion(next_questionid,sqb_quiz_container_outer_id , quiztempid=""){ 
	var quiz_temp_id = "#quiz_temp_id"+quiztempid;
	jQuery( "#"+sqb_quiz_container_outer_id+ "  #"+next_questionid ).removeClass("question_container_disabled");
	var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();
	if(quiz_pagination != "all"){		 
		jQuery( "#"+sqb_quiz_container_outer_id+ " .Quiz-Template-outer  .Quiz-Template " ).addClass("hide_cls").removeClass("show_cls");
		jQuery( "#"+sqb_quiz_container_outer_id+ "  "+quiz_temp_id ).removeClass("hide_cls").addClass("show_cls ");
		jQuery( "#"+sqb_quiz_container_outer_id+ " .question_container " ).addClass("hide_cls").removeClass("show_cls");
		jQuery( "#"+sqb_quiz_container_outer_id+ "  #"+next_questionid ).removeClass("hide_cls").addClass("show_cls ");
	}else{
	
	 jQuery('html, body').animate({
		   scrollTop: jQuery( "#"+sqb_quiz_container_outer_id+ "  #"+next_questionid).offset().top - 160
		}, "slow");   
	}
}
  
 
//function to go to the top of the div
function quizScrollToDiv(myDiv, sqb_quiz_container_outer_id, nextdiv_id='', current_ques_div='', current_ques_div_hgt=''){ 
 
	if(nextdiv_id =="undefined"){
		return;
	}
	if(myDiv =="undefined"){
		return;
	}
	var quiz_pagination = jQuery("#"+sqb_quiz_container_outer_id+' #quiz_pagination').val();	
	var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
	if (isMobile) { //mobile
		if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
					
		}else{ 		
			var quiz_slider_animation = jQuery("#"+sqb_quiz_container_outer_id+' #quiz_slider_animation').val();	
			var quiz_slider_animation_option = jQuery("#"+sqb_quiz_container_outer_id+' #quiz_slider_animation_option').val();	
			jQuery("#"+sqb_quiz_container_outer_id+' #quiz_slider_animation').val("N");	
			jQuery("#"+sqb_quiz_container_outer_id+' #quiz_slider_animation_option').val("");	
			 
			//for one_per_page
			if(quiz_pagination !="all"){
				if (typeof nextdiv_id == "undefined" || nextdiv_id == '' ){
				}else{
					jQuery('html, body').animate({
						scrollTop: jQuery(myDiv+ ' #'+nextdiv_id ).offset().top-100
					}, "slow");
				}
			}
		}
		 
	}else{ //desktop
		
		if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
		}else{		
			move_question_move(myDiv, sqb_quiz_container_outer_id, nextdiv_id, current_ques_div, current_ques_div_hgt);
		}		
	}		
		
}

function move_question_move(myDiv, sqb_quiz_container_outer_id, nextdiv_id='', current_ques_div='', current_ques_div_hgt=''){
 
	var move_question = jQuery("#"+sqb_quiz_container_outer_id+' #move_question').val();		 
	var quiz_display = jQuery("#"+sqb_quiz_container_outer_id+' #quiz_display').val();	
	if(quiz_display =="inpage"){  
		if(nextdiv_id =="" || typeof nextdiv_id =="undefined" || nextdiv_id ==null || nextdiv_id ==undefined){ 
		}else{		 
			if(quiz_pagination !="all"){
				
				var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
				if (isMobile) { //mobile
					var move_question = "Y";
				} 
				if(move_question =="Y"){						 
					if((jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation').val() == 'Y') && (jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation_option').val() == 'tb')){ 
						
					}else{							 
						var nextdiv_id_hgt = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+nextdiv_id).height(); 							
						//if(parseInt(nextdiv_id_hgt) < parseInt(current_ques_div_hgt)){
						var quiz_scroll_allow = page_question_animation_visiblity_check(myDiv+".show_cls  .Quiz-Template.show_cls .Quiz-Template-title");
						if (!quiz_scroll_allow) { 								 
							jQuery('html, body').animate({
								scrollTop: jQuery('#'+sqb_quiz_container_outer_id+ ' #'+nextdiv_id).offset().top-100
							}, "slow");		
						}	
						//}
					}
					 
				}
			}
		}
	}
} 


function quizScrollToDivCenter(myDiv, sqb_quiz_container_outer_id){ 
    
	if(myDiv =="undefined"){
		return;
	}
	var quiz_scroll_allow = page_question_animation_visiblity_check(myDiv+" .Quiz-Template-title");
	if (!quiz_scroll_allow) { 
		var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
		if (isMobile) { //mobile
			var quiz_slider_animation = jQuery("#"+sqb_quiz_container_outer_id+' #quiz_slider_animation').val();	
			if(quiz_slider_animation !="Y"){		 
			  jQuery('html, body').animate({
				   scrollTop: jQuery(myDiv).offset().top - 50
				}, "slow");  
			}
		}else{  //mobile		 
			jQuery('html, body').animate({			  
			  //scrollTop: jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').offset().top - 100
			   scrollTop: jQuery(myDiv).offset().top - 100
			}, "slow");  
		}
	}
}
function quizScrollToDivTop(myDiv, sqb_quiz_container_outer_id){ 	

	var quiz_scroll_allow = page_question_animation_visiblity_check(myDiv+" .Quiz-Template-title");
	if (!quiz_scroll_allow) { 
		 jQuery('html, body').animate({ 
	        scrollTop: jQuery(myDiv+' .Quiz-Optin-Template ').offset().top-100
	    }, "slow"); 
    }
}
function quizScrollToDivTopResult(myDiv, sqb_quiz_container_outer_id, defview = 'default'){ 
	
	if (defview == 'analyzing') {
		var quiz_scroll_allow = page_question_animation_visiblity_check(myDiv+" .analyzing_result_title");
	}else{
		var quiz_scroll_allow = page_question_animation_visiblity_check(myDiv+" .Quiz-Template-title");
	}

	if (!quiz_scroll_allow) { 
		 jQuery('html, body').animate({ 
	        scrollTop: jQuery(myDiv).offset().top-100
	    }, "slow");  
    }	
}

 
function sqb_find_back_question_for_funnel_new(obj,parent_ques_div, sqb_quiz_container_outer_id){ 

	var quiz_id =   jQuery('#'+sqb_quiz_container_outer_id).find('#quiz_id').val();
	   var data_answer_id =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected').attr('data-answer-id');
	   var data_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).attr('data-question-id');	
	   var current_ques_div_hgt = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_temp_id'+data_question_id).height(); 
	  var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();
		  
	  if(jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).hasClass('multiple_correct_cls')){
		   
		    var data_answer_id =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected.multiple_cls').attr('data-answer-id');
			var data_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected.multiple_cls').attr('data-question-id');	    
	   }   

 	  //var sqb_funnel_ques_ans_connection_json= jQuery('#'+sqb_quiz_container_outer_id).find('.sqb_funnel_ques_ans_connection_json').val();
 	   var sqb_funnel_back_ques_ans_connection_json = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_funnel_back_ques_ans_connection_json').val();

 	  	var sqb_funnel_back_ques_ans_connection_json = jQuery.parseJSON(sqb_funnel_back_ques_ans_connection_json)
		 
		var sqb_funnel_json = sqb_funnel_back_ques_ans_connection_json;

		var prev_question_id = sqb_funnel_json[data_question_id]['back_question'];
		return prev_question_id;

}
function sqb_find_next_question_for_funnel_new(obj,parent_ques_div, sqb_quiz_container_outer_id){ 
	 	
 	  var quiz_id =   jQuery('#'+sqb_quiz_container_outer_id).find('#quiz_id').val();
	   var data_answer_id =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected').attr('data-answer-id');
	   var data_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected').attr('data-question-id');	    
	   var current_ques_div_hgt = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_temp_id'+data_question_id).height(); 
	  var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();
		  
	  if(jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).hasClass('multiple_correct_cls')){
		   
		    var data_answer_id =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected.multiple_cls').attr('data-answer-id');
			var data_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).attr('data-question-id');	    
	   }   

 	  //var sqb_funnel_ques_ans_connection_json= jQuery('#'+sqb_quiz_container_outer_id).find('.sqb_funnel_ques_ans_connection_json').val();
 	   var sqb_funnel_ques_ans_connection_json= jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_funnel_ques_ans_connection_json').val();
 

 	  	var sqb_funnel_ques_ans_connection_json = jQuery.parseJSON(sqb_funnel_ques_ans_connection_json)
		 
		var sqb_funnel_json = sqb_funnel_ques_ans_connection_json;
		if(data_question_id in sqb_funnel_json){			
			// check next has or not
			if(sqb_funnel_json[data_question_id]['next_question'] == undefined || sqb_funnel_json[data_question_id]['next_question'][data_answer_id] == undefined){				
				  
				 // jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').hide();
				  //show_optin or not
					//show_optin_form() ;
				  var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();	

				  if(sqb_quiz_type == "personality"){
								 
						personality_last_child_calculation(sqb_quiz_container_outer_id,"question_id_"+data_question_id ) ;

				  }else  if(sqb_quiz_type == "assessment"){

					  assessment_last_child_calculation(sqb_quiz_container_outer_id, "question_id_"+data_question_id);
					  
				  }else  if(sqb_quiz_type == "scoring"){
					 jQuery('#'+sqb_quiz_container_outer_id+ ' .single_cls').css('pointer-events', 'none');
					  scoring_last_child_calculation(sqb_quiz_container_outer_id,"question_id_"+data_question_id ) ;
				   } else if(sqb_quiz_type == "survey"){
					  
					  survey_last_child_calculation(sqb_quiz_container_outer_id,"question_id_"+data_question_id ) ;
					}
			 
			}else{			
				  var next_question_id = sqb_funnel_json[data_question_id]['next_question'][data_answer_id];
				   
				  var quiz_temp_id = "quiz_temp_id"+data_question_id;
				  var quiz_temp_id_next = "quiz_temp_id"+next_question_id;
				  			  		
					var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
					if(quiz_slider_animation =="Y")	{	
						setTimeout(function() {
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id_next ).addClass('show_cls').removeClass('hide_cls');
							jQuery("#"+sqb_quiz_container_outer_id+ " .enable_branching_quiz .question_container").removeClass('show_cls').addClass('hide_cls');
							jQuery("#"+sqb_quiz_container_outer_id+ " .enable_branching_quiz .question_container#question_id_"+next_question_id).addClass('show_cls').removeClass('hide_cls');
							 move_question_move('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id, quiz_temp_id_next, quiz_temp_id, current_ques_div_hgt);
						}, 500); 
					}else{
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
							jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id_next ).addClass('show_cls').removeClass('hide_cls');
							jQuery("#"+sqb_quiz_container_outer_id+ " .enable_branching_quiz .question_container").removeClass('show_cls').addClass('hide_cls');
							jQuery("#"+sqb_quiz_container_outer_id+ " .enable_branching_quiz .question_container#question_id_"+next_question_id).addClass('show_cls').removeClass('hide_cls');
							  move_question_move('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer', sqb_quiz_container_outer_id, quiz_temp_id_next, quiz_temp_id, current_ques_div_hgt);
						}
				  sqb_save_question_answer_report(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_id').val(),next_question_id, 0,0, sqb_quiz_container_outer_id);
				  
				  var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();
				  if(display_correctans_options ==""){
					// progressbar
					sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
				  }
				 
			}			
		}else {
		}
		
	
}

function sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id = 0,crrent_quesid = 0, sqb_quiz_container_outer_id){
	
	
	if(!jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
		//increase next question view count in questions and answer report table
		
		if(jQuery('#'+sqb_quiz_container_outer_id+ ' #question_id_'+crrent_quesid).closest('.Quiz-Template').next().attr('data-question-id') == undefined ){
			
		}else{
			
			sqb_save_question_answer_report(sqb_quiz_id,jQuery('#'+sqb_quiz_container_outer_id+ ' #question_id_'+crrent_quesid).closest('.Quiz-Template').next().attr('data-question-id'), 0,0, sqb_quiz_container_outer_id);
		}
	}
}

// show all question
function sqb_quiz_pagination_all(parent_ques_div, sqb_quiz_container_outer_id){
	//check if correct answer or not			
	var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();	
	var correct_ans_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();	 
	//show correct incorrect answer		 
	var correct_answer_msg = sqb_correct_msg(parent_ques_div, sqb_quiz_container_outer_id);
	var incorrect_answer_msg = sqb_incorrect_msg(parent_ques_div, sqb_quiz_container_outer_id);
	 
	//check if show correct incorrect answer or next question			 
	var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();		
	var parent_hasClass =  jQuery("#"+parent_ques_div).hasClass('multiple_correct_cls');
	var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container #sqb_quiz_type').val(); 
 	
	if(parent_hasClass == true){ // for multiple correct answer
		var hascorrect_count = jQuery("#"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls").length;
		var hascorrect_checkbox_count = jQuery("#"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls .checkbox_fe:checked").length;	
		//if quiz_type assessment
		if(sqb_quiz_type =="assessment"){
			if(hascorrect_count == hascorrect_checkbox_count){				 
				var correct_ans_count = parseInt(correct_ans_count) + 1;						 
				jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(correct_ans_count);											
			}
		}else if(sqb_quiz_type =="scoring"){ //condition for quiz_type = scoring		
			//condition for quiz_type = scoring				 
			var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(); 	
			var points_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(); 			 
			if(hascorrect_count == hascorrect_checkbox_count){
				var data_point = jQuery(this).attr("data-point");				 
				var sqb_points_ans = parseInt(data_point)+ parseInt(sqb_points_ans);
				jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(sqb_points_ans); 	
				var get_max_points_count = getmaxDataPoints(displayquesid, sqb_quiz_container_outer_id) ;
				var points_count = parseInt(get_max_points_count)+ parseInt(points_count);
				jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(points_count);					
			}	
		}						 
					
	}else{ // for single correct answer
			
		var hasaddselected = jQuery("#"+parent_ques_div+" .correct_ans_cls").hasClass('addselected');
		//if quiz_type assessment
		if(sqb_quiz_type =="assessment"){
			if(hasaddselected == true){						 
				var correct_ans_count = parseInt(correct_ans_count) + 1;						 
				jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(correct_ans_count);									
			}
		}else if(sqb_quiz_type =="scoring"){		  
			//condition for quiz_type = scoring				 
			var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(); 	
			var points_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(); 			 
			if(hasaddselected == true){	
				var data_point = jQuery(this).attr("data-point");				 
				var sqb_points_ans = parseInt(data_point)+ parseInt(sqb_points_ans);
				jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(sqb_points_ans); 	
				var get_max_points_count = getmaxDataPoints(displayquesid, sqb_quiz_container_outer_id) ;
				var points_count = parseInt(get_max_points_count)+ parseInt(points_count);
				jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(points_count);		
					
			}			
		}	
	}		
 
	
	// enter data in question and answer table
	var ans_select_obj = jQuery('#'+parent_ques_div).find('.sqb_ans_selected');
	var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+ ' input#quiz_id').val();
	var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
	var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');
	var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');

	if (typeof sqb_question_id === "undefined" || (sqb_question_id == 0)){
		sqb_question_id = jQuery('#'+parent_ques_div).find('.single_cls').attr('data-question-id');
		sqb_answer_id = 0;
		sqb_outcome_id = 0;
	}

	sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
	sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);
	 
} 
//email validation
function sqbValidateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( email );
}

//which answer has max points
function getmaxDataPoints(ques_id, sqb_quiz_container_outer_id) {
	var data_points_array = [];		   
	 jQuery('#'+sqb_quiz_container_outer_id+ ' #'+ques_id+ ' .sqb_ans_item_outer').each(function(){
		var data_points = jQuery(this).attr("data-point");	
		data_points_array.push(data_points);	 
	});		 
	var max_points = Math.max.apply(Math,data_points_array); // Math.max(data_points_array);	 
	return max_points;	
}

function getmaxDataPointsForMatchingType(ques_id, sqb_quiz_container_outer_id) {
	var data_points_array = [];		
	var points = 0;   
	 jQuery('#'+sqb_quiz_container_outer_id+ ' #'+ques_id+ ' .sqb_ans_item_outer .sqb_input_ans_field .sqb-match-box').each(function(){
		var data_points = jQuery(this).attr("data-point");	
		points = parseInt(points) + parseInt(data_points);
		//data_points_array.push(data_points);	 
	});		 
	//var max_points = Math.max.apply(Math,data_points_array); // Math.max(data_points_array);	 
	return points;	
}

//which 	
function show_optin_form(sqb_quiz_container_outer_id) {		
	 var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
	 var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
	 if(show_optin =="N"){ 	
	 	var show_analyzing_result_time = jQuery("#"+sqb_quiz_container_outer_id+ "  #show_analyzing_time_delay").val();
	 		 
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
			}else{
				outcomeRedirectCallBeforeReister(sqb_quiz_container_outer_id);
			}
				
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
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() == 'all'){
				if(jQuery( '#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').is(':hidden') && jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() == 'all') {
                    jQuery('html, body').animate({
                        scrollTop: jQuery( '#'+sqb_quiz_container_outer_id).offset().top - 120
                     }, "slow");
                }else{
					jQuery('html, body').animate({
					   scrollTop: jQuery( '#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').offset().top - 120
					}, "slow");
				}
			}
			
			 
		}, 900); 

		//}, show_analyzing_result_time+'000');
		  var temp_wid2 = jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_result_template_outer  .quiz_comon_template ").css("max-width");
			if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6' && jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template8'){		
			jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_result_template_outer  .Quiz-Template.show_cls").css("max-width",temp_wid2);	
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("max-width",temp_wid2); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("width",temp_wid2);
			}	
		 
		//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer', sqb_quiz_container_outer_id); 
		
		 		
	 }else{
		//alert();		
		if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() == 'optin-after-questions-screen'){
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
					show_analyzing_result_screen(sqb_quiz_container_outer_id) ;
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
				autoSubmitOptin(sqb_quiz_container_outer_id);
				//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
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
						
						/*if((jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation').val() == 'Y') && (jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation_option').val() == 'tb')){ 
							
						}else{	
							quizScrollToDivTop('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer');
						} 	*/

						
						/*if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation').val() == 'Y'){ 	
							if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation_option').val() != 'tb'){ 	
								quizScrollToDivTop('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer');
							}
						}*/
					}
				}
			}


			// personality calculator survey

			// not for assesment scoring 

			if(sqb_quiz_type == 'personality' || sqb_quiz_type == 'calculator' || sqb_quiz_type == 'survey'){
				var outcome_id = jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_final").val();
				var outcome_names = jQuery('#outcome_id_'+outcome_id).find('#outcome_name').val();
				if(outcome_names == undefined){
					var outcome_name = '';
				}else{
					var outcome_name = outcome_names;
				}

				if (jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").length  > 0) {
					jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template .Quiz-Template-title").html(jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template .Quiz-Template-title").html().replace('%%OUTCOME_TITLE%%', outcome_name));
					jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template .sqb_opt_in_h6").html(jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template .sqb_opt_in_h6").html().replace('%%OUTCOME_TITLE%%', outcome_name));
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

//which answer has max points
function getMultipleAnswerIds(parent_ques_div, sqb_quiz_container_outer_id) { 
	var ansid_array = [];
	jQuery.each( jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer input.sqb_and_field:checked"), function(){
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
	
//which answer has max points
function getMultipleChoicePoints(parent_ques_div, sqb_quiz_container_outer_id) { 
	var ansid_array = [];
	jQuery.each( jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer input.sqb_and_field:checked"), function(){
		ansid_array.push(jQuery(this).attr("data-id"));
	});
	var sqb_answer_id  =  ansid_array.join(",");
	return sqb_answer_id; 	
}		

	
function sqb_checkbox_count_increase(parent_ques_div, sqb_quiz_container_outer_id){
	 
	var quiz_pagination =jQuery("#"+sqb_quiz_container_outer_id+ " #quiz_pagination").val(); 	
	if(quiz_pagination == "all"){
		var parent_hasClass = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).hasClass('multiple_correct_cls');
		var firsttimechecked =  jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).hasClass('firsttimechecked');		 
		if(firsttimechecked == true){ 
		}else{
			if(parent_hasClass == true){ // for multiple correct answer
				jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).addClass('firsttimechecked'); 
					// progressbar
					sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
				
			} 
		} 
	}
	 
} 
//calculate points and correct answer for all the question, if lesson id is there
function sqb_calculate_result(sqb_quiz_container_outer_id){	

	var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
	var points_count =  jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val();
	var sqb_correct_ans =  jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();
	var total_ques =  jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val();
	 
	 jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){
		if( jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder').hasClass('enable_branching_quiz')){
			if( jQuery(this).find('.sqb_ans_selected').length == 0){	
				 return true;  
			}
		}
		var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='quiz_id']").val();				 
		var sqb_ans_correct_cls = jQuery(this).find(".sqb_ans_item_outer").hasClass("correct_ans_cls");						 
		var sqb_ans_selected_cls = jQuery(this).find(".sqb_ans_item_outer.correct_ans_cls").hasClass("sqb_ans_selected");
		
		var parent_ques_div =  jQuery(this).closest(".question_container").attr('id');	
		var parent_hasClass =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls'); 						 
		//if quiz type is assessment
		if(sqb_quiz_id =="assessment"){
			if(parent_hasClass == true){
				var hascorrect_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls").length;
				var hascorrect_checkbox_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls .checkbox_fe:checked").length;
				var total_checked = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer .checkbox_fe:checked").length;
				if(hascorrect_count == hascorrect_checkbox_count && total_checked == hascorrect_checkbox_count){				 
					var correct_ans_count = parseInt(correct_ans_count) + 1;						 
					jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_correct_ans").val(correct_ans_count);			  						
				}
				
			}else{
				if(sqb_ans_correct_cls == sqb_ans_selected_cls){			 
					var correct_ans_count = parseInt(correct_ans_count) + 1;						 
					jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_correct_ans").val(correct_ans_count);
				}
			}				 
		}		
		
		//if quiz type is scoring
		if(sqb_quiz_id =="scoring"){
			
			if(parent_hasClass == true){
				var hascorrect_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls").length;
				var hascorrect_checkbox_count = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer.correct_ans_cls .checkbox_fe:checked").length;
				var total_checked = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+"  .sqb_ans_item_outer .checkbox_fe:checked").length;
				/*if(hascorrect_count == hascorrect_checkbox_count && total_checked == hascorrect_checkbox_count){						
				}*/
				var data_point = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer.sqb_ans_selected").attr("data-point");						 
				var sqb_points_ans = parseInt(data_point)+ parseInt(sqb_points_ans);					 
				jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_points_ans").val(sqb_points_ans); 			 
				var get_max_points_count = getmaxDataPoints(parent_ques_div) ;
				var points_count = parseInt(get_max_points_count)+ parseInt(points_count);
				jQuery("#"+sqb_quiz_container_outer_id+ " #points_count").val(points_count);
				
			}else{
				if(sqb_ans_correct_cls == sqb_ans_selected_cls){			 
					var correct_ans_count = parseInt(correct_ans_count) + 1;						 
					jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_correct_ans").val(correct_ans_count); 
				}
				var data_point = jQuery("#"+parent_ques_div+" .sqb_ans_item_outer.sqb_ans_selected").attr("data-point");				 
				var sqb_points_ans = parseInt(data_point)+ parseInt(sqb_points_ans);
				jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_points_ans").val(sqb_points_ans); 
				
				var get_max_points_count = getmaxDataPoints(parent_ques_div) ;
				var points_count = parseInt(get_max_points_count)+ parseInt(points_count);
				jQuery("#"+sqb_quiz_container_outer_id+ " #points_count").val(points_count);
			}
		}				 
		
	});		 
	  
}

// enable the_markas_complete button
function unlocking_markas_complete(sqb_quiz_container_outer_id){
	var showquiz = false; 
	var quiz_blocking =jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_blocking').val(); 	
	var quiz_passmark =jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_passmark').val(); 	
	var pass_criteria =jQuery('#'+sqb_quiz_container_outer_id+ ' #pass_criteria').val(); 	
	var sqb_quiz_type =jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val(); 	
	if(quiz_blocking == "Y"){
		if(pass_criteria == "pass"){
			
			if(sqb_quiz_type == "assessment" || sqb_quiz_type == "scoring" ){
				if(sqb_quiz_type == "assessment"){
					var sqb_correct_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();
					var total_ques = jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val(); 	 
					var final_val = parseFloat(parseInt(sqb_correct_ans, 10) * 100) / parseInt(total_ques, 10);					 
				}
				if(sqb_quiz_type == "scoring"){
					var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
					var points_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val();
					var final_val = parseFloat(parseInt(sqb_points_ans, 10) * 100) / parseInt(points_count, 10);
				} 
				var gotmarks_percentage = (Math.round(final_val * 100) / 100).toFixed(0); 
				 
				if(parseInt(quiz_passmark) <= parseInt(gotmarks_percentage)){					 
					var showquiz = true;	
				}else{					 
					var showquiz = false;	
				} 	
			}else{ //else	 pass_criteria
				var showquiz = true;	
			} 
					
		}else{	 //else	 pass_criteria
			var showquiz = true;			
		}		
	}else{	//else	 quiz_blocking
		var showquiz = true;
	} 
	 
	if(showquiz == true){
		jQuery(".markas_completed_btn").removeClass('disableMarkBtn');  
		
	}else{		 
		jQuery(".not_passed_quiz_msg_outer").remove();  
		jQuery(".markas_completed_btn").addClass('disableMarkBtn');  
		var markedAsCompleted = jQuery(".markedAsCompleted").val();
		if(markedAsCompleted != 'Y'){
			var not_passed_quiz_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #not_passed_quiz_msg').val();				
			jQuery('#'+sqb_quiz_container_outer_id+"  .quiz_quesans_template_outer .Quiz-Template-overflow " ).after('<div class="not_passed_quiz_msg_outer" style="display: inline-block;">'+not_passed_quiz_msg+'</div>');
		}
	}
			 
} 

// enable the_markas_complete button
function unlocking_markas_complete_onpageload(){
	var showquiz = false; 
	var quiz_blocking =jQuery('#quiz_blocking').val(); 	
	var quiz_passmark =jQuery('#quiz_passmark').val(); 	
	var pass_criteria =jQuery('#pass_criteria').val(); 	
	var sqb_quiz_type =jQuery('#sqb_quiz_type').val(); 
	var lesson_id =jQuery('#lesson_id').val();
	var count_manage_lead_data = jQuery('#count_manage_lead_data').val();
	 
	lesson_id = jQuery.isNumeric(lesson_id);						 			
	if( lesson_id !="" && lesson_id == true){		
		if(quiz_blocking == "Y"){
			if(pass_criteria == "pass"){
				if(count_manage_lead_data >0 ){					
					
					if(sqb_quiz_type == "assessment" || sqb_quiz_type == "scoring" ){
						if(sqb_quiz_type == "assessment"){
							var sqb_correct_ans = jQuery('#sqb_correct_ans').val();
							var total_ques = jQuery("#ques_count").val(); 	 
							var final_val = parseFloat(parseInt(sqb_correct_ans, 10) * 100) / parseInt(total_ques, 10);					 
						}
						if(sqb_quiz_type == "scoring"){
							var sqb_points_ans = jQuery('#sqb_points_ans').val();
							var points_count = jQuery('#points_count').val();
							var final_val = parseFloat(parseInt(sqb_points_ans, 10) * 100) / parseInt(points_count, 10);
						} 
						var gotmarks_percentage = (Math.round(final_val * 100) / 100).toFixed(0); 
						if(quiz_passmark < gotmarks_percentage){
							var showquiz = true;	
						}else{
							var showquiz = false;	
						} 	
					}else{ //else	 pass_criteria
						var showquiz = true;	
					}
				}else{
					var showquiz = false;
				}
						
			}else{	 //else	 pass_criteria
				if(count_manage_lead_data >0 ){	
					var showquiz = true;	
				}else{
					var showquiz = false;
				}		
			}		
		}else{	//else	 quiz_blocking
			var showquiz = true;
		}
		
		if(showquiz == true){
			jQuery(".markas_completed_btn").removeClass('disableMarkBtn');  
		}else{
			jQuery(".markas_completed_btn").addClass('disableMarkBtn');  
		}
	}
			 
} 
 
//disable ques anslesson
function enable_see_detail(sqb_quiz_container_outer_id, notcount=''){   
	 
	var quiz_pagination =jQuery("#"+sqb_quiz_container_outer_id+ " #quiz_pagination").val(); 
	jQuery('#'+sqb_quiz_container_outer_id+ ' .buttondata_outer.multiple_ques_true .dap_see_details_btn').removeClass('btn_disabled');	
	if(notcount =="notcount"){
		jQuery('#'+sqb_quiz_container_outer_id+ ' .dap_see_details_btn ').trigger("click");		
		jQuery('.lesson_container_outer .quiz_quesans_template_outer .single_next_btn  ').addClass("btn_disabled");				 
		/*jQuery('html, body').animate({
		   scrollTop: jQuery( "#"+sqb_quiz_container_outer_id+ "  .dap_see_details_btn ").offset().top 
		}, "slow"); */ 
		 	
	}else{
		if(quiz_pagination != "all"){ 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .dap_see_details_btn ').trigger("click");		
		} 
	} 
	
	var dap_login_email_id = jQuery('#'+sqb_quiz_container_outer_id).find('#dap_login_email_id').val();
	if(dap_login_email_id != undefined){
	  var dap_login_first_name = jQuery('#'+sqb_quiz_container_outer_id).find('#dap_login_first_name').val();
	  sqbUserSendMail(sqb_quiz_container_outer_id, dap_login_first_name , dap_login_email_id , '')
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
		sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_last_question_btn_click');
	}
}

 
function sqbUserSendMail(sqb_quiz_container_outer_id, first_name , email , btn_click, sqb_action = ''){	 	 
	 
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ "  input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();	
	

	 
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

	var register_way = jQuery('#'+sqb_quiz_container_outer_id+ ' #register_way').val();	
	var signup_way = jQuery('#'+sqb_quiz_container_outer_id+ ' #signup_way').val();	
	if(sqb_action == 'only_mail_send'){
		signup_way = 'DAP';
	}
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
	jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_question_answer_hidden').each(function(){
		var ques_id = jQuery(this).data('id');	
		var answer_id = jQuery(this).data('key'); 	
		var correct_ans = jQuery(this).data('correct');	
		 
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
			var other_field =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected .custom-other-box").val();
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
				'other_field':other_field,
		});			
	}); 
 	  
 	var outcome_final=  jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val();
	var outcome_desc =  jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer #outcome_id_'+outcome_final+' #result_temp_contentid').html();
	

	var outcome_desc_old =  jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer #outcome_id_'+outcome_final+' #result_temp_contentid').html();
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_hidden').html(outcome_desc_old);
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_hidden img').each(function(){
			jQuery(this).remove() ;
	});
	var outcome_desc = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_hidden').html();
	var double_optin  = jQuery('#'+sqb_quiz_container_outer_id).find("#double_optin").val();
	//added for the backend preview	
	var SQBPreview = jQuery('#SQBPreview').val();
	if(SQBPreview =="Y"){
		return false;
	}
	
	var sqb_quiz_category_enable = jQuery('#'+sqb_quiz_container_outer_id).find('input[name="sqb_quiz_category_enable"]').val();  
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
		var category_number_percent	 = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+outcomeid+' .category_number_percent').html();
		var category_number_div= jQuery('#'+sqb_quiz_container_outer_id+ ' #'+outcomeid+' .category_number_div').html();
	}
	
		//register   user ajax  
		jQuery.ajax({	 
			url: ajaxurl,	 
			type: "POST",
			//	async: true,
			//async: false,
			data: {
				action: 'SQBAddUserAjax',
				//form_data : form_data
				first_name: first_name,
				email: email ,		 
				register_way: register_way ,		 
				productId: productId ,	
				signup_way: signup_way ,	
				quizId: quizId ,	
				outcome_final: outcome_final ,	
				sqb_question_answer_array: sqb_question_answer_array ,	
				outcome_ids_array:outcome_ids_array,
				outcome_desc:outcome_desc,
				double_optin:encodeURIComponent(double_optin),
			},
			success: function (response) {	
				 
				response = JSON.parse(response);	
				 	 
				
				sqb_send_email_notifications(first_name ,email ,register_way ,productId ,signup_way,quizId ,sqb_quiz_type ,	outcome_final,sqb_question_answer_array ,outcome_ids_array,	outcome_desc,'',	category_result_list_array, '' ,	'' ,catdata ,category_number_percent ,category_number_div ,'','','');
				
				
			}
		});
	 
}


//enableNextButtonForLesson
function enableNextButtonForLesson(parent_ques_div, sqb_quiz_container_outer_id){
	/*jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_next_btn').addClass('btn_disabled');
	jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .sqb_next_btn').removeClass('btn_disabled');*/
}

function lesson_show_hide_retake(sqb_quiz_container_outer_id){
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer  .reake_data_outer ').hide(); 
	if(jQuery('#'+sqb_quiz_container_outer_id+' .quiz_result_template_outer .reake_data_outer ').length <1){		
		var retakehtml = jQuery('#'+sqb_quiz_container_outer_id+' .quiz_quesans_template_outer .reake_data_outer ').html();		
		  
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .result_temp_outer ').append('<div class="reake_data_outer retake_data_outer_reload" style="display:block">'+retakehtml+'</div>');	
	} 
}
function lesson_quiz_pagination(sqb_quiz_container_outer_id, quiz_pagination){
	if(quiz_pagination !="all"){		 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .reake_data_outer ').hide();			 
		lesson_show_hide_retake(sqb_quiz_container_outer_id);		
	}else{
		jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass("question_container_disabled1"); 
	}
}
function  lesson_quiz_pagination_show_result(sqb_quiz_container_outer_id , sqb_retake){	
	
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
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer1 ').show();	 
}

function disable_ques_ans_lesson(sqb_quiz_container_outer_id){
	 
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
			   //jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer ').css("display","block");  
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer  ').css("display","none"); 
		  }else{  
			 jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer ').css("display","none");  
			 jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer  ').css("display","block");  
		  }
			jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){
				
				lesson_quiz_pagination(sqb_quiz_container_outer_id ,quiz_pagination);
				
				//set the textarea and fill_in_the_blank values
				var fill_in_blank_cls =   jQuery(this).find(" .sqb_ans_item_outer").hasClass('fill_in_blank_cls'); 
				var text_cls = jQuery(this).find(" .sqb_ans_item_outer").hasClass('text_cls'); 
				var slider_cls = jQuery(this).find(" .sqb_ans_item_outer").hasClass('slider_cls'); 
				if(fill_in_blank_cls ==true){							 
					var picked_answer_text = jQuery(this).find(".picked_answer_text").val();								 					
					jQuery(this).find(".fill_in_blank_cls .sqb_ans_item .sqb_and_field").val(picked_answer_text);								 					
				}else if(text_cls ==true){								 
					var picked_answer_text = jQuery(this).find(".picked_answer_text").val();
					jQuery(this).find(".text_cls .sqb_ans_item .sqb_and_field").val(picked_answer_text);												 	
				}else if(slider_cls ==true){								 
					var picked_answer_text = jQuery(this).find(".slider.sqb_ans_slider").val();
																 	
				}else{} 				
			});

			
			if( sqb_retake == "n"  ){	 
					//add disable tclass to answers, after they click  on button		    
				  jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){
						jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').removeClass("question_container_disabled");
						lesson_quiz_pagination(sqb_quiz_container_outer_id , quiz_pagination);		 						 
				   });
				  
			 }else{  
				 jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_retake').val("y");
				 
				//jQuery('#'+sqb_quiz_container_outer_id+ ' .buttondata_outer.multiple_ques_true .dap_see_details_btn').addClass('btn_disabled');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){
					//jQuery('#'+sqb_quiz_container_outer_id+ ' .answer_container').removeClass("answer_container_disabled1");  
					jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').removeClass("question_container_disabled"); 
				 
					lesson_quiz_pagination(sqb_quiz_container_outer_id , quiz_pagination);			
									
					jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_ans_item_outer').removeClass("sqb_ans_selected"); 
					jQuery('#'+sqb_quiz_container_outer_id+ ' .multiple_correct_checkbox .checkbox_fe').prop('checked', false);  
			     });
				
			 }
			if(quiz_pagination !="all"){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .dap_see_details_btn ').hide();	 
			  lesson_quiz_pagination_show_result(sqb_quiz_container_outer_id , sqb_retake);
			}
		 }else{
			 
			 jQuery('#'+sqb_quiz_container_outer_id+ ' .retake_button').addClass('btn_disabled');
			 jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass("question_container_disabled"); 
					 
					//lesson_quiz_pagination(sqb_quiz_container_outer_id , quiz_pagination);
					jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').first().removeClass("question_container_disabled"); 					
					 jQuery('#'+sqb_quiz_container_outer_id+ ' .buttondata_outer.multiple_ques_true .dap_see_details_btn').addClass('btn_disabled');
			  });
			   
		 }
	}
}




function sqb_all_question_view_insert(element_id = ''){
	
	   if(element_id != ''){
			var obj = jQuery('#'+element_id);
			if((jQuery(obj).find('#lesson_id').val() != '')){
				var quiz_id = jQuery(obj).find('#quiz_id').val();
				jQuery(obj).find('.question_container').each(function(){
					var question_id = jQuery(this).attr('data-question-id');
					
					sqb_save_question_answer_report(quiz_id,question_id,0,0,element_id,'only_question');
					
				});
			}
	}
}



function nextbutton_calculation_lesson(sqb_quiz_container_outer_id, parent_ques_div){
	 
		jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_quiz_next_button_click").val(0); 
		var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container #sqb_quiz_type').val();
		display_correctans_options = "no";
		
		var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val(); if(quiz_pagination != "all"){
				jQuery("#"+sqb_quiz_container_outer_id+ " .question_container ").removeClass("question_container_disabled");
			}else{
				jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).addClass("question_container_disabled");
			}
			  
		// progressbar
			sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
		 // enter data in question and answer table
			var ans_select_obj = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected');
			var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+  ' input#quiz_id').val();
			var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
			var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');
			var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');

			if (typeof sqb_question_id === "undefined" || (sqb_question_id == 0)){
				sqb_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.single_cls').attr('data-question-id');
				sqb_answer_id = 0;
				sqb_outcome_id = 0;
			}
			 
		
			var parent_hasClass =  jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).hasClass('multiple_correct_cls');
			if(parent_hasClass == true){
				 
				var sqb_answer_id  = getMultipleAnswerIds(parent_ques_div, sqb_quiz_container_outer_id);	
			} 
			
			sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
			sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
			sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);	
			
			//if  quiz_type is personality
		if(sqb_quiz_type =="personality"){
			 
			jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+' .answer_container ').removeClass("answer_container_disabled");
			 
			 //scroll to next question
			var next_questionid_outer =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).closest('.Quiz-Template').next().attr('data-question-id');			 
			var next_questionid =   "question_id_"+next_questionid_outer;
			var display_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .question_container').last().attr('id');					 			 
			if(display_lastchild != parent_ques_div){					 
				sqbScrollToNextQuestion(next_questionid, sqb_quiz_container_outer_id, next_questionid_outer); 
				//enableNextButtonForLesson(next_questionid, sqb_quiz_container_outer_id); 						  
			}else{
				enable_see_detail(sqb_quiz_container_outer_id);
			}
							
				 
				
		} else if(sqb_quiz_type =="assessment"){	 //if  quiz_type is assessment	
				
				var hascorrect_ans = jQuery("#"+parent_ques_div+" .correct_ans_cls").hasClass('addselected');		
				//jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).addClass("question_container_disabled");			 
				//correct ans calculations
				/*if(hascorrect_ans == true){				 
					var correct_ans_count = parseInt(correct_ans_count) + 1;						 
					jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val(correct_ans_count); 		 
				}	*/		
			 		 	
				 //scroll to next question
				var next_questionid_outer =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).closest('.Quiz-Template').next().attr('data-question-id');	 
				var next_questionid =   "question_id_"+next_questionid_outer;
				var display_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .question_container').last().attr('id');					 			 
				if(display_lastchild != parent_ques_div){					 
					sqbScrollToNextQuestion(next_questionid, sqb_quiz_container_outer_id, next_questionid_outer);  
					//enableNextButtonForLesson(next_questionid, sqb_quiz_container_outer_id);						  
				}else{
					enable_see_detail(sqb_quiz_container_outer_id);
				}
				 
				 
				
			} else if(sqb_quiz_type =="scoring"){	 //if  quiz_type is scoring		
				 
				//jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).addClass("question_container_disabled");			 
				//correct ans calculations				 	 
				/*var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(); 	
				var points_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(); 	
				var hasaddselected = jQuery("#"+parent_ques_div+" .sqb_ans_item_outer").hasClass('addselected');
				if(hasaddselected == true){	
					var data_point = jQuery(this).attr("data-point");				 
					var sqb_points_ans = parseInt(data_point)+ parseInt(sqb_points_ans);
					jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val(sqb_points_ans); 	
					var get_max_points_count = getmaxDataPoints(parent_ques_div, sqb_quiz_container_outer_id) ;
					var points_count = parseInt(get_max_points_count)+ parseInt(points_count);
					jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(points_count);							
				} 	*/
							
				 //scroll to next question
				var next_questionid_outer =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).closest('.Quiz-Template').next().attr('data-question-id');			 
				var next_questionid =   "question_id_"+next_questionid_outer;	
				var display_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .question_container').last().attr('id');	
				 				 			 
				if(display_lastchild != parent_ques_div){					 
					sqbScrollToNextQuestion(next_questionid, sqb_quiz_container_outer_id, next_questionid_outer);  	
					//enableNextButtonForLesson(next_questionid, sqb_quiz_container_outer_id);			  
				}else{
					enable_see_detail(sqb_quiz_container_outer_id);
				}
				 
			 
			}else{	 
					
				 
				//jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).addClass("question_container_disabled");
				 
				 //scroll to next question
				var next_questionid_outer =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).closest('.Quiz-Template').next().attr('data-question-id');			 
				var next_questionid =   "question_id_"+next_questionid_outer;		 
				var display_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .question_container').last().attr('id');					 			 
				if(display_lastchild != parent_ques_div){					 
					sqbScrollToNextQuestion(next_questionid, sqb_quiz_container_outer_id, next_questionid_outer);  
					//enableNextButtonForLesson(next_questionid, sqb_quiz_container_outer_id);					  
				}else{
					enable_see_detail(sqb_quiz_container_outer_id);
				}
				
		}
		
		
							
	}

function show_all_questions_in_one_page(sqb_quiz_container_outer_id, parent_ques_div){
	 
		jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_quiz_next_button_click").val(0); 
		var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_quiz_container #sqb_quiz_type').val();
		display_correctans_options = "no";
		var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val(); 
		if(quiz_pagination != "all"){
				jQuery("#"+sqb_quiz_container_outer_id+ " .question_container ").removeClass("question_container_disabled");
			}else{
				jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).addClass("question_container_disabled");
			}
			  
		// progressbar
			//sqbProgressBar(sqb_quiz_container_outer_id, "#"+parent_ques_div);
		 
			//if  quiz_type is personality
		if(sqb_quiz_type =="personality"){
			 
			jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+' .answer_container ').removeClass("answer_container_disabled");
			 
			 //scroll to next question
			var next_questionid_outer =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).closest('.Quiz-Template').next().attr('data-question-id');			 
			var next_questionid =   "question_id_"+next_questionid_outer;
			var display_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .question_container').last().attr('id');					 			 
			if(display_lastchild != parent_ques_div){					 
				sqbScrollToNextQuestion(next_questionid, sqb_quiz_container_outer_id, next_questionid_outer); 
			}else{
				personality_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div );
			}
								
		} else if(sqb_quiz_type =="assessment"){//if  quiz_type is assessment	
				var hascorrect_ans = jQuery("#"+parent_ques_div+" .correct_ans_cls").hasClass('addselected');
				//scroll to next question
				var next_questionid_outer =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).closest('.Quiz-Template').next().attr('data-question-id');	 
				var next_questionid =   "question_id_"+next_questionid_outer;
				var display_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .question_container').last().attr('id');					 			 
				if(display_lastchild != parent_ques_div){					 
					sqbScrollToNextQuestion(next_questionid, sqb_quiz_container_outer_id, next_questionid_outer);
					}else{
					assessment_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div ) ;
				}
			} else if(sqb_quiz_type =="scoring"){	 //if  quiz_type is scoring					
				//scroll to next question
				var next_questionid_outer =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).closest('.Quiz-Template').next().attr('data-question-id');			 
				var next_questionid =   "question_id_"+next_questionid_outer;	
				var display_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .question_container').last().attr('id');	
				 				 			 
				if(display_lastchild != parent_ques_div){					 
					sqbScrollToNextQuestion(next_questionid, sqb_quiz_container_outer_id, next_questionid_outer);  	
								  
				}else{
					//enable_see_detail(sqb_quiz_container_outer_id);
					scoring_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div ) ;
				}
			} else if(sqb_quiz_type =="calculator"){	
				//scroll to next question
				var next_questionid_outer =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).closest('.Quiz-Template').next().attr('data-question-id');			 
				var next_questionid =   "question_id_"+next_questionid_outer;	
				var display_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .question_container').last().attr('id');	
				 				 			 
				if(display_lastchild != parent_ques_div){					 
					sqbScrollToNextQuestion(next_questionid, sqb_quiz_container_outer_id, next_questionid_outer);  	
								  
				}else{
					//enable_see_detail(sqb_quiz_container_outer_id);
					calculator_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div ) ;
				}	 
			}else{	 
				//scroll to next question
				var next_questionid_outer =   jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).closest('.Quiz-Template').next().attr('data-question-id');			 
				var next_questionid =   "question_id_"+next_questionid_outer;		 
				var display_lastchild =  jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .question_container').last().attr('id');					 			 
				if(display_lastchild != parent_ques_div){					 
					sqbScrollToNextQuestion(next_questionid, sqb_quiz_container_outer_id, next_questionid_outer);  
					//enableNextButtonForLesson(next_questionid, sqb_quiz_container_outer_id);					  
				}else{
					//enable_see_detail(sqb_quiz_container_outer_id);
					survey_last_child_calculation(sqb_quiz_container_outer_id,parent_ques_div ) ;
				}	
		}
		
		var parent_hasClass = false;
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
		
		// enter data in question and answer table
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
			 
		
			//var parent_hasClass =  jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div).hasClass('multiple_correct_cls');
			if(parent_hasClass == true){
				 
				var sqb_answer_id  = getMultipleAnswerIds(parent_ques_div, sqb_quiz_container_outer_id);	
			} 
			
			sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
			sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
			sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);						
	}

	function sqb_template5_unselect_answer(){
		jQuery('.Quiz-Template5-right-side .sqb_ans_item_outer .sqb_ans_item').on('click',function(){
			jQuery(this).toggleClass('sqb_ans_selected');
		});
	}
	//sqb_template5_unselect_answer();
	
/****/

function sqbSecondsToDhms(seconds) {
  seconds = Number(seconds);
  var d = Math.floor(seconds / (3600*24));
  var h = Math.floor(seconds % (3600*24) / 3600);
  var m = Math.floor(seconds % 3600 / 60);
  var s = Math.floor(seconds % 60);

 // var dDisplay = d > 0 ? d + (d == 1 ? " day, " : " days, ") : "";
 // var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
  //var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";
  //var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";
  var mDisplay = m > 0 ? m + (m == 1 ? "m " : "m ") : "";
  var sDisplay = s > 0 ? s + (s == 1 ? "s" : "s") : "";
  return  mDisplay + sDisplay;
}
				

 
//for calculator
function sqb_formula_putback_values(sqb_quiz_container_outer_id) {	 
	//formula loop
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .sqb_formula_data').each(function(){		 		
		var data_formula = jQuery(this).attr('data-formula'); 			
		jQuery(this).text(data_formula);		
	});
}	
	 
function sqb_calculator_formula_calculation(sqb_quiz_container_outer_id) {		 
	var formula_mergetag_replace="";	
	var j =1; 	
	 
	//formula loop
	//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer  .sqb_formula_data').each(function(){
	jQuery('#'+sqb_quiz_container_outer_id+ '   .sqb_formula_data').each(function(){
		var sqb_formula_id = jQuery(this).attr('id'); 
		var sqb_formula_data = jQuery(this).text(); //Q1*Q2
		var data_prefix = jQuery(this).attr('data-prefix');	 	 
		var data_sufix = jQuery(this).attr('data-sufix');	
		var data_numtype = jQuery(this).attr('data-numtype');	
		var data_range = jQuery(this).attr('data-range');	
		var data_outcome = jQuery(this).attr('data-outcome');	
		var i =1; 
		var quesformula_value = {};
		//question loop 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_formula_ques_div').each(function(){
			var sqb_points_ans = 0 ;
			var question_wrapper_id = jQuery(this).attr('id');		 
			var quesformula_name = jQuery(this).attr('data-quesformula-name');	//Q1, Q2	 
			
			var has_multiple_cls =  jQuery(this).find('.question_container').hasClass('multiple_correct_cls');				
			var has_slider_cls =  jQuery(this).find('.question_container').hasClass('question_type_slider');				
			var has_numeric_value = jQuery(this).find('.question_container').hasClass('question_type_numerical_text');
			var has_match_text_value = jQuery(this).find('.question_container').hasClass('question_type_matching_text');
			var weight_and_height_cls = jQuery(this).find('.question_container').hasClass('question_type_weight_and_height');
			
			if(has_multiple_cls == true){	//for multiple answer	 
				 //incorrect answer	
				 if( jQuery(this).find('.sqb_ans_selected').length >0){	
					//var data_point = jQuery(this).find('.sqb_ans_selected').attr('data-point');	
					
					var sqb_loop_v_i = 1;
					var  sqb_points_ans = 0;
					jQuery("#"+sqb_quiz_container_outer_id+" #"+question_wrapper_id+ " .sqb_ans_item_outer .checkbox_fe:checked ").each(function(){	 
						var data_point = jQuery(this).closest('.sqb_ans_item_outer').attr('data-point');
						if(typeof data_point != 'undefined' && data_point != '' ){						 
						}else{
							data_point =0;
						}
						sqb_points_ans = parseFloat(data_point)+ parseFloat(sqb_points_ans);
						sqb_loop_v_i++;						 
					});						
					quesformula_value[i] = sqb_points_ans;												 
				}
			}else if(has_slider_cls == true){	//for slider answer	
				if( jQuery(this).find('.sqb_ans_selected').length > 0){							 
					var data_point =  jQuery(this).find('.sqb_ans_slider').val();	
					if(typeof data_point != 'undefined' && data_point != '' ){						 
					}else{
						data_point =0;
					}	 				
					var sqb_points_ans = parseFloat(data_point)+ parseFloat(sqb_points_ans);						
					quesformula_value[i] = sqb_points_ans;	
				}
			}else if(has_numeric_value == true){
				if( jQuery(this).find('.sqb_ans_selected').length > 0){			
					
					if(jQuery(this).find('.sqb_ans_selected').attr('data-point') != 0 && jQuery(this).find('.sqb_ans_selected').attr('data-point') != ''){
						var data_point =  jQuery(this).find('.sqb_ans_selected').attr('data-point');
					}else{
						var data_point =  jQuery(this).find('.sqb_and_field').val();
					}
						
					if(typeof data_point != 'undefined' && data_point != '' ){						 
					}else{
						data_point =0;
					}	 				
					var sqb_points_ans = parseFloat(data_point)+ parseFloat(sqb_points_ans);						
					quesformula_value[i] = sqb_points_ans;	
				}
			}else if(has_match_text_value == true){
				if( jQuery(this).find('.sqb_ans_selected').length > 0){	
				
					var data_point = calculate_match_points(jQuery(this).find('.question_container'));

					if(typeof data_point != 'undefined' && data_point != '' ){						 
					}else{
						data_point =0;
					}	 				
					var sqb_points_ans = parseFloat(data_point)+ parseFloat(sqb_points_ans);						
					quesformula_value[i] = sqb_points_ans;	
				}
			}else if(weight_and_height_cls == true){
				if( jQuery(this).find('.sqb_ans_selected').length > 0){
					
					quesformula_value[i] = getHeightWeightValues(jQuery(this));
					
				}
			}else{				 
				if( jQuery(this).find('.sqb_ans_selected').length > 0){							 
					var data_point =  jQuery(this).find('.sqb_ans_selected').attr('data-point');
					if(typeof data_point != 'undefined' && data_point != '' ){						 
					}else{
						data_point =0;
					}				 				
					var sqb_points_ans = parseFloat(data_point)+ parseFloat(sqb_points_ans);						
					quesformula_value[i] = sqb_points_ans;	
				}			 		
			}
					
			i++;
		});	

		var quesformula_value_reverse = [];
		for (var i = Object.entries(quesformula_value).length; i >= 1; i--) {
			quesformula_value_reverse.push(quesformula_value[i]);
		}

		jQuery.each(quesformula_value_reverse, function(index, value){				
			var length = Object.entries(quesformula_value).length;
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
		sqb_formula_calculation(sqb_formula_data, sqb_formula_id, data_prefix, data_sufix,data_numtype,data_range,data_outcome, sqb_quiz_container_outer_id);
		j++;
	});			
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .sqb_formula_data').each(function(){		 		
		var data_formula = jQuery(this).text();
		if(data_formula == 0){
			jQuery(this).hide();
		}
	});
	 	 
}


function sqbCommaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }
	
//for calculator
function sqb_formula_calculation(expression_val, sqb_formula_id, data_prefix='', data_sufix='',data_numtype = '', data_range = '', data_outcome='', sqb_quiz_container_outer_id='') {		
	   
	const parser = math.parser();  
	var final_res1 = parser.evaluate(expression_val) ;
	if(SQBIsNumeric(final_res1)){
		var final_res = final_res1;
	}else{
		var final_res = final_res1.toFixed(2);
	}
	
	//calculator formula Advanced Rules
	calculatorFormulaAdvancedRules(sqb_quiz_container_outer_id, parseInt(final_res));
	
	if(typeof data_prefix != 'undefined' && data_prefix != '' ){
		final_res = data_prefix+final_res;
	}
	if(typeof data_sufix != 'undefined' && data_sufix != '' ){
		final_res = final_res+data_sufix;
	}
	  
	jQuery('#'+sqb_formula_id).html(sqbCommaSeparateNumber(final_res));
	if(data_numtype=="range"){
		if(typeof data_range != 'undefined' && data_range != '' ){
			var data_range = data_range.split("-");
			var start_range = data_range[0];	
			var end_range = data_range[1];
			if(start_range <= final_res && final_res <= end_range )	{
				if(typeof data_outcome != 'undefined' && data_outcome != '' ){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').hide();  
					jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_id_'+data_outcome).show();  
					jQuery('#calculator_outcome_id').val(data_outcome);
				}
			}
		}
	} else if(data_numtype=="number"){
		if(typeof data_range != 'undefined' && data_range != '' ){
			if(data_range == final_res  )	{
				if(typeof data_outcome != 'undefined' && data_outcome != '' ){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').hide();  
					jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_id_'+data_outcome).show();  
					jQuery('#calculator_outcome_id').val(data_outcome);
				}
			}
		}
	}	 
	var quiz_type = jQuery('#sqb_quiz_type').val();
	if(quiz_type == 'calculator'){
		if(data_outcome == ''){
			data_outcome = jQuery('#'+sqb_quiz_container_outer_id+' .outcome_div:first').attr('data-outcome-id');
		}
		//jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val(data_outcome);
	}
}

function SQBIsNumeric(value) {
    return /^-?\d+$/.test(value);
}

function SQBInt(value) {
	return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
}

function show_analyzing_result_screen(sqb_quiz_container_outer_id) {
		var social_share_screen_value = jQuery('#'+sqb_quiz_container_outer_id+ ' #social_share_screen_value').val(); 
		if(social_share_screen_value == 'Y' && jQuery('#'+sqb_quiz_container_outer_id+' .sqb_social_share_next_btn').hasClass('disable_social_share_next_btn')){
		} else {
			var show_analysing = true;
			var shown_analysing_screen = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_analyzing_template_outer').hasClass('done_screen');
			if(shown_analysing_screen){
			show_analysing = false;
			}
			
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' #show_analyzing_result').val() == 'Y' && show_analysing){
				var show_analyzing_result_time = jQuery("#"+sqb_quiz_container_outer_id+ "  #show_analyzing_time_delay").val();	
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_analyzing_template_outer ').addClass('show_cls').removeClass('hide_cls done_screen'); 
				sqb_show_analyze_screen(sqb_quiz_container_outer_id);		
				setTimeout(function() {	
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_analyzing_template_outer ').addClass('hide_cls done_screen').removeClass('show_cls'); 
					showLoaderForOutcome(sqb_quiz_container_outer_id);
					hideLoaderForOutcome(sqb_quiz_container_outer_id);

					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').addClass('show_cls').removeClass('hide_cls done_screen');		
				}, show_analyzing_result_time+'000');	
			}else{
				var allow_retake = jQuery('#'+sqb_quiz_container_outer_id+ ' #allow_retake').val();
				if(allow_retake == 'N' && social_share_screen_value == 'N'){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').addClass('show_cls').removeClass('hide_cls done_screen');
				} else {
				}	
			}
		}
}

function hideLoaderForOutcome(sqb_quiz_container_outer_id) {
	var charts_settings = decodeURIComponent(jQuery('#'+sqb_quiz_container_outer_id+' #outcome_screen_charts_settings').val());
	var final_charts_settings = charts_settings.split('|');
	if(final_charts_settings[6] == 'Y'){
	var loader_length = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .loader_outcome').length;	
		if(loader_length < 1){
			//var loader_html= '<div class="  loader_outcome" style="display: none;"><div class="sqb_loader_inner"></div></div>';
			//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div:visible .result_temp_outer').before(loader_html);	
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .loader_outcome').hide();
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div .result_temp_outer').show();	
		}
	}	
}

function showLoaderForOutcome(sqb_quiz_container_outer_id) {
	var charts_settings = decodeURIComponent(jQuery('#'+sqb_quiz_container_outer_id+' #outcome_screen_charts_settings').val());
	var final_charts_settings = charts_settings.split('|');
	if(final_charts_settings[6] == 'Y'){
	var loader_length = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .loader_outcome').length;	
		if(loader_length < 1){
			var loader_html= '<div class="  loader_outcome" style="display: none;"><div class="sqb_loader_inner"></div></div>';
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div:visible .result_temp_outer').before(loader_html);	
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .loader_outcome').show();
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div .result_temp_outer').hide();	
		}
	}
}

function hideLoaderForOutcome(sqb_quiz_container_outer_id) {
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .loader_outcome').hide();
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div .result_temp_outer').show();	
}

function removeFontTag() {
	jQuery("font font font font").each(function(){
		if(jQuery(this).length){ 
			jQuery(this).contents().unwrap();
		 }
	})
	jQuery("font font font").each(function(){
		if(jQuery(this).length){ 
			jQuery(this).contents().unwrap();
		 }
	})
	jQuery("font font").each(function(){
		if(jQuery(this).length){ 
			jQuery(this).contents().unwrap();
		 }
	})
	jQuery("font").each(function(){
		if(jQuery(this).length){ 
			jQuery(this).contents().unwrap();
		 }
	})
	
	//added for images not showing in outcome screen because of Lazyload plugin
	jQuery(".quiz_result_template_outer .outcome_div img").each(function(){
		if (jQuery(this).hasClass("jetpack-lazy-image")) {
			jQuery(this).removeClass("jetpack-lazy-image");
			jQuery(this).removeClass("lazyloaded");			
			jQuery(this).removeAttr("data-lazy-src");			
			jQuery(this).removeAttr("srcset");
		}
					
	})
	 
	setTimeout(function(){ 		 
		jQuery(".quiz_result_template_outer .outcome_div img").each(function(){
			if (jQuery(this).hasClass("jetpack-lazy-image")) {
				jQuery(this).removeClass("jetpack-lazy-image");
				jQuery(this).removeClass("lazyloaded");			
				jQuery(this).removeAttr("data-lazy-src");			
				jQuery(this).removeAttr("srcset");
			}	
		})
	}, 2000);	
	//Lazyload fix ends	 
	 
}

function removeFontTagNew() {	 
	
	jQuery(".quiz_quesans_template_outer .sqb_ans_item").each(function(){
		jQuery(this).removeAttr("style");	
	})
	 
}


function sqb_count_string(main_str, sub_str)   {
    main_str += '';
    sub_str += '';

    if (sub_str.length <= 0) 
    {
        return main_str.length + 1;
    }

    subStr = sub_str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    return (main_str.match(new RegExp(subStr, 'gi')) || []).length;
}
 
 
jQuery(window).on('load' , function(){	 
	//added for exit popup for form type quiz
	 sqbfullLoaded();	
	 sqbfullLoadedtimebased(); 
	 sqbfullLoadedpercentagebased(); 
	 sqbfullLoadedentrybased(); 
});


function sqbfullLoadedtimebased(){ 
	var quiz_display = jQuery('.time_based_popup_sqb #quiz_display').val();	
	if(quiz_display == "time_based"){
		jQuery('.time_based_popup_sqb .quiz_start_template_outer').removeClass('show_cls').addClass('hide_cls');
		jQuery('.time_based_popup_sqb .quiz_quesans_template_outer').addClass('hide_cls').removeClass('show_cls');

			var delay_time_basedpopup = jQuery('#getExitPopupValue').val();
			setTimeout(function(){ 
				var show_start_screen =  jQuery(" #show_start_screen").val();	
				var sqb_quiz_container_outer_id =  jQuery(".sqb_quiz_container_outer").attr('id');	
				if(show_start_screen =="Y"){
					jQuery('.time_based_popup_sqb .quiz_start_template_outer').removeClass('hide_cls').addClass('show_cls');	
					sqbAddStartScreen();	
				}else{
					jQuery( '.time_based_popup_sqb .quiz_start_template_outer .take-quiz-btn ').trigger('click');
				}	
			}, delay_time_basedpopup+'000');
	}
}

 
jQuery(window).on("scroll", function(){
	var winheight = jQuery(window).height();
   var docheight = jQuery(document).height();
   var scrollTop = jQuery(window).scrollTop();
   var trackLength = docheight - winheight;
   var pctScrolled = Math.floor(scrollTop/trackLength * 100);
 	var quiz_display = jQuery('.percentage_based_popup_sqb #quiz_display').val();	
	if(quiz_display == "percentage_based"){
		var delay_percentage_basedpopup = jQuery('#getExitPopupValue').val();
		if(pctScrolled > delay_percentage_basedpopup){
			
			var show_start_screen =  jQuery(" #show_start_screen").val();	
			if(show_start_screen =="Y"){
				jQuery('.percentage_based_popup_sqb .quiz_start_template_outer').removeClass('hide_cls').addClass('show_cls');	
				sqbAddStartScreen();
			}else{
				jQuery( '.percentage_based_popup_sqb .quiz_start_template_outer .take-quiz-btn ').trigger('click'); 
			}
			 
		}
 	}
}); 

function sqbfullLoadedpercentagebased(){ 
	var quiz_display = jQuery('.percentage_based_popup_sqb #quiz_display').val();	
	jQuery('.percentage_based_popup_sqb .quiz_quesans_template_outer').addClass('hide_cls').removeClass('show_cls');

	if(quiz_display == "percentage_based"){
		var show_start_screen =  jQuery(" #show_start_screen").val();	
		if(show_start_screen =="Y"){
			jQuery('.percentage_based_popup_sqb .quiz_start_template_outer').removeClass('hide_cls').addClass('show_cls');	
			sqbAddStartScreen();
		}else{
			jQuery( '.percentage_based_popup_sqb .quiz_start_template_outer .take-quiz-btn ').trigger('click'); 
		}
		 
	}
}

function sqbfullLoadedentrybased(){ 
	var quiz_display = jQuery('.entry_popup_sqb #quiz_display').val();	
	if(quiz_display == "entry"){

		setTimeout(function(){ 			 	
			// jQuery( '.quiz_start_template_outer .take-quiz-btn ').trigger('click');
				
				var show_start_screen =  jQuery(" #show_start_screen").val();	
				if(show_start_screen =="Y"){
					jQuery('.entry_popup_sqb .quiz_start_template_outer').removeClass('hide_cls').addClass('show_cls');	
					sqbAddStartScreen();
				}else{
					jQuery( '.entry_popup_sqb .quiz_start_template_outer .take-quiz-btn ').trigger('click');
				}
				 			
		}, 500); 

		jQuery('.entry_popup_sqb .quiz_start_template_outer').removeClass('show_cls').addClass('hide_cls');

	}
}

function sqbAddStartScreen(){ 	
	//added for start screen  show in poupup
	var sqb_quiz_container_outer_id =  jQuery(".sqb_quiz_container_outer").attr('id');	
	var show_start_screen =  jQuery("#"+sqb_quiz_container_outer_id+" #show_start_screen").val();	
	if(show_start_screen =="Y"){
		var sqb_quiz_container_data = jQuery('#'+sqb_quiz_container_outer_id).html();				 
		jQuery('#'+sqb_quiz_container_outer_id).html('');	
			 
		
		jQuery('body').append('<div class="modal_popup_outer" id="pop'+sqb_quiz_container_outer_id+'"><div class="sqb_quiz_container_outer" id="'+sqb_quiz_container_outer_id+'"> '+sqb_quiz_container_data+'</div></div>');	
			 
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_outer_fe').addClass('modal_popup');
		jQuery('.modal_popup_outer').addClass('show');
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_outer_fe').hide();
	} 
			
}


function sqbfullLoaded(){ 
	
	jQuery('.sqb_quiz_container_outer').each(function(){
 		var parent = jQuery(this).attr('id');
		
 		var sqb_quiz_type = jQuery('#'+parent).find('#sqb_quiz_type').val();	
		var quiz_display = jQuery('#'+parent).find('#quiz_display').val();	
		var quiz_id = jQuery('#'+parent).find('#quiz_id').val();	
		var form_quiz_displayed = jQuery('#'+parent).find('#form_quiz_displayed').val();	
		//added for exit popup
		if(quiz_display == "exit" || quiz_display == "corner_popup") {
		//if(sqb_quiz_type =="form" && quiz_display == "popup" && form_quiz_displayed == "exit") {
			//jQuery( '.exit_popup_sqb .quiz_start_template_outer').removeClass('show_cls').addClass('hide_cls');
			
			 
			//sqbAddStartScreen();
			 
			var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
			if (isMobile) { 
				var delay_exitpopup = jQuery('#'+parent).find('#exit_popup_timer').val();	
				if(delay_exitpopup < 1){
					delay_exitpopup ='5';
				}
			 
				setTimeout(function(){ 			 	
					sqbShowPopup(quiz_id);
				}, delay_exitpopup+'000');
				
			}else{ 			
				
				var link_was_clicked = false;
				document.addEventListener("click", function(e) {
				if (e.target.nodeName.toLowerCase() === 'a') {
					link_was_clicked = true;
				}
				}, true);

				/*jQuery(window).on('beforeunload', function(){
					
					if(link_was_clicked) {
						return;
					}
					sqbExitPopupAjax();
					return;				
				});	*/

				document.addEventListener("mouseout", function (e) {
					if (e.pageY < jQuery(window).scrollTop()) {
						sqbExitPopupAjax(parent);
					}
				});	
				
				/*	
				jQuery(window).blur(function() {
					sqbExitPopupAjax();
				});	
				*/	
			}	
		}	
		
		//added for entry popup
		if(sqb_quiz_type =="form" && quiz_display == "popup" && form_quiz_displayed == "entry") {
		//if(quiz_display == "popup") {
			setTimeout(function(){ 			 	
					jQuery('#'+parent).find( '.quiz_start_template_outer .take-quiz-btn ').trigger('click');
			}, 500); 
			
			jQuery('#'+parent).find( ' .quiz_start_template_outer').removeClass('show_cls').addClass('hide_cls');
		}



	});

	
}
 

function sqbExitPopupAjax(parent){
	var ajaxurl = jQuery('#sqb_ajaxurl').val();	
	var quiz_id = jQuery('#quiz_id').val();	
	sqbShowPopup(parent);		 
}

function sqbShowPopup(parent){
	var quiz_display = jQuery('#'+parent).find('#quiz_display').val();	
	if(quiz_display == "exit" ) {
		var exitpopup = jQuery('#'+parent).find( '#exitpopup').val();
		if(exitpopup < 1){
			var show_start_screen =  jQuery('#'+parent).find("#show_start_screen").val();	
			if(show_start_screen =="Y"){
				jQuery('#'+parent).find('.quiz_start_template_outer').removeClass('hide_cls').addClass('show_cls');	
				sqbAddStartScreen();
			}else{
				 
				jQuery('#'+parent).find( '.quiz_start_template_outer .take-quiz-btn ').trigger('click');
			}
			
			jQuery('#'+parent).find('#exitpopup').val('1');

			jQuery('#'+parent).find('.Quiz-Template').each(function(){
	 	
		 		jQuery(this).find('.date-question-type').each(function(){
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
			 	
		 	});
			/*jQuery( '.exit_popup_sqb .quiz_start_template_outer .take-quiz-btn ').trigger('click');
			jQuery( '.exit_popup_sqb #exitpopup').val('1');*/
		}
	}
		 
}
function sqbHideScreensForForm(){	 
	jQuery( '#exitpopup').val('0');
	//added for exit popup 
	var sqb_quiz_type = jQuery('#sqb_quiz_type').val();	
	var quiz_display = jQuery('#quiz_display').val();	
	var form_quiz_displayed = jQuery('#form_quiz_displayed').val();
	
	if(sqb_quiz_type =="form" && quiz_display == "popup" && form_quiz_displayed == "exit") {
		jQuery( ' .quiz_start_template_outer').removeClass('show_cls').addClass('hide_cls');				
		jQuery( ' .quiz_start_template_outer').hide();				
	}  
}  


function calculatorFormulaAdvancedRules(sqb_quiz_container_outer_id, value){	
	  
	var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();		
	var final_formula_val = jQuery('#'+sqb_quiz_container_outer_id+ ' #final_formula_val').val();	
	if( final_formula_val > 0){
		return;
	}	 
	if(sqb_quiz_type =="calculator" ) {
		var founddata = false;  
		if(founddata) {
			   			 
		}else{								
			jQuery('#'+sqb_quiz_container_outer_id+ ' .formula_advanced_rules').each(function(){
				  var datatitle = jQuery(this).attr('data-title');
				  
				  if(datatitle =="number"){
					   var datanum = jQuery(this).attr('data-range');
					   var formulaid = jQuery(this).attr('data-formulaid');							 	 
					   if(datanum >0){				 
						   if(value == datanum){							 
								founddata = true;
								jQuery('#'+sqb_quiz_container_outer_id+ ' #final_formula_val').val(1);	
								var outcome_id = jQuery(this).val();
								jQuery("#"+sqb_quiz_container_outer_id+ " .outcome_div").hide();	
								jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_id_"+outcome_id).show();
								jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val(outcome_id);	
								return false;								
						   }
							
					   }
				  }else if(datatitle =="range"){
					   var datastart = jQuery(this).attr('data-start');
					   var dataend = jQuery(this).attr('data-end');		
						 			    						   
					   if(value >= datastart ){
						   if( value <= dataend){									
							   founddata = true;
							    jQuery('#'+sqb_quiz_container_outer_id+ ' #final_formula_val').val(1);
								var outcome_id = jQuery(this).val();								
								jQuery("#"+sqb_quiz_container_outer_id+ " .outcome_div").hide();	
								jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_id_"+outcome_id).show();	
								jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val(outcome_id);		
								return false;							
						   }
					   }					   
				  }
				  
			});	 		
		}  
	}  
}  


function sqb_display_outcome_data_in_spider_chart(sqb_quiz_container_outer_id, sqb_quiz_id,charts_settings,outcome_id_array){

var sqb_spider_bar_chart_font_weight = '500';	
var sqb_spider_bar_chart_font_size = '14';
var sqb_spider_bar_chart_font_color = '#12c9dd';
var sqb_spider_bar_chart_font_family = "'DM Sans',sans-serif";
var sqb_label_text = 'Total Responses';

var final_charts_settings = charts_settings.split('|');
if(final_charts_settings[9] != ''){
sqb_spider_bar_chart_font_weight = final_charts_settings[9];
}

if(final_charts_settings[10] != ''){
sqb_spider_bar_chart_font_size = final_charts_settings[10];
}

if(final_charts_settings[11] != ''){
sqb_spider_bar_chart_font_color = final_charts_settings[11];
}

if(final_charts_settings[12] != ''){
sqb_spider_bar_chart_font_family = final_charts_settings[12];
}

if(final_charts_settings[14] != ''){
sqb_label_text = final_charts_settings[14];
sqb_label_text = sqb_label_text.replace("+"," ");
}

	
var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
if(isMobile) {
sqb_spider_bar_chart_font_weight = '400';
sqb_spider_bar_chart_font_size = '10';
}
 
if(jQuery('#'+sqb_quiz_container_outer_id+' #spiderChartOutcome').length == 0){
	var loader_html= '<div class="sqb_loader_outer_chart OUTCOME_SPIDER_CHART_loader" style="display: none;"><div class="sqb_loader_inner"></div></div>';
	jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div:visible #result_temp_btnid').before(loader_html+"<div class='ans_in_resultpage_outer sqb_charts_outer_section'><div class='chart-container'><canvas id='spiderChartOutcome'></canvas></div></div>");
}  
		jQuery('#'+sqb_quiz_container_outer_id).find('.OUTCOME_SPIDER_CHART_loader').show();
		var sqb_quiz_category_enable = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_quiz_category_enable').val();
		if(final_charts_settings[15] != '' && final_charts_settings[15] == 'category_based') {
			var response = sqb_display_category_charts(sqb_quiz_container_outer_id);
			jQuery('#'+sqb_quiz_container_outer_id).find('.OUTCOME_SPIDER_CHART_loader').hide();
			sqb_show_spider_chart(sqb_quiz_container_outer_id,response,sqb_label_text,sqb_spider_bar_chart_font_color,sqb_spider_bar_chart_font_family,sqb_spider_bar_chart_font_size,sqb_spider_bar_chart_font_weight,final_charts_settings[15]);
		} else if(final_charts_settings[15] != '' && final_charts_settings[15] == 'outcome_ranking') {
			var chart_type = 'spider_chart';
			sqb_display_outcome_ranking_data(sqb_quiz_container_outer_id,sqb_label_text,sqb_spider_bar_chart_font_color,sqb_spider_bar_chart_font_family,sqb_spider_bar_chart_font_size,sqb_spider_bar_chart_font_weight,outcome_id_array,chart_type,final_charts_settings[15]);
		} else {
			//(final_charts_settings[15] != '' && final_charts_settings[15] == 'outcome_based'){
			var ajaxurl = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_ajaxurl').val();	
			jQuery.ajax({	 
				url: ajaxurl,	 
				type: "POST",
				//	async: true,
				//async: false,
				data: {
					action: 'SQBOutcomeSpiderchartAjax',
					sqb_quiz_id: sqb_quiz_id,
				},
				success: function (response) {	
					jQuery('#'+sqb_quiz_container_outer_id).find('.OUTCOME_SPIDER_CHART_loader').hide();
					response = JSON.parse(response);
					sqb_show_spider_chart(sqb_quiz_container_outer_id,response,sqb_label_text,sqb_spider_bar_chart_font_color,sqb_spider_bar_chart_font_family,sqb_spider_bar_chart_font_size,sqb_spider_bar_chart_font_weight,final_charts_settings[15]);
				}
			});
		}
}

function sqb_display_outcome_data_in_bar_chart(sqb_quiz_container_outer_id, sqb_quiz_id,charts_settings,outcome_id_array){
	
	var sqb_spider_bar_chart_font_weight = '600';	
	var sqb_spider_bar_chart_font_size = '16';
	var sqb_spider_bar_chart_font_color = '#12c9dd';
	var sqb_spider_bar_chart_font_family = "'DM Sans',sans-serif";
	var sqb_label_text = 'Total Responses';
	
	var final_charts_settings = charts_settings.split('|');
	if(final_charts_settings[9] != ''){
	sqb_spider_bar_chart_font_weight = final_charts_settings[9];
	}

	if(final_charts_settings[10] != ''){
	sqb_spider_bar_chart_font_size = final_charts_settings[10];
	}

	if(final_charts_settings[11] != ''){
	sqb_spider_bar_chart_font_color = final_charts_settings[11];
	}

	if(final_charts_settings[12] != ''){
	sqb_spider_bar_chart_font_family = final_charts_settings[12];
	}
	
	if(final_charts_settings[14] != ''){
	sqb_label_text = final_charts_settings[14];
	sqb_label_text = sqb_label_text.replace("+"," ");
	}
	
	var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
	if(isMobile) {
	sqb_spider_bar_chart_font_weight = '400';
	sqb_spider_bar_chart_font_size = '10';
	}				
					
	//jQuery('#'+sqb_quiz_container_outer_id+' #spiderChartOutcome1').closest('.ans_in_resultpage_outer').remove();
	/*if(jQuery('#'+sqb_quiz_container_outer_id+' #spiderChartOutcome1').length < 1){
			var loader_html= '<div class="sqb_loader_outer_chart OUTCOME_BAR_CHART_loader" style="display: none;"><div class="sqb_loader_inner"></div></div>';
			jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div:visible #result_temp_btnid').before(loader_html+"<div class='ans_in_resultpage_outer sqb_charts_outer_section'><div class='chart-container cls1'><canvas id='spiderChartOutcome1'></canvas></div></div>");
	}*/
	
	jQuery('#'+sqb_quiz_container_outer_id).find('.OUTCOME_BAR_CHART_loader').show();
	var sqb_quiz_category_enable = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_quiz_category_enable').val();
	if(final_charts_settings[15] != '' && final_charts_settings[15] == 'category_based') {
			var response = sqb_display_category_charts(sqb_quiz_container_outer_id);
			sqb_show_bar_chart(sqb_quiz_container_outer_id,response,sqb_label_text,sqb_spider_bar_chart_font_color,sqb_spider_bar_chart_font_family,sqb_spider_bar_chart_font_size,sqb_spider_bar_chart_font_weight,final_charts_settings[15]);
	} else if(final_charts_settings[15] != '' && final_charts_settings[15] == 'outcome_ranking') {
			var chart_type = 'bar_chart';
			sqb_display_outcome_ranking_data(sqb_quiz_container_outer_id,sqb_label_text,sqb_spider_bar_chart_font_color,sqb_spider_bar_chart_font_family,sqb_spider_bar_chart_font_size,sqb_spider_bar_chart_font_weight,outcome_id_array,chart_type,final_charts_settings[15]);
	} else {
	//(final_charts_settings[15] != '' && final_charts_settings[15] == 'outcome_based'){
	var ajaxurl = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_ajaxurl').val();
	jQuery.ajax({	 
				url: ajaxurl,	 
				type: "POST",
				//	async: true,
				//async: false,
				data: {
					action: 'SQBOutcomebarchartAjax',
					sqb_quiz_id: sqb_quiz_id,
				},
				success: function (response) {	
					jQuery('#'+sqb_quiz_container_outer_id).find('.OUTCOME_BAR_CHART_loader').hide();
					response = JSON.parse(response);
					sqb_show_bar_chart(sqb_quiz_container_outer_id,response,sqb_label_text,sqb_spider_bar_chart_font_color,sqb_spider_bar_chart_font_family,sqb_spider_bar_chart_font_size,sqb_spider_bar_chart_font_weight,final_charts_settings[15]);	
				}
			});	
	}
}

function sqb_display_outcome_ranking_data(sqb_quiz_container_outer_id,sqb_label_text,sqb_spider_bar_chart_font_color,sqb_spider_bar_chart_font_family,sqb_spider_bar_chart_font_size,sqb_spider_bar_chart_font_weight,outcome_id_array,chart_type,sqb_chart_type){
	 var sqbarray = outcome_id_array;	
	 if(sqbarray.length == 0){
		var outcome_id = jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').attr('data-outcome-id');
		sqbarray.push(outcome_id); 
	 }
	 if(sqbarray.length == 0){
		  var outcome_id = jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').attr('data-outcome-id');
		  //return outcome_id;
	  }else{
            var outcome_ids_count = [];
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
				outcome_ids_count[el] = modeMap[el];
			}
			
			var unique_arr = sqbarray.filter(function(element,index,self){
            return index === self.indexOf(element); 
			});
			var labels = [];
			var count_data = [];
			for(var j = 0; j < unique_arr.length; j++)
			{
			var outcome_id = unique_arr[j];	
			labels[j] = outcome_id;
			count_data[j] = outcome_ids_count[outcome_id];
			}

			var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+' #quiz_id').val();
			var ajaxurl = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_ajaxurl').val();	
			jQuery.ajax({	 
				url: ajaxurl,	 
				type: "POST",
				data: {
					action: 'SQBOutcomeTitleAjax',
					sqb_quiz_id: sqb_quiz_id,
					outcome_ids: labels,
					outcome_count: count_data,
				},
				success: function (response) {	
					response = JSON.parse(response);
					var result = {"labels":response.labels,"data":response.data};
					if(chart_type == 'bar_chart'){
						jQuery('#'+sqb_quiz_container_outer_id).find('.OUTCOME_BAR_CHART_loader').hide();
						sqb_show_bar_chart(sqb_quiz_container_outer_id,result,sqb_label_text,sqb_spider_bar_chart_font_color,sqb_spider_bar_chart_font_family,sqb_spider_bar_chart_font_size,sqb_spider_bar_chart_font_weight, sqb_chart_type);
					} else {
						jQuery('#'+sqb_quiz_container_outer_id).find('.OUTCOME_SPIDER_CHART_loader').hide();
						sqb_show_spider_chart(sqb_quiz_container_outer_id,result,sqb_label_text,sqb_spider_bar_chart_font_color,sqb_spider_bar_chart_font_family,sqb_spider_bar_chart_font_size,sqb_spider_bar_chart_font_weight,sqb_chart_type);
					}
				}
			});
		}
}

function sqb_show_spider_chart(sqb_quiz_container_outer_id,response,sqb_label_text,sqb_spider_bar_chart_font_color,sqb_spider_bar_chart_font_family,sqb_spider_bar_chart_font_size,sqb_spider_bar_chart_font_weight,sqb_chart_type){
		var outcome_final = jQuery('#'+sqb_quiz_container_outer_id+' #outcome_final').val();
		//jQuery('#'+sqb_quiz_container_outer_id+' #spiderChartOutcome').closest('.ans_in_resultpage_outer').remove();
		if(jQuery('#'+sqb_quiz_container_outer_id+' #spiderChartOutcome').length < 1){
		jQuery('#outcome_id_'+outcome_final).find('#result_temp_btnid').before("<div class='ans_in_resultpage_outer sqb_charts_outer_section'><div class='chart-container'><canvas id='spiderChartOutcome'></canvas></div></div>");
		}
		
		var dataArray = response.data;
		var max_scale_value = Math.max.apply(Math, dataArray);
		var min_scale_value = Math.min.apply(Math, dataArray);
		
		if(sqb_chart_type == 'category_based'){
		var min_scale_value = 0;
		var max_scale_value = 100;
		}
		
		const data = {
			  labels: response.labels,
			  datasets: [{
				label: sqb_label_text,
				data: response.data,
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
								   color: sqb_spider_bar_chart_font_color,
								   font: {
											family: sqb_spider_bar_chart_font_family,
											size: sqb_spider_bar_chart_font_size,
											weight: sqb_spider_bar_chart_font_weight,
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
			const myChart = new Chart(document.getElementById('spiderChartOutcome'),config);
			jQuery('#sqb_quiz_builder canvas#spiderChartOutcome').css('background-color','#fff');
}


function poll_chart(sqb_quiz_container_outer_id,chart_data){

	
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

	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
		if(jQuery(this).css('display') != 'none'){
			jQuery(this).html(jQuery(this).html().replace('[ShowPollResults]', '<h3>'+chart_data.question+'</h3><div><canvas id="poll_chart" width="400" height="150"></canvas></div>'));

			if(jQuery('#poll_chart').length > 0){
		
				const myChart = new Chart(
				document.getElementById('poll_chart').getContext('2d'),
				config
				);
			}

		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div .ShowPollResultsChart').addClass(chart_data.type);
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div .ShowPollResultsChart').addClass('show_cls').removeClass('hide_cls');
		}
	});
}

function sqb_show_bar_chart(sqb_quiz_container_outer_id,response,sqb_label_text,sqb_spider_bar_chart_font_color,sqb_spider_bar_chart_font_family,sqb_spider_bar_chart_font_size,sqb_spider_bar_chart_font_weight,sqb_chart_type){
		var outcome_final = jQuery('#'+sqb_quiz_container_outer_id+' #outcome_final').val();
		//jQuery('#'+sqb_quiz_container_outer_id+' #spiderChartOutcome1').closest('.ans_in_resultpage_outer').remove();
		if(jQuery('#'+sqb_quiz_container_outer_id+' #spiderChartOutcome1').length < 1){
		 jQuery('#outcome_id_'+outcome_final).find('#result_temp_btnid').before("<div class='ans_in_resultpage_outer sqb_charts_outer_section'><div class='chart-container'><canvas id='spiderChartOutcome1'></canvas></div></div>");
		}
		
		var dataArray = response.data;
		var max_scale_vale = Math.max.apply(Math, dataArray);
		if(sqb_chart_type == 'category_based'){
		var max_scale_vale = 100;
		}

		if(jQuery('#spiderChartOutcome1').length < 1){
			return false;
		}
		
		var ctx = document.getElementById('spiderChartOutcome1').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: response.labels,
				datasets: [{
					label: sqb_label_text,
					data: response.data,
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
						max: max_scale_vale,
						},
					  x: {
						ticks: {
						  color: sqb_spider_bar_chart_font_color,
						  font: {
								family: sqb_spider_bar_chart_font_family,
								size: sqb_spider_bar_chart_font_size,
								weight: sqb_spider_bar_chart_font_weight,
							  }
						}
					  }
					},
			responsive:true,
			maintainAspectRatio:true,
			}
		});	
		jQuery('#sqb_quiz_builder canvas#spiderChartOutcome1').css('background-color','#fff');		
}

function sqb_display_category_charts(sqb_quiz_container_outer_id){

var total_text = jQuery('#'+sqb_quiz_container_outer_id).find('input[name="sqb_cat_total_text"]').val();
var sqb_quiz_category_enable = jQuery('#'+sqb_quiz_container_outer_id).find('input[name="sqb_quiz_category_enable"]').val();
 
var cat_html = '';
if(sqb_quiz_category_enable == 'Y'){
		var sqb_category_details = '';
		var cat_ids = {};
		var eachcat_ids = {};
		var max_cat_val =0;
		var quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
		jQuery('#'+sqb_quiz_container_outer_id).find('.quiz_quesans_template_outer .Quiz-Template').each(function(){
			 
			if(quiz_type == 'scoring'){ 						
				var parent_hasClass =  jQuery(this).find(".question_container").hasClass('multiple_correct_cls');
				var ques_id =  jQuery(this).find(".question_container").attr('id');
				var matrix_cls =   jQuery(this).find(" .sqb_ans_item_outer").hasClass('matrix_cls'); 
				var question_type_slider_cls =   jQuery(this).find(" .question_container").hasClass('question_type_slider'); 
				
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
							jQuery(this).find(".question_container  .matrix_cls .checkbox_fe:checked").each(function(){				 
								cat_val =  jQuery(this).attr('data-assigned-value');
								 
								if(cat_val =="NaN"	|| cat_val =="nan" || cat_val =="NAN" || typeof cat_val =="undefined"){
										cat_val =0;
								 }
								if(cat_ids[cat_id]){
									cat_val = parseFloat(cat_ids[cat_id])+parseFloat(cat_val);
								}
								cat_ids[cat_id] = cat_val;
								
								max_cat_val = getmaxDataPointsMatrix(ques_id, sqb_quiz_container_outer_id);
								
								if(eachcat_ids[cat_id]){
									max_cat_val = parseFloat(eachcat_ids[cat_id])+parseFloat(max_cat_val);
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
		
		/*var category_list_json = jQuery('input[name="category_list_json"]').val();
		var cat_html = '';
		//var cat_total_val = 0;
		var cat_total_per = 0;
		var labels = [];
		var data = [];
		if(category_list_json != ''){
			category_list_json = JSON.parse(category_list_json);
			 
			jQuery.each(cat_ids,function(index, value){
			  
				if(category_list_json[index]){
					var cat_get_value = value;
					if(cat_get_value =="NaN"	|| cat_get_value =="nan" || cat_get_value =="NAN" || typeof cat_get_value =="undefined"){
							cat_get_value =0;
					}
					cat_html += '<div class="cat-details-row"><label>'+category_list_json[index]+' : </label><span>'+cat_get_value+'</span></div>';
					//cat_total_val = parseFloat(cat_total_val)+parseFloat(cat_get_value);
					labels[index] = category_list_json[index];
					data[index] = cat_get_value;
					console.log(+ category_list_json[index] +'cat_total_per'+cat_total_per);
					cat_total_val = parseFloat(cat_total_val)+parseFloat(cat_get_value);
				}
			});				
		}*/
				var maxcatval1 =0;
				var category_with_max_points = [];
				var category_list_json = jQuery('input[name="category_list_json"]').val();
				var cat_html = '';
				var cat_html1 = '';
				var cat_total_html = '';
				var cat_total_val = 0;
				var cat_total_per = 0;
				var labels = [];
				var data = [];
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
								//cat_html += '<div class="cat-details-row"><label><b>'+category_list_json[index]+'</b> : </label><span>'+cat_get_value+' ('+cat_get_value+'/'+maxcatval+')</span></div>';
								//cat_html1 += '<div class="cat-details-row"><label><b>'+category_list_json[index]+'</b> : </label><span>'+cat_total_per+'%  ('+cat_get_value+'/'+maxcatval+')</span></div>'; 
							}else{
									//cat_html += '<div class="cat-details-row"><label><b>'+category_list_json[index]+'</b> : </label><span> '+cat_get_value+'  ('+cat_get_value+'/'+maxcatval+')</span></div>';
								//cat_html1 += '<div class="cat-details-row"><label><b>'+category_list_json[index]+'</b> : </label><span> 0% ('+cat_get_value+'/'+maxcatval+')</span></div>'; 
							}
							
							labels[index] = category_list_json[index]+ ' (%)';
							//data[index] = cat_get_value;
							data[index] = cat_total_per;
														
						}
					});
					
				}
		
	
		 
		if(Object.keys(cat_ids).length != 0){
			jQuery('#'+sqb_quiz_container_outer_id).find('input[name="category_result_list_json"]').val(JSON.stringify(cat_ids));
		}
		var labelsNew = labels.filter(function (value) {
            return value != null && value != "";
        });
        var dataNew = data.filter(function (value) {
            return value != null && value != "";
        });
		var response = {"labels":labelsNew,"data":dataNew};				
	}	
	return response;
}

function sqb_display_data_in_charts(sqb_quiz_container_outer_id, sqb_quiz_id,sqb_question_id,user_id){
	var outcome_id_array = outcome_ids_array;
	
	var charts_settings = decodeURIComponent(jQuery('#'+sqb_quiz_container_outer_id+' #outcome_screen_charts_settings').val());
	var final_charts_settings = charts_settings.split('|');
	
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
		if(jQuery(this).css('display') != 'none'){
			var outcome_final_id = jQuery(this).attr('id');
			if(typeof outcome_final_id != 'undefined' && outcome_final_id != '' ){
				if(final_charts_settings[6] == 'Y'){
				var sqb_spider_chart_shortcode = '[OUTCOME_SPIDER_CHART]';
				var sqb_bar_chart_shortcode = '[OUTCOME_BAR_CHART]';
				if(final_charts_settings[15] != '' && final_charts_settings[15] == 'outcome_based'){
				 sqb_spider_chart_shortcode = '[OUTCOME_SPIDER_CHART]';
				 sqb_bar_chart_shortcode = '[OUTCOME_BAR_CHART]';
				}
				if(final_charts_settings[15] != '' && final_charts_settings[15] == 'category_based') {
				 sqb_spider_chart_shortcode = '[CATEGORY_SPIDER_CHART]';
				 sqb_bar_chart_shortcode = '[CATEGORY_BAR_CHART]';
				}
				if(final_charts_settings[15] != '' && final_charts_settings[15] == 'outcome_ranking') {
				 sqb_spider_chart_shortcode = '[PERSONALITY_SPIDER_CHART]';
				 sqb_bar_chart_shortcode = '[PERSONALITY_BAR_CHART]';
				}
					
				jQuery(this).html(jQuery(this).html().replace(sqb_spider_chart_shortcode, '<div class="ans_in_resultpage_outer sqb_charts_outer_section"><div class="chart-container spiderChartOutcomeClass"><canvas id="spiderChartOutcome"></canvas></div></div>'));
					
				jQuery(this).html(jQuery(this).html().replace(sqb_bar_chart_shortcode, '<div class="ans_in_resultpage_outer sqb_charts_outer_section"><div class="chart-container spiderChartOutcomeClass1"><canvas id="spiderChartOutcome1"></canvas></div></div>'));
					
				jQuery(this).html(jQuery(this).html().replace('[QUESTION_ANSWER_DATA_CHART]', '<div id="question_answer_chart"></div>'));
				
				}
			}
		}
	});
	
	jQuery('.sqb_loader_outer_chart').show();
	jQuery(document).ajaxStop(function(){ 						 
		jQuery('.sqb_loader_outer_chart').hide();
		jQuery('.sqb_loader_outer_chart').remove();
	}); 

	var outcome_bar_chart_mergetag_exists = false;
	if(jQuery('#'+sqb_quiz_container_outer_id+' .spiderChartOutcomeClass1').length > 0){
		outcome_bar_chart_mergetag_exists = true;
	}
	
	var question_answer_bar_chart_mergetag_exists = false;
	if(jQuery('#'+sqb_quiz_container_outer_id+' #question_answer_chart').length > 0){
	question_answer_bar_chart_mergetag_exists = true;
	}
	
	var outcome_spider_chart_mergetag_exists = false;
	if(jQuery('#'+sqb_quiz_container_outer_id+' .spiderChartOutcomeClass').length > 0){
	outcome_spider_chart_mergetag_exists = true;
	}
	
	setTimeout(function(){
		if(final_charts_settings[1] == 'outcome_bar_chart' || outcome_bar_chart_mergetag_exists){
		sqb_display_outcome_data_in_bar_chart(sqb_quiz_container_outer_id, sqb_quiz_id,charts_settings,outcome_id_array);
		}
	},1500);
	
	setTimeout(function(){
		if(final_charts_settings[2] == 'question_answer_bar_chart' || question_answer_bar_chart_mergetag_exists){ 	
		sqb_display_questions_data_in_bar_chart(sqb_quiz_container_outer_id, sqb_quiz_id,sqb_question_id,charts_settings,user_id);
		}
	}, 1800);
	
	setTimeout(function(){
		if(final_charts_settings[0] == 'outcome_spider_chart' || outcome_spider_chart_mergetag_exists){
		sqb_display_outcome_data_in_spider_chart(sqb_quiz_container_outer_id, sqb_quiz_id,charts_settings,outcome_id_array);
		}
	},2000);
	
	setTimeout(function(){
	hideLoaderForOutcome(sqb_quiz_container_outer_id);
	},2500);
} 

function sqb_display_questions_data_in_bar_charts_with_question(sqb_quiz_container_outer_id, sqb_quiz_id,user_id){
	jQuery(document).on('change','#select_question_id',function(){
		var sqb_question_id = jQuery(this).val();
		var charts_settings = decodeURIComponent(jQuery('#'+sqb_quiz_container_outer_id+' #outcome_screen_charts_settings').val());
		sqb_display_questions_data_in_bar_chart(sqb_quiz_container_outer_id, sqb_quiz_id,sqb_question_id,charts_settings,user_id);
	});
}

function sqb_display_questions_data_in_bar_chart(sqb_quiz_container_outer_id, sqb_quiz_id, sqb_question_id=0,charts_settings,user_id){
	var charts_settings = decodeURIComponent(jQuery('#'+sqb_quiz_container_outer_id+' #outcome_screen_charts_settings').val());
	var final_charts_settings = charts_settings.split('|');
	var chart_type = 'outcome_based';
	if(final_charts_settings[15] != ''){
		chart_type = final_charts_settings[15];
	}
	
	if(jQuery('#'+sqb_quiz_container_outer_id+' #question_answer_chart').length > 0){
	}else{
		
		var loader_html= '<div class="sqb_loader_outer_chart QUESTION_ANSWER_DATA_CHART_loader" style="display: none;"><div class="sqb_loader_inner"></div></div>';
				jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div:visible #result_temp_btnid').before(loader_html+'<div id="question_answer_chart"></div>');
	}
		var ajaxurl = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_ajaxurl').val();
		jQuery('#'+sqb_quiz_container_outer_id).find('.QUESTION_ANSWER_DATA_CHART_loader').show();
		jQuery.ajax({	 
					url: ajaxurl,	 
					type: "POST",
					//	async: true,
					//async: false,
					data: {
						action: 'SQBQuestionsbarchartAjax',
						sqb_quiz_id: sqb_quiz_id,
						sqb_question_id: sqb_question_id,
						chart_type: chart_type,
						user_id: user_id,
					},
					success: function (response) {	
						jQuery('#'+sqb_quiz_container_outer_id).find('.QUESTION_ANSWER_DATA_CHART_loader').hide();
						response = JSON.parse(response);
						var outcome_final = jQuery('#'+sqb_quiz_container_outer_id+' #outcome_final').val();
						var select_question_html = response.select_question_html;
						jQuery('#'+sqb_quiz_container_outer_id+' .sqb_select_questions').remove();
						jQuery('#'+sqb_quiz_container_outer_id+' .spiderChartOutcome2').closest('.ans_in_resultpage_outer').remove();
						if(jQuery('#'+sqb_quiz_container_outer_id+' #question_answer_chart').length > 0){
							jQuery('#outcome_id_'+outcome_final).find('#question_answer_chart').html('');
							jQuery('#outcome_id_'+outcome_final).find('#question_answer_chart').html(""+select_question_html+"<div class='ans_in_resultpage_outer sqb_charts_outer_section'><div class='spiderChartOutcome2'>"+response.title_html+"</div></div>");
						} else {
							jQuery('#outcome_id_'+outcome_final).find('#result_temp_btnid').before(""+select_question_html+"<div class='ans_in_resultpage_outer sqb_charts_outer_section'><div class='spiderChartOutcome2'>"+response.title_html+"</div></div>");
						}
						
					}
				});
}


function sqb_save_lead_info_on_click_on_outcome_btn(){
	
	jQuery(document).on('click' ,'#result_temp_btnid .take-quiz-btn' ,function(evt){
		evt.stopImmediatePropagation();

		

		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		if(quiz_display =="popup" ){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}
		
		// save report info
		var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+" input[type='hidden'][id='quiz_id']").val();
		var sqb_quiz_current_page_id = jQuery("#"+sqb_quiz_container_outer_id+" input[type='hidden'][id='sqb_quiz_current_page_id']").val();
		var outcome_id= 0;
		if(jQuery("#"+sqb_quiz_container_outer_id+"  #outcome_final").length != 0){
		  outcome_id =  jQuery("#"+sqb_quiz_container_outer_id+"  #outcome_final").val();
		}
	
		sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_outcome_form_btn_click',outcome_id);

		// save lead info
		var user_id = jQuery("#"+sqb_quiz_container_outer_id+" #user_id").val();
		var how_many_answed = 0;
	 
	});

}

function sqb_report_save(quiz_id = 0,sqb_quiz_current_page_id = 0,report_type = '',outcome_id = '0'){ 
	//added for the backend preview	
	var SQBPreview = jQuery('#SQBPreview').val();
	if(SQBPreview =="Y"){
		return false;
	}

	if(report_type == 'quiz_outcome_show'){
		outcome_id = jQuery('.quiz_result_template_outer .outcome_div:visible').attr('data-outcome-id');
	}

	var sqb_ajaxurl = jQuery('#sqb_ajaxurl').val();
	jQuery.post(sqb_ajaxurl, {  
					action: 'sqb_save_reports',
					quiz_id: quiz_id,   
					report_type : report_type,
					outcome_id : outcome_id,
					current_page_id:sqb_quiz_current_page_id
		}, function(response){
			 try {
			response = JSON.parse(response);   			
			if(response.returndata){
				var returndata = response.returndata;
				var event_name = returndata.event_name;	
				var event_name_new = returndata.event_name_new;	
				var tag = returndata.tag;	
				var value = returndata.value;	
				var action_name = returndata.action_name;	
				var tags = returndata.tags;	
				var status = returndata.status;
				if(status == 'Y' && action_name != 'outcome'){
					console.log('track the fb report');
					fbq('track', event_name, {
					content_name: event_name, 
					content_ids: tags,
					content_type: action_name,
					value: value
					});      
				}else if(status == 'Y' && action_name == 'outcome'){
					var outcome_id = jQuery('.quiz_result_template_outer .outcome_div:visible').attr('data-outcome-id');
					
					if(outcome_id != ''){
						var outcome_title = jQuery('#outcome_id_'+outcome_id).find('#outcome_name').val();
						console.log(outcome_title);
						var quiz_title = jQuery('#sqb_quiz_title').val();
						fbq('trackCustom', 'Outcome', {
							quiz_title: quiz_title,
							outcome_title: outcome_title,
							tag: tag
						});
					}
				}
			}
		//event_name	//event_name_new	//fbAppId	//tag		//value
		
		}catch(err) {
		  console.log("sqb_report_save error call"+err.message)
		}
			
	});
}
 
function sqb_click_to_share_btn(){
	  
	//added for the backend preview	
	var SQBPreview = jQuery('#SQBPreview').val();
	if(SQBPreview =="Y"){
		return false;
	}
	jQuery(document).on('click','.quiz-Facebook-btn', function(evt){
		evt.stopImmediatePropagation();
		FB.init({ 
			appId: jQuery("#social_share_fb_api_key").val(),
			autoLogAppEvents : true,
			xfbml            : true,
			version          : 'v9.0'
		});
		evt.preventDefault();
		//var outcome_id = jQuery(this).closest('.outcome_div').find('input[name="outcome_id"]').val();
		
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		if(quiz_display =="popup" ){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		}
	
		var social_share_fb_api_key =jQuery('#'+sqb_quiz_container_outer_id+ ' #social_share_fb_api_key').val();
		if(social_share_fb_api_key == ''){
			alert("Facebook APP key is missing.");
			return false;
		}
		var outcome_final = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val();
		var url_data = jQuery('#share_params_'+outcome_final).val();
		//var url_data = jQuery(this).closest('.outcome_div').find("input[name='share_paremets']").val();
		//var sqb_share_url_generate = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_share_url_generate').val()+url_data;
		
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
					}, 	function(response){
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
							 //jQuery('#'+sqb_quiz_container_outer_id+ ' .customize_social_share_wrapper .quiz-social-links').hide();
							///var fb_share_thank_you_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' input#fb_share_thank_you_msg').val();
							 ///jQuery('#'+sqb_quiz_container_outer_id+ ' .customize_social_share_wrapper label').text(fb_share_thank_you_msg);
							
						}
					}
			);
	});
	
	 
	
	jQuery(document).on('click','.quiz-twitter-btn' ,function(evt){
		evt.stopImmediatePropagation();
		evt.preventDefault();
		var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		if(quiz_display =="popup" ){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		} 
		var outcome_id = jQuery(this).closest('.outcome_div').find('input[name="outcome_id"]').val();
		//var sqb_twitter_url = 'https://twitter.com/share?url=';
		var sqb_twitter_url = 'https://twitter.com/intent/tweet?text='+jQuery('#tw_share_description').val()+'&url=';
		var url_data =  jQuery("#"+sqb_quiz_container_outer_id+  " input[name='share_paremets_quiz']").val();
		
		var sqb_share_url_generate =  jQuery('#'+sqb_quiz_container_outer_id+ ' input[name="sqb_social_share_url"]').val()+'?sqbtw='+url_data;;
		 
		sqb_share_url_generate += '&'+Math.floor(Math.random() * 10000);
		var sqb_share_url_generate = sqb_twitter_url+encodeURIComponent(sqb_share_url_generate);
		// Load the SDK Asynchronously
		sqb_twitter_share(sqb_share_url_generate,sqb_quiz_container_outer_id);
			
	});
	 
}

function checkCustomFields(){
	var error = [];
	var exists_field = [];
	if(jQuery(".custom_add_fields")){
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
			}else{
				jQuery('#id_custom_fields_'+name).remove();
			}

		});
	}

	if(exists_field.length > 0){
		jQuery(".custom_add_fields").each(function(){
	            
	        var field_name = jQuery(this).attr('id');
	        var name = field_name.replace('id_custom_fields_','');
	        if(jQuery.inArray(name,exists_field) == -1){
		       jQuery('#id_custom_fields_'+name).remove();
		    }
		});
	}else{
		jQuery('.custom_add_fields').remove();
	}
}

function page_question_animation_visiblity_check(element_class){
	if (jQuery(element_class)[0]) {
		var elementBottom = jQuery(element_class).offset().top;
	    var viewportTop = jQuery(window).scrollTop();
	    var viewportBottom = viewportTop + jQuery(window).height();
	    return (elementBottom > viewportTop && elementBottom < viewportBottom);
	}else{
		return false;
	}
}