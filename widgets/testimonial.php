<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Plugin;

class TRAD_Testimonial_Slider extends Widget_Base {

    public function get_name() {
        return 'trad_testimonial_slider';
    }

    public function get_title() {
        return esc_html__( 'Turbo Testimonial Slider', 'turbo-addons-elementor-pro' );
    }

    public function get_icon() {
        return 'eicon-review trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    protected function _register_controls() {

        // ============================================================
        // CONTENT SECTION — Testimonials List
        // ============================================================
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Testimonials', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'template_select',
            [
                'label'   => esc_html__( 'Select Style', 'turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'template-1' => esc_html__( 'Style 1 — Card Slider with Arrows', 'turbo-addons-elementor-pro' ),
                    'template-2' => esc_html__( 'Style 2 — Multi-card Slider', 'turbo-addons-elementor-pro' ),
                ],
                'default' => 'template-1',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial_image',
            [
                'label' => esc_html__( 'Author Image', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'testimonial_name',
            [
                'label'   => esc_html__( 'Name', 'turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'John Doe', 'turbo-addons-elementor-pro' ),
            ]
        );

        $repeater->add_control(
            'testimonial_designation',
            [
                'label'   => esc_html__( 'Designation / Company', 'turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Director, XYZ Company', 'turbo-addons-elementor-pro' ),
            ]
        );

        $repeater->add_control(
            'testimonial_content',
            [
                'label'   => esc_html__( 'Testimonial Text', 'turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'turbo-addons-elementor-pro' ),
                'rows'    => 5,
            ]
        );

        $this->add_control(
            'testimonials_list',
            [
                'label'       => esc_html__( 'Testimonials List', 'turbo-addons-elementor-pro' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'testimonial_name'        => esc_html__( 'John Doe', 'turbo-addons-elementor-pro' ),
                        'testimonial_designation' => esc_html__( 'Director, XYZ Company', 'turbo-addons-elementor-pro' ),
                        'testimonial_content'     => esc_html__( 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'turbo-addons-elementor-pro' ),
                    ],
                    [
                        'testimonial_name'        => esc_html__( 'Jane Smith', 'turbo-addons-elementor-pro' ),
                        'testimonial_designation' => esc_html__( 'CEO, ABC Inc', 'turbo-addons-elementor-pro' ),
                        'testimonial_content'     => esc_html__( 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'turbo-addons-elementor-pro' ),
                    ],
                    [
                        'testimonial_name'        => esc_html__( 'Alex Mercer', 'turbo-addons-elementor-pro' ),
                        'testimonial_designation' => esc_html__( 'Pinnacle Strategies', 'turbo-addons-elementor-pro' ),
                        'testimonial_content'     => esc_html__( 'Working with this team was a game-changer for my business! Their targeted approach and high-quality leads significantly boosted our conversion rates.', 'turbo-addons-elementor-pro' ),
                    ],
                ],
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->end_controls_section();

        // ============================================================
        // CONTENT SECTION — Slider Settings
        // ============================================================
        $this->start_controls_section(
            'slider_settings_section',
            [
                'label' => esc_html__( 'Slider Settings', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label'       => esc_html__( 'Auto Play Speed (ms)', 'turbo-addons-elementor-pro' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 4000,
                'min'         => 0,
                'step'        => 100,
                'description' => esc_html__( 'Set 0 to disable auto play.', 'turbo-addons-elementor-pro' ),
            ]
        );

        // ── Style 1 — Responsive slides per view ──────────────────────────
        $this->add_control(
            'slides_per_view',
            [
                'label'     => esc_html__( 'Slides Per View — Desktop', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [ '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5' ],
                'default'   => '2',
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            'slides_per_view_tablet',
            [
                'label'     => esc_html__( 'Slides Per View — Tablet', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [ '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5' ],
                'default'   => '1',
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            'slides_per_view_mobile',
            [
                'label'     => esc_html__( 'Slides Per View — Mobile', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [ '1' => '1', '2' => '2', '3' => '3' ],
                'default'   => '1',
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        // ── Style 2 — Responsive visible cards ────────────────────────────
        $this->add_control(
            'slides_per_view_t2',
            [
                'label'     => esc_html__( 'Visible Cards — Desktop', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [ '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5' ],
                'default'   => '3',
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            'slides_per_view_t2_tablet',
            [
                'label'     => esc_html__( 'Visible Cards — Tablet', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [ '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5' ],
                'default'   => '2',
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            'slides_per_view_t2_mobile',
            [
                'label'     => esc_html__( 'Visible Cards — Mobile', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [ '1' => '1', '2' => '2', '3' => '3' ],
                'default'   => '1',
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->end_controls_section();

        // ============================================================
        // STYLE TAB — Slider Wrapper
        // ============================================================
        $this->start_controls_section(
            'style_wrapper_section',
            [
                'label' => esc_html__( 'Slider Wrapper', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wrapper_bg_heading',
            [
                'label'     => esc_html__( 'Style 1 Wrapper', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            't1_wrapper_bg',
            [
                'label'     => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [ '{{WRAPPER}} .trad-ts1-wrapper' => 'background-color: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            't1_wrapper_padding',
            [
                'label'      => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts1-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            't1_wrapper_margin',
            [
                'label'      => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts1-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 't1_wrapper_border',
                'label'     => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts1-wrapper',
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            't1_wrapper_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts1-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 't1_wrapper_shadow',
                'label'     => esc_html__( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts1-wrapper',
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        // ── Style 2 Wrapper ───────────────────────────────────────────────
        $this->add_control(
            'wrapper_bg_heading_t2',
            [
                'label'     => esc_html__( 'Style 2 Wrapper', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            't2_wrapper_bg',
            [
                'label'     => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [ '{{WRAPPER}} .trad-ts2-wrapper' => 'background-color: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            't2_wrapper_padding',
            [
                'label'      => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts2-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            't2_wrapper_margin',
            [
                'label'      => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts2-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 't2_wrapper_border',
                'label'     => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts2-wrapper',
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            't2_wrapper_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts2-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 't2_wrapper_shadow',
                'label'     => esc_html__( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts2-wrapper',
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->end_controls_section();

        // ============================================================
        // STYLE TAB — Card / Wrapper
        // ============================================================
        $this->start_controls_section(
            'style_card_section',
            [
                'label' => esc_html__( 'Card Style', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // --- Style 1 card ---
        $this->add_control(
            't1_card_bg',
            [
                'label'     => esc_html__( 'Card Background', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [ '{{WRAPPER}} .trad-ts1-card' => 'background-color: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            't1_card_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [ 'top' => 16, 'right' => 16, 'bottom' => 16, 'left' => 16, 'unit' => 'px', 'isLinked' => true ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts1-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            't1_card_padding',
            [
                'label'      => esc_html__( 'Card Padding', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'default'    => [ 'top' => 28, 'right' => 28, 'bottom' => 28, 'left' => 28, 'unit' => 'px', 'isLinked' => true ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts1-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 't1_card_shadow',
                'label'     => esc_html__( 'Card Shadow', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts1-card',
                'condition' => [ 'template_select' => 'template-1' ],
                'fields_options' => [
                    'box_shadow' => [
                        'default' => [
                            'horizontal' => 0, 'vertical' => 4, 'blur' => 24, 'spread' => 0,
                            'color' => 'rgba(0,0,0,0.07)',
                        ],
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 't1_card_border',
                'selector'  => '{{WRAPPER}} .trad-ts1-card',
                'condition' => [ 'template_select' => 'template-1' ],
                'fields_options' => [
                    'border' => [ 'default' => 'solid' ],
                    'width'  => [ 'default' => [ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1, 'unit' => 'px', 'isLinked' => true ] ],
                    'color'  => [ 'default' => '#e8e8e8' ],
                ],
            ]
        );

        // --- Style 2 card ---
        $this->add_control(
            't2_card_bg',
            [
                'label'     => esc_html__( 'Card Background', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [ '{{WRAPPER}} .trad-ts2-card' => 'background-color: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            't2_card_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [ 'top' => 16, 'right' => 16, 'bottom' => 16, 'left' => 16, 'unit' => 'px', 'isLinked' => true ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts2-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            't2_card_padding',
            [
                'label'      => esc_html__( 'Card Padding', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'default'    => [ 'top' => 28, 'right' => 28, 'bottom' => 28, 'left' => 28, 'unit' => 'px', 'isLinked' => true ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts2-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 't2_card_shadow',
                'label'     => esc_html__( 'Card Shadow', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts2-card',
                'condition' => [ 'template_select' => 'template-2' ],
                'fields_options' => [
                    'box_shadow' => [
                        'default' => [
                            'horizontal' => 0, 'vertical' => 4, 'blur' => 24, 'spread' => 0,
                            'color' => 'rgba(0,0,0,0.07)',
                        ],
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 't2_card_border',
                'selector'  => '{{WRAPPER}} .trad-ts2-card',
                'condition' => [ 'template_select' => 'template-2' ],
                'fields_options' => [
                    'border' => [ 'default' => 'solid' ],
                    'width'  => [ 'default' => [ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1, 'unit' => 'px', 'isLinked' => true ] ],
                    'color'  => [ 'default' => '#e8e8e8' ],
                ],
            ]
        );

        $this->end_controls_section();

        // ============================================================
        // STYLE TAB — Quote Icon
        // ============================================================
        $this->start_controls_section(
            'style_quote_section',
            [
                'label' => esc_html__( 'Quote Icon', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            't1_quote_color',
            [
                'label'     => esc_html__( 'Quote Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#22c55e',
                'selectors' => [ '{{WRAPPER}} .trad-ts1-quote-icon' => 'color: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            't1_quote_size',
            [
                'label'      => esc_html__( 'Quote Size', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range'      => [ 'px' => [ 'min' => 16, 'max' => 80 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 32 ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts1-quote-icon' => 'font-size: {{SIZE}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            't2_quote_color',
            [
                'label'     => esc_html__( 'Quote Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#9ca3af',
                'selectors' => [ '{{WRAPPER}} .trad-ts2-quote-icon' => 'color: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            't2_quote_size',
            [
                'label'      => esc_html__( 'Quote Size', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range'      => [ 'px' => [ 'min' => 16, 'max' => 80 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 32 ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts2-quote-icon' => 'font-size: {{SIZE}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->end_controls_section();

        // ============================================================
        // STYLE TAB — Text
        // ============================================================
        $this->start_controls_section(
            'style_text_section',
            [
                'label' => esc_html__( 'Testimonial Text', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Style 1 text
        $this->add_control(
            't1_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#374151',
                'selectors' => [ '{{WRAPPER}} .trad-ts1-text' => 'color: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 't1_text_typography',
                'label'     => esc_html__( 'Text Typography', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts1-text',
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            't1_text_align',
            [
                'label'     => esc_html__( 'Text Align', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [ 'title' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ), 'icon' => 'eicon-text-align-left' ],
                    'center'  => [ 'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ), 'icon' => 'eicon-text-align-center' ],
                    'right'   => [ 'title' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ), 'icon' => 'eicon-text-align-right' ],
                    'justify' => [ 'title' => esc_html__( 'Justify', 'turbo-addons-elementor-pro' ), 'icon' => 'eicon-text-align-justify' ],
                ],
                'default'   => 'left',
                'selectors' => [ '{{WRAPPER}} .trad-ts1-text' => 'text-align: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        // Style 2 text
        $this->add_control(
            't2_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#374151',
                'selectors' => [ '{{WRAPPER}} .trad-ts2-text' => 'color: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 't2_text_typography',
                'label'     => esc_html__( 'Text Typography', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts2-text',
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            't2_text_align',
            [
                'label'     => esc_html__( 'Text Align', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [ 'title' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ), 'icon' => 'eicon-text-align-left' ],
                    'center'  => [ 'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ), 'icon' => 'eicon-text-align-center' ],
                    'right'   => [ 'title' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ), 'icon' => 'eicon-text-align-right' ],
                    'justify' => [ 'title' => esc_html__( 'Justify', 'turbo-addons-elementor-pro' ), 'icon' => 'eicon-text-align-justify' ],
                ],
                'default'   => 'left',
                'selectors' => [ '{{WRAPPER}} .trad-ts2-text' => 'text-align: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->end_controls_section();

        // ============================================================
        // STYLE TAB — Author
        // ============================================================
        $this->start_controls_section(
            'style_author_section',
            [
                'label' => esc_html__( 'Author Info', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // --- Style 1 ---
        $this->add_control(
            't1_author_image_size',
            [
                'label'      => esc_html__( 'Image Size', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 30, 'max' => 150 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 64 ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-ts1-author-img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            't1_author_img_radius',
            [
                'label'      => esc_html__( 'Image Border Radius', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [ 'top' => 10, 'right' => 10, 'bottom' => 10, 'left' => 10, 'unit' => 'px', 'isLinked' => true ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts1-author-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 't1_author_img_border',
                'label'     => esc_html__( 'Image Border', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts1-author-img',
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            't1_name_color',
            [
                'label'     => esc_html__( 'Name Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#111827',
                'selectors' => [ '{{WRAPPER}} .trad-ts1-name' => 'color: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 't1_name_typography',
                'label'     => esc_html__( 'Name Typography', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts1-name',
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_control(
            't1_designation_color',
            [
                'label'     => esc_html__( 'Designation Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#6b7280',
                'selectors' => [ '{{WRAPPER}} .trad-ts1-designation' => 'color: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 't1_designation_typography',
                'label'     => esc_html__( 'Designation Typography', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts1-designation',
                'condition' => [ 'template_select' => 'template-1' ],
            ]
        );

        // --- Style 2 ---

        $this->add_control(
            'divider_border_color',
            [
                'label' => esc_html__( 'Divider Color', 'turbo-addons-elementor-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-ts2-author-row' => 'border-top-color: {{VALUE}};',
                ],
                'condition'  => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            't2_author_image_size',
            [
                'label'      => esc_html__( 'Image Size', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 30, 'max' => 150 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 48 ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-ts2-author-img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            't2_author_img_radius',
            [
                'label'      => esc_html__( 'Image Border Radius', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [ 'top' => 50, 'right' => 50, 'bottom' => 50, 'left' => 50, 'unit' => '%', 'isLinked' => true ],
                'selectors'  => [ '{{WRAPPER}} .trad-ts2-author-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                'condition'  => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 't2_author_img_border',
                'label'     => esc_html__( 'Image Border', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts2-author-img',
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            't2_name_color',
            [
                'label'     => esc_html__( 'Name Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#111827',
                'selectors' => [ '{{WRAPPER}} .trad-ts2-name' => 'color: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 't2_name_typography',
                'label'     => esc_html__( 'Name Typography', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts2-name',
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_control(
            't2_designation_color',
            [
                'label'     => esc_html__( 'Designation Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#6b7280',
                'selectors' => [ '{{WRAPPER}} .trad-ts2-designation' => 'color: {{VALUE}};' ],
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 't2_designation_typography',
                'label'     => esc_html__( 'Designation Typography', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-ts2-designation',
                'condition' => [ 'template_select' => 'template-2' ],
            ]
        );

        $this->end_controls_section();

        // ============================================================
        // STYLE TAB — Navigation (Arrow / Dots)
        // ============================================================
        $this->start_controls_section(
            'style_nav_section',
            [
                'label' => esc_html__( 'Navigation', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // ── Navigation Type — shared for both templates ────────────────────
        $this->add_control(
            'nav_type',
            [
                'label'   => esc_html__( 'Navigation Type', 'turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'arrows' => esc_html__( 'Arrows', 'turbo-addons-elementor-pro' ),
                    'dots'   => esc_html__( 'Dots', 'turbo-addons-elementor-pro' ),
                    'both'   => esc_html__( 'Arrows + Dots', 'turbo-addons-elementor-pro' ),
                    'none'   => esc_html__( 'None', 'turbo-addons-elementor-pro' ),
                ],
                'default' => 'arrows',    // Style 1 default
                'separator' => 'before',
            ]
        );

        // ── Nav Position — shared ──────────────────────────────────────────
        $this->add_control(
            'nav_position',
            [
                'label'     => esc_html__( 'Nav Position', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'below' => esc_html__( 'Below Slider', 'turbo-addons-elementor-pro' ),
                    'above' => esc_html__( 'Above Slider', 'turbo-addons-elementor-pro' ),
                ],
                'default'   => 'below',
                'condition' => [ 'nav_type!' => 'none' ],
            ]
        );

        // ── Arrows — shared style controls ────────────────────────────────
        $this->add_control(
            'nav_arrow_heading',
            [
                'label'     => esc_html__( '— Arrow Style', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'nav_type' => [ 'arrows', 'both' ] ],
            ]
        );

        $this->add_control(
            'nav_arrow_align',
            [
                'label'     => esc_html__( 'Arrow Alignment', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [ 'title' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),   'icon' => 'eicon-text-align-left' ],
                    'center'     => [ 'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ), 'icon' => 'eicon-text-align-center' ],
                    'flex-end'   => [ 'title' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),  'icon' => 'eicon-text-align-right' ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .trad-ts1-nav'  => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .trad-ts2-nav'  => 'justify-content: {{VALUE}};',
                ],
                'condition' => [ 'nav_type' => [ 'arrows', 'both' ] ],
            ]
        );

        $this->add_control(
            'nav_arrow_gap',
            [
                'label'      => esc_html__( 'Arrow Nav Gap', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 80 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 20 ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-ts1-nav' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .trad-ts2-nav' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [ 'nav_type' => [ 'arrows', 'both' ] ],
            ]
        );

        $this->add_control(
            'nav_arrow_color',
            [
                'label'     => esc_html__( 'Arrow Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#22c55e',
                'selectors' => [
                    '{{WRAPPER}} .trad-ts1-arrow'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-ts1-arrow svg' => 'stroke: {{VALUE}};',
                    '{{WRAPPER}} .trad-ts2-arrow'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-ts2-arrow svg' => 'stroke: {{VALUE}};',
                ],
                'condition' => [ 'nav_type' => [ 'arrows', 'both' ] ],
            ]
        );

        $this->add_control(
            'nav_arrow_bg',
            [
                'label'     => esc_html__( 'Arrow Background', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .trad-ts1-arrow' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .trad-ts2-arrow' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 'nav_type' => [ 'arrows', 'both' ] ],
            ]
        );

        $this->add_control(
            'nav_arrow_size',
            [
                'label'      => esc_html__( 'Arrow Button Size', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 24, 'max' => 80 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 44 ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-ts1-arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .trad-ts2-arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [ 'nav_type' => [ 'arrows', 'both' ] ],
            ]
        );

        $this->add_control(
            'nav_arrow_radius',
            [
                'label'      => esc_html__( 'Arrow Border Radius', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ], '%' => [ 'min' => 0, 'max' => 50 ] ],
                'default'    => [ 'unit' => '%', 'size' => 50 ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-ts1-arrow' => 'border-radius: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .trad-ts2-arrow' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [ 'nav_type' => [ 'arrows', 'both' ] ],
            ]
        );

        // ── Dots — shared style controls ──────────────────────────────────
        $this->add_control(
            'nav_dots_heading',
            [
                'label'     => esc_html__( '— Dots Style', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'nav_type' => [ 'dots', 'both' ] ],
            ]
        );

        $this->add_control(
            'nav_dots_align',
            [
                'label'     => esc_html__( 'Dots Alignment', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [ 'title' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),   'icon' => 'eicon-text-align-left' ],
                    'center'     => [ 'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ), 'icon' => 'eicon-text-align-center' ],
                    'flex-end'   => [ 'title' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),  'icon' => 'eicon-text-align-right' ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .trad-ts1-dots' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .trad-ts2-dots' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [ 'nav_type' => [ 'dots', 'both' ] ],
            ]
        );

        $this->add_control(
            'nav_dots_gap',
            [
                'label'      => esc_html__( 'Dots Nav Gap', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 80 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 20 ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-ts1-dots' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .trad-ts2-dots' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [ 'nav_type' => [ 'dots', 'both' ] ],
            ]
        );

        $this->add_control(
            'nav_dot_color',
            [
                'label'     => esc_html__( 'Dot Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#d1d5db',
                'selectors' => [
                    '{{WRAPPER}} .trad-ts1-dot' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .trad-ts2-dot' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 'nav_type' => [ 'dots', 'both' ] ],
            ]
        );

        $this->add_control(
            'nav_dot_active_color',
            [
                'label'     => esc_html__( 'Active Dot Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#22c55e',
                'selectors' => [
                    '{{WRAPPER}} .trad-ts1-dot.trad-ts1-dot-active' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .trad-ts2-dot.trad-ts2-active'     => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 'nav_type' => [ 'dots', 'both' ] ],
            ]
        );

        $this->add_control(
            'nav_dot_size',
            [
                'label'      => esc_html__( 'Dot Size', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 4, 'max' => 24 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 10 ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-ts1-dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .trad-ts2-dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [ 'nav_type' => [ 'dots', 'both' ] ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings     = $this->get_settings_for_display();
        $testimonials = $settings['testimonials_list'];
        $template     = isset( $settings['template_select'] ) ? $settings['template_select'] : 'template-1';
        $slider_speed = isset( $settings['slider_speed'] )    ? (int) $settings['slider_speed'] : 4000;

        $nav_type     = isset( $settings['nav_type'] )     ? $settings['nav_type']     : 'arrows';
        $nav_position = isset( $settings['nav_position'] ) ? $settings['nav_position'] : 'below';

        if ( 'template-1' === $template ) {
            $slides_per_view        = isset( $settings['slides_per_view'] )        ? (int) $settings['slides_per_view']        : 2;
            $slides_per_view_tablet = isset( $settings['slides_per_view_tablet'] ) ? (int) $settings['slides_per_view_tablet'] : 1;
            $slides_per_view_mobile = isset( $settings['slides_per_view_mobile'] ) ? (int) $settings['slides_per_view_mobile'] : 1;
            include plugin_dir_path( __FILE__ ) . '../templates/testimonial/testimonial-template-1.php';
        } elseif ( 'template-2' === $template ) {
            $slides_per_view        = isset( $settings['slides_per_view_t2'] )        ? (int) $settings['slides_per_view_t2']        : 3;
            $slides_per_view_tablet = isset( $settings['slides_per_view_t2_tablet'] ) ? (int) $settings['slides_per_view_t2_tablet'] : 2;
            $slides_per_view_mobile = isset( $settings['slides_per_view_t2_mobile'] ) ? (int) $settings['slides_per_view_t2_mobile'] : 1;
            include plugin_dir_path( __FILE__ ) . '../templates/testimonial/testimonial-template-2.php';
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new TRAD_Testimonial_Slider() );
