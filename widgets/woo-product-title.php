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
use TurboAddons\Elementor\Woo_Mini_cart_helper;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_WOO_Product_Title extends Widget_Base {

    public function get_name() {
        return 'trad_woo_product_title';
    }

    public function get_title() {
        return __('WOO Product Title', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-product-title trad-icon';
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
            'trad_woo_product_title_content_section',
            [
                'label' => esc_html__( 'Content', 'turbo-addons-elementor-pro' ),
            ]
        );

        $this->add_control(
			'trad_before_title',
			[
				'label'   => esc_html__( 'Text Before Title', 'turbo-addons-elementor-pro' ),
				'type'    => Controls_Manager::TEXT
			]
        );

		$this->add_control(
			'trad_woo_product_title_tag',
			[
				'label' => __( 'HTML Tag', 'turbo-addons-elementor-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->end_controls_section();

		/**
		 * Cart Icon Style
		 */
		
		$this->start_controls_section(
            'trad_woo_product_title_style',
            [
				'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE
            ]
		);

        $this->add_responsive_control(
            'trad_woo_product_title_alignment',
            [
                'label'         => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'center',
                'toggle'        => false,
                'options'       => [
                    'left' => [
                        'title'  => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title'  => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-text-align-center'
                    ],
                    'right'   => [
                        'title'  => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
                        'icon'   => 'eicon-text-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .trad-woo-product-title-box' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'trad_woo_title_box_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .trad-woo-product-title-box'
			]
		);

		$this->add_responsive_control(
			'trad_woo_title_box_padding',
			[
				'label'         => __( 'Padding', 'turbo-addons-elementor-pro' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'default'       => [
					'top'       => '1',
					'right'     => '0',
					'bottom'    => '1',
					'left'      => '0',
					'unit'      => 'px',
				],
				'selectors'     => [
					'{{WRAPPER}} .trad-woo-product-title-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'trad_woo_container_box_margin',
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
				],
				'selectors'    => [
					'{{WRAPPER}} .trad-woo-product-title-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'trad_woo_title_box_border_radius',
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
					'{{WRAPPER}} .trad-woo-product-title-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'trad_woo_title_box_border',
				'selector' => '{{WRAPPER}} .trad-woo-product-title-box'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'trad_woo_title_box_box_shadow',
				'selector' => '{{WRAPPER}} .trad-woo-product-title-box'
			]
		);

		$this->end_controls_section();

        /*
		* Title Styling Section
		*/
		$this->start_controls_section(
            'trad_woo_title_style_section',
            [
                'label' => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trad_woo_title_typography',
                'selector' => '{{WRAPPER}} .trad-woo-product-title-box .trad-woo-product-title-box-content'
            ]
        );

		$this->add_control(
			'trad_woo_title_color',
			[
				'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .trad-woo-product-title-box .trad-woo-product-title-box-content' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'trad_woo_title_text_shadow',
				'label' => __( 'Text Shadow', 'turbo-addons-elementor-pro' ),
				'selector' => '{{WRAPPER}} .trad-woo-product-title-box .trad-woo-product-title-box-content'
			]
		);

		$this->end_controls_section();
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

    protected function render_product_title() {
        if ( \Elementor\Plugin::instance()->editor->is_edit_mode() || \Elementor\Plugin::instance()->preview->is_preview_mode() ) {
            $title = get_the_title( Turbo_Addons_Pro\WOOHelper::trad_get_the_woo_product_title_first_product_id() );
            echo esc_html( $title );
        } else {
            the_title();
        }
    }
    

    protected function render() {
	if ( ! class_exists( 'woocommerce' ) ) {
		return;
	}

	$settings = $this->get_settings_for_display();

	$tag = isset( $settings['trad_woo_product_title_tag'] ) && in_array( $settings['trad_woo_product_title_tag'], [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'p' ] )
		? $settings['trad_woo_product_title_tag']
		: 'h3';

	$before_title = ! empty( $settings['trad_before_title'] ) ? sanitize_text_field( $settings['trad_before_title'] ) : '';
	?>

	<div class="trad-woo-product-title-box">
		<<?php echo esc_attr( $tag ); ?> class="product_title entry-title trad-woo-product-title-box-content">
			<?php
			if ( $before_title ) {
				echo esc_html( $before_title );
			}
			$this->render_product_title();
			?>
		</<?php echo esc_attr( $tag ); ?>>
	</div>

	<?php
}

}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_WOO_Product_Title());
