<?php get_header(); ?>	
<div id="content" class="site-content">
    <div class="header-content center-relative block search-title">
        <h1 class="entry-title"><?php echo get_search_query(); ?></h1>
    </div>

    <div class="blog-holder block center-relative results-holder">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article <?php post_class('animate relative blog-item-holder center-relative '); ?> >
                    <div class="blog-item-wrapper">                        
                        <div class="entry-holder">
                            <h2 class="entry-title"><a href="<?php the_permalink($post->ID); ?>"><?php the_title(); ?></a></h2>                             
                        </div>
                        <div class="clear"></div>
                    </div>
                </article>  

                <?php
            endwhile;
            echo '<div class="clear"></div>';
            echo '<div class="pagination-holder">';
            the_posts_pagination();
            echo '</div>';
        else:
            echo '<h2>' . esc_html__("No results", 'seppo-wp') . '</h2>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>