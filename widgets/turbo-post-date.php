<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography; 

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_Post_Date_Display_Widget extends Widget_Base {

    public function get_name() {
        return 'trad_post_date_display';
    }

    public function get_title() {
        return __('Post Date', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-date trad-icon';
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


        // Dynamic post Title
        $this->add_control(
            'trad_post_date',
            [
                'label' => __('Select Post', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                    'tags' => [
                        'post_title' // This will automatically pull the post title dynamically
                    ],
                ],
                'default' => '', // Default to empty, dynamic tag will override this
            ]
        );

        $this->add_control(
            'country',
            [
                'label' => __('Select Country', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
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
                'default' => 'us', // Default to Bangladesh
                'description' => __('Select a country to display the post date in the local language.', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'date_format',
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
            'trad_show_post_date_heading',
            [
                'label' => __('Show Heading', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'turbo-addons-elementor-pro'),
                'label_off' => __('Hide', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_post_date_body_style',
            [
                'label' => __('Background Style', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Background Color Control for .trad-date-time-display
        $this->add_control(
            'trad_post_date_display_background_color',
            [
                'label' => __('Background Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2E3292',
                'selectors' => [
                    '{{WRAPPER}} .trad-post-display' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Padding Control for .trad-date-time-display
        $this->add_control(
            'trad_post_date_display_padding',
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
                    '{{WRAPPER}} .trad-post-display' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin Control for .trad-date-time-display
        $this->add_control(
            'trad_post_date_display_margin',
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
                    '{{WRAPPER}} .trad-post-display' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'trad_post_date_display_box_shadow',
                'label' => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-post-display',
            ]
        );
    
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trad_post_date_display_border',
                'label' => __( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-post-display',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_post_date_text_style',
            [
                'label' => __('Text Style', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'trad_show_post_date_heading' => 'yes',
                ],
            ]
        );

        // Date Typography Control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_post_date_title_typography', // Unique name for the control
                'label'    => esc_html__( 'Title Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-post-display-title',
            ]
        );

        // Date Color Control
        $this->add_control(
            'trad_post_date_title_color',
            [
                'label' => __('Title Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad-post-display-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Date Alignment Control
        $this->add_control(
            'trad_post_date_title_alignment',
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
                    '{{WRAPPER}} .trad-post-display-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Padding Control
        $this->add_control(
            'trad_post_date_title_padding',
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
                    '{{WRAPPER}} .trad-post-display-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin Control
        $this->add_control(
            'trad_post_date_title_margin',
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
                    '{{WRAPPER}} .trad-post-display-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_post_date_date_style',
            [
                'label' => __('Date Style', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Date Typography Control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_post_date_date_typography', // Unique name for the control
                'label'    => esc_html__( 'Date Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-post-display-date',
            ]
        );

        // Date Color Control
        $this->add_control(
            'trad_post_date_date_color',
            [
                'label' => __('Date Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad-post-display-date' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Date Alignment Control
        $this->add_control(
            'trad_post_date_date_alignment',
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
                    '{{WRAPPER}} .trad-post-display-date' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Padding Control
        $this->add_control(
            'trad_post_date_date_padding',
            [
                'label' => __('Date Padding', 'turbo-addons-elementor-pro'),
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
                    '{{WRAPPER}} .trad-post-display-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin Control
        $this->add_control(
            'trad_post_date_date_margin',
            [
                'label' => __('Date Margin', 'turbo-addons-elementor-pro'),
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
                    '{{WRAPPER}} .trad-post-display-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
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

    // Render the widget content
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Get the selected post ID and country
        $post = isset($settings['trad_post_date']) ? sanitize_text_field($settings['trad_post_date']) : null;
        $country = isset($settings['country']) ? sanitize_text_field($settings['country']) : ''; 
       
        if (!empty($post)) {
            // Get the title and creation date for the selected post
            $post_id = get_the_ID($post);
            $date_format = !empty($settings['date_format']) ? $settings['date_format'] : 'F j, Y';
            $post_date = get_the_date($date_format, $post_id);

            // Convert the date based on the selected country (e.g., month name and numerals)
            $post_date = $this->convert_to_native_format($post_date, $country);  // Call to convert date
            $show_heading = isset($settings['trad_show_post_date_heading']) ? $settings['trad_show_post_date_heading'] : 'no';
            // Output the post title and creation date
            echo '<div class="trad-post-display">';
            if($show_heading === 'yes') {
            echo '<h2 class="trad-post-display-title">' . esc_html($post) . '</h2>';
            }
            echo '<p class="trad-post-display-date">' . esc_html($post_date) . '</p>';
            echo '</div>';
        } else {
            echo '<div class="trad-post-display">';
            echo '<p class="trad-post-display-date">' . esc_html__('Post not found or invalid.', 'turbo-addons-elementor-pro') . '</p>';
            echo '</div>';
        }
    }
}

// Register the widget
Plugin::instance()->widgets_manager->register_widget_type(new TRAD_Post_Date_Display_Widget());
