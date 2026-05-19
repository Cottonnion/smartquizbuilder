jQuery(document).ready(function(){
	//jQuery('table.sqb_std_shortcode_table').show();
		sqb_std_shorcode_datatable_fe();
		sqb_load_userde_result_fe();
		
		
});

function sqb_std_shorcode_datatable_fe(){
	if(jQuery('table.sqb_std_shortcode_table .std_quiz_date').length < 1){		 
		jQuery('table.sqb_std_shortcode_table .sqb_date_row').remove();
	} 
	jQuery('table.sqb_std_shortcode_table').find('tr.std_backend_only').remove();
	if(jQuery('.std_course_name').css('display') != 'none'){
		jQuery('.sqb_std_shortcode_table').addClass('sqb_user_quiz_details_course');
	}

	jQuery('table.sqb_std_shortcode_table').DataTable({
		//"order": [[ 4, "desc" ]],
		"bLengthChange": false,
		pageLength : 10,
		"autoWidth": false,
		language: {
			search: "",
			searchPlaceholder: "Search..."
		},
		"fnInitComplete": function() {
			jQuery('.sqb_user_quiz_details').show();
			jQuery('table.sqb_std_shortcode_table').show();
		}
	});
	
	
}



function sqb_load_userde_result_fe(){	
		
	jQuery(document).on('click', '.close_Side_Popup', function(e){
		jQuery('.Manage_Side_Popup').removeClass("active_Side_Popup");
		jQuery('body').removeClass('sqb_student_shortcode_outer');
	});
	
	
	jQuery(document).on('click', '.dap_student_view_quiz_course_details', function(e){
		var btn_text = jQuery(this).text();
		var btn_obj = jQuery(this);
		jQuery(this).text("Loading...");
		jQuery('body').addClass('sqb_student_shortcode_outer');
		
		var user_id = jQuery(this).attr('data_user_id');
		var name = jQuery(this).attr('data_user_name');
		var email = jQuery(this).attr('data_user_email');
		var date = jQuery(this).attr('data_date');
		var quiz_id = jQuery(this).attr('data_quiz_id');
		//var row_id = jQuery(this).attr('data_row_id');
		var source = jQuery(this).attr('data_source');
		
			 jQuery.post(jQuery("#sqb_st_ajaxurl").val(), {
				action: 'sqb_load_userdetails',
				user_id: user_id,	
				name: name,	
				email: email,
				date: date,
				quiz_id:quiz_id,	
				
				source:source,	
			//	quiz_id:"all",	
			}, function(response) {
				response = JSON.parse(response);	
				//console.log(response);			 
				jQuery('.Manage_Side_Popup_content').html(response);
				jQuery('.Manage_Side_Popup').addClass("active_Side_Popup");
				jQuery(btn_obj).text(btn_text);
			});	
	});	
			
}	

