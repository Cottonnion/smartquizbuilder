jQuery(document).ready(function(){

	sqb_tiny_mce_editor();
	sqb_lb_table_datatable_call();
	sqb_leaderboard_text_tiny_mce_editor();
	sqb_leaderboard_delete_by_id();


	jQuery('.clone_leaderboard_by_id').on('click',function(){		 
		var leaderboard_id = jQuery(this).attr('data-id');
		if(leaderboard_id == '' || leaderboard_id == 0){
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
				sqb_leaderboard_show_loader();
				jQuery.post(ajaxurl, {
				action: 'sqb_clone_leaderboard_by_id',
				leaderboard_id: leaderboard_id ,
							 
				}, function(response) {		  
					swal('','Clone Completed',"success");
					sqb_leaderboard_hide_loader();
					location.reload();		 
				});
			}
		});
	});
	
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
	
	jQuery(document).on('change', '#retake_option' , function(){
		if(jQuery(this).prop('checked') == true){
			jQuery("#selected_order").val('highest_score');
			jQuery('#selected_order option[value="first_submission"]').hide();
			jQuery('#selected_order option[value="last_submission"]').hide();
		}else{
			jQuery('#selected_order option[value="first_submission"]').show();
			jQuery('#selected_order option[value="last_submission"]').show();

		}
	});

 	var date = new Date();
 	var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
	
	jQuery('#sqb_start_date').removeClass('hasDatepicker').datepicker({
		format: "yyyy-mm-dd",
		todayHighlight: true,
		autoclose: true
	}); 

	jQuery('#sqb_end_date').removeClass('hasDatepicker').datepicker({
		format: "yyyy-mm-dd",
		todayHighlight: true,
		autoclose: true
	}); 

	jQuery(window).scroll(function(){
		var sticky = jQuery('.member-Template-Customize-setting-outer'),
		scroll = jQuery(window).scrollTop();
		if (scroll >= 100) sticky.addClass('fixed');
		else sticky.removeClass('fixed');
	});
	
	

	jQuery('.general-tabs-v2 li.nav-item').on('click','a', function () {
		var tab = jQuery(this).attr('data-tab');
		if(tab == "customizer" || tab == "leaderboard_shortcode"){
			var leaderboard_id = jQuery('#leaderboard_id').val();
			if(leaderboard_id == ""){
				swal("Please save data");
				return false;
			}
		}
	});

	jQuery('input[name="select_date_range"]').on('change', function(){
		if(jQuery(this).val() == 'range'){
			jQuery('.sqb_time_period_date_range').show('slow');
		}else{
			jQuery('.sqb_time_period_date_range').hide('slow');
		}
	});

	jQuery(document).on('click', '.leaderboard-embed-btn', function(){
		var sqb_site_url = jQuery("#get_home_url").val();
		var leaderboard_id = jQuery('#leaderboard_id').val();
		var embedCode = '<div style="width: 100%;"><iframe style=" min-width: 100%; width: 100%; height: 100vh;" src="'+sqb_site_url+'?lb-embed=1&lbid='+leaderboard_id+'" frameborder="0" scrolling="auto"></iframe></div> '; 
		jQuery('#embedCodeLeaderboardModal').modal('show');
		jQuery('#copyLeaderboardEmbedCodeOuter').text(embedCode); 
	});

	jQuery('.sqb_leaderboard_back_btn').on('click', function(){
		var active_tab = jQuery("ul.nav-tabs li a.active").attr('data-tab');
		if(active_tab == 'leaderboard_shortcode'){
			jQuery('.general-tabs-v2 li:eq(1) a').trigger('click');
		}else if(active_tab == "customizer"){
			jQuery('.general-tabs-v2 li:eq(0) a').trigger('click');
		}
	})

	jQuery('#quiz_option_selected').on('change', function(){
		var quiz_type = jQuery(this).val();
		sqb_leaderboard_show_loader();
		jQuery.post(ajaxurl, {
			action: 'sqb_load_quiz_data',
			quiz_type: quiz_type,  
			}, function(response) {
			sqb_leaderboard_hide_loader();
			var get_data = JSON.parse(response);
			if(get_data){
				jQuery('ul.sqb_leaderboard_selected_quiz_ids').html('');
				jQuery('.sqb_leaderboard_select_quiz_ids').html('');
				jQuery('.sqb_selected_quiz_ids_outer').hide();
				jQuery('.sqb_leaderboard_select_quiz_ids').append(get_data);
			}
		});
	});

	jQuery(document).on('keyup','#sqb_search_quiz_ids',function() {
		var allpostlist = [];
		var str2 = jQuery(this).val().toLowerCase();	 
		var i = 0;
		jQuery("ul.sqb_leaderboard_select_quiz_ids li").each(function() {
			var str1 = jQuery(this).text().toLowerCase();
			if (str1.indexOf(str2) != -1) {
				allpostlist[i++] = jQuery(this).attr("data-title");
			}
		});

		jQuery("ul.sqb_leaderboard_select_quiz_ids li").each(function() {
			if (jQuery.inArray(jQuery(this).attr("data-title"), allpostlist) !== -1) {
				jQuery(this).show();
			} else {
				jQuery(this).hide();
			}
		});
	});

	jQuery('body').on('click','ul.sqb_leaderboard_select_quiz_ids li',function(){
		var page_title = jQuery(this).attr('data-value');
		if(page_title){
			if(page_title == "all"){
				if(jQuery('.sqb_leaderboard_select_quiz_ids .all_selected_ids').hasClass('selectedquiz_ids')){
					jQuery('ul.sqb_leaderboard_select_quiz_ids li').removeClass('selectedquiz_ids');
					jQuery('ul.sqb_leaderboard_selected_quiz_ids').html('');
					jQuery('.sqb_selected_quiz_ids_outer').hide();

				}else{
					jQuery('ul.sqb_leaderboard_select_quiz_ids li').removeClass('selectedquiz_ids');
					jQuery('ul.sqb_leaderboard_select_quiz_ids .all_selected_ids').addClass('selectedquiz_ids');

					//jQuery('ul.sqb_leaderboard_select_quiz_ids li').addClass('selectedquiz_ids');
					jQuery('ul.sqb_leaderboard_selected_quiz_ids').html('');

					jQuery('.sqb_leaderboard_select_quiz_ids .user_taken_ids').each(function(){
						var all_url_id = jQuery(this).attr('data-id');
						var all_page_title = jQuery(this).attr('data-value');
						if(all_url_id){
							jQuery('.sqb_selected_quiz_ids_outer').show();
							jQuery('ul.sqb_leaderboard_selected_quiz_ids').append('<li data-id='+all_url_id+'>'+all_page_title+' (ID:'+all_url_id+')</li>');
						}
					});
				}
			}else{
				if(jQuery('.sqb_leaderboard_select_quiz_ids .all_selected_ids').hasClass('selectedquiz_ids')){
					jQuery('ul.sqb_leaderboard_selected_quiz_ids').html('');
				}
				jQuery('.sqb_leaderboard_select_quiz_ids .all_selected_ids').removeClass('selectedquiz_ids');
				var url_id = jQuery(this).attr('data-id');
				jQuery(this).toggleClass('selectedquiz_ids');
				jQuery('.sqb_selected_quiz_ids_outer').show();
				if(jQuery(this).hasClass('selectedquiz_ids')){
					jQuery('ul.sqb_leaderboard_selected_quiz_ids').append('<li data-id='+url_id+'>'+page_title+' (ID:'+url_id+')</li>');
				} else {
					jQuery("ul.sqb_leaderboard_selected_quiz_ids li[data-id='" + url_id + "']").remove();
				}
				if(jQuery('.sqb_leaderboard_selected_quiz_ids li').length == 0){
					jQuery('.sqb_selected_quiz_ids_outer').hide();
				}

				/*if(jQuery('ul.sqb_leaderboard_select_quiz_ids li.selectedquiz_ids').length == 0){
					var url_id = jQuery(this).attr('data-id');
					jQuery(this).addClass('selectedquiz_ids');
					jQuery('.sqb_selected_quiz_ids_outer').show();
					jQuery('ul.sqb_leaderboard_selected_quiz_ids').append('<li data-id='+url_id+'>'+page_title+' (ID:'+url_id+')</li>');
				}else{
					jQuery(this).removeClass('selectedquiz_ids');
					var url_id = jQuery(this).attr('data-id');
					jQuery("ul.sqb_leaderboard_selected_quiz_ids li[data-id='" + url_id + "']").remove();
					if(jQuery('.sqb_leaderboard_selected_quiz_ids li').length == 0){
						jQuery('.sqb_selected_quiz_ids_outer').hide();
					}
				}*/

			}
		}
	});


	jQuery('body').on('click','.sqb_closed_ufp_customizer_opiton',function(){
		jQuery(this).closest('.Template-Customize-Setting ').find('.customizer_innner_sections').hide();
	});

	var page = sqb_leaderboard_getUrlVars()["page"];
	if(page == "sqb_create_leaderboard_page"){
		jQuery('#lb_template_width').bootstrapSlider().change(function() {
			var current_val = jQuery(this).val();
			var get_val = jQuery(this).val()+'px';
			jQuery("body").get(0).style.setProperty("--lb-template-width", get_val);
			jQuery('input[name="lb_select_background_width"]').val(current_val);
		});

		jQuery('#lb_template_height').bootstrapSlider().change(function() {
			var current_val = jQuery(this).val();
			var get_val = jQuery(this).val()+'px';
			jQuery("body").get(0).style.setProperty("--lb-template-height", get_val);
			jQuery('input[name="lb_select_background_height"]').val(current_val);
		});

		jQuery('#lb_template_width_percentage').bootstrapSlider().change(function() {
			var current_val = jQuery(this).val();
			var get_val = jQuery(this).val()+'%';
			jQuery("body").get(0).style.setProperty("--lb-template-width", get_val);
			jQuery('input[name="lb_select_background_width"]').val(current_val);
		});

		jQuery('#lb_template_height_vh').bootstrapSlider().change(function() {
			var current_val = jQuery(this).val();
			var get_val = jQuery(this).val()+'vh';
			jQuery("body").get(0).style.setProperty("--lb-template-height", get_val);
			jQuery('input[name="lb_select_background_height"]').val(current_val);
		});

		jQuery('#lb_temp_background_opacity').bootstrapSlider().change(function() {
			var get_val = jQuery(this).val();
			jQuery("body").get(0).style.setProperty("--lb-template-background-opacity", get_val);
		});

		jQuery('#lb_temp_internal_width').bootstrapSlider().change(function() {
			var get_val = jQuery(this).val()+'px';
			var get_original_val = jQuery(this).val();
			jQuery("body").get(0).style.setProperty("--lb-temp-internal-width", get_val);
			jQuery('input[name="lb_select_internal_background_width"]').val(get_original_val);
		});

		jQuery('#lb_temp_internal_width_percentage').bootstrapSlider().change(function() {
			var get_val = jQuery(this).val()+'%';
			var get_original_val = jQuery(this).val();
			jQuery("body").get(0).style.setProperty("--lb-temp-internal-width", get_val);
			jQuery('input[name="lb_select_internal_background_width"]').val(get_original_val);
		});

		jQuery('#lb_temp_border_width').bootstrapSlider().change(function() {
			var get_val = jQuery(this).val();
			jQuery("body").get(0).style.setProperty("--lb-temp-border-width", get_val);
		});

		jQuery('#lb_temp_border_radius').bootstrapSlider().change(function() {
			var get_val = jQuery(this).val()+'px';
			jQuery("body").get(0).style.setProperty("--lb-temp-border-radius", get_val);
		});	

		jQuery('#lb_temp_shadow_color_div, #lb_temp_shadow_color').colorpicker().on('changeColor', function() {
			var get_val = jQuery(this).colorpicker('getValue');
			jQuery("body").get(0).style.setProperty("--lb-temp-shadow-color", get_val);
		}); 

		
		jQuery('#lb_temp_spread_radius').bootstrapSlider().change(function() {
			var get_val = jQuery(this).val()+'px';
			jQuery("body").get(0).style.setProperty("--lb-temp-spread-radius", get_val);
		});	

		jQuery('#lb_temp_blur_radius').bootstrapSlider().change(function() {
			var get_val = jQuery(this).val()+'px';
			jQuery("body").get(0).style.setProperty("--lb-temp-blur-radius", get_val);
		});

		jQuery('#lb_temp_horizontal_length').bootstrapSlider().change(function() {
			var get_val = jQuery(this).val()+'px';
			jQuery("body").get(0).style.setProperty("--lb-temp-horizontal-length", get_val);
		});

		jQuery('#lb_temp_vertical_length').bootstrapSlider().change(function() {
			var get_val = jQuery(this).val()+'px';
			jQuery("body").get(0).style.setProperty("--lb-temp-vertical-length", get_val);
		});

		jQuery('.lb-select-background-width-option').on('change', function(){
			if(jQuery(this).val() == "%"){
				jQuery("#lb_template_width_percentage").bootstrapSlider('setValue', 100);
				jQuery('input[name="lb_select_background_width"]').val(100);
				jQuery('.lb_template_width_percentage_outer').show();
				jQuery('.lb_template_width_outer').hide();
			}else{
				jQuery("#lb_template_width_percentage").bootstrapSlider('setValue', 1400);
				jQuery('input[name="lb_select_background_width"]').val(1400);
				jQuery('.lb_template_width_percentage_outer').hide();
				jQuery('.lb_template_width_outer').show();
			}
		});

		jQuery('.lb-select-background-height-option').on('change', function(){
			if(jQuery(this).val() == "vh"){
				jQuery("#lb_template_height_vh").bootstrapSlider('setValue', 100);
				jQuery('input[name="lb_select_background_height"]').val(100);
				jQuery('.lb_template_height_vh_outer').show();
				jQuery('.lb_template_height_outer').hide();
			}else{
				jQuery("#lb_template_height_vh").bootstrapSlider('setValue', 500);
				jQuery('input[name="lb_select_background_height"]').val(500);
				jQuery('.lb_template_height_vh_outer').hide();
				jQuery('.lb_template_height_outer').show();
			}
		});

		jQuery('.lb-select-background-internal-width-option').on('change', function(){
			if(jQuery(this).val() == "%"){
				jQuery("#lb_temp_internal_width_percentage").bootstrapSlider('setValue', 100);
				jQuery('input[name="lb_select_internal_background_width"]').val(100);
				jQuery('.lb_temp_internal_width_percentage_outer').show();
				jQuery('.lb_temp_internal_width_outer').hide();
			}else{
				jQuery("#lb_temp_internal_width_percentage").bootstrapSlider('setValue', 1400);
				jQuery('input[name="lb_select_internal_background_width"]').val(1400);
				jQuery('.lb_temp_internal_width_percentage_outer').hide();
				jQuery('.lb_temp_internal_width_outer').show();
			}
		});

		jQuery('#lb_temp_aligment').on('change', function() {
			var get_val = jQuery(this).val();
			jQuery("body").get(0).style.setProperty("--dm-engagement-temp-aligment", get_val);
			if(get_val == "none"){
				jQuery('.sqb_leaderboard_engagement_full_width_temp').addClass('template-align-none');	
				jQuery('.sqb_leaderboard_engagement_full_width_temp').removeClass('template-align-left');	
				jQuery('.sqb_leaderboard_engagement_full_width_temp').removeClass('template-align-right');	
			}else if(get_val == "left"){
				jQuery('.sqb_leaderboard_engagement_full_width_temp').removeClass('template-align-none');	
				jQuery('.sqb_leaderboard_engagement_full_width_temp').addClass('template-align-left');	
				jQuery('.sqb_leaderboard_engagement_full_width_temp').removeClass('template-align-right');	
			}else if(get_val == "right"){
				jQuery('.sqb_leaderboard_engagement_full_width_temp').removeClass('template-align-none');	
				jQuery('.sqb_leaderboard_engagement_full_width_temp').removeClass('template-align-left');	
				jQuery('.sqb_leaderboard_engagement_full_width_temp').addClass('template-align-right');	
			}
		});

		jQuery('#lb_temp_background_color_div, #lb_temp_background_color').colorpicker().on('changeColor', function() {
			var get_val = jQuery(this).colorpicker('getValue');
			jQuery("body").get(0).style.setProperty("--lb-temp-background-color", get_val);
		}); 

		jQuery('#lb_temp_border_color_div, #lb_temp_border_color').colorpicker().on('changeColor', function() {
			var get_val = jQuery(this).colorpicker('getValue');
			jQuery("body").get(0).style.setProperty("--lb-temp-border-color", get_val);
		}); 

		jQuery('#lb_temp_border_style').on('change', function() {
			var get_val = jQuery(this).val();
			jQuery("body").get(0).style.setProperty("--lb-temp-border-style", get_val);
			
		});

		/*Inside Customizers*/

		jQuery('#lb_leaderboard_background_color_div, #lb_leaderboard_background_color').colorpicker().on('changeColor', function() {
			var get_val = jQuery(this).colorpicker('getValue');
			jQuery("body").get(0).style.setProperty("--lb-leaderboard-background-color", get_val);
		}); 

		jQuery('#lb_description_background_color_div, #lb_description_background_color').colorpicker().on('changeColor', function() {
			var get_val = jQuery(this).colorpicker('getValue');
			jQuery("body").get(0).style.setProperty("--lb-description-background-color", get_val);
		}); 

		jQuery('#lb_heading_background_color_div, #lb_heading_background_color').colorpicker().on('changeColor', function() {
			var get_val = jQuery(this).colorpicker('getValue');
			jQuery("body").get(0).style.setProperty("--lb-heading-background-color", get_val);
		}); 

		jQuery('#lb_alternate_background_color_div, #lb_alternate_background_color').colorpicker().on('changeColor', function() {
			var get_val = jQuery(this).colorpicker('getValue');
			jQuery("body").get(0).style.setProperty("--lb-alternate-background-color", get_val);
		}); 

		jQuery('#lb_alternate_second_background_color_div, #lb_alternate_second_background_color').colorpicker().on('changeColor', function() {
			var get_val = jQuery(this).colorpicker('getValue');
			jQuery("body").get(0).style.setProperty("--lb-alternate-second-background-color", get_val);
		}); 

		jQuery('#lb_optout_background_color_div, #lb_optout_background_color').colorpicker().on('changeColor', function() {
			var get_val = jQuery(this).colorpicker('getValue');
			jQuery("body").get(0).style.setProperty("--lb-optout-background-color", get_val);
		}); 
	}

	jQuery(document).on('click','.sqb_change_lb_bg_image',function() {
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
				jQuery('.leaderboard-bg img').show();
				jQuery('.leaderboard-bg img').attr('src',attachment.url);
			});
		
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','.sqb_remove_lb_bg_image',function() {
		jQuery('.leaderboard-bg img').attr('src', '');
		jQuery('.leaderboard-bg img').hide();
	});
});

	

