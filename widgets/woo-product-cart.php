<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class TRAD_WOO_Product_Cart_Button extends Widget_Base {

	public function get_name()       { return 'trad_woo_product_cart_button'; }
	public function get_title()      { return __( 'WOO Product Add to Cart', 'freemius-turbo-addons-elementor-pro' ); }
	public function get_icon()       { return 'eicon-woo-cart trad-icon'; }
	public function get_categories() { return [ 'turbo-addons-woo-pro' ]; }

	/* ===========================================================
	 * CONTROLS
	 * =========================================================== */
	protected function register_controls() {

		$this->trad_init_content_wc_notice_controls();

		if ( ! class_exists( 'woocommerce' ) ) {
			return;
		}

		// ── Content ──────────────────────────────────────────────
		$this->start_controls_section( 'trad_section_add_to_cart_content', [
			'label' => __( 'Content', 'freemius-turbo-addons-elementor-pro' ),
		] );

		$this->add_control( 'trad_woo_product_cart_button_text', [
			'label'   => esc_html__( 'Button Text', 'freemius-turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Add to Cart', 'freemius-turbo-addons-elementor-pro' ),
		] );

		$this->add_control( 'trad_woo_cart_click_action', [
			'label'   => __( 'After Add to Cart', 'freemius-turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'view_cart_btn',
			'options' => [
				'view_cart_btn' => __( 'Show "View Cart" button (AJAX)', 'freemius-turbo-addons-elementor-pro' ),
				'redirect_cart' => __( 'Redirect to Cart page', 'freemius-turbo-addons-elementor-pro' ),
			],
		] );

		$this->add_control( 'trad_woo_view_cart_text', [
			'label'     => __( 'View Cart Text', 'freemius-turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => __( 'View Cart', 'freemius-turbo-addons-elementor-pro' ),
			'condition' => [ 'trad_woo_cart_click_action' => 'view_cart_btn' ],
		] );

		$this->end_controls_section();

		// ── Style: Layout ─────────────────────────────────────────
		$this->start_controls_section( 'trad_woo_cart_layout_section', [
			'label' => esc_html__( 'Layout', 'freemius-turbo-addons-elementor-pro' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'trad_woo_cart_alignment', [
			'label'   => esc_html__( 'Alignment', 'freemius-turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'flex-start' => [ 'title' => esc_html__( 'Left',   'freemius-turbo-addons-elementor-pro' ), 'icon' => 'eicon-text-align-left'   ],
				'center'     => [ 'title' => esc_html__( 'Center', 'freemius-turbo-addons-elementor-pro' ), 'icon' => 'eicon-text-align-center' ],
				'flex-end'   => [ 'title' => esc_html__( 'Right',  'freemius-turbo-addons-elementor-pro' ), 'icon' => 'eicon-text-align-right'  ],
			],
			'default'   => 'flex-start',
			'selectors' => [ '{{WRAPPER}} .trad-cart-form' => 'justify-content: {{VALUE}};' ],
		] );

		$this->add_control( 'trad_woo_cart_direction', [
			'label'   => __( 'Direction', 'freemius-turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::CHOOSE,
			'toggle'  => false,
			'options' => [
				'row'    => [ 'title' => __( 'Row',    'freemius-turbo-addons-elementor-pro' ), 'icon' => 'eicon-h-align-left' ],
				'column' => [ 'title' => __( 'Column', 'freemius-turbo-addons-elementor-pro' ), 'icon' => 'eicon-v-align-top'  ],
			],
			'default'   => 'row',
			'selectors' => [ '{{WRAPPER}} .trad-cart-form' => 'flex-direction: {{VALUE}};' ],
		] );

		$this->add_responsive_control( 'trad_woo_cart_gap', [
			'label'      => __( 'Gap', 'freemius-turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 60 ] ],
			'default'    => [ 'size' => 10, 'unit' => 'px' ],
			'selectors'  => [ '{{WRAPPER}} .trad-cart-form' => 'gap: {{SIZE}}{{UNIT}};' ],
		] );

		$this->end_controls_section();

		// ── Style: Add to Cart Button ──────────────────────────────
		$this->start_controls_section( 'trad_woo_cart_btn_section', [
			'label' => __( 'Add to Cart Button', 'freemius-turbo-addons-elementor-pro' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'trad_woo_cart_btn_typo',
			'selector' => '{{WRAPPER}} .trad-cart-btn',
		] );

		$this->add_responsive_control( 'trad_woo_cart_btn_padding', [
			'label'      => __( 'Padding', 'freemius-turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [ 'top' => '11', 'right' => '24', 'bottom' => '11', 'left' => '24', 'unit' => 'px', 'isLinked' => false ],
			'selectors'  => [ '{{WRAPPER}} .trad-cart-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'trad_woo_cart_btn_border',
			'selector' => '{{WRAPPER}} .trad-cart-btn',
		] );

		$this->add_responsive_control( 'trad_woo_cart_btn_radius', [
			'label'      => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .trad-cart-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'trad_woo_cart_btn_shadow',
			'selector' => '{{WRAPPER}} .trad-cart-btn',
		] );

		$this->start_controls_tabs( 'trad_woo_cart_btn_tabs' );

			$this->start_controls_tab( 'trad_woo_cart_btn_normal', [ 'label' => __( 'Normal', 'freemius-turbo-addons-elementor-pro' ) ] );

			$this->add_control( 'trad_woo_cart_btn_color', [
				'label'     => __( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [ '{{WRAPPER}} .trad-cart-btn' => 'color: {{VALUE}};' ],
			] );

			$this->add_control( 'trad_woo_cart_btn_bg', [
				'label'     => __( 'Background', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2E3195',
				'selectors' => [ '{{WRAPPER}} .trad-cart-btn' => 'background-color: {{VALUE}};' ],
			] );

			$this->end_controls_tab();

			$this->start_controls_tab( 'trad_woo_cart_btn_hover', [ 'label' => __( 'Hover', 'freemius-turbo-addons-elementor-pro' ) ] );

			$this->add_control( 'trad_woo_cart_btn_hover_color', [
				'label'     => __( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .trad-cart-btn:hover' => 'color: {{VALUE}};' ],
			] );

			$this->add_control( 'trad_woo_cart_btn_hover_bg', [
				'label'     => __( 'Background', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .trad-cart-btn:hover' => 'background-color: {{VALUE}};' ],
			] );

			$this->add_control( 'trad_woo_cart_btn_transition', [
				'label'     => __( 'Transition (s)', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px' => [ 'min' => 0, 'max' => 3, 'step' => 0.1 ] ],
				'default'   => [ 'size' => 0.3 ],
				'selectors' => [ '{{WRAPPER}} .trad-cart-btn' => 'transition: background-color {{SIZE}}s ease, color {{SIZE}}s ease;' ],
			] );

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// ── Style: View Cart Button (conditional) ─────────────────
		$this->start_controls_section( 'trad_woo_view_cart_btn_section', [
			'label'     => __( 'View Cart Button', 'freemius-turbo-addons-elementor-pro' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [ 'trad_woo_cart_click_action' => 'view_cart_btn' ],
		] );

		$this->add_control( 'trad_woo_view_cart_btn_color', [
			'label'     => __( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [ '{{WRAPPER}} .trad-view-cart-btn' => 'color: {{VALUE}};' ],
		] );

		$this->add_control( 'trad_woo_view_cart_btn_bg', [
			'label'     => __( 'Background', 'freemius-turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#46b450',
			'selectors' => [ '{{WRAPPER}} .trad-view-cart-btn' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_control( 'trad_woo_view_cart_btn_hover_color', [
			'label'     => __( 'Text Color (Hover)', 'freemius-turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-view-cart-btn:hover' => 'color: {{VALUE}};' ],
		] );

		$this->add_control( 'trad_woo_view_cart_btn_hover_bg', [
			'label'     => __( 'Background (Hover)', 'freemius-turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-view-cart-btn:hover' => 'background-color: {{VALUE}};' ],
		] );

		$this->end_controls_section();

		// ── Style: Quantity +/− Buttons ───────────────────────────
		$this->start_controls_section( 'trad_woo_qty_btn_section', [
			'label' => __( 'Quantity Buttons', 'freemius-turbo-addons-elementor-pro' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'trad_woo_qty_btn_size', [
			'label'      => __( 'Button Size', 'freemius-turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 24, 'max' => 80 ] ],
			'default'    => [ 'size' => 38, 'unit' => 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .trad-qty-minus, {{WRAPPER}} .trad-qty-plus' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'trad_woo_qty_btn_icon_size', [
			'label'      => __( 'Icon Size', 'freemius-turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 8, 'max' => 40 ] ],
			'default'    => [ 'size' => 16, 'unit' => 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .trad-qty-minus, {{WRAPPER}} .trad-qty-plus' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'trad_woo_qty_btn_tabs' );

			$this->start_controls_tab( 'trad_woo_qty_btn_normal', [ 'label' => __( 'Normal', 'freemius-turbo-addons-elementor-pro' ) ] );

			$this->add_control( 'trad_woo_qty_btn_color', [
				'label'     => __( 'Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#444444',
				'selectors' => [ '{{WRAPPER}} .trad-qty-minus, {{WRAPPER}} .trad-qty-plus' => 'color: {{VALUE}};' ],
			] );

			$this->add_control( 'trad_woo_qty_btn_bg', [
				'label'     => __( 'Background', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f0f0f0',
				'selectors' => [ '{{WRAPPER}} .trad-qty-minus, {{WRAPPER}} .trad-qty-plus' => 'background-color: {{VALUE}};' ],
			] );

			$this->end_controls_tab();

			$this->start_controls_tab( 'trad_woo_qty_btn_hover', [ 'label' => __( 'Hover', 'freemius-turbo-addons-elementor-pro' ) ] );

			$this->add_control( 'trad_woo_qty_btn_hover_color', [
				'label'     => __( 'Color', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .trad-qty-minus:hover, {{WRAPPER}} .trad-qty-plus:hover' => 'color: {{VALUE}};' ],
			] );

			$this->add_control( 'trad_woo_qty_btn_hover_bg', [
				'label'     => __( 'Background', 'freemius-turbo-addons-elementor-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .trad-qty-minus:hover, {{WRAPPER}} .trad-qty-plus:hover' => 'background-color: {{VALUE}};' ],
			] );

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'trad_woo_qty_btn_border',
			'separator' => 'before',
			'selector'  => '{{WRAPPER}} .trad-qty-minus, {{WRAPPER}} .trad-qty-plus',
		] );

		$this->add_responsive_control( 'trad_woo_qty_btn_radius', [
			'label'      => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .trad-qty-minus, {{WRAPPER}} .trad-qty-plus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		// ── Style: Quantity Input ──────────────────────────────────
		$this->start_controls_section( 'trad_woo_qty_input_section', [
			'label' => __( 'Quantity Input', 'freemius-turbo-addons-elementor-pro' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'trad_woo_qty_input_typo',
			'selector' => '{{WRAPPER}} .trad-qty-input',
		] );

		$this->add_responsive_control( 'trad_woo_qty_input_width', [
			'label'      => __( 'Width', 'freemius-turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 30, 'max' => 120 ] ],
			'default'    => [ 'size' => 52, 'unit' => 'px' ],
			'selectors'  => [ '{{WRAPPER}} .trad-qty-input' => 'width: {{SIZE}}{{UNIT}};' ],
		] );

		$this->add_control( 'trad_woo_qty_input_color', [
			'label'     => __( 'Text Color', 'freemius-turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333333',
			'selectors' => [ '{{WRAPPER}} .trad-qty-input' => 'color: {{VALUE}};' ],
		] );

		$this->add_control( 'trad_woo_qty_input_bg', [
			'label'     => __( 'Background', 'freemius-turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [ '{{WRAPPER}} .trad-qty-input' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_responsive_control( 'trad_woo_qty_input_padding', [
			'label'      => __( 'Padding', 'freemius-turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .trad-qty-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'trad_woo_qty_input_border',
			'selector' => '{{WRAPPER}} .trad-qty-input',
		] );

		$this->add_responsive_control( 'trad_woo_qty_input_radius', [
			'label'      => __( 'Border Radius', 'freemius-turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .trad-qty-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->end_controls_section();
	}

	/* ===========================================================
	 * WC notice helper
	 * =========================================================== */
	protected function trad_init_content_wc_notice_controls() {
		if ( ! class_exists( 'woocommerce' ) ) {
			$this->start_controls_section( 'trad_global_warning', [
				'label' => __( 'Warning!', 'freemius-turbo-addons-elementor-pro' ),
			] );
			$this->add_control( 'trad_global_warning_text', [
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( '<strong>WooCommerce</strong> is not installed/activated. Please install <a href="plugin-install.php?s=woocommerce&tab=search&type=term" target="_blank">WooCommerce</a> first.', 'freemius-turbo-addons-elementor-pro' ),
				'content_classes' => 'trad-woo-warning',
			] );
			$this->end_controls_section();
		}
	}

	/* ===========================================================
	 * RENDER
	 * =========================================================== */
	protected function render() {

		if ( ! class_exists( 'woocommerce' ) ) {
			return;
		}

		$settings = $this->get_settings_for_display();

		/* ── Resolve product ─────────────────────────────────────── */
		if ( Plugin::instance()->editor->is_edit_mode() ) {
			$product = \Turbo_Addons_Pro\WOOHelper::trad_get_first_woo_product();
		} else {
			$product = wc_get_product( get_the_ID() );
		}

		if ( empty( $product ) || ! is_a( $product, 'WC_Product' ) ) {
			if ( Plugin::instance()->editor->is_edit_mode() ) {
				echo '<p class="trad-woo-product-is-empty">' . esc_html__( 'No product found for preview.', 'freemius-turbo-addons-elementor-pro' ) . '</p>';
			}
			return;
		}

		/* ── Product data ────────────────────────────────────────── */
		$product_id     = $product->get_id();
		$min_qty        = apply_filters( 'woocommerce_quantity_input_min',  $product->get_min_purchase_quantity(), $product ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHookname -- WooCommerce core filter
		$max_qty        = apply_filters( 'woocommerce_quantity_input_max',  $product->get_max_purchase_quantity(), $product ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHookname -- WooCommerce core filter
		$step_qty       = apply_filters( 'woocommerce_quantity_input_step', 1, $product ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHookname -- WooCommerce core filter
		$btn_text       = ! empty( $settings['trad_woo_product_cart_button_text'] )
		                  ? esc_html( $settings['trad_woo_product_cart_button_text'] )
		                  : esc_html__( 'Add to Cart', 'freemius-turbo-addons-elementor-pro' );
		$view_cart_text = ! empty( $settings['trad_woo_view_cart_text'] )
		                  ? esc_html( $settings['trad_woo_view_cart_text'] )
		                  : esc_html__( 'View Cart', 'freemius-turbo-addons-elementor-pro' );
		$cart_url       = esc_url( wc_get_cart_url() );
		$max_attr       = $max_qty > 0 ? ' max="' . esc_attr( $max_qty ) . '"' : '';
		$show_qty       = ! $product->is_sold_individually();
		$click_action   = ! empty( $settings['trad_woo_cart_click_action'] ) ? $settings['trad_woo_cart_click_action'] : 'view_cart_btn';

		// Use our own AJAX handler so WC's redirect-to-cart setting is bypassed
		$trad_ajax_url = esc_url( admin_url( 'admin-ajax.php' ) );
		$trad_nonce    = wp_create_nonce( 'trad_add_to_cart_nonce' );
		?>
		<div class="trad-woo-product-cart-button"
			data-action="<?php echo esc_attr( $click_action ); ?>"
			data-product-id="<?php echo esc_attr( $product_id ); ?>"
			data-cart-url="<?php echo esc_attr( $cart_url ); ?>"
			data-ajax-url="<?php echo esc_attr( $trad_ajax_url ); ?>"
			data-nonce="<?php echo esc_attr( $trad_nonce ); ?>"
		>
			<div class="trad-cart-form cart">

				<?php if ( $show_qty ) : ?>
				<div class="trad-qty-wrap">
					<button type="button" class="trad-qty-minus" aria-label="<?php esc_attr_e( 'Decrease quantity', 'freemius-turbo-addons-elementor-pro' ); ?>">&#8722;</button>
					<input
						type="number"
						class="trad-qty-input qty"
						name="quantity"
						value="<?php echo esc_attr( max( 1, $min_qty ) ); ?>"
						min="<?php echo esc_attr( $min_qty ); ?>"
						<?php echo $max_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- esc_attr'd ?>
						step="<?php echo esc_attr( $step_qty ); ?>"
						aria-label="<?php esc_attr_e( 'Product quantity', 'freemius-turbo-addons-elementor-pro' ); ?>"
					/>
					<button type="button" class="trad-qty-plus" aria-label="<?php esc_attr_e( 'Increase quantity', 'freemius-turbo-addons-elementor-pro' ); ?>">&#43;</button>
				</div>
				<?php endif; ?>

				<button type="button" class="trad-cart-btn single_add_to_cart_button button alt">
					<?php echo $btn_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- esc_html'd ?>
				</button>

				<?php if ( $click_action === 'view_cart_btn' ) : ?>
				<a href="<?php echo $cart_url; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- esc_url'd ?>"
				   class="trad-view-cart-btn"
				   style="display:none;"
				   aria-hidden="true">
					<?php echo $view_cart_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- esc_html'd ?>
				</a>
				<?php endif; ?>

			</div>
		</div>

		<script>
		(function () {
			'use strict';

			var wrap = document.currentScript ? document.currentScript.previousElementSibling : null;
			if ( ! wrap ) return;

			var productId = wrap.getAttribute( 'data-product-id' );
			var action    = wrap.getAttribute( 'data-action' );
			var cartUrl   = wrap.getAttribute( 'data-cart-url' );
			var ajaxUrl   = wrap.getAttribute( 'data-ajax-url' );
			var nonce     = wrap.getAttribute( 'data-nonce' );
			var addBtn    = wrap.querySelector( '.trad-cart-btn' );
			var viewBtn   = wrap.querySelector( '.trad-view-cart-btn' );

			/* ── Quantity +/- ───────────────────────────────────── */
			wrap.addEventListener( 'click', function ( e ) {
				var btn = e.target.closest( '.trad-qty-minus, .trad-qty-plus' );
				if ( ! btn ) return;
				var input = btn.closest( '.trad-qty-wrap' ).querySelector( '.trad-qty-input' );
				if ( ! input ) return;
				var step = parseFloat( input.getAttribute( 'step' ) ) || 1;
				var min  = parseFloat( input.getAttribute( 'min' ) )  || 0;
				var maxA = input.getAttribute( 'max' );
				var max  = ( maxA && maxA !== '' ) ? parseFloat( maxA ) : Infinity;
				var val  = parseFloat( input.value ) || 0;
				input.value = btn.classList.contains( 'trad-qty-minus' )
				            ? Math.max( min, val - step )
				            : Math.min( max, val + step );
				input.dispatchEvent( new Event( 'change', { bubbles: true } ) );
			} );

			/* ── Add to Cart click ──────────────────────────────── */
			if ( ! addBtn ) return;

			addBtn.addEventListener( 'click', function () {

				var qtyInput = wrap.querySelector( '.trad-qty-input' );
				var qty      = qtyInput ? ( parseInt( qtyInput.value, 10 ) || 1 ) : 1;

				/* Loading state */
				addBtn.disabled = true;
				addBtn.classList.add( 'trad-loading' );

				/*
				 * POST to our own AJAX handler (trad_add_to_cart).
				 * We handle the cart addition server-side and return fragments
				 * WITHOUT a redirect key, so WC's wc-add-to-cart.js never
				 * triggers a redirect — regardless of WC's store settings.
				 */
				var body = 'action=trad_add_to_cart'
				         + '&product_id=' + encodeURIComponent( productId )
				         + '&quantity='   + encodeURIComponent( qty )
				         + '&nonce='      + encodeURIComponent( nonce );

				fetch( ajaxUrl, {
					method:  'POST',
					headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
					body:    body,
				} )
				.then( function ( res ) { return res.json(); } )
				.then( function ( data ) {

					addBtn.disabled = false;
					addBtn.classList.remove( 'trad-loading' );

					if ( ! data || ! data.success ) {
						/* Server reported failure — only redirect for redirect_cart mode,
						   for view_cart_btn mode show a simple error state instead */
						if ( action === 'redirect_cart' ) {
							window.location.href = cartUrl.split( '?' )[0]
							    + '?add-to-cart=' + productId + '&quantity=' + qty;
						} else {
							/* Reset button so user can try again */
							addBtn.style.display = '';
						}
						return;
					}

					if ( action === 'redirect_cart' ) {
						window.location.href = cartUrl;
					} else {
						/* Show View Cart, stay on page */
						addBtn.style.display = 'none';
						if ( viewBtn ) {
							viewBtn.style.removeProperty( 'display' );
							viewBtn.removeAttribute( 'aria-hidden' );
						}
					}

					/* Update mini-cart fragments — but do NOT fire added_to_cart
					   because WC's handler reads data.redirect from it */
					if ( typeof jQuery !== 'undefined' && data.data && data.data.fragments ) {
						jQuery.each( data.data.fragments, function ( key, val ) {
							jQuery( key ).replaceWith( val );
						} );
						jQuery( document.body ).trigger( 'wc_fragments_refreshed' );
					}
				} )
				.catch( function () {
					/*
					 * Network failure — only redirect for redirect_cart mode.
					 */
					addBtn.disabled = false;
					addBtn.classList.remove( 'trad-loading' );
					if ( action === 'redirect_cart' ) {
						window.location.href = cartUrl.split( '?' )[0]
						    + '?add-to-cart=' + productId + '&quantity=' + qty;
					}
				} );
			} );
		}());
		</script>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new TRAD_WOO_Product_Cart_Button() );

