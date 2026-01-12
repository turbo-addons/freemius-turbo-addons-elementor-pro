<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_WOO_Product_Meta extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_meta';
    }

    public function get_title() {
        return __('WOO Product Meta', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-product-meta trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-woo-pro'];
    }

    protected function register_controls() {

        $this->trad_init_content_wc_notice_controls();
        if ( !class_exists( 'woocommerce' ) ) {
            return;
        }

		/**
        * Content Section
        */

		 $this->start_controls_section(
			'section_product_meta_captions',
			[
				'label' => __( 'Mate Label', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
			$this->add_control(
				'meta_fields_list',
				[
					'label' => esc_html__('Select Meta Fields', 'turbo-addons-elementor-pro'),
					'type' => Controls_Manager::REPEATER,
					'fields' => [
						[
							'name' => 'meta_type',
							'label' => esc_html__('Meta Type', 'turbo-addons-elementor-pro'),
							'type' => Controls_Manager::SELECT,
							'options' => [
								'sku'      => __('SKU', 'turbo-addons-elementor-pro'),
								'category' => __('Category', 'turbo-addons-elementor-pro'),
								'tag'      => __('Tag', 'turbo-addons-elementor-pro'),
								'brand'    => __('Brand', 'turbo-addons-elementor-pro'),
							],
							'default' => 'category',
						],
						[
							'name' => 'custom_label',
							'label' => esc_html__('Custom Label (optional)', 'turbo-addons-elementor-pro'),
							'type' => Controls_Manager::TEXT,
							'default' => '',
							'placeholder' => __('Leave blank to use default', 'turbo-addons-elementor-pro'),
						],
					],
					'title_field' => '{{ meta_type }}',
				]
			);


		$this->add_control(
			'trad_woo_product_meta_separator_label',
			[
				'label' => __( 'Separator', 'turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' 	  => __( ', ', 'turbo-addons-elementor-pro' ),
				'placeholder' => __( 'Separator', 'turbo-addons-elementor-pro' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

        /**
         * Content Section
         */
        $this->start_controls_section(
            'trad_woo_product_meta_content_section',
            [
                'label' => esc_html__( 'Before Meta Text', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'trad_woo_product_meta_before',
			[
				'label'       => esc_html__( 'Before Text', 'turbo-addons-elementor-pro' ),
				'type'        => Controls_Manager::TEXTAREA
			]
        );

		

        $this->end_controls_section();

        /**
		 * Style Section
		 */

		/*
		* container Styling Section
		*/
        $this->start_controls_section(
            'trad_woo_product_meta_box_style_section',
            [
                'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_responsive_control(
            'trad_woo_product_meta_box_alignment',
            [
                'label'         => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'left',
                'toggle'        => false,
                'options'       => [
                    'left' => [
                        'title'  => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-h-align-left'
                    ],
                    'center'     => [
                        'title'  => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-h-align-center'
                    ],
                    'right'   => [
                        'title'  => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-h-align-right'
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .trad-woo-product-meta-box' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_meta_box_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-product-meta-box'
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_meta_box_padding',
			[
				'label'         => __( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'default'       => [
					'top'       => '0',
					'right'     => '0',
					'bottom'    => '0',
					'left'      => '0',
					'unit'      => 'px',
                    'isLinked'  => false
				],
				'selectors'     => [
					'{{WRAPPER}} .trad-woo-product-meta-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_meta_box_margin',
			[
				'label'        => __( 'Margin', 'turbo-addons-elementor-pro' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .trad-woo-product-meta-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'trad_woo_product_meta_box_radius',
			[
				'label'      => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-meta-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'trad_woo_product_meta_box_border',
				'selector' => '{{WRAPPER}} .trad-woo-product-meta-box'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_meta_box_shadow',
				'selector' => '{{WRAPPER}} .trad-woo-product-meta-box'
			]
		);

        $this->end_controls_section();

        /**
		* Style Tab Meta Style
		*/
		$this->start_controls_section(
            'trad_woo_product_meta_data_style',
            [
                'label' => esc_html__( 'Meta Style', 'turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
			'trad_woo_product_meta_label_heading_style',
			[
				'label' 	=> __( 'Meta Label', 'turbo-addons-elementor-pro' ),
				'type'  	=> Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'trad_woo_product_meta_link_as_box',
			[
				'label'         => esc_html__( 'Box View', 'turbo-addons-elementor-pro' ),
				'type'          => Controls_Manager::SWITCHER,
                'description'   => __( 'Show Link as Box', 'turbo-addons-elementor-pro' ),
                'label_on'      => __( 'Yes', 'turbo-addons-elementor-pro' ),
				'label_off'     => __( 'No', 'turbo-addons-elementor-pro' ),
                'return_value'  => 'yes',
				'default'       => 'no',
			]
		);
		
		$this->add_control(
            'etrad_woo_product_meta_label_bg_color',
            [
                'label'     => esc_html__('Background Color', 'turbo-addons-elementor-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'trad_woo_product_meta_link_as_box' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-container-box .detail-label' => 'background: {{VALUE}};'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 	   => 'trad_woo__meta_label_text_typography',
				'selector' => '{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-container-box .detail-label',
			]
		);

		$this->add_control(
			'trad_woo_product_meta_text_color',
			[
				'label' 	=> __( 'Color', 'turbo-addons-elementor-pro' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-container-box .detail-label' => 'color: {{VALUE}}',
				],
			]
		);

		
        $this->add_responsive_control(
			'trad_woo_product_meta_label_padding',
			[
				'label'         => __( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'default'       => [
					'top'       => '0',
					'right'     => '0',
					'bottom'    => '0',
					'left'      => '0',
					'unit'      => 'px',
                    'isLinked'  => false
				],
				'selectors'     => [
					'{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-container-box .detail-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_meta_label_radius',
			[
				'label'      => __( 'Border Radius', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-container-box .detail-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'trad_woo_product_meta_label_border',
				'selector'  => '{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-container-box .detail-label',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'trad_woo_product_meta_label_box_shadow',
				'selector'  => '{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-container-box .detail-label',
			]
		);

		$this->add_control(
			'trad_woo_product_meta_link_heading_style',
			[
				'label' 	=> __( 'Meta Value', 'turbo-addons-elementor-pro' ),
				'type'  	=> Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_meta_link_space_between',
			[
				'label' => __( 'Space Between', 'turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 25,
					],
				],
				'default' 		=> [
					'unit' 		=> 'px',
					'size' 		=> 8,
				],
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-container-box .detail-content a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-container-box .sku:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'trad_woo_product_meta_link_typography',
				'selector' 	=> '{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-container-box a',
			]
		);

		$this->add_control(
			'trad_woo_product_meta_link_color',
			[
				'label' => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type' 	=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-container-box a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

        /*
		* Before meta Styling Section
		*/
		$this->start_controls_section(
            'trad_woo_product_meta_before_after_style_section',
            [
                'label' => esc_html__( 'Before Meta Text', 'turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_control(
			'trad_woo_product_meta_before_style',
			[
				'label'     => __( 'Before Meta', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'trad_woo_product_meta_before_typography',
				'selector'         => '{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-before',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 14
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ]
			]
		);

		$this->add_control(
			'trad_woo_product_meta_before_color',
			[
				'label'     => __( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-before' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_meta_before_margin',
			[
				'label'      => __( 'Margin', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
				],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_meta_before_padding',
			[
				'label'      => __( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
				],
				'selectors'  => [
					'{{WRAPPER}} .trad-woo-product-meta-box .trad-woo-product-meta-before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this-> end_controls_section();

    }
	// -----------------------------------woocommerce plugin warning function
    //---------------------------------------------------------------------------------------------
    protected function trad_init_content_wc_notice_controls() {
		if ( ! class_exists( 'woocommerce' ) ) {
			$this->start_controls_section( 'trad_global_warning', [
				'label' => __( 'Warning!', 'turbo-addons-elementor-pro' ),
			] );
			$this->add_responsive_control( 'trad_global_warning_text', [
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( '<strong>WooCommerce</strong> is not installed/activated on your site. Please install and activate <a href="plugin-install.php?s=woocommerce&tab=search&type=term" target="_blank">WooCommerce</a> first.', 'turbo-addons-elementor-pro' ),
				'content_classes' => 'trad-woo-warning',
			] );
			$this->end_controls_section();

			return;
		}
	}

		protected function render_woo_product_meta_data() {
			$settings  = $this->get_settings_for_display();
			$separator = !empty($settings['trad_woo_product_meta_separator_label']) ? $settings['trad_woo_product_meta_separator_label'] : ', ';

			if ( empty($settings['meta_fields_list']) || ! is_array($settings['meta_fields_list']) ) return;

			// ✅ Use the saved product from render()
			$product = isset($this->current_product) ? $this->current_product : null;
			if ( ! $product ) return;

			foreach ( $settings['meta_fields_list'] as $field ) {
				$type  = $field['meta_type'];
				$label = ! empty($field['custom_label']) ? $field['custom_label'] : ucfirst($type);
				$value = '';

				switch ( $type ) {
					case 'sku':
						$value = $product->get_sku();
						break;
					case 'category':
						$value = get_the_term_list( $product->get_id(), 'product_cat', '', $separator );
						break;
					case 'tag':
						$value = get_the_term_list( $product->get_id(), 'product_tag', '', $separator );
						break;
					case 'brand':
						$value = get_the_term_list( $product->get_id(), 'product_brand', '', $separator );
						break;
				}

				if ( ! empty( $value ) ) {
					echo '<span class="trad-woo-product-meta-container-box">';
					echo '<span class="detail-label">' . esc_html($label) . ':</span> ';
					echo '<span class="detail-content">' . wp_kses_post($value) . '</span>';
					echo '</span>';
				}
			}
		}	
	
		protected function render() {
			if ( ! class_exists( 'woocommerce' ) ) return;

			$settings = $this->get_settings_for_display();

			if ( empty( $settings['meta_fields_list'] ) || ! is_array( $settings['meta_fields_list'] ) ) return;

			// ✅ Live: use queried product | Editor: fallback to helper
			if ( ! is_admin() && is_singular('product') ) {
				$product = wc_get_product( get_queried_object_id() );
			} else {
				$product = Turbo_Addons_Pro\WOOHelper::trad_get_first_woo_product();
			}

			if ( ! $product ) return;

			// Save product for use in render_woo_product_meta_data()
			$this->current_product = $product;

			echo '<div class="trad-woo-product-meta-box">';

			if ( ! empty( $settings['trad_woo_product_meta_before'] ) ) {
				echo '<p class="trad-woo-product-meta-before">';
				echo wp_kses_post( $settings['trad_woo_product_meta_before'] );
				echo '</p>';
			}

			$this->render_woo_product_meta_data();

			echo '</div>';
		}



}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Meta());