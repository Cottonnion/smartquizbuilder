<?php

use Dompdf\Dompdf;





if(isset($_REQUEST['sqb_pdf_preview_v2'])){



    $sqb_plugins_url = plugins_url().'/smartquizbuilder';

   

    $quiz_name = '';    

    $quiz_type = '';

    $quiz_desc = '';

    $outcomeTitle ='';

    $outcomeDescription = '';

    $ansData = ''; 

    $first_name = '';

    $email = '';

    $name = '';

    $answerFormat ='';





    $pdf_file_name = 'outcomepdffile';

   

    if (isset($_REQUEST['pdf_id'])) {
        $pdf_id = $_REQUEST['pdf_id'];
    } else {
        $pdf_id = 0;
    }



    if($pdf_id < 1){

        return false;

    }

    $pdf_mode = 'advance';



    if($pdf_id > 0){



        $pdfRecords = SQB_PdfContent::loadById($pdf_id);

        

        if(!empty($pdfRecords) && $pdf_mode == 'advance'){



            $pdfRowData = $pdfRecords->getContent();

            $pdf_file_name = sanitize_title($pdfRecords->getName());

            $pdfArray = maybe_unserialize($pdfRowData);



            $other_options = $pdfRecords->getOtherOptions();

            $page_view = 'portrait';

            if(!empty($other_options)){

                $other_options_unserialize = unserialize($other_options);



                if(!empty($other_options_unserialize["page_view"])){

                    $page_view = $other_options_unserialize["page_view"];

                }

            }

            $pageHtml = '';

            if(!empty($pdfArray)){



                foreach ($pdfArray as $index => $page) {



                    $type = $page['type'];

                    $data = $page['data'];



                    $pageHtml .= '<div class="pdf-pageview-'.$page_view.' pdf-pageimage-'.$type.' pdf-page pdf-page-'.($index+1).'">';



                    if($type == 'text'){

                        $pageHtml .=  '<div class="sqb-pdf-page-content">'.stripcslashes($data).'</div>';

                    }else if($type == 'image'){

                            $pageHtml .= '<div class="inside-pdf-img-wrapper" style="background-image: url('.$data.');"><img src="" /></div>';

                    }



                    $pageHtml .= '</div>';

                    //$pageHtml .= '<div class="page-break"></div>';

                    

                }

                $pdf_data = $pageHtml;

            }else{

                $pdf_data = '';

            }

        }

    }



    $pdf_header_background_color = sqbGetValidSettingsByKey('pdf_header_background_color');

    $pdf_footer_background_color =  sqbGetValidSettingsByKey('pdf_footer_background_color');

    $add_pdf_icon = sqbGetValidSettingsByKey('add_pdf_icon');



    $pdf_display_option = sqbGetValidSettingsByKey('pdf_display_option');



    $first_page_image = sqbGetValidSettingsByKey('first_page_image');

    $last_page_image = sqbGetValidSettingsByKey('last_page_image');

    $pdf_header_title = sqbGetValidSettingsByKey('pdf_header_title');



    $pdf_header_title = str_replace('%%HEADERTITLE%%', 'Your quiz title here', $pdf_header_title);



    if($pdf_header_title == '<div><br data-mce-bogus=\"1\"></div>'){

        $pdf_header_title = '';

    }



    $pdf_footer_copyright_content = sqbGetValidSettingsByKey('pdf_footer_copyright_content');

    $pdf_footer_copyright_content = str_replace("%%YEAR%%",date("Y"),$pdf_footer_copyright_content);

    $home_url = home_url();

    $parse = parse_url($home_url);

    $pdf_footer_copyright_content = str_replace('%%DOMAIN%%', $parse['host'], $pdf_footer_copyright_content);



    $first_page = '';

    $last_page = '';



    

    $pdf_global_font = sqbGetValidSettingsByKey('pdf_global_font');

    $pdf_global_font = (!empty($pdf_global_font) && $pdf_global_font != '')? $pdf_global_font : 'sans-serif';

    $pdf_mgenplus_bolf = ($pdf_global_font == 'mgenplus') ? '* #sqb_quiz_builder .quiz_outer_fe strong, * b, strong, strong *, b *, * h1,* h2, * h3, * h4, * h5, * h6{ font-weight : 600 !important;}' : '';

    $pdf_viatname_bolf = ($pdf_global_font == 'BeVietnamPro, sans-serif') ? '* #sqb_quiz_builder .quiz_outer_fe strong, * b, * h1,* h2, * h3, * h4, * h5, * h6{ font-weight : 400 !important;}' : '';



    if(!empty($pdf_display_option)){

        if($pdf_display_option == 'same'){



            /* Global Styles for first and last image */

            $firstpage_width = sqbGetValidSettingsByKey('firstpage_width');

            $first_page_align = sqbGetValidSettingsByKey('first_page_align');

            $first_page_horizontal = sqbGetValidSettingsByKey('first_page_horizontal');

            $lastpage_width = sqbGetValidSettingsByKey('lastpage_width');

            $last_page_align = sqbGetValidSettingsByKey('last_page_align');

            $last_page_horizontal = sqbGetValidSettingsByKey('last_page_horizontal');





            /* END */

            if(!empty($first_page_image) && strtolower($first_page_image) != 'null'){

                $first_page = '<div id="certificates_outer1" class="first-screen"><img src="'.$first_page_image.'" height="100%" width="100%"></div>';

            }

            if(!empty($last_page_image) && strtolower($last_page_image) != 'null'){

                $last_page = '<div id="certificates_outer2" class="last-screen"><img src="'.$last_page_image.'" height="100%" width="100%"></div>';

            }

        }else if($pdf_display_option == 'different'){

            $explodepdfFrontLastImage = explode('|',$pdfFrontLastImage);

            $first_page_image = $explodepdfFrontLastImage[0];

            $last_page_image = $explodepdfFrontLastImage[1];





            $firstpage_width = $explodepdfFrontLastImage[2];

            $first_page_align = $explodepdfFrontLastImage[3];

            $first_page_horizontal = $explodepdfFrontLastImage[4];

            $lastpage_width = $explodepdfFrontLastImage[5];

            $last_page_align = $explodepdfFrontLastImage[6];

            $last_page_horizontal = $explodepdfFrontLastImage[7];







            if(!empty($first_page_image)  && strtolower($first_page_image) != 'null'){

                $first_page = '<div id="certificates_outer1" class="first-screen"><img src="'.$first_page_image.'" height="100%" width="100%"></div>';

            }

            if(!empty($last_page_image)  && strtolower($last_page_image) != 'null'){

                $last_page = '<div id="certificates_outer2" class="last-screen"><img src="'.$last_page_image.'" height="100%" width="100%"></div>';

            }

        }

    }



    $pdf_header = '';

    $pdf_footer = '';

    $paged_based_css = '';



    

    $pdf_header = '<table id="table-header" style="width: 100%;margin: 0;padding: 0;text-align: left;background-color:'.$pdf_header_background_color.';border: none;border-collapse: collapse;"><tr style="vertical-align: middle;"><th style="width:30%;padding:10px 20px;text-align:left; "><img style="max-width: 100px;max-height:60px;width:auto;height:auto;" src="'.$add_pdf_icon.'"></th><th style="width:70%;padding:10px 20px;color:#171717;"><div style="vertical-align: middle;font-size: 19px;line-height: 1;margin: 0;padding: 0;text-align:right;width:100%;">'.$pdf_header_title.'</div></th></tr></table>';



    if(empty($pdf_header_title) && empty($add_pdf_icon)){

        $pdf_header = '';

    }



    if(!empty($pdf_footer_copyright_content)){

        $pdf_footer = '<table id="table-footer" style="width: 100%;margin: 0;padding: 0;text-align: center;background-color:'.$pdf_footer_background_color.';border: none;border-collapse: collapse;"><tr><th style="width:100%;padding:10px 20px;">'.$pdf_footer_copyright_content.'</th></tr></table>';

    }





    if(empty($pdfArray)){

        

    $pdf_data_final =  $pdf_header.$pdf_footer.'<div class="sqb_quiz_container_outer  template_num_template1 inpage_popup_sqb  sqb_mobile_view_layout_active " id="sqbquizouter_333"> <div class="sqb_counter_outer"  ><div class="sqb_quiz_container normal_quiz quiz_type_personality" id="sqb_quiz_builder"><div class="quiz_result_template_outer1 quiz_outer_fe "  > '.$first_page.'<div class="pdf-content-part">'.$pdf_data.'</div>'.$last_page.' </div></div></div></div>';

        $paged_based_css = '@page  {margin:2.5cm 0; size: letter; }';



    }else{

       $pdf_data_final =  $pdf_header.$pdf_footer.'<div class="sqb_pdf_page_based sqb_quiz_container_outer  template_num_template1 inpage_popup_sqb  sqb_mobile_view_layout_active " id="sqbquizouter_333"> <div class="sqb_counter_outer"  ><div class="pdf-content-part">'.$pdf_data.'</div></div></div>';


        if ($page_view == 'landscape') {
            $a4_size = '@page { margin-left: 0; margin-right: 0; }';
        }else{
             $a4_size = '@page { margin-left: 0; margin-right: 0; margin-top: 0; size: A4; }';
        }

        $conditional_css = '';

        if(!empty($pdf_footer_copyright_content)){
            $conditional_css.= '@page {margin-bottom: 1.5cm;}
            #table-footer{ bottom: -1.5cm;}
            .inside-pdf-img-wrapper { top: 0; }';
        }
        
        if(!empty($pdf_header_title) || !empty($add_pdf_icon)){
            $conditional_css.= '@page { margin-top: 2.5cm; }
            #table-header{ top: -2.5cm;}
            .inside-pdf-img-wrapper { top: -2.5cm; }';
        }

        

        $paged_based_css = $a4_size.'
            .sqb_pdf_page_based .pdf-page { page-break-after: always; }
            .inside-pdf-img-wrapper { page-break-after: always;  position:absolute; left:0; right:0; bottom:0; top:0; width: 595pt; height:842pt; margin: 0!important; background-size: cover; background-position: center;}
            .sqb-pdf-page-content{ padding: 20px 0;}
            .pdf-pageview-landscape .inside-pdf-img-wrapper{width: 842pt; height:595pt;}
            
            .sqb-pdf-page-content{padding-bottom: 0; }'.$conditional_css;
    }

    

    $pdf_data_final = str_replace("%%DAY%%",date("d"),$pdf_data_final);

    $pdf_data_final = str_replace("%%MONTH%%",date("m"),$pdf_data_final);

    $pdf_data_final = str_replace("%%YEAR%%",date("Y"),$pdf_data_final);

    $pdf_data_final = str_replace("%%FULL_DATE%%",date("Y/m/d"),$pdf_data_final);



    $pdf_data_final =  str_replace('<span','<div class="nopaddingdiv"',$pdf_data_final); 

    $pdf_data_final =  str_replace('</span>','</div>',$pdf_data_final); 



    $pdf_data_final =  str_replace('<label','<div class="nopaddingdiv"',$pdf_data_final); 

    $pdf_data_final =  str_replace('</label>','</div>',$pdf_data_final); 



    $pdf_data_final =  str_replace('<p','<div class="pmaster"',$pdf_data_final); 

    $pdf_data_final =  str_replace('</p>','</div>',$pdf_data_final); 

    



    $cssurl =  ' 

    <link href="'.$sqb_plugins_url.'/includes/templates/result/template2/template2.css?v='.rand(1,1000).'" rel="stylesheet">  

    <link href="'.$sqb_plugins_url.'/includes/css/sqb_frontend.css?v='.rand(1,1000).'" rel="stylesheet">';

    $temp_content = ob_get_clean();   

    $temp_content =  $cssurl.stripslashes($pdf_data_final);  

    

    

    $filename = $pdf_file_name;

    //for the width

    if(@$first_page_align == 'center'){

        $first_img_top= '50%;';

        $first_img_tranform_top= '-50%';

    }else if(@$first_page_align == 'bottom'){

        $first_img_top= '100%;';

        $first_img_tranform_top= '-100%';

    }else{

        $first_img_top= '0;';

        $first_img_tranform_top= '0';

    }



    if(@$first_page_horizontal == 'center'){

        $first_img_left= '50%;';

        $first_img_tranform_left= '-50%';

    }else if(@$first_page_horizontal == 'right'){

        $first_img_left= '100%;';

        $first_img_tranform_left= '-100%';

    }else{

        $first_img_left= '0;';

        $first_img_tranform_left= '0';

    }



    /*Last Page*/

    

    if(@$last_page_align == 'center'){

        $last_img_top= '50%;';

        $last_img_tranform_top= '-50%';

    }else if(@$last_page_align == 'bottom'){

        $last_img_top= '100%;';

        $last_img_tranform_top= '-100%';

    }else{

        $last_img_top= '0;';

        $last_img_tranform_top= '0';

    }



    if(@$last_page_horizontal == 'center'){

        $last_img_left= '50%;';

        $last_img_tranform_left= '-50%';

    }else if(@$last_page_horizontal == 'right'){

        $last_img_left= '100%;';

        $last_img_tranform_left= '-100%';

    }else{

        $last_img_left= '0;';

        $last_img_tranform_left= '0';

    }



    $font_url = site_url().'/wp-content/plugins/smartquizbuilder/includes/frontend/';
    $gdpr_font_url = site_url().'/wp-content/plugins/gdprlibrary/assets/';



    $screen_name = 'settings_background_color';

    $strm_type = 'settings';

    $pdf_global_text_color = '#000';

    $pdf_global_bg = '#f0f0f0';

    

    $demo = '

    <html>

        <head>  

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

            <style> 



            @font-face {

                font-family: "BeVietnamPro";

                src: url("'.$font_url.'fonts/BeVietnamPro.ttf");

            }

            @font-face {
                font-family: "mgenplus";
                src: url("'.$gdpr_font_url.'fonts/mgenplus-1c-medium.ttf");
                font-weight: 400;
            }

             @font-face {
                font-family: "mgenplus";
                src: url("'.$gdpr_font_url.'fonts/mgenplus-1c-bold.ttf");
                font-weight: 600;
            }



                body { background-color: #FFFFFF; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; line-height: 1.3; scrollbar-3dlight-color: #F0F0EE; scrollbar-arrow-color: #676662; scrollbar-base-color: #F0F0EE; scrollbar-darkshadow-color: #DDDDDD; scrollbar-face-color: #E0E0DD; scrollbar-highlight-color: #F0F0EE; scrollbar-shadow-color: #F0F0EE; scrollbar-track-color: #F5F5F5; }
                
                .page-break {

                            page-break-before: always;

                        }

                .sqb_spider_charts_heading, #question_answer_chart,.ans_in_resultpage_outer,.question_answer_chart ,.take-quiz-btn{display:none !important;} 

                #certificates_outer1, #certificates_outer2{position: relative; bottom: 0; top: 0; left: 0; height:780px;  width:100%; text-align:center; }

                #certificates_outer1.first-screen{ page-break-after: always; }

                #certificates_outer1.first-screen img, #certificates_outer2.first-screen img{position: absolute; object-fit: cover; width: '.@$firstpage_width.'px; max-width: 100%; height: auto; top: '.@$first_img_top.'; left: '.@$first_img_left.'; transform: translate('.$first_img_tranform_left.', '.$first_img_tranform_top.'); text-align: center; }

                #certificates_outer1.last-screen img, #certificates_outer2.last-screen img{position: absolute; object-fit: cover; width: '.@$lastpage_width.'px; max-width: 100%; height: auto;  top: '.$last_img_top.'; left: '.$last_img_left.'; transform: translate('.$last_img_tranform_left.', '.$last_img_tranform_top.'); text-align: center; }



                .pdf-content-part{ padding: 0 20px; margin: 10px!important;}

                .pmaster{margin-top: 1em; margin-bottom: 1em;}

                .nopaddingdiv{margin-top: 0; margin-bottom: 0; display: inline;}

                .assessment_outcome_connect .sqb_ans_item_img,.assessment_outcome_connect .sqb_backend_show {display:none}

                .sqb_ans_item.ans_type_rating  .answer-options{display:none !important;} 

                .sqb_answer_bot_option_wrapper_outer {display:none;}

                .sqb_template7_selected .ans_layout_div .sqb_ans_add_image .dropdown-link-style.dropdown { display:none;}  

                .sqb_template7_selected #Start-Screen-Settings .start_temp_static_div .sqb_edit_template { display:none !important; }

                .sqb_template8_selected .sqb-ans-image-options .sqb-custom-size-cover .sqb-que-img-width { display:none; }

                .outer-style8 .sqbHideQuesTemplateImageOuter { display:none !important; }

                .outcome_products_section{display:none;} 



                .Quiz-Template.result_temp_outer  {display: block!important;width: 100%!important; max-width: 100%!important;}



                .Quiz-Template .Quiz-Template-title, .Quiz-Template .Quiz-Template-image, 

                .Quiz-Template .Quiz-Template-content , .Quiz-Template-content p , 

                .Quiz-Template-content ul.Quiz-question-points {display:block!important;width: 100%!important;  }



                #sqb_quiz_builder  .Quiz-Template .Quiz-Template-title,   

                #sqb_quiz_builder .Quiz-Template .Quiz-Template-content , #sqb_quiz_builder .Quiz-Template-content p , 

                #sqb_quiz_builder .Quiz-Template-content ul.Quiz-question-points {display: block!important;width: 100%!important;  max-width: 100%!important;}

                .result_temp_outer img{display:none!important;}

                .sqb_img_draggable, .Quiz-Template .Quiz-Template-image img, #sqb_quiz_builder .Quiz-Template .Quiz-Template-image img, #sqb_quiz_builder .quiz_comon_template .sqb_img_draggable{ width: 100%!important; object-fit: unset!important; margin: 0!important;}



                #sqb_quiz_builder.sqb_quiz_container .outcome_div .question_img_div{ width: 100%!important;  }

                .Quiz-Template .take-quiz-btn, #sqb_quiz_builder .Quiz-Template .take-quiz-btn{ display: none!important;}

                .outcomeTemplateYoutubeVideoOuter{ display: none;}

                .result_temp_outer  img{display:none!important; height:0}

                .result_temp_outer #result_temp_id {  height:0!important;}



                .sqb_quiz_container_outer *{text-align:left}

                .Quiz-Template.result_temp_outer, .result_temp_outer{ border: 0 !important; padding: 0 !important;margin: 0 !important;border-width: 0 !important;}

                sqb_quiz_builder .points_scored_result {padding: 0 !important;} 

                #table-header {position: fixed; top: -2.5cm; left: 0cm; right: 0cm; height: 2cm; color: white; text-align: center; line-height: normal; }

                .result_temp_outer .sqbHideTemplateImageOuter .sqbHideTemplateImage, .result_temp_outer .sqbHideOutcomeDescriptionOuter .sqbHideOutcomeDescription,.result_temp_outer .sqbShowTemplateImageOuter .sqbShowTemplateImage {display:none;}

                #table-footer {position: fixed; bottom: -2.5cm; left: 0cm; right: 0cm; height: 1.5cm; color: white; text-align: center; line-height: normal; }

                

                *{ font-family: '.$pdf_global_font.'!important;}

                '.$pdf_viatname_bolf.'
                '.$pdf_mgenplus_bolf.'

                .sqbHideOutcomeDescriptionOuter, .sqbShowTemplateImageOuter, .generate_pdf_form{display:none!important;}

                .sqb_quiz_container_outer td div { display: inline; }

                .sqb_quiz_container_outer .mce-item-table tr{ margin-bottom: 10px;}

                .sqb_quiz_container_outer .mce-item-table table{ display:block; }

                .result_temp_outer{ position: unset; display:block!important; }

                table.mce-item-table tr{ display:table-row;}

                table.mce-item-table td{ width: auto;}

                table.mce-item-table {width: 100%; background-color: #ffffff; border-collapse: collapse; border-width: 2px; border-color: #000; border-style: solid; color: #000000; }



                table.mce-item-table td, table.mce-item-table th {border-width: 2px; border-color: #000; border-style: solid; padding: 3px; }

                .sqb_category_details{display: block !important;}

                .cat-details-row{display: block !important;}

                .cat-details-row .nopaddingdiv{display: inline-block;padding-right: 20px;  font-weight: 400 !important;}

                .cat-details-row .nopaddingdiv b{font-weight: 600 !important;}

                .sqbHideOutcomeDescription{display: none;}

                .outcome-printselected-answer{display:none !important;}

                .pdf-content-part img{ margin-left: 0 !important; margin-right: 0 !important;}

                .canvas_image {display: block !important;text-align: center !important;}

                .canvas_image img { max-width: 100%;  height: auto;}

                

                /* .sqb-category-breakdown { display: table; width: 100%; }

                .sqb-category-breakdown .sqb-col-2 { display: table-cell; width: 48%; border-left: 0.5% solid #fff; border-right: 0.5%  solid #fff; }

                .sqb-category-breakdown .sqb-col-3 { display: table-cell; width: 30%; border-left: 0.5% solid #fff; border-right: 0.5%  solid #fff; } */

                

                .sqb-categoy-bd-inner{ margin-top: 10px; page-break-inside: avoid!important; }

                .sqb-category-card h3 { font-size: 16px; color: '.$pdf_global_text_color.'; margin-bottom: 10px; padding-top: 20px; }

                .sqb-category-card > div { font-size: 15px; color:  '.$pdf_global_text_color.'!important; }

                .sqb-category-card { padding: 0px 10px 20px; border-radius: 6px; position: relative; background-color: '.$pdf_global_bg.'; }

                .sqb-categoy-progress-bar { height: 10px; background-color: gray; border-radius: 5px; position: relative; margin-top: 10px; }

                .sqb-categoy-progress { height: 10px; border-radius: 5px; }

                .sqb-categoy-progress-info { display: table; width: 100%; margin-top: 5px; }

                .sqb-categoy-score { width: 50%; display: inline-block; text-align: right!important; font-weight: 400 !important; }

                .sqb-categoy-range { font-weight: 400 !important; width: 50%; display: inline-block; color:  '.$pdf_global_text_color.'; }

                .sqb-categoy-progress-info > span { font-size: 14px; font-weight: 400; color:  '.$pdf_global_text_color.'; }

                .sqb-categoy-progress-info span strong { font-weight: 400 !important; }

                  

                '.$paged_based_css.'

            </style>

            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        </head>

        <body>

            '.$temp_content.'

            <style> body{margin: 0;} </style>

        </body>

    </html>';

   //echo '<pre>';print_r($demo);

    // include autoloader

    require_once SQB_PD_DIR.'/inc/dompdf/autoload.inc.php';

    // reference the Dompdf namespace  



    // instantiate and use the dompdf class

    $dompdf = new Dompdf(array('enable_remote' => true));

    $dompdf->loadHtml($demo); 

    // (Optional) Setup the paper size and orientation

    if ($page_view == 'landscape') {

        $dompdf->setPaper('A4', 'landscape');

    }else{

        $dompdf->setPaper('A4', 'portrait');

    }

    

    // Render the HTML as PDF

    $dompdf->render();

    // Output the generated PDF to Browser

    //$dompdf->stream($filename,array("Attachment"=>0));

  

    //if($isDownload){

        

        $dompdf->stream($filename);

        exit;

    //}

}



?>