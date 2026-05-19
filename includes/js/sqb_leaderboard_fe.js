jQuery(document).ready( function() {

    setSQBDWidth();
    var lb_pagination = jQuery('#lb_pagination').val();

    jQuery('.leaderboard-table table').DataTable({
        responsive: true,
            "language": {
                "emptyTable": "No Shortcodes Found"
            },
            "iDisplayLength": parseInt(lb_pagination),
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "bAutoWidth": false, 
            "ordering": false, 
            language: {
        paginate: {
          next: '>', // or '→'
          previous: '<' // or '←' 
        }
      },
            "fnDrawCallback": function(oSettings) {
           /* if (jQuery('.leaderboard-table tr').length < parseInt(lb_pagination)) {
                jQuery('.dataTables_paginate').hide();
            }*/

             if(oSettings.fnRecordsTotal() <= parseInt(lb_pagination)){     
                jQuery('.dataTables_length').hide();
                jQuery('.dataTables_paginate').hide();
            } else {
                jQuery('.dataTables_length').show();
                jQuery('.dataTables_paginate').show(); 
            }
        }
    }); 


    jQuery(document).on("click",".remove-from-leaderboard", function(){

        if(confirm(sqbLeaderboard.confirm_optout) == true) {
            
            jQuery.ajax({
                type : "post",
                url : sqbLeaderboard.ajaxurl,
                data : {action: "sqb_lb_exclude_users"},
                success: function(response) {
                   location.reload();
                }
             });

        } else {
            return false;
        }

    });
});

function setSQBDWidth(){
    var window_width = jQuery('html').width();
    jQuery('html').css("--window-width-full-screen", window_width+'px');
}

window.addEventListener('resize', function(event) {
    setSQBDWidth();
});
