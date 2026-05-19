function sqb_pdf_content_text_tiny_mce_editor() {
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
				//ed.execCommand("fontName", false, "'open sans', sans-serif");
				jQuery(ed.getDoc()).contents().find('body').blur(function(){
				   
				});  
			});
		}
	});
}

function sqb_pdf_content_show_loader(){
	jQuery('.sqb_loading_wrapper').show();
}

function sqb_pdf_content_hide_loader(){
	jQuery('.sqb_loading_wrapper').hide();
}

function generateUniqueId() {
  	return Date.now().toString(36) + Math.random().toString(36).substr(2);
}

function sqb_save_pdf_content_data_on_click(){
	if(jQuery('.sqb-pdf-generator-main-container .pdf-slide-box-create-box-a4-size.pdf-screen-content').hasClass('sqb-ai-active')){
		jQuery('.save-content-data').trigger('click');
	}
}

function sqb_pdf_ct_table_datatable_call(){
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

function sqb_save_pdf_content_data(next){
	if(jQuery('.pdf-slide-sticky-bottom-page-preview-box .pdf-slider-box').length == 1){
		swal('Please add Image or Content');
		return false;
	}

	sqb_save_pdf_content_data_on_click();
	var data = [];
	var name = jQuery('#pdf_content_name').val();
	var page_view = jQuery('input[name="page_view_option"]:checked').val();
	var pdf_id = jQuery('#pdf_id').val();

	var other_optionss = [];
	other_options = {'page_view': page_view};

	jQuery('.pdf-slide-sticky-bottom-page-preview-box .pdf-slider-box').each(function(){

		if(jQuery(this).find('.add-slide-btn').length != 0){
	    	
	    }else{
	    	if(jQuery(this).hasClass('pdf-slide-text')){
	    		var html_data = jQuery(this).find('.pdf-content-data').val();
		    	var get_html = jQuery('.pdf-for-content').html();
		    	if(html_data){
		    		html_data = html_data;
		    	}else{
		    		html_data = '';
		    	}
		    	data.push({
				    id: generateUniqueId(),
				    type: 'text',
				    data: html_data
				  });
	    	}else if(jQuery(this).hasClass('pdf-slide-img')){
	    		//var bg = jQuery(this).css('background-image');
				//var img_url = bg.replace('url(','').replace(')','').replace(/\"/gi, "");
				var img_url = jQuery(this).find('.pdf-slide-hidden-image').val();
				data.push({
				    id: generateUniqueId(),
				    type: 'image',
				    data: img_url
				  });
	    	}
	    }
	});
	sqb_pdf_content_show_loader();
	jQuery.post(ajaxurl, {
		action: 'sqb_save_pdf_content_data',
		data : data,
		name : name,
		other_options : other_options,
		pdf_id : pdf_id,
	}, function(response) {
		sqb_pdf_content_hide_loader();
		var result = jQuery.parseJSON(response);
		if(result.id){
			jQuery('#pdf_id').val(result.id);
			if(next == 'next'){
				jQuery('.sqb-ai-style-screen').removeClass('sqb-ai-active-screen');
				jQuery('#sqb-pdf-thankyou-screen').addClass('sqb-ai-active-screen');
			}
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

	setTimeout(function() {
		jQuery(obj).html('<i class="fa fa-files-o" aria-hidden="true"></i> Copy');
	}, 2000);
}

function sqbpdf_next_screen_move(nextbtn){
	jQuery('.sqbpdf-ai-screen-list').removeClass('sqbpdf-ai-active-screen');
	jQuery('.'+nextbtn).addClass('sqbpdf-ai-active-screen');
}

function sqbpdf_copy_to_clipboardNew(obj) {
	var elementId = jQuery(obj).attr("data-id");
	var code = jQuery('#'+elementId).text();
    var code = code.replace(/<br>/g, "\n");
    copyToClipboardNew(code);
    jQuery(obj).find('i').text("Copied!");
    setTimeout(function() {
      jQuery(obj).find('i').text("Copy Code");
    }, 2000);

    return false;
}

function copyToClipboardNew(text) {
	var tempInput = jQuery("<textarea>");
	if (jQuery("#CreateAICourseModalNew.show .modal-content").length) {
	  jQuery("#CreateAICourseModalNew .modal-content").append(tempInput);
	}else if (jQuery("#CreateAIProductModalNew.show .modal-content").length) {
	  jQuery("#CreateAIProductModalNew .modal-content").append(tempInput);
	}else{
	  jQuery("body").append(tempInput);
	}
	
	tempInput.val(text).select();
	document.execCommand("copy");
	tempInput.remove();
  }
  
function generate_prompt_outline_editsqbpdf(){

	var sqbpdf_ai_quiz_title = jQuery('#ai_quiz_select').find(':selected').text();

	sqbpdf_ai_quiz_title = sqbpdf_ai_quiz_title.split('(ID')[0].trim();

	//var sqbpdf_ai_course_goal = jQuery('#sqbpdf_ai_course_goal').val();
	
	var allOptionValues = [];
        
	// Loop through all the options
	jQuery('#ai_quiz_outcome option').each(function() {
		var value = jQuery(this).val();
		if (value !== '') {
			allOptionValues.push(value);
		}
	});

	var outcome_count = 0;
	if(allOptionValues.length > 0) {
		outcome_count = allOptionValues.length;
	}

	var outcome_title = jQuery('#ai_quiz_outcome').val();
        
	// Join the option values with newline
	var joinedValues = allOptionValues.join('\n');

	var sqbpdf_ai_language = jQuery('#edit_sqbpdf_ai_course_lang').val();
   
	sqbpdf_ai_quiz_title = pdf_aicontent.replaceAll('%%QUIZ_NAME%%',sqbpdf_ai_quiz_title);

	sqbpdf_ai_quiz_title = sqbpdf_ai_quiz_title.replaceAll('%%GOAL%%',jQuery('#sqb-pdf-ai-goal').val());
   
	sqbpdf_ai_quiz_title = sqbpdf_ai_quiz_title.replaceAll('%%ALL_OUTCOMES%%',joinedValues);
	sqbpdf_ai_quiz_title = sqbpdf_ai_quiz_title.replaceAll('%%SELECTED_OUTCOME%%',outcome_title);
	sqbpdf_ai_quiz_title = sqbpdf_ai_quiz_title.replaceAll('%%OUTCOME_COUNT%%',outcome_count);
	
	sqbpdf_ai_quiz_title = sqbpdf_ai_quiz_title.replaceAll('%%LANGUAGE%%',sqbpdf_ai_language);

	return sqbpdf_ai_quiz_title;
}


function generateAiPdfContent(prompt){

	//dap_product_show_loader();
	SQBShowLoader();
	jQuery.ajax({
	  url: ajaxurl,
		type: "POST",
		data : {
		  'action' : 'generate_ai_pdf_content_api',
		  'prompt' : prompt
		},
		success: function(object_){
		  //dap_product_hide_loader();
		  SQBHideLoader();
		  var object = JSON.parse(object_);
		  if(object.status == 'ok'){
			try {
				jQuery('#edit_sqbpdf_ai_outline_json').val(object.object);
				jQuery('.sqb-pdf-ai-put-content').trigger('click');
			} catch (error) {
				console.error('Error parsing JSON data:', error);
			}
		  }else if(object.status == 'error'){
  
			if(object.code == 'invalid_api_key'){
			  swal('','Invalid API Key',"");
			}else{
  
			  var msg = '';
			  if(object.html == undefined){
				msg = object.message;
			  }else{
				msg = object.html;
			  }
  
			  swal({
				title : 'Alert',
				text: msg,
				//type: "warning",
				showCancelButton: true,
				showCloseButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				customClass: '',
				
			  },function(isConfirm){
				if (isConfirm) {
				  generateAiTitleProduct(prompt);
				}
			  });
			}
		  }
  
		},
		error: function(jqXHR, textStatus, errorThrown) {
		  //dap_product_hide_loader();
		  SQBHideLoader();
		  alert('Something went wrong please try again');
		  console.log("Request failed:", textStatus, errorThrown);
		}
	  }); 
  }

jQuery(document).ready(function(){
	sqb_pdf_ct_table_datatable_call();

	jQuery('.clone_pdf_content_by_id').on('click',function(){		 
		var pdf_content_id = jQuery(this).attr('data-id');
		if(pdf_content_id == '' || pdf_content_id == 0){
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
				sqb_pdf_content_show_loader();
				jQuery.post(ajaxurl, {
				action: 'sqb_clone_pdfContent_by_id',
				pdf_content_id: pdf_content_id ,
							 
				}, function(response) {		  
					swal('','Clone Completed',"success");
					sqb_pdf_content_hide_loader();
					location.reload();		 
				});
			}
		});
	});

	jQuery(document).on('click','.see-pdf-mapping', function(){
		jQuery(".pdf_mapping_side_popup").addClass("active_Side_Popup");
		jQuery(".pdf_mapping_side_popup").css("display","block");
		SQBShowLoader();
		jQuery(document).ready(function() {
			jQuery.ajax({
				url: ajaxurl, // WordPress AJAX URL
				type: 'POST',
				data: {
					action: 'load_pdf_mapping' // The name of the AJAX action
				},
				success: function(response) {
					SQBHideLoader();
					// Update the pdf-mapping-content div with the received HTML content
					jQuery('.pdf-mapping-content').html(response);
				},
				error: function(xhr, status, error) {
					SQBHideLoader();
					console.error(error);
				}
			});
		});
		

	});

	jQuery("body").on('click','.pdf_mapping_side_popup .close_Side_Popup', function(){
		jQuery(".pdf_mapping_side_popup").removeClass("active_Side_Popup");
	});

	jQuery(document).on('click','.sqb-ai-style-quiz-start-screen .pdf-back-btn', function(){
		var get_home_url = jQuery('#get_home_url').val();
		window.location.href = get_home_url+"/wp-admin/admin.php?page=sqb_pdf_content";
	});

	jQuery(document).on('click','.btn-pdf-avalible-tags-popup', function(){
	 	jQuery('.pdf_avalible_tags_popup_options_wrapper').addClass('active_Side_Popup');
	});

	jQuery(document).on('click','.sqb-pdf-builder-merge-tags', function(){
	 	jQuery('.pdf_individual_question_avalible_tags_popup_options_wrapper').addClass('active_Side_Popup');
	});

	jQuery(document).on('click','.btn-pdf-ai-popup', function(){
		jQuery('.pdf_ai_popup_options_wrapper').addClass('active_Side_Popup');
   });

	jQuery('.close_Side_Popup').on('click', function(){
	 	jQuery('.pdf_avalible_tags_popup_options_wrapper').removeClass('active_Side_Popup');
	 	jQuery('.pdf_ai_popup_options_wrapper').removeClass('active_Side_Popup');
	 	jQuery('.pdf_individual_question_avalible_tags_popup_options_wrapper').removeClass('active_Side_Popup');
	});

	jQuery('.pdf_ai_popup_options_wrapper .close_Side_Popup').on('click', function(){
		jQuery('.sqbpdf-ai-screen-list').removeClass('sqbpdf-ai-active-screen');
		jQuery('.edit-sqbpdf-ai-selection-screen').addClass('sqbpdf-ai-active-screen');
   });

	jQuery(document).on('click','.delete_pdf_content_by_id',function(e){
		e.preventDefault();
		var current_obj = this;
		var id = jQuery(this).attr('data-id'); 
		swal({
		 	 title: "Are you sure you want to Delete ?",
			text: "",
			type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#24bd92",
			confirmButtonText: "Yes, Delete!",
			customClass: '',
			}).then((willDelete) => {

			if (willDelete['value'] == true) {
				sqb_pdf_content_show_loader();
				jQuery.post(ajaxurl, {
						action: 'sqbDeletePdfContentByIdAjax',
						id: id,  
				}, function(response) {
					//swal('Deleted Successfully!');
					jQuery('.sqb-page-delete-alert').show();
					setTimeout(function() {
				        jQuery('.sqb-page-delete-alert').hide();
				    }, 5000);
				    
					sqb_pdf_content_hide_loader();
					var table = jQuery(current_obj).closest('.sqb_member_page_table_class').DataTable();
					table.row(jQuery(current_obj).closest('.sqb_member_page_table_class').find('tr.sqb_member_manage_page_row_id_'+id)).remove().draw();
					//location.reload();
				});
			}else{
				return false;	
			}
		});
	});	

	

	jQuery( function() {jQuery( "#sortable" ).sortable(); } ); 

	jQuery(document).on('click','.show_merge_tags',function() {
		jQuery('.merge_tags_div').show();
	});

	jQuery(document).on('click','.Personalize_close',function() {
		jQuery('.merge_tags_div').hide();
	});

	jQuery(document).on('click','.sqb-goback-btn',function() {
		jQuery('.sqb-ai-style-screen').removeClass('sqb-ai-active-screen');
		jQuery('#sqb-pdf-generator-screen').addClass('sqb-ai-active-screen');
	});

	jQuery(document).on('click','.sqb-preview-pdf',function() {
		
		var downloadText = 'Please wait...';
		var formdata = [];
		var pdf_id = jQuery('#pdf_id').val();
        formdata.push({name: "pdf_id", value: pdf_id});
		jQuery(this).html(downloadText);
		jQuery(this).addClass('downloading-pdf');
		jQuery.ajax({
			type: "POST",
			url: '?sqb_pdf_preview_v2=1',
			data: formdata,
			xhrFields: {
				responseType: 'blob'
			},
			success: function(blob, status, xhr) {
				jQuery('.sqb-preview-pdf').html('Click to Preview');
				jQuery('.sqb-preview-pdf').removeClass('downloading-pdf');
			
				/*setTimeout(function(){
					$this.find('.pdf-success').remove();
				},10000);*/

				var filename = "";
				var disposition = xhr.getResponseHeader('Content-Disposition');
				if (disposition && disposition.indexOf('attachment') !== -1) {
					var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
					var matches = filenameRegex.exec(disposition);
					if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
				}

				if (typeof window.navigator.msSaveBlob !== 'undefined') {
					window.navigator.msSaveBlob(blob, filename);
				} else {
					var URL = window.URL || window.webkitURL;
					var downloadUrl = URL.createObjectURL(blob);
					if (filename) {
						var a = document.createElement("a");
						if (typeof a.download === 'undefined') {
							window.location.href = downloadUrl;
						} else {
							a.href = downloadUrl;
							a.download = filename;
							document.body.appendChild(a);
							a.click();
						}
					} else {
						window.location.href = downloadUrl;
					}
					setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100);
				}
			},error: function(XMLHttpRequest, textStatus, errorThrown) { 
				jQuery('.sqb-preview-pdf').html('Click to Preview');
				jQuery('.sqb-preview-pdf').removeClass('downloading-pdf');
			}   
		});
	});


	jQuery('input[name="page_view_option"]').on('change', function(){
		var get_value = jQuery(this).val();
		if(get_value == 'landscape'){
			jQuery('.sqb-pdf-generator-main-container').addClass('pdf_landscape_view');
		}else{
			jQuery('.sqb-pdf-generator-main-container').removeClass('pdf_landscape_view');
		}
	});

	jQuery('.pdf-next-btn').on('click', function() {
		if(jQuery('#pdf_content_name').val() == ''){
			jQuery('.empty-name-error').show();
			return false;
		}
		jQuery('.empty-name-error').hide();
	  	const nextDivId = jQuery(this).attr('data-next');
	  	jQuery('.sqb-ai-style-quiz-common-info').removeClass('sqb-ai-active-screen');
	  	const targetDiv = jQuery('#' + nextDivId);
	  	if (targetDiv.length) {
	    	targetDiv.addClass('sqb-ai-active-screen');
	 	}
	 	jQuery('.pdf-slider-box.active').trigger('click');
	});

	jQuery('.pdf-content-back').on('click', function() {
		sqb_save_pdf_content_data_on_click();
	  	jQuery('.sqb-ai-style-quiz-common-info').addClass('sqb-ai-active-screen');
	  	jQuery('#sqb-pdf-generator-screen').addClass('sqb-ai-active-screen');
	});

	jQuery(document).on('click','.save-content-data',function() {
		var get_id = jQuery('.pdf-slide-append-main .pdf-content-area').attr('id');
		var get_pdf_data = tinymce.get(get_id).getContent();
		jQuery('.pdf-slide-sticky-bottom-page-preview-box .pdf-slider-box.active').find('.pdf-content-data').val(get_pdf_data);
		jQuery(this).text('Saving...');
		setTimeout(function(){
			jQuery('.save-content-data').text('Save');
		}, 1000);
	});

	jQuery(document).on('click','.delete-img',function() {
		var next_div = jQuery('.pdf-slide-sticky-bottom-page .pdf-slider-box.active').next();

		jQuery('.pdf-slide-append-main .pdf-slide-box-create-box-a4-size').remove();
		jQuery('.pdf-slide-sticky-bottom-page-preview-box .pdf-slider-box.active').remove();
		if(next_div.find('.add-slide-btn').length == 1){
			jQuery('.add-slide-btn').trigger('click');
		}else{
			next_div.addClass('active').trigger('click');
		}
		// jQuery('.pdf-slide-append-main .pdf-slide-box-create-box').addClass('sqb-ai-active');
	});
	
	jQuery(document).on('click','.edit-img',function() {
		var data = jQuery(this);
	   	var sqb_mediauploader;
	   	window.sqb_img_class = jQuery(this).attr('data-class');	 
		if (sqb_mediauploader) {
			sqb_mediauploader.open();
			return;
		}
		sqb_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Add Image',
			button: {
				text: 'Add Image'
			},
			library: {
		            type: [ 'image' ]
		    },
			multiple: true
		});
		sqb_mediauploader.on('select', function() {
			attachment = sqb_mediauploader.state().get('selection').first().toJSON();
			var attachment_url = attachment.url;
			var originalHtml = jQuery('.pdf-slide-box-create-box-a4-size-wrapper.pdf-for-img').html();
			var newImageTag = '<img src="'+attachment_url+'">';
			var modifiedHtml = originalHtml.replace('%%DYNAMIC_IMAGE%%', newImageTag);
	    	jQuery('#sqb-pdf-generator-screen .pdf-slide-append-main .pdf-slide-box-create-box-a4-size').remove();
	    	jQuery('#sqb-pdf-generator-screen .pdf-slide-append-main').append(modifiedHtml);
	    	jQuery('.pdf-slider-box.active').css('background-image', 'url(' + attachment_url + ')');
	    	jQuery('.pdf-slider-box.active').find('.pdf-slide-hidden-image').val(attachment_url);
		});
		sqb_mediauploader.open();
	});
	
	jQuery(document).on('click','.add-slide-btn',function() {
		sqb_save_pdf_content_data_on_click();
		jQuery('#sqb-pdf-generator-screen .pdf-slide-box-create-box-a4-size').removeClass('sqb-ai-active');
		jQuery('#sqb-pdf-generator-screen .pdf-slide-box-create-box').addClass('sqb-ai-active');
		jQuery('#sqb-pdf-generator-screen .pdf-slide-append-main .pdf-screen-img').remove();
		jQuery('#sqb-pdf-generator-screen .pdf-slide-append-main .pdf-screen-content').remove();
	});

	jQuery(document).on('click','.sqb_add_content',function() {
		var get_html = jQuery('.pdf-for-content').html();
		var modifiedHtml = get_html.replace('%%DYNAMIC_TEXTAREA%%', '<div><span style="font-size: 13pt;font-family: open sans, sans-serif;">Thank you for completing the quiz titled:</span></div> <div><span style="font-size: 13pt;font-family: open sans, sans-serif;">%%QUIZ_TITLE%%</span></div> <div><span style="font-size: 13pt;font-family: open sans, sans-serif;">This is a \'%%QUIZ_TYPE%% quiz\'.</span></div> <div>&nbsp;</div> <div><span style="font-size: 13pt;font-family: open sans, sans-serif;">Here\'s your result details:</span></div> <div><span style="font-size: 13pt;font-family: open sans, sans-serif;"><strong>Your Outcome:</strong> %%OUTCOME%%</span></div> <div><span style="font-size: 13pt;font-family: open sans, sans-serif;"><strong>Your Answers:</strong> %%ANSWERS%%</span></div>');
		modifiedHtml = modifiedHtml.replace('%%UNIQUEID%%', generateUniqueId());

		jQuery('#sqb-pdf-generator-screen .pdf-slide-append-main').append(modifiedHtml);
		jQuery('.pdf-slide-box-create-box').removeClass('sqb-ai-active');
		jQuery('.pdf-slide-sticky-bottom-page-preview-box .pdf-slider-box.active').removeClass('active');
		jQuery('#sqb-pdf-generator-screen .pdf-slide-append-main').find('.pdf-content-area').addClass('sqb_text_editor');
		sqb_pdf_content_text_tiny_mce_editor();
		jQuery('<div class="pdf-slider-box pdf-slide-text active"><textarea class="pdf-content-data" style="display:none;"><div><span style="font-size: 13pt;font-family: open sans, sans-serif;">Thank you for completing the quiz titled:</span></div> <div><span style="font-size: 13pt;font-family: open sans, sans-serif;">%%QUIZ_TITLE%%</span></div> <div><span style="font-size: 13pt;font-family: open sans, sans-serif;">This is a \'%%QUIZ_TYPE%% quiz\'.</span></div> <div>&nbsp;</div> <div><span style="font-size: 13pt;font-family: open sans, sans-serif;">Here\'s your result details:</span></div> <div><span style="font-size: 13pt;font-family: open sans, sans-serif;"><strong>Your Outcome:</strong> %%OUTCOME%%</span></div> <div><span style="font-size: 13pt;font-family: open sans, sans-serif;"><strong>Your Answers:</strong> %%ANSWERS%%</span></div></textarea></div>').insertBefore('.pdf-slide-sticky-bottom-page-preview-box .pdf-slider-box-btn');
	});

	jQuery(document).on('click','.pdf-slide-sticky-bottom-page-preview-box .pdf-slider-box',function() {
		sqb_save_pdf_content_data_on_click();
	    jQuery('.pdf-slide-sticky-bottom-page-preview-box .pdf-slider-box.active').removeClass('active');
	    jQuery(this).addClass('active');
	    if(jQuery(this).find('.add-slide-btn').length != 0){
	    	return false;
	    }
	    jQuery('#sqb-pdf-generator-screen .pdf-slide-box-create-box-a4-size').remove();
	    if(jQuery(this).hasClass('pdf-slide-text')){
	    	var html_data = jQuery(this).find('.pdf-content-data').val();
	    	var get_html = jQuery('.pdf-for-content').html();
	    	if(html_data){
	    		html_data = html_data;
	    	}else{
	    		html_data = '';
	    	}
	    	var modifiedHtml = get_html.replace('%%DYNAMIC_TEXTAREA%%', html_data);
	    	modifiedHtml = modifiedHtml.replace('%%UNIQUEID%%', generateUniqueId());
	    	jQuery('#sqb-pdf-generator-screen .pdf-slide-append-main').append(modifiedHtml);
			jQuery('.pdf-slide-box-create-box').removeClass('sqb-ai-active');
			jQuery('#sqb-pdf-generator-screen .pdf-slide-append-main').find('.pdf-content-area').addClass('sqb_text_editor');
			sqb_pdf_content_text_tiny_mce_editor();
	    }else if(jQuery(this).hasClass('pdf-slide-img')){
	    	var bg = jQuery(this).css('background-image');
			var attachment_url = bg.replace('url(','').replace(')','').replace(/\"/gi, "");
	    	var originalHtml = jQuery('.pdf-slide-box-create-box-a4-size-wrapper.pdf-for-img').html();
			jQuery('.pdf-slide-box-create-box').removeClass('sqb-ai-active');
			var newImageTag = '<img src="'+attachment_url+'">';
			var modifiedHtml = originalHtml.replace('%%DYNAMIC_IMAGE%%', newImageTag);
	    	jQuery('#sqb-pdf-generator-screen .pdf-slide-append-main').append(modifiedHtml);
	    }
	});

	jQuery(document).on('click','.sqb_add_image',function() {
		var data = jQuery(this);
	   	var sqb_mediauploader;
	   	window.sqb_img_class = jQuery(this).attr('data-class');	 
		if (sqb_mediauploader) {
			sqb_mediauploader.open();
			return;
		}
		sqb_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Add Image',
			button: {
				text: 'Add Image'
			},
			library: {
		            type: [ 'image' ]
		    },
			multiple: true
		});
		sqb_mediauploader.on('select', function() {
			gallerySelection = sqb_mediauploader.state().get('selection').toJSON();
			gallerySelection.map(function(attachment) {
				var attachment_url = attachment.url;
				var originalHtml = jQuery('.pdf-slide-box-create-box-a4-size-wrapper.pdf-for-img').html();
				jQuery('.pdf-slide-box-create-box').removeClass('sqb-ai-active');
				jQuery('.pdf-slide-sticky-bottom-page-preview-box .pdf-slider-box.active').removeClass('active');
				var newImageTag = '<img src="'+attachment_url+'">';
				var modifiedHtml = originalHtml.replace('%%DYNAMIC_IMAGE%%', newImageTag);
		    	jQuery('#sqb-pdf-generator-screen .pdf-slide-append-main').append(modifiedHtml);
		    	jQuery('#sqb-pdf-generator-screen .pdf-slide-append-main .pdf-slide-box-create-box-a4-size').removeClass('sqb-ai-active');
				jQuery('<div class="pdf-slider-box pdf-slide-img active" style=" background-image: url('+attachment_url+'); "><input type="hidden" value="'+attachment_url+'" class="pdf-slide-hidden-image"></div>').insertBefore('.pdf-slide-sticky-bottom-page-preview-box .pdf-slider-box-btn');
			});

			jQuery('#sqb-pdf-generator-screen .pdf-slide-append-main .pdf-slide-box-create-box-a4-size:last-child').addClass('sqb-ai-active');
			jQuery( function() {jQuery( "#sortable" ).sortable(); } ); 
		});
		sqb_mediauploader.open();
	});


	/* PDF AI */

	var api_flow = 'manual';
	var edit_module_name = '';
	var edit_module_id = '';
	jQuery(document).on('click','.edit-sqbpdf-ai_manual_flow',function(){
		jQuery('.sqbpdf-ai-screen-list').removeClass('sqbpdf-ai-active-screen');
		jQuery('.edit-sqbpdf-ai-manual-basic-screen').addClass('sqbpdf-ai-active-screen');
		edit_api_flow = 'normal';
		api_flow = 'normal';
		
		jQuery('.edit-sqbpdf-ai-field-group-for-show-ui').removeClass('sqbpdf-ai-hide');
		jQuery('.edit-sqbpdf-ai-field-group-for-show-text').addClass('sqbpdf-ai-hide');
		jQuery('#edit_sqbpdf_ai_outline_prompt_text').text('Show Prompt');

		jQuery('.edit-sqbpdf-ai-main-screen').addClass('ai-flow-manual').removeClass('ai-flow-api');
	});

	jQuery(document).on('click','.edit-sqbpdf-ai_auto_flow',function(){
		jQuery('.sqbpdf-ai-screen-list').removeClass('sqbpdf-ai-active-screen');
		jQuery('.edit-sqbpdf-ai-manual-basic-screen').addClass('sqbpdf-ai-active-screen');
		jQuery('.edit-sqbpdf-ai-main-screen').addClass('ai-flow-api').removeClass('ai-flow-manual');
		edit_api_flow = 'api';
		api_flow = 'api';
	});

	jQuery('select[name="ai_quiz_select"]').select2();
	jQuery('select[name="edit_sqbpdf_ai_course_lang"]').select2();
	jQuery('select[name="ai_quiz_outcome"]').select2();
	jQuery(document).on('change','#ai_quiz_select',function(){
		
		var selectedQuiz = jQuery(this).val();
		SQBShowLoader();
		jQuery.ajax({
			type: 'GET',
			url: ajaxurl,
			data: {
				action: 'generate_outcome_dropdown',
				quiz_id: selectedQuiz
			},
			success: function(response) {
				SQBHideLoader();
				jQuery('select[name="ai_quiz_outcome"]').html(response);
			}
		});
		
	});
	jQuery(document).on('click','.edit-sqbpdf-ai-next-btn',function(){
		var nextbtn =  jQuery(this).attr('data-next');
		var screen =  jQuery(this).attr('data-screen');
		var is_api = false;
	  
		if (typeof nextbtn !== "undefined" && nextbtn != '') {
			if(screen == 'edit-generate-outline'){

				if(jQuery('#ai_quiz_select').val() == ''){
					swal('Please select a quiz.');
					return false;
				}else if(jQuery('#ai_quiz_outcome').val() == ''){
					swal('Please select an outcome.');
					return false;
				}else if(jQuery('#sqb-pdf-ai-goal').val() == ''){
					swal('Please enter a goal.');
					return false;
				}

				if(api_flow == 'api'){
					//var sqbpdf_edit_prompt = generate_prompt_outline_editsqbpdf();
					if (jQuery('.edit-sqbpdf-ai-field-group-for-show-ui').hasClass('dap-ai-hide')) {
						var prompt_data = generate_prompt_outline_editsqbpdf();
						var prompt_required_data = jQuery('<div>').html(prompt_data).find('span').text();
						var prompt_other_data_org = jQuery('<div>').html(prompt_data).find('span').remove().end().html();
						var prompt_other_data = jQuery('#edit_sqbpdf_ai_course_prompt').val();
						sqbpdf_edit_prompt = prompt_other_data+''+prompt_required_data;
					  }else{
						var sqbpdf_edit_prompt = generate_prompt_outline_editsqbpdf();
					  }
					generateAiPdfContent(sqbpdf_edit_prompt);
				}else{
					var sqbpdf_edit_prompt = generate_prompt_outline_editsqbpdf();
					jQuery('#edit_sqbpdf_ai_outline_prompt_format_code').html(sqbpdf_edit_prompt);
					sqbpdf_next_screen_move(nextbtn);
				}
			}

			if (screen != 'edit-generate-outline' && screen != 'edit-sqbpdf-ai-manual-outline-selection-screen') {
				sqbpdf_next_screen_move(nextbtn);
			}
		}
	});

	jQuery(document).on('click','#edit_sqbpdf_ai_outline_prompt_text',function(){

		if(jQuery('#ai_quiz_select').val() == ''){
			swal('Please select a quiz.');
			return false;
		}else if(jQuery('#ai_quiz_outcome').val() == ''){
			swal('Please select an outcome.');
			return false;
		}else if(jQuery('#sqb-pdf-ai-goal').val() == ''){
			swal('Please enter a goal.');
			return false;
		}

		jQuery('.edit-sqbpdf-ai-field-group-for-show-ui').toggleClass('sqbpdf-ai-hide');
		jQuery('.edit-sqbpdf-ai-field-group-for-show-text').toggleClass('sqbpdf-ai-hide');
		if(jQuery(this).text() == 'Show Prompt'){
	  
			var prompt_data = generate_prompt_outline_editsqbpdf();
			var prompt_required_data = jQuery('<div>').html(prompt_data).find('span').text();
			var prompt_other_data = jQuery('<div>').html(prompt_data).find('span').remove().end().html();
			jQuery('#edit_sqbpdf_ai_course_prompt').val(prompt_other_data);
	  
			jQuery(this).text('Return')
		}else{
			jQuery(this).text('Show Prompt')
		}
	});

	jQuery(document).on('click','.sqb-pdf-ai-put-content',function(){
		
		
		var contid = jQuery('.sqb-ai-active-screen .pdf-content-area').attr('id');
		var newContent = jQuery('#edit_sqbpdf_ai_outline_json').val();

		if(newContent == '' && api_flow == 'manual'){
			swal('Please enter the content that you received from the ChatGPT response.');
			return false;
		}

		var editor = tinymce.get(contid);

		var existingContent = editor.getContent();

		var Chtml = jQuery('<div>').html(newContent);

		Chtml.find('p').css({'font-size':'13pt','font-family' : 'open sans, sans-serif'});
		Chtml.find('ul').css({'font-size':'13pt','font-family' : 'open sans, sans-serif'});

		var combinedContent = existingContent + Chtml.html();

		editor.setContent(combinedContent);

		jQuery('#edit_sqbpdf_ai_outline_json').val('');
		
		jQuery('.pdf_ai_popup_options_wrapper').removeClass('active_Side_Popup');

		jQuery('.sqbpdf-ai-screen-list').removeClass('sqbpdf-ai-active-screen');
		jQuery('.edit-sqbpdf-ai-selection-screen').addClass('sqbpdf-ai-active-screen');

		swal('Congrats! PDF content is ready! It has been added to the editor.');
		
	});

	

	jQuery(document).on('click','.sqbpdf-ai-back-btn',function(){
		var prevbtn =  jQuery(this).attr('data-prev');
		if (typeof prevbtn !== "undefined" && prevbtn != '') {
			jQuery('.sqbpdf-ai-screen-list').removeClass('sqbpdf-ai-active-screen');
			jQuery('.'+prevbtn).addClass('sqbpdf-ai-active-screen');
			jQuery('.sqbpdf-ai-field-group-for-show-ui').removeClass('sqbpdf-ai-hide');
			jQuery('.sqbpdf-ai-field-group-for-show-text').addClass('sqbpdf-ai-hide');
			jQuery('#sqbpdf_ai_outline_prompt_text').text('Show Prompt');
		}

	});
});