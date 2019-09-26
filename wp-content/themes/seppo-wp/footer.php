<!--Footer-->

<?php
$allowed_html_array = cocobasic_allowed_html();
?>


<footer class="footer">
    <div class="footer-content center-relative">

        <?php if ((get_option('cocobasic_footer_logo') !== '') && get_option('cocobasic_footer_logo') !== false): ?>        
            <div class="footer-logo">
                <img src="<?php echo esc_url(get_option('cocobasic_footer_logo', get_template_directory_uri() . '/images/logo.png')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
            </div>        
        <?php endif; ?>
        <div class="footer-logo-divider"></div>
        <?php if (get_theme_mod('cocobasic_footer_mail') != ''): ?>
            <div class="footer-mail">            
                <?php
                if (get_theme_mod('cocobasic_footer_mail') != ''):
                    echo wp_kses(__(get_theme_mod('cocobasic_footer_mail') ? get_theme_mod('cocobasic_footer_mail') : '<a href="#">hello@yoursite.com</a>', 'seppo-wp'), $allowed_html_array);
                endif;
                ?>               
            </div>
        <?php endif; ?>

        <?php if (is_active_sidebar('footer-sidebar')) : ?>
            <ul id="footer-sidebar">
                <?php dynamic_sidebar('footer-sidebar'); ?>
            </ul>
        <?php endif; ?>  

        <div class="footer-social-divider"></div>

        <?php if (get_theme_mod('cocobasic_footer_social_content') != ''): ?>
            <div class="social-holder">
                <?php
                echo wp_kses(__(get_theme_mod('cocobasic_footer_social_content') ? get_theme_mod('cocobasic_footer_social_content') : '<a href="#"><span class="fa fa-twitter"></span></a><a href="#"><span class="fa fa-facebook"></span></a><a href="#"><span class="fa fa-behance"></span></a><a href="#"><span class="fa fa-dribbble"></span></a>', 'seppo-wp'), $allowed_html_array);
                ?>
            </div>
        <?php endif; ?>

        <?php if (get_theme_mod('cocobasic_footer_copyright_content') != ''): ?>
            <div class="copyright-holder">
                <?php
                echo wp_kses(__(get_theme_mod('cocobasic_footer_copyright_content') ? get_theme_mod('cocobasic_footer_copyright_content') : '2017 Colorius WordPress Theme by CocoBasic.', 'seppo-wp'), $allowed_html_array);
                ?>
            </div>
        <?php endif; ?>
    </div>
</footer>

</div>

<?php wp_footer();
?>
</body>
</html>