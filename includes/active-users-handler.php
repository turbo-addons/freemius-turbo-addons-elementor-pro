<?php
if (!defined('ABSPATH')) exit;

add_action('wp_ajax_trad_update_active_users', 'trad_update_active_users');
add_action('wp_ajax_nopriv_trad_update_active_users', 'trad_update_active_users');
add_action('wp_ajax_save_license_status', 'save_license_status_in_db');

function trad_update_active_users() {
    if (!session_id()) {
        session_start();
    }

    $timeout = 30; 
    $current_time = time();

    // Get existing active users or initialize an empty array
    $active_users = get_transient('trad_active_users') ?: [];

    // Update session activity timestamp
    $active_users[session_id()] = $current_time;

    // Remove expired sessions
    foreach ($active_users as $session => $timestamp) {
        if ($current_time - $timestamp > $timeout) {
            unset($active_users[$session]);
        }
    }

    // Save updated data
    set_transient('trad_active_users', $active_users, $timeout);

    wp_send_json_success(['active_users' => count($active_users)]);
}

add_action('wp_ajax_trad_remove_active_user', 'trad_remove_active_user');
add_action('wp_ajax_nopriv_trad_remove_active_user', 'trad_remove_active_user');

function trad_remove_active_user() {
    if (!session_id()) {
        session_start();
    }

    $active_users = get_transient('trad_active_users') ?: [];
    
    if (isset($active_users[session_id()])) {
        unset($active_users[session_id()]);
    }

    set_transient('trad_active_users', $active_users, 30);

    wp_send_json_success(['active_users' => count($active_users)]);
}

function save_license_status_in_db() {
    check_ajax_referer( 'trad_license_nonce', 'security' );
    if (!isset($_POST['license_key']) || !isset($_POST['expire_date'])) {
        wp_send_json(['success' => false, 'message' => 'Missing license key or expiration date']);
        return;
    }

    $license_key = sanitize_text_field( wp_unslash( $_POST['license_key'] ) );
    $expire_date = sanitize_text_field( wp_unslash( $_POST['expire_date'] ) );

    // Save the license key and expire date in the WordPress options table
    update_option('turbo_addons_pro_license_active_key', $license_key);
    update_option('turbo_addons_pro_license_expire_date', $expire_date);

    wp_send_json(['success' => true, 'message' => 'License saved successfully']);
}

//WOO Pagination
function trad_load_products() {
    check_ajax_referer( 'trad_load_products_nonce', 'security' );
    $category = isset($_POST['category'])
    ? sanitize_text_field( wp_unslash( $_POST['category'] ) )
    : '';
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 2;

    $args = [
        'post_type'      => 'product',
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
    ];

    if (!empty($category) && $category !== 'all') {
         // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- Using tax_query intentionally for product_cat filter
        $args['tax_query'] = [
            [
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category,
            ]
        ];
    }

    $query = new WP_Query($args);
    $total_pages = $query->max_num_pages;

    if ($query->have_posts()) {
        echo '<div class="trad-product-list-grid">'; // grid container

        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());
            ?>
            <div class="trad-woo-product-item-pagination">
                <a class = "trad-woo-pagination_link_card" href="<?php the_permalink(); ?>">
                    <?php 
                        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        echo $product->get_image();
                     ?>
                    <h3><?php the_title(); ?></h3>
                    <span>
                    <?php 
                        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        echo $product->get_price_html();
                     ?>
                     </span>
                </a>
                <?php 
                    $productId = $product->get_id();
                    $productLink = $product->get_permalink();
                    $sku = $product->get_sku();

                    if( $product->is_type( 'variable' ) ) {
                        echo '<a href="'.esc_url( $productLink ).'" class="trad-woo-pagination-cart-btn" data-quantity="1" data-product_id="'.absint($productId).'" data-product_sku="'.esc_attr($sku).'">View Options</a>';
                    } else {
                        echo '<a href="'.esc_attr( '?add-to-cart='.$productId ).'" class="trad-woo-pagination-cart-btn add_to_cart_button ajax_add_to_cart" data-quantity="1" data-product_id="'.absint($productId).'" data-product_sku="'.esc_attr($sku).'">Add to Cart</a>';
                    }
                ?>
            </div>
            <?php
        }

        echo '</div>'; // close grid wrapper

        if ($total_pages > 1) {
            echo '<div class="trad-woo-pagination">';
            for ($i = 1; $i <= $total_pages; $i++) {
                $active_class = ($i == $paged) ? 'active' : '';
                echo '<a href="#" class="trad-woo-pagination-link ' . esc_attr( $active_class ) . '" data-page="' . esc_attr( $i ) . '">' . esc_html( $i ) . '</a>';
            }
            echo '</div>';
        }

        wp_reset_postdata();
    } else {
        echo '<p>No products found for this category.</p>';
    }

    wp_die();
}



add_action('wp_ajax_trad_load_products', 'trad_load_products');
add_action('wp_ajax_nopriv_trad_load_products', 'trad_load_products');


// --------------------------post load more button handler//
add_action('wp_ajax_trad_load_more_posts', 'trad_load_more_posts_callback');
add_action('wp_ajax_nopriv_trad_load_more_posts', 'trad_load_more_posts_callback');

function trad_load_more_posts_callback() {
    check_ajax_referer('trad_load_more_posts_nonce', 'security');
    $cat_id = isset($_POST['category']) ? intval($_POST['category']) : 0;
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $limit  = isset($_POST['limit']) ? intval($_POST['limit']) : 6;

    $query = new WP_Query([
        'cat'            => $cat_id,
        'posts_per_page' => $limit,
        'offset'         => $offset,
    ]);

    ob_start();
    $count = 0;

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $count++;

            $title = get_the_title();
            $description = get_the_excerpt();
            $image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            $date = get_the_date();

            echo '<div class="trad-post-list">';
            if ($image) {
                echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($title) . '" class="trad-post-feature-image">';
            }
            echo '<h3 class="trad-post-title">' . esc_html($title) . '</h3>';
            echo '<p class="trad-post-date">' . esc_html($date) . '</p>';
            echo '<p class="trad-post-description">' . esc_html(wp_trim_words($description, 20, '...')) . '</p>';
            echo '<a href="' . esc_url(get_permalink()) . '" class="trad-post-read-more-button">Read More</a>';
            echo '</div>';
        }
    }

    wp_reset_postdata();
    $html = ob_get_clean();

    // Get total count for comparison
    $total_query = new WP_Query([
        'cat'            => $cat_id,
        'posts_per_page' => -1,
        'fields'         => 'ids',
    ]);

    wp_send_json_success([
        'html'     => $html,
        'count'    => $count,
        'has_more' => ($offset + $count) < $total_query->post_count,
    ]);
}