<?php
// helper.php

function get_widget_pro_lists() {
    return [
        'timeline-story'       => 'timeline-story.php',
        'progress-bar'         => 'progress-bar.php',
        'review-template'      => 'review-template.php',
        'testimonial'          => 'testimonial.php',
        'three-d-flip-box'     => 'three-d-flip-box.php',
        'polygon3Dcarousel'    => 'polygon3Dcarousel.php',
        'turbo-date-time'      => 'turbo-date-time.php',
        'turbo-post-date'      => 'turbo-post-date.php',
        'post-category'        => 'post-category.php',
        'list-icon'            => 'list-icon.php', 
        'advance-featured-card'=> 'advance-featured-card.php',                                                                                                           
        'post-list'            => 'post-list.php',    
        'post-filter-tab'      => 'post-filter-tab.php',
        'image-scrolling_animatin-vr' => 'image-scrolling_animatin-vr.php',    
        'pricing-table-pro'    => 'pricing-table-pro.php',
        'hero-slider'          => 'hero-slider.php',
        'tuor-guide'           => 'tuor-guide.php',
        'woo-product-card'     => 'woo-product-card.php', 
        'pdf-flip-book'        => 'pdf-flip-book.php',  
        'text-gradient'        => 'text-gradient.php',  
        'visitor-count'        => 'visitor-count.php',
        'woo-product-pagination' => 'woo-product-pagination.php',
        'woo-category'         => 'woo-category.php',
        'dynamic-table'        => 'dynamic-table.php',
        'woo-mini-cart'        => 'woo-mini-cart.php',
        'woo-product-title'    => 'woo-product-title.php',
        'hr-slider'            => 'hr-slider.php',
        'woo-product-short-description' => 'woo-product-short-description.php',
        'woo-product-description' => 'woo-product-description.php',
        'woo-product-price'    => 'woo-product-price.php',
        'woo-product-meta'     => 'woo-product-meta.php',
        'woo-product-related'  => 'woo-product-related.php',
        'woo-product-breadcrumb'=> 'woo-product-breadcrumb.php',
        'woo-product-rating'    => 'woo-product-rating.php',
        'woo-product-stock'     => 'woo-product-stock.php',
        'woo-product-navigation' => 'woo-product-navigation.php',
        'woo-product-tab'       => 'woo-product-tab.php',
        'woo-product-image'     => 'woo-product-image.php',
        'woo-product-button'    => 'woo-product-button.php',
        'woo-product-cart'      => 'woo-product-cart.php',
    ];
}

