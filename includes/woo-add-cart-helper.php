<?php
namespace TurboAddons\Elementor;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Woo_Mini_cart_helper {

    public static function init() {
        add_filter( 'woocommerce_add_to_cart_fragments', array( __CLASS__, 'trad_cart_count_total_fragments'), 10, 1 );
        // AJAX add-to-cart for our custom widget (bypasses WC redirect-to-cart setting)
        add_action( 'wp_ajax_trad_add_to_cart',        array( __CLASS__, 'trad_ajax_add_to_cart' ) );
        add_action( 'wp_ajax_nopriv_trad_add_to_cart', array( __CLASS__, 'trad_ajax_add_to_cart' ) );
	}

    public static function trad_cart_count_total_fragments( $fragments ) {

        $fragments['.trad-cart-items-count-number'] = '<span class="trad-cart-items-count-number">' . WC()->cart->get_cart_contents_count() .'</span>';
        $fragments['.trad-cart-items-heading-text'] = '<span class="trad-cart-items-heading-text">' . WC()->cart->get_cart_contents_count() .'</span>';
        $fragments['.trad-cart-items-count-price'] = '<span class="trad-cart-items-count-price">' . WC()->cart->get_cart_total() .'</span>';

        return $fragments;
    }

    /**
     * Custom AJAX add-to-cart handler.
     * Adds the product to WC cart and returns fragments — no redirect key —
     * regardless of WooCommerce's "redirect to cart" setting.
     */
    public static function trad_ajax_add_to_cart() {

        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'trad_add_to_cart_nonce' ) ) {
            wp_send_json_error( array( 'message' => 'Security check failed.' ), 403 );
        }

        if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
            wp_send_json_error( array( 'message' => 'WooCommerce not available.' ) );
        }

        $product_id = isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
        $quantity   = isset( $_POST['quantity'] )   ? absint( $_POST['quantity'] )   : 1;
        $quantity   = max( 1, $quantity );

        if ( ! $product_id ) {
            wp_send_json_error( array( 'message' => 'Invalid product.' ) );
        }

        // Ensure WC session exists for guest users
        if ( ! WC()->session->has_session() ) {
            WC()->session->set_customer_session_cookie( true );
        }

        $added = WC()->cart->add_to_cart( $product_id, $quantity );

        if ( false === $added ) {
            wp_send_json_error( array( 'message' => 'Could not add to cart.' ) );
        }

        WC()->cart->calculate_totals();

        // Get fragments — these update mini-cart widgets in the header etc.
        $fragments = apply_filters( 'woocommerce_add_to_cart_fragments', array() ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHookname -- WooCommerce core filter

        wp_send_json_success( array(
            'fragments'  => $fragments,
            'cart_hash'  => WC()->cart->get_cart_hash(),
            'cart_count' => WC()->cart->get_cart_contents_count(),
        ) );
    }

}

Woo_Mini_cart_helper::init();
