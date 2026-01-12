<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_WOO_Product_Short_Description extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_short_description';
    }

    public function get_title() {
        return __('WOO Product Short Description', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-product-description trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-woo-pro'];
    }

    protected function register_controls() {

        $this->trad_init_content_wc_notice_controls();
        if ( !class_exists( 'woocommerce' ) ) {
            return;
        }
		
		/**
		 * Content Section
		 */

        $this->start_controls_section(
            'trad_woo_product_short_description_content_section',
            [
                'label' => esc_html__( 'Content', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
			'trad_before_short_description',
			[
				'label'   => esc_html__( 'Text Before Description', 'turbo-addons-elementor-pro' ),
				'type'    => Controls_Manager::TEXTAREA
			]
        );

		$this->add_control(
			'trad_after_short_description',
			[
				'label'   => esc_html__( 'Text After Description', 'turbo-addons-elementor-pro' ),
				'type'    => Controls_Manager::TEXTAREA
			]
        );

		$this->end_controls_section();
		
		$this->start_controls_section(
            'trad_woo_product_short_description_style',
            [
				'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

        $this->add_responsive_control(
            'trad_woo_product_short_description_alignment',
            [
                'label'         => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'center',
                'toggle'        => false,
                'options'       => [
                    'left' => [
                        'title'  => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title'  => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-text-align-center'
                    ],
                    'right'   => [
                        'title'  => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-text-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .trad-woo-product-short-description-box' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_short_description_box_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-product-short-description-box'
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_short_description_box_padding',
			[
				'label'         => __( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'default'       => [
					'top'       => '1',
					'right'     => '0',
					'bottom'    => '1',
					'left'      => '0',
					'unit'      => 'px',
				],
				'selectors'     => [
					'{{WRAPPER}} .trad-woo-product-short-description-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_short_description_box_margin',
			[
				'label'        => __( 'Margin', 'turbo-addons-elementor-pro' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
				],
				'selectors'    => [
					'{{WRAPPER}} .trad-woo-product-short-description-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'trad_woo_product_short_description_box_border_radius',
			[
				'label'      => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-short-description-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'trad_woo_product_short_description_box_border',
				'selector' => '{{WRAPPER}} .trad-woo-product-short-description-box'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_short_description_box_box_shadow',
				'selector' => '{{WRAPPER}} .trad-woo-product-short-description-box'
			]
		);

		$this->end_controls_section();

        /*
		* Description Styling Section
		*/
		$this->start_controls_section(
            'trad_woo_product_short_description_style_section',
            [
                'label' => esc_html__( 'Description', 'turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
			'trad_woo_product_short_description_color',
			[
				'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-short-description-box .woocommerce-product-details__short-description' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_short_description_typography',
                'selector' => '{{WRAPPER}} .trad-woo-product-short-description-box .woocommerce-product-details__short-description'
            ]
        );

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' 		=> 'trad_woo_product_short_description_text_shadow',
				'label' 	=> __( 'Text Shadow', 'turbo-addons-elementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .trad-woo-product-short-description-box .woocommerce-product-details__short-description'
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_short_description_margin',
			[
				'label'      => __( 'Margin', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
                    'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-short-description-box .woocommerce-product-details__short-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_short_description_padding',
			[
				'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
                    'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-short-description-box .woocommerce-product-details__short-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

        /*
		* Before Styling Section
		*/
		$this->start_controls_section(
            'trad_woo_product_short_description_before_style_section',
            [
                'label' => esc_html__( 'Before Description', 'turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'trad_woo_product_short_description_before_typography',
				'selector'         => '{{WRAPPER}} .trad-woo-product-short-description-box .trad-short-description-before',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 14
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ]
			]
		);

		$this->add_control(
			'trad_woo_product_short_description_before_color',
			[
				'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-short-description-box .trad-short-description-before' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_short_description_before_padding',
			[
				'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
                    'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-short-description-box .trad-short-description-before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_short_description_before_margin',
			[
				'label'      => __( 'Margin', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
                    'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-short-description-box .trad-short-description-before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();

        /*
		* After Styling Section
		*/
		$this->start_controls_section(
            'trad_woo_product_short_description_after_style_section',
            [
                'label' => esc_html__( 'After Description', 'turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'trad_woo_product_short_description_after_typography',
				'selector'         => '{{WRAPPER}} .trad-woo-product-short-description-box .trad-short-description-after',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 14
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ]
			]
		);

		$this->add_control(
			'trad_woo_product_short_description_after_color',
			[
				'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-short-description-box .trad-short-description-after' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_short_description_after_padding',
			[
				'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
                    'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-short-description-box .trad-short-description-after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_short_description_after_margin',
			[
				'label'      => __( 'Margin', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
                    'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-short-description-box .trad-short-description-after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();

    }
	    // -----------------------------------woocommerce plugin warning function
    //---------------------------------------------------------------------------------------------
    protected function trad_init_content_wc_notice_controls() {
		if ( ! class_exists( 'woocommerce' ) ) {
			$this->start_controls_section( 'trad_global_warning', [
				'label' => __( 'Warning!', 'turbo-addons-elementor-pro' ),
			] );
			$this->add_responsive_control( 'trad_global_warning_text', [
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( '<strong>WooCommerce</strong> is not installed/activated on your site. Please install and activate <a href="plugin-install.php?s=woocommerce&tab=search&type=term" target="_blank">WooCommerce</a> first.', 'turbo-addons-elementor-pro' ),
				'content_classes' => 'trad-woo-warning',
			] );
			$this->end_controls_section();

			return;
		}
	}

    protected function render_product_short_description() {
        if ( \Elementor\Plugin::instance()->editor->is_edit_mode() || \Elementor\Plugin::instance()->preview->is_preview_mode() ) {
            $short_description = Turbo_Addons_Pro\WOOHelper::trad_get_the_woo_product_short_description_first_product_id();
            echo '<div class="woocommerce-product-details__short-description">';
            echo wp_kses_post( $short_description );
            echo '</div>';
        } else {
            global $product;
            $product = wc_get_product();
            if ( empty( $product ) ) {
                return;
            }
            wc_get_template( 'single-product/short-description.php' );
        }
    }
    
    

    protected function render() {
        if( ! class_exists('woocommerce') ) {
	        return;
        }
		$settings = $this->get_settings_for_display();

		?>
		<div class="trad-woo-product-short-description-box">

            <?php if ( ! empty( $settings['trad_before_short_description'] ) ) : ?>
                <p class="trad-short-description-before" ><?php echo wp_kses_post( $settings['trad_before_short_description'] );?></p>
            <?php endif; ?>

            <?php $this->render_product_short_description(); ?>

            <?php if ( ! empty( $settings['trad_after_short_description'] ) ) : ?>
                <p class="trad-short-description-after" ><?php echo wp_kses_post( $settings['trad_after_short_description'] );?></p>
            <?php endif; ?>	

        </div>
		<?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Short_Description());
