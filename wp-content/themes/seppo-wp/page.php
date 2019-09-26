<?php get_header(); ?>

<div id="content" class="site-content">
    <?php
    $allowed_html_array = cocobasic_allowed_html();
    if (have_posts()) :
        while (have_posts()) : the_post();
            $curentPostID = $post->ID;
            $class = '';
            if (get_post_meta($post->ID, "page_padding", true) == 'no'):
                $class .= 'no-padding ';
            endif;
            if (get_post_meta($post->ID, "page_show_title", true) == 'no'):
                $class .= 'no-page-title ';
            endif;
            ?>

            <div <?php post_class('section ' . $class); ?>>                   
                <?php if (get_post_meta($curentPostID, "page_show_title", true) != 'no'): ?>
                    <div class="page-title-holder">
                        <h1 class="entry-title">
                            <?php
                            if (get_post_meta($curentPostID, "page_custom_title", true) != '') {
                                echo do_shortcode(wp_kses(get_post_meta($curentPostID, "page_custom_title", true), $allowed_html_array));
                            } else {
                                echo get_the_title();
                            }
                            ?>
                        </h1>
                    </div>
                <?php endif; ?>
                <div class="section-wrapper block content-1170 center-relative">                                                
                    <div class="content-wrapper">
                        <?php
                        the_content();
                        $defaults = array(
                            'before' => '<p class="wp-link-pages top-50"><span>' . esc_html__('Pages:', 'seppo-wp') . '</span>',
                            'after' => '</p>'
                        );
                        wp_link_pages($defaults);
                        ?>    
                    </div>
                    <div class="clear"></div>
                </div>
            </div> 
            <?php
            comments_template();
        endwhile;
    endif;
    ?>    
</div>

<?php get_footer(); ?>