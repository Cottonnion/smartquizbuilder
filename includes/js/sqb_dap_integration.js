jQuery(document).ready(function(){
	sqb_dap_blocking_quiz_status_update();
	jQuery(document).on('change','#select_course_id', function () {	
		var courseid = jQuery(this).val();
		sqbGetLessonsForSelectedCourse(courseid);	 			
	}); 
	
	jQuery(document).on('change' , '#sqb_display_quiz_on_lesson', function(e){
		e.preventDefault();
		var parent_id = jQuery(this).closest('.add_edit_form').attr('id');
		var display_quiz = jQuery(this).val();

		if(display_quiz == 'Y'){
			jQuery('#'+parent_id+' .commonHideShowQuiz').show();
		}else{
			jQuery('#'+parent_id+' .commonHideShowQuiz').hide();
		}
		
	});
	
	jQuery('#dap_manage_course_table').DataTable({
		"order": [[ 4, "desc" ]],
		"bLengthChange": false,
		pageLength : 10,
		language: {
			search: "",
			searchPlaceholder: "Search..."
		},
		"fnInitComplete": function() {
			jQuery('#dap_manage_course_table').show();
		}
	});
	
	
	
	jQuery(document).on('change','#blocking_quiz',function(e){
		e.preventDefault();
		var parent_id = jQuery(this).closest('.add_edit_form').attr('id');
		sqb_show_hide_quiz_blocking_wrapper(parent_id);
	});
	jQuery(document).on('change','#select_quiz_id',function(e){
		e.preventDefault();
		var parent_id = jQuery(this).closest('.add_edit_form').attr('id');
		sqb_show_hide_quiz_blocking_wrapper(parent_id);	
		var quiz_id = jQuery(this).val();
		if(quiz_id != 0){
			jQuery('#'+parent_id+' .sqb_quiz_shortcode_details').show('slow');
			jQuery('#'+parent_id+' #dynamic_copyable_text_sqb_dap_quiz').html('[SmartQuizBuilder id='+quiz_id+'][/SmartQuizBuilder]');
		}else{
			jQuery('#'+parent_id+' .sqb_quiz_shortcode_details').hide('slow');
		}	
	
	});
	
	
	jQuery(document).on('change','#unlock_criteria',function(e){
		e.preventDefault();
		var parent_id = jQuery(this).closest('.add_edit_form').attr('id');
		if(jQuery(this).val() == 'pass'){
			jQuery('#'+parent_id+' .sqb_passing_criteria_wrapper').show('slow');
		}else{
			jQuery('#'+parent_id+' .sqb_passing_criteria_wrapper').hide('slow');
		}	
	});

	jQuery(document).on('change','#sqb_quiz_show_correct_ans',function(e){
		e.preventDefault();
		var parent_id = jQuery(this).closest('.add_edit_form').attr('id');
		if(jQuery(this).val() == 'N'){
			jQuery('#'+parent_id+' .quiz_show_correct_incorrect_no_wrapper').show('slow');
		}else{
			jQuery('#'+parent_id+' .quiz_show_correct_incorrect_no_wrapper').hide('slow');
		}
		
	});
	
	jQuery(document).on('change','#sqb_quiz_many_attempts',function(e){
		e.preventDefault();
		var parent_id = jQuery(this).closest('.add_edit_form').attr('id');
		if(jQuery(this).val() == 'limited'){
			jQuery('#'+parent_id+' .sqb_quiz_many_attempts_limit_wrapper').show('slow');
		}else{
			jQuery('#'+parent_id+' .sqb_quiz_many_attempts_limit_wrapper').hide('slow');
		}
	});
	
	jQuery(document).on('change','#sqb_quiz_allow_retake',function(e){
		e.preventDefault();
		var parent_id = jQuery(this).closest('.add_edit_form').attr('id');
		if(jQuery(this).val() == 'Y'){
			jQuery('#'+parent_id+' .retake_no_wrapper').show('slow');
			if(jQuery('#'+parent_id+' #sqb_quiz_many_attempts').val() == 'limited'){
				jQuery('#'+parent_id+' .sqb_quiz_many_attempts_limit_wrapper').show('slow');
			}
		}else{
			jQuery('#'+parent_id+' .retake_no_wrapper').hide('slow');
			jQuery('#'+parent_id+' .sqb_quiz_many_attempts_limit_wrapper').hide('slow');
		}
	});
	
	
	
	jQuery(document).on('change','.sqb_quiz_show_result_screen',function(e){
		e.preventDefault();
		var parent_id = jQuery(this).closest('.add_edit_form').attr('id');
		if(jQuery(this).prop('checked')){
			jQuery(this).closest('.form-group').next().show('slow');
		}else{
			jQuery(this).closest('.form-group').next().hide('slow');
		}
	});
	  
			
});


