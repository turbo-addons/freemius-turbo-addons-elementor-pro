<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_WOO_Product_Description extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_description';
    }

    public function get_title() {
        return __('WOO Product Description', 'turbo-addons-elementor-pro');
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

        // Content Controls
        $this->start_controls_section(
            'trad_woo_product_description_content_section',
            [
                'label' => esc_html__( 'Content', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
            'trad_before_description',
            [
                'label'   => esc_html__( 'Text Before Description', 'turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::TEXTAREA
            ]
        );

        $this->add_control(
            'trad_after_description',
            [
                'label'   => esc_html__( 'Text After Description', 'turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::TEXTAREA
            ]
        );

        $this->end_controls_section();

        // Box Styling Controls
        $this->start_controls_section(
            'trad_woo_product_description_style',
            [
				'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

        $this->add_responsive_control(
            'trad_woo_product_description_alignment',
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
                    '{{WRAPPER}} .trad-woo-product-description-box' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_description_box_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-product-description-box'
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_description_box_padding',
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
					'{{WRAPPER}} .trad-woo-product-description-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_description_box_margin',
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
					'{{WRAPPER}} .trad-woo-product-description-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'trad_woo_product_description_box_border_radius',
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
					'{{WRAPPER}} .trad-woo-product-description-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'trad_woo_product_description_box_border',
				'selector' => '{{WRAPPER}} .trad-woo-product-description-box'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_description_box_box_shadow',
				'selector' => '{{WRAPPER}} .trad-woo-product-description-box'
			]
		);

        $this->end_controls_section();

        /*
		* Description Styling Section
		*/
		$this->start_controls_section(
            'trad_woo_product_description_style_section',
            [
                'label' => esc_html__( 'Description', 'turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
			'trad_woo_product_description_color',
			[
				'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-description-box .woocommerce-product-details__description' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_description_typography',
                'selector' => '{{WRAPPER}} .trad-woo-product-description-box .woocommerce-product-details__description'
            ]
        );

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' 		=> 'trad_woo_product_description_text_shadow',
				'label' 	=> __( 'Text Shadow', 'turbo-addons-elementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .trad-woo-product-description-box .woocommerce-product-details__description'
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_description_margin',
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
					'{{WRAPPER}} .trad-woo-product-description-box .woocommerce-product-details__description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_description_padding',
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
					'{{WRAPPER}} .trad-woo-product-description-box .woocommerce-product-details__description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

        /*
		* Before Styling Section
		*/
		$this->start_controls_section(
            'trad_woo_product_description_before_style_section',
            [
                'label' => esc_html__( 'Before Description', 'turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'trad_woo_product_description_before_typography',
				'selector'         => '{{WRAPPER}} .trad-woo-product-description-box .trad-woo-description-before',
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
			'trad_woo_product_description_before_color',
			[
				'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-description-box .trad-woo-description-before' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_description_before_padding',
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
					'{{WRAPPER}} .trad-woo-product-description-box .trad-woo-description-before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_description_before_margin',
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
					'{{WRAPPER}} .trad-woo-product-description-box .trad-woo-description-before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();

        /*
		* After Styling Section
		*/
		$this->start_controls_section(
            'trad_woo_product_description_after_style_section',
            [
                'label' => esc_html__( 'After Description', 'turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'trad_woo_product_description_after_typography',
				'selector'         => '{{WRAPPER}} .trad-woo-product-description-box .trad-woo-description-after',
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
			'trad_woo_product_description_after_color',
			[
				'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-description-box .trad-woo-description-after' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_description_after_padding',
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
					'{{WRAPPER}} .trad-woo-product-description-box .trad-woo-description-after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_description_after_margin',
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
					'{{WRAPPER}} .trad-woo-product-description-box .trad-woo-description-after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
    }

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

    protected function render_product_description() {
        if ( \Elementor\Plugin::instance()->editor->is_edit_mode() || \Elementor\Plugin::instance()->preview->is_preview_mode() ) {
            $description = Turbo_Addons_Pro\WOOHelper::trad_get_the_woo_product_description_first_product_id();
            echo '<div class="woocommerce-product-details__description">';
            echo wp_kses_post( $description );
            echo '</div>';
        } else {
            global $product;
            $product = wc_get_product();
            if ( empty( $product ) ) {
                return;
            }
            wc_get_template( 'single-product/tabs/description.php' );
        }
    }

    protected function render() {
        if( ! class_exists('woocommerce') ) {
            return;
        }

        $settings = $this->get_settings_for_display();

        ?>
        <div class="trad-woo-product-description-box">

            <?php if ( ! empty( $settings['trad_before_description'] ) ) : ?>
                <p class="trad-woo-description-before"><?php echo wp_kses_post( $settings['trad_before_description'] ); ?></p>
            <?php endif; ?>

            <?php $this->render_product_description(); ?>

            <?php if ( ! empty( $settings['trad_after_description'] ) ) : ?>
                <p class="trad-woo-description-after"><?php echo wp_kses_post( $settings['trad_after_description'] ); ?></p>
            <?php endif; ?> 

        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Description());
