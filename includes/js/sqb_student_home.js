jQuery(document).ready(function(){

	sqb_tiny_mce_editor();
	sqb_mp_table_datatable_call();
	sqb_member_engagement_delete_by_id_new();




	jQuery('.sqb_logged_in_hidden_selected_quiz_ids').sortable();
	jQuery('.sqb_user_taken_selected_quiz_ids').sortable();
	jQuery( ".sqb_logged_in_selected_quiz_ids" ).sortable();
	jQuery('.sqb_user_taken_hidden_selected_quiz_ids').sortable();


	jQuery(document).on('keyup','#sqb_search_logged_in_select_quiz',function() {
		var allpostlist = [];
		var str2 = jQuery(this).val().toLowerCase();	 
		var i = 0;
		jQuery("ul.sqb_logged_in_select_quiz_ids li").each(function() {
			var str1 = jQuery(this).text().toLowerCase();
			if (str1.indexOf(str2) != -1) {
				allpostlist[i++] = jQuery(this).attr("data-title");
			}
		});

		jQuery("ul.sqb_logged_in_select_quiz_ids li").each(function() {
			if (jQuery.inArray(jQuery(this).attr("data-title"), allpostlist) !== -1) {
				jQuery(this).show();
			} else {
				jQuery(this).hide();
			}
		});
	});

	jQuery(document).on('keyup','#sqb_search_logged_in_hidden_select_quiz',function() {
		var allpostlist = [];
		var str2 = jQuery(this).val().toLowerCase();	 
		var i = 0;
		jQuery("ul.sqb_logged_in_hidden_select_quiz_ids li").each(function() {
			var str1 = jQuery(this).text().toLowerCase();
			if (str1.indexOf(str2) != -1) {
				allpostlist[i++] = jQuery(this).attr("data-title");
			}
		});

		jQuery("ul.sqb_logged_in_hidden_select_quiz_ids li").each(function() {
			if (jQuery.inArray(jQuery(this).attr("data-title"), allpostlist) !== -1) {
				jQuery(this).show();
			} else {
				jQuery(this).hide();
			}
		});
	});

	jQuery(document).on('keyup','#sqb_search_logged_in_user_taken_select_quiz',function() {
		var allpostlist = [];
		var str2 = jQuery(this).val().toLowerCase();	 
		var i = 0;
		jQuery("ul.sqb_user_taken_select_quiz_ids li").each(function() {
			var str1 = jQuery(this).text().toLowerCase();
			if (str1.indexOf(str2) != -1) {
				allpostlist[i++] = jQuery(this).attr("data-title");
			}
		});

		jQuery("ul.sqb_user_taken_select_quiz_ids li").each(function() {
			if (jQuery.inArray(jQuery(this).attr("data-title"), allpostlist) !== -1) {
				jQuery(this).show();
			} else {
				jQuery(this).hide();
			}
		});
	});

	jQuery(document).on('change','input[name="dm_engagement_enable_retake"]',function() {
		if(jQuery(this).prop('checked') == true){
			jQuery('.completed-quiz-block .sqb_btn_container').append('<a href="%%QUIZ_URL_RETAKE%%" data-quiz-id="%%QUIZ_ID%%" target="_blank" class="sqb-retake-outer sqb_sale_page_url sqb-member-view-quiz-result"> <div class="access_content retake_access_content_btn sqb_tiny_mce_editor"> <div>Retake this Quiz</div> </div> </a>');

			sqb_tiny_mce_editor();
		}else{
			jQuery('.completed-quiz-block .sqb_btn_container .sqb-retake-outer').remove();
		}
	});

	jQuery(document).on('keyup','#sqb_search_logged_in_user_taken_hidden_select_quiz',function() {
		var allpostlist = [];
		var str2 = jQuery(this).val().toLowerCase();	 
		var i = 0;
		jQuery("ul.sqb_user_taken_hidden_select_quiz_ids li").each(function() {
			var str1 = jQuery(this).text().toLowerCase();
			if (str1.indexOf(str2) != -1) {
				allpostlist[i++] = jQuery(this).attr("data-title");
			}
		});

		jQuery("ul.sqb_user_taken_hidden_select_quiz_ids li").each(function() {
			if (jQuery.inArray(jQuery(this).attr("data-title"), allpostlist) !== -1) {
				jQuery(this).show();
			} else {
				jQuery(this).hide();
			}
		});
	});



	jQuery('body').on('click','ul.sqb_logged_in_select_quiz_ids li',function(){
		var page_title = jQuery(this).attr('data-value');
		if(page_title == "all"){
			if(jQuery('.sqb_logged_in_select_quiz_ids .all_logged_in_ids').hasClass('active_completed_quiz')){
				jQuery('ul.sqb_logged_in_select_quiz_ids li').removeClass('active_completed_quiz');
				jQuery('ul.sqb_logged_in_selected_quiz_ids').html('');
				jQuery('.sqb_logged_in_selected_quiz_ids_outer').hide();

			}else{
				jQuery('ul.sqb_logged_in_select_quiz_ids li').removeClass('active_completed_quiz');
				jQuery('ul.sqb_logged_in_select_quiz_ids .all_logged_in_ids').addClass('active_completed_quiz');
				jQuery('ul.sqb_logged_in_selected_quiz_ids').html('');

				jQuery('.sqb_logged_in_select_quiz_ids .logged_in_ids').each(function(){
					var all_url_id = jQuery(this).attr('data-id');
					var all_page_title = jQuery(this).attr('data-value');
					if(all_url_id){
						jQuery('.sqb_logged_in_selected_quiz_ids_outer').show();
						jQuery('ul.sqb_logged_in_selected_quiz_ids').append('<li data-id='+all_url_id+'>'+all_page_title+' (ID:'+all_url_id+')</li>');
					}
				});
			}
		}else{
			if(jQuery('.sqb_logged_in_select_quiz_ids .all_logged_in_ids').hasClass('active_completed_quiz')){
				jQuery('ul.sqb_logged_in_selected_quiz_ids').html('');
			}

			jQuery('.sqb_logged_in_select_quiz_ids .all_logged_in_ids').removeClass('active_completed_quiz');
			var url_id = jQuery(this).attr('data-id');
			jQuery(this).toggleClass('active_completed_quiz');
			jQuery('.sqb_logged_in_selected_quiz_ids_outer').show();
			if(jQuery(this).hasClass('active_completed_quiz')){
				jQuery('ul.sqb_logged_in_selected_quiz_ids').append('<li data-id='+url_id+'>'+page_title+' (ID:'+url_id+')</li>');
			} else {
				jQuery("ul.sqb_logged_in_selected_quiz_ids li[data-id='" + url_id + "']").remove();
			}
			if(jQuery('.sqb_logged_in_selected_quiz_ids li').length == 0){
				jQuery('.sqb_logged_in_selected_quiz_ids_outer').hide();
			}
		}
		jQuery( ".sqb_logged_in_selected_quiz_ids" ).sortable();
	});

	jQuery('body').on('click','ul.sqb_logged_in_hidden_select_quiz_ids li',function(){
		var page_title = jQuery(this).attr('data-value');
		if(page_title == "all"){
			if(jQuery('.sqb_logged_in_hidden_select_quiz_ids .all_logged_in_ids').hasClass('active_completed_hidden_quiz')){
				jQuery('ul.sqb_logged_in_hidden_select_quiz_ids li').removeClass('active_completed_hidden_quiz');
				jQuery('ul.sqb_logged_in_hidden_selected_quiz_ids').html('');
				jQuery('.sqb_logged_in_hidden_selected_quiz_ids_outer').hide();

			}else{
				jQuery('ul.sqb_logged_in_hidden_select_quiz_ids li').removeClass('active_completed_hidden_quiz');
				jQuery('ul.sqb_logged_in_hidden_select_quiz_ids .all_logged_in_ids').addClass('active_completed_hidden_quiz');

				//jQuery('ul.sqb_logged_in_hidden_select_quiz_ids li').addClass('active_completed_hidden_quiz');
				jQuery('ul.sqb_logged_in_hidden_selected_quiz_ids').html('');

				jQuery('.sqb_logged_in_hidden_select_quiz_ids .logged_in_ids').each(function(){
					var all_url_id = jQuery(this).attr('data-id');
					var all_page_title = jQuery(this).attr('data-value');
					if(all_url_id){
						jQuery('.sqb_logged_in_hidden_selected_quiz_ids_outer').show();
						jQuery('ul.sqb_logged_in_hidden_selected_quiz_ids').append('<li data-id='+all_url_id+'>'+all_page_title+' (ID:'+all_url_id+')</li>');
					}
				});
			}
		}else{
			if(jQuery('.sqb_logged_in_hidden_select_quiz_ids .all_logged_in_ids').hasClass('active_completed_hidden_quiz')){
				jQuery('ul.sqb_logged_in_hidden_selected_quiz_ids').html('');
			}
			jQuery('.sqb_logged_in_hidden_select_quiz_ids .all_logged_in_ids').removeClass('active_completed_hidden_quiz');
			var url_id = jQuery(this).attr('data-id');
			jQuery(this).toggleClass('active_completed_hidden_quiz');
			jQuery('.sqb_logged_in_hidden_selected_quiz_ids_outer').show();
			if(jQuery(this).hasClass('active_completed_hidden_quiz')){
				jQuery('ul.sqb_logged_in_hidden_selected_quiz_ids').append('<li data-id='+url_id+'>'+page_title+' (ID:'+url_id+')</li>');
			} else {
				jQuery("ul.sqb_logged_in_hidden_selected_quiz_ids li[data-id='" + url_id + "']").remove();
			}
			if(jQuery('.sqb_logged_in_hidden_selected_quiz_ids li').length == 0){
				jQuery('.sqb_logged_in_hidden_selected_quiz_ids_outer').hide();
			}
		}
		jQuery('.sqb_logged_in_hidden_selected_quiz_ids').sortable();
	});

	jQuery('body').on('click','ul.sqb_user_taken_select_quiz_ids li',function(){
		var page_title = jQuery(this).attr('data-value');
		if(page_title == "all"){
			if(jQuery('.sqb_user_taken_select_quiz_ids .all_logged_in_ids').hasClass('active_not_taken_quiz')){
				jQuery('ul.sqb_user_taken_select_quiz_ids li').removeClass('active_not_taken_quiz');
				jQuery('ul.sqb_user_taken_selected_quiz_ids').html('');
				jQuery('.sqb_user_taken_selected_quiz_ids_outer').hide();

			}else{
				jQuery('ul.sqb_user_taken_select_quiz_ids li').removeClass('active_not_taken_quiz');
				jQuery('ul.sqb_user_taken_select_quiz_ids .all_logged_in_ids').addClass('active_not_taken_quiz');

				//jQuery('ul.sqb_user_taken_select_quiz_ids li').addClass('active_not_taken_quiz');
				jQuery('ul.sqb_user_taken_selected_quiz_ids').html('');

				jQuery('.sqb_user_taken_select_quiz_ids .user_taken_ids').each(function(){
					var all_url_id = jQuery(this).attr('data-id');
					var all_page_title = jQuery(this).attr('data-value');
					if(all_url_id){
						jQuery('.sqb_user_taken_selected_quiz_ids_outer').show();
						jQuery('ul.sqb_user_taken_selected_quiz_ids').append('<li data-id='+all_url_id+'>'+all_page_title+' (ID:'+all_url_id+')</li>');
					}
				});
			}
		}else{
			if(jQuery('.sqb_user_taken_select_quiz_ids .all_logged_in_ids').hasClass('active_not_taken_quiz')){
				jQuery('ul.sqb_user_taken_selected_quiz_ids').html('');
			}
			jQuery('.sqb_user_taken_select_quiz_ids .all_logged_in_ids').removeClass('active_not_taken_quiz');
			var url_id = jQuery(this).attr('data-id');
			jQuery(this).toggleClass('active_not_taken_quiz');
			jQuery('.sqb_user_taken_selected_quiz_ids_outer').show();
			if(jQuery(this).hasClass('active_not_taken_quiz')){
				jQuery('ul.sqb_user_taken_selected_quiz_ids').append('<li data-id='+url_id+'>'+page_title+' (ID:'+url_id+')</li>');
			} else {
				jQuery("ul.sqb_user_taken_selected_quiz_ids li[data-id='" + url_id + "']").remove();
			}
			if(jQuery('.sqb_user_taken_selected_quiz_ids li').length == 0){
				jQuery('.sqb_user_taken_selected_quiz_ids_outer').hide();
			}
		}
		jQuery('.sqb_user_taken_selected_quiz_ids').sortable();
	});

	/*var url_id = jQuery(this).attr('data-id');
		var page_url = jQuery(this).attr('data-value');
		jQuery(this).toggleClass('active_not_taken_hidden_quiz');
		jQuery('.sqb_user_taken_hidden_selected_quiz_ids_outer').show();
		if(jQuery(this).hasClass('active_not_taken_hidden_quiz')){
			jQuery('ul.sqb_user_taken_hidden_selected_quiz_ids').append('<li data-id='+url_id+'>'+page_url+' (ID:'+url_id+')</li>');
		} else {
			jQuery("ul.sqb_user_taken_hidden_selected_quiz_ids li[data-id='" + url_id + "']").remove();
		}*/

	jQuery('body').on('click','ul.sqb_user_taken_hidden_select_quiz_ids li',function(){
		var page_title = jQuery(this).attr('data-value');
		if(page_title == "all"){
			if(jQuery('.sqb_user_taken_hidden_select_quiz_ids .all_logged_in_ids').hasClass('active_not_taken_hidden_quiz')){
				jQuery('ul.sqb_user_taken_hidden_select_quiz_ids li').removeClass('active_not_taken_hidden_quiz');
				jQuery('ul.sqb_user_taken_hidden_selected_quiz_ids').html('');
				jQuery('.sqb_user_taken_hidden_selected_quiz_ids_outer').hide();

			}else{
				jQuery('ul.sqb_user_taken_hidden_select_quiz_ids li').removeClass('active_not_taken_hidden_quiz');
				jQuery('ul.sqb_user_taken_hidden_select_quiz_ids .all_logged_in_ids').addClass('active_not_taken_hidden_quiz');

				//jQuery('ul.sqb_user_taken_hidden_select_quiz_ids li').addClass('active_not_taken_hidden_quiz');
				jQuery('ul.sqb_user_taken_hidden_selected_quiz_ids').html('');

				jQuery('.sqb_user_taken_hidden_select_quiz_ids .user_taken_ids').each(function(){
					var all_url_id = jQuery(this).attr('data-id');
					var all_page_title = jQuery(this).attr('data-value');
					if(all_url_id){
						jQuery('.sqb_user_taken_hidden_selected_quiz_ids_outer').show();
						jQuery('ul.sqb_user_taken_hidden_selected_quiz_ids').append('<li data-id='+all_url_id+'>'+all_page_title+' (ID:'+all_url_id+')</li>');
					}
				});
			}
		}else{
			if(jQuery('.sqb_user_taken_hidden_select_quiz_ids .all_logged_in_ids').hasClass('active_not_taken_hidden_quiz')){
				jQuery('ul.sqb_user_taken_hidden_selected_quiz_ids').html('');
			}
			jQuery('.sqb_user_taken_hidden_select_quiz_ids .all_logged_in_ids').removeClass('active_not_taken_hidden_quiz');
			var url_id = jQuery(this).attr('data-id');
			jQuery(this).toggleClass('active_not_taken_hidden_quiz');
			jQuery('.sqb_user_taken_hidden_selected_quiz_ids_outer').show();
			if(jQuery(this).hasClass('active_not_taken_hidden_quiz')){
				jQuery('ul.sqb_user_taken_hidden_selected_quiz_ids').append('<li data-id='+url_id+'>'+page_title+' (ID:'+url_id+')</li>');
			} else {
				jQuery("ul.sqb_user_taken_hidden_selected_quiz_ids li[data-id='" + url_id + "']").remove();
			}
			if(jQuery('.sqb_user_taken_hidden_selected_quiz_ids li').length == 0){
				jQuery('.sqb_user_taken_hidden_selected_quiz_ids_outer').hide();
			}
		}
		jQuery('.sqb_user_taken_hidden_selected_quiz_ids').sortable();
	});




	jQuery('body').on('click','.sqb_btn_container a',function(event){
		event.preventDefault();
	});

	jQuery('#dm_engagement_temp_wid').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'px';
		jQuery("body").get(0).style.setProperty("--dm-engagement-temp-wid", get_val);
	});
	jQuery('#dm_engagement_temp_border_width').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'px';
		jQuery("body").get(0).style.setProperty("--dm-engagement-temp-border-width", get_val);
	});
	jQuery('#dm_engagement_temp_border_radius').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'px';
		jQuery("body").get(0).style.setProperty("--dm-engagement-temp-border-radius", get_val);
	});
	jQuery('#dm_engagement_completed_image_height').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'px';
		jQuery("body").get(0).style.setProperty("--dm-engagement-completed-image-height", get_val);
	});
	jQuery('#dm_engagement_completed_template_width').bootstrapSlider().change(function() {
		var temp_select = jQuery('#template-percentage-selection').val();
		if(temp_select == "percentage"){
			var get_val = jQuery(this).val()+'%';
		}else{
			var get_val = jQuery(this).val()+'px';
		}
		jQuery("body").get(0).style.setProperty("--dm-engagement-completed-template-width", get_val);
  		jQuery('.tempate-slider-for-px-percentage input[type="number"]').val(jQuery(this).val());

	});
	jQuery('#dm_engagement_completed_template_width_in_px').bootstrapSlider().change(function() {
		var temp_select = jQuery('#template-percentage-selection').val();
		if(temp_select == "percentage"){
			var get_val = jQuery(this).val()+'%';
		}else{
			var get_val = jQuery(this).val()+'px';
		}
		jQuery("body").get(0).style.setProperty("--dm-engagement-completed-template-width", get_val);
	  	jQuery('.tempate-slider-for-px-percentage input[type="number"]').val(jQuery(this).val());
	});
	jQuery('#dm_engagement_temp_shadow_spread_radius').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'px';
		jQuery("body").get(0).style.setProperty("--dm-engagement-temp-shadow-spread-radius", get_val);
	});
	jQuery('#dm_engagement_temp_shadow_blur_radius').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'px';
		jQuery("body").get(0).style.setProperty("--dm-engagement-temp-shadow-blur-radius", get_val);
	});
	jQuery('#dm_engagement_temp_shadow_horizontal_length').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'px';
		jQuery("body").get(0).style.setProperty("--dm-engagement-temp-shadow-horizontal-length", get_val);
	});
	jQuery('#dm_engagement_temp_shadow_vertical_length').bootstrapSlider().change(function() {
		var get_val = jQuery(this).val()+'px';
		jQuery("body").get(0).style.setProperty("--dm-engagement-temp-shadow-vertical-length", get_val);
	});


	jQuery('#dm_engagement_temp_border_color_div, #dm_engagement_temp_border_color').colorpicker().on('changeColor', function() {
		var get_val = jQuery(this).colorpicker('getValue');
		jQuery("body").get(0).style.setProperty("--dm-engagement-temp-border-color", get_val);
	}); 

	jQuery('#dm_engagement_temp_left_side_background_color_div, #dm_engagement_temp_left_side_background_color').colorpicker().on('changeColor', function() {
		var get_val = jQuery(this).colorpicker('getValue');
		jQuery("body").get(0).style.setProperty("--dm-engagement-temp-left-side-background-color", get_val);
	}); 
	jQuery('#dm_engagement_temp_shadow_color_div, #dm_engagement_temp_shadow_color').colorpicker().on('changeColor', function() {
		var get_val = jQuery(this).colorpicker('getValue');
		jQuery("body").get(0).style.setProperty("--dm-engagement_temp-shadow-color", get_val);
	}); 
	jQuery('#completed_quiz_background_color_div, #completed_quiz_background_color').colorpicker().on('changeColor', function() {
		var get_val = jQuery(this).colorpicker('getValue');
		jQuery("body").get(0).style.setProperty("--completed-quiz-background-color", get_val);
	}); 
	jQuery('#not_started_background_div, #not_started_background').colorpicker().on('changeColor', function() {
		var get_val = jQuery(this).colorpicker('getValue');
		jQuery("body").get(0).style.setProperty("--not-started-background", get_val);
	}); 

	jQuery('#dm_engagement_temp_aligment').on('change', function() {
		var get_val = jQuery(this).val();
		jQuery("body").get(0).style.setProperty("--dm-engagement-temp-aligment", get_val);
		if(get_val == "none"){
			jQuery('.sqb_member_engagement_full_width_temp').addClass('template-align-none');	
			jQuery('.sqb_member_engagement_full_width_temp').removeClass('template-align-left');	
			jQuery('.sqb_member_engagement_full_width_temp').removeClass('template-align-right');	
		}else if(get_val == "left"){
			jQuery('.sqb_member_engagement_full_width_temp').removeClass('template-align-none');	
			jQuery('.sqb_member_engagement_full_width_temp').addClass('template-align-left');	
			jQuery('.sqb_member_engagement_full_width_temp').removeClass('template-align-right');	
		}else if(get_val == "right"){
			jQuery('.sqb_member_engagement_full_width_temp').removeClass('template-align-none');	
			jQuery('.sqb_member_engagement_full_width_temp').removeClass('template-align-left');	
			jQuery('.sqb_member_engagement_full_width_temp').addClass('template-align-right');	
		}
	});
	jQuery('#dm_engagement_temp_border_style').on('change', function() {
		var get_val = jQuery(this).val();
		jQuery("body").get(0).style.setProperty("--dm-engagement-temp-border-style", get_val);
		
	});
	
	jQuery('#dm_engagement_completed_image_height_type').on('click',function(){
		if(jQuery(this).prop('checked')){
			jQuery('.start_temp_img_width').hide();
			jQuery('.sqb_member_engagement_full_width_temp').addClass('image-height-auto');			
		}else{
			jQuery('.start_temp_img_width').show();
			jQuery('.sqb_member_engagement_full_width_temp').removeClass('image-height-auto');			
			
		}
	});

	jQuery('#template-percentage-selection').on('change', function() {
	  if (this.value == 'px') {
	  		var get_val = 400;
		  	jQuery('input[name="percentagepixel-input"]').val('400');
		  	jQuery('#dm_engagement_completed_template_width_in_px').bootstrapSlider('setValue', '400');
	  		jQuery("body").get(0).style.setProperty("--dm-engagement-completed-template-width", get_val+"px");
	  		jQuery('.tempate-slider-for-percentage').hide();
	  		jQuery('.tempate-slider-for-pixel').show();
	  		jQuery('.tempate-slider-for-px-percentage input[type="number"]').val(jQuery('#dm_engagement_completed_template_width_in_px').val());
	  		//var get_val = jQuery('input[name="percentagepixel-input"]').val();
	  		//jQuery("body").get(0).style.setProperty("--dm-engagement-completed-template-width", get_val+"px");
	  }else{
	  	var get_val = 33.33;
	  	jQuery('input[name="percentagepixel-input"]').val('33.33');
	  	jQuery('#dm_engagement_completed_template_width').bootstrapSlider('setValue', '33.33');
  		jQuery("body").get(0).style.setProperty("--dm-engagement-completed-template-width", get_val+"%");
	  	jQuery('.tempate-slider-for-pixel').hide();
	  	jQuery('.tempate-slider-for-percentage').show();
	  	jQuery('.tempate-slider-for-px-percentage input[type="number"]').val(jQuery('#dm_engagement_completed_template_width').val());
	  }
	});

	jQuery('input[name="percentagepixel-input"]').on('input', function(){
		var get_val = jQuery(this).val();
		if(jQuery('#template-percentage-selection').val() == "px"){
			jQuery('#dm_engagement_completed_template_width_in_px').bootstrapSlider('setValue', get_val);
			jQuery("body").get(0).style.setProperty("--dm-engagement-completed-template-width", get_val+'px');

		}else{
			jQuery('#dm_engagement_completed_template_width').bootstrapSlider('setValue', get_val);
			jQuery("body").get(0).style.setProperty("--dm-engagement-completed-template-width", get_val+'%');
		}
	})
	

	jQuery('.Template-Customize_heading').on('click',function(){		 
		jQuery('.Template-Customize-Setting').find('.customize_open').show();
		jQuery('.Template-Customize-Setting').find('.customize_close').hide();
		jQuery('.Template-Customize-Setting').find('.customizer_innner_sections').hide('slow');
		if(jQuery(this).closest('.Template-Customize-Setting').find('.customizer_innner_sections').css("display") =="none"){
			jQuery(this).closest('.Template-Customize-Setting').find('.customize_open').hide();
			jQuery(this).closest('.Template-Customize-Setting').find('.customize_close').show();
			jQuery(this).closest('.Template-Customize-Setting').find('.customizer_innner_sections').show('slow');
		}else{
			jQuery(this).closest('.Template-Customize-Setting').find('.customize_open').show();
			jQuery(this).closest('.Template-Customize-Setting').find('.customize_close').hide();
			jQuery(this).closest('.Template-Customize-Setting').find('.customizer_innner_sections').hide('slow');
		}
	});

	jQuery('body').on('click','.sqb_closed_ufp_customizer_opiton',function(){
		jQuery(this).closest('.Template-Customize-Setting ').find('.customizer_innner_sections').hide();
	});


	jQuery('.general-tabs-v2 li.nav-item').on('click','a', function () {
		var tab = jQuery(this).attr('data-tab');
		if(tab == "customizer" || tab == "settings" || tab == "student_shortcode"){
			var student_id = jQuery('#student_id').val();
			if(student_id == ""){
				swal("Please save data");
				return false;
			}
		}
	});
});

