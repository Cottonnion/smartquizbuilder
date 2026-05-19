jQuery(document).ready(function(){


	jQuery(document).on("click",".sqb-remove-user-from-leaderboar", function(){

        if(confirm("Are you sure you don't want this to be listed in the leaderboard?") == true) {
            var userid = jQuery(this).attr('data-userid');
            var source = jQuery(this).attr('data-source');
            jQuery.ajax({
                type : "post",
                url : ajaxurl,
                data : {action: "sqb_lb_exclude_users",userid : userid,source : source,is_admin : true},
                success: function(response) {
                   // location.reload();
				   sqb_print_leaderboard();
                }
             });

        } else {
            return false;
        }

    });

    jQuery(document).on('click','.sqb-user-list', function() {
		setTimeout(function(){
		 	jQuery(window).resize();
		}, 200);
	});

	jQuery('.acc-container .acc:nth-child(1) .acc-head').addClass('active');
	jQuery('.acc-container .acc:nth-child(1) .acc-content').slideDown();
	jQuery(document).on('click','.acc-head', function() {
		if(jQuery(this).hasClass('active')) {
			jQuery(this).siblings('.acc-content').slideUp();
			jQuery(this).removeClass('active');
		}else {
			jQuery('.acc-content').slideUp();
			jQuery('.acc-head').removeClass('active');
			jQuery(this).siblings('.acc-content').slideToggle();
			jQuery(this).toggleClass('active');
		}
	});

	jQuery(document).on('click','.download-certificate-pdf', function(){

		var lead_id = jQuery(this).attr('data-lead-id');
		var quiz_id = jQuery(this).attr('data-quiz-id');
	   //var user_id =  $this.find('#user_id').val();
	   var formdata = [];
	   formdata.push({name: "lead_id", value: lead_id});
	   formdata.push({name: "quiz_id", value: quiz_id});
	   formdata.push({name: "outcome_id", value: 0});
	   jQuery(this).addClass('disable-button');
	   var orig_text = jQuery(this).html();
	   $this = jQuery(this);
	   $this.html('Please Wait..');
	
	   jQuery.ajax({
		  type: "POST",
		  url: '?sqb_cert_pdf_download=1',
		  data: formdata,
		  xhrFields: {
			  responseType: 'blob'
		  },
		  success: function(blob, status, xhr) {
			$this.removeClass('disable-button');
			//$this.find('.btn div').html(orig_text);
			$this.html(orig_text);
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
			  
		  }
	  });
	
	});

	jQuery('.dropdown').each(function(index, dropdown) {
		let search = jQuery(dropdown).find('.search');
		let items = jQuery(dropdown).find('.dropdown-item');
		
		jQuery(search).on('input', function() {
			filter(jQuery(search).val().trim().toLowerCase())
		});

		function filter(word) {
			let length = items.length
			let collection = []
			let hidden = 0
			
			for (let i = 0; i < length; i++) {
				if (items[i].value.toString().toLowerCase().includes(word)) {
					jQuery(items[i]).show()
				} else {
					jQuery(items[i]).hide()
					hidden++
				}
			}

			if (hidden === length) {
				jQuery(dropdown).find('.dropdown_empty').show();
			} else {
				jQuery(dropdown).find('.dropdown_empty').hide();
			}
		}
		
		jQuery(dropdown).find('.dropdown-menu').find('.menuItems').on('click', '.dropdown-item', function() {
			jQuery(dropdown).find('.dropdown-toggle').text(jQuery(this)[0].value);
			jQuery(dropdown).find('.dropdown-toggle').dropdown('toggle');
		})
	});


	jQuery('#manage_users_start_date').datepicker().datepicker("setDate", new Date());
	
	jQuery('#manage_users_end_date').datepicker().datepicker("setDate", new Date());
	
	jQuery('#manage_reports_search_start_date').datepicker().datepicker("setDate", new Date());

	jQuery('#manage_reports_search_end_date').datepicker("setDate", new Date());
	var myDate = jQuery('#manage_reports_search_end_date').datepicker('getDate'); 
	if(myDate){
    	myDate.setDate(myDate.getDate()+1); 
	}
	jQuery('#manage_reports_search_end_date').datepicker("setDate", myDate);
	
	jQuery('.sqb_manage_reports_search_table').DataTable({
		"order": [[ 2, "desc" ]],
		"bLengthChange": false,
		pageLength : 10,
		language: {
			search: false,
			searchPlaceholder: "Search..."
		},
		"fnInitComplete": function() {
			//jQuery('.Manage_leads_table').show();
		}
	});
	
	jQuery('.sqb_manage_report_search_table').DataTable({
		"order": [[ 2, "desc" ]],
		"bLengthChange": false,
		pageLength : 10,
		language: {
			search: "",
			searchPlaceholder: "Search..."
		},
		"fnInitComplete": function() {
			jQuery('.Manage_leads_table').show();
		}
	});

	
	jQuery('.sqb_manage_leads_table').DataTable({
		"order": [[ 2, "desc" ]],
		"bLengthChange": false,
		pageLength : 10,
		language: {
			search: "",
			searchPlaceholder: "Search..."
		},
		"fnInitComplete": function() {
			jQuery('.Manage_leads_table').show();
		}
	});

	if (jQuery('.sqb_manage_user_table').length){
		SQBShowLoader();
	    jQuery('.sqb_manage_user_table').DataTable({
		    'processing': true,
		    'serverSide': true,
		    'scrollX': true,
		    'language': {
		        search: "",
		        searchPlaceholder: "Search..."
		    },
		    'serverMethod': 'post',
		    'ajax': {
		        'url': ajaxurl+'?action=SQBLoadUserDataPagination',
		        'data': function (d) {
		        }
		    },
		    'columns': json_data_field,
		    'initComplete': function () {
		        SQBHideLoader();
		        setTimeout(function(){
		        	console.log('frf');
		        	jQuery(document).resize();
		        }, 500);
		    }
		}).on('preXhr.dt', function () {
		    SQBShowLoader();
		}).on('xhr.dt', function () {
		    //jQuery(window).resize();
		    SQBHideLoader();
		});
	}

	/*jQuery(document).on('click','#Quiz-reportsTab-inner li', function(){
		console.log('tgtg');
		//jQuery(window).resize();
	});*/

	jQuery('.Manage_leads_table').DataTable({
		"order": [[ 3, "desc" ]],
		"bLengthChange": false,
		pageLength : 10,
		language: {
			search: "",
			searchPlaceholder: "Search..."
		},
		"fnInitComplete": function() {
			jQuery('.Manage_leads_table').show();
		}
	});
	
	jQuery('.close_Side_Popup').click(function(){		
		jQuery('.Manage_Side_Popup').removeClass("active_Side_Popup");
		jQuery('.view-profile-link').text("View Details");
	});
	jQuery(document).on('click','.viewManageLeadUserDetails',function(){		
		jQuery(this).text("Loading...");
	});
	
	/*jQuery(document).on('click','#reports_tab .nav-tabs a ',function(){	
		var tab_id =jQuery(this).attr('href');		 
		jQuery('#reports_tab #reports-tab-content .tab-pane').removeClass('active show');
		jQuery('#reports_tab #reports-tab-content '+tab_id).addClass('active show');

	});*/
	
	/*jQuery(document).on('click' , '.filterManageLeads' , function(e){
		e.preventDefault();
		var filter_by = jQuery('#selectFilterBy-id').data('value');
		var quiz_id = jQuery('#selectStartQuiz-id').data('value');
		var quiz_type = jQuery('#selectStartQuizType-id').data('value');
		if(filter_by == 0){
			swal('Please select a filter type');
			return false;	
		}
		
		if(filter_by != 0){
			if(filter_by == 'quiz'  && quiz_id == 0){
				swal('Please select a Quiz');
				return false;	
			}else if(filter_by == 'quiz_type' && quiz_type == 0){
				swal('Please select a Quiz Type');
				return false;		
			}
		}
		SQBShowLoader();
		
		jQuery.post(ajaxurl, {
			action: 'sqb_filter_lead_data',
			filter_by: filter_by,	
			quiz_id: quiz_id,	
			quiz_type: quiz_type,
		}, function(response) {
			SQBHideLoader();
			response = JSON.parse(response);
			jQuery('.Manage_leads_table_user_details').html(response);
		});
		
	}); 
	
	*/

	jQuery(document).mouseup(function(e) 
	{
	    var container = jQuery(".dropdown .dropdown-menu");
	    if (!container.is(e.target) && container.has(e.target).length === 0) 
	    {
	        container.removeClass('show');
	    }
	});

	jQuery(document).on('change' , 'input[name="question_search"]' , function(e){
		e.preventDefault();
		var question_search = jQuery(this).val();
		jQuery('.tags-section').hide();
		if(question_search == 'specific_question'){
			jQuery('.show-question-search').show();
			jQuery('.sqb-manage-leads-searchbox-inner').hide();
			jQuery('.category-value').hide();
			jQuery('.category-section').hide();
			jQuery('.score-value').hide();
		}else if(question_search == 'all'){
			jQuery('.score-value').hide();
			jQuery('.category-value').hide();
			jQuery('.category-section').hide();
			jQuery('.show-question-search').hide();
			jQuery('.sqb-manage-leads-searchbox-inner').show();
			jQuery('.sqb_select_answer_dropdown').remove();
			jQuery('#selectStartQuizSearchQuestion-id').text('Select a Question');
			jQuery('#selectStartQuizSearchQuestion-id').attr('data-value', 0);
			jQuery('.manage_reports_search_btn').trigger('click');
		}else if(question_search == 'score_over'){
			jQuery('.score-value').show();
			jQuery('.category-section').hide();
			jQuery('.category-value').hide();
			jQuery('.show-question-search').hide();
			jQuery('.sqb-manage-leads-searchbox-inner').hide();
			jQuery('.sqb_select_answer_dropdown').remove();
			jQuery('#selectStartQuizSearchQuestion-id').text('Select a Question');
			jQuery('#selectStartQuizSearchQuestion-id').attr('data-value', 0);
		}else if(question_search == 'check_category'){
			jQuery('.category-section').show();
			jQuery('.score-value').hide();
			jQuery('.category-value').show();
			jQuery('.show-question-search').hide();
			jQuery('.sqb-manage-leads-searchbox-inner').hide();
			jQuery('.sqb_select_answer_dropdown').remove();
			jQuery('#selectStartQuizSearchQuestion-id').text('Select a Question');
			jQuery('#selectStartQuizSearchQuestion-id').attr('data-value', 0);
		}else if(question_search == 'specific_tag'){
			jQuery('.score-value').hide();
			jQuery('.category-section').hide();
			jQuery('.category-value').hide();
			jQuery('.show-question-search').hide();
			jQuery('.sqb-manage-leads-searchbox-inner').hide();
			jQuery('.sqb_select_answer_dropdown').remove();
			jQuery('#selectStartQuizSearchQuestion-id').text('Select a Question');
			jQuery('#selectStartQuizSearchQuestion-id').attr('data-value', 0);
			jQuery('.tags-section').show();
		}
	});
	jQuery('body').on('click','.selectStartQuizSearchQuestion .dropdown-item',function(e){
		e.preventDefault();
		var question_id = jQuery(this).attr('data-value');
		var question_type = jQuery(this).attr('data-question-type');
		var text = jQuery(this).text();
		var quiz_id = jQuery('#selectStartQuizSearch-id').attr('data-value');
		var start_date = jQuery('#manage_reports_search_start_date').val();
		var end_date = jQuery('#manage_reports_search_end_date').val();
		
		jQuery('#selectStartQuizSearchQuestion-id').text(text);
		jQuery('#selectStartQuizSearchQuestion-id').attr('data-value', question_id);

		if(question_type == 'date' || question_type == 'text' || question_type == 'numerical_text' || question_type == 'slider' || question_type == 'phone_number' || question_type == 'email' || question_type == 'weight_and_height'){
			jQuery('.sqb-manage-leads-searchbox-inner').show();
			jQuery('.sqb-manage-leads-searchbox-inner').html('');
			jQuery('.custom-filter-show-hide').show();
			jQuery('.sql-select_outer_section').remove('.sqb_select_answer_dropdown');
			jQuery('.sql-select_outer_section').after('<div class="sql-select_outer_section mb-3 sqb_select_answer_dropdown" style="display:none;"><div class="dropdown dropdown-custom-style selectStartQuizSearchAnswer"> <button class="dropdown-toggle" id="selectStartQuizSearchAnswer-id" aria-haspopup="true" aria-expanded="false" data-value="">Select an Answer</button> <div class="dropdown-menu" aria-labelledby="selectStartQuizSearchQuestion-id" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 42px, 0px);"></div> </div> </div>');
			jQuery('.manage_reports_search_btn').trigger('click');
		}else{
			SQBShowLoader();
			jQuery.post(ajaxurl, {
					action: 'sqb_load_search_answers',
					quiz_id: quiz_id,	
					start_date: start_date,	
					end_date: end_date,
					question_id: question_id,
			}, function(response) {
				response = JSON.parse(response);				 
				SQBHideLoader();
				if(response.result_html){
					jQuery('.sqb-manage-leads-searchbox-inner').show();
					jQuery('.sqb-manage-leads-searchbox-inner').html('');
					if(jQuery('.sqb_select_answer_dropdown').length > 0){
						jQuery('.sqb_select_answer_dropdown').remove();
					}
					jQuery('.sql-select_outer_section').after(response.result_html);
				}
			});	
		}
	});
	
	jQuery('body').on('click','.selectStartQuizSearchAnswer .dropdown-item',function(e){
		e.preventDefault();
		var answer_id = jQuery(this).attr('data-value');
		var text = jQuery(this).text();
		var question_id = jQuery('#selectStartQuizSearchQuestion-id').attr('data-value');
		
		var quiz_id = jQuery('#selectStartQuizSearch-id').attr('data-value');
		var start_date = jQuery('#manage_reports_search_start_date').val();
		var end_date = jQuery('#manage_reports_search_end_date').val();
		
		jQuery('#selectStartQuizSearchAnswer-id').text(text);
		jQuery('#selectStartQuizSearchAnswer-id').attr('data-value', answer_id);
		jQuery('.custom-filter-show-hide').show();
		jQuery('.manage_reports_search_btn').trigger('click');
		/*SQBShowLoader();
		jQuery.post(ajaxurl, {
				action: 'sqb_load_search_answers_data',
				quiz_id: quiz_id,	
				start_date: start_date,	
				end_date: end_date,
				question_id: question_id,
				answer_id: answer_id,
		}, function(response) {
			response = JSON.parse(response);				 
			SQBHideLoader();
			if(response.table_html){
				jQuery('.custom-filter-show-hide').show();
				jQuery('.sqb-manage-leads-searchbox-outer').html('');
				jQuery('.sqb-manage-leads-searchbox-outer').html(response.table_html);
				jQuery('.sqb_manage_report_search_table').DataTable({
					"order": [[ 2, "desc" ]],
					"bLengthChange": false,
					pageLength : 10,
					language: {
						search: "",
						searchPlaceholder: "Search..."
					},
					"fnInitComplete": function() {
						//jQuery('.Manage_leads_table').show();
					}
				});
			}
		});	*/
	});
	
	jQuery('.selectStartQuizSearch .dropdown-item').click(function(e){
		e.preventDefault();
		var id = jQuery(this).data('value');
		var type = jQuery(this).data('quiz-type');
		var check_category = jQuery(this).data('category');
		var text = jQuery( this).text();
		jQuery('#selectStartQuizSearch-id').text(text);
		jQuery('#selectStartQuizSearch-id').attr('data-value', id);
		jQuery('#selectStartQuizSearch-id').attr('data-type', type);
		jQuery('#selectStartQuizSearch-id').attr('data-category', check_category);
		var start_date = jQuery('#manage_reports_search_start_date').val();
		var end_date = jQuery('#manage_reports_search_end_date').val();
		var quiz_id = jQuery('#selectStartQuizSearch-id').attr('data-value');
		if(quiz_id > 0){
			SQBShowLoader();
		 	jQuery.post(ajaxurl, {
					action: 'SQBLoadquestionsByFilter',
					quiz_id: quiz_id,	
					type: type,	
					check_category: check_category,	
					start_date: start_date,	
					end_date: end_date,	

			}, function(response) {
				response = JSON.parse(response);				 
				SQBHideLoader();
				jQuery('.selectStartQuizSearch .dropdown-menu').removeClass('show');
				if(response.table_html){
					jQuery('.question-data').html('');
					jQuery('.question-data').html(response.table_html);
					jQuery('.custom-filter-show-hide').show();
				}

				if(response.table_data){
					jQuery('.sqb-manage-leads-searchbox-inner').html('');
					jQuery('.sqb-manage-leads-searchbox-inner').show();
					jQuery('.sqb-manage-leads-searchbox-inner').html(response.table_data);
					jQuery('.sqb_manage_report_search_table').DataTable({
					  	dom: 'Bfrtip',
					  	buttons: [{ extend: 'csv', text: 'Export Data', title: 'data' }],
					  	"order": [[ 2, "desc" ]],
						"bLengthChange": false,
						pageLength : 10,
						language: {
							search: "",
							searchPlaceholder: "Search..."
						},
						"fnInitComplete": function() {
							//jQuery('.Manage_leads_table').show();
						}
					});
				}

			});	
		 }/*else{
		 	jQuery('.question-data-filter').html('');
		 }*/
	});	
	
	jQuery('.selectStartQuiz .dropdown-item').click(function(e){
		e.preventDefault();
	
		var type = jQuery(this).data('value');
		var text = jQuery( this).text();
		jQuery('#selectStartQuiz-id').text(text);
		jQuery('#selectStartQuiz-id').attr('data-value', type);
	});	

	jQuery('.selectStartQuizType .dropdown-item').click(function(e){
		e.preventDefault();
	
		var type = jQuery(this).data('value');
		var text = jQuery( this).text();
		jQuery('#selectStartQuizType-id').text(text);
		jQuery('#selectStartQuizType-id').data('value', type);
	});	

	jQuery('.selectFilterBy .dropdown-item').click(function(e){
		e.preventDefault();
		var selectFilterBy = jQuery(this).data('value');
		var text = jQuery(this).text();
		jQuery('#selectFilterBy-id').text(text);
		jQuery('#selectFilterBy-id').data('value', selectFilterBy);
		if(selectFilterBy == 'quiz'){
			jQuery('.startedQuizOuter').show();	
			jQuery('.startedQuizTypeOuter').hide();	
		}else if(selectFilterBy == 'quiz_type'){
			jQuery('.startedQuizOuter').hide();	
			jQuery('.startedQuizTypeOuter').show();	
		}else{
			jQuery('.startedQuizOuter').hide();	
			jQuery('.startedQuizTypeOuter').hide();		
		}
	});
	
	jQuery(document).on('click', '.exportManageLeadData', function(e){
		e.preventDefault();
		var filter_by = 'quiz_id';
		var quiz_id = jQuery('#selectStartQuiz-id').attr('data-value');
		if(quiz_id == '' || quiz_id == 0 ){
			swal('','Please select a quiz','');
			return false;
		}
		var start_date = jQuery('#manage_users_start_date').val();
		var end_date = jQuery('#manage_users_end_date').val();
		
		jQuery('.filterByHidden').val(filter_by);
		jQuery('.quiz_idHidden').val(quiz_id);
		
		var form_id      = 'form#manage_users_form';
		window.open(csvDownloadUrlV2+'?action=sqb_report_csv_download&filter_by='+filter_by+'&quiz_id='+quiz_id+'&start_date='+start_date+'&end_date='+end_date);

	//	jQuery(form_id).submit();
		/*jQuery.post(ajaxurl, {
			action: 'sqb_export_filtered_lead_data',
			filter_by: filter_by,	
			quiz_id: quiz_id,	
			quiz_type: quiz_type,
		}, function(response) {
			
		});*/
	});

	jQuery(document).on('click', '.exportQuestionAnswerData', function(e){
		e.preventDefault();
		var filter_by = 'quiz_id';
		var quiz_id = jQuery('#selectStartQuizSearch-id').attr('data-value');
		if(quiz_id == '' || quiz_id == 0 ){
			swal('','Please select a quiz','');
			return false;
		}
		var question_id = jQuery('#selectStartQuizSearchQuestion-id').attr('data-value');
		if(question_id == '' || question_id == 0 ){
			swal('','Please select a question','');
			return false;
		}
		var answer_id = jQuery('#selectStartQuizSearchAnswer-id').attr('data-value');

		var start_date = jQuery('#manage_reports_search_start_date').val();
		var end_date = jQuery('#manage_reports_search_end_date').val();
		
		window.open(csvDownloadUrl+'?filter_by='+filter_by+'&quiz_id='+quiz_id+'&question_id='+question_id+'&answer_id='+answer_id+'&start_date='+start_date+'&end_date='+end_date);
	
	});
	
	jQuery(document).on('click', '.viewManageLeadUserDetails', function(e){
		var user_id = jQuery(this).data('userid');
		var name = jQuery(this).data('key');
		var email = jQuery(this).data('email');
		var date = jQuery(this).data('date');
		var quiz_id = jQuery(this).data('quizid');
		var row_id = jQuery(this).data('row-id');
		var source = jQuery(this).data('source');
		var course_id = jQuery(this).data('course_id');		
		if(name=="" || typeof name=="undefined"){			 
			name= jQuery('.tr_user_id_'+user_id+' .u_name_cls').text(); 			 
		}
		sqb_load_userdetails(user_id, name, email,date,quiz_id,row_id,source,course_id);
	});

	jQuery(document).on('click', '.viewUserDetails', function(e){
		var user_id = jQuery(this).data('userid');		
		var quiz_id = jQuery(this).data('quizid');
		var name = jQuery(this).data('username');
		var email = jQuery(this).data('useremail');
		SQBShowLoader();
		jQuery.post(ajaxurl, {
		action: 'sqb_load_all_user_data',
		user_id: user_id,	
		quiz_id:quiz_id,
		name:name,
		email:email,
	}, function(response) {
		response = JSON.parse(response);	
		SQBHideLoader();
		jQuery('#manage-user-details').find('.Manage_Side_Popup_content').html(response);
		jQuery('#manage-user-details').addClass('active_Side_Popup');
		if(jQuery('#manage-user-details .acc').length == 1){
			jQuery('.acc-head:first').trigger('click');
		}

		});	
	});
	
	jQuery(document).on('change','#select_tag_for_search',function(){
		jQuery('input#sqb_search_tags').val('');
		jQuery('input#sqb_search_tags_hidden').val(jQuery(this).val());
		jQuery('.manage_reports_search_btn').trigger('click');
	});
	
	jQuery(document).on('keyup','#sqb_search_tags', function(){
		jQuery('#select_tag_for_search').prop('selectedIndex',0);
		jQuery('input#sqb_search_tags_hidden').val(jQuery(this).val());
	});
	
	jQuery('.manage_reports_search_btn').on('click',function(){
		var quiz_id = jQuery('#selectStartQuizSearch-id').attr('data-value');
		var type = jQuery('#selectStartQuizSearch-id').attr('data-type');
		var check_category = jQuery('#selectStartQuizSearch-id').attr('data-category');

		var question_id = jQuery('#selectStartQuizSearchQuestion-id').attr('data-value');
		var answer_id = jQuery('#selectStartQuizSearchAnswer-id').attr('data-value');
		var start_date = jQuery('#manage_reports_search_start_date').val();
		var end_date = jQuery('#manage_reports_search_end_date').val();
		if(question_id == 0){
			var question_search = jQuery('input[name="question_search"]:checked').val();
			if(question_search == 'specific_tag'){
				var search_tags = jQuery('#sqb_search_tags_hidden').val();
				var selected_tag = jQuery('#select_tag_for_search :selected').attr('data-id');
				if(search_tags == '' && selected_tag == ''){
					swal('','Please Enter Or Select Tag Name','');
					return false;
				}
				SQBShowLoader();
				jQuery.post(ajaxurl, {
						action: 'SQBLoadSearchTags',
						quiz_id: quiz_id,	
						search_tags: search_tags,	
						start_date: start_date,	
						end_date: end_date,	

				}, function(response) {
					response = JSON.parse(response);				 
					SQBHideLoader();
					if(response.table_html){
						jQuery('.sqb-manage-leads-searchbox-inner').html('');
						jQuery('.sqb-manage-leads-searchbox-inner').show();
						jQuery('.sqb-manage-leads-searchbox-inner').html(response.table_html);
						jQuery('.sqb_manage_report_search_table').DataTable({
						  	dom: 'Bfrtip',
						  	buttons: [{ extend: 'csv', text: 'Export Data', title: 'data' }],
						  	"order": [[ 2, "desc" ]],
							"bLengthChange": false,
							pageLength : 10,
							language: {
								search: "",
								searchPlaceholder: "Search..."
							},
							"fnInitComplete": function() {
								//jQuery('.Manage_leads_table').show();
							}
						});
					}

				});	
			} else if(question_search == 'score_over'){
				var score_value = jQuery('input[name="score_value"]').val();
				if(score_value == ''){
					swal('','Please Enter Number','');
					return false;
				}

				SQBShowLoader();
			 	jQuery.post(ajaxurl, {
						action: 'SQBLoadScorefilter',
						quiz_id: quiz_id,	
						type: type,	
						check_category: check_category,	
						score_value: score_value,	
						start_date: start_date,	
						end_date: end_date,	

				}, function(response) {
					response = JSON.parse(response);				 
					SQBHideLoader();
					

					if(response.table_html){
						jQuery('.sqb-manage-leads-searchbox-inner').html('');
						jQuery('.sqb-manage-leads-searchbox-inner').show();
						jQuery('.sqb-manage-leads-searchbox-inner').html(response.table_html);
						jQuery('.sqb_manage_report_search_table').DataTable({
						  	dom: 'Bfrtip',
						  	buttons: [{ extend: 'csv', text: 'Export Data', title: 'data' }],
						  	"order": [[ 2, "desc" ]],
							"bLengthChange": false,
							pageLength : 10,
							language: {
								search: "",
								searchPlaceholder: "Search..."
							},
							"fnInitComplete": function() {
								//jQuery('.Manage_leads_table').show();
							}
						});
					}

				});	
			}else if(question_search == 'check_category'){
				var category_value = jQuery('input[name="category_value"]').val();
				var selected_category = jQuery('.category_name :selected').val();
				if(selected_category == '0'){
					swal('','Please Select Category','');
					return false;
				}

				if(category_value == ''){
					swal('','Please Enter Number','');
					return false;
				}

				SQBShowLoader();
			 	jQuery.post(ajaxurl, {
						action: 'SQBLoadCategoryfilter',
						quiz_id: quiz_id,	
						type: type,	
						category_value: category_value,	
						selected_category: selected_category,	
						start_date: start_date,	
						end_date: end_date,	

				}, function(response) {
					response = JSON.parse(response);				 
					SQBHideLoader();
					

					if(response.table_html){
						jQuery('.sqb-manage-leads-searchbox-inner').html('');
						jQuery('.sqb-manage-leads-searchbox-inner').show();
						jQuery('.sqb-manage-leads-searchbox-inner').html(response.table_html);
						jQuery('.sqb_manage_report_search_table').DataTable({
						  	dom: 'Bfrtip',
						  	buttons: [{ extend: 'csv', text: 'Export Data', title: 'data' }],
						  	"order": [[ 2, "desc" ]],
							"bLengthChange": false,
							pageLength : 10,
							language: {
								search: "",
								searchPlaceholder: "Search..."
							},
							"fnInitComplete": function() {
								//jQuery('.Manage_leads_table').show();
							}
						});
					}

				});	
			}else{
				SQBShowLoader();
			 	jQuery.post(ajaxurl, {
						action: 'SQBLoadquestionsByFilter',
						quiz_id: quiz_id,	
						type: type,	
						check_category: check_category,
						start_date: start_date,	
						end_date: end_date,	

				}, function(response) {
					response = JSON.parse(response);				 
					SQBHideLoader();
					if(response.table_html){
						jQuery('.question-data').html('');
						jQuery('.question-data').html(response.table_html);
						jQuery('.custom-filter-show-hide').show();
					}

					if(response.table_data){
						jQuery('.sqb-manage-leads-searchbox-inner').html('');
						jQuery('.sqb-manage-leads-searchbox-inner').show();
						jQuery('.sqb-manage-leads-searchbox-inner').html(response.table_data);
						jQuery('.sqb_manage_report_search_table').DataTable({
						  	dom: 'Bfrtip',
						  	buttons: [{ extend: 'csv', text: 'Export Data', title: 'data' }],
						  	"order": [[ 2, "desc" ]],
							"bLengthChange": false,
							pageLength : 10,
							language: {
								search: "",
								searchPlaceholder: "Search..."
							},
							"fnInitComplete": function() {
								//jQuery('.Manage_leads_table').show();
							}
						});
					}

				});	
			}



			
		}else{
			SQBShowLoader();
			jQuery.post(ajaxurl, {
					action: 'SQBLoadSearchByFilter',
					quiz_id: quiz_id,	
					question_id: question_id,	
					answer_id: answer_id,	
					start_date: start_date,	
					end_date: end_date,
			}, function(response) {
				response = JSON.parse(response);				 
				SQBHideLoader();
				if(response.table_html){
					jQuery('.sqb-manage-leads-searchbox-inner').html('');
					jQuery('.sqb-manage-leads-searchbox-inner').html(response.table_html);
					jQuery('.sqb_manage_report_search_table').DataTable({
					  	dom: 'Bfrtip',
					  	buttons: [{ extend: 'csv', text: 'Export Data', title: 'data' }],
					  	"order": [[ 2, "desc" ]],
						"bLengthChange": false,
						pageLength : 10,
						language: {
							search: "",
							searchPlaceholder: "Search..."
						},
						"fnInitComplete": function() {
							//jQuery('.Manage_leads_table').show();
						}
					});
				}
			});	
		}
	});
		
	jQuery('.filterManageUsersLeads').on('click',function(){
		var quiz_id = jQuery('#selectStartQuiz-id').attr('data-value');
		var start_date = jQuery('#manage_users_start_date').val();
		var end_date = jQuery('#manage_users_end_date').val();
		
		//var date = new Date(start_date);
		
		//date.setDate(date.getDate() - 1);
		/*rrr*/
				    	/*var d = date.getDate();
						var m =  date.getMonth();
						m += 1;  // JavaScript months are 0-11
						var y = date.getFullYear();
						start_date = m + "/" + d + "/" + y;*/
		/*rrr*/
		
		SQBShowLoader();
		 jQuery.post(ajaxurl, {
				action: 'sqb_load_users_by_filter',
				quiz_id: quiz_id,	
				start_date: start_date,	
				end_date: end_date,
		}, function(response) {
			response = JSON.parse(response);				 
			SQBHideLoader();
			if(response.table_html){
				jQuery('.sqb_manage_leads_table_wrapper').html('');
				jQuery('.sqb_manage_leads_table_wrapper').html(response.table_html);
				jQuery('.sqb_manage_leads_table').DataTable({
					"order": [[ 2, "desc" ]],
					"bLengthChange": false,
					pageLength : 10,
					language: {
						search: "",
						searchPlaceholder: "Search..."
					},
					"fnInitComplete": function() {
						jQuery('.Manage_leads_table').show();
					}
				});
			}
		
		});	
		
		
	});
	
	//jQuery('.filterManageUsersLeads').trigger('click');
	
	// manage_user_view_details_btn 
	
	jQuery(document).on('click','.manage_user_view_details_btn',function(){
		var email= jQuery(this).attr('data-email');
		jQuery('#Quiz-reportsTab a[href="#reports_user_quiz_details"]').trigger('click');
		jQuery('#reports_user_quiz_details input[type="search"]').val(email).trigger('keyup').trigger('change'); 
	});
	
	sqb_user_question_answer_reset_by_id();
	 
});


