<?php
/**
 * Pro Template Library Enhancer
 * Extends the free plugin's template library with pro-specific enhancements
 * 
 * @package Turbo Addons Elementor Pro
 * @since 1.9.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Ensure free plugin's template library is loaded and working
 * Add any pro-specific enhancements here
 */
class TRAD_Pro_Template_Enhancer {

    public static function init() {
        // Hook into free plugin's template library if it exists
        if ( class_exists( '\Elementor\TemplateLibrary\TRAD_Turbo_Template_Import_Library' ) ) {
            // Pro enhancements can be added here
            add_filter( 'trad_template_filter_args', [ __CLASS__, 'enhance_pro_template_args' ] );
        }
    }

    /**
     * Enhance template arguments for pro users
     */
    public static function enhance_pro_template_args( $args ) {
        // Add pro-specific enhancements if needed
        return $args;
    }
}

// Initialize only if free plugin is active
if ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'turbo-addons-elementor/turbo-addons-elementor.php' ) ) {
    add_action( 'plugins_loaded', [ 'TRAD_Pro_Template_Enhancer', 'init' ] );
}
