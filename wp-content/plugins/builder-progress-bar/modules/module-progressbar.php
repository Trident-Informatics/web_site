<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Module Name: Progress Bar
 */

class TB_ProgressBar_Module extends Themify_Builder_Component_Module {

    public function __construct() {
        parent::__construct(array(
            'name' => __('Progress Bar', 'builder-progressbar'),
            'slug' => 'progressbar'
        ));
    }

    public function get_assets() {
        $instance = Builder_ProgressBar::get_instance();
        return array(
            'selector' => '.module.module-progressbar .tb-progress-bar',
            'css' => themify_enque($instance->url . 'assets/style.css'),
            'js' => themify_enque($instance->url . 'assets/scripts.js'),
            'ver' => $instance->version
        );
    }

    public function get_options() {
        return array(
            array(
                'id' => 'mod_title_progressbar',
                'type' => 'text',
                'label' => __('Module Title', 'builder-progressbar'),
                'class' => 'large',
                'render_callback' => array(
                    'binding' => 'live',
                    'live-selector'=>'.module-title'
                )
            ),
            array(
                'id' => 'progress_bars',
                'type' => 'builder',
                'options' => array(
                    array(
                        'id' => 'bar_label',
                        'type' => 'text',
                        'label' => __('Label', 'builder-progressbar'),
                        'class' => 'large',
                        'render_callback' => array(
							'binding' => 'live',
							'repeater' => 'progress_bars',
                            'live-selector'=>'.tb-progress-bar-label'
                        )
                    ),
                    array(
                        'id' => 'bar_percentage',
                        'type' => 'text',
                        'label' => __('Percentage', 'builder-progressbar'),
                        'after' => '%',
                        'class' => 'small',
                        'render_callback' => array(
                            'binding' => 'live',
                            'repeater' => 'progress_bars'
						)
					),
					array(
						'id' => 'bar_percentage_from',
						'type' => 'text',
						'label' => __('Percentage From', 'builder-progressbar'),
						'after' => 'integer',
						'class' => 'small',
						'render_callback' => array(
							'binding' => 'live',
							'repeater' => 'progress_bars'
						)
					),
					array(
						'id' => 'bar_percentage_label',
						'type' => 'text',
						'label' => __( 'Custom Percentage Label', 'builder-progressbar' ),
						'binding' => array(
							'empty' => array(
								'hide' => array('bar_percentage_only_label_wrap')
							),
							'not_empty' => array(
								'show' => array('bar_percentage_only_label_wrap')
							)
						),
						'render_callback' => array(
							'binding' => 'live',
							'repeater' => 'progress_bars'
						)
					),
					array(
						'id' => 'bar_percentage_only_label',
						'type' => 'checkbox',
						'label' => '&nbsp;',
						'pushed' => 'pushed',
						'options' => array(
							array( 'name' => 'yes', 'value' => __( 'Exclude percentage number', 'themify' ) )
						),
						'render_callback' => array(
							'binding' => 'live',
							'repeater' => 'progress_bars'
						),
						'wrap_with_class' => 'bar_percentage_only_label_wrap'
					),
                    array(
                        'id' => 'bar_color',
                        'type' => 'text',
                        'colorpicker' => true,
                        'label' => __('Color', 'builder-progressbar'),
                        'class' => 'small',
                        'render_callback' => array(
                            'binding' => 'live',
                            'repeater' => 'progress_bars'
                        )
                    ),
                ),
                'render_callback' => array(
                    'binding' => 'live',
                    'control_type' => 'repeater'
                )
            ),
            array(
                'id' => 'hide_percentage_text',
                'type' => 'select',
                'label' => __('Hide Percentage Text', 'builder-progressbar'),
                'options' => array(
                    'no' => __('No', 'builder-progressbar'),
                    'yes' => __('Yes', 'builder-progressbar'),
                ),
                'render_callback' => array(
                    'binding' => 'live'
                )
            ),
            // Additional CSS
            array(
                'type' => 'separator',
                'meta' => array('html' => '<hr/>')
            ),
            array(
                'id' => 'add_css_progressbar',
                'type' => 'text',
                'label' => __('Additional CSS Class', 'builder-progressbar'),
                'class' => 'large exclude-from-reset-field',
                'help' => sprintf('<br/><small>%s</small>', __('Add additional CSS class(es) for custom styling (<a href="https://themify.me/docs/builder#additional-css-class" target="_blank">learn more</a>).', 'builder-progressbar')),
                'render_callback' => array(
                    'binding' => 'live'
                )
            )
        );
    }

    public function get_default_settings() {
        return array(
            'hide_percentage_text' => 'no',
            'progress_bars' => array(array(
                    'bar_label' => esc_html__('Label', 'builder-progressbar'),
                    'bar_percentage' => 80,
                    'bar_color' => '4a54e6_1'
                ))
        );
    }

