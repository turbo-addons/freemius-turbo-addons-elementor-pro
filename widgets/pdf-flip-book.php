<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Plugin;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Trad_Flip_Book extends Widget_Base {

    public function get_name() {
        return 'trad-flip-book';
    }

    public function get_title() {
        return esc_html__('PDF Flip Book', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-library-open trad-icon'; // Choose an appropriate icon
    }

    public function get_categories() {
        return ['turbo-addons-pro']; // Change to your desired category
    }

    public function get_keywords() {
        return [ 'Flip', 'Flip Book', '3D', '3D Book', 'Flipper', 'PDF', 'Book' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('PDF Library', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_title',
            [
                'label'       => __('Title', 'turbo-addons-elementor-pro'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Item Title', 'turbo-addons-elementor-pro'),
                'label_block' => true,
                'description' => __('Only Show 15 characters', 'turbo-addons-elementor-pro'), // UI hint
            ]
        );

        $repeater->add_control(
            'item_type',
            [
                'label'   => __('Select Type', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => __('Image', 'turbo-addons-elementor-pro'),
                    'icon'  => __('Icon', 'turbo-addons-elementor-pro'),
                ],
                'description' => __('Choose Image or Icon. The same option must be selected under Style → Sidebar Tab Item for styling.', 'turbo-addons-elementor-pro'),
            ]
        );
        $repeater->add_control(
            'item_image',
            [
                'label' => __('Feature Image', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'item_type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'item_icon',
            [
                'label' => esc_html__('Icon', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'solid',
                ],
                'condition' => [
                    'item_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'item_url',
            [
                'label' => __('URL', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://example.com', 'turbo-addons-elementor-pro'),
                'description' => __('Upload your PDF anywhere and paste the live link here. Only public links work, local URLs not supported.', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'items_list',
            [
                'label' => __('Items', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_title' => __('Item #1', 'turbo-addons-elementor-pro'),
                        'item_image' => ['url' => Utils::get_placeholder_image_src()],
                        'item_url' => ['url' => '#'],
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'pdf_box_section',
            [
                'label' => esc_html__('Box', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'pdf_box_background_color',
                'label'    => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'], 
                'selector' => '{{WRAPPER}} .trad-pdf-ifram-section',
            ]
        );

        $this->add_responsive_control(
            'pdf_box_padding',
            [
                'label' => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-pdf-ifram-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top'    => 20,
                    'right'  => 20,
                    'bottom' => 20,
                    'left'   => 20,
                    'unit'   => 'px',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'pdf_box_border',
                'label'    => esc_html__('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-pdf-ifram-section',
            ]
        );

        $this->add_responsive_control(
            'pdf_box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-pdf-ifram-section' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pdf_heading_section',
            [
                'label' => esc_html__('Heading', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // ------------------ Title Color ------------------
        $this->add_control(
            'trad_pdf_flip_book_title_color',
            [
                'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .trad-pdf-flip-book-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // ------------------ Title Typography ------------------
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_pdf_flip_book_title_typography',
                'label'    => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-pdf-flip-book-title',
            ]
        );

        // ------------------ Title Alignment ------------------
        $this->add_responsive_control(
            'trad_pdf_flip_book_title_alignment',
            [
                'label'   => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .trad-pdf-flip-book-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // ------------------ Title Margin ------------------
        $this->add_responsive_control(
            'trad_pdf_flip_book_title_margin',
            [
                'label'      => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-pdf-flip-book-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top'      => 0,
                    'right'    => 0,
                    'bottom'   => 15,
                    'left'     => 0,
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        // ------------------ Title Padding ------------------
        $this->add_responsive_control(
            'trad_pdf_flip_book_title_padding',
            [
                'label'      => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-pdf-flip-book-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'trad_active_item_section',
            [
                'label' => esc_html__('Active Item', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'trad_pdf_tab_item_active_color',
            [
                'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type'  => Controls_Manager::COLOR,
                'default' => '#424242ff',
                'selectors' => [
                    '{{WRAPPER}} .pdf-side-sidebar-section li.active, 
                    {{WRAPPER}} .pdf-side-sidebar-section li.active *' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'trad_pdf_tab_item_active_background_color',
                'label'    => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pdf-side-sidebar-section li.active',
            ]
        );

        // ================== Active Border ==================
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trad_pdf_tab_item_active_border',
                'label'    => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .pdf-side-sidebar-section li.active',
            ]
        );

        // ================== Active Border Radius ==================
        $this->add_responsive_control(
            'trad_pdf_tab_item_active_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pdf-side-sidebar-section li.active' =>
                        'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
         // Start Section for Layout Controls
         $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Layout Settings', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Flex Direction Control with Icons
        $this->add_responsive_control(
            'trad_pdf_flip_book_flex_direction',
            [
                'label' => esc_html__('Direction', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Row', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'column' => [
                        'title' => esc_html__('Column', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__('Row Reverse', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__('Column Reverse', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'row',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .trad-pdf-viewer-widget-container' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'section_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'vw'], // Allow multiple units
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1920,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 5,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'vw' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-pdf-viewer-widget-container' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
          );

          $this->add_control(
            'trad_pdf_sidebar_section_spacing_heading',
            [
                'label'     => esc_html__( 'Spacing', 'turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'trad_pdf_iframe_section_margin_right',
            [
                'label' => esc_html__( 'Space', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-pdf-ifram-section' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'trad_pdf_flip_book_flex_direction' => [ 'row' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_pdf_iframe_section_margin_right_row_reverse',
            [
                'label' => esc_html__( 'Space', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-pdf-ifram-section' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'trad_pdf_flip_book_flex_direction' => [ 'row-reverse' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_pdf_iframe_section_margin_right_column',
            [
                'label' => esc_html__( 'Space', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-pdf-ifram-section' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'trad_pdf_flip_book_flex_direction' => [ 'column' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_pdf_iframe_section_margin_right_column_reverse',
            [
                'label' => esc_html__( 'Space', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-pdf-ifram-section' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'trad_pdf_flip_book_flex_direction' => [ 'column-reverse' ],
                ],
            ]
        );

        $this->end_controls_section();

        // Start Section for Layout Controls
        $this->start_controls_section(
            'pdf_tab_section',
            [
                'label' => esc_html__('Sidebar Tab', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'pdf_tab_sidebar_background',
                'label'    => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'], 
                'selector' => '{{WRAPPER}} .pdf-side-sidebar-section',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'pdf_tab_sidebar_border',
                'label'    => esc_html__('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .pdf-side-sidebar-section',
            ]
        );

        $this->add_responsive_control(
            'pdf_tab_sidebar_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pdf-side-sidebar-section' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Flex Direction Control with Icons
        $this->add_responsive_control(
            'tab_flex_direction',
            [
                'label' => esc_html__('Direction', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Row', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'column' => [
                        'title' => esc_html__('Column', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__('Row Reverse', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__('Column Reverse', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'column-reverse',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .pdf-side-sidebar-section' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        // Sidebar Width Control
            $this->add_responsive_control(
                'tab_bar_width',
                [
                    'label' => esc_html__('Width', 'turbo-addons-elementor-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'vw'],
                    'range' => [
                        '%' => ['min' => 10, 'max' => 100],
                        'px' => ['min' => 100, 'max' => 1920],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tab_justify_content',
                [
                    'label' => esc_html__('Alignment', 'turbo-addons-elementor-pro'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-end' => [
                            'title' => esc_html__('Start', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-text-align-right',
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        
                        'flex-start' => [
                            'title' => esc_html__('End', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'space-between' => [
                            'title' => esc_html__('Space Between', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-flex eicon-justify-space-between-h',
                        ],
                        'space-around' => [
                            'title' => esc_html__('Space Around', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-flex eicon-justify-space-around-h',
                        ],
                        'space-evenly' => [
                            'title' => esc_html__('Space Evenly', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-flex eicon-justify-space-evenly-h',
                        ],
                    ],
                    'default' => 'flex-end',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'pdf_tab_item_section',
                [
                    'label' => esc_html__('Sidebar Tab Item', 'turbo-addons-elementor-pro'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'item_type',
                [
                    'label'   => __('Item Type', 'turbo-addons-elementor-pro'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'image',
                    'options' => [
                        'image' => __('Image', 'turbo-addons-elementor-pro'),
                        'icon'  => __('Icon', 'turbo-addons-elementor-pro'),
                    ],
                    'description' => __('Choose Image or Icon. Make sure the same option is selected in Content → PDF Library → Items → Select Type.', 'turbo-addons-elementor-pro'),
                ]
            );

            $this->start_controls_tabs( 'trad_pdf_tab_section_tab' );
            //  Controls tab For Back
            $this->start_controls_tab(
                'trad_pdf_tab_section_normal',
                [
                    'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
                ]
            );

            $this->add_control(
                'trad_pdf_tab_item_body_style_heading',
                [
                    'label'     => esc_html__( 'Body', 'turbo-addons-elementor-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after', // optional: ekta line separator dibe
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'trad_pdf_tab_item_border',
                    'label'    => esc_html__('Border', 'turbo-addons-elementor-pro'),
                    'selector' => '{{WRAPPER}} .pdf-side-sidebar-section li',
                ]
            );

            $this->add_control(
                'trad_pdf_tab_item_icon_style_heading',
                [
                    'label'     => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after', // optional: ekta line separator dibe
                    'condition' => [
                        'item_type' => 'icon',
                    ],
                ]
            );

            // ================== Icon Color ==================
            $this->add_control(
                'trad_pdf_tab_icon_color',
                [
                    'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#000000',
                    'selectors' => [
                        '{{WRAPPER}} .trad-pdf-list-item i'   => 'color: {{VALUE}};',
                        '{{WRAPPER}} .trad-pdf-list-item svg' => 'fill: {{VALUE}};',
                    ],
                    'condition' => [
                        'item_type' => 'icon',
                    ],
                ]
            );

            // ================== Icon Size ==================
            $this->add_responsive_control(
                'trad_pdf_tab_icon_size',
                [
                    'label' => esc_html__( 'Size', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'size' => 24,
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .trad-pdf-list-item i'   => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .trad-pdf-list-item svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'item_type' => 'icon',
                    ],
                ]
            );

            // ================== Icon Margin ==================
            $this->add_responsive_control(
                'trad_pdf_tab_icon_margin',
                [
                    'label'      => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors'  => [
                        '{{WRAPPER}} .trad-pdf-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'default' => [
                        'top'      => 0,
                        'right'    => 10,
                        'bottom'   => 0,
                        'left'     => 0,
                        'unit'     => 'px',
                        'isLinked' => false,
                    ],
                    'condition' => [
                        'item_type' => 'icon',
                    ],
                ]
            );

            // ================== Icon Padding ==================
            $this->add_responsive_control(
                'trad_pdf_tab_icon_padding',
                [
                    'label'      => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors'  => [
                        '{{WRAPPER}} .trad-pdf-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'item_type' => 'icon',
                    ],
                ]
            );

            // ================== Icon Border ==================
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'trad_pdf_tab_icon_border',
                    'label'    => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                    'selector' => '{{WRAPPER}} .trad-pdf-list-item',
                    'condition' => [
                        'item_type' => 'icon',
                    ],
                ]
            );

            // ================== Icon Border Radius ==================
            $this->add_responsive_control(
                'trad_pdf_tab_icon_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .trad-pdf-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'item_type' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'trad_pdf_tab_item_image_style_heading',
                [
                    'label'     => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after', // optional: ekta line separator dibe
                    'condition' => [
                        'item_type' => 'image',
                    ],
                ]
            );

            // ================== Image Width ==================
            $this->add_responsive_control(
                'trad_pdf_tab_item_image_width',
                [
                    'label' => esc_html__( 'Width', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 50,
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'item_type' => 'image',
                    ],
                ]
            );

            // ================== Image Height ==================
            $this->add_responsive_control(
                'trad_pdf_tab_item_image_height',
                [
                    'label' => esc_html__( 'Height', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 50,
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li img' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'item_type' => 'image',
                    ],
                ]
            );

            // ================== Image Margin ==================
            $this->add_responsive_control(
                'trad_pdf_tab_item_image_margin',
                [
                    'label' => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'item_type' => 'image',
                    ],
                ]
            );

            $this->add_responsive_control(
                'trad_pdf_tab_item_image_padding',
                [
                    'label' => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'item_type' => 'image',
                    ],
                ]
            );

            // ================== Border Control ==================
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'trad_pdf_tab_item_image_border',
                    'label'    => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                    'selector' => '{{WRAPPER}} .pdf-side-sidebar-section li img',
                    'condition' => [
                        'item_type' => 'image',
                    ],
                ]
            );

            // ================== Border Radius ==================
            $this->add_responsive_control(
                'trad_pdf_tab_item_image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'item_type' => 'image',
                    ],
                ]
            );

            $this->add_control(
                'trad_pdf_tab_item_text_style_heading',
                [
                    'label'     => esc_html__( 'Text', 'turbo-addons-elementor-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after', // optional: ekta line separator dibe
                ]
            );

            $this->add_control(
                'trad_pdf_tab_item_color',
                [
                    'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                    'type'  => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section p' => 'color: {{VALUE}};',
                    ],
                    'default' => '#3A3939',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'trad_pdf_tab_item_typography',
                    'label' => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
                    'selector' => '{{WRAPPER}} .pdf-side-sidebar-section p',
                ]
            );

            // ================== Margin ==================
            $this->add_responsive_control(
                'trad_pdf_tab_item_margin',
                [
                    'label' => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // ================== Padding ==================
            $this->add_responsive_control(
                'trad_pdf_tab_item_padding',
                [
                    'label' => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'trad_pdf_tab_section_hover',
                [
                    'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
                ]
            );
            $this->add_control(
                'trad_pdf_tab_item_heading_hover',
                [
                    'label'     => esc_html__( 'Body', 'turbo-addons-elementor-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after', // optional: ekta line separator dibe
                ]
            );
            $this->add_control(
                'trad_pdf_tab_section_hover_transition',
                [
                    'label' => esc_html__('Transition', 'turbo-addons-elementor-pro'),
                    'type'  => Controls_Manager::SLIDER,
                    'size_units' => ['s'],
                    'range' => [
                        's' => [
                            'min' => 0.1,
                            'max' => 10,
                            'step' => 0.1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li, 
                        {{WRAPPER}} .pdf-side-sidebar-section li *' => 'transition: all {{SIZE}}{{UNIT}} ease;',
                    ],
                    'default' => [
                        'size' => 0.3,
                        'unit' => 's',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'     => 'trad_pdf_tab_item_hover_background_color',
                    'label'    => esc_html__('Background', 'turbo-addons-elementor-pro'),
                    'types'    => ['classic', 'gradient'], 
                    'selector' => '{{WRAPPER}} .pdf-side-sidebar-section li:hover',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'trad_pdf_tab_item_hover_border',
                    'label'    => esc_html__('Border', 'turbo-addons-elementor-pro'),
                    'selector' => '{{WRAPPER}} .pdf-side-sidebar-section li:hover',
                ]
            );
            $this->add_responsive_control(
                'trad_pdf_tab_item_hover_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'trad_pdf_tab_item_heading_text_hover',
                [
                    'label'     => esc_html__( 'Text', 'turbo-addons-elementor-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after', // optional: ekta line separator dibe
                ]
            );
            // Hover Color
            $this->add_control(
                'trad_pdf_tab_item_hover_color',
                [
                    'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                    'type'  => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li:hover, 
                        {{WRAPPER}} .pdf-side-sidebar-section li:hover *' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Hover Typography
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'trad_pdf_tab_item_hover_typography',
                    'label' => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
                    'selector' => '{{WRAPPER}} .pdf-side-sidebar-section li:hover, {{WRAPPER}} .pdf-side-sidebar-section li:hover *',
                ]
            );

            // ================== Hover Margin ==================
            $this->add_responsive_control(
                'trad_pdf_tab_item_hover_margin',
                [
                    'label' => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // ================== Hover Padding ==================
            $this->add_responsive_control(
                'trad_pdf_tab_item_hover_padding',
                [
                    'label' => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'trad_pdf_tab_item_heading_icon_hover',
                [
                    'label'     => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after', // optional: ekta line separator dibe
                    'condition' => [
                        'item_type' => 'icon',
                    ],
                ]
            );

            // ================== Icon Hover Color ==================
            $this->add_control(
                'trad_pdf_tab_icon_hover_color',
                [
                    'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li:hover .trad-pdf-list-item i'   => 'color: {{VALUE}};',
                        '{{WRAPPER}} .pdf-side-sidebar-section li:hover .trad-pdf-list-item svg' => 'fill: {{VALUE}};',
                    ],
                ]
            );

            // ================== Icon Hover Size ==================
            $this->add_responsive_control(
                'trad_pdf_tab_icon_hover_size',
                [
                    'label' => esc_html__( 'Size', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li:hover .trad-pdf-list-item i'   => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pdf-side-sidebar-section li:hover .trad-pdf-list-item svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // ================== Icon Hover Border ==================
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'trad_pdf_tab_icon_hover_border',
                    'label'    => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
                    'selector' => '{{WRAPPER}} .pdf-side-sidebar-section li:hover .trad-pdf-list-item',
                ]
            );

            // ================== Icon Hover Border Radius ==================
            $this->add_responsive_control(
                'trad_pdf_tab_icon_hover_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li:hover .trad-pdf-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );



            $this->add_control(
                'trad_pdf_tab_item_heading_image_hover',
                [
                    'label'     => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after', // optional: ekta line separator dibe
                    'condition' => [
                        'item_type' => 'image',
                    ],
                ]
            );

            // ================== Hover Border Control ==================
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'trad_pdf_tab_item_image_hover_border',
                    'label'    => esc_html__( 'Border (Hover)', 'turbo-addons-elementor-pro' ),
                    'selector' => '{{WRAPPER}} .pdf-side-sidebar-section li:hover img',
                    'condition' => [
                        'item_type' => 'image',
                    ],
                ]
            );

            // ================== Hover Border Radius ==================
            $this->add_responsive_control(
                'trad_pdf_tab_item_image_hover_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .pdf-side-sidebar-section li:hover img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'item_type' => 'image',
                    ],
                ]
            );

            $this->end_controls_tab();
            $this->end_controls_tabs();
            $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $items = $settings['items_list'];
    
        // Define the fixed base URL
        $base_url = 'http://flowpaper.com/flipbook/';
    
        if (empty($items)) return;
    
        // Get the last added item for the main section
        $last_item = end($items);
        $raw_title = ! empty( $last_item['item_title'] ) ? $last_item['item_title'] : '';
        $short_title = ( strlen( $raw_title ) > 15 ) ? substr( $raw_title, 0, 15 ) . '...' : $raw_title;
        ?>
        <div class="trad-pdf-viewer-widget-container">
            <div class="trad-pdf-ifram-section">
                <h3 class="trad-pdf-flip-book-title"><?php echo esc_html($short_title); ?></h3>
                <iframe id="flipbook-iframe" 
                        class="trad-flip-book-pdf-ifram"
                        src="<?php echo esc_url($base_url . $last_item['item_url']['url']); ?>" 
                        style="border: none;" allowfullscreen>
                </iframe>
            </div>
            <div class="pdf-side-sidebar-section">
                    <?php foreach (array_reverse($items) as $index => $item) : 
                            $raw_title = ! empty( $item['item_title'] ) ? $item['item_title'] : '';
                            $short_title = ( strlen( $raw_title ) > 15 ) ? substr( $raw_title, 0, 15 ) . '...' : $raw_title;
                    ?>
                        <li data-index="<?php echo esc_attr($index); ?>" 
                            data-title="<?php echo esc_attr($item['item_title']); ?>" 
                            data-image="<?php echo esc_url($item['item_image']['url']); ?>" 
                            data-url="<?php echo esc_attr($item['item_url']['url']); ?>">
                            <?php if ( $item['item_type'] === 'image' && !empty($item['item_image']['url']) ) : ?>
                                <img src="<?php echo esc_url($item['item_image']['url']); ?>" alt="Image">
                            <?php elseif ( $item['item_type'] === 'icon' && !empty($item['item_icon']['value']) ) : ?>
                                <span class="trad-pdf-list-item">
                                    <?php Icons_Manager::render_icon( $item['item_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                            <?php endif; ?>
                            <p><?php echo esc_html($short_title); ?></p>
                        </li>
                    <?php endforeach; ?>
            </div>
        </div>
        <script>
        jQuery(document).ready(function($) {
            const baseURL = "http://flowpaper.com/flipbook/"; // Fixed base URL

            $('.pdf-side-sidebar-section li').first().addClass('active');
    
            $('.pdf-side-sidebar-section li').on('click', function() {
                var title = $(this).data('title');
                // var image = $(this).data('image');
                var url = $(this).data('url'); // Only the dynamic part of the URL

                // sobar active remove
                $('.pdf-side-sidebar-section li').removeClass('active');

                // current li active hobe
                $(this).addClass('active');
    
                // Update the main section dynamically
                $('.trad-pdf-ifram-section h3').text(title);
                // $('.trad-pdf-ifram-section img').attr('src', image);
                $('#flipbook-iframe').attr('src', baseURL + url); // Construct iframe URL dynamically
            });
        });
        </script>
        <?php
    }
    

}
// Register the widget with Elementor.
Plugin::instance()->widgets_manager->register_widget_type( new Trad_Flip_Book() );