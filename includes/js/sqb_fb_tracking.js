jQuery(document).ready(function(){

	jQuery(document).on('hide.bs.modal','#customjs_add_model', function () {
		sqb_reset_customjs();
	});

	jQuery(document).on('change','#quiz_cjs_trigger_val',function() {
		jQuery('.custom_is_event').hide();
		jQuery('.custom_is_event').removeClass('active');
		jQuery('.sqb-customjs-copy').hide();
	});

	jQuery(document).on('change','.sqb_customjs_status',function() {

		var status = 'Y';
		var id = jQuery(this).attr('data-id');
		if(jQuery(this).is(':checked')){
			status = 'Y';
		}else{
			status = 'N';
		}
		
		sqb_update_status_custom_js(id,status);

    });

	//added for the data-toggle
jQuery(document).on('click', '.dropdown-toggle' , function(event){
	event.preventDefault();
	 event.stopImmediatePropagation();

	jQuery(this).next(".dropdown-menu").toggleClass('newshowcls');	
	jQuery(this).next(".dropdown-menu").toggleClass('show');	
	
});
jQuery(document).on('click', '.dropdown-menu.newshowcls  a' , function(event){ 
	event.preventDefault();
	 event.stopImmediatePropagation();
	jQuery(this).closest(".dropdown-menu").removeClass('newshowcls');	
	jQuery(this).closest(".dropdown-menu").removeClass('show');	
	
});

jQuery(document).on('change', '.showHideSqbTrackData', function(e){
	e.preventDefault();
	jQuery('.quiz_ques_answer_common_class').hide();
	if(jQuery(this).prop('checked') == true){
		jQuery('.showHideSqbTrackData').prop('checked' , false);
		jQuery(this).prop('checked' , true);
		var id = jQuery(this).data('id');
		jQuery('.quiz_answer_outer'+id).show();	
		jQuery('.quiz_question_outer'+id).show();	
	}	
});

jQuery(document).on('click', '#sqb_save_fb_pixel_id', function(e){
	e.preventDefault();
	SQBShowLoader();
	var sqb_fb_pixel_id = jQuery('#sqb_fb_pixel_id').val();
	if(sqb_fb_pixel_id == ''){
		//showerror return
	}
	jQuery.post(ajaxurl, {
				action: 'sqb_save_update_fb_tracking_id',
				sqb_fb_pixel_id: sqb_fb_pixel_id,
	}, function(response) {
		SQBHideLoader();
	});	
});	

//	jQuery(document).on('change', '#sqb_fb_tracking_select_quiz', function(){
jQuery('#sqb_fb_tracking_select_quiz .dropdown-item').click(function(){
	var quiz_id = jQuery(this).data('value');
	var quiz_name = jQuery( this).text();
	jQuery('#sqb_fb_tracking_select_quiz-id').text(quiz_name);
	jQuery('#sqb_fb_tracking_select_quiz').data('value', quiz_id);
	if(quiz_id != '' && quiz_id != 0){
		SQBShowLoader();
		jQuery.post(ajaxurl, {
				action: 'sqb_load_question_answers_by_order',
				quiz_id: quiz_id,
				quiz_name: quiz_name,
		}, function(response) {
			SQBHideLoader();
			response = JSON.parse(response);
			jQuery('.sqbFbTrackingQuizData').html(response.html);
			jQuery('.sqbFbTrackingCommon').show();
		});		
	}	
});



jQuery('#sqb_custom_js_select_quiz .dropdown-item').click(function(){
	SQBShowLoader();
	var quiz_id = jQuery(this).data('value');
	var quiz_name = jQuery( this).text();
	jQuery('#sqb_custom_js_select_quiz-id').text(quiz_name);
	jQuery('#sqb_custom_js_select_quiz').attr('data-value', quiz_id);
	if(quiz_id != '' && quiz_id != 0){
		sqb_load_customjs(quiz_id,quiz_name);
	}	
});

jQuery(document).on('click', '.sqb_save_fb_tracking', function(e){
	e.preventDefault();
	SQBShowLoader();
	var quiz_id = jQuery('#sqb_fb_tracking_select_quiz').data('value');
	
	var tracking_arr = new Array();
	
	var pageViewTag = jQuery( "#pageViewTag" ).val();
	var pageViewValue = jQuery( "#pageViewValue" ).val();
	var pageViewStatus = getCheckedStatus("#pageViewStatus");
	
	var landingClickTag = jQuery( "#landingClickTag" ).val();
	var landingClickValue = jQuery( "#landingClickValue" ).val();
	var landingClickStatus = getCheckedStatus("#landingClickStatus");
	
	var leadSubmitTag = jQuery( "#leadSubmitTag" ).val();
	var leadSubmitValue = jQuery( "#leadSubmitValue" ).val();
	var leadSubmitStatus = getCheckedStatus("#leadSubmitStatus");
	
	var resultClickedTag = jQuery( "#resultClickedTag" ).val();
	var resultClickedValue = jQuery( "#resultClickedValue" ).val();
	var resultClickedStatus = getCheckedStatus("#resultClickedStatus");

	tracking_arr[0] = {'event_name': 'Page View' , 'tag' : pageViewTag, 'value':pageViewValue, 'custom_action_name':'' , 'custom_action_id': '', 'track_type' : 'fb','status' : pageViewStatus};
	tracking_arr[1] = {'event_name': 'Landing CTA Clicked' , 'tag' : landingClickTag, 'value':landingClickValue, 'custom_action_name':'' , 'custom_action_id': '', 'track_type' : 'fb','status' : landingClickStatus};
	tracking_arr[2] = {'event_name': 'Lead Form Submitted' , 'tag' : leadSubmitTag, 'value':leadSubmitValue, 'custom_action_name':'' , 'custom_action_id': '', 'track_type' : 'fb','status' : leadSubmitStatus};
	tracking_arr[3] = {'event_name': 'Result CTA Clicked' , 'tag' : resultClickedTag, 'value':resultClickedValue, 'custom_action_name':'' , 'custom_action_id': '', 'track_type' : 'fb','status' : resultClickedStatus};
	var i = 4;
	

	jQuery('.outcome_event').each(function(){
		var oid = jQuery(this).data('id');
		var j = 1;
		var outcomeTag = jQuery( "#outcomeViewTag_"+oid ).val();
		var checked_outcome = getCheckedStatus("#outcomeViewStatus_"+oid);
		//var questionValue = jQuery( "#questionValue"+qid ).val();
		
		tracking_arr[i] = {'event_name': 'View Outcome' , 'tag' : outcomeTag, 'value':0, 'custom_action_name':'outcome' , 'custom_action_id': oid, 'track_type' : 'fb','status' : checked_outcome};
		i++;
	});	

	jQuery('.quiz_event_outer').each(function(){
		var qid = jQuery(this).data('id');
		
		var questionTag = jQuery( "#questionTag"+qid ).val();
		var questionValue = jQuery( "#questionValueStatus"+qid ).val();
		
		var checked_ques = getCheckedStatus("#questionValueStatus"+qid);

		tracking_arr[i] = {'event_name': 'Track Custom' , 'tag' : questionTag, 'value':questionValue, 'custom_action_name':'question' , 'custom_action_id': qid, 'track_type' : 'fb','status' : checked_ques};
		
		i++;
	});
	jQuery('.quiz_event_outer').each(function(){
		var qid = jQuery(this).data('id');
		var j = 1;
		var checked_ques = getCheckedStatus("#questionValueStatus"+qid);
		jQuery('.quiz_answer_outer'+qid).each(function(){
			var aid = jQuery(this).data('id');
			var answerTag = jQuery( "#answerTag"+j+qid ).val();
			var answerValue = jQuery( "#answerValue"+j+qid ).val();
			
			tracking_arr[i] = {'event_name': 'Track Custom' , 'tag' : answerTag, 'value':answerValue, 'custom_action_name':'answer' , 'custom_action_id': aid, 'track_type' : 'fb','status' : checked_ques};	
			j++;
			i++;
		})
		
		
	});	

	if(quiz_id != '' && quiz_id != 0){
		jQuery.post(ajaxurl, {
				action: 'sqb_save_quiz_tracking_details',
				tracking_arr: tracking_arr,
				quiz_id: quiz_id,
		}, function(response) {
			SQBHideLoader();
			swal("Saved Successfully!");
		});		
	}	
});

})


