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

class TRAD_WOO_Product_Price extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_price';
    }

    public function get_title() {
        return __('WOO Product Price', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-product-price trad-icon';
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
            'trad_woo_product_price_content_section',
            [
                'label' => esc_html__( 'Price Setting', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
            'trad_woo_discount_suffix',
            [
                'label'       => esc_html__('Discount Suffix Text', 'turbo-addons-elementor-pro'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '% OFF',
                'placeholder' => '% OFF',
                'condition'   => [
                    'trad_woo_show_discount_percentage!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'trad_woo_product_hide_regular_price',
            [
                'label'        => esc_html__( 'Hide Regular Price', 'turbo-addons-elementor-pro' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Hide', 'turbo-addons-elementor-pro' ),
                'label_off'    => esc_html__( 'Show', 'turbo-addons-elementor-pro' ),
                'return_value' => 'none',
                'default'      => 'yes',
                'selectors'    => [
                    '{{WRAPPER}} .price del' => 'display: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_woo_show_discount_percentage',
            [
                'label'        => esc_html__('Show Discount Percentage', 'turbo-addons-elementor-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Hide', 'turbo-addons-elementor-pro'),
                'label_off'    => esc_html__('Show', 'turbo-addons-elementor-pro'),
                'return_value' => 'none',
                'default'      => '',
                'selectors'    => [
                    '{{WRAPPER}} .trad-discount-badge' => 'display: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // -----------------------------Box Styling Controls--------------------------------
        //==================================================================================

        //----------------price box
        $this->start_controls_section(
            'trad_woo_product_price_style',
            [
				'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

        $this->add_responsive_control(
            'trad_woo_product_price_alignment',
            [
                'label'         => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'left',
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
                    '{{WRAPPER}} .trad-woo-product-price-box' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_price_box_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-product-price-box'
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_price_box_padding',
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
					'{{WRAPPER}} .trad-woo-product-price-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_price_box_margin',
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
					'{{WRAPPER}} .trad-woo-product-price-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'trad_woo_product_price_box_border_radius',
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
					'{{WRAPPER}} .trad-woo-product-price-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'trad_woo_product_price_box_border',
				'selector' => '{{WRAPPER}} .trad-woo-product-price-box'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_price_box_box_shadow',
				'selector' => '{{WRAPPER}} .trad-woo-product-price-box'
			]
		);

        $this->end_controls_section();



        /*
		* Price Style
		*/
		$this->start_controls_section(
            'trad_woo_product_price_style_section',
            [
                'label' => esc_html__( 'Price', 'turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        // Correct Margin Control
        $this->add_responsive_control(
            'trad_woo_product_price_margin',
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
                    '{{WRAPPER}} .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        // Correct Padding Control
        $this->add_responsive_control(
            'trad_woo_product_price_padding',
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
                    '{{WRAPPER}} .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

		$this->add_control(
			'trad_woo_product_regular_price',
			[
				'label' => __( 'Regular Price', 'turbo-addons-elementor-pro' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [ 'trad_woo_product_hide_regular_price!' => 'none' ]
			]
		);

        $this->add_control(
            'trad_woo_product_regular_price_color',
            [
                'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .price del' => 'color: {{VALUE}};',
                ],
                'condition' => [ 'trad_woo_product_hide_regular_price!' => 'none' ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_regular_price_typography',
                'selector' => '{{WRAPPER}} .price del',
                'condition' => [ 'trad_woo_product_hide_regular_price!' => 'none' ]
            ]
        );

        $this->add_control(
            'trad_woo_product_regular_price_text_decoration',
            [
                'label' => esc_html__( 'Text Decoration', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'turbo-addons-elementor-pro' ),
                    'underline' => esc_html__( 'Underline', 'turbo-addons-elementor-pro' ),
                    'overline' => esc_html__( 'Overline', 'turbo-addons-elementor-pro' ),
                    'line-through' => esc_html__( 'Line Through', 'turbo-addons-elementor-pro' ),
                ],
                'default' => 'line-through',
                'selectors' => [
                    '{{WRAPPER}} .price del' => 'text-decoration: {{VALUE}};',
                ],
                'condition' => [ 'trad_woo_product_hide_regular_price!' => 'none' ]
            ]
        );

        $this->add_control(
			'trad_woo_product_sell_price',
			[
				'label' => __( 'Sell Price', 'turbo-addons-elementor-pro' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        // Correct Color Control
        $this->add_control(
            'trad_woo_product_sell_price_color',
            [
                'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .price ins' => 'color: {{VALUE}};',
                ]
            ]
        );

        // Correct Typography Control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_sell_price_typography',
                'selector' => '{{WRAPPER}} .price ins',
            ]
        );

        $this->add_control(
            'trad_woo_product_sell_price_text_decoration',
            [
                'label' => esc_html__( 'Text Decoration', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'turbo-addons-elementor-pro' ),
                    'underline' => esc_html__( 'Underline', 'turbo-addons-elementor-pro' ),
                    'overline' => esc_html__( 'Overline', 'turbo-addons-elementor-pro' ),
                    'line-through' => esc_html__( 'Line Through', 'turbo-addons-elementor-pro' ),
                ],
                'default' => 'None',
                'selectors' => [
                    '{{WRAPPER}} .price ins' => 'text-decoration: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_section();

        // discount percentage style//

        $this->start_controls_section(
            'trad_woo_product_discount_badge_section',
            [
                'label' => esc_html__( 'Discount Badge', 'turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                        'trad_woo_show_discount_percentage!' => 'none', // show controls when NOT hiding
                    ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'trad_discount_badge_background',
                'label'    => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-discount-badge-style',
            ]
        );

        $this->add_responsive_control(
            'trad_discount_percentage_margin',
            [
                'label' => esc_html__('Margin', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .trad-discount-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'trad_discount_badge_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => 3,
                    'right' => 3,
                    'bottom' => 3,
                    'left' => 3,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-discount-badge-style' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

         $this->add_group_control(
            Group_Control_Typography::get_type(),
                [
                    'name'     => 'trad_discount_percentage_typography',
                    'selector' => '{{WRAPPER}} .trad-discount-badge',
                
                ]
            );

            $this->add_control(
            'trad_discount_percentage_color',
            [
                'label'     => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0044ff',
                'selectors' => [
                    '{{WRAPPER}} .trad-discount-badge' => 'color: {{VALUE}};',
                ],
              
            ]
        );

        $this->add_responsive_control(
            'trad_discount_badge_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => 4,
                    'right' => 4,
                    'bottom' => 4,
                    'left' => 4,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-discount-badge-style' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

    protected function render_product_price() {
        if ( \Elementor\Plugin::instance()->editor->is_edit_mode() || \Elementor\Plugin::instance()->preview->is_preview_mode() ) {
            $price = Turbo_Addons_Pro\WOOHelper::trad_get_the_woo_product_price_first_product_id();
            echo '<p class="price">';
            echo wp_kses_post( $price );
            echo '</p>';
        } else {
            global $product;
            $product = wc_get_product();
            if ( empty( $product ) ) {
                return;
            }
            wc_get_template( 'single-product/price.php' );
        }
    }

    protected function render() {
    if (!class_exists('woocommerce')) return;

    $settings = $this->get_settings_for_display();
    $is_editor = \Elementor\Plugin::instance()->editor->is_edit_mode();

    $product = $is_editor
        ? \Turbo_Addons_Pro\WOOHelper::trad_get_first_woo_product()
        : wc_get_product();

    if (!$product) return;

    $regular_price = floatval($product->get_regular_price());
    $sale_price = floatval($product->get_sale_price());
    $has_discount = $regular_price > $sale_price && $sale_price > 0;
    $discount = $has_discount ? round(($regular_price - $sale_price) / $regular_price * 100) : '';
    $suffix = trim($settings['trad_woo_discount_suffix'] ?? '% OFF');

    ?>
    <div class="trad-woo-product-price-box">
        <?php if ( $has_discount ) : ?>
            <div class="trad-discount-badge">
                <span class="trad-discount-badge-style">
                    <?php echo esc_html( $discount . $suffix ); ?>
                </span>
            </div>
        <?php endif; ?>
        
        <?php $this->render_product_price(); ?>
    </div>
    <?php
}


}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Price());
