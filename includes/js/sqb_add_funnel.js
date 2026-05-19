jQuery(document).ready(function(){
 	
 	jQuery(".funnel-search").keyup(function () {
	    var filter = jQuery(this).val();
	    jQuery(".enter_funnel_name_select a").each(function () {
	        if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
	            jQuery(this).hide();
	        } else {
	            jQuery(this).show()
	        }
	    });
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
		
	jQuery(document).on('click', '#funnel_enable_branching', function(){
		if(jQuery(this).prop('checked') == true){

		 	var enter_funnel_name_select =  jQuery("#enter_funnel_name_select-id").attr('data-value');
			var	funnel_enable_branching = 'Y';
			var data_export = JSON.stringify(editor.export());
			var data_export_array = editor.export();	
	 		SQBShowLoader();
			jQuery.post(ajaxurl, {
					action: 'sqb_save_funnel_quiz_data',
					quiz_id : enter_funnel_name_select,
					data_export: data_export,
					funnel_enable_branching: funnel_enable_branching,
					async : true,
			}, function(response) {
 				SQBHideLoader();
				var response = jQuery.parseJSON(response);
				if(response.success){
					swal("","Quiz funnel activated successfully","");
				}
			});
		}else{
			var enter_funnel_name_select =  jQuery("#enter_funnel_name_select-id").attr('data-value');
			var	funnel_enable_branching = 'N';
			var data_export = JSON.stringify(editor.export());
			var data_export_array = editor.export();	
	 		SQBShowLoader();
			jQuery.post(ajaxurl, {
					action: 'sqb_save_funnel_quiz_data',
					quiz_id : enter_funnel_name_select,
					data_export: data_export,
					funnel_enable_branching: funnel_enable_branching,
					async : true,
			}, function(response) {
 				SQBHideLoader();
				var response = jQuery.parseJSON(response);
				if(response.success){
					swal("","Quiz funnel deactivated successfully","");
				}
			});
		}
	});


 jQuery('.enter_funnel_name_select .dropdown-menu a').on('click',function(){
	 var text_funnel_id =  jQuery(this).attr('data-value');
	 var text_funnel_text = jQuery(this).text();
	 jQuery("#enter_funnel_name_select-id").text(text_funnel_text);
	 jQuery("#enter_funnel_name_select-id").attr('data-value',text_funnel_id);
	  sqb_load_funnel();
 });
		
 
	
	
});	



function sqb_funnel_tiny_editor() {
	 tinymce.init({
        selector: '.sqb_tiny_editor, .sqb_tiny_mce_editor',
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
        plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak', 'searchreplace wordcount visualblocks visualchars code fullscreen', 'insertdatetime media nonbreaking save table contextmenu directionality', 'emoticons template paste textcolor colorpicker textpattern imagetools'],
        toolbar1: 'insertfile undo redo | styleselect | bold italic |  fontselect | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
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
	
function sqbAppendQuestionScreen(i, nodeNumArg, appendfromprev, quizFunnelClass, mainQuizClass, pos_x, pos_y, ans_box = ''){
		var funnelId = jQuery('.funnelId').val();
		var j = i+1;
		var k = i-1;
		var html = '';
		
		var existing_question = '<a class="dropdown-item existing_question_btn"  data-appendfromprev="'+appendfromprev+'"  data-parent="ul_question_add_answer_btn_div'+i+'" href="#">Existing Question</a>';
		
		if(i == 1){
			existing_question = '';	
		}
	
		html += ' <div class="funnel-option-list" data-posx="'+pos_x+'" data-posy="'+pos_y+'"><div data-funnelid="'+funnelId+'"  data-level="'+i+'" data-parentnodeid="'+k+'" data-parentanswerid="'+k+'" class="quiz-funnel-input '+mainQuizClass+' funnel_node'+i+'  firstTemplateSelect'+j+'"><span class="sqb_funnel_remove_section"><i class="fa fa-times" aria-hidden="true"></i></span>';
		if(jQuery('.funnel_node'+i).length == 0){
			html += '<h4 class="quizfunnel-node-id">Node # '+nodeNumArg+'</h4>';
			nodeNum = nodeNumArg + 1;
		}
		
		html += '<div class="Quizfunnel-Template-outer"><div class="Quizfunnel-Template funnelQuestLevel'+i+'" style=""><div class="Quizfunnel-Template-title question_title sqb_tiny_editor"><div>Untitle Quiz</div></div><div class="Quizfunnel-Template-image"><img class="" src=""><span data-class="" class="question_img_upload"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="Quizfunnel-Template-content"><div class="sqb_tiny_editor">Type Description Here</div></div><div class="Quizfunnel_question_add_answer_outer"><div class="question_add_more_ans_btn"data-level="'+i+'"  data-funnelid="'+funnelId+'" data-parentnodeid="'+k+'" data-parentanswerid="'+k+'" data-appendfromprev="'+appendfromprev+'"  data-parent="ul_question_add_answer_btn_div'+i+'" data-posx="'+pos_x+'" data-posy="'+pos_y+'">Click To Add Answer</div>'+ans_box+'</div><div data-id="firstTemplateSelect'+i+'" class="Template-popup-link selecteTemplateModalBtn dropdown"><button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Action</a><a data-id="firstTemplateSelect'+j+'" class="switchScreenBtn" data-level="'+i+'" data-funnelid="'+funnelId+'">Switch Screen</a>'+existing_question+'</div></div> </div></div></div></div>';	
		return html;
}

function sqbAppendOptinResultScreen(i, nodeNumArg, appendfromprev, response){
	var funnelId = jQuery('.funnelId').val();
	var j = i+1;
	var k = i-1;
	var html = '';

	html += ' <li class="funnel-option-list"><div data-funnelid="'+funnelId+'"  data-level="'+i+'" data-parentnodeid="'+k+'" data-parentanswerid="'+k+'" class="quiz-funnel-input  funnel_node'+i+'  firstTemplateSelect'+j+'"><span class="sqb_funnel_remove_section"><i class="fa fa-times" aria-hidden="true"></i></span>';
	if(jQuery('.funnel_node'+i).length == 0){
		html += '<h4 class="quizfunnel-node-id">Node # '+nodeNumArg+'</h4>';
		nodeNum = nodeNumArg + 1;
	}	
	
	html += response+'<div data-id="firstTemplateSelect'+i+'" class="Template-popup-link selecteTemplateModalBtn dropdown"><button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Action</a><a data-id="firstTemplateSelect'+j+'" class="switchScreenBtn" data-level="'+i+'" data-funnelid="'+funnelId+'">Switch Screen</a><a class="dropdown-item" href="#">Something else here</a></div></div> </div></div></div><ul class="funnel-sub-options ul_question_add_answer_btn_div'+j+' ul_question_add_answer_btn_div"></ul></li>';
	
	return html;
}

function sqbAppendScreenDropDown(i, nodeNumArg, appendfromprev){
		var funnelId = jQuery('.funnelId').val();
		var j = i+1;
		var k = i-1;
		var html = '';
		
		html = ' <li class="funnel-option-list"><div data-funnelid="'+funnelId+'"  data-level="'+i+'" data-parentnodeid="'+k+'" data-parentanswerid="'+k+'" class="quiz-funnel-input funnel_node'+i+'  firstTemplateSelect'+j+'">';
		if(jQuery('.funnel_node'+i).length == 0){
			html += '<h4 class="quizfunnel-node-id">Node # '+nodeNumArg+'</h4>';
			nodeNum = nodeNumArg + 1;
		}
		
		html += '<div class="Quizfunnel-Template-outer"><div class="funnelQuestLevel'+i+'" style=""><select class="selectScreenTemplate"  data-level="'+i+'"  data-funnelid="'+funnelId+'" data-parentnodeid="'+k+'" data-parentanswerid="'+k+'" data-appendfromprev="'+appendfromprev+'"  data-parent="ul_question_add_answer_btn_div'+i+'"><option value="">Select Template</option><option value="qatemplate">Question/Answer</option><option value="opt-in">Opt-In Template</option><option value="result">Result Template</option></select></div> <a class="Template-popup-linkselecteTemplateModalBtn"  data-id="firstTemplateSelect'+i+'">...</a></div></div><ul class="funnel-sub-options ul_question_add_answer_btn_div'+j+' ul_question_add_answer_btn_div"></ul></div></li>';	
		return html; 
}


function sqbGetTemplateHtml(templateType, num,  nextlevel, nodeNumArg, appendfromprev){
	if(templateType == 'qatemplate'){
		var  html = sqbAppendQuestionScreen(nextlevel, nodeNumArg, appendfromprev);
		return html;
	}else{
	
		var temp = num;
		var quiz_temp = templateType;
		jQuery.post(ajaxurl, {
					action: 'sqb_get_funnel_temp',
					temp: temp,
					quiz_temp: quiz_temp,
		}, function(response) {
			var response = jQuery.parseJSON(response);
			
			//response = '<div class="quiz-funnel-input main-question-block"><button data-id="'+selectTemplateModal+'" class="switchScreenBtn" data-level="1" data-funnelid="'+funnelId+'">Switch Screen</button>'+response+'<a class="Template-popup-link selecteTemplateModalBtn"  data-id="'+selectTemplateModal+'">...</a><button class="appendNextNode" data-level="1" data-funnelid="'+funnelId+'">Next</button></div>';
			//jQuery('.'+selectTemplateModal).find('.start_temp_container').html(response);
			var prevLevel = nextlevel - 2;
			var  html = sqbAppendOptinResultScreen(nextlevel, nodeNumArg, appendfromprev, response);
		//	jQuery('.'+appendfromprev).find('.ul_question_add_answer_btn_div'+prevLevel).html(html);
		//alert(templateType);
			if(templateType == 'opt-in'){
				jQuery('.optinTemplate1').html(html);
			}else if(templateType == 'result'){
				jQuery('.resultTemplate1').html(html);	
			}
			//return html;
			
		//	jQuery('#Quizfunnel-Template-select').modal('hide');
			
		});	
	}	
}


function sqbAppendExistingQuestion(questiondiv, appendfromprev, parent, questid){
		
}


function zoomIn(){
	var zoom = jQuery('.allNodesMainOuterWrapper').css('zoom');
	jQuery('.allNodesMainOuterWrapper').css('zoom' , parseFloat(zoom) + parseFloat('0.10'));
	return false;
}

function zoomOut(){
	var zoom = jQuery('.allNodesMainOuterWrapper').css('zoom');
	if(zoom > '0.3'){
		jQuery('.allNodesMainOuterWrapper').css('zoom' , zoom - '0.10');
	}
	return false;
}


function sqbGetStartTemplate(){
	var temp = 'template1';
			var quiz_temp = 'start';
			jQuery.post(ajaxurl, {
						action: 'sqb_get_funnel_temp',
						temp: temp,
						quiz_temp: quiz_temp,
						async : true,
			}, function(response) {
				var response = jQuery.parseJSON(response);
				
				jQuery('.startTemplate1').html(response);
				
				/*response = '<div class="quiz-funnel-input main-question-block"><span class="sqb_funnel_remove_section"><i class="fa fa-times" aria-hidden="true"></i></span>'+response+'<div  class="Template-popup-link dropdown"><button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item selecteTemplateModalBtn" data-id="firstTemplateSelect1" href="#">Select START Template</a><a data-id="firstTemplateSelect1" class="switchScreenBtn dropdown-item" data-level="1" data-funnelid="'+response.id+'">Switch Screen</a><a data-id="firstTemplateSelect1" class="dropdown-item deleteNode" href="#">Delete Node</a></div><button class="appendNextNode" data-level="1" data-funnelid="'+response.id+'"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></div></div><ul class="funnel-sub-options ul_question_add_answer_btn_div1 ul_question_add_answer_btn_div"></ul></div></div></div>';*/
				//jQuery('.'+selectTemplateModal).find('.start_temp_container').html(response);

				//jQuery('#Quizfunnel-Template-select').modal('hide');   
				return response;
				
				//sqb_funnel_tiny_editor();
			});		
}




function sqb_funnel_reset_connections(){
	
	
	 var id =  jQuery("#enter_funnel_name_select-id").attr('data-value');
	 
	 if(id == '' || id == 0){
		 swal("","Plase select Quiz","");
		 return false;
	 }
	 swal({
			 // title: "Are you sure?",
			  text: "Do you want to reset connections?",
			  icon: "warning",
			  className : "funnel_branching_enable_confrim_box",
			  icon: "warning",
			   buttons: {
			  	cancel: "No",
			  	confirm: "Yes",
				},
			  dangerMode: true,
			}).then((isConfirm) => {
				if (isConfirm) {
	 
	 SQBShowLoader();
	 jQuery('.sqb_funnel_save_btn').hide();
	 jQuery('.sqb_funnel_reload_and_reset_question_btn').hide();
	 jQuery('.funnel_enable_branching_toggle_btn').hide(); 
		
		if(id != '' && id != 0){
			
			jQuery.post(ajaxurl, {
					action: 'sqbGetDataForQuiz',
					id: id,
					'reset_connections': 'yes',
			}, function(response) {
				SQBHideLoader();
				//console.log(response);
					var response = jQuery.parseJSON(response);
					//console.log(response);
					jQuery('#drawflow').html('');
					if(response.success){
						
						jQuery('#drawflow').removeAttr('class')
						jQuery('#drawflow').addClass('parent-drawflow');
						if(response.max_funnel_questions_active){
							jQuery('#drawflow').addClass('max_funnel_questions_active');
						}else{
							jQuery('#drawflow').removeClass('max_funnel_questions_active');
						}
						
						sqbCreateBranch(JSON.stringify(response.drawflowArr));	
						 editor.zoom_out();
						 editor.zoom_out();
						jQuery('.sqb_funnel_save_btn').show();
						jQuery('.sqb_funnel_reload_and_reset_question_btn').show();
						if(response.enable_branching && (response.enable_branching == 'Y')){
							jQuery('input#funnel_enable_branching').prop('checked',true);
							jQuery('.funnel_enable_branching_toggle_btn').show();
						}else{
						    jQuery('input#funnel_enable_branching').prop('checked',false);
							jQuery('.funnel_enable_branching_toggle_btn').show();
						}
						
						if(response.message){
							swal("",response.message,"");
						}
						
					}
			});
		}else{
			//show alert	
		}
	}
	});
	
}
	


function sqb_reload_and_reset_question(){
	
	
	 var id =  jQuery("#enter_funnel_name_select-id").attr('data-value');
	 
	 if(id == '' || id == 0){
		 swal("","Plase select Quiz","");
		 return false;
	 }
	 
	 jQuery('.sqb_funnel_save_btn').hide();
	 jQuery('.sqb_funnel_reload_and_reset_question_btn').hide();
	 jQuery('.funnel_enable_branching_toggle_btn').hide(); 
		
		if(id != '' && id != 0){
			SQBShowLoader();
			jQuery.post(ajaxurl, {
					action: 'sqbGetDataForQuiz',
					id: id,
					'reload_fresh': 'yes',
			}, function(response) {
				SQBHideLoader();
				//console.log(response);
					var response = jQuery.parseJSON(response);
					//console.log(response);
					jQuery('#drawflow').html('');
					if(response.success){
						
						jQuery('#drawflow').removeAttr('class')
						jQuery('#drawflow').addClass('parent-drawflow');
						if(response.max_funnel_questions_active){
							jQuery('#drawflow').addClass('max_funnel_questions_active');
						}else{
							jQuery('#drawflow').removeClass('max_funnel_questions_active');
						}
						  
						sqbCreateBranch(JSON.stringify(response.drawflowArr));	
						 editor.zoom_out();
						 editor.zoom_out();
						jQuery('.sqb_funnel_save_btn').show();
						jQuery('.sqb_funnel_reload_and_reset_question_btn').show();
						if(response.enable_branching && (response.enable_branching == 'Y')){
							jQuery('input#funnel_enable_branching').prop('checked',true);
							jQuery('.funnel_enable_branching_toggle_btn').show();
						}else{
						    jQuery('input#funnel_enable_branching').prop('checked',false);
							jQuery('.funnel_enable_branching_toggle_btn').show();
						}
						
						if(response.message){
							swal("",response.message,"");
						}
						
					}
			});
		}else{
			//show alert	
		}
	
}
	
	
function sqb_load_funnel(){
	
	
		
		var id =  jQuery("#enter_funnel_name_select-id").attr('data-value');
	 
		if(id == '' || id == 0){
			 swal("","Plase select Quiz","");
			 return false;
		}
		 
		jQuery('.sqb_funnel_save_btn').hide();
		jQuery('.sqb_funnel_reload_and_reset_question_btn').hide();
		jQuery('.funnel_enable_branching_toggle_btn').hide();  
		
		if(id != '' && id != 0){
			SQBShowLoader();
			jQuery.post(ajaxurl, {
					action: 'sqbGetDataForQuiz',
					id: id,
					'reload_fresh': 'yes',
			}, function(response) {
				SQBHideLoader();
				//console.log(response);
				jQuery('.sqb_funnel_reload_and_reset_question_btn').show();
					var response = jQuery.parseJSON(response);
					//console.log(response);
					jQuery('#drawflow').html('');
					
					if(response.success){


						
						jQuery('#drawflow').removeAttr('class')
						jQuery('#drawflow').addClass('parent-drawflow');
						if(response.max_funnel_questions_active){
							jQuery('#drawflow').addClass('max_funnel_questions_active');
						}else{
							jQuery('#drawflow').removeClass('max_funnel_questions_active');
						}
						
						sqbCreateBranch(JSON.stringify(response.drawflowArr), response);	
						
						 editor.zoom_out();
						 editor.zoom_out();
						jQuery('.sqb_funnel_save_btn').show();
						jQuery('.sqb_funnel_reload_and_reset_question_btn').show();
						
						if(response.enable_branching && (response.enable_branching == 'Y')){
							jQuery('input#funnel_enable_branching').prop('checked',true);
							jQuery('.funnel_enable_branching_toggle_btn').show();
						}else{
						    jQuery('input#funnel_enable_branching').prop('checked',false);
							jQuery('.funnel_enable_branching_toggle_btn').show();
						}
						
					}
			});
		}else{
			//show alert	
		}
			
	
	
}

function sqb_funnel_save(data = ''){
	var enter_funnel_name_select =  jQuery("#enter_funnel_name_select-id").attr('data-value');
	var funnel_enable_branching = jQuery('#funnel_enable_branching').prop('checked');
	if(enter_funnel_name_select == '' || enter_funnel_name_select == 0){
		swal('','Please select quiz','');
		return false;
	}
	if(funnel_enable_branching){
		sqb_funnel_save_data();
	}else{	
		swal({
			// title: "Are you sure",
			text: "Do you want to activate this funnel?",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			customClass: 'funnel_branching_enable_confrim_box',
		}).then((result) => {
			if (result.value) {
				jQuery('#funnel_enable_branching').prop('checked',true);
				sqb_funnel_save_data();
			}else{
				jQuery('#funnel_enable_branching').prop('checked',false);
			}
		});
	}
}

function sqb_funnel_save_data(){
	
	    var enter_funnel_name_select =  jQuery("#enter_funnel_name_select-id").attr('data-value');
		funnel_enable_branching = jQuery('#funnel_enable_branching').prop('checked');
		if(funnel_enable_branching){
			funnel_enable_branching = 'Y';
		}else{
			funnel_enable_branching = 'N';
		}
	// funnel save start 

	console.log(editor.export());
				//JSON.stringify(editor.export(), null,4);
				var data_export = JSON.stringify(editor.export());
				// console.log(data_export);
				var data_export_array = editor.export();
				jQuery('.sqb_funnel_save_btn').text('Please Wait..');
				jQuery.post(ajaxurl, {
									action: 'sqb_save_funnel_quiz_data',
									quiz_id : enter_funnel_name_select,
									data_export: data_export,
									funnel_enable_branching: funnel_enable_branching,
									async : true,
						}, function(response) {
							var response = jQuery.parseJSON(response);
							
							//console.log(response);
							
							if(response.success){
								//swal('',response.success,'');
								jQuery('.sqb_funnel_save_btn').text('Save');
							}
				
					});
			
                // funnel save end 
	
}
