jQuery(document).ready(function(){
	sqb_quiz_category_tab_events();
	sqb_getquiz_settings();
	sqb_next_retake_button_customizer();
	sqb_skip_question_button_customizer();
	sqb_category_button_customizer();
	sqb_file_upload_button_customizer();
	sqb_dap_customizer();
	sqb_tiny_mce_editor();
	sqb_select2();
	sqb_notification_text_tiny_mce_editor();
	sqb_certificate_table_datatable_call();
    sqb_certificate_delete_by_id();
    sqb_edit_certificate_by_id();
    sqb_notification_text_tiny_mce_editor();
    draggable_event_for_cert();

	sqb_cert_resize_logo();

	jQuery('#Quiz_setting_tab li:eq(6)').on('click', function(){
		jQuery('#Quiz_setting_tab_7').addClass('active show');
		jQuery('.certificate-section-outer').show('slow');
		jQuery('#add_new_certificate_wrapper').hide('slow');
		jQuery('#cert_edit_id').val('');
	});


	jQuery(document).on('click','.sqbimagefield-delete-btn',function() {
		var data = jQuery(this)
		data.parents('.sqbimagefield-wrapper').find('.sqbimagefield-img-wrapper').removeClass('show');
		data.parents('.sqbimagefield-wrapper').find('.sqbimagefield-img-wrapper').addClass('hide');
		data.parents('.sqbimagefield-wrapper').find('img').attr('src', '');
		data.parents('.sqbimagefield-wrapper').find('.sqbimagefield-hidden').val('');
	});

	jQuery('.sqb_save_email_template_sign').on('click', function() {
	    var sqb_signature_body = tinymce.get('sqb_signature_body').getContent();
	    var sqb_signature_image = jQuery('input[name="sqb_signature_image"]').val();
	    var sqb_email_logo = jQuery('input[name="sqb_email_logo"]').val();
	    SQBShowLoader();

	    jQuery.ajax({
	        url: ajaxurl,
	        type: 'POST',
	        data: {
	            action: 'sqb_save_global_email_template',
	            sqb_signature_body: sqb_signature_body,
	            sqb_signature_image: sqb_signature_image,
	            sqb_email_logo: sqb_email_logo,
	        },
	        success: function(response) {
	            SQBHideLoader();
	            if (response.success) {
	                swal('Email template saved successfully!');
	            } else {
	                swal('Error: ' + response.data);
	            }
	        },
	        error: function() {
	            SQBHideLoader();
	            swal('An error occurred while saving the email template. Please try again.');
	        }
	    });
	});

	var $ = jQuery;
	var sqb_sign_mediauploader;

	function sqbEmailSignatureOpenMediaUploader(wrapper) {
	    if (sqb_sign_mediauploader) {
	        sqb_sign_mediauploader.open();
	        return;
	    }
	    sqb_sign_mediauploader = wp.media.frames.file_frame = wp.media({
	        title: 'Choose Image',
	        button: {
	            text: 'Choose Image'
	        },
	        multiple: false
	    });
	    sqb_sign_mediauploader.on('select', function() {
	    	console.log(wrapper);
	        var attachment = sqb_sign_mediauploader.state().get('selection').first().toJSON();
	        wrapper.find('.sqb-default-upload-wrapper').removeClass('active');
	        wrapper.find('.sqb-default-upload-wrapper-has-img').addClass('active');
	        wrapper.find('.quiz-emailtemp-preview-img img').attr('src', attachment.url);
	        wrapper.find('.sqbimagefield-hidden').val(attachment.url);
	    });
	    sqb_sign_mediauploader.open();
	}

    // Event handler for direct click on upload button
    $(document).on('click', '.sqb-email-signature', function(e) {
	    e.preventDefault();
	    var wrapper = jQuery('.sqb-email-signature-outer');
	    sqbEmailSignatureOpenMediaUploader(wrapper);
	});

    var sqb_logo_mediauploader;
	function sqbEmailLogoOpenMediaUploader(wrapper) {
	    if (sqb_logo_mediauploader) {
	        sqb_logo_mediauploader.open();
	        return;
	    }
	    sqb_logo_mediauploader = wp.media.frames.file_frame = wp.media({
	        title: 'Choose Image',
	        button: {
	            text: 'Choose Image'
	        },
	        multiple: false
	    });
	    sqb_logo_mediauploader.on('select', function() {
	        var attachment = sqb_logo_mediauploader.state().get('selection').first().toJSON();
	        wrapper.find('.sqb-default-upload-wrapper').removeClass('active');
	        wrapper.find('.sqb-default-upload-wrapper-has-img').addClass('active');
	        wrapper.find('.quiz-emailtemp-preview-img img').attr('src', attachment.url);
	        wrapper.find('.sqbimagefield-hidden').val(attachment.url);
	    });
	    sqb_logo_mediauploader.open();
	}

    // Event handler for direct click on upload button
    $(document).on('click', '.sqb-email-logo', function(e) {
	    e.preventDefault();
	    var wrapper = jQuery('.sqb-email-logo-outer');
	    sqbEmailLogoOpenMediaUploader(wrapper);
	});

    // Event handler for replace logo button
    $(document).on('click', '.replace-logo-btn', function(e) {
        e.preventDefault();
        var wrapper = jQuery('.sqb-email-logo-outer');
        sqbEmailLogoOpenMediaUploader(wrapper);
    });

    $(document).on('click', '.replace-sign-btn', function(e) {
        e.preventDefault();
        var wrapper = jQuery('.sqb-email-signature-outer');
        sqbEmailSignatureOpenMediaUploader(wrapper);
    });

	jQuery(document).on('click','.delete-logo-img',function() {
		var data = jQuery('.sqb-email-logo-outer');
		data.find('img').attr('src', '');
		data.find('.sqbimagefield-hidden').val('');
		data.find('.sqb-default-upload-wrapper').addClass('active');
		data.find('.sqb-default-upload-wrapper-has-img').removeClass('active');
	});

	jQuery(document).on('click','.delete-sign-img',function() {
		var data = jQuery('.sqb-email-signature-outer');
		data.find('img').attr('src', '');
		data.find('.sqbimagefield-hidden').val('');
		data.find('.sqb-default-upload-wrapper').addClass('active');
		data.find('.sqb-default-upload-wrapper-has-img').removeClass('active');
	});

	

	jQuery(document).on('change','input[name="email_verify_platform"]',function() {
		if(jQuery(this).val() == 'quickemail'){
			jQuery('.qev-quickemail').show();
			jQuery('.qev-reoon').hide();
		}else{
			jQuery('.qev-quickemail').hide();
			jQuery('.qev-reoon').show();
		}
	});


	jQuery(document).on('change','#field_type',function() {
		if(jQuery(this).val() == 'phone_number'){
			initializeIntlTelInput('us');
			jQuery('.select-country-outer').show();
			jQuery('.sqb-dropdown-field-outer').hide();
		}else if(jQuery(this).val() == 'dropdown'){
			jQuery('.sqb-dropdown-field-outer').show();
			jQuery('.select-country-outer').hide();
		}else{
			jQuery('.sqb-dropdown-field-outer').hide();
			jQuery('.select-country-outer').hide();
		}
	});

	jQuery(document).on('click','.select-country-outer .iti__country-list li',function(){
		var selected_country = jQuery(this).attr('data-country-code');
		jQuery('#cf_selected_country').val(selected_country);
	});
	jQuery(document).on('change','.search-quiz',function() {
		jQuery('.search_popup_result').html('');
	});

	jQuery(document).on('click', '.add_new_certificate_tabs li:eq(0)', function(){
		jQuery('.certficate-prev-btn').hide();
	});
	jQuery(document).on('click', '.add_new_certificate_tabs li:eq(1)', function(){
		jQuery('.certficate-prev-btn').show();
	});

	jQuery(document).on('click','.certficate-prev-btn',function(){
		jQuery('.add_new_certificate_tabs li:eq(0) a').trigger('click');
	});	

	jQuery(document).on('click', '.delete-template-element',function(){
   		if(jQuery(this).parents('.dragable-certificate-element').hasClass('hide-this-section-in-frontend')) {
   			jQuery(this).parents('.dragable-certificate-element').attr('title', 'Hide in frontend');
   		}else{
   			jQuery(this).parents('.dragable-certificate-element').attr('title', 'Show in frontend');
   		}
   		jQuery(this).parents('.dragable-certificate-element').toggleClass('hide-this-section-in-frontend');
   });

	jQuery(document).on('click','.certificate_listing_btn',function() {
		var id = jQuery(this).attr('data-id');
		if(jQuery(this).prop('checked') == true){
			var status = "Y";
		}else{
			var status = "N";
		}

		SQBShowLoader();
	    jQuery.post(ajaxurl, {
			action: 'SQBSaveCertificateData',
			operation_name: 'update_status_certificate',
			id: id,	
			status: status,	
		},function(response) {
			SQBHideLoader();
		});
	});

	jQuery('.manage-certificate-empty-btn, .create-new-cert').on('click', function(){
		jQuery('.no_certificate_created').hide('slow');
		jQuery('.certificate_created').hide('slow');
		jQuery('#add_new_certificate_wrapper').show('slow');
		jQuery('#cert_general_tab').addClass('active show');
		jQuery('#cert_edit_id').val('');
		jQuery('.certficate-prev-btn').hide();

		jQuery('input[name="cert_name"]').val('');
		jQuery('#certificate_btn_status').prop('checked', false);
		jQuery('#certificate_admin_name').val('');
		jQuery('#certificate_logo_src').val('');
		jQuery('.certificate_logo_btn_wrapper').html('');
		jQuery('#cert_signature_img_src').val('');
		jQuery('.cert_signature_img_wrapper').html('');
		jQuery('.certificate_template_html_outer').html('');

		jQuery("#add_new_coupon_tab li:eq(0) a").trigger('click');
		jQuery("#add_new_certificate_wrapper #cert_customizer_tab").removeClass('active show');

		jQuery('.certificate_template_html_outer').html(certificate_template_html_outer_clone);
		sqb_cert_resize_logo();
		sqb_tiny_mce_editor();
		draggable_event_for_cert();
	});

	jQuery('.sqb_cert_return_btn').on('click', function(){
		jQuery('#add_new_certificate_wrapper').hide('slow');
		jQuery('#cert_edit_id').val('');

		jQuery.post(ajaxurl, {
				action: 'sqb_load_certifciate_data',
		}, function(response) {
			response = JSON.parse(response);
			if(response != "No data Found"){
				jQuery('.certificate_created').show();
				jQuery('.no_certificate_created').hide();
				jQuery('#sqb_certificate_tab_table tbody').html('');
				jQuery('#sqb_certificate_tab_table tbody').append(response);
			}else{
				jQuery('.no_certificate_created').show('slow');
			}
		});
	});

	jQuery(document).on('change','#sqb-search-by',function() {
		jQuery('.search_popup_result').html('');
		var val = jQuery(this).val();
		if(val == 'quiz-name'){
			jQuery('.search-by-quiz-wrapper').show();
			jQuery('.search-by-page-wrapper').hide();
		}else if(val == 'page-url'){
			jQuery('.search-by-page-wrapper').show();
			jQuery('.search-by-quiz-wrapper').hide();
		}else{
			jQuery('.search-by-page-wrapper').hide();
			jQuery('.search-by-quiz-wrapper').hide();
		}
	});

	jQuery(document).on('click','.page_enable',function() {
		
		var val = jQuery(this).prop('checked');
		
		var data = {
			quiz_id : jQuery('#search-quiz').val(),
			action: "sqb_search_popup_page_enable",
			page_id : jQuery(this).attr('data-pageid'),
			enable : val
		};
		SQBShowLoader();
		jQuery.ajax({
			type : "post",
			url : ajaxurl,
			data : data,
			success: function(response) {
				SQBHideLoader();
			}
		});
	});

	jQuery(document).on('click','.quiz_enable',function() {
		
		var val = jQuery(this).prop('checked');
		
		var data = {
			quiz_id : jQuery(this).attr('data-quizid'),
			action: "sqb_search_popup_page_enable",
			page_id : jQuery('#search-page').val(),
			enable : val
		};
		SQBShowLoader();
		jQuery.ajax({
			type : "post",
			url : ajaxurl,
			data : data,
			success: function(response) {
				SQBHideLoader();
			}
		});
	});

	jQuery(document).on('click','#btn-search-popup',function() {

		var data = {
			action: "sqb_search_popup_results",
			search_by : jQuery('#sqb-search-by').val(),
			search_quiz : jQuery('#search-quiz').val(),
			search_page : jQuery('#search-page').val()
		};
		SQBShowLoader();
		jQuery('.search_popup_result').hide();
		jQuery.ajax({
			type : "post",
			url : ajaxurl,
			data : data,
			success: function(response) {
				if(response != ''){
					jQuery('.search_popup_result').show();
					jQuery('.search_popup_result').html(response);
				}else{
					jQuery('.search_popup_result').hide();
				}
				SQBHideLoader();
			}
		});
	});

	jQuery(document).on('click','.sqb-repair',function() {
		jQuery(this).text('Please Wait...');
		jQuery.post(ajaxurl, {
			action: 'SqbRepairTable',
			}, function(response) {	
				jQuery('.sqb-repair').text('Click to Repair');
				jQuery('.repaired-message').show();
				setTimeout(function(){
					jQuery('.repaired-message').hide();
				}, 2500);
		});
	});


	jQuery(document).on('keyup', '.tag_width_input', function(){
		var val = jQuery(this).val();
		jQuery("#tag_width").bootstrapSlider('setValue', val);
	});

	jQuery(document).on('keyup', '.category_width_input', function(){
		var val = jQuery(this).val();
		jQuery("#category_width").bootstrapSlider('setValue', val);
	});

	jQuery(document).on('keyup', '.question_width_input', function(){
		var val = jQuery(this).val();
		jQuery("#question_width").bootstrapSlider('setValue', val);
	});

	jQuery(document).on('keyup', '.personalization_width_input', function(){
		var val = jQuery(this).val();
		jQuery("#personalization_width").bootstrapSlider('setValue', val);
	});

	jQuery(document).on('keyup', '.analyzing_width_input', function(){
		var val = jQuery(this).val();
		jQuery("#analyzing_width").bootstrapSlider('setValue', val);
	});


	jQuery(document).on('click','h5.quiz--sub-title.quiz-accordion-title',function(){
	    jQuery('h5.quiz--sub-title.quiz-accordion-title').not(jQuery(this)).parents('.quiz-content-accordion-wrapper').removeClass('active-tabs');
	    jQuery(this).parents('.quiz-content-accordion-wrapper').toggleClass('active-tabs');
	});
	jQuery(document).on('click','.save-pdf-images',function() {
		SQBShowLoader();
		var quiz_id = jQuery('.pdf-quizList .nav-item.activeli').attr('data-value');
		var different_first_image = jQuery('input[name="different_first_page_image"]').val();
		var different_last_image = jQuery('input[name="different_last_page_image"]').val();

		var quiz_firstpage_width = jQuery("#quiz_firstpage_width").val();
		var quiz_first_page_align = jQuery('#quiz_first_page_align_style option:selected').val();
		var quiz_first_page_horizontal = jQuery('#quiz_first_horizontal_page_align_style option:selected').val();

		var quiz_lastpage_width = jQuery("#quiz_lastpage_width").val();
		var quiz_last_page_align = jQuery('#quiz_last_page_align_style option:selected').val();
		var quiz_last_page_horizontal = jQuery('#quiz_last_horizontal_page_align_style option:selected').val();

		jQuery.post(ajaxurl, {
			action: 'sqb_save_quiz_pdf',
			quiz_id: quiz_id,   
			different_first_image: different_first_image,   
			different_last_image: different_last_image,
			quiz_firstpage_width: quiz_firstpage_width,
			quiz_first_page_align: quiz_first_page_align,
			quiz_first_page_horizontal: quiz_first_page_horizontal,
			quiz_lastpage_width: quiz_lastpage_width,
			quiz_last_page_align: quiz_last_page_align,
			quiz_last_page_horizontal: quiz_last_page_horizontal,
			}, function(response) {	
				SQBHideLoader();	 
		});
		jQuery('.save-pdf-settings').trigger('click');
	});

	jQuery(document).on('click','.preview-header-btn',function() {
		var header_title = jQuery('.header_title').html();
		var logo_img = jQuery('input[name="add_pdf_icon"]').val();
		var background_color = jQuery('input[name="header_background_color"]').val();
		jQuery('.preview-header-section').css('background-color', background_color);
		jQuery('.logo-section img').attr('src', logo_img);
		jQuery('.header-title').html(header_title)
		jQuery('.preview-header-section').show();
	});
	jQuery(document).on('click','input[name="upload_first_image_option"]',function() {
		if(jQuery(this).prop('checked') == true){
			jQuery('.pdf-display-options').show();
			jQuery('.all-first-image').show();
			jQuery('input[name="pdf_display_option"]:first').prop("checked", true).trigger("click");
		}else{
			jQuery('.all-first-image').hide();
			jQuery('.pdf-display-options').hide();
			jQuery('.pdf-settings-content').hide();
		}
	});

	jQuery('.pdf-all-outer .pdf-image-section .pdf-browse-img').on('click', function(){
		jQuery('.add_pdf_icon').trigger('click');
	});

	jQuery('.first-page-image .pdf-image-section .pdf-first-img').on('click', function(){
		jQuery('.first_page_image').trigger('click');
	});

	jQuery('.first-page-image .pdf-image-section .pdf-last-img').on('click', function(){
		jQuery('.first_page_image').trigger('click');
	});

	jQuery('.last-page-image .pdf-image-section .pdf-browse-img').on('click', function(){
		jQuery('.last_page_image').trigger('click');
	});

	jQuery('.different-first-image .pdf-image-section .different-pdf-last-img').on('click', function(){
		jQuery('.different_last_page_image').trigger('click');
	});

	jQuery('.different-first-image .pdf-image-section .different-pdf-first-img').on('click', function(){
		jQuery('.different_first_page_image').trigger('click');
	});

	jQuery(document).on('change','input[name="pdf_display_option"]',function() {
		if(jQuery(this).val() == 'same'){
			jQuery('.all-first-image').show();
			jQuery('.pdf-settings-content').hide();
		}else{
			jQuery('.pdf-settings-content').show();
			jQuery('.all-first-image').hide();
		}
	});

	var pdf_display_option = jQuery('input[name="pdf_display_option"]:checked').val();
	if(pdf_display_option == 'different'){
		sqb_getpdf_settings();
	}

	jQuery(document).on('click','.pdf-quizList li a',function(){
		jQuery(".pdf-quizList li a").removeClass(" active");
		jQuery(".pdf-quizList li").removeClass(" activeli");
		jQuery(this).addClass(" active");
		jQuery(this).closest("li").addClass(" activeli");
		sqb_getpdf_settings();
	});

	jQuery(document).on('click','.preview-footer-btn',function() {
		var footer_text = jQuery('.footer_copyright_content').html();
		jQuery('.pdf-footer-text').html(footer_text);
		var footer_bg = jQuery('input[name="footer_background_color"]').val();
		jQuery('.preview-footer-section').css('background-color', footer_bg);
		jQuery('.preview-footer-section').show();
	});

	jQuery('.header-close').on('click', function(){
		jQuery('.preview-header-section').hide();
	});

	jQuery('.footer-close').on('click', function(){
		jQuery('.preview-footer-section').hide();
	});

	jQuery(document).on('click','#cert_signature_img_btn',function() {
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
				jQuery('input[name="cert_signature_img_src"]').val(attachment.url);
				jQuery('.cert_signature_img_wrapper').html('<img src="'+attachment.url+'">');

			});
		
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','#uploadimage_certi_btn',function() {
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
				jQuery('input[name="certificate_logo_src"]').val(attachment.url);		
				jQuery('#certificates_outer2 img').attr('src', attachment.url);
			});
		
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','#certificate_logo_btn',function() {
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
				jQuery('input[name="certificate_logo_src"]').val(attachment.url);
				jQuery('.certificate_logo_btn_wrapper').html('<img src="'+attachment.url+'">');
				jQuery('.award_img_inner').find('img').attr('src', attachment.url);

			});
		
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','.add_pdf_icon',function() {
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
				jQuery('input[name="add_pdf_icon"]').val(attachment.url);
				jQuery('.pdf-all-outer .pdf-browse-img').attr('src',attachment.url);
				jQuery('.pdf-all-outer .browse-pdf-btn-wrapper').hide();
				jQuery('.pdf-all-outer .pdf-image-section').show();
			});
		
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','.first_page_image',function() {
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
				jQuery('input[name="first_page_image"]').val(attachment.url);
				jQuery('.pdf-first-img').attr('src',attachment.url);
				jQuery('.first-page-class .browse-pdf-btn-wrapper').hide();
				jQuery('.first-page-class .pdf-image-section').show();
			});
		
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','.last_page_image',function() {
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
				jQuery('.all-last-image .pdf-image-section').show();
				jQuery('input[name="last_page_image"]').val(attachment.url);
				jQuery('.pdf-last-img').attr('src',attachment.url);
				jQuery('.last-page-image .browse-pdf-btn-wrapper').hide();
				jQuery('.last-page-image .pdf-image-section').show();
			});
		
		sqb_mediauploader.open();
	});


	jQuery(document).on('click','.different_first_page_image',function() {
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
				jQuery('input[name="different_first_page_image"]').val(attachment.url);
				jQuery('.different-pdf-first-img').attr('src',attachment.url);
				jQuery('.first-page-image .pdf-image-section').show();
				jQuery('.first-page-image .browse-pdf-btn-wrapper').hide();
			});
		
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','.delete-different-first-image',function() {
		jQuery('input[name="different_first_page_image"]').val('');
		jQuery('.different-pdf-first-img').attr('src','');
		jQuery('.different-first-image .first-page-image .pdf-image-section').hide();
		jQuery('.different-first-image .first-page-image .browse-pdf-btn-wrapper').show();
	});

	jQuery(document).on('click','.delete-different-last-image',function() {
		jQuery('input[name="different_last_page_image"]').val('');
		jQuery('.different-pdf-last-img').attr('src','');
		jQuery('.different-first-image .last-page-image .pdf-image-section').hide();
		jQuery('.different-first-image .last-page-image .browse-pdf-btn-wrapper').show();

	});

	jQuery(document).on('click','.delete-all-first-image',function() {
		jQuery('input[name="first_page_image"]').val('');
		jQuery('.pdf-first-img').attr('src','');
		jQuery('.all-first-image .first-page-image .pdf-image-section').hide();
		jQuery('.all-first-image .first-page-image .browse-pdf-btn-wrapper').show();
	});

	jQuery(document).on('click','.delete-pdf-logo-image',function() {
		jQuery('input[name="add_pdf_icon"]').val('');
		jQuery('.pdf-all-outer .pdf-browse-img').attr('src','');
		jQuery('.pdf-all-outer .pdf-image-section').hide();
		jQuery('.pdf-all-outer .browse-pdf-btn-wrapper').show();
	});

	jQuery(document).on('click','.delete-all-last-image',function() {
		jQuery('input[name="last_page_image"]').val('');
		jQuery('.pdf-last-img').attr('src','');
		jQuery('.all-first-image .last-page-image .pdf-image-section').hide();
		jQuery('.all-first-image .last-page-image .browse-pdf-btn-wrapper').show();
	});

	jQuery(document).on('click','.different_last_page_image',function() {
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
				jQuery('.last-page-image .pdf-image-section').show();
				jQuery('input[name="different_last_page_image"]').val(attachment.url);
				jQuery('.different-pdf-last-img').attr('src',attachment.url);
				jQuery('.last-page-image .browse-pdf-btn-wrapper').hide();
			});
		
		sqb_mediauploader.open();
	});


	jQuery('#header_background_color_div').colorpicker();
	jQuery('#footer_background_color_div').colorpicker();


	/*Import Questions using csv */
	jQuery('#import-btn').on('click', function(e) {
      e.preventDefault();
     jQuery('.sqb_import_msg').hide();
      var quizid = jQuery('#sqb_import_select_quiz').attr('data-value');
	  if(quizid < 1){
		  jQuery('.sqb_import_msg.csv_validation_message').show().text('Please select a Quiz');
		  setTimeout(function(){ 
		  jQuery('.sqb_import_msg.csv_validation_message').hide();
		  }, 10000);
		  return false;
	  }
	  
	  var input_type = jQuery('#frmCSVImport').find('input[name="file"]');
      var files = jQuery(input_type)[0].files;
		
	  if(files.length < 1 ){
		  jQuery('.sqb_import_msg.csv_validation_message').show().text('Please select a csv file.');
		  setTimeout(function(){ 
		  jQuery('.sqb_import_msg.csv_validation_message').hide('slow');
		  }, 10000);
		  return false;
	  }
	  
	   	SQBShowLoader();
      	var form = jQuery('#frmCSVImport')[0];
      	var varform = new FormData(form);
      	varform.append("action", "sqb_import_csv");
      	varform.append("quiz_id", quizid);
  		varform.append("security", SQBSettings.sqb_import_csv);

      	sqbProcessCSVImport(varform);
    });

    function sqbProcessCSVImport(varform) {
        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            dataType: "JSON",
            data: varform,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: sqbonLoadingimport,
            success: sqbonSuccesimport,
            crossDomain:true
        });
    }

    function sqbonLoadingimport() {
    }
    
    function sqbonSuccesimport(data, status) {
		jQuery('#frmCSVImport').trigger("reset");
		if(data.result) {
			 jQuery('.sqb_import_msg.csv_sucess_message').show().html(data.message);
			  setTimeout(function(){ 
			  jQuery('.sqb_import_msg.csv_sucess_message').hide('slow');
			 }, 20000);
		} else {
		  jQuery('.sqb_import_msg.csv_validation_message').show().html(data.message);
		  setTimeout(function(){ 
		  jQuery('.sqb_import_msg.csv_validation_message').hide('slow');
		  }, 20000);
		}
		SQBHideLoader();
    }
    
    jQuery(document).on('click', '.sqb_download_sample_csv', function(e){
		e.preventDefault();
		var d = new Date();
		var time = d.getTime();
		var csv_type = jQuery(this).attr('data-id');
		var csv_url = jQuery(this).attr('data-url');
		if(csv_type == 'sample_csv'){
			window.open(csv_url+"?"+time);
		} else {
			window.open(csv_url+"?"+time);
		}
		
	});
	
	
	
