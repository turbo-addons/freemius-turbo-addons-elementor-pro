<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class Pro_Helper_Widgets_Class {
    public static function get_the_pro_widget_lists() {
        
        // Retrieve the current widget settings
        $widgets_pro = get_option('turbo_pro_addons_widgets', []);
                    
        if (empty($widgets_pro)) {
            $widgets_pro = [

                // ---------content--------//
                'timeline-story',
                'review-template', 
                'testimonial', 
                'list-icon',
                'tuor-guide',
                'csv-data-table',
                'table',
                // ---------dynamic content--------//
                'turbo-date-time',
                'turbo-post-date',
                'post-category',
                'advance-featured-card',
                'post-list',
                'post-filter-tab',
                'visitor-count',
                'advanced-search',
                'off-canvas',
                'whatsapp',
                // ---------Creative--------//
                'progress-bar', 
                'three-d-flip-box',
                'three-d-slider', // not found
                'image-scrolling_animatin-vr',
                'hero-slider',
                'pdf-flip-book',
                'text-gradient',
                'hotspot',  //----------------25 widgets-----------

                //------------woocommerce---- 18 widgets------------18+25=43
                'woo-category',
                'woo-mini-cart',
                'woo-product-breadcrumb',
                'woo-product-button',
                'woo-product-card',
                'woo-product-cart',
                'woo-product-description',
                'woo-product-image',
                'woo-product-meta',
                'woo-product-navigation',
                'woo-product-pagination',
                'woo-product-price',
                'woo-product-rating',
                'woo-product-related',
                'woo-product-short-description',
                'woo-product-stock',
                'woo-product-tab',
                'woo-product-title',       
            ];
        }

        // If no widgets are saved, default to all widgets being active
        if (empty($widgets_pro)) {
            $widgets_pro = array_keys($all_pro_widgets); // This sets all widgets as active by default
        } 
        $all_pro_widgets = [
            //   File Key                   => Widget Name
            'timeline-story'                => 'Time Line / Road Map',  
            'progress-bar'                  => 'Progress Bar',  
            'review-template'               => 'Review Template',  
            'testimonial'                   => 'Testimonial Slider',  
            'three-d-flip-box'              => '3D Flip Box',  
            'three-d-slider'                => '3D Slider', //missing
            'turbo-date-time'               => 'Local Date', 
            'turbo-post-date'               => 'Post Date', 
            'post-category'                 => 'Post Category',
            'list-icon'                     => 'Icon List',
            'advance-featured-card'         => 'Advance Featured Card',
            'post-list'                     => 'Post List',
            'post-filter-tab'               => 'Post Filter Tab',
            'image-scrolling_animatin-vr'   => 'Image Vertical Scrolling',
            'hero-slider'                   => 'Hero Slider',
            'tuor-guide'                    => 'Tour Guide',          
            'pdf-flip-book'                 => 'PDF Flip Book',
            'text-gradient'                 => 'Text Gradient', 
            'visitor-count'                 => 'Active Visitor Count',  
            'csv-data-table'                => 'CSV Data Table',
            'table'                         => 'Table',
            'advanced-search'               => 'Advanced Search Pro',
            'off-canvas'                    => 'Off-Canvas',
            'whatsapp'                      => 'WhatsApp Chat',
            'hotspot'                       => 'Image Hotspot',

            //------------------wocommerce--------------------------

            'woo-category'                  => 'WOO Category Card',
            'woo-mini-cart'                 => 'Woo Mini Cart',
            'woo-product-breadcrumb'        => 'WOO Product Breadcrumb',
            'woo-product-button'            => 'WOO BuyNow Button',
            'woo-product-card'              => 'Woo Products Card',
            'woo-product-cart'              => 'WOO Product Add to Cart',
            'woo-product-short-description' => 'WOO Product Short Description',
            'woo-product-image'             => 'WOO Product Image',
            'woo-product-meta'              => 'WOO Product Meta',
            'woo-product-navigation'        => 'WOO Product Navigation',
            'woo-product-pagination'        => 'WOO Product Pagination',
            'woo-product-price'             => 'WOO Product Price',
            'woo-product-rating'            => 'WOO Product Rating',
            'woo-product-related'           => 'WOO Product Related',                    
            'woo-product-description'       => 'WOO Product Description', 
            'woo-product-stock'             => 'WOO Product Stock',
            'woo-product-tab'               => 'WOO Product Tabs',
            'woo-product-title'             => 'WOO Product Title',
            
            
        ];

        $widget_pro_categories = [

            'CONTENT' => ['timeline-story','review-template','testimonial', 'list-icon', 'tuor-guide',
                             'csv-data-table', 'table',], 
           
            'DYNAMIC CONTENT' => ['turbo-date-time', 'turbo-post-date','post-category', 'advance-featured-card',
                                    'post-list', 'post-filter-tab', 'visitor-count', 'advanced-search', 'off-canvas',
                                    'whatsapp',
                                ],
           
            'CREATIVE' => ['progress-bar','three-d-flip-box', 'three-d-slider', 'image-scrolling_animatin-vr',
                                'hero-slider', 'pdf-flip-book', 'text-gradient','hotspot', ],
            
            'WOOCOMMERCE' => ['woo-category', 'woo-mini-cart','woo-product-breadcrumb',
                               'woo-product-button','woo-product-card','woo-product-cart','woo-product-description',
                               'woo-product-image','woo-product-meta','woo-product-navigation',
                               'woo-product-pagination','woo-product-price','woo-product-rating',
                               'woo-product-related','woo-product-short-description','woo-product-stock',
                               'woo-product-tab','woo-product-title', 
                            ],
        ];

        // Return widgets data
        $pro_data = [
            'widgets_pro' => $widgets_pro,
            'all_pro_widgets' => $all_pro_widgets,
            'widget_pro_categories' => $widget_pro_categories,
        ];
        
        // Save to database
        // update_option('custom_widget_data', $data);

        return $pro_data;
    }
}
