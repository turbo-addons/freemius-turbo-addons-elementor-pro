<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
get_header();

$trad_template_id = intval(get_option('trad_selected_single_template_id')); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

if ($trad_template_id && class_exists('\Elementor\Plugin') && get_post_type($trad_template_id) === 'trad_single_template') {

    // Force a global $product during Elementor editor preview
    if (is_admin() && \Elementor\Plugin::$instance->editor->is_edit_mode()) {
        $trad_mock_product = wc_get_product(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
        if (!$trad_mock_product) {
            $trad_products = wc_get_products(['limit' => 1]); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
            if (!empty($trad_products)) {
                $trad_mock_product = wc_get_product($trad_products[0]->get_id());
            }
        }

        if ($trad_mock_product) {
            global $product; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- WooCommerce standard global
            $product = $trad_mock_product;
            setup_postdata($product->get_id());
        }
    }

    // Fetch the Elementor template content
    $trad_content = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($trad_template_id); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

    if (!empty($trad_content)) {
        do_action('woocommerce_before_main_content'); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHookname -- WooCommerce core action
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Elementor sanitizes its own builder output
        echo $trad_content;
        do_action('woocommerce_after_main_content'); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHookname -- WooCommerce core action
    } else {
        echo '<p>No template selected or the selected template is empty.</p>';
    }
} else {
    echo '<p>No single product template selected. Please select a template in the settings.</p>';
}

get_footer();
?>
