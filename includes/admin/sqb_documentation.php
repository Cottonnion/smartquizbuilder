<link rel='stylesheet' id='sqb_bootstrap.min-css'  href='//stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css?ver=4.1.0' media='all' />
<link rel='stylesheet' id='font-awesome-css-css'  href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' media='all' />
<link href="<?php echo plugin_dir_url(__FILE__);?>../../includes/css/sqb_quiz.css" rel="stylesheet">
<script src='//stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js?ver=4.1.0'></script>

<?php include_once('sqb_header.php'); ?>
  <script>
 jQuery(document).ready(function(){
	 jQuery(document).on('click','#Quiz-left-Tabs a ',function(){	
		var tab_id =jQuery(this).attr('href');			 
		jQuery('#Quiz-TabContent .tab-pane').removeClass('active show');
		jQuery('#Quiz-TabContent '+tab_id).addClass('active show');
		 
	});  
});  

</script>
<section class="quiz-section quiz_outer Quiz-documentation">
	<div class="quiz-container">
		<!--h1 class="logo-brand"><i class="fa fa-cube" aria-hidden="true"></i> Smart Quiz Builder Plugin Documentation </h1-->
		<div class="Quiz--tabs-outer">
			<div class="Quiz-left-tab-outer">
				<div class="Quiz-left-logo">
					<img src="<?php echo $img_logo = plugin_dir_url(__FILE__)."../../includes/images/smartquizbuilder-logo.png";?>" alt="logo" style="max-width: 130px; float: left;">
				</div>
				<ul class="nav nav-tabs" id="Quiz-left-Tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="quiztype-tab" data-toggle="tab" href="#quiztype" role="tab" aria-controls="home" aria-selected="true"><label>Quiz Type</label>
							<i class="fa fa-plus" aria-hidden="true"></i></a>
					</li>

					<li class="nav-item">
						<a class="nav-link" id="tour-tab" data-toggle="tab" href="#tour" role="tab" aria-controls="home" aria-selected="true"><label>A Tour of SQB</label>
							<i class="fa fa-plus" aria-hidden="true"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><label>Installation</label>
							<i class="fa fa-plus" aria-hidden="true"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="personality_quiz_tab" data-toggle="tab" href="#personality_quiz" role="tab" aria-controls="personality_quiz" aria-selected="false"><label>Personality Quizzes</label>
							<i class="fa fa-plus" aria-hidden="true"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="branching_logic_tab" data-toggle="tab" href="#branching_logic" role="tab" aria-controls="branching_logic" aria-selected="false"><label>Branching Logic</label>
							<i class="fa fa-plus" aria-hidden="true"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="assessments_quiz_tab" data-toggle="tab" href="#assessments_quiz" role="tab" aria-controls="assessments_quiz" aria-selected="false"><label>Assessments</label>
							<i class="fa fa-plus" aria-hidden="true"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="customizations_tab" data-toggle="tab" href="#customizations" role="tab" aria-controls="customizations_tab" aria-selected="false"><label>Customizations </label>
							<i class="fa fa-plus" aria-hidden="true"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="personalize_quiz_tab" data-toggle="tab" href="#personalize_quiz" role="tab" aria-controls="personalize_quiz" aria-selected="false"><label>Personalize your Quiz </label>
							<i class="fa fa-plus" aria-hidden="true"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="zapier_webhook_tab" data-toggle="tab" href="#zapier_webhook" role="tab" aria-controls="zapier_webhook" aria-selected="false"><label>Zapier / Webhook </label>
							<i class="fa fa-plus" aria-hidden="true"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="blocking_quizzes_tab" data-toggle="tab" href="#blocking_quizzes" role="tab" aria-controls="blocking_quizzes" aria-selected="false"><label>Blocking Quizzes</label>
							<i class="fa fa-plus" aria-hidden="true"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="analytics_quizzes_tab" data-toggle="tab" href="#analytics_quizzes" role="tab" aria-controls="analytics_quizzes" aria-selected="false"><label>Analytics</label>
							<i class="fa fa-plus" aria-hidden="true"></i></a>
					</li>
					
				</ul>
			</div>
 
			<div class="tab-content sqb-reports-section" id="Quiz-TabContent">
				<div class="tab-pane fade show active" id="quiztype" role="tabpanel" aria-labelledby="quiztype-tab">
					<h3 class="quiz--title"><i class="fa fa-cube" aria-hidden="true"></i>Documentation </h3>					 
					<div class="gray-info-block">
						<h3 class="gray-info-title" id="content">What Quiz should YOU Create?</h3>
					<p>Watch this video for all the details.</p>
						<div class="YT-videoWrapper">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/76fz6Jtu37Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						 
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="tour" role="tabpanel" aria-labelledby="tour-tab">
					<h3 class="quiz--title"><i class="fa fa-cube" aria-hidden="true"></i>Documentation </h3>					 
					<div class="gray-info-block">
						<h3 class="gray-info-title" id="content">A Tour of SQB</h3>
					<p>Watch this video for a full tour of SQB.</p>
						<div class="YT-videoWrapper">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/DaVCUrOCElw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						 
						</div>
					</div>
				</div>
				<div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
					<h3 class="quiz--title"><i class="fa fa-cube" aria-hidden="true"></i>Documentation </h3>
					<!--h3 class="quiz--title"><i class="fa fa-cog" aria-hidden="true"></i> Installation</h3-->
					<div class="gray-info-block">
						<h3 class="gray-info-title" id="content">Installation</h3>
					<p>Watch this video for details</p>
						<div class="YT-videoWrapper">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/OHlPVpK6QJw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="personality_quiz" role="tabpanel" aria-labelledby="personality_quiz-tab">
					<h3 class="quiz--title"><i class="fa fa-cube" aria-hidden="true"></i>Documentation </h3>
					<!--h3 class="quiz--title"><i class="fa fa-cog" aria-hidden="true"></i> Installation</h3-->
					<div class="gray-info-block">
						<h3 class="gray-info-title" id="content">Personality Quizzes</h3>
						<p class="heading_p_cls">How to create and use a Personality Quiz to grow your List!</p>
						<div class="YT-videoWrapper">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/c0K22UZt8lM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
						<p  class="heading_p_cls" style=" margin-top: 40px;">How to create a fun, BuzzFeed-style Personality quiz</p>
						<div class="YT-videoWrapper">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/wzDesESwUJs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="assessments_quiz" role="tabpanel" aria-labelledby="assessments_quiz-tab">
					<h3 class="quiz--title"><i class="fa fa-cube" aria-hidden="true"></i>Documentation </h3>
					<!--h3 class="quiz--title"><i class="fa fa-cog" aria-hidden="true"></i> Installation</h3-->
					<div class="gray-info-block">
						<h3 class="gray-info-title" id="content">Assessments Quizzes</h3>
						<p>Watch this video for details</p>
						<div class="YT-videoWrapper">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/In_EhK4WCGo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="customizations" role="tabpanel" aria-labelledby="customizations-tab">
					<h3 class="quiz--title"><i class="fa fa-cube" aria-hidden="true"></i>Documentation </h3>
					<!--h3 class="quiz--title"><i class="fa fa-cog" aria-hidden="true"></i> Installation</h3-->
					<div class="gray-info-block">
						<h3 class="gray-info-title" id="content">Customizations</h3>
						<p>Watch this video for details</p>
						<div class="YT-videoWrapper">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/bv5Siv9I7Gg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="personalize_quiz" role="tabpanel" aria-labelledby="personalize_quiz-tab">
					<h3 class="quiz--title"><i class="fa fa-cube" aria-hidden="true"></i>Documentation </h3>
					<!--h3 class="quiz--title"><i class="fa fa-cog" aria-hidden="true"></i> Installation</h3-->
					<div class="gray-info-block">
						<h3 class="gray-info-title" id="content">Personalize your Quiz </h3>
						<p>Watch this video for details</p>
						<div class="YT-videoWrapper">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/hjhUijZxjnA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="branching_logic" role="tabpanel" aria-labelledby="branching_logic-tab">
					<h3 class="quiz--title"><i class="fa fa-cube" aria-hidden="true"></i>Documentation </h3>
					<!--h3 class="quiz--title"><i class="fa fa-cog" aria-hidden="true"></i> Installation</h3-->
					<div class="gray-info-block">
						<h3 class="gray-info-title" id="content">Branching Logic</h3>
						<p  class="heading_p_cls">How to create a Survey or Quiz Funnel with Branching Logic</p>
						<div class="YT-videoWrapper">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/oCq7LAywMlU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
						<p   class="heading_p_cls" style=" margin-top: 40px;">How to implement Branching Logic</p>
						<div class="YT-videoWrapper">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/g9duC6Sq_yo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			
				<div class="tab-pane fade" id="zapier_webhook" role="tabpanel" aria-labelledby="zapier_webhook-tab">
					<h3 class="quiz--title"><i class="fa fa-cube" aria-hidden="true"></i>Zapier / Webhook Integration </h3>
					 
					<div class="gray-info-block">
						<h3 class="gray-info-title" id="content">Zapier / Webhook Integration</h3>
						<p>Watch this video for details</p>
						<div class="YT-videoWrapper">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/_FewqYqaHiI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>					
						</div>
						<br/><br/>
						<p><a href="https://smartquizbuilder.com/how-to-connect-smartquizbuilder-with-zapier/" target="_blank">Click here for more details >>></a> </p>
					</div>
				</div>
				<div class="tab-pane fade" id="blocking_quizzes" role="tabpanel" aria-labelledby="blocking_quizzes-tab">
					<h3 class="quiz--title"><i class="fa fa-cube" aria-hidden="true"></i>Blocking Quizzes </h3>
					 
					<div class="gray-info-block">
						<h3 class="gray-info-title" id="content">Blocking Quizzes</h3>
						<p><strong>Part 1:</strong> Full DEMO of end-to-end user experience of an Online Course fully built using DigitalAccessPass.com (DAP) - with quizzes from SmartQuizBuilder.com (SQB).</p>
						<div class="YT-videoWrapper">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/PZfPYyPQCT4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>					
						</div>					 
						<br/><br/>
						<p><strong>Part 2:</strong> How to use DAP's Built-In LMS To Create And Deliver your Online Courses! </p>
						<div class="YT-videoWrapper">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/XCmVqqxHLsc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>					
						</div>
							<br/><br/>
						<p>More Details:</p>
				 
						<p><strong>Part 1:</strong> <a href="https://smartquizbuilder.com/how-to-add-blocking-quizzes-to-your-online-courses/" target="_blank">https://smartquizbuilder.com/how-to-add-blocking-quizzes-to-your-online-courses/
						</a></p>
						<p><strong>Part 2:</strong> <a href="https://smartquizbuilder.com/clone-of-how-to-add-blocking-quizzes-to-your-online-courses/" target="_blank">https://smartquizbuilder.com/clone-of-how-to-add-blocking-quizzes-to-your-online-courses/
						</a></p>
						 

					</div>
				</div>	
						 
				<div class="tab-pane fade" id="analytics_quizzes" role="tabpanel" aria-labelledby="blocking_quizzes-tab">
					<h3 class="quiz--title"><i class="fa fa-cube" aria-hidden="true"></i>Analytics </h3>
					 
					<div class="gray-info-block">
						<h3 class="gray-info-title" id="content">Analytics</h3>
						 <p>How to Analyze your Quiz Results</p>
						<div class="YT-videoWrapper">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/4yksrkZpguk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>

					</div>
				</div>			 
			
			</div>
		</div>
	</div>

