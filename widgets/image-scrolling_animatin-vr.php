<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class TRAD_Image_Scroll_Widget extends Widget_Base {
    
    public function get_name() {
        return 'image-vertical-scroll-widget';
    }
// image-scrolling_animatin-vr

    public function get_title() {
        return __('Image Vertical Scrolling', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-slider-vertical trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    protected function _register_controls() {
        // Section: Content
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image_list',
            [
                'label'       => __('Images', 'turbo-addons-elementor-pro'),
                'type'        => Controls_Manager::GALLERY,
                'default'     => [],
                'description' => __('Add images to the scrolling gallery', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->end_controls_section();

        // Section: Settings
        $this->start_controls_section(
            'settings_section',
            [
                'label' => __('Settings', 'turbo-addons-elementor-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'scroll_speed',
            [
                'label'   => __('Scroll Speed (seconds)', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 10,
                'min'     => 1,
                'step'    => 1,
                'description' => __('Set the speed of the scrolling animation.', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'scroll_direction',
            [
                'label'   => __('Scroll Direction', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'btt', // default is Bottom-to-Top
                'options' => [
                    'btt' => __('Bottom to Top', 'turbo-addons-elementor-pro'),
                    'ttb' => __('Top to Bottom', 'turbo-addons-elementor-pro'),
                ],
                'description' => __('Choose the direction of the scrolling animation.', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'   => __('Columns', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::SLIDER,
                'size_units' => [''],
                'range'   => [
                    '' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-image-grid-scrolling-inner' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                ],
            ]
        );

        $this->add_control(
            'gap',
            [
                'label'   => __('Gap (px)', 'turbo-addons-elementor-pro'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 10,
                'min'     => 0,
                'step'    => 1,
                'description' => __('Spacing between images.', 'turbo-addons-elementor-pro'),
            ]
        );
        // paused on off controller
        $this->add_control(
            'pause_on_hover',
            [
                'label'        => __('Pause on Hover', 'turbo-addons-elementor-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'turbo-addons-elementor-pro'),
                'label_off'    => __('No', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'selectors'    => [
                    '{{WRAPPER}}:hover .trad-image-grid-scrolling-wrapper' => 'animation-play-state: paused;',
                ],
            ]
        );

        $this->end_controls_section();
        //----------------------style sections-------------------------------------------
        //--------------------------------------------------------------------------------
        //------------------------------box style---------
        $this->start_controls_section(
            'trad_box_auto_scroller_box_style',
            [
                'label' => esc_html__('Box', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'trad_box_auto_scroller_padding',
            [
                'label' => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-image-grid-scrolling-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'wrapper_box_shadow',
                    'selector' => '{{WRAPPER}} .trad-image-grid-scrolling',
                ]
            );
        
        $this->end_controls_section();


        $this->start_controls_section(
            'trad_auto_scroll_image_style',
            [
                'label' => esc_html__('Image', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Image Width Controller
        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1024,
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
                    '{{WRAPPER}} .trad-image-grid-scrolling-inner img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //---------------image border--------------
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'image_border',
                'label'    => __('Border', 'turbo-addons-elementor-pro'),
                'selector' => '{{WRAPPER}} .trad-image-grid-scrolling-inner img',
            ]
        );
        // ----------------border radious----------------
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-image-grid-scrolling-inner img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
    $s = $this->get_settings_for_display();
    $images    = $s['image_list'];
    $speed     = !empty($s['scroll_speed']) ? $s['scroll_speed'] : 10;
    $direction = !empty($s['scroll_direction']) ? $s['scroll_direction'] : 'btt';
    $gap       = isset($s['gap']) ? (int) $s['gap'] : 10;

    if (empty($images)) {
        echo '<p>' . esc_html__('No images added.', 'turbo-addons-elementor-pro') . '</p>';
        return;
    }
    ?>
    <div class="trad-image-grid-scrolling scroll-direction-<?php echo esc_attr($direction); ?>"
         style="--speed: <?php echo esc_attr($speed); ?>s; --gap: <?php echo esc_attr($gap); ?>px;">
        <div class="trad-image-grid-scrolling-wrapper">
            
            <div class="trad-image-grid-scrolling-inner">
                <?php foreach ($images as $img) : ?>
                    <img src="<?php echo esc_url($img['url']); ?>" alt="" loading="lazy">
                <?php endforeach; ?>
            </div>

            <div class="trad-image-grid-scrolling-inner clone">
                <?php foreach ($images as $img) : ?>
                    <img src="<?php echo esc_url($img['url']); ?>" alt="" loading="lazy" aria-hidden="true">
                <?php endforeach; ?>
            </div>

        </div>
    </div>
    <?php
}

}

// Register the widget
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new TRAD_Image_Scroll_Widget());
