<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background; 
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Trad_Whatsapp_Widget extends Widget_Base {

    public function get_name() { return 'trad-whatsapp'; }
    public function get_title() { return esc_html__('WhatsApp', 'turbo-addons-elementor-pro'); }
    public function get_icon() { return 'eicon-commenting-o trad-icon'; }
    public function get_categories() { return ['turbo-addons-pro']; }

    protected function get_upsale_data() {
        return [
            'condition'    => ! Utils::has_pro(),
            'image'        => esc_url( ELEMENTOR_ASSETS_URL . 'images/go-pro.svg' ),
            'image_alt'    => esc_attr__( 'Upgrade', 'turbo-addons-elementor-pro' ),
            'title'        => esc_html__( 'Upgrade to Pro', 'turbo-addons-elementor-pro' ),
            'description'  => esc_html__( 'Get the WhatsApp widget with Turbo Addons Elementor Pro.', 'turbo-addons-elementor-pro' ),
            'upgrade_url'  => esc_url( 'https://turbo-addons.com/pricing/' ),
            'upgrade_text' => esc_html__( 'Upgrade Now', 'turbo-addons-elementor-pro' ),
        ];
    }

    protected function _register_controls() {

        /* ==========================================================
         *  WIDGET MODE
         * ========================================================== */
        $this->start_controls_section('section_widget_mode', [
            'label' => __( 'Widget Mode', 'turbo-addons-elementor-pro' ),
        ]);
        $this->add_control('widget_mode', [
            'label'   => __( 'Mode', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'inline_chat',
            'options' => [
                'inline_chat'   => __( 'Inline Chat Window', 'turbo-addons-elementor-pro' ),
                'floating_multi' => __( 'Floating Multi-Agent', 'turbo-addons-elementor-pro' ),
            ],
        ]);
        $this->end_controls_section();

        /* ==========================================================
         *  INLINE CHAT — AGENT INFO
         * ======         *  INLINE CHAT â€” AGENT INFO
         * ========================================================== */
        $this->start_controls_section('section_inline_agent', [
            'label'     => __( 'Agent Info', 'turbo-addons-elementor-pro' ),
            'condition' => [ 'widget_mode' => 'inline_chat' ],
        ]);
        $this->add_control('ic_agent_name', [
            'label'   => __( 'Agent Name', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Rober Doe',
        ]);
        $this->add_control('ic_agent_tagline', [
            'label'   => __( 'Tagline / Status', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Typically replies in a few hours',
        ]);
        $this->add_control('ic_agent_phone', [
            'label'       => __( 'WhatsApp Number', 'turbo-addons-elementor-pro' ),
            'type'        => Controls_Manager::TEXT,
            'description' => __( 'Include country code, e.g. +8801712345678', 'turbo-addons-elementor-pro' ),
            'placeholder' => '+8801712345678',
        ]);
        $this->add_control('ic_agent_avatar', [
            'label' => __( 'Agent Avatar', 'turbo-addons-elementor-pro' ),
            'type'  => Controls_Manager::MEDIA,
        ]);
        $this->add_control('ic_default_msg', [
            'label'   => __( 'Chat Bubble Message', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::TEXTAREA,
            'default' => "Looking for the best offer? \nI'm happy to tell you",
            'rows'    => 3,
        ]);
        $this->add_control('ic_reply_placeholder', [
            'label'   => __( 'Reply Placeholder', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Write to response',
        ]);
        $this->end_controls_section();

        /* INLINE CHAT â€” BUTTON */
        $this->start_controls_section('section_inline_button', [
            'label'     => __( 'Button', 'turbo-addons-elementor-pro' ),
            'condition' => [ 'widget_mode' => 'inline_chat' ],
        ]);
        $this->add_control('ic_button_style', [
            'label'   => __( 'Button Style', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'avatar_name_sub',
            'options' => [
                'avatar_name_sub' => __( 'Avatar + Name + Subtitle', 'turbo-addons-elementor-pro' ),
                'avatar_name'     => __( 'Avatar + Name', 'turbo-addons-elementor-pro' ),
                'icon_text'       => __( 'Icon + Text', 'turbo-addons-elementor-pro' ),
            ],
        ]);
        $this->add_control('ic_button_text', [
            'label'     => __( 'Button Text', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::TEXT,
            'default'   => 'Contact us',
            'condition' => [ 'ic_button_style' => 'icon_text' ],
        ]);
        $this->add_control('ic_btn_avatar', [
            'label'       => __( 'Button Avatar Image', 'turbo-addons-elementor-pro' ),
            'type'        => Controls_Manager::MEDIA,
            'description' => __( 'Upload a separate avatar for the button. If empty, uses Agent Avatar.', 'turbo-addons-elementor-pro' ),
            'condition'   => [ 'ic_button_style' => [ 'avatar_name_sub', 'avatar_name' ] ],
        ]);
        $this->add_control('ic_btn_icon', [
            'label'     => __( 'Button Icon', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::ICONS,
            'default'   => [ 'value' => 'fab fa-whatsapp', 'library' => 'fa-brands' ],
            'condition' => [ 'ic_button_style' => 'icon_text' ],
        ]);
        $this->add_control('ic_theme_color', [
            'label'   => __( 'Theme Color', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::COLOR,
            'default' => '#cc8b2f',
        ]);
        $this->end_controls_section();

        /* ==========================================================
         *  INLINE CHAT â€” BUTTON STYLE (condition-based show/hide + Normal/Hover tabs)
         * ========================================================== */

        /* ==========================================================
         *  FLOATING MULTI-AGENT â€” BUTTON
         * ========================================================== */
        $this->start_controls_section('section_floating_button', [
            'label'     => __( 'Button Settings', 'turbo-addons-elementor-pro' ),
            'condition' => [ 'widget_mode' => 'floating_multi' ],
        ]);
        $this->add_control('button_layout', [
            'label'   => __( 'Position', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'fixed-right',
            'options' => [
                'fixed-right' => __( 'Bottom Right (Floating)', 'turbo-addons-elementor-pro' ),
                'fixed-left'  => __( 'Bottom Left (Floating)', 'turbo-addons-elementor-pro' ),
            ],
        ]);
        $this->add_control('button_text', [
            'label'   => __( 'Button Text', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::TEXT,
            'default' => __( 'Chat with us', 'turbo-addons-elementor-pro' ),
        ]);
        $this->add_control('button_icon', [
            'label'   => __( 'Icon', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::ICONS,
            'default' => [ 'value' => 'fab fa-whatsapp', 'library' => 'fa-brands' ],
        ]);
        $this->end_controls_section();

        /* FLOATING MULTI â€” POPUP HEADER */
        $this->start_controls_section('section_popup_header', [
            'label'     => __( 'Popup Header', 'turbo-addons-elementor-pro' ),
            'condition' => [ 'widget_mode' => 'floating_multi' ],
        ]);
        $this->add_control('header_title', [
            'label'   => __( 'Header Title', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Start a Conversation',
        ]);
        $this->add_control('header_subtitle', [
            'label'   => __( 'Header Subtitle', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Hi! Click one of our member below to chat on WhatsApp',
        ]);
        $this->end_controls_section();

        /* FLOATING MULTI â€” AGENTS */
        $this->start_controls_section('section_agents', [
            'label'     => __( 'Agents', 'turbo-addons-elementor-pro' ),
            'condition' => [ 'widget_mode' => 'floating_multi' ],
        ]);
        $repeater = new Repeater();
        $repeater->add_control('agent_name',    [ 'label' => __('Name', 'turbo-addons-elementor-pro'),    'type' => Controls_Manager::TEXT,    'default' => 'John Doe' ]);
        $repeater->add_control('agent_tagline', [ 'label' => __('Tagline', 'turbo-addons-elementor-pro'), 'type' => Controls_Manager::TEXT,    'default' => 'Typically replies in a few hours' ]);
        $repeater->add_control('agent_phone',   [ 'label' => __('WhatsApp Number', 'turbo-addons-elementor-pro'), 'type' => Controls_Manager::TEXT, 'description' => 'e.g. +8801712345678' ]);
        $repeater->add_control('agent_avatar',  [ 'label' => __('Avatar', 'turbo-addons-elementor-pro'),  'type' => Controls_Manager::MEDIA ]);
        $repeater->add_control('default_msg',   [ 'label' => __('Default Message', 'turbo-addons-elementor-pro'), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Hi there! How can I help you?' ]);
        $this->add_control('agents', [
            'label'       => __( 'Agent List', 'turbo-addons-elementor-pro' ),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{{ agent_name }}}',
            'default'     => [ [ 'agent_name' => 'Support Team', 'agent_phone' => '' ] ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('style_box', [
            'label'     => __( 'Box', 'turbo-addons-elementor-pro' ),
            'tab'       => Controls_Manager::TAB_STYLE,
        ]);

        //alignment left right center
        $this->add_responsive_control('box_padding', [
            'label' => __( 'Padding', 'turbo-addons-elementor-pro' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'vh' ],
            'selectors' => [
                '{{WRAPPER}} .trad-wa-inline-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .trad-whatsapp-wrapper'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('box_margin', [
            'label' => __( 'Margin', 'turbo-addons-elementor-pro' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'vh' ],
            'selectors' => [
                '{{WRAPPER}} .trad-wa-inline-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .trad-whatsapp-wrapper'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('box_radius', [
            'label' => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'vh' ],
            'selectors' => [
                '{{WRAPPER}} .trad-wa-inline-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .trad-whatsapp-wrapper'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

         $this->end_controls_section();

        $this->start_controls_section('style_button', [
            'label'     => __( 'Button', 'turbo-addons-elementor-pro' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'widget_mode' => 'floating_multi' ],
        ]);

        /* ---- Alignment ---- */
        $this->add_responsive_control('floating_btn_align', [
            'label'   => __( 'Button Alignment', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [ 'title' => __('Left',   'turbo-addons-elementor-pro'), 'icon' => 'eicon-text-align-left'   ],
                'center'     => [ 'title' => __('Center', 'turbo-addons-elementor-pro'), 'icon' => 'eicon-text-align-center' ],
                'flex-end'   => [ 'title' => __('Right',  'turbo-addons-elementor-pro'), 'icon' => 'eicon-text-align-right'  ],
            ],
            'selectors' => [ '{{WRAPPER}} .trad-whatsapp-button' => 'align-self: {{VALUE}};' ],
        ]);

        /* ---- Layout (always visible) ---- */
        $this->add_responsive_control('button_padding', [
            'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'default'    => [ 'top' => '12', 'right' => '20', 'bottom' => '12', 'left' => '20', 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .trad-whatsapp-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('button_margin', [
            'label'      => __( 'Margin', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [ '{{WRAPPER}} .trad-whatsapp-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('button_border_radius', [
            'label'      => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'default'    => [ 'top' => '50', 'right' => '50', 'bottom' => '50', 'left' => '50', 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .trad-whatsapp-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('button_icon_size', [
            'label'      => __( 'Icon Size', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em' ],
            'range'      => [ 'px' => [ 'min' => 10, 'max' => 80 ] ],
            'default'    => [ 'size' => 24, 'unit' => 'px' ],
            'selectors'  => [
                '{{WRAPPER}} .trad-whatsapp-button .trad-whatsapp-icon'     => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .trad-whatsapp-button .trad-whatsapp-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .trad-whatsapp-button .trad-whatsapp-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_text_typography',
                'label'    => __( 'Text Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-whatsapp-button .trad-whatsapp-text',
            ]
        );
        $this->add_responsive_control('button_icon_gap', [
            'label'      => __( 'Icon & Text Gap', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
            'default'    => [ 'size' => 8, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .trad-whatsapp-button' => 'gap: {{SIZE}}{{UNIT}};' ],
        ]);

        /* ---- Normal / Hover Tabs ---- */
        $this->start_controls_tabs('button_color_tabs');

            /* === NORMAL === */
            $this->start_controls_tab('button_tab_normal', [
                'label' => __( 'Normal', 'turbo-addons-elementor-pro' ),
            ]);
            $this->add_control('button_bg_color', [
                'label'     => __( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#25d366',
                'selectors' => [ '{{WRAPPER}} .trad-whatsapp-button' => 'background-color: {{VALUE}};' ],
            ]);
            $this->add_control('button_text_color', [
                'label'     => __( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-whatsapp-button'                        => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-whatsapp-button .trad-whatsapp-text'    => 'color: {{VALUE}};',
                ],
            ]);
            $this->add_control('button_icon_color', [
                'label'     => __( 'Icon Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-whatsapp-button .trad-whatsapp-icon'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-whatsapp-button .trad-whatsapp-icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-whatsapp-button .trad-whatsapp-icon svg' => 'fill: {{VALUE}};',
                ],
            ]);
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [ 'name' => 'button_border', 'selector' => '{{WRAPPER}} .trad-whatsapp-button' ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [ 'name' => 'button_box_shadow', 'selector' => '{{WRAPPER}} .trad-whatsapp-button' ]
            );
            $this->end_controls_tab();

            /* === HOVER === */
            $this->start_controls_tab('button_tab_hover', [
                'label' => __( 'Hover', 'turbo-addons-elementor-pro' ),
            ]);
            $this->add_control('button_bg_color_hover', [
                'label'     => __( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1ebe57',
                'selectors' => [ '{{WRAPPER}} .trad-whatsapp-button:hover' => 'background-color: {{VALUE}};' ],
            ]);
            $this->add_control('button_text_color_hover', [
                'label'     => __( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-whatsapp-button:hover'                     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-whatsapp-button:hover .trad-whatsapp-text' => 'color: {{VALUE}};',
                ],
            ]);
            $this->add_control('button_icon_color_hover', [
                'label'     => __( 'Icon Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-whatsapp-button:hover .trad-whatsapp-icon'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-whatsapp-button:hover .trad-whatsapp-icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-whatsapp-button:hover .trad-whatsapp-icon svg' => 'fill: {{VALUE}};',
                ],
            ]);
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [ 'name' => 'button_border_hover', 'selector' => '{{WRAPPER}} .trad-whatsapp-button:hover' ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [ 'name' => 'button_box_shadow_hover', 'selector' => '{{WRAPPER}} .trad-whatsapp-button:hover' ]
            );
            $this->add_control('button_hover_transition', [
                'label'     => __( 'Transition Duration (s)', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 3, 'step' => 0.1 ] ],
                'default'   => [ 'size' => 0.3 ],
                'selectors' => [ '{{WRAPPER}} .trad-whatsapp-button' => 'transition: all {{SIZE}}s ease;' ],
            ]);
            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('style_header', [
            'label'     => __( 'Popup Header', 'turbo-addons-elementor-pro' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'widget_mode' => 'floating_multi' ],
        ]);
        $this->add_control('header_bg', [
            'label'     => __( 'Background Color', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .trad-whatsapp-header' => 'background-color: {{VALUE}}' ],
        ]);
        $this->add_control('header_color', [
            'label'     => __( 'Text Color', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .trad-whatsapp-title'    => 'color: {{VALUE}}',
                '{{WRAPPER}} .trad-whatsapp-subtitle' => 'color: {{VALUE}}',
                '{{WRAPPER}} .trad-whatsapp-header'   => 'color: {{VALUE}}',
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('style_body', [
            'label'     => __( 'Body & Agents', 'turbo-addons-elementor-pro' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'widget_mode' => 'floating_multi' ],
        ]);
        $this->add_control('body_bg', [
            'label'     => __( 'Body Background', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .trad-whatsapp-body' => 'background-color: {{VALUE}}' ],
        ]);
        $this->add_control('agent_bg', [
            'label'     => __( 'Agent Card Background', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .trad-whatsapp-agent' => 'background-color: {{VALUE}}' ],
        ]);
        $this->add_control('agent_name_color', [
            'label'     => __( 'Agent Name Color', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .trad-whatsapp-agent-name' => 'color: {{VALUE}}' ],
        ]);
        $this->add_control('agent_tagline_color', [
            'label'     => __( 'Agent Tagline Color', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .trad-whatsapp-agent-tagline' => 'color: {{VALUE}}' ],
        ]);

        /* ---- Agent Avatar Size ---- */
        $this->add_responsive_control('agent_avatar_size', [
            'label'      => __( 'Agent Avatar Size', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 20, 'max' => 100 ] ],
            'default'    => [ 'size' => 45, 'unit' => 'px' ],
            'selectors'  => [
                '{{WRAPPER}} .trad-whatsapp-agent-avatar'     => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        /* ---- Agent Avatar Border Radius ---- */
        $this->add_responsive_control('agent_avatar_border_radius', [
            'label'      => __( 'Agent Avatar Border Radius', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'default'    => [ 'top' => '50', 'right' => '50', 'bottom' => '50', 'left' => '50', 'unit' => '%' ],
            'selectors'  => [ '{{WRAPPER}} .trad-whatsapp-agent-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);

        /* ---- Agent Avatar Border ---- */
        $this->add_control('agent_avatar_border_color', [
            'label'     => __( 'Agent Avatar Border Color', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .trad-whatsapp-agent-avatar' => 'border-color: {{VALUE}};' ],
        ]);
        $this->add_responsive_control('agent_avatar_border_width', [
            'label'      => __( 'Agent Avatar Border Width', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 10 ] ],
            'default'    => [ 'size' => 0, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .trad-whatsapp-agent-avatar' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;' ],
        ]);

        $this->end_controls_section();
        $this->start_controls_section('style_ic_header', [
            'label'     => __( 'Chat Header', 'turbo-addons-elementor-pro' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'widget_mode' => 'inline_chat' ],
        ]);
        $this->add_control('ic_header_bg', [
            'label'     => __( 'Header Background', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .trad-wa-cw-header' => 'background-color: {{VALUE}} !important' ],
        ]);
        $this->add_control('ic_header_color', [
            'label'     => __( 'Text Color', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .trad-wa-cw-header'       => 'color: {{VALUE}} !important',
                '{{WRAPPER}} .trad-wa-cw-hname'        => 'color: {{VALUE}} !important',
                '{{WRAPPER}} .trad-wa-cw-hstatus'      => 'color: {{VALUE}} !important',
            ],
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'ic_header_name_typo', 'label' => __('Name Typography', 'turbo-addons-elementor-pro'), 'selector' => '{{WRAPPER}} .trad-wa-cw-hname' ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'ic_header_status_typo', 'label' => __('Status Typography', 'turbo-addons-elementor-pro'), 'selector' => '{{WRAPPER}} .trad-wa-cw-hstatus' ]
        );
        $this->add_responsive_control('ic_header_padding', [
            'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('ic_avatar_size', [
            'label'      => __( 'Avatar Size', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 20, 'max' => 100 ] ],
            'selectors'  => [
                '{{WRAPPER}} .trad-wa-cw-avatar' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        /* ---- Chat Header Avatar Border Radius ---- */
        $this->add_responsive_control('ic_avatar_border_radius', [
            'label'      => __( 'Avatar Border Radius', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'default'    => [ 'top' => '50', 'right' => '50', 'bottom' => '50', 'left' => '50', 'unit' => '%' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);

        /* ---- Chat Header Avatar Border ---- */
        $this->add_control('ic_avatar_border_color', [
            'label'     => __( 'Avatar Border Color', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => 'rgba(255,255,255,0.5)',
            'selectors' => [ '{{WRAPPER}} .trad-wa-cw-avatar' => 'border-color: {{VALUE}};' ],
        ]);
        $this->add_responsive_control('ic_avatar_border_width', [
            'label'      => __( 'Avatar Border Width', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 10 ] ],
            'default'    => [ 'size' => 2, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-avatar' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;' ],
        ]);

        $this->end_controls_section();

        /* ---- Chat Card (Popup Window) ---- */
        $this->start_controls_section('style_ic_card', [
            'label'     => __( 'Chat Card (Popup)', 'turbo-addons-elementor-pro' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'widget_mode' => 'inline_chat' ],
        ]);
        $this->add_responsive_control('ic_card_width', [
            'label'      => __( 'Card Width', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%', 'vw' ],
            'range'      => [ 'px' => [ 'min' => 200, 'max' => 600 ] ],
            'default'    => [ 'size' => 280, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-chatwin' => 'width: {{SIZE}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('ic_card_border_radius', [
            'label'      => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-chatwin' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;' ],
        ]);
        $this->add_responsive_control('ic_card_margin', [
            'label'      => __( 'Card Margin', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-chatwin' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'ic_card_shadow',
                'label'    => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-wa-chatwin',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'ic_card_border',
                'label'    => __( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-wa-chatwin',
            ]
        );
        $this->end_controls_section();

        /* ---- Chat Body Area ---- */
        $this->start_controls_section('style_ic_body', [
            'label'     => __( 'Chat Body Area', 'turbo-addons-elementor-pro' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'widget_mode' => 'inline_chat' ],
        ]);
        $this->add_control('ic_body_bg', [
            'label'     => __( 'Background Color', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .trad-wa-cw-body' => 'background-color: {{VALUE}}' ],
        ]);
        $this->add_responsive_control('ic_body_padding', [
            'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('ic_body_min_height', [
            'label'      => __( 'Min Height', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'vh' ],
            'range'      => [ 'px' => [ 'min' => 60, 'max' => 600 ] ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-body' => 'min-height: {{SIZE}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('ic_body_max_height', [
            'label'      => __( 'Max Height', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'vh' ],
            'range'      => [ 'px' => [ 'min' => 80, 'max' => 800 ] ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-body' => 'max-height: {{SIZE}}{{UNIT}}; overflow-y: auto;' ],
        ]);
        $this->end_controls_section();

        /* ---- Chat Bubble ---- */
        $this->start_controls_section('style_ic_bubble', [
            'label'     => __( 'Chat Bubble', 'turbo-addons-elementor-pro' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'widget_mode' => 'inline_chat' ],
        ]);
        $this->add_responsive_control('ic_bubble_align', [
            'label'   => __( 'Bubble Alignment', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'left'   => [ 'title' => __('Left',   'turbo-addons-elementor-pro'), 'icon' => 'eicon-text-align-left'   ],
                'center' => [ 'title' => __('Center', 'turbo-addons-elementor-pro'), 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => __('Right',  'turbo-addons-elementor-pro'), 'icon' => 'eicon-text-align-right'  ],
            ],
            'default'   => 'left',
            'selectors' => [ '{{WRAPPER}} .trad-wa-cw-body' => 'text-align: {{VALUE}};' ],
        ]);
        $this->add_control('ic_bubble_bg', [
            'label'     => __( 'Bubble Background', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [ '{{WRAPPER}} .trad-wa-cw-bubble' => 'background-color: {{VALUE}}' ],
        ]);
        $this->add_responsive_control('ic_bubble_padding', [
            'label'      => __( 'Bubble Padding', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-bubble' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('ic_bubble_margin', [
            'label'      => __( 'Bubble Margin', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-bubble' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('ic_bubble_border_radius', [
            'label'      => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-bubble' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [ 'name' => 'ic_bubble_border', 'selector' => '{{WRAPPER}} .trad-wa-cw-bubble' ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [ 'name' => 'ic_bubble_shadow', 'selector' => '{{WRAPPER}} .trad-wa-cw-bubble' ]
        );
        $this->end_controls_section();

        /* ---- Sender Name ---- */
        $this->start_controls_section('style_ic_sender', [
            'label'     => __( 'Sender Name', 'turbo-addons-elementor-pro' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'widget_mode' => 'inline_chat' ],
        ]);
        $this->add_control('ic_sender_color', [
            'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#cc8b2f',
            'selectors' => [ '{{WRAPPER}} .trad-wa-cw-sender' => 'color: {{VALUE}}' ],
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'ic_sender_typography', 'selector' => '{{WRAPPER}} .trad-wa-cw-sender' ]
        );
        $this->add_responsive_control('ic_sender_margin', [
            'label'      => __( 'Margin', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-sender' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->end_controls_section();

        /* ---- Message Text ---- */
        $this->start_controls_section('style_ic_message', [
            'label'     => __( 'Message Text', 'turbo-addons-elementor-pro' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'widget_mode' => 'inline_chat' ],
        ]);
        $this->add_control('ic_bubble_text', [
            'label'     => __( 'Text Color', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#333333',
            'selectors' => [ '{{WRAPPER}} .trad-wa-cw-msg' => 'color: {{VALUE}}' ],
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'ic_msg_typography', 'selector' => '{{WRAPPER}} .trad-wa-cw-msg' ]
        );
        $this->end_controls_section();

        /* ---- Timestamp ---- */
        $this->start_controls_section('style_ic_time', [
            'label'     => __( 'Timestamp', 'turbo-addons-elementor-pro' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'widget_mode' => 'inline_chat' ],
        ]);
        $this->add_control('ic_time_color', [
            'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#aaaaaa',
            'selectors' => [ '{{WRAPPER}} .trad-wa-cw-time' => 'color: {{VALUE}}' ],
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'ic_time_typography', 'selector' => '{{WRAPPER}} .trad-wa-cw-time' ]
        );
        $this->add_responsive_control('ic_time_align', [
            'label'   => __( 'Alignment', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'left'   => [ 'title' => __('Left',   'turbo-addons-elementor-pro'), 'icon' => 'eicon-text-align-left'   ],
                'center' => [ 'title' => __('Center', 'turbo-addons-elementor-pro'), 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => __('Right',  'turbo-addons-elementor-pro'), 'icon' => 'eicon-text-align-right'  ],
            ],
            'default'   => 'right',
            'selectors' => [ '{{WRAPPER}} .trad-wa-cw-time' => 'text-align: {{VALUE}};' ],
        ]);
        $this->end_controls_section();
        $this->start_controls_section('section_ic_btn_style', [
            'label'     => __( 'Button Style', 'turbo-addons-elementor-pro' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'widget_mode' => 'inline_chat' ],
        ]);

        /* ---- Alignment ---- */
        $this->add_responsive_control('ic_btn_align', [
            'label'   => __( 'Button Alignment', 'turbo-addons-elementor-pro' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [ 'title' => __('Left',   'turbo-addons-elementor-pro'), 'icon' => 'eicon-text-align-left'   ],
                'center'     => [ 'title' => __('Center', 'turbo-addons-elementor-pro'), 'icon' => 'eicon-text-align-center' ],
                'flex-end'   => [ 'title' => __('Right',  'turbo-addons-elementor-pro'), 'icon' => 'eicon-text-align-right'  ],
            ],
            'selectors' => [ '{{WRAPPER}} .trad-wa-cw-btn' => 'align-self: {{VALUE}};' ],
        ]);

        /* ---- Layout controls (always visible) ---- */
        $this->add_responsive_control('ic_btn_padding', [
            'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'default'    => [ 'top' => '10', 'right' => '16', 'bottom' => '10', 'left' => '16', 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('ic_btn_margin', [
            'label'      => __( 'Margin', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('ic_btn_border_radius', [
            'label'      => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'default'    => [ 'top' => '30', 'right' => '30', 'bottom' => '30', 'left' => '30', 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('ic_btn_gap', [
            'label'      => __( 'Icon & Text Gap', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
            'default'    => [ 'size' => 8, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-cw-btn' => 'gap: {{SIZE}}{{UNIT}};' ],
        ]);

        /* ---- Avatar Size â€” only for avatar styles ---- */
        $this->add_responsive_control('ic_btn_avatar_size', [
            'label'      => __( 'Avatar Size', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 20, 'max' => 80 ] ],
            'default'    => [ 'size' => 36, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-btn-avatar' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
            'condition'  => [ 'ic_button_style' => [ 'avatar_name_sub', 'avatar_name' ] ],
        ]);

        /* ---- Avatar Border Radius ---- */
        $this->add_responsive_control('ic_btn_avatar_border_radius', [
            'label'      => __( 'Avatar Border Radius', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'default'    => [ 'top' => '50', 'right' => '50', 'bottom' => '50', 'left' => '50', 'unit' => '%' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-btn-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            'condition'  => [ 'ic_button_style' => [ 'avatar_name_sub', 'avatar_name' ] ],
        ]);

        /* ---- Avatar Border ---- */
        $this->add_control('ic_btn_avatar_border_color', [
            'label'     => __( 'Avatar Border Color', 'turbo-addons-elementor-pro' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => 'rgba(255,255,255,0.5)',
            'selectors' => [ '{{WRAPPER}} .trad-wa-btn-avatar' => 'border-color: {{VALUE}};' ],
            'condition' => [ 'ic_button_style' => [ 'avatar_name_sub', 'avatar_name' ] ],
        ]);
        $this->add_responsive_control('ic_btn_avatar_border_width', [
            'label'      => __( 'Avatar Border Width', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 10 ] ],
            'default'    => [ 'size' => 2, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .trad-wa-btn-avatar' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;' ],
            'condition'  => [ 'ic_button_style' => [ 'avatar_name_sub', 'avatar_name' ] ],
        ]);

        /* ---- Icon Size â€” only for icon_text style ---- */
        $this->add_responsive_control('ic_btn_icon_size', [
            'label'      => __( 'Icon Size', 'turbo-addons-elementor-pro' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em' ],
            'range'      => [ 'px' => [ 'min' => 10, 'max' => 80 ] ],
            'default'    => [ 'size' => 22, 'unit' => 'px' ],
            'selectors'  => [
                '{{WRAPPER}} .trad-wa-btn-icon'     => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .trad-wa-btn-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .trad-wa-btn-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
            'condition'  => [ 'ic_button_style' => 'icon_text' ],
        ]);

        /* ---- Name Typography â€” avatar styles ---- */
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ic_btn_name_typography',
                'label'     => __( 'Name Typography', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-wa-btn-name',
                'condition' => [ 'ic_button_style' => [ 'avatar_name_sub', 'avatar_name' ] ],
            ]
        );

        /* ---- Subtitle Typography â€” only avatar_name_sub ---- */
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ic_btn_sub_typography',
                'label'     => __( 'Subtitle Typography', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-wa-btn-sub',
                'condition' => [ 'ic_button_style' => 'avatar_name_sub' ],
            ]
        );

        /* ---- Button Text Typography â€” icon_text style ---- */
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ic_btn_text_typography',
                'label'     => __( 'Button Text Typography', 'turbo-addons-elementor-pro' ),
                'selector'  => '{{WRAPPER}} .trad-wa-btn-icon-text .trad-wa-btn-name',
                'condition' => [ 'ic_button_style' => 'icon_text' ],
            ]
        );

        /* ---- Normal / Hover Tabs ---- */
        $this->start_controls_tabs('ic_btn_color_tabs');

            /* === NORMAL === */
            $this->start_controls_tab('ic_btn_tab_normal', [
                'label' => __( 'Normal', 'turbo-addons-elementor-pro' ),
            ]);

            $this->add_control('ic_btn_bg_color', [
                'label'     => __( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .trad-wa-cw-btn' => 'background-color: {{VALUE}};' ],
            ]);

            /* Text color â€” avatar styles */
            $this->add_control('ic_btn_text_color', [
                'label'     => __( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-wa-btn-name' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-wa-btn-sub'  => 'color: {{VALUE}};',
                ],
                'condition' => [ 'ic_button_style' => [ 'avatar_name_sub', 'avatar_name' ] ],
            ]);

            /* Icon color â€” icon_text style */
            $this->add_control('ic_btn_icon_color', [
                'label'     => __( 'Icon Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-wa-btn-icon'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-wa-btn-icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-wa-btn-icon svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [ 'ic_button_style' => 'icon_text' ],
            ]);

            /* Button text color â€” icon_text style */
            $this->add_control('ic_btn_label_color', [
                'label'     => __( 'Button Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [ '{{WRAPPER}} .trad-wa-btn-icon-text .trad-wa-btn-name' => 'color: {{VALUE}};' ],
                'condition' => [ 'ic_button_style' => 'icon_text' ],
            ]);

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [ 'name' => 'ic_btn_border', 'selector' => '{{WRAPPER}} .trad-wa-cw-btn' ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [ 'name' => 'ic_btn_box_shadow', 'selector' => '{{WRAPPER}} .trad-wa-cw-btn' ]
            );

            $this->end_controls_tab();

            /* === HOVER === */
            $this->start_controls_tab('ic_btn_tab_hover', [
                'label' => __( 'Hover', 'turbo-addons-elementor-pro' ),
            ]);

            $this->add_control('ic_btn_bg_color_hover', [
                'label'     => __( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .trad-wa-cw-btn:hover' => 'background-color: {{VALUE}};' ],
            ]);

            /* Text color hover â€” avatar styles */
            $this->add_control('ic_btn_text_color_hover', [
                'label'     => __( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-wa-cw-btn:hover .trad-wa-btn-name' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-wa-cw-btn:hover .trad-wa-btn-sub'  => 'color: {{VALUE}};',
                ],
                'condition' => [ 'ic_button_style' => [ 'avatar_name_sub', 'avatar_name' ] ],
            ]);

            /* Icon color hover â€” icon_text style */
            $this->add_control('ic_btn_icon_color_hover', [
                'label'     => __( 'Icon Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-wa-cw-btn:hover .trad-wa-btn-icon'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-wa-cw-btn:hover .trad-wa-btn-icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-wa-cw-btn:hover .trad-wa-btn-icon svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [ 'ic_button_style' => 'icon_text' ],
            ]);

            /* Button text color hover â€” icon_text style */
            $this->add_control('ic_btn_label_color_hover', [
                'label'     => __( 'Button Text Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .trad-wa-cw-btn:hover .trad-wa-btn-icon-text .trad-wa-btn-name' => 'color: {{VALUE}};' ],
                'condition' => [ 'ic_button_style' => 'icon_text' ],
            ]);

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [ 'name' => 'ic_btn_border_hover', 'selector' => '{{WRAPPER}} .trad-wa-cw-btn:hover' ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [ 'name' => 'ic_btn_box_shadow_hover', 'selector' => '{{WRAPPER}} .trad-wa-cw-btn:hover' ]
            );
            $this->add_control('ic_btn_hover_transition', [
                'label'     => __( 'Transition Duration (s)', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 3, 'step' => 0.1 ] ],
                'default'   => [ 'size' => 0.3 ],
                'selectors' => [ '{{WRAPPER}} .trad-wa-cw-btn' => 'transition: all {{SIZE}}s ease;' ],
            ]);

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /* ==========================================================
     *  RENDER
     * ========================================================== */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $mode = $settings['widget_mode'] ?? 'inline_chat';

        if ( $mode === 'inline_chat' ) {
            $this->render_inline_chat( $settings );
        } else {
            $this->render_floating_multi( $settings );
        }
    }

    /* ----------------------------------------------------------
     *  INLINE CHAT WINDOW
     * ---------------------------------------------------------- */
    private function render_inline_chat( $settings ) {
        $name        = esc_html( $settings['ic_agent_name'] ?? '' );
        $tagline     = esc_html( $settings['ic_agent_tagline'] ?? '' );
        $raw_phone   = trim( $settings['ic_agent_phone'] ?? '' );
        $msg         = nl2br( esc_html( $settings['ic_default_msg'] ?? '' ) );
        $placeholder = esc_html( $settings['ic_reply_placeholder'] ?? 'Write to response' );
        $avatar_url  = esc_url( $settings['ic_agent_avatar']['url'] ?? '' );
        $color       = esc_attr( $settings['ic_theme_color'] ?? '#cc8b2f' );
        $btn_style   = $settings['ic_button_style'] ?? 'avatar_name_sub';
        $btn_text    = esc_html( $settings['ic_button_text'] ?? 'Contact us' );
        $btn_icon    = $settings['ic_btn_icon'] ?? [];

        // Button avatar: use separate upload if set, else fallback to agent avatar
        $btn_avatar_url = '';
        if ( ! empty( $settings['ic_btn_avatar']['url'] ) ) {
            $btn_avatar_url = esc_url( $settings['ic_btn_avatar']['url'] );
        } elseif ( ! empty( $settings['ic_agent_avatar']['url'] ) ) {
            $btn_avatar_url = esc_url( $settings['ic_agent_avatar']['url'] );
        }

        // Build WhatsApp link
        $phone_digits = preg_replace('/[^\d]/', '', $raw_phone );
        $wa_text      = rawurlencode( $settings['ic_default_msg'] ?? '' );
        $wa_link      = !empty($phone_digits)
            ? 'https://api.whatsapp.com/send?phone=' . $phone_digits . ( !empty($wa_text) ? '&text=' . $wa_text : '' )
            : '#';

        // Current time for the bubble
        $time = current_time('g:i A');
        ?>
        <div class="trad-wa-inline-wrapper">

            <!-- Chat Window Popup -->
            <div class="trad-wa-chatwin">

                <div class="trad-wa-cw-header" style="background-color:<?php echo $color; ?>">
                    <?php if ( $avatar_url ): ?>
                        <img class="trad-wa-cw-avatar" src="<?php echo $avatar_url; ?>" alt="<?php echo $name; ?>">
                    <?php else: ?>
                        <div class="trad-wa-cw-avatar trad-wa-cw-avatar-placeholder">
                            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm96 64H128c-70.7 0-128 57.3-128 128v32h448v-32c0-70.7-57.3-128-128-128z"/></svg>
                        </div>
                    <?php endif; ?>
                    <div class="trad-wa-cw-header-info">
                        <span class="trad-wa-cw-hname"><?php echo $name; ?></span>
                        <span class="trad-wa-cw-hstatus">
                            <span class="trad-wa-cw-dot"></span>
                            <?php echo $tagline; ?>
                        </span>
                    </div>
                </div>

                <div class="trad-wa-cw-body">
                    <div class="trad-wa-cw-bubble">
                        <div class="trad-wa-cw-sender"><?php echo $name; ?></div>
                        <div class="trad-wa-cw-msg"><?php echo $msg; ?></div>
                        <div class="trad-wa-cw-time"><?php echo $time; ?></div>
                    </div>
                </div>

                <a href="<?php echo esc_url($wa_link); ?>" target="<?php echo ($wa_link !== '#') ? '_blank' : '_self'; ?>" rel="noopener noreferrer" class="trad-wa-cw-footer">
                    <span class="trad-wa-cw-placeholder"><?php echo $placeholder; ?></span>
                    <span class="trad-wa-cw-send-btn" style="background-color:<?php echo $color; ?>">
                        <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M476.6 106.7L13.4 295.2c-15.8 6.8-14.8 28.5 1.6 33.9l99.4 32.4 38.9 119c4.7 14.4 23.2 18.2 33.1 6.9l56.1-63.6 107 83.3c12.5 9.7 30.5 2.5 33.5-13.2l76.9-377.7c3.4-16.5-13.2-29.8-28.3-23.5z"/></svg>
                    </span>
                </a>

            </div>

            <!-- Trigger Button -->
            <?php if ($btn_style === 'avatar_name_sub'): ?>
                <div class="trad-wa-cw-btn trad-wa-btn-avatar-sub" style="background-color:<?php echo $color; ?>">
                    <?php if ($btn_avatar_url): ?>
                        <img src="<?php echo $btn_avatar_url; ?>" alt="<?php echo $name; ?>" class="trad-wa-btn-avatar">
                    <?php endif; ?>
                    <div class="trad-wa-btn-info">
                        <span class="trad-wa-btn-name"><?php echo $name; ?></span>
                        <span class="trad-wa-btn-sub"><?php echo $tagline; ?></span>
                    </div>
                </div>

            <?php elseif ($btn_style === 'avatar_name'): ?>
                <div class="trad-wa-cw-btn trad-wa-btn-avatar-name" style="background-color:<?php echo $color; ?>">
                    <?php if ($btn_avatar_url): ?>
                        <img src="<?php echo $btn_avatar_url; ?>" alt="<?php echo $name; ?>" class="trad-wa-btn-avatar">
                    <?php endif; ?>
                    <span class="trad-wa-btn-name"><?php echo $name; ?></span>
                </div>

            <?php else: // icon_text ?>
                <div class="trad-wa-cw-btn trad-wa-btn-icon-text" style="background-color:<?php echo $color; ?>">
                    <span class="trad-wa-btn-icon">
                        <?php if ( ! empty( $btn_icon['value'] ) ) :
                            \Elementor\Icons_Manager::render_icon( $btn_icon, [ 'aria-hidden' => 'true' ] );
                        else: ?>
                            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                        <?php endif; ?>
                    </span>
                    <span class="trad-wa-btn-name"><?php echo $btn_text; ?></span>
                </div>
            <?php endif; ?>

        </div>
        <?php
    }

    /* ----------------------------------------------------------
     *  FLOATING MULTI-AGENT
     * ---------------------------------------------------------- */
    private function render_floating_multi( $settings ) {
        $wrapper_class = 'trad-whatsapp-wrapper';
        if ($settings['button_layout'] === 'fixed-right') {
            $wrapper_class .= ' trad-whatsapp-floating trad-whatsapp-floating-bottom-right';
        } elseif ($settings['button_layout'] === 'fixed-left') {
            $wrapper_class .= ' trad-whatsapp-floating trad-whatsapp-floating-bottom-left';
        } else {
            $wrapper_class .= ' trad-whatsapp-inline';
        }
        ?>
        <div class="<?php echo esc_attr($wrapper_class); ?>">

            <div class="trad-whatsapp-popup">
                <div class="trad-whatsapp-header">
                    <div class="trad-whatsapp-header-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                    </div>
                    <?php if (!empty($settings['header_title'])): ?>
                        <h4 class="trad-whatsapp-title"><?php echo esc_html($settings['header_title']); ?></h4>
                    <?php endif; ?>
                    <?php if (!empty($settings['header_subtitle'])): ?>
                        <p class="trad-whatsapp-subtitle"><?php echo esc_html($settings['header_subtitle']); ?></p>
                    <?php endif; ?>
                </div>

                <div class="trad-whatsapp-body">
                    <?php if (!empty($settings['agents'])): ?>
                        <?php foreach ($settings['agents'] as $agent):
                            $raw_phone   = trim($agent['agent_phone'] ?? '');
                            $phone_clean = preg_replace('/[^\d+]/', '', $raw_phone);
                            $phone_clean = preg_replace('/(?!^)\+/', '', $phone_clean);
                            $digits      = ltrim($phone_clean, '+');
                            $wa_text     = rawurlencode($agent['default_msg'] ?? '');
                            $link = !empty($digits)
                                ? 'https://api.whatsapp.com/send?phone=' . $digits . ($wa_text ? '&text=' . $wa_text : '')
                                : '#';
                        ?>
                        <a href="<?php echo esc_url($link); ?>" target="<?php echo ($link !== '#') ? '_blank' : '_self'; ?>" rel="noopener noreferrer" class="trad-whatsapp-agent elementor-repeater-item-<?php echo esc_attr($agent['_id']); ?>">
                            <?php if (!empty($agent['agent_avatar']['url'])): ?>
                                <div class="trad-whatsapp-agent-avatar">
                                    <img src="<?php echo esc_url($agent['agent_avatar']['url']); ?>" alt="<?php echo esc_attr($agent['agent_name']); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="trad-whatsapp-agent-info">
                                <h5 class="trad-whatsapp-agent-name"><?php echo esc_html($agent['agent_name']); ?></h5>
                                <p class="trad-whatsapp-agent-tagline"><?php echo esc_html($agent['agent_tagline']); ?></p>
                            </div>
                            <div class="trad-whatsapp-agent-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="trad-whatsapp-button">
                <?php if (!empty($settings['button_icon']['value'])): ?>
                    <span class="trad-whatsapp-icon elementor-icon">
                        <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
                    </span>
                <?php endif; ?>
                <?php if (!empty($settings['button_text'])): ?>
                    <span class="trad-whatsapp-text"><?php echo esc_html($settings['button_text']); ?></span>
                <?php endif; ?>
            </div>

        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Trad_Whatsapp_Widget() );