function sqb_save_member_data(next){


	var active_tab = jQuery("ul.nav-tabs li a.active").attr('data-tab');
	
	if(active_tab == "general_settings"){
		var completed_quiz_array = [];
		jQuery('.sqb_logged_in_selected_quiz_ids li').each(function(){
			var get_id = jQuery(this).attr('data-id');
			completed_quiz_array.push(get_id);
		});

		var completed_hidden_quiz_array = [];
		jQuery('.sqb_logged_in_hidden_selected_quiz_ids li').each(function(){
			var get_id = jQuery(this).attr('data-id');
			completed_hidden_quiz_array.push(get_id);
		});

		var not_taken_quiz_array = [];
		jQuery('.sqb_user_taken_selected_quiz_ids li').each(function(){
			var get_id = jQuery(this).attr('data-id');
			not_taken_quiz_array.push(get_id);
		});

		var not_taken_hidden_quiz_array = [];
		jQuery('.sqb_user_taken_hidden_selected_quiz_ids li').each(function(){
			var get_id = jQuery(this).attr('data-id');
			not_taken_hidden_quiz_array.push(get_id);
		});

		var student_data = {'completed_quiz_array': completed_quiz_array, 'completed_hidden_quiz_array': completed_hidden_quiz_array, 'not_taken_quiz_array': not_taken_quiz_array, 'not_taken_hidden_quiz_array': not_taken_hidden_quiz_array};

		var temp_name = jQuery('#name').val();
		if(temp_name == ""){
			jQuery('.page_response').append('<div class="enter-name-error">Please Enter Name</div>');
			return false;
		}else{
			jQuery('.enter-name-error').remove();
		}
		

	}else if(active_tab == "customizer"){
		var dm_engagement_temp_wid = jQuery("#dm_engagement_temp_wid").val();
		var dm_engagement_temp_border_width = jQuery("#dm_engagement_temp_border_width").val();
		var dm_engagement_temp_border_radius = jQuery("#dm_engagement_temp_border_radius").val();
		var dm_engagement_temp_shadow_spread_radius = jQuery("#dm_engagement_temp_shadow_spread_radius").val();
		var dm_engagement_temp_shadow_blur_radius = jQuery("#dm_engagement_temp_shadow_blur_radius").val();
		var dm_engagement_temp_shadow_horizontal_length = jQuery("#dm_engagement_temp_shadow_horizontal_length").val();
		var dm_engagement_temp_shadow_vertical_length = jQuery("#dm_engagement_temp_shadow_vertical_length").val();
		var dm_engagement_completed_image_height = jQuery("#dm_engagement_completed_image_height").val();
		
		var dm_engagement_temp_left_side_background_color= jQuery("#dm_engagement_temp_left_side_background_color").colorpicker('getValue');
		var dm_engagement_temp_border_color= jQuery("#dm_engagement_temp_border_color").colorpicker('getValue');
		var dm_engagement_temp_shadow_color= jQuery("#dm_engagement_temp_shadow_color").colorpicker('getValue');
		var completed_quiz_background_color= jQuery("#completed_quiz_background_color").colorpicker('getValue');
		var not_started_background_color= jQuery("#not_started_background_color").colorpicker('getValue');

		var dm_engagement_temp_aligment = jQuery("#dm_engagement_temp_aligment").val();
		var dm_engagement_temp_border_style = jQuery("#dm_engagement_temp_border_style").val();

		if(jQuery('#dm_engagement_completed_image_height_type').prop('checked') == true){
			var dm_engagement_completed_image_height_type = "Y";
		}else{
			var dm_engagement_completed_image_height_type = "N";
		}

		if(jQuery('#dm_engagement_enable_certificate').prop('checked') == true){
			var dm_engagement_enable_certificate = "Y";
		}else{
			var dm_engagement_enable_certificate = "N";
		}

		if(jQuery('#dm_engagement_enable_retake').prop('checked') == true){
			var dm_engagement_enable_retake = "Y";
		}else{
			var dm_engagement_enable_retake = "N";
		}

		if(jQuery('#template-percentage-selection').val() == "px"){
			var dm_engagement_completed_template_width = jQuery("#dm_engagement_completed_template_width_in_px").val();
		}else{
			var dm_engagement_completed_template_width = jQuery("#dm_engagement_completed_template_width").val();
		}
		var template_percentage_selection = jQuery('#template-percentage-selection').val();

		var customizer_data = {'dm_engagement_temp_wid': dm_engagement_temp_wid, 'dm_engagement_temp_border_width': dm_engagement_temp_border_width, 'dm_engagement_temp_border_radius':dm_engagement_temp_border_radius,'dm_engagement_temp_shadow_spread_radius':dm_engagement_temp_shadow_spread_radius, 'dm_engagement_temp_shadow_blur_radius':dm_engagement_temp_shadow_blur_radius, 'dm_engagement_temp_shadow_horizontal_length':dm_engagement_temp_shadow_horizontal_length, 'dm_engagement_temp_shadow_vertical_length': dm_engagement_temp_shadow_vertical_length, 'dm_engagement_temp_left_side_background_color': dm_engagement_temp_left_side_background_color, 'dm_engagement_temp_border_color': dm_engagement_temp_border_color, 'dm_engagement_temp_shadow_color': dm_engagement_temp_shadow_color, 'completed_quiz_background_color': completed_quiz_background_color, 'not_started_background_color': not_started_background_color, 'dm_engagement_temp_aligment': dm_engagement_temp_aligment, 'dm_engagement_temp_border_style': dm_engagement_temp_border_style, 'dm_engagement_completed_image_height_type':dm_engagement_completed_image_height_type,'dm_engagement_enable_certificate':dm_engagement_enable_certificate,'dm_engagement_enable_retake':dm_engagement_enable_retake, 'dm_engagement_completed_template_width': dm_engagement_completed_template_width, 'template_percentage_selection':template_percentage_selection, 'dm_engagement_completed_image_height': dm_engagement_completed_image_height };

		var completed_html = jQuery('.completed-quizs-list .completed-quiz-block').html();
		var completed_title_text = jQuery('.sqb_member_engagement_full_width_temp .completed-quiz-title').html();
		var not_started_html = jQuery('.completed-quizs-list .not-started-quiz-block').html();
		var notstarted_title_text = jQuery('.sqb_member_engagement_full_width_temp .not-started-title').html();

		var html_data = { 'completed_title': completed_title_text, 'completed_html': completed_html, 'notstarted_title':notstarted_title_text, 'not_started_html': not_started_html}
		
	}else if(active_tab == "settings"){
		SQBShowLoader();
		var quiz_array = {};
		jQuery('.quiz-global-settings tr').each(function(){
			var quiz_id = jQuery(this).attr('data-quiz-id');
			var image = jQuery(this).find(".sqb-upload img").attr('src');
			var redirect_url = jQuery(this).find("input[name='quiz_page_url']").val();
			if(image || redirect_url){
				var image_and_redirect_url = {'image': image, 'redirect_url': redirect_url};
				quiz_array[quiz_id] = image_and_redirect_url;
				// quiz_array.push(image_and_redirect_url);
			}
		});
		jQuery.post(ajaxurl, {
				action: 'sqb_save_member_all_quiz_data',
				quiz_array: quiz_array,
				}, function(response) {
					SQBHideLoader();
					jQuery('<div class="saved_member_data sucess_message">Saved successfully.</div>').insertAfter('.student-save-data');
					setTimeout(function(){
						jQuery('.saved_member_data').remove();
					}, 2000);

					if(active_tab == "settings"){
						if(next){
							jQuery('.general-tabs-v2 li:eq(3) a').trigger('click');
						}
					}
				});
		return false;
	}

	var id = jQuery('#student_id').val();

	SQBShowLoader();
	jQuery.post(ajaxurl, {
		action: 'sqb_save_member_data',
		id: id,
		active_tab: active_tab,
		temp_name:temp_name,
		customizer_data:customizer_data,
		html_data:html_data,
		student_data:student_data,
	}, function(response) {
		SQBHideLoader();
		jQuery('<div class="saved_member_data sucess_message">Saved successfully.</div>').insertAfter('.student-save-data');
		setTimeout(function(){
			jQuery('.saved_member_data').remove();
		}, 2000);

		response = JSON.parse(response);
		if(response.status){
			jQuery('#student_id').val(response.status);
			jQuery('.student_shortcode_id').text("[SQBStudentDashboard id="+response.status+"][/SQBStudentDashboard]");
		}
		if(response.table_data){
			jQuery('.quiz-global-settings').html(response.table_data);
		}
		var shortcode_name = jQuery('#name').val();
		jQuery('#student_shortcode_tab').find('.sqb_detail_quiz_name').text('');
		jQuery('#student_shortcode_tab').find('.sqb_detail_quiz_name').text(shortcode_name);

		if(active_tab == "general_settings"){
			if(next){
				jQuery('.general-tabs-v2 li:eq(1) a').trigger('click');
			}
		}else if(active_tab == "customizer"){
			if(next){
				jQuery('.general-tabs-v2 li:eq(2) a').trigger('click');
			}
		}

	});
}

