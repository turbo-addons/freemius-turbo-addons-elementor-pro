<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography; 
use Elementor\Group_Control_Background;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_Text_Gradient extends Widget_Base {

    public function get_name() {
        return 'trad_text_gradient';
    }

    public function get_title() {
        return __('Text Gradient', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-notes trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }


    protected function _register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'skin_select',
            [
                'label' => esc_html__( 'Select Skin', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'skin-1' => esc_html__( 'Skin 1', 'turbo-addons-elementor-pro' ),
                    'skin-2' => esc_html__( 'Skin 2', 'turbo-addons-elementor-pro' ),
                ],
                'default' => 'skin-1',
            ]
        );

        $this->add_control(
            'top_text',
            [
                'label' => __('Text', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => __('abstract', 'turbo-addons-elementor-pro'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'style_box_section',
            [
                'label' => __('Box', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        ); 

        //Background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'text_gradient_skin_one_background',
                'label' => __('Background', 'turbo-addons-elementor-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-text-gradient-skin-one-container',
                'condition' => [
                    'skin_select' => 'skin-1',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'text_gradient_skin_two_background',
                'label' => __('Background', 'turbo-addons-elementor-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-text-gradient-skin-two-container',
                'condition' => [
                    'skin_select' => 'skin-2',
                ],
            ]
        );

        //padding
        $this->add_responsive_control(
            'text_gradient_skin_one_padding',
            [
                'label'      => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-text-gradient-skin-one-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skin_select' => 'skin-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_gradient_skin_two_padding',
            [
                'label'      => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-text-gradient-skin-two-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skin_select' => 'skin-2',
                ],
            ]
        );

        //margin

        $this->add_responsive_control(
            'text_gradient_skin_one_margin',
            [
                'label'      => esc_html__('Margin', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-text-gradient-skin-one-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skin_select' => 'skin-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_gradient_skin_two_margin',
            [
                'label'      => esc_html__('Margin', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-text-gradient-skin-two-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skin_select' => 'skin-2',
                ],
            ]
        );

        // Border Group
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'text_gradient_skin_one_border',
                'label'    => esc_html__('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-text-gradient-skin-one-container',
                'condition' => [
                    'skin_select' => 'skin-1',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'text_gradient_skin_two_border',
                'label'    => esc_html__('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-text-gradient-skin-two-container',
                'condition' => [
                    'skin_select' => 'skin-2',
                ],
            ]
        );
        
        // Border Radius
        $this->add_responsive_control(
            'text_gradient_skin_one_radius',
            [
                'label'      => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-text-gradient-skin-one-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skin_select' => 'skin-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_gradient_skin_two_radius',
            [
                'label'      => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-text-gradient-skin-two-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'skin_select' => 'skin-2',
                ],
            ]
        );

        // Box Shadow Group
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'text_gradient_skin_one_shadow',
                'label'    => esc_html__('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-text-gradient-skin-one-container',
                'condition' => [
                    'skin_select' => 'skin-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'text_gradient_skin_two_shadow',
                'label'    => esc_html__('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-text-gradient-skin-two-container',
                'condition' => [
                    'skin_select' => 'skin-2',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Content', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //Background 
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'text_gradient_skin_one_content_background',
                'label' => __('Text Background', 'turbo-addons-elementor-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-text-gradient-skin-one-content',
                'condition' => [
                    'skin_select' => 'skin-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'text_gradient_skin_two_content_background',
                'label' => __('Text Background', 'turbo-addons-elementor-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-text-gradient-skin-animated',
                'condition' => [
                    'skin_select' => 'skin-2',
                ],
            ]
        );

        // Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_gradient_skin_one_content_typography', // Unique name for the control
                'label'    => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-text-gradient-skin-one-top-line',
                'condition' => [
                    'skin_select' => 'skin-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_gradient_skin_two_content_typography', // Unique name for the control
                'label'    => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-text-gradient-skin-animated',
                'condition' => [
                    'skin_select' => 'skin-2',
                ],
            ]
        );

        // Alignment 

        $this->add_control(
            'text_gradient_skin_one_content_align',
            [
                'label' => __('Text Alignment', 'turbo-addons-elementor-pro'),
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
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .trad-text-gradient-skin-one-top-line' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'skin_select' => 'skin-1',
                ],
            ]
        );

        $this->add_control(
            'text_gradient_skin_two_content_align',
            [
                'label' => __('Text Alignment', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .trad-text-gradient-skin-two-container' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'skin_select' => 'skin-2',
                ],
            ]
        );
        
        $this->add_control(
            'text_gradient_skin_animated_speed',
            [
                'label' => __('Animation Speed (Seconds)', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['s'],
                'range' => [
                    's' => [
                        'min' => 5,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-text-gradient-skin-animated' => 'animation-duration: {{SIZE}}s !important; -webkit-animation-duration: {{SIZE}}s !important;',
                ],
                'condition' => [
                    'skin_select' => 'skin-2',
                ],
            ]
        );
        

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $selected_template_for_text_gradient = isset( $settings['skin_select'] ) ? $settings['skin_select'] : 'skin-1';
        $background_style = $this->get_render_attribute_string('background');
        // Pass the dynamic data to the template
        if ( 'skin-1' === $selected_template_for_text_gradient ) {
            include plugin_dir_path( __FILE__ ) . '../templates/text_skin/skin-1.php';
        } elseif ( 'skin-2' === $selected_template_for_text_gradient ) {
            include plugin_dir_path( __FILE__ ) . '../templates/text_skin/skin-2.php';
        }
        // Extract background styles
        /*$background_style = $this->get_render_attribute_string('background');

        ?>
        <div class="trad-text-container">
            <div class="trad-content" style="-webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; <?= $background_style; ?>">
                <p class="trad-top-line"><?= esc_html($settings['top_text']); ?></p>
            </div>
        </div>
        <?php
        */
    }
    
}

// Register the widget
Plugin::instance()->widgets_manager->register_widget_type(new TRAD_Text_Gradient());
