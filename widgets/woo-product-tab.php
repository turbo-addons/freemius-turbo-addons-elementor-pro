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

class TRAD_WOO_Product_Tab extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_tab';
    }

    public function get_title() {
        return __('WOO Product Tabs', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-product-tabs trad-icon';
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
            'trad_woo_product_tab_content_section',
            [
                'label' => esc_html__( 'Content', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
			'trad_woo_product_tabs_before_text',
			[
				'label'       => esc_html__( 'Show Text Before Tabs', 'turbo-addons-elementor-pro' ),
				'type'        => Controls_Manager::TEXTAREA
			]
        );

        $this->end_controls_section();

        // Box Styling Controls
        $this->start_controls_section(
            'trad_woo_product_tab_box_style',
            [
				'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_tab_panel_description_container_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-product-details-tabs-box'
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_tab_panel_description_container_padding',
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
					'{{WRAPPER}} .trad-woo-product-details-tabs-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_tab_panel_description_container_margin',
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
					'{{WRAPPER}} .trad-woo-product-details-tabs-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'trad_woo_product_tab_panel_description_container_radius',
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
					'{{WRAPPER}} .trad-woo-product-details-tabs-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'trad_woo_product_tab_panel_description_container_border',
				'selector' => '{{WRAPPER}} .trad-woo-product-details-tabs-box'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_tab_panel_description_container_box_shadow',
				'selector' => '{{WRAPPER}} .trad-woo-product-details-tabs-box'
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
            'trad_woo_product_product_tabs_control_style',
            [
                'label' => esc_html__('Tab', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'trad_woo_product_product_tabs_control_item_container_style',
            [
                'label'     => esc_html__('Tab Container', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::HEADING
            ]
        );

		$this->add_control(
			'trad_woo_product_tabs_box_alignment',
			[
				'label'   => __( 'Alignment', 'turbo-addons-elementor-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'default' => 'trad-woo-product-tabs-menu-container-align-top',
				'options' => [
					'trad-woo-product-tabs-menu-container-align-left'   => [
						'title' => __( 'Left', 'turbo-addons-elementor-pro' ),
						'icon'  => 'eicon-arrow-left'
					],
					'trad-woo-product-tabs-menu-container-align-top' => [
						'title' => __( 'Top', 'turbo-addons-elementor-pro' ),
						'icon'  => 'eicon-arrow-up'
					],
					'trad-woo-product-tabs-menu-container-align-right'  => [
						'title' => __( 'Right', 'turbo-addons-elementor-pro' ),
						'icon'  => 'eicon-arrow-right'
					]
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_product_tabs_control_container_nav_tabs_width',
			[
				'label' => __( 'Width', 'turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'devices' => [ 'desktop' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box.trad-woo-product-tabs-menu-container-align-left .woocommerce-tabs .wc-tabs' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .trad-woo-product-details-tabs-box.trad-woo-product-tabs-menu-container-align-right .woocommerce-tabs .wc-tabs' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .trad-woo-product-details-tabs-box.trad-woo-product-tabs-menu-container-align-left .woocommerce-tabs .woocommerce-Tabs-panel' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .trad-woo-product-details-tabs-box.trad-woo-product-tabs-menu-container-align-right .woocommerce-tabs .woocommerce-Tabs-panel' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
                ],
                'condition' => [
                    'trad_woo_product_tabs_box_alignment' => ['trad-woo-product-tabs-menu-container-align-left', 'trad-woo-product-tabs-menu-container-align-right']
                ]
			]
        );

		$this->add_responsive_control(
			'trad_woo_product_product_tabs_control_container_nav_conten_spacing',
			[
				'label'       => __( 'Left & Right Spacing', 'turbo-addons-elementor-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					],
				],
				'devices' => [ 'desktop', 'tablet' ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 10
                ],
                'tablet_default' => [
					'size' => 10,
					'unit' => '%',
				],
                'mobile_default' => [
					'size' => 0,
					'unit' => 'px',
				],
                'condition' => [
					'trad_woo_product_tabs_box_alignment' => ['trad-woo-product-tabs-menu-container-align-left', 'trad-woo-product-tabs-menu-container-align-right']
                ],
				'selectors'   => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box.trad-woo-product-tabs-menu-container-align-left .woocommerce-tabs .woocommerce-Tabs-panel' => 'margin-left: {{SIZE}}{{UNIT}}; width: calc( ( 100% - {{trad_woo_product_product_tabs_control_container_nav_tabs_width.size}}{{trad_woo_product_product_tabs_control_container_nav_tabs_width.unit}} ) - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .trad-woo-product-details-tabs-box.trad-woo-product-tabs-menu-container-align-right .woocommerce-tabs .woocommerce-Tabs-panel' => 'margin-right: {{SIZE}}{{UNIT}}; width: calc( ( 100% - {{trad_woo_product_product_tabs_control_container_nav_tabs_width.size}}{{trad_woo_product_product_tabs_control_container_nav_tabs_width.unit}} ) - {{SIZE}}{{UNIT}} );',
                ],
			]
		);
        
        $this->add_responsive_control(
            'trad_woo_product_product_tabs_control_container_padding',
            [
                'label'        => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', 'em', '%'],
                'default'      => [
                    'top'      => '30',
                    'right'    => '20',
                    'bottom'   => '30',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_product_tabs_control_container_margin',
            [
                'label'        => esc_html__('Margin', 'turbo-addons-elementor-pro'),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', 'em', '%'],
                'default'      => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'  => 'trad_woo_product_product_tabs_control_container_background',
				'label' => __( 'Background', 'turbo-addons-elementor-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs',
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_product_product_tabs_control_container_border',
                'selector' => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs',
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_product_tabs_control_container_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px',
					'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'                   => 'trad_woo_product_product_tabs_control_shadow',
                'selector'               => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs',
                'fields_options'         => [
                    'box_shadow_type'    => [ 
                        'default'        =>'yes' 
                    ],
                    'box_shadow'         => [
                        'default'        => [
                            'horizontal' => 0,
                            'vertical'   => 10,
                            'blur'       => 33,
                            'spread'     => 0,
                            'color'      => 'rgba(51, 77, 128, 0.1)'
                        ]
                    ]
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_product_tabs_control_item_style',
            [
                'label'     => esc_html__('Tab Items', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_product_tabs_control_item_control_item_alignment',
            [
                'label'         => esc_html__('Item Alignment', 'turbo-addons-elementor-pro'),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'label_block'   => true,
                'default'       => 'center',
                'options'       => [
                    'left'      => [
                        'title' => esc_html__('Left', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => esc_html__('Center', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'     => [
                        'title' => esc_html__('Right', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-right'
                    ],
                ],
                'condition' => [
                    'trad_woo_product_tabs_box_alignment!' => ['trad-woo-product-tabs-menu-container-align-left', 'trad-woo-product-tabs-menu-container-align-right']
				],
				'selectors_dictionary' => [
                    'left'      => 'text-align: left; display: flex; justify-content: flex-start; margin-right: auto;',
					'center'    => 'text-align: center; display: flex; justify-content: center; margin-left: auto; margin-right: auto;',
					'right'     => 'text-align: right; display: flex; justify-content: flex-end; margin-left: auto;',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs' => '{{VALUE}};'
                ]
            ]
        );      

		$this->add_responsive_control(
            'trad_woo_product_product_tabs_control_item_control_item_alignment_left_right',
            [
                'label'         => esc_html__('Item Alignment2', 'turbo-addons-elementor-pro'),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'label_block'   => true,
                'default'       => 'center',
                'options'       => [
                    'left'      => [
                        'title' => esc_html__('Left', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => esc_html__('Center', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'     => [
                        'title' => esc_html__('Right', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
				'selectors_dictionary' => [
                    'left'      => 'text-align: left; display: flex; justify-content: flex-start; margin-right: auto;',
					'center'    => 'text-align: center; display: flex; justify-content: center; margin-left: auto; margin-right: auto;',
					'right'     => 'text-align: right; display: flex; justify-content: flex-end; margin-left: auto;',
                ],
                'condition' => [
                    'trad_woo_product_tabs_box_alignment' => ['trad-woo-product-tabs-menu-container-align-left', 'trad-woo-product-tabs-menu-container-align-right']
				],
                'selectors'     => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li a' => '{{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_product_tabs_control_control_item_padding',
            [
                'label'      => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'    => 10,
                    'right'  => 20,
                    'bottom' => 5,
                    'left'   => 20,
                    'unit'   => 'px',
					'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
			'trad_woo_product_product_tabs_control_control_item_spacing',
			[
				'label'       => __( 'Between Items Spacing', 'turbo-addons-elementor-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					],
				],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 10
                ],
				'selectors'   => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box.trad-woo-product-tabs-menu-container-align-top .woocommerce-tabs .wc-tabs li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .trad-woo-product-details-tabs-box.trad-woo-product-tabs-menu-container-align-left .woocommerce-tabs .wc-tabs li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .trad-woo-product-details-tabs-box.trad-woo-product-tabs-menu-container-align-right .woocommerce-tabs .wc-tabs li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_product_tabs_control_control_typography',
                'selector' => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li a',
                'fields_options'     => [
                    'text_transform' => [
                        'default'    => 'capitalize'
                    ]
                ]
            ]
        );

        // Tabs
        $this->start_controls_tabs('trad_woo_product_product_tabs_control_control_tabs');

        // Normal State Tab
        $this->start_controls_tab('trad_woo_product_product_tabs_control_control_normal', ['label' => esc_html__('Normal', 'turbo-addons-elementor-pro')]);

        $this->add_control(
            'trad_woo_product_product_tabs_control_normal_text_color',
            [
                'label'     => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#444444',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_product_tabs_control_normal_bg_color',
            [
                'label'     => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li a' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                 => 'trad_woo_product_product_tabs_control_normal_border',
                'fields_options'       => [
                    'border'           => [
                        'default'      => 'solid'
                    ],
                    'width'            => [
                        'default'      => [
                            'top'      => '0',
                            'right'    => '0',
                            'bottom'   => '2',
                            'left'     => '0',
                            'isLinked' => false
                        ]
                    ],
                    'color'            => [
                        'default'      => 'rgba(255,255,255,0)'
                    ]
                ],
                'selector'             => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li a'
            ]
        );

        $this->add_control(
            'trad_woo_product_product_tabs_control_normal_border_radius',
            [
                'label'   => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::SLIDER,
                'range'   => [
                    'px'  => [
                        'max' => 30
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li a' => 'border-radius: {{SIZE}}px;'
                ]
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab('trad_woo_product_product_tabs_control_btn_hover', ['label' => esc_html__('Hover', 'turbo-addons-elementor-pro')]);

        $this->add_control(
            'trad_woo_product_product_tabs_control_hover_text_color',
            [
                'label'     => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2e3195',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_product_tabs_control_hover_bg_color',
            [
                'label'     => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li a:hover'      => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_product_product_tabs_control_hover_border',
                'selector' => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li a:hover'
            ]
        );

        $this->add_control(
            'trad_woo_product_product_tabs_control_hover_border_radius',
            [
                'label'       => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px'      => [
                        'max' => 30
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li a:hover' => 'border-radius: {{SIZE}}px;'
                ]
            ]
        );

        $this->end_controls_tab();

        // Active State Tab
        $this->start_controls_tab('trad_woo_product_product_tabs_control_btn_active', ['label' => esc_html__('Active', 'turbo-addons-elementor-pro')]);

        $this->add_control(
            'trad_woo_product_product_tabs_control_active_text_color',
            [
                'label'     => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2e3195',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li.active a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_product_tabs_control_active_bg_color',
            [
                'label'     => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li.active a' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                 => 'trad_woo_product_product_tabs_control_active_border',
                'fields_options'       => [
                    'border'           => [
                        'default'      => 'solid'
                    ],
                    'width'            => [
                        'default'      => [
                            'top'      => '0',
                            'right'    => '0',
                            'bottom'   => '2',
                            'left'     => '0',
                            'isLinked' => false
                        ]
                    ],
                    'color'            => [
                        'default'      => '#2e3195'
                    ]
                ],
                'selector'             => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li.active a'
            ]
        );

        $this->add_control(
            'trad_woo_product_product_tabs_control_active_border_radius',
            [
                'label'       => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px'      => [
                        'max' => 30
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .wc-tabs li.active a' => 'border-radius: {{SIZE}}px;'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

		/*
		* Tabs panel Styling Section
		*/
		$this->start_controls_section(
			'trad_woo_product_tabs_panel_content_style',
			[
				'label' => __( 'Tab Panel', 'turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'trad_woo_product_tabs_panel_content_bg_color',
			[
				'label'     => __( 'Background Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel' => 'background-color: {{VALUE}};'
				]

			]
		);

		$this->add_responsive_control(
			'trad_woo_product_tabs_panel_content_margin',
			[
				'label'         => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'trad_woo_product_tabs_panel_content_padding',
			[
				'label'      => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'default'    => [
					'top'      => '20',
					'right'    => '20',
					'bottom'   => '20',
					'left'     => '20'
				],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'trad_woo_product_tabs_panel_content_border',
				'selector'  => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel'
			]
		);

		$this->add_control(
			'trad_woo_product_tabs_panel_content_box_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'trad_woo_product_tabs_panel_content_box_shadow',
				'selector'  => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel'
			]
		);

		$this->end_controls_section();

		/*
		* Tabs Title Styling Section
		*/
		$this->start_controls_section(
            'trad_woo_product_product_tabs_title',
            [
				'label'     => __( 'Title', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'trad_woo_product_product_tabs_title_margin',
			[
				'label'         => __( 'Margin', 'turbo-addons-elementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'default'       => [
					'top'       => '0',
					'right'     => '0',
					'bottom'    => '0',
					'left'      => '0',
					'unit'      => 'px',
				],
                'selectors'     => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_product_tabs_title_padding',
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
				],
                'selectors'     => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_product_tabs_title_alignment',
			[
				'label'   => __( 'Title Alignment', 'turbo-addons-elementor-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'left'		=> [
						'title' => __( 'Left', 'turbo-addons-elementor-pro' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center' 	=> [
						'title' => __( 'Center', 'turbo-addons-elementor-pro' ),
						'icon' 	=> 'eicon-text-align-center'
					],
					'right' 	=> [
						'title' => __( 'Right', 'turbo-addons-elementor-pro' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel h2' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel h3' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'trad_woo_product_product_tabs_title_typography',
				'selector' => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel h2, {{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel h3'
			]
		);

		$this->add_control(
			'trad_woo_product_product_tabs_title_color',
			[
				'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1B1D26',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel h2' => 'color: {{VALUE}};',
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel h3' => 'color: {{VALUE}};'
				]	
			]
		);
	
		$this->end_controls_section();

		$this->start_controls_section(
            'trad_woo_product_tab_panel_description_style',
            [
                'label' => esc_html__( 'Description', 'turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'trad_woo_product_tab_panel_description_color',
			[
				'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel p' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_tab_panel_description_typography',
                'selector' => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel'
            ]
        );

        $this->add_responsive_control(
			'trad_woo_product_tab_panel_description_margin',
			[
				'label'         => __( 'Margin', 'turbo-addons-elementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'default'       => [
					'top'       => '0',
					'right'     => '0',
					'bottom'    => '0',
					'left'      => '0',
					'unit'      => 'px',
				],
                'selectors'     => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_tab_panel_description_padding',
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
				],
                'selectors'     => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);

		$this->end_controls_section();
		
		 /**
         * -------------------------------------------
         * Tab Style Table Style
         * -------------------------------------------
         */ 
        $this->start_controls_section(
            'trad_woo_product_tab_panel_table_tables_style',
            [
                'label' => esc_html__('Table', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs( 'trad_woo_product_tab_panel_table_style_tab' );
        //  Controls tab For Box
        $this->start_controls_tab(
        'trad_woo_product_tab_panel_table_style_tab_table',
            [
                'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_tab_panel_table_typography',
                'selector' => ' {{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel table thead th, {{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel table tbody td, {{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel table tfoot td',
                'fields_options'     => [
                    'text_transform' => [
                        'default'    => 'capitalize'
                    ]
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_tab_panel_table_row_vertical_alignment',
            [
                'label'   => __( 'Vertical Alignment', 'turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title'  => __( 'Top', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-v-align-top'
                    ],
                    'middle' => [
                        'title'  => __( 'Middle', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-v-align-middle'
                    ],
                    'bottom' => [
                        'title'  => __( 'Bottom', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-v-align-bottom'
                    ]
                ],
                'default' => 'middle',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce table.shop_attributes th' => 'vertical-align: {{VALUE}} !important;',
                    '{{WRAPPER}} table.shop_attributes th' => 'vertical-align: {{VALUE}} !important;',
                    '{{WRAPPER}} .woocommerce table.shop_attributes tr th' => 'vertical-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
			'trad_woo_product_tab_panel_table_row_horizontal_alignment',
			[
				'label'   => __( 'Horizontal Alignment', 'turbo-addons-elementor-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title'  => __( 'Left', 'turbo-addons-elementor-pro' ),
						'icon'   => 'eicon-text-align-left'
					],
					'center'     => [
						'title'  => __( 'Center', 'turbo-addons-elementor-pro' ),
						'icon'   => 'eicon-text-align-center'
					],
					'right'   => [
						'title'  => __( 'Right', 'turbo-addons-elementor-pro' ),
						'icon'   => 'eicon-text-align-right'
					]
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel table tbody tr td, {{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel table thead tr th' => 'text-align: {{VALUE}};'
				]
			]
		);
        $this->add_responsive_control(
			'trad_woo_product_tab_panel_table_row_margin',
			[
				'label'         => __( 'Margin', 'turbo-addons-elementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'default'       => [
					'top'       => '0',
					'right'     => '0',
					'bottom'    => '0',
					'left'      => '0',
					'unit'      => 'px',
				],
                'selectors'     => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_tab_panel_table_row_padding',
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
				],
                'selectors'     => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
        $this->add_control(
            'trad_woo_product_tab_panel_table_bg_color',
            [
                'label'     => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel table' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                 => 'trad_woo_product_tab_panel_table_border',
                'fields_options'       => [
                    'border'           => [
                        'default'      => 'solid'
                    ],
                    'color'            => [
                        'default'      => 'rgba(255,255,255,0)'
                    ]
                ],
                'selector'             => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel table'
            ]
        );

        $this->add_control(
            'trad_woo_product_tab_panel_table_border_radius',
            [
                'label'   => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::SLIDER,
                'range'   => [
                    'px'  => [
                        'max' => 30
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel table' => 'border-radius: {{SIZE}}px;'
                ]
            ]
        );
        $this->end_controls_tab();

        //  Controls tab For Row
        $this->start_controls_tab(
        'trad_woo_product_tab_panel_table_style_tab_row',
            [
                'label' => esc_html__( 'Row', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
            'trad_woo_product_tab_panel_table_row_background_color',
            [
                'label'     => esc_html__('Row Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel table tbody tr td'      => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_tab_panel_table_even_row_background_color',
            [
                'label'     => esc_html__('Even Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel table tbody tr:nth-child(even) td'      => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
			'trad_woo_product_tab_panel_table_row_color',
			[
				'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel p' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_control(
			'trad_woo_product_tab_panel_table_row_th_color',
			[
				'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box  table.shop_attributes th' => 'color: {{VALUE}};'
				]
			]
		);

        $this->end_controls_tab();

        //  Controls tab For Row
        $this->start_controls_tab(
        'trad_woo_product_tab_panel_table_style_tab_cell',
            [
                'label' => esc_html__( 'Cell', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_tab_panel_table_cell_padding',
            [
                'label'      => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel table tbody tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                 => 'trad_woo_product_tab_panel_table_cell_border',
                'fields_options'       => [
                    'border'           => [
                        'default'      => 'solid'
                    ],
                    'color'            => [
                        'default'      => '#ccc'
                    ]
                ],
                'selector'             => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-tabs .woocommerce-Tabs-panel table tbody tr td'
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

		$this->start_controls_section(
            'trad_woo_product_tabs_before_text_after_style_section',
            [
                'label' => esc_html__( 'Tab Before Text', 'turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_tabs_before_text_alignment',
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
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .trad-woo-product-tabs-before-text' => 'display: flex; justify-content: {{VALUE}};'
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'trad_woo_product_tabs_before_text_typography',
				'selector'         => '{{WRAPPER}} .trad-woo-product-details-tabs-box .trad-woo-product-tabs-before-text',
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

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_tabs_before_text_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-product-details-tabs-box .trad-woo-product-tabs-before-text'
			]
		);

		$this->add_control(
			'trad_woo_product_tabs_before_text_color',
			[
				'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .trad-woo-product-tabs-before-text' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_tabs_before_text_margin',
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
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .trad-woo-product-tabs-before-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_tabs_before_text_padding',
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
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .trad-woo-product-tabs-before-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this-> end_controls_section();

		$this->start_controls_section(
			'trad_woo_product_product_tabs_review_style',
			[
				'label' => esc_html__( 'Review Tab', 'turbo-addons-elementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->start_controls_tabs( 'trad_woo_product_product_tabs_review_tab_style' );

        //  Controls tab For Image
        $this->start_controls_tab(
        'trad_woo_product_product_tabs_review_tab_style_image',
            [
                'label' => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
            ]
        );

		$this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_image_box_height',
			[
				'label'       => __( 'Height', 'turbo-addons-elementor-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 32
				],
				'selectors'   => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #reviews #comments ol.commentlist li img.avatar'=> 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_image_box_width',
			[
				'label'       => __( 'Width', 'turbo-addons-elementor-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 32
				],
				'selectors'   => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #reviews #comments ol.commentlist li img.avatar'=> 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_image_box_radius',
			[
				'label'      => __( 'Border radius', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => '%',
                    'isLinked' => false
				],
				'selectors'  => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #reviews #comments ol.commentlist li img.avatar'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'trad_woo_product_product_tabs_reviewes_image_box_border',
				'selector'  => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #reviews #comments ol.commentlist li img.avatar',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_product_tabs_reviewes_image_box_shadow',
				'selector' => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #reviews #comments ol.commentlist li img.avatar'
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_image_box_margin_left',
			[
				'label'       => __( 'Right Spacing', 'turbo-addons-elementor-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => -50,
						'max' => 100
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 50
				],
				'selectors'   => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #reviews #comments ol.commentlist li .comment-text'=> 'margin-left: {{SIZE}}{{UNIT}};'
				],
			]
		);

        $this->end_controls_tab();

        //  Controls tab For Name
        $this->start_controls_tab(
        'trad_woo_product_product_tabs_review_tab_style_name',
            [
                'label' => esc_html__( 'Name', 'turbo-addons-elementor-pro' ),
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'trad_woo_product_product_tabs_reviewes_title_typography',
				'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-Tabs-panel .woocommerce-review__author',
			]
		);

		$this->add_control(
			'trad_woo_product_product_tabs_reviewes_title_color',
			[
				'label' => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-review__author' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_title_margin',
			[
				'label' => __( 'Margin', 'turbo-addons-elementor-pro' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
                    'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-Tabs-panel .woocommerce-review__author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();
        
        //  Controls tab For Date
        $this->start_controls_tab(
        'trad_woo_product_product_tabs_review_tab_style_date',
            [
                'label' => esc_html__( 'Date', 'turbo-addons-elementor-pro' ),
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'trad_woo_product_product_tabs_reviewes_date_typography',
				'label'     => __( 'Typography', 'turbo-addons-elementor-pro' ),
				'selector'  => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-Tabs-panel .woocommerce-review__published-date',
			]
		);

		$this->add_control(
			'trad_woo_product_product_tabs_reviewes_date_color',
			[
				'label' => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-Tabs-panel .woocommerce-review__published-date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_date_margin',
			[
				'label' => __( 'Margin', 'turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
                    'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-Tabs-panel .woocommerce-review__published-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        //  Controls tab For Description
        $this->start_controls_tab(
        'trad_woo_product_product_tabs_review_tab_style_description',
            [
                'label' => esc_html__( 'Description', 'turbo-addons-elementor-pro' ),
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'trad_woo_product_product_tabs_reviewes_date',
				'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-Tabs-panel .description',
			]
		);

		$this->add_control(
			'trad_woo_product_product_tabs_reviewes_description_color',
			[
				'label' => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-Tabs-panel .description' => 'color: {{VALUE}} !important;',
				],
			]
		);

        $this->add_control(
            'trad_woo_product_product_tabs_description_normal_background_color',
            [
                'label'     => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #reviews #comments ol.commentlist li .comment-text' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_description_padding',
			[
				'label' => __( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
                    'isLinked' => false
				],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #reviews #comments ol.commentlist li .comment-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

                
		$this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_description_radius',
			[
				'label'      => __( 'Border radius', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => '%',
                    'isLinked' => false
				],
				'selectors'  => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #reviews #comments ol.commentlist li .comment-text'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'trad_woo_product_product_tabs_reviewes_description_border',
				'selector'  => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #reviews #comments ol.commentlist li .comment-text',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_product_tabs_reviewes_description_box_shadow',
				'selector' => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #reviews #comments ol.commentlist li .comment-text'
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();
        /**
		 * Reviewer rating Style Section
		 */

		$this->add_control(
			'trad_woo_product_product_tabs_reviewes_rating_style',
			[
				'label' => __( 'Rating', 'turbo-addons-elementor-pro' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_rating_size',
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
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-Tabs-panel .star-rating' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_rating_icon_margin',
			[
				'label'       => __( 'Icon Margin', 'turbo-addons-elementor-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 5
				],
				'selectors'   => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-Tabs-panel .star-rating' => 'margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'trad_woo_product_product_tabs_reviewes_rating_tabs' );

			// normal state rating
			$this->start_controls_tab( 'trad_woo_product_product_tabs_reviewes_rating_normal', [ 'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ) ] );

				$this->add_control(
					'trad_woo_product_product_tabs_reviewes_rating_normal_color',
					[
						'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
                            '{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-Tabs-panel .star-rating::before' => 'color: {{VALUE}} !important;',
						]
					]
				);

			$this->end_controls_tab();

			// hover state rating
			$this->start_controls_tab( 'trad_woo_product_product_tabs_reviewes_rating_active', [ 'label' => esc_html__( 'Active', 'turbo-addons-elementor-pro' ) ] );

				$this->add_control(
					'trad_woo_product_product_tabs_reviewes_rating_active_color',
					[
						'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ff5b84',
						'selectors' => [
							'{{WRAPPER}} .trad-woo-product-details-tabs-box .woocommerce-Tabs-panel .star-rating' => 'color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this-> end_controls_section();

        $this->start_controls_section(
            'trad_woo_product_product_tabs_reviewes_form_title_style',
            [
                'label' => esc_html__('Form Title', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_product_tabs_reviewes_form_title_alignment', 
            [
                'label'         => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'center',
                'toggle'        => false,
                'options'       => [
                    'left' => [
                        'title'  => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title'  => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title'  => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-text-align-right',
                    ],
                ],
                'selectors_dictionary' => [
                    'left'   => 'display: flex; justify-content: flex-start;',
                    'center' => 'display: flex; justify-content: center;',
                    'right'  => 'display: flex; justify-content: flex-end;',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box .comment-reply-title' => '{{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'trad_woo_product_product_tabs_reviewes_form_title_typography',
				'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-product-details-tabs-box .comment-reply-title',
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_form_title_padding',
			[
				'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box .comment-reply-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_form_title_margin',
			[
				'label'      => __( 'Margin', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box .comment-reply-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_product_tabs_reviewes_form_title_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box .comment-reply-title'
			]
		);

        $this->add_control(
			'trad_woo_product_product_tabs_reviewes_form_title_color',
				[
					'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#222222',
					'selectors' => [
                            '{{WRAPPER}} .trad-woo-product-details-tabs-box .comment-reply-title' => 'color: {{VALUE}} !important;',
					]
				]
		);

        $this-> end_controls_section();

        $this->start_controls_section(
            'trad_woo_product_product_tabs_reviewes_form_style',
            [
                'label' => esc_html__('Form', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs( 'trad_woo_product_product_tabs_reviewes_form_style_tab' );
        //  Controls tab For Normal
        $this->start_controls_tab(
        'trad_woo_product_product_tabs_reviewes_form_style_box',
            [
                'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_product_tabs_reviewes_form_container_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form'
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_form_container_margin',
			[
				'label'      => __( 'Margin', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10'
				],
				'selectors'  => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_form_container_padding',
			[
				'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
				'selectors'  => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_form_container_radius',
			[
				'label'      => __( 'Border radius', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10'
				],
				'selectors'  => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'            => 'trad_woo_product_product_tabs_reviewes_form_container_border',
				'fields_options'  => [
                    'border'      => [
                        'default' => 'solid'
                    ],
                    'width'          => [
                        'default'    => [
							'top'    => '1',
							'right'  => '1',
							'bottom' => '1',
							'left'   => '1'
                        ]
                    ],
                    'color'       => [
                        'default' => '#e3e3e3'
                    ]
				],
				'selector'        => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form'
			]
		);

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_product_tabs_reviewes_form_container_box_shadow',
				'selector' => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form'
			]
		);
        $this->end_controls_tab();

        $this->start_controls_tab(
        'trad_woo_product_product_tabs_reviewes_form_style_form_label',
            [
                'label' => esc_html__( 'Label', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_product_tabs_reviewes_form_label_typography',
                'selector' => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form label',
                'fields_options'     => [
                    'text_transform' => [
                        'default'    => 'capitalize'
                    ]
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_product_tabs_reviewes_form_label_color',
            [
                'label'     => esc_html__('Label Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#444444',
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form label' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_product_tabs_reviewes_form_label_bottom_spacing',
            [
                'label'        => esc_html__( 'Label Bottom Spacing', 'turbo-addons-elementor-pro' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'selectors'    => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form label' => 'margin-bottom: {{SIZE}}px;'
                ]
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
        'trad_woo_product_product_tabs_reviewes_form_style_form_input',
            [
                'label' => esc_html__( 'Input', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_product_tabs_reviewes_form_input_field_typography',
                'selector' => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="text"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="email"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="url"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="password"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="search"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="number"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="tel"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="range"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="date"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="month"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="week"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="time"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="datetime"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="datetime-local"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="color"],
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form .select2-selection__placeholder,
                        .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form textarea'
            ]
        );
        
        $this->add_control(
            'trad_woo_product_product_tabs_reviewes_form_input_field_text_color',
            [
                'label'     => __( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input, .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form textarea, .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form .select2-selection__placeholder' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_product_tabs_reviewes_form_input_field_placeholder_color',
            [
                'label'     => __( 'Placeholder Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="text"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="email"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="url"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="password"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="search"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="number"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="tel"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="range"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="date"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="month"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="week"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="time"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="datetime"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="datetime-local"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input[type="color"]::placeholder,
                    .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form textarea::placeholder' => 'color: {{VALUE}};'
                ]
            ]
        );
  
        $this->add_control(
            'trad_woo_product_product_tabs_reviewes_form_input_field_bg',
            [
                'label'     => __( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input, .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form textarea, .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form .select2-selection--single' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_product_tabs_reviewes_form_input_field_margin',
            [
                'label'      => __( 'Margin', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input:not([type=checkbox]), .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form textarea, .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form .select2-container, .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form .select2-container .select2-selection--single' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'default'    => [
                    'top'    => 10,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ]
            ]
        );

        $this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_form_input_field_padding',
			[
                'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'unit'   => 'px',
					'size'   => 15
                ],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input:not([type=checkbox]), {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form textarea, {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form .select2-selection__rendered, {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form .select2-container .select2-selection--single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
            'trad_woo_product_product_tabs_reviewes_form_input_field_height',
            [
                'label' => esc_html__('Input Field Height', 'turbo-addons-elementor-pro'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                        'step' => 1
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond p.comment-form-author input[type="text"]' => 'height: {{SIZE}}px;',
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond p.comment-form-email input[type="email"]' => 'height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_product_tabs_reviewes_form_input_field_width',
            [
                'label' => __( 'Field Width', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 1
                    ]
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond p.comment-form-author input[type="text"]' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond p.comment-form-email input[type="email"]' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_product_tabs_reviewes_form_input_field_bottom_spacing',
            [
                'label'        => esc_html__( 'Field Bottom Spacing', 'turbo-addons-elementor-pro' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'selectors'    => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form' => 'margin-bottom: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'        => 'trad_woo_product_product_tabs_reviewes_form_input_field_border',
                'selector'    => '{{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input:not([type=checkbox]), {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form textarea, {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form .select2-container .select2-selection--single'
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_form_input_field_radius',
			[
                'label'      => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input:not([type=checkbox]), .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form textarea, .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form .select2-container .select2-selection--single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_product_tabs_reviewes_form_input_field_box_shadow',
				'selector' => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form input:not([type=checkbox]), .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form .form-submit input:not([type=submit]), .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form textarea, .woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .comment-form .select2-container .select2-selection--single'
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'trad_woo_product_product_tabs_reviewes_form_button_style',
            [
                'label' => esc_html__('Form Button', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'trad_woo_product_product_tabs_reviewes_form_btn_style',
            [
                'label'     => esc_html__('Button', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_product_tabs_reviewes_form_btn_alignment',
            [
                'label'   => __( 'Alignment', 'turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => __( 'Left', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'desktop_default' => 'left',
                'tablet_default' => 'center',
                'mobile_default' => 'center',
                'selectors_dictionary' => [
                    'left'    => 'display: flex; justify-content: flex-start;',
                    'center'  => 'display: flex; justify-content: center;',
                    'right'   => 'display: flex; justify-content: flex-end;',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .form-submit' => '{{VALUE}}',
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_product_tabs_reviewes_form_btn_typography',
                'selector' => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .form-submit input',
                'fields_options'     => [
                    'text_transform' => [
                        'default'    => 'capitalize'
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_product_tabs_reviewes_form_btn_padding',
            [
                'label'      => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .form-submit input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_form_btn_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .form-submit input'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_product_tabs_reviewes_form_btn_margin_top',
			[
				'label'       => __( 'Top Spacing', 'turbo-addons-elementor-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => -50,
						'max' => 50
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 20
				],
				'selectors'   => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .form-submit'=> 'margin-top: {{SIZE}}{{UNIT}};'
				],
			]
		);

        $this->start_controls_tabs( 'trad_woo_product_product_tabs_reviewes_form_btn_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ) ] );

		$this->add_control(
			'trad_woo_product_product_tabs_reviewes_form_btn_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> "#fff",
				'selectors'	=> [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .form-submit input'  => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_control(
            'trad_woo_product_product_tabs_reviewes_form_btn_background',
            [
                'label'     => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'	=> '#2e3195',
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .form-submit input'      => 'background: {{VALUE}};'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'            => 'trad_woo_product_product_tabs_reviewes_form_btn_border',
				'fields_options'  => [
                    'border' 	  => [
                        'default' => 'solid'
                    ],
                    'width'  	  => [
                        'default' 	 => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1',
                            'isLinked' => false
                        ]
                    ],
                    'color' 	  => [
                        'default' => '#2e3195'
                    ]
                ],
				'selector'        => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .form-submit input'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_product_tabs_reviewes_form_btn_shadow',
				'selector' => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .form-submit input'
			]
		);

		$this->end_controls_tab();
		
		$this->start_controls_tab( 'trad_woo_product_product_tabs_reviewes_form_btn_hover', [ 'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ) ] );

		$this->add_control(
			'trad_woo_product_product_tabs_reviewes_form_btn_hover_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2e3195',
				'selectors' => [
					'.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .form-submit input:hover' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_control(
            'trad_woo_product_product_tabs_reviewes_form_btn_hover_background',
            [
                'label'     => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => "#fff",
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .form-submit input:hover'      => 'background: {{VALUE}};'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'            => 'trad_woo_product_product_tabs_reviewes_form_btn_border_hover',
                'fields_options'  => [
                    'border' 	  => [
                        'default' => 'solid'
                    ],
                    'width'  	  => [
                        'default' 	 => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1',
                            'isLinked' => false
                        ]
                    ],
                    'color' 	  => [
                        'default' => '#2e3195'
                    ]
                ],
				'selector'        => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .form-submit input:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_product_tabs_reviewes_form_btn_box_shadow_hover',
				'selector' => '.woocommerce {{WRAPPER}} .trad-woo-product-details-tabs-box #review_form #respond .form-submit input:hover'
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();	
        $this->end_controls_section();

        $this->start_controls_section(
            'trad_woo_product_product_tabs_reviewes_form_review_style',
            [
                'label' => esc_html__('Review Star', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_product_tabs_reviewes_form_review_typography',
                'selector' => '.woocommerce p.stars a',
                'fields_options'     => [
                    'text_transform' => [
                        'default'    => 'capitalize'
                    ]
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_product_tabs_reviewes_form_review_color',
            [
                'label'     => esc_html__('Star Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#F8FF0E',
                'selectors' => [
                    'p.stars a::before' => 'color: {{VALUE}} !important;',
                    'p.stars.selected a.active::before' => 'color: {{VALUE}} !important;',
                    'p.stars.selected a::before' => 'color: {{VALUE}} !important;',
                    'p.stars a:hover ~ a::before' => 'color: {{VALUE}} !important;',
                    'p.stars:hover a::before' => 'color: {{VALUE}} !important;',
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


    protected function render() {
        if( ! class_exists('woocommerce') ) {
	        return;
        }

		$settings = $this->get_settings_for_display();
		?>

		<div class="trad-woo-product-details-tabs-box <?php echo esc_attr( $settings['trad_woo_product_tabs_box_alignment'] );?>">

                <?php if ( ! empty( $settings['trad_woo_product_tabs_before_text'] ) ) : ?>
                    <p class="trad-woo-product-tabs-before-text" ><?php echo wp_kses_post( $settings['trad_woo_product_tabs_before_text'] );?></p>
				<?php endif; ?>

                <?php 

                if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
                        $product = \Turbo_Addons_Pro\WOOHelper::trad_get_first_woo_product();

                        if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
                            echo '<p>No preview product found.</p>';
                            echo '</div>';
                            return;
                        }

                        global $post;
                        $post = get_post( $product->get_id() );
                        setup_postdata( $post );

                        if ( get_post_type() === 'elementor_library' ) {
                            add_filter( 'the_content', [ $this, 'product_content' ] );
                        }

                        wc_get_template( 'single-product/tabs/tabs.php' );
                        wp_reset_postdata();

                    } else {

                        global $product;
                        $product = wc_get_product();
                        if ( empty( $product ) ) {
                            return;
                        }

                        wc_get_template( 'single-product/tabs/tabs.php' );

						// On render widget from Editor - trigger the init manually.
						if ( wp_doing_ajax() ) {
							?>
							<script>
								jQuery( '.wc-tabs-wrapper, .woocommerce-tabs, #rating' ).trigger( 'init' );
							</script>
							<?php
						}
                    }

                ?>

		</div>

		<?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Tab());
