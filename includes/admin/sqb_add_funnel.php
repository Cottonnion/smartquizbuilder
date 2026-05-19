<?php


?>

<div class="Quiz-Funnel-outer quiz_outer">
<?php 

echo sqbGetLoaderHtml();
$page  = '';
if(isset($_GET['page'])){
	$page = $_GET['page'];
}
include_once('sqb_header.php');
?>

<?php 
		$current_version_plugin = rand(10,10000);
		//wp_enqueue_script("sqb_sortable_jquery_ui", "//cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.3/cjs/popper.min.js", array('jquery')); 
		wp_enqueue_script("sqb_add_funnel_js",plugin_dir_url(__FILE__)."../js/sqb_add_funnel.js", false, $current_version_plugin );
	//	wp_enqueue_script("sqb_funnel_drawflow_js",plugin_dir_url(__FILE__)."../js/sqb_funnel_drawflow.js", false, $current_version_plugin );
		//wp_enqueue_style("sqb_add_funnel_css",plugin_dir_url(__FILE__)."../css/sqb_add_funnel.css", false, $current_version_plugin );
		wp_enqueue_style("sqb_questions_css",plugin_dir_url(__FILE__)."../css/sqb_questions.css", false, $current_version_plugin );
		
		
		
		$quizData = SQB_Quiz::load();
		
		$csspath =  plugin_dir_url(__FILE__)."../css/sqb_add_funnel.css?v=456456";			
?>
	  <!--script src="https://cdn.jsdelivr.net/gh/jerosoler/Drawflow/dist/drawflow.min.js"></script-->
	  <script src="<?php echo plugin_dir_url(__FILE__);?>../js/sqb_drawflow.min.js?v=<?php echo rand(10,1000);?>"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/jerosoler/Drawflow/dist/drawflow.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
	  <?php 
	  	$ip = $_SERVER['REMOTE_ADDR'];
    	$gdprcountry = sqbGetGDPRStatus($ip);
    	$is_googlefont = get_option('sqb_google_font_option', true);


    	if($gdprcountry != 1 && $is_googlefont != 'N'){

	  ?>
	  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
		<?php } ?> 
	  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	  <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
	  <script src="<?php echo plugin_dir_url(__FILE__);?>../js/sqb_funnel_drawflow.js?v=<?php echo rand(10,1000);?>"></script>
	  
				
<link href="<?= $csspath ?>" rel="stylesheet">
				
	<section class="quizfunnel-section">
		<input type="hidden" value="" class="funnelId">
		<div class="quizfunnel-container">
			<h5 class="quizfunnel--sub-title">Quiz Funnel</h5>
			<div class="quizfunnel-card-outer-gray">				
				<div class="quizfunnel-content-card">
					<label for="" class="quizfunnel_label">Name</label>
					<div class="quizfunnel_right-content">
						<div class="dropdown dropdown-custom-style enter_funnel_name_select">
							<button class="dropdown-toggle" id="enter_funnel_name_select-id" type="button"  aria-haspopup="true" aria-expanded="false" data-value="0">Select a Quiz</button>
							<div class="dropdown-menu" aria-labelledby="enter_funnel_name_select-id">
								<form class="px-4 py-2">
							      <input type="search" class="form-control funnel-search" placeholder="Enter name..." autofocus="autofocus">
							    </form>
								<?php 
									if(isset($quizData)){
										foreach($quizData as $data){
											if($data->getQuizType() != 'calculator'){
												$funnel_selected = '';
												if(isset($_GET['id']) && ($data->getId() == $_GET['id'])){
													$funnel_selected = 'selected';
												}
												echo '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$data->getId().'" '.$funnel_selected.'>'.stripslashes($data->getQuizName()).' (id: '.$data->getId().')</a>';
											}
											//echo '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$data->getId().'" '.$funnel_selected.'>'.$data->getQuizName().'</a>';
										}
									}
								?>
							</div>
						</div>
						<!--input type="text" class="enter_funnel_name_text" value="" placeholder="Enter Name"-->
						<!--button class="enter_funnel_name_next" onclick="sqb_load_funnel()">Next</button-->
						
						<div class="funnel_enable_branching_toggle_btn" style="display:none">
							<label>Activate Branching</label>
							<div class="square-switch_onoff">
								<input class="checkbox" name="progress_bar" type="checkbox" id="funnel_enable_branching" value="Y" checked="checked">
								<label for="funnel_enable_branching"></label>
							</div>
						</div>
						<button  class="sqb_funnel_save_btn" onclick="sqb_funnel_save()" style="display:none"> Save </button>
						<button  class="sqb_funnel_reload_and_reset_question_btn" onclick="sqb_reload_and_reset_question()" style="display:none"> Reload New Questions </button>
						<button  class="sqb_funnel_reload_and_reset_question_btn" onclick="sqb_funnel_reset_connections()" style="display:none"> Reset Connections</button>
						
						
						
					</div>
				</div>

				<div class="quizfunnel-zoom-options">					
					<i class="fas fa-search-minus" onclick="editor.zoom_out()"></i>
					<i class="fas fa-search" onclick="editor.zoom_reset()"></i>
					<i class="fas fa-search-plus" onclick="editor.zoom_in()"></i>
					<!--a class="zoom-button" onclick="zoomOut()"><i class="fa fa-search-minus" aria-hidden="true"></i></a>
					<a class="zoom-button" onclick="zoomIn()"><i class="fa fa-search-plus" aria-hidden="true"></i></a-->
				</div>
				

			<div class="quizfunnel-card-outer-gray">
				<div class="wrapper allNodesMainOuterWrapper">	  
					<div class="col-right">
						<div id="drawflow" ondrop="drop(event)" ondragover="allowDrop(event)">
						</div>
					</div>
				</div>		   
			</div>

			<div class="quizfunnel-actions justify-content-end">
				<button class="sqb_funnel_save_btn" onclick="sqb_funnel_save()" style="display:none"> Save </button>
			</div>

		   </div>

		</div>
	</section>


	<script>
		var id = document.getElementById("drawflow");
		const editor = new Drawflow(id);
	</script>

</div>
