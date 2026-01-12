<?php 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_Pricing_Table_Pro extends Widget_Base {

    public function get_name() {
        return 'trad_pricing_table_pro';
    }

    public function get_title() {
        return __('Pricing Table Pro', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-price-table trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Pricing Table Content', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'style_select',
            [
                'label' => esc_html__( 'Select Style', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style-1' => esc_html__( 'style 1', 'turbo-addons-elementor-pro' ),
                    'style-2' => esc_html__( 'style 2', 'turbo-addons-elementor-pro' ),
                    'style-3' => esc_html__( 'style 3', 'turbo-addons-elementor-pro' ),
                    'style-4' => esc_html__( 'style 4', 'turbo-addons-elementor-pro' ),
                    'style-5' => esc_html__( 'style 5', 'turbo-addons-elementor-pro' ),
                    'style-6' => esc_html__( 'style 6', 'turbo-addons-elementor-pro' ),
                    'style-7' => esc_html__( 'style 7', 'turbo-addons-elementor-pro' ),
                    'style-8' => esc_html__( 'style 8', 'turbo-addons-elementor-pro' ),
                    'style-9' => esc_html__( 'style 9', 'turbo-addons-elementor-pro' ),
                    'style-10' => esc_html__( 'style 10', 'turbo-addons-elementor-pro' ),
                    'style-11' => esc_html__( 'style 11', 'turbo-addons-elementor-pro' ),
                    'style-12' => esc_html__( 'style 12', 'turbo-addons-elementor-pro' ),
                    'style-13' => esc_html__( 'style 13', 'turbo-addons-elementor-pro' ),
                    'style-14' => esc_html__( 'style 14', 'turbo-addons-elementor-pro' ),
                    'style-15' => esc_html__( 'style 15', 'turbo-addons-elementor-pro' ),
                ],
                'default' => 'style-2',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'trad_pricing_table_pro_header_section_content',
            [
                'label' => __( 'Header Section', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition'  => [
                    'style_select' => ['style-1', 'style-2'], // Only show if the switcher is enabled
                ],
            ],
        );

        $this->add_control(
            'trad_pricing_table_pro_header_title',
            [
                'label' => esc_html__('Title', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Our Basic and Additional Solutions', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_sub_header_title',
            [
                'label' => esc_html__('Sub Title', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Aliquam ut porttitor leo a. Diam donec adipiscing tristique risus nec feugiat in.', 'turbo-addons-elementor-pro'),
            ]
        );


        $this->end_controls_section(); 

        $this->start_controls_section(
            'trad_free_section_content',
            [
                'label' => __( 'Free Section', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition'  => [
                    'style_select' => ['style-1', 'style-2'], // Only show if the switcher is enabled
                ],
            ],
        );

        $this->add_control(
            'trad_pricing_table_pro_free',
            [
                'label' => esc_html__('Title', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Free', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_free_description',
            [
                'label' => esc_html__('Short Description', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Enter a brief description here', 'turbo-addons-elementor-pro'),
                'placeholder' => esc_html__('Provide a short description', 'turbo-addons-elementor-pro'),
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_free_price',
            [
                'label' => esc_html__('Price', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('$0', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_free_price_unit',
            [
                'label' => esc_html__('Unit', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__(' per month', 'turbo-addons-elementor-pro'),
            ]
        );
        // Image
        $this->add_control(
            'trad_pricing_table_pro_free_price_image',
            [
                'label' => esc_html__('Image', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_btn_text_free',
            [
                'label' => esc_html__('Button Text', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Buy Now', 'turbo-addons-elementor-pro'),
            ]
        );

        // Pricing Free URL (added URL control)
        $this->add_control(
            'trad_pricing_table_pro_free_price_url',
            [
                'label' => esc_html__("Free URL", 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'turbo-addons-elementor-pro'),
            ]
        );

        $repeater = new Repeater();

        // Icon control
        $repeater->add_control(
            'trad_pricing_table_free_feature_icon',
            [
                'label' => esc_html__('Icon', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-info-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        // Text control
        $repeater->add_control(
            'trad_pricing_table_free_feature_text',
            [
                'label' => esc_html__('Text', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Feature text', 'turbo-addons-elementor-pro'),
                'placeholder' => esc_html__('Enter feature text', 'turbo-addons-elementor-pro'),
            ]
        );

        $repeater->add_responsive_control(
            'trad_pricing_table_free_feature_icon_color',
            [
                'label' => esc_html__('Icon Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
            ]
        );

        // Text decoration control
        $repeater->add_responsive_control(
            'trad_pricing_table_free_feature_text_decoration',
            [
                'label' => __('Text Decoration', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'none' => __('None', 'turbo-addons-elementor-pro'),
                    'line-through' => __('Line Through', 'turbo-addons-elementor-pro'),
                    'underline' => __('Underline', 'turbo-addons-elementor-pro'),
                    'overline' => __('Overline', 'turbo-addons-elementor-pro'),
                ],
                'default' => 'none',
            ]
        );

        // Add repeater to the main control
        $this->add_control(
            'trad_pricing_table_free_features_list',
            [
                'label' => esc_html__('Features', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ trad_pricing_table_free_feature_text }}}',
                'default' => [
                    [
                        'trad_pricing_table_free_feature_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_free_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_free_feature_text' => '2 links',
                        'trad_pricing_table_free_feature_text_decoration' => 'none',
                    ],
                    [
                        'trad_pricing_table_free_feature_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_free_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_free_feature_text' => 'Own analytics platform',
                        'trad_pricing_table_free_feature_text_decoration' => 'none',
                    ],
                    [
                        'trad_pricing_table_free_feature_icon' => [
                            'value' => 'fas fa-times',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_free_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_free_feature_text' => 'Chat support',
                        'trad_pricing_table_free_feature_text_decoration' => 'line-through',
                    ],
                    [
                        'trad_pricing_table_free_feature_icon' => [
                            'value' => 'fas fa-times',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_free_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_free_feature_text' => 'Mobile application',
                        'trad_pricing_table_free_feature_text_decoration' => 'line-through',
                    ],
                    [
                        'trad_pricing_table_free_feature_icon' => [
                            'value' => 'fas fa-times',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_free_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_free_feature_text' => 'Unlimited users',
                        'trad_pricing_table_free_feature_text_decoration' => 'line-through',
                    ],
                ],
            ]
        );        

        
        $this->end_controls_section();

        $this->start_controls_section(
            'trad_pro_section_content',
            [
                'label' => __( 'Pro Section', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition'  => [
                    'style_select' => ['style-1', 'style-2'], // Only show if the switcher is enabled
                ],
            ],
        );

        $this->add_control(
            'trad_pricing_table_pro_pro',
            [
                'label' => esc_html__('Title', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Pro', 'turbo-addons-elementor-pro'),
            ]
        );

        // Enable Badge Toggle
        $this->add_control(
            'trad_pricing_table_pro_pro_show_badge',
            [
                'label' => esc_html__('Show Badge', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => esc_html__('No', 'turbo-addons-elementor-pro'),
                'default' => 'yes',
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        // Badge Text Control
        $this->add_control(
            'trad_pricing_table_pro_pro_badge_text',
            [
                'label' => esc_html__('Badge Text', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Pro', 'turbo-addons-elementor-pro'),
                'condition' => [
                    'trad_pricing_table_pro_pro_show_badge' => 'yes',
                    'style_select' => 'style-1',
                ],
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_pro_description',
            [
                'label' => esc_html__('Short Description', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Enter a brief description here', 'turbo-addons-elementor-pro'),
                'placeholder' => esc_html__('Provide a short description', 'turbo-addons-elementor-pro'),
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_pro_price',
            [
                'label' => esc_html__('Price', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('$15', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_pro_price_unit',
            [
                'label' => esc_html__('Unit', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('per month', 'turbo-addons-elementor-pro'),
            ]
        );

        // Image
        $this->add_control(
            'trad_pricing_table_pro_pro__image',
            [
                'label' => esc_html__('Image', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_btn_text_pro',
            [
                'label' => esc_html__('Button Text', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Buy Now', 'turbo-addons-elementor-pro'),
            ]
        );

        // Pricing Pro URL (added URL control)
        $this->add_control(
            'trad_pricing_table_pro_pro_price_url',
            [
                'label' => esc_html__("Pro URL", 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'turbo-addons-elementor-pro'),
            ]
        );

        $repeater = new Repeater();

        // Icon control
        $repeater->add_control(
            'trad_pricing_table_pro_feature_icon',
            [
                'label' => esc_html__('Icon', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-info-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'trad_pricing_table_pro_feature_icon_color',
            [
                'label' => esc_html__('Icon Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
            ]
        );

        // Text control
        $repeater->add_control(
            'trad_pricing_table_pro_feature_text',
            [
                'label' => esc_html__('Text', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Feature text', 'turbo-addons-elementor-pro'),
                'placeholder' => esc_html__('Enter feature text', 'turbo-addons-elementor-pro'),
            ]
        );

        // Text decoration control
        $repeater->add_responsive_control(
            'trad_pricing_table_pro_feature_text_decoration',
            [
                'label' => __('Text Decoration', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'none' => __('None', 'turbo-addons-elementor-pro'),
                    'line-through' => __('Line Through', 'turbo-addons-elementor-pro'),
                    'underline' => __('Underline', 'turbo-addons-elementor-pro'),
                    'overline' => __('Overline', 'turbo-addons-elementor-pro'),
                ],
                'default' => 'none',
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_features_list',
            [
                'label' => esc_html__('Features', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ trad_pricing_table_pro_feature_text }}}', // Display text in repeater item title
                'default' => [
                    [
                        'trad_pricing_table_pro_feature_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_pro_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_pro_feature_text' => '2 links',
                        'trad_pricing_table_free_feature_text_decoration' => 'none',
                    ],
                    [
                        'trad_pricing_table_pro_feature_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_pro_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_pro_feature_text' => 'Own analytics platform',
                        'trad_pricing_table_free_feature_text_decoration' => 'none',
                    ],
                    [
                        'trad_pricing_table_pro_feature_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_pro_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_pro_feature_text' => 'Chat support',
                        'trad_pricing_table_free_feature_text_decoration' => 'none',
                    ],
                    [
                        'trad_pricing_table_pro_feature_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_pro_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_pro_feature_text' => 'Mobile application',
                        'trad_pricing_table_free_feature_text_decoration' => 'none',
                    ],
                    [
                        'trad_pricing_table_pro_feature_icon' => [
                            'value' => 'fas fa-times',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_pro_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_pro_feature_text' => 'Unlimited users',
                        'trad_pricing_table_free_feature_text_decoration' => 'none',
                    ],
                ],
            ]
        );

        $this->end_controls_section(); 

        $this->start_controls_section(
            'trad_enterprise_section_content',
            [
                'label' => __( 'Enterprise Section', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition'  => [
                    'style_select' => ['style-1','style-2'] // Only show if the switcher is enabled
                ],
            ],
        );

        $this->add_control(
            'trad_pricing_table_pro_enterprise',
            [
                'label' => esc_html__('Title', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Enterprise', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_enterprise_description',
            [
                'label' => esc_html__('Short Description', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Enter a brief description here', 'turbo-addons-elementor-pro'),
                'placeholder' => esc_html__('Provide a short description', 'turbo-addons-elementor-pro'),
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_enterprise_price',
            [
                'label' => esc_html__('Price', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('$0', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_enterprise_price_unit',
            [
                'label' => esc_html__('Unit', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__(' per month', 'turbo-addons-elementor-pro'),
            ]
        );

        // Image
        $this->add_control(
            'trad_pricing_table_pro_exclusive__image',
            [
                'label' => esc_html__('Image', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_btn_text_enterprise',
            [
                'label' => esc_html__('Button Text', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Buy Now', 'turbo-addons-elementor-pro'),
            ]
        );

        // Pricing Enterprise URL (added URL control)
        $this->add_control(
            'trad_pricing_table_pro_enterprise_price_url',
            [
                'label' => esc_html__("Enterprise URL", 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'turbo-addons-elementor-pro'),
            ]
        );

        $repeater = new Repeater();

        // Icon control
        $repeater->add_control(
            'trad_pricing_table_enterprise_feature_icon',
            [
                'label' => esc_html__('Icon', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-info-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'trad_pricing_table_enterprise_feature_icon_color',
            [
                'label' => esc_html__('Icon Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
            ]
        );

        // Text control
        $repeater->add_control(
            'trad_pricing_table_enterprise_feature_text',
            [
                'label' => esc_html__('Text', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Feature text', 'turbo-addons-elementor-pro'),
                'placeholder' => esc_html__('Enter feature text', 'turbo-addons-elementor-pro'),
            ]
        );

        // Text decoration control
        $repeater->add_responsive_control(
            'trad_pricing_table_pro_enterprise_feature_text_decoration',
            [
                'label' => __('Text Decoration', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'none' => __('None', 'turbo-addons-elementor-pro'),
                    'line-through' => __('Line Through', 'turbo-addons-elementor-pro'),
                    'underline' => __('Underline', 'turbo-addons-elementor-pro'),
                    'overline' => __('Overline', 'turbo-addons-elementor-pro'),
                ],
                'default' => 'none',
            ]
        );

        $this->add_control(
            'trad_pricing_table_enterprise_features_list',
            [
                'label' => esc_html__('Features', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ trad_pricing_table_enterprise_feature_text }}}', // Display text in repeater item title
                'default' => [
                    [
                        'trad_pricing_table_enterprise_feature_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_enterprise_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_enterprise_feature_text' => '2 links',
                        'trad_pricing_table_free_feature_text_decoration' => 'none',
                    ],
                    [
                        'trad_pricing_table_enterprise_feature_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_enterprise_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_enterprise_feature_text' => 'Own analytics platform',
                        'trad_pricing_table_free_feature_text_decoration' => 'none',
                    ],
                    [
                        'trad_pricing_table_enterprise_feature_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_enterprise_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_enterprise_feature_text' => 'Chat support',
                        'trad_pricing_table_free_feature_text_decoration' => 'none',
                    ],
                    [
                        'trad_pricing_table_enterprise_feature_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_enterprise_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_enterprise_feature_text' => 'Mobile application',
                        'trad_pricing_table_free_feature_text_decoration' => 'none',
                    ],
                    [
                        'trad_pricing_table_enterprise_feature_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'trad_pricing_table_enterprise_feature_icon_color' => '#CCCCCC',
                        'trad_pricing_table_enterprise_feature_text' => 'Unlimited users',
                        'trad_pricing_table_free_feature_text_decoration' => 'none',
                    ],
                ],
            ]
        );

        $this->end_controls_section(); 

        // -------------------------------------------------------------------------------   End Of Style - 01 Style -------------------------------------------------------------- //
        // -------------------------------------------------------------------------------   End Of Style - 02 Style -------------------------------------------------------------- //

        $this->start_controls_section(
            'section_style_container',
            [
                'label' => __('Container', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'container_background',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_plans__container',
            ]
        );

        // Padding
        $this->add_responsive_control(
            'container_padding',
            [
                'label'      => __('Padding', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plans__container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin
        $this->add_responsive_control(
            'container_margin',
            [
                'label'      => __('Margin', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plans__container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'container_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_plans__container',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'container_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plans__container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'container_box_shadow',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_plans__container',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_plans_hero',
            [
                'label' => __('Header Style', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );
        
        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'plans_hero_background',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_plansHero',
            ]
        );
        
        // Padding
        $this->add_responsive_control(
            'plans_hero_padding',
            [
                'label'      => __('Padding', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plansHero' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Margin
        $this->add_responsive_control(
            'plans_hero_margin',
            [
                'label'      => __('Margin', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plansHero' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'plans_hero_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_plansHero',
            ]
        );
        
        // Border Radius
        $this->add_responsive_control(
            'plans_hero_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plansHero' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'plans_hero_box_shadow',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_plansHero',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_plans_hero_title',
            [
                'label' => __('Plans Title', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_pricing_table_pro_plansHero_title_header_style',
                'label' => esc_html__( 'Text', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_plansHero__title',
            ]
        );
        // Color
        $this->add_control(
            'plans_hero_title_color',
            [
                'label'     => __('Text Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plansHero__title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        // Padding
        $this->add_responsive_control(
            'plans_hero_title_padding',
            [
                'label'      => __('Padding', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plansHero__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Margin
        $this->add_responsive_control(
            'plans_hero_title_margin',
            [
                'label'      => __('Margin', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plansHero__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Text Alignment
        $this->add_responsive_control(
            'plans_hero_title_alignment',
            [
                'label'        => __('Text Alignment', 'turbo-addons-elementor-pro'),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __('Left', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'      => 'center',
                'selectors'    => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plansHero__title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_plans_hero_subtitle',
            [
                'label' => __('Plans Subtitle', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_pricing_table_pro_plansHero_sub_header_style',
                'label' => esc_html__( 'Text', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_plansHero__subtitle',
            ]
        );
        // Color
        $this->add_control(
            'plans_hero_subtitle_color',
            [
                'label'     => __('Text Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plansHero__subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        // Padding
        $this->add_responsive_control(
            'plans_hero_subtitle_padding',
            [
                'label'      => __('Padding', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plansHero__subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Margin
        $this->add_responsive_control(
            'plans_hero_subtitle_margin',
            [
                'label'      => __('Margin', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plansHero__subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Text Alignment
        $this->add_responsive_control(
            'plans_hero_subtitle_alignment',
            [
                'label'        => __('Text Alignment', 'turbo-addons-elementor-pro'),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __('Left', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'turbo-addons-elementor-pro'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'      => 'center',
                'selectors'    => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plansHero__subtitle' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        // Plan Item ------------------------------------------------------------------
        $this->start_controls_section(
            'section_style_plan_item_list_items',
            [
                'label' => __('Plan Item List', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_icon_size',
            [
                'label' => esc_html__('Icon Size', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}};', // Font Awesome or other font-based icons
                    '{{WRAPPER}} .elementor-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};', // SVG icons
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_features_list_icon_padding',
            [
                'label' => esc_html__('Icon Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_features_list_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control (
            'trad_pricing_table_pro_features_list_icon_margin',
            [
                'label' => esc_html__('Icon Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_features_list_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //Plan Item Free Start --------------------------------------------------------------------------------------------------------------------------------------------------
       
        $this->start_controls_section(
            'section_style_plan_item_free',
            [
                'label' => __('Plan Item Free', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        // Image Width Controller
        $this->add_responsive_control(
            'trad_pricing_table_pro_free_plan_item_free_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => '%', // Default unit
                    'size' => 100,   // Default value
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_planItem--free' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        // Background Color
        $this->add_control(
            'plan_item_free_background',
            [
                'label'     => __('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_planItem--free' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        // Padding
        $this->add_responsive_control(
            'plan_item_free_padding',
            [
                'label'      => __('Padding', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_planItem' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Margin
        $this->add_responsive_control(
            'plan_item_free_margin',
            [
                'label'      => __('Margin', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_planItem' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'        => 'plan_item_free_border',
                'label'       => __('Border', 'turbo-addons-elementor-pro'),
                'selector'    => '{{WRAPPER}} .trad_pricing_table_pro_planItem--free',
            ]
        );
        
        // Border Radius
        $this->add_responsive_control(
            'plan_item_free_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_planItem--free' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'plan_item_free_box_shadow',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_planItem--free',
            ]
        );
        
        $this->end_controls_section();

        // Plan Free Header Part --------------------------------------------------------------------------------------------------------------------------

        $this->start_controls_section(
            'section_style_plan_item_free_header',
            [
                'label' => __('Plan Item Free Header', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        // Image Width Controller
        $this->add_responsive_control(
            'trad_pricing_table_pro_free_image_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px', // Default unit
                    'size' => 70,   // Default value
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_price_image_resize' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // $this->add_responsive_control(
        //     'trad_pricing_table_pro_free_image_height',
        //     [
        //         'label' => __('Height', 'turbo-addons-elementor-pro'),
        //         'type' => \Elementor\Controls_Manager::SLIDER,
        //         'size_units' => ['%', 'px', 'em'],
        //         'range' => [
        //             'px' => [
        //                 'min' => 0,
        //                 'max' => 500,
        //             ],
        //             '%' => [
        //                 'min' => 0,
        //                 'max' => 100,
        //             ],
        //             'em' => [
        //                 'min' => 0,
        //                 'max' => 20,
        //             ],
        //         ],
        //         'default' => [
        //             'unit' => 'px', // Default unit
        //             'size' => 87,   // Default value
        //         ],
        //         'selectors' => [
        //             '{{WRAPPER}} .trad_pricing_table_pro_free_price_image_resize' => 'height: {{SIZE}}{{UNIT}};',
        //         ],
        //     ]
        // );

        // Border Group Controller
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'trad_pricing_table_pro_free_image_border',
                'label' => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_free_price_image_resize',
            ]
        );

        // Border Radius Controller
        $this->add_control(
            'trad_pricing_table_pro_free_image_border_radius',
            [
                'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_price_image_resize' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Show/Hide Switcher
        $this->add_responsive_control(
            'trad_pricing_table_pro_free_image_visibility',
            [
                'label' => __('Show Image', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'turbo-addons-elementor-pro'),
                'label_off' => __('Hide', 'turbo-addons-elementor-pro'),
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_free_title_padding',
            [
                'label' => __('Title Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_text_edit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_free_title_margin',
            [
                'label' => __('Title Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_text_edit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_free_title_color',
            [
                'label' => __('Title Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_text_edit' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Typography Control for Title
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_pricing_table_pro_free_title_typography',
                'label'    => __( 'Title Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_free_text_edit',
            ]
        );

        // Padding Control
        $this->add_responsive_control(
            'trad_pricing_table_pro_free_desc_text_padding',
            [
                'label' => __('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_card__desc_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin Control
        $this->add_responsive_control(
            'trad_pricing_table_pro_free_desc_text_margin',
            [
                'label' => __('Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_card__desc_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Text Color Control
        $this->add_control(
            'trad_pricing_table_pro_free_desc_text_color',
            [
                'label' => __('Text Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_card__desc_text' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Typography Control for Title
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_pricing_table_pro_free_desc_typography',
                'label'    => __( 'Text Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_card__desc_text',
            ]
        );


        $this->end_controls_section();

        // Plan Item Free Price ----------------------------------------------------------------------------------------------------------------------------------

        $this->start_controls_section(
            'section_style_plan_item_free_content',
            [
                'label' => __('Plan Item Free Price', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_pricing_table_pro_price_typography',
                'label' => esc_html__( 'Price Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_price_value',
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_price_color',
            [
                'label' => esc_html__('Price Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_price_value' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_pricing_table_pro_price_padding',
            [
                'label' => esc_html__('Price Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_price_value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_pricing_table_pro_price_margin',
            [
                'label' => esc_html__('Price Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 15,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_price_value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // price unit----------------------------------------------

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_pricing_table_pro_price_unit_typography',
                'label' => esc_html__( 'Unit Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_price_unit',
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_price_unit_color',
            [
                'label' => esc_html__('Unit Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_price_unit' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_pricing_table_pro_price_unit_padding',
            [
                'label' => esc_html__('Unit Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_price_unit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_pricing_table_pro_price_unit_margin',
            [
                'label' => esc_html__('Unit Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 10,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_price_unit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        

        $this->end_controls_section();


        // Plan Item Free ------------------------------------------------------------------
        $this->start_controls_section(
            'section_style_plan_item_list_items_free',
            [
                'label' => __('Plan Item List Free', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_pricing_table_pro_free_feature_text_typography',
                'label' => esc_html__( 'Item Text Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_free_feature_text',
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_free_feature_padding',
            [
                'label' => esc_html__('Item Text Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_feature_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control (
            'trad_pricing_table_pro_free_feature_margin',
            [
                'label' => esc_html__('Item Text Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_feature_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'trad_pricing_table_pro_free_feature_text_color',
			[
				'label' => esc_html__('Item Text Color', 'turbo-addons-elementor-pro'),
				'type' =>  Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .trad_pricing_table_pro_free_feature_text' => 'color: {{VALUE}};',
				],

			]
		);

        $this->end_controls_section();

        // Plan Item Free Button ------------------------------------------------------------------
        $this->start_controls_section(
            'section_style_plan_item_list_items_free_button',
            [
                'label' => __('Plan Item Free Button', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->start_controls_tabs( 'trad_pricing_table_pro_free_style_tab' );
        //  Controls tab For Normal
        $this->start_controls_tab(
            'trad_pricing_table_pro_free_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );

        // Background Color Control
        $this->add_responsive_control(
            'trad_pricing_table_pro_button_background_color',
            [
                'label' => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffecf0',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_custom' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Text Color Control
        $this->add_responsive_control(
            'trad_pricing_table_pro_button_color',
            [
                'label' => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ea4c89',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_custom' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 5, // You can adjust the max value based on your preference
                    ],
                ],
                'default' => [
                    'unit' => 'rem', // Setting the default unit to rem
                    'size' => .5// Setting the default value to 1rem
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_custom' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        


        $this->end_controls_tab();
        //  Controls tab For Hover
        $this->start_controls_tab(
            'trad_pricing_table_pro_free_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );
        $this->add_control(
            'trad_pricing_table_pro_button_hover_background_color',
            [
                'label' => esc_html__('Hover Background Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ea4c89', // Default color for hover
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_custom:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_button_hover_text_color',
            [
                'label' => esc_html__('Hover Text Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff', // Default color for hover
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_custom:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_pricing_table_pro_button_hover_text_box',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_button_custom:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // Plan Item Free End ------------------------------------------------------------------------------------------------------------------------------------------------

        //Plan Item Pro Start ---------------------------------------------------------------------------------------------------------------------------------------------------

        $this->start_controls_section(
            'section_style_plan_item_pro',
            [
                'label' => __('Plan Item Pro', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        // Image Width Controller
        $this->add_responsive_control(
            'trad_pricing_table_pro_free_plan_item_pro_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => '%', // Default unit
                    'size' => 100,   // Default value
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_planItem--pro' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        // Background Color
        $this->add_control(
            'plan_item_pro_background',
            [
                'label'     => __('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_planItem--pro' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'        => 'plan_item_pro_border',
                'label'       => __('Border', 'turbo-addons-elementor-pro'),
                'selector'    => '{{WRAPPER}} .trad_pricing_table_pro_planItem--pro',
            ]
        );
        
        // Border Radius
        $this->add_responsive_control(
            'plan_item_pro_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_planItem--pro' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'plan_item_pro_box_shadow',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_planItem--pro',
            ]
        );
        
        $this->end_controls_section();

        // Plan Pro Header Part ------------------------------------------------------------------------------------------------------------------

        $this->start_controls_section(
            'section_style_plan_item_pro_header',
            [
                'label' => __('Plan Item Pro Header', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        // Image Width Controller
        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_image_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px', // Default unit
                    'size' => 70,   // Default value
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_price_image_resize' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // $this->add_responsive_control(
        //     'trad_pricing_table_pro_pro_image_height',
        //     [
        //         'label' => __('Height', 'turbo-addons-elementor-pro'),
        //         'type' => \Elementor\Controls_Manager::SLIDER,
        //         'size_units' => ['%', 'px', 'em'],
        //         'range' => [
        //             'px' => [
        //                 'min' => 0,
        //                 'max' => 500,
        //             ],
        //             '%' => [
        //                 'min' => 0,
        //                 'max' => 100,
        //             ],
        //             'em' => [
        //                 'min' => 0,
        //                 'max' => 20,
        //             ],
        //         ],
        //         'default' => [
        //             'unit' => 'px', // Default unit
        //             'size' => 87,   // Default value
        //         ],
        //         'selectors' => [
        //             '{{WRAPPER}} .trad_pricing_table_pro_pro_price_image_resize' => 'height: {{SIZE}}{{UNIT}};',
        //         ],
        //     ]
        // );

        // Border Group Controller
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'trad_pricing_table_pro_pro_image_border',
                'label' => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_pro_price_image_resize',
            ]
        );

        // Border Radius Controller
        $this->add_control(
            'trad_pricing_table_pro_pro_image_border_radius',
            [
                'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_price_image_resize' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Show/Hide Switcher
        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_image_visibility',
            [
                'label' => __('Show Image', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'turbo-addons-elementor-pro'),
                'label_off' => __('Hide', 'turbo-addons-elementor-pro'),
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_title_padding',
            [
                'label' => __('Title Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_text_edit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_title_margin',
            [
                'label' => __('Title Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_text_edit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_pro_title_color',
            [
                'label' => __('Title Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_text_edit' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Typography Control for Title
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_pricing_table_pro_pro_title_typography',
                'label'    => __( 'Title Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_pro_text_edit',
            ]
        );

        // Padding Control
        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_desc_text_padding',
            [
                'label' => __('Text Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_card__desc_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin Control
        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_desc_text_margin',
            [
                'label' => __('Text Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_card__desc_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Text Color Control
        $this->add_control(
            'trad_pricing_table_pro_pro_desc_text_color',
            [
                'label' => __('Text Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_card__desc_text' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Typography Control for Title
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_pricing_table_pro_pro_desc_typography',
                'label'    => __( 'Title Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_pro_card__desc_text',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'trad_pricing_table_pro_card_label_border',
                'label' => esc_html__('Badge Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_card__label',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_pricing_table_pro_card_label_typography',
                'label'    => __( 'Badge Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_card__label',
            ]
        );
        
        $this->add_control(
            'trad_pricing_table_pro_card_label_background_color',
            [
                'label' => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f4f4f4',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_card__label' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'trad_pricing_table_pro_card_label_text_color',
            [
                'label' => esc_html__('Badge Text Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_card__label' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_pricing_table_pro_card_label_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_card__label' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        // Plan Item Pro Price ----------------------------------------------------------------------------------------------------------------------------------

        $this->start_controls_section(
            'section_style_plan_item_pro_content',
            [
                'label' => __('Plan Item Pro Price', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_pricing_table_pro_pro_price_typography',
                'label' => esc_html__( 'Price Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_pro_price_value',
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_price_color',
            [
                'label' => esc_html__('Price Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_price_value' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_price_padding',
            [
                'label' => esc_html__('Price Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_price_value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_price_margin',
            [
                'label' => esc_html__('Price Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 15,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_price_value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // price unit----------------------------------------------

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_pricing_table_pro_pro_price_unit_typography',
                'label' => esc_html__( 'Unit Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_pro_price_unit',
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_price_unit_color',
            [
                'label' => esc_html__('Unit Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_price_unit' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_price_unit_padding',
            [
                'label' => esc_html__('Unit Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_price_unit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_price_unit_margin',
            [
                'label' => esc_html__('Unit Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 10,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_price_unit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Plan Item Pro ------------------------------------------------------------------
        $this->start_controls_section(
            'section_style_plan_item_list_items_pro',
            [
                'label' => __('Plan Item List Pro', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_pricing_table_pro_pro_feature_text_typography',
                'label' => esc_html__( 'Item Text Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_pro_feature_text',
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_feature_padding',
            [
                'label' => esc_html__('Item Text Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_feature_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control (
            'trad_pricing_table_pro_pro_feature_margin',
            [
                'label' => esc_html__('Item Text Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_feature_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'trad_pricing_table_pro_pro_feature_text_color',
			[
				'label' => esc_html__('Item Text Color', 'turbo-addons-elementor-pro'),
				'type' =>  Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .trad_pricing_table_pro_pro_feature_text' => 'color: {{VALUE}};',
				],

			]
		);

        $this->end_controls_section();

        // Plan Item Pro ------------------------------------------------------------------
        $this->start_controls_section(
            'section_style_plan_item_list_items_pro_button',
            [
                'label' => __('Plan Item Pro Button', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->start_controls_tabs( 'trad_pricing_table_pro_pro_style_tab' );
        //  Controls tab For Normal
        $this->start_controls_tab(
            'trad_pricing_table_pro_pro_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );

        // Background Color Control
        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_button_background_color',
            [
                'label' => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ea4c89',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_button_custom' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Text Color Control
        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_button_color',
            [
                'label' => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffecf0',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_button_custom' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_pro_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 5, // You can adjust the max value based on your preference
                    ],
                ],
                'default' => [
                    'unit' => 'rem', // Setting the default unit to rem
                    'size' => .5// Setting the default value to 1rem
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_button_custom' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        


        $this->end_controls_tab();
        //  Controls tab For Hover
        $this->start_controls_tab(
            'trad_pricing_table_pro_pro_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );
        $this->add_control(
            'trad_pricing_table_pro_pro_button_hover_background_color',
            [
                'label' => esc_html__('Hover Background Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffecf0', // Default color for hover
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_button_custom:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_pro_button_hover_text_color',
            [
                'label' => esc_html__('Hover Text Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ea4c89', // Default color for hover
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_pro_button_custom:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_pricing_table_pro_pro_button_hover_text_box',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_pro_button_custom:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // Plan Item Free End ------------------------------------------------------------------------------------------------------------------------------------------------
        //Plan Item Free Start --------------------------------------------------------------------------------------------------------------------------------------------------
       
        $this->start_controls_section(
            'section_style_plan_item_enterprise',
            [
                'label' => __('Plan Item Enterprise', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        // Image Width Controller
        $this->add_responsive_control(
            'trad_pricing_table_pro_free_plan_item_enterprise_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => '%', // Default unit
                    'size' => 100,   // Default value
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_planItem--entp' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        // Background Color
        $this->add_control(
            'plan_item_enterprise_background',
            [
                'label'     => __('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_planItem--entp' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        // Padding
        $this->add_responsive_control(
            'plan_item_enterprise_padding',
            [
                'label'      => __('Padding', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_planItem' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Margin
        $this->add_responsive_control(
            'plan_item_enterprise_margin',
            [
                'label'      => __('Margin', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_planItem' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'        => 'plan_item_enterprise_border',
                'label'       => __('Border', 'turbo-addons-elementor-pro'),
                'selector'    => '{{WRAPPER}} .trad_pricing_table_pro_planItem--entp',
            ]
        );
        
        // Border Radius
        $this->add_responsive_control(
            'plan_item_enterprise_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_planItem--entp' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'plan_item_enterprise_box_shadow',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_planItem--entp',
            ]
        );
        
        $this->end_controls_section();

        // Plan Enterprise Header Part --------------------------------------------------------------------------------------------------------------------------

        $this->start_controls_section(
            'section_style_plan_item_enterprise_header',
            [
                'label' => __('Plan Item Enterprise Header', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        // Image Width Controller
        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_image_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px', // Default unit
                    'size' => 70,   // Default value
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_price_image_resize' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // $this->add_responsive_control(
        //     'trad_pricing_table_pro_enterprise_image_height',
        //     [
        //         'label' => __('Height', 'turbo-addons-elementor-pro'),
        //         'type' => \Elementor\Controls_Manager::SLIDER,
        //         'size_units' => ['%', 'px', 'em'],
        //         'range' => [
        //             'px' => [
        //                 'min' => 0,
        //                 'max' => 500,
        //             ],
        //             '%' => [
        //                 'min' => 0,
        //                 'max' => 100,
        //             ],
        //             'em' => [
        //                 'min' => 0,
        //                 'max' => 20,
        //             ],
        //         ],
        //         'default' => [
        //             'unit' => 'px', // Default unit
        //             'size' => 87,   // Default value
        //         ],
        //         'selectors' => [
        //             '{{WRAPPER}} .trad_pricing_table_pro_enterprise_price_image_resize' => 'height: {{SIZE}}{{UNIT}};',
        //         ],
        //     ]
        // );

        // Border Group Controller
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'trad_pricing_table_pro_enterprise_image_border',
                'label' => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_enterprise_price_image_resize',
            ]
        );

        // Border Radius Controller
        $this->add_control(
            'trad_pricing_table_pro_enterprise_image_border_radius',
            [
                'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_price_image_resize' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Show/Hide Switcher
        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_image_visibility',
            [
                'label' => __('Show Image', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'turbo-addons-elementor-pro'),
                'label_off' => __('Hide', 'turbo-addons-elementor-pro'),
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_title_padding',
            [
                'label' => __('Title Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_text_edit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_title_margin',
            [
                'label' => __('Title Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_text_edit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_enterprise_title_color',
            [
                'label' => __('Title Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_text_edit' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Typography Control for Title
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_pricing_table_pro_enterprise_title_typography',
                'label'    => __( 'Title Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_enterprise_text_edit',
            ]
        );

        // Padding Control
        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_desc_text_padding',
            [
                'label' => __('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_card__desc_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin Control
        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_desc_text_margin',
            [
                'label' => __('Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_card__desc_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Text Color Control
        $this->add_control(
            'trad_pricing_table_pro_enterprise_desc_text_color',
            [
                'label' => __('Text Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_card__desc_text' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Typography Control for Title
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_pricing_table_pro_enterprise_desc_typography',
                'label'    => __( 'Text Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_enterprise_card__desc_text',
            ]
        );

        $this->end_controls_section();

        // Plan Item Free Price ----------------------------------------------------------------------------------------------------------------------------------

        $this->start_controls_section(
            'section_style_plan_item_enterprise_content',
            [
                'label' => __('Plan Item Enterprise Price', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_pricing_table_pro_enterprise_price_typography',
                'label' => esc_html__( 'Price Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_enterprise_price_value',
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_price_color',
            [
                'label' => esc_html__('Price Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_price_value' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_price_padding',
            [
                'label' => esc_html__('Price Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_price_value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_price_margin',
            [
                'label' => esc_html__('Price Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 15,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_price_value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // price unit----------------------------------------------

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_pricing_table_pro_enterprise_price_unit_typography',
                'label' => esc_html__( 'Unit Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_enterprise_price_unit',
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_price_unit_color',
            [
                'label' => esc_html__('Unit Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_price_unit' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_price_unit_padding',
            [
                'label' => esc_html__('Unit Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_price_unit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_price_unit_margin',
            [
                'label' => esc_html__('Unit Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 10,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_price_unit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        

        $this->end_controls_section();

        // Plan Item Enterprise ------------------------------------------------------------------
        $this->start_controls_section(
            'section_style_plan_item_list_items_enterprise',
            [
                'label' => __('Plan Item List Enterprise', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_pricing_table_pro_enterprise_feature_text_typography',
                'label' => esc_html__( 'Item Text Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_enterprise_feature_text',
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_feature_padding',
            [
                'label' => esc_html__('Item Text Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_feature_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control (
            'trad_pricing_table_pro_enterprise_feature_margin',
            [
                'label' => esc_html__('Item Text Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_feature_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'trad_pricing_table_pro_enterprise_feature_text_color',
			[
				'label' => esc_html__('Item Text Color', 'turbo-addons-elementor-pro'),
				'type' =>  Controls_Manager::COLOR,
				'default' => '#FFF9F9',
				'selectors' => [
					'{{WRAPPER}} .trad_pricing_table_pro_enterprise_feature_text' => 'color: {{VALUE}};',
				],

			]
		);

        $this->end_controls_section();

        // Plan Item Free Button ------------------------------------------------------------------
        $this->start_controls_section(
            '_style_two',
            [
                'label' => __('Plan Item Enterprise Button', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-1', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->start_controls_tabs( 'trad_pricing_table_pro_enterprise_style_tab' );
        //  Controls tab For Normal
        $this->start_controls_tab(
            'trad_pricing_table_pro_enterprise_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );

        // Background Color Control
        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_button_background_color',
            [
                'label' => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffecf0',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_button_custom' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Text Color Control
        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_button_color',
            [
                'label' => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ea4c89',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_button_custom' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_enterprise_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 5, // You can adjust the max value based on your preference
                    ],
                ],
                'default' => [
                    'unit' => 'rem', // Setting the default unit to rem
                    'size' => .5// Setting the default value to 1rem
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_button_custom' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        


        $this->end_controls_tab();
        //  Controls tab For Hover
        $this->start_controls_tab(
            'trad_pricing_table_pro_enterprise_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );
        $this->add_control(
            'trad_pricing_table_pro_enterprise_button_hover_background_color',
            [
                'label' => esc_html__('Hover Background Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ea4c89', // Default color for hover
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_button_custom:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_pricing_table_pro_enterprise_button_hover_text_color',
            [
                'label' => esc_html__('Hover Text Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff', // Default color for hover
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_enterprise_button_custom:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_pricing_table_pro_enterprise_button_hover_text_box',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_enterprise_button_custom:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // ---------------------------------------------------------- Style Type - 2 controller for design ------------------------------------------------------------------//

        $this->start_controls_section(
            'section_style_plans_hero_container_header',
            [
                'label' => __('Container Header', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-2', // Only show if the switcher is enabled
                ],
            ]
        );

        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'trad_plan_pro_style_two_container_header_background',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-pricing-table-pro-heading-style-two',
            ]
        );

        // Padding
        $this->add_responsive_control(
            'trad_plan_pro_style_two_container_header_padding',
            [
                'label'      => __('Padding', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-pricing-table-pro-heading-style-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin
        $this->add_responsive_control(
            'trad_plan_pro_style_two_container_header_margin',
            [
                'label'      => __('Margin', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-pricing-table-pro-heading-style-two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_plan_pro_style_two_container_header_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-pricing-table-pro-heading-style-two',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'trad_plan_pro_style_two_container_header_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad-pricing-table-pro-heading-style-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_plan_pro_style_two_container_header_box_shadow',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-pricing-table-pro-heading-style-two',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_plan_pro_style_two_container_header_title',
                'label' => esc_html__( 'Header Text', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_plansHero__title',
            ]
        );
        // Color
        $this->add_control(
            'trad_plan_pro_style_two_container_header_title_color',
            [
                'label'     => __('Header Text Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plansHero__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_plan_pro_style_two_container_header_sub_title',
                'label' => esc_html__( 'Header Sub Text', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_plansHero__subtitle',
            ]
        );
        // Color
        $this->add_control(
            'trad_plan_pro_style_two_container_header_sub_title_color',
            [
                'label'     => __('Headr Sub Text Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_plansHero__subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_two_plans_all_item',
            [
                'label' => __('Plan List', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-2', // Only show if the switcher is enabled
                ],
            ]
        );
        $this->add_responsive_control(
            'trad_section_style_two_plans_all_item_icon_size',
            [
                'label' => esc_html__('Icon Size', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}};', // Font Awesome or other font-based icons
                    '{{WRAPPER}} .elementor-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};', // SVG icons
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_section_style_two_plans_all_item_icon_padding',
            [
                'label' => esc_html__('Icon Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_features_list_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control (
            'trad_section_style_two_plans_all_item_icon_margin',
            [
                'label' => esc_html__('Icon Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_features_list_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_section_style_two_plans_all_item_text',
                'label' => esc_html__( 'Plan List Text', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_free_feature_text',
            ]
        );
        // Color
        // $this->add_control(
        //     'trad_section_style_two_plans_all_item_text_color',
        //     [
        //         'label'     => __('Plan List Text Color', 'turbo-addons-elementor-pro'),
        //         'type'      => \Elementor\Controls_Manager::COLOR,
        //         'default'   => '',
        //         'selectors' => [
        //             '{{WRAPPER}} .trad_pricing_table_pro_free_feature_text' => 'color: {{VALUE}};',
        //         ],
        //     ]
        // );

        $this->add_responsive_control(
            'trad_section_style_two_plans_all_item_text_padding',
            [
                'label' => esc_html__('List Text Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_feature_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control (
            'trad_section_style_two_plans_all_item_text_margin',
            [
                'label' => esc_html__('List Text Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_feature_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_two_plans_all_item_basic_plan',
            [
                'label' => __('Basic Plan', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-2', // Only show if the switcher is enabled
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_section_style_two_plans_all_item_basic_plan_typography',
                'label' => esc_html__( 'Baisc Plan Title Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_free_text_edit_one',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_basic_plan_color',
            [
                'label'     => __('Baisc Plan Title Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_text_edit_one' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_basic_plan_mini_divider_color',
            [
                'label'     => __('Baisc Plan Mini Divider Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad-pricing-table-pro-style-two-divider-one' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_section_style_two_plans_all_item_basic_plan_price_typography',
                'label' => esc_html__( 'Baisc Plan Price Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_price_unit_price',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_basic_plan_duration_price',
            [
                'label'     => __('Baisc Plan Duration Price', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_price_unit_price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_section_style_two_plans_all_item_basic_plan_duration_typography',
                'label' => esc_html__( 'Baisc Plan Duration Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_price_unit_one',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_basic_plan_duration_color',
            [
                'label'     => __('Baisc Plan Duration Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_price_unit_one' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_basic_plan_divider_color',
            [
                'label'     => __('Baisc Plan Divider Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad-pricing-table-pro-style-two-divider-main-one' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_basic_plan_list_color',
            [
                'label'     => __('Baisc Plan List Text Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_feature_text_free_plan' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_plan_item_list_items_basic_button',
            [
                'label' => __('Basic Button', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-2', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->start_controls_tabs( 'trad_pricing_table_pro_basic_style_tab' );
        //  Controls tab For Normal
        $this->start_controls_tab(
            'trad_pricing_table_pro_basic_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_button_basic_button_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_basic' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control (
            'trad_pricing_table_pro_button_basic_button_margin',
            [
                'label' => esc_html__('Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_basic' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'trad_section_style_two_plans_all_item_basic_plan_background_color',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_button_basic',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_basic_plan__color',
            [
                'label'     => __('Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_basic' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_section_style_two_plans_all_item_basic_plan_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_button_basic',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'trad_section_style_two_plans_all_item_basic_plan_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_basic' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_section_style_two_plans_all_item_basic_plan_box_shadow',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_button_basic',
            ]
        );


        $this->end_controls_tab();
        //  Controls tab For Hover
        $this->start_controls_tab(
            'trad_pricing_table_pro_basic_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );
        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'trad_section_style_two_plans_all_item_basic_plan_background_color_hover',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_button_basic:hover',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_basic_plan_hover_color',
            [
                'label'     => __('Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_basic:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // --------------------------------------------------------------- pro controller added here ........................................................................//

        $this->start_controls_section(
            'section_style_two_plans_all_item_pro_plan',
            [
                'label' => __('Pro Plan', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-2', // Only show if the switcher is enabled
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_section_style_two_plans_all_item_pro_plan_typography',
                'label' => esc_html__( 'Pro Plan Title Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_free_text_edit_two',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_pro_plan_color',
            [
                'label'     => __('Pro Plan Title Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_text_edit_two' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_pro_plan_mini_divider_color',
            [
                'label'     => __('Pro Plan Mini Divider Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad-pricing-table-pro-style-two-divider-two' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_section_style_two_plans_all_item_pro_plan_price_typography',
                'label' => esc_html__( 'Pro Plan Price Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_price_unit_price_two',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_pro_plan_duration_price',
            [
                'label'     => __('Pro Plan Duration Price', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_price_unit_price_two' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_section_style_two_plans_all_item_pro_plan_duration_typography',
                'label' => esc_html__( 'Pro Plan Duration Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_price_unit_two',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_pro_plan_duration_color',
            [
                'label'     => __('Pro Plan Duration Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_price_unit_two' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_pro_plan_divider_color',
            [
                'label'     => __('Pro Plan Divider Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad-pricing-table-pro-style-two-divider-main-two' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_pro_plan_list_color',
            [
                'label'     => __('Pro Plan List Text Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_feature_text_pro_plan' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_plan_item_list_items_professional_button',
            [
                'label' => __('Pro Button', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-2', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->start_controls_tabs( 'trad_pricing_table_pro_professional_style_tab' );
        //  Controls tab For Normal
        $this->start_controls_tab(
            'trad_pricing_table_pro_professional_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_button_professional_button_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_pro' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control (
            'trad_pricing_table_pro_button_professional_button_margin',
            [
                'label' => esc_html__('Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_pro' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'trad_section_style_two_plans_all_item_professional_plan_background_color',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_button_pro',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_professional_plan__color',
            [
                'label'     => __('Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_pro' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_section_style_two_plans_all_item_professional_plan_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_button_pro',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'trad_section_style_two_plans_all_item_professional_plan_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_pro' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_section_style_two_plans_all_item_professional_plan_box_shadow',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_button_pro',
            ]
        );


        $this->end_controls_tab();
        //  Controls tab For Hover
        $this->start_controls_tab(
            'trad_pricing_table_pro_professional_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );
        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'trad_section_style_two_plans_all_item_professional_plan_background_color_hover',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_button_pro:hover',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_professional_plan_hover_color',
            [
                'label'     => __('Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_pro:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // --------------------------------------------------------------- enterprise controller added here ........................................................................//

        $this->start_controls_section(
            'section_style_two_plans_all_item_enterprise_plan',
            [
                'label' => __('Enterprise Plan', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-2', // Only show if the switcher is enabled
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_section_style_two_plans_all_item_enterprise_plan_typography',
                'label' => esc_html__( 'Enterprise Plan Title Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_free_text_edit_three',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_enterprise_plan_color',
            [
                'label'     => __('Enterprise Plan Title Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_text_edit_three' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_enterprise_plan_mini_divider_color',
            [
                'label'     => __('Enterprise Plan Mini Divider Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad-pricing-table-pro-style-two-divider-three' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_section_style_two_plans_all_item_enterprise_plan_price_typography',
                'label' => esc_html__( 'Enterprise Plan Price Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_price_unit_price_three',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_enterprise_plan_duration_price',
            [
                'label'     => __('Enterprise Plan Duration Price Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_price_unit_price_three' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'trad_section_style_two_plans_all_item_enterprise_plan_duration_typography',
                'label' => esc_html__( 'Enterprise Plan Duration Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_price_unit_three',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_enterprise_plan_duration_color',
            [
                'label'     => __('Enterprise Plan Duration Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_price_unit_three' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_enterprise_plan_divider_color',
            [
                'label'     => __('Enterprise Plan Divider Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad-pricing-table-pro-style-two-divider-main-three' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_enterprise_plan_list_color',
            [
                'label'     => __('enterprise Plan List Text Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_free_feature_text_enterprise_plan' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_plan_item_list_items_enterprise_button_style_two',
            [
                'label' => __('Enterprise Button', 'turbo-addons-elementor-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'style_select' => 'style-2', // Only show if the switcher is enabled
                ],
            ]
        );

        $this->start_controls_tabs( 'trad_pricing_table_pro_enterprise_style_tab_style_two' );
        //  Controls tab For Normal
        $this->start_controls_tab(
            'trad_pricing_table_pro_enterprise_normal_tab_style_two',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_responsive_control(
            'trad_pricing_table_pro_button_enterprise_button_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_enterprise' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control (
            'trad_pricing_table_pro_button_enterprise_button_margin',
            [
                'label' => esc_html__('Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_enterprise' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'trad_section_style_two_plans_all_item_enterprise_plan_background_color',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_button_enterprise',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_enterprise_plan__color',
            [
                'label'     => __('Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_enterprise' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_section_style_two_plans_all_item_enterprise_plan_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_button_enterprise',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'trad_section_style_two_plans_all_item_enterprise_plan_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_enterprise' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_section_style_two_plans_all_item_enterprise_plan_box_shadow',
                'label'    => __('Box Shadow', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_button_enterprise',
            ]
        );


        $this->end_controls_tab();
        //  Controls tab For Hover
        $this->start_controls_tab(
            'trad_pricing_table_pro_enterprise_hover_tab_style_two',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        );
        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'trad_section_style_two_plans_all_item_enterprise_plan_background_color_hover',
                'label'    => __('Background', 'turbo-addons-elementor-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad_pricing_table_pro_button_enterprise:hover',
            ]
        );

        $this->add_control(
            'trad_section_style_two_plans_all_item_enterprise_plan_hover_color',
            [
                'label'     => __('Color', 'turbo-addons-elementor-pro'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .trad_pricing_table_pro_button_enterprise:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Get the dynamic data
        $selected_pricing_table_pro_style = isset( $settings['style_select'] ) ? $settings['style_select'] : 'style-1';

        // Pass the dynamic data to the template
        if ( 'style-1' === $selected_pricing_table_pro_style ) {
            include plugin_dir_path( __FILE__ ) . '../templates/pricing_table/style-1.php';
        } elseif ( 'style-2' === $selected_pricing_table_pro_style ) {
            include plugin_dir_path( __FILE__ ) . '../templates/pricing_table/style-2.php';
        }
    }
}

// Register the widget
Plugin::instance()->widgets_manager->register_widget_type(new TRAD_Pricing_Table_Pro());
