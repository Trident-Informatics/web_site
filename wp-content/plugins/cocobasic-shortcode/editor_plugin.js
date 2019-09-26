(function () {

    "use strict";

    tinymce.create('tinymce.plugins.shortcodes_options', {
        init: function (ed, url) {
            ed.addButton('cocobasic_shortcodes_button', {
                title: 'CocoBasic',
                image: url + '/editor.png',
                onclick: function () {

                    if (jQuery('#cocobasic_shortcodes_popup_holder').is(":visible")) {
                        jQuery("#cocobasic_shortcodes_popup_holder").hide();
                    } else {
                        jQuery("#cocobasic_shortcodes_popup_holder").show();

                        jQuery("#wp-content-editor-tools").append("<div id='cocobasic_shortcodes_popup_holder'></div>");
                        jQuery('#cocobasic_shortcodes_popup_holder').load(url + '/cocobasic_shortcodes_popup.php#cocobasic_shortcodes_popup', function () {

                            var y = jQuery("#wp-content-media-buttons").height();
                            var x = jQuery('div[aria-label="CocoBasic"]').offset().left - jQuery("#adminmenuwrap").width() + 10;

                            jQuery("#cocobasic_shortcodes_popup_holder").css({top: y, left: x});

                            jQuery("#cocobasic_columns").on('click', function () {
                                addColumnsHtml();
                            });

                            jQuery("#cocobasic_service").on('click', function () {
                                var shortcode = '[service title="Preciese" num="1"]<br/>Phasellus vel est sem integer suscipit enim quis dictum.<br/>[button_dot href="https://LinkHere.com"]MORE[/button_dot]<br/>[/service]';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                                jQuery("#cocobasic_shortcodes_popup_holder").hide();
                            });

                            jQuery("#cocobasic_info_text").click(function () {
                                var shortcode = '[info title="PROJECT"]Corporate Branding[/info]';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                                jQuery("#cocobasic_shortcodes_popup_holder").hide();
                            });
                            
                            jQuery("#cocobasic_medium_text").click(function () {
                                var shortcode = '[medium_text up="WHO WE ARE"]Live up to your creative potential.[/medium_text]';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                                jQuery("#cocobasic_shortcodes_popup_holder").hide();
                            });

                            jQuery("#cocobasic_skills").click(function () {
                                var shortcode = '[skills]<br/>[skill percent="90%" text="WP"]<br/>[skill percent="75%" text="Creativity"]<br/>[skill percent="20%" text="Cooking"]<br/>[skill percent="90%" text="Development"]<br/>[skill percent="60%" text="Marketing"]<br/>[/skills]';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                                jQuery("#cocobasic_shortcodes_popup_holder").hide();
                            });          

                            jQuery("#cocobasic_image_slider").on('click', function () {
                                addImageSliderHtml();
                            });

                            jQuery("#cocobasic_image_slide").on('click', function () {
                                addImageSlideHtml();
                            });

                            jQuery("#cocobasic_text_slider").on('click', function () {
                                addTextSliderHtml();
                            });

                            jQuery("#cocobasic_text_slide").on('click', function () {
                                addTextSlideHtml();
                            });

                            jQuery("#cocobasic_pricing").click(function () {
                                var shortcode = '[pricing title="BASIC" num="1" button_text="CHOOSE PLAN" price="$29" sub_price="per month" href="#" target="_self"]<br/>[pricing_list]Lipsum[/pricing_list]<br/>[pricing_list]Lipsum[/pricing_list]<br/>[pricing_list]Lipsum[/pricing_list]<br/>[pricing_list]Lipsum[/pricing_list]<br/>[pricing_list included="no"]Lipsum[/pricing_list]<br/>[pricing_list included="no"]Lipsum[/pricing_list]<br/>[/pricing]';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                                jQuery("#cocobasic_shortcodes_popup_holder").hide();
                            });

                            jQuery("#cocobasic_latest_posts").click(function () {
                                var shortcode = '[latest_posts show="5"]';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                                jQuery("#cocobasic_shortcodes_popup_holder").hide();
                            });

                            jQuery("#cocobasic_milestones").click(function () {
                                var shortcode = '[milestones]<br/>[milestone num="135" title="Terabytes of files uploaded"]Nulla ac laoreet est, a mollis nibh. Aenean eget auctor velit quis pharetra.[/milestone]<br/>[milestone num="67K" title="Lines of CSS code wrote"]Nulla ac laoreet est, a mollis nibh. Aenean eget auctor velit quis pharetra.[/milestone]<br/>[/milestones]';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                                jQuery("#cocobasic_shortcodes_popup_holder").hide();
                            });
                            
                            jQuery("#cocobasic_social_icons").click(function () {
                                addSocialIconsHtml();
                            });

                            jQuery("#cocobasic_button").click(function () {
                                addButtonHtml();
                            });
                        })
                    }
                },
            });
            return null;
        }
    });

    tinymce.PluginManager.add('shortcodes_options', tinymce.plugins.shortcodes_options);
})();

