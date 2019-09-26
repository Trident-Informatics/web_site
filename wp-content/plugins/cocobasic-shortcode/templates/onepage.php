<?php
/*
  Template Name: OnePage
 */
?>

<?php get_header(); ?>
<div id="content" class="site-content center-relative">        
    <?php
    $args = array('post_type' => 'page', 'posts_per_page' => '-1', 'orderby' => 'menu_order', 'order' => 'ASC', 'meta_query' => array(array('key' => 'page_structure', 'value' => '2', 'compare' => '=')));
    $loop = new WP_Query($args);
    $totalPages = $loop->post_count;
    $allowed_html_array = cocobasic_allowed_plugin_html();
    $numCounter = 0;
    if ($loop->have_posts()) :
        while ($loop->have_posts()) : $loop->the_post();
            $slug = $post->post_name;
            $curentPostID = $post->ID;
            $numCounter++;

            if (get_post_meta($post->ID, "page_title_position", true) == 'right'):
                $title_position = 'float-right';
                $content_position = 'float-left';
            else:
                $title_position = 'float-left';
                $content_position = 'float-right';
            endif;


            $class = '';
            if (get_post_meta($post->ID, "page_padding", true) == 'no'):
                $class .= 'no-padding ';
            endif;
            if (get_post_meta($post->ID, "page_show_title", true) == 'no'):
                $class .= 'no-page-title ';
            endif;
            ?>
            <div id="<?php echo $slug; ?>" <?php post_class('section ' . $class); ?>>                   
                <?php if (get_post_meta($curentPostID, "page_show_title", true) != 'no'): ?>
                    <div class="page-title-holder">
                        <h2 class="entry-title">
                            <?php
                            if (get_post_meta($curentPostID, "page_custom_title", true) != '') {
                                echo do_shortcode(wp_kses(get_post_meta($curentPostID, "page_custom_title", true), $allowed_html_array));
                            } else {
                                echo get_the_title();
                            }
                            ?>
                        </h2>
                    </div>
                <?php endif; ?>
                <div class="section-wrapper block content-1170 center-relative">                                                
                    <div class="content-wrapper">
                        <?php
                        the_content();
                        $defaults = array(
                            'before' => '<p class="wp-link-pages top-50"><span>' . esc_html__('Pages:', 'cardea-wp') . '</span>',
                            'after' => '</p>'
                        );
                        wp_link_pages($defaults);
                        ?>    
                    </div>
                    <div class="clear"></div>
                </div>
            </div> 
            <?php
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>
<?php get_footer(); ?>