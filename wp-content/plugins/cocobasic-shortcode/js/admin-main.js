(function ($) {
    "use stict";
    var custom_uploader;
    var select_control;

    checkPreviewBackground();
    setPreviewBackgroundOnLoad();

    $(window).on('load', function () {

        if ($('.block-editor-page').length)
        {
            select_control = $('#inspector-select-control-0');
        } else {
            select_control = $('#page_template');
        }

        switch (select_control.val()) {
            case 'onepage.php':
                $('#cocobasic_page_custom_meta_box').hide();
                break;
        }

        select_control.on('change', function () {
            switch (this.value) {
                case 'onepage.php':
                    $('#cocobasic_page_custom_meta_box').hide();
                    break;
                default :
                    $('#cocobasic_page_custom_meta_box').show();
            }
        });


        $('#upload_image_button').on('click', function (e) {
            var return_field = $(this).prev();
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
                $(return_field).val(attachment.url);

                var imgcheck = attachment.url.width;
                if (imgcheck !== 0) {
                    $('#small-background-image-preview').css('background-image', 'url(' + attachment.url + ')').addClass('has-background');
                }
            });
            //Open the uploader dialog
            custom_uploader.open();
        });

        if ($().ColorPicker) {
            doColors();
        }

    });


    function doColors()
    {

        var pageBackgroundColor = $('#colorPageBackgroundColor').next('input').first().attr('value');

        if (pageBackgroundColor == '') {
            pageBackgroundColor = '#ffffff';
        }

        $('#colorPageBackgroundColor').find('div').first().css('background-color', pageBackgroundColor);

        $('#colorPageBackgroundColor').ColorPicker({
            color: pageBackgroundColor,
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                $('#colorPageBackgroundColor div').css('backgroundColor', '#' + hex);
                $('#colorPageBackgroundColor').next('input').first().attr('value', '#' + hex);
            }
        });
    }

    function setPreviewBackgroundOnLoad() {
        $('.image-url-input').each(function () {
            if ($(this).val() !== '') {
                $(this).nextAll('#small-background-image-preview:first').css('background-image', 'url(' + $(this).val() + ')');
            } else {
                $(this).nextAll('#small-background-image-preview:first').removeClass('has-background');
            }
        });
    }

    function checkPreviewBackground() {
        $('.image-url-input').on('change', function () {
            if ($(this).val() === '') {
                $(this).nextAll('#small-background-image-preview:first').css('background-image', 'none').removeClass('has-background');
            }
        });
    }

})(jQuery);