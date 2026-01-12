<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography; 
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_Tuor_Guide_Pro extends Widget_Base {

    public function get_name() {
        return 'trad_tuor_guide';
    }

    public function get_title() {
        return __('Tuor Guide', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-notes trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    public function get_style_depends() {
        return [ 'introjs-css' ];
    }

    public function get_script_depends() {
        return [ 'introjs-js', 'trad-guided-tour-js' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'steps',
            [
                'label' => __( 'Tour Steps', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'element_selector',
                        'label' => __( 'Element Selector', 'turbo-addons-elementor-pro' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => '#element-id',
                        'description' => __( 'CSS selector of the element to highlight.', 'turbo-addons-elementor-pro' ),
                    ],
                    [
                        'name' => 'step_title',
                        'label' => __( 'Step Title', 'turbo-addons-elementor-pro' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Step Title', 'turbo-addons-elementor-pro' ),
                    ],
                    [
                        'name' => 'step_description',
                        'label' => __( 'Step Description', 'turbo-addons-elementor-pro' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'This is a description for the step.', 'turbo-addons-elementor-pro' ),
                    ],
                ],
                'title_field' => '{{{ step_title }}}',
            ]
        );

        $this->end_controls_section();

        // ---------------------------style sections-------------------------
        $this->start_controls_section(
            'tour_style_sections',
            [
                'label' => __( 'Style', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__( 'Container Background', 'turbo-addons-elementor-pro' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .trad-guided-tour-btn',
            ]
        );

        $this->add_control(
            'padding_control_tour_guide',
            [
                'label' => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ], // Units you can control the padding in
                'selectors' => [
                    '{{WRAPPER}} .trad-guided-tour-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
            );
            // border style///
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'tour_guide_btn_border',
                    'label' => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                    'selector' => '{{WRAPPER}} .trad-guided-tour-btn',
                ]
            );  
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tour_guide_btn_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-guided-tour-btn',
            ]
        );
        

        $this->end_controls_section();
    }

    // Render the widget content
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <button id="start-tour" class="trad-guided-tour-btn">Start Tour</button>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const steps = <?php echo wp_json_encode( $settings['steps'] ); ?>;
                document.getElementById('start-tour').addEventListener('click', function () {
                    const tour = introJs();
                    steps.forEach((step, index) => {
                        tour.addStep({
                            element: step.element_selector,
                            title: step.step_title,
                            intro: step.step_description
                        });
                    });
                    tour.start();
                });
            });
        </script>

        <?php
    }
    
}

// Register the widget
Plugin::instance()->widgets_manager->register_widget_type(new TRAD_Tuor_Guide_Pro());
