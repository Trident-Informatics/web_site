<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
/**
 * Template Progress Bar
 * 
 * Access original fields: $mod_settings
 */
if (TFCache::start_cache($mod_name, self::$post_id, array('ID' => $module_ID))):
    $fields_default = array(
        'mod_title_progressbar' => '',
        'progress_bars' => array(),
        'hide_percentage_text' => 'no',
        'add_css_progressbar' => '',
        'animation_effect' => '',
    );
    $bar_default = array(
        'bar_label' => '',
		'bar_percentage' => 80,
		'bar_percentage_from' => '',
		'bar_percentage_only_label' => '',
		'bar_percentage_label' => '',
        'bar_color' => '#4a54e6'
    );

    $fields_args = wp_parse_args($mod_settings, $fields_default);
    unset($mod_settings);
    $animation_effect = self::parse_animation_effect($fields_args['animation_effect'], $fields_args);

    $container_class = implode(' ', apply_filters('themify_builder_module_classes', array(
        'module', 'module-' . $mod_name, $module_ID, $fields_args['add_css_progressbar'], $animation_effect
                    ), $mod_name, $module_ID, $fields_args)
	);

    $container_props = apply_filters('themify_builder_module_container_props', array(
        'id' => $module_ID,
        'class' => $container_class
            ), $fields_args, $mod_name, $module_ID);
    ?>
    <!-- module progress bar -->
    <div <?php echo self::get_element_attributes($container_props); ?>>
        <!--insert-->
        <?php if ($fields_args['mod_title_progressbar'] !== ''): ?>
            <?php echo $fields_args['before_title'] . apply_filters('themify_builder_module_title', $fields_args['mod_title_progressbar'], $fields_args) . $fields_args['after_title']; ?>
        <?php endif; ?>

        <?php do_action('themify_builder_before_template_content_render'); ?>
        <?php if (!empty($fields_args['progress_bars'])): ?>
            <div class="tb-progress-bar-wrap">
                <?php foreach ($fields_args['progress_bars'] as $key => $bar) : ?>
					<?php 
						$bar = wp_parse_args($bar, $bar_default);
						$label_amount = ! empty( $bar[ 'bar_percentage_from' ] )
							? $bar[ 'bar_percentage_from' ] * $bar['bar_percentage'] / 100
							: $bar['bar_percentage'];

						if( ! empty( $bar['bar_percentage_label'] ) && ! empty( $bar[ 'bar_percentage_only_label' ] ) ) {
							$label_amount = '';
						}
					?>
                    <div class="tb-progress-bar">
                        <i class="tb-progress-bar-label"><?php echo $bar['bar_label']; ?></i>
                        <span class="tb-progress-bar-bg" data-percent="<?php echo $bar['bar_percentage'] ?>" style="width: 0; background-color: <?php echo Themify_Builder_Stylesheet::get_rgba_color($bar['bar_color']); ?>">
                            <?php if ('no' === $fields_args['hide_percentage_text']) : ?>
                                <span class="tb-progress-tooltip" id="<?php echo $module_ID . $key; ?>-progress-tooltip" data-to="<?php echo $label_amount; ?>" data-suffix="<?php echo ! empty( $bar[ 'bar_percentage_label' ] ) ? ' ' . $bar[ 'bar_percentage_label' ] : '%'; ?>" data-decimals="0"></span>
                            <?php endif; ?>
                        </span>
                    </div><!-- .tb-progress-bar -->
                <?php endforeach; ?>
            </div><!-- .tb-progress-bar-wrap -->
        <?php endif; ?>
        <?php do_action('themify_builder_after_template_content_render'); ?>
    </div>
    <!-- /module progress bar -->
<?php endif; ?>
<?php TFCache::end_cache(); ?>