function sqb_lb_table_datatable_call(){
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

function sqb_leaderboard_copy_to_clipboard(obj) {
	jQuery(obj).text('Copied');
	var elementId = jQuery(obj).attr("data-id");
	var aux = document.createElement("input");
	aux.setAttribute("value", document.getElementById(elementId).innerHTML);
	document.body.appendChild(aux);
	aux.select();
	document.execCommand("copy"); 
	document.body.removeChild(aux);
}

function sqb_leaderboard_engagement_delete_by_id_new(){
	
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
				sqb_leaderboard_show_loader();
				jQuery.post(ajaxurl, {
						action: 'sqbDeleteMemberEngagementByIdAjax',
						id: id,  
				}, function(response) {
					//swal('Deleted Successfully!');
					jQuery('.sqb-page-delete-alert').show();
					setTimeout(function() {
				        jQuery('.sqb-page-delete-alert').hide();
				    }, 5000);
				    
					sqb_leaderboard_hide_loader();
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

function sqb_save_leaderboard_data(next){
	var leaderboard_id = jQuery("#leaderboard_id").val();

	var leaderboard_name = jQuery("#leaderboard_name").val();
	if(leaderboard_name == ""){
		 jQuery('html, body').animate({
	        scrollTop: jQuery(".sqb_multiple_url_select").offset().top
	    }, 1000);
		jQuery('.leaderboard_name_error').show();
		return false;
	}else{
		jQuery('.leaderboard_name_error').hide();
	}
	var quiz_option_selected = jQuery("#quiz_option_selected").val();

	var selected_quiz_ids = jQuery('.sqb_leaderboard_selected_quiz_ids li').map(function() { 
    							return jQuery(this).attr('data-id')
							}).get().join(',');

	if(selected_quiz_ids == ""){
		 jQuery('html, body').animate({
	        scrollTop: jQuery(".select-quiz-outer").offset().top
	    }, 1000);
		jQuery('.select_quiz_error').show();
		return false;
	}else{
		jQuery('.select_quiz_error').hide();
	}

	var number_of_entries = jQuery('#number_of_entries').val();

	if(number_of_entries == ""){
		 jQuery('html, body').animate({
	        scrollTop: jQuery(".leaderboard-number-outer").offset().top
	    }, 1000);
		jQuery('.enter_number_error').show();
		return false;
	}else{
		jQuery('.enter_number_error').hide();
	}

	if(jQuery('#retake_option').prop('checked') == true){
		var retake_option = "Y";
	}else{
		var retake_option = "N";
	}

	var select_date_range = jQuery('input[name="select_date_range"]:checked').val();
	var sqb_start_date = jQuery('input[name="sqb_start_date"]').val();
	var sqb_end_date = jQuery('input[name="sqb_end_date"]').val();
	var leaderboard_nodata = tinymce.get('leaderboard_nodata').getContent();
	var selected_order = jQuery('#selected_order').val(); 
	
	var display_options = jQuery('#display_options').val(); 
	var score_format = jQuery('#score_format').val();
	var lb_temp_aligment = jQuery("#lb_temp_aligment").val();
	var lb_pagination = jQuery("#lb_pagination").val();
	var lb_temp_background_color = jQuery("#lb_temp_background_color").colorpicker('getValue');
	var lb_temp_border_width = jQuery("#lb_temp_border_width").val();
	var lb_temp_border_style = jQuery("#lb_temp_border_style").val();
	var lb_temp_border_color = jQuery("#lb_temp_border_color").colorpicker('getValue');
	var lb_temp_shadow_color = jQuery("#lb_temp_shadow_color").colorpicker('getValue');
	var lb_temp_border_radius = jQuery("#lb_temp_border_radius").val();
	var lb_temp_spread_radius = jQuery("#lb_temp_spread_radius").val();
	var lb_temp_blur_radius = jQuery("#lb_temp_blur_radius").val();
	var lb_temp_horizontal_length = jQuery("#lb_temp_horizontal_length").val();
	var lb_temp_vertical_length = jQuery("#lb_temp_vertical_length").val();
	
	var lb_temp_background_opacity = jQuery("#lb_temp_background_opacity").val();
	var lb_leaderboard_background_color = jQuery("#lb_leaderboard_background_color").val();
	var lb_description_background_color = jQuery("#lb_description_background_color").val();
	var lb_heading_background_color = jQuery("#lb_heading_background_color").val();
	var lb_alternate_background_color = jQuery("#lb_alternate_background_color").val();
	var lb_alternate_second_background_color = jQuery("#lb_alternate_second_background_color").val();
	var lb_optout_background_color = jQuery("#lb_optout_background_color").val();
	
	var lb_select_background_height_option = jQuery(".lb-select-background-height-option").val();
	if(lb_select_background_height_option == 'px'){
		var lb_template_height = jQuery("#lb_template_height").val();
	}else{
		var lb_template_height = jQuery('#lb_template_height_vh').val();
	}

	var lb_leaderboardimage = jQuery('.lb_leaderboardimage').attr('src');
	var lb_select_background_width_option = jQuery('.lb-select-background-width-option').val();
	if(lb_select_background_width_option == 'px'){
		var lb_template_width = jQuery("#lb_template_width").val();
	}else{
		var lb_template_width = jQuery('#lb_template_width_percentage').val();
	}
	var lb_select_background_internal_width_option = jQuery('.lb-select-background-internal-width-option').val();
	if(lb_select_background_width_option == 'px'){
		var lb_temp_internal_width = jQuery("#lb_temp_internal_width").val();
	}else{
		var lb_temp_internal_width = jQuery('#lb_temp_internal_width_percentage').val();
	}

	/*table data */

	var leaderboard_title = jQuery('.leaderboard-header').html();
	var leaderboard_content = jQuery('.leader-content').html();
	var rank_title = jQuery('.rank_title').html();
	var first_name = jQuery('.first_name').html();
	var last_name = jQuery('.last_name').html();
	var score = jQuery('.score').html();
	var leaderboard_table = jQuery(".leaderboard-table").html();

	var customizer_array = {};

	var active_tab = jQuery("ul.nav-tabs li a.active").attr('data-tab');


	var customizer_array = {'display_options': display_options, 'score_format':score_format, 'lb_template_width': lb_template_width, 'lb_temp_aligment': lb_temp_aligment, 'lb_temp_background_color': lb_temp_background_color, 'lb_temp_border_width': lb_temp_border_width, 'lb_temp_border_style': lb_temp_border_style, 'lb_temp_border_color': lb_temp_border_color, 'lb_temp_border_radius': lb_temp_border_radius, 'lb_temp_shadow_color': lb_temp_shadow_color, 'lb_temp_spread_radius': lb_temp_spread_radius, 'lb_temp_blur_radius': lb_temp_blur_radius, 'lb_temp_horizontal_length': lb_temp_horizontal_length, 'lb_temp_vertical_length': lb_temp_vertical_length, 'leaderboard_title': leaderboard_title, 'leaderboard_content': leaderboard_content, 'rank_title': rank_title, 'first_name': first_name, 'last_name': last_name, 'score': score, 'lb_temp_background_opacity': lb_temp_background_opacity, 'lb_leaderboard_background_color': lb_leaderboard_background_color, 'lb_description_background_color': lb_description_background_color, 'lb_heading_background_color': lb_heading_background_color, 'lb_alternate_background_color': lb_alternate_background_color, 'lb_alternate_second_background_color': lb_alternate_second_background_color, 'lb_leaderboardimage': lb_leaderboardimage, 'lb_temp_internal_width': lb_temp_internal_width, 'lb_select_background_width_option': lb_select_background_width_option, 'lb_select_background_internal_width_option': lb_select_background_internal_width_option, 'lb_select_background_height_option': lb_select_background_height_option, 'lb_template_height': lb_template_height, 'lb_optout_background_color': lb_optout_background_color, 'lb_pagination': lb_pagination};

	sqb_leaderboard_show_loader();

	jQuery.post(ajaxurl, {
	action: 'sqb_save_leaderboard_data',
	leaderboard_id: leaderboard_id,
	leaderboard_name: leaderboard_name,
	quiz_option_selected: quiz_option_selected,
	selected_quiz_ids: selected_quiz_ids,
	number_of_entries: number_of_entries,
	retake_option: retake_option,
	select_date_range: select_date_range,
	sqb_start_date: sqb_start_date,
	sqb_end_date: sqb_end_date,
	leaderboard_nodata: leaderboard_nodata,
	selected_order: selected_order,
	customizer_array: customizer_array,
	leaderboard_table: leaderboard_table,
	}, function(response) {
		sqb_leaderboard_hide_loader();
		var get_data = JSON.parse(response);
		if(get_data.last_id){
			jQuery('#leaderboard_id').val(get_data.last_id);
			jQuery('.sqb_detail_quiz_name').html('');
			jQuery('.sqb_detail_quiz_name').append(leaderboard_name);
			jQuery('.leaderboard_shortcode_id').html('');
			jQuery('.leaderboard_shortcode_id').append('[SQBLeaderboard id="'+get_data.last_id+'"][/SQBLeaderboard]');
		}

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

function sqb_leaderboard_show_loader(){
	jQuery('.sqb_loading_wrapper').show();
}

function sqb_leaderboard_hide_loader(){
	jQuery('.sqb_loading_wrapper').hide();
}

function sqb_external_leaderboard_copy_to_clipboard(obj) {
	
	jQuery(obj).text('Copied');
	//jQuery('#embedCodeModal').modal('hide')
	var elementId = jQuery(obj).attr("data-id");
	var aux = document.createElement("input");
	var externalScript = jQuery('#copyLeaderboardEmbedCodeOuter').text();
	aux.setAttribute("value", externalScript);
	document.body.appendChild(aux);
	aux.select();
	aux.focus({preventScroll: true});
	document.execCommand("copy"); 
	document.body.removeChild(aux); 
}

function sqb_leaderboard_delete_by_id(){
	
	jQuery(document).on('click','.delete_leaderboard_by_id',function(e){
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
				sqb_leaderboard_show_loader();
				jQuery.post(ajaxurl, {
						action: 'sqbDeleteLeaderboardByIdAjax',
						id: id,  
				}, function(response) {
					//swal('Deleted Successfully!');
					jQuery('.sqb-page-delete-alert').show();
					setTimeout(function() {
				        jQuery('.sqb-page-delete-alert').hide();
				    }, 5000);
				    
					sqb_leaderboard_hide_loader();
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

function sqb_leaderboard_text_tiny_mce_editor() {
	tinymce.init({
	 	mode : "specific_textareas",
		editor_selector : "sqb_text_editor",
		resize: "both",
		fontsize_formats: '8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 20pt 24pt 30pt 36pt',
	   	font_formats: "Andale Mono=andale mono,times;" + "Arial=arial,helvetica,sans-serif;" + "Arial Black=arial black,avant garde;" + "Book Antiqua=book antiqua,palatino;" + "Comic Sans MS=comic sans ms,sans-serif;" + "Courier New=courier new,courier;" + "Georgia=georgia,palatino;" + "Helvetica=helvetica;" + "Impact=impact,chicago;" + "Montserrat=Montserrat,sans-serif;Open Sans=open sans,sans-serif;Poppins=Poppins,sans-serif;Lato=Lato,sans-serif;Nunito=Nunito,sans-serif;Noto Serif=Noto Serif,sans-serif;Noto Sans=Noto Sans,sans-serif;Raleway=Raleway,sans-serif;" + "Symbol=symbol;" + "Tahoma=tahoma,arial,helvetica,sans-serif;" + "Terminal=terminal,monaco;" + "Times New Roman=times new roman,times;" + "Trebuchet MS=trebuchet ms,geneva;" + "Verdana=verdana,geneva;" + "Webdings=webdings;" + "Wingdings=wingdings,zapf dingbats",
		content_style:"@import url('https://fonts.googleapis.com/css?family=Open+Sans');@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');@import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');@import url('https://fonts.googleapis.com/css2?family=Raleway&display=swap');@import url('https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap');@import ur('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');",  
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
			ed.on('init', function() {
				jQuery(ed.getDoc()).contents().find('body').blur(function(){
				   
				});  
			});
		}
	});
}

function sqb_leaderboard_getUrlVars()
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