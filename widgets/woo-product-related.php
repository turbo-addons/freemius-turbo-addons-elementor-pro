<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_WOO_Product_Related extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_related';
    }

    public function get_title() {
        return __('WOO Product Related', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-product-related trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-woo-pro'];
    }

    protected function register_controls() {

        $this->trad_init_content_wc_notice_controls();
        if (!class_exists('woocommerce')) {
            return;
        }

        // Content Section
        $this->start_controls_section(
            'trad_product_related_title_setting_section',
            [
                'label' => __('Title', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'trad_product_related_title_text',
            [
                'label' => esc_html__('Related Products', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Related Products', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'trad_product_related_content_setting_section',
            [
                'label' => __('Layout Settings', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'posts_per_page',
            [
                'label' => __('Products Per Page', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'range' => [
                    'px' => [
                        'max' => 20,
                    ],
                ],
            ]
        );

      $this->add_responsive_control(
        'columns',
        [
            'label' => __('Columns', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
            ],
            'default' => '4',
                'selectors' => [
                    '{{WRAPPER}} ul.products' => 'display: grid; grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
        ]
    );
    $this->add_responsive_control(
        'grid_gap',
        [
            'label' => __('Grid Gap', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 10,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 10,
                ],
            ],
            'default' => [
                'size' => 30,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} ul.products' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

        $this->add_control(
            'orderby',
            [
                'label' => __('Order By', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => __('Date', 'turbo-addons-elementor-pro'),
                    'title' => __('Title', 'turbo-addons-elementor-pro'),
                    'price' => __('Price', 'turbo-addons-elementor-pro'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('Order', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => __('ASC', 'turbo-addons-elementor-pro'),
                    'desc' => __('DESC', 'turbo-addons-elementor-pro'),
                ],
            ]
        );

        //show hide options
        $this->add_control(
            'show_category',
            [
                'label' => __('Show Category', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => __('No', 'turbo-addons-elementor-pro'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_price',
            [
                'label' => __('Show Price', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => __('No', 'turbo-addons-elementor-pro'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label' => __('Show Button', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => __('No', 'turbo-addons-elementor-pro'),
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // ==============================style tab===============================
        //========================================================================

        $this->start_controls_section(
            'trad_product_related_container_style_section',
            [
                'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_related_alignment', 
            [
                'label'         => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
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
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li img' => 'display: inline-block; vertical-align: middle;',
                    '{{WRAPPER}} .woocommerce-loop-summary' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'trad_product_related_container_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .trad-woo-product-related-box .related .products li',
            ]
        );
        
        $this->add_responsive_control(
            'trad_product_related_container_padding',
            [
                'label' => __( 'Padding', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_product_related_container_radius',
            [
                'label' => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trad_product_related_container_border',
                'selector' => '{{WRAPPER}} .trad-woo-product-related-box .related .products li',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'trad_product_related_container_box_shadow',
                'selector' => '{{WRAPPER}} .trad-woo-product-related-box .related .products li',
            ]
        );
        
        $this->end_controls_section();

                $this->start_controls_section(
            'trad_woo_product_related_heading_title_style',
            [
                'label' => __( 'Title', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_related_heading_title_alignment', 
            [
                'label'         => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
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
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related.products > h2' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_woo_product_related_heading_title_typography',
                'selector' => '{{WRAPPER}} .trad-woo-product-related-box .related.products > h2'
            ]
        );
        
        $this->add_control(
            'trad_woo_product_related_heading_title_color',
            [
                'label' => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related.products > h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_related_heading_title_padding',
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
                    '{{WRAPPER}} .trad-woo-product-related-box .related.products > h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->add_responsive_control(
            'trad_woo_product_related_heading_title_margin',
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
                    '{{WRAPPER}} .trad-woo-product-related-box .related.products > h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->end_controls_section();

        // image style controller..///
        $this->start_controls_section(
            'trad_product_related_image_style',
            [
                'label' => __( 'Product Image', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'trad_product_related_image_width',
            [
                'label' => __('Image Width', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'size' => 70,
                    'unit' => '%',
                ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 600,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li img' =>
                        'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'trad_product_related_image_border',
                'label' => __('Image Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-product-related-box .related .products li img',
            ]
        );
        
       $this->add_responsive_control(
            'trad_product_related_image_radius',
            [
                'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 8,
                    'right' => 8,
                    'bottom' => 8,
                    'left' => 8,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li img' =>
                        'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'trad_product_related_image_box_shadow',
                'selector' => '{{WRAPPER}} .trad-woo-product-related-box .related .products li img',
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'trad_product_related_product_title_style',
            [
                'label' => __( 'Product Title', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_product_related_product_title_typography',
                'selector' => '{{WRAPPER}} .trad-woo-product-related-box .related .products li a .woocommerce-loop-product__title',
            ]
        );
        
        $this->add_control(
            'trad_product_related_product_title_color',
            [
                'label' => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li a .woocommerce-loop-product__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_related_title_padding',
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
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li a .woocommerce-loop-product__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_related_title_margin',
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
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li a .woocommerce-loop-product__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'trad_product_related_product_category_style',
            [
                'label' => __( 'Product Category', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                 'condition' => [
                    'show_category' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_product_related_product_category_typography',
                'selector' => '{{WRAPPER}} .trad-woo-product-related-box .trad-woo-product-related-category',
            ]
        );
        
        $this->add_control(
            'trad_product_related_product_category_color',
            [
                'label' => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .trad-woo-product-related-category' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_related_category_padding',
            [
                'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => '5',
                    'right'  => '0',
                    'bottom' => '5',
                    'left'   => '0',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-related-box .trad-woo-product-related-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_related_category_margin',
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
                    '{{WRAPPER}} .trad-woo-product-related-box .trad-woo-product-related-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        //-----------price style-------------

        $this->start_controls_section(
            'trad_product_related_price_style',
            [
                'label' => __( 'Price', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                 'condition' => [
                    'show_price' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_related_price_padding',
            [
                'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => '10',
                    'right'  => '0',
                    'bottom' => '10',
                    'left'   => '0',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_related_price_margin',
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
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
			'trad_woo_product_related_sell_price',
			[
				'label' => __( 'Sell Price', 'turbo-addons-elementor-pro' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

       $this->add_control(
            'trad_woo_product_related_sell_price_color',
            [
                'label'     => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products .price ins' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products .price:not(:has(del))' => 'color: {{VALUE}};', // 🟦 fallback for non-sale prices
                ],
            ]
        );

        // Correct Typography Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_related_sell_price_typography',
                'selector' => 
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products .price ins, 
                    {{WRAPPER}} .trad-woo-product-related-box .related .products .price:not(:has(del))',
            ]
        );

        $this->add_control(
			'trad_woo_product_related_regular_price',
			[
				'label' => __( 'Regular Price', 'turbo-addons-elementor-pro' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'trad_woo_product_related_regular_price_color',
            [
                'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products .price del' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_product_related_regular_price_typography',
                'selector' => '{{WRAPPER}} .trad-woo-product-related-box .related .products .price del',
            ]
        );

        $this->add_control(
            'trad_woo_product_related_regular_price_text_decoration',
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
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products .price del' => 'text-decoration: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_woo_product_related_hide_regular_price',
            [
                'label'        => esc_html__( 'Hide Regular Price', 'turbo-addons-elementor-pro' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Hide', 'turbo-addons-elementor-pro' ),
                'label_off'    => esc_html__( 'Show', 'turbo-addons-elementor-pro' ),
                'return_value' => 'none',
                'default'      => '',
                'selectors'    => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products .price del' => 'display: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'trad_product_related_button_style',
            [
                'label' => __( 'Button', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                 'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs( 'trad_woo_product_related_button_style_tab' );
        //  Controls tab For Normal
        $this->start_controls_tab(
            'trad_woo_product_related_button_style_normal',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_product_related_button_typography',
                'selector' => '{{WRAPPER}} .trad-woo-product-related-box .related .products li .button',
            ]
        );

        $this->add_responsive_control(
            'trad_product_related_button_padding',
            [
                'label' => __( 'Padding', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '10',
                    'right' => '10',
                    'bottom' => '10',
                    'left' => '10',
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_product_related_button_margin',
            [
                'label' => __( 'Margin', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'trad_product_related_button_text_color',
            [
                'label' => __( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li .button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_product_related_button_background_color',
            [
                'label' => __( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li .button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trad_product_related_button_border',
                'selector' => '{{WRAPPER}} .trad-woo-product-related-box .related .products li .button',
            ]
        );

        $this->add_responsive_control(
			'trad_product_related_button_border_radius',
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
					'{{WRAPPER}} .trad-woo-product-related-box .related .products li .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'trad_product_related_button_box_shadow',
                'selector' => '{{WRAPPER}} .trad-woo-product-related-box .related .products li .button',
            ]
        );


        $this->end_controls_tab();

        //  Style tab For Hover
        $this->start_controls_tab(
            'trad_woo_product_related_button_style_hover',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
            'trad_product_related_button_hover_color',
            [
                'label' => __( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li .button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_product_related_button_hover_background',
            [
                'label' => __( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li .button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'trad_woo_product_related_badge_style',
            [
                'label' => __( 'Badge', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_related_badge_position_horizontal',
            [
                'label'   => __('Right', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw' ], // Add desired units
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'range'   => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-related-box .related .products li a span.onsale' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_related_badge_position_vertical',
            [
                'label'   => __('Top', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw' ], // Add desired units
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'range'   => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-related-box .related .products li a span.onsale' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_related_product_badge_height',
            [
                'label'         => esc_html__('Height', 'turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::SLIDER,
                'selectors'     => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-related-box .related .products li a span.onsale' => 'min-height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                ],                
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1
                    ]
                ],
                'default' => [
					'unit' => 'px',
					'size' => 25,
				]
            ]
        );  

        $this->add_responsive_control(
            'trad_woo_product_related_badge_padding',
            [
                'label'         => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,            
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
					'top'       => '10',
					'right'     => '20',
					'bottom'    => '10',
					'left'      => '20',
					'unit'      => 'px',
                    'isLinked'  => false
				],
                'selectors'     => [
                        '.woocommerce {{WRAPPER}} .trad-woo-product-related-box .related .products li a span.onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_related_badge_border_radius',
            [
                'label'         => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'default'    => [
                    'top'      => '10',
                    'right'    => '10',
                    'bottom'   => '10',
                    'left'     => '10',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'selectors'     => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-related-box .related .products li a span.onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_related_badge_text_style',
            [
                'label'     => esc_html__( 'Text', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::HEADING
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'trad_woo_product_related_badge_text_typography',
                'label'     => __( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector'  => '.woocommerce {{WRAPPER}} .trad-woo-product-related-box .related .products li a span.onsale',
            )
        );

        $this->add_control(
            'trad_woo_product_related_badge_text_color',
            [
                'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-related-box .related .products li a span.onsale' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_related_badge_text_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000',
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-related-box .related .products li a span.onsale' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_related_badge_text_display',
            [
                'label'        => esc_html__( 'Hide Badge', 'turbo-addons-elementor-pro' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Hide', 'turbo-addons-elementor-pro' ),
                'label_off'    => esc_html__( 'Show', 'turbo-addons-elementor-pro' ),
                'return_value' => 'none',
                'default'      => 'label_on',
                'selectors'    => [
                    '{{WRAPPER}} .trad-woo-product-related-box .related .products li a span.onsale' => 'display: {{VALUE}};',
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

    public function trad_related_product_title($title) {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['trad_product_related_title_text'])) {
            $title = $settings['trad_product_related_title_text'];
        }

		return $title;
    }

    protected function render_product_related() {
	if ( ! class_exists( 'WooCommerce' ) ) return;

	$settings = $this->get_settings_for_display();

	// ✅ Live: use queried product | Editor: fallback
	if ( ! is_admin() && is_singular( 'product' ) ) {
		$product = wc_get_product( get_queried_object_id() );
	} else {
		$product = \Turbo_Addons_Pro\WOOHelper::trad_get_first_woo_product();
	}

	if ( ! $product ) return;

	// ✅ Get real related product IDs
	$related_ids = wc_get_related_products(
		$product->get_id(),
		$settings['posts_per_page'],
		$product->get_upsell_ids()
	);

	$related_products = [];

	foreach ( $related_ids as $related_id ) {
		$product_obj = wc_get_product( $related_id );
		if ( ! $product_obj || ! $product_obj->is_visible() ) continue;

		$related_products[] = [
			'id'          => $product_obj->get_id(),
			'name'        => $product_obj->get_name(),
			'link'        => get_permalink( $product_obj->get_id() ),
			'image'       => wp_get_attachment_image_url( $product_obj->get_image_id(), 'woocommerce_thumbnail' ),
			'price'       => $product_obj->get_price_html(),
			'is_on_sale'  => $product_obj->is_on_sale(),
		];
	}

	// ✅ Now output HTML (same as before)
	if ( ! empty( $related_products ) ) {
		echo '<div class="trad-woo-product-related-box">';
		echo '<section class="related products">';

		if ( ! empty( $settings['trad_product_related_title_text'] ) ) {
			echo '<h2>' . esc_html( $settings['trad_product_related_title_text'] ) . '</h2>';
		}

		$this->add_render_attribute( 'wrapper', 'class', 'ta-related-products-list' );
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
		echo '<ul class="products">';

		foreach ( $related_products as $related ) {
			?>
			<li class="product type-product">
				<div class="woocommerce-loop-product__wrapper">
					<a href="<?php echo esc_url( $related['link'] ); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
						<?php if ( $related['is_on_sale'] ) : ?>
							<span class="onsale">Sale!</span>
						<?php endif; ?>
						<img src="<?php echo esc_url( $related['image'] ); ?>" alt="<?php echo esc_attr( $related['name'] ); ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />
					</a>
					<div class="woocommerce-loop-summary">
						<?php
						$related_product = wc_get_product( $related['id'] );
						$terms = get_the_terms( $related_product->get_id(), 'product_cat' );

						if ( $settings['show_category'] === 'yes' && $terms && ! is_wp_error( $terms ) ) {
							$first_term = reset( $terms );
							echo '<h3 class="trad-woo-product-related-category">' . esc_html( $first_term->name ) . '</h3>';
						}
						?>

						<a href="<?php echo esc_url( $related['link'] ); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
							<h2 class="woocommerce-loop-product__title"><?php echo esc_html( $related['name'] ); ?></h2>
						</a>

						<?php
						if ( $settings['show_price'] === 'yes' ) {
							echo '<span class="price">' . wp_kses_post( $related['price'] ) . '</span>';
						}

						if ( $settings['show_button'] === 'yes' ) {
							echo '<a href="' . esc_url( $related['link'] ) . '" class="button product_type_simple">';
							esc_html_e( 'Read more', 'turbo-addons-elementor-pro' );
							echo '</a>';
						}
						?>
					</div>
				</div>
			</li>
			<?php
		}

		echo '</ul>';
		echo '</div>'; // .ta-related-products-list
		echo '</section>';
		echo '</div>'; // .trad-woo-product-related-box
	}
}

    

    protected function render() {
        if (!class_exists('woocommerce')) {
            return;
        }

        $settings = $this->get_settings_for_display();

        ?>
        <div class="trad-woo-product-related-box">
            <?php $this->render_product_related(); ?>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Related());
