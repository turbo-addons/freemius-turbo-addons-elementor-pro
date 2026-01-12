<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Repeater;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class TRAD_3D_Carousel_Widget extends Widget_Base {

    public function get_name() {
        return 'trad_3d_carousel';
    }

    public function get_title() {
        return __('3D Carousel', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-carousel trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
    
        $repeater = new Repeater();
    
        $repeater->add_control(
            'image',
            [
                'label' => __('Choose Image', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
    
        $this->add_control(
            'carousel_images',
            [
                'label' => __('Carousel Images', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' =>[ 
                    [
                    'url' => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    
            ],
                'title_field' => '{{{ image.url ? "Image" : "Add Image" }}}',
                'max_items' => 6,  // Limit to 6 images
            ]
        );


        // Animation Speed Control
    $this->add_control(
        'animation_speed',
        [
            'label' => __('Sliding Animation Speed (seconds)', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::NUMBER,
            'default' => 15,
            'min' => 1,
            'max' => 60,
            'step' => 1,
            'description' => __('Set the animation speed in seconds', 'turbo-addons-elementor-pro'),
        ]
    );

    // Animation Direction Control
    $this->add_control(
        'animation_direction',
        [
            'label' => __('Sliding Direction', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::SELECT,
            'default' => 'clockwise',
            'options' => [
                'clockwise' => __('Clockwise', 'turbo-addons-elementor-pro'),
                'counterclockwise' => __('Counterclockwise', 'turbo-addons-elementor-pro'),
                
            ],
        ]
    );


    $this->add_control(
        'hover_pause_animation',
        [
            'label' => __( 'Pause on Hover (See the hover Effect in live)', 'turbo-addons-elementor-pro' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'On', 'turbo-addons-elementor-pro' ),
            'label_off' => __( 'Off', 'turbo-addons-elementor-pro' ),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );
    
$this->end_controls_section();


    // Slider body controller//
    $this->start_controls_section(
        'slider_container_style',
        [
            'label' => __( 'Slider Container', 'turbo-addons-elementor-pro' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => 'slider_container_background',
            'label' => __( 'Background', 'turbo-addons-elementor-pro' ),
            'types' => [ 'classic', 'gradient', 'video' ],
            'selector' => '{{WRAPPER}} .trad-3d-carousel-body',
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'slider_container_box_shadow',
            'label' => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-3d-carousel-body',
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'slider_container_border',
            'label' => __( 'Border', 'turbo-addons-elementor-pro' ),
            'selector' => '{{WRAPPER}} .trad-3d-carousel-body',
        ]
    );

    // height and width controller///
    $this->add_responsive_control(
        'Container_height',
        [
            'label'      => esc_html__('Height', 'turbo-addons-elementor-pro'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px', 'em', '%'],
            'range'      => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'default'    => [
                    'size' => 350,
                    'unit' => 'px',
                ],
            'selectors'  => [
                '{{WRAPPER}} .trad-3d-carousel-body' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'Container_width',
        [
            'label'      => esc_html__('Width', 'turbo-addons-elementor-pro'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px', 'em', '%'],
            'range'      => [
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default'    => [
                    'size' => 100,
                    'unit' => '%',
                ],
            'selectors'  => [
                '{{WRAPPER}} .trad-3d-carousel-body' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();

         // Style Controls for Each Slide
    $this->start_controls_section(
        'style_section',
        [
            'label' => __('Slide Style', 'turbo-addons-elementor-pro'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'image_border',
            'label' => __('Border', 'turbo-addons-elementor-pro'),
            'selector' => '{{WRAPPER}} .trad-3d-carousel-gallery > img',
        ]
    );

    $this->add_control(
        'image_border_radius',
        [
            'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .trad-3d-carousel-gallery > img' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'image_box_shadow',
            'label' => __('Box Shadow', 'turbo-addons-elementor-pro'),
            'selector' => '{{WRAPPER}} .trad-3d-carousel-gallery > img',
        ]
    );

    $this->add_control(
        'image_background_color',
        [
            'label' => __('Background Color', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::COLOR,
            'default' => 'transparent',
            'selectors' => [
                '{{WRAPPER}} .trad-3d-carousel-gallery > img' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    // height and width controller///
    $this->add_responsive_control(
        'Slide_height',
        [
            'label'      => esc_html__('Height', 'turbo-addons-elementor-pro'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px', 'em', '%'],
            'range'      => [
                'px' => [
                    'min' => 0,
                    'max' => 400,
                ],
            ],
            'default'    => [
                    'size' => 150,
                    'unit' => 'px',
                ],
            'selectors'  => [
                '{{WRAPPER}} .trad-3d-carousel-gallery > img' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'Slide_width',
        [
            'label'      => esc_html__('Width', 'turbo-addons-elementor-pro'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px', 'em', '%'],
            'range'      => [
                'px' => [
                    'min' => 0,
                    'max' => 400,
                ],
            ],
            'default'    => [
                    'size' => 150,
                    'unit' => 'px',
                ],
            'selectors'  => [
                '{{WRAPPER}} .trad-3d-carousel-gallery > img' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();


    // Shape Style Controls for Polygon
    $this->start_controls_section(
        'shape_style_section',
        [
            'label' => __('Shape Style', 'turbo-addons-elementor-pro'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'polygon_background_color',
        [
            'label' => __('Background Color', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::COLOR,
            'default' => 'rgba(6, 88, 165, 0.541)',
            'selectors' => [
                '{{WRAPPER}} .trad-3d-carousel-gallery::before' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_section();
}

protected function render() {
    $settings = $this->get_settings_for_display();

    // Sanitize animation speed and direction inputs
    $animation_duration = intval( $settings['animation_speed'] ) . 's'; // Ensures it's an integer value for seconds
    $animation_direction = sanitize_text_field( $settings['animation_direction'] );

    // Define inline @keyframes based on the direction
    $direction_css = ($animation_direction === 'clockwise') ? 
        '@keyframes rotateAnim { 0% {transform: perspective(450px) rotateX(-100deg) rotate(0deg);} 100% {transform: perspective(450px) rotateX(-100deg) rotate(-360deg);}}' : 
        '@keyframes rotateAnim { 0% {transform: perspective(450px) rotateX(-100deg) rotate(0deg);} 100% {transform: perspective(450px) rotateX(-100deg) rotate(360deg);}}';

    // Escape CSS output
    echo '<style>' . esc_html( $direction_css ) . '</style>';
    echo '<div class="trad-3d-carousel-body"><div class="trad-3d-carousel-gallery" style="animation: rotateAnim ' . esc_attr( $animation_duration ) . ' linear infinite;">';

    if ( ! empty( $settings['carousel_images'] ) ) {
        foreach ( $settings['carousel_images'] as $index => $item ) {
            $image_url = isset($item['image']['url']) ? esc_url( $item['image']['url'] ) : '';
            // echo '<img src="' . $image_url . '" style="--_a:' . esc_attr( $index * 60 ) . 'deg; transform: rotate(var(--_a)) translateY(120%) rotateX(90deg);">';
            echo '<img src="' . esc_url( $image_url ) . '" style="--_a:' . esc_attr( $index * 60 ) . 'deg; transform: rotate(var(--_a)) translateY(120%) rotateX(90deg);">';
        }
    }
    echo '</div></div>';

    // Add JavaScript for pause-on-hover if the option is enabled
    if ( 'yes' === $settings['hover_pause_animation'] ) :
    ?>
   <script>
    jQuery(document).ready(function($) {
        const $gallery = $('.trad-3d-carousel-gallery');
        $gallery.on('mouseenter', function() {
            $(this).css('animation-play-state', 'paused');
        });
        $gallery.on('mouseleave', function() {
            $(this).css('animation-play-state', 'running');
        });
    });
</script>
    <?php
    endif;
}

public function _content_template() {}

}
// Register the widget with Elementor
Plugin::instance()->widgets_manager->register_widget_type( new TRAD_3D_Carousel_Widget() );
