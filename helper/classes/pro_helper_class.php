<?php
namespace Turbo_Addons_Pro;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class Pro_Helper_Widgets_Class {
    public static function get_the_pro_widget_lists() {
        
        // Retrieve the current widget settings
        $widgets_pro = get_option('turbo_pro_addons_widgets', []);
                    
        if (empty($widgets_pro)) {
            $widgets_pro = [
                'timeline-story',  
                'progress-bar',  
                'review-template',  
                'testimonial',  
                'three-d-flip-box', 
                'polygon3Dcarousel',
                'turbo-date-time', 
                'turbo-post-date',
                'post-category',
                'list-icon',
                'advance-featured-card',
                'post-list',
                'post-filter-tab',
                'pricing-table-pro',
                'image-scrolling_animatin-vr',
                'hero-slider',
                'tuor-guide',
                'pdf-flip-book',
                'woo-product-carousel',
                'text-gradient',
                'visitor-count',
                'woo-product-pagination',
                'woo-category',
                'dynamic-table',
                'woo-mini-cart',
                'woo-product-title',
                'woo-product-short-description',
                'woo-product-description',
                'woo-product-price',
                'woo-product-meta',
                'woo-product-related',
                'woo-product-breadcrumb',
                'woo-product-rating',
                'woo-product-stock',
                'woo-product-navigation',
                'woo-product-tab',
                'woo-product-image',
                'woo-product-button',
                'woo-product-cart',
                // 'hr-slider',
            ];
        }

        // If no widgets are saved, default to all widgets being active
        if (empty($widgets_pro)) {
            $widgets_pro = array_keys($all_pro_widgets); // This sets all widgets as active by default
        } 
        $all_pro_widgets = [
            //   File Key          => Widget Name
            'timeline-story'        => 'Time Line / Road Map',  
            'progress-bar'          => 'Progress Bar',  
            'review-template'       => 'Review Template',  
            'testimonial'           => 'Testimonial Slider',  
            'three-d-flip-box'      => '3D Flip Box',  
            'polygon3Dcarousel'     => '3D Carousel', 
            'turbo-date-time'       => 'Local Date', 
            'turbo-post-date'       => 'Post Date', 
            'post-category'         => 'Post Category',
            'list-icon'             => 'Icon List',
            'advance-featured-card' => 'Advance Featured Card',
            'post-list'             => 'Post List',
            'post-filter-tab'       => 'Post Filter Tab',
            'image-scrolling_animatin-vr'  => 'Image Vertical Scrolling',
            'pricing-table-pro'     => 'Pricing Table Pro',
            'hero-slider'           => 'Hero Slider',
            'tuor-guide'            => 'Tour Guide',
            'woo-product-card'      => 'Woo Products Card',
            'pdf-flip-book'         => 'PDF Flip Book',
            'text-gradient'         => 'Text Gradient', 
            'visitor-count'         => 'Active Visitor Count',
            'woo-product-pagination' => 'WOO Product Pagination',
            'woo-category'          => 'WOO Category Card',
            'dynamic-table'         => 'Dynamic Table',
            'woo-mini-cart'         => 'Woo Mini Cart',
            'woo-product-title'     => 'WOO Product Title',
            'woo-product-short-description' => 'WOO Product Short Description',
            'woo-product-description' => 'WOO Product Description',
            'woo-product-price'      => 'WOO Product Price',
            'woo-product-meta'       => 'WOO Product Meta',
            'woo-product-related'    => 'WOO Product Related',
            'woo-product-breadcrumb' => 'WOO Product Breadcrumb',
            'woo-product-rating'     => 'WOO Product Rating',
            'woo-product-stock'      => 'WOO Product Stock',
            'woo-product-navigation' => 'WOO Product Navigation',
            'woo-product-tab'        => 'WOO Product Tabs',
            'woo-product-image'      => 'WOO Product Image',
            'woo-product-button'     => 'WOO BuyNow Button',
            'woo-product-cart'       => 'WOO Product Add to Cart',
            // 'hr-slider'              => 'HR Slider',
        ];

        $widget_pro_categories = [
            'Contact' => ['timeline-story', 'progress-bar', 'review-template', 'visitor-count', 'dynamic-table'],
            'Slider' => ['hero-slider', 'tuor-guide'],
            'Post & Content' => ['testimonial', 'three-d-flip-box', 'polygon3Dcarousel', 'pdf-flip-book'],
            'UI & Effects' => ['post-category', 'list-icon', 'advance-featured-card', 'post-list', 'post-filter-tab', 'text-gradient'],
            'E-commerce & Features' => ['pricing-table-pro', 'image-scrolling_animatin-vr'],
            'Date & Time' => ['turbo-date-time', 'turbo-post-date'],
            'WOOCOMMERCE' => ['woo-product-card', 'woo-product-pagination', 'woo-category', 'woo-mini-cart', 'woo-product-title',
                             'woo-product-short-description', 'woo-product-description', 'woo-product-price',
                             'woo-product-meta', 'woo-product-related', 'woo-product-breadcrumb', 'woo-product-rating', 'woo-product-stock',
                             'woo-product-navigation', 'woo-product-tab', 'woo-product-image', 'woo-product-button', 'woo-product-cart',
                            ],
        ];

        // Return widgets data
        $pro_data = [
            'widgets_pro' => $widgets_pro,
            'all_pro_widgets' => $all_pro_widgets,
            'widget_pro_categories' => $widget_pro_categories
        ];
        
        // Save to database
        // update_option('custom_widget_data', $data);

        return $pro_data;
    }
}