function sqb_member_create_page($obj){
		$parent_selector = '#settings_general';
		post_title = jQuery($parent_selector).find('input[name="name"]').val();
		
		if(post_title == ''){
			$message = "Please Enter a Name for your Page";
			swal($message);
			return ;
		}
		
		SQBShowLoader();
		jQuery($obj).text('Creating...');
		jQuery.post(ajaxurl, {
			action: 'sqbMemberGenerateWpPage',
			post_title:post_title,
		}, function(response) {
			SQBHideLoader();
			jQuery($obj).text('Click to Create');
			$parent_selector = '.page_response';
			
			response = JSON.parse(response);
			
			jQuery($parent_selector).removeClass('text-success text-danger');
			if(response.status == 'yes'){
				$message = "Sorry, This Name is already taken. Please Try with another one.";
				jQuery($parent_selector).text($message).addClass('text-danger');
				return ;
			}else if(response.status == 'no'){
				$message = "Login Page created successfully.";
				jQuery($parent_selector).text($message).addClass('text-success');
				jQuery('#settings_general input[name="page_id"]').val(response.post_id);
				return ;
			}
			
		    	
		});
    }

jQuery( function($){
	// on upload button click
	jQuery( 'body' ).on( 'click', '.sqb-upload', function( event ){
		event.preventDefault(); // prevent default link click and page refresh
		
		const button = $(this)
		const imageId = button.next().next().val();
		
		const customUploader = wp.media({
			title: 'Insert image', // modal window title
			library : {
				// uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
				type : 'image'
			},
			button: {
				text: 'Use this image' // button label text
			},
			multiple: false
		}).on( 'select', function() { // it also has "open" and "close" events
			const attachment = customUploader.state().get( 'selection' ).first().toJSON();
			button.removeClass( 'button' ).html( '<img src="' + attachment.url + '">'); // add image instead of "Upload Image"
			button.next().show(); // show "Remove image" link
			button.next().next().val( attachment.id ); // Populate the hidden field with image ID
			button.parent('.image-upload-on-member-profile-page').find(".no-image").remove();
		})
		
		// already selected images
		customUploader.on( 'open', function() {

			if( imageId ) {
			  const selection = customUploader.state().get( 'selection' )
			  attachment = wp.media.attachment( imageId );
			  attachment.fetch();
			  selection.add( attachment ? [attachment] : [] );
			}
			
		})

		customUploader.open()
	
	});
	// on remove button click
	jQuery( 'body' ).on( 'click', '.sqb-remove', function( event ){
		event.preventDefault();
		const button = $(this);
		button.next().val( '' ); // emptying the hidden field
		button.hide().prev().addClass( 'button' ).html( 'Upload image' ); // replace the image with text
	});
});

