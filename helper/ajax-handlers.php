<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

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
        echo '<div class="trad-woo-no-products">' . esc_html__('No products found.', 'freemius-turbo-addons-elementor-pro') . '</div>';
    }

    wp_die();
}

// Advanced Search AJAX Handler
add_action('wp_ajax_trad_advanced_search', 'trad_advanced_search_callback');
add_action('wp_ajax_nopriv_trad_advanced_search', 'trad_advanced_search_callback');

function trad_advanced_search_callback() {
    check_ajax_referer( 'trad_search_nonce', 'nonce' );

    $query          = isset( $_POST['query'] ) ? sanitize_text_field( wp_unslash( $_POST['query'] ) ) : '';
    $post_types     = isset( $_POST['post_types'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['post_types'] ) ) : [ 'post', 'page' ];
    $count          = isset( $_POST['count'] ) ? absint( $_POST['count'] ) : 5;
    $show_thumb     = isset( $_POST['show_thumb'] ) && 'yes' === $_POST['show_thumb'];
    $show_excerpt   = isset( $_POST['show_excerpt'] ) && 'yes' === $_POST['show_excerpt'];
    $excerpt_length = isset( $_POST['excerpt_length'] ) ? absint( $_POST['excerpt_length'] ) : 15;
    $show_date      = isset( $_POST['show_date'] ) && 'yes' === $_POST['show_date'];
    $show_type      = isset( $_POST['show_type'] ) && 'yes' === $_POST['show_type'];
    $result_style   = isset( $_POST['result_style'] ) ? sanitize_text_field( wp_unslash( $_POST['result_style'] ) ) : 'list';

    if ( empty( $query ) ) {
        wp_send_json_error( [ 'message' => 'Empty query' ] );
    }

    $args = [
        'post_type'      => $post_types,
        'post_status'    => 'publish',
        'posts_per_page' => $count,
        's'              => $query,
        'orderby'        => 'relevance',
    ];

    $search_query = new WP_Query( $args );

    if ( ! $search_query->have_posts() ) {
        wp_send_json_success( [ 'html' => '<div class="trad-no-results">' . esc_html__( 'No results found', 'freemius-turbo-addons-elementor-pro' ) . '</div>' ] );
    }

    $html = '';
    $item_class = 'grid' === $result_style ? 'trad-result-card' : 'trad-result-item';

    while ( $search_query->have_posts() ) {
        $search_query->the_post();
        $post_id = get_the_ID();
        
        $html .= '<a href="' . esc_url( get_permalink( $post_id ) ) . '" class="' . esc_attr( $item_class ) . '">';
        
        // Thumbnail
        if ( $show_thumb ) {
            $has_thumb = has_post_thumbnail( $post_id );
            
            if ( $has_thumb ) {
                $thumb_url = get_the_post_thumbnail_url( $post_id, 'thumbnail' );
                if ( $thumb_url ) {
                    $html .= '<div class="trad-result-thumb">';
                    $html .= '<img src="' . esc_url( $thumb_url ) . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '" loading="lazy" />';
                    $html .= '</div>';
                }
            }
        }
        
        // Content wrapper
        $html .= '<div class="trad-result-content">';
        
        // Title
        $html .= '<h4 class="trad-result-title">' . esc_html( get_the_title( $post_id ) ) . '</h4>';
        
        // Excerpt
        if ( $show_excerpt ) {
            $excerpt = get_the_excerpt( $post_id );
            if ( empty( $excerpt ) ) {
                $excerpt = get_the_content( null, false, $post_id );
            }
            $html .= '<p class="trad-result-excerpt">' . esc_html( wp_trim_words( $excerpt, $excerpt_length, '...' ) ) . '</p>';
        }
        
        // Meta (date and post type)
        if ( $show_date || $show_type ) {
            $html .= '<div class="trad-result-meta">';
            
            if ( $show_date ) {
                $html .= '<span class="trad-result-date">' . esc_html( get_the_date( '', $post_id ) ) . '</span>';
            }
            
            if ( $show_type ) {
                $post_type_obj = get_post_type_object( get_post_type( $post_id ) );
                if ( $post_type_obj ) {
                    $html .= '<span class="trad-result-type">' . esc_html( $post_type_obj->labels->singular_name ) . '</span>';
                }
            }
            
            $html .= '</div>';
        }
        
        $html .= '</div>'; // .trad-result-content
        $html .= '</a>'; // .trad-result-item
    }

    wp_reset_postdata();

    wp_send_json_success( [ 'html' => $html ] );
}