/*Import Questions using csv ends*/

	jQuery('#sqb_import_select_quiz_id .dropdown-item').click(function(){
		jQuery('.sqb_import_msg').hide();
		var quiz_id = jQuery(this).attr('data-value');
		var quiz_name = jQuery( this).text();
		jQuery('#sqb_import_select_quiz').text(quiz_name);
		jQuery('#sqb_import_select_quiz').attr('data-value', quiz_id);
		if(quiz_id < 1){
			jQuery('.quiz_type_selected_section').hide();
		} else {
			var quiz_type = jQuery(this).attr('data-quiztype');
			var quiz_type_title = '';
			if(quiz_type == 'personality'){
				quiz_type_title = "Personality ";
			} else if(quiz_type == 'assessment'){
				quiz_type_title = "Assessment ";
			} else if(quiz_type == 'scoring'){
				quiz_type_title = "Scoring ";
			} else if(quiz_type == 'survey'){
				quiz_type_title = "Survey ";
			}
			jQuery('.quiz_type_selected_section').show().text(''+quiz_type_title+' type quiz selected.');
		}
	});

	var url = window.location.href;
	var tab = sqb_getUrlVars()["tab"];
  	if(tab == 'globalnotification'){
  		jQuery("#Quiz-reportsTab li:eq(1) a").addClass("active show");
  		jQuery('#settings_notifications_tab').addClass('active show');
  		jQuery('.sqb-email-notification-selection').hide();
  		jQuery('#global-settings-outer').show();
  	}else if(tab == 'quizlevelnotification'){
  		jQuery("#Quiz-reportsTab li:eq(1) a").addClass("active show");
  		jQuery('#settings_notifications_tab').addClass('active show');
  		jQuery('.sqb-email-notification-selection').hide();
  		jQuery('#different-settings-outer').show();

  		var quizid = sqb_getUrlVars()["quizid"];
  		if(quizid){
  			setTimeout(function(){
  			jQuery('.quizListing li[data-value="'+quizid+'"] a').get(0).click();
		}, 1000);  
  		}else{
  			setTimeout(function(){
	  			jQuery('.quizListing li:first-child a').trigger('click');
			}, 1000);  
  		}							
  	}else if(tab == 'Quiz_setting_tab_4'){
			jQuery("#Quiz-reportsTab li:eq(0) a").addClass("active show");
			jQuery("#settings_advance_tab").addClass("active show");
			jQuery(".sqb_custom_fields_section").trigger('click');
  	}else if(tab == 'global_settings'){
  			jQuery("#Quiz-reportsTab li:eq(0) a").addClass("active show");
  			jQuery("#settings_advance_tab").addClass("active show");
			jQuery("#Quiz_setting_tab li:eq(0) a").removeClass("active");
			jQuery("#Quiz_setting_tab_content .tab-pane").removeClass("active show");
			jQuery("#Quiz_setting_tab li:eq(2) a").addClass("active show");
			jQuery("#Quiz_setting_tab_3").addClass("active show");
  	}else if(tab == 'email_verification'){
  			jQuery("#Quiz-reportsTab li a").removeClass("active show");
			jQuery("#Quiz-reportsTab li:eq(4) a").addClass("active show");
			jQuery("#settings_external_integration_tab").addClass("active show");
			jQuery("#settings_external_integration_tab #Quiz-reportsTab li:eq(1) a").addClass("active show");
			jQuery("#dap_admin_notification_tab1").removeClass("active show");
			jQuery("#dap_admin_notification_tab2").addClass("active show");
  	}else if(tab == 'wp_sync'){
		jQuery("#Quiz-reportsTab li:eq(0) a").addClass("active show");
		jQuery('#settings_advance_tab').addClass("active show");
		jQuery('#Quiz_setting_tab li:nth-child(4) a').trigger('click');
	}else if(tab == 'customizer'){
		jQuery("#Quiz-reportsTab li:eq(5) a").addClass("active show");
		jQuery('#settings_button_tab').addClass("active show");
	}else if(tab == 'message_customizer'){
		jQuery("#Quiz-reportsTab li:eq(4) a").addClass("active show");
		jQuery('#settings_button_tab').addClass("active show");

		jQuery(".message-Quiz-reportsTab li:eq(0) a").removeClass("active show");
		jQuery(".message-Quiz-reportsTab li:eq(2) a").addClass("active show");
		jQuery('#customizer_setting_tab').removeClass("active show");
		jQuery('#message_setting_tab').addClass("active show");
	}else if(tab == 'certificate'){
		jQuery("#Quiz-reportsTab li:eq(0) a").trigger("click");
		jQuery('#Quiz_setting_tab li:eq(6) a').trigger('click');
	}else if(tab == 'chat_gpt_integration'){
		jQuery("#Quiz-reportsTab li:eq(3) a").trigger("click");
		jQuery('#settings_external_integration_tab li:eq(2) a').trigger('click');
	}else if(tab == 'category'){
		jQuery("#Quiz-reportsTab li:eq(0) a").trigger("click");
		jQuery('#Quiz_setting_tab li:eq(2) a').trigger('click');
	}else if(tab == 'email_template'){
		jQuery("#Quiz-reportsTab li:eq(0) a").trigger("click");
		jQuery('#Quiz_setting_tab li:eq(7) a').trigger('click');
	}

	
	jQuery(document).on('click','.quizList li a',function(){
		jQuery(".quizList li a").removeClass(" active");
		jQuery(".quizList li").removeClass(" activeli");
		jQuery(this).addClass(" active");
		jQuery(this).closest("li").addClass(" activeli");
		sqb_getquiz_settings();
	});

	jQuery('.configure-email').on('click', function(){
		jQuery('#different-settings-outer').hide('slow');
		jQuery('#global-settings-outer').show('slow');
		jQuery('.student-notification').trigger('click');
	})

	jQuery(document).on('click','#notification_send_copy',function(){
		if(jQuery(this).prop('checked') == true){
			jQuery(this).closest('.quizLevelCommonNotification').css('border-bottom','none');
			jQuery('.notification-copy-fields-outer').show();
			jQuery('.noti_email_ids').show();
			jQuery('.noti_copy_email').show();
		}else{
			jQuery(this).closest('.quizLevelCommonNotification').css('border-bottom','1px solid #efefef');
			jQuery('.notification-copy-fields-outer').hide();
			jQuery('.noti_email_ids').hide();
			jQuery('.noti_copy_email').hide();
		}
	});


	/*jQuery(document).on('click','.quizListing li a',function(){
		jQuery(".quizListing li a").removeClass(" active");
		jQuery(".quizListing li").removeClass(" activeli");
		jQuery(this).addClass(" active");
		jQuery(this).closest("li").addClass(" activeli");
		var quizid = jQuery(this).closest('li').data('value');
		var quiztype = jQuery(this).closest('li').data('type');
		
		SQBShowLoader();
		
		jQuery.post(ajaxurl, {
			action: 'sqb_get_email_notification_settings',
			quizid: quizid,   
			quiztype: quiztype,   
		}, function(response) {	
			response = JSON.parse(response);
			if(response.email_setting == '1'){
				jQuery('.quizLevelCommonNotification').show();
				jQuery('input[name=email_notification_settings][value=global-email-option]').prop('checked', 'checked');
				if(response.email_data){
					jQuery('#quizlevel_from_name').val(response.email_data['from_name']);
					jQuery('#quizlevel_from_email').val(response.email_data['from_email']);
					jQuery('#quizlevel_email_subject').val(response.email_data['subject']);
					tinymce.get("quizlevel_email_body").setContent(sqb_stripslashes(response.email_data['body']));
					tinymce.get("quizlevel_answer_format").setContent(response.email_data['answer_format']);

					var send_copy = response.email_data['send_copy'];
					if(send_copy || send_copy == 'Y'){
						jQuery('#notification_send_copy').prop('checked' , true);
						jQuery('.noti_email_ids').show();
						jQuery('.noti_copy_email').show();
						jQuery('.notification-copy-fields-outer').show();					
						
					}else{
						jQuery('#notification_send_copy').prop('checked' , false);				
						jQuery('#email_ids').val('');
						jQuery('#copy_email_subject').val('User %%EMAIL%% has completed the quiz');
						jQuery('.noti_email_ids').hide();
						jQuery('.noti_copy_email').hide();
						jQuery('.notification-copy-fields-outer').hide();
					}

					jQuery('#email_ids').val(response.email_data['email_ids']);
					if(response.email_data['copy_email_subject']){
						jQuery('#copy_email_subject').val(response.email_data['copy_email_subject']);
					}else{
						jQuery('#copy_email_subject').val('User %%EMAIL%% has completed the quiz');
					}

				}else{
					jQuery('#quizlevel_from_name').val('');
					jQuery('#quizlevel_from_email').val('');
					jQuery('#quizlevel_email_subject').val('');
					
					tinymce.get("quizlevel_email_body").setContent("<p>Thank you for completing the quiz titled: %%QUIZ_TITLE%%.</p> <p>This is a %%QUIZ_TYPE%% quiz.</p> <p><strong>Here's your result details:</strong></p> <p>Your Outcome - %%OUTCOME%%.</p> <p>Quiz Title: %%QUIZ_TITLE%%</p> <p>Outcome: %%OUTCOME%%</p> <p><strong>Your Answers</strong>: %%ANSWERS%%</p>");
					tinymce.get("quizlevel_answer_format").setContent('<p><strong>Question</strong>: %%QUESTION%%</p> <p><strong>Your Answer</strong>: %%ANSWER%%</p>');
					jQuery('#notification_send_copy').prop('checked' , false);				
					jQuery('#email_ids').val('');
					jQuery('#copy_email_subject').val('User %%EMAIL%% has completed the quiz');
					jQuery('.noti_email_ids').hide();
					jQuery('.noti_copy_email').hide();
					jQuery('.notification-copy-fields-outer').hide();
				}
			}else if(response.email_setting == '2'){
				jQuery('.quizLevelCommonNotification').hide();
				jQuery('input[name=email_notification_settings][value=global-email-option]').prop('checked', 'checked');
				jQuery('#quizlevel_from_name').val('');
				jQuery('#quizlevel_from_email').val('');
				jQuery('#quizlevel_email_subject').val('');
				tinymce.get("quizlevel_email_body").setContent("<p>Thank you for completing the quiz titled: %%QUIZ_TITLE%%.</p> <p>This is a %%QUIZ_TYPE%% quiz.</p> <p><strong>Here's your result details:</strong></p> <p>Your Outcome - %%OUTCOME%%.</p> <p>Quiz Title: %%QUIZ_TITLE%%</p> <p>Outcome: %%OUTCOME%%</p> <p><strong>Your Answers</strong>: %%ANSWERS%%</p>");
				tinymce.get("quizlevel_answer_format").setContent('<p><strong>Question</strong>: %%QUESTION%%</p> <p><strong>Your Answer</strong>: %%ANSWER%%</p>');
				jQuery('#notification_send_copy').prop('checked' , false);				
				jQuery('#email_ids').val('');
				jQuery('#copy_email_subject').val('User %%EMAIL%% has completed the quiz');
				jQuery('.noti_email_ids').hide();
				jQuery('.noti_copy_email').hide();
				jQuery('.notification-copy-fields-outer').hide();
			}else if(response.email_setting == '3'){
				jQuery('.quizLevelCommonNotification').hide();
				jQuery('input[name=email_notification_settings][value=dont-send-email]').prop('checked', 'checked');
				jQuery('#quizlevel_from_name').val('');
				jQuery('#quizlevel_from_email').val('');
				jQuery('#quizlevel_email_subject').val('');
				tinymce.get("quizlevel_email_body").setContent("<p>Thank you for completing the quiz titled: %%QUIZ_TITLE%%.</p> <p>This is a %%QUIZ_TYPE%% quiz.</p> <p><strong>Here's your result details:</strong></p> <p>Your Outcome - %%OUTCOME%%.</p> <p>Quiz Title: %%QUIZ_TITLE%%</p> <p>Outcome: %%OUTCOME%%</p> <p><strong>Your Answers</strong>: %%ANSWERS%%</p>");
				tinymce.get("quizlevel_answer_format").setContent('<p><strong>Question</strong>: %%QUESTION%%</p> <p><strong>Your Answer</strong>: %%ANSWER%%</p>');

				jQuery('#notification_send_copy').prop('checked' , false);				
				jQuery('#email_ids').val('');
				jQuery('#copy_email_subject').val('User %%EMAIL%% has completed the quiz');
				jQuery('.noti_email_ids').hide();
				jQuery('.noti_copy_email').hide();
				jQuery('.notification-copy-fields-outer').hide();
			}else{
				jQuery('.quizLevelCommonNotification').hide();
				jQuery('input[name=email_notification_settings][value=send-customized-email]').prop('checked', 'checked');
				jQuery('#quizlevel_from_name').val('');
					jQuery('#quizlevel_from_email').val('');
					jQuery('#quizlevel_email_subject').val('');
					tinymce.get("quizlevel_email_body").setContent("<p>Thank you for completing the quiz titled: %%QUIZ_TITLE%%.</p> <p>This is a %%QUIZ_TYPE%% quiz.</p> <p><strong>Here's your result details:</strong></p> <p>Your Outcome - %%OUTCOME%%.</p> <p>Quiz Title: %%QUIZ_TITLE%%</p> <p>Outcome: %%OUTCOME%%</p> <p><strong>Your Answers</strong>: %%ANSWERS%%</p>");
					tinymce.get("quizlevel_answer_format").setContent('<p><strong>Question</strong>: %%QUESTION%%</p> <p><strong>Your Answer</strong>: %%ANSWER%%</p>');

					jQuery('#notification_send_copy').prop('checked' , false);				
					jQuery('#email_ids').val('');
					jQuery('#copy_email_subject').val('User %%EMAIL%% has completed the quiz');
					jQuery('.noti_email_ids').hide();
					jQuery('.noti_copy_email').hide();
					jQuery('.notification-copy-fields-outer').hide();
					jQuery('.quizLevelCommonNotification').show('slow');

			}
			SQBHideLoader();			
		});
	}); */

	/*--------*/

	jQuery('.sqb-email-notification-selection-item').on('click', function(){
		jQuery('.sqb-email-notification-selection').hide('slow');
		jQuery('.sqb-email-notification-selection-item').removeClass('sqb-email-notification-selected');
		jQuery(this).addClass('sqb-email-notification-selected');

		var quiz_value = jQuery(this).attr('data-value');

		if(quiz_value == 'global'){
			jQuery('#global-settings-outer').show();
			jQuery('#different-settings-outer').hide();
		}else if(quiz_value == 'quiz_level'){
			jQuery('#different-settings-outer').show();
			jQuery('#global-settings-outer').hide();
			jQuery('.quizListing li:first-child a').trigger('click');
		}
	});


	/*---------*/
	jQuery(document).on('change', '#notification_send_email', function(e){
		e.preventDefault();
		if(jQuery(this).prop('checked') == true){
			jQuery('.commonNotification').show();
		}else{
			jQuery('.commonNotification').hide();
		}	
	});

	/*-----------GDPR Scripts-----------------*/
	
	jQuery(document).on('change','.sqb_gdpr_btn_mode' , function(){

		if(jQuery(this).prop('checked') == true){
			var value = 1;
		}else{
			var value = 0;
		}

		var code = jQuery(this).attr('data-id');

		jQuery.post(ajaxurl, {
			action: 'SQBChangeGdprStatus',
			code: code,
			value: value,
		},function(response) {
			//console.log(response);
		}); 
	});
	



	jQuery(document).on('change','.gdpr_status',function(){
		
		if(jQuery(this).prop('checked') == true){
			var value = 0;
			swal({
	 			title: "Do you want to enable GDPR ?",
				  text: "",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonText: 'Yes, enable it!',
				  cancelButtonText: 'No, cancel!',
				  closeOnConfirm: false,
				  showLoaderOnConfirm: true,
			}).then(function(isConfirm){
				if (isConfirm.value) {
					jQuery.post(ajaxurl, {
						action: 'sqb_change_gdpr_status',
						value: value,
					}, function (response) {	
						jQuery('.third-party-outer').show();					
						jQuery('.google-font-option').show();				
						jQuery('.gdpr-table-outer').show();		
						swal(
						'Success!',
						'Your record is updated. \n\n',
						'success'
					  );
					});
				} else{
					jQuery('input[name="gdpr_status"]').prop('checked', false);
				}
			});
		}else{
			if(jQuery('#google_font_enable').prop('checked') == true){
				var google_font_enable = 'N';
			}
			if(jQuery('#sqb_thirdParty_checkbox').prop('checked') == true){
				var sqb_thirdParty_checkbox = '0';
			}
			var value = 1;
			swal({
	 			title: "Do you want to disable GDPR ?",
				text: "",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonText: 'Yes, disable it!',
				  cancelButtonText: 'No, cancel!',
				  closeOnConfirm: false,
				  showLoaderOnConfirm: true,
			}).then(function(isConfirm){
				if (isConfirm.value) {
					jQuery.post(ajaxurl, {
						action: 'sqb_change_gdpr_status',
					value: value,
					google_font_enable: google_font_enable,
					sqb_thirdParty_checkbox: sqb_thirdParty_checkbox,
					}, function (response) {
						jQuery('.third-party-outer').hide();					
						jQuery('.google-font-option').hide();					
						jQuery('.gdpr-table-outer').hide();	
						jQuery('#sqb_thirdParty_checkbox').prop('checked', false);
						jQuery('#google_font_enable').prop('checked', false);

						swal(
						'Success!',
						'Your record is updated.\n\n',
						'success'
					  );
					});
				}else{
					jQuery('input[name="gdpr_status"]').prop('checked', true);
				}
			});
		}
	});

	jQuery(document).on('change','.thirdParty_status',function(){
		if(jQuery("input[name='thirdParty_status']").prop('checked') == true){
			var gdpr_plugin = jQuery('#gdpr-plugin').val();
			if(gdpr_plugin == 'notactive'){
				jQuery('.gdpr-library-msg').show();
				jQuery('#sqb_thirdParty_checkbox').prop('checked', false);
				return false;
			}else{
				jQuery('.gdpr-library-msg').hide();
			}
			var value = 1;
		}else{
			var value = 0;
		}
		SQBShowLoader();
		jQuery.post(ajaxurl, {
				action: 'sqb_change_thirdparty_status',
				value: value,
			}, function (response) {	
			SQBHideLoader();				
				swal(
				'Success!',
				'Your record is updated.\n\n',
				'success'
			  );
			});
	});


	/*-----------GDPR Scripts End-----------------*/
	
	jQuery(document).on('change', '.student_send_email', function(e){
		e.preventDefault();
		var type = jQuery(this).attr('data-type');
		if(jQuery(this).prop('checked') == true){
			jQuery('.'+type+'CommonNotification').show();
		}else{
			jQuery('.'+type+'CommonNotification').hide();
		}	
	});

	jQuery(document).on('change','input[name="quiz_notification"]',function(){
		if(jQuery(this).val() == 'global-email'){
			jQuery('#different-settings-outer').hide('slow');
			jQuery('#global-settings-outer').show('slow');
		} else {
			jQuery('#global-settings-outer').hide('slow');
			jQuery('#different-settings-outer').show('slow');
		}
	});
	
	jQuery(document).on('change', '#give_points_on_complete', function(e){
		e.preventDefault();
		var gop_exists = jQuery('#gop_exists').val();
		
		if(jQuery(this).prop('checked') == true){
			if(gop_exists == 'N'){
				jQuery('.check_gop_availability').show('slow');	
				jQuery('#give_points_on_complete').prop('checked',false);
				return false;
			}
			if(jQuery(this).attr('data-quiz-type') == 'scoring' || jQuery(this).attr('data-quiz-type') == 'assessment'){
			jQuery('.give_points_on_quiz_pass_outer').show('slow');
			jQuery('#give_points_on_quiz_pass').prop('checked',false);
			}
			jQuery('.quiz_how_many_points_outer').show('slow');
			jQuery('.quiz_points_display_message_outer').show('slow');
		}else{
			if(jQuery(this).attr('data-quiz-type') == 'scoring' || jQuery(this).attr('data-quiz-type') == 'assessment'){
			jQuery('.give_points_on_quiz_pass_outer').hide('slow');
			jQuery('#give_points_on_quiz_pass').prop('checked',false);
			}
			jQuery('.quiz_how_many_points_outer').hide('slow');
			jQuery('.quiz_points_display_message_outer').hide('slow');
			jQuery('.quiz_points').hide();
		}
	
	});
	
	jQuery(document).on('change', '#give_points_on_quiz_pass', function(e){
		e.preventDefault();
		
		if(jQuery(this).prop('checked') == true){
			if(jQuery(this).attr('data-quiz-type') == 'scoring'){
			jQuery('.quiz_passing_score_outer').show('slow');
			}
			if(jQuery(this).attr('data-quiz-type') == 'assessment'){
			jQuery('.quiz_correct_answers_outer').show('slow');
			}
			jQuery('.give_points_on_retake_outer').show('slow');
			jQuery('#give_points_on_retake').prop('checked',false);
		}else{
			if(jQuery(this).attr('data-quiz-type') == 'scoring'){
			jQuery('.quiz_passing_score_outer').hide('slow');
			}
			if(jQuery(this).attr('data-quiz-type') == 'assessment'){
			jQuery('.quiz_correct_answers_outer').hide('slow');
			}
			jQuery('.give_points_on_retake_outer').hide('slow');
		}
		
	});
	

	jQuery(".show_merge_tags, .Personalize_close").click(function() {
       jQuery('.addmergetagspreview1').slideToggle();
    });
	
	jQuery('.sqb_save_student_quiz_notification').click(function(){
		var quiz_type = jQuery(this).attr('data-type');
		sqb_save_quiz_notification(quiz_type);
	})

