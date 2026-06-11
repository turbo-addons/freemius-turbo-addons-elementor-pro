<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_WOO_Product_Image extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_image';
    }

    public function get_title() {
        return __('WOO Product Image', 'freemius-turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-product-images trad-icon';
    }

    public function get_categories() {
        return ['turbo-addons-woo-pro'];
    }

    public function get_script_depends() {
        return [ 'zoom', 'wc-single-product' ];
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
            'trad_woo_product_title_content_section',
            [
                'label' => esc_html__( 'Content', 'freemius-turbo-addons-elementor-pro' ),
            ]
        );

            
		$this->add_control(
            'trad_woo_product_thumb_view_style',
            [
                'label'   => esc_html__( 'Thumbnail View', 'freemius-turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'prefix_class' => 'trad-woo-product-thumb-view-',
                'options' => [
					'default'   => esc_html__( 'Default', 'freemius-turbo-addons-elementor-pro' ),                    
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_image_before',
            [
                'label'   => esc_html__( 'Text Before Image', 'freemius-turbo-addons-elementor-pro' ),
                'type'    => Controls_Manager::TEXTAREA
            ]
        );

        $this->end_controls_section();

        /*
		* Image container Styling Section
		*/
        $this->start_controls_section(
            'trad_woo_product_image_container_style_section',
            [
                'label' => esc_html__( 'Container', 'freemius-turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_image_container_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-product-image'
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_image_container_padding',
			[
				'label'         => __( 'Padding', 'freemius-turbo-addons-elementor-pro' ),
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
					'{{WRAPPER}} .trad-woo-product-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_product_image_container_margin',
			[
				'label'        => __( 'Margin', 'freemius-turbo-addons-elementor-pro' ),
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
					'{{WRAPPER}} .trad-woo-product-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'trad_woo_product_image_container_radius',
			[
				'label'      => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
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
					'{{WRAPPER}} .trad-woo-product-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'       => 'trad_woo_product_image_container_border',
				'selector'   => '{{WRAPPER}} .trad-woo-product-image'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_product_image_container_box_shadow',
				'selector' => '{{WRAPPER}} .trad-woo-product-image'
			]
		);

        $this->end_controls_section();

        /*
		* Image Section
		*/
        $this->start_controls_section(
            'trad_woo_product_image_style_section',
            [
                'label' => esc_html__( 'Image', 'freemius-turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'trad_woo_product_image_enable_sale_flash',
            [
                'label'        => __( 'Enable Sale Flash', 'freemius-turbo-addons-elementor-pro' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'freemius-turbo-addons-elementor-pro' ),
                'label_off'    => __( 'Hide', 'freemius-turbo-addons-elementor-pro' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'trad_woo_product_image_border',
				'label' 	=> __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .trad-woo-product-image .images img.wp-post-image',
			]
        );
        
        $this->add_responsive_control(
            'trad_woo_product_image_border_radius',
            [
                'label'         => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'default'       => [
                    'top'       => '0',
                    'right'     => '0',
                    'bottom'    => '0',
                    'left'      => '0',
                    'isLinked'  => true
                ],                
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .trad-woo-product-image .images img.wp-post-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'trad_woo_product_image_box_shadow',
				'label' 	=> __( 'Box Shadow', 'freemius-turbo-addons-elementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .trad-woo-product-image .images img.wp-post-image',
			]
		);

        $this->end_controls_section();

        /*
		* Sale Tags Section
		*/
		$this->start_controls_section(
            'trad_woo_product_image_sale_style',
            [
                'label'     => __( 'Sale Tags', 'freemius-turbo-addons-elementor-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_image_sale_tag_left_position',
            [
                'label'         => esc_html__('Horizontal Position', 'freemius-turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 20,
                    'unit'      => 'px'
                ],               
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 5
                    ]
                ],
                'selectors'     => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-image span.onsale' => 'left: {{SIZE}}{{UNIT}};'
                ],   
            ]
        );  

        $this->add_responsive_control(
            'trad_woo_product_image_sale_tag_top_position',
            [
                'label'         => esc_html__('Vertical Position', 'freemius-turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 20,
                    'unit'      => 'px'
                ],               
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 5
                    ]
                ],
                'selectors'     => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-image span.onsale' => 'top: {{SIZE}}{{UNIT}};'
                ],   
            ]
        );  

        $this->add_responsive_control(
            'trad_woo_product_image_sale_height',
            [
                'label'         => esc_html__('Sale Height', 'freemius-turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::SLIDER,
                'selectors'     => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-image span.onsale' => 'min-height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                ],                
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1
                    ]
                ],
                'default' => [
					'unit' => 'px',
					'size' => 25,
				]
            ]
        );  

        $this->add_responsive_control(
            'trad_woo_product_image_sale_tag_padding',
            [
                'label'         => esc_html__( 'Padding', 'freemius-turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,            
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
					'top'       => '10',
					'right'     => '20',
					'bottom'    => '10',
					'left'      => '20',
					'unit'      => 'px',
                    'isLinked'  => false
				],
                'selectors'     => [
                        '.woocommerce {{WRAPPER}} .trad-woo-product-image span.onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'trad_woo_product_image_sale_tag_border_radius',
            [
                'label'         => esc_html__( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'default'    => [
                    'top'      => '10',
                    'right'    => '10',
                    'bottom'   => '10',
                    'left'     => '10',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'selectors'     => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-image span.onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_image_sale_tag_style',
            [
                'label'         => esc_html__( 'Sale Tag', 'freemius-turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::HEADING
            ]
        );

        $this->add_control(
            'trad_woo_product_image_sale_tag_color',
            [
                'label'     => esc_html__( 'Color', 'freemius-turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-image span.onsale' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'trad_woo_product_image_sale_tag_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'freemius-turbo-addons-elementor-pro' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2E3195',
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-image span.onsale' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'trad_woo_product_image_sale_shadow',
                'selector'  => '.woocommerce {{WRAPPER}} .trad-woo-product-image span.onsale'        
            ]
        );

        $this->end_controls_section();

        /**
         * Product Gallery Section
         */

        $this->start_controls_section(
            'trad_woo_product_image_thumbnail_style',
            [
                'label' => esc_html__( 'Product Gallery', 'freemius-turbo-addons-elementor-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'trad_woo_product_image_thumbnail_border',
				'label' 	=> __( 'Border', 'freemius-turbo-addons-elementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .trad-woo-product-image .images .flex-control-thumbs li img',
			]
        );
        
        $this->add_responsive_control(
            'trad_woo_product_image_thumbnail_border_radius',
            [
                'label'         => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'default'       => [
                    'top'       => '0',
                    'right'     => '0',
                    'bottom'    => '0',
                    'left'      => '0',
                    'isLinked'  => true
                ],                
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '.woocommerce {{WRAPPER}} .trad-woo-product-image div.images .flex-control-thumbs li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '.woocommerce {{WRAPPER}} .trad-woo-product-image div.images .flex-control-thumbs li img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'trad_woo_product_image_thumbnail_box_shadow',
				'label' 	=> __( 'Box Shadow', 'freemius-turbo-addons-elementor-pro' ),
				'selector' 	=> '{{WRAPPER}} .trad-woo-product-image .images .flex-control-thumbs li img',
			]
		);

        $this->end_controls_section();


		$this->start_controls_section(
            'trad_woo_product_image_before_after_style_section',
            [
                'label' => esc_html__( 'Before Text', 'freemius-turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_product_image_before_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .product-image-before'
			]
		);


		$this->add_control(
			'trad_woo_product_image_before_color',
			[
				'label'     => __( 'Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .product-image-before' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'trad_woo_product_image_before_typography',
				'selector'         => '{{WRAPPER}} .product-image-before',
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

		$this->add_responsive_control(
			'trad_woo_product_image_before_margin',
			[
				'label'      => __( 'Margin', 'freemius-turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
                    'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .product-image-before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
			'trad_woo_product_image_before_padding',
			[
				'label'      => __( 'Padding', 'freemius-turbo-addons-elementor-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
                    'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .product-image-before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
            'trad_woo_product_image_before_alignment',
            [
                'label'         => esc_html__( 'Alignment', 'freemius-turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'left',
                'toggle'        => false,
                'options'       => [
                    'left' => [
                        'title'  => esc_html__( 'Left', 'freemius-turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title'  => esc_html__( 'Center', 'freemius-turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-text-align-center'
                    ],
                    'right'   => [
                        'title'  => esc_html__( 'Right', 'freemius-turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-text-align-right'
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .product-image-before' => 'text-align: {{VALUE}};'
                ]
            ]
        );
		$this-> end_controls_section();
    }
    protected function trad_init_content_wc_notice_controls() {
        if ( ! class_exists( 'woocommerce' ) ) {
            $this->start_controls_section( 'trad_global_warning', [
                'label' => __( 'Warning!', 'freemius-turbo-addons-elementor-pro' ),
            ] );
            $this->add_responsive_control( 'trad_global_warning_text', [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __( '<strong>WooCommerce</strong> is not installed/activated on your site. Please install and activate <a href="plugin-install.php?s=woocommerce&tab=search&type=term" target="_blank">WooCommerce</a> first.', 'freemius-turbo-addons-elementor-pro' ),
                'content_classes' => 'trad-woo-warning',
            ] );
            $this->end_controls_section();

            return;
        }
    }
    protected function render() {
    if ( ! class_exists( 'woocommerce' ) ) {
        return;
    }

    $settings = $this->get_settings_for_display();
    $this->add_render_attribute( 'trad-woo-product-image', 'class',  'trad-woo-product-image' );

    if ( ! empty( $settings['trad_woo_product_image_before'] ) ) {
        echo '<p class="product-image-before">' . wp_kses_post( $settings['trad_woo_product_image_before'] ) . '</p>';
    }
    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '<div ' . $this->get_render_attribute_string( 'trad-woo-product-image' ) . '>';

    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- WooCommerce standard global
    global $product; 

    // ✅ Handle Elementor Editor Mode
    if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
        $product = Turbo_Addons_Pro\WOOHelper::trad_get_first_woo_product();

        if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
            echo '<p>No preview product found.</p></div>';
            return;
        }

        setup_postdata( $product->get_id() );

        ob_start();
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHookname -- WooCommerce core filter
        $columns = apply_filters( 'woocommerce_product_thumbnails_columns', 4 ); 
        $thumbnail_id = $product->get_image_id();
       
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHookname -- WooCommerce core filter
        $wrapper_classes = apply_filters( 'woocommerce_single_product_image_gallery_classes', array( 
            'woocommerce-product-gallery',
            'woocommerce-product-gallery--' . ( $thumbnail_id ? 'with-images' : 'without-images' ),
            'woocommerce-product-gallery--columns-' . absint( $columns ),
            'images',
        ) );
        ?>
        <div class="product">
            <div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>"
                 data-columns="<?php echo esc_attr( $columns ); ?>"
                 style="transition: opacity .25s ease-in-out; float: none; width: 100%;">
                <figure class="woocommerce-product-gallery__wrapper">
                    <?php
                    if ( $thumbnail_id ) {
                        $html = wc_get_gallery_image_html( $thumbnail_id, true );
                    } else {
                        $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
                        $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />',
                            esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ),
                            esc_html__( 'Awaiting product image', 'freemius-turbo-addons-elementor-pro' ) );
                        $html .= '</div>';
                    }
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped,WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHookname -- WooCommerce core filter/output
                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $thumbnail_id ); 

                    $attachment_ids = $product->get_gallery_image_ids();
                    if ( $attachment_ids && $thumbnail_id ) {
                        foreach ( $attachment_ids as $attachment_id ) {
                            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped,WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHookname -- WooCommerce core filter/output
                            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id );
                        }
                    }

                    ?>
                </figure>
            </div>
        </div>
        <?php
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo ob_get_clean();
        ?>
        <script>
            jQuery(document).ready(function () {
                jQuery('.woocommerce-product-gallery').each(function () {
                    jQuery(this).wc_product_gallery();
                });
            });
        </script>
        <?php

    } else {
        // ✅ Frontend rendering
        $product = wc_get_product(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- WooCommerce standard global

        if ( empty( $product ) ) {
            echo '</div>';
            return;
        }

        if ( 'yes' === $settings['trad_woo_product_image_enable_sale_flash'] ) {
            wc_get_template( 'loop/sale-flash.php' );
        }

        wc_get_template( 'single-product/product-image.php' );
        ?>
       <script>
        document.addEventListener('DOMContentLoaded', function () {
            jQuery('.woocommerce-product-gallery').each(function () {
                jQuery(this).wc_product_gallery();
            });
        });
        </script>
        <?php
    }

    echo '</div>';
}

}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Image());