function sqb_load_data_by_quiz_id_and_course_id(){
	//var quiz_id = jQuery('#sqb_quiz_many_attempts').val();
	//var course_id = jQuery('#select_course_id').val();
	
	
	
	 var quiz_id = 44;
	 var course_id = 22;
	 
	 
	 if(quiz_id == '' || course_id == ''){
		 return false;
	 }
		
		SQBShowLoader();
		jQuery.post(ajaxurl, {
			action: 'sqb_load_dap_blocking_quiz',		 		   		  
			quiz_id: quiz_id,	   		  
			course_id: course_id,	   		  
            
		}, function (response) { 
			 SQBHideLoader();
			 response = JSON.parse(response);
			  //console.log(response);
			  
			  if(response.lession_html){
				  jQuery('#select_lesson_id').html(response.lession_html);
				  
			  }
			  
			   if(response.quiz_data){
				   var quiz_data = response.quiz_data
				    if(quiz_data.quiz_status){
						if(quiz_data.quiz_status == 'Y'){
							jQuery('#quiz_status').prop('checked',true);
						}else{
							jQuery('#quiz_status').prop('checked',false);
						}
					}
					
					if(quiz_data.quiz_display_option){
						if(quiz_data.quiz_display_option == 'manual'){
							jQuery('input[name="quiz_display_option"][value="manual"]').prop('checked',true);
						}else{
							jQuery('input[name="quiz_display_option"][value="automatic"]').prop('checked',true);
						}
					}
					
					if(quiz_data.blocking_quiz){
						if(quiz_data.blocking_quiz == 'Y'){
							jQuery('#blocking_quiz').val('Y');
						}else{
							jQuery('#blocking_quiz').val('N');
						}
					}
					
					
					if(quiz_data.sqb_quiz_show_start_screen){
						if(quiz_data.sqb_quiz_show_start_screen == 'Y'){
							jQuery('#sqb_quiz_show_start_screen').val('Y').change();
						}else{
							jQuery('#sqb_quiz_show_start_screen').val('N').change();
						}
					}
				    if(quiz_data.sqb_quiz_allow_retake){
						if(quiz_data.sqb_quiz_allow_retake == 'Y'){
							jQuery('#sqb_quiz_allow_retake').val('Y').change();
						}else{
							jQuery('#sqb_quiz_allow_retake').val('N').change();
						}
					}
					
					 if(quiz_data.sqb_quiz_max_attempts_limit){
						 jQuery('#sqb_quiz_max_attempts_limit').val(quiz_data.sqb_quiz_max_attempts_limit);
						if(quiz_data.sqb_quiz_max_attempts_limit ==  '999'){
							jQuery('#sqb_quiz_many_attempts').val('unlimited').change();
						}else{
							jQuery('#sqb_quiz_many_attempts').val('limited').change();
						}
					}
				  
				  
				  
			  }
			 
			  
			  
			  //if('')
			 
		});	
	
}

