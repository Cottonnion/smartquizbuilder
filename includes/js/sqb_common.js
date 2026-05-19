 
function SQBShowLoader(text = ''){
	jQuery('.sqb_loading_wrapper').show();
    if(text != ''){
        jQuery('.sqb_loading_wrapper').addClass('sqb_loader_with_text_on');
    }
}

function SQBHideLoader(){
	jQuery('.sqb_loading_wrapper').hide();  
    jQuery('.sqb_loading_wrapper').removeClass('sqb_loader_with_text_on');
}
function sqb_show_loader(){
	 
}

function sqb_hide_loader(){
	 
}


function sqb_tiny_mce_editor(parent_selector='') {

    var global_theme = jQuery('#sqb_enable_global_setting_each_screen').prop('checked');

    var gdpr_value = jQuery('#gdpr_compliance').val();
    var is_googlefont = jQuery('#is_googlefont').val();
    if(gdpr_value == 0 && is_googlefont == 1){
    var font_load = "@import url('https://fonts.googleapis.com/css?family=Open+Sans');@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');@import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');@import url('https://fonts.googleapis.com/css2?family=Raleway&display=swap');@import url('https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap');@import ur('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');";
    }else{
        var font_load = '';
    }
    var get_home_url = jQuery('#get_home_url').val();

    if(global_theme){
        jQuery('body').addClass('sqb-new-global-editor');



        tinymce.PluginManager.add('sqb_media_buttons', function (editor) {

        // IMAGE BUTTON
        editor.addButton('sqb_image', {
            icon: 'image',
            tooltip: 'Insert Image',
            onclick: function () {

                let frame = wp.media({
                    title: 'Select Image',
                    library: { type: 'image' },
                    multiple: false
                });

                frame.on('select', function () {
                    let attachment = frame.state().get('selection').first().toJSON();

                    editor.insertContent(
                        '<img src="' + attachment.url + '" alt="' + (attachment.alt || '') + '" />'
                    );
                });

                frame.open();
            }
        });

        // VIDEO BUTTON
        editor.addButton('sqb_video', {
            icon: 'media',
            tooltip: 'Insert Video',
            onclick: function () {

                let frame = wp.media({
                    title: 'Select Video',
                    library: { type: 'video' },
                    multiple: false
                });

                frame.on('select', function () {
                    let attachment = frame.state().get('selection').first().toJSON();

                    // INSERT HTML5 VIDEO (NO TINYMCE POPUP)
                    editor.insertContent(
                        '<video controls style="max-width:100%">' +
                        '<source src="' + attachment.url + '" type="video/mp4">' +
                        '</video>'
                    );
                });

                frame.open();
            }
        });
    });

        tinymce.init({
            selector: parent_selector+' .sqb_tiny_mce_editor',
            menubar:false,
            statusbar: false,
            inline: true,
            height: 500,
            theme: 'modern',
            force_br_newlines: true,
            force_p_newlines: false,
            resize: "both",
            object_resizing: "img",
            forced_root_block: 'div',
            convert_urls: false,
            fontsize_formats: "8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 28pt 30pt 32pt 34pt 36pt 38pt 40pt",
            plugins: [
                    "lists link image charmap code",
                    "sqb_media_buttons",
                    "fullscreen",
                    "textcolor colorpicker"
                ],
            toolbar1: 'undo redo | sqb_image sqb_video | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify| forecolor | link | code ',
            //toolbar2: 'print preview media | forecolor backcolor emoticons ',      
            image_advtab: true,
            extended_valid_elements: 'video[controls|width|height|poster|style],source[src|type]',
            convert_urls: false,
            //lineheight_formats: "1 1.1 1.2 1.3 1.4 1.5 1.6 1.7 1.8 1.9 2",
            templates: [{
                title: 'Test template 1',
                content: 'Test 1'
            }, {
                title: 'Test template 2',
                content: 'Test 2'
            }],
            file_picker_types: 'image media',
            file_picker_callback: function (callback, value, meta) {

                let frame = wp.media({
                    title: 'Select or Upload Media',
                    button: { text: 'Use this media' },
                    multiple: false,
                    library: {
                        type: meta.filetype === 'image' ? 'image' : 'video'
                    }
                });

                frame.on('select', function () {
                    let attachment = frame.state().get('selection').first().toJSON();

                    if (meta.filetype === 'media') {
                        // INSERT WP VIDEO SHORTCODE
                        callback('[video src="' + attachment.url + '"]');
                    } else {
                        callback(attachment.url);
                    }
                });

                frame.open();
            }
        });
    }else{
        jQuery('body').removeClass('sqb-new-global-editor');
        tinymce.init({
        selector: parent_selector+' .sqb_tiny_mce_editor',
        inline: true,
        height: 500,
        theme: 'modern',
        force_br_newlines: true,
        force_p_newlines: false,
        external_plugins: {
            lineheight: get_home_url+'/wp-content/plugins/smartquizbuilder/includes/js/tinymce/lineheight/plugin.min.js',
            textshadow: get_home_url+'/wp-content/plugins/smartquizbuilder/includes/js/tinymce/textshadow/plugin.min.js',
            fontweight: get_home_url+'/wp-content/plugins/smartquizbuilder/includes/js/tinymce/fontweight/plugin.min.js'
        },
        resize: "both",
        object_resizing: "img",
        forced_root_block: 'div',
        convert_urls: false,
        fontsize_formats: "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 22pt 24pt 26pt 30pt 35pt 40pt",
        font_formats: "Andale Mono=andale mono,times;" + "Arial=arial,helvetica,sans-serif;" + "Arial Black=arial black,avant garde;" + "Book Antiqua=book antiqua,palatino;" + "Comic Sans MS=comic sans ms,sans-serif;" + "Courier New=courier new,courier;" + "Georgia=georgia,palatino;" + "Helvetica=helvetica;" + "Impact=impact,chicago;" + "Montserrat=Montserrat,sans-serif;Open Sans=open sans,sans-serif;Poppins=Poppins,sans-serif;Lato=Lato,sans-serif;Nunito=Nunito,sans-serif;Noto Serif=Noto Serif,sans-serif;Noto Sans=Noto Sans,sans-serif;Raleway=Raleway,sans-serif;" + "Rasa=Rasa;" + "Roboto=Roboto;" + "Symbol=symbol;" + "Tahoma=tahoma,arial,helvetica,sans-serif;" + "Terminal=terminal,monaco;" + "Times New Roman=times new roman,times;" + "Trebuchet MS=trebuchet ms,geneva;" + "Verdana=verdana,geneva;" + "Webdings=webdings;" + "Wingdings=wingdings,zapf dingbats",
        content_style: font_load,
        //plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak', 'searchreplace wordcount visualblocks visualchars code fullscreen', 'insertdatetime media nonbreaking save table contextmenu directionality', 'emoticons template paste textcolor colorpicker textpattern imagetools'],
       // toolbar1: 'insertfile undo redo | styleselect | bold italic |  fontselect | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
       // toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
       plugins: [
               "lists link image charmap code",
               "fullscreen",
               "media paste , textcolor colorpicker"
           ],
        toolbar1: 'insertfile undo redo | styleselect | fontselect | fontsizeselect | fontweightselect | lineheightselect | textshadowselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons ',      
        image_advtab: true,
        lineheight_formats: "1 1.1 1.2 1.3 1.4 1.5 1.6 1.7 1.8 1.9 2",
        fontweight_formats: "100 200 300 400 500 600 700 800 900 bold bolder inherit initial lighter normal revert unset",
        textshadow_formats: "1px 1px rgba(255,255,255,0.4)|2px 2px rgba(255,255,255,0.4)|3px 3px rgba(255,255,255,0.4)|1px 1px rgba(0,0,0,0.4)|2px 2px rgba(0,0,0,0.4)|3px 3px rgba(0,0,0,0.4)|1px 1px rgba(128,128,128,0.4)|2px 2px rgba(128,128,128,0.4)|3px 3px rgba(128,128,128,0.4)|none",
        templates: [{
            title: 'Test template 1',
            content: 'Test 1'
        }, {
            title: 'Test template 2',
            content: 'Test 2'
        }]
    });
    }

    sqb_tiny_mce_editor_for_outcome();
}


