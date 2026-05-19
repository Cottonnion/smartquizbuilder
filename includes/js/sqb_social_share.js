jQuery(document).ready(function(){
	

sqb_social_share_check_row_exists();
sqb_tiny_mce_editor_social_share();
sqb_tiny_editor_social_share_textarea();
sqb_mediauploader_social_share_tab();

jQuery('#show_social_share_btn').on('click',function(){
	
	if(jQuery(this).prop('checked')){
		jQuery('.disabled_shocial_share').hide();
	}else{
		jQuery('.disabled_shocial_share').show();
	}
});
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
});


function sqb_tiny_editor_social_share_textarea(){
	
	tinymce.init({
        selector: '.sqb_tiny_editor_social_share_textarea',
        theme: 'modern',
        force_br_newlines: true,
        force_p_newlines: false,
        resize: "both",
        object_resizing: "img",
        forced_root_block: '',
        fontsize_formats: "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 22pt 24pt 26pt 30pt",
        theme_advanced_fonts: "Andale Mono=andale mono,times;" + "Arial=arial,helvetica,sans-serif;" + "Arial Black=arial black,avant garde;" + "Book Antiqua=book antiqua,palatino;" + "Comic Sans MS=comic sans ms,sans-serif;" + "Courier New=courier new,courier;" + "Georgia=georgia,palatino;" + "Helvetica=helvetica;" + "Impact=impact,chicago;" + "Symbol=symbol;" + "Tahoma=tahoma,arial,helvetica,sans-serif;" + "Terminal=terminal,monaco;" + "Times New Roman=times new roman,times;" + "Trebuchet MS=trebuchet ms,geneva;" + "Verdana=verdana,geneva;" + "Webdings=webdings;" + "Wingdings=wingdings,zapf dingbats",
       // plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak', 'searchreplace wordcount visualblocks visualchars code fullscreen', 'insertdatetime media nonbreaking save table contextmenu directionality', 'emoticons template paste textcolor colorpicker textpattern imagetools'],
        //toolbar1: 'insertfile undo redo | styleselect | bold italic |  fontselect | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
       //toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
		plugins: [
               "lists link image charmap code",
               "fullscreen",
               "media paste , textcolor"
           ],
		toolbar1: 'insertfile undo redo | styleselect | fontselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		toolbar2: 'print preview media | forecolor backcolor emoticons ',      
        image_advtab: true,
        templates: [{
            title: 'Test template 1',
            content: 'Test 1'
        }, {
            title: 'Test template 2',
            content: 'Test 2'
        }]
      });
}


function sqb_tiny_mce_editor_social_share() {
	 tinymce.init({
        selector: '.sqb_tiny_mce_editor_social_share',
        inline: true,
        height: 500,
        theme: 'modern',
        force_br_newlines: true,
        force_p_newlines: false,
        resize: "both",
        object_resizing: "img",
        forced_root_block: '',
        fontsize_formats: "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 22pt 24pt 26pt 30pt",
        theme_advanced_fonts: "Andale Mono=andale mono,times;" + "Arial=arial,helvetica,sans-serif;" + "Arial Black=arial black,avant garde;" + "Book Antiqua=book antiqua,palatino;" + "Comic Sans MS=comic sans ms,sans-serif;" + "Courier New=courier new,courier;" + "Georgia=georgia,palatino;" + "Helvetica=helvetica;" + "Impact=impact,chicago;" + "Symbol=symbol;" + "Tahoma=tahoma,arial,helvetica,sans-serif;" + "Terminal=terminal,monaco;" + "Times New Roman=times new roman,times;" + "Trebuchet MS=trebuchet ms,geneva;" + "Verdana=verdana,geneva;" + "Webdings=webdings;" + "Wingdings=wingdings,zapf dingbats",
       // plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak', 'searchreplace wordcount visualblocks visualchars code fullscreen', 'insertdatetime media nonbreaking save table contextmenu directionality', 'emoticons template paste textcolor colorpicker textpattern imagetools'],
        //toolbar1: 'insertfile undo redo | styleselect | bold italic |  fontselect | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        //toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
        plugins: [
               "lists link image charmap code",
               "fullscreen",
               "media paste , textcolor"
           ],
		toolbar1: 'insertfile undo redo | styleselect | fontselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		toolbar2: 'print preview media | forecolor backcolor emoticons ',      
        image_advtab: true,
        templates: [{
            title: 'Test template 1',
            content: 'Test 1'
        }, {
            title: 'Test template 2',
            content: 'Test 2'
        }]
    });
}


