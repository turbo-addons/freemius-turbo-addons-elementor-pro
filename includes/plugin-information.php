<?php
/**
 * Plugin Information Handler
 * Provides custom plugin information for the View Details modal
 * 
 * @package Turbo Addons Elementor Pro
 * @since 1.3.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class TRAD_Plugin_Information {

    /**
     * Initialize the plugin information handler
     */
    public static function init() {
        add_filter( 'plugins_api', [ __CLASS__, 'plugin_info' ], 20, 3 );
    }

    /**
     * Custom Plugin Information for View Details Modal
     * 
     * @param false|object|array $res    The result object or array. Default false.
     * @param string            $action The type of information being requested from the Plugin Installation API.
     * @param object            $args   Plugin API arguments.
     * @return object Plugin information
     */
    public static function plugin_info( $res, $action, $args ) {
        // Check if this is a request for our plugin
        if ( 'plugin_information' !== $action ) {
            return $res;
        }

        if ( 'turbo-addons-elementor-pro' !== $args->slug ) {
            return $res;
        }

        // Create plugin information object
        $plugin_info = new stdClass();
        $plugin_info->name = 'Turbo Addons Elementor Pro';
        $plugin_info->slug = 'turbo-addons-elementor-pro';
        $plugin_info->version = TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION;
        $plugin_info->author = '<a href="https://turbo-addons.com/">Turbo Addons Pro</a>';
        $plugin_info->homepage = 'https://turbo-addons.com/';
        $plugin_info->requires = '5.0';
        $plugin_info->tested = '6.9.4';
        $plugin_info->requires_php = '7.4';
        $plugin_info->last_updated = gmdate( 'Y-m-d' );
        $plugin_info->sections = array(
            'description' => self::get_description(),
            'features' => self::get_features(),
            'installation' => self::get_installation(),
            'changelog' => self::get_changelog(),
        );
        $plugin_info->banners = array(
            'low' => TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/banner-1544x500.png',
            'high' => TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/banner-1544x500.png',
        );

        return $plugin_info;
    }

    /**
     * Get Plugin Description
     * 
     * @return string HTML description
     */
    private static function get_description() {
        return '<h3>Turbo Addons Elementor Pro</h3>
        <p>Turbo Addons for Elementor gives you everything: <strong>90+ advanced widgets</strong>, WooCommerce support, and <strong>200+ prebuilt templates</strong> — all built for easy drag & drop design.</p>
        <p>Customize every part of your site, fast and code-free! Build stunning websites with powerful features including:</p>
        <ul>
            <li>✅ <strong>90+ Premium Widgets</strong> - Advanced widgets for every need</li>
            <li>✅ <strong>WooCommerce Integration</strong> - Complete shop builder widgets</li>
            <li>✅ <strong>200+ Templates</strong> - Pre-designed sections and pages</li>
            <li>✅ <strong>Fully Responsive</strong> - Mobile-first design approach</li>
            <li>✅ <strong>Regular Updates</strong> - New features added frequently</li>
            <li>✅ <strong>Premium Support</strong> - Dedicated support team</li>
        </ul>
        <p><strong>Perfect for:</strong> Agencies, Freelancers, Business Owners, and WordPress Developers</p>';
    }

    /**
     * Get Plugin Features
     * 
     * @return string HTML features list
     */
    private static function get_features() {
        return '<h3>Key Features</h3>
        <h4>🎨 Advanced Widgets</h4>
        <ul>
            <li><strong>Timeline Story</strong> - Create beautiful timeline layouts</li>
            <li><strong>Progress Bar</strong> - Animated progress indicators</li>
            <li><strong>Testimonials</strong> - Customer reviews and testimonials</li>
            <li><strong>3D Flip Box</strong> - Interactive flip animations</li>
            <li><strong>Pricing Tables</strong> - Professional pricing layouts</li>
            <li><strong>Hero Slider</strong> - Full-width hero sections</li>
            <li><strong>Advanced Search</strong> - Live AJAX search functionality</li>
            <li><strong>CSV Table</strong> - Upload and display CSV data with search & pagination</li>
            <li><strong>Off Canvas</strong> - Sliding side panels for menus and content</li>
            <li><strong>Tour Guide</strong> - Step-by-step site walkthroughs</li>
            <li>And 80+ more widgets...</li>
        </ul>
        
        <h4>🛒 WooCommerce Widgets</h4>
        <ul>
            <li>Product Cards & Grids</li>
            <li>Product Categories</li>
            <li>Mini Cart</li>
            <li>Product Single Page Builder</li>
            <li>Custom Product Templates</li>
            <li>Product Navigation</li>
            <li>Product Tabs</li>
            <li>Product Meta Information</li>
            <li>And many more...</li>
        </ul>
        
        <h4>⚡ Performance</h4>
        <ul>
            <li>Optimized code for fast loading</li>
            <li>Conditional asset loading</li>
            <li>Mobile responsive design</li>
            <li>Cross-browser compatible</li>
            <li>SEO friendly markup</li>
        </ul>
        
        <h4>🎯 Use Cases</h4>
        <ul>
            <li>Business websites</li>
            <li>E-commerce stores</li>
            <li>Portfolio sites</li>
            <li>Agency websites</li>
            <li>Landing pages</li>
            <li>Blog & magazine sites</li>
        </ul>';
    }

    /**
     * Get Installation Instructions
     * 
     * @return string HTML installation guide
     */
    private static function get_installation() {
        return '<h3>Installation</h3>
        <ol>
            <li>Make sure <strong>Turbo Addons Elementor (Free)</strong> is installed and activated</li>
            <li>Upload the plugin files to <code>/wp-content/plugins/turbo-addons-elementor-pro</code></li>
            <li>Activate the plugin through the "Plugins" menu in WordPress</li>
            <li>Activate your license key in the Turbo Addons Pro settings</li>
            <li>Start using the premium widgets in Elementor editor</li>
        </ol>
        
        <h4>Requirements</h4>
        <ul>
            <li>WordPress 5.0 or higher</li>
            <li>PHP 7.4 or higher</li>
            <li>Elementor 3.0.0 or higher</li>
            <li>Turbo Addons Elementor (Free version) must be active</li>
        </ul>
        
        <h4>Getting Started</h4>
        <ol>
            <li>Go to <strong>Turbo Addons Pro</strong> in your WordPress admin menu</li>
            <li>Enable/disable widgets as needed</li>
            <li>Edit any page with Elementor</li>
            <li>Find widgets under <strong>Turbo Addons Pro</strong> category</li>
            <li>Drag and drop widgets to your page</li>
        </ol>';
    }

    /**
     * Get Changelog
     * 
     * @return string HTML changelog
     */
    private static function get_changelog() {
        return '<h3>Changelog</h3>
        
        <h4>Version 1.3.4 - ' . gmdate('Y-m-d') . '</h4>
        <ul>
            <li><strong>New:</strong> CSV Upload & Display widget with search and pagination</li>
            <li><strong>New:</strong> Advanced table styling options</li>
            <li><strong>New:</strong> Mobile responsive table layouts (scroll & card modes)</li>
            <li><strong>New:</strong> Table heading and description with styling controls</li>
            <li><strong>Improved:</strong> Search functionality with customizable icons</li>
            <li><strong>Improved:</strong> Pagination with full styling controls</li>
            <li><strong>Fixed:</strong> Plugin information display in View Details modal</li>
            <li><strong>Fixed:</strong> Various bug fixes and performance improvements</li>
        </ul>
        
        <h4>Version 1.3.3</h4>
        <ul>
            <li><strong>New:</strong> Off Canvas widget</li>
            <li><strong>New:</strong> Advanced Search widget</li>
            <li><strong>New:</strong> Dynamic Table widget</li>
            <li><strong>Updated:</strong> Progress Bar widget</li>
            <li><strong>Updated:</strong> Timeline widget</li>
            <li><strong>Updated:</strong> 3D Slider widget</li>
        </ul>
        
        <h4>Version 1.3.0</h4>
        <ul>
            <li><strong>New:</strong> WooCommerce single product page builder</li>
            <li><strong>New:</strong> 15 WooCommerce widgets</li>
            <li><strong>New:</strong> Custom header and footer builder</li>
            <li><strong>Improved:</strong> Widget performance optimization</li>
        </ul>
        
        <h4>Version 1.2.0</h4>
        <ul>
            <li><strong>New:</strong> 10+ new premium widgets</li>
            <li><strong>New:</strong> 50+ new templates</li>
            <li><strong>Improved:</strong> Mobile responsiveness</li>
            <li><strong>Improved:</strong> Code optimization</li>
        </ul>
        
        <p><a href="https://turbo-addons.com/changelog/" target="_blank" rel="noopener">View Full Changelog →</a></p>';
    }
}

// Initialize the plugin information handler
TRAD_Plugin_Information::init();