function getCheckedStatus($id){
var checked= '';
if(jQuery($id).is(':checked')){
	checked = 'Y';
}else{
	checked = 'N';
}
return checked;
}

function sqb_reset_customjs(){
	var parent = jQuery('#customjs_add_model');
	parent.find('#quiz_cjs_name_val').val('');
	parent.find('#quiz_cjs_desc_val').val('');
	parent.find('#quiz_cjs_id').val('');
	parent.find('#quiz_cjs_id').val('0');
	parent.find('.custom_is_event').hide();
	parent.find('.custom_is_event').removeClass('active');
	jQuery('.sqb-customjs-copy').hide();
	
}
function sqb_edit_customjs(id){
	jQuery('#customjs_add_model').modal('show');
	var parent = jQuery('#customjs_add_model');
	jQuery.post(ajaxurl, {
		action: 'sqb_load_custom_js_by_id',
		id: id,
	}, function(response){
		response = JSON.parse(response);
		if(response.status == 'ok'){

			var code = response.code.replace(new RegExp("\\\\", "g"), "");

			parent.find('#quiz_cjs_name_val').val(response.name);
			parent.find('#quiz_cjs_desc_val').val(code);
			parent.find('#quiz_cjs_trigger_val').val(response.type);
			parent.find('#quiz_cjs_id').val(response.id);
		}
		SQBHideLoader();
		/*parent.find('.close').trigger('click'); 
		parent.find('#quiz_cjs_name_val').val('');
		parent.find('#quiz_cjs_desc_val').val('');
		parent.find('#quiz_cjs_id').val('');*/
	});

}

