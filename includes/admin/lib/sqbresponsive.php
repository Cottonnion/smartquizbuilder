<?php



if (!function_exists('SQBCheckFOpen')) {function SQBCheckFOpen($pn, $wcplicense){global $sqbVersion, $wcpDomain;$domain = str_ireplace("www.", "", getHost($_SERVER['HTTP_HOST']));$fp = @fsockopen('ssl://'.$wcpDomain, 443, $errno, $errstr, 30);if (!$fp) {$subject = "Fsockopen Error from " . $domain;$body = "Fsockopen Error from " . $domain;sendLicensingErrorEmail($subject, $body);return true;} else {$req = "domain=" . $domain . "&lk=" . $wcplicense . "&pn=" . $pn . "&v=" . $sqbVersion;$header = "POST /wcpValidateLicenseSQB.php HTTP/1.1\r\n";$header .= "Host: " . $wcpDomain . "\r\n";$header .= "Content-type: application/x-www-form-urlencoded\r\n";$header .= "Content-length: " . strlen($req) . "\r\n";$header .= "Connection: Close\r\n\r\n";fwrite($fp, $header . $req);while (!feof($fp)) {$res = fgets($fp, 1024);$errorPos = strpos($res, "error occurred");if ($errorPos !== false) {$subject = "Error occurred from " . $domain;$body = "Error occurred from " . $domain;sendLicensingErrorEmail($subject, $body);fclose($fp);return true;}$pos = strpos($res, "WICKIFIED");$pos2 = strpos($res, "WICKIFIEDELITE");$pos3 = strpos($res, "WICKIFIEDSPECIAL");if (($pos !== false) || ($pos2 !== false) || ($pos3 !== false)) {$pieces = explode("#", $res);$randomStr = $pieces[2];$responseKey = $pieces[1];$licenseHash = md5(trim($domain) . trim($wcplicense) . trim($randomStr));if (strcmp($responseKey, $licenseHash) == 0) {$_SESSION['randomStr'] = $randomStr;$_SESSION[$pn] = $pn;fclose($fp);return true;}}} fclose($fp);return false;}}}

																																	
if(!function_exists('getHost')) {
  function getHost($Address) {
	 $parseUrl = parse_url(trim($Address));
	 $sqb_host = '';
	 if(isset($parseUrl['host'])){
		  $sqb_host =  $parseUrl['host'];
	 }else if(isset($parseUrl['path'])){
		 $sqb_host_array =  explode('/', $parseUrl['path'], 2);
		 if(is_array($sqb_host_array)){
			 $sqb_host =  array_shift($sqb_host_array);
		 }
		 
	 }
	 return trim($sqb_host);
  } 
}
if(!function_exists('sendLicensingErrorEmail')) {
  function sendLicensingErrorEmail($subject,$body) {
	  $fromName = "WickedCoolPlugins";
	  $fromEmail = "WickedCoolPlugins@WickedCoolPlugins.com";
	  @mail("wcp@wickedcoolplugins.com",$subject,$body,"From:\"WickedCoolPlugins\"<wco@WickedCoolPlugins>");
	  return;
  }
}

$wcpDomain = "www.wickedcoolplugins.com";

?>
<?php $ajaxurl = admin_url('admin-ajax.php'); ?>
<?php
$whoAmI = "SQB";
$wcplicense =  get_option('wcp_licenseKey');
//echo $wcplicense;
$showeditor = true; // Licensing check bypassed
if($showeditor == false)
{ ?>
<script>
function sqblicense_save_wcp(){
	var ajaxurl = "<?php echo $ajaxurl ?>";
	jQuery('#loadingicon').show();
	jQuery('#loadingoverlay').show();
	var wcp_key = jQuery('#sqbwcp-license-key').val();
	if (wcp_key != '') {
		jQuery.post(ajaxurl, {
			action: 'sqblicense_save_wcp',
			key: wcp_key,
			},function(response) {
				//jQuery('#loadingicon').hide();
				//jQuery('#loadingoverlay)').hide();
				alert('Succesfully Saved WCP License Key');
				window.location.reload();
			})
	}else{
		jQuery('#loadingicon').hide();
		jQuery('#loadingoverlay').hide();
		alert('Please Enter Your WCP License Key');
		return false;
	}
	return true;
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SmartQuizBuilder Editor</title>
</head>
<body>

<div class="dashboardwrapper">
<table cellspacing="0" cellpadding="0" style="width:60%;">
  <thead>
    <tr>
      <th width="40%" >Enter WCP License Key <br/>(Click <strong><a href="http://wickedcoolplugins.com/my-account/"> HERE </a></strong> to get your WCP License Key)</th>
      <th width="35%"></th>
      <th width="25%"></th>
    </tr>
  </thead>
  
  <tbody>
  <tr>
  <td></td>
  </tr>
    <tr>
      <td>Enter Your License Key:</td>
      <td class="edit_wcp_key"><input name="sqbwcp-license-key" type="text" id="sqbwcp-license-key" value="<?php echo get_option('wcp_licenseKey'); ?>"></td>
      <td><input type="button" class="button button-primary" onClick="sqblicense_save_wcp()" value="Save WCP Key"></td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td>
    <div id="loadingoverlay">
    </div>
    <div id="loadingicon" style="display:none">
        <i class="fa fa-spinner fa-pulse fa-5x"></i>
    </div>
	</td>
	</tr>
  </tbody>
</table>



</div>
</body>
</html>

<?php 
exit;
}
?>