jQuery(document).ready(function(){
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

jQuery(document).on('click','.Quiz-reports-tab-inner #Quiz-reportsTab a ',function(){	
	var tab_id =jQuery(this).attr('href');	
	if(tab_id == "#settings_advance_tab"){
		jQuery('.global-settings-tab li:eq(0) a').trigger('click');
		jQuery('#Quiz_setting_tab_1').addClass('active show');
	}else if(tab_id == "#settings_button_tab"){
		jQuery('.message-Quiz-reportsTab li:eq(0) a').trigger('click');
		jQuery('#customizer_setting_tab').addClass('active show');
	}else if(tab_id == "#settings_external_integration_tab"){
		jQuery('.email-verification-tab li:eq(0) a').trigger('click');
		jQuery('#dap_admin_notification_tab1').addClass('active show');
	}else if(tab_id == "#settings_tracking_tab"){
		jQuery('.tracking-tabs li:eq(0) a').trigger('click');
		jQuery('#dap_admin_notification_tab1').addClass('active show');
		jQuery('#settings_fbtracking_tab').addClass('show').addClass('active');
	}else{
		jQuery('#reports-tab-content > .tab-pane').removeClass('active show');
		jQuery('#reports-tab-content > '+tab_id).addClass('active show');
		jQuery('#reports-tab-content  '+tab_id+' .tab-pane').first().addClass('active show');
	}	 
});  
/* jQuery(document).on('click','#settings_button_tab #Quiz-reportsTab a ',function(){	
	var tab_id =jQuery(this).attr('href');			 
	jQuery('#settings_button_tab > .tab-pane').removeClass('active show');
	jQuery('#settings_button_tab > '+tab_id).addClass('active show');
	 
}); */ 
jQuery(document).on('click','#settings_notifications_tab #Quiz-reportsTab a ',function(){	
	var tab_id = jQuery(this).attr('href');			 
	jQuery('#settings_notifications_tab > .tab-pane').removeClass('active show');
	jQuery('#settings_notifications_tab > '+tab_id).addClass('active show');
	 
});  
	
jQuery(document).on('change' , '#show_first_name_screen', function(e){
	e.preventDefault();
	if(jQuery(this).prop('checked') == true){
		jQuery('.show_first_name_screen_temp_outer').show();
	}else{
		jQuery('.show_first_name_screen_temp_outer').hide();	
	}
	sqb_tiny_mce_editor();
});

jQuery(document).on('change' , '#analyzing_result', function(e){
	e.preventDefault();
	if(jQuery(this).prop('checked') == true){
		jQuery('.show_analyzing_result_outer').show();
	}else{
		jQuery('.show_analyzing_result_outer').hide();	
	}
	sqb_tiny_mce_editor();
});


jQuery('#setting_tag_background_color,#setting_tag_background_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
	jQuery('#setting_tag_background_color_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
}); 
jQuery('#next_button_settings_background_color,#next_button_settings_background_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
	jQuery('#next_button_settings_background_color_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
}); 

jQuery('#setting_category_background_color,#setting_category_background_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
	jQuery('#setting_category_background_color_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
}); 

jQuery('#setting_ans_ad_recommendation,#setting_ans_ad_recommendation_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
	jQuery('#setting_ans_ad_recommendation_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
}); 

jQuery('#setting_question_ads_color,#setting_question_ads_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
	jQuery('#setting_question_ads_color_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
}); 

jQuery('#setting_personalization_color,#setting_personalization_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
	jQuery('#setting_personalization_color_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
}); 

jQuery('#setting_analyzing_screen_color,#setting_analyzing_screen_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
	jQuery('#setting_analyzing_screen_color_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
}); 
jQuery('#setting_progress_color,#setting_progress_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
	jQuery('#setting_progress_color_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
}); 

jQuery('#setting_progress_inactive_color,#setting_progress_inactive_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
	jQuery('#setting_progress_inactive_color_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
}); 

jQuery('#charts_bar_background_color,#charts_bar_background_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
	jQuery('#charts_bar_background_color_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
}); 

jQuery('#top_bar_background_color,#top_bar_background_color_div').colorpicker({format: 'rgba'}).on('changeColor', function() {
	jQuery('#top_bar_background_color_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
}); 




jQuery('#analyzing_result_progress_color,#analyzing_result_progress_color_div').colorpicker().on('changeColor', function() {
	jQuery('.analyzing-progress-bar').css('background-color', jQuery(this).colorpicker('getValue'));
	jQuery('#analyzing_result_progress_color_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
	
}); 

jQuery('#personalization_button_color,#personalization_button_color_div').colorpicker().on('changeColor', function() {
	jQuery('.firstname_ok_btn').css('background-color', jQuery(this).colorpicker('getValue'));
	jQuery('#personalization_button_color_div .input-group-addon i').css('background-color', jQuery(this).colorpicker('getValue'));
}); 

jQuery('#placeholder_button_color,#placeholder_button_color_div').colorpicker().on('changeColor', function() {
	jQuery('.sqb_first_name').css('color', jQuery(this).colorpicker('getValue'));
	//jQuery('.sqb_first_name::placeholder').css('color', jQuery(this).colorpicker('getValue'));
}); 

jQuery('body').on('change','#analyzing_result_alignment',function(){
	var selected_value = jQuery(this).val();
	jQuery('.show_analyzing_result_inner').find('.analyzing_result_temp').css('text-align',selected_value);
});

jQuery('body').on('change','.analyzing-result-time-delay',function(){
	var selected_value = jQuery(this).val();
	jQuery('.time-delay-hidden').val(selected_value);
});

		
})

function sqb_dap_migration_table(url){
var final_url = url+'/wp-admin/admin.php?page=sqb_settings&tab=dap_course&manage';
SQBShowLoader();
jQuery.post(ajaxurl, {
	action: 'sqb_quiz_lesson_migration',
	}, function(response) {	
		SQBHideLoader();
		response = JSON.parse(response);
		console.log(response.result);
		if(response.result == 'success'){
			location.replace(final_url);
		}
});

}
