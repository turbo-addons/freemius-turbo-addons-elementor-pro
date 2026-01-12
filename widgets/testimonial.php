<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;

class TRAD_Testimonial_Slider extends Widget_Base {

    public function get_name() {
        return 'trad_testimonial_slider';
    }

    public function get_title() {
        return esc_html__('Turbo Testimonial Slider', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-post-slider trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Testimonials', 'turbo-addons-elementor-pro'),
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
                ],
                'default' => 'template-1',
            ]
        );

        $repeater = new Repeater();

        // Testimonial Image
        $repeater->add_control(
            'testimonial_image',
            [
                'label' => esc_html__('Choose Image', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        // Testimonial Name
        $repeater->add_control(
            'testimonial_name',
            [
                'label' => esc_html__('Name', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Mr. Turbo', 'turbo-addons-elementor-pro'),
            ]
        );

        // Testimonial Location
        $repeater->add_control(
            'testimonial_location',
            [
                'label' => esc_html__('Location', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('San Francisco, USA', 'turbo-addons-elementor-pro'),
            ]
        );

        // Testimonial Content
        $repeater->add_control(
            'testimonial_content',
            [
                'label' => esc_html__('Testimonial Content', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Discover Turbo Addons: empowering your creativity with a complete suite of tools to bring your design vision to life.', 'turbo-addons-elementor-pro'),
            ]
        );

        // Add the repeater control with a default value
        $this->add_control(
            'testimonials_list',
            [
                'label' => esc_html__('Testimonials List', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_image' => ['url' => esc_url(TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/images/trad-testimonial.jpg')],
                        'testimonial_name' => esc_html__('Mr. Turbo', 'turbo-addons-elementor-pro'),
                        'testimonial_location' => esc_html__('San Francisco, USA', 'turbo-addons-elementor-pro'),
                        'testimonial_content' => esc_html__('Discover Turbo Addons: empowering your creativity with a complete suite of tools to bring your design vision to life.', 'turbo-addons-elementor-pro'),
                    ],
                ],
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'speed_content_section',
            [
                'label' => esc_html__('Slider Speed', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        // Control for slider speed
        $this->add_control(
            'slider_speed',
            [
                'label' => esc_html__('Slider Speed (ms)', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Style', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Background Color Control
        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_slider',
            [
                'label' => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-slider' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_slider_padding',
            [
                'label' => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '20',
                    'right' => '20',
                    'bottom' => '20',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_slider_margin',
            [
                'label' => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        // image controller

        // Width Control
        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_image_width',
            [
                'label' => esc_html__( 'Image Width', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px', // Default unit
                    'size' => 100, // Default size
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        // Height Control
        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_image_height',
            [
                'label' => esc_html__( 'Image Height', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px', // Default unit
                    'size' => 100, // Default size
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-image img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        // Border Radius Control
        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_image_border_radius',
            [
                'label' => esc_html__( 'Image Border Radius', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => '%', // Default unit
                    'size' => 50, // Default size
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-image img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );



        //image alignment

        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_image_alignment',
            [
                'label'   => esc_html__( 'Image Alignment', 'turbo-addons-elementor-pro' ),
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-image' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        

        //title
        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_name_color',
            [
                'label' => esc_html__( 'Title Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-name' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_turbo_testmonial_slider_template_one_name_typography', // Unique name for the control
                'label'    => esc_html__( 'Title Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-name',
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_name_alignment',
            [
                'label' => esc_html__( 'Title Alignment', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::CHOOSE,
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
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-name' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        //location

        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_location_color',
            [
                'label' => esc_html__( 'Location Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-location' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_turbo_testmonial_slider_template_one_location_typography', // Unique name for the control
                'label'    => esc_html__( 'Location Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-location',
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_location_alignment',
            [
                'label' => esc_html__( 'Location Alignment', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::CHOOSE,
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
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-location' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
    
        //text
        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_text_color',
            [
                'label' => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-text' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_turbo_testmonial_slider_template_one_text_typography', // Unique name for the control
                'label'    => esc_html__( 'Text Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-text',
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_text_alignment',
            [
                'label' => esc_html__( 'Text Alignment', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::CHOOSE,
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
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'turbo-addons-elementor-pro' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-text' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_dot_color',
            [
                'label' => esc_html__( 'Dot Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#d0d0d0', // Default color for the dot
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-dot' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'trad_turbo_testmonial_slider_template_one_dot_width',
            [
                'label' => esc_html__( 'Dot Width', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-dot' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'trad_turbo_testmonial_slider_template_one_dot_height',
            [
                'label' => esc_html__( 'Dot Height', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-dot' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        
        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_active_dot_color',
            [
                'label' => esc_html__( 'Active Dot Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#007bff', // Default color for the active dot
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-active' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );

        $this->add_control(
            'trad_turbo_testmonial_slider_template_one_controls_alignment',
            [
                'label' => esc_html__( 'Controls Alignment', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::CHOOSE,
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .trad-turbo-testmonial-slider-template-one-controls' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-1',
                ],
            ]
        );
        
        // For Template - 2
        $this->add_control(
            'testimonial-template-two-content_background_color',
            [
                'label' => esc_html__( 'Content Background Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-testimonial-template-two-content' => 'background-color: {{VALUE}};',
                ],
                'default' => '#07013112',
                'condition' => [
                    'template_select' => 'template-2',
                ],
            ]
        );

        $this->add_control(
            'trad_testimonial_template_two_content_description_color',
            [
                'label' => esc_html__( 'Review Description Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-testimonial-template-two-content-description' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_testimonial_template_two_content_description_typography', // Unique name for the control
                'label'    => esc_html__( 'Review Description Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-testimonial-template-two-content-description',
                'condition' => [
                    'template_select' => 'template-2',
                ],
            ]
        );

        $this->add_control(
            'trad_testimonial_template_two_content_heading_color',
            [
                'label' => esc_html__( 'Review Heading Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-testimonial-template-two-content-heading' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_testimonial_template_two_content_heading_typography', // Unique name for the control
                'label'    => esc_html__( 'Review Heading Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-testimonial-template-two-content-heading',
                'condition' => [
                    'template_select' => 'template-2',
                ],
            ]
        );

        $this->add_control(
            'trad_testimonial_template_two_content_author_color',
            [
                'label' => esc_html__( 'Review Author Color', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#808080',
                'selectors' => [
                    '{{WRAPPER}} .trad-testimonial-template-two-content-author' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'template_select' => 'template-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_testimonial_template_two_content_author_typography', // Unique name for the control
                'label'    => esc_html__( 'Review Author Typography', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-testimonial-template-two-content-author',
                'condition' => [
                    'template_select' => 'template-2',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $testimonials = $settings['testimonials_list'];
        $selected_template_for_testimonial = isset( $settings['template_select'] ) ? $settings['template_select'] : 'template-1';
        $slider_speed = isset($settings['slider_speed']) && is_int($settings['slider_speed']) ? $settings['slider_speed'] : 5000;
        // Pass the dynamic data to the template
        if ( 'template-1' === $selected_template_for_testimonial ) {
            include plugin_dir_path( __FILE__ ) . '../templates/testimonial/testimonial-template-1.php';
        } elseif ( 'template-2' === $selected_template_for_testimonial ) {
            include plugin_dir_path( __FILE__ ) . '../templates/testimonial/testimonial-template-2.php';
        }
    }
}


// Register the widget with Elementor.
Plugin::instance()->widgets_manager->register_widget_type( new TRAD_Testimonial_Slider() );