jQuery(document).on('keyup', '#sqb_search_multiple_select', function() {
	var allpostlist = [];
	console.log('ededed');
	var str2 = jQuery(this).val().toLowerCase();	 
	var i = 0;
	jQuery("ul.sqb_select_urls li").each(function() {
		var str1 = jQuery(this).text().toLowerCase();
		if (str1.indexOf(str2) != -1) {
			allpostlist[i++] = jQuery(this).attr("data-value");
		}
	});

	jQuery("ul.sqb_select_urls li").each(function() {
		if (jQuery.inArray(jQuery(this).attr("data-value"), allpostlist) !== -1) {
			jQuery(this).show();
		} else {
			jQuery(this).hide();
		}
	});

});

function sqb_load_userdetails(user_id, name, email,date = '', quiz_id,row_id = '',source = '',course_id = ''){	 	
	 
	 jQuery.post(ajaxurl, {
		action: 'sqb_load_userdetails',
		user_id: user_id,	
		name: name,	
		email: email,
		date: date,
		quiz_id:quiz_id,	
		row_id:row_id,	 
		source:source,	
		course_id:course_id,	
	//	quiz_id:"all",	
	}, function(response) {
		response = JSON.parse(response);				 
		jQuery('.Manage_Side_Popup_content').html(response);
		jQuery('.Manage_Side_Popup').addClass("active_Side_Popup");
		 jQuery(this).text("View Details");

		try{
			jQuery('.sqb_matching_text').each(function(){
				var points = 0;
				var text = jQuery(this).find('.ans_text1 .sentence-matched');
				text.each(function(){
					points = points + parseInt(jQuery(this).attr('data-point'));
				});
				jQuery(this).find('.result_text .result_inn').html(points);
			});
		}catch(err) {}

	});	
}	
 
