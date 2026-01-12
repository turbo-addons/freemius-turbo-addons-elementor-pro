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

class TRAD_WOO_Product_Navigation extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_navigation';
    }

    public function get_title() {
        return __('WOO Product Navigation', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-post-navigation trad-icon';
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
         * Navigation Section
         */
        $this->start_controls_section(
			'trad_woo_product_navigation_content',
			[
				'label' => __( 'Navigation', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

        // Selector: Choose Icon or Text
        $this->add_control(
            'trad_woo_product_navigation_type',
            [
                'label' => __( 'Navigation Type', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'text' => __( 'Text', 'turbo-addons-elementor-pro' ),
                    'icon' => __( 'Icon', 'turbo-addons-elementor-pro' ),
                ],
            ]
        );

        // Prev Text (only show when type = text)
        $this->add_control(
            'trad_woo_product_navigation_prev_text',
            [
                'label' => __( 'Prev Text', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder' => __( 'Prev', 'turbo-addons-elementor-pro' ),
                'default' => __( 'Prev', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'trad_woo_product_navigation_type' => 'text',
                ],
            ]
        );

        // Prev Icon (only show when type = icon)
        $this->add_control(
            'trad_woo_product_navigation_prev_icon',
            [
                'label'       => __( 'Prev Icon', 'turbo-addons-elementor-pro' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'trad_woo_product_navigation_type' => 'icon',
                ],
            ]
        );

        // Next Text (only show when type = text)
        $this->add_control(
            'trad_woo_product_navigation_next_text',
            [
                'label' => __( 'Next Text', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder' => __( 'Next', 'turbo-addons-elementor-pro' ),
                'default' => __( 'Next', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'trad_woo_product_navigation_type' => 'text',
                ],
            ]
        );

        // Next Icon (only show when type = icon)
        $this->add_control(
            'trad_woo_product_navigation_next_text',
            [
                'label'       => __( 'Next Icon', 'turbo-addons-elementor-pro' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'trad_woo_product_navigation_type' => 'icon',
                ],
            ]
        );

        $this->end_controls_section();

		/*
		* Box Styling Section
		*/
        $this->start_controls_section(
            'trad_woo_product_nav_box_style_section',
            [
                'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'trad-woo_product_nav_box_alignment',
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
                    '{{WRAPPER}} .trad-woo-product-navigation' => 'display: flex; justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_nav_box_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-product-nav-box'
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_nav_box_padding',
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
					'{{WRAPPER}} .trad-woo-product-nav-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_nav_box_margin',
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
					'{{WRAPPER}} .trad-woo-product-nav-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'trad_woo_product_nav_box_radius',
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
					'{{WRAPPER}} .trad-woo-product-nav-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'trad_woo_product_nav_box_border',
				'selector' => '{{WRAPPER}} .trad-woo-product-nav-box'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_nav_box_shadow',
				'selector' => '{{WRAPPER}} .trad-woo-product-nav-box'
			]
		);

        $this->end_controls_section();

        /**
		* Style Tab Prev Style
		*/

        $this->start_controls_section(
            'trad_woo_product_navigation_icon_style',
            [
                'label'     => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'trad_woo_product_navigation_type' => 'icon',
                ],
            ]
        );
         
        $this->add_control(
            'trad_woo_product_navigation_icon_size',
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
                    'size' => 16,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-nav-box .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .trad-woo-product-nav-box .elementor-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_navigation_icon_alignment',
            [
                'label'   => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'center',
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
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-navigation-link a.trad-woo-product-prev' => 'display: flex; justify-content: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-navigation-link a.trad-woo-product-next' => 'display: flex; justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'trad_woo_product_navigation_icon_style_tab' );

        //  Controls tab For Normal
        $this->start_controls_tab(
        'trad_woo_product_navigation_icon_style_normal',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
            'trad_woo_product_navigation_icon_color',
            [
                'label' => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-next i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-next svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-prev i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-prev svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        //  Controls tab For Hover
        $this->start_controls_tab(
        'trad_woo_product_navigation_icon_style_hover',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
            'trad_woo_product_navigation_icon_color_hover',
            [
                'label' => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-next:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-next:hover svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-prev:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-prev:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


		$this->start_controls_section(
            'trad_woo_product_navigation_style_nav',
            [
                'label'     => esc_html__( 'Navigation Button', 'turbo-addons-elementor-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'product_nav_padding',
            [
                'label' => __('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_navigation_icon_text_typography',
                'selector' => '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-next span, {{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-prev span',
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_navigation_style_spacing',
            [
                'label'      => __( 'Button Specing', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-navigation-link+.trad-woo-product-navigation-link' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

         $this->start_controls_tabs( 'trad_woo_product_navigation_style_tab' );

        //  Controls tab For Normal
        $this->start_controls_tab(
            'trad_woo_product_navigation_style_normal',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );
        $this->add_control(
            'trad_woo_product_navigation_style_background',
            [
                'label'     => __( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-prev' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-next' => 'background: {{VALUE}};',
                ],
            ]
        );

         $this->add_control(
            'trad_woo_product_navigation_text_color',
            [
                'label'     => __( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eeeeee',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-prev' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-next' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_product_navigation_style_border',
                'label'    => __( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-prev, {{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-next',
            ]
        );

         $this->add_responsive_control(
            'trad_woo_product_navigation_style_radius',
            [
                'label'      => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'      => '5',
                    'right'    => '5',
                    'bottom'   => '5',
                    'left'     => '5',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_woo_product_navigation_style_box_shadow',
                'selector' => '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-prev, {{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-next'
            ]
        );

        $this->end_controls_tab();

        //  Style tab For Hover
        $this->start_controls_tab(
            'trad_woo_product_navigation_style_hover',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
            'trad_woo_product_navigation_style_active_background',
            [
                'label'     => __( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2E3195',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-prev:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-next:hover' => 'background: {{VALUE}};',
                ],
            ]
        );
         $this->add_control(
            'trad_woo_product_navigation_text_color_hover',
            [
                'label'     => __( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-prev:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-next:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_product_navigation_style_active_border_hover',
                'label'    => __( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-prev:hover, {{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-next:hover',
            ]
        );

         $this->add_responsive_control(
            'trad_woo_product_navigation_style_radius_hover',
            [
                'label'      => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'      => '5',
                    'right'    => '5',
                    'bottom'   => '5',
                    'left'     => '5',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-prev:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-next:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_woo_product_navigation_style_box_shadow_hover',
                'selector' => '{{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-prev:hover, {{WRAPPER}} .trad-woo-product-navigation .trad-woo-product-next:hover'
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        $this->start_controls_section(
            'trad_woo_product_navigation_tooltip_image_style_section',
            [
                'label' => __( 'Tooltip', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs( 'trad_woo_product_navigation_tooltip_image_style_tab_start' );

        //  Controls tab For Normal
        $this->start_controls_tab(
            'trad_woo_product_navigation_tooltip_image_style_tab_box',
            [
                'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'trad_woo_product_navigation_tooltip_content_typography',
				'selector'         => '{{WRAPPER}} .trad-woo-product-navigation-link .product-thumbnail h3.product-title',
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
            'trad_woo_product_navigation_tooltip_style_color',
            [
                'label'     => __( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-navigation-link .product-thumbnail .product-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'trad_woo_product_navigation_tooltip_content_background',
                'types'    => [ 'classic', 'gradient' ], 
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => '#fff',
                    ]
                ],
                'selector' => '{{WRAPPER}} .trad-woo-product-navigation-link .product-thumbnail'
            ]
        );

        $this->add_responsive_control(
			'trad_woo_product_navigation_tooltip_text_width',
		    [
                'label' => __( 'Tooltip Width', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
		            'px'       => [
		                'min'  => 0,
		                'max'  => 1000,
		                'step' => 5
		            ],
		            '%'        => [
		                'min'  => 0,
		                'max'  => 100
		            ]
		        ],
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 120
                ],
		        'selectors'    => [
		            '{{WRAPPER}} .trad-woo-product-navigation-link .product-thumbnail' => 'width: {{SIZE}}{{UNIT}};'
		        ]
		    ]
		);

        $this->add_responsive_control(
            'trad_woo_product_navigation_tooltip_text_padding',
            [
                'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => 10,
                    'right'  => 10,
                    'bottom' => 10,
                    'left'   => 10
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-navigation-link .product-thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator'  =>'before'
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_navigation_tooltip_content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'    => 4,
                    'right'  => 4,
                    'bottom' => 4,
                    'left'   => 4
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-navigation-link .product-thumbnail' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px !important;'
                ]
            ]
        );
    
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_woo_product_navigation_tooltip_box_shadow_hover',
                'selector' => '{{WRAPPER}} .trad-woo-product-navigation-link .product-thumbnail'
            ]
        );

        $this->add_control(
            'trad_woo_product_navigation_tooltip_box_prev_position',
            [
                'label'        => __( 'Previous Hover Box Position', 'turbo-addons-elementor-pro' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __( 'Default', 'turbo-addons-elementor-pro' ),
                'label_on'     => __( 'Custom', 'turbo-addons-elementor-pro' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        
        $this->start_popover();

            $this->add_responsive_control(
                'trad_woo_product_navigation_tooltip_box_prev_position_x_offset',
                [
                    'label'      => __( 'X Offset', 'turbo-addons-elementor-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range'      => [
                        'px' => [
                            'min' => -3000,
                            'max' => 3000,
                        ],
                        '%'  => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default'    => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .trad-woo-product-navigation-link.product-prev .product-thumbnail.prev-short-info' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'trad_woo_product_navigation_tooltip_box_prev_position_y_offset',
                [
                    'label'      => __( 'Y Offset', 'turbo-addons-elementor-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range'      => [
                        'px' => [
                            'min' => -3000,
                            'max' => 3000,
                        ],
                        '%'  => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default'    => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .trad-woo-product-navigation-link.product-prev .product-thumbnail.prev-short-info' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_popover();

        $this->add_control(
            'trad_woo_product_navigation_tooltip_box_next_position',
            [
                'label'        => __( 'Next Hover Box Position', 'turbo-addons-elementor-pro' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __( 'Default', 'turbo-addons-elementor-pro' ),
                'label_on'     => __( 'Custom', 'turbo-addons-elementor-pro' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        
        $this->start_popover();

            $this->add_responsive_control(
                'trad_woo_product_navigation_tooltip_box_next_position_x_offset',
                [
                    'label'      => __( 'X Offset', 'turbo-addons-elementor-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range'      => [
                        'px' => [
                            'min' => -3000,
                            'max' => 3000,
                        ],
                        '%'  => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default'    => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .trad-woo-product-navigation-link.product-next .product-thumbnail.next-short-info' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'trad_woo_product_navigation_tooltip_box_next_position_y_offset',
                [
                    'label'      => __( 'Y Offset', 'turbo-addons-elementor-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range'      => [
                        'px' => [
                            'min' => -3000,
                            'max' => 3000,
                        ],
                        '%'  => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default'    => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .trad-woo-product-navigation-link.product-next .product-thumbnail.next-short-info' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_popover();
        $this->end_controls_tab();

        //  Style tab For Hover
        $this->start_controls_tab(
            'trad_woo_product_navigation_tooltip_image_style_tab',
            [
                'label' => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
            ]
        );
        $this->add_responsive_control(
			'trad_woo_product_navigation_tooltip_image_box_radius',
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
                    '{{WRAPPER}} .trad-woo-product-navigation-link .product-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'trad_woo_product_navigation_tooltip_image_box_border',
				'selector' => '{{WRAPPER}} .trad-woo-product-navigation-link .product-thumbnail img',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_navigation_tooltip_image_box_shadow',
				'selector' => '{{WRAPPER}} .trad-woo-product-navigation-link .product-thumbnail img'
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


   protected function render() {

    if ( !class_exists( 'woocommerce' ) ) {
        return;
    }

    $settings = $this->get_settings_for_display();
    $is_editor = \Elementor\Plugin::instance()->editor->is_edit_mode();

    global $product;
    $product = wc_get_product();

    // Fallback: load any product in editor mode
    if ( empty( $product ) && $is_editor ) {
        $product_ids = wc_get_products([
            'limit' => 1,
            'return' => 'ids',
        ]);
        if ( !empty( $product_ids ) ) {
            $product = wc_get_product( $product_ids[0] );
        }
    }

    if ( empty( $product ) ) {
        return;
    }

    if ( $is_editor ) {
        // Load any two other products to simulate prev/next
        $posts = get_posts([
            'post_type' => 'product',
            'numberposts' => 2,
            'orderby' => 'date',
            'order' => 'DESC',
            'post__not_in' => [ $product->get_id() ], // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
        ]);
        $prev_post = $posts[0] ?? null;
        $next_post = $posts[1] ?? null;
    } else {
        $next_post = get_next_post( true, '', 'product_cat' );
        $prev_post = get_previous_post( true, '', 'product_cat' );
    }

    $navigation_next_text = $settings['trad_woo_product_navigation_next_text'] ?? __( 'Next', 'turbo-addons-elementor-pro' );
    $navigation_prev_text = $settings['trad_woo_product_navigation_prev_text'] ?? __( 'Prev', 'turbo-addons-elementor-pro' );

    ?>
    <div class="trad-woo-product-nav-box">
        <ul class="trad-woo-product-navigation">

            <?php if ( $prev_post instanceof WP_Post ): ?>
                <li class="trad-woo-product-navigation-link product-prev">
                    <a class="trad-woo-product-prev elementor-icon" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" aria-label="Previous" tabindex="-1">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['trad_woo_product_navigation_prev_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <?php if ( !empty( $navigation_prev_text ) ) : ?>
                            <span><?php echo esc_html( $navigation_prev_text ); ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown product-thumbnail prev-short-info">
                        <a title="<?php echo esc_html( get_the_title( $prev_post->ID ) ); ?>" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
                            <?php echo get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ); ?>
                            <h3 class="product-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></h3>
                        </a>
                    </div>
                </li>
            <?php endif; ?>

            <?php if ( $next_post instanceof WP_Post ): ?>
                <li class="trad-woo-product-navigation-link product-next">
                    <a class="trad-woo-product-next elementor-icon" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" aria-label="Next" tabindex="-1">
                        <?php if ( !empty( $navigation_next_text ) ) : ?>
                            <span><?php echo esc_html( $navigation_next_text ); ?></span>
                        <?php endif; ?>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['trad_woo_product_navigation_next_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </a>
                    <div class="dropdown product-thumbnail next-short-info">
                        <a title="<?php echo esc_html( get_the_title( $next_post->ID ) ); ?>" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
                            <?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ); ?>
                            <h3 class="product-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></h3>
                        </a>
                    </div>
                </li>
            <?php endif; ?>

        </ul>
    </div>
    <?php
}

}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Navigation());
