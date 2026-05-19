<div class="question_tab_to_main_heading_wrapper formula-screen-preview">
	<div class="preview-section ml-auto">
		<a data-toggle="modal" data-target="#openpreview" class="btn sqb_transprent_btn sb-preview-quiz" href="javascript:void(0)">Preview Quiz</a>
	</div>
</div>

<div class="quiz-card-outer-gray formula-outer">
	<div class="sqbv2-main-template">
		<div class="sqbv2-left-side-template">
			<div class="Template-Customize-content">
				<div class="formula-content-left">
					<h2 class="formula-heading">Select questions/results that want to add to your formula </h2>

					<div class="formula-question-list">
					</div>
				</div>

				<div class="formula-content-right">
					<div class="d-flex align-items-center mb-3">
						<div class="slc-formula-title" style="display:none;"> <div class="input-group"> <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1">Title</span> </div> <input type="text" name="formula_title" id="formula_title" value="" placeholder="Enter Title" class="form-control"> </div> </div>
						<!-- <input type="text" name="formula_title" id="formula_title" value="" placeholder="Formula Title"> -->
						<!-- <span class="formula_title pr-3"></span> -->
						<a href="javascript:void(0);" class="add-formula sqb-add-formula ml-auto mb-0" style="white-space: nowrap;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Formula </a>
					</div>
					<div class="sqb-formula-fields">

						<textarea class="form-control" id="name_formula" name="name_formula" rows="4" cols="50" placeholder="e.g. (Q1 + Q2) * (Q4 / Q5)"></textarea>
						<input type="hidden" id="edit_formula_id" value="">
						<div class="shortcode_details validation_message" style="display:none;"></div>
						<div class="shortcode_details sucess_message" style="display:none;">Saved successfully.</div>
						<div class="formula-actions">
							<a href="javascript:void(0)" class="formula-actions-btn" id="sqb_save_formula">Save Formula</a>
						</div>
					</div>
					<div id="sqb_formula_list"></div>
				</div>
			</div>
		</div>
		<div class="sqbv2-right-side-customizer">
			<div class="Template-Customize-setting-outer">
				<div class="Template-Customize-Setting ">
					<div class="showHideLeftSidebaroptions">
						<h3 class="Template-Customize_heading">Formula Setting
							<div class="customize_open_close">
								<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
								<i class="fa fa-angle-down customize_open" aria-hidden="true"></i>
							</div>
						</h3>
					</div>

					<div class="customizer_innner_sections">
						<div class="Template-Customize-element Template5_customizer sqb_common_customizer" style="">
							<div class="Template-Customize-element-inner mt-3" style="display: block;">
								<div class="inner_template_style_box">
									<h4>Add Variable:</h4>
									<div class="formula-variable-list mt-3">
										<span class="formula-variable-item" data-formula-sign="+"> + </span>
										<span class="formula-variable-item" data-formula-sign="-"> - </span>
										<span class="formula-variable-item" data-formula-sign="*"> * </span>
										<span class="formula-variable-item" data-formula-sign="/"> / </span>
										<span class="formula-variable-item" data-formula-sign="^"> ^(power) </span>
										<span class="formula-variable-item" data-formula-sign="if"> IF statement </span>
										<span class="formula-variable-item" data-formula-sign="ifand"> IF X And Y </span>
										<span class="formula-variable-item" data-formula-sign="ifor"> IF X OR Y </span>
										<span class="formula-variable-item" data-formula-sign="round"> round </span>
										<span class="formula-variable-item" data-formula-sign="floor"> floor </span>
										<span class="formula-variable-item" data-formula-sign="ceil"> ceil </span>
										<span class="formula-variable-item" data-formula-sign="log"> log </span>
									</div>
								</div>
								<div class="show-messages" style="display:none"></div>
							</div>

							<div class="Template-Customize-element-inner" style="display: block;">
								<div class="inner_template_style_box">
									<h4>Unit of Variable:</h4>
									<div class="input-group mt-3 mb-2">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">PREFIX</span>
										</div>
										<input type="text" class="form-control" placeholder="$" id="formula-prefix" aria-describedby="basic-addon1">
									</div>
									<div class="input-group mb-0">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">SUFFIX</span>
										</div>
										<input type="text" class="form-control" placeholder="%" id="formula-suffix" aria-describedby="basic-addon1">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	


	

	<div class="quiz-actions">
		<a href="javascript:void(0)" class="quiz--btn quiz-prev-btn" onclick="sqb_next_tab('Quiz-Screen-Settings')"> Previous </a>
		<!--<a href="javascript:void(0)" class="quiz--btn quiz-save-btn" onclick="sqb_save_quiz('Formula-Screen')"> Save </a>-->
		<a href="javascript:void(0)" class="quiz--btn quiz-next-btn" onclick="sqb_save_quiz('Opt-Screen-Settings','next','formula_tab')"> Save & Next </a>
	</div>
</div>
