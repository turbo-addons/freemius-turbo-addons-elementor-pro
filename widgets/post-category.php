<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography; 
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_Post_Category extends Widget_Base {

    public function get_name() {
        return 'trad_category_wise_post_count';
    }

    public function get_title() {
        return __('Post Category', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-my-account trad-icon';
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

        $this->add_control(
            'selected_category',
            [
                'label'       => __('Select Category', 'turbo-addons-elementor-pro'),
                'type'        => Controls_Manager::SELECT,
                'options'     => $options,
                'default'     => key($options),
            ]
        );

        // Show/Hide Category
        $this->add_control(
            'trad_category_show_post_text',
            [
                'label' => __('Show Category', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'turbo-addons-elementor-pro'),
                'label_off' => __('Hide', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'post_available_text',
            [
                'label' => __('Text after number', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Post Available', 'turbo-addons-elementor-pro'),
                'description' => __('Enter the text to display after the post count.', 'turbo-addons-elementor-pro'),
            ]
        );

        // Show/Hide Product Count
        $this->add_control(
            'trad_category_post_show_count_text',
            [
                'label' => __('Show Post Count', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'turbo-addons-elementor-pro'),
                'label_off' => __('Hide', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();

         //-----image----
         $this->start_controls_section(
            'trad_post_category_image',
            [
                'label' => __('Image', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        //--show hide image
        $this->add_control(
            'trad_category_show_image',
            [
                'label' => __('Show Image', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'turbo-addons-elementor-pro'),
                'label_off' => __('Hide', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
         $this->add_control(
            'uploaded_image',
            [
                'label'     => __('Upload Image', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'trad_category_show_image' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
        
        //button
         $this->start_controls_section(
            'trad_post_category_button',
            [
                'label' => __('Button', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
          $this->add_control(
            'trad_category_post_count_show_button',
            [
                'label' => __('Show Button', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => __('No', 'turbo-addons-elementor-pro'),
                'default' => 'yes',
                'description' => __('Enable to show a button below the post count', 'turbo-addons-elementor-pro'),
            ]
        );

        // Button Text Control
        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('See All Post', 'turbo-addons-elementor-pro'),
                'condition' => [
                    'trad_category_post_count_show_button' => 'yes',
                ],
            ]
        );

        // Button Link Type
        $this->add_control(
            'button_link_type',
            [
                'label' => __('Link Type', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __('Default (Category Archive)', 'turbo-addons-elementor-pro'),
                    'custom'  => __('Custom URL', 'turbo-addons-elementor-pro'),
                ],
                'condition' => [
                    'trad_category_post_count_show_button' => 'yes',
                ],
            ]
        );

         // Button Link Control (only visible when Custom is selected)
        $this->add_control(
            'button_link',
            [
                'label' => __('Custom Button Link', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'turbo-addons-elementor-pro'),
                'condition' => [
                    'trad_category_post_count_show_button' => 'yes',
                    'button_link_type' => 'custom',
                ],
            ]
        );

        $this->end_controls_section();

        // ---------------------------------------------style section------------------------------------
        // =================================================================================================//

        $this->start_controls_section(
            'container_style_section',
            [
                'label' => esc_html__('Card', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
         // Padding Control
        $this->add_responsive_control(
            'trad_category_post_count_card_padding',
            [
                'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad_category_post_count_card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //------flex derection----choose
          $this->add_responsive_control(
            'flex_direction',
            [
                'label' => __('Image Direction', 'turbo-addons-elementor-pro'),
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
                'default' => 'row',
                'selectors' => [
                    '{{WRAPPER}} .trad_category_post_count_card' => 'flex-direction: {{VALUE}};',
                ],
            ]
        ); 
        // align items
        $this->add_responsive_control(
            'trad_category_post_count_card_align',
            [
                'label' => esc_html__('Alignment', 'turbo-addons-elementor-pro'),
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
                    'end' => [
                        'title' => esc_html__('Right', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_category_post_count_card' => 'align-items: {{VALUE}};',
                ],
            ]
        );

       $this->add_responsive_control(
            'content_row_img_gap',
            [
                'label' => __('Gap', 'turbo-addons-elementor-pro'),
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
                    'size' => 15, // Default row gap of 20px
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_category_post_count_card' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'trad_category_post_count_card_background',
                'label' => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
                'types' => [ 'classic', 'gradient' ], 
                'selector' => '{{WRAPPER}} .trad_category_post_count_card',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'trad_category_post_count_card_shadow',
                'label' => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_category_post_count_card',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trad_category_post_count_card_border',
                'label' => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_category_post_count_card',
            ]
        );
        $this->end_controls_section();

        //----------------------------------------image section-------------------------------------
        $this->start_controls_section(
            'image_style_section',
            [
                'label' => esc_html__('Image Section', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'trad_category_post_count_image_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_category_post_count_card_img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_category_post_count_image_border_radius',
            [
                'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_category_post_count_card_img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // --------------------------------typography style--------------------------
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__('Content Section', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
         // align items
        $this->add_responsive_control(
            'trad_category_post_content_text_align',
            [
                'label' => esc_html__('Alignment', 'turbo-addons-elementor-pro'),
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
                    'end' => [
                        'title' => esc_html__('Right', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_category_post_count_card_content_wrapper ' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        //title heading separator
        $this->add_control(
            'trad_category_post_content_category_title_heading',
            [
                'label' => esc_html__('Title', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_category_post_content_category_title',
                'label' => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_category_post_count_card_title',
            ]
        );
    
        // Text Color Control
        $this->add_control(
            'trad_category_post_content_category_title_color',
            [
                'label' => esc_html__('Title Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000', // Default color
                'selectors' => [
                    '{{WRAPPER}} .trad_category_post_count_card_title' => 'color: {{VALUE}}',
                ],
            ]
        );
        //--------------------post count--------------
        $this->add_control(
            'trad_category_post_count_text_heading',
            [
                'label' => esc_html__('Post Count Text', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_category_post_count_text',
                'label' => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_category_post_count_card_count',
            ]
        );
    
        // Text Color Control
        $this->add_control(
            'trad_category_post_count_text_color',
            [
                'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000', // Default color
                'selectors' => [
                    '{{WRAPPER}} .trad_category_post_count_card_count' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        //--------------------------------------------button style ----------------------------------------------
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__('Button Style', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //---------typography
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_category_post_content_button_typography',
                'label' => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_category_post_count_card_button',
            ]
        );
        //---------padding
          $this->add_responsive_control(
            'trad_category_post_content_button_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 5,
                    'right' => 10,
                    'bottom' => 5,
                    'left' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_category_post_count_card_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
       //----------- border radious//
        $this->add_responsive_control(
            'trad_category_post_content_button_radius',
            [
                'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_category_post_count_card_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->start_controls_tabs( 'trad_category_post_count_style_tab' );

        //  -----------Controls tab For Normal------------
        $this->start_controls_tab(
            'trad_category_post_count_style_normal',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'trad_category_post_content_button',
                'label' => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .trad_category_post_count_card_button',
            ]
        );

        $this->add_control(
            'trad_category_post_content_button_typography_text_color',
            [
                'label' => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff', 
                'selectors' => [
                    '{{WRAPPER}} .trad_category_post_count_card_button a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trad_category_post_content_button_border',
                'label' => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_category_post_count_card_button',
            ]
        );

         $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'trad_category_post_content_button_shadow',
                'label' => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_category_post_count_card_button',
            ]
        );
    
        $this->end_controls_tab();
        // ----------------------- Controls tab For Hover
        $this->start_controls_tab(
            'trad_category_post_count_style_hover',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        ); 

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'trad_category_post_content_button_hover',
                    'label' => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .trad_category_post_count_card_button:hover',
                ]
            );

        $this->add_control(
            'trad_category_post_content_button_typography_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff', 
                'selectors' => [
                    '{{WRAPPER}} .trad_category_post_count_card_button:hover a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trad_category_post_content_button_border_hover',
                'label' => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_category_post_count_card_button:hover',
            ]
        );

         $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'trad_category_post_content_button_shadow_hover',
                'label' => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_category_post_count_card_button:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $category_id = $settings['selected_category'];
    
        // Get the category details
        $category = get_term_by('id', $category_id, 'category');
        $post_count = $category ? $category->count : 0;
        $category_name = $category ? $category->name : __('Unknown', 'turbo-addons-elementor-pro');
        $post_available_text = !empty($settings['post_available_text']) ? $settings['post_available_text'] : __('Product Available', 'turbo-addons-elementor-pro');
        $show_post_count = isset($settings['trad_category_post_show_count_text']) && 'yes' === $settings['trad_category_post_show_count_text'];
        $show_category_text = isset($settings['trad_category_show_post_text']) && 'yes' === $settings['trad_category_show_post_text']; 
        
        // button variable//
        $button_text = !empty($settings['button_text']) ? $settings['button_text'] : __('Sell All Post', 'turbo-addons-elementor-pro');
        // $button_link = $settings['button_link'];
        // $button_url = isset($button_link['url']) ? esc_url($button_link['url']) : '#';
        $button_target = isset($button_link['is_external']) && $button_link['is_external'] ? '_blank' : '_self';
        $button_rel = isset($button_link['nofollow']) && $button_link['nofollow'] ? 'nofollow' : 'noopener';
        // Default URL = Category Archive Page
        $default_url = get_category_link($category_id);

        // If user selects custom → use custom URL
        if ($settings['button_link_type'] === 'custom' && !empty($settings['button_link']['url'])) {
            $button_url = esc_url($settings['button_link']['url']);
        } else {
            $button_url = esc_url($default_url);
        }

        echo '<div class="trad_category_post_count_card">';

          if(!empty($settings["trad_category_show_image"])) {
            echo '<div class="trad_category_post_count_card_img">';
                echo '<img src="' . esc_url($settings['uploaded_image']['url']) . '" alt="' . esc_attr__('Category Image', 'turbo-addons-elementor-pro') . '" class="trad_category_post_count_card_image_resize">';
            echo '</div>';
          }
            // text content section//
            echo '<div class="trad_category_post_count_card_content_wrapper">';
                // Display category name and post count
                if($show_category_text == 'yes' || $show_post_count == 'yes') {
                        if(!empty($show_category_text)) {
                            echo '<h3 class="trad_category_post_count_card_title">' . esc_html($category_name) . '</h3>';
                        }
                        if(!empty($show_post_count)) {
                            echo '<p class="trad_category_post_count_card_count">' . esc_html($post_count) . ' ' . esc_html($post_available_text) . '</p>';
                        }
                        if(!empty($settings["trad_category_post_count_show_button"])) {
                            echo '<button class="trad_category_post_count_card_button">';
                                echo '<a href="'. esc_url( $button_url ) .'">'.esc_html($button_text).'</a>';
                            echo '</button>';
                        } 
                }
            echo '</div>';
        echo '</div>';
    } 

}

// Register the widget
Plugin::instance()->widgets_manager->register_widget_type(new TRAD_Post_Category());


                       
