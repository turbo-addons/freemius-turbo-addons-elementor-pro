<?php
namespace Turbo_Addons_Pro;

class WOOHelper {
    /**
    * Displays the title of the first published WooCommerce product when in Elementor editor or preview mode, for testing purposes.
    */
    public static function trad_get_the_woo_product_title_first_product_id(){
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'order'          => 'ASC',
            'orderby'        => 'ID',

        );
        $the_query = new \WP_Query( $args );
        // The Loop
        if ( $the_query->have_posts() ) {
                $product_id = array();
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    
                    $product_id[] = get_the_ID();

                    return reset($product_id);
                }
            }else {
                
        }
        /* Restore original Post Data */
        wp_reset_postdata();
      
    }
    /**
    * Displays the short description of the first published WooCommerce product when in Elementor editor or preview mode, for testing purposes.
    */
    public static function trad_get_the_woo_product_short_description_first_product_id(){
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'order'          => 'ASC',
            'orderby'        => 'ID',
        );
        $the_query = new \WP_Query( $args );
        
        // The Loop
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                
                // Get the product ID
                $product_id = get_the_ID();
                $product = wc_get_product( $product_id );
                
                // Get the short description securely
                if ( $product && $product->get_short_description() ) {
                    // Use wp_kses_post to sanitize the short description
                    return wp_kses_post( $product->get_short_description() );
                }
            }
        }
    
        /* Restore original Post Data */
        wp_reset_postdata();
    
        // Return an empty string if no short description found
        return '';
    }

    /**
    * Displays the full description of the first published WooCommerce product when in Elementor editor or preview mode, for testing purposes.
    */
    public static function trad_get_the_woo_product_description_first_product_id(){
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'order'          => 'ASC',
            'orderby'        => 'ID',
        );
        $the_query = new \WP_Query( $args );
        
        // The Loop
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                
                // Get the product ID
                $product_id = get_the_ID();
                $product = wc_get_product( $product_id );
                
                // Get the full description securely
                if ( $product && $product->get_description() ) {
                    // Use wp_kses_post to sanitize the description
                    return wp_kses_post( $product->get_description() );
                }
            }
        }

        /* Restore original Post Data */
        wp_reset_postdata();

        // Return an empty string if no description found
        return '';
    }

    /**
     * Displays the price of the first published WooCommerce product when in Elementor editor or preview mode, for testing purposes.
     */
    public static function trad_get_the_woo_product_price_first_product_id(){
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'order'          => 'ASC',
            'orderby'        => 'ID',
        );
        $the_query = new \WP_Query( $args );
        
        // The Loop
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                
                // Get the product ID
                $product_id = get_the_ID();
                $product = wc_get_product( $product_id );
                
                // Get the product price securely
                if ( $product ) {
                    // Get formatted price
                    $price_html = $product->get_price_html();
                    
                    // Use wp_kses_post to sanitize the price HTML
                    return wp_kses_post( $price_html );
                }
            }
        }

        /* Restore original Post Data */
        wp_reset_postdata();

        // Return an empty string if no price found
        return '';
    }

    /**
     * Displays the meta data of the first published WooCommerce product when in Elementor editor or preview mode, for testing purposes.
    */

    public static function trad_get_the_woo_first_product_meta_data() {
        
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'order'          => 'ASC',
            'orderby'        => 'ID',
        );
        $the_query = new \WP_Query( $args );
    
        // Initialize product data array
        $product_data = array(
            'sku'         => '',
            'categories'  => '',
            'tags'        => '',
            'brand'       => '',
        );
    
        // The Loop
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
    
                // Get the product ID
                $product_id = get_the_ID();
                $product = wc_get_product( $product_id );
    
                // Ensure the product exists
                if ( ! $product ) {
                    continue;
                }
    
                // Get SKU
                $product_data['sku'] = $product->get_sku() ? wp_kses_post( $product->get_sku() ) : __( 'N/A', 'turbo-addons-elementor-pro' );
    
                // Get Categories
                $category_list = get_the_term_list( $product_id, 'product_cat', '', ', ' );
                $product_data['categories'] = $category_list ? wp_kses_post( $category_list ) : __( 'No categories', 'turbo-addons-elementor-pro' );
    
                // Get Tags
                $tag_list = get_the_term_list( $product_id, 'product_tag', '', ', ' );
                $product_data['tags'] = $tag_list ? wp_kses_post( $tag_list ) : __( 'No tags', 'turbo-addons-elementor-pro' );
    
                // Get Brand (assuming the brand is stored as a custom taxonomy)
                $brand_list = get_the_term_list( $product_id, 'product_brand', '', ', ' );
                $product_data['brand'] = $brand_list ? wp_kses_post( $brand_list ) : __( 'No brand', 'turbo-addons-elementor-pro' );
    
                // Break the loop after the first product
                break;
            }
        }
    
        /* Restore original Post Data */
        wp_reset_postdata();
    
        // Return the product data as an array
        return $product_data;
    }
    
    /**
     * Displays the category of the first published WooCommerce product when in Elementor editor or preview mode, for testing purposes.
    */

    public static function trad_get_related_products_by_first_product_category($limit = 5) {
        $limit = absint($limit); // ✅ Validate

        // Get the first product
        $first_product_data = self::trad_get_the_woo_first_product_meta_data();

        // Extract and sanitize categories
        $categories = sanitize_text_field( wp_strip_all_tags( $first_product_data['categories'] ) );
        if (empty($categories) || $categories === __('No categories', 'turbo-addons-elementor-pro')) {
            return []; // No categories found
        }

        // Convert category names to IDs
        $category_ids = [];
        $category_names = explode(', ', $categories);
        foreach ($category_names as $category_name) {
            $category_name = sanitize_text_field($category_name); // ✅ Sanitize input
            $term = get_term_by('name', $category_name, 'product_cat');
            if ($term && !is_wp_error($term)) {
                $category_ids[] = $term->term_id;
            }
        }

        if (empty($category_ids)) {
            return [];
        }

        // Prepare query
        $args = [
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => $limit,
            'orderby' => 'rand',
            // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- Using tax_query intentionally for product_cat filter
            'tax_query' => [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $category_ids,
                    'operator' => 'IN',
                ]
            ],
        ];

        $related_query = new \WP_Query($args);
        $related_products = [];

        if ($related_query->have_posts()) {
            while ($related_query->have_posts()) {
                $related_query->the_post();
                $product = wc_get_product(get_the_ID());
                if ($product) {
                    $related_products[] = [
                        'id' => $product->get_id(),
                        'name' => $product->get_name(), // Escaped on output
                        'price' => $product->get_price_html(), // Escaped on output
                        'image' => wp_get_attachment_url($product->get_image_id()),
                        'link' => get_permalink($product->get_id()),
                    ];
                }
            }
            wp_reset_postdata();
        }

        return $related_products;
    }

    /**
     * Displays the first published WooCommerce product when in Elementor editor or preview mode, for testing purposes.
    */

    public static function trad_get_first_woo_product() {
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'order'          => 'ASC',
            'orderby'        => 'ID',
        );

        $query = new \WP_Query($args);

        if ( $query->have_posts() ) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());
            wp_reset_postdata();
            return $product;
        }

        wp_reset_postdata();
        return false;
    }
    
}
