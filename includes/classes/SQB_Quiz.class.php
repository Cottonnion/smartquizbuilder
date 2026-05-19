<?php 

class SQB_Quiz {
	
	public $redirect_after_complete;
	public $show_firstname_template;
	public $quiz_first_name_template;
	public $show_analyzing_result;
	public $show_analyzing_result_time;
	public $pass_criteria;
	public $status;
	public $sqb_insert_quiz;
	public $questions_top_border;
	public $email_notification_settings;
	public $double_optin;
	public $pdf_front_last_image;
	public $correct_answer_page;
	public $pre_built;
	public $pre_built_details;
	public $admin_email;
	public $send_copy;
	public $quiz_display_url;
	public $global_style;
	public $setting_level;
	public $id;
	public $quiz_name;
	public $quiz_desc;
	public $quiz_type;
	public $grade_quiz;
	public $progress_bar;
	public $quiz_display;
	public $quiz_blocking;
	public $quiz_passmark;
	public $quiz_attempts_allowed;
	public $quiz_pagination;
	public $question_per_page;
	public $quiz_timer;
	public $quiz_timer_limit;
	public $quiz_score;
	public $show_percentage;
	public $show_for_notloggedin_user;
	public $question_display;
	public $number_of_question;
	public $question_bank_options;
	public $questions_random;
	public $answers_random;
	public $show_start_screen;
	public $show_optin_screen;
	public $show_share_screen;
	public $show_result_screen;
	public $template_display_sequence;
	public $user_added_my_email_platform;
	public $user_added_platform;
	public $outcome_type;
	public $outcome_page;
	public $display_score_on_page;
	public $display_correctans_on_page;
	public $display_correctans_options;
	public $display_quesans_on_outcome;
	public $outcome_redirect_url;
	public $user_opt_in_redirect;
	public $user_opt_in_redirect_url;
	public $date;
	public $enable_branching;
	public $show_next_button;
	public $already_take_the_quiz;
	public $total_attempts;
	public $quiz_show_correct_answer;
	public $template;
	public $show_video;
	public $video_url;
	public $allow_retake;
	public $quiz_display_in_url;
	public $quiz_popup_time_delay;
	public $quiz_popup_frequency;
	public $quiz_popup_position;
	public $quick_email_verification;
	public $quiz_slider_animation;
	public $quiz_slider_animation_option;
	public $result_display_option;
	public $timer_html;
	public $timer_customizer;
	public $timer_expired_msg;
	public $enable_background_image;
	public $category;
	public $transparent_background_settings;
	public $opt_screen_position;
	public $weighted_score;
	public $ans_recommendation;
	public $ans_tags;
	public $recommended_next_button;
	public $customizer_styles;
	public $move_question;
	public $outcome_screen_display;
	public $outcome_screen_charts_settings;
	public $category_option;
	public $customizer_style_setting;
	public $exit_popup_value;
	public $show_firstname_outcome;
	public $show_download_button;
	public $download_pdf_button_html;
	public $poll_settings;
	public $all_other_options;
	public $auto_submit_opt;
	public $qns_ads;
	public $ads_next_button;
	public $game_animation;
	public $game_animation_options;
	public $show_back_button;

	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
	
	function getQuizName() {
		return $this->quiz_name;
	}
	function setQuizName($o) {
		$this->quiz_name = $o;
	}
	
	function getQuizDesc() {
		return $this->quiz_desc;
	}
	function setQuizDesc($o) {
		$this->quiz_desc	 = $o;
	}
	
	function getQuizType() {
		return $this->quiz_type;
	}
	function setQuizType($o) {
		$this->quiz_type	 = $o;
	}
	
	function getGradeQuiz() {
		return $this->grade_quiz;
	}
	function setGradeQuiz($o) {
		$this->grade_quiz	 = $o;
	}
	
	function getProgressBar() {
		return $this->progress_bar;
	}
	function setProgressBar($o) {
		$this->progress_bar	 = $o;
	}
	
	function getQuizDisplay() {
		return $this->quiz_display;
	}
	function setQuizDisplay($o) {
		$this->quiz_display	 = $o;
	}
	
	function getDisplayOnFirstScreen() {
		return $this->display_on_first_screen;
	}
	function setDisplayOnFirstScreen($o) {
		$this->display_on_first_screen	 = $o;
	}
	
	function getStartTemplate() {
		return $this->start_template;
	}
	function setStartTemplate($o) {
		$this->start_template	 = $o;
	} 
	
	function getQuizPassmark() {
		return $this->quiz_passmark;
	}
	function setQuizPassmark($o) {
		$this->quiz_passmark	 = $o;
	}
	
	function getQuizShowAnswer() {
		return $this->quiz_showanswer;
	}
	function setQuizShowAnswer($o) {
		$this->quiz_showanswer	 = $o;
	}
	/*
	function getQuizShowResult() {
		return $this->quiz_show_result;
	}
	function setQuizShowResult($o) {
		$this->quiz_show_result	 = $o;
	}*/
	
	function getQuizShowFirstNameTemp() {
		return $this->show_firstname_template;
	}
	function setQuizShowFirstNameTemp($o) {
		$this->show_firstname_template	 = $o;
	}

	function getQuizShowAnalyzingResult() {
		return $this->show_analyzing_result;
	}
	function setQuizShowAnalyzingResult($o) {
		$this->show_analyzing_result = $o;
	}

	function getQuizAnalyzingResultTime() {
		return $this->show_analyzing_result_time;
	}
	function setQuizAnalyzingResultTime($o) {
		$this->show_analyzing_result_time = $o;
	}
	
	function getQuizAttemptsAllowed() {
		return $this->quiz_attempts_allowed;
	}
	function setQuizAttemptsAllowed($o) {
		$this->quiz_attempts_allowed	 = $o;
	}
	function getTotalAttempts() {
		return $this->total_attempts;
	}
	function setTotalAttempts($o) {
		$this->total_attempts = $o;
	}
	
	function getAlreadyTakeTheQuiz() {
		return $this->already_take_the_quiz;
	}
	function setAlreadyTakeTheQuiz($o) {
		$this->already_take_the_quiz	 = $o;
	}
	
	function getQuizPagination() {
		return $this->quiz_pagination;
	}
	function setQuizPagination($o) {
		$this->quiz_pagination	 = $o;
	}
	
	function getQuestionPerPage() {
		return $this->question_per_page;
	}
	function setQuestionPerPage($o) {
		$this->question_per_page	 = $o;
	}
	function getQuizTimer() {
		return $this->quiz_timer;
	}
	function setQuizTimer($o) {
		$this->quiz_timer	 = $o;
	}
	function getQuizTimerLimit() {
		return $this->quiz_timer_limit;
	}
	function setQuizTimerLimit($o) {
		$this->quiz_timer_limit	 = $o;
	}
	
	function getQuizScore() {
		return $this->quiz_score;
	}
	function setQuizScore($o) {
		$this->quiz_score	 = $o;
	}
	
