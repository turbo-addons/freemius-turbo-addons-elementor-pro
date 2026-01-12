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

class TRAD_WOO_Product_Breadcrumb extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_breadcrumb';
    }

    public function get_title() {
        return __('WOO Product Breadcrumb', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-product-breadcrumbs trad-icon';
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
            'trad_woo_product_breadcrumb_content_section',
            [
                'label' => esc_html__( 'Content', 'turbo-addons-elementor-pro' ),
            ]
        );

		$this->add_control(
			'trad_woo_product_breadcrumb_before',
			[
				'label'       => esc_html__( 'Text Before Breadcrumb', 'turbo-addons-elementor-pro' ),
				'type'        => Controls_Manager::TEXTAREA
			]
        );

        $this->end_controls_section();

        // Box Styling Controls
        $this->start_controls_section(
            'trad_woo_product_breadcrumb_box_style',
            [
				'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

        $this->add_responsive_control(
            'trad_woo_product_breadcrumb_container_alignment',
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
                'selectors'     => [
                    '{{WRAPPER}} .trad-woo-product-breadcrumb-box' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_breadcrumb_container_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-product-breadcrumb-box'
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_breadcrumb_container_padding',
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
					'{{WRAPPER}} .trad-woo-product-breadcrumb-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_breadcrumb_container_margin',
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
					'{{WRAPPER}} .trad-woo-product-breadcrumb-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'trad_woo_product_breadcrumb_container_radius',
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
					'{{WRAPPER}} .trad-woo-product-breadcrumb-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'trad_woo_product_breadcrumb_container_border',
				'selector'  => '{{WRAPPER}} .trad-woo-product-breadcrumb-box'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_breadcrumb_container_box_shadow',
				'selector' => '{{WRAPPER}} .trad-woo-product-breadcrumb-box'
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'trad_woo_product_breadcrumb_style',
            [
				'label' => esc_html__( 'Breadcrumb', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

        $this->add_control(
            'trad_woo_product_breadcrumb_separator_type',
            [
                'label' => __('Separator Type','turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'icon' => __('Icon','turbo-addons-elementor-pro'),
                    'text' => __('Default','turbo-addons-elementor-pro'),
                ],
            ]
        );


        $this->add_control(
            'trad_woo_product_breadcrumb_separator_icon',
            [
                'label' => __('Separator Icon','turbo-addons-elementor-pro'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'trad_woo_product_breadcrumb_separator_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'trad_woo_product_breadcrumb_separator_text',
            [
                'label' => __('Separator Text','turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => '/',
                'condition' => [
                    'trad_woo_product_breadcrumb_separator_type' => 'text',
                ],
            ]
        );


        $this->add_control(
            'trad_woo_product_breadcrumb_icon_size',
            [
                'label' => esc_html__('Icon Size','turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 300,
                    ],
                ],

                'default' => [
                        'size' => 18,
                        'unit' => 'px',
                    ],
                
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-breadcrumb-separator-icon i' => 'font-size: {{SIZE}}{{UNIT}};', // Font Awesome or other font-based icons
                    '{{WRAPPER}} .trad-woo-product-breadcrumb-separator-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};', // SVG icons
                ],
                'condition' => [
                    'trad_woo_product_breadcrumb_separator_type' => 'icon',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_breadcrumb_icon_vertical_alignment',
            [
                'label' => esc_html__('Vertical Align','turbo-addons-elementor-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => __('Top','turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __('Middle','turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __('Bottom','turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'middle',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-breadcrumb-separator-icon svg' => 'vertical-align: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-breadcrumb-separator-icon i'   => 'vertical-align: {{VALUE}};',
                ],
                'condition' => [
                    'trad_woo_product_breadcrumb_separator_type' => 'icon',
                ],
            ]
        );

        $this->start_controls_tabs( 'trad_woo_product_breadcrumb_style_tab' );
        //  Controls tab For Normal
        $this->start_controls_tab(
            'trad_woo_product_breadcrumb_normal_style',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_breadcrumb_normal_typography',
				'label'    => __( 'Normal Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-woo-product-breadcrumb-box .woocommerce-breadcrumb a'
            ]
        );
        $this->add_control(
            'trad_woo_product_breadcrumb_normal_color',
            [
                'label'     => __( 'Normal Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-breadcrumb-box .woocommerce-breadcrumb > a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'trad_woo_product_breadcrumb_active_style',
            [
                'label' => esc_html__( 'Active', 'turbo-addons-elementor-pro' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_breadcrumb_active_typography',
				'label'    => __( 'Active Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-woo-product-breadcrumb-box .woocommerce-breadcrumb'
            ]
        );
        $this->add_control(
            'trad_woo_product_breadcrumb_active_color',
            [
                'label'     => __( 'Active Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2E3195',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-breadcrumb-box .woocommerce-breadcrumb' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'trad_woo_product_breadcrumb_separator_style',
            [
                'label' => esc_html__( 'Separator', 'turbo-addons-elementor-pro' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_breadcrumb_separator_typography',
                'label'    => esc_html__('Separator Typography','turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-product-breadcrumb-separator-text',
                'condition' => [
                    'trad_woo_product_breadcrumb_separator_type' => 'text',
                ],
            ]
        );
        $this->add_control(
            'trad_woo_product_breadcrumb_separator_color',
            [
                'label' => esc_html__('Separator Color','turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2E3195',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-breadcrumb-separator-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-breadcrumb-separator-icon svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-breadcrumb-separator-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
		$this->end_controls_section();

        $this->start_controls_section(
            'trad_woo_product_breadcrum_before_style',
            [
				'label' => esc_html__( 'Before Text', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'trad_woo_product_breadcrumb_before_typography',
				'selector'         => '{{WRAPPER}} .trad-woo-product-breadcrumb-box .trad-woo-breadcrumb-before-title',
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
			'trad_woo_product_breadcrumb_before_color',
			[
				'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2E3195',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-breadcrumb-box .trad-woo-breadcrumb-before-title' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_breadcrumb_before_padding',
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
					'{{WRAPPER}} .trad-woo-product-breadcrumb-box .trad-woo-breadcrumb-before-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_breadcrumb_before_margin',
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
					'{{WRAPPER}} .trad-woo-product-breadcrumb-box .trad-woo-breadcrumb-before-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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

    protected function render() {

        if ( !class_exists( 'woocommerce' ) ) {
            return;
        }

        if ( ! post_type_exists( 'product' ) ) { 
            return;
        }

        $settings = $this->get_settings_for_display();
        
        ?>

        <div class="trad-woo-product-breadcrumb-box">

            <?php if ( ! empty( $settings['trad_woo_product_breadcrumb_before'] ) ) : ?>
				<p class="trad-woo-breadcrumb-before-title" ><?php echo wp_kses_post( $settings['trad_woo_product_breadcrumb_before'] );?></p>
			<?php endif; ?>

            <?php
                $separator = '';

                if ( $settings['trad_woo_product_breadcrumb_separator_type'] === 'icon' && ! empty( $settings['trad_woo_product_breadcrumb_separator_icon']['value'] ) ) {
                    ob_start();
                    echo '<span class="trad-woo-product-breadcrumb-separator-icon">';
                    Icons_Manager::render_icon(
                        $settings['trad_woo_product_breadcrumb_separator_icon'],
                        [ 'aria-hidden' => 'true' ]
                    );
                    echo '</span>';
                    $separator = ob_get_clean();
                } elseif ( $settings['trad_woo_product_breadcrumb_separator_type'] === 'text' && ! empty( $settings['trad_woo_product_breadcrumb_separator_text'] ) ) {
                    $separator = '<span class="trad-woo-product-breadcrumb-separator-text">' . esc_html( $settings['trad_woo_product_breadcrumb_separator_text'] ) . '</span>';
                }

                woocommerce_breadcrumb([
                    'delimiter' => ' ' . $separator . ' ',
                ]);

            ?>
        </div>

        <?php

    }
}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Breadcrumb());