function sqb_social_share_check_row_exists(){
	jQuery(".share_select_quiz_list a").on('click',function(){
		 jQuery("#share_select_quiz").attr('data-value',jQuery(this).attr('data-value'));
		 jQuery("#share_select_quiz").text(jQuery(this).text());
		 var quiz_id = jQuery(this).attr('data-value');
		 
		 console.log("quiz_id "+quiz_id);
		 SQBShowLoader();
		 if(quiz_id  != ''){
				 jQuery.ajax({	 
					url: ajaxurl,	 
					type: "POST",
					
					data: {
						action: 'sqb_social_share_load_data_by_quiz_id',
						quiz_id: quiz_id,
					},
					success: function (response) {
						SQBHideLoader();	
						jQuery(".social_share_img").attr('src','');
						jQuery('#share_image_value').val(''); 
						jQuery("#share_text").val('');
						jQuery('#fb_share_details').val(''); 
						jQuery('#tw_share_details').val('');
						jQuery('#share_url').val('');
						jQuery(".customize_social_share_wrapper_html").html('<div class="customize_social_share_wrapper"><label class="sqb_tiny_mce_editor_social_share">Share your Results on Social</label><div class="quiz-social-links"><a href="javascript:void(0)" target="_blank" class="quiz-social-media-btn quiz-Facebook-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a><a href="javascript:void(0)" target="_blank" class="quiz-social-media-btn quiz-twitter-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></div></div>');
						
						response = JSON.parse(response);		 
						console.log(response);
						if(response.success){
							if(response.start_template){
								var img_src = jQuery(response.start_template).find('.start_img').attr('src');
								console.log(img_src);
								if(img_src != ''){
									
									jQuery(".social_share_img").attr('src',img_src);
									jQuery('#share_image_value').val(img_src);  
								}
							}
							if(response.share_text){
								jQuery("#share_text").val(response.share_text);
							}
							
							if(response.fb_share_details){
								
								//tinymce.get("fb_share_details").setContent(response.fb_share_details); 
								jQuery('#fb_share_details').val(response.fb_share_details); 
							}
							if(response.tw_share_details){
								
								//tinymce.get("tw_share_details").setContent(response.tw_share_details); 
								jQuery('#tw_share_details').val(response.tw_share_details); 
							}
							
							
							if(response.customize_social_share_wrapper_html){
								jQuery(".customize_social_share_wrapper_html").html(response.customize_social_share_wrapper_html);
							}
							
							if(response.share_url){
								jQuery("#share_url").val(response.share_url);
							}
							
							if(response.share_image_value){
								jQuery(".social_share_img").attr('src',response.share_image_value);
								jQuery('#share_image_value').val(response.share_image_value);  
							}
							
							if(response.show_social_share){
								
								if(response.show_social_share == 1){
									jQuery('#show_social_share_btn').prop('checked',true);
									jQuery('.disabled_shocial_share').hide();
								}else{
									jQuery('#show_social_share_btn').prop('checked',false);
									jQuery('.disabled_shocial_share').show();
								}
								
							}
							
							sqb_tiny_mce_editor_social_share();
							sqb_tiny_editor_social_share_textarea();
						}
						
					}
				});
		 }
		
	});

}


function sqb_mediauploader_social_share_tab(){
	
	jQuery(document).on('click','.share_img_upload',function() {
		console.log('click : sbq_change_img');
	   var sqb_mediauploader;
	  
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
			jQuery('.social_share_img').attr('src', attachment.url);
			jQuery('#share_image_value').val(attachment.url);
			
		});
		sqb_mediauploader.open();
	});
} 

function sqb_save_social_share(){
	
	
	
	var quiz_id = jQuery("#share_select_quiz").attr('data-value');
	if(quiz_id == '' || quiz_id == 0){
		swal("","Plase select a Quiz");
		return false;
	}
	
	var share_text = jQuery("#share_text").val();
	if(share_text	 == '' ){
		swal("","Enter Share Title");
		return false;
	}
	
	//var fb_share_details =   tinymce.get("fb_share_details").getContent();
	var fb_share_details =   jQuery('#fb_share_details').val();
	if(fb_share_details	 == '' ){
		swal("","Enter Facebook Details");
		return false;
	}
	
	//var tw_share_details =  tinymce.get("tw_share_details").getContent(); 
	var tw_share_details =  jQuery('#tw_share_details').val(); 
	if(tw_share_details	 == '' ){
		swal("","Enter Twitter Details");
		return false;
	}
	
	var share_image_value = jQuery('#share_image_value').val();
	
	if(share_image_value == ''){
		swal("","Please upload Image");
		return false;
	}
	
	var show_social_share_btn = jQuery('#show_social_share_btn').prop('checked');
	if(show_social_share_btn){
		show_social_share_btn = 1;
	}else{
		show_social_share_btn = 0;
	}
	
	
	
	var share_url = jQuery("#share_url").val();
	
	if(share_url == ''){
		swal("","Enter Share URL");
		return false;
	}
	
	var html = jQuery(".customize_social_share_wrapper_html").html();
	html  = encodeURIComponent(html);
	fb_share_details  = encodeURIComponent(fb_share_details);
	tw_share_details  = encodeURIComponent(tw_share_details);
	
	var social_share_fb_api_key = jQuery('#fb_api_key').val();
	if(social_share_fb_api_key == ''){
		swal("","We noticed that you have not entered a Facebook App ID in the settings page.","");
		jQuery("#fb_api_key").focus();	
		return false;
	}
	var share_image_value_extension = share_image_value.substring(share_image_value.lastIndexOf('.') + 1); 
	if(share_image_value_extension == 'gif'){
		swal("","Sorry, can't share gifs. Please upload a different image","");
		return false;
	}
	
	
	jQuery('.sqb_save_social_share_btn').text('Please Wait...');
	jQuery.ajax({	 
			url: ajaxurl,	 
			type: "POST",
			data: {
				action: 'sqb_save_social_share',
				//form_data : form_data
				quiz_id: quiz_id,
				share_text: share_text ,		 
				fb_share_details: fb_share_details ,		 
				tw_share_details: tw_share_details ,	
				share_image_value: share_image_value,	
				share_url: share_url,	
				show_social_share_btn: show_social_share_btn,	
				social_share_fb_api_key: social_share_fb_api_key,	
				html: html,	
			},
			success: function (response) {	
				response = JSON.parse(response);		 
				console.log(response);
				jQuery('.sqb_save_social_share_btn').text('Save');
			}
	});		
	
}
