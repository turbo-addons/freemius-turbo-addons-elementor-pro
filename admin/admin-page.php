<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Enqueue necessary styles and scripts
function turbo_addons_pro_admin_enqueue_styles_scripts() {
    wp_enqueue_style(
        'taep-admin-style',
        TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/css/admin-style.css',
        [],
        filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'admin/assets/css/admin-style.css' ),
        'all'
    );
    wp_enqueue_script(
        'taep-admin-script',
        TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/js/admin-script.js',
        [ 'jquery' ],
        filemtime( TRAD_TURBO_ADDONS_PRO_PLUGIN_PATH . 'admin/assets/js/admin-script.js' ),
        true
    );
}
add_action( 'admin_enqueue_scripts', 'turbo_addons_pro_admin_enqueue_styles_scripts' );

// Function to render the admin page
function turbo_addons_pro_admin_page() {
    ?>

    <!-- ---------------------- Pro Dashboard top banner ------------------------------------>
    <div id="taep-dashboard-navbar">
        <div class="taep-dashboard-top-banner-container">
            <div class="taep-dashboard-top-banner-container-60">
                <p style="font-size:18px">
                    <strong>Turbo Addons Pro</strong> is active! You have access to <strong>45+ premium widgets</strong>, full WooCommerce support, and 200+ ready-made templates.
                </p>
                <p style="font-size:18px;">
                    Need help? Visit our
                    <a class="taep-dashboard-top-message-button" href="https://turbo-addons.com/docs/" target="_blank">
                        Documentation
                    </a>
                    &nbsp;or&nbsp;
                    <a class="taep-dashboard-top-message-button" href="https://turbo-addons.com/get-support/" target="_blank">
                        Get Support
                    </a>
                </p>
            </div>
            <div class="taep-dashboard-top-banner-container-40">
                <a href="https://turbo-addons.com/widgets/" target="_blank" rel="noopener noreferrer" style="text-decoration:none;">
                    <img style="width:100%" class="taep-dashboard-banner-add"
                        src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/banner-1544x500.png' ); ?>"
                        alt="<?php echo esc_attr( 'Turbo Addons Pro Banner' ); ?>">
                </a>
            </div>
        </div>
    </div>

    <!-- ---------------------- Pro Dashboard tab section ----------------------------------->
    <div class="taep-wrap-dashboard taep-addons-dashboard">
        <?php
        $current_tab = isset( $_POST['current_tab'] ) ? sanitize_text_field( wp_unslash( $_POST['current_tab'] ) ) : 'general-tab';
        ?>

        <div class="taep-addons-sidebar" id="taep-addons-sidebar-menu">
            <ul class="taep-turbo-dashboard-menu-list">
                <li class="taep-tab-link tab-link active" data-tab="general-tab">
                    <a href="#"><?php esc_html_e( 'Dashboard', 'turbo-addons-elementor-pro' ); ?></a>
                </li>
                <li class="taep-tab-link tab-link" data-tab="elements-free-tab">
                    <a href="#"><?php esc_html_e( 'Elements Free', 'turbo-addons-elementor-pro' ); ?></a>
                </li>
                <li class="taep-tab-link tab-link" data-tab="elements-pro-tab">
                    <a href="#"><?php esc_html_e( 'Elements Pro', 'turbo-addons-elementor-pro' ); ?></a>
                </li>
                <li class="taep-tab-link tab-link" data-tab="extension-tab">
                    <a href="#"><?php esc_html_e( 'Extension', 'turbo-addons-elementor-pro' ); ?></a>
                </li>
                <li class="taep-tab-link tab-link" data-tab="premium-tab">
                    <a href="#"><?php esc_html_e( 'Go Premium', 'turbo-addons-elementor-pro' ); ?></a>
                </li>
            </ul>
        </div>

        <div class="taep-addons-content" id="taep-addons-content-details">

            <!-- ==================================================== Tab 1 — Dashboard ================================= -->
            <!-- ========================================================================================================= -->
            <div id="general-tab" class="taep-tab-content tab-content taep-dashboard-tab <?php echo $current_tab === 'general-tab' ? 'active' : ''; ?>">

                <!-- Section 1: What's New + New Templates -->
                <div class="taep-dashboard-sec-one">
                    <div class="taep-dashboard-sec-one-left">
                        <h3 class="taep-dashboard-sub-heading"><?php esc_html_e( "What's New in Version 1.3.4", 'turbo-addons-elementor-pro' ); ?></h3>
                        <hr>
                        <div class="taep-updated-list">
                            <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turbo-logo-update.webp' ); ?>" alt="<?php echo esc_attr( 'update icon' ); ?>">
                            <div class="taep-updated-list-typography">
                                <h4><?php esc_html_e( 'Added Pro Widgets', 'turbo-addons-elementor-pro' ); ?></h4>
                                <p><?php esc_html_e( 'WhatsApp Chat, Image Hotspot, Off-Canvas, Advanced Search Pro', 'turbo-addons-elementor-pro' ); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="taep-updated-list">
                            <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turbo-logo-update.webp' ); ?>" alt="<?php echo esc_attr( 'update icon' ); ?>">
                            <div class="taep-updated-list-typography">
                                <h4><?php esc_html_e( 'WooCommerce Support', 'turbo-addons-elementor-pro' ); ?></h4>
                                <p><?php esc_html_e( 'Full custom single product page builder with 15+ Woo widgets.', 'turbo-addons-elementor-pro' ); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="taep-updated-list">
                            <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turbo-logo-update.webp' ); ?>" alt="<?php echo esc_attr( 'update icon' ); ?>">
                            <div class="taep-updated-list-typography">
                                <h4><?php esc_html_e( 'Updated', 'turbo-addons-elementor-pro' ); ?></h4>
                                <p><?php esc_html_e( 'Tested and verified for full compatibility with Elementor 4.0.2', 'turbo-addons-elementor-pro' ); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="taep-updated-list">
                            <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turbo-logo-update.webp' ); ?>" alt="<?php echo esc_attr( 'update icon' ); ?>">
                            <div class="taep-updated-list-typography">
                                <h4><?php esc_html_e( 'Updated', 'turbo-addons-elementor-pro' ); ?></h4>
                                <p><?php esc_html_e( 'Tested and verified for full compatibility with Elementor 4.0.2', 'turbo-addons-elementor-pro' ); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- //-----------------------tomorrow work rest--------------------------- -->

                    <div class="taep-dashboard-sec-one-right">
                        <h3 class="taep-dashboard-sub-heading"><?php esc_html_e( 'Latest Template Added', 'turbo-addons-elementor-pro' ); ?></h3>
                        <hr>
                        <?php
                        // Fetch latest template from API — cached for 12 hours
                        $cache_key      = 'taep_latest_template_v1';
                        $template_data  = get_transient( $cache_key );

                        if ( false === $template_data ) {
                            $response = wp_remote_get(
                                'https://mt.turbo-addons.com/api/ta/v1/latest-template',
                                [ 'timeout' => 8, 'sslverify' => true ]
                            );

                            if ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) {
                                $body          = wp_remote_retrieve_body( $response );
                                $template_data = json_decode( $body, true );
                                if ( is_array( $template_data ) && ! empty( $template_data['name'] ) ) {
                                    set_transient( $cache_key, $template_data, 12 * HOUR_IN_SECONDS );
                                } else {
                                    $template_data = null;
                                }
                            } else {
                                $template_data = null;
                            }
                        }

                        if ( ! empty( $template_data ) ) :
                            $tpl_name     = sanitize_text_field( $template_data['name']     ?? '' );
                            $tpl_category = sanitize_text_field( $template_data['category'] ?? '' );
                            $tpl_type     = sanitize_text_field( $template_data['type']     ?? '' );
                            $tpl_preview  = esc_url( $template_data['preview'] ?? '#' );
                            $tpl_thumb    = esc_url( $template_data['thumb']   ?? '' );
                            $tpl_is_pro   = ( isset( $template_data['pro'] ) && $template_data['pro'] === 'on' );
                        ?>
                        <div class="taep-latest-template-card">

                            <!-- LEFT: tall portrait thumbnail -->
                            <?php if ( $tpl_thumb ) : ?>
                            <div class="taep-latest-template-thumb-wrap">
                                <img src="<?php echo $tpl_thumb; ?>"
                                     alt="<?php echo esc_attr( $tpl_name ); ?>"
                                     class="taep-latest-template-thumb">
                                <?php if ( $tpl_is_pro ) : ?>
                                <span class="taep-template-pro-badge"><?php esc_html_e( 'PRO', 'turbo-addons-elementor-pro' ); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>

                            <!-- RIGHT: info -->
                            <div class="taep-latest-template-info">
                                <div class="taep-latest-template-meta">
                                    <?php if ( $tpl_category ) : ?>
                                    <span class="taep-template-badge taep-template-badge-category">
                                        <?php echo esc_html( ucfirst( $tpl_category ) ); ?>
                                    </span>
                                    <?php endif; ?>
                                    <?php if ( $tpl_type ) : ?>
                                    <span class="taep-template-badge taep-template-badge-type">
                                        <?php echo esc_html( ucfirst( $tpl_type ) ); ?>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <h4 class="taep-latest-template-name"><?php echo esc_html( $tpl_name ); ?></h4>
                                <p class="taep-latest-template-desc">
                                    <?php
                                    printf(
                                        /* translators: %s: template name */
                                        esc_html__( 'A brand-new "%s" template is now available in the Turbo Addons template library. Import it in one click and go live faster.', 'turbo-addons-elementor-pro' ),
                                        esc_html( $tpl_name )
                                    );
                                    ?>
                                </p>
                                <div class="taep-latest-template-actions">
                                    <a href="<?php echo $tpl_preview; ?>" target="_blank" rel="noopener" class="taep-template-btn taep-template-btn-preview">
                                        <?php esc_html_e( 'Live Preview ⤴', 'turbo-addons-elementor-pro' ); ?>
                                    </a>
                                    <a href="https://turbo-addons.com/templates/" target="_blank" rel="noopener" class="taep-template-btn taep-template-btn-all">
                                        <?php esc_html_e( 'All Templates', 'turbo-addons-elementor-pro' ); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php else : ?>
                        <!-- Fallback when API is unreachable -->
                        <div class="taep-latest-template-fallback">
                            <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/comming_BANNER.gif' ); ?>"
                                 alt="<?php echo esc_attr( 'Turbo Addons Pro' ); ?>"
                                 style="width:100%;border-radius:8px;">
                            <div class="taep-dashboard-center-btn" style="margin-top:12px;">
                                <a href="https://turbo-addons.com/templates/" target="_blank" rel="noopener">
                                    <?php esc_html_e( 'Explore All Templates ⤴', 'turbo-addons-elementor-pro' ); ?>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Section 2: Review CTA -->
                <div class="taep-review-cta-wrap">
                    <!-- left decorative blob -->
                    <div class="taep-review-cta-blob taep-review-cta-blob-left"></div>
                    <!-- right decorative blob -->
                    <div class="taep-review-cta-blob taep-review-cta-blob-right"></div>

                    <div class="taep-review-cta-inner">
                        <!-- star row -->
                        <div class="taep-review-stars" aria-label="5 stars">
                            <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
                        </div>

                        <h3 class="taep-review-cta-title">
                            <?php esc_html_e( 'Loving Turbo Addons Pro?', 'turbo-addons-elementor-pro' ); ?>
                        </h3>
                        <p class="taep-review-cta-desc">
                            <?php esc_html_e( "Your review helps thousands of WordPress users discover Turbo Addons. It takes 30 seconds and means the world to us.", 'turbo-addons-elementor-pro' ); ?>
                        </p>

                        <div class="taep-review-cta-actions">
                            <a href="https://wordpress.org/plugins/turbo-addons-elementor/#reviews"
                               target="_blank" rel="noopener"
                               class="taep-review-btn taep-review-btn-primary">
                                &#9733;&nbsp;<?php esc_html_e( 'Leave a Review', 'turbo-addons-elementor-pro' ); ?>
                            </a>
                            <a href="https://turbo-addons.com/get-support/"
                               target="_blank" rel="noopener"
                               class="taep-review-btn taep-review-btn-ghost">
                                <?php esc_html_e( 'Need Help?', 'turbo-addons-elementor-pro' ); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Docs / Widgets / Support cards -->
                <div class="taep-dashboard-sec-four">
                    <div class="taep-dashboard-sec-four-card">
                        <h3 class="taep-dashboard-sub-heading"><?php esc_html_e( 'Documentation', 'turbo-addons-elementor-pro' ); ?></h3>
                        <p><?php esc_html_e( 'Everything you need to get started with Turbo Addons Pro — guides, widget references, and how-tos.', 'turbo-addons-elementor-pro' ); ?></p>
                        <img class="taep-dashboard-banner-add"
                            src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turbo-logo.png' ); ?>"
                            alt="<?php echo esc_attr( 'documentation' ); ?>">
                        <div class="taep-dashboard-center-btn">
                            <a href="https://turbo-addons.com/docs/" target="_blank" rel="noopener">
                                <?php esc_html_e( 'Documentation ⤴', 'turbo-addons-elementor-pro' ); ?>
                            </a>
                        </div>
                    </div>
                    <div class="taep-dashboard-sec-four-card">
                        <h3 class="taep-dashboard-sub-heading"><?php esc_html_e( 'Explore 45+ Pro Widgets', 'turbo-addons-elementor-pro' ); ?></h3>
                        <p><?php esc_html_e( 'Discover a powerful collection of 45+ premium widgets designed for advanced functionality and creativity.', 'turbo-addons-elementor-pro' ); ?></p>
                        <img class="taep-dashboard-banner-add"
                            src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turboFile.png' ); ?>"
                            alt="<?php echo esc_attr( 'pro widgets' ); ?>">
                        <div class="taep-dashboard-center-btn">
                            <a href="https://turbo-addons.com/widgets/" target="_blank" rel="noopener">
                                <?php esc_html_e( 'Explore ⤴', 'turbo-addons-elementor-pro' ); ?>
                            </a>
                        </div>
                    </div>
                    <div class="taep-dashboard-sec-four-card">
                        <h3 class="taep-dashboard-sub-heading"><?php esc_html_e( 'Get Support', 'turbo-addons-elementor-pro' ); ?></h3>
                        <p><?php esc_html_e( 'Get expert guidance, instant support, and personalized insights to troubleshoot issues and achieve your goals.', 'turbo-addons-elementor-pro' ); ?></p>
                        <img class="taep-dashboard-banner-add"
                            src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turbo-logo-white.png' ); ?>"
                            alt="<?php echo esc_attr( 'support' ); ?>">
                        <div class="taep-dashboard-center-btn">
                            <a href="https://turbo-addons.com/get-support/" target="_blank" rel="noopener">
                                <?php esc_html_e( 'Get Support ⤴', 'turbo-addons-elementor-pro' ); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================== Tab 2 — Elements Free ========================================= -->
            <!-- ========================================================================================================== -->
            <div id="elements-free-tab" class="taep-tab-content tab-content taep-dashboard-elements-tab <?php echo $current_tab === 'elements-free-tab' ? 'active' : ''; ?>">
                <div class="taep-widgets-section">
                    <form method="post" action="#">
                        <?php
                        wp_nonce_field( 'save_turbo_addons_widgets', 'turbo_addons_nonce' );

                        if ( isset( $_POST['save_free_changes'] ) ) {
                            if ( ! isset( $_POST['turbo_addons_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['turbo_addons_nonce'] ) ), 'save_turbo_addons_widgets' ) ) {
                                wp_die( esc_html__( 'Nonce verification failed. Please try again.', 'turbo-addons-elementor-pro' ) );
                            }
                            $widgets = isset( $_POST['widgets'] ) && is_array( $_POST['widgets'] ) ? array_map( 'sanitize_key', wp_unslash( $_POST['widgets'] ) ) : [];
                            update_option( 'turbo_addons_widgets', $widgets );
                            echo '<div class="taep-alert-updated-div updated">
                                <p>' . esc_html__( 'Free widgets saved successfully.', 'turbo-addons-elementor-pro' ) . '</p>
                                <button class="taep-alert-dismiss-button" type="button">&times;</button>
                            </div>';
                        }

                        // Pull free widget data via free plugin helper
                        $widget_data       = Turbo_Addons\Helper::get_the_widget_lists();
                        $widgets           = $widget_data['widgets'];
                        $all_widgets       = $widget_data['all_widgets'];
                        $widget_categories = $widget_data['widget_categories'];

                        echo '<div class="taep-widget-tabs-container">';

                        // Sticky filter bar
                        echo '<div class="taep-dashboard-elements-tab-wraper">';
                        echo '<ul class="taep-widget-tabs-list">';
                        $tab_count = 0;
                        foreach ( $widget_categories as $category => $widgets_in_category ) {
                            echo '<li class="taep-widget-filter-tab-item" data-tab="taep-widget-tab' . esc_attr( $tab_count ) . '">' . esc_html( $category ) . '</li>';
                            $tab_count++;
                        }
                        echo '</ul>';

                        echo '<div class="taep-dashboard-select-widget-btn">';
                        echo '<label>';
                        echo '<input type="checkbox" id="taep-select-all-free-widgets" />';
                        echo '<span>' . esc_html__( 'Select All', 'turbo-addons-elementor-pro' ) . '</span>';
                        echo '</label>';
                        echo '</div>';
                        echo '</div>'; // .taep-dashboard-elements-tab-wraper

                        // Tab content
                        echo '<div class="taep-widget-tabs-content">';
                        $tab_count = 0;
                        foreach ( $widget_categories as $category => $widgets_in_category ) {
                            echo '<div class="taep-widget-tab-content" id="taep-widget-tab' . esc_attr( $tab_count ) . '">';
                            echo '<h3>' . esc_html( $category ) . '</h3>';
                            echo '<div class="taep-widget-list">';
                            foreach ( $widgets_in_category as $widget_key ) {
                                $is_active = in_array( $widget_key, $widgets );
                                ?>
                                <div class="taep-widget-card">
                                    <label class="taep-elements-tab-icon-text">
                                        <input type="checkbox" class="taep-widget-checkbox taep-dashboard-toggle-switch" name="widgets[]" value="<?php echo esc_attr( $widget_key ); ?>" <?php checked( $is_active ); ?> />
                                        <span class="taep-dashboard-toggle-slider"></span>
                                        <span class="taep-dashboard-widget-label"><?php echo esc_html( $all_widgets[ $widget_key ] ?? $widget_key ); ?></span>
                                    </label>
                                </div>
                                <?php
                            }
                            echo '</div>'; // .taep-widget-list
                            echo '</div>'; // .taep-widget-tab-content
                            $tab_count++;
                        }
                        echo '</div>'; // .taep-widget-tabs-content
                        echo '</div>'; // .taep-widget-tabs-container
                        ?>
                        <input type="hidden" id="current_tab" name="current_tab" value="<?php echo esc_attr( ! empty( $current_tab ) ? $current_tab : 'general-tab' ); ?>">
                        <div class="taep-tab-filter-save-btn">
                            <input type="submit" name="save_free_changes" class="button taep-dashboard-elements-btn-submit" value="<?php esc_attr_e( 'Save Changes', 'turbo-addons-elementor-pro' ); ?>" />
                        </div>
                    </form>
                </div>
            </div>

            <!-- ================================================ Tab 3 — Elements Pro ==================================== -->
             <!-- ========================================================================================================= -->
            <div id="elements-pro-tab" class="taep-tab-content tab-content taep-dashboard-elements-tab <?php echo $current_tab === 'elements-pro-tab' ? 'active' : ''; ?>">
                <div class="taep-widgets-section">
                    <form method="post" action="#">
                        <?php
                        wp_nonce_field( 'save_turbo_addons_pro_widgets', 'turbo_addons_pro_nonce' );

                        if ( isset( $_POST['save_pro_changes'] ) ) {
                            if ( ! isset( $_POST['turbo_addons_pro_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['turbo_addons_pro_nonce'] ) ), 'save_turbo_addons_pro_widgets' ) ) {
                                wp_die( esc_html__( 'Nonce verification failed. Please try again.', 'turbo-addons-elementor-pro' ) );
                            }
                            $widgets_pro = isset( $_POST['widgets_pro'] ) && is_array( $_POST['widgets_pro'] ) ? array_map( 'sanitize_key', wp_unslash( $_POST['widgets_pro'] ) ) : [];
                            update_option( 'turbo_pro_addons_widgets', $widgets_pro );
                            echo '<div class="taep-alert-updated-div updated">
                                <p>' . esc_html__( 'Pro widgets saved successfully.', 'turbo-addons-elementor-pro' ) . '</p>
                                <button class="taep-alert-dismiss-button" type="button">&times;</button>
                            </div>';
                        }

                        // Pull pro widget data
                        $pro_data            = Pro_Helper_Widgets_Class::get_the_pro_widget_lists();
                        $widgets_pro         = $pro_data['widgets_pro'];
                        $all_pro_widgets     = $pro_data['all_pro_widgets'];
                        $widget_pro_categories = $pro_data['widget_pro_categories'];

                        echo '<div class="taep-widget-tabs-container">';

                        // Sticky filter bar
                        echo '<div class="taep-dashboard-elements-tab-wraper">';
                        echo '<ul class="taep-widget-tabs-list">';
                        $tab_count = 0;
                        foreach ( $widget_pro_categories as $category => $widgets_in_category ) {
                            echo '<li class="taep-widget-filter-tab-item" data-tab="taep-pro-widget-tab' . esc_attr( $tab_count ) . '">' . esc_html( $category ) . '</li>';
                            $tab_count++;
                        }
                        echo '</ul>';

                        echo '<div class="taep-dashboard-select-widget-btn">';
                        echo '<label>';
                        echo '<input type="checkbox" id="taep-select-all-pro-widgets" />';
                        echo '<span>' . esc_html__( 'Select All', 'turbo-addons-elementor-pro' ) . '</span>';
                        echo '</label>';
                        echo '</div>';
                        echo '</div>'; // .taep-dashboard-elements-tab-wraper

                        // Tab content
                        echo '<div class="taep-widget-tabs-content">';
                        $tab_count = 0;
                        foreach ( $widget_pro_categories as $category => $widgets_in_category ) {
                            echo '<div class="taep-widget-tab-content" id="taep-pro-widget-tab' . esc_attr( $tab_count ) . '">';
                            echo '<h3>' . esc_html( $category ) . '</h3>';
                            echo '<div class="taep-widget-list">';
                            foreach ( $widgets_in_category as $widget_key ) {
                                $is_active = in_array( $widget_key, $widgets_pro );
                                ?>
                                <div class="taep-widget-card">
                                    <label class="taep-elements-tab-icon-text">
                                        <input type="checkbox" class="taep-pro-widget-checkbox taep-dashboard-toggle-switch" name="widgets_pro[]" value="<?php echo esc_attr( $widget_key ); ?>" <?php checked( $is_active ); ?> />
                                        <span class="taep-dashboard-toggle-slider"></span>
                                        <span class="taep-dashboard-widget-label"><?php echo esc_html( $all_pro_widgets[ $widget_key ] ?? $widget_key ); ?></span>
                                    </label>
                                </div>
                                <?php
                            }
                            echo '</div>'; // .taep-widget-list
                            echo '</div>'; // .taep-widget-tab-content
                            $tab_count++;
                        }
                        echo '</div>'; // .taep-widget-tabs-content
                        echo '</div>'; // .taep-widget-tabs-container
                        ?>
                        <input type="hidden" id="current_tab" name="current_tab" value="<?php echo esc_attr( ! empty( $current_tab ) ? $current_tab : 'general-tab' ); ?>">
                        <div class="taep-tab-filter-save-btn">
                            <input type="submit" name="save_pro_changes" class="button taep-dashboard-elements-btn-submit" value="<?php esc_attr_e( 'Save Changes', 'turbo-addons-elementor-pro' ); ?>" />
                        </div>
                    </form>
                </div>
            </div>

            <!-- ============================================== Tab 4 — Extension ========================================= -->
            <!-- ========================================================================================================== -->
            <div id="extension-tab" class="taep-tab-content tab-content taep-dashboard-extension-tab <?php echo $current_tab === 'extension-tab' ? 'active' : ''; ?>">
                <div class="taep-widgets-section">
                    <form method="post" action="#">
                        <?php
                        wp_nonce_field( 'save_turbo_addons_pro_extensions_action', 'taep_extensions_nonce' );

                        if ( isset( $_POST['save_pro_extensions'] ) ) {
                            if ( ! isset( $_POST['taep_extensions_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['taep_extensions_nonce'] ) ), 'save_turbo_addons_pro_extensions_action' ) ) {
                                wp_die( esc_html__( 'Nonce verification failed. Please try again.', 'turbo-addons-elementor-pro' ) );
                            }
                            $extensions = isset( $_POST['extensions'] ) && is_array( $_POST['extensions'] ) ? array_map( 'sanitize_key', wp_unslash( $_POST['extensions'] ) ) : [];
                            update_option( 'turbo_addons_extensions', $extensions );
                            $current_tab = 'extension-tab';
                            echo '<div class="taep-alert-updated-div updated">
                                <p>' . esc_html__( 'Extensions saved successfully.', 'turbo-addons-elementor-pro' ) . '</p>
                                <button class="taep-alert-dismiss-button" type="button">&times;</button>
                            </div>';
                        }

                        // Pull extension data from free plugin helper
                        $extension_data = Turbo_Addons\Helper::get_the_extension_lists();
                        $extensions     = $extension_data['extensions'];
                        $all_extensions = $extension_data['all_extensions'];

                        echo '<div class="taep-widget-tabs-container">';

                        echo '<div class="taep-dashboard-elements-tab-wraper">';
                        echo '<ul class="taep-widget-tabs-list">';
                        echo '<li class="taep-widget-filter-tab-item active">' . esc_html__( 'Available Extensions', 'turbo-addons-elementor-pro' ) . '</li>';
                        echo '</ul>';

                        echo '<div class="taep-dashboard-select-widget-btn">';
                        echo '<label>';
                        echo '<input type="checkbox" id="taep-select-all-extensions" />';
                        echo '<span>' . esc_html__( 'Select All', 'turbo-addons-elementor-pro' ) . '</span>';
                        echo '</label>';
                        echo '</div>';
                        echo '</div>'; // .taep-dashboard-elements-tab-wraper

                        echo '<div class="taep-widget-tabs-content">';
                        echo '<div class="taep-widget-tab-content active" id="taep-extension-tab">';
                        echo '<div class="taep-widget-list">';

                        if ( ! empty( $all_extensions ) ) {
                            foreach ( $all_extensions as $key => $label ) {
                                $is_active = in_array( $key, $extensions, true );
                                ?>
                                <div class="taep-widget-card">
                                    <label class="taep-elements-tab-icon-text">
                                        <input type="checkbox" class="taep-extension-checkbox taep-dashboard-toggle-switch"
                                            name="extensions[]"
                                            value="<?php echo esc_attr( $key ); ?>"
                                            <?php checked( $is_active ); ?> />
                                        <span class="taep-dashboard-toggle-slider"></span>
                                        <span class="taep-dashboard-widget-label"><?php echo esc_html( $label ); ?></span>
                                    </label>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p>' . esc_html__( 'No extensions found. Please ensure the free plugin is active.', 'turbo-addons-elementor-pro' ) . '</p>';
                        }

                        echo '</div>'; // .taep-widget-list
                        echo '</div>'; // .taep-widget-tab-content
                        echo '</div>'; // .taep-widget-tabs-content
                        echo '</div>'; // .taep-widget-tabs-container
                        ?>
                        <input type="hidden" id="current_tab" name="current_tab" value="extension-tab">
                        <div class="taep-tab-filter-save-btn">
                            <input type="submit" name="save_pro_extensions" class="button taep-dashboard-elements-btn-submit" value="<?php esc_attr_e( 'Save Changes', 'turbo-addons-elementor-pro' ); ?>" />
                        </div>
                    </form>
                </div>
            </div>

            <!-- ======================================================= Tab 5 — Go Premium ============================================= -->
            <!-- ======================================================================================================================== -->
            <div id="premium-tab" class="taep-tab-content tab-content taep-dashboard-premium-tab <?php echo $current_tab === 'premium-tab' ? 'active' : ''; ?>">
                <div class="taep-header-section">
                    <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/banner-1544x500.png' ); ?>"
                        alt="<?php echo esc_attr( 'Turbo Addons Pro Banner' ); ?>"
                        style="width:100%; border-radius:10px;">
                    <div class="taep-dashboard-pro-tabs-top" style="margin-top:30px;">
                        <h2><?php esc_html_e( 'Elevate Your Elementor Experience', 'turbo-addons-elementor-pro' ); ?></h2>
                        <h1>
                            <?php esc_html_e( "Thank you for upgrading to PRO! Now enjoy ", 'turbo-addons-elementor-pro' ); ?>
                            <span style="color:#aa0088"><?php esc_html_e( '45+ premium PRO widgets', 'turbo-addons-elementor-pro' ); ?></span>
                            <?php esc_html_e( ' along with 50+ high-quality free widgets — almost everything you need to make your website stand out!', 'turbo-addons-elementor-pro' ); ?>
                        </h1>
                        <p><?php esc_html_e( 'With Turbo Addons Pro, you gain access to powerful, flexible tools tailored for creatives, marketers, and businesses alike.', 'turbo-addons-elementor-pro' ); ?></p>
                        <a href="https://turbo-addons.com" target="_blank" rel="noopener">
                            <button class="taep-dashboard-pro-tabs-top-btn"><?php esc_html_e( 'Visit Turbo Addons', 'turbo-addons-elementor-pro' ); ?></button>
                        </a>
                    </div>
                </div>
                <div class="taep-widgets-section"></div>
            </div>

        </div><!-- .taep-addons-content -->
    </div><!-- .taep-wrap-dashboard -->
    <?php
}

// Register the admin menu
function turbo_addons_pro_add_admin_menu() {
    $icon_url = esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turbo-icon.png' );
    add_menu_page(
        'Turbo Addons Pro',
        'Turbo Addons Pro',
        'manage_options',
        'turbo_addons_pro',
        'turbo_addons_pro_admin_page',
        $icon_url,
        21
    );
}
add_action( 'admin_menu', 'turbo_addons_pro_add_admin_menu' );