function sqb_mp_table_datatable_call(){
	var attribute_table_type = jQuery('.sqb_member_page_table_class').attr('attribute_table_type');
	var member_page_type = jQuery('.sqb_member_page_table_class').attr('member_page_type');
	var sqb_table_sort_var = [[ 0, "desc" ],[ 3, "desc" ]];
	if(attribute_table_type == 'single_type_page'){
		sqb_table_sort_var = [[ 0, "desc" ],[ 3, "desc" ]];
	}
	var pagination_len = 10;
	if(member_page_type == 'engagement'){
		sqb_table_sort_var = [[2, "desc" ]];
		pagination_len = 4;
	}
	
	jQuery('#sqb_member_page_table').DataTable({
		responsive: true,
			"language": {
				"emptyTable": "No Shortcodes Found"
			},
			 "iDisplayLength": 10,
			"order": sqb_table_sort_var,
			"fnInitComplete": function (){			 
				//dap_member_hide_loader(); 
				jQuery('.sqb_member_page_table_class').show();		
					 
			}
	}); 
	jQuery('#sqb_member_course_page_table').DataTable({
		responsive: true,
			"language": {
				"emptyTable": "No Shortcodes Found"
			},
			 "iDisplayLength":10,

			"order": [[2, "desc" ]],
			"fnInitComplete": function (){			 
				//dap_member_hide_loader(); 
				jQuery('.sqb_member_page_table_class').show();		
					 
			}
	}); 
	
}

