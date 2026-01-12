<?php
namespace Turbo_Addons_Pro;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class Pro_Helper {
    public static function get_the_free_widget_lists() {
        // Check if the class and method exist in the free plugin
        if ( class_exists('Turbo_Addons\Helper') && method_exists('Turbo_Addons\Helper', 'get_the_widget_lists') ) {
            // Call the method from the free plugin
            $data =  \Turbo_Addons\Helper::get_the_widget_lists();
            return $data;
        } else {
            // Retrieve the current widget settings
            $widgets = get_option('turbo_addons_widgets', []);

            // Default widget list if not set in options
            if (empty($widgets)) {
                $widgets = [
                    'advanced-heading',
                    'contact-info',
                    'popular-post',
                    'preview-card',
                    'pricing-table',
                    'animated_text_effects',
                    'icon-button',
                    'section-shape-divider',
                    'countdown-timer',
                    'social-bar',
                    'review-star',
                    'most-top-bar',
                    'team-slider',
                    'fancy-alert',
                    'dual-header',
                    'info-box',
                    'business-hour',
                    'carousel',
                    'call-to-action',
                    'accordion',
                    'tooltip',
                    'floating-effect',
                    'image-overlay-effects',
                    'food-menu',
                    'coupon-code',
                    'single-testimonial',
                    'data-table',
                    'photo-stack',
                    'debit-card',
                    'icon_card',
                    'image_icon_card',
                    'copy-right-footer',
                    'read-more',
                    'google-map',
                    'event-calender',
                    'image-compare',
                    'advance-search',
                    'scroll-to-top',
                    'scroll-navigation',
                    'nav-menu',
                    'cookie-consent',
                    'navigation-menu',
                    'contact-form-7',
                ];
            }

            // Define all available widgets
            $all_widgets = [
                'advanced-heading'         => 'Advanced Heading',
                'contact-info'             => 'Contact Info',
                'popular-post'             => 'Popular Posts',
                'preview-card'             => 'Preview Card',
                'pricing-table'            => 'Pricing Table',
                'animated_text_effects'    => 'Text Animation',
                'icon-button'              => 'Icon Button',
                'section-shape-divider'    => 'Shape Divider',
                'countdown-timer'          => 'Count Down',
                'social-bar'               => 'Social Bar',
                'review-star'              => 'Review Star',
                'most-top-bar'             => 'Top Bar',
                'team-slider'              => 'Team Slider',
                'fancy-alert'              => 'Fancy Alert',
                'dual-header'              => 'Dual Header',
                'info-box'                 => 'Info Box',
                'business-hour'            => 'Business Hour',
                'carousel'                 => 'Carousel',
                'call-to-action'           => 'Call To Action',
                'accordion'                => 'Accordion',
                'tooltip'                  => 'Turbo Tooltip',
                'floating-effect'          => 'Floating Effect',
                'image-overlay-effects'    => 'Hover Overlay',
                'food-menu'                => 'Food Menu List',
                'coupon-code'              => 'Coupon Code',
                'single-testimonial'       => 'Single Testimonial',
                'data-table'               => 'Data Table',
                'photo-stack'              => 'Photo Stack',
                'debit-card'               => 'Banking Card',
                'icon_card'                => 'Icon Card',
                'image_icon_card'          => 'Image Icon Card',
                'copy-right-footer'        => 'Copy Right',
                'read-more'                => 'Read More',
                'google-map'               => 'Google Map',
                'event-calender'           => 'Event Calender',
                'image-compare'            => 'Image Compare',
                'advance-search'           => 'Advance Search',
                'scroll-to-top'            => 'Scroll To Top',
                'scroll-navigation'        => 'Scroll Navigation',
                'nav-menu'                 => 'Nav Menu',
                'cookie-consent'           => 'Cookie Consent',
                'navigation-menu'          => 'Navigation Menu',
                'contact-form-7'           => 'Contact Form 7',
            ];

            // $widget_categories = [
            //     'Contact' => ['contact-info', 'Heading', 'popular-post'],
            //     'Post & Content' => ['preview-card', 'pricing-table', 'animated_text_effects', 'icon-button'],
            //     'UI & Effects' => ['section-shape-divider', 'countdown-timer', 'social-bar', 'review-star', 'most-top-bar', 'team-slider'],
            //     'E-commerce & Features' => ['fancy-card', 'fancy-alert', 'dual-header', 'info-box', 'business-hour'],
            //     'Layout & Navigation' => ['carousel', 'call-to-action', 'accordion', 'tooltip', 'floating-effect', 'image-overlay-effects'],
            //     'Footer' => ['food-menu', 'coupon-code', 'single-testimonial', 'data-table'],
            //     'Miscellaneous' => ['photo-stack', 'debit-card', 'icon_card', 'image_icon_card', 'copy-right-footer'],
            //     'Other' => ['read-more', 'google-map', 'event-calender', 'image-compare', 'advance-search', 'scroll-to-top', 'scroll-navigation', 'nav-menu'],  // Added two more
            // ];
            $widget_categories = [
                'CONTENT' => [
                    'advanced-heading',
                    'google-map',
                    'image_icon_card',
                    'data-table',
                    'single-testimonial',
                    'carousel',
                    'tooltip',
                    'accordion',
                    'info-box',
                    'dual-header',
                    'team-slider',
                    'review-star',
                    'section-shape-divider',
                    'icon-button',
                    'preview-card',
                    'contact-info',
                    'nav-menu',
                    'navigation-menu',
                    'food-menu',
                ],
                
                'DYNAMIC CONTENT' => [
                    'event-calender',
                    'read-more',
                    'copy-right-footer',
                    'popular-post',
                    'contact-form-7',
                    'advance-search',
                ],
                'MARKETING' => [
                    'debit-card',
                    'coupon-code',
                    'call-to-action',
                    'business-hour',
                    'pricing-table',
                ],
                'CREATIVE' => [
                    'scroll-navigation',
                    'scroll-to-top',
                    'image-compare',
                    'photo-stack',
                    'fancy-alert',
                    'image-overlay-effects',
                    'floating-effect',
                    // 'fancy-card',
                    'countdown-timer',
                    'animated_text_effects',
                    // 'flipbook-img',
                ],
                'SOCIAL' => [
                    'most-top-bar',
                    'social-bar',
                    'cookie-consent',
                ],
                // 'WOOCOMMERCE' => [
                // ],
            ];

            // Return widgets data
            $data = [
                'widgets' => $widgets,
                'all_widgets' => $all_widgets,
                'widget_categories' => $widget_categories
            ];

            return $data;
        }
        
        // Save to database
        // update_option('custom_widget_data', $data);

        // return $free_widgets;
    }

    public static function get_the_pro_extension_lists() {

    // If free plugin exists, use its method
    if ( class_exists( 'Turbo_Addons\Helper' ) && method_exists( 'Turbo_Addons\Helper', 'get_the_extension_lists' ) ) {
        $data =  \Turbo_Addons\Helper::get_the_extension_lists();
        return $data;
    }

    // 🟢 Fallback when free plugin not loaded yet
    $extensions = get_option( 'turbo_addons_extensions', [] );

    $all_extensions = [
        'tooltip' => __( 'Tooltip Extension', 'turbo-addons-elementor-pro' ),
        // Add future pro extensions here
    ];

    return [
        'extensions'     => $extensions,
        'all_extensions' => $all_extensions,
    ];
}

}