/**/

	jQuery(document).on('change','input[type=radio][name=email_notification_settings]',function() {
	    if (this.value == 'send-customized-email') {
	     	jQuery('.quizLevelCommonNotification').show('slow');   
	     	jQuery('#notification_send_copy').prop('checked' , false);				
			jQuery('#email_ids').val('');
			jQuery('#copy_email_subject').val('User %%EMAIL%% has completed the quiz');
			
			setTimeout(function(){ 
				jQuery('.noti_email_ids').hide();
				jQuery('.noti_copy_email').hide();
				jQuery('.notification-copy-fields-outer').hide();
			}, 1000);
			jQuery('#notification_send_copy').closest('.quizLevelCommonNotification').css('border-bottom','1px solid #efefef');
			
	    }else if (this.value == 'global-email-option') {
	     	jQuery('.quizLevelCommonNotification').hide('slow');  
	     	jQuery('.notification-copy-fields-outer').hide(); 
	    }else if (this.value == 'dont-send-email') {
	     	jQuery('.quizLevelCommonNotification').hide('slow');  
	     	jQuery('.notification-copy-fields-outer').hide(); 
	    }
	});


	jQuery('.sqb_save_quiz_level_notification').click(function(){
		var quiz_notification = '';
		var quiz_id = jQuery('ul.quizListing').find('li.activeli').data('value');
		var quiz_type = jQuery('ul.quizListing').find('li.activeli').data('type');
		var email_notification = jQuery('input[name=email_notification_settings]:checked').val();
		
		if(email_notification == 'send-customized-email'){
			var notification_from_name = '';
			if(quiz_type != '' && quiz_id != ''){
				notification_type = 'student_email';
				var notification_send_email = 'N';
				//var notification_send_email_check = jQuery('#'+quiz_type+'_send_email').prop('checked');
				var notification_from_email = jQuery('#quizlevel_from_email').val();
				var notification_email_subject = jQuery('#quizlevel_email_subject').val();
				var notification_email_body = tinymce.get('quizlevel_email_body').getContent();
				var notification_answer_format = tinymce.get('quizlevel_answer_format').getContent();
				notification_from_name = jQuery('#quizlevel_from_name').val();


				if(jQuery('#notification_send_copy').prop('checked') == true){
					var notification_send_copy = 'Y';
				}else{
					var notification_send_copy = 'N';
				}

				var email_ids = jQuery('#email_ids').val();
				var copy_email_subject = jQuery('#copy_email_subject').val();


				var quiz_settings = 'quiz_level';
			}
				notification_send_email = 'Y';

				if(notification_from_email == ''){
					swal('Please enter the "From Email"');
					return false;
				}

				if(notification_email_subject == ''){
					swal('Please enter email Subject');
					return false;
				}

				if(notification_email_body == ''){
					swal('Please enter email Body');
					return false;
				}

			var form_data = {
				notification_from_email: notification_from_email,
				notification_email_subject: notification_email_subject,
				notification_email_body: notification_email_body ,
				notification_type: notification_type ,
				notification_send_email: notification_send_email ,
				notification_answer_format: notification_answer_format ,
				quiz_type: quiz_type ,
				notification_from_name: notification_from_name ,
				quiz_id: quiz_id ,
				quiz_settings: quiz_settings ,
				notification_send_copy: notification_send_copy ,
				email_ids: email_ids ,
				copy_email_subject: copy_email_subject ,
			}	
				SQBShowLoader();
			jQuery.post(ajaxurl, {
					action: 'sqb_save_quiz_notification',
					form_data: form_data,   
			}, function(response) {		 
				SQBHideLoader();			  
			});

			quiz_notification = '1';
			jQuery.post(ajaxurl, {
					action: 'sqb_quiz_update_email_notification',
					quiz_id: quiz_id,  
					quiz_notification: quiz_notification, 
			}, function(response) {		 
				SQBHideLoader();

				jQuery('.sqb-notification-save-btn-msg').show();
				setTimeout(function(){ 
					jQuery('.sqb-notification-save-btn-msg').hide();
				}, 2000);			  
			});


		}else{
			if(email_notification == 'global-email-option'){
				quiz_notification = '2';
			}else if(email_notification == 'dont-send-email'){
				quiz_notification = '3';
			}

			jQuery.post(ajaxurl, {
					action: 'sqb_quiz_update_email_notification',
					quiz_id: quiz_id,  
					quiz_notification: quiz_notification, 
			}, function(response) {		 
				SQBHideLoader();	
				jQuery('.sqb-notification-save-btn-msg').show();
				setTimeout(function(){ 
					jQuery('.sqb-notification-save-btn-msg').hide();
				}, 2000);			  
			});

		}
	})
/**/
	jQuery('.sqb-export-import-quiz-item').on('click', function(){
		jQuery('.sqb-export-import-quiz-selection').hide('slow');
		jQuery('.sqb-export-import-quiz-item').removeClass('sqb-email-notification-selected');
		jQuery(this).addClass('sqb-email-notification-selected');

		var quiz_value = jQuery(this).attr('data-value');

		if(quiz_value == 'all_quiz'){
			jQuery('#export-import-quiz-outer').show();
			jQuery('#import-question-answers-outer').hide();
			jQuery('#search-popup-quiz-outer').hide();
		}else if(quiz_value == 'question_answers'){
			jQuery('#import-question-answers-outer').show();
			jQuery('#export-import-quiz-outer').hide();
			jQuery('#search-popup-quiz-outer').hide();
			
			jQuery('.quizListing li:first-child a').trigger('click');
		}else if(quiz_value == 'search_popup'){
			jQuery('#export-import-quiz-outer').hide();
			jQuery('#search-popup-quiz-outer').show();
			jQuery('#import-question-answers-outer').hide();
		}
	});

	
	sqb_quiz_personality_name_text_update();
});

function sqb_add_new_Certificate(next_tab = ''){

    	var id =  jQuery('#cert_edit_id').val();

    	var cert_name  = jQuery("input[name='cert_name']").val();
	   	if(cert_name == ''){
			swal("Please enter name of certificate");
			sqb_cert_next_tab('cert_general_tab');
			return false;
	    }

	    var admin_name = jQuery('#certificate_admin_name').val();
	    var signature_img = jQuery('#cert_signature_img_src').val();
	    var logo_img = jQuery('#certificate_logo_src').val();
		
		if(admin_name == '' && signature_img == ''){
			swal("Please enter admin name or upload signature image");
			return false;
	    }
		
	    
	    var cert_status  = jQuery("input#certificate_btn_status").prop('checked');
	    
	    if(cert_status){
			cert_status = 'Y';
		}else{
			cert_status = 'N';
		}

		jQuery(".certificate_template_html_outer  .sqb_tiny_mce_editor,  .sqb_tiny_mce_editor" ).each(function(){
		jQuery(this).removeAttr('id');
			
		});

		var ans_html1 = jQuery('.certificate_template_html_outer').html(); 
	    sqb_tiny_mce_editor();	

	    jQuery('.certtificate_data_hidden').html(ans_html1) ;
		jQuery('.certtificate_data_hidden .ui-resizable-handle.ui-resizable-e').remove();
		jQuery('.certtificate_data_hidden .ui-resizable-handle.ui-resizable-se').remove();
		jQuery('.certtificate_data_hidden .ui-resizable-handle.ui-resizable-s').remove();
		
		var ans_html2 =  jQuery('.certtificate_data_hidden').html();
		jQuery('.certtificate_data_hidden').html('');
	     
	    var template_html = encodeURIComponent(ans_html2);
	    
	   //var logo_width = jQuery('.certificate_template_html_outer').find('.award_img_inner').css('width').replace(/[^-\d\.]/g, '');
	   //var logo_height =  jQuery('.certificate_template_html_outer').find('.award_img_inner').css('height').replace(/[^-\d\.]/g, '');
	    
	    //var csutomzer_value = logo_width+'||'+logo_height;
	   
	    //var cert_type = jQuery('#cert_type').val();
	    var template = "1";
	    SQBShowLoader();

	    jQuery.post(ajaxurl, {
			action: 'SQBSaveCertificateData',
			operation_name: 'save_certificate',
			data: {"admin_name":admin_name,"logo_img":logo_img,"signature_img":signature_img,"id":id,"cert_name":cert_name, "operation_name":'save_certificate' ,"cert_status":cert_status, "template_html":template_html, "template":template},	
		},function(response) {
			//console.log(response);
			response = JSON.parse(response);

			SQBHideLoader();
			if(next_tab == 'cert_customizer_tab'){
				jQuery('.add_new_certificate_tabs').find(' li:eq(1) a').trigger('click');
				jQuery('.certficate-prev-btn').show();
			}

			if(response.edit_id){
				jQuery('#cert_edit_id').val(response.edit_id);
			}
			jQuery('.saved-cert-msg').show();

			setTimeout(function(){
				jQuery('.saved-cert-msg').hide();
			},1000);
		}); 

    }

    function sqb_cert_next_tab(tab_id){
		jQuery('ul.add_new_certificate_tabs').find('a[href="#'+tab_id+'"]').trigger('click');
	}

function sqb_getUrlVars()
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


function sqb_quiz_personality_name_text_update() {
	
		jQuery(document).on('focus','.show_first_name_screen_temp_outer input[name="sqb_first_name"]', function(){ 
			var text = jQuery(this).attr('placeholder');
			jQuery(this).val(text);
		});
		
		jQuery(document).on('focusout','.show_first_name_screen_temp_outer input[name="sqb_first_name"]', function(){ 
			var text = jQuery(this).val();
			jQuery(this).attr('placeholder', text);
			jQuery(this).val('');
		});
	
}


function sqb_save_facebook_api_key(){
	
	var fb_api_key = jQuery("#fb_api_key").val();
	if(fb_api_key == ''){
		swal('','Please Enter facebook API Key');
		return false;
	}
	
	SQBShowLoader();
	jQuery.post(ajaxurl, {
			action: 'sqb_save_fb_api_key',
			fb_api_key: fb_api_key,
			
	}, function(response){
			response = JSON.parse(response);
			//console.log(response);
			SQBHideLoader();  
			
	});
}

function sqb_save_chatgpt_api_key(){
	
	var api_key = jQuery("#chatgpt_api_key").val();
	var api_model = jQuery("#openai-model").val();
	/*if(api_key == ''){
		swal('','Please Enter ChatGPT API Key');
		return false;
	}*/
	
	SQBShowLoader();
	jQuery.post(ajaxurl, {
			action: 'sqb_save_chatgpt_api_key',
			api_key: api_key,
			api_model: api_model
	}, function(response){
			response = JSON.parse(response);
			//console.log(response);
			jQuery('.save-quiz-ai-outer').show();
			SQBHideLoader();  
			
	});
}

function sqb_save_quick_email_verification_api_key(){
	
	var qev_api_key = jQuery("#qev_api_key").val();
	var qev_timeout = jQuery("#qev_timeout").val();

	var reoon_api_key = jQuery("#reoon_api_key").val();

	var email_verification_platform = jQuery('input[name="email_verify_platform"]:checked').val();

	/*if(qev_api_key == ''){
		swal('','Please Enter Quick Email Verification API Key');
		return false;
	}*/
	/*if(qev_timeout == ''){
		swal('','Please Enter Quick Email Verification Timeout');
		return false;
	}*/
	
	SQBShowLoader();
	jQuery.post(ajaxurl, {
			action: 'sqb_save_quick_email_verification_api_settings',
			qev_api_key: qev_api_key,
			email_verification_platform: email_verification_platform,
			reoon_api_key: reoon_api_key,
			qev_timeout: qev_timeout,
			
	}, function(response){
			response = JSON.parse(response);
			//console.log(response);
			SQBHideLoader();  
	});
}

function sqb_getpdf_settings(){ 	
	
	var quizid = jQuery('.pdf-quizList li.activeli').attr("data-value"); 
	if(jQuery('.pdf-quizList li.activeli').length < 1){
		quizid = 0;
		jQuery('.different-first-image .pdf-image-section').hide();
		return false;
	}

	SQBShowLoader();

	jQuery.post(ajaxurl, {
		action: 'sqb_getpdf_settings',
		quizid: quizid,   
	}, function(response) {	
		SQBHideLoader();
		response = JSON.parse(response);
		if(response.success){
			if(response.first_page_image && response.first_page_image != 'NULL'){
				jQuery('.different-first-image .first-page-image .pdf-image-section').show();
				jQuery('.different-pdf-first-img').attr('src',response.first_page_image);
				jQuery('input[name="different_first_page_image"]').val(response.first_page_image);
				jQuery('.different-first-image .first-page-image .browse-pdf-btn-wrapper').hide();
			}else{
				jQuery('.different-first-image .first-page-image .pdf-image-section').hide();
				jQuery('.different-pdf-first-img').attr('src','');
				jQuery('input[name="different_first_page_image"]').val('');
				jQuery('.different-first-image .first-page-image .browse-pdf-btn-wrapper').show();

			}

			if(response.quiz_firstpage_width){
				jQuery('#quiz_firstpage_width').bootstrapSlider('setValue',response.quiz_firstpage_width);
			}else{
				jQuery('#quiz_firstpage_width').bootstrapSlider('setValue','450');
			}

			if(response.quiz_first_page_align){
				jQuery('#quiz_first_page_align_style option[value="'+response.quiz_first_page_align+'"]').attr('selected',true);
			}else{
				jQuery('#quiz_first_page_align_style option').attr('selected',false);
				jQuery('#quiz_first_page_align_style option[value="center"]').attr('selected',true);
			}

			if(response.quiz_first_page_horizontal){
				jQuery('#quiz_first_horizontal_page_align_style option[value="'+response.quiz_first_page_horizontal+'"]').attr('selected',true);
			}else{
				jQuery('#quiz_first_horizontal_page_align_style optio').attr('selected',false);
				jQuery('#quiz_first_horizontal_page_align_style option[value="center"]').attr('selected',true);
			}

			if(response.last_page_image && response.last_page_image != 'NULL'){
				jQuery('.different-first-image .last-page-image .pdf-image-section').show();
				jQuery('.different-pdf-last-img').attr('src',response.last_page_image);
				jQuery('input[name="different_last_page_image"]').val(response.last_page_image);
				jQuery('.different-first-image .last-page-image .browse-pdf-btn-wrapper').hide();
			}else{
				jQuery('.different-first-image .last-page-image .pdf-image-section').hide();
				jQuery('.different-pdf-last-img').attr('src','');
				jQuery('input[name="different_last_page_image"]').val('');
				jQuery('.different-first-image .last-page-image .browse-pdf-btn-wrapper').show();
			}

			if(response.quiz_lastpage_width){
				jQuery('#quiz_lastpage_width').bootstrapSlider('setValue',response.quiz_lastpage_width);
			}else{
				jQuery('#quiz_lastpage_width').bootstrapSlider('setValue','450');
			}

			if(response.quiz_last_page_align){
				jQuery('#quiz_last_page_align_style option[value="'+response.quiz_last_page_align+'"]').attr('selected',true);
			}else{
				jQuery('#quiz_last_page_align_style option').attr('selected',false);
				jQuery('#quiz_last_page_align_style option[value="center"]').attr('selected',true);
			}


			if(response.quiz_last_page_horizontal){
				jQuery('#quiz_last_horizontal_page_align_style option[value="'+response.quiz_last_page_horizontal+'"]').attr('selected',true);
			}else{
				jQuery('#quiz_last_horizontal_page_align_style option').attr('selected',false);
				jQuery('#quiz_last_horizontal_page_align_style option[value="center"]').attr('selected',true);
			}
			
			
		}
	});
}	

