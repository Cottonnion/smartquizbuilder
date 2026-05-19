jQuery(document).ready(function(){
	sqbCourseHideShow();
    
	jQuery('#manage_students_list_table').DataTable({ 
		 "order": [],
		"bLengthChange": false,
		pageLength : 16,
		language: {
			search: "",
			searchPlaceholder: "Search your course..."
		},
		"fnInitComplete": function() {
			jQuery('#manage_students_list_table').show();
			 
		}
	});	
	
	jQuery(document).on('click','#dapselectcourse .dropdown-item',function(e){	
		e.preventDefault();
		var user_email = jQuery('.manage_student_filter_wrapper1 input[name="dap_sqb_user_email"]').val();
		var courseId = jQuery(this).data('value');
		var text = jQuery(this).text();
		var quiz_id = jQuery('.manage_student_filter_wrapper1 #dapselectQuiz-id').attr('data-value');
		var text = jQuery( this).text();
		jQuery('#dapselectcourse-id').text(text);
		jQuery('#dapselectcourse-id').attr('data-value', courseId);
		var course_filter = jQuery('.manage_student_filter_wrapper1 #dapselect_course_filter_name').attr('data-value');
        dapGetQuizCourseData(user_email ,courseId,quiz_id,course_filter);

	});
	
	
	jQuery(document).on('click','#dapselect_course_filter .dropdown-item',function(e){	
		e.preventDefault();
		var user_email = jQuery('.manage_student_filter_wrapper1 input[name="dap_sqb_user_email"]').val();
		var courseId = jQuery('.manage_student_filter_wrapper1 #dapselectcourse-id').attr('data-value');
		var course_filter = jQuery(this).data('value');
		var text = jQuery(this).text();
		var quiz_id = jQuery('.manage_student_filter_wrapper1 #dapselectQuiz-id').attr('data-value');
		var text = jQuery( this).text();
		jQuery('#dapselect_course_filter_name').text(text);
		jQuery('#dapselect_course_filter_name').attr('data-value', course_filter);
		
        dapGetQuizCourseData(user_email ,courseId,quiz_id,course_filter);

	});
});

function dapGetQuizCourseData(user_email = '' ,courseId = 0,quiz_id = 0, course_filter = 0){
	var pagination_page_no = jQuery('input[name="dap_student_pagination_page_no"]').val();
	var sortBy = jQuery('#sqbCourseSorting-id').attr('data-value');
		SQBShowLoader();
		jQuery.post(ajaxurl, {
				action: 'SqbGetQuizCourseData',
				courseId : courseId,	
				user_email : user_email,	
				quiz_id : quiz_id,	
				pagination_page_no : pagination_page_no,	
				sortBy : sortBy,
				course_filter: course_filter,
				
			}, function(response){
				response = JSON.parse(response);
				jQuery('#manage_student_table_outer').html(response.html);	
				if(response.quiz_drop_down_list){
					jQuery('ul.quiz_drop_down_list').html(response.quiz_drop_down_list);
				}
				SQBHideLoader();  
			});
	
}

function sqbCourseHideShow(){
	jQuery('.manage_student_btn').click(function(){
		jQuery('.manage_student_list_wrapper').hide();
		jQuery('.manage_student_progress_wrapper').show();
		var courseId = jQuery(this).attr('data-course-id');
		jQuery('.dapselectcourse').find('#courseQuiz'+courseId).trigger('click');
	});
	
	jQuery('.manage_courses_list_view_btn').click(function(){
		
		jQuery('.manage_student_list_wrapper').show();
		jQuery('.manage_student_progress_wrapper').hide();
	});
	
	//
	jQuery('.manage_course_awards_btn').click(function(){
		jQuery('.coursePointsSetupOuter').show();
		jQuery('.manageCoursePointsSetupOuter').hide();
		jQuery('#action_points_tab .top_search_section_outer').hide();
		var courseId = jQuery(this).attr('data-course-id');
		jQuery('.dapawardselectcourse').find('#courseQuiz'+courseId).trigger('click');
	});
	
	jQuery('.btn_return_manage_points').click(function(){
		jQuery('.coursePointsSetupOuter').hide();
		jQuery('#action_points_tab .top_search_section_outer').show();
		jQuery('.manageCoursePointsSetupOuter').show();
	});
	
	
}

function closeViewDetails(){
	jQuery('.closeViewDetails').click(function(e){
		e.preventDefault();
		jQuery('.viewDetailsCommon').hide('slow');
	})
}

function close_Side_Popup(){
	jQuery('.Manage_Side_Popup').removeClass("active_Side_Popup");	
}

function dap_student_view_quiz_course(data){
	//console.log(data);
	var userId = jQuery(data).attr('user_id');
	//jQuery('.viewDetailsCommon').hide();
	jQuery('#viewDetails'+userId).siblings('.viewDetailsCommon').hide();
	setTimeout(function(){ jQuery('#viewDetails'+userId).toggle('slow'); }, 200);
	
}
