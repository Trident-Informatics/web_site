(function ($) {

    "use strict";

    // COLORS                         
    wp.customize('cocobasic_menu_color', function (value) {
        value.bind(function (to) {
            var inlineStyle, customColorCssElemnt;

            inlineStyle = '<style class="custom-color-css1">';
            inlineStyle += '.site-wrapper .sm-clean li a.menu-item-link { color: ' + to + '; }';
            inlineStyle += '</style>';

            customColorCssElemnt = $('.custom-color-css1');

            if (customColorCssElemnt.length) {
                customColorCssElemnt.replaceWith(inlineStyle);
            } else {
                $('head').append(inlineStyle);
            }

        });
    });

    wp.customize('cocobasic_menu_background_color', function (value) {
        value.bind(function (to) {
            var inlineStyle, customColorCssElemnt;

            inlineStyle = '<style class="custom-color-css2">';
            inlineStyle += '.site-wrapper .header-holder, .site-wrapper .sm-clean ul { background-color: ' + to + '; }';
            inlineStyle += '</style>';

            customColorCssElemnt = $('.custom-color-css2');

            if (customColorCssElemnt.length) {
                customColorCssElemnt.replaceWith(inlineStyle);
            } else {
                $('head').append(inlineStyle);
            }

        });
    });


    wp.customize('cocobasic_global_color', function (value) {
        value.bind(function (to) {
            var inlineStyle, customColorCssElemnt;

            inlineStyle = '<style class="custom-color-css3">';
            inlineStyle += 'body .site-wrapper a, body .site-wrapper a:hover, body .site-wrapper .sm-clean a:hover, body .site-wrapper .main-menu.sm-clean .sub-menu li a:hover, body .site-wrapper .sm-clean li.active a, body .site-wrapper .sm-clean li.current-page-ancestor > a, body .site-wrapper .sm-clean li.current_page_ancestor > a, body .site-wrapper .sm-clean li.current_page_item > a, body .site-wrapper #header-main-menu .sm-clean li a.menu-item-link:hover, .site-wrapper .blog-item-holder a.item-button:hover, .site-wrapper .navigation.pagination a:hover, .site-wrapper .tags-holder a:hover, .site-wrapper .comment-form-holder a:hover, .site-wrapper .replay-at-author, .site-wrapper .form-submit input[type=submit]:hover, .site-wrapper .wpcf7 input[type=submit]:hover, body .site-wrapper .footer .footer-content a:hover, .site-wrapper a.button:hover, .site-wrapper .more-posts-portfolio:hover, .site-wrapper .pricing-table-price, .site-wrapper .pricing-list span.fa, body .site-wrapper .footer .footer-content.center-relative a:hover { color: ' + to + '; }';
            inlineStyle += '.site-wrapper .blog-item-holder a.item-button, .blog .site-wrapper .more-posts, .blog .site-wrapper .no-more-posts, .blog .site-wrapper .more-posts-loading, .site-wrapper .page-title-holder, .site-wrapper .navigation.pagination .current, .site-wrapper .tags-holder a, .single .site-wrapper .nav-links > a, .site-wrapper .form-submit input[type=submit], .site-wrapper .search h1.entry-title, .site-wrapper .archive h1.entry-title, .site-wrapper .wpcf7 input[type=submit], .site-wrapper a.button, .site-wrapper .member-social-holder { background-color: ' + to + '; }';
            inlineStyle += '.site-wrapper .blog-item-holder a.item-button, .site-wrapper .tags-holder a, .site-wrapper .form-submit input[type=submit], .site-wrapper .wpcf7 input[type=submit], .site-wrapper a.button, .single .site-wrapper .entry-info:after { border-color: ' + to + '; }';
            inlineStyle += '.site-wrapper .page-title-holder:after { border-top-color: ' + to + '; }';
            inlineStyle += '</style>';

            customColorCssElemnt = $('.custom-color-css3');

            if (customColorCssElemnt.length) {
                customColorCssElemnt.replaceWith(inlineStyle);
            } else {
                $('head').append(inlineStyle);
            }

        });
    });


    wp.customize('cocobasic_footer_background', function (value) {
        value.bind(function (to) {
            var inlineStyle, customColorCssElemnt;

            inlineStyle = '<style class="custom-color-css4">';
            inlineStyle += '.site-wrapper .footer { background-color: ' + to + '; }';
            inlineStyle += '</style>';

            customColorCssElemnt = $('.custom-color-css4');

            if (customColorCssElemnt.length) {
                customColorCssElemnt.replaceWith(inlineStyle);
            } else {
                $('head').append(inlineStyle);
            }

        });
    });

    
    wp.customize('cocobasic_footer_background', function (value) {
        value.bind(function (to) {
            var inlineStyle, customColorCssElemnt;

            inlineStyle = '<style class="custom-color-css5">';
            inlineStyle += '.single .site-wrapper .nav-links > a:hover { background-color: ' + to + '; }';
            inlineStyle += '</style>';

            customColorCssElemnt = $('.custom-color-css5');

            if (customColorCssElemnt.length) {
                customColorCssElemnt.replaceWith(inlineStyle);
            } else {
                $('head').append(inlineStyle);
            }

        });
    });

    function cocobasic_hexToRGB(hex, alpha) {
        var r = parseInt(hex.slice(1, 3), 16),
                g = parseInt(hex.slice(3, 5), 16),
                b = parseInt(hex.slice(5, 7), 16);

        if (alpha) {
            return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
        } else {
            return "rgb(" + r + ", " + g + ", " + b + ")";
        }
    }

})(jQuery);