function sqb_show_hide_quiz_blocking_wrapper(parent_id){
	
	
	if(jQuery('#'+parent_id+' #blocking_quiz').val() == 'Y'){
			
			var quiz_type = jQuery("#"+parent_id+" #select_quiz_id option:selected").attr('data-quiz-type');
			if(quiz_type == null){
				return false;
			}
			if(quiz_type== 'assessment' || quiz_type== 'scoring'){
				jQuery('#'+parent_id+' .blocking_quiz_yes_wrapper').show('slow');
				if(jQuery('#'+parent_id+' #unlock_criteria').val() == 'complete'){
					jQuery('#'+parent_id+' .sqb_passing_criteria_wrapper').hide('slow');
				}
				
			}else{
				jQuery('#'+parent_id+' .blocking_quiz_yes_wrapper').hide('slow');
			}
			
		}else{
			jQuery('#'+parent_id+' .blocking_quiz_yes_wrapper').hide('slow');
		}
}

/**** function to get units of selected course ******/
function sqbGetLessonsForSelectedCourse(courseid){			 
		SQBShowLoader();
		jQuery('#select_lesson_id').html('<li>Select one or more lessons</li>');
		jQuery.post(ajaxurl, {
			action: 'sqbGetLessons',		 		  
			courseid: courseid ,	   		  
            
		}, function (response) { 
			 SQBHideLoader();
			 response = JSON.parse(response);
			  //console.log(response);
			  if(response.html){
				jQuery('#select_lesson_id').html(response.html);
			}
		});	
	 
}


