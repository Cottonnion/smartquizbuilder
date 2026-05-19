<?php 
	
	include_once(dirname(__FILE__).'../../../../../../wp-load.php');

	/*$name = 'facebook';
	$key = 'fb_tracking_id';
	$fbAppIdDetails = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name , $key);
	
	
	if($fbAppIdDetails == false){ 
		/*fb app id is not set, so return */
		/*return;	
	}
	
	   parse_str(base64_decode($_GET['smartquizbuilderfb']), $output);
	
	$fbAppId = $fbAppIdDetails->getValue();
	$quiz_id = $_GET['quiz_id'];
	$event_name = $_GET['event_name'];
	$track_type = 'fb';*/
	/*$quizTrackData = SQB_QuizTracking::loadByQuizIdEventAndTrackType($quiz_id , $event_name, $track_type);	*/

?>

<script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
					n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
					n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
					t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
					document,'script','//connect.facebook.net/en_US/fbevents.js');
					//fbq('init', '<?php echo $fbAppId; ?>');	
					// Removed: hardcoded developer pixel ID (966561857113077) was sending purchase events to developer's ad account
					fbq('init', '<?php echo esc_js($fbAppId); ?>');	
					
fbq('track', 'PageView');
</script>

<style>
	
</style>
