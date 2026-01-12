<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Plugin;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_Post_Filter_Tab extends Widget_Base {

    public function get_name() {
        return 'post-filter-tab';
    }

    public function get_title() {
        return __('Post Filter Tab', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-filter trad-icon';
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

        // Repeater control for categories with icons
        $repeater = new Repeater();

        // -------------------add content tab---------------------
        //===============================================================
        $repeater->add_control(
            'category_id',
            [
                'label'       => __('Category', 'turbo-addons-elementor-pro'),
                'type'        => Controls_Manager::SELECT,
                'options'     => $this->get_categories_options(),
                'default'     => $this->get_uncategorized_term_id(),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'category_icon',
            [
                'label'   => __('Category Icon', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'       => __('Categories', 'turbo-addons-elementor-pro'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ category_id }}}',
                'default'     => [
                    [
                        'category_id'  => $this->get_uncategorized_term_id(), // Default to "Uncategorized"
                        'category_icon' => [
                            'value' => 'fas fa-star',
                            'library' => 'solid',
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // -----------------------------------Post Section list --------------------//
        $this->start_controls_section(
            'post_list_settings',
            [
                'label' => __('Post List Settings', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        //---------------number of post-------------------
        //-----------------------------------------------------------------
        $this->add_responsive_control(
            'post_columns',
            [
                'label'       => __('Number of Columns', 'turbo-addons-elementor-pro'),
                'type'        => Controls_Manager::NUMBER,
                'min'         => 1,
                'max'         => 8,
                'step'        => 1,
                'default'     => 3,
                'selectors'   => [
                    '{{WRAPPER}} .trad-post-filter-content-post-list' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );
        
        $this->add_control(
            'post_excerpt_length',
            [
                'label'   => __('Excerpt Length (Words)', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 0,
            ]
        );
        
        $this->add_control(
            'show_featured_image',
            [
                'label'        => __('Show Featured Image', 'turbo-addons-elementor-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off'    => __('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        
        $this->add_control(
            'show_post_date',
            [
                'label'        => __('Show Post Date', 'turbo-addons-elementor-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off'    => __('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        
        $this->add_control(
            'show_read_more',
            [
                'label'        => __('Show Read More Button', 'turbo-addons-elementor-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off'    => __('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        
        $this->end_controls_section();

        // ------------------------------------style tab---------------------------------------
        // ============================================================================================

        // --------------------------------------Content Sections//
        $this->start_controls_section(
            'container_style_section',
            [
                'label' => __('Container Style', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'container_background_color',
            [
                'label'     => __('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .trad-advance-post-filter-container' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'container_flex_direction',
            [
                'label'     => __('Container Direction', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'row'          => __('Row', 'turbo-addons-elementor-pro'),
                    'row-reverse'  => __('Row Reverse', 'turbo-addons-elementor-pro'),
                    'column'       => __('Column', 'turbo-addons-elementor-pro'),
                    'column-reverse' => __('Column Reverse', 'turbo-addons-elementor-pro'),
                ],
                'default'   => 'row',
                'selectors' => [
                    '{{WRAPPER}} .trad-advance-post-filter-container' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        // ---------------------------------------tab section//
        $this->start_controls_section(
            'category_tab-style_section',
            [
                'label' => __('Tab Style', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        // tab width
        $this->add_control(
            'trad_advance_post_filter_tab_width',
            [
                'label'      => __('Tab Width', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-advance-post-filter-left-column' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        
        // --------------------------tab background color///
        $this->add_control(
            'trad_advance_post_filter_tab_background_color',
            [
                'label'     => __('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#D7D5D5',
                'selectors' => [
                    '{{WRAPPER}} .trad-advance-post-filter-left-column' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // --------------------------tab width///
        $this->add_responsive_control(
            'trad_advance_post_filter_tab_width',
            [
                'label'      => __('Tab Width', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-advance-post-filter-left-column' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

         // --------------------------tab directions///
        $this->add_responsive_control(
            'category_tab_direction',
            [
                'label'     => __('Tab Direction', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'row'          => __('Row', 'turbo-addons-elementor-pro'),
                    'row-reverse'  => __('Row Reverse', 'turbo-addons-elementor-pro'),
                    'column'       => __('Column', 'turbo-addons-elementor-pro'),
                    'column-reverse' => __('Column Reverse', 'turbo-addons-elementor-pro'),
                ],
                'default'   => 'column',
                'selectors' => [
                    '{{WRAPPER}} .trad-advance-post-filter-left-column' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        // --------------------------tab button alignment///
        $this->add_control(
            'category_alignment',
            [
                'label'   => __('Button Alignment', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Start', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('End', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'space-between' => [
                        'title' => __('Space Between', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-justify-space-between-h',
                    ],
                    'space-around' => [
                        'title' => __('Space Around', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-justify-space-around-h',
                    ],
                ],
                'default'   => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .trad-advance-post-filter-left-column' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
         // --------------------------tab spacing///
        $this->add_responsive_control(
            'button_spacing',
            [
                'label'      => __('Button Spacing (Gap)', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-advance-post-filter-left-column' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // ---------------------tab section padding///
        $this->add_responsive_control(
            'trad_tab_post_filter_padding',
            [
                'label'      => __('Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'    => 20,
                    'right'  => 20,
                    'bottom' => 20,
                    'left'   => 20,
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-advance-post-filter-left-column' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();   

         // ----------------------------------- -Button Style ---------------------------------------
        // ============================================================================================

        // ------------------------------------Tab section (Button)//
        $this->start_controls_section(
            'tab_button_style_section',
            [
                'label' => __('Tab Button Style', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        // --------------------------------button background color//
        $this->add_control(
            'button_background_color',
            [
                'label'     => __('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .trad-advance-post-filter-left-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // --------------------------------button typography//
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => __('Button Typography', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-advance-post-filter-left-btn',
            ]
        );
         // --------------------------------button text color/
        $this->add_control(
            'button_text_color',
            [
                'label'     => __('Button Text Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .trad-advance-post-filter-left-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        // --------------------------------button icon color/
        $this->add_responsive_control(
            'icon_color',
            [
                'label'     => __('Icon Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#d87403',
                'selectors' => [
                    '{{WRAPPER}} .trad-advance-post-filter-left-btn i' => 'color: {{VALUE}};',
                ],
            ]
        );

        // --------------------------------button padding/
        $this->add_responsive_control(
            'trad_tab_button_post_filter_padding',
            [
                'label'      => __('Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'    => 10,
                    'right'  => 10,
                    'bottom' => 10,
                    'left'   => 10,
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-advance-post-filter-left-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // heading active button
        $this->add_control(
            'heading_active_button',
            [
                'label'     => __('Active Button', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        // selector background color
        $this->add_control(
            'active_button_background_color',
            [
                'label'     => __('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#d87403',
                'selectors' => [
                    '{{WRAPPER}} .trad-advance-post-filter-left-btn.active' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // active button selector color
        $this->add_control(
            'active_button_color',
            [
                'label'     => __('Text Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#d87403',
                'selectors' => [
                    '{{WRAPPER}} .trad-advance-post-filter-left-btn.active' => 'color: {{VALUE}};',
                ],
            ]
        );

         // ---------------------Category button style///
        $this->end_controls_section();    


        // -----------------------------content sections---------------------//
        //=====================================================================

         // ---------------------------------------Post section//
         $this->start_controls_section(
            'category_post_container_section',
            [
                'label' => __('Post Container Section', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        // container width
        $this->add_responsive_control(
            'category_post_container_width',
            [
                'label'      => __('Container Width', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 250,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-advance-post-filter-right-column' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // post card padding//
        $this->add_responsive_control(
            'category_post_container_section_padding',
            [
                'label'      => __('Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'    => 10,
                    'right'  => 10,
                    'bottom' => 10,
                    'left'   => 10,
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-advance-post-filter-right-column' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //container heading typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'section_heading_typography',
                'label'    => __('Section Heading Typography', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-post-filter-content-section-heading',
            ]
        );
         //container heading color
        $this->add_control(
            'section_heading_color',
            [
                'label'     => __('Heading Text Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .trad-post-filter-content-section-heading' => 'color: {{VALUE}};',
                ],
            ]
        );
        //section heading alignment
        $this->add_control(
            'trad_filter_post_section_heading_alignment',
            [
                'label' => __('Section Heading Alignment', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::CHOOSE,
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
                'selectors' => [
                    '{{WRAPPER}} .trad-post-filter-content-section-heading' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();    

        //--------------------------------- post card sections
        // =================================================================================//
        $this->start_controls_section(
            'category_post_container_post_card',
            [
                'label' => __('Post Card Style', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        // card view//
        $this->add_responsive_control(
            'category_post_container_post_card_view',
            [
                'label'     => __('Card View Style', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'row'          => __('Row', 'turbo-addons-elementor-pro'),
                    'row-reverse'  => __('Row Reverse', 'turbo-addons-elementor-pro'),
                    'column'       => __('Column', 'turbo-addons-elementor-pro'),
                    'column-reverse' => __('Column Reverse', 'turbo-addons-elementor-pro'),
                ],
                'default'   => 'column',
                'selectors' => [
                    '{{WRAPPER}} .trad-post-filter-post-item' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        // ----------------------card width//
        $this->add_responsive_control(
            'trad_post_filter_post_item_width',
            [
                'label'      => __('Card Width', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
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
                'default'    => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-post-filter-post-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        // ------------------------card background color//--
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'post_card_background',
                'label' => esc_html__( 'Progress Bar Background', 'turbo-addons-elementor-pro' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .trad-post-filter-post-item',
            ]
        );

        //---------------card padding
        $this->add_responsive_control(
            'category_post_container_section_card_padding',
            [
                'label'      => __('Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-post-filter-post-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section(); 


         // =================================================================================//
         $this->start_controls_section(
            'category_post_container_post_card_image',
            [
                'label' => __('Post Card Image', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        //-----------------------------------feature image width
         $this->add_responsive_control(
            'trad_post_filter_feature_image_width',
            [
                'label'      => __('Fature Img Width', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
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
                'default'    => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-post-filter-post-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'trad_post_filter_feature_image_size',
            [
                'label'   => __('Feature Image Size', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'full',
                'options' => [
                    'thumbnail' => __('Thumbnail', 'turbo-addons-elementor-pro'),
                    'medium'    => __('Medium', 'turbo-addons-elementor-pro'),
                    'large'     => __('Large', 'turbo-addons-elementor-pro'),
                    'full'      => __('Full', 'turbo-addons-elementor-pro'),
                ],
            ]
        );
        
      
        $this->end_controls_section(); 

        // ------------------------post card text section-------------//
        //=====================================================================================
        $this->start_controls_section(
            'category_post_card_text_section',
            [
                'label' => __('Post Card Text Section', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        // text alignment
        $this->add_responsive_control(
            'trad_post_card_text_content_alignment',
            [
                'label'     => __('Text Alignment', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'start' => [
                        'title' => __('Start', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => __('End', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'start',
                'selectors' => [
                    '{{WRAPPER}} .trad-post-filter-post-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );
         // ---------------post card text padding-------------------//
         $this->add_responsive_control(
            'trad_post_card_text_content_padding',
            [
                'label'      => __('Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'    => 10,
                    'right'  => 10,
                    'bottom' => 10,
                    'left'   => 10,
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-post-filter-post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // --------------------Post title-------------------///
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'post_title_heading_typography',
                'label'    => __('Post Title Typography', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-post-filter-post-title',
            ]
        );
        //------------------post title color----------------------
        $this->add_responsive_control(
            'post_title_color',
            [
                'label'     => __('Title Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0e0d0dff',
                'selectors' => [
                    '{{WRAPPER}} .trad-post-filter-post-title' => 'color: {{VALUE}};',
                ],
            ]
        );

         // --------------------Post description typography///
         $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad-post_description_heading_typography',
                'label'    => __('Description Typography', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-post-filter-post-excerpt',
            ]
        );
        //post title color
        $this->add_responsive_control(
            'trad_post_description_color',
            [
                'label'     => __('Description Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .trad-post-filter-post-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

          // --------------------Post date Typography///
          $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_post_filter_date_typography',
                'label'    => __('Date Typography', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-post-filter-post-date',
            ]
        );
        //-----------------------post date color
        $this->add_responsive_control(
            'post_date_color',
            [
                'label'     => __('Date Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad-post-filter-post-date' => 'color: {{VALUE}};',
                ],
            ]
        );

         // -------------------Read More button///
         $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'read_more_typography',
                'label'    => __('Read More Typography', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-post-filter-post-read-more',
            ]
        );
        //-------------------read more text color
        $this->add_responsive_control(
            'trad_post_read_more_button_text_color',
            [
                'label'     => __('Read More Text Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad-post-filter-post-read-more' => 'color: {{VALUE}};',
                ],
            ]
        );
        // read more button background//
        $this->add_control(
            'read_more_background_color',
            [
                'label'     => __('Button Background', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#09186D',
                'selectors' => [
                    '{{WRAPPER}} .trad-post-filter-post-read-more' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_button_padding',
            [
                'label'      => __('Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'    => 7,
                    'right'  => 10,
                    'bottom' => 7,
                    'left'   => 10,
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-post-filter-post-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_button_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-post-filter-post-read-more' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    private function get_categories_options($used_categories = []) {
        $categories = get_terms([
            'taxonomy'   => 'category',
            'hide_empty' => false,
        ]);

        $options = [];
        foreach ($categories as $category) {
            if (!in_array($category->term_id, $used_categories)) {
                $options[$category->term_id] = $category->name;
            }
        }

        return $options;
    }

    private function get_uncategorized_term_id() {
        $term = get_term_by('slug', 'uncategorized', 'category');
        return $term ? $term->term_id : '';
    }
    

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['categories'])) {
            echo '<p>No categories configured.</p>';
            return;
        }

        ?>
        <div class="trad-advance-post-filter-container">
            <div class="trad-advance-post-filter-left-column">
                <?php foreach ($settings['categories'] as $index => $category_data): ?>
                    <a href="#trad-advance-post-filter-content-<?php echo esc_attr($category_data['category_id']); ?>" 
                    class="trad-advance-post-filter-left-btn <?php echo $index === 0 ? 'active' : ''; ?>" 
                    data-text="<?php echo esc_attr(get_term($category_data['category_id'])->name); ?>">
                        <?php if (!empty($category_data['category_icon']['value'])): ?>
                            <span class="trad-advance-post-filter-left-btn_icon">
                                <i class="<?php echo esc_attr($category_data['category_icon']['value']); ?>"></i>
                            </span>
                        <?php endif; ?>
                        <span class="trad-advance-post-filter-left-btn_text">
                            <?php echo esc_html(get_term($category_data['category_id'])->name); ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        
            <div class="trad-advance-post-filter-right-column">
            <?php foreach ($settings['categories'] as $index => $category_data): ?>
                <div id="trad-advance-post-filter-content-<?php echo esc_attr($category_data['category_id']); ?>" 
                    class="trad-post-filter-content-section <?php echo $index === 0 ? 'trad-post-filter-content-active-section' : ''; ?>">
                    <h3 class="trad-post-filter-content-section-heading"><?php echo esc_html(get_term($category_data['category_id'])->name); ?></h3>
                    
                   <div class="trad-post-filter-content-post-list">
    <?php
    // Fetch posts in this category
    $posts = get_posts([
        'category' => $category_data['category_id'],
        'posts_per_page' => -1,
    ]);

    if (!empty($posts)) {
        foreach ($posts as $post) {

            // Fetch post data
            $title   = get_the_title($post->ID);
            $date    = get_the_date('F j, Y', $post->ID);
            $excerpt = wp_trim_words($post->post_content, $settings['post_excerpt_length'], '...');
            $permalink = get_permalink($post->ID);
            ?>

            <div class="trad-post-filter-post-item">

                <?php if ($settings['show_featured_image'] === 'yes') :

                    $image_size   = $settings['trad_post_filter_feature_image_size'];
                    $thumbnail_id = get_post_thumbnail_id($post->ID);

                    if ($thumbnail_id) : ?>
                        <div class="trad-post-filter-post-image">
                            <?php echo wp_get_attachment_image(
                                $thumbnail_id,
                                $image_size,
                                false,
                                [
                                    'class' => 'trad-post-filter-featured-image',
                                    'alt'   => esc_attr($title),
                                ]
                            ); ?>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>


                <div class="trad-post-filter-post-content">
                    <h4 class="trad-post-filter-post-title"><?php echo esc_html($title); ?></h4>

                    <?php if ($settings['show_post_date'] === 'yes'): ?>
                        <div class="trad-post-filter-post-date"><?php echo esc_html($date); ?></div>
                    <?php endif; ?>

                    <div class="trad-post-filter-post-excerpt">
                        <?php 
                        if (!empty($excerpt) && $settings['post_excerpt_length'] !== 0) {
                            echo esc_html($excerpt);
                        }
                        ?>
                    </div>

                    <?php if ($settings['show_read_more'] === 'yes'): ?>
                        <a href="<?php echo esc_url($permalink); ?>" class="trad-post-filter-post-read-more">Read More</a>
                    <?php endif; ?>
                </div>

            </div>

        <?php
        }
    } else {
        echo '<div>No posts found in this category.</div>';
    }
    ?>
</div>


                </div>
            <?php endforeach; ?>
        </div>
           
        </div>
       
       <style>
            .trad-post-filter-content-section {
                display: none;
                opacity: 0;
                transition: opacity 0.8s ease-in-out;
            }
            .trad-post-filter-content-section.trad-post-filter-content-active-section {
                display: block;
                opacity: 1;
            }

            .trad-advance-post-filter-left-btn.active {
                font-weight: bold;
            }

            .trad-advance-post-filter-left-btn i {
                margin-right: 5px;
            }
        </style>
       
        <?php
    }
}

// Register the widget
Plugin::instance()->widgets_manager->register_widget_type(new TRAD_Post_Filter_Tab());
