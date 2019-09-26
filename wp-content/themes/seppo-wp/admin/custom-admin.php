<?php
/*
 * Register Theme Customizer
 */
add_action('customize_register', 'cocobasic_theme_customize_register');

function cocobasic_theme_customize_register($wp_customize) {

    function cocobasic_clean_html($value) {
        $allowed_html_array = cocobasic_allowed_html();
        $value = wp_kses($value, $allowed_html_array);
        return $value;
    }

    class CocoBasicWP_Customize_Textarea_Control extends WP_Customize_Control {

        public $type = 'textarea';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <textarea rows="10" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
            </label>
            <?php
        }

    }

    //----------------------------- IMAGE SECTION  ---------------------------------------------

    $wp_customize->add_section('cocobasic_image_section', array(
        'title' => esc_html__('Images Section', 'seppo-wp'),
        'priority' => 33
    ));


    $wp_customize->add_setting('cocobasic_preloader', array(
        'default' => get_template_directory_uri() . '/images/preloader.gif',
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cocobasic_preloader', array(
        'label' => esc_html__('Preloader Gif', 'seppo-wp'),
        'section' => 'cocobasic_image_section',
        'settings' => 'cocobasic_preloader'
    )));

    $wp_customize->add_setting('cocobasic_header_logo', array(
        'default' => get_template_directory_uri() . '/images/logo.png',
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cocobasic_header_logo', array(
        'label' => esc_html__('Header Logo', 'seppo-wp'),
        'section' => 'cocobasic_image_section',
        'settings' => 'cocobasic_header_logo',
        'priority' => 998
    )));

    $wp_customize->add_setting('cocobasic_logo_width', array(
        'default' => "88px",
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control('cocobasic_logo_width', array(
        'label' => esc_html__('Header Logo Width:', 'seppo-wp'),
        'section' => 'cocobasic_image_section',
        'settings' => 'cocobasic_logo_width',
        'priority' => 998
    ));

    $wp_customize->add_setting('cocobasic_logo_height', array(
        'default' => "50px",
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control('cocobasic_logo_height', array(
        'label' => esc_html__('Header Logo Height:', 'seppo-wp'),
        'section' => 'cocobasic_image_section',
        'settings' => 'cocobasic_logo_height',
        'priority' => 998
    ));



    //----------------------------- END IMAGE SECTION  ---------------------------------------------
    //
    //
    //
    //----------------------------------COLORS SECTION--------------------

    $wp_customize->add_setting('cocobasic_preloader_background_color', array(
        'default' => '#000000',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cocobasic_preloader_background_color', array(
        'label' => esc_html__('Preloader Background Color', 'seppo-wp'),
        'section' => 'colors',
        'settings' => 'cocobasic_preloader_background_color'
    )));

    $wp_customize->add_setting('cocobasic_menu_background_color', array(
        'default' => '#060606',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cocobasic_menu_background_color', array(
        'label' => esc_html__('Menu Background Color', 'seppo-wp'),
        'section' => 'colors',
        'settings' => 'cocobasic_menu_background_color'
    )));

    $wp_customize->add_setting('cocobasic_menu_color', array(
        'default' => '#ffffff',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cocobasic_menu_color', array(
        'label' => esc_html__('Menu Color', 'seppo-wp'),
        'section' => 'colors',
        'settings' => 'cocobasic_menu_color'
    )));

    $wp_customize->add_setting('cocobasic_global_color', array(
        'default' => '#47ea4e',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cocobasic_global_color', array(
        'label' => esc_html__('Global Color', 'seppo-wp'),
        'section' => 'colors',
        'settings' => 'cocobasic_global_color'
    )));

    $wp_customize->add_setting('cocobasic_single_post_navigation_hover_color', array(
        'default' => '#73f473',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cocobasic_single_post_navigation_hover_color', array(
        'label' => esc_html__('Single Post Navigation Mouseover Color', 'seppo-wp'),
        'section' => 'colors',
        'settings' => 'cocobasic_single_post_navigation_hover_color'
    )));


    //----------------------------------------------------------------------------------------------
    //
    //
    //
      //------------------------- FOOTER SECTION ---------------------------------------------

    $wp_customize->add_section('cocobasic_footer_text_section', array(
        'title' => esc_html__('Footer', 'seppo-wp'),
        'priority' => 99
    ));

    $wp_customize->add_setting('cocobasic_footer_background_image', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cocobasic_footer_background_image', array(
        'label' => esc_html__('Footer Background Image', 'seppo-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'cocobasic_footer_background_image',
        'priority' => 999
    )));

    $wp_customize->add_setting('cocobasic_footer_background_color', array(
        'default' => '#111111',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cocobasic_footer_background_color', array(
        'label' => esc_html__('Footer Background Color', 'seppo-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'cocobasic_footer_background_color'
    )));

    $wp_customize->add_setting('cocobasic_footer_logo', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cocobasic_footer_logo', array(
        'label' => esc_html__('Footer Logo', 'seppo-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'cocobasic_footer_logo',
        'priority' => 999
    )));

    $wp_customize->add_setting('cocobasic_footer_logo_width', array(
        'default' => "88px",
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control('cocobasic_footer_logo_width', array(
        'label' => esc_html__('Footer Logo Width:', 'seppo-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'cocobasic_footer_logo_width',
        'priority' => 999
    ));

    $wp_customize->add_setting('cocobasic_footer_logo_height', array(
        'default' => "50px",
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control('cocobasic_footer_logo_height', array(
        'label' => esc_html__('Footer Logo Height:', 'seppo-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'cocobasic_footer_logo_height',
        'priority' => 999
    ));

    $wp_customize->add_setting('cocobasic_show_logo_divider', array(
        'default' => 'no',
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control('cocobasic_show_logo_divider', array(
        'label' => esc_html__('Show Footer Logo Divider', 'seppo-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'cocobasic_show_logo_divider',
        'priority' => 999,
        'type' => 'radio',
        'choices' => array(
            'yes' => esc_html__('Yes', 'seppo-wp'),
            'no' => esc_html__('No', 'seppo-wp'),
    )));


    $wp_customize->add_setting('cocobasic_footer_mail', array(
        'default' => '',
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control(new CocoBasicWP_Customize_Textarea_Control($wp_customize, 'cocobasic_footer_mail', array(
        'label' => esc_html__('Footer Mail', 'seppo-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'cocobasic_footer_mail',
        'priority' => 999
    )));



    $wp_customize->add_setting('cocobasic_show_social_divider', array(
        'default' => 'no',
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control('cocobasic_show_social_divider', array(
        'label' => esc_html__('Show Social Divider', 'seppo-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'cocobasic_show_social_divider',
        'priority' => 999,
        'type' => 'radio',
        'choices' => array(
            'yes' => esc_html__('Yes', 'seppo-wp'),
            'no' => esc_html__('No', 'seppo-wp'),
    )));

    $wp_customize->add_setting('cocobasic_footer_social_content', array(
        'default' => '',
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control(new CocoBasicWP_Customize_Textarea_Control($wp_customize, 'cocobasic_footer_social_content', array(
        'label' => esc_html__('Footer Social Content', 'seppo-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'cocobasic_footer_social_content',
        'priority' => 999
    )));


    $wp_customize->add_setting('cocobasic_footer_copyright_content', array(
        'default' => '',
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control(new CocoBasicWP_Customize_Textarea_Control($wp_customize, 'cocobasic_footer_copyright_content', array(
        'label' => esc_html__('Footer Copyright Content:', 'seppo-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'cocobasic_footer_copyright_content',
        'priority' => 999
    )));



    //---------------------------- END FOOTER TEXT SECTION --------------------------
    //
    //
    //--------------------------------------------------------------------------
    $wp_customize->get_setting('cocobasic_menu_color')->transport = 'postMessage';
    $wp_customize->get_setting('cocobasic_menu_background_color')->transport = 'postMessage';
    $wp_customize->get_setting('cocobasic_global_color')->transport = 'postMessage';
    $wp_customize->get_setting('cocobasic_preloader_background_color')->transport = 'postMessage';
    $wp_customize->get_setting('cocobasic_footer_background_color')->transport = 'postMessage';
    $wp_customize->get_setting('cocobasic_single_post_navigation_hover_color')->transport = 'postMessage';
    //--------------------------------------------------------------------------
    /*
     * If preview mode is active, hook JavaScript to preview changes
     */
    if ($wp_customize->is_preview() && !is_admin()) {
        add_action('customize_preview_init', 'cocobasic_theme_customize_preview_js');
    }
}

/**
 * Bind Theme Customizer JavaScript
 */
function cocobasic_theme_customize_preview_js() {
    wp_enqueue_script('cocobasic-wp-theme-customizer', get_template_directory_uri() . '/admin/js/custom-admin.js', array('customize-preview'), '20120910', true);
}

/*
 * Generate CSS Styles
 */

class CocoBasicWPLiveCSS {

    public static function cocobasic_theme_customized_style() {
        echo '<style type="text/css">' .
        //Menu Color, Menu Background Color
        cocobasic_generate_css('.site-wrapper .sm-clean li a.menu-item-link', 'color', 'cocobasic_menu_color', '', '') .
        cocobasic_generate_css('.site-wrapper .header-holder, .site-wrapper .sm-clean ul', 'background-color', 'cocobasic_menu_background_color', '', '') .
        //Global Color
        cocobasic_generate_css('body .site-wrapper a, body .site-wrapper a:hover, body .site-wrapper .sm-clean a:hover, body .site-wrapper .main-menu.sm-clean .sub-menu li a:hover, body .site-wrapper .sm-clean li.active a, body .site-wrapper .sm-clean li.current-page-ancestor > a, body .site-wrapper .sm-clean li.current_page_ancestor > a, body .site-wrapper .sm-clean li.current_page_item > a, body .site-wrapper #header-main-menu .sm-clean li a.menu-item-link:hover, .site-wrapper .blog-item-holder a.item-button:hover, .site-wrapper .navigation.pagination a:hover, .site-wrapper .tags-holder a:hover, .site-wrapper .comment-form-holder a:hover, .site-wrapper .replay-at-author, .site-wrapper .form-submit input[type=submit]:hover, .site-wrapper .wpcf7 input[type=submit]:hover, body .site-wrapper .footer .footer-content a:hover, .site-wrapper a.button:hover, .site-wrapper .more-posts-portfolio:hover, .site-wrapper .pricing-table-price, .site-wrapper .pricing-list span.fa, body .site-wrapper .footer .footer-content.center-relative a:hover', 'color', 'cocobasic_global_color') .
        cocobasic_generate_css('.site-wrapper .blog-item-holder a.item-button, .blog .site-wrapper .more-posts, .blog .site-wrapper .no-more-posts, .blog .site-wrapper .more-posts-loading, .site-wrapper .page-title-holder, .site-wrapper .navigation.pagination .current, .site-wrapper .tags-holder a, .single .site-wrapper .nav-links > a, .site-wrapper .form-submit input[type=submit], .site-wrapper .search h1.entry-title, .site-wrapper .archive h1.entry-title, .site-wrapper .wpcf7 input[type=submit], .site-wrapper a.button, .site-wrapper .member-social-holder', 'background-color', 'cocobasic_global_color') .
        cocobasic_generate_css('.site-wrapper .blog-item-holder a.item-button, .site-wrapper .tags-holder a, .site-wrapper .form-submit input[type=submit], .site-wrapper .wpcf7 input[type=submit], .site-wrapper a.button, .single .site-wrapper .entry-info:after', 'border-color', 'cocobasic_global_color') .
        cocobasic_generate_css('.site-wrapper .page-title-holder:after', 'border-top-color', 'cocobasic_global_color') .        
        //Single Post Navigation Hover Color
        cocobasic_generate_css('.single .site-wrapper .nav-links > a:hover', 'background-color', 'cocobasic_single_post_navigation_hover_color') .
        //Footer Background Color
        cocobasic_generate_css('.site-wrapper .footer', 'background-color', 'cocobasic_footer_background_color') .
        //Preloader Background Color
        cocobasic_generate_css('.site-wrapper .doc-loader', 'background-color', 'cocobasic_preloader_background_color') .
        cocobasic_generate_additional_css() .
        '</style>';
    }

}

/*
 * Generate CSS Class - Helper Method
 */

function cocobasic_generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $rgba = '') {
    $return = '';
    $mod = get_option($mod_name);
    if (!empty($mod)) {
        if ($rgba === true) {
            $mod = '0px 0px 50px 0px ' . cocobasic_hex2rgba($mod, 0.65);
        }
        $return = sprintf('%s { %s:%s; }', $selector, $style, $prefix . $mod . $postfix
        );
    }
    return $return;
}

function cocobasic_generate_additional_css() {
    $allowed_html_array = cocobasic_allowed_html();
    $return = '';
    if (get_theme_mod('cocobasic_logo_width') != '' || get_theme_mod('cocobasic_logo_height') != ''):
        $return .= '.site-wrapper .header-logo img{width: ' . get_theme_mod('cocobasic_logo_width') . '; height: ' . get_theme_mod('cocobasic_logo_height') . ';}';
    endif;
    if (get_theme_mod('cocobasic_footer_logo_width') != '' || get_theme_mod('cocobasic_footer_logo_height') != ''):
        $return .= '.site-wrapper .footer-logo img{width: ' . get_theme_mod('cocobasic_footer_logo_width') . '; height: ' . get_theme_mod('cocobasic_footer_logo_height') . ';}';
    endif;
    if (get_theme_mod('cocobasic_show_logo_divider') === 'yes'):
        $return .= '.site-wrapper .footer-logo-divider {display: block;}';
    endif;
    if (get_theme_mod('cocobasic_show_social_divider') === 'yes'):
        $return .= '.site-wrapper .footer-social-divider {display: block;}';
    endif;
    if (get_option('cocobasic_footer_background_image') !== '' && get_option('cocobasic_footer_background_image') !== false):
        $return .= '.footer{background-image: url(' . esc_url(get_option('cocobasic_footer_background_image')) . ');}';
    endif;
    $return = wp_kses($return, $allowed_html_array);
    return $return;
}
?>