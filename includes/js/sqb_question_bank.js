//sqb_tiny_mce_editor();


//function sqb_get_question_details($quiz_type){
		/*jQuery.post(ajaxurl, {
				action: 'sqb_show_question_by_type',
				quiz_type: $quiz_type,   
		}, function(response) {
			response = JSON.parse(response);
		});*/

		//jQuery('.sqb--selection-options .sqb--selection-item').removeClass('sqb--selection-item-selected');
		//jQuery(this).addClass('sqb--selection-item-selected');

		//jQuery('.manage_question_wrapper').find('.'+$quiz_type).show();

//	}

jQuery(document).ready(function(){

// sqb_get_question_details('personality');
	jQuery('.sqb--selection-item').on('click', function(){
		jQuery('.sqb--selection-item').removeClass('sqb--selection-item-selected');
		jQuery(this).addClass('sqb--selection-item-selected');

		var quiz_type = jQuery(this).attr('data-type');
		console.log(quiz_type);
		jQuery('.manage_question_wrapper .table-responsive').hide();
		jQuery('.manage_question_wrapper').find('.'+quiz_type).show();

		jQuery('html,body').animate({
        scrollTop: jQuery(".manage_question_wrapper").offset().top},
        'slow');
	});


	jQuery('.close_Side_Popup').on('click', function(){
		jQuery('.show-quiz-side-popup').removeClass('active_Side_Popup');
	});

	jQuery('.sqb-quiz-question').on('click', function(){
		SQBShowLoader();
		var question_id = jQuery(this).attr('data-questionid');

		jQuery.post(ajaxurl, {
				action: 'sqb_get_quiz_by_question_id',
				question_id: question_id,  
				dataType: 'json', 
		}, function(response) {
			SQBHideLoader();
			get_response = JSON.parse(response);
			var question_title = get_response['question_title'];
			jQuery('.question-title').html(question_title);
			jQuery('.show-quiz-side-popup').addClass('active_Side_Popup');
			var site_url = jQuery('#site-url').val();
			var get_title = '<div class="table-responsive"><table class="sqb_manage_leads_table table" style="width:100%"><thead><tr><th class="">Quiz Name</th><th>Action</th></tr></thead><tbody>';
			// console.log(get_response.titl);
			jQuery.each(get_response, function(key,value) {
				if(key == 'question_title'){
					return;
				}
			   get_title += '<tr><td>'+get_response[key].title+'</td> <td><div class="action-icon_btn text-center"><a title="Edit Quiz" href="'+site_url+'/wp-admin/admin.php?page=sqb_add_quiz&id='+get_response[key].id+'&question_tab=quiz-question-screen&quesId='+question_id+'" class="ManageQuiz-action-btn item-edit-btn"><i class="fa fa-pencil" aria-hidden="true" style=""></i></a><a class="ManageQuiz-action-btn item-view-btn sqb-quiz-answer ml-1" data-quizid="'+get_response[key].id+'" title="View Quiz" href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true"></i></a></div></td></tr>';
			});
			get_title += '</tbody></table></div>';

			jQuery('.quiz-title').empty();
			jQuery('.quiz-title').append(get_title);
		});
	});


	jQuery(document).on('click',".sqb-quiz-answer",function(){
		var quiz_id = jQuery(this).attr('data-quizid');
		jQuery('.sqb_loading_wrapper').show();	 
		jQuery.post(ajaxurl, {
			action: 'sqb_preview_quiz',
			quiz_id: quiz_id,
			
		}, function(response) {		
			jQuery('.sqb_loading_wrapper').hide();	 

			var get_iframe = JSON.parse(response);
			jQuery('.sqb-preview-quiz-modal').html(get_iframe);
			jQuery('#question_screen').addClass('openpreview_question_display');
			
		});
	});

	jQuery(document).on('click',".close",function(){
		jQuery('#question_screen').removeClass('openpreview_question_display');
	});



	/*--------------------------------------------------------------------------------------*/



	jQuery(document).on('click','.add_new_ques', function(){
		jQuery('.manage_question_wrapper').hide();
		jQuery('.add_question_wrapper').show();
	});
	jQuery(document).mouseup(function(e){
	    var container = jQuery(".dropdown-custom-style");
	    if (!container.is(e.target) && container.has(e.target).length === 0) 
	    {
	        container.find(".dropdown-menu.question_type_list_ul").removeClass('newshowcls');
	        container.find(".dropdown-menu.question_type_list_ul").removeClass('show');
	    }
	});

	jQuery('.question_type_list_ul li a').on('click', function(){
		var ques_type = jQuery(this).attr('data-value');
		jQuery('.dropdown-toggle').attr('data-value',ques_type);
		jQuery('.question_add_answer_outer_div').empty();
		jQuery(".dropdown-menu.question_type_list_ul").toggleClass('newshowcls');
        jQuery(".dropdown-menu.question_type_list_ul").toggleClass('show');
		jQuery('.sqb_addNewQuestion').trigger('click');
	});

	jQuery(document).on('click', '.dropdown-toggle' , function(event){
   	 	event.preventDefault();
		event.stopImmediatePropagation();
		jQuery(this).next(".dropdown-menu.question_type_list_ul").toggleClass('newshowcls');	
		jQuery(this).next(".dropdown-menu.question_type_list_ul").toggleClass('show');	
		
	});	

	jQuery(document).on('click','.sqb_addNewQuestion',function(){
		var ques_type = jQuery('.dropdown-toggle').attr('data-value');
		
		var sqb_datetime = new Date();
		var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
		var site_url = jQuery('#site-url').val();
		var sqb_ans_empty_img = site_url+'/wp-content/plugins/smartquizbuilder/includes/images/sqb_empty.jpg';
		var currect_ans_checkbox_show = "style='display:none'"; 
		var points_ans_checkbox_show = "style='display:none'"; 
		var show_ans_box_for_scroing_and_assessment  = "style='display:none'"; 
		if(ques_type == "single"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			//var ans_box = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><input type='radio' name='sqb_ans' class='sqb_and_field sqb_input_ans_field'><div class='sql_ans_text sqb_tiny_mce_editor'><div>Type Answer Here</div></div><input type='radio' title='Check the box for correct answer' name='sqb_is_right_ans' class='sqb_and_field sqb_is_right_ans'><input type='text'  name='ans_poins' title='Enter Ans Points'><span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-trash-o' aria-hidden='true'></i></span></div>";
			var ans_box = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div>Type Answer Here</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			
			//parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
			
		}else if(ques_type == "multi"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			
			
			var ans_box = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div>Type Answer Here</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			
			//parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
			
		
		}else if(ques_type == "yes_no"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}

			if(already_added_answer > 1 ){
				return false;
			}*/
			var ans_box = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div>Yes</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
			 ans_box += "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div>No</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			
			//parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
			
		
		}else if(ques_type == "rating"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}
			var ranting_alignment_text = ' style="text-align: center;"';
			parent_obj.find('.question_add_answer_outer_div').removeClass('ranting_level_1 ranting_level_2 ranting_level_3 ranting_level_4 ranting_level_5 ranting_level_6 ranting_level_7 ranting_level_8 ranting_level_9');   */
			
			/*if(already_added_answer >= 1 ){
				var answer_rating_no = already_added_answer+1;
				var ans_box = "<div class='sqb_ans_item ans_type_rating' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div "+ranting_alignment_text+" >"+(already_added_answer+1)+"</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
				if(answer_rating_no < 10){
					parent_obj.find('.question_add_answer_outer_div').addClass('ranting_level_'+answer_rating_no);   
				}
				
			}else if(already_added_answer == 0){*/
				var ans_box = "<div class='sqb_ans_item ans_type_rating' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div "+ranting_alignment_text+">1</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
				var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
				ans_box += "<div class='sqb_ans_item ans_type_rating' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div "+ranting_alignment_text+">2</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
				var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
				ans_box += "<div class='sqb_ans_item ans_type_rating' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div "+ranting_alignment_text+">3</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
				var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
				ans_box += "<div class='sqb_ans_item ans_type_rating' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div "+ranting_alignment_text+">4</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
				var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
				ans_box += "<div class='sqb_ans_item ans_type_rating' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div "+ranting_alignment_text+">5</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
				/*parent_obj.find('.question_add_answer_outer_div').addClass('ranting_level_5');   
			}*/
			
			
		}else if(ques_type == "text"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			var ans_box = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><textarea class='sqb_and_field sqb_input_ans_field sqb_textarea_ans_field' name='sqb_ans_"+sqb_round_no+"' placeholder='Enter the text here' ></textarea><span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			//parent_obj.find('.question_add_answer_outer_div').html('');
			//parent_obj.find('.question_add_answer_outer_div').addClass('sqb_disable_tiny_mce_editor');
			//sqb_placeholder_editable();
			
		}else if(ques_type == "fill_in_blank"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			var ans_box = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><input type='text' class='sqb_and_field sqb_input_ans_field sqb_fill_in_blank_ans_field' name='sqb_ans_"+sqb_round_no+"' placeholder='Enter the text here' ><span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			//parent_obj.find('.question_add_answer_outer_div').html('');
			//parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
		}else if(ques_type == "slider"){
			var ans_box = "<div class='sqb_ans_item sqb_ans_item_slider' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><span class='answer_slider_options_show sqb_backend_show '>Click to customize</span> <div class='type-slider-outer'><input name='sqb_ans_"+sqb_round_no+"' id='sqb_ans_slider_"+sqb_round_no+"' class='slider sqb_ans_slider' data-slider-id='ex1Slider' type='text' data-slider-min='0' data-slider-max='100' data-slider-step='1' data-slider-value='0' top_box_b_clr='#333'  suffix_text='%' prefix_text ='' complete_bar_b_clr='#333' slider_b_clr= '#fff'><div class='slider_label sqb_tiny_mce_editor '><div class='slider_label_start' style='text-align: left;'>start</div> <div class='slider_label_middle' style='text-align: center;'>middle</div><div class='slider_label_end' style='text-align: right;'>end</div></div></div><span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			
			//parent_obj.find('.question_add_answer_outer_div').html('');
			//parent_obj.find('.question_add_answer_outer_div').addClass('sqb_disable_tiny_mce_editor');
		
		}else if(ques_type == "matrix"){			
			//var parent_selector = jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div').find('.answer_matrix_save_table');
			//if(parent_selector.find('.SQB-main-table').length == 0){
				var ans_box = "<div class='sqb_ans_item_matrix' ><span class='answer_matrix_options_show sqb_backend_show '>Click To Add/Edit Answer</span><div class='answer_matrix_save_table'></div></div>";
				//parent_obj.find('.question_add_answer_outer_div').html('');
			//}
			
			//parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
			//parent_obj.find('.question_add_answer_outer_div').addClass('answer-type-matrix-selected');
			//parent_obj.find('.question-type-card.question_type_wrapper').addClass('answer-type-matrix-selected');
			
		}else if(ques_type == "file_upload"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			var ans_box = "<div class='sqb_ans_item file-upload-wrapper' data-id='%%ANSWERID%%' id='"+sqb_round_no+"' style='padding: 0px'><div class='file-upload'><div class='file-upload-message'><i class='fa fa-cloud-upload' aria-hidden='true'></i><div class='sqb_tiny_mce_editor'>Drag and drop a file here or click</div><p class='file-upload-error'>Ooops, something wrong happended.</p></div><input type='file' name='sqb_file_upload' class='sqb_file_upload'><div class='file-upload-preview'><span class='file-upload-render'><img class='file-upload-preview-img' src=''></span><div class='file-upload-infos'><div class='file-upload-infos-inner'><p class='file-upload-filename'><span class='file-upload-filename-inner'>about.jpg</span></p><p class='file-upload-infos-message'>Drag and drop or click to replace</p></div></div></div></div><label class='uploadedFileName1 uploadedFileNamePre' style='display:none'></label></div>";
			//parent_obj.find('.question_add_answer_outer_div').html('');
			//parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
			
			
			jQuery('#question_file_upload').modal('show');
			if(jQuery('.sqb_question_no.active').find('input[name="question_file_upload_settings"]').val() == ''){
			jQuery('#question_file_upload').find('input[type="checkbox"]').prop('checked',false);
			}//question_file_upload_settings db column in questions_bank

			var file_setting_value = jQuery('.sqb_question_no.active').find('input[name="question_file_upload_settings"]').val();
			if (file_setting_value != '') {
				var file_settings = file_setting_value.split('|');
				var documents_arr = file_settings[0];
				jQuery.each(documents_arr.split(','), function(index, item) {
					if(jQuery('.file_type_doc:eq('+index+')').val() == item){
					jQuery('.file_type_doc:eq('+index+')').prop('checked',true);
					} else {
					jQuery('.file_type_doc:eq('+index+')').prop('checked',false);
					}
				});
				
				var images_arr = file_settings[1];
				jQuery.each(images_arr.split(','), function(index, item) {
					if(jQuery('.file_type_img:eq('+index+')').val() == item){
					jQuery('.file_type_img:eq('+index+')').prop('checked',true);
					} else {
					jQuery('.file_type_img:eq('+index+')').prop('checked',false);
					}
				});
				
				
				var video_arr = file_settings[2];
				jQuery.each(video_arr.split(','), function(index, item) {
					if(jQuery('.file_type_video:eq('+index+')').val() == item){
					jQuery('.file_type_video:eq('+index+')').prop('checked',true);
					} else {
					jQuery('.file_type_video:eq('+index+')').prop('checked',false);
					}
				});
				
				
				var audio_arr = file_settings[3];
				jQuery.each(audio_arr.split(','), function(index, item) {
					if(jQuery('.file_type_audio:eq('+index+')').val() == item){
					jQuery('.file_type_audio:eq('+index+')').prop('checked',true);
					} else {
					jQuery('.file_type_audio:eq('+index+')').prop('checked',false);
					}
				});
				jQuery('#maxFileUploadSize').val(file_settings[4]);
			}
			
		}else if(ques_type == "ranking_choices"){
			/*if(quiz_type  == 'calculator'){
				show_ans_box_for_scroing_and_assessment = 'style="display:none"';
			}*/
		var ans_box = "<div class='sqb_ans_item ans_type_ranking_choices' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div>Type Answer Here</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
		//parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
		//parent_obj.find('.Quiz-Template-content.question_description').html('<div>Your users can re-order the answers choices based on their preference using a drag/drop interface in the frontend.</div>').show();
		}else{
			//sqb_sweet_message('','Question type is wrong!','');
			return false;
		}

		jQuery('.question_add_answer_outer_div').append(ans_box);

	});

});


