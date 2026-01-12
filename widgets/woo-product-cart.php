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

class TRAD_WOO_Product_Cart_Button extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_cart_button';
    }

    public function get_title() {
        return __('WOO Product Add to Cart', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-woo-cart trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-woo-pro'];
    }

    protected function register_controls() {

        $this->trad_init_content_wc_notice_controls();
        if ( !class_exists( 'woocommerce' ) ) {
            return;
        }

        $this->start_controls_section(
            'trad_section_add_to_cart_content',
            [
                'label' => __( 'Content', 'turbo-addons-elementor-pro' ),
            ]
        );

		$this->add_control(
			'trad_woo_product_cart_button_text',
			[
				'label'      => esc_html__( 'Button Text', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::TEXT,
				'default'    => esc_html__( 'Add to Cart', 'turbo-addons-elementor-pro' ),
			]
		);

        $this->end_controls_section();

        /*
		* Box Styling Section
		*/
        $this->start_controls_section(
            'trad_woo_product_cart_button_box_style_section',
            [
                'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'trad-woo_product_cart_button_box_alignment',
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
                    '{{WRAPPER}} .trad-woo-product-cart-button form' => 'display: flex; justify-content: {{VALUE}};',
                ],
            ]
        );
		// Layout (Row / Column) Toggle
		$this->add_control(
			'trad_cart_layout_direction',
			[
				'label'   => __( 'Layout Direction', 'turbo-addons-elementor-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'row' => [
						'title' => __( 'Row', 'turbo-addons-elementor-pro' ),
						'icon'  => 'eicon-h-align-left',
					],
					'column' => [
						'title' => __( 'Column', 'turbo-addons-elementor-pro' ),
						'icon'  => 'eicon-v-align-top',
					],
				],
				'default'   => 'row',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-cart-button form' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		// Gap Control
		$this->add_responsive_control(
			'trad_cart_layout_gap',
			[
				'label' => __( 'Gap Between Items', 'turbo-addons-elementor-pro' ),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-cart-button form' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        /**
         * Button Style Section
         */
        $this->start_controls_section(
            'trad_woo_product_cart_button_style',
            [
                'label' => __( 'Button', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'trad_woo_product_cart_button_typography',
                'label'     => __( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-woo-product-cart-button .cart button.button',
            )
        );

        $this->add_responsive_control(
            'trad_woo_product_cart_button_padding',
            [
                'label' => __( 'Padding', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'default'       => [
					'top'       => '12',
					'right'     => '45',
					'bottom'    => '12',
					'left'      => '45',
					'unit'      => 'px',
                    'isLinked'  => false
				],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-cart-button .cart button.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
		  $this->add_control(
            'trad_woo_product_cart_button_color',
            [
                'label'     => __( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'	=> "#fff",
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-cart-button .cart button.button' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'trad_woo_product_cart_button_background_color',
            [
                'label' => __( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::COLOR,
                'default'	=> '#2E3195',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-cart-button .cart button.button' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );
		// --------------------------Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_addtocart_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-product-cart-button .cart button.button',
            ]
        );
        // -------------------------Border Radius
        $this->add_responsive_control(
            'trad_addtocart_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-cart-button .cart button.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

         /**
         * Quantity Style Section
         */
        $this->start_controls_section(
            'trad_woo_product_cart_button_quantity_style',
            [
                'label' => __( 'Quantity Buttons', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Background Color Control
		$this->add_control(
			'trad_woo_product_cart_quantity_button_bg',
			[
				'label' => __( 'Background Color', 'turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eeeeee',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-minus-button, 
					{{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-plus-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Width Control
		$this->add_responsive_control(
			'trad_woo_product_cart_quantity_button_width',
			[
				'label' => __( 'Button Width', 'turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-minus-button, 
					{{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-plus-button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        //typography control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_woo_product_cart_quantity_button_typography',
                'label' => __( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-minus-button, 
                {{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-plus-button',  
            ]
        );
        // color control
        $this->add_responsive_control(
            'trad_woo_product_cart_quantity_button_color',
            [
                'label' => __( 'Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-minus-button, 
                    {{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-plus-button' => 'color: {{VALUE}};',
                ],
            ]
        );
        //padding control
        $this->add_responsive_control(
            'trad_woo_product_cart_quantity_button_padding',
            [
                'label' => __( 'Padding', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-minus-button, 
                    {{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-plus-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //border control
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trad_woo_product_cart_quantity_button_border',
                'selector' => '{{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-minus-button, 
                {{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-plus-button',
            ]
        );
        //border radius control
        $this->add_responsive_control(
            'trad_woo_product_cart_quantity_button_border_radius',
            [
                'label' => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-minus-button, 
                    {{WRAPPER}} .trad-woo-product-cart-button .trad-woo-product-cart-plus-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		

		$this->add_control(
			'trad_woo_product_cart_quantity_input_field_style',
			[
				'label'     => __( 'Input Field', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'trad_woo_product-cart_quantity_input_field_typography',
                'label'     => __( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-woo-product-cart-button form.cart .quantity input',
            )
        );
        //color control
        $this->add_control(
            'trad_woo_product_cart_quantity_input_color',
            [
                'label' => __( 'Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-cart-button form.cart .quantity input' => 'color: {{VALUE}};',
                ],
            ]
        );
        //width control
        $this->add_responsive_control(
            'trad_woo_product_cart_quantity_input_width',
            [
                'label' => __( 'Width', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,   
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],  
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-cart-button form.cart .quantity input' => 'width: {{SIZE}}{{UNIT}};',
                ],  
            ]
        );

		$this->add_responsive_control(
			'trad_woo_product-cart_quantity_input_padding',
			[
				'label' => __( 'Input Padding', 'turbo-addons-elementor-pro' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-cart-button form.cart .quantity input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        //border control
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trad_woo_product_cart_quantity_input_border',
                'selector' => '{{WRAPPER}} .trad-woo-product-cart-button form.cart .quantity input',    
            ]
        );
        //border radius control
        $this->add_responsive_control(
            'trad_woo_product_cart_quantity_input_border_radius',
            [
                'label' => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-cart-button form.cart .quantity input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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

    public function get_script_depends() {
        return ['trad-woo-product-all-script'];
    }

    public function add_to_cart_text() {
        $settings = $this->get_settings_for_display();
        return ! empty( $settings['trad_woo_product_cart_button_text'] )
            ? esc_html( $settings['trad_woo_product_cart_button_text'] )
            : __( 'Add to cart', 'turbo-addons-elementor-pro' );
    }


    protected function render_add_to_cart_button() {

    $settings = $this->get_settings_for_display();

    // Elementor Editor Mode
    if ( Plugin::instance()->editor->is_edit_mode() ) {
        $product = \Turbo_Addons_Pro\WOOHelper::trad_get_first_woo_product();

        if ( ! empty( $product ) ) {
            ob_start();
            add_filter( 'woocommerce_product_single_add_to_cart_text', [ $this, 'add_to_cart_text' ] );
            $GLOBALS['product'] = $product;
            woocommerce_template_single_add_to_cart();
            remove_filter( 'woocommerce_product_single_add_to_cart_text', [ $this, 'add_to_cart_text' ] );
            return ob_get_clean();
        } else {
            return '<div class="trad-woo-product-is-empty">' . esc_html__( 'No product found for preview.', 'turbo-addons-elementor-pro' ) . '</div>';
        }
    }

    // LIVE MODE
			$product = wc_get_product( get_the_ID() );

			// If still not a valid product (e.g., used on homepage or section), fallback to first product
			if ( ! $product || ! $product->is_type( 'simple' ) ) {
				$product = \Turbo_Addons_Pro\WOOHelper::trad_get_first_woo_product();
			}

			if ( empty( $product ) ) {
				echo '<div class="trad-woo-product-is-empty">' . esc_html__( 'No product found to display.', 'turbo-addons-elementor-pro' ) . '</div>';
				return;
			}

			$GLOBALS['product'] = $product;

			add_filter( 'woocommerce_product_single_add_to_cart_text', [ $this, 'add_to_cart_text' ] );
			ob_start();
			woocommerce_template_single_add_to_cart();
			
			$form = ob_get_clean();

			$form = str_replace(
				'single_add_to_cart_button',
				'trad-woo-CARTS-button single_add_to_cart_button elementor-button',
				$form
			);
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<div class="' . esc_attr( $product->get_type() ) . '">' . $form . '</div>';

			remove_filter( 'woocommerce_product_single_add_to_cart_text', [ $this, 'add_to_cart_text' ] );
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

        <div class="trad-woo-product-cart-button">
            <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            <?php echo $this->render_add_to_cart_button(); ?>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Cart_Button());