// COLUMNS  //
var addColumnsHtml = function () {
    var params = {
        'name': 'columns'
    };
    jQuery.ajax({
        type: "POST",
        url: '../wp-content/plugins/cocobasic-shortcode/shortcode_template.php',
        data: params
    }).done(function (response) {

        var responseObj = jQuery.parseJSON(response);
        if (responseObj.ResponseData) {
            var form = jQuery(responseObj.ResponseData);
        }

        form.appendTo('body').hide();

        var selected_column = jQuery('#cocobasic_shortcode_columns select option:selected').text();

        jQuery('#cocobasic_shortcode_columns').on('change', function () {
            var optionSelected = jQuery(this).find("option:selected");
            selected_column = optionSelected.text();
        });

        var isChecked = jQuery('#column_checkbox').attr('checked') ? true : false;

        jQuery('#column_checkbox').on('click', function () {

            if (isChecked)
            {
                isChecked = false;
            } else
            {
                isChecked = true;
            }
        });

        // handles the click event of the submit button
        form.find('#submit_shortcode').on('click', function () {


            var shortcode = null;

            if (!isChecked) {
                switch (selected_column) {
                    case '1/1' :
                        shortcode = '[col size="one"';
                        break;
                    case '1/3' :
                        shortcode = '[col size="one_third"';
                        break;
                    case '2/3' :
                        shortcode = '[col size="two_third"';
                        break;
                    case '1/2' :
                        shortcode = '[col size="one_half"';
                        break;
                    case '1/4' :
                        shortcode = '[col size="one_fourth"';
                        break;
                    case '3/4' :
                        shortcode = '[col size="three_fourth"';
                        break;
                    default :
                        shortcode = '';
                }
            } else {
                switch (selected_column) {
                    case '1/1' :
                        shortcode = '[col size="one"';
                        break;
                    case '1/3' :
                        shortcode = '[col size="one_third_last"';
                        break;
                    case '2/3' :
                        shortcode = '[col size="two_third_last"';
                        break;
                    case '1/2' :
                        shortcode = '[col size="one_half_last"';
                        break;
                    case '1/4' :
                        shortcode = '[col size="one_fourth_last"';
                        break;
                    case '3/4' :
                        shortcode = '[col size="three_fourth_last"';
                        break;
                    default :
                        shortcode = '';
                }
            }

            var columns_class = jQuery('#shortcode_columns_class').val();

            if (columns_class != '') {
                shortcode += ' class="' + columns_class + '"][/col]';
            } else {
                shortcode += '][/col]';
            }

            // inserts the shortcode into the active editor
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            // closes Thickbox
            tb_remove();
            jQuery("#cocobasic_shortcodes_popup_holder").hide();
        });
        var width = jQuery(window).width(), H = jQuery(window).height(), W = (720 < width) ? 720 : width;
        W = W - 80;
        H = H - 84;
        tb_show('Columns Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=shortcodes_columns_form');
    });

};

