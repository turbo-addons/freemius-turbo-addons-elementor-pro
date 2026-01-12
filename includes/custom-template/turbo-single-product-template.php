<?php
/**
 * ============================
 * 1. TA Templates Admin Menu
 * ============================
 */
add_action('admin_menu', function () {
    if ( class_exists( 'WooCommerce' ) ) {
        add_menu_page(
            __('WOO Single Page', 'turbo-addons-elementor-pro'),
            __('WOO Single Page', 'turbo-addons-elementor-pro'),
            'manage_options',
            'woo_single_page',
            '__return_null',
            plugins_url('admin/assets/images/turboFile.svg', dirname(__DIR__, 2) . '/turbo-addons-elementor-pro.php'),
            21
        );
    }
});

/**
 * ================================
 * 2. Register "Single Product Page" CPT
 * ================================
 */
add_action('init', function () {
    if ( class_exists( 'WooCommerce' ) ) {
    register_post_type('trad_single_template', [
        'labels' => [
            'name' => __('Create Template', 'turbo-addons-elementor-pro'),
            'singular_name' => __('Single Product Template', 'turbo-addons-elementor-pro'),
            'menu_name' => __('Single Product Page', 'turbo-addons-elementor-pro'),
        ],
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => 'woo_single_page',
        'supports' => ['title', 'editor', 'elementor'],
        'show_in_rest' => true,
            'rewrite' => false,
        ]);
    }
});

/**
 * ================================
 *  override the "Add Post" text into 'Add New Template' text in Create Template button
 * ================================
 */

add_filter('post_type_labels_trad_single_template', function ($labels) {
    $labels->add_new_item = __('Add New Template', 'turbo-addons-elementor-pro');
    return $labels;
});


/**
 * ======================================================
 * 3. Inject Settings Form Above the Template Post List
 * ======================================================
 */
add_action('all_admin_notices', function () {
    global $pagenow, $post_type;
    if ($pagenow === 'edit.php' && $post_type === 'trad_single_template') {
        trad_render_template_settings_page();
    }
});

/**
 * ====================================
 * 4. Save Settings Form Submission
 * ====================================
 */
add_action('admin_init', function () {
    if (
        isset( $_POST['trad_selected_template'], $_POST['_trad_nonce'] )
        && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_trad_nonce'] ) ), 'trad_template_settings_nonce' )
    ) {
        update_option('trad_selected_single_template_id', intval($_POST['trad_selected_template']));
        wp_redirect(add_query_arg(['template_saved' => '1'], admin_url('edit.php?post_type=trad_single_template')));
        exit;
    }
});

/**
 * ==========================================
 * 5. Show Success Notice After Saving Template
 * ==========================================
 */
add_action( 'admin_notices', function () {
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    if ( isset( $_GET['template_saved'] ) && '1' === sanitize_text_field( wp_unslash( $_GET['template_saved'] ) ) ) {
        echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Template saved successfully!', 'turbo-addons-elementor-pro' ) . '</p></div>';
    }
} );

/**
 * ===================================
 * 6. Settings Form Markup + Logic
 * ===================================
 */
function trad_render_template_settings_page() {
    $selected_id = intval(get_option('trad_selected_single_template_id'));
    $templates = get_posts([
        'post_type' => 'trad_single_template',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ]);

    echo '<div class="wrap"><h1>Select Single Product Template</h1>';
    echo '<form method="post">';
    wp_nonce_field('trad_template_settings_nonce', '_trad_nonce');
    echo '<select name="trad_selected_template">';
    echo '<option value="">-- Default Template --</option>';
    foreach ($templates as $template) {
        $selected = selected($selected_id, $template->ID, false);
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '<option value="' . esc_attr( $template->ID ) . '" ' . $selected . '>' . esc_html( $template->post_title ) . '</option>';
    }
    echo '</select><br><br>';
    echo '<input type="submit" class="button button-primary" value="Save Template">';
    echo '</form></div>';
}

/**
 * ==========================================
 * 7. Template Override for WooCommerce
 * ==========================================
 */
add_filter('template_include', function ($template) {
    // Don't override template in Elementor editor mode
    if (\Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode()) {
        return $template;
    }

    if (is_singular('product') && !is_admin() && class_exists('\Elementor\Plugin')) {
        $template_id = get_option('trad_selected_single_template_id');
        if ($template_id) {
            $custom_template = plugin_dir_path(__DIR__) . 'custom-template/single-product-render.php';
            if (file_exists($custom_template)) {
                return $custom_template;
            }
        }
    }
    return $template;
}, 9999);

/**
 * ==================================
 * 8. Elementor and WC Styling Support
 * ==================================
 */

add_action('elementor/init', function () {
    add_post_type_support('trad_single_template', 'elementor');
});
if (class_exists('WooCommerce')) {
add_action('wp_enqueue_scripts', function () {

    if (is_product()) {
        \Elementor\Plugin::instance()->frontend->enqueue_styles();
        if (function_exists('is_woocommerce') && is_woocommerce()) {
            wp_enqueue_style('woocommerce-general');
            wp_enqueue_style('woocommerce-layout');
            wp_enqueue_style('woocommerce-smallscreen');
        }
    }
    
});
}
if (class_exists('WooCommerce')) {
add_action('wp_footer', function () {
    if (is_product() && class_exists('\Elementor\Plugin')) {
        \Elementor\Plugin::instance()->frontend->enqueue_scripts();
    }
});
}
add_filter('elementor/frontend/print_css', '__return_true');
