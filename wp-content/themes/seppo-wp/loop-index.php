<?php
global $post;
?>
<?php while (have_posts()) : the_post(); ?>    

    <?php
    $hasThumbnail = '';
    if (get_post_meta($post->ID, "post_blog_featured_image", true) !== ''):
        $hasThumbnail = 'has-post-thumbnail';
    endif;
    ?>
    <article <?php post_class('animate relative blog-item-holder center-relative ' . $hasThumbnail); ?> >
        <div class="blog-item-wrapper">
            <?php
            if (has_post_thumbnail($post->ID) || get_post_meta($post->ID, "post_blog_featured_image", true) !== '') :
                echo '<div class="post-thumbnail">';
                if (get_post_meta($post->ID, "post_blog_featured_image", true) !== ''):
                    echo '<a href="' . get_the_permalink($post->ID) . '"><div class="post-thumbnail-image"> <img src="' . esc_url(get_post_meta($post->ID, "post_blog_featured_image", true)) . '" alt="' . get_the_title() . '"></div></a>';
                else:
                    echo '<a href="' . get_the_permalink($post->ID) . '"><div class="post-thumbnail-image">' . get_the_post_thumbnail() . '</div></a>';
                endif;
                echo '</div>';
            endif;
            ?>
            <div class="entry-holder">
                <h2 class="entry-title"><a href="<?php the_permalink($post->ID); ?>"><?php the_title(); ?></a></h2> 
                <div class="entry-info">
                    <div class="entry-info-left">
                        <div class="cat-links">
                            <ul>
                                <?php
                                foreach ((get_the_category()) as $category) {
                                    echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                                }
                                ?>
                            </ul>
                        </div>       
                        <div class="entry-date published"><?php echo get_the_date(); ?></div>                                                              
                    </div>
                    <div class="excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>            
                <a class="item-button" href="<?php the_permalink($post->ID); ?>"><?php echo esc_html__('READ MORE', 'seppo-wp'); ?></a>
            </div>
            <div class="clear"></div>
        </div>
    </article>   

<?php endwhile; ?>