//  IMAGE SLIDER  //
var addImageSliderHtml = function () {
    var params = {
        'name': 'image_slider'
    };
    jQuery.ajax({
        type: "POST",
        url: '../wp-content/plugins/cocobasic-shortcode/shortcode_template.php',
        data: params
    }).done(function (response) {

        var responseObj = jQuery.parseJSON(response);
        if (responseObj.ResponseData) {
            var form = jQuery(responseObj.ResponseData);
        }

        form.appendTo('body').hide();
        var table = form.find('table');
        // handles the click event of the submit button
        form.find('#submit_shortcode').on('click', function () {

            var options = {
                'name': 'slider1',
                'auto': 'true',
                'hover_pause': 'true',
                'speed': '2000'
            };

            var shortcode = '[image_slider';
            for (var index in options) {
                var value = table.find('#shortcode_image_slider_' + index).val();
                if (value != '')
                {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }
            shortcode += ']<br/><br/>[/image_slider]';

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            // closes Thickbox
            tb_remove();
            jQuery("#cocobasic_shortcodes_popup_holder").hide();
        });
        var width = jQuery(window).width(), H = jQuery(window).height(), W = (720 < width) ? 720 : width;
        W = W - 80;
        H = H - 84;
        tb_show('Image Slider Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=shortcodes_image_slider_form');
    });
};

//  IMAGE SLIDE  //
var addImageSlideHtml = function () {
    var params = {
        'name': 'image_slide'
    };
    jQuery.ajax({
        type: "POST",
        url: '../wp-content/plugins/cocobasic-shortcode/shortcode_template.php',
        data: params
    }).done(function (response) {

        var responseObj = jQuery.parseJSON(response);
        if (responseObj.ResponseData) {
            var form = jQuery(responseObj.ResponseData);
        }

        form.appendTo('body').hide();
        var table = form.find('table');
        // handles the click event of the submit button

        var custom_uploader;

        form.find('#upload_image_button').on('click', function (e) {

            var return_field = jQuery(this).prev();
            e.preventDefault();


            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }

            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });

            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function () {
                attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery(return_field).val(attachment.url);
            });

            //Open the uploader dialog
            custom_uploader.open();

        });

        form.find('#submit_shortcode').on('click', function () {

            var options = {
                'img': '',
                'alt': '',
                'href': '',
                'target': ''
            };

            var shortcode = '[image_slide';
            for (var index in options) {
                var value = table.find('#shortcode_image_slide_' + index).val();
                if (value != '')
                {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }
            shortcode += ']';

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            // closes Thickbox
            tb_remove();
            jQuery("#cocobasic_shortcodes_popup_holder").hide();
        });
        var width = jQuery(window).width(), H = jQuery(window).height(), W = (720 < width) ? 720 : width;
        W = W - 80;
        H = H - 84;
        tb_show('Image Slide Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=shortcodes_image_slide_form');
    });
};