function sqb_load_userdetails1(user_id, name, email, quiz_id){
	var quiz_id =  jQuery(".get_quiz_details option:selected").val();
	var name =  jQuery(".user_name1").text();
	var email =  jQuery(".user_email1").text();	 
	 jQuery.post(ajaxurl, {
		action: 'sqb_load_userdetails',
		user_id: user_id,	
		name: name,	
		email: email,	
		quiz_id: quiz_id,	
	}, function(response) {
		response = JSON.parse(response);				 
		jQuery('.Manage_Side_Popup_content').html("Loading...");
		jQuery('.Manage_Side_Popup_content').html(response);
		 
	});	
}


function sqb_lead_user_delete_by_id(user_id){
	if(user_id == 0 || user_id == ''){
		return false;
	}
	
	swal({
			text: "Are you sure you want completely delete this user account, including the stats connected to this user? You'll not be able to recover the account",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Delete!",
			customClass: '',
			
		}).then((result) => {
			if (result.value) {
				
				// ajax call
				SQBShowLoader();
				 jQuery.post(ajaxurl, {
						action: 'sqb_user_delete_all_info_by_id',
						user_id: user_id
				}, function(response) {
					response = JSON.parse(response);				 
					SQBHideLoader();
					console.log(response); 
					var table = jQuery('.sqb_manage_leads_table').DataTable();
					table.row(jQuery('tr.tr_user_id_'+user_id)).remove().draw();
					
					var table = jQuery('.Manage_leads_table_user_details').DataTable();
					table.row(jQuery('tr.user_quiz_details_tr_user_id_'+user_id)).remove().draw();
					
				})
				
				
							
			}
	
	
			
		});
	
}