function sqb_update_status_custom_js(id,status){
	SQBShowLoader();
	jQuery.post(ajaxurl, {
		action: 'sqb_update_custom_js',
		id: id,
		status: status,
	}, function(response){
		SQBHideLoader();
	});
}

function sqb_delete_customjs(id){

	swal({
		text: "Are you sure you want to delete?",
		//type: "warning",
		showCancelButton: true,
		showCloseButton: true,
		confirmButtonColor: "#a71a1a",
		confirmButtonText: "Yes",
		customClass: '',
		
	}).then((result) => {
		if (result.value) {
			SQBShowLoader();
			jQuery.post(ajaxurl, {
				action: 'sqb_delete_customjs',
				id: id,
			}, function(response){
				jQuery('#sqb-custom-js-'+id).remove();
				SQBHideLoader();
				if(jQuery('.cls-sqb-custom-js').length < 1){
					jQuery('.sqb-customjs-tbody').html('<tr id="sqb-custom-js-0" class="cls-sqb-custom-js"><td colspan="4" align="center">No data found</td></tr>');
				}
				/*parent.find('.close').trigger('click'); 
				parent.find('#quiz_cjs_name_val').val('');
				parent.find('#quiz_cjs_desc_val').val('');
				parent.find('#quiz_cjs_id').val('');*/
			});
		}
	});
	

}

function sqb_close_customjs(){

}

function sqb_save_customjs(){
	var parent = jQuery('#customjs_add_model');
	var quiz_cjs_name_val = parent.find('#quiz_cjs_name_val').val();
	var quiz_cjs_desc_val = parent.find('#quiz_cjs_desc_val').val();
	var id = parent.find('#quiz_cjs_id').val();
	var quiz_cjs_trigger_val = parent.find('#quiz_cjs_trigger_val').val();
	var quiz_id = jQuery('#sqb_custom_js_select_quiz').attr('data-value');
	parent.find('.quiz_cjs_required').hide();
	
	if(quiz_cjs_name_val == ''){
		parent.find('.quiz_cjs_name_val_wrapper').find('.quiz_cjs_required').show();
		return false;
	}
	if(quiz_cjs_desc_val == ''){
		parent.find('.quiz_cjs_desc_val_wrapper').find('.quiz_cjs_required').show();
		return false;
	}
	
	SQBShowLoader();
	jQuery.post(ajaxurl, {
			id: id,
			action: 'sqb_save_customjs',
			quiz_id: quiz_id,
			cjs_name: quiz_cjs_name_val,
			cjs_desc: quiz_cjs_desc_val,
			cjs_trigger: quiz_cjs_trigger_val,
	}, function(response){
			response = JSON.parse(response);
			if(response.data){
					/*if(response.data.html){
						jQuery('#Quiz_setting_tab_2').html(response.data.html);
						sqb_quiz_category_datatable_call();
					}*/
			}
			SQBHideLoader();  
			parent.find('.close').trigger('click'); 
			var quiz_name = jQuery('#sqb_custom_js_select_quiz-id').text();
			var quiz_id = jQuery('#sqb_custom_js_select_quiz').attr('data-value');
			sqb_load_customjs(quiz_id,quiz_name);
			sqb_reset_customjs();
			
	});
	
	
}
function custom_js_sample(){
	var quiz_id = jQuery('#sqb_custom_js_select_quiz').attr('data-value');
	var trigger = jQuery('#quiz_cjs_trigger_val').val();
	jQuery('.custom_js_'+trigger).html(jQuery('.custom_js_'+trigger).html().replace('%%QUIZ_ID%%',quiz_id));
	jQuery('.custom_is_event').hide();
	jQuery('.custom_is_event').removeClass('active');
	jQuery('.custom_js_'+trigger).show();
	jQuery('.custom_js_'+trigger).addClass('active');

	jQuery('.sqb-customjs-copy').show();
}


function sqb_load_customjs(quiz_id,quiz_name){
	jQuery.post(ajaxurl, {
		action: 'sqb_load_custom_js',
		quiz_id: quiz_id,
		quiz_name: quiz_name,
	}, function(response) {
		SQBHideLoader();
		response = JSON.parse(response);
		jQuery('.sqbCustomJSQuizData').html(response.html);
		jQuery('.sqbCustomJSCommon').show();
	});		
}

function sqb_js_copy_to_clipboard(obj) {
	
	jQuery(obj).text('Copied');
	var elementId = jQuery('.custom_is_event.active').attr('id');
	var $temp = jQuery("<textarea>");
	jQuery("body").append($temp);
	$temp.text(jQuery('#'+elementId).text()).select().focus();
	document.execCommand("copy");
	$temp.remove();
}
