<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography; 
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_Turbo_Slider_Pro extends Widget_Base {

    public function get_name() {
        return 'trad_hero_slider';
    }

    public function get_title() {
        return __('Hero Slider', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-slider-device trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    protected function register_controls() {
      // Start Section for Slides
    $this->start_controls_section(
          'slides_section',
          [
              'label' => __('Slides', 'turbo-addons-elementor-pro'),
              'tab'   => Controls_Manager::TAB_CONTENT,
          ]
      );

      // Repeater Control for Slide Content
      $repeater = new Repeater();

      $repeater->add_control(
          'slide_background_image',
          [
              'label'   => __('Background Image', 'turbo-addons-elementor-pro'),
              'type'    => Controls_Manager::MEDIA,
              'default' => [
                  'url' => Utils::get_placeholder_image_src(),
              ],
          ]
        );

      $repeater->add_control(
          'slide_title',
          [
              'label'   => __('Slide Title', 'turbo-addons-elementor-pro'),
              'type'    => Controls_Manager::TEXT,
              'default' => __('Default Title', 'turbo-addons-elementor-pro'),
              'label_block' => true,
          ]
      );

      $repeater->add_control(
          'slide_sub_title',
          [
              'label'   => __('Slide Subtitle', 'turbo-addons-elementor-pro'),
              'type'    => Controls_Manager::TEXT,
              'default' => __('Default Subtitle ', 'turbo-addons-elementor-pro'),
              'label_block' => true,
          ]
      );

      $repeater->add_control(
          'slide_text',
          [
              'label'   => __('Slide Text', 'turbo-addons-elementor-pro'),
              'type'    => Controls_Manager::TEXTAREA,
              'default' => __('Default text for the slide.', 'turbo-addons-elementor-pro'),
              'label_block' => true,
          ]
      );

      $repeater->add_control(
          'slide_button_one',
          [
              'label'       => __('Button One Text', 'turbo-addons-elementor-pro'),
              'type'        => Controls_Manager::TEXT,
              'default'     => __('Learn More', 'turbo-addons-elementor-pro'),
              'label_block' => true,
          ]
      );

    $repeater->add_control(
          'slide_button_one_url',
          [
              'label'       => __('Button One URL', 'turbo-addons-elementor-pro'),
              'type'        => Controls_Manager::URL,
              'placeholder' => __('https://example.com', 'turbo-addons-elementor-pro'),
              'default'     => [
                  'url' => '#',
              ],
          ]
      );

    $repeater->add_control(
          'slide_button_two',
          [
              'label'       => __('Button Two Text', 'turbo-addons-elementor-pro'),
              'type'        => Controls_Manager::TEXT,
              'default'     => __('Get Info', 'turbo-addons-elementor-pro'),
              'label_block' => true,
          ]
      );

    $repeater->add_control(
          'slide_button_two_url',
          [
              'label'       => __('Button Two URL', 'turbo-addons-elementor-pro'),
              'type'        => Controls_Manager::URL,
              'placeholder' => __('https://example.com', 'turbo-addons-elementor-pro'),
              'default'     => [
                  'url' => '#',
              ],
          ]
      );

    // -------------------------------- Image Visibility Switch
        $repeater->add_control(
            'show_slide_image',
            [
                'label'        => esc_html__( 'Show Image', 'turbo-addons-elementor-pro' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'turbo-addons-elementor-pro' ),
                'label_off'    => esc_html__( 'Hide', 'turbo-addons-elementor-pro' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        // -------------------------------- Slider Image
        $repeater->add_control(
            'hero_slider_image_content',
            [
                'label'   => esc_html__( 'Slider Image', 'turbo-addons-elementor-pro' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'show_slide_image' => 'yes',
                ],
            ]
        );
     // ------ Shortcode Visibility Switch
     $repeater->add_control(
        'show_slide_shortcode',
        [
            'label'        => esc_html__( 'Show Shortcode', 'turbo-addons-elementor-pro' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'turbo-addons-elementor-pro' ),
            'label_off'    => esc_html__( 'Hide', 'turbo-addons-elementor-pro' ),
            'return_value' => 'yes',
            'default'      => '',
            ]
        );

    // -------------------------------- Shortcode Field
    $repeater->add_control(
        'slide_shortcode_content',
        [
            'label'       => esc_html__( 'Shortcode', 'turbo-addons-elementor-pro' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'placeholder' => esc_html__( '[your_shortcode]', 'turbo-addons-elementor-pro' ),
            'condition'   => [
                'show_slide_shortcode' => 'yes',
            ],
        ]
    );






    $this->add_control(
          'slides',
          [
              'label'       => __('Slides', 'turbo-addons-elementor-pro'),
              'type'        => Controls_Manager::REPEATER,
              'fields'      => $repeater->get_controls(),
              'default'     => [
                  [
                      'slide_background_image' => [
                          'url' => Utils::get_placeholder_image_src(),
                      ],
                      'slide_title' => __('Default Slide 1', 'turbo-addons-elementor-pro'),
                      'slide_text'  => __('This is the default text for slide 1.', 'turbo-addons-elementor-pro'),
                  ],
                  [
                      'slide_background_image' => [
                          'url' => Utils::get_placeholder_image_src(),
                      ],
                      'slide_title' => __('Default Slide 2', 'turbo-addons-elementor-pro'),
                      'slide_text'  => __('This is the default text for slide 2.', 'turbo-addons-elementor-pro'),
                  ],
              ],
              'title_field' => '{{{ slide_title }}}',
          ]
      );

    $this->end_controls_section();
    // ------------------------------------slider buttons settings
    $this->start_controls_section(
        'slider_buttons_settings',
            [
                'label' => __('Button Settings', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
    $this->add_responsive_control(
        'slide_btns_flex_direction',
        [
            'label'   => esc_html__( 'Buttons Direction', 'turbo-addons-elementor-pro' ),
            'type'    => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'row' => [
                    'title' => esc_html__( 'Row', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-h-align-left',
                ],
                'column' => [
                    'title' => esc_html__( 'Column', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-v-align-top',
                ],
    
            ],
            'default'   => 'row',
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_slide-btns' => 'flex-direction: {{VALUE}};',
            ],
        ]
    );

    // -------------------------------button justify content
    $this->add_responsive_control(
        'slide_btns_justify_content',
        [
            'label'   => esc_html__( 'Justify Content', 'turbo-addons-elementor-pro' ),
            'type'    => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => esc_html__( 'Start', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-h-align-left',
                ],
                'center' => [
                    'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-h-align-center',
                ],

                'flex-end' => [
                    'title' => esc_html__( 'End', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-h-align-right',
                ],
    
            ],
            'default'   => 'flex-start',
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_slide-btns' => 'justify-content: {{VALUE}};',
            ],
            'condition' => [
                'slide_btns_flex_direction' => 'row',
            ],
        ]
    );

    // ------------------------------- Button Align Items
    $this->add_responsive_control(
        'slide_btns_align_items',
        [
            'label'   => esc_html__( 'Align Items', 'turbo-addons-elementor-pro' ),
            'type'    => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => esc_html__( 'Top', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-v-align-top',
                ],
                'center' => [
                    'title' => esc_html__( 'Middle', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-v-align-middle',
                ],
                'flex-end' => [
                    'title' => esc_html__( 'Bottom', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-v-align-bottom',
                ],
            ],
            'default'   => 'center',
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_slide-btns' => 'align-items: {{VALUE}};',
            ],
            'condition' => [
                'slide_btns_flex_direction' => 'column',
            ],
        ]
    );

    $this->add_responsive_control(
    'slide_btns_gap',
        [
            'label' => esc_html__( 'Buttons Gap', 'turbo-addons-elementor-pro' ),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem' ],
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_slide-btns' => 'gap: {{SIZE}}{{UNIT}};',
            ],
            'default' => [
                'size' => 20,
            ],
        ]
    );

    $this->end_controls_section();

    // navigation icons
    $this->start_controls_section(
        'navigation_icons_section',
            [
                'label' => __('Navigation Icons', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

    $this->add_control(
        'show_navigation_icons',
        [
            'label'        => esc_html__( 'Navigation Icons', 'turbo-addons-elementor-pro' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'turbo-addons-elementor-pro' ),
            'label_off'    => esc_html__( 'Hide', 'turbo-addons-elementor-pro' ),
            'return_value' => 'yes',
            'default'      => 'yes',
            'selectors'    => [
                '{{WRAPPER}} .trad_turbo_slider_pro_swiper-button-prev' => 'display: {{VALUE}};',
                '{{WRAPPER}} .trad_turbo_slider_pro_swiper-button-next' => 'display: {{VALUE}};',
            ],
            'selectors_dictionary' => [
                'yes' => 'flex',
                ''    => 'none',
            ],
        ]
    );
    
    $this->add_control(
        'prev_icon',
        [
            'label' => __('Previous Icon', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-chevron-left',
                'library' => 'fa-solid',
            ],
            // 'condition' => [
            //     'show_navigation_icons' => 'yes',
            // ],
        ]
    );
    
    $this->add_control(
        'next_icon',
        [
            'label' => __('Next Icon', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-chevron-right',
                'library' => 'fa-solid',
            ],
            // 'condition' => [
            //     'show_navigation_icons' => 'yes',
            // ],
        ]
    );
    
    $this->end_controls_section();

    //================================================== style sections ================================
    //==================================================================================================

    $this->start_controls_section(
      'slider_style',
      [
          'label' => __('Slider Wrapper', 'turbo-addons-elementor-pro'),
          'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    // direction//
    $this->add_responsive_control(
        'slide_content_direction',
        [
            'label' => esc_html__( 'Content Direction', 'turbo-addons-elementor-pro' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'row' => [
                    'title' => esc_html__( 'Row', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-h-align-left',
                ],
                'row-reverse' => [
                    'title' => esc_html__( 'Row Reverse', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-h-align-right',
                ],
                'column' => [
                    'title' => esc_html__( 'Column', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-v-align-top',
                ],
                'column-reverse' => [
                    'title' => esc_html__( 'Column Reverse', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-v-align-bottom',
                ],
            ],
            // 'default' => 'row',
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_swiper-container .slide-bg-image' => 'flex-direction: {{VALUE}};',
            ],
        ]
    );
    // -------------------------------------------Justify content
    $this->add_responsive_control(
        'slide_content_justify',
        [
            'label' => esc_html__( 'Content Justify', 'turbo-addons-elementor-pro' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-text-align-center',
                ],
                'flex-end' => [
                    'title' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-text-align-right',
                ],
                'space-between' => [
                    'title' => esc_html__( 'Between', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-justify-space-between-h',
                ],
                'space-around' => [
                    'title' => esc_html__( 'Around', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-justify-space-around-h',
                ],
                'space-evenly' => [
                    'title' => esc_html__( 'Evenly', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-justify-space-evenly-h',
                ],
            ],
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_swiper-container .slide-bg-image' => 'justify-content: {{VALUE}};',
            ],
            'condition' => [
                // Optional: add condition if you only want this visible when certain layout enabled
            ],
        ]
    );
    //----------------------------------------------Align items
    $this->add_responsive_control(
        'slide_content_align_items',
        [
            'label' => esc_html__( 'Content Alignment', 'turbo-addons-elementor-pro' ),
            'type'  => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => esc_html__( 'Top', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-v-align-top',
                ],
                'center' => [
                    'title' => esc_html__( 'Middle', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-v-align-middle',
                ],
                'flex-end' => [
                    'title' => esc_html__( 'Bottom', 'turbo-addons-elementor-pro' ),
                    'icon'  => 'eicon-v-align-bottom',
                ],
            ],
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_swiper-container .slide-bg-image' => 'align-items: {{VALUE}};',
            ],
        ]
    );
    // Width control
    $this->add_responsive_control(
      'hero_slider_width',
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
              'unit' => '%',
              'size' => 100,
          ],
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider' => 'width: {{SIZE}}{{UNIT}} !important;',
          ],
      ]
    );

    // Height control
    $this->add_responsive_control(
      'hero_slider_height',
      [
          'label' => __('Height', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::SLIDER,
          'size_units' => ['px', '%', 'em', 'vh'], // Allow multiple units
          'range' => [
              'px' => [
                  'min' => 100,
                  'max' => 1200,
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
              'vh' => [
                  'min' => 10,
                  'max' => 100,
                  'step' => 1,
              ],
          ],
          'default' => [
              'unit' => 'vh',
              'size' => 80,
          ],
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider' => 'height: {{SIZE}}{{UNIT}};',
          ],
      ]
    );

    // Padding control
    $this->add_responsive_control(
      'hero_slider_padding',
      [
          'label' => __('Padding', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => ['px', 'em', '%'], // Allow padding in px, em, %
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
      ]
    );

    // Background color
    $this->add_group_control(
      Group_Control_Background::get_type(),
      [
          'name' => 'hero_slider_background',
          'label' => __('Background', 'turbo-addons-elementor-pro'),
          'types' => ['classic', 'gradient'],
          'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider',
      ]
    );

    // Border control
    $this->add_group_control(
      Group_Control_Border::get_type(),
      [
          'name' => 'hero_slider_border',
          'label' => __('Border', 'turbo-addons-elementor-pro'),
          'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider',
      ]
    );

    // Border radius
    $this->add_responsive_control(
      'hero_slider_border_radius',
      [
          'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::SLIDER,
          'size_units' => ['px', '%'], // Allow px and %
          'range' => [
              'px' => [
                  'min' => 0,
                  'max' => 100,
                  'step' => 1,
              ],
              '%' => [
                  'min' => 0,
                  'max' => 50,
                  'step' => 1,
              ],
          ],
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider' => 'border-radius: {{SIZE}}{{UNIT}};',
          ],
      ]
    );

    $this->add_control(
        'slide_overlay_color',
        [
            'label'     => esc_html__( 'Background Overlay', 'turbo-addons-elementor-pro' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .slide-inner.slide-bg-image::before' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    // Box shadow
    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      [
          'name' => 'hero_slider_box_shadow',
          'label' => __('Box Shadow', 'turbo-addons-elementor-pro'),
          'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider',
      ]
    );
    $this->end_controls_section();

    //----------------------------------------------Content Section---------
    $this->start_controls_section(
      'slider_inner_style',
      [
          'label' => __('Content Section', 'turbo-addons-elementor-pro'),
          'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    // ---------------------------------Content gap---------------------
    $this->add_responsive_control(
    'slide_content_gap',
        [
            'label' => esc_html__( 'Content Gap', 'turbo-addons-elementor-pro' ),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%', 'em', 'rem' ],
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_swiper-container .slide-bg-image' => 'gap: {{SIZE}}{{UNIT}};',
            ],
            'default' => [
                'size' => 20,
            ],
        ]
    );

    $this->add_responsive_control(
        'header_text_align',
        [
            'label' => __('Content Alignment', 'turbo-addons-elementor-pro'),
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
                'justify' => [
                    'title' => __('Justify', 'turbo-addons-elementor-pro'),
                    'icon' => 'eicon-text-align-justify',
                ],
            ],
            'default' => 'left', // Default alignment
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_header' => 'text-align: {{VALUE}};',
                '{{WRAPPER}} .trad_turbo_slider_pro_subtitle' => 'text-align: {{VALUE}};',
                '{{WRAPPER}} .trad_turbo_slider_pro_paragraph' => 'text-align: {{VALUE}};',
                '{{WRAPPER}} .trad_turbo_slider_pro_slide-btns' => 'text-align: {{VALUE}};',
            ],
            'label_block' => true,
         ]
        );


    $this->add_responsive_control(
      'hero_slider_inner_width',
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
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_container' => 'width: {{SIZE}}{{UNIT}};',
          ],
      ]
    );

    // Height control
    $this->add_responsive_control(
      'hero_slider_inner_height',
      [
          'label' => __('Height', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::SLIDER,
          'size_units' => ['px', '%', 'em', 'vh'], // Allow multiple units
          'range' => [
              'px' => [
                  'min' => 100,
                  'max' => 1200,
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
              'vh' => [
                  'min' => 10,
                  'max' => 100,
                  'step' => 1,
              ],
          ],
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_container' => 'height: {{SIZE}}{{UNIT}};',
          ],
      ]
    );

    // Padding control
    $this->add_responsive_control(
      'hero_slider_inner_padding',
      [
          'label' => __('Padding', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => ['px', 'em', '%'], // Allow padding in px, em, %
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
      ]
    );

    // Margin control
    $this->add_responsive_control(
      'hero_slider_inner_margin',
      [
          'label' => __('Margin', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => ['px', 'em', '%'], // Allow margin in px, em, %
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
      ]
    );

    // Background color
    $this->add_group_control(
      Group_Control_Background::get_type(),
      [
          'name' => 'hero_slider_inner_background',
          'label' => __('Background', 'turbo-addons-elementor-pro'),
          'types' => ['classic', 'gradient'],
          'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_container',
      ]
    );

    // Border control
    $this->add_group_control(
      Group_Control_Border::get_type(),
      [
          'name' => 'hero_slider_inner_border',
          'label' => __('Border', 'turbo-addons-elementor-pro'),
          'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_container',
      ]
    );

    // Border radius
    $this->add_responsive_control(
      'hero_slider_border_inner_radius',
      [
          'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::SLIDER,
          'size_units' => ['px', '%'], // Allow px and %
          'range' => [
              'px' => [
                  'min' => 0,
                  'max' => 100,
                  'step' => 1,
              ],
              '%' => [
                  'min' => 0,
                  'max' => 50,
                  'step' => 1,
              ],
          ],
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_container' => 'border-radius: {{SIZE}}{{UNIT}};',
          ],
      ]
    );

    // Box shadow
    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      [
          'name' => 'hero_slider_box_inner_shadow',
          'label' => __('Box Shadow', 'turbo-addons-elementor-pro'),
          'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_container',
      ]
    );
    $this->end_controls_section();

    // ----------------------------------------------------------------slider image---------------------
     $this->start_controls_section(
      'slider_inner_style_image',
      [
          'label' => __('Content (Media)', 'turbo-addons-elementor-pro'),
          'tab' => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_responsive_control(
        'show_hero_slider_image',
        [
            'label'        => esc_html__( 'Show Image', 'turbo-addons-elementor-pro' ),
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Hide', 'turbo-addons-elementor-pro' ),
            'label_off'    => esc_html__( 'Show', 'turbo-addons-elementor-pro' ),
            'return_value' => 'yes',
            'default'      => '',
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_swiper-container .trad_turbo_slider_slide_image' => 'display: none;',
            ],
        ]
    );

     $this->add_responsive_control(
      'hero_slider_image_width',
      [
          'label' => __('Width', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::SLIDER,
          'size_units' => ['px', '%', 'em', 'vw'], 
          'range' => [
              'px' => [
                  'min' => 20,
                  'max' => 1920,
                  'step' => 1,
              ],
              '%' => [
                  'min' => 10,
                  'max' => 100,
                  'step' => 1,
              ],
              'em' => [
                  'min' => 1,
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
            'size' => 30, 
            'unit' => '%', 
             ],
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_swiper-container .trad_turbo_slider_slide_image' => 'width: {{SIZE}}{{UNIT}};',
          ],
      ]
    );

    $this->end_controls_section();

    // ------------------------------------------------Typography---------------------------------------

    $this->start_controls_section(
      'slider_title_style',
      [
          'label' => __('Typography', 'turbo-addons-elementor-pro'),
          'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    //---------------------------------------Title--------------
    $this->add_control(
			'slider_title_options',
			[
				'label' => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
          'name'     => 'trad_turbo_slider_title_style_typography', 
          'label'    => esc_html__( 'Title Typography', 'turbo-addons-elementor-pro' ),
          'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_header',
      ]
    );

    // Text Color Control
    $this->add_control(
      'header_text_color',
      [
          'label' => __('Text Color', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::COLOR,
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_header' => 'color: {{VALUE}};',
          ],
      ]
    );

    // Margin Control
    $this->add_responsive_control(
      'header_margin',
      [
          'label' => __('Margin', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => ['px', '%', 'em'],
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
      ]
    );

    //----------------------------------------sub title---------------------
     $this->add_control(
			'slider_subtitle_options',
			[
				'label' => esc_html__( 'Sub-Title', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
	 );
      //---------typography
    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
          'name'     => 'trad_turbo_slider_sub_title_style_typography', // Unique name for the control
          'label'    => esc_html__( 'Title Typography', 'turbo-addons-elementor-pro' ),
          'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_subtitle',
      ]
    );
    
    // Text Color Control
    $this->add_control(
      'header_sub_text_color',
      [
          'label' => __('Text Color', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::COLOR,
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_subtitle' => 'color: {{VALUE}};',
          ],
      ]
    );

    // Margin Control
    $this->add_responsive_control(
      'header_sub_margin',
      [
          'label' => __('Margin', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => ['px', '%', 'em'],
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
      ]
    );

    //----------------------------------------Paragraph---------------------
     $this->add_control(
			'slider_paragraph_options',
			[
				'label' => esc_html__( 'Paragraph', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
	 );
      //---------typography
    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
          'name'     => 'trad_turbo_slider_paragraph', 
          'label'    => esc_html__( 'Paragraph', 'turbo-addons-elementor-pro' ),
          'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_paragraph',
      ]
    );
    

    // Text Color Control
    $this->add_control(
      'trad_turbo_slider_paragraph_color',
      [
          'label' => __('Text Color', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::COLOR,
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_paragraph' => 'color: {{VALUE}};',
          ],
      ]
    );

    // Margin Control
    $this->add_responsive_control(
      'trad_turbo_slider_paragraph_margin',
      [
          'label' => __('Margin', 'turbo-addons-elementor-pro'),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => ['px', '%', 'em'],
          'selectors' => [
              '{{WRAPPER}} .trad_turbo_slider_pro_paragraph' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
      ]
    );
 
    $this->end_controls_section();

    //---------------------------------------------------- Slider Button ------------------------------------------
    $this->start_controls_section(
        'slider_buttons_one_style',
        [
            'label' => __('Button One', 'turbo-addons-elementor-pro'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );
    // ---------------------------------------button width----------------------
    $this->add_responsive_control(
            'slider_button_one_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 400,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-one' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
     );


    //---------typography
    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
          'name'     => 'trad_turbo_hero_slider_btn1', 
          'label'    => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
          'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-one',
      ]
    );

     // Padding
    $this->add_responsive_control(
        'slider_button_one_padding',
        [
            'label' => __('Padding', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    // Border Radius
    $this->add_responsive_control(
        'slider_button_one_border_radius',
        [
            'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->start_controls_tabs( 'trad_slider_main_button_style_tab' );
    //  Controls tab For Normal
    $this->start_controls_tab(
        'trad_slider_main_button_normal_tab',
        [
            'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
        ]
    );

    $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => 'trad_slider_main_button_background',
            'label' => __('Background', 'turbo-addons-elementor-pro'),
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-one',
        ]
    );

    $this->add_control(
        'button_text_color',
        [
            'label' => __( 'Text Color', 'turbo-addons-elementor-pro' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-one' => 'color: {{VALUE}};',
            ],
        ]
    );

    // Border
    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'slider_button_one_border',
            'label' => __('Border', 'turbo-addons-elementor-pro'),
            'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-one',
        ]
    );

    // Box Shadow
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'slider_button_one_box_shadow',
            'label' => __('Box Shadow', 'turbo-addons-elementor-pro'),
            'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-one',
        ]
    );

    $this->end_controls_tab();
    //  Controls tab For Hover
    $this->start_controls_tab(
        'trad_slider_main_button_hover_tab',
        [
            'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'slider_button_one_background_hover',
            'label' => __('Background', 'turbo-addons-elementor-pro'),
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-one:hover',
        ]
    );

    $this->add_control(
        'slider_button_one_text_color_hover',
        [
            'label' => __('Text Color', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-one:hover' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'slider_button_one_border_hover',
            'label' => __('Border', 'turbo-addons-elementor-pro'),
            'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-one:hover',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'slider_button_one_box_shadow_hover',
            'label' => __('Box Shadow', 'turbo-addons-elementor-pro'),
            'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-one:hover',
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();

    /*--------------------------------------------Button Two--------------------- */

    $this->start_controls_section(
        'slider_buttons_two_style',
        [
            'label' => __('Button Two', 'turbo-addons-elementor-pro'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    // ---------------------------------------button width----------------------
    $this->add_responsive_control(
            'slider_button_two_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 400,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-two' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
     );

     $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
          'name'     => 'trad_turbo_hero_slider_btn2', 
          'label'    => esc_html__( 'Typography', 'turbo-addons-elementor-pro' ),
          'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-two',
      ]
    );

    // Padding
    $this->add_responsive_control(
        'slider_button_info_padding',
        [
            'label' => __('Padding', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    // Border Radius
    $this->add_responsive_control(
        'slider_button_info_border_radius',
        [
            'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->start_controls_tabs( 'trad_slider_info_button_style_tab' );
    //  Controls tab For Normal
    $this->start_controls_tab(
        'trad_slider_info_button_normal_tab',
        [
            'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
        ]
    );

    $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => 'trad_slider_info_button_background',
            'label' => __('Background', 'turbo-addons-elementor-pro'),
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-two',
        ]
    );

    $this->add_control(
        'info_button_text_color',
        [
            'label' => __( 'Text Color', 'turbo-addons-elementor-pro' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-two' => 'color: {{VALUE}};',
            ],
        ]
    );

    // Border
    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'slider_button_info_border',
            'label' => __('Border', 'turbo-addons-elementor-pro'),
            'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-two',
        ]
    );

    // Box Shadow
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'slider_button_info_box_shadow',
            'label' => __('Box Shadow', 'turbo-addons-elementor-pro'),
            'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-two',
        ]
    );

    $this->end_controls_tab();
    //  Controls tab For Hover
    $this->start_controls_tab(
        'trad_slider_info_button_hover_tab',
        [
            'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'slider_button_info_background_hover',
            'label' => __('Background', 'turbo-addons-elementor-pro'),
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-two:hover',
        ]
    );

    $this->add_control(
        'slider_button_info_text_color_hover',
        [
            'label' => __('Text Color', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-two:hover' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'slider_button_info_border_hover',
            'label' => __('Border', 'turbo-addons-elementor-pro'),
            'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-two:hover',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'slider_button_info_box_shadow_hover',
            'label' => __('Box Shadow', 'turbo-addons-elementor-pro'),
            'selector' => '{{WRAPPER}} .trad_turbo_slider_pro_slider-button-two:hover',
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();

    //--------------------------------- navigation button---------------------
    $this->start_controls_section(
        'navigation_buttons_style',
        [
            'label' => __('Navigation Buttons', 'turbo-addons-elementor-pro'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'nav_hover_show',
        [
            'label'        => esc_html__( 'Show Navigation on Hover', 'turbo-addons-elementor-pro' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'turbo-addons-elementor-pro' ),
            'label_off'    => esc_html__( 'No', 'turbo-addons-elementor-pro' ),
            'return_value' => 'yes',
            'default'      => 'yes',
            'selectors'    => [
                // When hover mode is active
                '{{WRAPPER}}.nav-hover-yes .swiper-button-prev, 
                {{WRAPPER}}.nav-hover-yes .swiper-button-next' => 'opacity: 0; transition: opacity 0.3s ease;',
                '{{WRAPPER}}.nav-hover-yes:hover .swiper-button-prev, 
                {{WRAPPER}}.nav-hover-yes:hover .swiper-button-next' => 'opacity: 1;',
                // When always visible
                '{{WRAPPER}}.nav-hover-no .swiper-button-prev, 
                {{WRAPPER}}.nav-hover-no .swiper-button-next' => 'opacity: 1; transition: opacity 0.3s ease;',
            ],
            'prefix_class' => 'nav-hover-', // adds .nav-hover-yes / .nav-hover-no to widget wrapper
        ]
    );
  
    // Background color control
    $this->add_control(
        'navigation_buttons_background',
        [
            'label' => __('Background Color', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::COLOR,
            'default' => 'transparent',
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-prev,
                {{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-next' => 'background: {{VALUE}};',
            ],
        ]
    );
    
    // Width control
    $this->add_responsive_control(
            'navigation_buttons_width',
            [
                'label' => __('Width', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 6,
                        'step' => .5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 55,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-prev,
                    {{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name'     => 'hero_slider_navigation_btn_border',
            'label'    => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
            'selector' => 
                '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-prev, 
                {{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-next',
        ]
    );
    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name'     => 'hero_slider_navigation_btn_border',
            'label'    => esc_html__( 'Border', 'turbo-addons-elementor-pro' ),
            'selector' => 
                '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-prev, 
                {{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-next',
        ]
    );

    
    // Border radius control
    $this->add_responsive_control(
            'navigation_buttons_border_radius',
            [
                'label' => __('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 55,
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-prev,
                    {{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-next' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );
    

    $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_turbo_slider_pro_swiper-button-prev.elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}} !important;', 
                    '{{WRAPPER}} .trad_turbo_slider_pro_swiper-button-prev.elementor-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}} !important;', // SVG icons
                    '{{WRAPPER}} .trad_turbo_slider_pro_swiper-button-next.elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}} !important;', 
                    '{{WRAPPER}} .trad_turbo_slider_pro_swiper-button-next.elementor-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}} !important;', // SVG icons
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad_turbo_slider_pro_swiper-button-prev.elementor-icon i' => 'color: {{VALUE}} !important;', 
                    '{{WRAPPER}} .trad_turbo_slider_pro_swiper-button-prev.elementor-icon svg' => 'fill: {{VALUE}} !important;', 
                    '{{WRAPPER}} .trad_turbo_slider_pro_swiper-button-next.elementor-icon i' => 'color: {{VALUE}} !important;', 
                    '{{WRAPPER}} .trad_turbo_slider_pro_swiper-button-next.elementor-icon svg' => 'fill: {{VALUE}} !important;', 
                ],
            ]
        );
        $this->add_control(
			'hero_slider_icon_positions',
			[
				'label' => esc_html__( 'Vertical Position(Y)', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
            'nav_icon_vertical_position',
            [
                'label' => esc_html__( 'Prev + Next Buttons', 'turbo-addons-elementor-pro' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 25,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 95,
                        'step' => 1,
                    ],
                    'vh' => [
                        'min' => -50,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 94,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-prev,
                    {{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-next' => 'top:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //----------------------- hr position of icons---------------
        $this->add_control(
			'hero_slider_icon_x_positions',
			[
				'label' => esc_html__( 'Horizontal Position(x)', 'turbo-addons-elementor-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
            'hero_nav_icon_x_position_prev',
            [
                'label' => esc_html__( 'Previous Button', 'turbo-addons-elementor-pro' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => -1920,
                        'max' => 1920,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'vw' => [
                        'min' => -50,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-prev' => 'left:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hero_nav_icon_x_position_next',
            [
                'label' => esc_html__( 'Next Button', 'turbo-addons-elementor-pro' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => -1920,
                        'max' => 1920,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'vw' => [
                        'min' => -50,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-button-next' => 'right:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

    $this->end_controls_section();



//----------------------pagination bullets
  $this->start_controls_section(
      'pagination_style',
      [
          'label' => __('Pagination Bullet Style', 'turbo-addons-elementor-pro'),
          'tab' => Controls_Manager::TAB_STYLE,
      ]
  );

  $this->start_controls_tabs( 'trad_pagination_bullet_style_tab' );

  $this->start_controls_tab(
      'trad_pagination_bullet_style_normal_tab',
      [
          'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
      ]
  );
  $this->add_control(
        'pagination_bullets_display',
        [
            'label' => __('Display Bullets', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Hide', 'turbo-addons-elementor-pro'), 
            'label_off' => __('Show', 'turbo-addons-elementor-pro'),
            'return_value' => 'none', 
            'default' => '', 
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-pagination-bullet' => 'display: {{VALUE}};', // Dynamically applies value
            ],
        ]
    );


  $this->add_responsive_control(
        'pagination_bullets_width',
        [
            'label' => __('Width', 'turbo-addons-elementor-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 5,
                    'max' => 50,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 12,
            ],
            'selectors' => [
                '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
            'pagination_bullets_display' => '',
            ],
        ]
    );
  $this->add_responsive_control(
    'pagination_bullets_height',
    [
        'label' => __('Height', 'turbo-addons-elementor-pro'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 5,
                'max' => 50,
                'step' => 1,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 12,
        ],
        'selectors' => [
            '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
          'pagination_bullets_display' => '', 
        ],
    ]
  );

  $this->add_control(
    'pagination_bullets_background',
    [
        'label' => __('Background Color', 'turbo-addons-elementor-pro'),
        'type' => Controls_Manager::COLOR,
        'default' => '#ffffff',
        'selectors' => [
            '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-pagination-bullet' => 'background: {{VALUE}};',
        ],
        'condition' => [
          'pagination_bullets_display' => '', 
        ],
    ]
  );
  $this->end_controls_tab();
  //  Controls tab For Hover
  $this->start_controls_tab(
      'trad_pagination_bullet_style_hover_tab',
      [
          'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
          'condition' => [
            'pagination_bullets_display' => '', 
          ],
      ]
  );
  $this->add_control(
    'pagination_bullets_hover_background',
    [
        'label' => __('Background Color', 'turbo-addons-elementor-pro'),
        'type' => Controls_Manager::COLOR,
        'default' => '#ddd',
        'selectors' => [
            '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-pagination-bullet:hover' => 'background: {{VALUE}};',
        ],
    ]
  );
  $this->end_controls_tab();

  //  Controls tab For Active
  $this->start_controls_tab(
      'trad_pagination_bullet_style_active_tab',
      [
          'label' => esc_html__( 'Active', 'turbo-addons-elementor-pro' ),
          'condition' => [
            'pagination_bullets_display' => '', // Show only if bullets are displayed
          ],
      ]
  );
  $this->add_control(
    'pagination_bullets_active_background',
    [
        'label' => __('Background Color', 'turbo-addons-elementor-pro'),
        'type' => Controls_Manager::COLOR,
        'default' => '#2b3b95',
        'selectors' => [
            '{{WRAPPER}} .trad_turbo_slider_pro_hero-slider .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
        ],
    ]
  );
  $this->end_controls_tab();
  $this->end_controls_tabs();
  $this->end_controls_section();
  }

    // Render the widget content
    protected function render() {
      $settings = $this->get_settings_for_display();
      $show_nav = isset( $settings['show_navigation_icons'] ) ? $settings['show_navigation_icons'] : 'yes';

      if (empty($settings['slides'])) {
          return; // Return if no slides are added.
      }
      ?>

      <!-- start of hero -->
      <section class="trad_turbo_slider_pro_hero-slider trad_turbo_slider_pro_hero-style">
          <div class="trad_turbo_slider_pro_swiper-container">
              <div class="swiper-wrapper">
                  <?php foreach ($settings['slides'] as $slide): ?>
                      <div class="swiper-slide">
                            <div class="slide-inner slide-bg-image" style="background-image: url('<?php echo esc_url($slide['slide_background_image']['url']); ?>');">
                             
                                <div class="trad_turbo_slider_pro_container">
                                    <div data-swiper-parallax="300" class="trad_turbo_slider_pro_slide-title">
                                        <h2 class="trad_turbo_slider_pro_header"><?php echo esc_html($slide['slide_title']); ?></h2>
                                    </div>

                                    <div data-swiper-parallax="300" class="trad_turbo_slider_pro_slide-subtitle">
                                        <h3 class="trad_turbo_slider_pro_subtitle"><?php echo esc_html($slide['slide_sub_title']); ?></h3>
                                    </div>

                                    <div data-swiper-parallax="400" class="trad_turbo_slider_pro_slide-text">
                                      <p class="trad_turbo_slider_pro_paragraph"><?php echo esc_html($slide['slide_text']); ?></p>
                                    </div>

                                    <!-- <div class="trad_turbo_slider_pro_clearfix"></div> -->

                                    <div data-swiper-parallax="500" class="trad_turbo_slider_pro_slide-btns">
                                      <?php if (!empty($slide['slide_button_one'])): ?>
                                          <a href="<?php echo esc_url($slide['slide_button_one_url']['url']); ?>" class="trad_turbo_slider_pro_slider-button-one"><?php echo esc_html($slide['slide_button_one']); ?></a>
                                      <?php endif; ?>
                                      <?php if (!empty($slide['slide_button_two'])): ?>
                                          <a href="<?php echo esc_url($slide['slide_button_two_url']['url']); ?>" class="trad_turbo_slider_pro_slider-button-two"></i> <?php echo esc_html($slide['slide_button_two']); ?></a>
                                      <?php endif; ?>
                                    </div>
                                </div>

                                 <div class="trad_turbo_slider_slide_image">
                                        <?php if ( ! empty( $slide['show_slide_shortcode'] ) && 'yes' === $slide['show_slide_shortcode'] && ! empty( $slide['slide_shortcode_content'] ) ) : ?>
                                            <div data-swiper-parallax="600" class="trad_turbo_slider_pro_slide-shortcode">
                                                <?php echo do_shortcode( $slide['slide_shortcode_content'] ); ?>
                                            </div>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $slide['show_slide_image'] ) && 'yes' === $slide['show_slide_image'] && ! empty( $slide['hero_slider_image_content']['url'] ) ) : ?>
                                        <img src="<?php echo esc_url( $slide['hero_slider_image_content']['url'] ); ?>" alt="slider_image">
                                    <?php endif; ?>
                                 </div>
                            </div>
                      </div>
                  <?php endforeach; ?>
              </div>
              <!-- end swiper-wrapper -->

              <!-- swipper controls -->
             <?php if ( 'yes' === $show_nav ) : ?>
              <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev trad_turbo_slider_pro_swiper-button-prev elementor-icon">
                            <?php
                                // Render the icon with proper sanitization
                                Icons_Manager::render_icon( $settings['prev_icon'], [ 'aria-hidden' => 'true' ] );
                            ?>
                    </div>
                    <div class="swiper-button-next trad_turbo_slider_pro_swiper-button-next elementor-icon">
                            <?php
                                // Render the icon with proper sanitization
                                Icons_Manager::render_icon( $settings['next_icon'], [ 'aria-hidden' => 'true' ] );
                            ?>
                    </div>
            </div>
          <?php endif; ?>
      </section>
      <!-- end of hero slider -->
      <script>
            var swiperOptions = {
                loop: true,
                speed: 1000, // Control the speed of the overlap
                autoplay: {
                    delay: 5000, // Time between slides
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                on: {
                    setTransition: function (speed) {
                        var swiper = this;
                        for (var i = 0; i < swiper.slides.length; i++) {
                            var slide = swiper.slides[i];
                            slide.style.transition = speed + 'ms';
                        }
                    },
                    slideChangeTransitionStart: function () {
                        var swiper = this;
                        swiper.slides.forEach((slide, index) => {
                            if (index === swiper.activeIndex) {
                                slide.style.zIndex = 2; // Ensure the active slide is on top
                                slide.querySelector('.slide-inner').style.transform =
                                    'translateX(0)';
                            } else {
                                slide.style.zIndex = 1; // Keep the other slides below
                            }
                        });
                    },
                    slideChangeTransitionEnd: function () {
                        var swiper = this;
                        swiper.slides.forEach((slide, index) => {
                            if (index !== swiper.activeIndex) {
                                slide.style.transition = 'none';
                                slide.querySelector('.slide-inner').style.transform =
                                    'translateX(100%)'; // Reset the slide for the next transition
                            }
                        });
                    },
                },
            };

            jQuery(document).ready(function ($) {
                var swiper = new Swiper('.trad_turbo_slider_pro_swiper-container', swiperOptions);
            });

            jQuery(document).ready(function ($) {
                $('.slide-bg-image').each(function () {
                    var bg = $(this).data('background');
                    if (bg) {
                        $(this).css('background-image', 'url(' + bg + ')');
                    }
                });
            });
      </script>
      <?php
  }
    
}

// Register the widget
Plugin::instance()->widgets_manager->register_widget_type(new TRAD_Turbo_Slider_Pro());
