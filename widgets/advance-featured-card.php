<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background; 
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border; 
use Elementor\Utils;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class TRAD_advance_featured_card extends Widget_Base {
    public function get_name() {
        return 'advance-featured-card';
    }

    public function get_title() {
        return esc_html__('Advance Feature Card', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-background trad-icon'; 
    }

    public function get_categories() {
        return ['turbo-addons-pro']; // Change to your desired category
    }
 
    protected function _register_controls() {
        $this->start_controls_section(
            'advance_featured_cardard',
            [
                'label' => __( 'Advance Featured Card', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
            'style_select',
            [
                'label' => esc_html__( 'Select Style', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style-1' => esc_html__( 'style 1', 'turbo-addons-elementor-pro' ),
                    'style-2' => esc_html__( 'style 2', 'turbo-addons-elementor-pro' ),
                ],
                'default' => 'style-1',
            ]
        );

        $this->add_control(
            'trad_advance_featured_card_image',
            [
                'label' => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'trad_advance_featured_card_badge_image',
            [
                'label' => esc_html__( 'Badge', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'  => [
                    'style_select' => 'style-2', // Only show if the switcher is enabled
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'trad_advance_featured_card_badge_title',
            [
                'label' => esc_html__('Title', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Advance Feature Card', 'turbo-addons-elementor-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        //badge text
        $this->add_control(
            'trad_advance_featured_card_badge_text',
            [
                'label' => esc_html__('Badge Text', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Popular', 'turbo-addons-elementor-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
     
        $this->end_controls_section();


        $this->start_controls_section(
            'section_card_link',
            [
                'label' => __('Card Link', 'turbo-addons-elementor-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'card_link_type',
            [
                'label' => __('Link Type', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'custom' => __('Custom URL', 'turbo-addons-elementor-pro'),
                    'site_url' => __('Site URL', 'turbo-addons-elementor-pro'),
                    'post_url' => __('Post URL', 'turbo-addons-elementor-pro'),
                    'home_url' => __('Home Page URL', 'turbo-addons-elementor-pro'),
                    'category_url' => __('Category URL', 'turbo-addons-elementor-pro'),
                ],
                'default' => 'custom',
            ]
        );
        
        $this->add_control(
            'custom_card_link',
            [
                'label' => __('Custom URL', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::URL,
                'condition' => [
                    'card_link_type' => 'custom',
                ],
                'placeholder' => __('https://your-custom-link.com', 'turbo-addons-elementor-pro'),
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );
        
        $this->end_controls_section();

        //--------------------------------------------Style Tab-------------------------------------
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Box', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
         // Responsive Alignment Control
        $this->add_responsive_control(
            'card_content_alignment',
            [
                'label'        => esc_html__('Alignment', 'turbo-addons-elementor-pro'),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'start' => [
                        'title' => esc_html__('Left', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors'    => [
                    '{{WRAPPER}} .trad_advance_features_card_content' => 'align-items: {{VALUE}};', 
                    '{{WRAPPER}} .trad_advance_features_card_content_title' => 'text-align: {{VALUE}};', 
                ],
            ]
        );
         // Padding Control
        $this->add_responsive_control(
            'card_padding',
            [
                'label'      => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
         // Width Control
        $this->add_responsive_control(
            'card_width',
            [
                'label'      => esc_html__('Width', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        // Height Control
        $this->add_responsive_control(
            'card_height',
            [
                'label'      => esc_html__('Height', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs( 'trad_advance_post_filter_style_tab' );
        //  Controls tab For Normal
        $this->start_controls_tab(
            'trad_advance_post_filter_style_normal',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );

        // Background Group
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'card_background',
                'label'    => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_advance_features_card',
            ]
        );

        // Border Group
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'card_border',
                'label'    => esc_html__('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_advance_features_card',
            ]
        );
        
        // Border Radius
        $this->add_responsive_control(
            'card_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Box Shadow Group
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'card_box_shadow',
                'label'    => esc_html__('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_advance_features_card',
            ]
        );
        
        $this->end_controls_tab();
        //  Controls tab For Hover
        $this->start_controls_tab(
            'trad_advance_post_filter_style_hover',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );
        // Background Group (Hover)
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'trad_card_background_hover',
                'label'    => esc_html__('Background (Hover)', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_advance_features_card:hover',
            ]
        );

        // Border Group (Hover)
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trad_card_border_hover',
                'label'    => esc_html__('Border (Hover)', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_advance_features_card:hover',
            ]
        );

        // Border Radius (Hover)
        $this->add_responsive_control(
            'trad_card_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Box Shadow Group (Hover)
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_card_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_advance_features_card:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        //--------------------------------------------image style--------------------------------
        $this->start_controls_section(
            'section_badege_card_image_style',
            [
                'label' => esc_html__('Image Style', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );  
         // Image Margin Control
        $this->add_responsive_control(
            'trad_card_image_margin',
            [
                'label'      => esc_html__('Image Margin', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_content_image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Image Padding Control
        $this->add_responsive_control(
            'trad_card_image_padding',
            [
                'label'      => esc_html__('Image Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_content_image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
         // Image Size (Width) Control
        $this->add_responsive_control(
            'trad_card_image_size_width',
            [
                'label'      => esc_html__('Image Width', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_content_image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->start_controls_tabs( 'trad_advance_post_filter_image_style_tab' );
        
        // Controls tab For Normal
        $this->start_controls_tab(
            'trad_advance_post_filter_image_style_normal',
            [
                'label' => esc_html__('Normal', 'turbo-addons-elementor-pro'),
            ]
        );
        
        // Background Group for Normal
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'trad_card_image_background_normal',
                'label'    => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_advance_features_card_content_image',
            ]
        );

        //image border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trad_card_image_border',
                'label'    => esc_html__('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_advance_features_card_content_image',
            ]
        );
        //border radious
        $this->add_responsive_control(
            'trad_card_image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_content_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Grayscale Filter Switcher
        $this->add_control(
            'trad_card_image_card_filter_grayscale',
            [
                'label'      => esc_html__('Enable Grayscale Filter', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SWITCHER,
                'label_on'   => esc_html__('On', 'turbo-addons-elementor-pro'),
                'label_off'  => esc_html__('Off', 'turbo-addons-elementor-pro'),
                'default'    => '',
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_content_image' => 'filter: grayscale(100%); transition: filter 0.3s ease-in-out;',
                    '{{WRAPPER}} .trad_advance_features_card_content_image:hover' => 'filter: grayscale(0%);',
                ],
            ]
        );
        $this->end_controls_tab();
        
        // Controls tab For Hover
        $this->start_controls_tab(
            'trad_advance_post_filter_image_style_hover',
            [
                'label' => esc_html__('Hover', 'turbo-addons-elementor-pro'),
            ]
        );
         // Background Group for Hover
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'trad_card_image_background_hover',
                'label'    => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_advance_features_card_content_image:hover',
            ]
        );

         //image border hover
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trad_card_image_border_hover',
                'label'    => esc_html__('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_advance_features_card:hover .trad_advance_features_card_content_image',
            ]
        );
        //border radious
        $this->add_responsive_control(
            'trad_card_image_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card:hover .trad_advance_features_card_content_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        
        // Grayscale Normal State Control
        $this->add_control(
            'trad_advance_post_filter_card_filter_grayscale_start',
            [
                'label'      => esc_html__('Grayscale (Normal State)', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range'      => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 100,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_content_image' => 'filter: grayscale({{SIZE}}%); transition: filter 0.3s ease-in-out;',
                ],
                'condition'  => [
                    'trad_card_image_card_filter_grayscale' => 'yes', // Only show if the switcher is enabled
                ],
            ]
        );
        // Grayscale Hover State Control
        $this->add_control(
            'trad_advance_post_filter_card_filter_grayscale_hover',
            [
                'label'      => esc_html__('Grayscale (Hover State)', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range'      => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_content_image:hover' => 'filter: grayscale({{SIZE}}%);',
                ],
                'condition'  => [
                    'trad_card_image_card_filter_grayscale' => 'yes', // Only show if the switcher is enabled
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // ----------------------------------------title style-------------------------------------

        $this->start_controls_section(
            'section_badege_card_title_style',
            [
                'label' => esc_html__('Title Style', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

         // Typography Control for Title (Normal)
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_card_title_typography', // Unique name for the control
                'label'    => esc_html__( 'Title Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_advance_features_card_content_title',
            ]
        );
        //title padding
        $this->add_responsive_control(
            'trad_card_title_padding',
            [
                'label'      => esc_html__('Title Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_content_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->start_controls_tabs( 'trad_advance_post_filter_title_style_tab' );
        
        // Controls tab For Normal
        $this->start_controls_tab(
            'trad_advance_post_filter_title_style_normal',
            [
                'label' => esc_html__('Normal', 'turbo-addons-elementor-pro'),
            ]
        );
        
        // Color Control for Title (Normal)
        $this->add_control(
            'trad_card_title_color',
            [
                'label'     => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad_advance_features_card_content_title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        // Controls tab For Hover
        $this->start_controls_tab(
            'trad_advance_post_filter_title_style_hover',
            [
                'label' => esc_html__('Hover', 'turbo-addons-elementor-pro'),
            ]
            );
        
        // Color Control for Title (Hover)
        $this->add_control(
            'trad_card_title_color_hover',
            [
                'label'     => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad_advance_features_card_content_title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        $this->end_controls_tabs();
        
        $this->end_controls_section();

        $this->start_controls_section(
            'trad_advance_features_card_badge_text_style',
            [
                'label' => esc_html__('Badge Style', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );
        
        // Group Background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'trad_badge_text_background',
                'label'    => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_advance_features_card_badge_text_global',
            ]
        );
        
        // Color
        $this->add_control(
            'trad_badge_text_color',
            [
                'label'     => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad_advance_features_card_badge_text_global' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Typography Control for Title (Normal)
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_card_title_badge_typography', // Unique name for the control
                'label'    => esc_html__( 'Title Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_advance_features_card_badge_text_global',
            ]
        );
        
        // Padding
        $this->add_responsive_control(
            'trad_badge_text_padding',
            [
                'label'      => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_badge_text_global' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Margin
        $this->add_responsive_control(
            'trad_badge_text_margin',
            [
                'label'      => esc_html__('Margin', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_badge_text_global' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Width
        $this->add_responsive_control(
            'trad_badge_text_width',
            [
                'label'      => esc_html__('Width', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 150,  
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_badge_text_global' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Height
        $this->add_responsive_control(
            'trad_badge_text_height',
            [
                'label'      => esc_html__('Height', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 25,  // Default height in px
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_badge_text_global' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        // Border Radius
        $this->add_responsive_control(
            'trad_badge_text_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_badge_text_global' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Rotation (Transform: Rotate)
        $this->add_responsive_control(
            'trad_badge_text_rotation',
            [
                'label'      => esc_html__('Rotation (Degrees)', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [], 
                'range'      => [
                    'px' => [ 
                        'min' => -360,
                        'max' => 360,
                        'step' => 1, 
                    ],
                ],
                'default'    => [
                    'size' => -50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_badge_text_global' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );        
        
        // Horizontal Position (Left and Right)
        $this->add_responsive_control(
            'trad_badge_text_horizontal_position',
            [
                'label'      => esc_html__('Horizontal Position', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'size' => -45,
                    'unit' => 'px',
                ],
                'range'      => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_badge_text_global' => 'left: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Vertical Position (Top and Bottom)
        $this->add_responsive_control(
            'trad_badge_text_vertical_position',
            [
                'label'      => esc_html__('Vertical Position', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'size' => 31,
                    'unit' => 'px',
                ],
                'range'      => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_badge_text_global' => 'top: {{SIZE}}{{UNIT}}; bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        $this->end_controls_section();

        $this->start_controls_section(
            'trad_advance_features_card_badge_logo_style',
            [
                'label' => esc_html__('Badge Image Style', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-2', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_badge_logo_width',
            [
                'label'      => esc_html__('Width', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_badge_image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Background Group
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'trad_badge_text_border_logo_background',
                'label'    => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_advance_features_card',
            ]
        );

        // Border Group
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trad_card_border_logo',
                'label'    => esc_html__('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_advance_features_card_badge_image',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'trad_badge_text_border_logo_radius',
            [
                'label'      => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_badge_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Box Shadow Group
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_badge_text_border_logo_shadow',
                'label'    => esc_html__('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_advance_features_card_badge_image',
            ]
        );

        // Horizontal Position (Left and Right)
        $this->add_responsive_control(
            'trad_badge_logo_horizontal_position',
            [
                'label'      => esc_html__('Horizontal Position', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_badge_image' => 'left: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Vertical Position (Top and Bottom)
        $this->add_responsive_control(
            'trad_badge_logo_vertical_position',
            [
                'label'      => esc_html__('Vertical Position', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'      => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_advance_features_card_badge_image' => 'top: {{SIZE}}{{UNIT}}; bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

       
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
    
        // Get the selected style
        $selected_style = isset($settings['style_select']) ? $settings['style_select'] : 'style-1';
    
        // Get the image and badge data
        $image_upload_for_card = isset($settings['trad_advance_featured_card_image']['url'])
            ? esc_url($settings['trad_advance_featured_card_image']['url'])
            : '';
        $style_badge_image = isset($settings['trad_advance_featured_card_badge_image']['url'])
            ? esc_url($settings['trad_advance_featured_card_badge_image']['url'])
            : '';
        $badge_card_title = !empty($settings['trad_advance_featured_card_badge_title']) ? $settings['trad_advance_featured_card_badge_title'] : '';
        $badge_card_text = !empty($settings['trad_advance_featured_card_badge_text']) ? $settings['trad_advance_featured_card_badge_text'] : 'Popular';
    
        // Determine the link based on the selected type
        $card_link = '#'; // Default fallback URL
        $link_target = '';
        $link_nofollow = '';
    
        switch ($settings['card_link_type']) {
            case 'custom':
                $card_link = !empty($settings['custom_card_link']['url']) ? esc_url($settings['custom_card_link']['url']) : '#';
                $link_target = !empty($settings['custom_card_link']['is_external']) && $settings['custom_card_link']['is_external'] ? ' target="_blank"' : '';
                $link_nofollow = !empty($settings['custom_card_link']['nofollow']) && $settings['custom_card_link']['nofollow'] ? ' rel="nofollow"' : '';
                break;
    
            case 'site_url':
                $card_link = site_url();
                break;
    
            case 'post_url':
                $card_link = get_permalink();
                break;
    
            case 'home_url':
                $card_link = home_url();
                break;
    
            case 'category_url':
                $category = get_the_category();
                if (!empty($category)) {
                    $card_link = get_category_link($category[0]->term_id);
                }
                break;
    
            default:
                $card_link = '#';
                break;
        }
        // Pass the dynamic data to the template
        if ('style-1' === $selected_style) {
            include plugin_dir_path(__FILE__) . '../templates/badge_card/style-1.php';
        } elseif ('style-2' === $selected_style) {
            include plugin_dir_path(__FILE__) . '../templates/badge_card/style-2.php';
        }
    }
}
// Register the widget with Elementor.
Plugin::instance()->widgets_manager->register_widget_type( new TRAD_advance_featured_card() );