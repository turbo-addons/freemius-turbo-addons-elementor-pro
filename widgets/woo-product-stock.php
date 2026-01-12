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

class TRAD_WOO_Product_Stock extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_stock';
    }

    public function get_title() {
        return __('WOO Product Stock', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-product-stock trad-icon';
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
            'trad_woo_product_stock_content_section',
            [
                'label' => esc_html__( 'Content', 'turbo-addons-elementor-pro' ),
            ]
        );

		$this->add_control(
			'trad_woo_product_stock_before',
			[
				'label'       => esc_html__( 'Text Before Stock', 'turbo-addons-elementor-pro' ),
				'type'        => Controls_Manager::TEXT
			]
        );

		$this->add_control(
            'trad_woo_product_stock_change_in_stock',
            [
                'label' => esc_html__('Change Default Text', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('In Stock', 'turbo-addons-elementor-pro'),
				'label_block' => true,
				'description' => esc_html__('This text will only appear when the product is in stock.', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->end_controls_section();

        // Box Styling Controls
        $this->start_controls_section(
            'trad_woo_product_stock_box_style',
            [
				'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

        $this->add_responsive_control(
            'trad_woo_product_stock_container_alignment',
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
                    '{{WRAPPER}} .trad-woo-before-stock-title' => 'display: flex; justify-content: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-stock-box' => 'display: flex; justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_stock_container_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-product-stock-box'
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_stock_container_padding',
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
					'{{WRAPPER}} .trad-woo-product-stock-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_stock_container_margin',
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
					'{{WRAPPER}} .trad-woo-product-stock-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'trad_woo_product_stock_container_radius',
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
					'{{WRAPPER}} .trad-woo-product-stock-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'trad_woo_product_stock_container_border',
				'selector'  => '{{WRAPPER}} .trad-woo-product-stock-box'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_stock_container_box_shadow',
				'selector' => '{{WRAPPER}} .trad-woo-product-stock-box'
			]
		);

		$this->end_controls_section();

		/*
		* stock Styling Section
		*/
        $this->start_controls_section(
            'trad_woo_product_stock_style_section',
            [
                'label' => esc_html__( 'Stock', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 	   => 'trad_woo_product_stock_style_typography',
				'selector' => '{{WRAPPER}} .trad-woo-product-stock-box .stock',
			]
		);

		$this->add_control(
			'trad_woo_product_stock_style_text_color',
			[
				'label' 	=> __( 'Color', 'turbo-addons-elementor-pro' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-stock-box .stock' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
            'trad_woo_product_stock_style_background_color',
            [
                'label'     => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-stock-box .stock' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
			'trad_woo_product_stock_style_padding',
			[
				'label'         => __( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'default'       => [
					'top'       => '0',
					'right'     => '0',
					'bottom'    => '0',
					'left'      => '0',
					'unit'      => 'px',
                    'isLinked'  => false
				],
				'selectors'     => [
					'{{WRAPPER}} .trad-woo-product-stock-box .stock' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_stock_style_radius',
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
					'{{WRAPPER}} .trad-woo-product-stock-box .stock' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'trad_woo_product_stock_style_border',
				'selector' => '{{WRAPPER}} .trad-woo-product-stock-box .stock',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_stock_style_shadow',
				'selector' => '{{WRAPPER}} .trad-woo-product-stock-box .stock'
			]
		);


        $this->end_controls_section();


        $this->start_controls_section(
            'trad_woo_product_stock_title_style',
            [
				'label' => esc_html__( 'Before Text', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'trad_woo_product_stock_title_typography',
				'selector'         => '{{WRAPPER}} .trad-woo-before-stock-title',
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
			'trad_woo_product_stock_title_color',
			[
				'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2E3195',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-before-stock-title' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_stock_title_padding',
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
					'{{WRAPPER}} .trad-woo-before-stock-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_stock_title_margin',
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
					'{{WRAPPER}} .trad-woo-before-stock-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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

	protected function render_product_stock() {
		 $settings = $this->get_settings_for_display();
		 $inStockStatusChange = !empty($settings['trad_woo_product_stock_change_in_stock']) ? $settings['trad_woo_product_stock_change_in_stock'] : 'In Stock' ;
		if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
			$product = Turbo_Addons_Pro\WOOHelper::trad_get_first_woo_product();

			if ( ! empty( $product ) ) {
				$stock_status = $product->get_stock_status();
				echo '<div class="product">';
				if ( $stock_status === 'instock' ) {
					echo '<p class="stock in-stock">' . esc_html( $inStockStatusChange , 'turbo-addons-elementor-pro' ) . '</p>';
				} else {
					$availability = $product->get_availability();
					echo '<p class="stock ' . esc_attr( $availability['class'] ) . '">';
						echo wp_kses_post( $availability['availability'] );
					echo '</p>';
				}
				echo '</div>';
			} else {
				echo '<div class="trad-woo-product-is-empty">' . esc_html__( 'No Stock Available', 'turbo-addons-elementor-pro' ) . '</div>';
			}
		} else {

			global $product;
            $product = wc_get_product();
            if ( empty( $product ) ) {
					return;
			}
			$stock_status = $product->get_stock_status(); 
			if ( $stock_status === 'instock' ) {
				echo '<p class="stock in-stock">' . esc_html( $inStockStatusChange , 'turbo-addons-elementor-pro' ) . '</p>';
			} else {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo wc_get_stock_html($product);
			}
			
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
		<?php if ( ! empty( $settings['trad_woo_product_stock_before'] ) ) : ?>
            <p class="trad-woo-before-stock-title"><?php echo wp_kses_post( $settings['trad_woo_product_stock_before'] ); ?></p>
        <?php endif; ?>
        <div class="trad-woo-product-stock-box">
            <?php $this->render_product_stock(); ?>
        </div>

        <?php

    }
}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Stock());