function trad_pro_enqueue_scripts_styles() {   

    // Swiper slider CSS
    wp_enqueue_style( 'trad-pro-swiper-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/vendor/swiper/swiper-bundle.min.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/vendor/swiper/swiper-bundle.min.css' ), 'all' );
    // Swiper slider JS
    // wp_enqueue_script( 'trad-pro-swiper-script', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/vendor/swiper/swiper-bundle.min.js', [], TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION, true );
    wp_enqueue_script( 'trad-pro-swiper-script', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/vendor/swiper/swiper-bundle.min.js', ['jquery'], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/vendor/swiper/swiper-bundle.min.js' ), true );

    // progress bar css
    wp_enqueue_style( 'progress-milestone-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/progress-bar.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/progress-bar.css' ), 'all' );
    wp_enqueue_script( 'progress-milestone-script', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/js/progress-bar.js', [ 'jquery'], TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH, true );
    
    // Flip Box
    wp_enqueue_style( 'three-d-flip-box-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/three-d-flipbox.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/three-d-flipbox.css' ), 'all' );
    
    // review template
    wp_enqueue_style( 'review-template-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/review-template.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/review-template.css' ), 'all' );
    wp_enqueue_script( 'review-template-script', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/js/review-template.js', [ 'jquery'], TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH, true );

    // testimonial template
    wp_enqueue_style( 'testimonial-template-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/testimonial.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/testimonial.css' ), 'all' );
    wp_enqueue_script( 'testimonial-template-script', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/js/testimonial/testimonial.js', [ 'jquery'], TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH, true );
    
    // 3D Carousel
    wp_enqueue_style( 'three-d-carousel', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/polygon3Dcarousel.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/polygon3Dcarousel.css' ), 'all' );
    

    // timeline story
    wp_enqueue_style( 'timeline-story-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/timeline-story.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/timeline-story.css' ), 'all' );
    
    // Category Post Count
    wp_enqueue_style( 'trad-category-post-count-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/category-post-count.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/category-post-count.css' ), 'all' );
   
    //list icon
    wp_enqueue_style( 'trad-list-icon_style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/list-icon.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/list-icon.css' ), 'all' );

    //Advance featured card
    wp_enqueue_style( 'advance-featured-card_style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/advance-featured-card.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/advance-featured-card.css' ), 'all' );
    
   
    //post list
    wp_enqueue_style( 'trad-post-list_style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/post-list.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/post-list.css' ), 'all' );
    wp_enqueue_script(
        'trad-post-list-script',
        TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/js/postlist.js',
        ['jquery'],
        filemtime(TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/js/postlist.js'),
        true
    );

    wp_localize_script(
        'trad-post-list-script',
        'trad_ajax_obj', 
        [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce( 'trad_load_more_posts_nonce' ),
        ]
    );


    
    //pricing table pro
    wp_enqueue_style( 'trad-pricing-table-pro_style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/pricing-table-pro.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/pricing-table-pro.css' ), 'all' );
    //Advance post-filter
    wp_enqueue_style( 'category-filter-tab_style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/category-filter-tab.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/category-filter-tab.css' ), 'all' );
    wp_enqueue_script( 'category-filter-tab_script', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/js/category-filter-tab.js', [ 'jquery'], TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH, true );

    // image-vertical-scrolling
    wp_enqueue_style( 'trad-image-vertical-scrolling', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/image-vertical-scrolling.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/image-vertical-scrolling.css' ), 'all' );
    wp_enqueue_script( 'trad-image-vertical-scroll-script', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/js/image_vertical-scroll.js',[ 'jquery'], TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION, true );
  
  
    //Woo Product Carousel
    wp_enqueue_style( 'trad-woo-product-card-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/woo-product-card.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/woo-product-card.css' ), 'all' );

    // Enqueue Owl Carousel CSS
    wp_enqueue_style( 'owl-carousel-pro-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/vendor/owl/css/owl.carousel.min.css', [], '2.3.4', 'all' );

    // Enqueue Owl Carousel theme CSS (depends on the main carousel CSS)
    wp_enqueue_style( 'owl-carousel-theme-pro-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/vendor/owl/css/owl.theme.default.min.css', ['owl-carousel'], '2.3.4', 'all' );

    wp_enqueue_script( 'owl-carousel-pro-script', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/vendor/owl/js/owl.carousel.min.js', [ 'jquery'], TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION, true );

    // Swiper slider CSS
    wp_enqueue_style( 'trad-turbo-pro-hero-slider-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/turbo-pro-hero-slider.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/turbo-pro-hero-slider.css' ), 'all' );

    // wp_enqueue_style( 'introjs-css', 'https://cdn.jsdelivr.net/npm/intro.js/minified/introjs.min.css', [], '5.2.0' );
    // wp_enqueue_script( 'introjs-js', 'https://cdn.jsdelivr.net/npm/intro.js/minified/intro.min.js', [], '5.2.0', true );
    wp_enqueue_style( 'introjs-css', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/vendor/intro/introjs.min.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/vendor/intro/introjs.min.css' ), 'all' );
    wp_enqueue_script( 'introjs-js', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/vendor/intro/intro.min.js', [], TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION, true );
    wp_enqueue_script( 'trad-guided-tour-js', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/js/tuor-guide.js', [ 'jquery', 'introjs-js' ], '1.0.0', true );
    wp_enqueue_style( 'trad-tuor-guide-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/tuor-guide.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/tuor-guide.css' ), 'all' );

    //Flip Book
    wp_enqueue_style( 'trad-flip-book-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/flip-book.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/flip-book.css' ), 'all' );
    wp_enqueue_script( 'trad-flip-book-script', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/js/flip-book.js',[ 'jquery'], TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION, true );

    //Text Gradient
    wp_enqueue_style( 'trad-text-gradient-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/text-gradient.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/text-gradient.css' ), 'all' );


    //WOO Pagination
    wp_enqueue_style( 'trad-woo-pagination-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/woo-product-pagination.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/woo-product-pagination.css' ), 'all' );

    //WOO Category card
    wp_enqueue_style( 'trad-woo-category-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/woo-category.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/woo-category.css' ), 'all' );

    wp_enqueue_style( 'trad-woo-min-cart-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/woo-min-cart.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/woo-min-cart.css' ), 'all' );
    wp_enqueue_script( 'trad-woo-min-cart-script', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/js/woo-min-cart.js',[ 'jquery'], TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION, true );
    // wp_enqueue_style( 'trad-hr-scroll-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/hr-scroll.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/hr-scroll.css' ), 'all' );
    // wp_enqueue_script( 'trad-hr-scroll-script', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/js/hr-scroll.js',[ 'jquery'], TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION, true );
    // wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', [], null, true);
    // wp_enqueue_script('scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', ['gsap'], null, true);
    // wp_enqueue_script('scrolltoplugin', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js', ['gsap'], null, true);

    wp_enqueue_script( 'gsap', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/vendor/gsap/gsap.min.js',[], TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION, true );
    wp_enqueue_script( 'scrolltrigger', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/vendor/scroll/ScrollTrigger.min.js',['gsap'], TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION, true );
    wp_enqueue_script( 'scrolltoplugin', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/vendor/scroll/ScrollToPlugin.min.js',['gsap'], TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION, true );

    //WOO Product ALL Style
    wp_enqueue_style( 'trad-woo-product-all-style', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/custom-css/woo-product-all.css', [], filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/custom-css/woo-product-all.css' ), 'all' );
    // WOO Product ALL Script
    wp_enqueue_script( 'trad-woo-product-all-script', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/js/woo-product-all.js',[ 'jquery'], TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION, true );
    
    wp_enqueue_script( 'trad-flip-box', TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/js/flip-box.js', ['jquery'], TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION, true );

}

    

