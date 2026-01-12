<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
get_header();

$template_id = intval(get_option('trad_selected_single_template_id'));

if ($template_id && class_exists('\Elementor\Plugin') && get_post_type($template_id) === 'trad_single_template') {

    // Force a global $product during Elementor editor preview
    if (is_admin() && \Elementor\Plugin::$instance->editor->is_edit_mode()) {
        $mock_product = wc_get_product();
        if (!$mock_product) {
            $products = wc_get_products(['limit' => 1]);
            if (!empty($products)) {
                $mock_product = wc_get_product($products[0]->get_id());
            }
        }

        if ($mock_product) {
            global $product;
            $product = $mock_product;
            setup_postdata($product->get_id());
        }
    }

    // Fetch the Elementor template content
    $content = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($template_id);

    if (!empty($content)) {
        do_action('woocommerce_before_main_content');
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo $content;
        do_action('woocommerce_after_main_content');
    } else {
        echo '<p>No template selected or the selected template is empty.</p>';
    }
} else {
    echo '<p>No single product template selected. Please select a template in the settings.</p>';
}

get_footer();
?>
