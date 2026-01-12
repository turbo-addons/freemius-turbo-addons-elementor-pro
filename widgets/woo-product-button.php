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

class TRAD_WOO_Product_Button extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_button';
    }

    public function get_title() {
        return __('WOO BuyNow Button', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-button trad-icon';
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
            'trad_section_buy_now_content',
            [
                'label' => __( 'Content', 'turbo-addons-elementor-pro' ),
            ]
        );

       $this->add_control(
    'button_text',
    [
        'label' => __( 'Button Text', 'turbo-addons-elementor-pro' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( 'Buy Now', 'turbo-addons-elementor-pro' ),
    ]
    );

    $this->add_control(
        'button_icon',
        [
            'label' => __( 'Icon', 'turbo-addons-elementor-pro' ),
            'type' => Controls_Manager::ICONS,
            'fa4compatibility' => 'icon',
            'default' => [
                'value' => 'fas fa-shopping-basket',
                'library' => 'fa-solid',
            ],
        ]
    );

    $this->add_control(
        'icon_position',
        [
            'label' => __( 'Icon Position', 'turbo-addons-elementor-pro' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'left',
            'options' => [
                'left' => __( 'Left', 'turbo-addons-elementor-pro' ),
                'right' => __( 'Right', 'turbo-addons-elementor-pro' ),
            ],
            'condition' => [
                'button_icon[value]!' => '',
            ],
        ]
    );


        $this->end_controls_section();

        /*
		* Box Styling Section
		*/

        $this->start_controls_section(
            'trad_woo_product_button_style_section',
            [
                'label' => __( 'Button', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
                'trad-woo_product_button_box_alignment',
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
                        '{{WRAPPER}} .trad-woo-product-button-box' => 'display: flex; justify-content: {{VALUE}};',
                    ],
                ]
            );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'trad_woo_product_button_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .trad-woo-product-button',
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_button_padding',
            [
                'label' => __( 'Padding', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_button_margin',
            [
                'label' => __( 'Margin', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trad_woo_product_button_border',
                'selector' => '{{WRAPPER}} .trad-woo-product-button',
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_button_border_radius',
            [
                'label' => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'trad_woo_product_button_shadow',
                'selector' => '{{WRAPPER}} .trad-woo-product-button',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'trad_woo_product_button_text_style_section',
            [
                'label' => __( 'Typography', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'display_type' => 'text',
                ],
            ]
        );

        $this->start_controls_tabs( 'trad_woo_product_button_style_tabs' );

        $this->start_controls_tab(
            'trad_woo_product_button_style_normal',
            [
                'label' => __( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_woo_product_button_typography',
                'selector' => '{{WRAPPER}} .trad-woo-product-button-text',
            ]
        );

        $this->add_control(
            'trad_woo_product_button_text_color',
            [
                'label' => __( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'trad_woo_product_button_style_hover',
            [
                'label' => __( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
            'trad_woo_product_button_hover_color',
            [
                'label' => __( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'trad_woo_product_button_hover_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .trad-woo-product-button:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'trad_woo_product_button_icon_style_section',
            [
                'label' => __( 'Icon', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'display_type' => 'icon',
                ],
            ]
        );
        $this->start_controls_tabs( 'trad_woo_product_button_icon_style_tabs' );

        $this->start_controls_tab(
            'trad_woo_product_button_icon_style_normal',
            [
                'label' => __( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
            'trad_woo_product_button_icon_color',
            [
                'label' => esc_html__('Icon Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-button-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-button-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_woo_product_button_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .trad-woo-product-button-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'trad_woo_product_button_icon_style_hover',
            [
                'label' => __( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );
        $this->add_control(
            'trad_woo_product_button_hover_icon_color',
            [
                'label' => esc_html__('Icon Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-button:hover .trad-woo-product-button-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-button:hover .trad-woo-product-button-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
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

    protected function render_buy_now_button() {
    $settings = $this->get_settings_for_display();

    // Get product based on context
    if ( Plugin::instance()->editor->is_edit_mode() ) {
        $product = \Turbo_Addons_Pro\WOOHelper::trad_get_first_woo_product();
    } else {
        global $product;
        $product = wc_get_product();
    }

    // Fallback or return
    if ( empty( $product ) ) {
        if ( Plugin::instance()->editor->is_edit_mode() ) {
            echo '<div class="trad-woo-product-is-empty">' . esc_html__( 'No product found for preview.', 'turbo-addons-elementor-pro' ) . '</div>';
        }
        return;
    }

    // Buy Now URL
    $product_id = $product->get_id();
    $checkout_url = wc_get_checkout_url();
    $buy_now_url = add_query_arg( 'add-to-cart', $product_id, $checkout_url );

    // Button output
    ?>
    <a href="<?php echo esc_url( $buy_now_url ); ?>" class="trad-woo-product-button elementor-button elementor-size-md elementor-button-link">
        <span class="trad-woo-product-button-content-wrapper">
            <?php
            $icon_html = '';
            $text_html = '<span class="trad-woo-product-button-text">' . esc_html( $settings['button_text'] ) . '</span>';

            if ( ! empty( $settings['button_icon']['value'] ) ) {
                ob_start();
                ?>
                <span class="trad-woo-product-button-icon elementor-icon">
                    <?php Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </span>
                <?php
                $icon_html = ob_get_clean();
            }
            // Render based on position
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo ($settings['icon_position'] === 'right') ? $text_html . $icon_html : $icon_html . $text_html;
            ?>
        </span>
      </a>
     <?php
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

        <div class="trad-woo-product-button-box">
            <?php $this->render_buy_now_button(); ?>
        </div>

        <?php

    }
}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Button());
