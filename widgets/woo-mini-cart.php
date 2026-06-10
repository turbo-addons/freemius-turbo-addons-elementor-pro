<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use TurboAddons\Elementor\Woo_Mini_cart_helper;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_WOO_Mini_Cart extends Widget_Base {

    public function get_name() {
        return 'trad_woo_mini-cart';
    }

    public function get_title() {
        return __('WOO Mini Cart', 'freemius-turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-product-categories trad-icon';
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
            'trad_woo_mini_cart_content_section',
            [
                'label' => esc_html__( 'Content', 'freemius-turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
			'trad_woo_mini_cart_icon',
			[
				'label' => __( 'Icon', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-cart-arrow-down',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_show_price',
			[
				'label' => __( 'Show Price Count', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'freemius-turbo-addons-elementor-pro' ),
				'label_off' => __( 'Hide', 'freemius-turbo-addons-elementor-pro' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_visibility',
			[
				'label' => __( 'Cart Bag Visibility', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fly-out',
				'options' => [
					'hover'  => __( 'Hover', 'freemius-turbo-addons-elementor-pro' ),
					'click'  => __( 'Click', 'freemius-turbo-addons-elementor-pro' ),
					'fly-out'  => __( 'Fly Out', 'freemius-turbo-addons-elementor-pro' ),
				],
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_bag_title',
			[
				'label' => __( 'Cart Bag Heading', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Items Seleceted', 'freemius-turbo-addons-elementor-pro' ),
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_visibility_animation',
			[
				'label' => __( 'Cart Bag Visibility Animation', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide-down',
				'options' => [
					'slide-up'  => __( 'Slide Down', 'freemius-turbo-addons-elementor-pro' ),
					'slide-down'  => __( 'Slide Up', 'freemius-turbo-addons-elementor-pro' ),
					'zoom-down'  => __( 'Zoom Down', 'freemius-turbo-addons-elementor-pro' ),
				],
				'condition' => [
					'trad_woo_mini_cart_visibility!' => 'fly-out'
				]
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_fly_out_appere_position',
			[
				'label' => __( 'Fly Out Appear Position', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'fly-out-appear-position-left' => [
						'title' => __( 'Left', 'freemius-turbo-addons-elementor-pro' ),
						'icon' => 'eicon-arrow-left',
					],
					'fly-out-appear-position-right' => [
						'title' => __( 'Right', 'freemius-turbo-addons-elementor-pro' ),
						'icon' => 'eicon-arrow-right',
					],
				],
				'default' => 'fly-out-appear-position-right',
				'toggle' => true,
				'condition' => [
					'trad_woo_mini_cart_visibility' => 'fly-out'
				]
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_color',
			[
				'label'     => esc_html__( 'Overlay Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0,0,0,.5)',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart-wrapper .trad-woo-cart-bag-fly-out-overlay' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'trad_woo_mini_cart_visibility' => 'fly-out'
				]
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_view_button_alignment',
			[
				'label' => __( 'Button Allignment', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'button-inline',
				'options' => [
					'button-inline'  => __( 'Inline', 'freemius-turbo-addons-elementor-pro' ),
					'button-full-width'  => __( 'Full Width', 'freemius-turbo-addons-elementor-pro' ),
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Cart Icon Style
		 */
		
		$this->start_controls_section(
            'trad_woo_mini_cart_icon_style',
            [
				'label' => esc_html__( 'Cart Icon', 'freemius-turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_control(
			'trad_woo_mini_cart_icon_alignment',
			[
				'label' => __( 'Icon Alignment', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'cart-icon-left' => [
						'title' => __( 'Left', 'freemius-turbo-addons-elementor-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'cart-icon-center' => [
						'title' => __( 'Center', 'freemius-turbo-addons-elementor-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'cart-icon-right' => [
						'title' => __( 'Right', 'freemius-turbo-addons-elementor-pro' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'cart-icon-left',
				'toggle' => true,
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_icon_box',
			[
				'label' => __( 'Enable Icon Box', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'freemius-turbo-addons-elementor-pro' ),
				'label_off' => __( 'Hide', 'freemius-turbo-addons-elementor-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_icon_box_width',
			[
				'label' => __( 'Width', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'trad_woo_mini_cart_icon_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_icon_box_height',
			[
				'label' => __( 'Height', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'trad_woo_mini_cart_icon_box' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_icon_padding',
			[
				'label' => __( 'Padding', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
					'unit' => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'trad_woo_mini_cart_icon_box!' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'trad_woo_mini_cart_icon_background',
				'label' => __( 'Background', 'freemius-turbo-addons-elementor-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon',
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_icon_color',
			[
				'label' => __( 'Icon Color', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#0e0c0cff',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_icon_size',
			[
				'label' => __( 'Icon Size', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'trad_woo_mini_cart_icon_border',
				'label' => __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_icon_border_radius',
			[
				'label' => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'unit' => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'trad_woo_mini_cart_icon_box_shadow',
				'label' => __( 'Box Shadow', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon',
			]
		);
		
		$this->end_controls_section();

		/**
		 * Cart Count Number Style
		 */

		$this->start_controls_section(
            'trad_woo_mini_cart_count_number_style',
            [
				'label' => esc_html__( 'Cart Count Item Number', 'freemius-turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_control(
			'trad_woo_mini_cart_count_number_box_enable',
			[
				'label' => __( 'Enable Number Box', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'freemius-turbo-addons-elementor-pro' ),
				'label_off' => __( 'Hide', 'freemius-turbo-addons-elementor-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_count_number_box_width',
			[
				'label' => __( 'Width', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon .trad-cart-items-count-number' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'trad_woo_mini_cart_count_number_box_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_count_number_box_height',
			[
				'label' => __( 'Height', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon .trad-cart-items-count-number' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'trad_woo_mini_cart_count_number_box_enable' => 'yes'
				]
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_count_number_position',
			[
				'label' => __( 'Number Position', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'freemius-turbo-addons-elementor-pro' ),
				'label_on' => __( 'Custom', 'freemius-turbo-addons-elementor-pro' ),
				'return_value' => 'yes',
                'default' => 'yes',
			]
		);

		$this->start_popover();

            $this->add_responsive_control(
                'trad_woo_mini_cart_count_number_position_left',
                [
                    'label' => __( 'X Offset', 'freemius-turbo-addons-elementor-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => -300,
                            'max' => 300,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 34,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon .trad-cart-items-count-number' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'trad_woo_mini_cart_count_number_position_top',
                [
                    'label' => __( 'Y Offset', 'freemius-turbo-addons-elementor-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => -300,
                            'max' => 300,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon .trad-cart-items-count-number' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_popover();

		$this->add_responsive_control(
			'trad_woo_mini_cart_count_number_padding',
			[
				'label' => __( 'Padding', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '2',
					'right' => '2',
					'bottom' => '2',
					'left' => '2',
					'unit' => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon .trad-cart-items-count-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'trad_woo_mini_cart_count_number_box_enable!' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'trad_woo_mini_cart_count_number_background',
				'label' => __( 'Background', 'freemius-turbo-addons-elementor-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#6e6e6eff'
					]
				],
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon .trad-cart-items-count-number',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'trad_woo_mini_cart_count_number_typography',
				'label' => __( 'Typography', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon .trad-cart-items-count-number',
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_count_number_color',
			[
				'label' => __( 'Number Color', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon .trad-cart-items-count-number' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'trad_woo_mini_cart_count_number_border',
				'label' => __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon .trad-cart-items-count-number',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_count_number_border_radius',
			[
				'label' => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'unit' => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon .trad-cart-items-count-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'trad_woo_mini_cart_count_number_box_shadow',
				'label' => __( 'Box Shadow', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-icon .trad-cart-items-count-number',
			]
		);

		$this->end_controls_section();

		/**
		 * Cart Price Style
		 */

		$this->start_controls_section(
            'trad_woo_mini_cart_count_price_style',
            [
				'label' => esc_html__( 'Cart Total Price', 'freemius-turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'trad_woo_mini_cart_count_price_typography',
				'label' => __( 'Typography', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-cart-items-count-price',
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_count_price_color',
			[
				'label' => __( 'Price Color', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-cart-items-count-price' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_count_price_left_spacing',
			[
				'label' => __( 'Left Spacing', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-cart-items-count-price' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Cart Bag Style
		 */

		$this->start_controls_section(
            'trad_woo_mini_cart_bag_style',
            [
				'label' => esc_html__( 'Cart Bag', 'freemius-turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_bag_width',
			[
				'label' => __( 'Width', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 350,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .trad-woo-mini-cart.fly-out.fly-out-appear-position-left .trad-woo-mini-cart-wrapper .trad-woo-cart-bag' => 'width: {{SIZE}}{{UNIT}}; left: calc( 0px - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .trad-woo-mini-cart.fly-out.fly-out-appear-position-right .trad-woo-mini-cart-wrapper .trad-woo-cart-bag' => 'width: {{SIZE}}{{UNIT}}; right: calc( 0px - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .trad-woo-mini-cart.fly-out.fly-out-appear-position-left .trad-woo-mini-cart-wrapper .trad-woo-cart-bag.fly-out-active' => 'left: calc( {{SIZE}}{{UNIT}} - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .trad-woo-mini-cart.fly-out.fly-out-appear-position-right .trad-woo-mini-cart-wrapper .trad-woo-cart-bag.fly-out-active' => 'right: calc( {{SIZE}}{{UNIT}} - {{SIZE}}{{UNIT}} );',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'trad_woo_mini_cart_bag_background',
				'label' => __( 'Background', 'freemius-turbo-addons-elementor-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#E5E6FF',
					]
				],
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_bag_padding',
			[
				'label' => __( 'Padding', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '12',
					'right' => '12',
					'bottom' => '12',
					'left' => '12',
					'unit' => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'trad_woo_mini_cart_bag_border',
				'label' => __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_bag_border_radius',
			[
				'label' => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'trad_woo_mini_cart_bag_box_shadow',
				'label' => __( 'Box Shadow', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag',
			]
		);

		$this->end_controls_section();

		/**
		 * Cart Heading Style
		 */

		$this->start_controls_section(
            'trad_woo_mini_cart_heading_style',
            [
				'label' => esc_html__( 'Cart Heading', 'freemius-turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_control(
			'trad_woo_mini_cart_heading_alignment',
			[
				'label' => __( 'Alignment', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'freemius-turbo-addons-elementor-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'freemius-turbo-addons-elementor-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'freemius-turbo-addons-elementor-pro' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag .trad-cart-items-heading' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_heading_margin',
			[
				'label' => __( 'Margin', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag .trad-cart-items-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_heading_padding',
			[
				'label' => __( 'Padding', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
					'unit' => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag .trad-cart-items-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'trad_woo_mini_cart_heading_background',
				'label' => __( 'Background', 'freemius-turbo-addons-elementor-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag .trad-cart-items-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'trad_woo_mini_cart_heading_typography',
				'label' => __( 'Typography', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag .trad-cart-items-heading',
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_heading_color',
			[
				'label'     => esc_html__( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag .trad-cart-items-heading' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'trad_woo_mini_cart_heading_border',
				'label' => __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
				'fields_options'  => [
                    'border' 	  => [
                        'default' => 'solid'
                    ],
                    'width'  	  => [
                        'default' 	 => [
                            'top'    => '0',
                            'right'  => '0',
                            'bottom' => '1',
                            'left'   => '0'
                        ]
                    ],
                    'color' 	  => [
                        'default' => 'rgba(255,255,255,.5)'
                    ]
                ],
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag .trad-cart-items-heading',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_heading_border_radius',
			[
				'label' => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag .trad-cart-items-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'trad_woo_mini_cart_heading_box_shadow',
				'label' => __( 'Box Shadow', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-mini-cart-wrapper .trad-woo-cart-bag .trad-cart-items-heading',
			]
		);

		$this->end_controls_section();

		/**
		 * Cart Item Style
		 */

		$this->start_controls_section(
            'trad_woo_mini_cart_bag_item_style',
            [
				'label' => esc_html__( 'Cart Item', 'freemius-turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_bag_item_padding',
			[
				'label' => __( 'Padding', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'trad_woo_mini_cart_bag_item_border',
				'label' => __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
				'fields_options'  => [
                    'border' 	  => [
                        'default' => 'solid'
                    ],
                    'width'  	  => [
                        'default' 	 => [
                            'top'    => '0',
                            'right'  => '0',
                            'bottom' => '1',
                            'left'   => '0'
                        ]
                    ],
                    'color' 	  => [
                        'default' => 'rgba(255,255,255,.5)'
                    ]
                ],
				'selector' => '{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item',
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_bag_item_image_heading',
			[
				'label' => __( 'Image', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_bag_item_image_size',
			[
				'label' => __( 'Image Size', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 300,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item a img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'trad_woo_mini_cart_bag_item_image_border',
				'label' => __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item a img',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_bag_item_image_border_radius',
			[
				'label' => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_bag_item_image_right_spacing',
			[
				'label' => __( 'Image Right Spacing', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item a img' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'trad_woo_mini_cart_bag_item_image_box_shadow',
				'label' => __( 'Box Shadow', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item a img',
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_bag_item_product_name_heading',
			[
				'label' => __( 'Product Name', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'trad_woo_mini_cart_bag_item_product_name_typography',
				'label' => __( 'Typography', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item a',
			]
		);

		$this->start_controls_tabs( 'trad_woo_mini_cart_bag_item_product_name_tabs' );

            // Normal State Tab
            $this->start_controls_tab( 'trad_woo_mini_cart_bag_item_product_name_normal', [ 'label' => esc_html__( 'Normal', 'freemius-turbo-addons-elementor-pro' ) ] );

				$this->add_control(
					'trad_woo_mini_cart_bag_item_product_name_color_normal',
					[
						'label'     => esc_html__( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item a' => 'color: {{VALUE}};'
						]
					]
				);
            
            $this->end_controls_tab();

            // Hover State Tab
            $this->start_controls_tab( 'trad_woo_mini_cart_bag_item_product_name_hover', [ 'label' => esc_html__( 'Hover', 'freemius-turbo-addons-elementor-pro' ) ] );

				$this->add_control(
					'trad_woo_mini_cart_bag_item_product_name_color_hover',
					[
						'label'     => esc_html__( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item a:hover' => 'color: {{VALUE}};'
						]
					]
				);

            $this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->add_control(
			'trad_woo_mini_cart_bag_item_product_price_heading',
			[
				'label' => __( 'Product Quantity & Price', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_bag_item_product_price_margin',
			[
				'label' => __( 'Margin', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item .quantity' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs( 'trad_woo_mini_cart_bag_item_product_price_tabs' );

            // Normal State Tab
			$this->start_controls_tab( 'trad_woo_mini_cart_bag_item_product_quantity', [ 'label' => esc_html__( 'Product Quantity', 'freemius-turbo-addons-elementor-pro' ) ] );
			
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'trad_woo_mini_cart_bag_item_product_quantity_typography',
						'label' => __( 'Typography', 'freemius-turbo-addons-elementor-pro' ),
						'selector' => '{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item .quantity',
					]
				);

				$this->add_control(
					'trad_woo_mini_cart_bag_item_product_quantity_color',
					[
						'label'     => esc_html__( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#f5f5f5',
						'selectors' => [
							'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item .quantity' => 'color: {{VALUE}};'
						]
					]
				);
            
            $this->end_controls_tab();

            // Hover State Tab
			$this->start_controls_tab( 'trad_woo_mini_cart_bag_item_product_price', [ 'label' => esc_html__( 'Product Price', 'freemius-turbo-addons-elementor-pro' ) ] );
			
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'trad_woo_mini_cart_bag_item_product_price_typography',
						'label' => __( 'Typography', 'freemius-turbo-addons-elementor-pro' ),
						'selector' => '{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item .woocommerce-Price-amount',
					]
				);

				$this->add_control(
					'trad_woo_mini_cart_bag_item_product_price_color',
					[
						'label'     => esc_html__( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#f5f5f5',
						'selectors' => [
							'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item .woocommerce-Price-amount' => 'color: {{VALUE}};'
						]
					]
				);

            $this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'trad_woo_mini_cart_bag_item_remove_heading',
			[
				'label' => __( 'Remove Item Icon', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_bag_item_remove_icon_box_size',
			[
				'label' => __( 'Remove Icon Box Size', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item .remove_from_cart_button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: calc( {{SIZE}}{{UNIT}} - 5px );',
				],
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_bag_item_remove_icon_background_color',
			[
				'label'     => esc_html__( 'Remove Icon Background Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item .remove_from_cart_button' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_bag_item_remove_icon_size',
			[
				'label' => __( 'Remove Icon Size', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 13,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item .remove_from_cart_button' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_bag_item_remove_icon_color',
			[
				'label'     => esc_html__( 'Remove Icon Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item .remove_from_cart_button' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'trad_woo_mini_cart_bag_item_remove_icon_box_border',
				'label' => __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item .remove_from_cart_button',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_bag_item_remove_icon_border_radius',
			[
				'label' => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item .remove_from_cart_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'trad_woo_mini_cart_bag_item_remove_icon_box_shadow',
				'label' => __( 'Box Shadow', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-cart-bag ul.woocommerce-mini-cart li.woocommerce-mini-cart-item .remove_from_cart_button',
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_bag_item_empty_message_heading',
			[
				'label' => __( 'Empty Product Message', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'trad_woo_mini_cart_bag_item_empty_message_typography',
				'label' => __( 'Typography', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__empty-message',
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_bag_item_empty_message_color',
			[
				'label'     => esc_html__( 'Empty Message Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__empty-message' => 'color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Cart Subtotal Style
		 */

		$this->start_controls_section(
            'trad_woo_mini_cart_subtotal_style',
            [
				'label' => esc_html__( 'Subtotal', 'freemius-turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_subtotal_margin',
			[
				'label' => __( 'Margin', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__total' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_subtotal_padding',
			[
				'label' => __( 'Padding', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__total' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_subtotal_title_heading',
			[
				'label' => __( 'Sobtotal Title', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'trad_woo_mini_cart_subtotal_title_typography',
				'label' => __( 'Typography', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__total',
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_subtotal_title_color',
			[
				'label'     => esc_html__( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__total' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_subtotal_price_heading',
			[
				'label' => __( 'Sobtotal Price', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'trad_woo_mini_cart_subtotal_price_typography',
				'label' => __( 'Typography', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__total .woocommerce-Price-amount',
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_subtotal_price_color',
			[
				'label'     => esc_html__( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__total .woocommerce-Price-amount' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'trad_woo_mini_cart_subtotal_border',
				'label' => __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__total',
			]
		);

		$this->end_controls_section();

		/**
		 * Cart View Cart Style
		 */

		$this->start_controls_section(
            'trad_woo_mini_cart_view_cart_style',
            [
				'label' => esc_html__( 'View Cart Button', 'freemius-turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_view_cart_left_spacing',
			[
				'label' => __( 'Left Spacing', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:first-child' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'trad_woo_mini_cart_view_button_alignment' => 'button-inline'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_view_cart_bottom_spacing',
			[
				'label' => __( 'Bottom Spacing', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:first-child' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'trad_woo_mini_cart_view_button_alignment' => 'button-full-width'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_view_cart_padding',
			[
				'label' => __( 'Padding', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
					'unit' => 'px',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:first-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'trad_woo_mini_cart_view_cart_typography',
				'label' => __( 'Typography', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:first-child',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_view_cart_radius',
			[
				'label' => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:first-child' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs( 'trad_woo_mini_cart_view_cart_tabs' );

            // Normal State Tab
			$this->start_controls_tab( 'trad_woo_mini_cart_view_cart_normal', [ 'label' => esc_html__( 'Normal', 'freemius-turbo-addons-elementor-pro' ) ] );

				$this->add_control(
					'trad_woo_mini_cart_view_cart_normal_background',
					[
						'label'     => esc_html__( 'Background Color', 'freemius-turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:first-child' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'trad_woo_mini_cart_view_cart_normal_color',
					[
						'label'     => esc_html__( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#000000',
						'selectors' => [
							'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:first-child' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'trad_woo_mini_cart_view_cart_normal_border',
						'label' => __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
						'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:first-child',
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'trad_woo_mini_cart_view_cart_normal_shadow',
						'label' => __( 'Box Shadow', 'freemius-turbo-addons-elementor-pro' ),
						'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:first-child',
					]
				);
            
            $this->end_controls_tab();

            // Hover State Tab
			$this->start_controls_tab( 'trad_woo_mini_cart_view_cart_hover', [ 'label' => esc_html__( 'Hover', 'freemius-turbo-addons-elementor-pro' ) ] );
			
				$this->add_control(
					'trad_woo_mini_cart_view_cart_hover_background',
					[
						'label'     => esc_html__( 'Background Color', 'freemius-turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:first-child:hover' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'trad_woo_mini_cart_view_cart_hover_color',
					[
						'label'     => esc_html__( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:first-child:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'trad_woo_mini_cart_view_cart_hover_border',
						'label' => __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
						'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:first-child:hover',
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'trad_woo_mini_cart_view_cart_hover_shadow',
						'label' => __( 'Box Shadow', 'freemius-turbo-addons-elementor-pro' ),
						'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:first-child:hover',
					]
				);

            $this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Cart Check out Style
		 */

		$this->start_controls_section(
            'trad_woo_mini_cart_checkout_style',
            [
				'label' => esc_html__( 'Checkout Button', 'freemius-turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_checkout_padding',
			[
				'label' => __( 'Padding', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
					'unit' => 'px',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:last-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'trad_woo_mini_cart_checkout_typography',
				'label' => __( 'Typography', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:last-child',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_checkout_radius',
			[
				'label' => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:last-child' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs( 'trad_woo_mini_cart_checkout_tabs' );

            // Normal State Tab
			$this->start_controls_tab( 'trad_woo_mini_cart_checkout_normal', [ 'label' => esc_html__( 'Normal', 'freemius-turbo-addons-elementor-pro' ) ] );

				$this->add_control(
					'trad_woo_mini_cart_checkout_normal_background',
					[
						'label'     => esc_html__( 'Background Color', 'freemius-turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:last-child' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'trad_woo_mini_cart_checkout_normal_color',
					[
						'label'     => esc_html__( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#000000',
						'selectors' => [
							'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:last-child' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'trad_woo_mini_cart_checkout_normal_border',
						'label' => __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
						'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:last-child',
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'trad_woo_mini_cart_checkout_normal_shadow',
						'label' => __( 'Box Shadow', 'freemius-turbo-addons-elementor-pro' ),
						'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:last-child',
					]
				);
            
            $this->end_controls_tab();

            // Hover State Tab
			$this->start_controls_tab( 'trad_woo_mini_cart_checkout_hover', [ 'label' => esc_html__( 'Hover', 'freemius-turbo-addons-elementor-pro' ) ] );
			
				$this->add_control(
					'trad_woo_mini_cart_checkout_hover_background',
					[
						'label'     => esc_html__( 'Background Color', 'freemius-turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:last-child:hover' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'trad_woo_mini_cart_checkout_hover_color',
					[
						'label'     => esc_html__( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:last-child:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'trad_woo_mini_cart_checkout_hover_border',
						'label' => __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
						'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:last-child:hover',
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'trad_woo_mini_cart_checkout_hover_shadow',
						'label' => __( 'Box Shadow', 'freemius-turbo-addons-elementor-pro' ),
						'selector' => '{{WRAPPER}} .trad-woo-cart-bag .woocommerce-mini-cart__buttons .wc-forward:last-child:hover',
					]
				);

            $this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Cart Check out Style
		 */

		$this->start_controls_section(
            'trad_woo_mini_cart_flyout_close_button_style',
            [
				'label' => esc_html__( 'Flyout Close Button', 'freemius-turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'trad_woo_mini_cart_visibility' => 'fly-out'
				]
            ]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_flyout_close_button_box_size',
			[
				'label' => __( 'Button Box Size', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 25,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-bag-fly-out-close-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_flyout_close_button_box_background',
			[
				'label'     => esc_html__( 'Box Background Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-bag-fly-out-close-icon' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'trad_woo_mini_cart_flyout_close_button_box_border',
				'label' => __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-bag-fly-out-close-icon',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_flyout_close_button_box_border_radius',
			[
				'label' => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'unit' => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-bag-fly-out-close-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'trad_woo_mini_cart_flyout_close_button_box_shadow',
				'label' => __( 'Box Shadow', 'freemius-turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-bag-fly-out-close-icon',
			]
		);

		$this->add_responsive_control(
			'trad_woo_mini_cart_flyout_close_button_icon_size',
			[
				'label' => __( 'Close Icon Size', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-bag-fly-out-close-icon:before' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-bag-fly-out-close-icon:after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_flyout_close_button_box_icon_color',
			[
				'label'     => esc_html__( 'Close Icon Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-bag-fly-out-close-icon:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-bag-fly-out-close-icon:after' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'trad_woo_mini_cart_flyout_close_button_position',
			[
				'label' => __( 'Close Button Position', 'freemius-turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'freemius-turbo-addons-elementor-pro' ),
				'label_on' => __( 'Custom', 'freemius-turbo-addons-elementor-pro' ),
				'return_value' => 'yes',
                'default' => 'yes',
			]
		);

		$this->start_popover();

            $this->add_responsive_control(
                'trad_woo_mini_cart_flyout_close_button_position_x_offset',
                [
                    'label' => __( 'X Offset', 'freemius-turbo-addons-elementor-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-bag-fly-out-close-icon' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'trad_woo_mini_cart_flyout_close_button_position_y_offset',
                [
                    'label' => __( 'Y Offset', 'freemius-turbo-addons-elementor-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .trad-woo-mini-cart .trad-woo-cart-bag-fly-out-close-icon' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_popover();

		$this->end_controls_section();

    }

	    // -----------------------------------woocommerce plugin warning function
    //---------------------------------------------------------------------------------------------
    protected function trad_init_content_wc_notice_controls() {
		if ( ! class_exists( 'woocommerce' ) ) {
			$this->start_controls_section( 'trad_global_warning', [
				'label' => __( 'Warning!', 'freemius-turbo-addons-elementor-pro' ),
			] );
			$this->add_responsive_control( 'trad_global_warning_text', [
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( '<strong>WooCommerce</strong> is not installed/activated on your site. Please install and activate <a href="plugin-install.php?s=woocommerce&tab=search&type=term" target="_blank">WooCommerce</a> first.', 'freemius-turbo-addons-elementor-pro' ),
				'content_classes' => 'trad-woo-warning',
			] );
			$this->end_controls_section();

			return;
		}
	}

    protected function render() {
        if( ! class_exists('woocommerce') ) {
	        return;
        }

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
            'trad_woo_mini_cart',
            [
                'class'           => array_filter( [
                    'trad-woo-mini-cart',
                    $settings['trad_woo_mini_cart_visibility']           ?? '',
                    $settings['trad_woo_mini_cart_icon_alignment']       ?? '',
                    $settings['trad_woo_mini_cart_bag_position']         ?? '',
                    $settings['trad_woo_mini_cart_fly_out_appere_position'] ?? '',
                    $settings['trad_woo_mini_cart_visibility_animation'] ?? '',
                ] ),
                'data-visibility' => $settings['trad_woo_mini_cart_visibility'] ?? 'hover',
            ]
        );
		$this->add_render_attribute(
            'trad_woo_mini_cart_wrapper',
            [
                'class' => array_filter( [
                    'trad-woo-mini-cart-wrapper',
                    'trad-cart-icon-box-' . ( $settings['trad_woo_mini_cart_icon_box'] ?? 'yes' ),
                    $settings['trad_woo_mini_cart_view_button_alignment'] ?? '',
                ] ),
            ]
        );
		?>
		<?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<div <?php echo $this->get_render_attribute_string( 'trad_woo_mini_cart' ); ?>>
			<?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<div <?php echo $this->get_render_attribute_string( 'trad_woo_mini_cart_wrapper' ); ?>>
				<span class="trad-woo-cart-icon">
					<?php Icons_Manager::render_icon( $settings['trad_woo_mini_cart_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					<span class="trad-cart-items-count-number">
						<?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php echo (( WC()->cart != '' ) ? WC()->cart->get_cart_contents_count() : '' ); ?>
					</span>
				</span>
				<?php if( 'yes' === $settings['trad_woo_mini_cart_show_price'] ){ ?>
					<span class="trad-cart-items-count-price">
						<?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php echo (( WC()->cart != '' ) ? WC()->cart->get_cart_total() : '' ); ?>
					</span>
				<?php
				}
				?>
				<div class="trad-woo-cart-bag">
					<div class="trad-cart-items-heading">
						<span class="trad-cart-items-heading-text"><?php echo esc_html( WC()->cart ? WC()->cart->get_cart_contents_count() : 0 ); ?></span>
						<?php echo esc_html( $settings['trad_woo_mini_cart_bag_title'] ); ?>
					</div>
					<div class="widget_shopping_cart_content trad-cart-items-list">
					<?php if ( WC()->cart && ! WC()->cart->is_empty() ) : ?>
						<?php foreach ( WC()->cart->get_cart() as $trad_cart_key => $trad_cart_item ) :
							$trad_product   = $trad_cart_item['data'];
							$trad_qty       = $trad_cart_item['quantity'];
							$trad_permalink = $trad_product->is_visible() ? get_permalink( $trad_product->get_id() ) : '';
							$trad_name      = $trad_product->get_name();
							$trad_price     = WC()->cart->get_product_price( $trad_product );
							$trad_img       = $trad_product->get_image( [ 60, 60 ] );
							$trad_remove    = wc_get_cart_remove_url( $trad_cart_key );
						?>
						<div class="trad-cart-item">
							<div class="trad-cart-item-thumb">
								<?php if ( $trad_permalink ) : ?>
									<a href="<?php echo esc_url( $trad_permalink ); ?>">
										<?php echo $trad_img; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WC template output ?>
									</a>
								<?php else : ?>
									<?php echo $trad_img; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php endif; ?>
							</div>
							<div class="trad-cart-item-info">
								<?php if ( $trad_permalink ) : ?>
									<a class="trad-cart-item-name" href="<?php echo esc_url( $trad_permalink ); ?>"><?php echo esc_html( $trad_name ); ?></a>
								<?php else : ?>
									<span class="trad-cart-item-name"><?php echo esc_html( $trad_name ); ?></span>
								<?php endif; ?>
								<span class="trad-cart-item-qty">
									<?php echo esc_html( $trad_qty ); ?> &times;
									<?php echo $trad_price; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WC formatted price ?>
								</span>
							</div>
							<a href="<?php echo esc_url( $trad_remove ); ?>"
							   class="trad-cart-item-remove remove_from_cart_button"
							   data-product_id="<?php echo esc_attr( $trad_product->get_id() ); ?>"
							   data-cart_item_key="<?php echo esc_attr( $trad_cart_key ); ?>"
							   aria-label="<?php
							   	/* translators: %s: product name */
							   	echo esc_attr( sprintf( __( 'Remove %s from cart', 'freemius-turbo-addons-elementor-pro' ), $trad_name ) );
							   ?>">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" width="10" height="10" aria-hidden="true">
									<line x1="1" y1="1" x2="9" y2="9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
									<line x1="9" y1="1" x2="1" y2="9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
								</svg>
							</a>
						</div>
						<?php endforeach; ?>

						<div class="trad-cart-subtotal">
							<span><?php esc_html_e( 'Subtotal:', 'freemius-turbo-addons-elementor-pro' ); ?></span>
							<span><?php echo WC()->cart->get_cart_subtotal(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WC formatted price ?></span>
						</div>

						<div class="trad-cart-actions">
							<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="trad-cart-action-btn trad-cart-view-btn">
								<?php esc_html_e( 'View cart', 'freemius-turbo-addons-elementor-pro' ); ?>
							</a>
							<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="trad-cart-action-btn trad-cart-checkout-btn">
								<?php esc_html_e( 'Checkout', 'freemius-turbo-addons-elementor-pro' ); ?>
							</a>
						</div>
					<?php else : ?>
						<p class="trad-cart-empty"><?php esc_html_e( 'No products in the cart.', 'freemius-turbo-addons-elementor-pro' ); ?></p>
					<?php endif; ?>
					</div>
					<?php if ( 'fly-out' === $settings['trad_woo_mini_cart_visibility'] ) : ?>
						<div class="trad-woo-cart-bag-fly-out-close-icon" role="button" aria-label="<?php esc_attr_e( 'Close', 'freemius-turbo-addons-elementor-pro' ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" width="14" height="14" aria-hidden="true">
								<line x1="1" y1="1" x2="13" y2="13" stroke="#333" stroke-width="2" stroke-linecap="round"/>
								<line x1="13" y1="1" x2="1" y2="13" stroke="#333" stroke-width="2" stroke-linecap="round"/>
							</svg>
						</div>
					<?php endif; ?>
				</div>
				<?php if( 'fly-out' === $settings['trad_woo_mini_cart_visibility'] ){ ?>
					<div class="trad-woo-cart-bag-fly-out-overlay"></div>
				<?php } ?>
			</div>

		</div>


		<?php
    }
    
 


}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Mini_Cart());
