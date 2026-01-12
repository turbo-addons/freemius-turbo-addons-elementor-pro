<?php

namespace TurboAddons\Elementor;

use Elementor\Controls_Manager;

class Woo_Mini_cart_helper {

    public static function init() {
        add_filter( 'woocommerce_add_to_cart_fragments', array( __CLASS__, 'trad_cart_count_total_fragments'), 10, 1 );
	}

    public static function trad_cart_count_total_fragments( $fragments ) {

        $fragments['.trad-cart-items-count-number'] = '<span class="trad-cart-items-count-number">' . WC()->cart->get_cart_contents_count() .'</span>';
        $fragments['.trad-cart-items-heading-text'] = '<span class="trad-cart-items-heading-text">' . WC()->cart->get_cart_contents_count() .'</span>';
        $fragments['.trad-cart-items-count-price'] = '<span class="trad-cart-items-count-price">' . WC()->cart->get_cart_total() .'</span>';

        return $fragments;
    }


}

Woo_Mini_cart_helper::init();