function sqb_user_question_answer_reset_by_id(){
	
	jQuery(document).on('click','.sqb_user_question_answer_reset_by_id', function(){
		
		var user_id = jQuery(this).attr('data-user-id');
		var quiz_id = jQuery(this).attr('data-quiz-id');
		var date = jQuery(this).attr('data-date');
		var quiz_type = jQuery(this).attr('data-quiz_type');
		var table_row_id = jQuery(this).attr('data-row-id');
		if(user_id == 0 || user_id == ''){
			return false;
		}
	
	swal({
			text: "Are you sure you want delete this record? It'll NOT delete the user account but just this specific quiz connected to this user",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Delete!",
			customClass: '',
			
		}).then((result) => {
			if (result.value) {
				
				// ajax call
				SQBShowLoader();
				 jQuery.post(ajaxurl, {
						action: 'sqb_user_question_answer_reset_by_id',
						user_id: user_id,
						quiz_id: quiz_id,
						date: date,
						quiz_type: quiz_type, 
				}, function(response) {
					response = JSON.parse(response);				 
					SQBHideLoader();
					console.log(response);
					jQuery('.Manage_Side_Popup').removeClass("active_Side_Popup");
					jQuery('.view-profile-link').text("View Details");
					
					//var table = jQuery('.Manage_leads_table_user_details').DataTable();
					//table.row(jQuery('tr.user_quiz_details_tr_row_id_'+table_row_id)).remove().draw();
					
					
				})
				
				
							
			}
	
	
			
		});
	});
}
