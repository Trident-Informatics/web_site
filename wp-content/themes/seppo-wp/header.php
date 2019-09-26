<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>        
        <meta charset="<?php bloginfo('charset'); ?>" />        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />       
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="site-wrapper">             
            <div class="doc-loader">
                <?php if (get_option('cocobasic_preloader') !== ''): ?>
                    <img src="<?php echo esc_url(get_option('cocobasic_preloader', get_template_directory_uri() . '/images/preloader.gif')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                <?php endif; ?>
            </div>       

            <header class="header-holder">             
                <div class="menu-wrapper center-relative relative">             
                    <div class="header-logo">
                        <?php if (get_option('cocobasic_header_logo') !== ''): ?>                            
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <img src="<?php echo esc_url(get_option('cocobasic_header_logo', get_template_directory_uri() . '/images/logo.png')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                            </a>               
                        <?php endif; ?>                                           
                    </div>

                    <div class="toggle-holder">
                        <div id="toggle" class="">
                            <div class="first-menu-line"></div>
                            <div class="second-menu-line"></div>
                            <div class="third-menu-line"></div>
                        </div>
                    </div>

                    <div class="menu-holder">
                        <?php
                        if (has_nav_menu("custom_menu")) {
                            wp_nav_menu(
                                    array(
                                        "container" => "nav",
                                        "container_class" => "",
                                        "container_id" => "header-main-menu",
                                        "fallback_cb" => false,
                                        "menu_class" => "main-menu sm sm-clean",
                                        "theme_location" => "custom_menu",
                                        "items_wrap" => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        "walker" => new cocobasic_header_menu()
                                    )
                            );
                        } else {
                            echo '<nav id="header-main-menu" class="default-menu"><ul>';
                            wp_list_pages(array("depth" => "3", 'title_li' => ''));
                            echo '</ul></nav>';
                        }
                        ?>                       
                    </div>
                    <div class="clear"></div>   
                </div>
            </header>