    public function get_styling() {
        $font_color_selectors = '.module-progressbar';
        $font_color_id = 'font_color';
        $font_color_label = __('Font Color', 'themify');
        if(method_exists( __CLASS__, 'get_color_type' )){
            $font_color = self::get_color($font_color_selectors, $font_color_id, $font_color_label,'color',true);
        }else{
            $font_color = self::get_color($font_color_selectors, $font_color_id, $font_color_label);
        }
        $general = array(
            //bacground
            self::get_seperator('image_bacground', __('Background', 'themify'), false),
            self::get_color('.module-progressbar', 'background_color', __('Background Color', 'themify'), 'background-color'),
            // Font
            self::get_seperator('font', __('Font', 'themify')),
            self::get_font_family('.module-progressbar'),
			! method_exists( __CLASS__, 'get_element_font_weight' ) ? '' : self::get_element_font_weight( '.module-progressbar' ),
            ! method_exists( __CLASS__, 'get_color_type' ) ? '' : self::get_color_type('font_color_type',__('Font Color Type', 'themify'),'font_color','font_gradient_color'),
            $font_color,
			! method_exists( __CLASS__, 'get_gradient_color' ) ? '' : self::get_gradient_color(array( '.module-progressbar .tb-progress-bar-label','.module-progressbar .tb-progress-tooltip' ),'font_gradient_color',__('Font Color', 'themify')),
            self::get_font_size('.module-progressbar'),
            self::get_line_height('.module-progressbar'),
            self::get_text_align('.module-progressbar'),
            // Padding
            self::get_seperator('padding', __('Padding', 'themify')),
            self::get_padding('.module-progressbar'),
            // Margin
            self::get_seperator('margin', __('Margin', 'themify')),
            self::get_margin('.module-progressbar'),
            // Border
            self::get_seperator('border', __('Border', 'themify')),
            self::get_border('.module-progressbar')
        );
		$bar = array(
			// Background
                        self::get_seperator('image_background',__('Background', 'themify'),false),
                        self::get_color('.module-progressbar .tb-progress-bar','b_c_b',__('Background Color', 'themify'),'background-color'),
			// Font
                        self::get_seperator('font',__('Font', 'themify')),
                        self::get_font_family('.module-progressbar .tb-progress-bar','f_f_b'),
						! method_exists( __CLASS__, 'get_element_font_weight' ) ? '' : self::get_element_font_weight( '.module-progressbar .tb-progress-bar','f_w_b' ),
                        self::get_color('.module-progressbar .tb-progress-bar', 'f_c_b', __('Font Color', 'themify')),
                        self::get_font_size('.module-progressbar .tb-progress-bar','f_s_b'),
                        self::get_line_height('.module-progressbar .tb-progress-bar','l_h_b'),
						self::get_letter_spacing('.module-progressbar .tb-progress-bar', 'l_s_b'),
						self::get_text_transform(array('.module-progressbar .tb-progress-bar', '.module-progressbar .tb-progress-bar .tb-progress-bar-label'), 't_t_b'),
						self::get_font_style(array('.module-progressbar .tb-progress-bar', '.module-progressbar .tb-progress-bar .tb-progress-bar-label'), 'f_sy_b','f_b_b'),
			// Padding
                        self::get_seperator('padding',__('Padding', 'themify')),
                        self::get_padding('.module-progressbar .tb-progress-bar','b_p'),
            // Margin
						self::get_seperator('margin', __('Margin', 'themify')),
						self::get_margin('.module-progressbar .tb-progress-bar','b_m'),
			// Border
                        self::get_seperator('border',__('Border', 'themify')),
                        self::get_border('.module-progressbar .tb-progress-bar','b_b')
		);
		return array(
			array(
				'type' => 'tabs',
				'id' => 'module-styling',
				'tabs' => array(
					'general' => array(
						'label' => __('General', 'builder-progress-bar'),
						'fields' => $general
					),
					'bar' => array(
						'label' => __('Bar', 'builder-progress-bar'),
						'fields' => $bar
					)
				)
			),
		);
    }

    protected function _visual_template() {
        $module_args = self::get_module_args();
        ?>

        <div class="module module-<?php echo $this->slug; ?> {{ data.add_css_progressbar }}">
            <!--insert-->
            <# if( data.mod_title_progressbar ) { #>
        <?php echo $module_args['before_title']; ?>
            {{{ data.mod_title_progressbar }}}
            <?php echo $module_args['after_title']; ?>
            <# } #>

        <?php do_action('themify_builder_before_template_content_render'); ?>

            <div class="tb-progress-bar-wrap">
                <# _.each( data.progress_bars, function( bar, index ) { #>
                <div class="tb-progress-bar">

                    <i class="tb-progress-bar-label">{{{ bar.bar_label }}}</i>
                    <span class="tb-progress-bar-bg" data-percent="{{ bar.bar_percentage }}" style="width: 0; background-color: <# bar.bar_color && print(themifybuilderapp.Utils.toRGBA(bar.bar_color)) #>">

                        <# if( data.hide_percentage_text === 'no' ) { #>
                        <span class="tb-progress-tooltip" id="{{ data.cid }}-{{ index }}-progress-tooltip" data-to="{{ bar.bar_percentage_only_label === 'yes' && bar.bar_percentage_label ? '' : bar.bar_percentage_from ? bar.bar_percentage_from * bar.bar_percentage / 100 : bar.bar_percentage }}" data-suffix="{{ bar.bar_percentage_label ? ' ' + bar.bar_percentage_label : '%' }}" data-decimals="0"></span>
                        <# } #>

                    </span>

                </div><!-- .tb-progress-bar -->
                <# } ); #>
            </div><!-- .tb-progress-bar-wrap -->

        <?php do_action('themify_builder_after_template_content_render'); ?>
        </div>
        <?php
    }

}

Themify_Builder_Model::register_module('TB_ProgressBar_Module');