function sqb_getquiz_settings(){ 	
	var quizid = jQuery('.quizList li.activeli').attr("data-value"); 
	if(jQuery('.quizList li.activeli').length < 1){
		quizid = 0;
		return false;
	}
	SQBShowLoader();
	var gop_exists = jQuery('#gop_exists').val();
	jQuery.post(ajaxurl, {
		action: 'sqb_getquiz_settings',
		quizid: quizid,   
	}, function(response) {	
		response = JSON.parse(response);
		if(response.success){
			if(response.template_num == "template8" || response.template_num == "template7"){
				jQuery('.hide-for-template8').hide()
			}else{
				jQuery('.hide-for-template8').show()
			}

			if(response.template_num == "template3" || response.template_num == "template4"){
				jQuery('.top_bar_bg_color').show();
			}else{
				jQuery('.top_bar_bg_color').hide();
			}
			//jQuery('input[name="grade_quiz"]').val(response.grade_quiz); 
			jQuery('input[name="quiz_passmark"]').val(response.quiz_passmark);
			jQuery('.quiz_attempts_allowed').val(response.quiz_attempts_allowed);
			jQuery('.already_take_the_quiz').val(response.already_take_the_quiz);
			jQuery('input[name="quiz_timer_limit"]').val(response.quiz_timer_limit);
			
			/*if(response.quiz_attempts_allowed == "Y"){
				jQuery('.quiz_attempts_allowed_outer_option').css('display' , 'inline-block');
			}else{
				jQuery('.quiz_attempts_allowed_outer_option').css('display' , 'none');
			}*/
			
			if(response.grade_quiz =="Y"){
				jQuery('input[name="grade_quiz"]').attr('checked' , true);
				jQuery('.quiz_passmark_div').css('display' , 'inline-block');
			}else{
				jQuery('input[name="grade_quiz"]').attr('checked' , false);
				jQuery('.quiz_passmark_div').css('display' , 'none');
			}
			if(response.quiz_timer =="Y"){
				jQuery('input[name="quiz_timer"]').attr('checked' , true);
			}else{
				jQuery('input[name="quiz_timer"]').attr('checked' , false);
			}

			if(response.show_firstname_outcome =="Y"){
				jQuery('input[name="show_firstname_outcome"]').attr('checked' , true);
			}else{
				jQuery('input[name="show_firstname_outcome"]').attr('checked' , false);
			}
			
			
			/*if(response.progress_bar =="Y"){
				jQuery('input[name="progress_bar"]').attr('checked' , true);
			}else{
				jQuery('input[name="progress_bar"]').attr('checked' , false);
			}*/
			
			/*if(response.show_correct_ans =="Y"){
				jQuery('input[name="show_correct_ans"]').attr('checked' , true);
			}else{
				jQuery('input[name="show_correct_ans"]').attr('checked' , false);
			}*/
			if(response.questions_random =="Y"){
				jQuery('input[name="questions_random"]').prop('checked' , true);
			}else{
				jQuery('input[name="questions_random"]').prop('checked' , false);
			}
			
			if(response.answers_random =="Y"){
				jQuery('input[name="answers_random"]').prop('checked' , true);
			}else{
				jQuery('input[name="answers_random"]').prop('checked' , false);
			}

			if(response.move_question =="Y"){
				jQuery('input[name="move_question"]').prop('checked' , true);
			}else{
				jQuery('input[name="move_question"]').prop('checked' , false);
			}
			if(response.show_for_notloggedin_user =="Y"){
				jQuery('input[name="show_for_notloggedin_user"]').attr('checked' , true);
			}else{
				jQuery('input[name="show_for_notloggedin_user"]').attr('checked' , false);
			}
			
			if(response.show_first_name_screen =="Y"){
				jQuery('input[name="show_first_name_screen"]').prop('checked' , true);
				jQuery('.show_first_name_screen_temp_outer').show();
				
			//	jQuery('.show_first_name_screen_temp').html(response.quiz_first_name_template);
			}else{
				jQuery('input[name="show_first_name_screen"]').prop('checked' , false);
				jQuery('.show_first_name_screen_temp_outer').hide();
			}

			if(response.show_analyzing_result =="Y"){
				jQuery('input[name="analyzing_result"]').prop('checked' , true);
				jQuery('.show_analyzing_result_outer').show();
				
			//	jQuery('.show_analyzing_result_temp').html(response.quiz_first_name_template);
			}else{
				jQuery('input[name="analyzing_result"]').prop('checked' , false);
				jQuery('.show_analyzing_result_outer').hide();
			}

			jQuery('.startTemplateHidden').html(response.quiz_start_template);

			if(jQuery('.startTemplateHidden').find('.start_temp_outer').length == 0){
				var defaultHtml = jQuery('.startDefaultTemplateHidden').html();
				jQuery('.startTemplateHidden').html(defaultHtml);
			}

			if(response.quiz_first_name_template != '' && response.quiz_first_name_template != 'NULL'){
				jQuery('.startTemplateHidden').find('.start_temp_outer').html(response.quiz_first_name_template);
				var get_color = jQuery('.startTemplateHidden').find('.firstname_ok_btn').css('background-color');
				if(get_color){
					jQuery('#personalization_button_color').val(rgb2hex(get_color));
					jQuery('#personalization_button_color_div span i').css('background-color',(rgb2hex(get_color)));
				}else{
					jQuery('#personalization_button_color').val('#ff634d');
					jQuery('#personalization_button_color_div span i').css('background-color',('#ff634d'));
				}
			}else{
				jQuery('.startTemplateHidden').find('.start_temp_outer').html(' <div class="Quiz-Template-content"><div class="show_first_name_screen_temp"><div class="Quiz-Template-title sqb_tiny_mce_editor">First up, what should we call you?</div><input type="text" value="" class="sqb_first_name" name="sqb_first_name" placeholder="Enter Name"><div class="sqb_first_name_ok_btn sqb_tiny_mce_editor"><div class="firstname_ok_btn">OK</div></div></div></div>');		
				jQuery('#personalization_button_color').val('#ff634d');
				jQuery('#personalization_button_color_div span i').css('background-color',('#ff634d'));
			}

			
			jQuery('#setting_tag_background_color').val(response.setting_tag_background_color);
			jQuery('#next_button_settings_background_color').val(response.next_button_settings_background_color);
			jQuery('#skip_question_button_for_quiz').val(response.skip_question_button_for_quiz);
			jQuery('#setting_category_background_color').val(response.setting_category_background_color);
			jQuery('#setting_ans_ad_recommendation').val(response.setting_ans_ad_recommendation);
			jQuery('#setting_question_ads_color').val(response.setting_question_ads_color);
			jQuery('#setting_personalization_color').val(response.setting_personalization_color);
			jQuery('#setting_analyzing_screen_color').val(response.setting_analyzing_screen_color);
			jQuery('#setting_progress_color').val(response.setting_progress_color);
			jQuery('#setting_progress_inactive_color').val(response.setting_progress_inactive_color);
			jQuery('#charts_bar_background_color').val(response.charts_bar_background_color);
			jQuery('#top_bar_background_color').val(response.top_bar_background_color);
			jQuery('#placeholder_button_color').val(response.placeholder_button_color);
			jQuery('#setting_tag_background_color_div').colorpicker('setValue', response.setting_tag_background_color);
			jQuery('#next_button_settings_background_color_div').colorpicker('setValue', response.next_button_settings_background_color);
			jQuery('#skip_question_button_for_quiz_div').colorpicker('setValue', response.skip_question_button_for_quiz);
			jQuery('#setting_category_background_color_div').colorpicker('setValue', response.setting_category_background_color);
			jQuery('#setting_ans_ad_recommendation_div').colorpicker('setValue', response.setting_ans_ad_recommendation);
			jQuery('#setting_question_ads_color_div').colorpicker('setValue', response.setting_question_ads_color);
			jQuery('#setting_personalization_color_div').colorpicker('setValue', response.setting_personalization_color);
			jQuery('#setting_analyzing_screen_color_div').colorpicker('setValue', response.setting_analyzing_screen_color);
			jQuery('#setting_progress_color_div').colorpicker('setValue', response.setting_progress_color);
			jQuery('#setting_progress_inactive_color_div').colorpicker('setValue', response.setting_progress_inactive_color);
			jQuery('#charts_bar_background_color_div').colorpicker('setValue', response.charts_bar_background_color);
			jQuery('#top_bar_background_color_div').colorpicker('setValue', response.top_bar_background_color);
			jQuery('#placeholder_button_color_div').colorpicker('setValue', response.placeholder_button_color);

			jQuery('#tag_width').bootstrapSlider('setValue', response.setting_tag_width_input);


			jQuery('#nexttbtn_width_for_quiz').bootstrapSlider('setValue', response.nexttbtn_width_for_quiz);
			jQuery('#nexttbtn_height_for_quiz').bootstrapSlider('setValue', response.nexttbtn_height_for_quiz);
			var next_btn_html = jQuery('.next-btn-settings .next_temp_container').html(response.next_btn_html);

			jQuery('#skip_question_btn_width_for_quiz').bootstrapSlider('setValue', response.skip_question_btn_width_for_quiz);
			jQuery('#skip_question_btn_height_for_quiz').bootstrapSlider('setValue', response.skip_question_btn_height_for_quiz);
			var skip_btn_html = jQuery('.skip_question_wrapper_for_quiz .skip_question_temp_container').html(response.skip_btn_html);


			jQuery('.tag_width_input').val(response.setting_tag_width_input);

			jQuery('#category_width').bootstrapSlider('setValue', response.setting_category_width_input);
			jQuery('.category_width_input').val(response.setting_category_width_input);

			jQuery('#question_width').bootstrapSlider('setValue', response.setting_question_width_input);
			jQuery('.question_width_input').val(response.setting_question_width_input);

			jQuery('#personalization_width').bootstrapSlider('setValue', response.setting_personalization_width_input);
			jQuery('.personalization_width_input').val(response.setting_personalization_width_input);

			jQuery('#analyzing_width').bootstrapSlider('setValue', response.setting_analyzing_width_input);
			jQuery('.analyzing_width_input').val(response.setting_analyzing_width_input);


			if(response.quiz_analyzing_result_template != ''){
				var get_html = jQuery('.show_analyzing_result_outer').find('.show_analyzing_result_inner .Quiz-Template-content').html(response.quiz_analyzing_result_template);
				var time_delay = jQuery(get_html).find('.time-delay-hidden').val();
				jQuery('.analyzing-result-time-delay').val(time_delay);

				var progress_color = jQuery('.analyzing-progress-bar').css('background-color');
				jQuery('#analyzing_result_progress_color').val(rgb2hex(progress_color));
				jQuery('#analyzing_result_progress_color_div span i').css('background-color',(rgb2hex(progress_color)));

				var text_align = jQuery('.analyzing_result_temp').css('text-align');
				jQuery('#analyzing_result_alignment option[value='+text_align+']').attr('selected','selected');

			}else{
				jQuery('.show_analyzing_result_outer').find('.show_analyzing_result_inner .Quiz-Template-content').html('<div class="analyzing_result_temp" style="text-align: center;"> <div class="analyzing_result_content"> <div class="analyzing_result_title sqb_tiny_mce_editor">Preparing Report...</div> <div class="sqb_tiny_mce_editor">Please wait... we are calculating your results</div> </div> <div class="analyzing_result_progress"><div class="progress"> <div class="analyzing-progress-bar" role="progressbar" style="width: 50%;background-color:#007bff;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div> </div> <div class="analyzing_result_note sqb_tiny_mce_editor">* Do not leave the page or reload the page *</div> </div> <input type="hidden" name="time-delay-hidden" class="time-delay-hidden" value="3"> </div>');		
			}
			
			if(response.grade_quiz_name){
				jQuery('.setting_quiz_title').show();
				jQuery('.setting_quiz_title .quiz_label').html(response.grade_quiz_name);
			}
			
			jQuery('.show_first_name_screen_temp_inner').html(jQuery('.startTemplateHidden').html());
			
			if(response.quiz_type){
					jQuery('#give_points_on_complete').attr('data-quiz-type',response.quiz_type);
					jQuery('#give_points_on_quiz_pass').attr('data-quiz-type',response.quiz_type);
			}
		
			jQuery('.quiz_passing_score_outer').hide();
			jQuery('.quiz_correct_answers_outer').hide();
			jQuery('.check_gop_availability').hide('slow');
			
			if(response.quiz_points_id && gop_exists != 'N'){
				//console.log('data is saved');
				if(response.quiz_give_points == 'Y'){
					
					if(jQuery('#give_points_on_complete').prop('checked') == false){
						jQuery('#give_points_on_complete').trigger('click');
					}
					jQuery('#quiz_how_many_points').val(response.quiz_points);
					if(response.display_quiz_points_message == '<br data-mce-bogus="1">'){
					} else {
						jQuery('.sqb_display_message_box').html(response.display_quiz_points_message);
					}
					
					if(response.quiz_type){
						if(response.quiz_type == 'scoring'){
							jQuery('.give_points_on_quiz_pass_outer').show();
							if(response.quiz_points_pass_criteria == 'pass'){
								if(jQuery('#give_points_on_quiz_pass').prop('checked') == false){
								jQuery('#give_points_on_quiz_pass').trigger('click');
								}
								jQuery('.quiz_passing_score_outer').show();
								jQuery('#quiz_passing_score').val(response.quiz_points_pass_percent);
								jQuery('.give_points_on_retake_outer').show();
								if(response.quiz_points_retake_pass_rule == 'Y'){
									if(jQuery('#give_points_on_retake').prop('checked') == false){
									jQuery('#give_points_on_retake').trigger('click');
									}
								} else {
									if(jQuery('#give_points_on_retake').prop('checked') == true){
									jQuery('#give_points_on_retake').trigger('click');
									}
								}
							} else {
								if(jQuery('#give_points_on_quiz_pass').prop('checked') == true){
								jQuery('#give_points_on_quiz_pass').trigger('click');
								}
							}
						} else if(response.quiz_type == 'assessment'){
							jQuery('.give_points_on_quiz_pass_outer').show();
							if(response.quiz_points_pass_criteria == 'pass'){
								if(jQuery('#give_points_on_quiz_pass').prop('checked') == false){
								jQuery('#give_points_on_quiz_pass').trigger('click');
								}
								
								jQuery('.quiz_correct_answers_outer').show();
								jQuery('#quiz_correct_answers').val(response.quiz_points_pass_percent);
								jQuery('.give_points_on_retake_outer').show();
								if(response.quiz_points_retake_pass_rule == 'Y'){
									if(jQuery('#give_points_on_retake').prop('checked') == false){
									jQuery('#give_points_on_retake').trigger('click');
									}
								} else {
									if(jQuery('#give_points_on_retake').prop('checked') == true){
									jQuery('#give_points_on_retake').trigger('click');
									}
								}
							} else {
								if(jQuery('#give_points_on_quiz_pass').prop('checked') == true){
								jQuery('#give_points_on_quiz_pass').trigger('click');
								}
							}
						} else {
							jQuery('.give_points_on_quiz_pass_outer').hide();
							jQuery('.quiz_passing_score_outer').hide();
							jQuery('.quiz_correct_answers_outer').hide();
							jQuery('.give_points_on_retake_outer').hide();
						}
					}
				} else {
					if(jQuery('#give_points_on_complete').prop('checked') == true){
						jQuery('#give_points_on_complete').trigger('click');
					}
				}
			} else {
				//console.log('data is not saved');
				if(jQuery('#give_points_on_complete').prop('checked') == true){
					jQuery('#give_points_on_complete').trigger('click');
					jQuery('#quiz_how_many_points').val('');
				}
				jQuery('.sqb_display_message_box').html('<div style="text-align:left">Congrats! You have earned %%POINTS%% point(s) by completing this quiz.</div>');
			}
			jQuery('.show_first_name_screen_temp').find( "[id^='mce_']" ).each(function(){
            	jQuery(this).removeAttr('id');
     	 	});
			jQuery('.analyzing_result_temp').find( "[id^='mce_']" ).each(function(){
            	jQuery(this).removeAttr('id');
     	 	});

			if(response.template_num == "template5"){
				jQuery('.Quiz-start-Template5').addClass('quiz_comon_template');
			}
			sqb_tiny_mce_editor();
			
		}	 
		SQBHideLoader();			  
	});
	 			    		
			 
	
}

function sqb_stripslashes (str) {

  return (str + '').replace(/\\(.?)/g, function (s, n1) {
    switch (n1) {
    case '\\':
      return '\\';
    case '0':
      return '\u0000';
    case '':
      return '';
    default:
      return n1;
    }
  });
}
function rgb2hex(rgb){
	if(typeof rgb !== "undefined"){
	 rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
	 return (rgb && rgb.length === 4) ? "#" +
	  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
	  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
	  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
	}
}

function sqb_save_global_settings(){
	jQuery(document).on('click', '#sqb_disable_wp_sync',function(){
		var sqb_wp_syncing = 'N';
		  if(jQuery(this).prop("checked") == true){
            sqb_wp_syncing = 'Y';
          }
          jQuery.post(ajaxurl, {
			action: 'sqb_wp_syncing_save',
			sqb_wp_syncing: sqb_wp_syncing,   
			}, function(response) {		 
			});
	});

	jQuery(document).on('click', '#google_font_enable',function(){
		var sqb_google_font_option = 'N';
		  if(jQuery(this).prop("checked") == true){
            sqb_google_font_option = 'Y';
          }
          SQBShowLoader();
          jQuery.post(ajaxurl, {
			action: 'google_font_option_save',
			sqb_google_font_option: sqb_google_font_option,   
			}, function(response) {		
			SQBHideLoader();				
				swal(
				'Success!',
				'Your record is updated.\n\n',
				'success'
			  ); 
			});
	});

	jQuery(document).on('click', '#sqb_optimized_js_css_enable',function(){
		var sqb_optimized_js_css = 'N';
		  if(jQuery(this).prop("checked") == true){
            sqb_optimized_js_css = 'Y';
          }
          jQuery.post(ajaxurl, {
			action: 'sqb_optimized_js_css_option_save',
			sqb_optimized_js_css: sqb_optimized_js_css,   
			}, function(response) {		 
			});
	});

	jQuery(document).on('click', '#sqb_rtl_mode',function(){
		var sqb_rtl_mode = 'N';
		  if(jQuery(this).prop("checked") == true){
            sqb_rtl_mode = 'Y';
          }
          jQuery.post(ajaxurl, {
			action: 'sqb_wp_sqb_rtl_save',
			sqb_rtl_mode: sqb_rtl_mode,   
			}, function(response) {		 
			});
	});

}
sqb_save_global_settings();

function sqb_exit_popup_timer(){
	jQuery(document).on('click', '.exit-popup-btn',function(){
		SQBShowLoader();
		var exit_popup_val = jQuery('input[name="exit_popup_timer"]').val();
	        jQuery.post(ajaxurl, {
				action: 'sqb_exit_popup_timer_save',
				exit_popup_val: exit_popup_val,   
				}, function(response) {	
				SQBHideLoader();	 
			});
	});
}
sqb_exit_popup_timer();

