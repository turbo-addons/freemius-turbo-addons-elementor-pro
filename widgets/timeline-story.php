<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border; 
use Elementor\Group_Control_Background; 


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_Timeline_Story extends Widget_Base {

    public function get_name() {
        return 'trad-timeline-story';
    }

    public function get_title() {
        return esc_html__('Turbo Timeline', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-post-list trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    protected function _register_controls() {

        // Adding the repeater to the widget control
        $this->start_controls_section(
            'timeline_story_content',
            [
                'label' => esc_html__('Timeline Items', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Create a repeater control for multiple timeline items
        $repeater = new Repeater();

        // text alignment//
        $repeater->add_responsive_control(
            'time_line_text_align',
            [
                'label' => esc_html__( 'Text Alignment', 'turbo-addons-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'turbo-addons-elementor' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'turbo-addons-elementor' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'turbo-addons-elementor' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .trad-timeline-story-title'       => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .trad-timeline-story-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Title
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Timeline Title', 'turbo-addons-elementor-pro'),
                'label_block' => true,
            ]
        );

        // Description
        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Timeline Description', 'turbo-addons-elementor-pro'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'media_type',
            [
                'label' => esc_html__('Choose Media Type', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'turbo-addons-elementor-pro'),
                    'icon' => esc_html__('Icon', 'turbo-addons-elementor-pro'),
                ],
            ]
        );

        // Image
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'media_type' => 'image', // Display only if 'image' is selected
                ],
            ]
        );

        $repeater->add_control(
            'image_alignment',
            [
                'label' => __( 'Image Alignment', 'turbo-addons-elementor-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'turbo-addons-elementor-pro' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'turbo-addons-elementor-pro' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'turbo-addons-elementor-pro' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                // 'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .trad-timeline-story-image' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'media_type' => 'image', // Display only if 'image' is selected
                ],
            ]
        );
        

        // Icon Selection Control (conditionally shown if 'Icon' is selected)
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-down', // Default to a down arrow
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'media_type' => 'icon', // Display only if 'icon' is selected
                ],
            ]
        );

       $repeater->add_control(
            'icon_alignment',
            [
                'label' => esc_html__( 'Icon Alignment', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'flex-start',
                'condition' => [
                    'media_type' => 'icon',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .trad-timeline-story-icon' => 'display:flex; justify-content: {{VALUE}};',
                ],
            ]
        );
    
        // Position: Left or Right
        $repeater->add_control(
            'position',
            [
                'label' => esc_html__('Position', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__('Left', 'turbo-addons-elementor-pro'),
                    'right' => esc_html__('Right', 'turbo-addons-elementor-pro'),
                ],
            ]
        );

        // Repeater control to add multiple timeline items
        $this->add_control(
            'timeline_items',
            [
                'label' => esc_html__('Timeline Items', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}', // Display title in repeater
                'default' => [
                    [
                        'title' => esc_html__('First Timeline Event', 'turbo-addons-elementor-pro'),
                        'description' => esc_html__('Description for the first event.', 'turbo-addons-elementor-pro'),
                        'media_type' => 'image',
                        'image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                        'position' => 'left',
                    ],
                    [
                        'title' => esc_html__('Second Timeline Event', 'turbo-addons-elementor-pro'),
                        'description' => esc_html__('Description for the second event.', 'turbo-addons-elementor-pro'),
                        'media_type' => 'icon',
                        'icon' => ['value' => 'fas fa-check'],
                        'position' => 'right',
                    ],
                ],
            ]
        );

       // Show / Hide Arrows
        $this->add_control(
            'show_arrows',
            [
                'label'        => esc_html__( 'Show Arrows', 'turbo-addons-elementor-pro' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Hide', 'turbo-addons-elementor-pro' ),
                'label_off'    => esc_html__( 'Show', 'turbo-addons-elementor-pro' ),
                'return_value' => 'none',
                'default'      => 'block',
                'selectors'    => [
                    '{{WRAPPER}} .trad-left-story-line-temp-one::before'  => 'display: {{VALUE}};',
                    '{{WRAPPER}} .trad-right-story-line-temp-one::before' => 'display: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ========================================Style Section ============================================
        $this->start_controls_section(
            'trad_timeline_container_style',
            [
                'label' => esc_html__('Box', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //padding 
        $this->add_responsive_control(
            'time_line_container_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .trad-timeline-story-line-temp-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Background Group
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'time_line_container_background',
                'label'    => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-timeline-story-line-temp-one',
            ]
        );
        // border//
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'time_line_container_border',
                'selector' => '{{WRAPPER}} .trad-timeline-story-line-temp-one',
            ]
        );
        //border radious
        $this->add_control(
            'time_line_container_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .trad-timeline-story-line-temp-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ------------------------------------content Box style---------------------------
        $this->start_controls_section(
            'trad_timeline_content_style',
            [
                'label' => esc_html__('Content Box', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
         // Background Group
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'time_line_content_box_background',
                'label'    => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-timeline-story-line-temp-one .trad-content-story-line-temp-one',
            ]
        );
        // padding//
        $this->add_responsive_control(
            'time_line_content_box_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .trad-timeline-story-line-temp-one .trad-content-story-line-temp-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //boder
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'time_line_content_box_border',
                'selector' => '{{WRAPPER}} .trad-timeline-story-line-temp-one .trad-content-story-line-temp-one',
            ]
        );
        //border radious
        $this->add_control(
            'time_line_content_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .trad-timeline-story-line-temp-one .trad-content-story-line-temp-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  

        $this->end_controls_section();

        // ----------------------------------------------------------image icon------------------------------------------//
        $this->start_controls_section(
            'trad_timeline_story_image_or_icon',
            [
                'label' => esc_html__('Image or Icon', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
         $this->add_control(
            'trad_image_separator',
            [
                'label'    => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
                'type'     => \Elementor\Controls_Manager::HEADING,
                'separator'=> 'before',
            ]
        );

        $this->add_control(
            'image_width',
            [
                'label' => esc_html__('Image Width', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px', // Default unit
                    'size' => 100, // Default size
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-content-story-line-temp-one img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'image_height',
            [
                'label' => esc_html__('Image Height', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh', '%'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px', // Default unit
                    'size' => 100, // Default size
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-content-story-line-temp-one img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__('Image Border Radius', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px', // Default unit
                    'size' => 10, // Default size
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-content-story-line-temp-one img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'trad_icon_separator',
            [
                'label'    => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
                'type'     => \Elementor\Controls_Manager::HEADING,
                'separator'=> 'before',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#131313ff',
                'selectors' => [
                    '{{WRAPPER}} .trad-timeline-story-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-timeline-story-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
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
                    'size' => 25,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-timeline-story-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .trad-timeline-story-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        //----------------------------------- Typography---------------------------------//

        $this->start_controls_section(
            'trad_timeline_story_typography',
            [
                'label' => esc_html__('Typography', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // -------------title
        $this->add_control(
            'trad_typography_separator',
            [
                'label'    => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
                'type'     => \Elementor\Controls_Manager::HEADING,
                'separator'=> 'before',
            ]
        );
        //margine
        $this->add_responsive_control(
            'trad_timeline_story_title_margin',
            [
                'label' => esc_html__('Title Margin', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .trad-timeline-story-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' =>[
                    'unit'=> 'px',
                    'top'=> '10',
                    'right'=> '0',
                    'bottom'=> '-5',
                    'left'=> '0',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_timeline_story_title_typography', // Unique name for the control
                'label'    => esc_html__( 'Title Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-timeline-story-title',
            ]
        );
        

        $this->add_control(
            'trad_timeline_story_title_color',
            [
                'label' => esc_html__('Title Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1b1b1bff', // Default to white
                'selectors' => [
                    '{{WRAPPER}} .trad-timeline-story-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // -------------description
        $this->add_control(
            'trad_typography_desc_separator',
            [
                'label'    => esc_html__( 'Description', 'turbo-addons-elementor-pro' ),
                'type'     => \Elementor\Controls_Manager::HEADING,
                'separator'=> 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_timeline_story_description_typography', // Unique name for the control
                'label'    => esc_html__( 'Description Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-timeline-story-description',
            ]
        );
    
        $this->add_control(
            'trad_timeline_story_description_color',
            [
                'label' => esc_html__('Description Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#353535ff', // Default to white
                'selectors' => [
                    '{{WRAPPER}} .trad-timeline-story-description' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        //--------------------------------- arrow style-----------------------------------
         $this->start_controls_section(
            'trad_timeline_arrow_style',
            [
                'label' => esc_html__('Arrow', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        // Left item before pseudo-element border color
        $this->add_control(
            'left_before_border_color',
            [
                'label' => esc_html__('Left Arrow Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff', // Default to white
                'selectors' => [
                    '{{WRAPPER}} .trad-left-story-line-temp-one::before' => 'border-color: transparent transparent transparent {{VALUE}};',
                ],
            ]
        );

        // Right item before pseudo-element border color
        $this->add_control(
            'right_before_border_color',
            [
                'label' => esc_html__('Right Arrow Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff', // Default to white
                'selectors' => [
                    '{{WRAPPER}} .trad-right-story-line-temp-one::before' => 'border-color: transparent {{VALUE}} transparent transparent;',
                ],
            ]
        );
        // Arrow vertical position
        $this->add_control(
            'trad_arrow_separator',
            [
                'label'    => esc_html__( 'Virtical Position', 'turbo-addons-elementor-pro' ),
                'type'     => \Elementor\Controls_Manager::HEADING,
                'separator'=> 'before',
            ]
        );
        //virtical position
        $this->add_responsive_control(
            'trad_arrow_vertical_position',
            [
                'label' => esc_html__('Position', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-left-story-line-temp-one::before' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .trad-right-story-line-temp-one::before' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
       


        $this->end_controls_section();


        // ------------------------------------Pointer/Circuler---------------------------
        $this->start_controls_section(
            'trad_timeline_pointer_style',
            [
                'label' => esc_html__('Pointer/Circle', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //size
        $this->add_responsive_control(
            'timeline_pointer_size',
            [
                'label'      => esc_html__('Size', 'turbo-addons-elementor-pro'),
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
                    'size' => 33,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-container-story-line-temp-one::after' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'trad_dot_bg_color',
            [
                'label' => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-timeline-story-line-temp-one .trad-container-story-line-temp-one::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        //--------------border-----------
         $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'timeline_pointer_border',
                'label' => __( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-container-story-line-temp-one::after',
            ]
        );
        //------------ border radious ------
        $this->add_responsive_control(
            'timeline_pointer_border_radious',
            [
                'label'      => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-container-story-line-temp-one::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
         // Box Shadow Group
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'time_line_pointer_box_shadow',
                'label'    => esc_html__('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-container-story-line-temp-one::after',
            ]
        );

        //Pointer position separator header
        $this->add_control(
            'trad_pointer_position_separator',
            [
                'label'    => esc_html__( 'Pointer Position', 'turbo-addons-elementor-pro' ),
                'type'     => \Elementor\Controls_Manager::HEADING,
                'separator'=> 'before',
            ]
        );
        

         $this->add_control(
            'trad_left_dot_position',
            [
                'label' => __( 'Left Dot', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => -16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-timeline-story-line-temp-one .trad-container-story-line-temp-one::after' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'trad_right_dot_position',
            [
                'label' => __( 'Right Dot', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => -16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-timeline-story-line-temp-one .trad-right-story-line-temp-one::after' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    // Pointer vertical position
        $this->add_control(
            'trad_pointer_arrow_separator',
            [
                'label'    => esc_html__( 'Virtical Position', 'turbo-addons-elementor-pro' ),
                'type'     => \Elementor\Controls_Manager::HEADING,
                'separator'=> 'before',
            ]
        );
        //virtical position
        $this->add_responsive_control(
            'trad_pointer_vertical_position',
            [
                'label' => esc_html__('Position', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 6,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-container-story-line-temp-one::after' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // ------------------------------------Line---------------------------
        $this->start_controls_section(
            'trad_timeline_line_style',
            [
                'label' => esc_html__('Line Style', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'trad_timeline_story_vertical_line_width',
            [
                'label' => esc_html__('Line Width', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px', // Default unit
                    'size' => 6, // Default size
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-timeline-story-line-temp-one::after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
         // Background Group
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'card_background',
                'label'    => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-timeline-story-line-temp-one::after',
            ]
        );
        // border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trad_timeline_story_vertical_line_border',
                'label' => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-timeline-story-line-temp-one::after',
            ]
        );

        // border radious
        $this->add_responsive_control(
            'trad_timeline_story_vertical_line_border_radious',
            [
                'label'      => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-timeline-story-line-temp-one::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( !empty( $settings['timeline_items'] ) ) {
            echo '<div class="trad-timeline-story-line-temp-one">';
            foreach ( $settings['timeline_items'] as $index => $item ) {

                // Determine if the container is left or right
                $position_class = $item['position'] == 'left' ? 'trad-container-story-line-temp-one trad-left-story-line-temp-one' : 'trad-container-story-line-temp-one trad-right-story-line-temp-one';

                ?>
                <div class="<?php echo esc_attr( $position_class ); ?> elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                    <div class="trad-content-story-line-temp-one">
                        <?php
                            // Show the image if selected
                            if ( $item['media_type'] == 'image' && !empty( $item['image']['url'] ) ) : ?>
                            <div class="trad-timeline-story-image">
                                <img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
                            </div>
                                
                            <?php
                            // Show the icon if selected
                            elseif ( $item['media_type'] == 'icon' && !empty( $item['icon']['value'] ) ) : ?>
                            <?php 
                                echo '<span class="trad-timeline-story-icon">';
                                    Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
                                echo '</span>';
                            ?>
                        <?php endif; ?>
                            <h2 class="trad-timeline-story-title"><?php echo esc_html( $item['title'] ); ?></h2>
                            <p class="trad-timeline-story-description"><?php echo esc_html( $item['description'] ); ?></p>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
        }
    }

}

// Register widget
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TRAD_Timeline_Story() );
