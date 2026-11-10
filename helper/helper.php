<?php
// helper.php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Whether this site has an active Turbo Addons Pro license (paid plan, trial,
 * or a state where Freemius allows premium code).
 *
 * Used to hide Pro widgets from the editor panel and to block inserting Pro
 * templates. It is NOT used to stop rendering: pages built while the license
 * was active keep working after it expires.
 *
 * @since 1.9.6
 * @return bool
 */
function trad_pro_is_license_active() {
    static $active = null;
    if ( null !== $active ) {
        return $active;
    }
    $active = false;
    if ( function_exists( 'taep_fs' ) ) {
        $fs     = taep_fs();
        $active = $fs->is_plan( 'pro', true ) || $fs->is_trial() || $fs->can_use_premium_code() || $fs->is_paying();
    }
    /** Filters the Turbo Addons Pro license state. */
    $active = (bool) apply_filters( 'trad_pro_is_license_active', $active );
    return $active;
}

function get_widget_pro_lists() {
    return [
        'timeline-story'                => 'timeline-story.php',
        'progress-bar'                  => 'progress-bar.php',
        'review-template'               => 'review-template.php',
        'testimonial'                   => 'testimonial.php',
        'three-d-flip-box'              => 'three-d-flip-box.php',
        'three-d-slider'                => 'three-d-slider.php',
        'turbo-date-time'               => 'turbo-date-time.php',
        'turbo-post-date'               => 'turbo-post-date.php',
        'post-category'                 => 'post-category.php',
        'list-icon'                     => 'list-icon.php', 
        'advance-featured-card'         => 'advance-featured-card.php',                                                                                                           
        'post-list'                     => 'post-list.php',    
        'post-filter-tab'               => 'post-filter-tab.php',
        'image-scrolling_animatin-vr'   => 'image-scrolling_animatin-vr.php',    
        'hero-slider'                   => 'hero-slider.php',
        'tuor-guide'                    => 'tuor-guide.php',
        'woo-product-card'              => 'woo-product-card.php', 
        'pdf-flip-book'                 => 'pdf-flip-book.php',  
        'text-gradient'                 => 'text-gradient.php',  
        'visitor-count'                 => 'visitor-count.php',
        'woo-product-pagination'        => 'woo-product-pagination.php',
        'woo-category'                  => 'woo-category.php',
        'csv-data-table'                => 'csv-data-table.php',
        'woo-mini-cart'                 => 'woo-mini-cart.php',
        'woo-product-title'             => 'woo-product-title.php',
        'woo-product-short-description' => 'woo-product-short-description.php',
        'woo-product-description'       => 'woo-product-description.php',
        'woo-product-price'             => 'woo-product-price.php',
        'woo-product-meta'              => 'woo-product-meta.php',
        'woo-product-related'           => 'woo-product-related.php',
        'woo-product-breadcrumb'        => 'woo-product-breadcrumb.php',
        'woo-product-rating'            => 'woo-product-rating.php',
        'woo-product-stock'             => 'woo-product-stock.php',
        'woo-product-navigation'        => 'woo-product-navigation.php',
        'woo-product-tab'               => 'woo-product-tab.php',
        'woo-product-image'             => 'woo-product-image.php',
        'woo-product-button'            => 'woo-product-button.php',
        'woo-product-cart'              => 'woo-product-cart.php',
        'table'                         => 'table.php',
        'advanced-search'               => 'advanced-search.php',
        'off-canvas'                    => 'off-canvas.php',
        'whatsapp'                      => 'whatsapp.php',
        'hotspot'                       => 'hotspot.php',
    ];
}

/**
 * Asset version: the file's modification time (cache-busts on every change),
 * falling back to the plugin version. Never the server path.
 *
 * @since 1.9.6
 * @param string $rel Path relative to the plugin root.
 * @return string
 */
function trad_pro_asset_ver( $rel ) {
    $file = TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . $rel;
    return file_exists( $file ) ? (string) filemtime( $file ) : TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION;
}

/**
 * Register (not enqueue) all front-end assets.
 *
 * Every widget declares the handles it needs in get_style_depends() /
 * get_script_depends(), so Elementor loads a file only on pages that actually
 * contain that widget (and loads all of them in the editor preview).
 * Before 1.9.6 everything was enqueued on every page of the site.
 *
 * Removed in 1.9.6: GSAP + ScrollTrigger + ScrollToPlugin (gsap.min.js was
 * missing and no widget used them), Owl Carousel (no Pro widget used it), the
 * bundled Swiper 11 (Hero Slider now uses Elementor's own Swiper) and the
 * empty review-template.js / flip-book.js files.
 */
