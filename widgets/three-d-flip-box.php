<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
class TURBO_three_d_Flip_Box extends Widget_Base {

    public function get_name() {
        return 'three-d-flip-box';
    }

    public function get_title() {
        return esc_html__('3D Flip Box', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-flip-box trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    protected function _register_controls() {
        //------------------------------------------------------------------------------------------
        //===================================== Content Tab    =====================================
        //------------------------------------------------------------------------------------------


        // ============================ FRONT SIDE CONTENT ============================
        $this->start_controls_section(
            'trad_flip_box_content_section_front',
            [
                'label' => esc_html__( 'Front Side', 'turbo-addons-elementor-pro' ),
            ]
        );

        // FRONT: Icon or Image Switcher
        $this->add_control(
            'front_media_type',
            [
                'label' => esc_html__( 'Media Type', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'icon'  => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
                    'image' => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
                ],
                'default' => 'icon',
            ]
        );

        // FRONT: ICON
        $this->add_control(
            'front_icon',
            [
                'label' => esc_html__( 'Select Icon', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::ICONS,
                'default' => [
                    'value'    => 'eicon-star',
                    'library'  => 'solid',
                ],
                'condition' => [
                    'front_media_type' => 'icon',
                ],
            ]
        );

        // FRONT: IMAGE
        $this->add_control(
            'front_image',
            [
                'label' => esc_html__( 'Select Image', 'turbo-addons-elementor-pro' ),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'front_media_type' => 'image',
                ],
            ]
        );

        // FRONT: Title
        $this->add_control(
            'front_title',
            [
                'label' => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '3D Flipbox for Elementor', 'turbo-addons-elementor-pro' ),
                'label_block' => true,
            ]
        );

        // FRONT: Description
        $this->add_control(
            'front_description',
            [
                'label' => esc_html__( 'Description', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Make your website more eye catching using 3d flipbox.', 'turbo-addons-elementor-pro' ),
                'rows' => 4,
            ]
        );

        $this->end_controls_section();


        // ============================ BACK SIDE CONTENT ============================
        $this->start_controls_section(
            'trad_flip_box_content_section_back',
            [
                'label' => esc_html__( 'Back Side', 'turbo-addons-elementor-pro' ),
            ]
        );

        // BACK: Title
        $this->add_control(
            'back_title',
            [
                'label' => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Do the Action', 'turbo-addons-elementor-pro' ),
                'label_block' => true,
            ]
        );

        // BACK: Description
        $this->add_control(
            'back_description',
            [
                'label' => esc_html__( 'Description', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Make your action more user friendly.', 'turbo-addons-elementor-pro' ),
                'rows' => 4,
            ]
        );
        // BACK: Button Text
        $this->add_control(
            'back_button_text',
            [
                'label' => esc_html__( 'Button Text', 'turbo-addons-elementor-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Click For Action', 'turbo-addons-elementor-pro' ),
                'label_block' => true,
            ]
        );

        // BACK: Button Text
        $this->add_control(
            'back_button_link',
            [
                'label' => esc_html__( 'Button Link', 'turbo-addons-elementor-pro' ),
                'type'  => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'turbo-addons-elementor-pro' ),
                'show_external' => true, // this enables new tab + nofollow checkbox
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );
        $this->end_controls_section();
        // ----------------------------------------------------------------------------------------
        // ----------------------------------------settings----------------------------------------
        // ----------------------------------------------------------------------------------------
        $this->start_controls_section(
            'flip_box_settings_section',
            [
                'label' => esc_html__('Settings', 'turbo-addons-elementor-pro'),
            ]
        );
        // HEIGHT
        $this->add_responsive_control(
            'flip_box_height',
            [
                'label' => esc_html__('Height', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-flip-box-front' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .trad-flip-box-back'  => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // BORDER RADIUS
        $this->add_responsive_control(
            'flip_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-flip-box-front' => 'border-radius: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .trad-flip-box-back'  => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // FLIP DIRECTION
        $this->add_control(
            'flip_box_direction',
            [
                'label' => esc_html__('Flip Direction', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-arrow-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'top' => [
                        'title' => esc_html__('Top', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-arrow-up',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-arrow-down',
                    ],
                ],
                'default' => 'right',
            ]
        );

        // 3D DEPTH
        $this->add_control(
            'flip_box_3d_depth',
            [
                'label' => esc_html__('3D Depth', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'turbo-addons-elementor-pro'),
                'label_off' => esc_html__('Off', 'turbo-addons-elementor-pro'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $this->add_responsive_control(
            'flip_box_depth_amount',
            [
                'label' => esc_html__( '3D Depth Value', 'turbo-addons-elementor-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 2,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 60, // your current default depth
                    'unit' => 'px',
                ],
                'condition' => [
                    'flip_box_3d_depth' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-has-depth .trad-flip-inner' => 'transform: translateZ({{SIZE}}{{UNIT}}); -webkit-transform: translateZ({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section();
        //------------------------------------------------------------------------------------------
        //===================================== style sections =====================================
        //------------------------------------------------------------------------------------------

        //------------------------------------Font---------------------------------------------------
        $this->start_controls_section(
            'flip_box_style_section_front',
            [
                'label' => esc_html__('Front Side', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
            );
        // FRONT SIDE – Background Group Control
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'     => 'flip_box_front_bg',
                    'label'    => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
                    'types'    => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .trad-flip-box-front',
                ]
            );
            // hr lin/?/
            $this->add_control(
                'flip_box_front_hr',
                [
                    'type' => \Elementor\Controls_Manager::DIVIDER,
                ]
            );
            // padding
            $this->add_responsive_control(
                'flip_box_front_padding',
                [
                    'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .trad-flip-box-front' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            //alignment
            $this->add_responsive_control(
                'flip_box_front_alignment',
                [
                    'label' => esc_html__('Alignment', 'turbo-addons-elementor-pro'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .trad-flip-box-front .trad-flip-inner' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .flip-box-media' => 'justify-content: {{VALUE}};',
                    ],
                    'default' => 'center',
                ]
            );
        // vertical alignment - align items//
            $this->add_responsive_control(
                'flip_box_front_vertical_alignment',
                [
                    'label' => esc_html__('Vertical Alignment', 'turbo-addons-elementor-pro'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [
                            'title' => esc_html__('Top', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-align-start-v',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-align-center-v',
                        ],
                        'flex-end' => [
                            'title' => esc_html__('Bottom', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-align-end-v',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .trad-flip-box-front' => 'align-items: {{VALUE}};',
                    ],
                    'default' => 'center',
                ]
            );
       // -------------hr//
        $this->add_control(
            'flip_box_front_hr_border',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        // border//
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'flip_box_front_border',
                'selector' => '{{WRAPPER}} .trad-flip-box-front',
            ]
        );
        //--------------------------------------------------image----------------------------------
        //heading image
        $this->add_control(
            'flip_box_front_image_heading',
            [
                'label' => esc_html__('Image', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'front_media_type' => 'image',
                ],
            ]
        );
        //heading icon
        $this->add_control(
            'flip_box_front_icon_heading',
            [
                'label' => esc_html__('Icon', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                //condition
                'condition' => [
                    'front_media_type' => 'icon',
                ],
            ]
        );
        // image/icon gap-----------
        $this->add_responsive_control(
            'flip_box_front_image_gap',
            [
                'label' => esc_html__('Gap', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .flip-box-media' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // image/icon size
        $this->add_responsive_control(
            'flip_box_front_image_size',
            [
                'label' => esc_html__('Size', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .flip-box-media img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .flip-box-media i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .flip-box-media svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

         //border image
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'flip_box_front_image_border',
                'selector' => '{{WRAPPER}} .flip-box-media img',
                'condition' => [
                    'front_media_type' => 'image',
                ],
            ]
        );
        // border radious image//
        $this->add_control(
            'flip_box_front_image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .flip-box-media img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'front_media_type' => 'image',
                ],
            ]
        );
        //-----------------------------------------icon------------------------
        //icon color
        $this->add_control(
            'flip_box_front_icon_color',
            [
                'label' => esc_html__('Icon Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flip-box-media i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .flip-box-media svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'front_media_type' => 'icon',
                ],
            ]
        );
        //icon background color
        $this->add_control(
            'flip_box_front_icon_background_color',
            [
                'label' => esc_html__('Icon Background', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flip-box-media' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'front_media_type' => 'icon',
                ],
            ]
        );
       
        //icon padding
        $this->add_responsive_control(
            'flip_box_front_icon_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .flip-box-media' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    // '{{WRAPPER}} .flip-box-media svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'front_media_type' => 'icon',
                ],
            ]
        );
        // Icon Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'flip_box_front_icon_border',
                'selector' => '{{WRAPPER}} .flip-box-media',
                'condition' => [
                    'front_media_type' => 'icon',
                ],
            ]
        );
        // border radius icon
        $this->add_control(
            'flip_box_front_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .flip-box-media'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'front_media_type' => 'icon',
                ],
            ]
        );
        //--------title---------------
        $this->add_control(
            'flip_box_front_title_heading',
            [
                'label' => esc_html__('Title', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        // typography//
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'flip_box_front_title_typography',
                'selector' => '{{WRAPPER}} .trad-flip-box-front .trad-flip-inner .trad-flip-box-header',
            ]
        );
        // color
        $this->add_control(
            'flip_box_front_title_color',
            [
                'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-flip-box-front .trad-flip-inner .trad-flip-box-header' => 'color: {{VALUE}};',
                ],
            ]
        );
         //--------description---------------
        $this->add_control(
            'flip_box_front_description',
            [
                'label' => esc_html__('Description', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        // typography//
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'flip_box_front_description_typography',
                'selector' => '{{WRAPPER}} .trad-flip-box-front .trad-flip-inner .trad-flip-box-desc',
            ]
        );
        // color
        $this->add_control(
            'flip_box_front_description_color',
            [
                'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-flip-box-front .trad-flip-inner .trad-flip-box-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        //------------------------------------Back---------------------------------------------------
        $this->start_controls_section(
            'flip_box_style_section_Back',
            [
                'label' => esc_html__('Back Side', 'turbo-addons-elementor-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // FRONT SIDE – Background Group Control
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'     => 'flip_box_back_bg',
                    'label'    => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
                    'types'    => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .trad-flip-box-back',
                ]
            );
        //hr lin/?/
        $this->add_control(
            'flip_box_back_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        // padding
            $this->add_responsive_control(
                'flip_box_back_padding',
                [
                    'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .trad-flip-box-back' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        //alignment
        $this->add_responsive_control(
         'flip_box_back_alignment',
            [
                'label' => esc_html__('Alignment', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                'left' => [
                        'title' => esc_html__('Left', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-text-align-left',
                        ],
                'center' => [
                            'title' => esc_html__('Center', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-text-align-center',
                        ],
                'right' => [
                            'title' => esc_html__('Right', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                'selectors' => [
                        '{{WRAPPER}} .trad-flip-box-back .trad-flip-inner' => 'text-align: {{VALUE}};',
                    ],
                'default' => 'center',
                ]
            );
            // vertical alignment - align items//
            $this->add_responsive_control(
                'flip_box_back_vertical_alignment',
                [
                    'label' => esc_html__('Vertical Alignment', 'turbo-addons-elementor-pro'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [
                            'title' => esc_html__('Top', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-align-start-v',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-align-center-v',
                        ],
                        'flex-end' => [
                            'title' => esc_html__('Bottom', 'turbo-addons-elementor-pro'),
                            'icon' => 'eicon-align-end-v',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .trad-flip-box-back' => 'align-items: {{VALUE}};',
                    ],
                    'default' => 'center',
                ]
            );
        // -------------hr//
        $this->add_control(
            'flip_box_back_hr_border',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        // border//
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'flip_box_back_border',
                'selector' => '{{WRAPPER}} .trad-flip-box-back',
            ]
        );

        //--------title---------------
        $this->add_control(
            'flip_box_back_title_heading',
            [
                'label' => esc_html__('Title', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        // typography//
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'flip_box_back_title_typography',
                'selector' => '{{WRAPPER}} .trad-flip-box-back .trad-flip-inner .trad-flip-box-header',
            ]
        );
        // color
        $this->add_control(
            'flip_box_back_title_color',
            [
                'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-flip-box-back .trad-flip-inner .trad-flip-box-header' => 'color: {{VALUE}};',
                ],
            ]
        );
        //--------description---------------
        $this->add_control(
            'flip_box_back_description',
            [
                'label' => esc_html__('Description', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        //description margin
        $this->add_responsive_control(
            'flip_box_back_description_margin',
            [
                'label' => esc_html__('Margin', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-flip-box-back .trad-flip-inner .trad-flip-box-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        // typography//
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'flip_box_back_description_typography',
                'selector' => '{{WRAPPER}} .trad-flip-box-back .trad-flip-inner .trad-flip-box-desc',
            ]
        );
        // color
        $this->add_control(
            'flip_box_back_description_color',
            [
                'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-flip-box-back .trad-flip-inner .trad-flip-box-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        //button style
        $this->add_control(
            'flip_box_back_button_heading',
            [
                'label' => esc_html__('Button', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        // button typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'flip_box_back_button_typography',
                'selector' => '{{WRAPPER}} .trad-flip-box-back .trad-flip-inner .trad-flip-box-button',
            ]
        );
        // button color
        $this->add_control(
            'flip_box_back_button_color',
            [
                'label' => esc_html__('Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-flip-box-back .trad-flip-inner .trad-flip-box-button' => 'color: {{VALUE}};',
                ],
            ]
        );
        // button background color
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'flip_box_back_button_bg',
                'label' => esc_html__('Background', 'turbo-addons-elementor-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .trad-flip-box-back .trad-flip-inner .trad-flip-box-button',
            ]
        );
        // button border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'flip_box_back_button_border',
                'selector' => '{{WRAPPER}} .trad-flip-box-back .trad-flip-inner .trad-flip-box-button',
            ]
        );
        // button border radius
        $this->add_control(
            'flip_box_back_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-flip-box-back .trad-flip-inner .trad-flip-box-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // button padding
        $this->add_responsive_control(
            'flip_box_back_button_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-flip-box-back .trad-flip-inner .trad-flip-box-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //box shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'flip_box_back_button_shadow',
                'selector' => '{{WRAPPER}} .trad-flip-box-back .trad-flip-inner .trad-flip-box-button',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
            $settings = $this->get_settings_for_display();
            // --------------------FRONT SIDE MEDIA (icon or image)--------
            $front_media_html = '';
            if ( $settings['front_media_type'] === 'icon' && !empty($settings['front_icon']['value']) ) {
                ob_start(); // capture icon output
                \Elementor\Icons_Manager::render_icon( 
                    $settings['front_icon'], 
                    [ 'aria-hidden' => 'true' ] 
                );
                $icon_html = ob_get_clean();

                $front_media_html = '<span class="flip-box-icon">' . $icon_html . '</span>';
            }

            elseif ( $settings['front_media_type'] === 'image' && !empty($settings['front_image']['url']) ) {
                $front_media_html = '<img src="' . esc_url($settings['front_image']['url']) . '" alt="" class="flip-box-img">';
            }

            //------------------backside button---------//
            $button_text = !empty($settings['back_button_text']) ? $settings['back_button_text'] : '';
            $link = $settings['back_button_link'];
            $target = $link['is_external'] ? ' target="_blank"' : '';
            $nofollow = $link['nofollow'] ? ' rel="nofollow"' : '';
            $url = !empty($link['url']) ? esc_url($link['url']) : '#';

            //------------animation style------------
            $direction = $settings['flip_box_direction'];
            $depth     = $settings['flip_box_3d_depth'] === 'yes' ? 'trad-has-depth' : 'trad-no-depth';
            $flip_classes = 'trad-flip-' . $direction . ' ' . $depth;

            ?>
            <div class="trad-3d-flip-box-container">
                <div class="trad-3d-flip-box-item">
                    <div class="trad_3dflip-box <?php echo esc_attr($flip_classes); ?>">

                        <!-- ================= FRONT SIDE ================= -->
                        <div class="trad-flip-box-front">
                            <div class="trad-flip-inner">
                                
                                <?php if ( $front_media_html ) : ?>
                                    <div class="flip-box-media"><?php echo $front_media_html; ?></div>
                                <?php endif; ?>

                                <?php if ( !empty($settings['front_title']) ) : ?>
                                    <h3 class="trad-flip-box-header"><?php echo esc_html($settings['front_title']); ?></h3>
                                <?php endif; ?>

                                <?php if ( !empty($settings['front_description']) ) : ?>
                                    <p class="trad-flip-box-desc"><?php echo esc_html($settings['front_description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- ================= BACK SIDE ================= -->

                        <div class="trad-flip-box-back">
                            <div class="trad-flip-inner">
                                <?php if ( !empty($settings['back_title']) ) : ?>
                                    <h3 class="trad-flip-box-header"><?php echo esc_html($settings['back_title']); ?></h3>
                                <?php endif; ?>

                                <?php if ( !empty($settings['back_description']) ) : ?>
                                    <p class="trad-flip-box-desc"><?php echo esc_html($settings['back_description']); ?></p>
                                <?php endif; ?>

                                <?php if ( $button_text ) : ?>
                                    <a href="<?php echo $url; ?>" class="trad-flip-box-button"<?php echo $target . $nofollow; ?>>
                                        <?php echo esc_html($button_text); ?>
                                    </a>
                                <?php endif; ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php
        }
}

// Register the widget with Elementor.
Plugin::instance()->widgets_manager->register_widget_type(new TURBO_three_d_Flip_Box());
