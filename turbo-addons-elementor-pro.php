<?php
/**
 * Plugin Name: Turbo Addons Elementor Pro
 * Plugin URI: https://turbo-addons.com/
 * Description: Turbo Addons for Elementor gives you everything: 80+ advanced widgets, WooCommerce support, custom headers & footers, and 100+ prebuilt templates — all built for easy drag & drop design. Customize every part of your site, fast and code-free!
 * Version: 1.3.2
 * Author: Turbo Addons Pro
 * Author URI: https://turbo-addons.com/pricing/
 * License: GPLv3
 * License URI: https://opensource.org/licenses/GPL-3.0
 * Text Domain: turbo-addons-elementor-pro
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// wp-pulse integration
if ( ! class_exists( 'WPPulse_SDK' ) ) {
    require_once __DIR__ . '/wppulse/wppulse-plugin-analytics-engine-sdk.php';
}

// Fetch plugin data automatically
$trad_turbo_pro_plugin_data = get_file_data( __FILE__, [
    'Name'       => 'Plugin Name',
    'Version'    => 'Version',
    'TextDomain' => 'Text Domain',
] );

$trad_turbo_pro_plugin_slug = dirname( plugin_basename( __FILE__ ) );

// Initialize SDK
if ( class_exists( 'WPPulse_SDK' ) ) {
    WPPulse_SDK::init( __FILE__, [
        'name'     => $trad_turbo_pro_plugin_data['Name'],
        'slug'     => $trad_turbo_pro_plugin_slug,
        'version'  => $trad_turbo_pro_plugin_data['Version'],
        'endpoint' => 'https://wp-turbo.com/wp-json/wppulse/v1/collect',
    ] );
}

/**
 * Main Plugin Class
 * @since 1.0.0
 */
final class TRAD_Turbo_Addons_Pro {

    const TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION = '1.3.2';
    const TRAD_TURBO_ADDONS_PRO_MIN_ELEMENTOR_VERSION = '3.0.0';
    const TRAD_TURBO_ADDONS_PRO_MIN_PHP_VERSION = '7.4';
    
    private static $_instance = null;