</section>

<style type="text/css">
.Quiz-documentation .gray-info-block .heading_p_cls {    font-size: 18px;    font-weight: 600;}
.Quiz-documentation .gray-info-block {width: 100%;margin-top: 20px;float: none;display: inline-block;max-width: 1000px;padding: 30px 70px 40px;border: 1px solid #e2e2e2;border-radius: 6px;background: #f9f9f9;}

.Quiz-documentation .gray-info-block .gray-info-title {font-weight: 600 !important;font-size: 24px;color: #419bd0;margin-bottom: 14px;display: inline-block;width: 100%;margin: 0 0 15px 0;line-height: normal;}

.Quiz-documentation .gray-info-block  p {font-size: 16px;font-weight: 400;letter-spacing: .5px;color: #666;line-height: 20px;}

.Quiz-documentation .gray-info-block p:last-child {margin-bottom: 0;}

.Quiz-documentation .logo-brand {margin: 0 0 16px 0; display: inline-block; text-transform: capitalize; text-decoration: none; color: #419bd0; width: 100%; text-align: center; background: #f8f8f8; padding: 10px 0; line-height: 1.1; vertical-align: middle; font-size: 37px; }

.Quiz-documentation .Quiz--tabs-outer .Quiz-left-tab-outer {width: 280px;flex-basis: 280px;max-width: 280px;}

.Quiz--tabs-outer #Quiz-TabContent {max-width: calc(100% - 280px);}

.YT-videoWrapper {position: relative; padding-bottom: 56.25%; height: 0; border: 1px solid #e2e2e2; box-shadow: 0px 0 13px 2px #b7b7b7; }

.YT-videoWrapper iframe {position: absolute;top: 0;left: 0;width: 100%;height: 100%;vertical-align: middle;}

.gray-info-block video {display: inline-block;margin: 20px 0 0 0;width: 100%;height: auto;padding: 0;vertical-align: middle;}

</style>


