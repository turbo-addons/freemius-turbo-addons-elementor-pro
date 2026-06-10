<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_CSV_Data_Table_Widget extends Widget_Base {

    public function get_name() {
        return 'csv-data-table';
    }

    public function get_title() {
        return __('CSV Data Table', 'freemius-turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-upload trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'csv_section',
            [
                'label' => __('CSV Data Table', 'freemius-turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'csv_upload',
            [
                'label' => __('CSV Data Table', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::MEDIA,
                'media_types' => ['text/csv'],
            ]
        );

        $this->add_control(
            'display_format',
            [
                'label' => __('Display Format', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'list' => __('List (ul>li)', 'freemius-turbo-addons-elementor-pro'),
                    'table' => __('Table', 'freemius-turbo-addons-elementor-pro'),
                ],
                'default' => 'list',
            ]
        );

        $this->add_control(
            'mobile_layout',
            [
                'label' => __('Mobile Layout', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'scroll' => __('Horizontal Scroll', 'freemius-turbo-addons-elementor-pro'),
                    'cards' => __('Stacked Cards', 'freemius-turbo-addons-elementor-pro'),
                ],
                'default' => 'scroll',
                'condition' => [
                    'display_format' => 'table',
                ],
            ]
        );

        $this->add_responsive_control(
            'mobile_breakpoint',
            [
                'label' => __('Mobile Breakpoint (px)', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 320,
                        'max' => 1024,
                    ],
                ],
                'default' => [
                    'size' => 768,
                ],
                'condition' => [
                    'display_format' => 'table',
                ],
            ]
        );

        $this->add_control(
            'enable_search',
            [
                'label' => __('Enable Search', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'freemius-turbo-addons-elementor-pro'),
                'label_off' => __('No', 'freemius-turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'enable_search',
            [
                'label' => __('Enable Search', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'freemius-turbo-addons-elementor-pro'),
                'label_off' => __('No', 'freemius-turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'search_placeholder',
            [
                'label' => __('Search Placeholder', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Search...', 'freemius-turbo-addons-elementor-pro'),
                'condition' => [
                    'enable_search' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'search_icon',
            [
                'label' => __('Search Icon', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-search',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_search' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'clear_icon',
            [
                'label' => __('Clear Icon', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-times',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_search' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // ---------------heading and description----------------
         $this->start_controls_section(
            'heading_and_description',
            [
                'label' => __('Heading & Descriptin', 'freemius-turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'table_heading_text',
            [
                'label' => __('Table Heading', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Data Table', 'freemius-turbo-addons-elementor-pro'),
                'placeholder' => __('Enter table heading', 'freemius-turbo-addons-elementor-pro'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'table_description',
            [
                'label' => __('Table Description', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('View and search through the data below. Use the search field to filter results.', 'freemius-turbo-addons-elementor-pro'),
                'placeholder' => __('Enter table description', 'freemius-turbo-addons-elementor-pro'),
                'rows' => 3,
            ]
        );


        $this->end_controls_section();

        // Pagination Section
        $this->start_controls_section(
            'pagination_section',
            [
                'label' => __('Pagination', 'freemius-turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_pagination',
            [
                'label' => __('Enable Pagination', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'freemius-turbo-addons-elementor-pro'),
                'label_off' => __('No', 'freemius-turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'rows_per_page',
            [
                'label' => __('Rows Per Page', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'min' => 1,
                'max' => 100,
                'condition' => [
                    'enable_pagination' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Search Style Section
        $this->start_controls_section(
            'search_style_section',
            [
                'label' => __('Search Field Style', 'freemius-turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_search' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'search_typography',
                'selector' => '{{WRAPPER}} .csv-search-input',
            ]
        );

        $this->add_control(
            'search_text_color',
            [
                'label' => __('Text Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .csv-search-input' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'search_bg_color',
            [
                'label' => __('Background Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .csv-search-input' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'search_border',
                'selector' => '{{WRAPPER}} .csv-search-input',
            ]
        );

        $this->add_responsive_control(
            'search_border_radius',
            [
                'label' => __('Border Radius', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .csv-search-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'search_padding',
            [
                'label' => __('Padding', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .csv-search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'search_margin',
            [
                'label' => __('Margin Bottom', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .csv-search-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_button_bg',
            [
                'label' => __('Toggle Button Background', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#6040e0',
                'selectors' => [
                    '{{WRAPPER}} .csv-search-toggle' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_button_color',
            [
                'label' => __('Toggle Button Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .csv-search-toggle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'search_icon_heading',
            [
                'label' => __('Search Icon', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'search_icon_size',
            [
                'label' => __('Icon Size', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .csv-search-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .csv-search-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'search_icon_color',
            [
                'label' => __('Icon Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666',
                'selectors' => [
                    '{{WRAPPER}} .csv-search-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .csv-search-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'clear_icon_heading',
            [
                'label' => __('Clear Icon', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'clear_icon_size',
            [
                'label' => __('Icon Size', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 18,
                ],
                'selectors' => [
                    '{{WRAPPER}} .csv-clear-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .csv-clear-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'clear_icon_color',
            [
                'label' => __('Icon Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#999',
                'selectors' => [
                    '{{WRAPPER}} .csv-clear-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .csv-clear-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'clear_icon_hover_color',
            [
                'label' => __('Icon Hover Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .csv-clear-icon:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .csv-clear-icon:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Heading & Description Style Section
        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => __('Heading & Description', 'freemius-turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_style_heading',
            [
                'label' => __('Heading', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .csv-table-heading',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __('Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .csv-table-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_align',
            [
                'label' => __('Alignment', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .csv-table-heading' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => __('Margin', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '15',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .csv-table-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_style_heading',
            [
                'label' => __('Description', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .csv-table-description',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .csv-table-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_align',
            [
                'label' => __('Alignment', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .csv-table-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label' => __('Margin', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '15',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .csv-table-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Pagination Style Section
        $this->start_controls_section(
            'pagination_style_section',
            [
                'label' => __('Pagination Style', 'freemius-turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_pagination' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_alignment',
            [
                'label' => __('Alignment', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .csv-pagination' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'enable_pagination' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pagination_typography',
                'selector' => '{{WRAPPER}} .csv-pagination button',
            ]
        );

        $this->add_responsive_control(
            'pagination_spacing',
            [
                'label' => __('Spacing Between Buttons', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                    ],
                ],
                'default' => [
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .csv-pagination button' => 'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_margin_top',
            [
                'label' => __('Margin Top', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .csv-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('pagination_tabs');

        // Normal State
        $this->start_controls_tab(
            'pagination_normal',
            [
                'label' => __('Normal', 'freemius-turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'pagination_text_color',
            [
                'label' => __('Text Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .csv-pagination button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_bg_color',
            [
                'label' => __('Background Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f5f5f5',
                'selectors' => [
                    '{{WRAPPER}} .csv-pagination button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pagination_border',
                'selector' => '{{WRAPPER}} .csv-pagination button',
            ]
        );

        $this->end_controls_tab();

        // Hover State
        $this->start_controls_tab(
            'pagination_hover',
            [
                'label' => __('Hover', 'freemius-turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'pagination_hover_text_color',
            [
                'label' => __('Text Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .csv-pagination button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_hover_bg_color',
            [
                'label' => __('Background Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#e0e0e0',
                'selectors' => [
                    '{{WRAPPER}} .csv-pagination button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_hover_border_color',
            [
                'label' => __('Border Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .csv-pagination button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Active State
        $this->start_controls_tab(
            'pagination_active',
            [
                'label' => __('Active', 'freemius-turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'pagination_active_text_color',
            [
                'label' => __('Text Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .csv-pagination button.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_active_bg_color',
            [
                'label' => __('Background Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#6040e0',
                'selectors' => [
                    '{{WRAPPER}} .csv-pagination button.active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_active_border_color',
            [
                'label' => __('Border Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#6040e0',
                'selectors' => [
                    '{{WRAPPER}} .csv-pagination button.active' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'pagination_padding',
            [
                'label' => __('Padding', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'default' => [
                    'top' => '8',
                    'right' => '15',
                    'bottom' => '8',
                    'left' => '15',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .csv-pagination button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'pagination_border_radius',
            [
                'label' => __('Border Radius', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => '4',
                    'right' => '4',
                    'bottom' => '4',
                    'left' => '4',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .csv-pagination button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Table Style Section
        $this->start_controls_section(
            'table_style_section',
            [
                'label' => __('Table Style', 'freemius-turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'display_format' => 'table',
                ],
            ]
        );

        $this->add_control(
            'table_heading',
            [
                'label' => __('Table', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'table_border',
                'selector' => '{{WRAPPER}} .csv-table-wrapper, {{WRAPPER}} .csv-table',
            ]
        );

        $this->add_responsive_control(
            'table_border_radius',
            [
                'label' => __('Border Radius', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .csv-table-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    '{{WRAPPER}} .csv-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'table_bg_color',
            [
                'label' => __('Background Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .csv-table' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cell_border_heading',
            [
                'label' => __('Cell Borders', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cell_border',
                'selector' => '{{WRAPPER}} .csv-table th, {{WRAPPER}} .csv-table td',
            ]
        );

        // Table Header Styles
        $this->add_control(
            'header_heading',
            [
                'label' => __('Table Header', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'header_typography',
                'selector' => '{{WRAPPER}} .csv-table thead th',
            ]
        );

        $this->add_control(
            'header_text_color',
            [
                'label' => __('Text Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .csv-table thead th' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'header_bg_color',
            [
                'label' => __('Background Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#6040e0',
                'selectors' => [
                    '{{WRAPPER}} .csv-table thead th' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_padding',
            [
                'label' => __('Padding', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'default' => [
                    'top' => '12',
                    'right' => '15',
                    'bottom' => '12',
                    'left' => '15',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .csv-table thead th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_align',
            [
                'label' => __('Text Align', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .csv-table thead th' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Table Body/Data Styles
        $this->add_control(
            'body_heading',
            [
                'label' => __('Table Body (Data)', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'body_typography',
                'selector' => '{{WRAPPER}} .csv-table tbody td',
            ]
        );

        $this->add_control(
            'body_text_color',
            [
                'label' => __('Text Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .csv-table tbody td' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'body_bg_color',
            [
                'label' => __('Background Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .csv-table tbody td' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'body_padding',
            [
                'label' => __('Padding', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'default' => [
                    'top' => '10',
                    'right' => '15',
                    'bottom' => '10',
                    'left' => '15',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .csv-table tbody td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'body_align',
            [
                'label' => __('Text Align', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'freemius-turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .csv-table tbody td' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Row Styles
        $this->add_control(
            'row_heading',
            [
                'label' => __('Table Rows', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'row_stripe',
            [
                'label' => __('Striped Rows', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'freemius-turbo-addons-elementor-pro'),
                'label_off' => __('No', 'freemius-turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'row_stripe_color',
            [
                'label' => __('Stripe Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f9f9f9',
                'selectors' => [
                    '{{WRAPPER}} .csv-table tbody tr:nth-child(even) td' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'row_stripe' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'row_hover_color',
            [
                'label' => __('Row Hover Color', 'freemius-turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f0f0f0',
                'selectors' => [
                    '{{WRAPPER}} .csv-table tbody tr:hover td' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $csv_file = $settings['csv_upload']['url'] ?? '';
        $display_format = $settings['display_format'] ?? 'list';
        $mobile_layout = $settings['mobile_layout'] ?? 'scroll';
        $mobile_breakpoint = $settings['mobile_breakpoint']['size'] ?? 768;
        $enable_search = $settings['enable_search'] ?? 'no';
        $search_placeholder = $settings['search_placeholder'] ?? 'Search...';
        $enable_pagination = $settings['enable_pagination'] ?? 'no';
        $rows_per_page = $settings['rows_per_page'] ?? 10;
        $widget_id = 'csv-widget-' . $this->get_id();

        if (empty($csv_file)) {
            echo '<p style="color:red;">No CSV file uploaded!</p>';
            return;
        }

        // Fetch CSV Data
        $csv_data = $this->parse_csv($csv_file);

        if (!empty($csv_data)) {
            echo '<div class="csv-container csv-mobile-' . esc_attr($mobile_layout) . '" id="' . esc_attr($widget_id) . '" data-rows-per-page="' . esc_attr($rows_per_page) . '" data-mobile-breakpoint="' . esc_attr($mobile_breakpoint) . '">';
            
            // Table Heading
            if (!empty($settings['table_heading_text'])) {
                echo '<h2 class="csv-table-heading">' . esc_html($settings['table_heading_text']) . '</h2>';
            }
            
            // Table Description
            if (!empty($settings['table_description'])) {
                echo '<div class="csv-table-description">' . wp_kses_post(nl2br($settings['table_description'])) . '</div>';
            }
            
            // Search Field (no toggle button)
            if ($enable_search === 'yes') {
                $search_func = 'searchTable_' . str_replace('-', '_', $widget_id);
                $clear_func = 'clearSearch_' . str_replace('-', '_', $widget_id);
                
                echo '<div class="csv-search-wrapper">';
                echo '<div class="csv-search-input-wrapper">';
                echo '<input type="text" class="csv-search-input" placeholder="' . esc_attr($search_placeholder) . '" oninput="' . esc_js($search_func) . '()">';
                
                // Search Icon
                echo '<span class="csv-search-icon">';
                \Elementor\Icons_Manager::render_icon($settings['search_icon'], ['aria-hidden' => 'true']);
                echo '</span>';
                
                // Clear Icon
                echo '<span class="csv-clear-icon" onclick="' . esc_js($clear_func) . '()" style="display:none;">';
                \Elementor\Icons_Manager::render_icon($settings['clear_icon'], ['aria-hidden' => 'true']);
                echo '</span>';
                
                echo '</div>';
                echo '</div>';
            }

            if ($display_format === 'list') {
                echo '<ul class="csv-list csv-searchable">';
                foreach ($csv_data as $index => $row) {
                    echo '<li class="csv-row" data-index="' . esc_attr($index) . '">';
                    foreach ($row as $cell) {
                        if ($this->is_image_url($cell)) {
                            echo '<img src="' . esc_url($cell) . '" alt="Image" style="max-width:100px; margin-right:10px;">';
                        } else {
                            echo esc_html($cell) . ' | ';
                        }
                    }
                    echo '</li>';
                }
                echo '</ul>';
            } else {
                // Table wrapper for responsive scroll
                echo '<div class="csv-table-wrapper">';
                echo '<table class="csv-table csv-searchable" border="1" cellpadding="5" cellspacing="0">';
                echo '<thead><tr>';
                foreach ($csv_data[0] as $header) {
                    echo '<th data-label="' . esc_attr($header) . '">' . esc_html($header) . '</th>';
                }
                echo '</tr></thead>';
                echo '<tbody>';
                for ($i = 1; $i < count($csv_data); $i++) {
                    echo '<tr class="csv-row" data-index="' . esc_attr($i) . '">';
                    $col_index = 0;
                    foreach ($csv_data[$i] as $cell) {
                        $header_label = isset($csv_data[0][$col_index]) ? $csv_data[0][$col_index] : '';
                        echo '<td data-label="' . esc_attr($header_label) . '">';
                        if ($this->is_image_url($cell)) {
                            echo '<img src="' . esc_url($cell) . '" alt="Image" style="max-width:100px;">';
                        } else {
                            echo esc_html($cell);
                        }
                        echo '</td>';
                        $col_index++;
                    }
                    echo '</tr>';
                }
                echo '</tbody></table>';
                echo '</div>';
            }
            
            // Pagination
            if ($enable_pagination === 'yes') {
                echo '<div class="csv-pagination"></div>';
            }
            
            echo '</div>';
            
            // Add inline JavaScript for search and pagination functionality
            ?>
            <script>
            (function() {
                const widgetId = '<?php echo esc_js($widget_id); ?>';
                const enablePagination = <?php echo $enable_pagination === 'yes' ? 'true' : 'false'; ?>;
                const rowsPerPage = <?php echo intval($rows_per_page); ?>;
                let currentPage = 1;

                function getVisibleRows() {
                    const rows = Array.from(document.querySelectorAll('#' + widgetId + ' .csv-row'));
                    return rows.filter(row => !row.hasAttribute('data-search-hidden'));
                }

                function initPagination() {
                    if (!enablePagination) return;
                    
                    const filteredRows = getVisibleRows();
                    const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
                    
                    const paginationContainer = document.querySelector('#' + widgetId + ' .csv-pagination');
                    
                    if (totalPages <= 1) {
                        paginationContainer.innerHTML = '';
                        // Show all filtered rows if only one page
                        filteredRows.forEach(row => {
                            row.removeAttribute('data-pagination-hidden');
                            row.style.display = '';
                        });
                        return;
                    }
                    
                    // Make sure current page is within bounds
                    if (currentPage > totalPages) {
                        currentPage = totalPages;
                    }
                    if (currentPage < 1) {
                        currentPage = 1;
                    }
                    
                    let paginationHTML = '';
                    
                    // First button
                    paginationHTML += '<button onclick="goToPage_' + widgetId.replace(/-/g, '_') + '(1)" ' + (currentPage === 1 ? 'disabled' : '') + '>First</button>';
                    
                    // Page numbers
                    for (let i = 1; i <= totalPages; i++) {
                        if (i === 1 || i === totalPages || (i >= currentPage - 2 && i <= currentPage + 2)) {
                            paginationHTML += '<button onclick="goToPage_' + widgetId.replace(/-/g, '_') + '(' + i + ')" class="' + (i === currentPage ? 'active' : '') + '">' + i + '</button>';
                        } else if (i === currentPage - 3 || i === currentPage + 3) {
                            paginationHTML += '<span style="padding: 8px;">...</span>';
                        }
                    }
                    
                    // Last button
                    paginationHTML += '<button onclick="goToPage_' + widgetId.replace(/-/g, '_') + '(' + totalPages + ')" ' + (currentPage === totalPages ? 'disabled' : '') + '>Last</button>';
                    
                    paginationContainer.innerHTML = paginationHTML;
                    
                    displayPage(filteredRows);
                }

                function displayPage(filteredRows) {
                    if (!enablePagination) return;
                    
                    const start = (currentPage - 1) * rowsPerPage;
                    const end = start + rowsPerPage;
                    
                    // Show only the rows for current page
                    filteredRows.forEach((row, index) => {
                        if (index >= start && index < end) {
                            row.style.display = '';
                            row.removeAttribute('data-pagination-hidden');
                        } else {
                            row.style.display = 'none';
                            row.setAttribute('data-pagination-hidden', 'true');
                        }
                    });
                }

                window['goToPage_' + widgetId.replace(/-/g, '_')] = function(page) {
                    currentPage = page;
                    initPagination();
                };

                window['searchTable_' + widgetId.replace(/-/g, '_')] = function() {
                    const input = document.querySelector('#' + widgetId + ' .csv-search-input');
                    const searchIcon = document.querySelector('#' + widgetId + ' .csv-search-icon');
                    const clearIcon = document.querySelector('#' + widgetId + ' .csv-clear-icon');
                    const filter = input.value.toLowerCase();
                    const rows = document.querySelectorAll('#' + widgetId + ' .csv-row');
                    
                    // Toggle icons based on input value
                    if (input.value.length > 0) {
                        if (searchIcon) searchIcon.style.display = 'none';
                        if (clearIcon) clearIcon.style.display = 'flex';
                    } else {
                        if (searchIcon) searchIcon.style.display = 'flex';
                        if (clearIcon) clearIcon.style.display = 'none';
                    }
                    
                    // Filter rows
                    rows.forEach(function(row) {
                        const text = row.textContent || row.innerText;
                        if (text.toLowerCase().indexOf(filter) > -1) {
                            row.removeAttribute('data-search-hidden');
                            if (!enablePagination) {
                                row.style.display = '';
                            }
                        } else {
                            row.setAttribute('data-search-hidden', 'true');
                            row.style.display = 'none';
                        }
                    });
                    
                    // Reset to page 1 and reinit pagination if enabled
                    if (enablePagination) {
                        currentPage = 1;
                        initPagination();
                    }
                };

                window['clearSearch_' + widgetId.replace(/-/g, '_')] = function() {
                    const input = document.querySelector('#' + widgetId + ' .csv-search-input');
                    const searchIcon = document.querySelector('#' + widgetId + ' .csv-search-icon');
                    const clearIcon = document.querySelector('#' + widgetId + ' .csv-clear-icon');
                    
                    input.value = '';
                    if (searchIcon) searchIcon.style.display = 'flex';
                    if (clearIcon) clearIcon.style.display = 'none';
                    
                    // Remove search hidden attribute from all rows
                    const rows = document.querySelectorAll('#' + widgetId + ' .csv-row');
                    rows.forEach(function(row) {
                        row.removeAttribute('data-search-hidden');
                        if (!enablePagination) {
                            row.style.display = '';
                        }
                    });
                    
                    // Focus back on input
                    input.focus();
                    
                    // Reset to page 1 and reinit pagination if enabled
                    if (enablePagination) {
                        currentPage = 1;
                        initPagination();
                    }
                };

                // Initialize pagination on load
                if (enablePagination) {
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', function() {
                            setTimeout(initPagination, 100);
                        });
                    } else {
                        setTimeout(initPagination, 100);
                    }
                }
            })();
            </script>
            <style>
            .csv-table-heading {
                font-size: 24px;
                font-weight: 600;
                line-height: 1.3;
                margin: 0 0 15px 0;
            }
            
            .csv-table-description {
                font-size: 14px;
                line-height: 1.6;
                margin: 0 0 15px 0;
            }
            
            .csv-search-wrapper {
                margin-bottom: 20px;
            }
            .csv-search-input-wrapper {
                position: relative;
                width: 100%;
            }
            .csv-search-input {
                width: 100%;
                padding: 12px 45px 12px 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 14px;
                box-sizing: border-box;
                transition: all 0.3s ease;
            }
            .csv-search-input:focus {
                outline: none;
                border-color: #999;
                box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1);
            }
            .csv-search-icon,
            .csv-clear-icon {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                display: flex;
                align-items: center;
                justify-content: center;
                pointer-events: none;
            }
            .csv-clear-icon {
                cursor: pointer;
                pointer-events: auto;
                transition: all 0.2s ease;
            }
            .csv-clear-icon:hover {
                opacity: 0.7;
            }
            .csv-container {
                margin: 20px 0;
            }
            
            /* Table Wrapper for Horizontal Scroll */
            .csv-table-wrapper {
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                border-collapse: separate;
            }
            
            .csv-table {
                width: 100%;
                border-collapse: collapse;
                min-width: 600px;
                border-spacing: 0;
                margin: 0;
                margin-bottom: 0 !important;
            }
            
            .csv-table tbody {
                margin: 0;
            }
            
            .csv-table tbody tr:last-child td {
                margin-bottom: 0;
            }
            
            /* Mobile Responsive - Horizontal Scroll (Default) */
            @media screen and (max-width: <?php echo intval($mobile_breakpoint); ?>px) {
                .csv-mobile-scroll .csv-table-wrapper {
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                }
                
                .csv-mobile-scroll .csv-table {
                    margin: 0;
                }
            }
            
            /* Mobile Responsive - Stacked Cards */
            @media screen and (max-width: <?php echo intval($mobile_breakpoint); ?>px) {
                .csv-mobile-cards .csv-table-wrapper {
                    overflow-x: visible;
                }
                
                .csv-mobile-cards .csv-table {
                    min-width: 100%;
                }
                
                .csv-mobile-cards .csv-table thead {
                    display: none;
                }
                
                .csv-mobile-cards .csv-table tbody tr {
                    display: block;
                    margin-bottom: 15px;
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    padding: 15px;
                    background: #fff;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                }
                
                .csv-mobile-cards .csv-table tbody td {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 10px 0;
                    border: none;
                    border-bottom: 1px solid #f0f0f0;
                    text-align: right;
                }
                
                .csv-mobile-cards .csv-table tbody td:last-child {
                    border-bottom: none;
                }
                
                .csv-mobile-cards .csv-table tbody td:before {
                    content: attr(data-label);
                    font-weight: bold;
                    text-align: left;
                    flex: 0 0 40%;
                    padding-right: 10px;
                }
                
                .csv-mobile-cards .csv-table tbody td img {
                    max-width: 60px !important;
                }
            }
            
            /* Pagination Styles */
            .csv-pagination {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 20px;
            }
            .csv-pagination button {
                padding: 8px 15px;
                margin: 0 5px;
                border: 1px solid #ddd;
                background-color: #f5f5f5;
                color: #333;
                cursor: pointer;
                border-radius: 4px;
                font-size: 14px;
                transition: all 0.3s ease;
            }
            .csv-pagination button:hover:not(:disabled) {
                background-color: #e0e0e0;
            }
            .csv-pagination button.active {
                background-color: #6040e0;
                color: #fff;
                border-color: #6040e0;
            }
            .csv-pagination button:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }
            
            /* Mobile Pagination */
            @media screen and (max-width: 480px) {
                .csv-pagination button {
                    padding: 6px 10px;
                    margin: 2px;
                    font-size: 12px;
                }
            }
            </style>
            <?php
        } else {
            echo '<p style="color:red;">Invalid or empty CSV file.</p>';
        }
    }

    private function parse_csv($file_url) {
        $csv_data = [];
        $file_path = str_replace(get_site_url(), ABSPATH, $file_url); // Convert URL to file path

        global $wp_filesystem;

        // Initialize WP_Filesystem
        if ( empty( $wp_filesystem ) ) {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem();
        }

        if ( $wp_filesystem->exists( $file_path ) ) {
            $contents = $wp_filesystem->get_contents( $file_path );
            if ( $contents ) {
                $lines = explode( "\n", $contents );
                foreach ( $lines as $line ) {
                    $row = str_getcsv( $line, ',' );
                    if ( ! empty( $row ) ) {
                        $csv_data[] = $row;
                    }
                }
            }
        }

        return $csv_data;
    }


    private function is_image_url($url) {
        return preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $url);
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_CSV_Data_Table_Widget());