    /**
     * Singleton Instance Method
     * @since 1.0.0
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     * @since 1.0.0
     */
    public function __construct() {
        $this->define_constants();
        // Include the helper file
        include_once plugin_dir_path(__FILE__) . 'helper/helper.php';
        include_once plugin_dir_path(__FILE__) . 'helper/ajax-handlers.php';
        include_once plugin_dir_path(__FILE__) . 'helper/classes/woo_helper.php';
        include_once plugin_dir_path(__FILE__) . 'includes/woo-add-cart-helper.php';
        add_action( 'wp_enqueue_scripts', 'trad_pro_enqueue_scripts_styles' );
        add_action( 'init', [ $this, 'trad_load_textdomain' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );

        // Check if the Free version is active
        if ( $this->is_free_version_active() ) {
            // Register activation hook directly without checks
            register_activation_hook( __FILE__, [ $this, 'turbo_addons_elementor_pro_activate' ] );
        }

        // Check if the Free version is active
        add_action( 'admin_init', [ $this, 'check_free_version_active' ] );

        // Redirect after activation
        add_action( 'admin_init', [ $this, 'handle_pro_activation_redirect' ] );

        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'trad_enqueue_warning_scripts' ] );

    }

    /**
     * Check if the free version is active
     *
     * @return bool
     */
    private function is_free_version_active() {
        // Replace 'turbo-addons-elementor/turbo-addons-elementor.php' with the actual main file of the free version
        include_once ABSPATH . 'wp-admin/includes/plugin.php';
        return is_plugin_active( 'turbo-addons-elementor/turbo-addons-elementor.php' );
    }

    /**
     * Handle the plugin activation to set a transient for redirect
     */
    public function turbo_addons_elementor_pro_activate() {
        // Set a transient to show the redirect
        set_transient( 'turbo_addons_pro_activation_redirect', true, 30 ); // 30 seconds
    }

    /**
     * Handle the redirect after activation
     */
    public function handle_pro_activation_redirect() {
        if ( get_transient( 'turbo_addons_pro_activation_redirect' ) ) {
            delete_transient( 'turbo_addons_pro_activation_redirect' );
            wp_redirect( admin_url( 'admin.php?page=turbo_addons_pro' )); // Correct redirect URL
            exit; // Always exit after redirecting
        }
    }
    
            
    public function trad_enqueue_warning_scripts() {
        wp_enqueue_style( 
            'trad-turbo-editor-warning-pro-style',
            TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'assets/css/editor-warning.css',
            [],
            filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'assets/css/editor-warning.css' ),
            'all'
        );
    }
            

    /**
     * Define Plugin Constants
     * @since 1.0.0
     */
    private function define_constants() {
        define( 'TRAD_TURBO_ADDONS_PRO_PLUGIN_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
        define( 'TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
        define( 'TRAD_TURBO_ADDONS_PRO_PLUGIN_VERSION', '1.3.2' );
    }

    /**
     * Load Text Domain for Translations
     * @since 1.0.0
     */
    public function trad_load_textdomain() {
        load_plugin_textdomain( 'turbo-addons-elementor-pro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

    /**
     * Initialize the plugin
     * @since 1.0.0
     */
    public function init() {

        // Check if Turbo Addons Free is active
        if ( ! defined( 'TURBO_ADDONS_VERSION' ) ) {  // Make sure TURBO_ADDONS_VERSION is defined in the free version
            add_action( 'admin_notices', [ $this, 'trad_admin_pro_notice_missing_main_plugin' ] );
            return;
        }

        // if ( ! version_compare( ELEMENTOR_VERSION, self::TRAD_TURBO_ADDONS_PRO_MIN_ELEMENTOR_VERSION, '>=' ) ) {
        //     add_action( 'admin_notices', [ $this, 'trad_admin_notice_minimum_elementor_version' ] );
        //     return;
        // }
        if ( ! version_compare( PHP_VERSION, self::TRAD_TURBO_ADDONS_PRO_MIN_PHP_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'trad_admin_notice_minimum_php_version' ] );
            return;
        }
        require_once plugin_dir_path(__FILE__) . 'helper/classes/helperClass.php';
        require_once plugin_dir_path(__FILE__) . 'helper/classes/pro_helper_class.php';
        require_once plugin_dir_path(__FILE__) . 'includes/active-users-handler.php';
        // ==============================
        // Turbo Addons Custom Template Sections
        // ==============================
        // -------------single product page----------//
        require_once plugin_dir_path(__FILE__) . 'includes/custom-template/turbo-single-product-template.php';
        add_action( 'elementor/init', [ $this, 'trad_init_category' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'trad_init_widgets' ] );
        if ( is_admin() ) {
            include_once ABSPATH . 'wp-admin/includes/plugin.php';
            // Check if the Free version is active
            if ( is_plugin_active( 'turbo-addons-elementor-pro/turbo-addons-elementor-pro.php' ) ) {
                require_once plugin_dir_path( __FILE__ ) . 'admin/admin-page.php';
            } else {
                add_action( 'admin_notices', [ $this, 'trad_admin_pro_notice_missing_main_plugin' ] );
                return;
            }
        }
    }

    /**
     * Initialize Widgets
     * @since 1.0.0
     */
    public function trad_init_widgets() {
        // Retrieve the widget settings from the database
        $widgets = get_option('turbo_pro_addons_widgets', []);
    
        // Define an array to map widget keys to their corresponding file paths
        $widget_files = get_widget_pro_lists();

        if (empty($widgets)) {
            $widgets = [
                'timeline-story',  
                'progress-bar',  
                'review-template',  
                'testimonial',  
                'flip-box',  
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
                'text-gradient',
                'visitor-count',
                'woo-product-card',
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
            ];
        }
        // Include each widget based on the stored settings
        foreach ($widget_files as $widget_key => $file) {
            if (in_array($widget_key, $widgets)) {
                require_once TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'widgets/' . $file;
            }
        }
    }
            

    // Premium Promotions

    /**
     * Initialize Category Section
     * @since 1.0.0
     */
    public function trad_init_category() {
        Elementor\Plugin::instance()->elements_manager->add_category (
            'turbo-addons-pro',
            [
                'title' => esc_html__( 'Turbo Addons Pro', 'turbo-addons-elementor-pro' )
            ]
        );
        Elementor\Plugin::instance()->elements_manager->add_category (
            'turbo-addons-woo-pro',
            [
                'title' => esc_html__( 'Turbo Woo', 'turbo-addons-elementor-pro' )
            ]
        );
    }

    /**
     * Admin Notice for Missing Elementor
     * @since 1.0.0
     */
    public function check_free_version_active() {
        // Check if the Free version is active
        if ( ! is_plugin_active( 'turbo-addons-elementor/turbo-addons-elementor.php' ) ) {
            add_action( 'admin_notices', [ $this, 'trad_admin_pro_notice_missing_main_plugin' ] );
            deactivate_plugins( plugin_basename( __FILE__ ) ); // Deactivate the Pro plugin if Free plugin is missing
        }
    }

    public function trad_admin_pro_notice_missing_main_plugin() {
        if ( ! is_plugin_active( 'turbo-addons-elementor/turbo-addons-elementor.php' ) ) {
            echo '<div class="notice notice-error">
                <p><strong>Turbo Addons Elementor Pro</strong> requires the <strong>Turbo Addons Elementor Free Version</strong> plugin to be installed and activated. Please activate the Free version to use the Pro features.</p>
            </div>';
        }
    }

    /**
     * Admin Notice for Minimum Elementor Version
     * @since 1.0.0
     */
    // public function trad_admin_notice_minimum_elementor_version() {
    //     if ( isset( $_GET['activate'] ) && isset( $_GET['_wpnonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'activate_plugin' ) ) {
    //         return; // Nonce verification failed
    //     }

    //     if ( isset( $_GET['activate'] ) ) {
    //         unset( $_GET['activate'] );
    //     }

    //     printf(
    //         '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
    //         wp_kses_post( sprintf(
    //             /* translators: 1: Plugin name (Turbo Addons), 2: Dependency name (Elementor), 3: Minimum required Elementor version */
    //             esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'turbo-addons-elementor-pro' ),
    //             '<strong>' . esc_html__( 'Turbo Addons Elementor Pro', 'turbo-addons-elementor-pro' ) . '</strong>',
    //             '<strong>' . esc_html__( 'Elementor', 'turbo-addons-elementor-pro' ) . '</strong>',
    //             esc_html( self::TRAD_TURBO_ADDONS_PRO_MIN_ELEMENTOR_VERSION )
    //         ) )
    //     );
    // }

    /**
     * Admin Notice for Minimum PHP Version
     * @since 1.0.0
     */
    public function trad_admin_notice_minimum_php_version() {
        if ( isset( $_GET['activate'] ) && isset( $_GET['_wpnonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'activate_plugin' ) ) {
            return; // Nonce verification failed
        }
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        printf(
            '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
            wp_kses_post( sprintf(
                /* translators: 1: Plugin name (Turbo Addons), 2: Software name (PHP), 3: Minimum required PHP version */
                esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'turbo-addons-elementor-pro' ),
                '<strong>' . esc_html__( 'Turbo Addons Elementor Pro', 'turbo-addons-elementor-pro' ) . '</strong>',
                '<strong>' . esc_html__( 'PHP', 'turbo-addons-elementor-pro' ) . '</strong>',
                esc_html( self::TRAD_TURBO_ADDONS_PRO_MIN_PHP_VERSION )
            ) )
        );
    }
}

/**
 * Initializes the Plugin
 * @since 1.0.0
 */
function trad_turbo_addons_pro() {
    return TRAD_Turbo_Addons_Pro::instance();
}

trad_turbo_addons_pro();