function sqb_save_dap_integration(el){
	
	var parent_id = jQuery(el).closest('.add_edit_form').attr('id');
	
	var course_id = jQuery('#'+parent_id+' #select_course_id').val();
	if(course_id == 0){
		swal("","Please select a course","");
		return false;
	}
	
	/*var lesson_ids = [];
	jQuery('ul#select_lesson_id input:checked').each(function(){
		lesson_ids.push(jQuery(this).val());
	});*/
	
	/*if(lesson_ids.length == 0){
		swal("","Please select one or more lessons","");
		return false;
	}*/
	
	var lesson_ids = jQuery('#'+parent_id+' #select_lesson_id').val();
	if(lesson_ids == 0){
		swal("","Please select a lesson","");
		return false;
	}
	
	var quiz_id = jQuery('#'+parent_id+' #select_quiz_id').val();
	if(quiz_id == 0){
		swal("","Please select a Quiz","");
		return false;
	}

	var quiz_display_option = jQuery("#"+parent_id+" input[type='radio'][name='quiz_display_option']:checked").val();
	var blocking_quiz = jQuery('#'+parent_id+' #blocking_quiz').val();
	var unlock_criteria = jQuery('#'+parent_id+' #unlock_criteria').val()
	var sqb_passing_criteria = jQuery("#"+parent_id+" input[name='sqb_passing_criteria']").val();	
	
	if(jQuery('#'+parent_id+' #blocking_quiz').val() == 'Y'){
			
		var quiz_type = jQuery('#'+parent_id+' #select_quiz_id option:selected').attr('data-quiz-type');
		
		if((quiz_type== 'assessment' || quiz_type== 'scoring') && ( unlock_criteria == 'pass')){
			if(sqb_passing_criteria == 0 || sqb_passing_criteria == ''){
				swal("","Enter passing criteria","");
				return false;
			}else if(sqb_passing_criteria > 100){
				swal("","Enter passing criteria between 0 to 100","");
				return false;
			}
		}
	}
	
	//var sqb_quiz_show_correct_ans = jQuery("#sqb_quiz_show_correct_ans").val();
	var sqb_quiz_show_start_screen = jQuery('#'+parent_id+' #sqb_quiz_show_start_screen_'+lesson_ids).prop('checked');
	if(sqb_quiz_show_start_screen){
		sqb_quiz_show_start_screen = 'Y';
	}else{
		sqb_quiz_show_start_screen = 'N';
	}
	
	
	var sqb_quiz_allow_retake = jQuery('#'+parent_id+' #sqb_quiz_allow_retake').val();
	var sqb_quiz_many_attempts = jQuery('#'+parent_id+' #sqb_quiz_many_attempts').val();
	var sqb_quiz_max_attempts_limit = jQuery('#'+parent_id+' #sqb_quiz_max_attempts_limit').val();
	
	if((sqb_quiz_allow_retake == 'Y') && (sqb_quiz_many_attempts == 'limited') && ((sqb_quiz_max_attempts_limit == 0) || (sqb_quiz_max_attempts_limit == ''))){
		swal("","Enter Max Attempt Limit","");
		return false;
	}
	
	var sqb_quiz_show_result_screen = jQuery('#'+parent_id+' #sqb_quiz_show_result_screen_'+lesson_ids).prop('checked');
	if(sqb_quiz_show_result_screen){
		sqb_quiz_show_result_screen = 'yes';
	}else{
		sqb_quiz_show_result_screen  = 'no';
	}
	
	
	var sqb_quiz_show_correct_incorrect_ans = jQuery('#'+parent_id+' #sqb_quiz_show_correct_incorrect_ans_'+lesson_ids).prop('checked');
	if(sqb_quiz_show_correct_incorrect_ans){
		sqb_quiz_show_correct_incorrect_ans = 'Y';
	}else{
		sqb_quiz_show_correct_incorrect_ans = 'N';
	}
	
	if(sqb_quiz_show_result_screen == 'no'){
		sqb_quiz_show_correct_incorrect_ans = 'N';
	}

	var quiz_pagination = jQuery("#"+parent_id+" input[type='radio'][name='quiz_pagination']:checked").val(); 
	var quiz_name = jQuery("#"+parent_id+ " #select_quiz_id option:selected").html();
	var quiz_data= {'sqb_quiz_show_result_screen':sqb_quiz_show_result_screen,'sqb_quiz_show_correct_incorrect_ans':sqb_quiz_show_correct_incorrect_ans,'quiz_id':quiz_id,'quiz_display_option':quiz_display_option,'blocking_quiz':blocking_quiz,'unlock_criteria':unlock_criteria,'sqb_passing_criteria':sqb_passing_criteria,'sqb_quiz_show_start_screen':sqb_quiz_show_start_screen,'sqb_quiz_allow_retake':sqb_quiz_allow_retake,'sqb_quiz_many_attempts':sqb_quiz_many_attempts,'sqb_quiz_max_attempts_limit':sqb_quiz_max_attempts_limit, 'quiz_pagination':quiz_pagination ,'quiz_name':quiz_name}

	
	
	var data = {'quiz_id':quiz_id,'course_id':course_id,"lesson_ids":lesson_ids};
	
	jQuery('#'+parent_id+' .dap_quiz_error_msg_outer').hide().html('');
	
	if((jQuery('#blocking_quiz').val() == 'Y') && (quiz_display_option == 'manual')){
		swal({
			text: "For a blocking quiz, you'll have to select automated quiz display option. You can't manually insert shortcodes in a lesson for blocking quizzes. Do you want to change to the automated display option?",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#02c7a6 ",
			confirmButtonText: "Yes",
			customClass: '',
			
		}).then((result) => {
			if (result.value) {
				jQuery("#"+parent_id+" input[type='radio'][name='quiz_display_option'][value='automatic']").trigger('click')
				 quiz_display_option = jQuery("#"+parent_id+" input[type='radio'][name='quiz_display_option']:checked").val();
				 quiz_data = {'sqb_quiz_show_result_screen':sqb_quiz_show_result_screen,'sqb_quiz_show_correct_incorrect_ans':sqb_quiz_show_correct_incorrect_ans,'quiz_id':quiz_id,'quiz_display_option':quiz_display_option,'blocking_quiz':blocking_quiz,'unlock_criteria':unlock_criteria,'sqb_passing_criteria':sqb_passing_criteria,'sqb_quiz_show_start_screen':sqb_quiz_show_start_screen,'sqb_quiz_allow_retake':sqb_quiz_allow_retake,'sqb_quiz_many_attempts':sqb_quiz_many_attempts,'sqb_quiz_max_attempts_limit':sqb_quiz_max_attempts_limit, 'quiz_pagination':quiz_pagination,'quiz_name':quiz_name}
				
				sqb_save_dap_integration_with_param(data,quiz_data);
			}else{
				sqb_save_dap_integration_with_param(data,quiz_data);
			}
		});
		
	}else{
		sqb_save_dap_integration_with_param(data,quiz_data);
	}	
}


