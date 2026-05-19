jQuery(document).ready( function() {

   jQuery(".sqb-view-result-popup").detach().appendTo('body');
   jQuery(document).on("click",".completed-quizs-list .sqb-member-view-quiz-result", function(){
      
      var quiz_id = jQuery(this).attr("data-quiz-id");
      var certificate_status = jQuery(this).closest('.sqb_member_engagement-inner').attr('data-certificate');
      var target = jQuery(this).data('target');
      jQuery(target).addClass("active_Side_Popup");
      jQuery(target).css("display","block");
      //jQuery('.sqb_sidebar_popup_content').html('Please wait..');
      jQuery('.sqb_sidebar_popup').addClass('sqb-loader-active-popup');
      jQuery.ajax({
         type : "post",
         //dataType : "html",
         url : sqbMember.ajaxurl,
         data : {action: "sqb_view_quiz_result", quiz_id : quiz_id, is_frontend : true,certificate_status : certificate_status},
         success: function(response) {
            jQuery('.sqb_sidebar_popup').removeClass('sqb-loader-active-popup');
            jQuery('.sqb_sidebar_popup_content').html(response);
            jQuery('.acc-container .acc:nth-child(1) .acc-head').addClass('active');
            jQuery('.acc-container .acc:nth-child(1) .acc-content').slideDown();
         }
      });
   });

   jQuery(document).on('click','.sqb_sidebar_popup .close_Side_Popup', function(){
      jQuery(".sqb_sidebar_popup").removeClass("active_Side_Popup");
      jQuery('.sqb_sidebar_popup').css("display","none");
      jQuery('.show_current_lesson_url').css("display","none");
   });

 });

jQuery(document).on('click','.download-certificate-pdf', function(){

    var lead_id = jQuery(this).attr('data-lead-id');
    var quiz_id = jQuery(this).attr('data-quiz-id');
   //var user_id =  $this.find('#user_id').val();
   var formdata = [];
   formdata.push({name: "lead_id", value: lead_id});
   formdata.push({name: "quiz_id", value: quiz_id});
   formdata.push({name: "outcome_id", value: 0});
   jQuery(this).addClass('disable-button');
   var orig_text = jQuery(this).html();
   $this = jQuery(this);
   $this.html('Please Wait..');

   jQuery.ajax({
      type: "POST",
      url: '?sqb_cert_pdf_download=1',
      data: formdata,
      xhrFields: {
          responseType: 'blob'
      },
      success: function(blob, status, xhr) {
        $this.removeClass('disable-button');
        //$this.find('.btn div').html(orig_text);
        $this.html(orig_text);
        var filename = "";
        var disposition = xhr.getResponseHeader('Content-Disposition');
        if (disposition && disposition.indexOf('attachment') !== -1) {
            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
            var matches = filenameRegex.exec(disposition);
            if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
        }

        if (typeof window.navigator.msSaveBlob !== 'undefined') {
            window.navigator.msSaveBlob(blob, filename);
        } else {
            var URL = window.URL || window.webkitURL;
            var downloadUrl = URL.createObjectURL(blob);
            if (filename) {
                var a = document.createElement("a");
                if (typeof a.download === 'undefined') {
                    window.location.href = downloadUrl;
                } else {
                    a.href = downloadUrl;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                }
            } else {
                window.location.href = downloadUrl;
            }
            setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100);
        }
          
      }
  });

});

 jQuery(document).ready(function($) {
   $('.acc-container .acc:nth-child(1) .acc-head').addClass('active');
   $('.acc-container .acc:nth-child(1) .acc-content').slideDown();
   $(document).on('click','.acc-head', function() {
       if($(this).hasClass('active')) {
         $(this).siblings('.acc-content').slideUp();
         $(this).removeClass('active');
       }
       else {
         $('.acc-content').slideUp();
         $('.acc-head').removeClass('active');
         $(this).siblings('.acc-content').slideToggle();
         $(this).toggleClass('active');
       }
   });     
   });