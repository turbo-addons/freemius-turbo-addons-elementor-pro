<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_Review_Archive extends Widget_Base {

    public function get_name() {
        return 'trad-review-archive';
    }

    public function get_title() {
        return esc_html__( 'Turbo Review Archive', 'turbo-addons-elementor-pro' );
    }

    public function get_icon() {
        return 'eicon-post-list trad-icon';
    }

    public function get_categories() {
        return [ 'turbo-addons-pro' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'template_select',
            [
                'label' => esc_html__( 'Select Template', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'template-1' => esc_html__( 'Template 1', 'turbo-addons-elementor-pro' ),
                    'template-2' => esc_html__( 'Template 2', 'turbo-addons-elementor-pro' ),
                    'template-3' => esc_html__( 'Template 3', 'turbo-addons-elementor-pro' ),
                    'template-4' => esc_html__( 'Template 4', 'turbo-addons-elementor-pro' ),
                    'template-5' => esc_html__( 'Template 5', 'turbo-addons-elementor-pro' ),
                ],
                'default' => 'template-1',
            ]
        );

        // For Template - 1 Image
        $this->add_control(
            'trad_review_archive_logo',
            [
                'label' => esc_html__( 'Upload Logo', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        // Logo Width Control
        $this->add_control(
            'logo_width',
            [
                'label' => esc_html__( 'Logo Width', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        // Logo Height Control
        $this->add_control(
            'logo_height',
            [
                'label' => esc_html__( 'Logo Height', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-logo img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );  
        
        
        // Logo Border Radius Control
        $this->add_control(
            'logo_border_radius',
            [
                'label' => esc_html__( 'Logo Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-logo img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        // For Template - 2 Image
        $this->add_control(
            'template_two_card_logo',
            [
                'label' => esc_html__( 'Upload Logo', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'template_select' => ['template-2', 'template-3'],
                ],
            ]
        );
        
        // Logo Width Control
        $this->add_control(
            'template_two_logo_width',
            [
                'label' => esc_html__( 'Logo Width', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-image-section img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => ['template-2', 'template-3'],
                ],
            ]
        );

        // Logo Height Control
        $this->add_control(
            'template_two_logo_height',
            [
                'label' => esc_html__( 'Logo Height', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-image-section img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => ['template-2', 'template-3'],
                ],
            ]
        );  
        
        
        // Logo Border Radius Control
        $this->add_control(
            'template_two_logo_border_radius',
            [
                'label' => esc_html__( 'Logo Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-image-section img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => ['template-2', 'template-3'],
                ],
            ]
        ); 
        
        // Template - 4
        
        // Logo Width Control for Template Three
        $this->add_control(
            'template_four_card_logo',
            [
                'label' => esc_html__( 'Upload Logo', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'template_select' => ['template-4', 'template-5'],
                ],
            ]
        );
        $this->add_control(
            'template_four_logo_width',
            [
                'label' => esc_html__( 'Logo Width', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-four-container-header img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        // Logo Height Control for Template Three
        $this->add_control(
            'template_four_logo_height',
            [
                'label' => esc_html__( 'Logo Height', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-four-container-header img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        // Logo Border Radius Control for Template Three
        $this->add_control(
            'template_four_logo_border_radius',
            [
                'label' => esc_html__( 'Logo Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-four-container-header img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        // Template - 5

        $this->add_control(
            'template_five_logo_width',
            [
                'label' => esc_html__( 'Logo Width', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-icon-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        // Logo Height Control for Template Three
        $this->add_control(
            'template_five_logo_height',
            [
                'label' => esc_html__( 'Logo Height', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-icon-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        // Logo Border Radius Control for Template Three
        $this->add_control(
            'template_five_logo_border_radius',
            [
                'label' => esc_html__( 'Logo Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-icon-wrapper img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        

        // Add dynamic data fields (e.g., title and content)

        $this->add_control(
            'dynamic_title',
            [
                'label' => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
                'placeholder' => esc_html__( 'Enter your title', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'template_select' => ['template-1', 'template-2', 'template-4', 'template-5'],
                ],
            ]
        );

        $this->add_control(
            'dynamic_sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
                'placeholder' => esc_html__( 'Enter your title', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'template_select' => ['template-2'],
                ],
            ]
        );



        $this->add_control(
            'dynamic_content',
            [
                'label' => esc_html__( 'Dynamic Content', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Default content', 'turbo-addons-elementor-pro' ),
                'placeholder' => esc_html__( 'Enter your content', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'template_select' => ['template-1', 'template-2', 'template-4'],
                ],
            ]
        );

        // For Template - 3

        $this->add_control(
            'money_back_title',
            [
                'label' => esc_html__( 'Guarantee Text', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Guarantee Text', 'turbo-addons-elementor-pro' ),
                'placeholder' => esc_html__( 'Enter your guarantee', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'template_select' => ['template-3', 'template-5'],
                ],
            ]
        );

        $this->add_control(
            'template_three_price_title',
            [
                'label' => esc_html__( 'Price Text', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Price Text', 'turbo-addons-elementor-pro' ),
                'placeholder' => esc_html__( 'Enter your Price', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'template_select' => ['template-3', 'template-5'],
                ],
            ]
        );

        $this->add_control(
            'template_three_save_title',
            [
                'label' => esc_html__( 'Save Text', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Save Text', 'turbo-addons-elementor-pro' ),
                'placeholder' => esc_html__( 'Enter your Save', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'template_select' => ['template-3', 'template-5'],
                ],
            ]
        );

        $this->add_control(
            'template_three_secure_title',
            [
                'label' => esc_html__( 'Secure Text', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Secure Text', 'turbo-addons-elementor-pro' ),
                'placeholder' => esc_html__( 'Enter your Secure', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'template_select' => ['template-3', 'template-5'],
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'review_section',
            [
                'label' => esc_html__( 'Review', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number_of_stars',
            [
                'label' => esc_html__('Number of Stars', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,  // Maximum of 10 stars
                'step' => 1,
                'default' => 5,  // Default to 5 stars
            ]
        );        

        // Star Rating Value
        $this->add_control(
            'star_rating',
            [
                'label' => esc_html__('Star Rating', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [''],
                'range' => [
                    '' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 2.5,
                ],
            ]
        );

        // Star Background Color
        $this->add_control(
            'star_background_color',
            [
                'label' => esc_html__('Review Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fc0',
            ]
        );

        // Star Color
        $this->add_control(
            'star_color',
            [
                'label' => esc_html__('Star Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
            ]
        );

        // Star Size
        $this->add_control(
            'star_size',
            [
                'label' => esc_html__('Star Size', 'turbo-addons-elementor-pro'),
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
                    'size' => 60,
                ],
            ]
        );

        // Hover Effect
        $this->add_control(
            'enable_hover',
            [
                'label' => esc_html__('Enable Hover Effect', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'turbo-addons-elementor-pro'),
                'label_off' => esc_html__('No', 'turbo-addons-elementor-pro'),
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'template_select' => ['template-1', 'template-3', 'template-4', 'template-5'],
                ],
            ]
        );

        // Button Text Control
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Visit', 'turbo-addons-elementor-pro' ),
                'placeholder' => esc_html__( 'Enter button text', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'template_select' => ['template-1', 'template-3', 'template-4', 'template-5'],
                ],
            ]
        );
        $this->add_control(
            'template_one_button_url',
            [
                'label' => esc_html__( 'Link', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'turbo-addons-elementor-pro' ),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        $this->add_control(
            'template_three_button_url',
            [
                'label' => esc_html__( 'Button Link', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'turbo-addons-elementor-pro' ),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_five_button_url',
            [
                'label' => esc_html__( 'Link', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'turbo-addons-elementor-pro' ),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );
        $this->add_control(
            'button_text_two',
            [
                'label' => esc_html__( 'Review Button', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Read Review', 'turbo-addons-elementor-pro' ),
                'placeholder' => esc_html__( 'Enter review text', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'template_select' => ['template-3', 'template-5'],
                ],
            ]
        );
        $this->add_control(
            'template_three_review_button_url',
            [
                'label' => esc_html__( 'Review Link', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'turbo-addons-elementor-pro' ),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );
        $this->add_control(
            'template_five_button_review_url',
            [
                'label' => esc_html__( 'Link', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'turbo-addons-elementor-pro' ),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'tc_section',
            [
                'label' => esc_html__( 'Terms & Condition', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'template_select' => ['template-1', 'template-3', 'template-4', 'template-5'],
                ],
            ]
        );

        // Button Text Control
        $this->add_control(
            'tc_text',
            [
                'label' => esc_html__( 'Terms and Condition Text', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'T&Cs Apply', 'turbo-addons-elementor-pro' ),
                'placeholder' => esc_html__( 'Enter term and condition text', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        // Button Text Control
        $this->add_control(
            'template_three_tc_text',
            [
                'label' => esc_html__( 'Terms and Condition Text', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'T&Cs Apply', 'turbo-addons-elementor-pro' ),
                'placeholder' => esc_html__( 'Enter term and condition text', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_tc_text',
            [
                'label' => esc_html__( 'Terms and Condition Text', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'T&Cs Apply', 'turbo-addons-elementor-pro' ),
                'placeholder' => esc_html__( 'Enter term and condition text', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        $this->add_control(
            'template_five_terms_condition_text',
            [
                'label' => esc_html__( 'Terms and Condition Text', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Terms and condition apply', 'turbo-addons-elementor-pro' ),
                'placeholder' => esc_html__( 'Enter term and condition text', 'turbo-addons-elementor-pro' ),
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        $this->add_control(
            'template_three_tc_url',
            [
                'label' => esc_html__( 'Link', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'turbo-addons-elementor-pro' ),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_tc_url',
            [
                'label' => esc_html__( 'Link', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'turbo-addons-elementor-pro' ),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'card_background_section',
            [
                'label' => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Background Color Control
        $this->add_control(
            'vpn_card_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        // Background Color Control 
        $this->add_control(
            'card_container_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-container' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-2',
                ],
            ]
        );

        $this->add_control(
            'container_template_three_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-three-logo-image' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'container_template_four_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-four-container' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        $this->add_control(
            'container_template_five_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-card' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_two_style_section',
            [
                'label' => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // For Template - 1
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_two_text_typography',
                'label' => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-review-archive-name',
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'title_two_text_color',
            [
                'label' => esc_html__( 'Title Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-name' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        // For Template - 2
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'template_two_title_typography',
                'label' => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-template-two-title',
                'condition' => [
                    'template_select' => 'template-2',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'template_two_title_text_color',
            [
                'label' => esc_html__( 'Title Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-two-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-2',
                ],
            ]
        );

        // For Template - 3 
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_three_price_typography',
                'label' => esc_html__( 'Price', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-review-archive-template-three-price-value',
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'title_three_price_color',
            [
                'label' => esc_html__( 'Price Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-three-price-value' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_three_save_typography',
                'label' => esc_html__( 'Save', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-review-archive-template-three-save-value',
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'title_three_save_color',
            [
                'label' => esc_html__( 'Save Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-three-save-value' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        // template - 4 

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_template_four_title_typography',
                'label' => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-review-archive-template-four-container-title',
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'trad_template_four_title_color',
            [
                'label' => esc_html__( 'Title Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-four-container-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );


        // template - 5

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_template_five_title_typography',
                'label' => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-template-five-service-name',
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'trad_template_five_title_color',
            [
                'label' => esc_html__( 'Title Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-service-name' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_five_price_typography',
                'label' => esc_html__( 'Price', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-template-five-price-value',
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'title_five_price_color',
            [
                'label' => esc_html__( 'Price Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-price-value' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_five_save_typography',
                'label' => esc_html__( 'Save', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-template-five-save',
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'title_five_save_color',
            [
                'label' => esc_html__( 'Save Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-save' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'description_style_section',
            [
                'label' => esc_html__( 'Description', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_text_typography',
                'label' => esc_html__( 'Description', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-review-archive-features',
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'description_text_color',
            [
                'label' => esc_html__( 'Title Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-features' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'template_two_description_typography',
                'label' => esc_html__( 'Description', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-template-two-description',
                'condition' => [
                    'template_select' => 'template-2',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'template_two_description_text_color',
            [
                'label' => esc_html__( 'Description Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-two-description' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_three_secure_typography',
                'label' => esc_html__( 'Secure', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-review-archive-template-three-secure-value',
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'title_three_secure_color',
            [
                'label' => esc_html__( 'Secure Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-three-secure-value' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_three_money_typography',
                'label' => esc_html__( 'Money Back', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-review-archive-template-three-money-back',
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'title_three_money_color',
            [
                'label' => esc_html__( 'Money Back Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-three-money-back' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        ); 

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_template_four_description_typography',
                'label' => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-review-archive-template-four-container-description',
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'trad_template_four_description_color',
            [
                'label' => esc_html__( 'Title Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-four-container-description' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );
        
        // Teamplate - 5

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_five_secure_typography',
                'label' => esc_html__( 'Secure', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-template-five-devices',
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'title_five_secure_color',
            [
                'label' => esc_html__( 'Secure Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-devices' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_five_money_typography',
                'label' => esc_html__( 'Money Back', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-template-five-money-back',
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'title_five_money_color',
            [
                'label' => esc_html__( 'Money Back Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-money-back' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        ); 


        $this->end_controls_section();


        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__( 'Button Style', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'template_select' => ['template-1', 'template-3', 'template-4', 'template-5'],
                ],
            ]
        );
        
        // Button Background Color
        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__( 'Button Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#6a33d8',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-btn' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        // Button Text Color
        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__( 'Button Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-btn' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        // Button Font Size
        $this->add_control(
            'button_font_size',
            [
                'label' => esc_html__( 'Button Font Size', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-btn' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        // Button Border Radius
        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Button Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
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
                    '{{WRAPPER}} .trad-review-archive-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        // Button Hover Background Color
        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => esc_html__( 'Button Hover Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-btn:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        // Button Hover Text Color
        $this->add_control(
            'button_hover_text_color',
            [
                'label' => esc_html__( 'Button Hover Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-btn:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        // template - 3 
        // Button -1
        // Button Background Color
        $this->add_control(
            'template_three_button_bg_color',
            [
                'label' => esc_html__( 'Button Background Color - 1', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#6a33d8',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-three-visit-btn' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_button_bg_color',
            [
                'label' => esc_html__( 'Button Background Color - 1', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#6a33d8',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-four-visit-btn' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        $this->add_control(
            'template_five_button_bg_color',
            [
                'label' => esc_html__( 'Button Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#6a33d8',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-visit-btn' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        // Button Text Color
        $this->add_control(
            'template_three_button_text_color',
            [
                'label' => esc_html__( 'Button Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-three-visit-btn' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_button_text_color',
            [
                'label' => esc_html__( 'Button Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-four-visit-btn' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        $this->add_control(
            'template_five_button_text_color',
            [
                'label' => esc_html__( 'Button Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-visit-btn' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        $this->add_control(
            'template_five_button_review_text_color',
            [
                'label' => esc_html__( 'Review Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-review-link' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        // Button Font Size
        $this->add_control(
            'template_three_button_font_size',
            [
                'label' => esc_html__( 'Button Font Size', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-template-three-visit-btn' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_button_font_size',
            [
                'label' => esc_html__( 'Button Font Size', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-template-four-visit-btn' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        $this->add_control(
            'template_five_button_font_size',
            [
                'label' => esc_html__( 'Button Font Size', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-visit-btn' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        $this->add_control(
            'template_five_review_button_font_size',
            [
                'label' => esc_html__( 'Review Font Size', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-review-link' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        $this->add_control(
            'template_four_button_width',
            [
                'label' => esc_html__( 'Width', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 50,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 16,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-template-four-visit-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        // Button Border Radius
        $this->add_control(
            'template_three_button_border_radius',
            [
                'label' => esc_html__( 'Button Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
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
                    '{{WRAPPER}} .trad-template-three-visit-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_button_border_radius',
            [
                'label' => esc_html__( 'Button Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
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
                    '{{WRAPPER}} .trad-template-four-visit-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        $this->add_control(
            'template_five_button_border_radius',
            [
                'label' => esc_html__( 'Button Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
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
                    '{{WRAPPER}} .trad-template-five-visit-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        // Button Hover Background Color
        $this->add_control(
            'template_three_button_hover_bg_color',
            [
                'label' => esc_html__( 'Button Hover Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-template-three-visit-btn:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_button_hover_bg_color',
            [
                'label' => esc_html__( 'Button Hover Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-template-four-visit-btn:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        $this->add_control(
            'template_five_button_hover_bg_color',
            [
                'label' => esc_html__( 'Button Hover Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-visit-btn:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        // Button Hover Text Color
        $this->add_control(
            'template_three_button_hover_text_color',
            [
                'label' => esc_html__( 'Button Hover Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-template-three-visit-btn:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_button_hover_text_color',
            [
                'label' => esc_html__( 'Button Hover Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-template-four-visit-btn:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        $this->add_control(
            'template_five_button_hover_text_color',
            [
                'label' => esc_html__( 'Button Hover Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-visit-btn:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        $this->add_control(
            'template_five_review_button_hover_text_color',
            [
                'label' => esc_html__( 'Review Hover Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-review-link:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );

        // BUtton -2 
        // Button Background Color
        $this->add_control(
            'template_three_review_button_bg_color',
            [
                'label' => esc_html__( 'Review Button Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#6a33d8',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-three-review-btn' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_review_button_bg_color',
            [
                'label' => esc_html__( 'Review Button Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#6a33d8',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-four-review-btn' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        // Button Text Color
        $this->add_control(
            'template_three_review_button_text_color',
            [
                'label' => esc_html__( 'Review Button Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-three-review-btn' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_review_button_text_color',
            [
                'label' => esc_html__( 'Review Button Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-four-review-btn' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        // Button Font Size
        $this->add_control(
            'template_three_review_button_font_size',
            [
                'label' => esc_html__( 'Review Button Font Size', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-template-three-review-btn' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_review_button_font_size',
            [
                'label' => esc_html__( 'Review Button Font Size', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-template-four-review-btn' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        $this->add_control(
            'template_four_review_button_width',
            [
                'label' => esc_html__( 'Review Button Width', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 50,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 16,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-template-four-review-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        // Button Border Radius
        $this->add_control(
            'template_three_review_button_border_radius',
            [
                'label' => esc_html__( 'Review Button Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
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
                    '{{WRAPPER}} .trad-template-three-review-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_review_button_border_radius',
            [
                'label' => esc_html__( 'Review Button Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
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
                    '{{WRAPPER}} .trad-template-four-review-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        // Button Hover Background Color
        $this->add_control(
            'template_three_review_button_hover_bg_color',
            [
                'label' => esc_html__( 'Review Button Hover Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-template-three-review-btn:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_review_button_hover_bg_color',
            [
                'label' => esc_html__( 'Review Button Hover Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-template-four-review-btn:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        // Button Hover Text Color
        $this->add_control(
            'template_three_review_button_hover_text_color',
            [
                'label' => esc_html__( 'Review Button Hover Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-template-three-review-btn:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_control(
            'template_four_review_button_hover_text_color',
            [
                'label' => esc_html__( 'Review Button Hover Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-template-four-review-btn:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'tc_style_section',
            [
                'label' => esc_html__( 'Terms & Condition', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'template_select' => ['template-1', 'template-3', 'template-4', 'template-5'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tc_text_typography',
                'label' => esc_html__( 'Terms Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-review-archive-terms',
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'tc_text_color',
            [
                'label' => esc_html__( 'Terms Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-action .trad-review-archive-terms' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_template_three_terms_text_typography',
                'label' => esc_html__( 'Terms Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-template-three-terms',
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'trad_template_three_terms_text_color',
            [
                'label' => esc_html__( 'Terms Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-three-terms' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_template_four_terms_text_typography',
                'label' => esc_html__( 'Terms Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-template-three-terms',
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'trad_template_four_terms_text_color',
            [
                'label' => esc_html__( 'Terms Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-three-terms' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trad_template_five_terms_text_typography',
                'label' => esc_html__( 'Terms Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-template-five-terms',
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );
        
        // Color Control for Terms Text
        $this->add_control(
            'trad_template_five_terms_text_color',
            [
                'label' => esc_html__( 'Terms Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-template-five-terms' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-5',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'divider_style_section',
            [
                'label' => esc_html__( 'Divider Style', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'template_select' => ['template-3', 'template-4'],
                ],
            ]
        );

        // Divider Width
        $this->add_control(
            'divider_width',
            [
                'label' => esc_html__( 'Width', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 50,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-three-divider' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        // Divider Height
        $this->add_control(
            'divider_height',
            [
                'label' => esc_html__( 'Height', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0.1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 78,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-three-divider' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        // Divider Background Color
        $this->add_control(
            'divider_background_color',
            [
                'label' => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-three-divider' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );

        // Divider Margin
        $this->add_responsive_control(
            'divider_margin',
            [
                'label' => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '10',
                    'right' => '0',
                    'bottom' => '10',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-three-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-3',
                ],
            ]
        );
        
        // Border Width Control for .trad-review-archive-template-four-container-header
        $this->add_control(
            'trad_card_header_border_width',
            [
                'label' => esc_html__( 'Border Width', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-four-container-header' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );
    
        // Border Color Control for .trad-review-archive-template-four-container-header
        $this->add_control(
            'trad_card_header_border_color',
            [
                'label' => esc_html__( 'Border Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000', // Set a default color
                'selectors' => [
                    '{{WRAPPER}} .trad-review-archive-template-four-container-header' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-4',
                ],
            ]
        );        

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Get the dynamic data
        $selected_template = isset( $settings['template_select'] ) ? $settings['template_select'] : 'template-1';
        $dynamic_title = isset( $settings['dynamic_title'] ) ? $settings['dynamic_title'] : 'Default Title';
        $dynamic_sub_title = isset( $settings['dynamic_sub_title'] ) ? $settings['dynamic_sub_title'] : 'Default Sub Title';
        $dynamic_content = isset( $settings['dynamic_content'] ) ? $settings['dynamic_content'] : 'Default Content';

        $number_of_stars = isset( $settings['number_of_stars'] ) ? $settings['number_of_stars'] : 5;
        $rating = $settings['star_rating']['size'];
        $star_color = sanitize_hex_color($settings['star_color']);
        $star_background_color = sanitize_hex_color($settings['star_background_color']);
        $star_size = isset($settings['star_size']['size']) ? absint($settings['star_size']['size']) . 'px' : '60px';
        $hover_class = $settings['enable_hover'] === 'yes' ? 'trad-template-stars-hover' : '';

        $stars_content = str_repeat('★', $number_of_stars);

        $button_text = isset( $settings['button_text'] ) ? $settings['button_text'] : 'Visit';
        $button_text_two = isset( $settings['button_text_two'] ) ? $settings['button_text_two'] : 'Read Review';
        $tc_text = isset( $settings['tc_text'] ) ? $settings['tc_text'] : 'T&Cs Apply';
        $template_three_tc_text = isset( $settings['template_three_tc_text'] ) ? $settings['template_three_tc_text'] : 'T&Cs Apply';  
        $template_four_tc_text = isset( $settings['template_four_tc_text'] ) ? $settings['template_four_tc_text'] : 'T&Cs Apply';  

        $template_five_tc_text = isset( $settings['template_five_terms_condition_text'] ) ? $settings['template_five_terms_condition_text'] : 'Terms and Condition';  
        // Template - 3

        
        $money_back_title = isset( $settings['money_back_title'] ) ? $settings['money_back_title'] : '45-day money-back guarantee';
        $template_three_price_title = isset( $settings['template_three_price_title'] ) ? $settings['template_three_price_title'] : '$2.05/month';
        $template_three_save_title = isset( $settings['template_three_save_title'] ) ? $settings['template_three_save_title'] : 'Save 85%';
        $template_three_secure_title = isset( $settings['template_three_secure_title'] ) ? $settings['template_three_secure_title'] : 'Secure up to 8 devices';
        $link_url = isset($settings['template_three_tc_url']['url']) ? esc_url($settings['template_three_tc_url']['url']) : '#';
        $link_url_four = isset($settings['template_four_tc_url']['url']) ? esc_url($settings['template_four_tc_url']['url']) : '#';
        $link_url_review_five = isset($settings['template_five_button_review_url']['url']) ? esc_url($settings['template_five_button_review_url']['url']) : '#';
        $link_url_five = isset($settings['template_five_button_url']['url']) ? esc_url($settings['template_five_button_url']['url']) : '#';
        $link_url_one = isset($settings['template_one_button_url']['url']) ? esc_url($settings['template_one_button_url']['url']) : '#';
        $link_url_three = isset($settings['template_three_button_url']['url']) ? esc_url($settings['template_three_button_url']['url']) : '#';
        $link_url_three_review = isset($settings['template_three_review_button_url']['url']) ? esc_url($settings['template_three_review_button_url']['url']) : '#';

        
        // Pass the dynamic data to the template
        if ( 'template-1' === $selected_template ) {
            include plugin_dir_path( __FILE__ ) . '../templates/template-1.php';
        } elseif ( 'template-2' === $selected_template ) {
            include plugin_dir_path( __FILE__ ) . '../templates/template-2.php';
        } elseif ( 'template-3' === $selected_template ) {
            include plugin_dir_path( __FILE__ ) . '../templates/template-3.php';
        } elseif ( 'template-4' === $selected_template ) {
            include plugin_dir_path( __FILE__ ) . '../templates/template-4.php';
        } elseif ( 'template-5' === $selected_template ) {
            include plugin_dir_path( __FILE__ ) . '../templates/template-5.php';
        }
    }
}

// Register widget
Plugin::instance()->widgets_manager->register_widget_type( new TRAD_Review_Archive() );