	function getQuizPercentage() {
		return $this->show_percentage;
	}
	function setQuizPercentage($o) {
		$this->show_percentage	 = $o;
	} 
	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}

	function getGlobalStyle() {
		return $this->global_style;
	}
	function setGlobalStyle($o) {
		$this->global_style = $o;
	}
	
	function getShowForNotLoggedInUser() {
		return $this->show_for_notloggedin_user;
	}
	
	function setShowForNotLoggedInUser($o) {
		$this->show_for_notloggedin_user = $o;
	}
	
	function getResultTemp() {
		return $this->result_temp;
	}
	
	function setResultTemp($o) {
		$this->result_temp = $o;
	}
	
	function getRedirectAfterComplete() {
		return $this->redirect_after_complete;
	}
	
	function setRedirectAfterComplete($o) {
		$this->redirect_after_complete = $o;
	}
	
	function getQuestionDisplay() {
		return $this->question_display;
	}
	
	function setQuestionDisplay($o) {
		$this->question_display = $o;
	}	
		
	function getNumberOfQuestion() {
		return $this->number_of_question;
	}
	
	function setNumberOfQuestion($o) {
		$this->number_of_question = $o;
	}

	function getQuestionBankOption() {
		return $this->question_bank_options;
	}
	
	function setQuestionBankOption($o) {
		$this->question_bank_options = $o;
	}	
		
	function getQuestionsRandom() {
		return $this->questions_random;
	}
	
	function setQuestionsRandom($o) {
		$this->questions_random = $o;
	}
		
	function getAnswersRandom() {
		return $this->answers_random;
	}
	
	function setAnswersRandom($o) {
		$this->answers_random = $o;
	} 
		
	function getShowStartScreen() {
		return $this->show_start_screen;
	}

	function setShowStartScreen($o) {
		$this->show_start_screen = $o;
	}

	function getShowOptinScreen() {
		return $this->show_optin_screen;
	}

	function setShowOptinScreen($o) {
		$this->show_optin_screen = $o;
	}

	function getShowShareScreen() {
		return $this->show_share_screen;
	}

	function setShowShareScreen($o) {
		$this->show_share_screen = $o;
	}
	
	function getOptinScreenPosition() {
		return $this->opt_screen_position;
	}

	function setOptinScreenPosition($o) {
		$this->opt_screen_position = $o;
	}

	function getShowResultScreen() {
		return $this->show_result_screen;
	}

	function setShowResultScreen($o) {
		$this->show_result_screen = $o;
	}

	function getTemplateDisplaySequence() {
		return $this->template_display_sequence;
	}

	function setTemplateDisplaySequence($o) {
		$this->template_display_sequence = $o;
	}	
	
	function getUserAddedMyEmailPlatform() {
		return $this->user_added_my_email_platform;
	}

	function setUserAddedMyEmailPlatform($o) {
		$this->user_added_my_email_platform = $o;
	}
	
	function getUserAddedPlatform() {
		return $this->user_added_platform;
	}

	function setUserAddedPlatform($o) {
		$this->user_added_platform = $o;
	}	
	
	function getResultDisplayOption() {
		return $this->result_display_option;
	}

	function setResultDisplayOption($o) {
		$this->result_display_option = $o;
	}
		
	function getQuizShowCorrectAnswer() {
		return $this->quiz_show_correct_answer;
	}

	function setQuizShowCorrectAnswer($o) {
		$this->quiz_show_correct_answer = $o;
	}
	 
	function getCorrectAnswerPage() {
		return $this->correct_answer_page;
	}
	function setCorrectAnswerPage($o) {
		$this->correct_answer_page = $o;
	} 	
		
	function getOutcomeType() {
		return $this->outcome_type;
	}
	function setOutcomeType($o) {
		$this->outcome_type = $o;
	} 

	function getOutcomePage() {
		return $this->outcome_page;
	}
	function setOutcomePage($o) {
		$this->outcome_page = $o;
	} 

	function getDisplayScoreOnPage() {
		return $this->display_score_on_page;
	}
	function setDisplayScoreOnPage($o) {
		$this->display_score_on_page = $o;
	}

	function getDisplayCorrectAnsOnPage() {
		return $this->display_correctans_on_page;
	}
	function setDisplayCorrectAnsOnPage($o) {
		$this->display_correctans_on_page = $o;
	}
	function getDisplayAnswerOptions() {
		return $this->display_correctans_options;
	}
	function setDisplayAnswerOptions($o) {
		$this->display_correctans_options = $o;
	}

	function getDisplayQuesansOnOutcome() {
		return $this->display_quesans_on_outcome;
	}
	function setDisplayQuesansOnOutcome($o) {
		$this->display_quesans_on_outcome = $o;
	}

	function getOutcomeRedirectUrl() {
		return $this->outcome_redirect_url;
	}
	function setOutcomeRedirectUrl($o) {
		$this->outcome_redirect_url = $o;
	}

	function getUserOptinRedirect() {
		return $this->user_opt_in_redirect;
	}
	function setUserOptinRedirect($o) {
		$this->user_opt_in_redirect = $o;
	}

	function getUserOptinRedirectUrl() {
		return $this->user_opt_in_redirect_url;
	}
	function setUserOptinRedirectUrl($o) {
		$this->user_opt_in_redirect_url = $o;
	} 
	
	function getShowNextButton() {
		return $this->show_next_button;
	}
	function setShowNextButton($o) {
		$this->show_next_button = $o;
	} 
	
	function getEnableBranching() {
		return $this->enable_branching;
	}
	function setEnableBranching($o) {
		$this->enable_branching = $o;
	} 
	
	function getTemplate() {
		return $this->template;
	}
	function setTemplate($o) {
		$this->template = $o;
	}

	function getShowVideo() {
		return $this->show_video;
	}
	function setShowVideo($o) {
		$this->show_video = $o;
	}

	function getVideoURL() {
		return $this->video_url;
	}
	function setVideoURL($o) {
		$this->video_url = $o;
	} 
	function getQuizBlocking() {
		return $this->quiz_blocking;
	} 
	function setQuizBlocking($o) {
		$this->quiz_blocking = $o;
	} 
	function getPassCriteria() {
		return $this->pass_criteria;
	} 
	function setPassCriteria($o) {
		$this->pass_criteria = $o;
	} 
	function getStatus() {
		return $this->status;
	} 
	function setStatus($o) {
		$this->status = $o;
	} 	
	
	function getSqbInsertQuiz() {
		return $this->sqb_insert_quiz;
	} 
	function setSqbInsertQuiz($o) {
		$this->sqb_insert_quiz = $o;
	} 	
	
	function getAllowRetake() {
		return $this->allow_retake;
	} 
	function setAllowRetake($o) {
		$this->allow_retake = $o;
	} 
	
	function getQuizDisplayUrls() {
		return $this->quiz_display_url;
	} 
	function setQuizDisplayUrls($o) {
		$this->quiz_display_url = $o;
	} 
	
	function getQuizDisplayInUrls() {
		return $this->quiz_display_in_url;
	} 
	function setQuizDisplayInUrls($o) {
		$this->quiz_display_in_url = $o;
	}
	
	function getQuizPopupTimeDelay() {
		return $this->quiz_popup_time_delay;
	} 
	function setQuizPopupTimeDelay($o) {
		$this->quiz_popup_time_delay = $o;
	} 
	
	function getQuizPopupFrequency() {
		return $this->quiz_popup_frequency;
	} 
	function setQuizPopupFrequency($o) {
		$this->quiz_popup_frequency = $o;
	} 
	
	function getQuizPopupPosition() {
		return $this->quiz_popup_position;
	} 
	function setQuizPopupPosition($o) {
		$this->quiz_popup_position = $o;
	} 
	
	function getEmailVerification() {
		return $this->quick_email_verification;
	} 
	function setEmailVerification($o) {
		$this->quick_email_verification = $o;
	} 

   function getQuizSliderAnimation() {
		return $this->quiz_slider_animation;
   }
	 
   function setQuizSliderAnimation($o) {
		$this->quiz_slider_animation = $o;
   } 
   
   function getQuizSliderAnimationOption() {
		return $this->quiz_slider_animation_option;
   }
	 
   function setQuizSliderAnimationOption($o) {
		$this->quiz_slider_animation_option = $o;
   }
	
    function getQuestionsTopBorder() {
		return $this->questions_top_border;
   }
	 
   function setQuestionsTopBorder($o) {
		$this->questions_top_border = $o;
   } 			

   function getTimerHtml() {
		return $this->timer_html;
   }	 
   function setTimerHtml($o) {
		$this->timer_html = $o;
   } 
   function getTimerCustomizer() {
		return $this->timer_customizer;
   }	 
   function setTimerCustomizer($o) {
		$this->timer_customizer = $o;
   }
   function getTimerExpiredMsg() {
		return $this->timer_expired_msg;
   }	 
   function setTimerExpiredMsg($o) {
		$this->timer_expired_msg = $o;
   } 
   
   function getEnableBackgroundImage() {
		return $this->enable_background_image;
   }	 
   function setEnableBackgroundImage($o) {
		$this->enable_background_image = $o;
   }    
   
   function getCategory() {
		return $this->category;
   }	    
   function setCategory($o) {
		$this->category = $o;
   } 		   
   
   function getPreBuilt(){
		return $this->pre_built;
   }	 
   function setPreBuilt($o) {
		$this->pre_built = $o;
   } 	
   
   function getPreBuiltDetails(){
		return $this->pre_built_details;
   }	 
   function setPreBuiltDetails($o) {
		$this->pre_built_details = $o;
   } 		

   function getTransparentBackgroundSettings(){
		return $this->transparent_background_settings;
   }	 
   function setTransparentBackgroundSettings($o) {
		$this->transparent_background_settings = $o;
   } 	   
   
   function getWeightedScore(){
		return $this->weighted_score;
   }
   	 
   function setWeightedScore($o) {
		$this->weighted_score = $o;
   }

   function getAnsRecommendation(){
		return $this->ans_recommendation;
	}	 
   
	function setAnsRecommendation($o) {
		$this->ans_recommendation = $o;
	}

	function getAnsTags(){
		return $this->ans_tags;
	}	 
   
	function setAnsTags($o) {
		$this->ans_tags = $o;
	}

 	function getCustomizerStyles(){
		return $this->customizer_styles;
	}	 
   
	function setCustomizerStyles($o) {
		$this->customizer_styles = $o;
	}
	
	function getRecommendedNextButton() {
		return $this->recommended_next_button;
	}	

	function setRecommendedNextButton($o) {
		$this->recommended_next_button = $o;
	}

	function getEmailNotificationSettings(){
		return $this->email_notification_settings;
   	}
   	 
   	function setEmailNotificationSettings($o) {
		$this->email_notification_settings = $o;
  	}  	

   	function getMoveQuestion(){
		return $this->move_question;
   	}
   	 
   	function setMoveQuestion($o) {
		$this->move_question = $o;
   	}

   	function getOutcomeScreen_Display(){
		return $this->outcome_screen_display;
   	}
   	 
   	function setOutcomeScreen_Display($o) {
		$this->outcome_screen_display = $o;
   	}
   	
   	function getOutcomeScreenChartsSettings(){
		return $this->outcome_screen_charts_settings;
   	}
   	 
   	function setOutcomeScreenChartsSettings($o) {
		$this->outcome_screen_charts_settings = $o;
   	}

   	function getCategoryOption(){
		return $this->category_option;
   	}
   	 
   	function setCategoryOption($o) {
		$this->category_option = $o;
   	}
   	function getDoubleOptin(){
		return $this->double_optin;
   	}
   	 
   	function setDoubleOptin($o) {
		$this->double_optin = $o;
   	}
   	
   	function getCustomizerStyleSetting() {
		return $this->customizer_style_setting;
	}
	
	function setCustomizerStyleSetting($o) {
		$this->customizer_style_setting = $o;
	}

	function getExitPopupValue(){
		return $this->exit_popup_value;
   	}
   	 
   	function setExitPopupValue($o) {
		$this->exit_popup_value = $o;
   	}

   	function getShowFirstnameOutcome(){
		return $this->show_firstname_outcome;
   	}
   	 
   	function setShowFirstnameOutcome($o) {
		$this->show_firstname_outcome = $o;
   	}
    function getShowDownloadButton(){
		return $this->show_download_button;
   	}
   	 
   	function setShowDownloadButton($o) {
		$this->show_download_button = $o;
   	}

   	function getDownloadPDFButtonHtml() {
		return $this->download_pdf_button_html;
	}	

	function setDownloadPDFButtonHtml($o) {
		$this->download_pdf_button_html = $o;
	}

	function getPdfFrontLastImage() {
		return $this->pdf_front_last_image;
	}	

	function setPdfFrontLastImage($o) {
		$this->pdf_front_last_image = $o;
	}

	function getPollSettings() {
		return $this->poll_settings;
	}	

	function setPollSettings($o) {
		$this->poll_settings = $o;
	}

	function getAllOtherOptions() {
		return $this->all_other_options;
	}	

	function setAllOtherOptions($o) {
		$this->all_other_options = $o;
	}

	function getAutoSubmitOptin() {
		return $this->auto_submit_opt;
	}	

	function setAutoSubmitOptin($o) {
		$this->auto_submit_opt = $o;
	}

	function getQnsAds(){
		return $this->qns_ads;
	}	 
   
	function setQnsAds($o) {
		$this->qns_ads = $o;
	}

	function getAdsNextButton() {
		return $this->ads_next_button;
	}	

	function setAdsNextButton($o) {
		$this->ads_next_button = $o;
	}

	function getAdminEmail() {
		return $this->admin_email;
	}	

	function setAdminEmail($o) {
		$this->admin_email = $o;
	}

	function getSendCopy() {
		return $this->send_copy;
	}	

	function setSendCopy($o) {
		$this->send_copy = $o;
	}

	function getGameAnimation() {
		return $this->game_animation;
	}	

	function setGameAnimation($o) {
		$this->game_animation = $o;
	}

	function getGameAnimationsOptions() {
		return $this->game_animation_options;
	}	

	function setGameAnimationsOptions($o) {
		$this->game_animation_options = $o;
	}

	function getShowBackButton() {
		return $this->show_back_button;
	}
	function setShowBackButton($o) {
		$this->show_back_button = $o;
	}
	
	function getSettingLevel() {
		return $this->setting_level;
	}

	function setSettingLevel($o) {
		$this->setting_level = $o;
	}
	

	public function create(){
		try {
			global $wpdb, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$data = array(
				'quiz_name'=> $this->getQuizName(),
				'quiz_desc'=> $this->getQuizDesc(),
				'quiz_type'=> $this->getQuizType(),
				'grade_quiz'=> $this->getGradeQuiz(),
				'progress_bar'=> $this->getProgressBar(),				
				'quiz_display'=> $this->getQuizDisplay(),
				'quiz_blocking'=> $this->getQuizBlocking(),
				//'display_on_first_screen'=> $this->getDisplayOnFirstScreen(),
				//'start_template'=> $this->getStartTemplate(),
				'quiz_passmark'=> $this->getQuizPassmark(),
				//'quiz_show_correct_answer'=> $this->getQuizShowAnswer(),				
				'correct_answer_page'=> $this->getCorrectAnswerPage(),
				'quiz_attempts_allowed'=> $this->getQuizAttemptsAllowed(),				
				'quiz_pagination'=> $this->getQuizPagination(),
				'question_per_page'=> $this->getQuestionPerPage(),
				'quiz_timer'=> $this->getQuizTimer(),
				'quiz_timer_limit'=> $this->getQuizTimerLimit(),
				'quiz_score'=> $this->getQuizScore(),
				'show_percentage'=> $this->getQuizPercentage(),				 
				'show_for_notloggedin_user'=> $this->getShowForNotLoggedInUser(),				 
				//'result_temp'=> $this->getResultTemp(),				 
				'redirect_after_complete'=> $this->getRedirectAfterComplete(),				 
				'question_display'=> $this->getQuestionDisplay(),				 
				'number_of_question'=> $this->getNumberOfQuestion(),				 
				'question_bank_options'=> $this->getQuestionBankOption(),				 
				'questions_random'=> $this->getQuestionsRandom(),				 
				'answers_random'=> $this->getAnswersRandom(),				 
				'show_start_screen'=> $this->getShowStartScreen(),				 
				'show_optin_screen'=> $this->getShowOptinScreen(),				 
				'show_share_screen'=> $this->getShowShareScreen(),				 
				'show_result_screen'=> $this->getShowResultScreen(),				 
				'show_firstname_template'=> $this->getQuizShowFirstNameTemp(),				 
				'show_analyzing_result'=> $this->getQuizShowAnalyzingResult(),				 
				'show_analyzing_result_time'=> $this->getQuizAnalyzingResultTime(),				 
				'template_display_sequence'=> $this->getTemplateDisplaySequence(),				 
				'user_added_my_email_platform'=> $this->getUserAddedMyEmailPlatform(),				 
				'user_added_platform'=> $this->getUserAddedPlatform(),				 
				'result_display_option'=> $this->getResultDisplayOption(),				 
				'quiz_show_correct_answer'=> $this->getQuizShowCorrectAnswer(),				 					
				'outcome_type'=> $this->getOutcomeType(),	
				'outcome_page'=> $this->getOutcomePage(),	
				'display_score_on_page'=> $this->getDisplayScoreOnPage(),	
				'display_correctans_on_page'=> $this->getDisplayCorrectAnsOnPage(),	
				'display_correctans_options'=> $this->getDisplayAnswerOptions(),	
				'display_quesans_on_outcome'=> $this->getDisplayQuesansOnOutcome(),	
				'outcome_redirect_url'=> $this->getOutcomeRedirectUrl(),				 
				'user_opt_in_redirect'=> $this->getUserOptinRedirect(),				 
				'user_opt_in_redirect_url'=> $this->getUserOptinRedirectUrl(),				 
				'date'=> $this->getDate(),			 
				'enable_branching'=> $this->getEnableBranching(),			 
				'show_next_button'=> $this->getShowNextButton(),			 
				'already_take_the_quiz'=> $this->getAlreadyTakeTheQuiz(),
				'total_attempts'=> $this->getTotalAttempts(),			 
				'template'=> $this->getTemplate(),			 
				'show_video'=> $this->getShowVideo(),			 
				'video_url'=> $this->getVideoURL(),			 
				'pass_criteria'=> $this->getPassCriteria(),			 
				'status'=> $this->getStatus(),			 
				'sqb_insert_quiz'=> $this->getSqbInsertQuiz(),			 
				'allow_retake'=> $this->getAllowRetake(),			 
				'quiz_display_url'=> $this->getQuizDisplayUrls(),			 
				'quiz_display_in_url'=> $this->getQuizDisplayInUrls(),			 
				'quiz_popup_time_delay'=> $this->getQuizPopupTimeDelay(),			 
				'quiz_popup_frequency'=> $this->getQuizPopupFrequency(),			 
				'quiz_popup_position'=> $this->getQuizPopupPosition(),			 
				'quick_email_verification'=> $this->getEmailVerification(),		
				'quiz_slider_animation'=> $this->getQuizSliderAnimation(),	
				'quiz_slider_animation_option'=> $this->getQuizSliderAnimationOption(),
				'questions_top_border'=> $this->getQuestionsTopBorder(), 
				'timer_html'=> $this->getTimerHtml(), 
				'timer_customizer'=> $this->getTimerCustomizer(), 
				'timer_expired_msg'=> $this->getTimerExpiredMsg(), 
				'enable_background_image'=> $this->getEnableBackgroundImage(), 
				'category'=> $this->getCategory(), 
				'pre_built'=> $this->getPreBuilt(), 
				'pre_built_details'=> $this->getPreBuiltDetails(), 
				'transparent_background_settings'=> $this->getTransparentBackgroundSettings(), 
				'opt_screen_position'=> $this->getOptinScreenPosition(), 
				'weighted_score'=> $this->getWeightedScore(),
                'email_notification_settings'=> $this->getEmailNotificationSettings(),
				'ans_recommendation'=> $this->getAnsRecommendation(), 
				'ans_tags'=> $this->getAnsTags(), 
				'recommended_next_button'=> $this->getRecommendedNextButton(), 
				'customizer_styles'=> $this->getCustomizerStyles(), 
				'move_question'=> $this->getMoveQuestion(), 
				'outcome_screen_display'=> $this->getOutcomeScreen_Display(),
				'outcome_screen_charts_settings'=> $this->getOutcomeScreenChartsSettings(),  
				'category_option'=> $this->getCategoryOption(),  
				'double_optin'=> $this->getDoubleOptin(),  
				'customizer_style_setting'=> $this->getCustomizerStyleSetting(),
				'exit_popup_value'=> $this->getExitPopupValue(),
				'show_firstname_outcome'=> $this->getShowFirstnameOutcome(),
                'show_download_button'=> $this->getShowDownloadButton(),
				'download_pdf_button_html'=> $this->getDownloadPDFButtonHtml(),
				'pdf_front_last_image'=> $this->getPdfFrontLastImage(),
				'poll_settings'=> $this->getPollSettings(),
				'all_other_options'=> $this->getAllOtherOptions(),
				'auto_submit_opt'=> $this->getAutoSubmitOptin(),
				'qns_ads'=> $this->getQnsAds(),
				'ads_next_button'=> $this->getAdsNextButton(),
				'admin_email'=> $this->getAdminEmail(),
				'send_copy'=> $this->getSendCopy(),
				'game_animations'=> $this->getGameAnimation(),
				'game_animations_options'=> $this->getGameAnimationsOptions(),
				'show_back_button'=> $this->getShowBackButton(), 
				'global_style'=> $this->getGlobalStyle(),
				'setting_level'=> $this->getSettingLevel(),  
			); 
			
			$wpdb->insert($tableName, $data);
			
			$id = $wpdb->insert_id;
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	

	public function update(){
		try {
			global $wpdb, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$data = array(
				'quiz_name'=> $this->getQuizName(),
				'quiz_desc'=> $this->getQuizDesc(),
				'quiz_type'=> $this->getQuizType(),
				'grade_quiz'=> $this->getGradeQuiz(),
				'progress_bar'=> $this->getProgressBar(),				
				'quiz_display'=> $this->getQuizDisplay(),
				'quiz_blocking'=> $this->getQuizBlocking(),
				//'display_on_first_screen'=> $this->getDisplayOnFirstScreen(),
				//'start_template'=> $this->getStartTemplate(),
				'quiz_passmark'=> $this->getQuizPassmark(),
				//'quiz_show_correct_answer'=> $this->getQuizShowAnswer(),				
				'correct_answer_page'=> $this->getCorrectAnswerPage(),
				'quiz_attempts_allowed'=> $this->getQuizAttemptsAllowed(),				
				'quiz_pagination'=> $this->getQuizPagination(),
				'question_per_page'=> $this->getQuestionPerPage(),
				'quiz_timer'=> $this->getQuizTimer(),
				'quiz_timer_limit'=> $this->getQuizTimerLimit(),
				'quiz_score'=> $this->getQuizScore(),
				'show_percentage'=> $this->getQuizPercentage(),				 
				'show_for_notloggedin_user'=> $this->getShowForNotLoggedInUser(),				 
				//'result_temp'=> $this->getResultTemp(),				 
				'redirect_after_complete'=> $this->getRedirectAfterComplete(),				 
				'question_display'=> $this->getQuestionDisplay(),				 
				'number_of_question'=> $this->getNumberOfQuestion(),
				'question_bank_options'=> $this->getQuestionBankOption(),					 
				'questions_random'=> $this->getQuestionsRandom(),				 
				'answers_random'=> $this->getAnswersRandom(),				 
				'show_start_screen'=> $this->getShowStartScreen(),				 
				'show_optin_screen'=> $this->getShowOptinScreen(),	
				'show_share_screen'=> $this->getShowShareScreen(),				 
				'show_result_screen'=> $this->getShowResultScreen(),	
				'show_firstname_template'=> $this->getQuizShowFirstNameTemp(),				 			 
				'show_analyzing_result'=> $this->getQuizShowAnalyzingResult(),				 			 
				'show_analyzing_result_time'=> $this->getQuizAnalyzingResultTime(),				 			 
				'template_display_sequence'=> $this->getTemplateDisplaySequence(),				 
				'user_added_my_email_platform'=> $this->getUserAddedMyEmailPlatform(),				 
				'user_added_platform'=> $this->getUserAddedPlatform(),				 
				'result_display_option'=> $this->getResultDisplayOption(),				 
				'quiz_show_correct_answer'=> $this->getQuizShowCorrectAnswer(),				 			
				'outcome_type'=> $this->getOutcomeType(),	
				'outcome_page'=> $this->getOutcomePage(),	
				'display_score_on_page'=> $this->getDisplayScoreOnPage(),	
				'display_correctans_on_page'=> $this->getDisplayCorrectAnsOnPage(),	
				'display_correctans_options'=> $this->getDisplayAnswerOptions(),
				'display_quesans_on_outcome'=> $this->getDisplayQuesansOnOutcome(),	
				'outcome_redirect_url'=> $this->getOutcomeRedirectUrl(),
				'user_opt_in_redirect'=> $this->getUserOptinRedirect(),				 
				'user_opt_in_redirect_url'=> $this->getUserOptinRedirectUrl(),						 
				'date'=> $this->getDate(),	
				'enable_branching'=> $this->getEnableBranching(),
				'show_next_button'=> $this->getShowNextButton(),	
				'already_take_the_quiz'=> $this->getAlreadyTakeTheQuiz(),
				'total_attempts'=> $this->getTotalAttempts(),	
				'template'=> $this->getTemplate(),		
				'show_video'=> $this->getShowVideo(),			 
				'video_url'=> $this->getVideoURL(),
				'pass_criteria'=> $this->getPassCriteria(),			
				'status'=> $this->getStatus(),	
				'sqb_insert_quiz'=> $this->getSqbInsertQuiz(),	
				'allow_retake'=> $this->getAllowRetake(),
				'quiz_display_url'=> $this->getQuizDisplayUrls(),			 
				'quiz_display_in_url'=> $this->getQuizDisplayInUrls(),
				'quiz_popup_time_delay'=> $this->getQuizPopupTimeDelay(),			 
				'quiz_popup_frequency'=> $this->getQuizPopupFrequency(),
				'quiz_popup_position'=> $this->getQuizPopupPosition(),	
				'quick_email_verification'=> $this->getEmailVerification(),	
				'quiz_slider_animation'=> $this->getQuizSliderAnimation(),
				'quiz_slider_animation_option'=> $this->getQuizSliderAnimationOption(),
				'questions_top_border'=> $this->getQuestionsTopBorder(), 
				'timer_html'=> $this->getTimerHtml(), 
				'timer_customizer'=> $this->getTimerCustomizer(), 	
				'timer_expired_msg'=> $this->getTimerExpiredMsg(), 
				'enable_background_image'=> $this->getEnableBackgroundImage(), 
				'category'=> $this->getCategory(), 
				'pre_built'=> $this->getPreBuilt(), 
				'pre_built_details'=> $this->getPreBuiltDetails(), 
				'transparent_background_settings'=> $this->getTransparentBackgroundSettings(),
				'opt_screen_position'=> $this->getOptinScreenPosition(),
				'weighted_score'=> $this->getWeightedScore(),
                'email_notification_settings'=> $this->getEmailNotificationSettings(), 
				'ans_recommendation'=> $this->getAnsRecommendation(), 
				'ans_tags'=> $this->getAnsTags(), 
				'recommended_next_button'=> $this->getRecommendedNextButton(), 
				'customizer_styles'=> $this->getCustomizerStyles(), 
				'move_question'=> $this->getMoveQuestion(), 
				'outcome_screen_display'=> $this->getOutcomeScreen_Display(),
				'outcome_screen_charts_settings'=> $this->getOutcomeScreenChartsSettings(),  
				'category_option'=> $this->getCategoryOption(),
				'customizer_style_setting'=> $this->getCustomizerStyleSetting(),
				'exit_popup_value'=> $this->getExitPopupValue(),
				'show_firstname_outcome'=> $this->getShowFirstnameOutcome(),
				'show_download_button'=> $this->getShowDownloadButton(),
				'download_pdf_button_html'=> $this->getDownloadPDFButtonHtml(),
				'pdf_front_last_image'=> $this->getPdfFrontLastImage(),	
				'poll_settings'=> $this->getPollSettings(),	
				'all_other_options'=> $this->getAllOtherOptions(),
				'auto_submit_opt'=> $this->getAutoSubmitOptin(),
				'qns_ads'=> $this->getQnsAds(),
				'ads_next_button'=> $this->getAdsNextButton(),
				'admin_email'=> $this->getAdminEmail(),
				'send_copy'=> $this->getSendCopy(),
				'game_animations'=> $this->getGameAnimation(),
				'game_animations_options'=> $this->getGameAnimationsOptions(),
				'show_back_button'=> $this->getShowBackButton(),  
				'setting_level'=> $this->getSettingLevel(),
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	

	public function updateBranchingStatus(){
		try {
			global $wpdb, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$data = array(
				'enable_branching'=> $this->getEnableBranching(),
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	  
	public static function loadById($id) {
		 
		try {
			global $wpdb, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows) &&  isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_Quiz();
				$sqbData->setId($row['id']);
				$sqbData->setQuizName($row['quiz_name']);
				$sqbData->setQuizDesc($row['quiz_desc']);
				$sqbData->setQuizType($row['quiz_type']);
				$sqbData->setGradeQuiz($row['grade_quiz']);
				$sqbData->setProgressBar($row['progress_bar']);				
				$sqbData->setQuizDisplay($row['quiz_display']);	
				$sqbData->setQuizBlocking($row['quiz_blocking']);				
				//$sqbData->setDisplayOnFirstScreen($row['display_on_first_screen']);
				//$sqbData->setStartTemplate($row['start_template']);
				$sqbData->setQuizPassmark($row['quiz_passmark']);
				//$sqbData->setQuizShowAnswer($row['quiz_showanswer']);
				//$sqbData->setQuizShowResult($row['quiz_show_result']);
				$sqbData->setQuizAttemptsAllowed($row['quiz_attempts_allowed']);				
				$sqbData->setQuizPagination($row['quiz_pagination']);
				$sqbData->setQuestionPerPage($row['question_per_page']);
				$sqbData->setQuizTimer($row['quiz_timer']);
				$sqbData->setQuizTimerLimit($row['quiz_timer_limit']);
				$sqbData->setQuizScore($row['quiz_score']);
				$sqbData->setQuizPercentage($row['show_percentage']);	
				$sqbData->setShowForNotLoggedInUser($row['show_for_notloggedin_user']);	
				//$sqbData->setResultTemp($row['result_temp']);	
				$sqbData->setRedirectAfterComplete($row['redirect_after_complete']);	
				$sqbData->setQuestionDisplay($row['question_display']);	
				$sqbData->setNumberOfQuestion($row['number_of_question']);	
				$sqbData->setQuestionBankOption($row['question_bank_options']);	
				$sqbData->setQuestionsRandom($row['questions_random']);	
				$sqbData->setAnswersRandom($row['answers_random']);	
				$sqbData->setShowStartScreen($row['show_start_screen']);	
				$sqbData->setShowOptinScreen($row['show_optin_screen']);	
				$sqbData->setShowShareScreen($row['show_share_screen']);	
				$sqbData->setShowResultScreen($row['show_result_screen']);	
				$sqbData->setQuizShowFirstNameTemp($row['show_firstname_template']);	
				$sqbData->setQuizShowAnalyzingResult($row['show_analyzing_result']);	
				$sqbData->setQuizAnalyzingResultTime($row['show_analyzing_result_time']);	
				$sqbData->setTemplateDisplaySequence($row['template_display_sequence']);	
				$sqbData->setUserAddedMyEmailPlatform($row['user_added_my_email_platform']);	
				$sqbData->setUserAddedPlatform($row['user_added_platform']);
				$sqbData->setOutcomeType($row['outcome_type']);	
				$sqbData->setOutcomePage($row['outcome_page']);	
				$sqbData->setDisplayScoreOnPage($row['display_score_on_page']);	
				$sqbData->setDisplayCorrectAnsOnPage($row['display_correctans_on_page']);	
				$sqbData->setDisplayAnswerOptions($row['display_correctans_options']);	
				$sqbData->setDisplayQuesansOnOutcome($row['display_quesans_on_outcome']);	
				$sqbData->setOutcomeRedirectUrl($row['outcome_redirect_url']);		
				$sqbData->setUserOptinRedirect($row['user_opt_in_redirect']);		
				$sqbData->setUserOptinRedirectUrl($row['user_opt_in_redirect_url']);		
				$sqbData->setDate($row['date']);		
				$sqbData->setEnableBranching($row['enable_branching']);		
				$sqbData->setShowNextButton($row['show_next_button']);		
				$sqbData->setAlreadyTakeTheQuiz($row['already_take_the_quiz']);		
				$sqbData->setTotalAttempts($row['total_attempts']);		
				$sqbData->setQuizShowCorrectAnswer($row['quiz_show_correct_answer']);	
				$sqbData->setTemplate($row['template']);				 	
				$sqbData->setShowVideo($row['show_video']);				 	
				$sqbData->setVideoURL($row['video_url']);
				$sqbData->setPassCriteria($row['pass_criteria']); 			 	
				$sqbData->setStatus($row['status']);				 	
				$sqbData->setSqbInsertQuiz($row['sqb_insert_quiz']);				 	
				$sqbData->setAllowRetake($row['allow_retake']);				 	
				$sqbData->setQuizDisplayUrls($row['quiz_display_url']);				 	
				$sqbData->setQuizDisplayInUrls($row['quiz_display_in_url']);
				$sqbData->setQuizPopupTimeDelay($row['quiz_popup_time_delay']);
				$sqbData->setQuizPopupFrequency($row['quiz_popup_frequency']);
				$sqbData->setQuizPopupPosition($row['quiz_popup_position']);				 	
				$sqbData->setEmailVerification($row['quick_email_verification']);	
				$sqbData->setQuizSliderAnimation($row['quiz_slider_animation']);
				$sqbData->setQuizSliderAnimationOption($row['quiz_slider_animation_option']);
				$sqbData->setResultDisplayOption($row['result_display_option']);
				$sqbData->setQuestionsTopBorder($row['questions_top_border']);
				$sqbData->setTimerHtml($row['timer_html']);
				$sqbData->setTimerCustomizer($row['timer_customizer']);
				$sqbData->setTimerExpiredMsg($row['timer_expired_msg']); 			 	
				$sqbData->setEnableBackgroundImage($row['enable_background_image']); 
				$sqbData->setTransparentBackgroundSettings($row['transparent_background_settings']); 
				$sqbData->setCategory($row['category']); 					 	
				$sqbData->setOptinScreenPosition($row['opt_screen_position']); 	
				$sqbData->setWeightedScore($row['weighted_score']); 	
                $sqbData->setEmailNotificationSettings($row['email_notification_settings']); 	
				$sqbData->setAnsRecommendation($row['ans_recommendation']); 		
				$sqbData->setAnsTags($row['ans_tags']); 		
				$sqbData->setRecommendedNextButton($row['recommended_next_button']);
				$sqbData->setCustomizerStyles($row['customizer_styles']);
				$sqbData->setMoveQuestion($row['move_question']);
				$sqbData->setOutcomeScreen_Display($row['outcome_screen_display']);
				$sqbData->setOutcomeScreenChartsSettings($row['outcome_screen_charts_settings']);
				$sqbData->setCategoryOption($row['category_option']);
				$sqbData->setDoubleOptin($row['double_optin']);
				$sqbData->setCustomizerStyleSetting($row['customizer_style_setting']);
				$sqbData->setExitPopupValue($row['exit_popup_value']);
				$sqbData->setShowFirstnameOutcome($row['show_firstname_outcome']);
				$sqbData->setShowDownloadButton($row['show_download_button']);
				$sqbData->setDownloadPDFButtonHtml($row['download_pdf_button_html']);
				$sqbData->setPdfFrontLastImage($row['pdf_front_last_image']);
				$sqbData->setPollSettings($row['poll_settings']);
				$sqbData->setAllOtherOptions($row['all_other_options']);
				$sqbData->setAutoSubmitOptin($row['auto_submit_opt']);
				$sqbData->setQnsAds($row['qns_ads']);
				$sqbData->setAdsNextButton($row['ads_next_button']);
				$sqbData->setAdminEmail($row['admin_email']);
				$sqbData->setSendCopy($row['send_copy']);
				$sqbData->setGameAnimation($row['game_animations']);
				$sqbData->setGameAnimationsOptions($row['game_animations_options']);
				$sqbData->setShowBackButton($row['show_back_button']);
				$sqbData->setGlobalStyle($row['global_style']);
				$sqbData->setSettingLevel($row['setting_level']);
				


			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	} 
	
	public static function loadArrById($id) {
		 
		try {
			global $wpdb, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$row = false;
			if(isset($rows) && isset($rows[0])){
				 				
				$row = $rows[0];
							 	
			}
			return $row;
		}catch (Exception $e) {
			throw $e;
		}
	}
 
	 
	public static function load() {
		  
		try {
			global $wpdb, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$sql = "SELECT * FROM " . $tableName." where `pre_built` is NULL or `pre_built` = 'N'   ORDER BY id desc   ";		
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){				
				
					
					$sqbData = new SQB_Quiz();
					$sqbData->setId($row['id']);
					$sqbData->setQuizName($row['quiz_name']);
					$sqbData->setQuizDesc($row['quiz_desc']);
					$sqbData->setQuizType($row['quiz_type']);
					$sqbData->setGradeQuiz($row['grade_quiz']);
					$sqbData->setProgressBar($row['progress_bar']);				
					$sqbData->setQuizDisplay($row['quiz_display']);	
					$sqbData->setQuizBlocking($row['quiz_blocking']);				
					//$sqbData->setDisplayOnFirstScreen($row['display_on_first_screen']);
					//$sqbData->setStartTemplate($row['start_template']);
					$sqbData->setQuizPassmark($row['quiz_passmark']);
					//$sqbData->setQuizShowAnswer($row['quiz_showanswer']);
					//$sqbData->setQuizShowResult($row['quiz_show_result']);
					$sqbData->setQuizAttemptsAllowed($row['quiz_attempts_allowed']);				
					$sqbData->setQuizPagination($row['quiz_pagination']);
					$sqbData->setQuestionPerPage($row['question_per_page']);
					$sqbData->setQuizTimer($row['quiz_timer']);
					$sqbData->setQuizTimerLimit($row['quiz_timer_limit']);
					$sqbData->setQuizScore($row['quiz_score']);
					$sqbData->setQuizPercentage($row['show_percentage']);	
					$sqbData->setShowForNotLoggedInUser($row['show_for_notloggedin_user']);	
					//$sqbData->setResultTemp($row['result_temp']);	
					$sqbData->setRedirectAfterComplete($row['redirect_after_complete']);	
					$sqbData->setQuestionDisplay($row['question_display']);	
					$sqbData->setNumberOfQuestion($row['number_of_question']);	
					$sqbData->setQuestionBankOption($row['question_bank_options']);	
					$sqbData->setQuestionsRandom($row['questions_random']);	
					$sqbData->setAnswersRandom($row['answers_random']);	
					$sqbData->setShowStartScreen($row['show_start_screen']);	
					$sqbData->setShowOptinScreen($row['show_optin_screen']);
					$sqbData->setShowShareScreen($row['show_share_screen']);		
					$sqbData->setShowResultScreen($row['show_result_screen']);	
					$sqbData->setQuizShowFirstNameTemp($row['show_firstname_template']);	
					$sqbData->setQuizShowAnalyzingResult($row['show_analyzing_result']);	
					$sqbData->setQuizAnalyzingResultTime($row['show_analyzing_result_time']);	
					$sqbData->setTemplateDisplaySequence($row['template_display_sequence']);	
					$sqbData->setUserAddedMyEmailPlatform($row['user_added_my_email_platform']);	
					$sqbData->setUserAddedPlatform($row['user_added_platform']);
					$sqbData->setOutcomeType($row['outcome_type']);	
					$sqbData->setOutcomePage($row['outcome_page']);	
					$sqbData->setDisplayScoreOnPage($row['display_score_on_page']);	
					$sqbData->setDisplayCorrectAnsOnPage($row['display_correctans_on_page']);	
					$sqbData->setDisplayAnswerOptions($row['display_correctans_options']);	
					$sqbData->setDisplayQuesansOnOutcome($row['display_quesans_on_outcome']);	
					$sqbData->setOutcomeRedirectUrl($row['outcome_redirect_url']);		
					$sqbData->setUserOptinRedirect($row['user_opt_in_redirect']);		
					$sqbData->setUserOptinRedirectUrl($row['user_opt_in_redirect_url']);		
					$sqbData->setDate($row['date']);		
					$sqbData->setEnableBranching($row['enable_branching']);		
					$sqbData->setShowNextButton($row['show_next_button']);		
					$sqbData->setAlreadyTakeTheQuiz($row['already_take_the_quiz']);		
					$sqbData->setTotalAttempts($row['total_attempts']);		
					$sqbData->setQuizShowCorrectAnswer($row['quiz_show_correct_answer']);	
					$sqbData->setTemplate($row['template']);				 	
					$sqbData->setShowVideo($row['show_video']);				 	
					$sqbData->setVideoURL($row['video_url']);
					$sqbData->setPassCriteria($row['pass_criteria']); 			 	
					$sqbData->setStatus($row['status']);				 	
					$sqbData->setSqbInsertQuiz($row['sqb_insert_quiz']);				 	
					$sqbData->setAllowRetake($row['allow_retake']);				 	
					$sqbData->setQuizDisplayUrls($row['quiz_display_url']);				 	
					$sqbData->setQuizDisplayInUrls($row['quiz_display_in_url']);
					$sqbData->setQuizPopupTimeDelay($row['quiz_popup_time_delay']);
					$sqbData->setQuizPopupFrequency($row['quiz_popup_frequency']);
					$sqbData->setQuizPopupPosition($row['quiz_popup_position']);				 	
					$sqbData->setEmailVerification($row['quick_email_verification']);	
					$sqbData->setQuizSliderAnimation($row['quiz_slider_animation']);	
					$sqbData->setQuizSliderAnimationOption($row['quiz_slider_animation_option']);	
					$sqbData->setResultDisplayOption($row['result_display_option']);   
					$sqbData->setQuestionsTopBorder($row['questions_top_border']); 
					$sqbData->setTimerHtml($row['timer_html']);
					$sqbData->setTimerCustomizer($row['timer_customizer']);
					$sqbData->setTimerExpiredMsg($row['timer_expired_msg']);  
					$sqbData->setEnableBackgroundImage($row['enable_background_image']);  
					$sqbData->setCategory($row['category']); 		
					$sqbData->setPreBuilt($row['pre_built']); 		
					$sqbData->setTransparentBackgroundSettings($row['transparent_background_settings']);
					$sqbData->setOptinScreenPosition($row['opt_screen_position']); 
					$sqbData->setWeightedScore($row['weighted_score']);
                    $sqbData->setEmailNotificationSettings($row['email_notification_settings']); 	
					$sqbData->setAnsRecommendation($row['ans_recommendation']); 	
					$sqbData->setAnsTags($row['ans_tags']); 	
					$sqbData->setRecommendedNextButton($row['recommended_next_button']);  	
					$sqbData->setCustomizerStyles($row['customizer_styles']); 
					$sqbData->setMoveQuestion($row['move_question']); 	
					$sqbData->setOutcomeScreen_Display($row['outcome_screen_display']);
					$sqbData->setOutcomeScreenChartsSettings($row['outcome_screen_charts_settings']);
					$sqbData->setCategoryOption($row['category_option']);
					$sqbData->setCustomizerStyleSetting($row['customizer_style_setting']);
					$sqbData->setExitPopupValue($row['exit_popup_value']);
					$sqbData->setShowFirstnameOutcome($row['show_firstname_outcome']);
					$sqbData->setShowDownloadButton($row['show_download_button']);
					$sqbData->setDownloadPDFButtonHtml($row['download_pdf_button_html']);
					$sqbData->setPdfFrontLastImage($row['pdf_front_last_image']);
					$sqbData->setPollSettings($row['poll_settings']);
					$sqbData->setAllOtherOptions($row['all_other_options']);
					$sqbData->setAutoSubmitOptin($row['auto_submit_opt']);
					$sqbData->setQnsAds($row['qns_ads']);
					$sqbData->setAdsNextButton($row['ads_next_button']);
					$sqbData->setAdminEmail($row['admin_email']);
					$sqbData->setSendCopy($row['send_copy']);
					$sqbData->setGameAnimation($row['game_animations']);
					$sqbData->setGameAnimationsOptions($row['game_animations_options']);
					$sqbData->setShowBackButton($row['show_back_button']);
					$sqbData->setSettingLevel($row['setting_level']);
					$sqbArray[] = 	$sqbData;
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}     


	public static function loadbylimit($offset = 0, $no_of_row = 0) {
		  
		try {
			global $wpdb, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$sql = "SELECT * FROM " . $tableName." where `pre_built` is NULL or `pre_built` = 'N'   ORDER BY id desc  LIMIT ".$offset.", ".$no_of_row;	

			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){				
				
					
					$sqbData = new SQB_Quiz();
					$sqbData->setId($row['id']);
					$sqbData->setQuizName($row['quiz_name']);
					$sqbData->setQuizDesc($row['quiz_desc']);
					$sqbData->setQuizType($row['quiz_type']);
					$sqbData->setGradeQuiz($row['grade_quiz']);
					$sqbData->setProgressBar($row['progress_bar']);				
					$sqbData->setQuizDisplay($row['quiz_display']);	
					$sqbData->setQuizBlocking($row['quiz_blocking']);				
					//$sqbData->setDisplayOnFirstScreen($row['display_on_first_screen']);
					//$sqbData->setStartTemplate($row['start_template']);
					$sqbData->setQuizPassmark($row['quiz_passmark']);
					//$sqbData->setQuizShowAnswer($row['quiz_showanswer']);
					//$sqbData->setQuizShowResult($row['quiz_show_result']);
					$sqbData->setQuizAttemptsAllowed($row['quiz_attempts_allowed']);				
					$sqbData->setQuizPagination($row['quiz_pagination']);
					$sqbData->setQuestionPerPage($row['question_per_page']);
					$sqbData->setQuizTimer($row['quiz_timer']);
					$sqbData->setQuizTimerLimit($row['quiz_timer_limit']);
					$sqbData->setQuizScore($row['quiz_score']);
					$sqbData->setQuizPercentage($row['show_percentage']);	
					$sqbData->setShowForNotLoggedInUser($row['show_for_notloggedin_user']);	
					//$sqbData->setResultTemp($row['result_temp']);	
					$sqbData->setRedirectAfterComplete($row['redirect_after_complete']);	
					$sqbData->setQuestionDisplay($row['question_display']);	
					$sqbData->setNumberOfQuestion($row['number_of_question']);	
					$sqbData->setQuestionBankOption($row['question_bank_options']);	
					$sqbData->setQuestionsRandom($row['questions_random']);	
					$sqbData->setAnswersRandom($row['answers_random']);	
					$sqbData->setShowStartScreen($row['show_start_screen']);	
					$sqbData->setShowOptinScreen($row['show_optin_screen']);
					$sqbData->setShowShareScreen($row['show_share_screen']);		
					$sqbData->setShowResultScreen($row['show_result_screen']);	
					$sqbData->setQuizShowFirstNameTemp($row['show_firstname_template']);	
					$sqbData->setQuizShowAnalyzingResult($row['show_analyzing_result']);	
					$sqbData->setQuizAnalyzingResultTime($row['show_analyzing_result_time']);	
					$sqbData->setTemplateDisplaySequence($row['template_display_sequence']);	
					$sqbData->setUserAddedMyEmailPlatform($row['user_added_my_email_platform']);	
					$sqbData->setUserAddedPlatform($row['user_added_platform']);
					$sqbData->setOutcomeType($row['outcome_type']);	
					$sqbData->setOutcomePage($row['outcome_page']);	
					$sqbData->setDisplayScoreOnPage($row['display_score_on_page']);	
					$sqbData->setDisplayCorrectAnsOnPage($row['display_correctans_on_page']);	
					$sqbData->setDisplayAnswerOptions($row['display_correctans_options']);	
					$sqbData->setDisplayQuesansOnOutcome($row['display_quesans_on_outcome']);	
					$sqbData->setOutcomeRedirectUrl($row['outcome_redirect_url']);		
					$sqbData->setUserOptinRedirect($row['user_opt_in_redirect']);		
					$sqbData->setUserOptinRedirectUrl($row['user_opt_in_redirect_url']);		
					$sqbData->setDate($row['date']);		
					$sqbData->setEnableBranching($row['enable_branching']);		
					$sqbData->setShowNextButton($row['show_next_button']);		
					$sqbData->setAlreadyTakeTheQuiz($row['already_take_the_quiz']);		
					$sqbData->setTotalAttempts($row['total_attempts']);		
					$sqbData->setQuizShowCorrectAnswer($row['quiz_show_correct_answer']);	
					$sqbData->setTemplate($row['template']);				 	
					$sqbData->setShowVideo($row['show_video']);				 	
					$sqbData->setVideoURL($row['video_url']);
					$sqbData->setPassCriteria($row['pass_criteria']); 			 	
					$sqbData->setStatus($row['status']);				 	
					$sqbData->setSqbInsertQuiz($row['sqb_insert_quiz']);				 	
					$sqbData->setAllowRetake($row['allow_retake']);				 	
					$sqbData->setQuizDisplayUrls($row['quiz_display_url']);				 	
					$sqbData->setQuizDisplayInUrls($row['quiz_display_in_url']);
					$sqbData->setQuizPopupTimeDelay($row['quiz_popup_time_delay']);
					$sqbData->setQuizPopupFrequency($row['quiz_popup_frequency']);
					$sqbData->setQuizPopupPosition($row['quiz_popup_position']);				 	
					$sqbData->setEmailVerification($row['quick_email_verification']);	
					$sqbData->setQuizSliderAnimation($row['quiz_slider_animation']);	
					$sqbData->setQuizSliderAnimationOption($row['quiz_slider_animation_option']);	
					$sqbData->setResultDisplayOption($row['result_display_option']);   
					$sqbData->setQuestionsTopBorder($row['questions_top_border']); 
					$sqbData->setTimerHtml($row['timer_html']);
					$sqbData->setTimerCustomizer($row['timer_customizer']);
					$sqbData->setTimerExpiredMsg($row['timer_expired_msg']);  
					$sqbData->setEnableBackgroundImage($row['enable_background_image']);  
					$sqbData->setCategory($row['category']); 		
					$sqbData->setPreBuilt($row['pre_built']); 		
					$sqbData->setTransparentBackgroundSettings($row['transparent_background_settings']);
					$sqbData->setOptinScreenPosition($row['opt_screen_position']); 
					$sqbData->setWeightedScore($row['weighted_score']);
                    $sqbData->setEmailNotificationSettings($row['email_notification_settings']); 	
					$sqbData->setAnsRecommendation($row['ans_recommendation']); 	
					$sqbData->setAnsTags($row['ans_tags']); 	
					$sqbData->setRecommendedNextButton($row['recommended_next_button']);  	
					$sqbData->setCustomizerStyles($row['customizer_styles']); 
					$sqbData->setMoveQuestion($row['move_question']); 	
					$sqbData->setOutcomeScreen_Display($row['outcome_screen_display']);
					$sqbData->setOutcomeScreenChartsSettings($row['outcome_screen_charts_settings']);
					$sqbData->setCategoryOption($row['category_option']);
					$sqbData->setCustomizerStyleSetting($row['customizer_style_setting']);
					$sqbData->setExitPopupValue($row['exit_popup_value']);
					$sqbData->setShowFirstnameOutcome($row['show_firstname_outcome']);
					$sqbData->setShowDownloadButton($row['show_download_button']);
					$sqbData->setDownloadPDFButtonHtml($row['download_pdf_button_html']);
					$sqbData->setPdfFrontLastImage($row['pdf_front_last_image']);
					$sqbData->setPollSettings($row['poll_settings']);
					$sqbData->setAllOtherOptions($row['all_other_options']);
					$sqbData->setAutoSubmitOptin($row['auto_submit_opt']);
					$sqbData->setQnsAds($row['qns_ads']);
					$sqbData->setAdsNextButton($row['ads_next_button']);
					$sqbData->setAdminEmail($row['admin_email']);
					$sqbData->setSendCopy($row['send_copy']);
					$sqbData->setGameAnimation($row['game_animations']);
					$sqbData->setGameAnimationsOptions($row['game_animations_options']);
					$sqbData->setShowBackButton($row['show_back_button']);
					$sqbData->setSettingLevel($row['setting_level']);
					$sqbArray[] = 	$sqbData;
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}     
	

	 

	public static function loadQuizDataById($id) {
		try {
			global $wpdb, $sqb_quiz, $sqb_quiz_questions, $sqb_quiz_answers, $sqb_quiz_question_bank, $sqb_quiz_template;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$table_sqb_quiz_questions = $wpdb->prefix . $sqb_quiz_questions;
			$table_sqb_quiz_answers = $wpdb->prefix . $sqb_quiz_answers;
			$table_sqb_quiz_question_bank= $wpdb->prefix . $sqb_quiz_question_bank;
			$table_sqb_quiz_template= $wpdb->prefix . $sqb_quiz_template;
			$sql = "SELECT * FROM " . $tableName . " as q , " . $table_sqb_quiz_questions. " as qq, ".$table_sqb_quiz_answers." as qa ,  ". $table_sqb_quiz_question_bank." as qqb, " .$table_sqb_quiz_template. " as qt WHERE q.id ='".$id."'  AND qq.quiz_id ='".$id."' AND  qq.question_id = qa.question_id AND  qq.question_id = qqb.id AND qt.quiz_id ='".$id."' " ;
			//echo $sql;die;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			return $rows;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadQuizDataByIdAndOrder($id, $orderBy = 'asc') {
		try {
			global $wpdb, $sqb_quiz, $sqb_quiz_questions, $sqb_quiz_answers, $sqb_quiz_question_bank, $sqb_quiz_template;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$table_sqb_quiz_questions = $wpdb->prefix . $sqb_quiz_questions;
			$table_sqb_quiz_answers = $wpdb->prefix . $sqb_quiz_answers;
			$table_sqb_quiz_question_bank= $wpdb->prefix . $sqb_quiz_question_bank;
			$table_sqb_quiz_template= $wpdb->prefix . $sqb_quiz_template;
			$sql = "SELECT * FROM " . $tableName . " as q , " . $table_sqb_quiz_questions. " as qq, ".$table_sqb_quiz_question_bank." as qqb WHERE q.id ='".$id."'  AND qq.quiz_id ='".$id."'  AND qqb.id =qq.question_id  ORDER BY qqb.question_order ".$orderBy ;
		
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			return $rows;
		}catch (Exception $e) {
			throw $e;
		}	
	}


	public static function DeleteById($id = 0) {
		try {
			global $wpdb, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$wpdb->delete($tableName, array( 'id' => $id ) );
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
    
    
    public static function loadByTypeAndPageId($quiz_type = '', $page_id = 0) {
		try {
		    global $wpdb, $sqb_quiz;

		    $tableName = $wpdb->prefix . $sqb_quiz;

		    $sql = "SELECT * FROM " . $tableName . " WHERE `quiz_display` = %s AND `pre_built` = 'N'";
		    $rows = $wpdb->get_results($wpdb->prepare($sql, $quiz_type), ARRAY_A);

		    $data = null;

		    if (is_array($rows) && count($rows)) {
		        foreach ($rows as $row) {
		            $page_ids = $row['quiz_display_url'];

		            // Current page ID
		            $current_page_id = get_queried_object_id();
		            // Current full URL
		            $current_url = home_url( add_query_arg( null, null ) );


		            if (!empty($page_ids)) {
		                $page_ids_array = explode(',', $page_ids);

		                if (in_array($current_page_id, $page_ids_array) || in_array($current_url, $page_ids_array)) {
		                    $data = $row['id'];
		                    break;
		                }
		            }
		        }
		    }

		    return $data;
		} catch (Exception $e) {
		    throw $e;
		}
	}
	
	public static function loadPreBuiltTheme() {
		try {
			global $wpdb, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_quiz;
		
			$sql = "SELECT * FROM " . $tableName . " where `pre_built` = 'Y' ";
			
			$rows = $wpdb->get_results($sql, ARRAY_A);
	
			$data = null;
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){				
					$sqbData = new SQB_Quiz();
					$sqbData->setId($row['id']);
					$sqbData->setQuizName($row['quiz_name']);
					$sqbData->setQuizType($row['quiz_type']);
					$sqbData->setPreBuilt($row['pre_built']);
					$sqbData->setPreBuiltDetails($row['pre_built_details']);
					$sqbData->setTransparentBackgroundSettings($row['transparent_background_settings']);
					$data[] = $sqbData;
				}
			}
			
			return $data;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadByGlobalStyle() {
		 
		try {
			global $wpdb, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$sql = "SELECT * FROM " . $tableName . " WHERE `global_style` ='Y' AND `pre_built` = 'N' ORDER BY id desc " ;
	
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){				
				
					
					$sqbData = new SQB_Quiz();
					$sqbData->setId($row['id']);
					$sqbData->setQuizName($row['quiz_name']);
					$sqbData->setQuizDesc($row['quiz_desc']);
					$sqbData->setQuizType($row['quiz_type']);
					$sqbData->setGradeQuiz($row['grade_quiz']);
					$sqbData->setProgressBar($row['progress_bar']);				
					$sqbData->setQuizDisplay($row['quiz_display']);	
					$sqbData->setQuizBlocking($row['quiz_blocking']);				
					//$sqbData->setDisplayOnFirstScreen($row['display_on_first_screen']);
					//$sqbData->setStartTemplate($row['start_template']);
					$sqbData->setQuizPassmark($row['quiz_passmark']);
					//$sqbData->setQuizShowAnswer($row['quiz_showanswer']);
					//$sqbData->setQuizShowResult($row['quiz_show_result']);
					$sqbData->setQuizAttemptsAllowed($row['quiz_attempts_allowed']);				
					$sqbData->setQuizPagination($row['quiz_pagination']);
					$sqbData->setQuestionPerPage($row['question_per_page']);
					$sqbData->setQuizTimer($row['quiz_timer']);
					$sqbData->setQuizTimerLimit($row['quiz_timer_limit']);
					$sqbData->setQuizScore($row['quiz_score']);
					$sqbData->setQuizPercentage($row['show_percentage']);	
					$sqbData->setShowForNotLoggedInUser($row['show_for_notloggedin_user']);	
					//$sqbData->setResultTemp($row['result_temp']);	
					$sqbData->setRedirectAfterComplete($row['redirect_after_complete']);	
					$sqbData->setQuestionDisplay($row['question_display']);	
					$sqbData->setNumberOfQuestion($row['number_of_question']);	
					$sqbData->setQuestionBankOption($row['question_bank_options']);	
					$sqbData->setQuestionsRandom($row['questions_random']);	
					$sqbData->setAnswersRandom($row['answers_random']);	
					$sqbData->setShowStartScreen($row['show_start_screen']);	
					$sqbData->setShowOptinScreen($row['show_optin_screen']);	
					$sqbData->setShowShareScreen($row['show_share_screen']);	
					$sqbData->setShowResultScreen($row['show_result_screen']);	
					$sqbData->setQuizShowFirstNameTemp($row['show_firstname_template']);	
					$sqbData->setQuizShowAnalyzingResult($row['show_analyzing_result']);	
					$sqbData->setQuizAnalyzingResultTime($row['show_analyzing_result_time']);	
					$sqbData->setTemplateDisplaySequence($row['template_display_sequence']);	
					$sqbData->setUserAddedMyEmailPlatform($row['user_added_my_email_platform']);	
					$sqbData->setUserAddedPlatform($row['user_added_platform']);
					$sqbData->setOutcomeType($row['outcome_type']);	
					$sqbData->setOutcomePage($row['outcome_page']);	
					$sqbData->setDisplayScoreOnPage($row['display_score_on_page']);	
					$sqbData->setDisplayCorrectAnsOnPage($row['display_correctans_on_page']);	
					$sqbData->setDisplayAnswerOptions($row['display_correctans_options']);	
					$sqbData->setDisplayQuesansOnOutcome($row['display_quesans_on_outcome']);	
					$sqbData->setOutcomeRedirectUrl($row['outcome_redirect_url']);		
					$sqbData->setUserOptinRedirect($row['user_opt_in_redirect']);		
					$sqbData->setUserOptinRedirectUrl($row['user_opt_in_redirect_url']);		
					$sqbData->setDate($row['date']);		
					$sqbData->setEnableBranching($row['enable_branching']);		
					$sqbData->setShowNextButton($row['show_next_button']);		
					$sqbData->setAlreadyTakeTheQuiz($row['already_take_the_quiz']);		
					$sqbData->setTotalAttempts($row['total_attempts']);		
					$sqbData->setQuizShowCorrectAnswer($row['quiz_show_correct_answer']);	
					$sqbData->setTemplate($row['template']);				 	
					$sqbData->setShowVideo($row['show_video']);				 	
					$sqbData->setVideoURL($row['video_url']);
					$sqbData->setPassCriteria($row['pass_criteria']); 			 	
					$sqbData->setStatus($row['status']);				 	
					$sqbData->setSqbInsertQuiz($row['sqb_insert_quiz']);				 	
					$sqbData->setAllowRetake($row['allow_retake']);				 	
					$sqbData->setQuizDisplayUrls($row['quiz_display_url']);				 	
					$sqbData->setQuizDisplayInUrls($row['quiz_display_in_url']);
					$sqbData->setQuizPopupTimeDelay($row['quiz_popup_time_delay']);
					$sqbData->setQuizPopupFrequency($row['quiz_popup_frequency']);
					$sqbData->setQuizPopupPosition($row['quiz_popup_position']);				 	
					$sqbData->setEmailVerification($row['quick_email_verification']);	
					$sqbData->setQuizSliderAnimation($row['quiz_slider_animation']);	
					$sqbData->setQuizSliderAnimationOption($row['quiz_slider_animation_option']);	
					$sqbData->setResultDisplayOption($row['result_display_option']);   
					$sqbData->setQuestionsTopBorder($row['questions_top_border']); 
					$sqbData->setTimerHtml($row['timer_html']);
					$sqbData->setTimerCustomizer($row['timer_customizer']);
					$sqbData->setTimerExpiredMsg($row['timer_expired_msg']);  
					$sqbData->setEnableBackgroundImage($row['enable_background_image']);  
					$sqbData->setCategory($row['category']); 		
					$sqbData->setPreBuilt($row['pre_built']); 		
					$sqbData->setTransparentBackgroundSettings($row['transparent_background_settings']);
					$sqbData->setMoveQuestion($row['move_question']);
					$sqbData->setOutcomeScreen_Display($row['outcome_screen_display']);
					$sqbData->setOutcomeScreenChartsSettings($row['outcome_screen_charts_settings']);
					$sqbData->setCategoryOption($row['category_option']);
					$sqbData->setCustomizerStyleSetting($row['customizer_style_setting']);
					$sqbData->setExitPopupValue($row['exit_popup_value']);
					$sqbData->setShowFirstnameOutcome($row['show_firstname_outcome']);
					$sqbData->setShowDownloadButton($row['show_download_button']);
					$sqbData->setDownloadPDFButtonHtml($row['download_pdf_button_html']);
					$sqbData->setPdfFrontLastImage($row['pdf_front_last_image']);
					$sqbData->setPollSettings($row['poll_settings']);
					$sqbData->setAllOtherOptions($row['all_other_options']);
					$sqbData->setAutoSubmitOptin($row['auto_submit_opt']);
					$sqbData->setQnsAds($row['qns_ads']);
					$sqbData->setAdsNextButton($row['ads_next_button']);
					$sqbData->setAdminEmail($row['admin_email']);
					$sqbData->setSendCopy($row['send_copy']);
					$sqbData->setGameAnimation($row['game_animations']);
					$sqbData->setGameAnimationsOptions($row['game_animations_options']);
					$sqbData->setShowBackButton($row['show_back_button']);
					$sqbData->setSettingLevel($row['setting_level']);
					$sqbArray[] = 	$sqbData;
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}	

	public static function loadByType($type) {
		 
		try {
			global $wpdb, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_type` ='".$type."' AND `pre_built` = 'N' ORDER BY id desc " ;
	
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){				
				
					
					$sqbData = new SQB_Quiz();
					$sqbData->setId($row['id']);
					$sqbData->setQuizName($row['quiz_name']);
					$sqbData->setQuizDesc($row['quiz_desc']);
					$sqbData->setQuizType($row['quiz_type']);
					$sqbData->setGradeQuiz($row['grade_quiz']);
					$sqbData->setProgressBar($row['progress_bar']);				
					$sqbData->setQuizDisplay($row['quiz_display']);	
					$sqbData->setQuizBlocking($row['quiz_blocking']);				
					//$sqbData->setDisplayOnFirstScreen($row['display_on_first_screen']);
					//$sqbData->setStartTemplate($row['start_template']);
					$sqbData->setQuizPassmark($row['quiz_passmark']);
					//$sqbData->setQuizShowAnswer($row['quiz_showanswer']);
					//$sqbData->setQuizShowResult($row['quiz_show_result']);
					$sqbData->setQuizAttemptsAllowed($row['quiz_attempts_allowed']);				
					$sqbData->setQuizPagination($row['quiz_pagination']);
					$sqbData->setQuestionPerPage($row['question_per_page']);
					$sqbData->setQuizTimer($row['quiz_timer']);
					$sqbData->setQuizTimerLimit($row['quiz_timer_limit']);
					$sqbData->setQuizScore($row['quiz_score']);
					$sqbData->setQuizPercentage($row['show_percentage']);	
					$sqbData->setShowForNotLoggedInUser($row['show_for_notloggedin_user']);	
					//$sqbData->setResultTemp($row['result_temp']);	
					$sqbData->setRedirectAfterComplete($row['redirect_after_complete']);	
					$sqbData->setQuestionDisplay($row['question_display']);	
					$sqbData->setNumberOfQuestion($row['number_of_question']);	
					$sqbData->setQuestionBankOption($row['question_bank_options']);	
					$sqbData->setQuestionsRandom($row['questions_random']);	
					$sqbData->setAnswersRandom($row['answers_random']);	
					$sqbData->setShowStartScreen($row['show_start_screen']);	
					$sqbData->setShowOptinScreen($row['show_optin_screen']);	
					$sqbData->setShowShareScreen($row['show_share_screen']);	
					$sqbData->setShowResultScreen($row['show_result_screen']);	
					$sqbData->setQuizShowFirstNameTemp($row['show_firstname_template']);	
					$sqbData->setQuizShowAnalyzingResult($row['show_analyzing_result']);	
					$sqbData->setQuizAnalyzingResultTime($row['show_analyzing_result_time']);	
					$sqbData->setTemplateDisplaySequence($row['template_display_sequence']);	
					$sqbData->setUserAddedMyEmailPlatform($row['user_added_my_email_platform']);	
					$sqbData->setUserAddedPlatform($row['user_added_platform']);
					$sqbData->setOutcomeType($row['outcome_type']);	
					$sqbData->setOutcomePage($row['outcome_page']);	
					$sqbData->setDisplayScoreOnPage($row['display_score_on_page']);	
					$sqbData->setDisplayCorrectAnsOnPage($row['display_correctans_on_page']);	
					$sqbData->setDisplayAnswerOptions($row['display_correctans_options']);	
					$sqbData->setDisplayQuesansOnOutcome($row['display_quesans_on_outcome']);	
					$sqbData->setOutcomeRedirectUrl($row['outcome_redirect_url']);		
					$sqbData->setUserOptinRedirect($row['user_opt_in_redirect']);		
					$sqbData->setUserOptinRedirectUrl($row['user_opt_in_redirect_url']);		
					$sqbData->setDate($row['date']);		
					$sqbData->setEnableBranching($row['enable_branching']);		
					$sqbData->setShowNextButton($row['show_next_button']);		
					$sqbData->setAlreadyTakeTheQuiz($row['already_take_the_quiz']);		
					$sqbData->setTotalAttempts($row['total_attempts']);		
					$sqbData->setQuizShowCorrectAnswer($row['quiz_show_correct_answer']);	
					$sqbData->setTemplate($row['template']);				 	
					$sqbData->setShowVideo($row['show_video']);				 	
					$sqbData->setVideoURL($row['video_url']);
					$sqbData->setPassCriteria($row['pass_criteria']); 			 	
					$sqbData->setStatus($row['status']);				 	
					$sqbData->setSqbInsertQuiz($row['sqb_insert_quiz']);				 	
					$sqbData->setAllowRetake($row['allow_retake']);				 	
					$sqbData->setQuizDisplayUrls($row['quiz_display_url']);				 	
					$sqbData->setQuizDisplayInUrls($row['quiz_display_in_url']);
					$sqbData->setQuizPopupTimeDelay($row['quiz_popup_time_delay']);
					$sqbData->setQuizPopupFrequency($row['quiz_popup_frequency']);
					$sqbData->setQuizPopupPosition($row['quiz_popup_position']);				 	
					$sqbData->setEmailVerification($row['quick_email_verification']);	
					$sqbData->setQuizSliderAnimation($row['quiz_slider_animation']);	
					$sqbData->setQuizSliderAnimationOption($row['quiz_slider_animation_option']);	
					$sqbData->setResultDisplayOption($row['result_display_option']);   
					$sqbData->setQuestionsTopBorder($row['questions_top_border']); 
					$sqbData->setTimerHtml($row['timer_html']);
					$sqbData->setTimerCustomizer($row['timer_customizer']);
					$sqbData->setTimerExpiredMsg($row['timer_expired_msg']);  
					$sqbData->setEnableBackgroundImage($row['enable_background_image']);  
					$sqbData->setCategory($row['category']); 		
					$sqbData->setPreBuilt($row['pre_built']); 		
					$sqbData->setTransparentBackgroundSettings($row['transparent_background_settings']);
					$sqbData->setMoveQuestion($row['move_question']);
					$sqbData->setOutcomeScreen_Display($row['outcome_screen_display']);
					$sqbData->setOutcomeScreenChartsSettings($row['outcome_screen_charts_settings']);
					$sqbData->setCategoryOption($row['category_option']);
					$sqbData->setCustomizerStyleSetting($row['customizer_style_setting']);
					$sqbData->setExitPopupValue($row['exit_popup_value']);
					$sqbData->setShowFirstnameOutcome($row['show_firstname_outcome']);
					$sqbData->setShowDownloadButton($row['show_download_button']);
					$sqbData->setDownloadPDFButtonHtml($row['download_pdf_button_html']);
					$sqbData->setPdfFrontLastImage($row['pdf_front_last_image']);
					$sqbData->setPollSettings($row['poll_settings']);
					$sqbData->setAllOtherOptions($row['all_other_options']);
					$sqbData->setAutoSubmitOptin($row['auto_submit_opt']);
					$sqbData->setQnsAds($row['qns_ads']);
					$sqbData->setAdsNextButton($row['ads_next_button']);
					$sqbData->setAdminEmail($row['admin_email']);
					$sqbData->setSendCopy($row['send_copy']);
					$sqbData->setGameAnimation($row['game_animations']);
					$sqbData->setGameAnimationsOptions($row['game_animations_options']);
					$sqbData->setShowBackButton($row['show_back_button']);
					$sqbData->setSettingLevel($row['setting_level']);
					$sqbArray[] = 	$sqbData;
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByPopup($id = 0,$search_by = '') {
		 
		try {
			
			global $wpdb, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_display` <> 'inpage' && `quiz_display` <> 'popup'" ;

			if(!empty($id) && $search_by != 'search_page'){
				$sql .= " AND id = '".$id."'";
			}

			if($search_by == 'search_page'){
				$sql .= " AND FIND_IN_SET(".$id.", quiz_display_url)";
			}
		
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){				
				
					
					$sqbData = new SQB_Quiz();
					$sqbData->setId($row['id']);
					$sqbData->setQuizName($row['quiz_name']);
					$sqbData->setQuizDesc($row['quiz_desc']);
					$sqbData->setQuizType($row['quiz_type']);
					$sqbData->setGradeQuiz($row['grade_quiz']);
					$sqbData->setProgressBar($row['progress_bar']);				
					$sqbData->setQuizDisplay($row['quiz_display']);	
					$sqbData->setQuizBlocking($row['quiz_blocking']);				
					//$sqbData->setDisplayOnFirstScreen($row['display_on_first_screen']);
					//$sqbData->setStartTemplate($row['start_template']);
					$sqbData->setQuizPassmark($row['quiz_passmark']);
					//$sqbData->setQuizShowAnswer($row['quiz_showanswer']);
					//$sqbData->setQuizShowResult($row['quiz_show_result']);
					$sqbData->setQuizAttemptsAllowed($row['quiz_attempts_allowed']);				
					$sqbData->setQuizPagination($row['quiz_pagination']);
					$sqbData->setQuestionPerPage($row['question_per_page']);
					$sqbData->setQuizTimer($row['quiz_timer']);
					$sqbData->setQuizTimerLimit($row['quiz_timer_limit']);
					$sqbData->setQuizScore($row['quiz_score']);
					$sqbData->setQuizPercentage($row['show_percentage']);	
					$sqbData->setShowForNotLoggedInUser($row['show_for_notloggedin_user']);	
					//$sqbData->setResultTemp($row['result_temp']);	
					$sqbData->setRedirectAfterComplete($row['redirect_after_complete']);	
					$sqbData->setQuestionDisplay($row['question_display']);	
					$sqbData->setNumberOfQuestion($row['number_of_question']);	
					$sqbData->setQuestionBankOption($row['question_bank_options']);	
					$sqbData->setQuestionsRandom($row['questions_random']);	
					$sqbData->setAnswersRandom($row['answers_random']);	
					$sqbData->setShowStartScreen($row['show_start_screen']);	
					$sqbData->setShowOptinScreen($row['show_optin_screen']);	
					$sqbData->setShowShareScreen($row['show_share_screen']);	
					$sqbData->setShowResultScreen($row['show_result_screen']);	
					$sqbData->setQuizShowFirstNameTemp($row['show_firstname_template']);	
					$sqbData->setQuizShowAnalyzingResult($row['show_analyzing_result']);	
					$sqbData->setQuizAnalyzingResultTime($row['show_analyzing_result_time']);	
					$sqbData->setTemplateDisplaySequence($row['template_display_sequence']);	
					$sqbData->setUserAddedMyEmailPlatform($row['user_added_my_email_platform']);	
					$sqbData->setUserAddedPlatform($row['user_added_platform']);
					$sqbData->setOutcomeType($row['outcome_type']);	
					$sqbData->setOutcomePage($row['outcome_page']);	
					$sqbData->setDisplayScoreOnPage($row['display_score_on_page']);	
					$sqbData->setDisplayCorrectAnsOnPage($row['display_correctans_on_page']);	
					$sqbData->setDisplayAnswerOptions($row['display_correctans_options']);	
					$sqbData->setDisplayQuesansOnOutcome($row['display_quesans_on_outcome']);	
					$sqbData->setOutcomeRedirectUrl($row['outcome_redirect_url']);		
					$sqbData->setUserOptinRedirect($row['user_opt_in_redirect']);		
					$sqbData->setUserOptinRedirectUrl($row['user_opt_in_redirect_url']);		
					$sqbData->setDate($row['date']);		
					$sqbData->setEnableBranching($row['enable_branching']);		
					$sqbData->setShowNextButton($row['show_next_button']);		
					$sqbData->setAlreadyTakeTheQuiz($row['already_take_the_quiz']);		
					$sqbData->setTotalAttempts($row['total_attempts']);		
					$sqbData->setQuizShowCorrectAnswer($row['quiz_show_correct_answer']);	
					$sqbData->setTemplate($row['template']);				 	
					$sqbData->setShowVideo($row['show_video']);				 	
					$sqbData->setVideoURL($row['video_url']);
					$sqbData->setPassCriteria($row['pass_criteria']); 			 	
					$sqbData->setStatus($row['status']);				 	
					$sqbData->setSqbInsertQuiz($row['sqb_insert_quiz']);				 	
					$sqbData->setAllowRetake($row['allow_retake']);				 	
					$sqbData->setQuizDisplayUrls($row['quiz_display_url']);				 	
					$sqbData->setQuizDisplayInUrls($row['quiz_display_in_url']);
					$sqbData->setQuizPopupTimeDelay($row['quiz_popup_time_delay']);
					$sqbData->setQuizPopupFrequency($row['quiz_popup_frequency']);
					$sqbData->setQuizPopupPosition($row['quiz_popup_position']);				 	
					$sqbData->setEmailVerification($row['quick_email_verification']);	
					$sqbData->setQuizSliderAnimation($row['quiz_slider_animation']);	
					$sqbData->setQuizSliderAnimationOption($row['quiz_slider_animation_option']);	
					$sqbData->setResultDisplayOption($row['result_display_option']);   
					$sqbData->setQuestionsTopBorder($row['questions_top_border']); 
					$sqbData->setTimerHtml($row['timer_html']);
					$sqbData->setTimerCustomizer($row['timer_customizer']);
					$sqbData->setTimerExpiredMsg($row['timer_expired_msg']);  
					$sqbData->setEnableBackgroundImage($row['enable_background_image']);  
					$sqbData->setCategory($row['category']); 		
					$sqbData->setPreBuilt($row['pre_built']); 		
					$sqbData->setTransparentBackgroundSettings($row['transparent_background_settings']);
					$sqbData->setMoveQuestion($row['move_question']);
					$sqbData->setOutcomeScreen_Display($row['outcome_screen_display']);
					$sqbData->setOutcomeScreenChartsSettings($row['outcome_screen_charts_settings']);
					$sqbData->setCategoryOption($row['category_option']);
					$sqbData->setCustomizerStyleSetting($row['customizer_style_setting']);
					$sqbData->setExitPopupValue($row['exit_popup_value']);
					$sqbData->setShowFirstnameOutcome($row['show_firstname_outcome']);
					$sqbData->setShowDownloadButton($row['show_download_button']);
					$sqbData->setDownloadPDFButtonHtml($row['download_pdf_button_html']);
					$sqbData->setPdfFrontLastImage($row['pdf_front_last_image']);
					$sqbData->setPollSettings($row['poll_settings']);
					$sqbData->setAllOtherOptions($row['all_other_options']);
					$sqbData->setAutoSubmitOptin($row['auto_submit_opt']);
					$sqbData->setQnsAds($row['qns_ads']);
					$sqbData->setAdsNextButton($row['ads_next_button']);
					$sqbData->setAdminEmail($row['admin_email']);
					$sqbData->setSendCopy($row['send_copy']);
					$sqbData->setGameAnimation($row['game_animations']);
					$sqbData->setGameAnimationsOptions($row['game_animations_options']);
					$sqbData->setShowBackButton($row['show_back_button']);
					$sqbData->setSettingLevel($row['setting_level']);
					$sqbArray[] = 	$sqbData;
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public function updateDoubleOptinData($quiz_id = 0,  $double_optin = ''){
		try {
			global $wpdb, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_quiz;
			$data = array(
				'double_optin'=> $double_optin,
			);
			$wpdb->update($tableName,$data,array('id'=>$quiz_id),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
}	
