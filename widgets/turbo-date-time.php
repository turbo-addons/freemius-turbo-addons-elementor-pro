<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_Date_Time_Display_Widget extends Widget_Base {

    public function get_name() {
        return 'trad_date_time_display';
    }

    public function get_title() {
        return __('Locale Date', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-calendar trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'turbo-addons-elementor-pro'),
            ]
        );

        $repeater = new Repeater();

        // Country Selector
        $repeater->add_control(
            'country',
            [
                'label' => __('Country', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT2,
                'options' => [
                    'us' => __('United States', 'turbo-addons-elementor-pro'),
                    'uk' => __('United Kingdom', 'turbo-addons-elementor-pro'),
                    'jp' => __('Japan', 'turbo-addons-elementor-pro'),
                    'cn' => __('China', 'turbo-addons-elementor-pro'),
                    'bd' => __('Bangladesh', 'turbo-addons-elementor-pro'),
                    'in' => __('India', 'turbo-addons-elementor-pro'),
                    'pk' => __('Pakistan', 'turbo-addons-elementor-pro'),
                    'de' => __('Germany', 'turbo-addons-elementor-pro'),
                    'ru' => __('Russia', 'turbo-addons-elementor-pro'),
                    'au' => __('Australia', 'turbo-addons-elementor-pro'),
                    'fr' => __('France', 'turbo-addons-elementor-pro'),
                    'it' => __('Italy', 'turbo-addons-elementor-pro'),
                    'nl' => __('Netherlands', 'turbo-addons-elementor-pro'),
                    // Add more countries as needed
                ],
                'default' => 'us',
                'label_block' => true,
                'multiple' => false,
            ]
        );

        $repeater->add_control(
            'trad_show_country',
            [
                'label' => __('Show My Country', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'turbo-addons-elementor-pro'),
                'label_off' => __('Hide', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // If IntlDateFormatter class is available
        if (class_exists('IntlDateFormatter')) {

        // Date Format Selector for US
        $repeater->add_control(
            'date_format_us',
            [
                'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'MM/dd/yyyy' => __('MM/DD/YYYY', 'turbo-addons-elementor-pro'),
                    'dd-MM-yyyy' => __('DD-MM-YYYY', 'turbo-addons-elementor-pro'),
                    'yyyy.MM.dd' => __('YYYY.MM.DD', 'turbo-addons-elementor-pro'),
                    'd MMMM, yyyy' => __('30 July 2024', 'turbo-addons-elementor-pro'),
                    'MMMM d, yyyy' => __('July 30 2024', 'turbo-addons-elementor-pro'),
                ],
                'default' => 'MM/dd/yyyy',
                'condition' => [
                    'country' => 'us',
                ],
            ]
        );

        $repeater->add_control(
            'date_format_uk',
            [
                'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'dd/MM/yyyy' => __('DD/MM/YYYY', 'turbo-addons-elementor-pro'),  // Standard UK format
                    'd MMMM, yyyy' => __('30 July 2024', 'turbo-addons-elementor-pro'), // Example: 30 July 2024
                    'MMMM d, yyyy' => __('July 30, 2024', 'turbo-addons-elementor-pro'), // Example: July 30, 2024
                    'yyyy/MM/dd' => __('YYYY/MM/DD', 'turbo-addons-elementor-pro'),  // Alternative format
                ],
                'default' => 'dd/MM/yyyy',
                'condition' => [
                    'country' => 'uk',
                ],
            ]
        );

        $repeater->add_control(
            'date_format_de',
            [
                'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'dd.MM.yyyy' => __('TT.MM.JJJJ', 'turbo-addons-elementor-pro'), // Standard German format
                    'd. MMMM, yyyy' => __('30. Juli 2024', 'turbo-addons-elementor-pro'), // Example: 30. July 2024
                    'MMMM d, yyyy' => __('Juli 30, 2024', 'turbo-addons-elementor-pro'), // Example: July 30, 2024
                ],
                'default' => 'dd.MM.yyyy',
                'condition' => [
                    'country' => 'de',
                ],
            ]
        );

        $repeater->add_control(
            'date_format_ru',
            [
                'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'dd.MM.yyyy' => __('ДД.MM.ГГГГ', 'turbo-addons-elementor-pro'), // Standard Russian format
                    'd MMMM yyyy' => __('30 июля 2024', 'turbo-addons-elementor-pro'), // Example: 30 July 2024
                    'MMMM d, yyyy' => __('Июль 30, 2024', 'turbo-addons-elementor-pro'), // Example: July 30, 2024
                    'yyyy-MM-dd' => __('ГГГГ-ММ-ДД', 'turbo-addons-elementor-pro'), // Alternative format
                ],
                'default' => 'dd.MM.yyyy',
                'condition' => [
                    'country' => 'ru',
                ],
            ]
        );

        $repeater->add_control(
            'date_format_au',
            [
                'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'dd/MM/yyyy' => __('30/07/2024', 'turbo-addons-elementor-pro'), // Standard Australian format
                    'd MMMM, yyyy' => __('30 July 2024', 'turbo-addons-elementor-pro'), // Example: 30 July 2024
                    'MMMM d, yyyy' => __('July 30, 2024', 'turbo-addons-elementor-pro'), // Example: July 30, 2024
                    'yyyy-MM-dd' => __('2024-07-30', 'turbo-addons-elementor-pro'), // Alternative format
                ],
                'default' => 'dd/MM/yyyy',
                'condition' => [
                    'country' => 'au',
                ],
            ]
        );

        $repeater->add_control(
            'date_format_fr',
            [
                'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'dd/MM/yyyy' => __('30/07/2024', 'turbo-addons-elementor-pro'), // Standard French format
                    'd MMMM, yyyy' => __('30 juillet 2024', 'turbo-addons-elementor-pro'), // Example: 30 July 2024
                    'MMMM d, yyyy' => __('juillet 30, 2024', 'turbo-addons-elementor-pro'), // Example: July 30, 2024
                    'yyyy-MM-dd' => __('2024-07-30', 'turbo-addons-elementor-pro'), // Alternative format
                ],
                'default' => 'dd/MM/yyyy',
                'condition' => [
                    'country' => 'fr',
                ],
            ]
        );

        $repeater->add_control(
            'date_format_it',
            [
                'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'dd/MM/yyyy' => __('DD/MM/YYYY', 'turbo-addons-elementor-pro'), // Standard Italian format
                    'd MMMM yyyy' => __('30 luglio 2024', 'turbo-addons-elementor-pro'), // Example: 30 July 2024
                    'MMMM d, yyyy' => __('Luglio 30, 2024', 'turbo-addons-elementor-pro'), // Example: July 30, 2024
                    'yyyy-MM-dd' => __('YYYY-MM-DD', 'turbo-addons-elementor-pro'), // Alternative format
                ],
                'default' => 'dd/MM/yyyy',
                'condition' => [
                    'country' => 'it',
                ],
            ]
        );

        $repeater->add_control(
            'date_format_nl',
            [
                'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'dd-MM-yyyy' => __('DD-MM-JJJJ', 'turbo-addons-elementor-pro'), // Standard Dutch format
                    'dd/MM/yyyy' => __('DD/MM/JJJJ', 'turbo-addons-elementor-pro'), // Alternative format
                    'd MMMM yyyy' => __('30 juli 2024', 'turbo-addons-elementor-pro'), // Example: 30 July 2024
                    'MMMM d, yyyy' => __('Juli 30, 2024', 'turbo-addons-elementor-pro'), // Example: July 30, 2024
                    'yyyy-MM-dd' => __('YYYY-MM-DD', 'turbo-addons-elementor-pro'), // ISO format
                ],
                'default' => 'dd-MM-yyyy',
                'condition' => [
                    'country' => 'nl', // Condition for Netherlands
                ],
            ]
        );
        

        // Date Format Selector for JP and CN
        $repeater->add_control(
            'date_format_cn',
            [
                'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'MM/dd/yyyy' => __('MM/DD/YYYY', 'turbo-addons-elementor-pro'),
                    'dd-MM-yyyy' => __('DD-MM-YYYY', 'turbo-addons-elementor-pro'),
                    'yyyy.MM.dd' => __('YYYY.MM.DD', 'turbo-addons-elementor-pro'),
                    'MMMM d yyyy' => __('July 30 2024', 'turbo-addons-elementor-pro'),
                ],
                'default' => 'yyyy.MM.dd',
                'condition' => [
                    'country' => 'cn',
                ],
            ]
        );

        $repeater->add_control(
            'date_format_jp',
            [
                'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'MM/dd/yyyy' => __('MM/DD/YYYY', 'turbo-addons-elementor-pro'),
                    'dd-MM-yyyy' => __('DD-MM-YYYY', 'turbo-addons-elementor-pro'),
                    'yyyy.MM.dd' => __('YYYY.MM.DD', 'turbo-addons-elementor-pro'),
                    'MMMM d yyyy' => __('July 30 2024', 'turbo-addons-elementor-pro'),
                ],
                'default' => 'yyyy.MM.dd',
                'condition' => [
                    'country' => 'jp',
                ],
            ]
        );

        $repeater->add_control(
            'date_format_bd',
            [
                'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'MM/dd/yyyy' => __('দদ/মম/বববব', 'turbo-addons-elementor-pro'),
                    'dd-MM-yyyy' => __('দদ-মম-বববব', 'turbo-addons-elementor-pro'),
                    'yyyy.MM.dd' => __('দদ.মম.বববব', 'turbo-addons-elementor-pro'),
                    'd MMMM, yyyy' => __('৩০ জুলাই ২০২৪', 'turbo-addons-elementor-pro'), // Example Bangla format
                    'MMMM d, yyyy' => __('জুলাই ৩০ ২০২৪', 'turbo-addons-elementor-pro'),
                ],
                'default' => 'MM/dd/yyyy',
                'condition' => [
                    'country' => 'bd',
                ],
            ]
        );

        $repeater->add_control(
            'date_format_in',
            [
                'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'MM/dd/yyyy' => __('मम/दि/वववव', 'turbo-addons-elementor-pro'),
                    'dd-MM-yyyy' => __('दि-मम-वववव', 'turbo-addons-elementor-pro'),
                    'yyyy.MM.dd' => __('वववव.मम.दि', 'turbo-addons-elementor-pro'),
                    'd MMMM, yyyy' => __('३० जुलाई, २०२४', 'turbo-addons-elementor-pro'), // Example Indian format
                    'MMMM d, yyyy' => __('जुलाई ३०, २०२४', 'turbo-addons-elementor-pro'),
                ],
                'default' => 'MM/dd/yyyy',
                'condition' => [
                    'country' => 'in',
                ],
            ]
        );

        $repeater->add_control(
            'date_format_pk',
            [
                'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'MM/dd/yyyy' => __('مم/دد/سسسس', 'turbo-addons-elementor-pro'),
                    'dd-MM-yyyy' => __('دد-مم-سسسس', 'turbo-addons-elementor-pro'),
                    'yyyy.MM.dd' => __('سسسس.مم.دد', 'turbo-addons-elementor-pro'),
                    'd MMMM, yyyy' => __('٣٠ جولائی، ٢٠٢٤', 'turbo-addons-elementor-pro'), // Example Urdu format
                    'MMMM d, yyyy' => __('جولائی ٣٠، ٢٠٢٤', 'turbo-addons-elementor-pro'),
                ],
                'default' => 'MM/dd/yyyy',
                'condition' => [
                    'country' => 'pk',
                ],
            ]
        );

        $this->add_control(
            'date_time_entries',
            [
                'label' => __('Locale Date', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'country' => 'us',  // Default country set to 'US'
                        'date_format_us' => 'MM/dd/yyyy',  // Default date format set to 'MM/dd/yyyy'
                        'trad_show_country' => 'yes',
                    ],
                ],
                'title_field' => 'Select Country & Format',
            ]
        );

        } else {
            $repeater->add_control(
                'date_format_global_all',
                [
                    'label' => __('Date Format', 'turbo-addons-elementor-pro'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'F j, Y' => __('November 1, 2024', 'turbo-addons-elementor-pro'),
                        'F d, Y' => __('November 01, 2024', 'turbo-addons-elementor-pro'),
                        'F j, y' => __('November 11, 24', 'turbo-addons-elementor-pro'),
                        'F d, y' => __('November 11, 24', 'turbo-addons-elementor-pro'),
                        'j/n/Y' => __('11/11/2024', 'turbo-addons-elementor-pro'),
                        'j-n-Y' => __('11-11-2024', 'turbo-addons-elementor-pro'),
                    ],
                    'default' => 'F j, Y',
                    'description' => __('Enter the PHP date format. Default is F j, Y.', 'turbo-addons-elementor-pro'),
                ]
            );

            $this->add_control(
                'date_time_entries',
                [
                    'label' => __('Locale Date', 'turbo-addons-elementor-pro'),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'country' => 'us',  // Default country set to 'US'
                            'date_format_global_all' => 'F j, Y',  // Default date format set to 'MM/dd/yyyy'
                            'trad_show_country' => 'yes',
                        ],
                    ],
                    'title_field' => 'Select Country & Format',
                ]
            );
        }

        $this->end_controls_section();

        $this->start_controls_section(
            'section_local_date_body_style',
            [
                'label' => __('Style Background', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Background Color Control for .trad-date-time-display
        $this->add_control(
            'trad_local_date_time_display_background_color',
            [
                'label' => __('Background Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2E3292',
                'selectors' => [
                    '{{WRAPPER}} .trad-date-time-display' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Padding Control for .trad-date-time-display
        $this->add_control(
            'trad_local_date_time_display_padding',
            [
                'label' => __('Padding', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '20',
                    'right' => '0',
                    'bottom' => '20',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-date-time-display' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin Control for .trad-date-time-display
        $this->add_control(
            'trad_local_date_time_display_margin',
            [
                'label' => __('Margin', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-date-time-display' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'trad_local_date_time_display_box_shadow',
                'label' => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-date-time-display',
            ]
        );
    
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'slider_container_border',
                'label' => __( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-date-time-display',
            ]
        );


        $this->end_controls_section();

        // Add Style Tab
        $this->start_controls_section(
            'section_local_date_title_style',
            [
                'label' => __('Style Country Title', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Date Typography Control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_local_date_title_typography', // Unique name for the control
                'label'    => esc_html__( 'Title Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-date-time-title-typography',
            ]
        );

        // Date Color Control
        $this->add_control(
            'trad_local_date_title_color',
            [
                'label' => __('Title Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad-date-time-title-typography' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Date Alignment Control
        $this->add_control(
            'trad_local_date_title_alignment',
            [
                'label' => __('Title Alignment', 'turbo-addons-elementor-pro'),
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
                'selectors' => [
                    '{{WRAPPER}} .trad-date-time-title-typography' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Padding Control
        $this->add_control(
            'trad_local_date_title_padding',
            [
                'label' => __('Title Padding', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],  // You can specify the units for padding
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-date-time-title-typography' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin Control
        $this->add_control(
            'trad_local_date_title_margin',
            [
                'label' => __('Title Margin', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],  // You can specify the units for margin
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-date-time-title-typography' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_local_date_style',
            [
                'label' => __('Style Date', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_local_date_typography', // Unique name for the control
                'label'    => esc_html__( 'Date Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-date-time-typography',
            ]
        );

        // Date Color Control
        $this->add_control(
            'trad_local_date_color',
            [
                'label' => __('Date Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad-date-time-typography' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Date Alignment Control
        $this->add_control(
            'trad_local_date_alignment',
            [
                'label' => __('Date Alignment', 'turbo-addons-elementor-pro'),
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
                'selectors' => [
                    '{{WRAPPER}} .trad-date-time-typography' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Padding Control for .trad-date-time-typography
        $this->add_control(
            'trad_local_date_time_padding',
            [
                'label' => __('Date Time Padding', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],  // Specify the units for padding
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-date-time-typography' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin Control for .trad-date-time-typography
        $this->add_control(
            'trad_local_date_time_margin',
            [
                'label' => __('Date Time Margin', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],  // Specify the units for margin
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-date-time-typography' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        
        $settings = $this->get_settings_for_display();

        $timezones = [
            'us' => 'America/New_York',  // United States (Eastern Time)
            'uk' => 'Europe/London',      // United Kingdom
            'bd' => 'Asia/Dhaka',         // Bangladesh
            'in' => 'Asia/Kolkata',       // India
            'pk' => 'Asia/Karachi',       // Pakistan
            'jp' => 'Asia/Tokyo',         // Japan
            'cn' => 'Asia/Shanghai',      // China
            'de' => 'Europe/Berlin',      // Germany
            'ru' => 'Europe/Moscow',      // Russia
            'fr' => 'Europe/Paris',       // France
            'it' => 'Europe/Rome',        // Italy
            'nl' => 'Europe/Amsterdam',   // Netherlands
            'au' => 'Australia/Sydney',   // Australia
            // Add more countries and their respective time zones as needed
        ];

         // Default timezone for countries not specified
        $default_timezone = 'UTC'; // or any other default timezone you want to use


       
        if (!empty($settings['date_time_entries'])) {
            echo '<div class="trad-date-time-display">';
            foreach ($settings['date_time_entries'] as $entry) {
                $country = esc_html($entry['country']);
                // Determine date format based on country
                $date_format = '';
                if ($country === 'us') {
                    $date_format = !empty($entry['date_format_us']) ? esc_html($entry['date_format_us']) : esc_html($entry['date_format_global_all']);
                } elseif ($country === 'bd') {
                    $date_format = !empty($entry['date_format_bd']) ? esc_html($entry['date_format_bd']) : esc_html($entry['date_format_global_all']);
                } elseif ($country === 'in') {
                    $date_format = !empty($entry['date_format_in']) ? esc_html($entry['date_format_in']) : esc_html($entry['date_format_global_all']);
                } elseif ($country === 'pk') {
                    $date_format = !empty($entry['date_format_pk']) ? esc_html($entry['date_format_pk']) : esc_html($entry['date_format_global_all']);
                } elseif ($country === 'uk') {
                    $date_format = !empty($entry['date_format_uk']) ? esc_html($entry['date_format_uk']) : esc_html($entry['date_format_global_all']);
                } elseif ($country === 'de') { // Check for Germany
                    $date_format = !empty($entry['date_format_de']) ? esc_html($entry['date_format_de']) : esc_html($entry['date_format_global_all']);
                } elseif ($country === 'ru') { // Check for Russia
                    $date_format = !empty($entry['date_format_ru']) ? esc_html($entry['date_format_ru']) : esc_html($entry['date_format_global_all']);
                } elseif ($country === 'au') { // Check for Australia
                    $date_format = !empty($entry['date_format_au']) ? esc_html($entry['date_format_au']) : esc_html($entry['date_format_global_all']);
                } elseif ($country === 'fr') { // Check for France
                    $date_format = !empty($entry['date_format_fr']) ? esc_html($entry['date_format_fr']) : esc_html($entry['date_format_global_all']);
                } elseif ($country === 'it') { // Check for Italy
                    $date_format = !empty($entry['date_format_it']) ? esc_html($entry['date_format_it']) : esc_html($entry['date_format_global_all']);
                } elseif ($country === 'nl') { // Check for Netherlands
                    $date_format = !empty($entry['date_format_nl']) ? esc_html($entry['date_format_nl']) : esc_html($entry['date_format_global_all']);
                } elseif ($country === 'cn') { // Check for China
                    $date_format = !empty($entry['date_format_cn']) ? esc_html($entry['date_format_cn']) : esc_html($entry['date_format_global_all']);
                } elseif ($country === 'jp') { // Check for Japan
                    $date_format = !empty($entry['date_format_jp']) ? esc_html($entry['date_format_jp']) : esc_html($entry['date_format_global_all']);
                }
                
                // Set locale based on country
                // $locale = $this->get_locale_for_country($country);

                // Set timezone based on the country
                $timezone = isset($timezones[$country]) ? $timezones[$country] : $default_timezone;

                // Use IntlDateFormatter if available, otherwise use DateTime
                if (class_exists('IntlDateFormatter')) {
                    // Set locale and timezone for IntlDateFormatter
                    $locale = $this->get_locale_for_country($country);
                    $formatter = new \IntlDateFormatter(
                        $locale,
                        \IntlDateFormatter::LONG,
                        \IntlDateFormatter::NONE,
                        $timezone,
                        null,
                        $date_format
                    );
                    $formatted_date = $formatter->format(time());
                } else {
                    // Fallback to DateTime if IntlDateFormatter is not available
                    $date = new \DateTime('now', new \DateTimeZone($timezone));
                    $formatted_date = $date->format($date_format);
                }

                // If country is Japan, convert numbers to Japanese numerals
                if ($country === 'jp') {
                    if (class_exists('IntlDateFormatter')) {
                        $formatted_date = $this->convert_to_native_numerals($formatted_date, 'jp'); // Japan
                    } else {
                        $formatted_date = $this->convert_to_native_format($formatted_date, $country); // Japan
                    }
                    
                } elseif ($country === 'cn') {
                    if (class_exists('IntlDateFormatter')) {
                        $formatted_date = $this->convert_to_native_numerals($formatted_date, 'cn'); // China
                    } else {
                        $formatted_date = $this->convert_to_native_format($formatted_date, $country); // China
                    }
                } elseif ($country === 'bd') {
                    if (class_exists('IntlDateFormatter')) {
                        $formatted_date = $this->convert_to_native_numerals($formatted_date, 'bd'); // Bangladesh
                    } else {
                        $formatted_date = $this->convert_to_native_format($formatted_date, $country); // Bangladesh
                    }
                } elseif ($country === 'in') {
                    if (class_exists('IntlDateFormatter')) {
                        $formatted_date = $this->convert_to_native_numerals($formatted_date, 'in'); // India
                    } else {
                        $formatted_date = $this->convert_to_native_format($formatted_date, $country); // India
                    }
                } elseif ($country === 'pk') {
                    if (class_exists('IntlDateFormatter')) {
                        $formatted_date = $this->convert_to_native_numerals($formatted_date, 'pk'); // Pakistan
                    } else {
                        $formatted_date = $this->convert_to_native_format($formatted_date, $country); // Pakistan
                    }
                } elseif ($country === 'de') {
                    if (class_exists('IntlDateFormatter')) {
                        $formatted_date = $this->convert_to_native_numerals($formatted_date, 'de'); // Germany
                    } else {
                        $formatted_date = $this->convert_to_native_format($formatted_date, $country); // Germany
                    }
                } elseif ($country === 'ru') {
                    if (class_exists('IntlDateFormatter')) {
                        $formatted_date = $this->convert_to_native_numerals($formatted_date, 'ru'); // Russia
                    } else {
                        $formatted_date = $this->convert_to_native_format($formatted_date, $country); // Russia
                    }
                } elseif ($country === 'au') {
                    if (class_exists('IntlDateFormatter')) {
                        $formatted_date = $this->convert_to_native_numerals($formatted_date, 'au'); // Australia
                    } else {
                        $formatted_date = $this->convert_to_native_format($formatted_date, $country); // Australia
                    }
                } elseif ($country === 'fr') {
                    if (class_exists('IntlDateFormatter')) {
                        $formatted_date = $this->convert_to_native_numerals($formatted_date, 'fr'); // France
                    } else {
                        $formatted_date = $this->convert_to_native_format($formatted_date, $country); // France
                    }
                } elseif ($country === 'it') {
                    if (class_exists('IntlDateFormatter')) {
                        $formatted_date = $this->convert_to_native_numerals($formatted_date, 'it'); // Italy
                    } else {
                        $formatted_date = $this->convert_to_native_format($formatted_date, $country); // Italy
                    }
                } elseif ($country === 'nl') {
                    if (class_exists('IntlDateFormatter')) {
                        $formatted_date = $this->convert_to_native_numerals($formatted_date, 'nl'); // Netherlands
                    } else {
                        $formatted_date = $this->convert_to_native_format($formatted_date, $country); // Netherlands
                    }
                } elseif ($country === 'us') {
                    if (class_exists('IntlDateFormatter')) {
                        $formatted_date = $this->convert_to_native_numerals($formatted_date, 'us'); // USA
                    } else {
                        $formatted_date = $this->convert_to_native_format($formatted_date, $country); // 
                    }
                } elseif ($country === 'uk') {
                    if (class_exists('IntlDateFormatter')) {
                        $formatted_date = $this->convert_to_native_numerals($formatted_date, 'uk'); // Uk
                    } else {
                        $formatted_date = $this->convert_to_native_format($formatted_date, $country); // 
                    }
                }

                $country_names = [
                    'United States' => 'United States',
                    'United Kingdom' => 'United Kingdom',
                    'Japan' => '日本',
                    'China' => '中國',
                    'Bangladesh' => 'বাংলাদেশ',
                    'India' => 'भारत',
                    'Pakistan' => 'پاکستان',
                    'Germany' => 'Deutschland',
                    'Russia' => 'Россия',
                    'Australia' => 'Australia',
                    'France' => 'France',
                    'Italy' => 'Italia',
                    'Netherlands' => 'Nederland',
                ];
                $country_name = $this->get_country_name($country);
                $show_country = isset($entry['trad_show_country']) ? $entry['trad_show_country'] : 'no';
                echo '<div class="trad-date-time-entry">';
                if ($show_country === 'yes') {
                    echo '<p class="trad-date-time-title-typography"><strong>' . esc_html($country_names[$country_name] ?? $country_name) . '</strong></p>';
                }
                echo '<p class="trad-date-time-typography">' . esc_html($formatted_date) . '</p>';
                echo '</div>';
            }
            echo '</div>';
        }
    }

    // Convert date and month names to native format based on the selected country
    private function convert_to_native_format($date, $country_code) {
        // Convert month name and numerals based on country
        if ($country_code === 'bd') {
            $month_map = [
                'January' => 'জানুয়ারী', 'February' => 'ফেব্রুয়ারী', 'March' => 'মার্চ', 'April' => 'এপ্রিল',
                'May' => 'মে', 'June' => 'জুন', 'July' => 'জুলাই', 'August' => 'আগস্ট',
                'September' => 'সেপ্টেম্বর', 'October' => 'অক্টোবর', 'November' => 'নভেম্বর', 'December' => 'ডিসেম্বর'
            ];
            $bangla_numbers = ['0' => '০', '1' => '১', '2' => '২', '3' => '৩', '4' => '৪', '5' => '৫', '6' => '৬', '7' => '৭', '8' => '৮', '9' => '৯'];
    
            // Replace month name and numerals
            $date = strtr($date, $month_map); // Replace month name with Bengali
            $date = strtr($date, $bangla_numbers); // Replace numerals with Bengali digits
        } elseif ($country_code === 'in') {
            $month_map = [
                'January' => 'जनवरी', 'February' => 'फरवरी', 'March' => 'मार्च', 'April' => 'अप्रैल',
                'May' => 'मई', 'June' => 'जून', 'July' => 'जुलाई', 'August' => 'अगस्त',
                'September' => 'सितंबर', 'October' => 'अक्टूबर', 'November' => 'नवंबर', 'December' => 'दिसंबर'
            ];
            $indian_numbers = ['0' => '०', '1' => '१', '2' => '२', '3' => '३', '4' => '४', '5' => '५', '6' => '६', '7' => '७', '8' => '८', '9' => '९'];
    
            // Replace month name and numerals
            $date = strtr($date, $month_map); // Replace month name with Hindi
            $date = strtr($date, $indian_numbers); // Replace numerals with Indian digits
        } elseif ($country_code === 'us' || $country_code === 'uk' || $country_code === 'au') {
            // For US and UK, use English month names and numerals
            $month_map = [
                'January' => 'January', 'February' => 'February', 'March' => 'March', 'April' => 'April',
                'May' => 'May', 'June' => 'June', 'July' => 'July', 'August' => 'August',
                'September' => 'September', 'October' => 'October', 'November' => 'November', 'December' => 'December'
            ];
            $english_numbers = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9'];
    
            // Replace month name and numerals
            $date = strtr($date, $month_map); // Replace month name with English
            $date = strtr($date, $english_numbers); // Replace numerals with English digits
        } elseif ($country_code === 'cn' || $country_code === 'jp') {
            $month_map = [
                'January' => '一月', 'February' => '二月', 'March' => '三月', 'April' => '四月',
                'May' => '五月', 'June' => '六月', 'July' => '七月', 'August' => '八月',
                'September' => '九月', 'October' => '十月', 'November' => '十一月', 'December' => '十二月'
            ];
            $chinese_numbers = ['0' => '零', '1' => '一', '2' => '二', '3' => '三', '4' => '四', '5' => '五', '6' => '六', '7' => '七', '8' => '八', '9' => '九'];
    
            // Replace month name and numerals
            $date = strtr($date, $month_map); // Replace month name with Chinese
            $date = strtr($date, $chinese_numbers); // Replace numerals with Chinese digits
        } elseif ($country_code === 'de') {
            $month_map = [
                'January' => 'Januar', 'February' => 'Februar', 'March' => 'März', 'April' => 'April',
                'May' => 'Mai', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'August',
                'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Dezember'
            ];
            $german_numbers = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9'];
    
            // Replace month name and numerals
            $date = strtr($date, $month_map); // Replace month name with German
            $date = strtr($date, $german_numbers); // Replace numerals with German digits
        } elseif ($country_code === 'ru') {
            $month_map = [
                'January' => 'Январь', 'February' => 'Февраль', 'March' => 'Март', 'April' => 'Апрель',
                'May' => 'Май', 'June' => 'Июнь', 'July' => 'Июль', 'August' => 'Август',
                'September' => 'Сентябрь', 'October' => 'Октябрь', 'November' => 'Ноябрь', 'December' => 'Декабрь'
            ];
            $russian_numbers = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9'];
    
            // Replace month name and numerals
            $date = strtr($date, $month_map); // Replace month name with Russian
            $date = strtr($date, $russian_numbers); // Replace numerals with Russian digits
        } elseif ($country_code === 'fr') {
            $month_map = [
                'January' => 'Janvier', 'February' => 'Février', 'March' => 'Mars', 'April' => 'Avril',
                'May' => 'Mai', 'June' => 'Juin', 'July' => 'Juillet', 'August' => 'Août',
                'September' => 'Septembre', 'October' => 'Octobre', 'November' => 'Novembre', 'December' => 'Décembre'
            ];
            $french_numbers = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9'];
    
            // Replace month name and numerals
            $date = strtr($date, $month_map); // Replace month name with French
            $date = strtr($date, $french_numbers); // Replace numerals with French digits
        } elseif ($country_code === 'it') {
            $month_map = [
                'January' => 'Gennaio', 'February' => 'Febbraio', 'March' => 'Marzo', 'April' => 'Aprile',
                'May' => 'Maggio', 'June' => 'Giugno', 'July' => 'Luglio', 'August' => 'Agosto',
                'September' => 'Settembre', 'October' => 'Ottobre', 'November' => 'Novembre', 'December' => 'Dicembre'
            ];
            $italian_numbers = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9'];
    
            // Replace month name and numerals
            $date = strtr($date, $month_map); // Replace month name with Italian
            $date = strtr($date, $italian_numbers); // Replace numerals with Italian digits
        } elseif ($country_code === 'nl') {
            $month_map = [
                'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maart', 'April' => 'April',
                'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Augustus',
                'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'December'
            ];
            $dutch_numbers = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9'];
    
            // Replace month name and numerals
            $date = strtr($date, $month_map); // Replace month name with Dutch
            $date = strtr($date, $dutch_numbers); // Replace numerals with Dutch digits
        } elseif ($country_code === 'pk') {
            $month_map = [
                'January' => 'جنوری', 'February' => 'فروری', 'March' => 'مارچ', 'April' => 'اپریل',
                'May' => 'مئی', 'June' => 'جون', 'July' => 'جولائی', 'August' => 'اگست',
                'September' => 'ستمبر', 'October' => 'اکتوبر', 'November' => 'نومبر', 'December' => 'دسمبر'
            ];
            $pakistani_numbers = ['0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹'];
    
            // Replace month name and numerals
            $date = strtr($date, $month_map); // Replace month name with Urdu
            $date = strtr($date, $pakistani_numbers); // Replace numerals with Pakistani digits
        }
    
        return esc_html($date);
    } 
    

    private function get_locale_for_country($country_code) {
        $locales = [
            'us' => 'en_US',
            'jp' => 'ja_JP',
            'cn' => 'zh_CN',
            'bd' => 'bn_BD',
            'in' => 'hi_IN',
            'pk' => 'ur_PK', 
            'uk' => 'en_GB',
            'de' => 'de_DE',
            'ru' => 'ru_RU',
            'au' => 'en_AU',
            'fr' => 'fr_FR',
            'it' => 'it_IT',
            'nl' => 'nl_NL',
            // Add more country codes and locales as needed
        ];
    
        return $locales[$country_code] ?? 'en_US';
    }

    private function get_country_name($country_code) {
        $countries = [
            'us' => __('United States', 'turbo-addons-elementor-pro'),
            'jp' => __('Japan', 'turbo-addons-elementor-pro'),
            'cn' => __('China', 'turbo-addons-elementor-pro'),
            'bd' => __('Bangladesh', 'turbo-addons-elementor-pro'),
            'in' => __('India', 'turbo-addons-elementor-pro'),
            'pk' => __('Pakistan', 'turbo-addons-elementor-pro'),
            'uk' => __('United Kingdom', 'turbo-addons-elementor-pro'),
            'de' => __('Germany', 'turbo-addons-elementor-pro'),
            'ru' => __('Russia', 'turbo-addons-elementor-pro'),
            'au' => __('Australia', 'turbo-addons-elementor-pro'),
            'fr' => __('France', 'turbo-addons-elementor-pro'),
            'it' => __('Italy', 'turbo-addons-elementor-pro'),
            'nl' => __('Netherlands', 'turbo-addons-elementor-pro'),
            // Add more countries as needed
        ];

        return $countries[$country_code] ?? __('Unknown', 'turbo-addons-elementor-pro');
    }

    private function convert_to_native_numerals($text, $country_code) {
        // Define conversions for countries like Japan and China
        if ($country_code === 'jp') {
            $japanese_numbers = ['0' => '〇', '1' => '一', '2' => '二', '3' => '三', '4' => '四', '5' => '五', '6' => '六', '7' => '七', '8' => '八', '9' => '九'];
            return strtr($text, $japanese_numbers);
        } elseif ($country_code === 'cn') {
            $chinese_numbers = ['0' => '〇', '1' => '一', '2' => '二', '3' => '三', '4' => '四', '5' => '五', '6' => '六', '7' => '七', '8' => '八', '9' => '九'];
            return strtr($text, $chinese_numbers);
        } elseif ($country_code === 'bd') {
            $bangla_numbers = ['0' => '০', '1' => '১', '2' => '২', '3' => '৩', '4' => '৪', '5' => '৫', '6' => '৬', '7' => '৭', '8' => '৮', '9' => '৯'];
            return strtr($text, $bangla_numbers);
        } elseif ($country_code === 'in') {
            $indian_numbers = ['0' => '०', '1' => '१', '2' => '२', '3' => '३', '4' => '४', '5' => '५', '6' => '६', '7' => '७', '8' => '८', '9' => '९'];
            return strtr($text, $indian_numbers);
        } elseif ($country_code === 'pk') {
            $urdu_numbers = ['0' => '٠', '1' => '١', '2' => '٢', '3' => '٣', '4' => '٤', '5' => '٥', '6' => '٦', '7' => '٧', '8' => '٨', '9' => '٩'];
            return strtr($text, $urdu_numbers);
        } elseif ($country_code === 'ru') {
            // Russian numerals (using standard Arabic numerals)
            $russian_numbers = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9'];
            return strtr($text, $russian_numbers);
        } elseif ($country_code === 'au') {
            // Australian numerals (using standard Arabic numerals)
            $australian_numbers = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9'];
            return strtr($text, $australian_numbers);
        } elseif ($country_code === 'fr') {
            // French numerals (using standard Arabic numerals)
            $french_numbers = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9'];
            return strtr($text, $french_numbers);
        } elseif ($country_code === 'it') {
            // Italian numerals (using standard Arabic numerals)
            $italian_numbers = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9'];
            return strtr($text, $italian_numbers);
        } elseif ($country_code === 'nl') {
            // Dutch numerals (using standard Arabic numerals)
            $dutch_numbers = ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9'];
            return strtr($text, $dutch_numbers);
        }

        return $text; // Default to no conversion if not specified
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_Date_Time_Display_Widget());
