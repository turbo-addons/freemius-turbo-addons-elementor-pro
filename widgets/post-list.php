<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_Post_list extends Widget_Base {
    
    public function get_name() {
        return 'trad_product_display';
    }

    public function get_title() {
        return __('Post List', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-posts-masonry trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

         // Fetch all categories
         $categories = get_terms([
            'taxonomy'   => 'category',
            'hide_empty' => false,
        ]);

        $options = [];
        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }

       $options = ['all' => __('All Posts', 'turbo-addons-elementor-pro')] + $options;

        $this->add_control(
            'selected_category',
            [
                'label'       => __('Select Category', 'turbo-addons-elementor-pro'),
                'type'        => Controls_Manager::SELECT,
                'options'     => $options,
                'default'     => 'all',
            ]
        );

        $this->add_control(
            'post_limit',
            [
                'label'   => __('Number of Posts to Show', 'turbo-addons-elementor-pro'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
                'default' => 6,
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label' => __('Excerpt Length (Words)', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 5,
                'max' => 300,
                'step' => 2,
                'default' => 20, // Default to 20 words
                'condition' => [
                    'show_description' => 'yes', // Only show if description is enabled
                ],
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label' => __('Read More Button', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Read More', 'turbo-addons-elementor-pro'),
                'placeholder' => __('Read More', 'turbo-addons-elementor-pro'),
                'condition' => [
                    'show_read_more' => 'yes', // Only show when button is enabled
                ],
            ]
        );

        //hr line

        $this->add_control(
            'load_more_text',
            [
                'label' => __('Load More Button', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Load More', 'turbo-addons-elementor-pro'),
                'placeholder' => __('Load More', 'turbo-addons-elementor-pro'),
                'condition' => [
                    'enable_load_more' => 'yes', // Show only if load more is enabled
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_settings',
            [
                'label' => __('Content Settings', 'turbo-addons-elementor-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        //show author name
        $this->add_control(
            'show_post_category_badge',
            [
                'label' => __('Show Badge', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => __('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_date',
            [
                'label' => __('Show Date', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => __('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'yes', // Date will be shown by default
            ]
        );
        
        $this->add_control(
            'show_description',
            [
                'label' => __('Show Description', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => __('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'yes', // Description will be shown by default
            ]
        );

        $this->add_control(
            'show_read_more',
            [
                'label' => __('Show Read More Button', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => __('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'enable_load_more',
            [
                'label' => __('Enable Load More Button', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => __('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        //show author name
        $this->add_control(
            'show_author_name',
            [
                'label' => __('Show Author Name', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => __('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        
        $this->end_controls_section();

      //-----------------------------------style sections--------------------------------------
      //---------------------------------------------------------------------------------------

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __('Layout', 'turbo-addons-elementor-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'columns',
            [
                'label' => __('Columns', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 6,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-product-display' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label' => __('Row Gap', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 20, // Default row gap of 20px
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-product-display' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'column_gap',
            [
                'label' => __('Column Gap', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 20, // Default column gap of 20px
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-product-display' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        // -----------------------------------------Content section------------------------------------------
        $this->start_controls_section(
            'trad-post-list-content-settings',
            [
                'label' => __('Post Card', 'turbo-addons-elementor-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
          //card padding
        $this->add_responsive_control(
            'card_padding',
            [
                'label' => __('Card Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-post-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        // flex direction
        $this->add_responsive_control(
            'flex_direction',
            [
                'label' => __('Flex Direction', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                   'row' => [
                        'title' => __('Row', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-arrow-left',
                    ],
                    'row-reverse' => [
                        'title' => __('Row Reverse', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'column' => [
                        'title' => __('Column', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-arrow-down',
                    ],
                ],
                'default' => 'column',
                'selectors' => [
                    '{{WRAPPER}} .trad-post-list' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );   
        // align items
        $this->add_responsive_control(
            'align_items',
            [
                'label' => __('Top', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Flex Start', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __('Center', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => __('Bottom', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .trad-post-list' => 'align-items: {{VALUE}};',
                ],
                'condition' => [
                    'flex_direction!' => 'column',
                ],
            ]
        );   


        $this->add_control(
            'content_alignment',
            [
                'label' => __('Content Alignment', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .trad-post-list' => 'text-align: {{VALUE}};', // Apply alignment to each card
                ],
            ]
        );
        // item gap
        $this->add_responsive_control(
            'trad_post_item_gap',
            [
                'label' => __('Item Gap', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 20, // Default item gap of 20px
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-post-list' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_post_list_box_radious',
            [
                'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-post-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //----------------------------------- control tabs//
        $this->start_controls_tabs(
			'layout_style_tabs'
		);

		$this->start_controls_tab(
			'layout_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
			]
		);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'trad_post_list_box_background',
                'label' => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
                'types' => [ 'classic', 'gradient' ], // Classic or Gradient background type
                'selector' => '{{WRAPPER}} .trad-post-list',
            ]
        );
    
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trad_post_list_box_border',
                'label' => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-post-list',
            ]
        );
           
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'trad_post_list_box_shadow',
                'label' => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-post-list',
            ]
        );
		$this->end_controls_tab(); // ------------------end normal tab



		$this->start_controls_tab(
			'style_layout_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
			]
		);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'trad_post_list_box_background_hover',
                'label' => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
                'types' => [ 'classic', 'gradient' ], // Classic or Gradient background type
                'selector' => '{{WRAPPER}} .trad-post-list:hover',
            ]
        );
    
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trad_post_list_box_border_hover',
                'label' => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-post-list:hover',
            ]
        );
           
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'trad_post_list_box_shadow_hover',
                'label' => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-post-list:hover',
            ]
        );
		$this->end_controls_tab(); //-------------------end hover tab
		$this->end_controls_tabs();
        $this->end_controls_section();

        // ----------------------------typography----------------------//
        $this->start_controls_section(
            'trad-post-list-typography-settings',
            [
                'label' => __('Typography', 'turbo-addons-elementor-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // -------------------------Title Typography//
        $this->add_control(
			'title_options',
			[
				'label' => esc_html__( 'Post Title', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

        //margine
        $this->add_control(
            'post_title_margin',
            [
                'label' => __('Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_button__typography',
                'label' => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-post-title',
            ]
        );

        $this->add_control(
            'post_title_style_text_color',
            [
                'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000', // Default color
                'selectors' => [
                    '{{WRAPPER}} .trad-post-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        //-------------------descriptions options------------------------
        $this->add_control(
			'descriptions_options',
			[
				'label' => esc_html__( 'Description', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
                'condition' => [
                    'show_description' => 'yes', // Only show when button is enabled
                ],
			]
		);
        // margin//
        $this->add_control(
            'description_margin',
            [
                'label' => __('Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-post-list .trad-post-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_description' => 'yes', // Only show when button is enabled
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'descriptions_typography',
                'label' => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-post-list .trad-post-description',
                'condition' => [
                    'show_description' => 'yes', // Only show when button is enabled
                ],
            ]
        );

        $this->add_control(
            'trad_description_style_text_color',
            [
                'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000', // Default color
                'selectors' => [
                    '{{WRAPPER}} .trad-post-list .trad-post-description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_description' => 'yes', // Only show when button is enabled
                ],
            ]
        );

         //-------------------Date options------------------------
         $this->add_control(
			'date_options',
			[
				'label' => esc_html__( 'Date', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
                'condition' => [
                    'show_date' => 'yes', // Only show when button is enabled
                ],
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_date_typography',
                'label' => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-post-date',
                'condition' => [
                    'show_date' => 'yes', // Only show when button is enabled
                ],
            ]
        );

        $this->add_control(
            'trad_date_style_text_color',
            [
                'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000', // Default color
                'selectors' => [
                    '{{WRAPPER}} .trad-post-date' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_author_name' => 'yes', // Only show when button is enabled
                ],
            ]
        );
         //-------------------  Author  ------------------------
         $this->add_control(
			'trad_author_name_options',
			[
				'label' => esc_html__( 'Author Name', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
                'condition' => [
                    'show_author_name' => 'yes', // Only show when button is enabled
                ],
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_author_typography',
                'label' => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-post-author',
                'condition' => [
                    'show_author_name' => 'yes', // Only show when button is enabled
                ],
            ]
        );

        $this->add_control(
            'trad_author_style_text_color',
            [
                'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000', // Default color
                'selectors' => [
                    '{{WRAPPER}} .trad-post-author' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_author_name' => 'yes', // Only show when button is enabled
                ],
            ]
        );


        $this->end_controls_section();


        //-----------------------------------------image style-------------------------------------
        $this->start_controls_section(
            'section_image_size',
            [
                'label' => __('Image Size', 'turbo-addons-elementor-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'image_size',
            [
                'label' => __('Image Size', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'], // Allow pixel and percentage units
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1920,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-post-feature-image' => 'width: {{SIZE}}{{UNIT}};', // Dynamically apply size
                ],
            ]
        );
        $this->add_responsive_control(
            'trad_post_image_radious',
            [
                'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-post-feature-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        

    //    ------------------------------ Button style sections------------------------------------------
    $this->start_controls_section(
        'post_button_style_section',
        [
            'label' => esc_html__( 'Read More Button', 'turbo-addons-elementor-pro' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_read_more' => 'yes', // Only show when button is enabled
            ],
        ]
    );
    // Button Margin
    $this->add_responsive_control(
        'post_button_margin',
        [
            'label' => esc_html__('Margin', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad-post-read-more-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'default' => [
                'top' => '15',
                'right' => '0',
                'bottom' => '0',
                'left' => '0',
                'unit' => 'px',
            ]
        ]
    ); 
    $this->add_responsive_control(
        'post_button_padding',
        [
            'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad-post-read-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'post_button_button_typography',
            'label' => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-post-read-more-button',
        ]
    );
    

    $this->start_controls_tabs(
        'post_button_style_tabs'
    );

    $this->start_controls_tab(
        'post_button_style_normal_tab',
        [
            'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
        ]
    );

    $this->add_control(
        'post_list_button_text_color',
        [
            'label' => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000', // Default color
            'selectors' => [
                '{{WRAPPER}} .trad-post-read-more-button' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => 'trad_post_read_more_button_background',
            'label' => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
            'types' => [ 'classic', 'gradient' ], // Classic or Gradient background type
            'selector' => '{{WRAPPER}} .trad-post-read-more-button',
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'trad_post_read_more_button_border',
            'label' => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-post-read-more-button',
        ]
    );
       
    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'trad_post_read_more_button_shadow',
            'label' => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-post-read-more-button',
        ]
    );

    $this->add_responsive_control(
        'trad_post_read_more_button_radious',
        [
            'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad-post-read-more-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );


    $this->end_controls_tab(); //------------------------button ends normal tab

    $this->start_controls_tab(
        'post_button_style_hover_tab',
        [
            'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
        ]
    );
    $this->add_control(
        'post_button_text_color_hover',
        [
            'label' => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000', // Default color
            'selectors' => [
                '{{WRAPPER}} .trad-post-read-more-button:hover' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => 'trad_post_read_more_button_background_hover',
            'label' => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
            'types' => [ 'classic', 'gradient' ], // Classic or Gradient background type
            'selector' => '{{WRAPPER}} .trad-post-read-more-button:hover',
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'trad_post_read_more_button_border_hover',
            'label' => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-post-read-more-button:hover',
        ]
    );
       
    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'trad_post_read_more_button_shadow_hover',
            'label' => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-post-read-more-button:hover',
        ]
    );

    $this->add_responsive_control(
        'trad_post_read_more_button_radious_hover',
        [
            'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad-post-read-more-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_tab();  //------------------------button ends hover tab
    $this->end_controls_tabs();
    $this->end_controls_section();



    // --------------------------post load more button style-------------------------------//
    $this->start_controls_section(
        'post_load_button_style_section',
        [
            'label' => esc_html__( 'Load More Button', 'turbo-addons-elementor-pro' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'enable_load_more' => 'yes', // Only show when button is enabled
            ],
        ]
    );
    // button alignment//
    $this->add_responsive_control(
        'load_more_button_alignment',
        [
            'label'        => __('Alignment', 'turbo-addons-elementor-pro'),
            'type'         => \Elementor\Controls_Manager::CHOOSE,
            'options'      => [
                'left' => [
                    'title' => __('Left', 'turbo-addons-elementor-pro'),
                    'icon'  => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'turbo-addons-elementor-pro'),
                    'icon'  => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'turbo-addons-elementor-pro'),
                    'icon'  => 'eicon-text-align-right',
                ],
            ],
            'default'     => 'center',
            'selectors'   => [
                '{{WRAPPER}} .trad-load-more-wrapper' => 'text-align: {{VALUE}};',
            ],
        ]
    );
    // Button Margin
    $this->add_responsive_control(
        'post_load_button_margin',
        [
            'label' => esc_html__('Margin', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad-load-more-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'default' => [
                'top' => '15',
                'right' => '0',
                'bottom' => '0',
                'left' => '0',
                'unit' => 'px',
            ]
        ]
    ); 
    $this->add_responsive_control(
        'post_load_button_padding',
        [
            'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad-load-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'post_load_button_button_typography',
            'label' => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-load-more-button',
        ]
    );
    

    $this->start_controls_tabs(
        'post_load_button_style_tabs'
    );

    $this->start_controls_tab(
        'post_load_button_style_normal_tab',
        [
            'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
        ]
    );

    $this->add_control(
        'post_load_button_text_color',
        [
            'label' => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000', // Default color
            'selectors' => [
                '{{WRAPPER}} .trad-load-more-button' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => 'post_load_button_background',
            'label' => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
            'types' => [ 'classic', 'gradient' ], // Classic or Gradient background type
            'selector' => '{{WRAPPER}} .trad-load-more-button',
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'post_load_button_border',
            'label' => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-load-more-button',
        ]
    );
       
    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'post_load_button_shadow',
            'label' => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-load-more-button',
        ]
    );

    $this->add_responsive_control(
        'post_load_button_radious',
        [
            'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad-load-more-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );


    $this->end_controls_tab(); //------------------------button ends normal tab

    $this->start_controls_tab(
        'post_load_button_style_hover_tab',
        [
            'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
        ]
    );
    $this->add_control(
        'post_load_button_text_color_hover',
        [
            'label' => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000', // Default color
            'selectors' => [
                '{{WRAPPER}} .trad-load-more-button:hover' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => 'post_load_button_read_more_button_background_hover',
            'label' => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
            'types' => [ 'classic', 'gradient' ], // Classic or Gradient background type
            'selector' => '{{WRAPPER}} .trad-load-more-button:hover',
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'post_load_button_read_more_button_border_hover',
            'label' => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-load-more-button:hover',
        ]
    );
       
    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'post_load_button_shadow_hover',
            'label' => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-load-more-button:hover',
        ]
    );

    $this->add_responsive_control(
        'post_load_button_radious_hover',
        [
            'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad-load-more-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_tab();  //------------------------button ends hover tab
    $this->end_controls_tabs();
    $this->end_controls_section();

    //badge
    $this->start_controls_section(
        'badge_style_section',
        [
            'label' => esc_html__('Badge', 'turbo-addons-elementor-pro'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $this->add_responsive_control(
        'badge_alignment',
        [
            'label'   => __('Badge Alignment', 'turbo-addons-elementor-pro'),
            'type'    => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'turbo-addons-elementor-pro'),
                    'icon'  => 'eicon-order-start',
                ],
                'right' => [
                    'title' => __('Right', 'turbo-addons-elementor-pro'),
                    'icon'  => 'eicon-order-end',
                ],
            ],
            'default' => 'right',
            'selectors_dictionary' => [
                'left'  => 'left: 15px; right: auto;',
                'right' => 'right: 15px; left: auto;',
            ],
            'selectors' => [
                '{{WRAPPER}} .trad-post-category-badge' => '{{VALUE}}',
            ],
        ]
    );
    //badge background-color
    $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => 'badge_background',
            'label' => esc_html__('Background', 'turbo-addons-elementor-pro'),
            'types' => [ 'classic', 'gradient' ], // Classic or Gradient background type
            'selector' => '{{WRAPPER}} .trad-post-category-badge',
        ]
    );
    //badge text color
    $this->add_control(
        'badge_text_color',
        [
            'label' => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffffff', // Default color
            'selectors' => [
                '{{WRAPPER}} .trad-post-category-badge' => 'color: {{VALUE}}',
            ],
        ]
    );
    //badge typography
    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'badge_typography',
            'label' => esc_html__('Typography', 'turbo-addons-elementor-pro'),
            'selector' => '{{WRAPPER}} .trad-post-category-badge',
        ]
    );
    //badge padding
    $this->add_responsive_control(
        'badge_padding',
        [
            'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad-post-category-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    //badge border
    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'badge_border',
            'label' => esc_html__('Border', 'turbo-addons-elementor-pro'),
            'selector' => '{{WRAPPER}} .trad-post-category-badge',
        ]
    );
    //badge border-radius
    $this->add_responsive_control(
        'badge_border_radius',
        [
            'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad-post-category-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    //badge box-shadow
    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'badge_box_shadow',
            'label' => __('Box Shadow', 'turbo-addons-elementor-pro'),
            'selector' => '{{WRAPPER}} .trad-post-category-badge',
        ]
    );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $selected_category = $settings['selected_category'];
        $columns = isset($settings['columns']) ? $settings['columns'] : 3;
    
        $show_date = isset($settings['show_date']) && $settings['show_date'] === 'yes';
        $show_description = isset($settings['show_description']) && $settings['show_description'] === 'yes';
        $author = get_the_author();
        $read_more_text = !empty($settings['read_more_text']) ? $settings['read_more_text'] : __('Read More', 'turbo-addons-elementor-pro');
    
        $post_limit = !empty($settings['post_limit']) ? intval($settings['post_limit']) : 6;
        $enable_load_more = !empty($settings['enable_load_more']) && $settings['enable_load_more'] === 'yes';

        $load_more_text = !empty($settings['load_more_text']) ? $settings['load_more_text'] : __('Load More', 'turbo-addons-elementor-pro');

    

        $query_args = [
            'posts_per_page' => $post_limit,
            'post_status'    => 'publish',
        ];

        if ($selected_category !== 'all') {
            $query_args['cat'] = $selected_category;
        }

        $query = new WP_Query($query_args);
    
        // Count total posts for Load More logic
        $total_args = [
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'post_status'    => 'publish', 
        ];

        if ($selected_category !== 'all') {
            $total_args['cat'] = $selected_category;
        }

        $total_query = new WP_Query($total_args);
        $total_posts = $total_query->post_count;
    
        if ($query->have_posts()) {
            $column_class = 'trad-columns-' . esc_attr(is_array($columns) ? $columns['size'] : $columns);
            echo '<div class="trad-product-display ' . esc_attr($column_class) . '">';
    
            while ($query->have_posts()) {
                $query->the_post();
    
                $title = get_the_title();
                $description = get_the_excerpt();
                $image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                $date = get_the_date();
                $categories = get_the_category();
                $primary_cat  = !empty($categories) ? $categories[0]->name : '';
                $primary_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '';

    
                echo '<div class="trad-post-list">';
               
                echo '<div>';
                    if ($image) {
                            echo '<a href="' . esc_url(get_permalink()) . '" class="trad-post-image-link">';
                                echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($title) . '" class="trad-post-feature-image">';
                            echo '</a>';
                        }
                
                    // show_post_category_badge//
                    if (!empty($primary_cat) && $settings['show_post_category_badge'] === 'yes' ) {
                        echo '<a href="' . esc_url($primary_link) . '" class="trad-post-category-badge">' . esc_html($primary_cat) . '</a>';
                    }
                echo '</div>';

                echo '<div class="trad-post-list-content">';
                    echo '<h3 class="trad-post-title">' . esc_html($title) . '</h3>';
                    if ($show_date) {
                        echo '<p class="trad-post-date">' . esc_html($date) . '</p>';
                    }
                
                    if ($settings['show_author_name'] === 'yes') {
                        echo '<p class="trad-post-author">By ' . esc_html($author) . '</p>';
                    }
                    // 

                    if ($show_description) {
                        $excerpt_length = !empty($settings['excerpt_length']) ? intval($settings['excerpt_length']) : 10;
                        $description = wp_trim_words($description, $excerpt_length, '...');
                        echo '<p class="trad-post-description">' . esc_html($description) . '</p>';
                    }
        
                    if (!empty($settings['show_read_more']) && $settings['show_read_more'] === 'yes') {
                        echo '<a href="' . esc_url(get_permalink()) . '" class="trad-post-read-more-button">' . esc_html($read_more_text) . '</a>';
                    }
                echo '</div>';
    
                echo '</div>';
            }
    
            echo '</div>'; // End .trad-product-display
    
            // Show Load More if enabled and more posts exist
            if ($enable_load_more && $total_posts > $post_limit) {
                echo '<div class="trad-load-more-wrapper">';
                    echo '<button class="trad-load-more-button" data-category="' . esc_attr($selected_category) . '" data-limit="' . esc_attr($post_limit) . '">' . esc_html($load_more_text) . '</button>';
                echo '</div>';
            }
            } else {
                echo '<p>' . esc_html__('No posts found in this category.', 'turbo-addons-elementor-pro') . '</p>';
            }
    
        wp_reset_postdata();
    }
    
    
}

// Register the widget
Plugin::instance()->widgets_manager->register_widget_type(new TRAD_Post_list());
