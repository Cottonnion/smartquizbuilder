
jQuery(document).ready(function(){
	
	sqb_question_answer_report();

	//Reports section Question/Anser Tab
	jQuery('body').on('click','.question_answer_report_wrapper .card .card-header:not(.no-accord)', function (e) {
		if( e.target !== this ) {
       		return;
	   }else{
		    jQuery(this).parent('.card').find('.collapse').toggleClass('show');
	   }
	});

	jQuery('.show_optout_leaderboard').on('click', function(){
		jQuery('#leaderboard_optout').modal('show');
	});
	
		//added for the data-toggle
	jQuery(document).on('click', '.remove_user' , function(){
		var user_id = jQuery(this).attr('data-id');
		var user_source = jQuery(this).attr('data-source');

		SQBShowLoader();
		jQuery.post(ajaxurl, {
				action: 'sqb_remove_user_leaderboard',
				user_id: user_id,
				user_source: user_source,
		}, function(response){
			SQBHideLoader();
			
			response = JSON.parse(response);
			jQuery('.show-optin-users').html(response.output);
		});
	});
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
		
	
	jQuery(document).on('click', '.sqb_empty_stats_table', function(e){
		e.preventDefault();
		
		var selected_quiz = jQuery('#SelectQuizNo').attr('data-value');
		if(selected_quiz == 'all_quiz'){
			var message = 'Are you sure you want to delete the stats for ALL Quizzes?';
		} else {
			var Quiz_name = jQuery('.SelectQuizNo_list').find("[data-value='" + selected_quiz + "']").text();
			var message = 'Are you sure you want to delete the stats for this quiz - "'+Quiz_name+'"';
		}
		swal({
		  title: "Are you sure?",
		  text: message,
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		  showCancelButton: true,
		  showCloseButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, Delete!",
		  customClass: '',
		  
		})
		.then((willDelete) => {
		  if (willDelete.value) {
			jQuery.post(ajaxurl, {
				action: 'sqb_empty_stats_table',
				quiz_id: selected_quiz,
			}, function(response){
				response = JSON.parse(response);
				sqb_load_reports();
			});
		  } else {
			
		  }
		});
		
	});
	
	jQuery('#manage_lead_tab').on('click',function(){
		jQuery('#reports_tab_tab').trigger('click');
		jQuery('a[href="#reports_manage_leads"]').trigger('click');
	});
	
		
	// select quiz option 
	jQuery('.SelectQuizNo_list a').on('click',function(){
		jQuery('#SelectQuizNo').text(jQuery(this).text());
		jQuery('#SelectQuizNo').attr('data-value',jQuery(this).attr('data-value'));
			sqb_load_reports();
	});
	
	jQuery('.question_answer_report_quiz_list a').on('click',function(){
		jQuery('.question_answer_report_quiz_id').text(jQuery(this).text());
		jQuery('.question_answer_report_quiz_id').attr('data-value',jQuery(this).attr('data-value'));
			//sqb_load_reports();
			sqb_question_answer_report();
	});

	jQuery('.leaderboard_list a').on('click',function(){
		jQuery('.leaderboard_list_id').text(jQuery(this).text());
		jQuery('.leaderboard_list_id').attr('data-value',jQuery(this).attr('data-value'));
		jQuery('.leaderboard_list-dd').removeClass('show');
	});
	
	
	jQuery('#reports_start_date').datepicker({
		
	});
	
	jQuery('#reports_end_date').datepicker({
		
	});
	
	
	jQuery('#sqb_qanr_start_date').datepicker({    
		
	});
	
	jQuery('#sqb_qanr_end_date').datepicker({
		
	});
	
	
	// select time option 
	jQuery('.select_report_time_option a').on('click',function(){
		jQuery('#SelectTimeButton').text(jQuery(this).text());
		var sqb_time_action_value = jQuery(this).attr('data-value');
		jQuery('#SelectTimeButton').attr('data-value',sqb_time_action_value);
		jQuery('.Select_report_group_action a').hide();
		jQuery('.stats_filter_outer .custom_range_wrapper').hide();
		if((sqb_time_action_value == 'today') || (sqb_time_action_value == 'yesterday') || (sqb_time_action_value == 'last_seven_days')|| (sqb_time_action_value == 'last_week') || (sqb_time_action_value == 'last_month')){
			jQuery('.Select_report_group_action a.report_group_action_day').show();
			jQuery('#Select_report_group_action_button').attr('data-value','day');
			jQuery('#Select_report_group_action_button').text('Day');
			
		}else if((sqb_time_action_value == 'last_three_month') || (sqb_time_action_value == 'last_six_month') || (sqb_time_action_value == 'last_year')){
				jQuery('.Select_report_group_action a.report_group_action_day').show();
				jQuery('.Select_report_group_action a.report_group_action_month').show();
				
				jQuery('#Select_report_group_action_button').attr('data-value','month');
				jQuery('#Select_report_group_action_button').text('Month');
				
		}else if(sqb_time_action_value == 'all_time'){
				
				jQuery('.Select_report_group_action a.report_group_action_all').show();
				jQuery('#Select_report_group_action_button').attr('data-value','all');
				jQuery('#Select_report_group_action_button').text('All');
				
		}else if(sqb_time_action_value == 'custom_range'){
				jQuery('.stats_filter_outer .custom_range_wrapper').show();
				jQuery('.Select_report_group_action a.report_group_action_month').show();
				jQuery('#Select_report_group_action_button').attr('data-value','month');
				jQuery('#Select_report_group_action_button').text('Month');
				
		}
		sqb_load_reports();
		
	});
	// select group action option 
	jQuery('.Select_report_group_action a').on('click',function(){
	
		jQuery('#Select_report_group_action_button').text(jQuery(this).text());
		jQuery('#Select_report_group_action_button').attr('data-value',jQuery(this).attr('data-value'));
			sqb_load_reports();
	});
	
	
	
	
	sqb_load_reports();
	
	
	jQuery('.Quiz-Restriction-list li:first-child a').trigger('click'); 
	
});


