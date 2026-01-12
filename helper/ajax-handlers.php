<?php
add_action('wp_ajax_trad_load_products', 'trad_load_products_callback');
add_action('wp_ajax_nopriv_trad_load_products', 'trad_load_products_callback');

function trad_load_products_callback() {
    check_ajax_referer( 'trad_load_products_nonce', 'security' );
    $category_slugs = isset($_POST['category'])
    ? array_map('sanitize_text_field', (array) wp_unslash($_POST['category']))
    : ['all'];
    $page = isset($_POST['page']) ? absint($_POST['page']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? absint($_POST['posts_per_page']) : 4;
    $widget_id = isset($_POST['widget_id'])
    ? sanitize_text_field( wp_unslash( $_POST['widget_id'] ) )
    : '';

    $category_slugs = array_map('sanitize_text_field', $category_slugs);

    $args = [
        'post_type' => 'product',
        'posts_per_page' => $posts_per_page,
        'paged' => $page,
    ];

    if (!in_array('all', $category_slugs)) {
        // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- Using tax_query intentionally for product_cat filter
        $args['tax_query'] = [[
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $category_slugs,
        ]];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();

        echo '<div class="trad-woo-product-item-pagination-wrapper">';

        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="elementor-element elementor-element-<?php echo esc_attr($widget_id); ?> trad-woo-product-item-pagination">
                <a href="<?php the_permalink(); ?>" class="trad-woo-pagination_link_card">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium'); ?>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                    <span><?php woocommerce_template_loop_price(); ?></span>
                </a>
                <?php if (function_exists('woocommerce_template_loop_add_to_cart')) : ?>
                    <div class="trad-woo-pagination-cart-btn">
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php
        }

        echo '</div>'; // .trad-woo-product-item-pagination-wrapper
        wp_reset_postdata();

        // Custom Pagination (with Elementor-friendly classes)
        $total_pages = $query->max_num_pages;
        if ($total_pages > 1) {
            echo '<div class="trad-woo-pagination">';
            for ($i = 1; $i <= $total_pages; $i++) {
                $active_class = ($i === $page) ? 'active' : '';
                echo '<span class="trad-woo-pagination-link page-numbers ' . esc_attr( $active_class ) . '" data-page="' . esc_attr($i) . '">' . esc_html($i) . '</span>';
            }
            echo '</div>';
        }
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo ob_get_clean();
    } else {
        echo '<div class="trad-woo-no-products">' . esc_html__('No products found.', 'turbo-addons-elementor-pro') . '</div>';
    }

    wp_die();
}
