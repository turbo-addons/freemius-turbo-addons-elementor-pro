<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography; 

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_WOO_Product_Card extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_card';
    }

    public function get_title() {
        return __('WOO Products Card', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-single-product trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-woo-pro'];
    }
    
    protected function register_controls() {

        $this->trad_init_content_wc_notice_controls();
        if ( !class_exists( 'woocommerce' ) ) {
            return;
        }

        // ----------------------------------------  Product list ------------------------------
        $this->start_controls_section(
            'trad_pro_woo_product_content_layout',
            [
                'label' => esc_html__( 'Layout Setting', 'turbo-addons-elementor-pro' ),
            ]
        );



        $this->add_responsive_control(
            'product_columns',
            [
                'label' => esc_html__('Columns', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [''],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 4, // Default 3 columns on desktop
                ],
                'tablet_default' => [
                    'size' => 3, // Default 2 columns on tablet
                ],
                'mobile_default' => [
                    'size' => 1, // Default 1 column on mobile
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-grid' => 'grid-template-columns: repeat({{SIZE}}, minmax(0, 1fr));',
                ],
            ]
        );

        $this->add_control(
            'product_limit',
            [
                'label' => esc_html__( 'Product Limit', 'turbo-addons-elementor-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label_block' => false,
                'default' => 10
            ]
        );


        $this->add_control(
            'product_type',
            [
                'label' => esc_html__( 'Product Type', 'turbo-addons-elementor-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'default' => 'recent_product',
                'options' => [
                    'recent_product' => esc_html__( 'Recent Product', 'turbo-addons-elementor-pro' ),
                    'featured_product' => esc_html__( 'Featured', 'turbo-addons-elementor-pro' ),
                    'on_sale' => esc_html__( 'On Sale', 'turbo-addons-elementor-pro' )
                ]
            ]
        );

        // Fetch all WooCommerce product categories
            $categories = get_terms([
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
            ]);

            $category_options = ['' => esc_html__('All Categories', 'turbo-addons-elementor-pro')];

            if (!empty($categories) && !is_wp_error($categories)) {
                foreach ($categories as $category) {
                    $category_options[$category->slug] = $category->name;
                }
            }

            // Add category filter control
            $this->add_control(
                'product_category',
                [
                    'label' => esc_html__('Product Category', 'turbo-addons-elementor-pro'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => $category_options,
                    'default' => '',
                    'condition' => [
                        'product_type!' => 'featured_product', // Avoid conflict with featured filter
                    ],
                ]
            );

        $this->end_controls_section(); // End content


        // show/off content settings/-----------------/
        $this->start_controls_section(
            'trad_pro_woo_product_content_setting',
            [
                'label' => esc_html__( 'Content Setting', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label' => esc_html__('Show Button', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => esc_html__('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
        'show_category',
        [
            'label' => esc_html__('Show Category', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'turbo-addons-elementor-pro'),
            'label_off' => esc_html__('No', 'turbo-addons-elementor-pro'),
            'return_value' => 'yes',
            'default' => '',
        ]
    );

$this->add_control(
    'show_rating',
    [
        'label' => esc_html__('Show Rating', 'turbo-addons-elementor-pro'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'turbo-addons-elementor-pro'),
        'label_off' => esc_html__('No', 'turbo-addons-elementor-pro'),
        'return_value' => 'yes',
        'default' => '',
    ]
);

$this->add_control(
    'show_sale_price',
    [
        'label' => esc_html__('Show On Sale Price', 'turbo-addons-elementor-pro'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'turbo-addons-elementor-pro'),
        'label_off' => esc_html__('No', 'turbo-addons-elementor-pro'),
        'return_value' => 'yes',
        'default' => '',
    ]
);

        $this->end_controls_section(); // End content

        // ------------Style Tab-----------------------------------------
        //--------------------------------------------------------------------------------------------------


        //card layout
        $this->start_controls_section(
            'trad_pro_woo_product_carousel_style',
            [
                'label' => esc_html__('Poduct Cards', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

          // Text Alignment
          $this->add_responsive_control(
            'woo_content_alignment',
            [
                'label'        => __('Alignment', 'turbo-addons-elementor-pro'),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __('Left', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'      => 'center',
                'selectors'    => [
                    '{{WRAPPER}} 
                    .trad-woo-product-img, 
                    .trad-woo-product-category, 
                    .trad-woo-product-name, 
                    .woocommerce-Price-amount,
                    .trad-woo-product-action,
                    .trad-woo-product-price' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-rating' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_woo_card_padding',
            [
                'label' => __('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 20,
                    'unit' => 'px', // Ensure default unit is set
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // control tabs//
        $this->start_controls_tabs(
			'style_cards_tabs'
		);

		$this->start_controls_tab(
			'style_card_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
			]
		);
        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'product_card_background',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-woo-product-card',
            ]
        );
        $this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
         // Border
         $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_card_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-product-card',
            ]
        );
        // Border Radius
        $this->add_responsive_control(
            'trad_woo_card_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_woo_card_box_shadow',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-product-card',
            ]
        );

		$this->end_controls_tab();

        $this->start_controls_tab(
			'style_card_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
			]
		);
         // Background
         $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'product_card_background_hover',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-woo-product-card:hover',
            ]
        );
        $this->add_control(
			'hr_hover',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
         // Border
         $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_card_border_hover',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-product-card:hover',
            ]
        );
        // Border Radius
        $this->add_responsive_control(
            'trad_woo_card_border_radius_hover',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-card:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_woo_card_box_shadow_hover',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-product-card:hover',
            ]
        );
		$this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section(); // End content


 //---------------------------------------------image style--------------------------------
 $this->start_controls_section(
    'trad_woo_product_list_image_style',
    [
        'label' => esc_html__('Image', 'turbo-addons-elementor-pro'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

 // Image Width Controller
        $this->add_responsive_control(
            'trad_woo_image_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1024,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => '%', // Default unit
                    'size' => 100,   // Default value
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // control tabs//
        $this->start_controls_tabs(
            'image_style_tabs'
        );

        $this->start_controls_tab(
            'style_image_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );

        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_card_image_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-product-img img',
            ]
        );
        // Border Radius
        $this->add_responsive_control(
            'trad_woo_list_image_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_card_image_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );
        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_card_image_border_hover',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-product-img:hover .trad-woo-product-img img',
            ]
        );
        // Border Radius
        $this->add_responsive_control(
            'trad_woo_list_image_border_radius_hover',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-img:hover .trad-woo-product-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section(); // End content

        //-----------------------------typography------------------------
        
        $this->start_controls_section(
            'trad_woo_product_typography_style',
            [
                'label' => esc_html__('Typography', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // -----------------------category----------------------------
        $this->add_control(
			'category_heading_more_options',
			[
				'label' => esc_html__( 'Category', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
                    'show_category' => 'yes',
                ],
			]
		);
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_category_name_typography',
                'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-woo-product-category',
                'condition' => [
                    'show_category' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'trad_category_text_color',
            [
                'label' => esc_html__( 'Text Color','turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-category a' => 'color: {{VALUE}} !important;', 
                ],
                'condition' => [
                    'show_category' => 'yes',
                ],
            ]
        );
        // --------------------------------------product name-------------------
        $this->add_control(
			'product_name_options',
			[
				'label' => esc_html__( 'Product Name', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_name_typography',
                'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-woo-product-name',
            ]
        );

        $this->add_control(
            'trad_product_name_text_color',
            [
                'label' => esc_html__( 'Text Color','turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-name a' => 'color: {{VALUE}} !important;', 
                ],
            ]
        );
        // --------------------------------------Regular Price-------------------
        $this->add_control(
			'regular_price_options',
			[
				'label' => esc_html__( 'Regular Price', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_regular-price_typography',
                'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-woo-regular-price',
            ]
        );

        $this->add_control(
            'trad_regular-price_text_color',
            [
                'label' => esc_html__( 'Text Color','turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff5500',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-regular-price' => 'color: {{VALUE}} !important;', 
                ],
            ]
        );

        // -------------------------------------- Price-------------------
        $this->add_control(
			'price_options',
			[
				'label' => esc_html__( 'Price', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
                
			]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'price_typography',
                'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-woo-sale-price',
            ]
        );

        $this->add_control(
            'price_text_color',
            [
                'label' => esc_html__( 'Text Color','turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-sale-price' => 'color: {{VALUE}} !important;', 
                ],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'trad_pro_woo_product_rating_style', [
                'label' => esc_html__( 'Rating', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_rating' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'trad_pro_woo_product_rating_color',
            [
                'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#E4B500',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-meta .elementor-icon i' => 'color: {{VALUE}};', // Font Awesome or other font-based icons
                    '{{WRAPPER}} .trad-woo-product-meta .elementor-icon svg' => 'fill: {{VALUE}};', // SVG icons
                ],
               
            ]
        );
        $this->add_responsive_control(
            'trad_pro_woo_product_rating_icon_size',
            [
                'label' => esc_html__('Icon Size', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 18,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-meta .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}};', // Font Awesome or other font-based icons
                    '{{WRAPPER}} .trad-woo-product-meta .elementor-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};', // SVG icons
                ],
            ]
        );
        $this->add_responsive_control(
            'trad_pro_woo_product_rating_margin',
            [
                'label' => esc_html__( 'Rating Margin', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'trad_pro_woo_product_rating_padding',
            [
                'label' => esc_html__( 'Rating Padding', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ----------------------------BUTTON STYLE------------------------------
        $this->start_controls_section(
            'trad_woo_product_add_to_card_button_style',
            [
                'label' => esc_html__('Button', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-woo-product_list_btn',
            ]
        );

        //----------------------------width------------------
        $this->add_responsive_control(
            'trad_woo_card_button_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1024,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => '%', // Default unit
                    'size' => 100,   // Default value
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product_list_btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //----------------padding-------------------------
        $this->add_responsive_control(
            'trad_woo_card_button_padding',
            [
                'label' => __('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 10,
                    'right' => 0,
                    'bottom' => 10,
                    'left' => 0,
                    'unit' => 'px', // Ensure default unit is set
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product_list_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // ---------------control tabs//
        $this->start_controls_tabs(
            'add_to_card_btn_style_tabs'
        );

        $this->start_controls_tab(
            'style_addto_cart_btn_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );
        //--------------------------background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'addtocart_background',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-woo-product_list_btn',
            ]
        );
        //--------------------------text color
        $this->add_control(
            'trad_button_text_color',
            [
                'label' => esc_html__( 'Text Color','turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product_list_btn' => 'color: {{VALUE}};', 
                ],
            ]
        );

        // --------------------------Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_addtocart_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-product_list_btn',
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
                    '{{WRAPPER}} .trad-woo-product_list_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_addto_cart_btn_normal_tab_hover',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );
        //--------------------------background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'addtocart_background_hover',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-woo-product_list_btn:hover',
            ]
        );
        //--------------------------text color
        $this->add_control(
            'trad_category_text_color_hover',
            [
                'label' => esc_html__( 'Text Color','turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#555',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product_list_btn:hover' => 'color: {{VALUE}};', 
                ],
            ]
        );

        // --------------------------Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_addtocart_border_hover',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-product_list_btn:hover',
            ]
        );
        // -------------------------Border Radius
        $this->add_responsive_control(
            'trad_addtocart_radius_hover',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product_list_btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section(); // End content

	}


    // -----------------------------------woocommerce plugin warning function
    //---------------------------------------------------------------------------------------------
    protected function trad_init_content_wc_notice_controls() {
		if ( ! class_exists( 'woocommerce' ) ) {
			$this->start_controls_section( 'trad_global_warning', [
				'label' => __( 'Warning!', 'turbo-addons-elementor-pro' ),
			] );
			$this->add_control( 'trad_global_warning_text', [
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( '<strong>WooCommerce</strong> is not installed/activated on your site. Please install and activate <a href="plugin-install.php?s=woocommerce&tab=search&type=term" target="_blank">WooCommerce</a> first.', 'turbo-addons-elementor-pro' ),
				'content_classes' => 'trad-woo-warning',
			] );
			$this->end_controls_section();

			return;
		}
	}
    

    // Render the widget content
    protected function render() {
        $settings = $this->get_settings_for_display();
    
        if ( !class_exists( 'woocommerce' ) ) {
            return;
        }
        ?>
        <div class="trad-woo-product-wrap">
             
            <div class="trad-woo-product-grid">
                <?php
                // Product Query
                $args = array(
                    'limit' => !empty( $settings['product_limit'] ) ? $settings['product_limit'] : 10,
                );
    
                // Featured Product
                if( !empty( $settings['product_type'] ) && $settings['product_type'] == 'featured_product' ) {
                    $args['tax_query'][] = array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                        'operator' => 'IN',
                    );
                }
    
                // On Sale
                if( !empty( $settings['product_type'] ) && $settings['product_type'] == 'on_sale' ) {
                    // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
                    $args['meta_query'] = array(
                        'relation' => 'OR',
                        array( 
                            'key'       => '_sale_price',
                            'value'     => 0,
                            'compare'   => '>',
                            'type'      => 'numeric'
                        ),
                        array(
                            'key'       => '_min_variation_sale_price',
                            'value'     => 0,
                            'compare'   => '>',
                            'type'      => 'numeric'
                        )
                    );
                }

                // Apply Category Filter
                if (!empty($settings['product_category'])) {
                    $args['tax_query'][] = [
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => $settings['product_category'],
                    ];
                }
    
                    $query = new \WC_Product_Query( $args );
                    $products = $query->get_products();
    
                if( !empty( $products ) ):
                    foreach( $products as $product ):
                        $productId = $product->get_id();
                        $productLink = get_permalink( $productId );
                        $sku = $product->get_sku();
                ?>

                <div class="trad-woo-product-card">
                    <!-- Product Image -->
                    <div class="trad-woo-product-img">
                        <?php echo wp_kses_post( $product->get_image() ); ?>
                    </div>
    
                    <!-- Product Details -->
                    <div class="trad-woo-product-details">
                        <?php if (!empty($settings['show_category'])) : ?>
                        <div class="trad-woo-product-category">
                            <?php echo wp_kses_post(wc_get_product_category_list($productId)); ?>
                        </div>  
                        <?php endif; ?>

                        <h6 class="trad-woo-product-name">
                            <a href="<?php echo esc_url($productLink); ?>"><?php echo esc_html($product->get_name()); ?></a>
                        </h6>

                        <div class="trad-woo-product-meta">
        
                            <p class="trad-woo-product-price">
                                <?php 
                                if ($product->is_on_sale()) {
                                    $regular_price = $product->get_regular_price();
                                    $sale_price = $product->get_sale_price();

                                    if (!empty($settings['show_sale_price']) && $regular_price) {
                                        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        echo '<del class="trad-woo-regular-price">' . wc_price($regular_price) . '</del> ';
                                        }
                                        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        echo '<span class="trad-woo-sale-price">' . wc_price($sale_price) . '</span>';
                                    } else {
                                    echo wp_kses_post($product->get_price_html());
                                    }
                                ?>
                            </p>

                            <!-- Rating  style-->
                            <?php if (!empty($settings['show_rating'])) : ?>
                            <div class="trad-woo-product-rating elementor-icon">
                                <?php
                                $rating = $product->get_average_rating();
                                $starRating = '';
                                $j = 0;

                                for ($i = 0; $i < 5; $i++) {
                                $j++;

                                if ($rating >= $j) {
                                    $starRating .= '<span class="trad-woo-product-star">';
                                    \Elementor\Icons_Manager::render_icon(
                                        ['value' => 'fas fa-star', 'library' => 'fa-solid'],
                                        ['aria-hidden' => 'true']
                                        );
                                        $starRating .= '</span>';
                                    } elseif ($rating < $j && $rating > $i) {
                                        $starRating .= '<span class="trad-woo-product-star">';
                                        \Elementor\Icons_Manager::render_icon(
                                            ['value' => 'fas fa-star-half-alt', 'library' => 'fa-solid'],
                                            ['aria-hidden' => 'true']
                                            );
                                     $starRating .= '</span>';
                                    } else {
                                      $starRating .= '<span class="trad-woo-product-star">';
                                        \Elementor\Icons_Manager::render_icon(
                                        ['value' => 'far fa-star', 'library' => 'fa-regular'],
                                        ['aria-hidden' => 'true']
                                        );
                                            $starRating .= '</span>';
                                        }
                                    }
                                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    echo $starRating;
                                    ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- Add to Cart -->
                        <?php if (!empty($settings['show_button'])) : ?>
                        <div class="trad-woo-product-action"> 
                            <?php 
                                if( $product->is_type( 'variable' ) ) {
                                  echo '<a href="'.esc_url( $productLink ).'" class="trad-woo-product_list_btn" data-quantity="1" data-product_id="'.absint($productId).'" data-product_sku="'.esc_attr($sku).'">View Options</a>';
                                } else {
                                  echo '<a href="'.esc_attr( '?add-to-cart='.$productId ).'" class="trad-woo-product_list_btn add_to_cart_button ajax_add_to_cart" data-quantity="1" data-product_id="'.absint($productId).'" data-product_sku="'.esc_attr($sku).'">Add to Cart</a>';
                                }
                            ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                    endforeach;
                 else: 
                    echo '<p>'.esc_html__( 'No product found.', 'turbo-addons-elementor-pro' ).'</p>';
                endif;
                ?>
            </div>
        </div>
    
     <?php
    }
    
}

// Register the widget
Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Card());