function sqb_pdf_settings_save(){
	jQuery(document).on('click', '.save-pdf-settings',function(e){
		SQBShowLoader();
		var header_background_color = jQuery('input[name="header_background_color"]').val();
		var pdf_global_font = jQuery('select[name="pdf_global_font"]').val();
		var footer_background_color = jQuery('input[name="footer_background_color"]').val();
		var footer_copyright_content = jQuery('.footer_copyright_content').html();
		var header_title = jQuery('.header_title').html();
		var add_pdf_icon = jQuery('input[name="add_pdf_icon"]').val();
		var first_page_image = jQuery('input[name="first_page_image"]').val();
		var last_page_image = jQuery('input[name="last_page_image"]').val();

		var firstpage_width = jQuery("#firstpage_width").val();
		var first_page_align = jQuery('#first_page_align_style option:selected').val();
		var first_page_horizontal = jQuery('#first_horizontal_page_align_style option:selected').val();

		var lastpage_width = jQuery("#lastpage_width").val();
		var last_page_align = jQuery('#last_page_align_style option:selected').val();
		var last_page_horizontal = jQuery('#last_horizontal_page_align_style option:selected').val();

		var upload_first_image_option = jQuery('input[name="upload_first_image_option"]').prop('checked');
		if(upload_first_image_option == true){
			var upload_first_image_option = 'Y';
		}else{
			var upload_first_image_option = 'N';
		}

		var pdf_display_option = jQuery('input[name="pdf_display_option"]:checked').val();

		if(pdf_display_option == 'different'){
			var quiz_id = jQuery('.pdf-quizList .nav-item.activeli').attr('data-value');
			var different_first_image = jQuery('input[name="different_first_page_image"]').val();
			var different_last_image = jQuery('input[name="different_last_page_image"]').val();

			var quiz_firstpage_width = jQuery("#quiz_firstpage_width").val();
			var quiz_first_page_align = jQuery('#quiz_first_page_align_style option:selected').val();
			var quiz_first_page_horizontal = jQuery('#quiz_first_horizontal_page_align_style option:selected').val();

			var quiz_lastpage_width = jQuery("#quiz_lastpage_width").val();
			var quiz_last_page_align = jQuery('#quiz_last_page_align_style option:selected').val();
			var quiz_last_page_horizontal = jQuery('#quiz_last_horizontal_page_align_style option:selected').val();

			jQuery.post(ajaxurl, {
				action: 'sqb_save_quiz_pdf',
				quiz_id: quiz_id,   
				different_first_image: different_first_image,   
				different_last_image: different_last_image,
				quiz_firstpage_width: quiz_firstpage_width,
				quiz_first_page_align: quiz_first_page_align,
				quiz_first_page_horizontal: quiz_first_page_horizontal,
				quiz_lastpage_width: quiz_lastpage_width,
				quiz_last_page_align: quiz_last_page_align,
				quiz_last_page_horizontal: quiz_last_page_horizontal,
				}, function(response) {	
					SQBHideLoader();	 
			});
		}

        jQuery.post(ajaxurl, {
			action: 'sqb_pdf_settings_save',
			header_background_color: header_background_color,   
			pdf_global_font: pdf_global_font,   
			footer_background_color: footer_background_color,   
			footer_copyright_content: footer_copyright_content,   
			header_title: header_title,   
			add_pdf_icon: add_pdf_icon,   
			first_page_image: first_page_image,   
			upload_first_image_option: upload_first_image_option,   
			pdf_display_option: pdf_display_option,   
			last_page_image: last_page_image,
			firstpage_width: firstpage_width,
			first_page_align: first_page_align,
			first_page_horizontal: first_page_horizontal,
			lastpage_width: lastpage_width,
			last_page_align: last_page_align,
			last_page_horizontal: last_page_horizontal,
			}, function(response) {	
				SQBHideLoader();	 
		});
	});
}
sqb_pdf_settings_save();

function sqb_save_quiz_setting(){ 
	var quiz_type = jQuery('li.nav-item.activeli').data('type');
	var quiz_random_question = jQuery('input[name="questions_random"]:checked').val();

	if(quiz_type == 'calculator' && quiz_random_question == 'Y'){
		
		jQuery('#questions_random').prop('checked', false); 
		var questions_random = 'N';
	}

	SQBShowLoader();
	var next_button_html = jQuery('.next_temp_container ').html();
	var back_button_html = jQuery('.back_temp_container ').html();
	var download_certificate_button_html = jQuery('.download_certificate_temp_container ').html();
	var retake_button_html = jQuery('.retake_temp_container ').html();
	
	var quizid = jQuery('.quizList li.activeli').attr("data-value");
	if(jQuery('.quizList li.activeli').length < 1){
		quizid = 0;
	}
	 
	var show_firstname_outcome  = jQuery('input[name="show_firstname_outcome"]').prop('checked');
	if(show_firstname_outcome){
		show_firstname_outcome = 'Y';
	}else{
		show_firstname_outcome = 'N';
	}
 	
 	var quiz_timer  = jQuery('input[name="quiz_timer"]').prop('checked');
	if(quiz_timer){
		quiz_timer = 'Y';
	}else{
		quiz_timer = 'N';
	}
	
	var quiz_timer_limit =jQuery('input[name="quiz_timer_limit"]').val();
	 
	var progress_bar  = jQuery('input[name="progress_bar"]').prop('checked');
	if(progress_bar){
		progress_bar = 'Y';
	}else{
		progress_bar = 'N';
	}
	
	
	var grade_quiz = jQuery('input[name="grade_quiz"]').val();
	var quiz_passmark = jQuery('input[name="quiz_passmark"]').val();
	var total_attempts = jQuery('input[name="total_attempts"]').val();
	var quiz_attempts_allowed = jQuery('.quiz_attempts_allowed option:selected').val();
	var already_take_the_quiz = jQuery('.already_take_the_quiz option:selected').val();
 
	var show_correct_ans  = jQuery('input[name="show_correct_ans"]').prop('checked');
	if(show_correct_ans){
		show_correct_ans = 'Y';
	}else{
		show_correct_ans = 'N';
	}
	if(quiz_type != 'calculator'){
		var questions_random  = jQuery('input[name="questions_random"]').prop('checked');
		if(questions_random){
			questions_random = 'Y';
		}else{
			questions_random = 'N';
		}
	}
	var answers_random  = jQuery('input[name="answers_random"]').prop('checked');
	if(answers_random){
		answers_random = 'Y';
	}else{
		answers_random = 'N';
	}

	var move_question  = jQuery('input[name="move_question"]').prop('checked');
	if(move_question){
		move_question = 'Y';
	}else{
		move_question = 'N';
	}
	var show_for_notloggedin_user  = jQuery('input[name="show_for_notloggedin_user"]').prop('checked');
	if(show_for_notloggedin_user){
		show_for_notloggedin_user = 'Y';
	}else{
		show_for_notloggedin_user = 'N';
	}
	
	var progressActive = jQuery('#progressactive_backgroud_color').val();
	var progressInactive = jQuery('#progressinactive_backgroud_color').val();
	var answer_background = jQuery('#answer_background_color').val();
	var answer_background1 = jQuery('#answer_background_color1').val();
	var answer_text_color = jQuery('#answer_text_color').val();
	var correct_answer_msg = jQuery('#correct_answer_msg').val();
	var incorrect_answer_msg = jQuery('#incorrect_answer_msg').val();
	var pick_ans_msg = jQuery('#pick_ans_msg').val();
	var sqb_question_cust = jQuery('#sqb_question_cust').val();
	var sqb_answer_cust = jQuery('#sqb_answer_cust').val();
	var sqb_incorrect_ans_exp = jQuery('#sqb_incorrect_ans_exp').val();
	var username_empty_msg = jQuery('#username_empty_msg').val();
	var required_field = jQuery('#required_field').val();
	var gdpr_required_field = jQuery('#gdpr_required_field').val();
	var outcome_screen_answer = jQuery('#outcome_screen_answer').val();
	var outcome_screen_result = jQuery('#outcome_screen_result').val();
	var outcome_screen_correct_answer = jQuery('#outcome_screen_correct_answer').val();
	var outcome_screen_incorrect_answer = jQuery('#outcome_screen_incorrect_answer').val();
	var email_empty_msg = jQuery('#email_empty_msg').val();
	var terms_condition_msg = jQuery('#terms_condition_msg').val();
	var show_first_name_screen = jQuery('#show_first_name_screen').prop('checked');
	var show_analyzing_result = jQuery('#analyzing_result').prop('checked');
	var show_analyzing_result_time = jQuery('.analyzing-result-time-delay').val();
	var show_first_name_screen_temp = jQuery('.show_first_name_screen_temp_outer').find('.quiz_comon_template').html();
	var show_analyzing_result_temp = jQuery('.show_analyzing_result_outer').find('.Quiz-Template-content').html();
	var placeholder_button_color = jQuery('#placeholder_button_color').colorpicker('getValue');
	
	if(show_first_name_screen){
		show_first_name_screen = 'Y';
	}else{
		show_first_name_screen = 'N';
	}

	if(show_analyzing_result){
		show_analyzing_result = 'Y';
	}else{
		show_analyzing_result = 'N';
	}
	var result_background_color = jQuery('#result_background_color').val();
	var result_background_color1 = jQuery('#result_background_color1').val();
	var fb_share_thank_you_msg = jQuery('#fb_share_thank_you_msg').val();
	var fb_share_error_msg = jQuery('#fb_share_error_msg').val();
	var valid_email = jQuery('#valid_email').val();
	var already_taken_quiz = jQuery('#already_taken_quiz').val();
	var not_passed_quiz_msg = jQuery('#not_passed_quiz_msg').val();
   
    // dap_customizer start 
    if(jQuery('.reports_tab_content_inner_sub_tab').hasClass('dap_enable_class')){
		var dap_see_details_btn_html = jQuery('.dap_see_details_template_html_preview_outer').html();
		var see_details_width = jQuery('#see_details_width').val();
		var see_details_height = jQuery('#see_details_height').val();
		var see_details_backgroud_color = jQuery('#see_details_backgroud_color').val();
		var dap_see_details_btn_customizer = see_details_width+'||'+see_details_height+'||'+see_details_backgroud_color;
		
		// question customizer 
		var dap_questions_font = jQuery('#dap_questions_font').val();
		var dap_questions_customizer = dap_questions_font;
		// answer customizer 
		var dap_answer_font = jQuery('#dap_answer_font').val();
		var dap_answer_font_weigth = jQuery('#dap_answer_font_weight').val();
		var dap_answer_background_color = jQuery('#dap_answer_background_color').val();
		var dap_answer_active_background_color = jQuery('#dap_answer_active_background_color').val();
		
		var dap_answer_customizer = dap_answer_font+'||'+dap_answer_font_weigth+'||'+dap_answer_background_color+'||'+dap_answer_active_background_color;
	}
    
    
    // dap_customizer end
   
     // skip question start
     
     var skip_question_btn_html = jQuery('.skip_question_temp_container').html();
     var skip_question_btn_width = jQuery('#skip_question_btn_width').val();
	 var skip_question_btn_height = jQuery('#skip_question_btn_height').val();
	 var skip_question_btn_backgroud_color = jQuery('#skip_question_button_backgroud_color').val();
	 
	 var skip_question_customizer = skip_question_btn_width+'||'+skip_question_btn_height+'||'+skip_question_btn_backgroud_color;
   
     // skip question end
	 
	// file upload button start
     
     var file_upload_btn_html = jQuery('.file_upload_temp_container').html();
     var file_upload_btn_width = jQuery('#file_upload_btn_width').val();
	 var file_upload_btn_height = jQuery('#file_upload_btn_height').val();
	 var file_upload_btn_backgroud_color = jQuery('#file_upload_button_backgroud_color').val();
	 
	 var file_upload_customizer = file_upload_btn_width+'||'+file_upload_btn_height+'||'+file_upload_btn_backgroud_color;
   
     // file upload button end
	 
     var user_shortcode_not_login = jQuery('#user_shortcode_not_login').val();
     var upload_button_text = jQuery('#upload_button_text').val();
     var uploaded_filename_text = jQuery('#uploaded_filename_text').val();
     var file_uploaded_message = jQuery('#file_uploaded_message').val();
     var file_upload_failed_message = jQuery('#file_upload_failed_message').val();
     var upload_filesize_limit_exceeds_message = jQuery('#upload_filesize_limit_exceeds_message').val();
     var file_upload_validation = jQuery('#file_upload_validation').val();
	
	var give_points = 'N';
	if(jQuery('#give_points_on_complete').prop('checked') == true){
		give_points = 'Y'
	}
	
	var points = jQuery('#quiz_how_many_points').val();
	
	var pass_criteria = 'complete';
	if(jQuery('#give_points_on_quiz_pass').prop('checked') == true){
		pass_criteria = 'pass';
	}
	
	var quiz_type = jQuery('#give_points_on_complete').attr('data-quiz-type');
	var pass_percent = '';
	if(quiz_type == 'scoring'){
		pass_percent = jQuery('#quiz_passing_score').val();
	}
	if(quiz_type == 'assessment'){
		pass_percent = jQuery('#quiz_correct_answers').val();
	}
	
	var retake_pass_rule = 'N';
	if(jQuery('#give_points_on_retake').prop('checked') == true){
		retake_pass_rule = 'Y'
	}
	
	var display_quiz_points_message = encodeURIComponent(jQuery('.sqb_display_message_box').html());
    
    //category quiz 
   var category_scoring_text1 = jQuery('#category_scoring_text1').val();
   var category_assessment_text1 = jQuery('#category_assessment_text1').val();
   var invalid_date_text = jQuery('#invalid_date_text').val();
   var pdf_download_success = jQuery('#pdf_download_success').val();
   var pdf_downloading_text = jQuery('#pdf_downloading_text').val();
   var logged_in_admin_msg = jQuery('#logged_in_admin_msg').val();
   var voting_closed = jQuery('#voting_closed').val();
   var quiz_details = jQuery('#quiz_details').val();
   var user_details = jQuery('#user_details').val();
   var user_answer = jQuery('#user_answer').val();
   var sqb_quiz_name = jQuery('#sqb_quiz_name').val();
   var sqb_date = jQuery('#sqb_date').val();
   var retake_count = jQuery('#retake_count').val();
   var time_spent = jQuery('#time_spent').val();
   var gdpr_terms = jQuery('#gdpr_terms').val();
   var quiz_result = jQuery('#quiz_result').val();
   var sqb_outcome = jQuery('#sqb_outcome').val();
   var sqb_name = jQuery('#sqb_name').val();
   var sqb_email = jQuery('#sqb_email').val();
   var user_email = jQuery('#user_email').val();
   var student_correct_answer = jQuery('#student_correct_answer').val();
   var points_scored = jQuery('#points_scored').val();
   var file_name = jQuery('#file_name').val();
   var student_incorrect = jQuery('#student_incorrect').val();
   var click_to_download = jQuery('#click_to_download').val();
   var file_upload_successfully = jQuery('#file_upload_successfully').val();
   var answer_no_longer = jQuery('#answer_no_longer').val();
   var sqb_weight = jQuery('#sqb_weight').val();
   var sqb_height = jQuery('#sqb_height').val();
   var sqb_certificate = jQuery('#sqb_certificate').val();
   var category_name_customize = jQuery('#category_name_customize').val();
   var click_to_play = jQuery('#click_to_play').val();
   var student_score = jQuery('#student_score').val();
   var sqb_total_points = jQuery('#sqb_total_points').val();
   var sqb_result = jQuery('#sqb_result').val();
   var sqb_score = jQuery('#sqb_score').val();
   var sqb_high = jQuery('#sqb_high').val();
   var sqb_medium = jQuery('#sqb_medium').val();
   var sqb_low = jQuery('#sqb_low').val();
   var sqb_valid_phonenumber = jQuery('#sqb_valid_phonenumber').val();
   var limit_exceeded = jQuery('#limit_exceeded').val();
   var dont_want_listed = tinymce.get('dont_want_listed').getContent();
   var click_to_optout = tinymce.get('click_to_optout').getContent();
   var logged_in_optout = tinymce.get('logged_in_optout').getContent();
   var dont_want_listed_leaderboard = tinymce.get('dont_want_listed_leaderboard').getContent();
   var not_loggedin = tinymce.get('not-loggedin-user').getContent();
   /*Category Values */

	var cat_width = jQuery('#customizer_width').val();
	var category_customizer_background_color = jQuery('#category_customizer_background_color').val();
	var customizer_border_width = jQuery('#customizer_border_width').val();
	var customizer_temp_br_style = jQuery('#customizer_temp_br_style').find(":selected").val();
	var category_customizer_border_color = jQuery('#category_customizer_border_color').val();
	var customizer_spread_radius = jQuery('#customizer_spread_radius').val();
	var customizer_blur_radius = jQuery('#customizer_blur_radius').val();
	var customizer_horizontal_length = jQuery('#customizer_horizontal_length').val();
	var customizer_vertical_length = jQuery('#customizer_vertical_length').val();
	var category_customizer_box_background_color = jQuery('#category_customizer_box_background_color').val();
	var customizer_align_style = jQuery('#customizer_align_style').find(":selected").val();
	var customizer_margin = jQuery('#customizer_margin').val();
	var customizer_padding = jQuery('#customizer_padding').val();

   	var category_customizer_values = cat_width+'|'+category_customizer_background_color+'|'+customizer_border_width+'|'+customizer_temp_br_style+'|'+category_customizer_border_color+'|'+customizer_spread_radius+'|'+customizer_blur_radius+'|'+customizer_horizontal_length+'|'+customizer_vertical_length+'|'+category_customizer_box_background_color+'|'+customizer_align_style+'|'+customizer_margin+'|'+customizer_padding;

   	var setting_tag_background_color = jQuery('#setting_tag_background_color').val();
   	var next_button_settings_background_color = jQuery('#next_button_settings_background_color').val();
   	var nexttbtn_width_for_quiz = jQuery('#nexttbtn_width_for_quiz').val();
   	var nexttbtn_height_for_quiz = jQuery('#nexttbtn_height_for_quiz').val();
   	var next_btn_html = jQuery('.next-btn-settings .next_temp_container').html();

   	var skip_question_button_for_quiz = jQuery('#skip_question_button_for_quiz').val();
   	var skip_question_btn_width_for_quiz = jQuery('#skip_question_btn_width_for_quiz').val();
   	var skip_question_btn_height_for_quiz = jQuery('#skip_question_btn_height_for_quiz').val();
   	var skip_btn_html = jQuery('.skip_question_wrapper_for_quiz .skip_question_temp_container').html();
	
	var setting_category_background_color = jQuery('#setting_category_background_color').val();
	var setting_ans_ad_recommendation = jQuery('#setting_ans_ad_recommendation').val();
	var setting_question_ads_color = jQuery('#setting_question_ads_color').val();
	var setting_personalization_color = jQuery('#setting_personalization_color').val();
	var setting_analyzing_screen_color = jQuery('#setting_analyzing_screen_color').val();
	var setting_progress_color = jQuery('#setting_progress_color').val();
	var setting_progress_inactive_color = jQuery('#setting_progress_inactive_color').val();
	var charts_bar_background_color = jQuery('#charts_bar_background_color').val();
	var top_bar_background_color = jQuery('#top_bar_background_color').val();
   	var setting_tag_width_input = jQuery('.tag_width_input').val();
   	var setting_category_width_input = jQuery('.category_width_input').val();
   	var setting_question_width_input = jQuery('.question_width_input').val();
   	var setting_personalization_width_input = jQuery('.personalization_width_input').val();
   	var setting_analyzing_width_input = jQuery('.analyzing_width_input').val();




	var all_background_color = {'setting_tag_background_color': setting_tag_background_color, 'setting_category_background_color': setting_category_background_color, 'setting_ans_ad_recommendation': setting_ans_ad_recommendation, 'setting_question_ads_color': setting_question_ads_color, 'setting_personalization_color': setting_personalization_color, 'setting_analyzing_screen_color': setting_analyzing_screen_color, 'setting_progress_color': setting_progress_color, 'setting_progress_inactive_color': setting_progress_inactive_color, 'setting_tag_width_input': setting_tag_width_input, 'setting_category_width_input': setting_category_width_input, 'setting_question_width_input': setting_question_width_input, 'setting_personalization_width_input': setting_personalization_width_input, 'setting_analyzing_width_input': setting_analyzing_width_input, 'charts_bar_background_color': charts_bar_background_color, 'next_button_settings_background_color': next_button_settings_background_color, 'nexttbtn_width_for_quiz': nexttbtn_width_for_quiz, 'nexttbtn_height_for_quiz': nexttbtn_height_for_quiz, 'next_btn_html': next_btn_html, 'skip_question_button_for_quiz': skip_question_button_for_quiz,'skip_question_btn_width_for_quiz': skip_question_btn_width_for_quiz, 'skip_question_btn_height_for_quiz': skip_question_btn_height_for_quiz, 'skip_btn_html': skip_btn_html, 'top_bar_background_color':top_bar_background_color, 'placeholder_button_color': placeholder_button_color };

	var form_data = {
		quizid: quizid,
		next_button_html: next_button_html,
		back_button_html: back_button_html,
		download_certificate_button_html: download_certificate_button_html,
		category_customizer_values: category_customizer_values,
		retake_button_html: retake_button_html ,
		quiz_timer: quiz_timer ,
		show_firstname_outcome: show_firstname_outcome ,
		quiz_timer_limit: quiz_timer_limit ,
		progress_bar: progress_bar ,
		grade_quiz: grade_quiz ,
		quiz_passmark: quiz_passmark ,
		already_take_the_quiz: already_take_the_quiz ,
		quiz_attempts_allowed: quiz_attempts_allowed ,
		show_correct_ans: show_correct_ans ,
		questions_random: questions_random ,
		answers_random: answers_random ,
		move_question: move_question ,
		show_for_notloggedin_user: show_for_notloggedin_user ,
		total_attempts: total_attempts ,
		progressActive: progressActive ,
		progressInactive: progressInactive ,
		answer_text_color: answer_text_color ,
		answer_background: answer_background ,
		answer_background1: answer_background1 ,
		correct_answer_msg: correct_answer_msg ,
		incorrect_answer_msg: incorrect_answer_msg ,
		pick_ans_msg: pick_ans_msg ,
		sqb_question_cust: sqb_question_cust ,
		sqb_answer_cust: sqb_answer_cust ,
		sqb_incorrect_ans_exp: sqb_incorrect_ans_exp ,
		username_empty_msg: username_empty_msg ,
		required_field: required_field ,
		gdpr_required_field: gdpr_required_field ,
		outcome_screen_answer: outcome_screen_answer ,
		outcome_screen_result: outcome_screen_result ,
		outcome_screen_correct_answer: outcome_screen_correct_answer ,
		outcome_screen_incorrect_answer: outcome_screen_incorrect_answer ,
		email_empty_msg: email_empty_msg ,
		terms_condition_msg: terms_condition_msg ,
		show_first_name_screen: show_first_name_screen ,
		show_analyzing_result: show_analyzing_result ,
		show_analyzing_result_time: show_analyzing_result_time ,
		show_first_name_screen_temp: show_first_name_screen_temp ,
		show_analyzing_result_temp: show_analyzing_result_temp ,
		result_background_color: result_background_color ,
		result_background_color1: result_background_color1 ,
		fb_share_thank_you_msg: fb_share_thank_you_msg ,
		fb_share_error_msg: fb_share_error_msg ,
		valid_email: valid_email ,
		already_taken_quiz: already_taken_quiz ,
		not_passed_quiz_msg: not_passed_quiz_msg ,
		dap_see_details_btn_html: dap_see_details_btn_html,
		dap_see_details_btn_customizer: dap_see_details_btn_customizer,
		dap_questions_customizer: dap_questions_customizer,
		dap_answer_customizer: dap_answer_customizer,
		skip_question_btn_html: skip_question_btn_html,
		skip_question_customizer: skip_question_customizer,
		file_upload_btn_html: file_upload_btn_html,
		file_upload_customizer: file_upload_customizer,
		user_shortcode_not_login: user_shortcode_not_login,
		upload_button_text: upload_button_text,
		file_uploaded_message: file_uploaded_message,
		file_upload_failed_message: file_upload_failed_message,
		upload_filesize_limit_exceeds_message: upload_filesize_limit_exceeds_message,
		file_upload_validation: file_upload_validation,
		uploaded_filename_text: uploaded_filename_text,
		give_points: give_points,
		points: points,
		pass_criteria: pass_criteria,
		pass_percent: pass_percent,
		retake_pass_rule: retake_pass_rule,
		display_quiz_points_message:display_quiz_points_message,
		category_scoring_text1:category_scoring_text1,
		category_assessment_text1:category_assessment_text1,
		invalid_date_text:invalid_date_text,
		pdf_download_success:pdf_download_success,
		pdf_downloading_text:pdf_downloading_text,
		logged_in_admin_msg:logged_in_admin_msg,
		voting_closed:voting_closed,
		sqb_outcome:sqb_outcome,
		quiz_details:quiz_details,
		user_details:user_details,
		user_answer:user_answer,
		sqb_quiz_name:sqb_quiz_name,
		sqb_date:sqb_date,
		retake_count:retake_count,
		time_spent:time_spent,
		gdpr_terms:gdpr_terms,
		quiz_result:quiz_result,
		sqb_name:sqb_name,
		sqb_email:sqb_email,
		user_email:user_email,
		student_correct_answer:student_correct_answer,
		points_scored:points_scored,
		file_name:file_name,
		student_incorrect:student_incorrect,
		click_to_download:click_to_download,
		file_upload_successfully:file_upload_successfully,
		answer_no_longer:answer_no_longer,
		sqb_weight:sqb_weight,
		sqb_height:sqb_height,
		sqb_certificate:sqb_certificate,
		category_name_customize:category_name_customize,
		click_to_play:click_to_play,
		student_score:student_score,
		sqb_total_points:sqb_total_points,
		sqb_result:sqb_result,
		sqb_score:sqb_score,
		sqb_high:sqb_high,
		sqb_medium:sqb_medium,
		sqb_low:sqb_low,
		sqb_valid_phonenumber:sqb_valid_phonenumber,
		not_loggedin : not_loggedin,
		dont_want_listed : dont_want_listed,
		click_to_optout : click_to_optout,
		logged_in_optout : logged_in_optout,
		dont_want_listed_leaderboard : dont_want_listed_leaderboard,
		limit_exceeded : limit_exceeded,
		all_background_color:all_background_color,
		}

	jQuery.post(ajaxurl, {
			action: 'sqb_save_quiz_settings',
			form_data: form_data,   
	}, function(response) {		 
		SQBHideLoader();		
		response = JSON.parse(response);
		if(response == 'Y' && show_analyzing_result == 'N'){
			jQuery('<div class="analyzig-error-msg-outer"><div class="analyzig-error-msg">Sorry, analyzing screen cannot be turned off when auto-opt-in is enabled. </div></div>').insertAfter('.Restriction-Settings-content');
			jQuery("html, body").animate({ scrollTop: $(document).height() }, 1000);
			setTimeout(function(){
				jQuery('.analyzig-error-msg').remove();
			}, 5000);
			jQuery('#analyzing_result').prop('checked',true);
			jQuery('.show_analyzing_result_outer').show();
			jQuery("Quiz_setting_tab_1").append('<div class="analyzig-error-msg">Sorry, analyzing screen cannot be turned off when auto-opt-in is enabled.</div>');
		}
		if(quiz_type == 'calculator' && quiz_random_question == 'Y'){
		jQuery('.quiz-save-setting-error').show();
		setTimeout(function(){ 
			jQuery('.quiz-save-setting-error').hide();
		}, 5000);
	}
	  
	});
			
 	
}


