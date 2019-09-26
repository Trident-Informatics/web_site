<?php get_header(); ?>           
<p class="center-text error-text-help-first"><strong><?php echo esc_html__('Oops!', 'seppo-wp'); ?></strong></p>            
<p class="center-text error-text-help-second"><?php echo esc_html__('The page you were looking for could not be found.', 'seppo-wp'); ?></p>
<p class="center-text error-text-404"><img src="<?php echo esc_url(get_template_directory_uri() . '/images/404.png'); ?>" alt="<?php echo esc_attr__('not found', 'seppo-wp'); ?>" /></p>
<div class="center-text error-search-holder"><?php get_search_form(); ?></div>
<p class="center-text error-text-home"><?php echo esc_html__('... or just go back to', 'seppo-wp'); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html__('Home', 'seppo-wp'); ?></a> <?php echo esc_html__('page.', 'seppo-wp'); ?></p>            
<?php get_footer(); ?>