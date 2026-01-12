<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background; 
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Plugin;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Trad_Icon_List extends Widget_Base {
    public function get_name() {
        return 'trad-icon-list';
    }

    public function get_title() {
        return esc_html__('Icon List', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-checkbox trad-icon'; // Choose an appropriate icon
    }

    public function get_categories() {
        return ['turbo-addons-pro']; // Change to your desired category
    }

    protected function get_upsale_data() {
		return [
			'condition' => ! Utils::has_pro(),
			'image' => esc_url( ELEMENTOR_ASSETS_URL . 'images/go-pro.svg' ),
			'image_alt' => esc_attr__( 'Upgrade', 'turbo-addons-elementor-pro' ),
			'title' => esc_html__( "Hey Grab your visitors' attention", 'turbo-addons-elementor-pro' ),
			'description' => esc_html__( 'Get the widget and grow website with Turbo Addons Elementor Pro.', 'turbo-addons-elementor-pro' ),
			'upgrade_url' => esc_url( 'https://turbo-addons.com/pricing/' ),
			'upgrade_text' => esc_html__( 'Upgrade Now', 'turbo-addons-elementor-pro' ),
		];
	}

    protected function _register_controls() {
        $this->start_controls_section(
            'list_section',
            [
                'label' => __( 'Icon List', 'turbo-addons-elementor-pro' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'turbo-addons-elementor-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'List Item', 'turbo-addons-elementor-pro' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'turbo-addons-elementor-pro' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __( 'URL', 'turbo-addons-elementor-pro' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'turbo-addons-elementor-pro' ),
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'list_items',
            [
                'label' => __( 'List Items', 'turbo-addons-elementor-pro' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'default' => [
                    [
                        'title' => 'Icon List One', // Default title for the first item
                        'trad_icon_list_type' => 'icon', 
                       
                    ],
                    [
                        'title' => 'Icon List Two', // Default title for the second item
                        'trad_icon_list_type' => 'icon', 
                        
                    ],
                    [
                        'title' => 'Icon List Three', // Default title for the third item
                        'trad_icon_list_type' => 'icon', 
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab
         * ------------------------------ List Style ------------------------------
         *
         */
        $this->start_controls_section(
            'style_section', [
                'label' => esc_html__( 'List Alignment', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // list direction - flex direction
        $this->add_responsive_control(
            'flex_direction',
            [
                'label' => esc_html__('Direction', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'column',
                'options' => [
                    'row' => [
                        'title' => esc_html__('Row', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'column' => [
                        'title' => esc_html__('Column', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-arrow-down',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-content' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );


        // Justify Content (Row)
         $this->add_responsive_control(
            'trad_icon_list_justify_content',
            [
                'label' => esc_html__('Alignment', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-justify-center-h',
                    ],
                    'space-around'=>[
                        'title' => esc_html__('Space Around', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-justify-space-around-h',
                    ],
                    'space-between'=>[
                        'title' => esc_html__('Space Between', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-justify-end-h',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-content li' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'flex_direction' => 'row',
                ],
            ]
        );

        // Gap Control
        $this->add_control(
            'list_gap',
            [
                'label'   => __( 'Gap Between Items', 'turbo-addons-elementor-pro' ),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 5,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-content' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * Style Tab
         * ------------------------------ List Items ------------------------------
         * class --- .trad-icon-list-content li
         */
        $this->start_controls_section(
            'trad_list_item_style_section', [
                'label' => esc_html__( 'List Item', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //padding
        $this->add_responsive_control(
            'trad_list_item_padding',
            [
                'label' => esc_html__('Padding', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-content li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                // default//
                'default' => [
                    'top' => '10',
                    'bottom' => '10',
                    'left' => '10',
                    'right' => '10',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );
        //border radious 
        $this->add_responsive_control(
            'trad_list_item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-container .trad-icon-list-content li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                
            ]
        );
        // item gap
        $this->add_responsive_control(
            'trad_list_item_gap',
            [
                'label' => esc_html__('Gap Between Items', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-content li .trad-icon-list-title' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_list_item_typography',
                'label'    => __('Typography', 'turbo-addons-elementor-pro'),
                'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-container .trad-icon-list-content .trad-icon-list-title',
                ]
            ]
        );
        $this->start_controls_tabs( 'trad_icon_list_item_style_tab' );
        //  Controls tab For Normal
        $this->start_controls_tab(
            'trad_icon_list_item_style_normal',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        );

         // text heading
        $this->add_control(
            'trad_icon_list_title_heading',
            [
                'label' => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'trad_icon_list_title_color',
            [
                'label' => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        // list item wrapper
        $this->add_control(
            'trad_icon_list_item_heading',
            [
                'label' => esc_html__('List Box', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
          // Background Control for Title
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'trad_list_title_background',
                'label'    => __( 'Background', 'turbo-addons-elementor-pro' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .trad-icon-list-content li',
            ]
        );

         // Border Control for Title
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_list_title_border',
                'label'    => __( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-icon-list-content li',
            ]
        );

        // Box Shadow Control for Title
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_list_title_box_shadow',
                'label'    => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-icon-list-content li',
            ]
        );

        $this->end_controls_tab();

        //  Controls tab For-------------------------------- Hover tab----------------------
        $this->start_controls_tab(
            'trad_icon_list_item_style_hover',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        ); 
          // text heading
        $this->add_control(
            'trad_icon_list_title_heading_hover',
            [
                'label' => esc_html__('Text Color', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'trad_icon_list_title_color_hover',
            [
                'label' => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                 'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-content li:hover .trad-icon-list-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        // list item wrapper
        $this->add_control(
            'trad_icon_list_item_heading_hover',
            [
                'label' => esc_html__('List Box', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
          // Background Control for Title
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'trad_list_title_background_hover',
                'label'    => __( 'Background', 'turbo-addons-elementor-pro' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .trad-icon-list-content li:hover',
            ]
        );

         // Border Control for Title
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_list_title_border_hover',
                'label'    => __( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-icon-list-content li:hover',
            ]
        );

        // Box Shadow Control for Title
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'trad_list_title_box_shadow_hover',
                'label'    => __( 'Box Shadow', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-icon-list-content li:hover',
            ]
        );
        

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();



        /**
         * Style Tab
         * ------------------------------icon------------------------------
         *
         */
        $this->start_controls_section(
            'trad_list_item_style_icon_section', [
                'label' => esc_html__( 'Icon ', 'turbo-addons-elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

         // icon alignment
        $this->add_control(
            'icon_alignment',
            [
                'label' => esc_html__('Icon Alignment', 'turbo-addons-elementor-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Top', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'end' => [
                        'title' => esc_html__('Bottom', 'turbo-addons-elementor-pro'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-container .trad-icon-list-content li' => 'align-items: {{VALUE}};',
                ],
            ]
        );

          $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 18, // Default size in px
                    'unit' => 'px', // Default unit
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}};', // Font Awesome or other font-based icons
                    '{{WRAPPER}} .elementor-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};', // SVG icons
                ],
            ]
        );
           $this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__('Icon Padding', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-style-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border radius control
        $this->add_responsive_control(
            'trad_icon_list_style_icon_border_radius',
            [
                'label'      => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .trad-icon-list-style-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs( 'trad_icon_list_style_tab' );

        // -------------------------------------------------- Controls tab For------------------ Normal
        $this->start_controls_tab(
            'trad_icon_list_style_normal',
            [
                'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ),
            ]
        ); 
        // Background color control
        $this->add_control(
            'trad_icon_list_style_icon_bg_color',
            [
                'label'     => __( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-style-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon i' => 'color: {{VALUE}};', // Font Awesome or other font-based icons
                    '{{WRAPPER}} .elementor-icon svg' => 'fill: {{VALUE}};', // SVG icons
                ],
            ]
        );

        // Border control
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_icon_list_style_icon_border',
                'label'    => __( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-icon-list-style-icon',
            ]
        );
        $this->end_controls_tab();
        //  -------------------------------Controls tab For--------------------------- Hover
        $this->start_controls_tab(
            'trad_icon_list_style_hover',
            [
                'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ),
            ]
        ); 

        // Background color control
        $this->add_control(
            'trad_icon_list_style_icon_bg_color_hover',
            [
                'label'     => __( 'Background Color', 'turbo-addons-elementor-pro' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-content li:hover  .trad-icon-list-style-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );
       
        $this->add_control(
            'icon_color_hover',
            [
                'label' => esc_html__('Icon Color', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trad-icon-list-content li:hover .elementor-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trad-icon-list-content li:hover .elementor-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // Border control
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'trad_icon_list_style_icon_border_hover',
                'label'    => __( 'Border', 'turbo-addons-elementor-pro' ),
                'selector' => '{{WRAPPER}} .trad-icon-list-content li:hover .trad-icon-list-style-icon',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }



    protected function render() {
        $settings = $this->get_settings_for_display();
    
        if ( !empty( $settings['list_items'] ) ) {
            ?>
            <div class="trad-icon-list-container">
                <ul class="trad-icon-list-content">
                <?php foreach ( $settings['list_items'] as $item ) : ?>
                    <li>

                        <!-- ICON LINK -->
                        <?php if ( !empty( $item['link']['url'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['link']['url'] ); ?>" 
                            target="<?php echo $item['link']['is_external'] ? '_blank' : '_self'; ?>"
                            rel="<?php echo $item['link']['nofollow'] ? 'nofollow' : 'noopener'; ?>">
                        <?php endif; ?>

                            <span class="trad-icon-list-style trad-icon-list-style-icon elementor-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>

                        <?php if ( !empty( $item['link']['url'] ) ) : ?>
                            </a>
                        <?php endif; ?>


                        <!-- TEXT LINK -->
                        <?php if ( !empty( $item['link']['url'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['link']['url'] ); ?>" 
                            target="<?php echo $item['link']['is_external'] ? '_blank' : '_self'; ?>"
                            rel="<?php echo $item['link']['nofollow'] ? 'nofollow' : 'noopener'; ?>">
                        <?php endif; ?>

                            <span class="trad-icon-list-title">
                                <?php echo esc_html( $item['title'] ); ?>
                            </span>

                        <?php if ( !empty( $item['link']['url'] ) ) : ?>
                            </a>
                        <?php endif; ?>

                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php
        }
    }
    
}
// Register the widget with Elementor.
Plugin::instance()->widgets_manager->register_widget_type( new Trad_Icon_List() );