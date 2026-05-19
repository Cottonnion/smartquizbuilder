<?php

use Dompdf\Dompdf;

$productId = $_REQUEST['quiz_id'];
$certificate_id = 0;
$quiz_name = 'Product A';
$certificate_html = '';
$admin_name = '';
$logo = '';
$width_selected = '1200';
$logo_width = '240';
$logo_height = '180';
$logo_width1 = '240px';
$logo_height1 = '180px';

$id = $_REQUEST['lead_id'];
$lead = SQB_ManageLeads::loadById($id);
$quiz_id = $lead->getQuizId();
$user_id = $lead->getUserId();
$date = $lead->getDate();

$certificate = SQB_QuizCertificate::loadById($lead->certificate_id);

$quiz = SQB_Quiz::loadById($quiz_id);
$userDetails = SQB_UserQuizDetails::loadByUserIdAndQuizIdDate($user_id,$quiz_id,$date);

$certificate_yourscore = '';
$certificate_total = '';
$certificate_total_per = '';
if(!empty($userDetails)){
    $certificate_yourscore = $userDetails[0]->getPointsScored();
    $certificate_total = $userDetails[0]->getTotalPoints();
    try {
        $certificate_total_per = round(($certificate_yourscore * 100) / $certificate_total,2).'%';
    } catch (Exception $e) {
    }
    
}

$outcome = SQB_Outcome::loadById($lead->getOutcome());
$certificate_outcome_title = '';
if(!empty($outcome)){
    $certificate_outcome_title = $outcome->getOutcomeName();
}

$certificate_html = $certificate->getTemplateHtml();
$certificate_logo = $certificate->getLogoImg();
$certificate_sign = $certificate->getSignatureImg();
$certificate_admin_name = $certificate->getAdminName();

if(!empty($certificate_sign)){
    $certificate_admin_name = '<img src="'.$certificate_sign.'" width="100px" />';
}

$certificate_date = $lead->getDate();
$certificate_outcome = $lead->getOutcome();
$certificate_quiz_title = $quiz->getQuizName();

$user_name='';
if($lead->getUsername() != ''){
    $user_name = $lead->getUsername();
}
$firstname = '';
$source = $lead->getSource();
$user_source = $lead->getUserSource();
if($source == "WP" && $user_source == "WP"){
    $user_info = get_userdata($user_id);	
    
    
    if(!empty($user_info)){
        $usersname =  $user_info->first_name." ". $user_info->last_name;	
        $firstname = $user_info->first_name;

        if($usersname == "sqbguest "){

        }else{
            $name = $usersname;
        }

        $email =  $user_info->user_email ;	
    }else{
        $name =  "";	
    }
}else if($source == "WP" && $user_source == "SQB"){
    $sqbUserObj = SQB_InternalUsers::loadByIdNew($user_id);					 
    if(!empty($sqbUserObj)){
        $email = $sqbUserObj->getEmail(); 	
        $name = $sqbUserObj->getFirstName(); 	
        $firstname = $sqbUserObj->getFirstName();
    }	
    
}else if($source == "DAP" && empty($user_source)){
    $dapUserObj = Dap_User::loadUserById($user_id);
    if(!empty($dapUserObj)){						
        
        $name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();	
        $firstname = $dapUserObj->getFirst_name();				
        $email =  $dapUserObj->getEmail();
        
    }
}

if($name=="" || $name==" "){
    $name= $user_name;
}

$filename = "certificatepdffile";
$width_selected = 0;
$page_dimension =  "@page { size: 1000pt 590pt; } .certificates-section {max-width: 1200px;width: 1200px;min-width: 1200px; } ";
if($width_selected =="900"){
	$page_dimension =  "@page { size: 700pt 580pt; }  .certificates-section {max-width: 700px;width: 700px;min-width: 700px; }  ";
}elseif($width_selected =="1000"){
	$page_dimension =  "@page { size: 800pt 590pt; }  .certificates-section {max-width: 1000px;width: 1000px;min-width: 1000px; } ";
}elseif($width_selected =="1100"){
	$page_dimension =  "@page { size: 900pt 590pt; } .certificates-section {max-width: 1100px;width: 1100px;min-width: 1100px; }  ";
}else{
	$page_dimension =  "@page { size: 1000pt 590pt; } .certificates-section {max-width: 1200px;width: 1200px;min-width: 1200px; }   ";
}