function  sqb_optin_leaderboard(){
	SQBShowLoader();
	jQuery.post(ajaxurl, {
			action: 'sqb_optin_leaderboard_users',
	}, function(response){
		SQBHideLoader();
		jQuery('#leaderboard_optin').modal('show');
		response = JSON.parse(response);
		jQuery('.show-optin-users').html(response.output);
	});
}


function  sqb_optout_leaderboard(){
	var email = jQuery('input[name="get_email"]').val();
	if(email == ""){
		jQuery('.leaderboard-optout-outer').append('<div class="optout_message already_added">Please Enter Email</div>');
		return false;
	}else{
		jQuery('.optout_message').remove();
	}
	SQBShowLoader();
	jQuery.post(ajaxurl, {
			action: 'sqb_optout_leaderboard_users',
			email: email,
	}, function(response){
		SQBHideLoader();
		response = JSON.parse(response);
		if(response.output == "Added"){
			jQuery('.leaderboard-optout-outer').append('<div class="optout_message">Added</div>');
			setTimeout(function(){
				jQuery('.optout_message').remove();
			}, 5000);
			jQuery('input[name="get_email"]').val('');
		}else if(response.output == "Already Added"){
			jQuery('.leaderboard-optout-outer').append('<div class="optout_message already_added">Already Added</div>');
			setTimeout(function(){
				jQuery('.optout_message').remove();
			}, 5000);
		}else if(response.output == "no_user"){
			jQuery('.leaderboard-optout-outer').append('<div class="optout_message already_added">No user exist with this email</div>');
			setTimeout(function(){
				jQuery('.optout_message').remove();
			}, 5000);
		}
		//jQuery('.show-optin-users').html(response.output);
	});

}

function  sqb_print_leaderboard(){
	
	var lb_id = jQuery('.leaderboard_list').attr('data-value');

	SQBShowLoader();
	jQuery.post(ajaxurl, {
			action: 'sqb_load_leaderboard',
			lb_id: lb_id,
	}, function(response){
		SQBHideLoader();
		
		jQuery('.leaderboard_list_wrapper').html(response);
	});
}
 

function  sqb_question_answer_report(){
	
	var quiz_id = jQuery('.question_answer_report_quiz_id').attr('data-value');
	//var quiz_id = jQuery('.question_answer_report_quiz_id').text();
	
	var sqb_qanr_start_date = jQuery('#sqb_qanr_start_date').val();
	var sqb_qanr_end_date = jQuery('#sqb_qanr_end_date').val();
	SQBShowLoader();
	jQuery.post(ajaxurl, {   
			action: 'sqb_load_question_answer_report',
			quiz_id: quiz_id,
			sqb_qanr_start_date: sqb_qanr_start_date,
			sqb_qanr_end_date: sqb_qanr_end_date,
			
			
			
	}, function(response){
		SQBHideLoader();
			response = JSON.parse(response);
			//console.log(response);
			if(response.success){
				if(response.no_records_fond){
					jQuery('.question_answer_report_wrapper').html(response.no_records_fond);
				}else{
					//eval(response.html);
					jQuery('.question_answer_report_wrapper').html(response.html);

					jQuery(".card-body").find("script").each(function(){
				     eval(jQuery(this).text());
				   });
				}
			}
			
			
			
	});
	
	
}

function sqbDeleteSubmission(sub_id = 0){
	
	if(sub_id == '' || sub_id == 0){
		return false;
	}

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
				//SQBShowLoader();
				jQuery.post(ajaxurl, {
				action: 'sqb_delete_submission_by_id',
				sub_id: sub_id ,
							 
				}, function(response) {		
					//swal('','Submission Deleted',"success");
					jQuery('.sqb_transprent_btn').trigger('click');
					//SQBHideLoader();
					//location.reload();		 
					
				});
				
				
				
			}
		});
	
	
	
}

function sqb_load_reports(){
	SQBShowLoader();
	var quiz_id = jQuery('#SelectQuizNo').attr('data-value');
	var statsType = jQuery('#SelectTimeButton').attr('data-value');
	var group_by = jQuery('#Select_report_group_action_button').attr('data-value');
	var reports_start_date = jQuery('#reports_start_date').val(); 	
	var reports_end_date = jQuery('#reports_end_date').val();
	jQuery.post(ajaxurl, {
			action: 'sqb_load_reports_data',
			quiz_id: quiz_id,
			statsType: statsType,
			group_by: group_by,
			reports_end_date: reports_end_date,
			reports_start_date: reports_start_date,
			operationName: 'sqb_get_reports_details',
	}, function(response) {
			SQBHideLoader();
			response = JSON.parse(response);
			if(response.success){
				
				jQuery('#overall_totals_table_outer_wrapper').html(response.table_html);
				
			
				jQuery('span.total_visit').html(response.total_visit);
				
				
				jQuery('span.total_click').html(response.total_click);
				
				jQuery('span.total_completed').html(response.total_completed);
				
				jQuery('span.total_opted_in').html(response.total_opted_in);
				
				jQuery('.total_reached_outcome').html(response.total_reached_outcome);
				
					
				jQuery('span.total_clicked_on_outcome_CTA').html(response.total_clicked_on_outcome_CTA);
				
				
				
				
			}	
			//console.log(response);
	});
	
	
}
