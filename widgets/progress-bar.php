<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class TRAD_Progress_bar extends Widget_Base {

    public function get_name() {
        return 'trad-progress-bar';
    }

    public function get_title() {
        return esc_html__( 'Progress Bar', 'turbo-addons-elementor-pro' );
    }

    public function get_icon() {
        return 'eicon-skill-bar trad-icon';
    }

    public function get_categories() {
        return [ 'turbo-addons-pro' ];
    }

    public function _register_controls() {

    //----------------------------------------------content section----------------------------------
    //==================================================================================================
      $this->start_controls_section(
            'progress_bar_section',
            [
                'label' => esc_html__( 'Progress Bar', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'milestone_value',
            [
                'label' => esc_html__( 'Progress Value (%)', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
            ]
        );
  
    $this->end_controls_section();
    // -------------------------------------------style section------------------------------------------//
    //==================================================================================================
        $this->start_controls_section(
            'progress-container-style',
            [
                'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // background//
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__( 'Container Background', 'turbo-addons-elementor-pro' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .trad-progress-milestone',
            ]
        );

        //  Box Shadow and Border
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-progress-milestone',
            ]
        );
        // border style///
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'label' => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-progress-milestone',
            ]
        );
        // paddaing style//
        $this->add_control(
            'padding_control',
            [
                'label' => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ], // Units you can control the padding in
                'selectors' => [
                    '{{WRAPPER}} .trad-progress-milestone' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // -------------------------------------------------------Percentage style-----------------------------------
        $this->start_controls_section(
            'progress_percentage_style_section',
            [
                'label' => esc_html__( 'Percentage (%) Style', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //percentage style selection
        $this->add_control(
            'progress_percentage_style_options',
            [
                'label' => esc_html__('Percentage Display Style', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        // style options
        $this->add_control(
        'percentage_display_style',
            [
            'label'   => esc_html__( 'Select Style', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'bubble',
            'options' => [
                'inside' => esc_html__( 'Inside', 'turbo-addons-elementor-pro' ),
                'bubble' => esc_html__( 'Bubble', 'turbo-addons-elementor-pro' ),
            ],
            'separator' => 'before',
            ]
        );


        $this->add_control(
            'progress_value_style',
            [
                'label' => esc_html__('Percentage bubble Background', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        //bubble background color
        $this->add_control(
            'progress_bubble_color',
            [
                'label' => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#e0e0e0ff',
                'selectors' => [
                    '{{WRAPPER}} .trad-progress-milestone-value.bubble' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .trad-progress-milestone-value-arrow'  => 'border-top-color: {{VALUE}};',
                ],
            ]
        );
        //padding
        $this->add_control(
            'progress_bubble_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ], // Units you can control the padding in
                'selectors' => [
                    '{{WRAPPER}} .trad-progress-milestone-value.bubble' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //border radius
        $this->add_control(
            'progress_bubble_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ], // Units you can control the padding in
                'selectors' => [
                    '{{WRAPPER}} .trad-progress-milestone-value.bubble' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //boxshadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'progress_bubble_box_shadow',
                'label' => esc_html__('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-progress-milestone-value.bubble',
            ]
        );
         //typography
        $this->add_control(
            'progress_typography_style',
            [
                'label' => esc_html__('Typography', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        //typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'progress_bubble_typography',
                'selector' => '{{WRAPPER}} .trad-progress-milestone-value.bubble',
            ]
        );
        //text color
        $this->add_control(
            'progress_bubble_text_color',
            [
                'label' => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .trad-progress-milestone-value.bubble' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        // ---------------------------------------------------Progress Bar---------------------------------------------
        $this->start_controls_section(
            'progress_bar_style_section',
            [
                'label' => esc_html__( 'Progress Bar Style', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //progress color
        $this->add_control(
            'progress_percentage',
            [
                'label' => esc_html__('Progress Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
         $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'progress_background',
                'label' => esc_html__( 'Progress Color', 'turbo-addons-elementor-pro' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .trad-progress-milestone-progress',
            ]
        );

        //progress bar background
        $this->add_control(
            'progress_bar_background',
            [
                'label' => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        // backgrund
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'progress_bar_background',
                'label' => esc_html__('Progress Bar Background', 'turbo-addons-elementor-pro'),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .trad-progress-milestone-progress-bar',
            ]
        );

        $this->add_control(
            'progress_bar_height',
            [
                'label' => esc_html__( 'Progress Bar Height', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-progress-milestone-progress-bar' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'progress_vertical_space',
            [
                'label' => esc_html__( 'Progress Vertical Space', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','%','em' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 45,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-progress-milestone-progress-bar' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'progress_bar_background',
                'label' => esc_html__( 'Progress Bar Background', 'turbo-addons-elementor-pro' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .trad-progress-milestone-progress-bar',
            ]
        );

        // Progress Bar Box Shadow and Border
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'progress_bar_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-progress-milestone-progress-bar',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'progress_bar_border',
                'label' => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-progress-milestone-progress-bar',
            ]
        );
        //border radious
        $this->add_control(
            'progress_bar_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ], // Units you can control the padding in
                'selectors' => [
                    '{{WRAPPER}} .trad-progress-milestone-progress-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .trad-progress-milestone-progress' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $milestone_value = absint( $settings['milestone_value']['size'] );
        $milestone_color = sanitize_hex_color( $settings['milestone_color'] );
        $progress_bar_height = isset( $settings['progress_bar_height']['size'] ) ? esc_attr( $settings['progress_bar_height']['size'] ) : '20';

        ?>
        <div class="trad-progress-milestone-container">
            <div class="trad-progress-milestone">
                <div class="trad-progress-milestone-progress-bar">
                    <div class="trad-progress-milestone-progress" style="width: <?php echo esc_attr( $milestone_value ); ?>%; --progress-percentage: <?php echo esc_attr( $milestone_value ); ?>;">
                        <?php if ( $settings['percentage_display_style'] === 'inside' ) : ?>
                        <span class="trad-progress-milestone-value inside">
                            <?php echo esc_html( $milestone_value ); ?>%
                        </span>
                        <?php else : ?>
                            <span class="trad-progress-milestone-value bubble">
                                <?php echo esc_html( $milestone_value ); ?>%
                                <span class="trad-progress-milestone-value-arrow"></span>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

// Register widget
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TRAD_Progress_bar() );