function sqb_member_copy_to_clipboard(obj) {
	jQuery(obj).text('Copied');
	var elementId = jQuery(obj).attr("data-id");
	var aux = document.createElement("input");
	aux.setAttribute("value", document.getElementById(elementId).innerHTML);
	document.body.appendChild(aux);
	aux.select();
	document.execCommand("copy"); 
	document.body.removeChild(aux);
}

function sqb_member_engagement_delete_by_id_new(){
	
	jQuery(document).on('click','.delete_member_enagegement_by_id',function(e){
		e.preventDefault();
		var current_obj = this;
		var id = jQuery(this).attr('data-id'); 
		swal({
		  title: "Are you sure?",
		  text: "Please confirm if you want to delete.",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete['value'] == true) {
				sqb_member_show_loader();
				jQuery.post(ajaxurl, {
						action: 'sqbDeleteMemberEngagementByIdAjax',
						id: id,  
				}, function(response) {
					//swal('Deleted Successfully!');
					jQuery('.sqb-page-delete-alert').show();
					setTimeout(function() {
				        jQuery('.sqb-page-delete-alert').hide();
				    }, 5000);
				    
					sqb_member_hide_loader();
					var table = jQuery(current_obj).closest('.sqb_member_page_table_class').DataTable();
					table.row(jQuery(current_obj).closest('.sqb_member_page_table_class').find('tr.sqb_member_manage_page_row_id_'+id)).remove().draw();
					//location.reload();
				});
			}else{
				return false;	
			}
		});
	});	
}

function sqb_member_show_loader(){
	jQuery('.sqb_member_loading_wrapper').show();
}

function sqb_member_hide_loader(){
	jQuery('.sqb_member_loading_wrapper').hide();
}