//  TEXT SLIDER  //
var addTextSliderHtml = function () {
    var params = {
        'name': 'text_slider'
    };
    jQuery.ajax({
        type: "POST",
        url: '../wp-content/plugins/cocobasic-shortcode/shortcode_template.php',
        data: params
    }).done(function (response) {

        var responseObj = jQuery.parseJSON(response);
        if (responseObj.ResponseData) {
            var form = jQuery(responseObj.ResponseData);
        }

        form.appendTo('body').hide();
        var table = form.find('table');
        // handles the click event of the submit button
        form.find('#submit_shortcode').on('click', function () {

            var options = {
                'name': 'textSlider1',
                'auto': 'true',
                'hover_pause': 'true',
                'speed': '2000'
            };

            var shortcode = '[text_slider';
            for (var index in options) {
                var value = table.find('#shortcode_text_slider_' + index).val();
                if (value != '')
                {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }
            shortcode += ']<br/><br/>[/text_slider]';

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            // closes Thickbox
            tb_remove();
            jQuery("#cocobasic_shortcodes_popup_holder").hide();
        });
        var width = jQuery(window).width(), H = jQuery(window).height(), W = (720 < width) ? 720 : width;
        W = W - 80;
        H = H - 84;
        tb_show('Text Slider Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=shortcodes_text_slider_form');
    });
};

//  TEXT SLIDE  //
var addTextSlideHtml = function () {
    var params = {
        'name': 'text_slide'
    };
    jQuery.ajax({
        type: "POST",
        url: '../wp-content/plugins/cocobasic-shortcode/shortcode_template.php',
        data: params
    }).done(function (response) {

        var responseObj = jQuery.parseJSON(response);
        if (responseObj.ResponseData) {
            var form = jQuery(responseObj.ResponseData);
        }

        form.appendTo('body').hide();
        var table = form.find('table');
        // handles the click event of the submit button

        var custom_uploader;

        form.find('#upload_image_button').on('click', function (e) {

            var return_field = jQuery(this).prev();
            e.preventDefault();


            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }

            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });

            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function () {
                attachment = custom_uploader.state().get('selection').first().toJSON();
                jQuery(return_field).val(attachment.url);
            });

            //Open the uploader dialog
            custom_uploader.open();

        });

        form.find('#submit_shortcode').on('click', function () {

            var options = {
                'name': '',
                'position': '',
                'img': '',
                'alt': ''
            };

            var shortcode = '[text_slide';
            for (var index in options) {
                var value = table.find('#shortcode_text_slide_' + index).val();
                if (value != '')
                {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }
            shortcode += ']CONTENT HEHRE[/text_slide]';

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            // closes Thickbox
            tb_remove();
            jQuery("#cocobasic_shortcodes_popup_holder").hide();
        });
        var width = jQuery(window).width(), H = jQuery(window).height(), W = (720 < width) ? 720 : width;
        W = W - 80;
        H = H - 84;
        tb_show('Text Slide Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=shortcodes_text_slide_form');
    });
};

//  SOCIAL ICONS  //
var addSocialIconsHtml = function () {
    var params = {
        'name': 'socialIcons'
    };
    jQuery.ajax({
        type: "POST",
        url: '../wp-content/plugins/cocobasic-shortcode/shortcode_template.php',
        data: params
    }).done(function (response) {

        var responseObj = jQuery.parseJSON(response);
        if (responseObj.ResponseData) {
            var form = jQuery(responseObj.ResponseData);
        }

        form.appendTo('body').hide();
        var table = form.find('table');
        // handles the click event of the submit button
        form.find('#submit_shortcode').click(function () {

            var options = {
                'icon': '',
                'href': '',
                'target': '_self'
            };

            var shortcode = '[social';
            for (var index in options) {
                var value = table.find('#shortcode_socialIcons_' + index).val();
                if (value != '')
                {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }

            shortcode += ']';

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            // closes Thickbox
            tb_remove();
            jQuery("#cocobasic_shortcodes_popup_holder").hide();
        });
        var width = jQuery(window).width(), H = jQuery(window).height(), W = (720 < width) ? 720 : width;
        W = W - 80;
        H = H - 84;
        tb_show('Social Icon Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=shortcodes_socialIcons_form');
    });
};

//  BUTTON  //
var addButtonHtml = function () {
    var params = {
        'name': 'button'
    };
    jQuery.ajax({
        type: "POST",
        url: '../wp-content/plugins/cocobasic-shortcode/shortcode_template.php',
        data: params
    }).done(function (response) {

        var responseObj = jQuery.parseJSON(response);
        if (responseObj.ResponseData) {
            var form = jQuery(responseObj.ResponseData);
        }

        form.appendTo('body').hide();
        var table = form.find('table');
        // handles the click event of the submit button
        form.find('#submit_shortcode').click(function () {

            var options = {
                'class': '',
                'href': '',
                'target': '_self',
                'position': 'center'
            };

            var shortcode = '[button';
            for (var index in options) {
                var value = table.find('#shortcode_button_' + index).val();
                if (value != '')
                {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }

            shortcode += ']BUTTON TEXT[/button]';

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            // closes Thickbox
            tb_remove();
            jQuery("#cocobasic_shortcodes_popup_holder").hide();
        });
        var width = jQuery(window).width(), H = jQuery(window).height(), W = (720 < width) ? 720 : width;
        W = W - 80;
        H = H - 84;
        tb_show('Button Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=shortcodes_button_form');
    });
};			 