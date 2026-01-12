<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_WOO_Product_Rating extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_rating';
    }

    public function get_title() {
        return __('WOO Product Rating', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-product-rating trad-icon';
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
            'trad_woo_product_rating_content_section',
            [
                'label' => esc_html__( 'Content', 'turbo-addons-elementor-pro' ),
            ]
        );

		$this->add_control(
			'trad_woo_product_rating_before',
			[
				'label'       => esc_html__( 'Text Before Rating', 'turbo-addons-elementor-pro' ),
				'type'        => Controls_Manager::TEXTAREA
			]
        );

        $this->end_controls_section();

        // Box Styling Controls
        $this->start_controls_section(
            'trad_woo_product_rating_box_style',
            [
				'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

        $this->add_responsive_control(
            'trad_woo_product_rating_container_alignment',
            [
                'label'   => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'flex-start',
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-rating-before-title' => 'display: flex; justify-content: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-rating-box' => 'display: flex; justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_rating_container_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-product-rating-box'
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_rating_container_padding',
			[
				'label'         => __( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'default'       => [
					'top'       => '10',
					'right'     => '0',
					'bottom'    => '10',
					'left'      => '0',
					'unit'      => 'px',
                    'isLinked'  => false
				],
				'selectors'     => [
					'{{WRAPPER}} .trad-woo-product-rating-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_rating_container_margin',
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
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .trad-woo-product-rating-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'trad_woo_product_rating_container_radius',
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
					'{{WRAPPER}} .trad-woo-product-rating-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'trad_woo_product_rating_container_border',
				'selector'  => '{{WRAPPER}} .trad-woo-product-rating-box'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_rating_container_box_shadow',
				'selector' => '{{WRAPPER}} .trad-woo-product-rating-box'
			]
		);

		$this->end_controls_section();

        /**
		 * Product Rating Style Section
		 */
		$this->start_controls_section(
			'trad_woo_product_rating_style',
			[
				'label'     => esc_html__( 'Rating', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_rating_size',
			[
				'label'       => __( 'Icon Size', 'turbo-addons-elementor-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 50
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 20
				],
				'selectors'   => [
					'{{WRAPPER}} .star-rating' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_rating_icon_margin',
			[
				'label'      => __( 'Icon Margin', 'turbo-addons-elementor-pro' ),
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
					'{{WRAPPER}} .star-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
        $this->start_controls_tabs( 'trad_woo_product_rating_style_tab' );
        //  Controls tab For Normal
        $this->start_controls_tab(
            'trad_woo_product_rating_normal_style',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );
		$this->add_control(
			'trad_woo_product_rating_normal_color',
			[
				'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2E3195',
				'selectors' => [
                    '{{WRAPPER}} .star-rating::before' => 'color: {{VALUE}} !important;',
				]
			]
		);
        $this->end_controls_tab();
        $this->start_controls_tab(
            'trad_woo_product_rating_active_style',
            [
                'label' => esc_html__( 'Active', 'turbo-addons-elementor-pro' ),
            ]
        );
		$this->add_control(
			'trad_woo_product_rating_active_color',
			[
				'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2E3195',
				'selectors' => [
					'{{WRAPPER}} .star-rating' => 'color: {{VALUE}};'
				]
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'trad_woo_section_rating_review_link_style',
			[
				'label' => __( 'Review', 'turbo-addons-elementor-pro' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'trad_woo_product_hide_review_rating',
            [
                'label'        => esc_html__( 'Hide Review', 'turbo-addons-elementor-pro' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Hide', 'turbo-addons-elementor-pro' ),
                'label_off'    => esc_html__( 'Show', 'turbo-addons-elementor-pro' ),
                'return_value' => 'none',
                'default'      => '',
                'selectors'    => [
                    '{{WRAPPER}} .woocommerce-review-link' => 'display: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
			'trad_woo_product_rating_review_color',
			[
				'label' => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type' 	=> Controls_Manager::COLOR,
				'default' => '#2E3195',
				'selectors' => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-rating-box .woocommerce-product-rating .woocommerce-review-link' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_rating_review_typography',
                'selector' => '.woocommerce {{WRAPPER}} .trad-woo-product-rating-box .woocommerce-product-rating .woocommerce-review-link'
            ]
        );

		$this-> end_controls_section();

        $this->start_controls_section(
            'trad_woo_product_ratingbefore_style',
            [
				'label' => esc_html__( 'Before Text', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'trad_woo_product_rating_before_typography',
				'selector'         => '{{WRAPPER}} .trad-woo-rating-before-title',
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
			'trad_woo_product_rating_before_color',
			[
				'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2E3195',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-rating-before-title' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_rating_before_padding',
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
					'{{WRAPPER}} .trad-woo-rating-before-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_rating_before_margin',
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
					'{{WRAPPER}} .trad-woo-rating-before-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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

    protected function render_product_rating() {

        if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {

            $product = Turbo_Addons_Pro\WOOHelper::trad_get_first_woo_product();

            if(!empty($product)) {
                $rating_count = $product->get_rating_count();
                $review_count = $product->get_review_count();
                $average      = $product->get_average_rating();
                if ( $rating_count > 0 ) { ?>
                    <div class="product">
                        <div class="woocommerce-product-rating">
                            <?php 
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo wc_get_rating_html( $average, $rating_count );
							 ?>
                            <?php if ( comments_open() ) : ?>
                                <a href="#reviews" class="woocommerce-review-link" rel="nofollow">(
									<?php
									printf(
										esc_html(
											// translators: %1$s: Number of customer reviews
											_n(
												'%1$s customer review',
												'%1$s customer reviews',
												$review_count,
												'turbo-addons-elementor-pro'
											)
										),
										'<span class="count">' . esc_html( $review_count ) . '</span>'
									);
									?>
									)
								</a>
                            <?php endif ?>
                        </div>
                    </div>
                <?php }
            } else {
                echo '<div class="trad-woo-product-is-empty">' . esc_html__( 'No Rating Available', 'turbo-addons-elementor-pro' ) . '</div>';
            }

        } else {
			global $product;
            $product = wc_get_product();
            if ( empty( $product ) ) {
					return;
			}

			wc_get_template( 'single-product/rating.php' );
        }
    }

    protected function render() {

        if ( !class_exists( 'woocommerce' ) ) {
            return;
        }

		if ( ! post_type_supports( 'product', 'comments' ) ) {
			return;
		}

        $settings = $this->get_settings_for_display();
        
        ?>
        <?php if ( ! empty( $settings['trad_woo_product_rating_before'] ) ) : ?>
                <p class="trad-woo-rating-before-title"><?php echo wp_kses_post( $settings['trad_woo_product_rating_before'] ); ?></p>
        <?php endif; ?>
        <div class="trad-woo-product-rating-box">
            <?php $this->render_product_rating(); ?>
        </div>

        <?php

    }
}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Rating());