function sqb_dap_customizer(){
	
	if(jQuery('.reports_tab_content_inner_sub_tab').hasClass('dap_enable_class')){
	}else{
		return false;
	}
	
	jQuery('#see_details_width').bootstrapSlider().change(function() {
		jQuery('.dap_see_details_btn ').css('width', +this.value + 'px');
	});
	
	jQuery('#see_details_height').bootstrapSlider().change(function() {
		jQuery(' .dap_see_details_btn').css('padding-top', +this.value + 'px');
		jQuery('.dap_see_details_btn').css('padding-bottom', +this.value + 'px');
	});
	
	jQuery('#see_details_backgroud_color_div, #see_details_backgroud_color').colorpicker().on('changeColor', function() {
		jQuery(' .dap_see_details_btn').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 
	
	
	// Question font
	jQuery('#dap_questions_font').bootstrapSlider().change(function() {
		
	});
	
	// Answer font
	jQuery('#dap_answer_font').bootstrapSlider().change(function() {
		
	});
	
	jQuery('#dap_answer_background_color_div, #dap_answer_background_color').colorpicker().on('changeColor', function() {
		
	}); 
	jQuery('#dap_answer_active_background_color_div, #dap_answer_active_background_color').colorpicker().on('changeColor', function() {
		
	}); 
	
	
	
}

function sqb_file_upload_button_customizer(){
	
	jQuery('#file_upload_btn_width').bootstrapSlider().change(function() {
		jQuery('.file_upload_button').css('width', +this.value + 'px');
	});
	 
	jQuery('#file_upload_btn_height').bootstrapSlider().change(function() {
		jQuery('.file_upload_button').css('padding-top', +this.value + 'px');
		jQuery('.file_upload_button').css('padding-bottom', +this.value + 'px');
	});
	
	jQuery('#file_upload_button_backgroud_color_div,#file_upload_button_backgroud_color').colorpicker().on('changeColor', function() {
		jQuery('.file_upload_button').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 
	
}

function sqb_skip_question_button_customizer(){
	
	jQuery('#skip_question_btn_width').bootstrapSlider().change(function() {
		jQuery('.skip_question_button').css('width', +this.value + 'px');
	});
	 
	jQuery('#skip_question_btn_height').bootstrapSlider().change(function() {
		jQuery('.skip_question_button').css('padding-top', +this.value + 'px');
		jQuery('.skip_question_button').css('padding-bottom', +this.value + 'px');
	});
	
	jQuery('#skip_question_button_backgroud_color_div,#skip_question_button_backgroud_color').colorpicker().on('changeColor', function() {
		jQuery('.skip_question_button').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 
	
}


function sqb_category_button_customizer(){
	
	jQuery('#customizer_border_width').bootstrapSlider().change(function() {
		jQuery('.CategoryCustomizer_result').css('border-width', +this.value + 'px');
	});

	jQuery('#customizer_temp_br_style').on('change',function() {
		jQuery('.CategoryCustomizer_result').css('border-style', this.value);
	}); 

 	jQuery('#category_customizer_background').colorpicker().on('changeColor', function() {
		jQuery('.CategoryCustomizer_result').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 
	jQuery('#category_customizer_border').colorpicker().on('changeColor', function() {
		jQuery('.CategoryCustomizer_result').css('border-color', jQuery(this).colorpicker('getValue'));
	}); 

	jQuery('#category_customizer_border_box_div').colorpicker().on('changeColor', function() {
		sqb_templates_BoxShadow_category();
	}); 

	jQuery('#customizer_margin').bootstrapSlider().change(function() {
		jQuery('.CategoryCustomizer_result').css('margin-bottom', +this.value + 'px');
	}); 

	jQuery('#customizer_padding').bootstrapSlider().change(function() {
		jQuery('.CategoryCustomizer_result').css('padding', +this.value + 'px');
	}); 

	jQuery('#customizer_align_style').on('change',function() {
		jQuery('.CategoryCustomizer_result').css('float', this.value);
	}); 

	jQuery('#customizer_spread_radius').bootstrapSlider().change(function() {
		sqb_templates_BoxShadow_category();
	});
	jQuery('#customizer_blur_radius').bootstrapSlider().change(function() {
		sqb_templates_BoxShadow_category();
	});
	jQuery('#customizer_horizontal_length').bootstrapSlider().change(function() {
		sqb_templates_BoxShadow_category();
	});
	jQuery('#customizer_vertical_length').bootstrapSlider().change(function() {
		sqb_templates_BoxShadow_category();
	});
	jQuery('#customizer_width').bootstrapSlider().change(function() {
		jQuery('.CategoryCustomizer_result').css('max-width', +this.value + 'px');
	});	
}

function sqb_templates_BoxShadow_category() {
	
	var hor_lnth = parseFloat(jQuery('#customizer_horizontal_length').val());
	var ver_lnth = parseFloat(jQuery('#customizer_vertical_length').val());
	var blur_radius = parseFloat(jQuery('#customizer_blur_radius').val());
	var sprd_radius = parseFloat(jQuery('#customizer_spread_radius').val());
	var shad_clr =  jQuery('#category_customizer_box_background_color').val();
	var temp_obj = jQuery('.CategoryCustomizer_result');
	
	hor_lnth = hor_lnth + 'px';
	ver_lnth = ver_lnth + 'px';
	blur_radius = blur_radius + 'px';
	sprd_radius = sprd_radius + 'px';
	var box_shadow = hor_lnth + ' ' + ver_lnth + ' ' + blur_radius + ' ' + sprd_radius + ' ' + shad_clr;
	temp_obj.css('-webkit-box-shadow', box_shadow);
	temp_obj.css('-moz-box-shadow', box_shadow);
	temp_obj.css('box-shadow', box_shadow);
}

function sqb_next_retake_button_customizer(){

	jQuery('#tag_width').bootstrapSlider().change(function() {
		jQuery('.sqb_next_btn').css('width', +this.value + 'px');
		jQuery('.tag_width_input').val(this.value);
	});

	jQuery('#category_width').bootstrapSlider().change(function() {
		jQuery('.sqb_next_btn').css('width', +this.value + 'px');
		jQuery('.category_width_input').val(this.value);
	});

	jQuery('#question_width').bootstrapSlider().change(function() {
		jQuery('.sqb_next_btn').css('width', +this.value + 'px');
		jQuery('.question_width_input').val(this.value);
	});

	jQuery('#personalization_width').bootstrapSlider().change(function() {
		jQuery('.sqb_next_btn').css('width', +this.value + 'px');
		jQuery('.personalization_width_input').val(this.value);
	});

	jQuery('#analyzing_width').bootstrapSlider().change(function() {
		jQuery('.sqb_next_btn').css('width', +this.value + 'px');
		jQuery('.analyzing_width_input').val(this.value);
	});

	/*=========================================*/
	jQuery('#nexttbtn_width_for_quiz').bootstrapSlider().change(function() {
		jQuery('.next-btn-settings .sqb_next_btn').css('width', +this.value + 'px');
	});
	 
	jQuery('#nexttbtn_height_for_quiz').bootstrapSlider().change(function() {
		jQuery('.next-btn-settings .sqb_next_btn').css('padding-top', +this.value + 'px');
		jQuery('.next-btn-settings .sqb_next_btn').css('padding-bottom', +this.value + 'px');
	});

	jQuery('#next_button_settings_background_color_div, #next_button_settings_background_color').colorpicker().on('changeColor', function() {
		jQuery('.next-btn-settings .sqb_next_btn').css('background-color', jQuery(this).colorpicker('getValue'));
	});

	jQuery('#skip_question_btn_width_for_quiz').bootstrapSlider().change(function() {
		jQuery('.skip_question_wrapper_for_quiz .skip_question_button').css('width', +this.value + 'px');
	});
	 
	jQuery('#skip_question_btn_height_for_quiz').bootstrapSlider().change(function() {
		jQuery('.skip_question_wrapper_for_quiz .skip_question_button').css('padding-top', +this.value + 'px');
		jQuery('.skip_question_wrapper_for_quiz .skip_question_button').css('padding-bottom', +this.value + 'px');
	});

	jQuery('#skip_question_button_for_quiz_div, #skip_question_button_for_quiz').colorpicker().on('changeColor', function() {
		jQuery('.skip_question_wrapper_for_quiz .skip_question_button').css('background-color', jQuery(this).colorpicker('getValue'));
	});

	/*=========================================*/

	jQuery('#nexttbtn_width').bootstrapSlider().change(function() {
		jQuery('.sqb_next_btn').css('width', +this.value + 'px');
	});
	 
	jQuery('#nexttbtn_height').bootstrapSlider().change(function() {
		jQuery(' .sqb_next_btn').css('padding-top', +this.value + 'px');
		jQuery('.sqb_next_btn').css('padding-bottom', +this.value + 'px');
	});
	jQuery('#backbtn_width').bootstrapSlider().change(function() {
		jQuery('.sqb_back_btn').css('width', +this.value + 'px');
	});

	jQuery('#download_certificate_btn_width').bootstrapSlider().change(function() {
		jQuery('.sqb_download_certificate_btn').css('width', +this.value + 'px');
	});
	 
	jQuery('#backbtn_height').bootstrapSlider().change(function() {
		jQuery(' .sqb_back_btn').css('padding-top', +this.value + 'px');
		jQuery('.sqb_back_btn').css('padding-bottom', +this.value + 'px');
	});

	jQuery('#download_certificate_btn_height').bootstrapSlider().change(function() {
		jQuery('.sqb_download_certificate_btn').css('padding-top', +this.value + 'px');
		jQuery('.sqb_download_certificate_btn').css('padding-bottom', +this.value + 'px');
	});
	jQuery('#backbutton_backgroud_color_div, #backbutton_backgroud_color').colorpicker().on('changeColor', function() {
		jQuery(' .sqb_back_btn').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 

	jQuery('#download_certificate_backgroud_color_div, #download_certificate_backgroud_color').colorpicker().on('changeColor', function() {
		jQuery('.sqb_download_certificate_btn').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 

	var back_width = jQuery('.back_temp_container').find('.single_back_btn').css('width');
	var back_width = parseInt(back_width, 10);

	var download_certificate_width = jQuery('.download_certificate_temp_container').find('.sqb_download_certificate_btn').css('width');
	var download_certificate_width = parseInt(download_certificate_width, 10);
	
	var back_height = jQuery('.back_temp_container').find('.single_back_btn').css('padding-top');
	var back_height = parseInt(back_height, 10);

	var download_certificate_height = jQuery('.download_certificate_temp_container').find('.sqb_download_certificate_btn').css('padding-top');
	var download_certificate_height = parseInt(download_certificate_height, 10);
	
	var back_background = jQuery('.back_temp_container').find('.single_back_btn').css('background');
	var download_certificate_background = jQuery('.download_certificate_temp_container').find('.sqb_download_certificate_btn').css('background');

	jQuery('#backbtn_height').bootstrapSlider('setValue', back_height);
	jQuery('#download_certificate_btn_height').bootstrapSlider('setValue', download_certificate_height);

	jQuery('#backbtn_width').bootstrapSlider('setValue', back_width);
	jQuery('#sqb_download_certificate_btn').bootstrapSlider('setValue', download_certificate_width);
	jQuery('#backbutton_backgroud_color_div, #backbutton_backgroud_color').colorpicker('setValue', back_background);
	jQuery('#download_certificate_backgroud_color_div, #download_certificate_backgroud_color').colorpicker('setValue', download_certificate_background);
	
	jQuery('#firstpage_width').bootstrapSlider();
	jQuery('#lastpage_width').bootstrapSlider();

	jQuery('#quiz_firstpage_width').bootstrapSlider();
	jQuery('#quiz_lastpage_width').bootstrapSlider();
	
	jQuery('#nextbutton_backgroud_color_div').colorpicker().on('changeColor', function() {
		jQuery(' .sqb_next_btn').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 
	jQuery('#retakebtn_width').bootstrapSlider().change(function() {
		jQuery('.retake_button').css('width', +this.value + 'px');
	});
	 
	jQuery('#retakebtn_height').bootstrapSlider().change(function() {
		jQuery('.retake_button').css('padding-top', +this.value + 'px');
		jQuery('.retake_button').css('padding-bottom', +this.value + 'px');
	});
	
	jQuery('#retakebutton_backgroud_color_div').colorpicker().on('changeColor', function() {
		jQuery('.retake_button').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 
	
	jQuery('#progressactive_backgroud_color_div').colorpicker().on('changeColor', function() {
		jQuery('.progress-bar').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 
	jQuery('#progressinactive_backgroud_color_div').colorpicker().on('changeColor', function() {
		jQuery('.progress').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 

	jQuery('#answer_background_color_div').colorpicker().on('changeColor', function() {
		jQuery('.sql_ans_text_settings span').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 

	jQuery('#answer_text_color_div').colorpicker().on('changeColor', function() {
		jQuery('.sql_ans_text_settings span').css('color', jQuery(this).colorpicker('getValue'));
	}); 

	jQuery('#answer_background_color_div1').colorpicker().on('changeColor', function() {
		jQuery('.sql_ans_text_settings span').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 

	jQuery('#result_background_color_div').colorpicker().on('changeColor', function() {
		//jQuery('.sql_ans_text_settings span').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 

	jQuery('#result_background_color_div1').colorpicker().on('changeColor', function() {
		//jQuery('.sql_ans_text_settings span').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 

	
}

function sqb_save_quiz_setting1(){ 	
	SQBShowLoader();
	var next_button_html = jQuery('.next_temp_container ').html();
	var back_button_html = jQuery('.back_temp_container ').html();
	var download_certificate_button_html = jQuery('.download_certificate_temp_container ').html();
	var retake_button_html = jQuery('.retake_temp_container ').html();
	var quizid = jQuery('.quizList li.activeli').attr("data-value");
	if(jQuery('.quizList li.activeli').length < 1){
		quizid = 0;
	}
	 
	var quiz_timer  = jQuery('input[name="quiz_timer"]').prop('checked');
	if(quiz_timer){
		quiz_timer = 'Y';
	}else{
		quiz_timer = 'N';
	}
 
	var quiz_timer_limit =jQuery('input[name="quiz_timer_limit"]').val();
	 
	var progress_bar  = jQuery('input[name="progress_bar"]').prop('checked');
	if(progress_bar){
		progress_bar = 'Y';
	}else{
		progress_bar = 'N';
	}
	
	
	var grade_quiz = jQuery('input[name="grade_quiz"]').val();
	var quiz_passmark = jQuery('input[name="quiz_passmark"]').val();
	var total_attempts = jQuery('input[name="total_attempts"]').val();
	var quiz_attempts_allowed = jQuery('.quiz_attempts_allowed option:selected').val();
	var already_take_the_quiz = jQuery('.already_take_the_quiz option:selected').val();
 
	var show_correct_ans  = jQuery('input[name="show_correct_ans"]').prop('checked');
	if(show_correct_ans){
		show_correct_ans = 'Y';
	}else{
		show_correct_ans = 'N';
	}
	var questions_random  = jQuery('input[name="questions_random"]').prop('checked');
	if(questions_random){
		questions_random = 'Y';
	}else{
		questions_random = 'N';
	}
	var answers_random  = jQuery('input[name="answers_random"]').prop('checked');
	if(answers_random){
		answers_random = 'Y';
	}else{
		answers_random = 'N';
	}

	var move_question  = jQuery('input[name="move_question"]').prop('checked');
	if(move_question){
		move_question = 'Y';
	}else{
		move_question = 'N';
	}
	var show_for_notloggedin_user  = jQuery('input[name="show_for_notloggedin_user"]').prop('checked');
	if(show_for_notloggedin_user){
		show_for_notloggedin_user = 'Y';
	}else{
		show_for_notloggedin_user = 'N';
	}
	
	var progressActive = jQuery('#progressactive_backgroud_color').val();
	var progressInactive = jQuery('#progressinactive_backgroud_color').val();
	var answer_background = jQuery('#answer_background_color').val();
	var answer_background1 = jQuery('#answer_background_color1').val();
	var answer_text_color = jQuery('#answer_text_color').val();
	var correct_answer_msg = jQuery('#correct_answer_msg').val();
	var incorrect_answer_msg = jQuery('#incorrect_answer_msg').val();
	var username_empty_msg = jQuery('#username_empty_msg').val();
	var required_field = jQuery('#required_field').val();
	var gdpr_required_field = jQuery('#gdpr_required_field').val();
	var outcome_screen_answer = jQuery('#outcome_screen_answer').val();
	var outcome_screen_result = jQuery('#outcome_screen_result').val();
	var outcome_screen_correct_answer = jQuery('#outcome_screen_correct_answer').val();
	var outcome_screen_incorrect_answer = jQuery('#outcome_screen_incorrect_answer').val();
	var email_empty_msg = jQuery('#email_empty_msg').val();
	var terms_condition_msg = jQuery('#terms_condition_msg').val();
	var show_first_name_screen = jQuery('#show_first_name_screen').prop('checked');
	var show_analyzing_result = jQuery('#analyzing_result').prop('checked');
	var show_analyzing_result_time = jQuery('.analyzing-result-time-delay').val();
	var show_first_name_screen_temp = jQuery('.show_first_name_screen_temp_outer').find('.quiz_comon_template').html();
	var show_analyzing_result_temp = jQuery('.show_analyzing_result_outer').find('.quiz_comon_template').html();
	
	if(show_first_name_screen){
		show_first_name_screen = 'Y';
	}else{
		show_first_name_screen = 'N';
	}

	if(show_analyzing_result){
		show_analyzing_result = 'Y';
	}else{
		show_analyzing_result = 'N';
	}
	var result_background_color = jQuery('#result_background_color').val();
	var result_background_color1 = jQuery('#result_background_color1').val();
	var fb_share_thank_you_msg = jQuery('#fb_share_thank_you_msg').val();
	var valid_email = jQuery('#valid_email').val();
	var already_taken_quiz = jQuery('#already_taken_quiz').val();
	var not_passed_quiz_msg = jQuery('#not_passed_quiz_msg').val();
	
	
	
	var form_data = {
		quizid: quizid,
		next_button_html: next_button_html,
		back_button_html: back_button_html,
		download_certificate_button_html: download_certificate_button_html,
		retake_button_html: retake_button_html ,
		quiz_timer: quiz_timer ,
		quiz_timer_limit: quiz_timer_limit ,
		progress_bar: progress_bar ,
		grade_quiz: grade_quiz ,
		quiz_passmark: quiz_passmark ,
		already_take_the_quiz: already_take_the_quiz ,
		quiz_attempts_allowed: quiz_attempts_allowed ,
		show_correct_ans: show_correct_ans ,
		questions_random: questions_random ,
		answers_random: answers_random ,
		move_question: move_question ,
		show_for_notloggedin_user: show_for_notloggedin_user ,
		total_attempts: total_attempts ,
		progressActive: progressActive ,
		progressInactive: progressInactive ,
		answer_text_color: answer_text_color ,
		answer_background: answer_background ,
		answer_background1: answer_background1 ,
		correct_answer_msg: correct_answer_msg ,
		incorrect_answer_msg: incorrect_answer_msg ,
		username_empty_msg: username_empty_msg ,
		required_field: required_field ,
		gdpr_required_field: gdpr_required_field ,
		outcome_screen_answer: outcome_screen_answer ,
		outcome_screen_result: outcome_screen_result ,
		outcome_screen_correct_answer: outcome_screen_correct_answer ,
		outcome_screen_incorrect_answer: outcome_screen_incorrect_answer ,
		email_empty_msg: email_empty_msg ,
		terms_condition_msg: terms_condition_msg ,
		show_first_name_screen: show_first_name_screen ,
		show_analyzing_result: show_analyzing_result ,
		show_analyzing_result_time: show_analyzing_result_time ,
		show_first_name_screen_temp: show_first_name_screen_temp ,
		show_analyzing_result_temp: show_analyzing_result_temp ,
		result_background_color: result_background_color ,
		result_background_color1: result_background_color1 ,
		fb_share_thank_you_msg: fb_share_thank_you_msg,
		valid_email: valid_email,
		already_taken_quiz: already_taken_quiz,
		not_passed_quiz_msg: not_passed_quiz_msg,
		}
	jQuery.post(ajaxurl, {
			action: 'sqb_save_quiz_settings',
			form_data: form_data,   
	}, function(response) {		 
		SQBHideLoader();			  
	});
			
 	
}

function sqb_save_quiz_notification(quiz_type=''){
	var notification_from_name = '';
	if(quiz_type != ''){
		notification_type = 'student_email';
		var notification_send_email = 'N';
		var notification_send_email_check = jQuery('#'+quiz_type+'_send_email').prop('checked');
		var notification_from_email = jQuery('#'+quiz_type+'_from_email').val();
		var notification_email_subject = jQuery('#'+quiz_type+'_email_subject').val();
		var notification_email_body = tinymce.get(quiz_type+'_email_body').getContent();
		var notification_answer_format = tinymce.get(quiz_type+'_answer_format').getContent();
		notification_from_name = jQuery('#'+quiz_type+'_from_name').val();
		var quiz_settings = 'global';

	}else{
		var notification_send_email = 'N';
		var notification_send_email_check = jQuery('#notification_send_email').prop('checked');
		var notification_from_email = jQuery('#notification_from_email').val();
		var notification_email_subject = jQuery('#notification_email_subject').val();
		var notification_email_body = tinymce.get('notification_email_body').getContent();
		var notification_type = 'admin_email';
		var notification_answer_format = '';
		 notification_from_name = jQuery('#notification_from_name').val();
		 var quiz_settings = 'global';
	}

	if(notification_send_email_check == true){
		notification_send_email = 'Y';

		if(notification_from_email == ''){
			swal('Please enter the "From Email"');
			return false;
		}

		if(notification_email_subject == ''){
			swal('Please enter email Subject');
			return false;
		}

		if(notification_email_body == ''){
			swal('Please enter email Body');
			return false;
		}
	}

	var form_data = {
		notification_from_email: notification_from_email,
		notification_email_subject: notification_email_subject,
		notification_email_body: notification_email_body ,
		notification_type: notification_type ,
		notification_send_email: notification_send_email ,
		notification_answer_format: notification_answer_format ,
		quiz_type: quiz_type ,
		notification_from_name: notification_from_name ,
		quiz_settings:quiz_settings,
	}	
	SQBShowLoader();		
	jQuery.post(ajaxurl, {
			action: 'sqb_save_quiz_notification',
			form_data: form_data,   
	}, function(response) {		 
		SQBHideLoader();			  
	});
}



function sqb_hide_global_notification(){
	jQuery('.sqb-email-notification-selection').show('slow');
	jQuery('#global-settings-outer').hide('slow');
	jQuery('#different-settings-outer').hide('slow');
}


function sqb_notification_text_tiny_mce_editor() {

	var gdpr_value = jQuery('#gdpr_compliance').val();
    var is_googlefont = jQuery('#is_googlefont').val();
    if(gdpr_value == 0 && is_googlefont == 1){
    var font_load = "@import url('https://fonts.googleapis.com/css?family=Open+Sans');@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');@import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');@import url('https://fonts.googleapis.com/css2?family=Raleway&display=swap');@import url('https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap');@import ur('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');";
    }else{
        var font_load = '';
    }
	tinymce.init({
         mode : "specific_textareas",
            editor_selector : "sqb_text_editor",
            resize: "both",
            /*plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste , textcolor"
            ],*/
            fontsize_formats: '8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 20pt 24pt 30pt 36pt',
            font_formats: "Andale Mono=andale mono,times;" + "Arial=arial,helvetica,sans-serif;" + "Arial Black=arial black,avant garde;" + "Book Antiqua=book antiqua,palatino;" + "Comic Sans MS=comic sans ms,sans-serif;" + "Courier New=courier new,courier;" + "Georgia=georgia,palatino;" + "Helvetica=helvetica;" + "Impact=impact,chicago;" + "Montserrat=Montserrat,sans-serif;Open Sans=open sans,sans-serif;Poppins=Poppins,sans-serif;Lato=Lato,sans-serif;Nunito=Nunito,sans-serif;Noto Serif=Noto Serif,sans-serif;Noto Sans=Noto Sans,sans-serif;Raleway=Raleway,sans-serif;" + "Symbol=symbol;" + "Tahoma=tahoma,arial,helvetica,sans-serif;" + "Terminal=terminal,monaco;" + "Times New Roman=times new roman,times;" + "Trebuchet MS=trebuchet ms,geneva;" + "Verdana=verdana,geneva;" + "Webdings=webdings;" + "Wingdings=wingdings,zapf dingbats",
        content_style:font_load,    
			//toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		   // toolbar2: 'print preview media | forecolor backcolor emoticons ',
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



function sqbDeleteCountryGDPR(countryID, name){
	swal({
	 	title: "Are you sure?",
        text: "Do you want to delete this country?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!",
        showCancelButton: true,
		animation: "slide-from-top",
	}).then(function(isConfirm){
		if (isConfirm.value) {
			jQuery.post(ajaxurl, {
				action: 'SQBDeleteCountryGdpr',
				id: countryID,

			}, function (response) {					
				swal("Deleted!", "Your country has been deleted.", "success");
				var url = window.location.href;
				location.href = url+'&tab=sqb_gdpr';
				//window.location.reload();
			});
		} 
	});
}


function addNewCountryGDPR(){
	var country_name  = jQuery("#country_name").val();
	var country_code  = jQuery("#country_code").val();
	var country_name_validate1 = country_name.trim();
	var country_code_validate1 = country_code.trim();
	
	if(country_name_validate1=="" || country_name_validate1==null){
		swal('Enter Country Name.');
	}else if(country_code_validate1=="" || country_code_validate1==null){
		swal('Enter Country Code.');
	}else{
		var data = jQuery("#add_country_form_gdpr").serialize();
		jQuery.post(ajaxurl, {
			action: 'sqb_add_country_gdpr',
			postdata: data,
		}, function (response) {
			if(response=='"sqb-gdpr-error"'){
				swal(
					'Error!',
					'This country name and code combination already exists. \n\n',
					'error'
				);
			}else{
				swal({
					title: "Success!",
					text:  "Your country is added. \n\n",
					type: "success",
					timer: 2000,
					showConfirmButton: false
				});
				window.setTimeout(function(){ 
					var url = window.location.href;
						location.href = url+'&tab=sqb_gdpr';
					//location.reload(true);
				} ,2000);		
			}		
		});
			
	}
}


function sqb_save_quiz_category(){
	var parent = jQuery('#quiz_category_add_model');
	var cat_name = parent.find('#quiz_cat_name_val').val();
	var cat_desc = tinymce.get('quiz_cat_desc_val').getContent();
	//var cat_desc = parent.find('#quiz_cat_desc_val').val();
	var cat_id = parent.find('#quiz_cat_id').val();
	parent.find('.quiz_cat_required').hide();
	
	if(cat_name == ''){
		parent.find('.quiz_cat_name_val_wrapper').find('.quiz_cat_required').show();
		return false;
	}
	/*if(cat_desc == ''){
		parent.find('.quiz_cat_desc_val_wrapper').find('.quiz_cat_required').show();
		return false;
	}*/
	
	SQBShowLoader();
	jQuery.post(ajaxurl, {
			action: 'sqb_save_quiz_category',
			cat_name: cat_name,
			cat_desc: cat_desc,
			cat_id: cat_id,
	}, function(response){
			response = JSON.parse(response);
			if(response.data){
					if(response.data.html){
						jQuery('#Quiz_setting_tab_2').html(response.data.html);
						sqb_quiz_category_datatable_call();
					}
			}
			SQBHideLoader();  
			parent.find('.close').trigger('click'); 
			parent.find('#quiz_cat_name_val').val('');
	        parent.find('#quiz_cat_desc_val').val('');
	        parent.find('#quiz_cat_id').val('');
			
	});
	
	
}



function sqb_quiz_category_tab_events(){
	sqb_quiz_category_datatable_call();
}

function sqb_quiz_category_datatable_call(){
	if(jQuery('#sqb_quiz_category_table').length != 0){
		jQuery('#sqb_quiz_category_table').DataTable({
			pageLength : 10,
			language: {
				search: "",
				searchPlaceholder: "Search..."
			},
			"fnInitComplete": function() {
				jQuery('#sqb_quiz_category_table').show();
			}
		});
	}
}

function sqb_edit_quiz_categroy(cat_id = 0){
	var parent = jQuery('#quiz_category_add_model');
	SQBShowLoader();
	jQuery.post(ajaxurl, {
			action: 'sqb_load_quiz_category_info',
			cat_id: cat_id,
			
	}, function(response){
			response = JSON.parse(response);
		
			SQBHideLoader();  
			if(response.success){
				parent.modal('show');
				parent.find('#quiz_cat_name_val').val(response.name);
				tinymce.get("quiz_cat_desc_val").setContent(response.description);
				//parent.find('#quiz_cat_desc_val').val(response.description);
				parent.find('#quiz_cat_id').val(response.id);
			}
			
	});
}

function sqb_quiz_cateogry_delete(cat_id = 0){
	var delete_status = jQuery('#sqb_quiz_category_table').find('.cat_tr_'+cat_id).find('.item-delete-btn').attr('delete-status');
	if(delete_status != 'Y'){
		swal('','This category is connected with some quizzes','error');
		return false;
		
	}
	
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
							action: 'sqb_quiz_category_delete',
							cat_id: cat_id,
							
					}, function(response){
							response = JSON.parse(response);
						
							SQBHideLoader();  
							if(response.success){
								if(response.data){
										if(response.data.html){
											jQuery('#Quiz_setting_tab_2').html(response.data.html);
											sqb_quiz_category_datatable_call();
										}
								}
							}
						});
				}
			});
		
}

function quiz_change_text(tab_name='',heading_text){	
	if( tab_name=='advanced'){ 
		jQuery('#settings_advance_tab .quiz_settings_head').html('<i class="fa fa-cog" aria-hidden="true"></i> '+heading_text);
	} else if( tab_name=='external_int'){ 
		
		if(heading_text =="Quick Email Verification"){
			jQuery('#settings_external_integration_tab  .quiz_settings_head').hide();
			jQuery('#settings_external_integration_tab  .quiz_settings_head1').show();
		}else{
			jQuery('#settings_external_integration_tab .quiz_settings_head').show();
			jQuery('#settings_external_integration_tab  .quiz_settings_head1').hide();
		}
	}
	var tab_id =jQuery(this).attr('href');			 
	//jQuery('#reports-tab-content .tab-content .tab-pane').removeClass('active show');
	//jQuery('#reports-tab-content .tab-content '+tab_id).addClass('active show');
	 
}

function sqb_reset_custom_fields(){
	jQuery('#custom_field_id').val('');
	jQuery('#keyname').val('');
	jQuery('#description').val('');
	jQuery('#keylabel').val('');
	jQuery('#field_value').val('');
	jQuery('#field_type').val('input').change();
	jQuery('#showonlytoadmin').val('N').change();
	jQuery('#required').val('N').change();
	jQuery('#dropdown_value').val('N').change();
	jQuery('#keyname').prop('disabled', false);
	jQuery('#keyname').removeClass('not-allowed');
}

function sqb_reset_tags_fields(){
	jQuery('#tag_field_id').val('');
	jQuery('#tagname').val('');
	jQuery('.tags_content_temp_outer').html('<div class="tags_content_temp" style="text-align: center;"><div class="analyzing_result_content"><div class="tags_content_heading sqb_tiny_mce_editor"><div>Heading goes here</div></div><div class="tags_content_desc sqb_tiny_mce_editor">Please enter tag description here</div></div></div>');
	sqb_tiny_mce_editor();
}


function sqb_bind_custom_fields_values(el){
	var custom_field_id = el.attr('data-id');
	var custom_field_name = el.attr('data-name');
	var custom_field_desc = el.attr('data-desc');
	var custom_field_label = el.attr('data-label');
	var custom_field_field_type = el.attr('data-field-type');
	var custom_field_field_value = el.attr('data-field-value');
	var custom_field_showonlytoadmin = el.attr('data-showonlytoadmin');
	var custom_field_required = el.attr('data-required');
	var custom_selected_country = el.attr('data-selected-country');
	

	jQuery('#custom_field_id').val(custom_field_id);
	jQuery('#keyname').val(custom_field_name);
	jQuery('#description').val(custom_field_desc);
	jQuery('#keylabel').val(custom_field_label);
	jQuery("#field_type").val(custom_field_field_type).change();
	jQuery('#field_value').val(custom_field_field_value);
	if(custom_field_field_type == 'dropdown'){
		jQuery('#dropdown_value').val(custom_selected_country);
	}else{
		jQuery('#cf_selected_country').val(custom_selected_country);
	}
	jQuery('#showonlytoadmin').val(custom_field_showonlytoadmin).change();
	jQuery('#required').val(custom_field_required).change();
	if(custom_field_field_type == "phone_number"){
		jQuery('.select-country-outer').show();
		jQuery('.sqb-dropdown-field-outer').hide();
		initializeIntlTelInput(custom_selected_country);
	}else if(custom_field_field_type == 'dropdown'){
		jQuery('.sqb-dropdown-field-outer').show();
		jQuery('.select-country-outer').hide();
	}else{
		jQuery('.sqb-dropdown-field-outer').hide();
		jQuery('.select-country-outer').hide();
	}
}

function initializeIntlTelInput(custom_selected_country) {
	jQuery('.cf-select-country-outer').html('<input name="select_country" class="cf-select-country">');

  var phoneInputID = ".cf-select-country";
  var input = document.querySelector(phoneInputID);

  // Check if intlTelInput instance exists
  if (input.intlTelInput) {
    input.intlTelInput.destroy();
  }

  var iti = window.intlTelInput(input, {
    formatOnDisplay: true,
    hiddenInput: "full_number",
    preferredCountries: [custom_selected_country],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js",
  });

  jQuery(phoneInputID).on("countrychange", function (event) {
    var selectedCountryData = iti.getSelectedCountryData();
    newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL);
    iti.setNumber("");

    // Update the mask variable with the new format
    mask = newPlaceholder.replace(/[1-9]/g, "0");
    // Destroy the jQuery mask (if applied) and reapply with the new mask
    jQuery(this).unmask().mask(mask);
  });

  iti.promise.then(function () {
    jQuery(phoneInputID).trigger("countrychange");
  });
}

function sqb_bind_tags_content_values(el){
	var tag_id = el.attr('data-id');
	var tag_name = el.attr('data-name');
	var tag_content = el.attr('data-content');
	SQBShowLoader();
	jQuery.post(ajaxurl, {
			action: 'SQBGetTagsContentAjax',
			tag_id: tag_id,     
		}, function(response) {	
			response = JSON.parse(response);
			jQuery('#tag_field_id').val(tag_id);
			jQuery('#tagname').val(tag_name);
			if(response.tags_content_html != ''){
				jQuery('.tags_content_temp_outer').html(response.tags_content_html);
			} else {
				var tags_content_html = '<div class="tags_content_temp" style="text-align: center;"><div class="analyzing_result_content"><div class="tags_content_heading sqb_tiny_mce_editor"><div>Heading goes here</div></div><div class="tags_content_desc sqb_tiny_mce_editor">Please enter tag description here</div></div></div>';
				jQuery('.tags_content_temp_outer').html(tags_content_html);
			}
			jQuery('.tags_content_temp_outer').find( "[id^='mce_']" ).each(function(){
				jQuery(this).removeAttr('id');
			});
			sqb_tiny_mce_editor();
			SQBHideLoader();
		});	
}

function sqb_save_quiz_custom_fields(){
	
	jQuery(document).on('click','.sqb_save_custom_fields',function(){
		var keyname = jQuery('#keyname').val();
		var keylabel = jQuery('#keylabel').val();
		var description = jQuery('#description').val();
		var field_type = jQuery('#field_type').val();
		var field_value = jQuery('#field_value').val();
		var showonlytoadmin = jQuery('#showonlytoadmin').val();
		var required = jQuery('#required').val();
		var custom_field_id = jQuery('#custom_field_id').val();
		var cf_selected_country = jQuery('#cf_selected_country').val();
		var dropdown_value = jQuery('#dropdown_value').val();
		if(keyname == ''){
			swal("","Sorry, name is a required field","");
			return false;
		}
		
		jQuery('input[name="keyname_valid"]').attr('id',keyname);
		
		
		try {
			var keyname_valid = jQuery('input[name="keyname_valid"]#'+keyname).length;
			if(keyname_valid == 0){
				swal("","<style>.swal2-popup #swal2-content{width:100%}.swal2-content div strong{float:none;}.swal2-popup {font-family: 'DM Sans',sans-serif;color: #333;font-size: 14px;line-height: 1.4;font-weight: normal;}.swal2-popup strong {font-weight: 600;}</style><strong>Sorry, these characters are not allowed:</strong></br>spaces, slash, any special characters",""); 
				return false;
			}
			
		}
		catch(err) {
			swal("","<style>.swal2-popup #swal2-content{width:100%}.swal2-content div strong{float:none;}.swal2-popup {font-family: 'DM Sans',sans-serif;color: #333;font-size: 14px;line-height: 1.4;font-weight: normal;}.swal2-popup strong {font-weight: 600;}</style><strong>Sorry, these characters are not allowed:</strong></br>spaces, slash, any special characters",""); 
			return false;
		}
        
        jQuery('input[name="keyname_valid"]').removeAttr('id');
		
		if(keylabel == ''){
			swal("","Sorry, label is a required field","");
			return false;	
		}
		SQBShowLoader();  
		jQuery.post(ajaxurl, {
			action: 'sqb_save_custom_fields',
			keyname: keyname,
			keylabel: keylabel,
			description: description,
			field_type: field_type,
			field_value: field_value,
			showonlytoadmin: showonlytoadmin,
			required: required,
			custom_field_id: custom_field_id,
			cf_selected_country: cf_selected_country,
			dropdown_value: dropdown_value,
		},function(response) {
			response = JSON.parse(response);	
			SQBHideLoader();  

			if(response.custom_field_already_exist){
				swal('','Field Name already exist','');
				return false;
			}
			
			if(response.custom_field_dropdown){
				jQuery('.Quiz-customfields-list').html(response.custom_field_dropdown);
			}
			if(response.custom_field_list_table){
				jQuery('.custom_fields_table').html(response.custom_field_list_table);
			}
			sqb_reset_custom_fields();
			jQuery('#Quiz_setting_tab_4 .custom_fields_msg.sucess_message').show();
			setTimeout(function(){ 
				jQuery('#Quiz_setting_tab_4 .custom_fields_msg.sucess_message').hide('slow');
			}, 1000);
			jQuery('#keyname').prop('disabled', false);
			jQuery('#keyname').removeClass('not-allowed');

		}); 
	});
	
	jQuery(document).on('click','.sqb_custom_fields_section',function(){
		jQuery.post(ajaxurl, {
			action: 'sqb_customfields_list_table',
		},function(response) {
			response = JSON.parse(response);
			if(response.custom_field_list_table){
				jQuery('.custom_fields_table').html(response.custom_field_list_table);
			}	
		});
	});
	
	jQuery(document).on('click','.sqb-delete-customfield',function(){
		swal({
			text: "Are you sure you want to delete this field? If you have added this field in any opt-in forms, it will not show up in the frontend anymore.",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#a71a1a",
			confirmButtonText: "Yes",
			customClass: '',
		}).then((result) => {
			if (result.value) {
				var custom_field_id = jQuery(this).attr('data-id');
				jQuery.post(ajaxurl, {
					action: 'sqb_delete_custom_field',
					custom_field_id: custom_field_id,
				},function(response) {
					response = JSON.parse(response);
					if(response.custom_field_list_table){
						jQuery('.custom_fields_table').html(response.custom_field_list_table);
					}
					if(response.custom_field_dropdown){
					jQuery('.Quiz-customfields-list').html(response.custom_field_dropdown);
					}
				});
			}
		});
	});
	
	jQuery(document).on('click','ul.Quiz-customfields-list li.sqb_custom_field_list_item',function(){
		jQuery('ul.Quiz-customfields-list li.sqb_custom_field_list_item a').removeClass('active');
		jQuery('ul.Quiz-customfields-list li.sqb_custom_field_list_item').removeClass('activeli');
		jQuery(this).find('a.nav-link').addClass('active');
		jQuery(this).addClass('activeli');
		var el = jQuery(this);
		jQuery('#keyname').prop('disabled', true);
		jQuery('#keyname').addClass('not-allowed');
		sqb_bind_custom_fields_values(el);
	});
	
	jQuery(document).on('click','span.add-custom-field, span.addCustomFieldsLink',function(){
		jQuery('ul.Quiz-customfields-list li.sqb_custom_field_list_item a').removeClass('active');
		jQuery('ul.Quiz-customfields-list li.sqb_custom_field_list_item').removeClass('activeli');
		sqb_reset_custom_fields();
	});

	jQuery(document).on('click','span.add-tag-content',function(){
		jQuery('ul.quizTagList li.sqb_tag_item a').removeClass('active');
		jQuery('ul.quizTagList li.sqb_tag_item').removeClass('activeli');
		jQuery('#Quiz_setting_tab_5 .delete-tag-content').hide();
		sqb_reset_tags_fields();
	});
	
	jQuery(document).on('click','ul.quizTagList li.sqb_tag_item',function(){
		jQuery('ul.quizTagList li.sqb_tag_item a').removeClass('active');
		jQuery('ul.quizTagList li.sqb_tag_item').removeClass('activeli');
		jQuery(this).find('a.nav-link').addClass('active');
		jQuery(this).addClass('activeli');
		jQuery('#Quiz_setting_tab_5 .delete-tag-content').show();
		var el = jQuery(this); 
		sqb_bind_tags_content_values(el);
	});
	
	jQuery(document).on('click','ul.Quiz-customfields-list li.sqb_custom_field_list_item',function(){
		jQuery('ul.Quiz-customfields-list li.sqb_custom_field_list_item a').removeClass('active');
		jQuery('ul.Quiz-customfields-list li.sqb_custom_field_list_item').removeClass('activeli');
		jQuery(this).find('a.nav-link').addClass('active');
		jQuery(this).addClass('activeli');
		var el = jQuery(this); 
		sqb_bind_custom_fields_values(el);
	});
	
	jQuery(document).on('click','.custom_fields_table .sqb-edit-customfield',function(){
		jQuery('ul.Quiz-customfields-list li.sqb_custom_field_list_item a').removeClass('active');
		jQuery('ul.Quiz-customfields-list li.sqb_custom_field_list_item').removeClass('activeli');
		var el = jQuery(this);
		sqb_bind_custom_fields_values(el);
		var custom_field_id = el.attr('data-id');
		jQuery('ul.Quiz-customfields-list').find('li[data-id="'+custom_field_id+'"]').addClass('activeli');
		jQuery('ul.Quiz-customfields-list').find('li[data-id="'+custom_field_id+'"]').find('a.nav-link').addClass('active');
	});

}
sqb_save_quiz_custom_fields();


jQuery(document).on('click','.sqb_tags_content_section',function(){
		jQuery.post(ajaxurl, {
			//action: 'sqb_customfields_list_table',
			action: 'sqb_tags_content_list_table',
		},function(response) {
			response = JSON.parse(response);
			if(response.tags_content_list_table){
				jQuery('.tag_content_table').html(response.tags_content_list_table);
			}	
		});
});

jQuery(document).on('click','.sqb_save_tag_content',function(){
		var tagname = jQuery('#tagname').val();
		//var sqb_tag_contents = tinymce.get('sqb_tag_contents').getContent();
		var sqb_tag_contents = jQuery('.tags_content_temp_outer').html();
		var tag_field_id = jQuery('#tag_field_id').val();
		if(tagname == ''){
			swal("","Sorry, name is a required field","");
			return false;
		}
		
		var regex = /[^a-zA-Z0-9 ]/g;
 
		//Validate TextBox value against the Regex.
		var isValid = regex.test(String.fromCharCode(tagname));
		if (!isValid) {
			swal("","<style>.swal2-popup #swal2-content{width:100%}.swal2-content div strong{float:none;}.swal2-popup {font-family: 'DM Sans',sans-serif;color: #333;font-size: 14px;line-height: 1.4;font-weight: normal;}.swal2-popup strong {font-weight: 600;}</style><strong>Sorry, these characters are not allowed:</strong></br>slash, any special characters",""); 
			return false;
		}
		/*jQuery('input[name="tagname_valid"]').attr('id',tagname);
		try {
			var tagname_valid = jQuery('input[name="tagname_valid"]#'+tagname).length;
			if(tagname_valid == 0){
				swal("","<style>.swal2-popup #swal2-content{width:100%}.swal2-content div strong{float:none;}.swal2-popup {font-family: 'DM Sans',sans-serif;color: #333;font-size: 14px;line-height: 1.4;font-weight: normal;}.swal2-popup strong {font-weight: 600;}</style><strong>Sorry, these characters are not allowed:</strong></br>spaces, slash, any special characters",""); 
				return false;
			}
			
		}
		catch(err) {
			swal("","<style>.swal2-popup #swal2-content{width:100%}.swal2-content div strong{float:none;}.swal2-popup {font-family: 'DM Sans',sans-serif;color: #333;font-size: 14px;line-height: 1.4;font-weight: normal;}.swal2-popup strong {font-weight: 600;}</style><strong>Sorry, these characters are not allowed:</strong></br>spaces, slash, any special characters",""); 
			return false;
		}
        jQuery('input[name="tagname_valid"]').removeAttr('id');*/
        
		
		SQBShowLoader();  
		jQuery.post(ajaxurl, {
			action: 'sqb_save_tag_content',
			tagname: tagname,
			sqb_tag_contents: sqb_tag_contents,
			tag_field_id: tag_field_id,
		},function(response) {
			response = JSON.parse(response);	
			SQBHideLoader();  
			if(response.tag_list_dropdown){
				if(response.duplicate_tag){
					swal('Tag already exists');
					jQuery('#Quiz_setting_tab_5 .delete-tag-content').hide();
					sqb_reset_tags_fields();
				} else {
				jQuery('.quizTagList').html(response.tag_list_dropdown);
				jQuery('ul.quizTagList li:last-child').addClass('activeli');
				jQuery('ul.quizTagList li:last-child').find('a').addClass('active');
				jQuery('#Quiz_setting_tab_5 .delete-tag-content').show();
				jQuery('#Quiz_setting_tab_5 .sqb_tags_msg.sucess_message').show();
				
				setTimeout(function(){ 
				jQuery('#Quiz_setting_tab_5 .sqb_tags_msg.sucess_message').hide('slow');
				}, 1000);
				
				}
			}
		}); 
	});

jQuery(document).on('click','#Quiz_setting_tab_5 .delete-tag-content',function(){
	swal({
			text: "Are you sure you want delete?",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#a71a1a",
			confirmButtonText: "Yes",
			customClass: '',
		}).then((result) => {
			if (result.value) {
				
				var tag_field_id = jQuery('#tag_field_id').val();
				jQuery.post(ajaxurl, {
					action: 'sqb_delete_tag',
					tag_field_id: tag_field_id,
				},function(response) {
					response = JSON.parse(response);
					if(response.tag_list_dropdown){
						jQuery('.quizTagList').html(response.tag_list_dropdown);
					}
					jQuery('#Quiz_setting_tab_5 .delete-tag-content').hide();
					sqb_reset_tags_fields();
				});
			}
		});
});
	
	
/**********************quiz export Import****************************/
function sqb_hide_sqb_quiz_export_import(){
	jQuery('.sqb-export-import-quiz-selection').show('slow');
	jQuery('#search-popup-quiz-outer').hide('slow');
	jQuery('#export-import-quiz-outer').hide('slow');
	jQuery('#import-question-answers-outer').hide('slow');
}

sqb_search_multiple_select_url();
sqb_select_page_list();

function sqb_search_multiple_select_url(){
	jQuery(document).on('keyup','#sqb_search_multiple_select',function() {
		var allpostlist = [];
		var str2 = jQuery(this).val().toLowerCase();	 
		var i = 0;
		jQuery("ul.sqb_select_quiz li").each(function() {
			var str1 = jQuery(this).text().toLowerCase();
			if (str1.indexOf(str2) != -1) {
				allpostlist[i++] = jQuery(this).attr("data-value");
			}
		});

		jQuery("ul.sqb_select_quiz li").each(function() {
			if (jQuery.inArray(jQuery(this).attr("data-value"), allpostlist) !== -1) {
				jQuery(this).show();
			} else {
				jQuery(this).hide();
			}
		});
	});
	jQuery(document).on('keyup','#sqb_search_multiple_quiz_name',function() {
		var allpostlist = [];
		var str2 = jQuery(this).val().toLowerCase();	 
		var i = 0;
		jQuery("ul.quizList li").each(function() {
			var str1 = jQuery(this).text().toLowerCase();
			if (str1.indexOf(str2) != -1) {
				allpostlist[i++] = jQuery(this).attr("data-title");
			}
		});

		jQuery("ul.quizList li").each(function() {
			if (jQuery.inArray(jQuery(this).attr("data-title"), allpostlist) !== -1) {
				jQuery(this).show();
			} else {
				jQuery(this).hide();
			}
		});
	});

	jQuery(document).on('keyup','#sqb_search_multiple_quiz_name_pdf',function() {
		var allpostlist = [];
		var str2 = jQuery(this).val().toLowerCase();	 
		var i = 0;
		jQuery("ul.pdf-quizList li").each(function() {
			var str1 = jQuery(this).text().toLowerCase();
			if (str1.indexOf(str2) != -1) {
				allpostlist[i++] = jQuery(this).attr("data-title");
			}
		});

		jQuery("ul.pdf-quizList li").each(function() {
			if (jQuery.inArray(jQuery(this).attr("data-title"), allpostlist) !== -1) {
				jQuery(this).show();
			} else {
				jQuery(this).hide();
			}
		});
	});
	jQuery(document).on('keyup','#sqb_search_tag_names',function() {
		var allpostlist = [];
		var str2 = jQuery(this).val().toLowerCase();	 
		var i = 0;
		jQuery("ul.quizTagList li").each(function() {
			var str1 = jQuery(this).text().toLowerCase();
			if (str1.indexOf(str2) != -1) {
				allpostlist[i++] = jQuery(this).attr("title");
			}
		});

		jQuery("ul.quizTagList li").each(function() {
			if (jQuery.inArray(jQuery(this).attr("title"), allpostlist) !== -1) {
				jQuery(this).show();
			} else {
				jQuery(this).hide();
			}
		});
	});
}

function sqb_select_page_list(){
	jQuery('ul.sqb_select_quiz li.active_quiz').each(function(){
			var url_id = jQuery(this).attr('data-id');
			var page_url = jQuery(this).attr('data-value');
			jQuery('ul.sqb_selected_quiz').append('<li data-id='+url_id+' data-value='+page_url+'>'+page_url+'</li>');
	});
	jQuery('ul.sqb_select_quiz li').css('cursor','pointer');
	
	jQuery(document).on('click','ul.sqb_select_quiz li',function(){
		jQuery('ul.sqb_select_quiz li').removeClass('active_quiz');
		var url_id = jQuery(this).attr('data-id');
		var page_url = jQuery(this).attr('data-value');
		jQuery(this).toggleClass('active_quiz');
		if(jQuery(this).hasClass('active_quiz')){
			jQuery('ul.sqb_selected_quiz').html('<li data-id='+url_id+' data-value='+page_url+'>'+page_url+'</li>');
		} else {
			jQuery("ul.sqb_selected_quiz li[data-id='" + url_id + "']").remove();
		}
	});
}
	
function sqb_import_quiz(){
      var input_type = jQuery('#frmzipImport').find('input[name="zip_file"]');
      var files = jQuery(input_type)[0].files;
      
	  if(files.length < 1 ){
		  swal('Please select a zip file');
		  return false;
	  }
	  
	  SQBShowLoader();
      var form = jQuery('#frmzipImport')[0];
      var varform = new FormData(form);
      varform.append("action", "sqb_import_zip");
	  sqbImportzipfile(varform);
}

function sqbImportzipfile(varform) {
	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		dataType: "JSON",
		data: varform,
		processData: false,
		contentType: false,
		cache: false,
		beforeSend: sqbonLoadingzip,
		success: sqbonSuccesZipImport,
		crossDomain:true
	});
}
    
function sqbonLoadingzip() {
}
    
function sqbonSuccesZipImport(data, status) {
	jQuery('#frmzipImport').trigger("reset");
	swal('',data.message,"success");
	SQBHideLoader();
	location.reload();
	window.location.replace(jQuery('a#manage_quiz_tab').attr('href'));
}

function sqb_export_quiz(){
	if(jQuery('#sqb_export_select_quiz').attr('data-value') > 0){
		SQBShowLoader();
		var quiz_ids = jQuery('#sqb_export_select_quiz').attr('data-value');
		jQuery.post(ajaxurl, {
			action: 'sqb_export_quiz',
			quiz_ids: quiz_ids,   
		}, function(response) {
			var out = jQuery.parseJSON(response);
			location.replace(out.fileurl);
			//jQuery('ul.sqb_select_quiz li').removeClass('active_quiz');//reset selcted quiz
			//jQuery('ul.sqb_selected_quiz').html('');//reset the list of selected quiz
			SQBHideLoader();	 
		});
	} else {
		swal('Please select a quiz');
		return false;	
	}
}

function sqb_certificate_table_datatable_call(){
	var attribute_table_type = jQuery('.sqb_certificate_tab_table_class').attr('attribute_table_type');
	var member_page_type = jQuery('.sqb_certificate_tab_table_class').attr('certificate_tab_type');
	
	if(member_page_type == 'certificate'){
		sqb_table_sort_var = [[2, "desc" ]];
		pagination_len = 4;
	}
	
	jQuery('#sqb_certificate_tab_table').DataTable({
		responsive: true,
			"language": {
				"emptyTable": "No Data Found"
			},
			 "iDisplayLength": 10,
			"order": [[3, 'desc']],
			"fnInitComplete": function (){			 
				//dap_member_hide_loader(); 
				jQuery('.sqb_certificate_tab_table_class').show();		
					 
			}
	}); 	
}

function sqb_certificate_delete_by_id(){
	
	jQuery(document).on('click','.delete_certificate_by_id',function(e){
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
				SQBShowLoader();
				jQuery.post(ajaxurl, {
						action: 'sqbDeleteCertificateByIdAjax',
						id: id,  
				}, function(response) {
					//swal('Deleted Successfully!');
					jQuery('.sqb-page-delete-alert').show();
					setTimeout(function() {
				        jQuery('.sqb-page-delete-alert').hide();
				    }, 5000);
				    
					SQBHideLoader();
					var table = jQuery(current_obj).closest('.sqb_certificate_tab_table_class').DataTable();
					table.row(jQuery(current_obj).closest('.sqb_certificate_tab_table_class').find('tr.sqb_certificate_manage_page_row_id_'+id)).remove().draw();
					//location.reload();
				});
			}else{
				return false;	
			}
		});
	});	
}
function sqb_edit_certificate_by_id(){
	
	jQuery(document).on('click','.edit_certificate_by_id',function(e){
		e.preventDefault();
		SQBShowLoader()

		jQuery("#add_new_coupon_tab li:eq(0) a").trigger('click');

		var current_obj = this;
		var id = jQuery(this).attr('data-id'); 
		jQuery.post(ajaxurl, {
				action: 'sqbEditCertificateByIdAjax',
				id: id,  
		}, function(response) {
			response = JSON.parse(response);


			if(response.success == "Success"){
				jQuery('input[name="cert_name"]').val(response.name);
				if(response.status == "Y"){
					jQuery('#certificate_btn_status').prop('checked', true);
				}else{
					jQuery('#certificate_btn_status').prop('checked', false);
				}			
				jQuery("#certificate_admin_name").val(response.admin_name);
				jQuery(".certificate_logo_btn_wrapper").html('<img src="'+response.logo_img+'">');
				jQuery('input[name="certificate_logo_src"]').val(response.logo_img);		
				jQuery(".cert_signature_img_wrapper").html('<img src="'+response.signature_img+'">');
				jQuery('input[name="cert_signature_img_src"]').val(response.signature_img);
				// var html_data = decodeURIComponent(response.template_html);
				jQuery('.certificate_template_html_outer').html(response.template_html); 
				jQuery('#cert_edit_id').val(id); 
			}	

			SQBHideLoader();
			sqb_tiny_mce_editor();
			sqb_cert_resize_logo();
			draggable_event_for_cert();

			jQuery('.certificate_created').hide('slow');
			jQuery('#add_new_certificate_wrapper').show('slow');
			jQuery('#cert_general_tab').addClass('active show');
			jQuery('.certficate-prev-btn').hide();
		});
	});	
}

jQuery(document).on('click','#sqb_export_select_quiz_id .dropdown-item',function(){
		var quiz_id = jQuery(this).attr('data-value');
		var quiz_name = jQuery( this).text();
		jQuery('#sqb_export_select_quiz').text(quiz_name);
		jQuery('#sqb_export_select_quiz').attr('data-value', quiz_id);
	});
	
function sqb_select2(){
	jQuery('.search-quiz').select2();
	jQuery('.simple-select').select2({ minimumResultsForSearch: -1 });
}

function draggable_event_for_cert(){

	jQuery('.dragable-certificate-element .sqb_tiny_mce_editor').on('dblclick', function(){
		if (jQuery(this).parents('.dragable-certificate-element').hasClass('ui-draggable')) {
			jQuery(".certificate_template_html_outer").addClass( "cert-edit-icon" );
         	jQuery(".template-allow-draganddrop .dragable-certificate-element").draggable( "destroy" );
         	 jQuery(this).focus();
		}
	});

	jQuery('.dragable-certificate-element .sqb_tiny_mce_editor').on('focusout', function(){
		jQuery(".certificate_template_html_outer").removeClass( "cert-edit-icon" );
         jQuery(".template-allow-draganddrop .dragable-certificate-element").draggable();
	});
}

function sqb_cert_resize_logo(){
	jQuery('.template-certificate-icon img').resizable();
	jQuery('.certificate-element-resizable').resizable();

	jQuery(".template-allow-draganddrop .award_img_inner").draggable();
	jQuery(".template-allow-draganddrop .dragable-certificate-element").draggable();
}  