function trad_pro_enqueue_scripts_styles() {
    $url = TRAD_TURBO_ADDONS_PRO_PLUGIN_URL;
    $css = 'assets/css/custom-css/';
    $js  = 'assets/js/';

    $styles = [
        'progress-milestone-style'        => $css . 'progress-bar.css',
        'three-d-flip-box-style'          => $css . 'three-d-flipbox.css',
        'review-template-style'           => $css . 'review-template.css',
        'testimonial-template-style'      => $css . 'testimonial.css',
        'three-d-carousel'                => $css . 'polygon3Dcarousel.css',
        'timeline-story-style'            => $css . 'timeline-story.css',
        'trad-category-post-count-style'  => $css . 'category-post-count.css',
        'trad-list-icon_style'            => $css . 'list-icon.css',
        'advance-featured-card_style'     => $css . 'advance-featured-card.css',
        'trad-post-list_style'            => $css . 'post-list.css',
        'category-filter-tab_style'       => $css . 'category-filter-tab.css',
        'trad-image-vertical-scrolling'   => $css . 'image-vertical-scrolling.css',
        'trad-woo-product-card-style'     => $css . 'woo-product-card.css',
        'trad-turbo-pro-hero-slider-style'=> $css . 'turbo-pro-hero-slider.css',
        'introjs-css'                     => 'assets/vendor/intro/introjs.min.css',
        'trad-tuor-guide-style'           => $css . 'tuor-guide.css',
        'trad-flip-book-style'            => $css . 'flip-book.css',
        'trad-text-gradient-style'        => $css . 'text-gradient.css',
        'trad-woo-pagination-style'       => $css . 'woo-product-pagination.css',
        'trad-woo-category-style'         => $css . 'woo-category.css',
        'trad-woo-min-cart-style'         => $css . 'woo-min-cart.css',
        'trad-woo-product-all-style'      => $css . 'woo-product-all.css',
        'trad-table-style'                => $css . 'trad-table.css',
        'trad-advanced-search-style'      => $css . 'trad-advanced-search.css',
        'trad-off-canvas-style'           => $css . 'trad-off-canvas.css',
        'trad-whatsapp-style'             => $css . 'trad-whatsapp.css',
        'trad-hotspot-style'              => $css . 'hotspot.css',
    ];
    foreach ( $styles as $handle => $rel ) {
        wp_register_style( $handle, $url . $rel, [], trad_pro_asset_ver( $rel ), 'all' );
    }

    $scripts = [
        'progress-milestone-script'         => [ $js . 'progress-bar.js', [ 'jquery' ] ],
        'trad-post-list-script'             => [ $js . 'postlist.js', [ 'jquery' ] ],
        'category-filter-tab_script'        => [ $js . 'category-filter-tab.js', [ 'jquery' ] ],
        'trad-image-vertical-scroll-script' => [ $js . 'image_vertical-scroll.js', [ 'jquery' ] ],
        'introjs-js'                        => [ 'assets/vendor/intro/intro.min.js', [] ],
        'trad-guided-tour-js'               => [ $js . 'tuor-guide.js', [ 'jquery', 'introjs-js' ] ],
        'trad-woo-min-cart-script'          => [ $js . 'woo-min-cart.js', [ 'jquery' ] ],
        'trad-woo-product-all-script'       => [ $js . 'woo-product-all.js', [ 'jquery' ] ],
        'trad-flip-box'                     => [ $js . 'flip-box.js', [ 'jquery' ] ],
        'trad-table-script'                 => [ $js . 'trad-table.js', [ 'jquery' ] ],
        'trad-advanced-search-script'       => [ $js . 'trad-advanced-search.js', [ 'jquery' ] ],
        'trad-off-canvas'                   => [ $js . 'trad-off-canvas.js', [ 'jquery' ] ],
        'trad-whatsapp-script'              => [ $js . 'trad-whatsapp.js', [ 'jquery', 'elementor-frontend' ] ],
        'trad-hotspot-script'               => [ $js . 'hotspot.js', [ 'jquery', 'elementor-frontend' ] ],
        'trad-pro-hero-slider'              => [ $js . 'hero-slider.js', [ 'jquery', 'elementor-frontend' ] ],
    ];
    // WP 6.9.1+ warns when a dependency is not registered yet (e.g. in the Elementor editor shell).
    $has_frontend = wp_script_is( 'elementor-frontend', 'registered' );
    foreach ( $scripts as $handle => $def ) {
        $def[1] = $has_frontend ? $def[1] : array_values( array_diff( $def[1], [ 'elementor-frontend' ] ) );
        wp_register_script( $handle, $url . $def[0], $def[1], trad_pro_asset_ver( $def[0] ), true );
    }

    wp_localize_script(
        'trad-post-list-script',
        'trad_ajax_obj',
        [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'trad_load_more_posts_nonce' ),
        ]
    );
    wp_localize_script( 'trad-advanced-search-script', 'tradSearchData', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'trad_search_nonce' ),
    ] );
}
    


