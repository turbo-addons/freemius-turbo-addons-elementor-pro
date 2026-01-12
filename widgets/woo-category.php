<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_WOO_Category extends Widget_Base {

    public function get_name() {
        return 'trad_woo_category';
    }

    public function get_title() {
        return __('WOO Category Card', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-product-categories trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-woo-pro'];
    }

    public static function trad_woo_product_categories_fetch() {
        $options = [];
    
        // Get all product categories
        $terms = get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
        ]);
    
        if (!empty($terms) && !is_wp_error($terms)) {
            $options = ['' => esc_html__('Select Category', 'turbo-addons-elementor-pro')];
            foreach ($terms as $term) {
                $options[$term->term_id] = $term->name;
            }
        }
    
        return $options;
    }
    
 
    protected function register_controls() {

        $this->trad_init_content_wc_notice_controls();
        if ( !class_exists( 'woocommerce' ) ) {
            return;
        }

        // ==================start content sections===================================
        //=============================================================================
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'turbo-addons-elementor-pro'),
            ]
        );
        // Count number of categories as products or items
        $this->add_control(
            'count_as_products_or_items',
            [
                'label' => esc_html__('Count as:', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Items',
            ]
        );
        //---------------number of columns-------------

        $this->add_responsive_control(
            'woo_cat_products_columns',
            [
                'label' => esc_html__('Columns', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'min' => 1,
                'max' => 10,
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-category-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_responsive_control(
            'number_of_categories',
            [
                'label'       => esc_html__('Number of Categories to Show', 'turbo-addons-elementor-pro'),
                'type'        => Controls_Manager::NUMBER,
                'min'         => 0,
                'step'        => 1,
                'default'     => 0, // Show all categories
                'description' => esc_html__('Set the number of categories to display. 0 means all categories.', 'turbo-addons-elementor-pro'),
            ]
        );
        
        
        $this->add_control(
            'include_categories',
            [
                'label'       => esc_html__('Include Specific Categories', 'turbo-addons-elementor-pro'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'options'     => self::trad_woo_product_categories_fetch('product'), // Function to get category list
                'multiple'    => true,
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'exclude_categories',
            [
                'label'       => esc_html__('Exclude Specific Categories', 'turbo-addons-elementor-pro'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'options'     => self::trad_woo_product_categories_fetch('product'), // Function to get category list
                'multiple'    => true,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'woo_cat_sort_by',
            [
                'label'   => esc_html__('Sort By', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'name'  => esc_html__('Name', 'turbo-addons-elementor-pro'),
                    'id'    => esc_html__('ID', 'turbo-addons-elementor-pro'),
                    'count' => esc_html__('Product Count', 'turbo-addons-elementor-pro'),
                    'none'  => esc_html__('None', 'turbo-addons-elementor-pro'),
                ],
                'default' => 'name',
            ]
        );
        
        $this->add_control(
            'woo_cat_ass_dess_order_by',
            [
                'label'   => esc_html__('Order By', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => esc_html__('Ascending', 'turbo-addons-elementor-pro'),
                    'DESC' => esc_html__('Descending', 'turbo-addons-elementor-pro'),
                ],
                'default' => 'ASC',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'image_size',
                'default' => 'medium_large',
            ]
        );
        //----------------image show -off on-------------
        $this->add_control(
            'hide_image',
            [
                'label' => esc_html__('Hide Image', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => esc_html__('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_responsive_control(
            'hide_empty',
            [
                'label'        => esc_html__('Hide Empty Categories', 'turbo-addons-elementor-pro'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'turbo-addons-elementor-pro'),
                'label_off'    => esc_html__('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_responsive_control(
            'hide_subcategories',
            [
                'label'        => esc_html__('Hide Subcategories', 'turbo-addons-elementor-pro'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'turbo-addons-elementor-pro'),
                'label_off'    => esc_html__('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->end_controls_section();

    // / ---------------------------------style sections- Box-------------------//
    //============================================================================
        $this->start_controls_section(
            'box_wrapper_section',
            [
                'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Flex Direction Control
        $this->add_responsive_control(
            'flex_direction',
            [
            'label' => __('Direction', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'row' => [
                'title' => __('Row', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-arrow-right',
                ],
                'column' => [
                'title' => __('Column', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-arrow-down',
                ],
                'row-reverse' => [
                'title' => __('Row Reverse', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-arrow-left',
                ],
                'column-reverse' => [
                'title' => __('Column Reverse', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-arrow-up',
                ],
            ],
            'default' => 'row',
            'toggle' => false,
            'selectors' => [
                '{{WRAPPER}} .trad-woo-cat-content-wrapper' => 'flex-direction: {{VALUE}};',
            ],
            ]
        );
        
        // Justify Content Control
        $this->add_responsive_control(
            'justify_content',
            [
            'label' => __('Justify Content', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                'title' => __('Start', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-align-start-h',
                ],
                'center' => [
                'title' => __('Center', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-align-center-h',
                ],
                'flex-end' => [
                'title' => __('End', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-align-end-h',
                ],
                'space-between' => [
                'title' => __('Space Between', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-justify-space-between-h',
                ],
                'space-around' => [
                'title' => __('Space Around', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-justify-space-around-h',
                ],
                'space-evenly' => [
                'title' => __('Space Evenly', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-justify-space-evenly-h',
                ],
            ],
            'default' => 'space-evenly',
            'toggle' => false,
            'selectors' => [
                '{{WRAPPER}} .trad-woo-cat-content-wrapper' => 'justify-content: {{VALUE}};',
            ],
            ]
        );
        
        // Align Items Control
        $this->add_responsive_control(
            'align_items',
            [
            'label' => __('Align Items', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'stretch' => [
                'title' => __('Stretch', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-align-stretch-v',
                ],
                'flex-start' => [
                'title' => __('Start', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-align-start-v',
                ],
                'center' => [
                'title' => __('Center', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-align-center-v',
                ],
                'flex-end' => [
                'title' => __('End', 'turbo-addons-elementor-pro'),
                'icon' => 'eicon-align-end-v',
                ],
            ],
            'default' => 'center',
            'toggle' => false,
            'selectors' => [
                '{{WRAPPER}} .trad-woo-cat-content-wrapper' => 'align-items: {{VALUE}};',
            ],
            ]
        );

        $this->add_responsive_control(
            'trad_pro_woo_category_margin',
            [
                'label' => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-category-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_pro_woo_category_padding',
            [
                'label' => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-category-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // ----------- starts tabs
        $this->start_controls_tabs(
			'style_category_tabs'
		);
        //----------- normal parts//
        $this->start_controls_tab(
			'style_woo_category_tab',
			[
				'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'card_background',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-woo-category-item',
            ]
        );

         // Border
         $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_category_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-category-item',
            ]
        );
        // Border Radius
        $this->add_responsive_control(
            'trad_woo_category_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-category-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_woo_category_box_shadow',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-category-item',
            ]
        );

        $this->end_controls_tab();


        //----------- hover parts//
        $this->start_controls_tab(
			'style_woo_category_tab_hover',
			[
				'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
			]
		);
         // background color//
         $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'card_background_hover',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-woo-category-item:hover',
            ]
        );

         // Border
         $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_woo_category_border_hover',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-category-item:hover',
            ]
        );
        // Border Radius
        $this->add_responsive_control(
            'trad_woo_category_border_radius_hover',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-woo-category-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Box Shadow_hover
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_woo_category_box_shadow_hover',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-woo-category-item:hover',
            ]
        );

        $this->end_controls_tab(); //-----------end hover parts
        $this->end_controls_tabs(); //----------end tabs
        $this->end_controls_section(); //-------end sections

    // =================================features image style======================================
    //=============================================================================================
    $this->start_controls_section(
        'feature_img_section',
        [
            'label' => esc_html__( 'Features Image', 'turbo-addons-elementor-pro' ),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
            'hide_image!' => 'yes', // show section only when image is NOT hidden
        ],
        ]
    );

    // Image Width Controller
    $this->add_responsive_control(
        'trad_woo_cat_fea_image_width',
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
                'unit' => 'px', // Default unit
                'size' => 120,   // Default value
            ],
            'selectors' => [
                '{{WRAPPER}} .trad-woo-category-features-image' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

     // Image Width Controller
     $this->add_responsive_control(
        'trad_woo_cat_fea_image_height',
        [
            'label' => __('Height', 'turbo-addons-elementor-pro'),
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
                'unit' => 'px', // Default unit
                'size' => 120,   // Default value
            ],
            'selectors' => [
                '{{WRAPPER}} .trad-woo-category-features-image' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'trad_pro_woo_category_img_margine',
        [
            'label' => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
            'type' => Controls_Manager::DIMENSIONS,
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .trad-woo-category-features-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'trad_pro_woo_category_img_padding',
        [
            'label' => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
            'type' => Controls_Manager::DIMENSIONS,
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .trad-woo-category-features-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );



    // image border radious
    $this->add_responsive_control(
        'trad_woo_category_img_radius',
        [
            'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .trad-woo-category-features-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );


    $this->end_controls_section(); //-------end sections

// =================================// typography sections======================================
    //=============================================================================================
    $this->start_controls_section(
        'woo_category_typography_section',
        [
            'label' => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_responsive_control(
        'header_name_options',
        [
            'label' => esc_html__( 'Category Name', 'turbo-addons-elementor-pro' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'trad_woo_product_cat_name_typography',
            'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-woo-category-item h4',
        ]
    );

    $this->add_responsive_control(
        'trad_product_name_text_color',
        [
            'label' => esc_html__( 'Text Color','turbo-addons-elementor-pro' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#444',
            'selectors' => [
                '{{WRAPPER}} .trad-woo-category-item h4' => 'color: {{VALUE}} !important;', 
            ],
        ]
    );

    // product count//
    $this->add_responsive_control(
        'header_count_options',
        [
            'label' => esc_html__( 'Item Count', 'turbo-addons-elementor-pro' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'trad_product_count_typography',
            'label'    => __( 'Typography', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-woo-category-item p',
        ]
    );

    // text alignment..//
    $this->add_responsive_control(
        'trad_woo_cat_footer_text_align',
        [
            'label' => esc_html__('Text Align', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => esc_html__('Left', 'turbo-addons-elementor-pro'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'turbo-addons-elementor-pro'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => esc_html__('Right', 'turbo-addons-elementor-pro'),
                    'icon' => 'eicon-text-align-right',
                ],
                'justify' => [
                    'title' => esc_html__('Justify', 'turbo-addons-elementor-pro'),
                    'icon' => 'eicon-text-align-justify',
                ],
            ],
            'default' => 'left',
            'selectors' => [
                '{{WRAPPER}} .trad-woo-cat-footer' => 'text-align: {{VALUE}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'trad_product_count_text_color',
        [
            'label' => esc_html__( 'Text Color','turbo-addons-elementor-pro' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#444',
            'selectors' => [
                '{{WRAPPER}} .trad-woo-category-item p' => 'color: {{VALUE}} !important;', 
            ],
        ]
    );

     // spacing controller//
     $this->add_responsive_control(
        'spacing_between_title_and_text',
        [
            'label' => __('Spacing', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', 'em'],
            'range' => [
                'px' => [
                    'min' => -50,
                    'max' => 100,
                ],
            ],
            'default' => [
                'size' => 0,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .trad-woo-cat-footer p' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    
    $this->end_controls_section(); //-------end sections


    }

    // -----------------------------------woocommerce plugin warning function
    //---------------------------------------------------------------------------------------------
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
        $settings   = $this->get_settings_for_display();

        if (!class_exists('woocommerce')) {
            return;
        }

        $hide_empty            = ($settings['hide_empty'] === 'yes') ? true : false;
        $hide_subcategories    = ($settings['hide_subcategories'] === 'yes');
        $include_categories    = !empty($settings['include_categories']) ? $settings['include_categories'] : [];
        $exclude_categories    = !empty($settings['exclude_categories']) ? $settings['exclude_categories'] : [];
        $number_of_categories  = !empty($settings['number_of_categories']) ? (int) $settings['number_of_categories'] : 0;
        $woo_cat_sort_by       = $settings['woo_cat_sort_by'];
        $woo_cat_ass_dess_order_by = $settings['woo_cat_ass_dess_order_by'];
        $image_size = $settings['image_size'] ?? 'default_size';
        $columns = !empty($settings['woo_cat_products_columns']) ? $settings['woo_cat_products_columns'] : 3;
        $custom_title          = !empty($settings['custom_title']) ? $settings['custom_title'] : '';
        $count_as_products_or_items = $settings['count_as_products_or_items'];

        // Fetch categories
        $categories = get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => $hide_empty,
            'include'    => !empty($include_categories) ? $include_categories : [],
            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- using exclude intentionally
            'exclude'    => !empty($exclude_categories) ? $exclude_categories : [],
            'orderby'    => $woo_cat_sort_by,
            'order'      => $woo_cat_ass_dess_order_by,
        ]);

        if (empty($categories) || is_wp_error($categories)) {
            echo '<p>' . esc_html__('No categories found.', 'turbo-addons-elementor-pro') . '</p>';
            return;
        }

        // Limit the number of categories if a value is set
        if ($number_of_categories > 0) {
            $categories = array_slice($categories, 0, $number_of_categories);
        }

        echo '<div class="trad-woo-category-grid">';

        foreach ($categories as $category) {
            // Skip subcategories if "Hide Subcategories" is enabled
            if ($hide_subcategories && $category->parent != 0) {
                continue;
            }
            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
            $image_url = $thumbnail_id ? Group_Control_Image_Size::get_attachment_image_src($thumbnail_id, 'image_size', $settings) : wc_placeholder_img_src();
            $product_count = $category->count;
            $category_link = get_term_link($category->term_id, 'product_cat');

            echo '<div class="trad-woo-category-item" style="text-align:center;">';
            echo '<a href="' . esc_url($category_link) . '">';
           
            echo '<div class="trad-woo-cat-content-wrapper">';
            
            echo '<div>'; 
            if ( empty($settings['hide_image']) ) {
                echo '<img 
                    class="trad-woo-category-features-image"
                    src="' . esc_url($image_url) . '"
                    alt="' . esc_attr($category->name) . '" 
                    style="max-width:100%;">';
            }
            echo '</div>';

            echo '<div class="trad-woo-cat-footer">'; 
                echo '<h4>' . esc_html($category->name) . '</h4>';
                /* translators: 1: Product count, 2: Label for products/items */
                echo '<p>' . sprintf( esc_html__( '%1$s %2$s', 'turbo-addons-elementor-pro' ), esc_html( $product_count ), esc_html( $count_as_products_or_items ) ) . '</p>';
            echo '</div>';

            echo '</div>';

            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Category());
