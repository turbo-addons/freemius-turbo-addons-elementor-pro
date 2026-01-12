<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue necessary styles and scripts
function turbo_addons_admin_enqueue_styles_scripts() {
    wp_enqueue_style('turbo-addons-admin-style', plugin_dir_url(__FILE__) . 'assets/css/admin-style.css', array(), '1.0.0');
    wp_enqueue_script('turbo-addons-admin-script', plugin_dir_url(__FILE__) . 'assets/js/admin-script.js', array('jquery'), '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'turbo_addons_admin_enqueue_styles_scripts');

// Function to render the admin page
function turbo_addons_pro_admin_page() {
    ?>
    <div id="turbo-dashboard-navbar">
        <div>
        <img class="turbo-dashboard-navbar-logo" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'assets/images/turbo-logo.png' ); ?>" alt="<?php echo esc_attr( 'turbo-logo' ); ?>">
        </div>
        <div>
            <input type="checkbox" id="turbo-dashboard-navbar-theme-input">
            <label for="turbo-dashboard-navbar-theme-input" id="turbo-dashboard-navbar-theme-label">
                <span>
                    <img id="turbo-dashboard-navbar-theme-sun" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'assets/images/sun.png' ); ?>" alt="<?php echo esc_attr( 'sun-icon' ); ?>">
                </span>
                <span>
                    <img id="turbo-dashboard-navbar-theme-moon" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'assets/images/moon.png' ); ?>" alt="<?php echo esc_attr( 'moon-icon' ); ?>">
                </span>
            </label>
        </div>
    </div>

    <div class="trad_wrap_dashboard turbo-addons-dashboard">
        <?php 
            $current_tab = isset($_POST['current_tab']) ? sanitize_text_field(wp_unslash($_POST['current_tab'])) : 'general-tab'; 
        ?>

        <div class="turbo-addons-sidebar" id="turbo-addons-sidebar-menu">
            <ul class="trad-turbo-dashboard-menu-list">
                <li class="trad-tab-link tab-link active" data-tab="general-tab"><a href="#"><?php esc_html_e('General', 'turbo-addons-elementor-pro'); ?></a></li>
                <li class="trad-tab-link tab-link" data-tab="elements-tab"><a href="#"><?php esc_html_e('Elements Free', 'turbo-addons-elementor-pro'); ?></a></li>
                <li class="trad-tab-link tab-link" data-tab="elements-pro-tab"><a href="#"><?php esc_html_e('Elements Pro', 'turbo-addons-elementor-pro'); ?></a></li>
                <li class="trad-tab-link tab-link" data-tab="extension-tab"><a href="#"><?php esc_html_e('Extension', 'turbo-addons-elementor-pro'); ?></a></li>
                <li class="trad-tab-link tab-link" data-tab="premium-tab"><a href="#"><?php esc_html_e('Go Premium', 'turbo-addons-elementor-pro'); ?></a></li>
            </ul>
        </div> 


        <div class="turbo-addons-content" id="turbo-addons-content-details">


            <!-- ==tab1======================General Tab Content
             ============================================================================== -->
             <div id="general-tab" class="trad-tab-content tab-content trad-dashboard-tab <?php echo $current_tab === 'general-tab' ? 'active' : ''; ?>">
                <div class="trad-dashboard-tab-general-wraper">
                <div class="trad-dashboard-tab-general-left" 
                style=
                "background-image: url('<?php echo esc_url(plugin_dir_url(__FILE__) . 'assets/images/fourcolorbg.png'); ?>');
                 background-position:center-center;
                 background-size:cover;
                 background-repeat:none;
                ">
                        <div class="trad-header-section trad-general-p">
                            <h1><?php esc_html_e(" What's New In Turbo Addons Pro?", 'turbo-addons-elementor-pro'); ?></h1>
                            <p>☞ Added 2 New Widgets</p>
                            <p>☞ Updated Template Library</p> 
                            <p>☞ Improved UI</p> 
                            <div class="trad-widgets-section">
                                <a href="https://wordpress.org/plugins/turbo-addons-elementor/#developers" target="_blank"> <button>See the changelog</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="trad-dashboard-tab-general-right">
                        <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . 'assets/images/comming_BANNER.gif'); ?>" alt="<?php echo esc_attr('Banner of coming soon'); ?>"> 
                        <a href="https://turbo-addons.com/widgets/" target="blank">
                            <button class="trad-dashboard-general-tabs-top-btn" >View Pro</button> 
                        </a>
                    </div>
                </div>
            </div>

            <!-- ====tab-2============================Elements Tab Content
             ================================================================================ -->
            <div id="elements-tab" class="trad-tab-content tab-content trad-dashboard-elements-tab <?php echo $current_tab === 'elements-tab' ? 'active' : ''; ?>" 
                style=
                "background-image: url('<?php echo esc_url(plugin_dir_url(__FILE__) . 'assets/images/fourcolorbg.png'); ?>');
                 background-position:center-center;
                 background-size:cover;
                 background-repeat:none;
                ">
                <div class="trad-header-section">
                    <h1><?php esc_html_e('Elements', 'turbo-addons-elementor-pro'); ?></h1>
                    <p>Essential elements to structure and style your website. Easily add headings, text, images, buttons, and more with full customization to match your brand.</p>
                </div>
                <div class="trad-widgets-section">
                    <h2><?php esc_html_e('Manage Widgets', 'turbo-addons-elementor-pro'); ?></h2>
                    <!-- Master Checkbox -->
                    <label>
                        <input type="checkbox" id="select-all-free-widgets" />
                        <span><?php esc_html_e('Select All', 'turbo-addons-elementor-pro'); ?></span>
                    </label>
                    <form method="post" action="">
                        <?php
                        wp_nonce_field('save_turbo_addons_widgets', 'turbo_addons_nonce');
                        // Check if the form was submitted
                        if (isset($_POST['save_changes'])) {

                            // Verify nonce to ensure the form submission is secure
                            if (!isset($_POST['turbo_addons_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['turbo_addons_nonce'])), 'save_turbo_addons_widgets')) {
                                wp_die(esc_html__('Nonce verification failed. Please try again.', 'turbo-addons-elementor-pro'));
                            }
            
                            // Apply your line after nonce verification
                            $widgets = isset($_POST['widgets']) && is_array($_POST['widgets']) ? array_map('sanitize_text_field', wp_unslash($_POST['widgets'])) : [];
                        
                            update_option('turbo_addons_widgets', $widgets);
                            echo '<div class="trad-alert-updated-div updated">
                                <p>' . esc_html__('Settings saved.', 'turbo-addons-elementor-pro') . '</p>
                                <button class="trad-alert-dismiss-button" type="button">×</button>
                            </div>';

                        }
                        // Retrieve the current widget settings
                        $widget_data = Turbo_Addons_Pro\Pro_Helper::get_the_free_widget_lists();
                        $widgets = $widget_data['widgets'];
                        $all_widgets = $widget_data['all_widgets'];
                        $widget_categories = $widget_data['widget_categories'];

                        // Display the widgets in categories
                        echo '<div class="trad-widget-tabs-container-pro">'; // Added container for sticky styling
                        echo '<ul class="trad-widget-tabs-list-pro">'; // Tab list
                        $tab_count = 0; // For generating unique tab IDs
                        foreach ($widget_categories as $category => $widgets_in_category) {
                            echo '<li class="trad-widget-tab-item-pro" data-tab="trad-widget-tab-pro' .  esc_attr( $tab_count ). '">' . esc_html($category) . '</li>';
                            $tab_count++;
                        }
                        echo '</ul>'; // Close tab list
                        
                        // Generate the tab content
                        echo '<div class="trad-widget-tabs-content-pro">'; // Updated tab content container class
                        $tab_count = 0; // Reset for content
                        foreach ($widget_categories as $category => $widgets_in_category) {
                            echo '<div class="trad-widget-tab-content-pro" id="trad-widget-tab-pro' .  esc_attr( $tab_count ) . '">'; // Updated tab content class
                            echo '<h3>' . esc_html($category) . '</h3>';
                            echo '<div class="trad-widget-list-pro">'; // List of widgets in the category
                        
                            foreach ($widgets_in_category as $widget_key) {
                                $is_active = in_array($widget_key, $widgets);
                                ?>
                                <div class="trad-widget-card">
                                    <label class="trad-elements-tab-icon-text">
                                        <input type="checkbox" class="widget-checkbox" name="widgets[]" value="<?php echo esc_attr($widget_key); ?>" <?php checked($is_active); ?> />
                                        <span><?php echo esc_html($all_widgets[$widget_key] ?? $widget_key); ?></span> <!-- Display widget name -->
                                    </label>
                                </div>
                                <?php
                            }
                        
                            echo '</div>'; // Close widget list
                            echo '</div>'; // Close tab-content
                            $tab_count++;
                        }
                        echo '</div>'; // Close tabs-content
                        
                        echo '</div>'; // Close widget tabs wrapper


                        ?>
                        <input type="hidden" id="current_tab" name="current_tab" value="<?php echo esc_attr(!empty($current_tab) ? $current_tab : 'general-tab'); ?>">

                        <div class="trad-tab-filter-save-btn-pro trad-tfb">
                            <input type="submit" name="save_changes" class="button trad-dashboard-elements-btn-submit " value="<?php esc_attr_e('Save Changes', 'turbo-addons-elementor-pro'); ?>" />
                    </div>
                    </form>
                </div>
            </div>

            <!-- ====tab-3============================Pro Elements Tab Content
             ================================================================================ -->
             <div id="elements-pro-tab" class="trad-tab-content tab-content trad-dashboard-elements-tab <?php echo $current_tab === 'elements-pro-tab' ? 'active' : ''; ?>" 
                style=
                "background-image: url('<?php echo esc_url(plugin_dir_url(__FILE__) . 'assets/images/fourcolorbg.png'); ?>');
                 background-position:center-center;
                 background-size:cover;
                 background-repeat:none;
                ">
                <div class="trad-header-section">
                    <h1><?php esc_html_e('Pro Elements', 'turbo-addons-elementor-pro'); ?></h1>
                    <p>Essential Pro elements to structure and style your website. Easily add headings, text, images, buttons, and more with full customization to match your brand.</p>
                </div>
                <div class="trad-widgets-section">
                    <h2><?php esc_html_e('Manage Pro Widgets', 'turbo-addons-elementor-pro'); ?></h2>
                    <form method="post" action="">
                        <?php
                        wp_nonce_field('save_turbo_addons_pro_widgets', 'turbo_addons_nonce');
                        // Check if the form was submitted
                        if (isset($_POST['save_pro_changes'])) {
                            // Verify nonce to ensure the form submission is secure
                            if (!isset($_POST['turbo_addons_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['turbo_addons_nonce'])), 'save_turbo_addons_pro_widgets')) {
                                wp_die(esc_html__('Nonce verification failed. Please try again.', 'turbo-addons-elementor-pro'));
                            }
                            // Apply your line after nonce verification
                            $widgets_pro = isset($_POST['widgets_pro']) && is_array($_POST['widgets_pro']) ? array_map('sanitize_text_field', wp_unslash($_POST['widgets_pro'])) : [];
                        
                            update_option('turbo_pro_addons_widgets', $widgets_pro);
                            echo '<div class="trad-alert-updated-div updated">
                                <p>' . esc_html__('Settings saved.', 'turbo-addons-elementor-pro') . '</p>
                                <button class="trad-alert-dismiss-button" type="button">×</button>
                            </div>';
                        }
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
                                'Post-filter-tab',
                                'pricing-table-pro',
                                'image-scrolling_animatin-vr',
                                'hero-slider',
                                'tuor-guide',
                                'pdf-flip-book',
                                'woo-product-card',
                                'text-gradient',
                                'visitor-count',
                                'word-count',
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
                            'timeline-story'        => 'Time Line / Road Map',  
                            'progress-bar'          => 'Progress Bar',  
                            'review-template'       => 'Review Template',  
                            'testimonial'           => 'Testimonial Slider',   
                            'three-d-flip-box'      => '3D Flip Box',  
                            'polygon3Dcarousel'     => '3D Carousel', 
                            'turbo-date-time'       => 'Local Date', 
                            'turbo-post-date'       => 'Post Date', 
                            'post-category'         => ' Post Category',
                            'list-icon'             => 'Icon List',
                            'advance-featured-card' => 'Advance Featured Card',
                            'post-list'             => 'Post List',
                            'post-filter-tab'       => 'Post Filter Tab',
                            'image-scrolling_animatin-vr'  => 'Image Vertical Scrolling',
                            'pricing-table-pro'     => 'Pricing Table Pro',
                            'hero-slider'           => 'Hero Slider',
                            'tuor-guide'            => 'Tour Guide',
                            'pdf-flip-book'         => 'PDF Flip Book',
                            'woo-product-card'      => 'Woo Products Card',
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
                
                        ];
                        // $widget_pro_data = Turbo_Addons_Pro\Pro_Helper_Widgets_Class::get_the_pro_widget_lists();
                        // $widgets_pro = $widget_pro_data['widgets_pro'];
                        // $all_pro_widgets = $widget_pro_data['all_pro_widgets'];
                        // $widget_pro_categories = $widget_pro_data['widget_pro_categories'];
                        // Display the widgets
                        echo '<div class="trad-widgets-grid">';
                        foreach ($all_pro_widgets as $widget_pro_key => $widget_pro_name) {
                            $is_active_pro = in_array($widget_pro_key, $widgets_pro);
                            ?>
                            <div class="trad-widget-card">
                                <label class="trad-elements-tab-icon-text">
                                    <input type="checkbox" name="widgets_pro[]" value="<?php echo esc_attr($widget_pro_key); ?>" <?php checked($is_active_pro); ?> />
                                    <span><?php echo esc_html($widget_pro_name); ?></span>
                                </label>
                            </div>
                            <?php
                        }
                        echo '</div>';
                        ?>
                        <input type="hidden" id="current_tab" name="current_tab" value="<?php echo esc_attr(!empty($current_tab) ? 'elements-pro-tab' : 'general-tab'); ?>">
                        <p>
                            <input type="submit" name="save_pro_changes" class="button trad-dashboard-elements-btn-submit " value="<?php esc_attr_e('Save Changes', 'turbo-addons-elementor-pro'); ?>" />
                        </p>
                    </form>
                </div>
            </div>


            <!-- ======tab-4/// ========================================Extension tabs=========================
            ====================================================================================================-->                      
            <div id="extension-tab" class="trad-tab-content tab-content trad-dashboard-elements-tab <?php echo $current_tab === 'extension-tab' ? 'active' : ''; ?>"
                style="
                    background-image: url('<?php echo esc_url(plugin_dir_url(__FILE__) . 'assets/images/fourcolorbg.png'); ?>');
                    background-position:center-center;
                    background-size:cover;
                    background-repeat:no-repeat;
                ">
                
                <!-- Header section -->
                <div class="trad-header-section">
                    <h1><?php esc_html_e('Extensions', 'turbo-addons-elementor-pro'); ?></h1>
                    <p>
                        Powerful extra modules that enhance Elementor and Turbo Addons Pro.  
                        Enable only what you need for better performance.
                    </p>
                </div>

                <div class="trad-widgets-section">
                    <h2><?php esc_html_e('Manage Extensions', 'turbo-addons-elementor-pro'); ?></h2>

                    <!-- Master Select All -->
                    <label>
                        <input type="checkbox" id="select-all-pro-extensions" />
                        <span><?php esc_html_e('Select All', 'turbo-addons-elementor-pro'); ?></span>
                    </label>

                    <form method="post" action="">
                        <?php
                        // ✅ Nonce for security
                        wp_nonce_field('save_turbo_addons_pro_extensions', 'turbo_addons_pro_extensions_nonce');

                        // ✅ Handle save
                        if (isset($_POST['save_pro_extensions'])) {

                            // Nonce verify
                            if (
                                !isset($_POST['turbo_addons_pro_extensions_nonce']) ||
                                !wp_verify_nonce(
                                    sanitize_text_field(wp_unslash($_POST['turbo_addons_pro_extensions_nonce'])),
                                    'save_turbo_addons_pro_extensions'
                                )
                            ) {
                                wp_die(esc_html__('Nonce verification failed. Please try again.', 'turbo-addons-elementor-pro'));
                            }

                            // Sanitize & save
                            $extensions = isset($_POST['extensions']) && is_array($_POST['extensions'])
                                ? array_map('sanitize_key', wp_unslash($_POST['extensions']))
                                : [];

                            // ✅ Save in same option as free plugin
                            update_option('turbo_addons_extensions', $extensions);

                            // Keep tab active
                            $current_tab = 'extension-tab';

                            echo '<div class="trad-alert-updated-div updated">
                                    <p>' . esc_html__('Extensions saved successfully.', 'turbo-addons-elementor-pro') . '</p>
                                    <button class="trad-alert-dismiss-button" type="button">×</button>
                                </div>';
                        }

                        // ✅ Retrieve extensions from Free Plugin Helper
                        $extension_data = \Turbo_Addons_Pro\Pro_Helper::get_the_pro_extension_lists();
                        $extensions     = isset($extension_data['extensions']) ? $extension_data['extensions'] : [];
                        $all_extensions = isset($extension_data['all_extensions']) ? $extension_data['all_extensions'] : [];

                        echo '<div class="trad-widget-tabs-container-pro">';

                        // Content wrapper
                        echo '<div class="trad-widget-tabs-content-pro">';
                        echo '<div class="trad-widget-tab-content-pro active" id="trad-extension-tab-pro">';
                        echo '<div class="trad-widget-list-pro">';

                        // Loop through extensions (from free plugin)
                        if (!empty($all_extensions)) {
                            foreach ($all_extensions as $key => $label) {
                                $is_active = in_array($key, $extensions, true);
                                ?>
                                <div class="trad-widget-card">
                                    <label class="trad-elements-tab-icon-text">
                                        <input type="checkbox" class="pro-extension-checkbox" name="extensions[]" 
                                            value="<?php echo esc_attr($key); ?>" <?php checked($is_active); ?> />
                                        <span><?php echo esc_html($label); ?></span>
                                    </label>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p>' . esc_html__('No extensions found. Please ensure the free plugin is active.', 'turbo-addons-elementor-pro') . '</p>';
                        }

                        echo '</div>'; // .trad-widget-list-pro
                        echo '</div>'; // .trad-widget-tab-content-pro
                        echo '</div>'; // .trad-widget-tabs-content-pro
                        echo '</div>'; // .trad-widget-tabs-container-pro
                        ?>

                        <!-- keep current tab -->
                        <input type="hidden" id="current_tab_pro_extensions" name="current_tab" value="extension-tab">

                        <div class="trad-tab-filter-save-btn-pro trad-tfb">
                            <input type="submit" name="save_pro_extensions" 
                                class="button trad-dashboard-elements-btn-submit" 
                                value="<?php esc_attr_e('Save Changes', 'turbo-addons-elementor-pro'); ?>" />
                        </div>
                    </form>
                </div>

            </div>

            <!-- ======tab-5/// ========================================Premium tabs=========================
             ====================================================================================================-->

            <div id="premium-tab" class="trad-tab-content tab-content trad-dashboard-premium-tab <?php echo $current_tab === 'premium-tab' ? 'active' : ''; ?>"
                style=
                    "background-image: url('<?php echo esc_url(plugin_dir_url(__FILE__) . 'assets/images/fourcolorbg.png'); ?>');
                    background-position:center-center;
                    background-size:cover;
                    background-repeat:none;
                ">
                <div class="trad-header-section">
                    <div class="trad-dashboard-pro-tabs-top">
                        <h2>
                            Elevate Your Elementor Experience
                        </h2>
                        <h1>
                            Thank you for upgrading to PRO! <br/> Now, enjoy <span style="color:#aa0088"> 20+ premium PRO features </span> <br/> along with 45 high-quality free widgets <br/> — almost everything you need to make your website stand out!
                        </h1>
                        <p>
                            With Turbo Addons, you’ll gain access to powerful, flexible tools tailored for creatives, marketers, and businesses alike. Supercharge your Elementor toolkit and bring your ideas to life like never before!
                        </p>
                        <a href="https://turbo-addons.com" target="blank">
                           <button class="trad-dashboard-pro-tabs-top-btn" >Turbo Addons</button> 
                        </a>
                    </div>
                </div>


                <div class="trad-widgets-section">
                    
                </div>
            </div>

            <!-- Add other tab contents like 'extension-tab', 'tools-tab', 'integrations-tab', and 'premium-tab' similarly -->

        </div>
    </div>
    <?php
}
// Function to safely construct the URL for the icon
function safe_url($url) {
    return esc_url($url); // Use WordPress's esc_url() to sanitize the URL
}

// Register the admin menu
function turbo_addons_add_admin_menu() {
    $icon_url = safe_url(plugin_dir_url(__FILE__) . 'assets/images/turbo-icon.png');
    add_menu_page(
        'Turbo Addons Pro',
        'Turbo Addons Pro',
        'manage_options',
        'turbo_addons_pro',
        'turbo_addons_pro_admin_page',
        $icon_url,
        20
    );
}
add_action('admin_menu', 'turbo_addons_add_admin_menu');
