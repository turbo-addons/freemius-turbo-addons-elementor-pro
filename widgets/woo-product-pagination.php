<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_WOO_Product_Category_Widget extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_pagination';
    }

    public function get_title() {
        return __('WOO Product Pagination', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-number-field trad-icon';
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
            'section_content',
            [
                'label' => __('Content', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'product_category',
            [
                'label' => __('Select Category', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->trad_get_product_categories(),
                'multiple' => true,
                'default' => 'all', // Set default category to "All"
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Products Per Page', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 50,
                'step' => 1,
                'default' => 4, // Default value
            ]
        );

        $this->add_control(
            'show_pagination_cart_btn',
            [
                'label' => esc_html__('Cart Button', 'turbo-addons-elementor-pro'), 
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'turbo-addons-elementor-pro'),
                'label_off' => esc_html__('Hide', 'turbo-addons-elementor-pro'),
                'return_value' => 'block',  // When ON, it sets display to block
                'default' => '',  // Default is empty to apply initial CSS
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination-cart-btn' => 'display: {{VALUE}} !important;',
                ],
            ]
        );

        // $this->add_control(
        //     'show_pagination_link',
        //     [
        //         'label' => esc_html__('Pagination Button', 'turbo-addons-elementor-pro'), 
        //         'type' => Controls_Manager::SWITCHER,
        //         'label_on' => esc_html__('Show', 'turbo-addons-elementor-pro'),
        //         'label_off' => esc_html__('Hide', 'turbo-addons-elementor-pro'),
        //         'return_value' => 'block',  
        //         'default' => '',  
        //         'selectors' => [
        //             '{{WRAPPER}} .trad-woo-pagination' => 'display: {{VALUE}} !important;',
        //         ],
        //     ]
        // );
        
        $this->end_controls_section();

        // -------------------style tabs----------------------------------------
        //======================================================================
        $this->start_controls_section(
            'box_wrapper_section',
            [
                'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // columns controller box
        $this->add_responsive_control(
            'trad_product_grid_columns',
            [
                'label' => esc_html__('Columns', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'default' => 4,
                'tablet_default' => 3,
                'mobile_default' => 1,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination-product-items' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );
        // background controller..//
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'trad_woo_pagination_product_items_background',
                'label' => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-woo-pagination-product-items',
            ]
        );
        
        // Margin Control
        $this->add_responsive_control(
            'trad_woo_pagination_product_items_margin',
            [
                'label' => esc_html__('Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination-product-items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Padding Control
        $this->add_responsive_control(
            'trad_woo_pagination_product_items_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination-product-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        //================================================image controller====================================
        $this->start_controls_section(
            'trad_img_section',
            [
                'label' => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

         // control tabs//
         $this->start_controls_tabs(
			'trad_style_image_pagination'
		);

		$this->start_controls_tab(
			'style_card_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
			]
		);
      // Image Width (default 100%)
        $this->add_responsive_control(
            'trad_woo_card_image_width',
            [
                'label' => esc_html__('Width', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 1000],
                    '%'  => ['min' => 0, 'max' => 100],
                    'em' => ['min' => 0, 'max' => 50],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination_link_card img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Image Height (optional, no default)
        $this->add_responsive_control(
            'trad_woo_card_image_height',
            [
                'label' => esc_html__('Height', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 1000],
                    '%'  => ['min' => 0, 'max' => 100],
                    'em' => ['min' => 0, 'max' => 50],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination_link_card img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
       
         // Border
         $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_pagination_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-pagination_link_card img',
            ]
        );
        // Border Radius
        $this->add_responsive_control(
            'trad_woo_image_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-pagination_link_card img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_tab();

        // --------------image hover sections----------
        $this->start_controls_tab(
			'trd_astyle_image_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
			]
		);
    
      // Image Width on Hover
        $this->add_responsive_control(
            'trad_woo_card_image_width_hover',
            [
                'label' => esc_html__('Width (Hover)', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 1000],
                    '%'  => ['min' => 0, 'max' => 100],
                    'em' => ['min' => 0, 'max' => 50],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination_link_card:hover img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Image Height on Hover
        $this->add_responsive_control(
            'trad_woo_pagination_image_height_hover',
            [
                'label' => esc_html__('Height (Hover)', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 1000],
                    '%'  => ['min' => 0, 'max' => 100],
                    'em' => ['min' => 0, 'max' => 50],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination_link_card:hover img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

      // Hover Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_image_border_hover',
                'selector' => '{{WRAPPER}} .trad-woo-pagination_link_card:hover img',
            ]
        );

        // Hover Border Radius
        $this->add_responsive_control(
            'trad_woo_image_border_radius_hover',
            [
                'label' => esc_html__('Border Radius (Hover)', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination_link_card:hover img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

         //-----------------------------typography------------------------
        
         $this->start_controls_section(
            'trad_woo_product_pagination_typography_style',
            [
                'label' => esc_html__('Typography', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'trad_woo_pagination_text_align',
            [
                'label' => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination_link_card' => 'text-align: {{VALUE}};', 
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
            ]
        );

        // ----------------------Product Name----------------------------
        $this->add_control(
			'category_pagination_product_name',
			[
				'label' => esc_html__( 'Name', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_pagination_product_typography',
                'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-woo-pagination_link_card h3',
            ]
        );

        $this->add_control(
            'trad_category_text_color',
            [
                'label' => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination_link_card h3' => 'color: {{VALUE}} !important;', 
                ],
            ]
        );
        // --------------------------------------price-------------------
        $this->add_control(
			'product_pagination_product_price',
			[
				'label' => esc_html__( 'Price', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_price_typography',
                'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-woo-pagination_link_card span .woocommerce-Price-amount',
            ]
        );

        $this->add_control(
            'trad_product_price_text_color',
            [
                'label' => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination_link_card span .woocommerce-Price-amount' => 'color: {{VALUE}} !important;', 
                ],
            ]
        );

        $this->end_controls_section();


        //======================================-add to cart button===================================//
       
        $this->start_controls_section(
           'trad_woo_product_pagination_atc',
           [
               'label' => esc_html__('Add To Cart Button', 'turbo-addons-elementor-pro'),
               'tab' => Controls_Manager::TAB_STYLE,
           ]
       );
       $this->add_responsive_control(
        'trad_woo_pagination_alignment',
        [
            'label' => esc_html__('Button Alignment', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => esc_html__('Left', 'turbo-addons-elementor-pro'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'turbo-addons-elementor-pro'),
                    'icon' => 'eicon-text-align-center',
                ],
                'flex-end' => [
                    'title' => esc_html__('Right', 'turbo-addons-elementor-pro'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .trad-woo-product-item-pagination' => 'align-items: {{VALUE}};',
            ],
        ]
    );

       $this->add_responsive_control(
        'trad_woo_product_pagination_atc_width',
        [
            'label' => esc_html__('Width', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000],
                '%'  => ['min' => 0, 'max' => 100],
                'em' => ['min' => 0, 'max' => 50],
            ],
            'default' => [
                'unit' => '%',
                'size' => 50,
            ],
            'selectors' => [
                '{{WRAPPER}} .trad-woo-pagination-cart-btn' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

       $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'trad_woo_pagination_product_atc_typography',
            'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-woo-pagination-cart-btn',
        ]
        );

        $this->add_control(
            'trad_woo_pagination_product_atc_color',
            [
                'label' => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination-cart-btn' => 'color: {{VALUE}} !important;', 
                ],
            ]
        );
         // background controller..//
         $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'trad_woo_pagination_product_atc_background',
                'label' => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-woo-pagination-cart-btn',
            ]
        );
        
        // Margin Control
        $this->add_responsive_control(
            'trad_woo_pagination_product_atc_margin',
            [
                'label' => esc_html__('Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination-cart-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Padding Control
        $this->add_responsive_control(
            'trad_woo_pagination_product_atc_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination-cart-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
         // Border
         $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_pagination_product_atc_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-pagination-cart-btn',
            ]
        );
        // Border Radius
        $this->add_responsive_control(
            'trad_woo_pagination_product_atc_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-pagination-cart-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
       $this->end_controls_section();

        //======================================- Paginations button==================================//
       
        $this->start_controls_section(
            'trad_woo_product_pagination_btn',
            [
                'label' => esc_html__('Pagination', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
         'trad_woo_pagination_button_alignment',
         [
             'label' => esc_html__('Alignment', 'turbo-addons-elementor-pro'),
             'type' => \Elementor\Controls_Manager::CHOOSE,
             'options' => [
                 'flex-start' => [
                     'title' => esc_html__('Left', 'turbo-addons-elementor-pro'),
                     'icon' => 'eicon-text-align-left',
                 ],
                 'center' => [
                     'title' => esc_html__('Center', 'turbo-addons-elementor-pro'),
                     'icon' => 'eicon-text-align-center',
                 ],
                 'flex-end' => [
                     'title' => esc_html__('Right', 'turbo-addons-elementor-pro'),
                     'icon' => 'eicon-text-align-right',
                 ],
             ],
             'default' => 'center',
             'selectors' => [
                 '{{WRAPPER}} .trad-woo-pagination' => 'justify-content: {{VALUE}};',
             ],
         ]
     );
 
        $this->add_responsive_control(
         'trad_woo_product_pagination_number_button_width',
         [
             'label' => esc_html__('Width', 'turbo-addons-elementor-pro'),
             'type' => \Elementor\Controls_Manager::SLIDER,
             'size_units' => ['px', '%', 'em'],
             'range' => [
                 'px' => ['min' => 0, 'max' => 1000],
                 '%'  => ['min' => 0, 'max' => 100],
                 'em' => ['min' => 0, 'max' => 50],
             ],
             'default' => [
                 'unit' => 'px',
                 'size' => 45,
             ],
             'selectors' => [
                 '{{WRAPPER}} .trad-woo-pagination .trad-woo-pagination-link ' => 'width: {{SIZE}}{{UNIT}};',
             ],
         ]
     );


        $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'trad_woo_product_pagination_number_button_typography',
            'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-woo-pagination .trad-woo-pagination-link',
        ]
        );


         // Margin Control
         $this->add_responsive_control(
            'trad_woo_product_pagination_number_button_margin',
            [
                'label' => esc_html__('Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination .trad-woo-pagination-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Padding Control
        $this->add_responsive_control(
            'trad_woo_product_pagination_number_button_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination .trad-woo-pagination-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // ---------control tabs--------------
        $this->start_controls_tabs(
            'trad_woo_pagination_style_tab'
        );

        $this->start_controls_tab(
            'pagination_normal_style_mood',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );
        $this->add_responsive_control(
            'trad_woo_product_pagination_number_button_color',
            [
                'label' => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#222',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination .trad-woo-pagination-link' => 'color: {{VALUE}} !important;', 
                ],
            ]
        );
         // background controller..//
         $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'trad_woo_product_pagination_number_button_background',
                'label' => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-woo-pagination .trad-woo-pagination-link',
            ]
        );
       
         // Border
         $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_product_pagination_number_button_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-pagination .trad-woo-pagination-link',
            ]
        );
        // Border Radius
        $this->add_responsive_control(
            'trad_woo_product_pagination_number_button_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-pagination .trad-woo-pagination-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
 
        $this->end_controls_tab();
        
        // -------active button---------
        $this->start_controls_tab(
            'pagination_active_style_mood',
            [
                'label' => esc_html__( 'Active', 'turbo-addons-elementor-pro' ),
            ]
        );
        $this->add_responsive_control(
            'trad_woo_product_pagination_number_button_color_active',
            [
                'label' => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-pagination .trad-woo-pagination-link.active' => 'color: {{VALUE}} !important;', 
                ],
            ]
        );
         // background controller..//
         $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'trad_woo_product_pagination_number_button_background_active',
                'label' => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-woo-pagination .trad-woo-pagination-link.active',
            ]
        );
         // Border
         $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_product_pagination_number_button_border_active',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-pagination .trad-woo-pagination-link.active',
            ]
        );
        // Border Radius
        $this->add_responsive_control(
            'trad_woo_product_pagination_number_button_radius_active',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-pagination .trad-woo-pagination-link.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    private function trad_get_product_categories() {
        $categories = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);
        $options = ['all' => __('All Categories', 'turbo-addons-elementor-pro')];

        if (!empty($categories) && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                $options[$category->slug] = $category->name;
            }
        }
        return $options;
    }
    
    
        // -----------------------------------woocommerce plugin warning function
    //---------------------------------------------------------------------------------------------
    protected function trad_init_content_wc_notice_controls() {
        if (!class_exists('woocommerce')) {
            $this->start_controls_section('trad_global_warning', [
                'label' => __('Warning!', 'turbo-addons-elementor-pro'),
            ]);
            $this->add_control('trad_global_warning_text', [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('WooCommerce is not installed/activated. Please install and activate <a href="plugin-install.php?s=woocommerce&tab=search&type=term" target="_blank">WooCommerce</a>.', 'turbo-addons-elementor-pro'),
                'content_classes' => 'trad-woo-warning',
            ]);
            $this->end_controls_section();
            return;
        }
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $category = $settings['product_category'] ?? 'all';
        $category_data = is_array($category) ? implode(',', array_map('sanitize_text_field', $category)) : sanitize_text_field($category);

        if (!class_exists('woocommerce')) {
            return;
        }

        $widget_id = $this->get_id();
        $nonce     = wp_create_nonce( 'trad_load_products_nonce' );

        ?>
        <div class="trad-woo-pagination-product-wrapper elementor-element-<?php echo esc_attr($widget_id); ?>"
            data-category="<?php echo esc_attr($category_data); ?>"
            data-posts-per-page="<?php echo esc_attr($settings['posts_per_page']); ?>"
            data-widget-id="<?php echo esc_attr($widget_id); ?>"
            data-nonce="<?php echo esc_attr($nonce); ?>">

            <div class="trad-woo-pagination-product-items"></div>
        </div>

        <div class="trad-woo-pagination-links-wrapper">
            <?php /* ?>
            <div class="trad-woo-pagination" data-show-pagination="<?php echo esc_attr($settings['show_pagination_link']); ?>">
            <?php */ ?>
            <div class="trad-woo-pagination">
                
            </div>
        </div>

        <script>
            jQuery(document).ready(function ($) {
                function loadProducts(page = 1) {
                    const wrapper = $('.trad-woo-pagination-product-wrapper');
                    const rawCategory = wrapper.data('category') || 'all';
                    const category = rawCategory.toString().split(',').filter(Boolean);
                    const postsPerPage = wrapper.data('posts-per-page') || 4;
                    const widgetId = wrapper.closest('.elementor-widget').data('id');
                    const nonce = wrapper.data('nonce');
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo esc_url(admin_url('admin-ajax.php')); ?>",
                        data: {
                            action: 'trad_load_products',
                            security: nonce,
                            category: category,
                            page: page,
                            posts_per_page: postsPerPage,
                            widget_id: widgetId
                        },
                        beforeSend: function () {
                            $('.trad-woo-pagination-product-items').html(`
                                <div class="trad-wooproduct-item-pagination-wrapper-loader">
                                    <div class="trad-wooproduct-item-pagination-outer"></div>
                                    <div class="trad-wooproduct-item-pagination-middle"></div>
                                    <div class="trad-wooproduct-item-pagination-inner"></div>
                                </div>
                            `);
                        },
                        success: function (response) {
                            const parsed = $('<div>').html(response);

                            const itemsWrapper = parsed.find('.trad-woo-product-item-pagination-wrapper');
                            const items = itemsWrapper.length ? itemsWrapper.html() : parsed.find('.trad-woo-product-item-pagination');
                            const pagination = parsed.find('.trad-woo-pagination');

                            $('.trad-woo-pagination-product-items').html(items);
                            $('.trad-woo-pagination').html(pagination);

                            // ✅ Apply display based on original setting
                            const showPagination = $('.trad-woo-pagination').data('show-pagination');
                            if (showPagination === 'block') {
                                $('.trad-woo-pagination').css('display', 'flex');
                            } else {
                                $('.trad-woo-pagination').css('display', 'none');
                            }

                            // ✅ Bind pagination click
                            $('.trad-woo-pagination .trad-woo-pagination-link').off('click').on('click', function (e) {
                                e.preventDefault();
                                const newPage = $(this).data('page');
                                if (newPage) {
                                    loadProducts(newPage);
                                }
                            });
                        }
                    });
                }

                loadProducts(1); // Initial load
            });
        </script>
        <?php
        
    }
    
    
}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Category_Widget());