function sqb_save_question_bank(){
	var question_type = jQuery('.dropdown-toggle').attr('data-value');
	var question_html = jQuery('.question_details').html();
	var question_title = jQuery('.question_title').text();


	if(jQuery(this).find('.question_add_answer_outer_div .sqb_ans_item').length > 0){
		jQuery(this).find('.question_add_answer_outer_div .sqb_ans_item').each(function(index){
			var answer_id = jQuery(this).attr('data-id');
			var answer_wrapper_id = jQuery(this).attr('id');
			var answer_title = jQuery(this).find('.sql_ans_text').text();



			answer_array.push({
				'ans':ans_html2,
				'order' : index,
				'correct_ans' : sqb_is_right_ans,
				'ans_point' : ans_poins,
				'ans_hint' : ans_hint,
				'ans_info' : ans_info,
				'answer_id' : answer_id,  
				'answer_title' : answer_title,  
				'answer_wrapper_id' : answer_wrapper_id,
				'matrix_values' : matrix_values,  
			});
		});
	}


	var form_data = {
					question_type:  question_type,
					question_html:  question_html,
					question_title: question_title
				}

	jQuery.post(ajaxurl, {
					action: 'sqb_save_question_bank',
					form_data: form_data,   
			}, function(response) {
				
				response = JSON.parse(response);

			});
}