$logo_width = ' width="'.$logo_width1 .'" ';
$logo_height = ' height="'.$logo_height1 .'" ';	 
$certificate_html = str_replace( '%%NAME%%', $name, $certificate_html); 
$certificate_html = str_replace( '%%first%%', $firstname, $certificate_html); 
$certificate_html = str_replace( '%%FIRST%%', $firstname, $certificate_html); 
$certificate_html = str_replace( '%%firstname%%', $firstname, $certificate_html); 
$certificate_html = str_replace( '%%FIRSTNAME%%', $firstname, $certificate_html); 
$certificate_html = str_replace( '%%FIRST_NAME%%', $firstname, $certificate_html); 
$certificate_html = str_replace( '%%first_name%%', $firstname, $certificate_html); 
$certificate_html = str_replace( '%%QUIZ_TITLE%%', $certificate_quiz_title, $certificate_html); 
$certificate_html = str_replace( '%%DATE%%', date('Y-m-d',strtotime($certificate_date)), $certificate_html);
$certificate_html = str_replace( '%%ADMIN_NAME%%', $certificate_admin_name, $certificate_html);	
$certificate_html = str_replace( '%%imgwidth%%', $logo_width, $certificate_html);
$certificate_html = str_replace( '%%imgheight%%', $logo_height, $certificate_html);
$certificate_html = str_replace( '%%imgwidth%%=""', $logo_width, $certificate_html);	 
$certificate_html = str_replace( '%%imgheight%%=""', $logo_height, $certificate_html);	
$certificate_html = str_replace( '%%IMGWIDTH%%', $logo_width, $certificate_html);	
$certificate_html = str_replace( '%%IMGHEIGHT%%', $logo_height, $certificate_html);
$certificate_html = str_replace( '%%YOURSCORE%%', $certificate_yourscore, $certificate_html);
$certificate_html = str_replace( '%%TOTALSCORE%%', $certificate_total, $certificate_html);
$certificate_html = str_replace( '%%SCOREINPERCENT%%',$certificate_total_per, $certificate_html);
$certificate_html = str_replace( '%%OUTCOME_TITLE%%',$certificate_outcome_title, $certificate_html);
$certificate_html = str_replace( '<span class="delete-template-element"><i class="fa fa-trash"></i></span>', '', $certificate_html);

global $wpdb;

$table_name = $wpdb->prefix . 'sqb_user_custom_fields';

$query = $wpdb->prepare(
    "SELECT * FROM $table_name WHERE manage_lead_id = %d",
    $id
);

$custom_fields = $wpdb->get_results($query);

if(!empty($custom_fields)){
    foreach($custom_fields as $custom_field){
        $cfield_name = $custom_field->name;
        $cfield_value = $custom_field->value;
        $certificate_html = str_replace( '%%'.$cfield_name.'%%', $cfield_value , $certificate_html);	
    }
}

$font_url = site_url().'/wp-content/plugins/smartquizbuilder/includes/frontend/';
$html = '<html>
<head>
    <style>
        @font-face {
            font-family: "Libre Baskerville";
            src: url("'.$font_url.'fonts/LibreBaskerville-Regular.ttf");
        }

        @font-face {
            font-family: "Dancing Script";
            src: url("'.$font_url.'fonts/DancingScript.ttf");
        }

        @font-face {
            font-family: "Rasa";
            src: url("'.$font_url.'fonts/Rasa-Medium.ttf") ;
        }



      @page { size: 1000pt 590pt; } .certificates-section {max-width: 1200px;width: 1200px;min-width: 1200px; } .template-heading *{ font-family: Libre Baskerville; font-size: 75px; color: #334166; text-align: center; line-height: 1.2;} .template-subheading *{ color: #C39A5C; font-family: Libre Baskerville; font-size: 40px; font-weight: 400; text-align: center; line-height: 1.2;} .template-subdescription *{ color: #334166; font-family: Rasa; font-size: 26px; text-align: center; line-height: 1.2;} .template-username *{ color: #03969E; font-family: \'Dancing Script\'; font-size: 62px; text-align: center; line-height: 1.2;} .template-description *{ color: #334166; font-family: Rasa; font-size: 22px; text-align: center; line-height: 1; } .template-signature-heading *, .template-date-heading *{ color: #334166; font-family: Rasa; font-size: 20px; text-align: center; line-height: 1.2;} .template-signature-content *, .template-date-content *{ color: #865B34; font-size: 16px; font-family: Rasa; text-align: center; } .certificates_outer1-tmp2 { position: fixed; bottom: 0;top: 0; left: 0; width: 100%; height: 700px; z-index: -1000; } .dragable-certificate-element { position: absolute; width: 100%;}.template2-main-wrapper main .certificate-element-max-conetnt { width: 300px; position: absolute; }  .certificates-section-tmp2 { max-width: 1200px; width: 1200px; min-width: 1200px; position: relative; margin: auto; } .template-certificate-icon.award_img_inner { text-align: center; } .dragable-certificate-element p { margin: 0;  padding: 0; line-height: 1;} .hide-this-section-in-frontend{ display:none!important;} .edit-template-element{ display:none!important;}

          .dap_cerficate_stroke .dap-stroke-line { width: 100%; line-height:1; box-sizing: border-box; font-family: Open Sans; height: 2px;   background: #C39A5C; display: block; } .dap_cerficate_stroke { display: flex; align-items: center; } .dap-stroke-dots { width: 20px; height: 20px; border: 2px solid #C39A5C; border-radius: 100%; } .certificate-element-resizable.only-width-resizable { height: auto!important; }
            </style>
        </head>
        <body>
             '.$certificate_html.'
        </body>
    </html>';



    require_once SQB_PD_DIR.'/inc/dompdf/autoload.inc.php';
    // reference the Dompdf namespace  
    
    // instantiate and use the dompdf class
    $dompdf = new Dompdf(array('enable_remote' => true));

    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');
    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    if(!empty($_REQUEST['browser'])){
        $dompdf->stream($filename,array("Attachment"=>0));
    }else{
        $dompdf->stream($filename); 
    }
    exit;