function sqb_save_dap_integration_with_param(data = '' , quiz_data = ''){
	
	SQBShowLoader();
				jQuery.post(ajaxurl, {
					action: 'sqb_save_dap_blocking_quiz',		 		  
					data: data ,	   		  
					quiz_data: quiz_data ,	   		  
					
				}, function (response) { 
					 SQBHideLoader();
					 response = JSON.parse(response);
					  //console.log(response);
						if(response.dapversionerr != ''){
							jQuery('.dap_quiz_error_msg_outer').html(response.dapversionerr);
							jQuery('.dap_quiz_error_msg_outer').show(); 
						}
					  if(response.already_lesson_ids_added_list_warning_html){
						  jQuery('.dap_quiz_error_msg_outer').show().html(response.already_lesson_ids_added_list_warning_html);
						   if(response.already_lesson_ids_added_list){
							   var sqb_i;
								for (sqb_i = 0; sqb_i < response.already_lesson_ids_added_list.length; sqb_i++) {
								 
								  // console.log(response.already_lesson_ids_added_list[sqb_i]);
								  jQuery('#select_lesson_id').find('input.mutliSelect[value="'+response.already_lesson_ids_added_list[sqb_i]+'"]').prop('checked',false);
								}
							   
							  
						   }  
					  }
					  
					 if(response.success){
						 jQuery('#sqb_lesson_action_'+data.lesson_ids).text('edit');
						 jQuery('#sqb_quiz_name_'+data.lesson_ids).text(quiz_data.quiz_name);
						jQuery('.quiz-save-btn-msg').show('slow');
						setTimeout(function(){jQuery('.quiz-save-btn-msg').hide('slow'); }, 5000);
					}
				});	
			
}



function sqb_dap_blocking_quiz_status_update(){
	
	
	jQuery('.sqb_dap_blocking_quiz_status_update').on('click',function(){
	    var quiz_id = jQuery(this).attr('data_quiz_id');
	    var quiz_status = jQuery(this).prop('checked'); 
	    if(quiz_status){
			quiz_status = 'Y';
		}else{
			quiz_status = 'N';
		}
		 SQBShowLoader();
		 jQuery.post(ajaxurl, {
				action: 'sqb_quiz_update_status_by_id',
				quiz_id: quiz_id,
				quiz_status : quiz_status
		}, function(response) {
			response = JSON.parse(response);				 
			SQBHideLoader();
			//console.log(response); 
			
			
		});
	});
}
	
function sqb_dap_delete_quiz_blocking(id){
	
	
	if(id == 0 || id == ''){
		return false;
	}  
	
	swal({
			text: "Are you sure you want delete?",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Delete!",
			customClass: '',
			
		}).then((result) => {
			if (result.value) {
				
				// ajax call
				SQBShowLoader();
				 jQuery.post(ajaxurl, {
						action: 'sqb_dap_quiz_bloking_by_id',
						id: id
				}, function(response) {
					response = JSON.parse(response);				 
					SQBHideLoader();
					//console.log(response); 
					var table = jQuery('#dap_manage_course_table').DataTable();
					table.row(jQuery('tr.tr_sqb_quiz_blocking_id_'+id)).remove().draw();
					
				})
				
				
							
			}
	
	
			
		});
	
	
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
}