function sqb_tiny_mce_editor_for_outcome() {

    var global_theme = jQuery('#sqb_enable_global_setting_each_screen').prop('checked');

    var gdpr_value = jQuery('#gdpr_compliance').val();
    var is_googlefont = jQuery('#is_googlefont').val();
    if(gdpr_value == 0 && is_googlefont == 1){
    var font_load = "@import url('https://fonts.googleapis.com/css?family=Open+Sans');@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');@import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');@import url('https://fonts.googleapis.com/css2?family=Raleway&display=swap');@import url('https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap');@import ur('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');";
    }else{
        var font_load = '';
    }
    var get_home_url = jQuery('#get_home_url').val();

    if(global_theme){
        jQuery('body').addClass('sqb-new-global-editor');

        tinymce.init({
            selector: '#Outcome-Display .result_temp_outer .Quiz-Template-content-inn .sqb_outcome_tiny_mce_editor',
            menubar:false,
            statusbar: false,
            inline: true,
            height: 500,
            theme: 'modern',
            force_br_newlines: true,
            force_p_newlines: false,
            resize: "both",
            object_resizing: "img",
            forced_root_block: false,
            convert_urls: false,
            fontsize_formats: "8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 28pt 30pt 32pt 34pt 36pt 38pt 40pt",
            plugins: [
                    "lists link image charmap code",
                    "fullscreen",
                    "paste",
                    "media paste , textcolor colorpicker"
                ],
            toolbar1: 'insertfile undo redo | styleselect | fontselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | print preview media | forecolor backcolor emoticons',
                
            image_advtab: true,
            lineheight_formats: "1 1.1 1.2 1.3 1.4 1.5 1.6 1.7 1.8 1.9 2",
            fontweight_formats: "100 200 300 400 500 600 700 800 900 bold bolder inherit initial lighter normal revert unset",
            textshadow_formats: "1px 1px rgba(255,255,255,0.4)|2px 2px rgba(255,255,255,0.4)|3px 3px rgba(255,255,255,0.4)|1px 1px rgba(0,0,0,0.4)|2px 2px rgba(0,0,0,0.4)|3px 3px rgba(0,0,0,0.4)|1px 1px rgba(128,128,128,0.4)|2px 2px rgba(128,128,128,0.4)|3px 3px rgba(128,128,128,0.4)|none",
            paste_as_text: true,
            paste_preprocess: function(plugin, args) {
                // Ensure the content is wrapped in the root block (div in this case)
                args.content = '<div>' + args.content + '</div>';
            },
            templates: [{
                title: 'Test template 1',
                content: 'Test 1'
            }, {
                title: 'Test template 2',
                content: 'Test 2'
            }]
        });

        tinymce.init({
            selector: '#Outcome-Display .result_temp_outer .sqb_outcome_tiny_mce_editor',
            menubar:false,
            statusbar: false,
            inline: true,
            height: 500,
            theme: 'modern',
            force_br_newlines: true,
            force_p_newlines: false,
            resize: "both",
            object_resizing: "img",
            forced_root_block: false,
            convert_urls: false,
            fontsize_formats: "8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 28pt 30pt 32pt 34pt 36pt 38pt 40pt",
            plugins: [
                    "lists link image charmap code",
                    "fullscreen",
                    "paste",
                    "media paste , textcolor colorpicker"
                ],
            toolbar1: 'undo redo | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify| forecolor | link | code',
            //toolbar2: 'print preview media | forecolor backcolor emoticons ',      
            image_advtab: true,
            //lineheight_formats: "1 1.1 1.2 1.3 1.4 1.5 1.6 1.7 1.8 1.9 2",
            paste_as_text: true,
            paste_preprocess: function(plugin, args) {
                // Ensure the content is wrapped in the root block (div in this case)
                args.content = '<div>' + args.content + '</div>';
            },
            templates: [{
                title: 'Test template 1',
                content: 'Test 1'
            }, {
                title: 'Test template 2',
                content: 'Test 2'
            }]
        });


            
        

    }else{
        jQuery('body').removeClass('sqb-new-global-editor');
        tinymce.init({
        selector: '#Outcome-Display .result_temp_outer .sqb_outcome_tiny_mce_editor',
        menubar:false,
        statusbar: false,
        inline: true,
        height: 500,
        theme: 'modern',
        force_br_newlines: true,
        force_p_newlines: false,
        resize: "both",
        object_resizing: "img",
        forced_root_block: false,
        convert_urls: false,
        fontsize_formats: "8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 28pt 30pt 32pt 34pt 36pt 38pt 40pt",
        plugins: [
                "lists link image charmap code",
                "fullscreen",
                "paste",
                "media paste , textcolor colorpicker"
            ],
        toolbar1: 'insertfile undo redo | styleselect | fontselect | fontsizeselect | fontweightselect | lineheightselect | textshadowselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons ',      
        image_advtab: true,
        lineheight_formats: "1 1.1 1.2 1.3 1.4 1.5 1.6 1.7 1.8 1.9 2",
        fontweight_formats: "100 200 300 400 500 600 700 800 900 bold bolder inherit initial lighter normal revert unset",
        textshadow_formats: "1px 1px rgba(255,255,255,0.4)|2px 2px rgba(255,255,255,0.4)|3px 3px rgba(255,255,255,0.4)|1px 1px rgba(0,0,0,0.4)|2px 2px rgba(0,0,0,0.4)|3px 3px rgba(0,0,0,0.4)|1px 1px rgba(128,128,128,0.4)|2px 2px rgba(128,128,128,0.4)|3px 3px rgba(128,128,128,0.4)|none",
        paste_as_text: true,
        paste_preprocess: function(plugin, args) {
                // Ensure the content is wrapped in the root block (div in this case)
                args.content = '<div>' + args.content + '</div>';
            },
        templates: [{
            title: 'Test template 1',
            content: 'Test 1'
        }, {
            title: 'Test template 2',
            content: 'Test 2'
        }]
    });
    }
}
 
