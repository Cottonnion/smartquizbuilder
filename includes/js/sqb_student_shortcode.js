
jQuery(document).ready(function(){
	
	jQuery('#std_course_details_show').change(function(){
		if(jQuery(this).prop('checked')){
			jQuery('.std_table_customizer_content_wrapper table .std_course_name').show();
			jQuery('.std_table_customizer_content_wrapper table .std_lesson_name').show();
			jQuery('.std_table_customizer_content_wrapper table .std_lesson_status').show();
		}else{
			
			
			jQuery('.std_table_customizer_content_wrapper table  .std_course_name').hide();
			jQuery('.std_table_customizer_content_wrapper table .std_lesson_name').hide();
			jQuery('.std_table_customizer_content_wrapper table .std_lesson_status').hide();
		}	
		
	});
	sqb_std_shorcode_template_customizer();
	sqb_std_shorcode_datatable();
	sqb_update_user_shortcode_course_details_status();
});


function sqb_std_shorcode_datatable(){
	
jQuery('#stb_manage_student_shortode').DataTable({
		"order": [[ 4, "desc" ]],
		"bLengthChange": false,
		pageLength : 10,
		language: {
			search: "",
			searchPlaceholder: "Search..."
		},
		"fnInitComplete": function() {
			jQuery('#stb_manage_student_shortode').show();
		}
	});
	
}

function sqb_std_shorcode_template_customizer(){
	
 
	// start tempalte customzier 	
	var sqb_str_table = jQuery('.sqb_std_shortcode_table');
	jQuery('#sqb_str_tab_width').bootstrapSlider().change(function() {
			sqb_str_table.css('max-width', +this.value + 'px');
	});
	
	jQuery('#sqb_str_tab_background_color_div,#sqb_str_tab_background_color').colorpicker().on('changeColor', function() {
				sqb_str_table.css('background-color', jQuery(this).colorpicker('getValue'));
	});
	
	jQuery('#sqb_str_tab_head_background_color,#sqb_str_tab_head_background_color_div').colorpicker().on('changeColor', function() {
				sqb_str_table.find('thead th').css('background-color', jQuery(this).colorpicker('getValue'));
	});
	
	
	
	
	jQuery('#sqb_str_btn_width').bootstrapSlider().change(function() {
			sqb_str_table.find('.dap_student_view_quiz_course_details').css('width', +this.value + 'px');
	});
	
	jQuery('#sqb_str_tab_btn_border_color_div,#sqb_str_tab_btn_border_color').colorpicker().on('changeColor', function() {
				sqb_str_table.find('.dap_student_view_quiz_course_details').css('border-color', jQuery(this).colorpicker('getValue'));
	});
	
}

function sqb_save_student_shortcode(){
	console.log('sqb_save_student_shortcode');
	
	var quiz_ids = [];
	jQuery('ul#sqb_std_select_quiz_ids input:checked').each(function(){
		quiz_ids.push(jQuery(this).val());
	});
	
	if(quiz_ids.length == 0){
		swal("","Please select one or more Quiz","");
		return false;
	}
	
	var course_details_show = jQuery('#std_course_details_show').prop('checked');
	
	if(course_details_show){
		course_details_show = 'Y';
	}else{
		course_details_show = 'N';
	}
	
	var html = encodeURIComponent(jQuery('.std_table_customizer_content_wrapper_table').html());
	var edit_id = jQuery('#sqb_student_shotcode_id').val();
	
	var sqb_str_tab_background_color = jQuery('#sqb_str_tab_background_color').val();
	var sqb_str_tab_width = jQuery('#sqb_str_tab_width').val();
	var sqb_str_btn_width = jQuery('#sqb_str_btn_width').val();
	var sqb_str_tab_btn_border_color = jQuery('#sqb_str_tab_btn_border_color').val();
	var sqb_str_tab_head_background_color = jQuery('#sqb_str_tab_head_background_color').val();
	
	var customzier = sqb_str_tab_background_color+'||'+sqb_str_tab_width+'||'+sqb_str_btn_width+'||'+sqb_str_tab_btn_border_color+'||'+sqb_str_tab_head_background_color;
	var result_btn_text = jQuery('table.sqb_std_shortcode_table').find('.dap_student_view_quiz_course_details').html();
	result_btn_text = encodeURIComponent(result_btn_text);
	
	SQBShowLoader();
		jQuery.post(ajaxurl, {
			action: 'sqb_save_student_shortcode',		 		  
			quiz_ids: quiz_ids ,	   		  
			course_details_show: course_details_show ,	   		  
			html: html,	   		  
			edit_id: edit_id,	   		  
			customzier: customzier,	   		  
			result_btn_text: result_btn_text,	   		  
            
		}, function (response) { 
			 SQBHideLoader();
			 response = JSON.parse(response);
			 
			 
			 if(response.success){
				if(response.edit_id){
					jQuery('#sqb_student_shotcode_id').val(response.edit_id);
					jQuery('#sqb_std_shortcode_dynamic_copyable_text_sqb').text(response.shotcode);
					jQuery('.sqb_std_shortocde_details_wrapper').show();
				}
				jQuery('.std_quiz-save-btn-msg').show('slow');
				setTimeout(function(){jQuery('.std_quiz-save-btn-msg').hide('slow'); }, 5000);  
			}
			 
	
	
	});
	
}



function sqb_delete_user_shortcode_by_id(id){
	
	
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
						action: 'sqb_delete_user_shortcode_by_id',
						id: id
				}, function(response) {
					response = JSON.parse(response);				 
					SQBHideLoader();
					//console.log(response); 
					var table = jQuery('#stb_manage_student_shortode').DataTable();
					table.row(jQuery('tr.tr_std_manage_shortcode_id_'+id)).remove().draw();
					
				})
				
				
							
			}
	
	
			
		});
	
	
}



function sqb_update_user_shortcode_course_details_status(){
	
	
	jQuery('.sqb_update_user_shortcode_course_details_status').on('click',function(){
	    var id = jQuery(this).attr('data_row_id');
	    var course_details_status = jQuery(this).prop('checked'); 
	    if(course_details_status){
			course_details_status = 'Y';
		}else{
			course_details_status = 'N';
		}
		 SQBShowLoader();
		 jQuery.post(ajaxurl, {
				action: 'sqb_update_user_shortcode_course_details_status_by_id',
				id: id,
				course_details_status : course_details_status
		}, function(response) {
			response = JSON.parse(response);				 
			SQBHideLoader();
			//console.log(response); 
			
			
		});
	});
}

