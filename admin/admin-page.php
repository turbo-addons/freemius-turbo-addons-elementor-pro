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
    // Pass AJAX url + nonce to JS for realtime template polling
    wp_localize_script( 'taep-admin-script', 'taepAdmin', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'taep_fetch_template' ),
    ] );
}
add_action( 'admin_enqueue_scripts', 'turbo_addons_pro_admin_enqueue_styles_scripts' );

// ── AJAX handler: fetch latest template fresh from API (no cache) ──────────────
function taep_ajax_fetch_latest_template() {
    check_ajax_referer( 'taep_fetch_template', 'nonce' );

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized', 403 );
    }

    $response = wp_remote_get(
        'https://mt.turbo-addons.com/api/ta/v1/latest-template',
        [ 'timeout' => 8, 'sslverify' => true ]
    );

    if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
        wp_send_json_error( 'API unreachable' );
    }

    $data = json_decode( wp_remote_retrieve_body( $response ), true );

    // API now returns an array of templates
    if ( ! is_array( $data ) || empty( $data ) ) {
        wp_send_json_error( 'Invalid response' );
    }

    // Normalise: accept both array-of-objects and single object
    $templates = isset( $data[0] ) ? $data : [ $data ];

    // Use first item's title as the cache pointer key
    $first = $templates[0];
    if ( empty( $first['title'] ) && empty( $first['name'] ) ) {
        wp_send_json_error( 'Invalid response' );
    }

    // Update the pointer + data transients so next PHP render is also fresh
    $pointer_key  = 'taep_tpl_pointer_v1';
    $data_key_pfx = 'taep_tpl_data_';
    $new_pointer  = md5( $first['title'] ?? $first['name'] );
    set_transient( $data_key_pfx . $new_pointer, $templates, 6 * HOUR_IN_SECONDS );
    set_transient( $pointer_key, $new_pointer, 1 * HOUR_IN_SECONDS );

    wp_send_json_success( $templates );
}
add_action( 'wp_ajax_taep_fetch_latest_template', 'taep_ajax_fetch_latest_template' );

// Function to render the admin page
function turbo_addons_pro_admin_page() {
    ?>

    <!-- ---------------------- Pro Dashboard top banner ------------------------------------>
    <div id="taep-dashboard-navbar">
        <!-- left glow blob -->
        <div class="taep-navbar-blob taep-navbar-blob-l"></div>
        <!-- right glow blob -->
        <div class="taep-navbar-blob taep-navbar-blob-r"></div>

        <div class="taep-navbar-inner">

            <!-- LEFT: branding + headline -->
            <div class="taep-navbar-brand">
                <div>
                     <div class="taep-navbar-tagline">
                        <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turbo-logo-white.png' ); ?>"
                            alt="Turbo Addons Pro"
                            class="taep-navbar-logo">
                        <span class="taep-navbar-pro-pill"><?php esc_html_e( 'PRO', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                     </div>
                     <span class="taep-navbar-headline"><?php esc_html_e( 'You\'re on the Pro plan — unlock everything.', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                </div>
                
            </div>

            <!-- CENTER: stat chips -->
            <div class="taep-navbar-stats">
                <div class="taep-stat-chip">
                    <span class="taep-stat-num">45+</span>
                    <span class="taep-stat-lbl"><?php esc_html_e( 'Pro Widgets', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                </div>
                <div class="taep-stat-divider"></div>
                <div class="taep-stat-chip">
                    <span class="taep-stat-num">200+</span>
                    <span class="taep-stat-lbl"><?php esc_html_e( 'Templates', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                </div>
                <div class="taep-stat-divider"></div>
                <div class="taep-stat-chip">
                    <span class="taep-stat-num">WooCommerce</span>
                    <span class="taep-stat-lbl"><?php esc_html_e( 'Full Support', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                </div>
            </div>

            <!-- RIGHT: CTA buttons -->
            <div class="taep-navbar-ctas">
                <a href="https://turbo-addons.com/docs/" target="_blank" rel="noopener"
                   class="taep-navbar-btn taep-navbar-btn-ghost">
                    📄 <?php esc_html_e( 'Docs', 'freemius-turbo-addons-elementor-pro' ); ?>
                </a>
                <a href="https://turbo-addons.com/get-support/" target="_blank" rel="noopener"
                   class="taep-navbar-btn taep-navbar-btn-solid">
                    💬 <?php esc_html_e( 'Get Support', 'freemius-turbo-addons-elementor-pro' ); ?>
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
                    <a href="#"><?php esc_html_e( 'Dashboard', 'freemius-turbo-addons-elementor-pro' ); ?></a>
                </li>
                <li class="taep-tab-link tab-link" data-tab="elements-free-tab">
                    <a href="#"><?php esc_html_e( 'Elements Free', 'freemius-turbo-addons-elementor-pro' ); ?></a>
                </li>
                <li class="taep-tab-link tab-link" data-tab="elements-pro-tab">
                    <a href="#"><?php esc_html_e( 'Elements Pro', 'freemius-turbo-addons-elementor-pro' ); ?></a>
                </li>
                <li class="taep-tab-link tab-link" data-tab="extension-tab">
                    <a href="#"><?php esc_html_e( 'Extension', 'freemius-turbo-addons-elementor-pro' ); ?></a>
                </li>
                <!-- <li class="taep-tab-link tab-link" data-tab="premium-tab">
                    <a href="#"><?php esc_html_e( 'Go Premium', 'freemius-turbo-addons-elementor-pro' ); ?></a>
                </li> -->
            </ul>
        </div>

        <div class="taep-addons-content" id="taep-addons-content-details">

            <!-- ==================================================== Tab 1 — Dashboard ================================= -->
            <!-- ========================================================================================================= -->
            <div id="general-tab" class="taep-tab-content tab-content taep-dashboard-tab <?php echo $current_tab === 'general-tab' ? 'active' : ''; ?>">

                <!-- ---------------------------Section 1: What's New + New Templates ----------------->
                <div class="taep-dashboard-sec-one">
                    <div class="taep-dashboard-sec-one-left">
                        <h3 class="taep-dashboard-sub-heading"><?php esc_html_e( "What's New in Version 1.9.0", 'freemius-turbo-addons-elementor-pro' ); ?></h3>
                        <hr>
                        <div class="taep-updated-list">
                            <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turbo-logo-update.webp' ); ?>" alt="<?php echo esc_attr( 'update icon' ); ?>">
                            <div class="taep-updated-list-typography">
                                <h4><?php esc_html_e( 'Added Pro Widgets', 'freemius-turbo-addons-elementor-pro' ); ?></h4>
                                <p><?php esc_html_e( 'WhatsApp Chat, Image Hotspot, Off-Canvas, Advanced Search Pro, CSV Table Builder', 'freemius-turbo-addons-elementor-pro' ); ?></p>
                            </div>
                        </div>
                        <hr>

                        <div class="taep-updated-list">
                            <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turbo-logo-update.webp' ); ?>" alt="<?php echo esc_attr( 'update icon' ); ?>">
                            <div class="taep-updated-list-typography">
                                <h4><?php esc_html_e( 'WooCommerce Support', 'freemius-turbo-addons-elementor-pro' ); ?></h4>
                                <p><?php esc_html_e( 'Full custom single product page builder with 15+ WooCommerce widgets.', 'freemius-turbo-addons-elementor-pro' ); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="taep-updated-list">
                            <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turbo-logo-update.webp' ); ?>" alt="<?php echo esc_attr( 'update icon' ); ?>">
                            <div class="taep-updated-list-typography">
                                <h4><?php esc_html_e( 'New Templates', 'freemius-turbo-addons-elementor-pro' ); ?></h4>
                                <p><?php esc_html_e( 'Added 5 new modern templates - Sports, Degital Service, Vehicle etc.  ', 'freemius-turbo-addons-elementor-pro' ); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="taep-updated-list">
                            <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turbo-logo-update.webp' ); ?>" alt="<?php echo esc_attr( 'update icon' ); ?>">
                            <div class="taep-updated-list-typography">
                                <h4><?php esc_html_e( 'Updated', 'freemius-turbo-addons-elementor-pro' ); ?></h4>
                                <p><?php esc_html_e( 'Tested and verified for full compatibility with Elementor 4.1.2', 'freemius-turbo-addons-elementor-pro' ); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="taep-dashboard-sec-one-right">
                        <?php
                        // ── Cache key ──────────────────────────────────────────────────────────
                        $api_url        = 'https://mt.turbo-addons.com/api/ta/v1/latest-template';
                        $pointer_key    = 'taep_tpl_pointer_v1';
                        $data_key_pfx   = 'taep_tpl_data_';

                        // ── Fetch / serve from cache ───────────────────────────────────────────
                        $templates     = null;
                        $cached_pointer = get_transient( $pointer_key );
                        if ( $cached_pointer ) {
                            $templates = get_transient( $data_key_pfx . $cached_pointer );
                        }

                        if ( empty( $templates ) ) {
                            $response = wp_remote_get( $api_url, [ 'timeout' => 8, 'sslverify' => true ] );
                            if ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) {
                                $decoded = json_decode( wp_remote_retrieve_body( $response ), true );
                                if ( is_array( $decoded ) && ! empty( $decoded ) ) {
                                    // Accept both array-of-objects and single object
                                    $templates   = isset( $decoded[0] ) ? $decoded : [ $decoded ];
                                    $first       = $templates[0];
                                    $new_pointer = md5( $first['title'] ?? $first['name'] ?? 'turbo' );
                                    set_transient( $data_key_pfx . $new_pointer, $templates, 6 * HOUR_IN_SECONDS );
                                    set_transient( $pointer_key, $new_pointer, 1 * HOUR_IN_SECONDS );
                                }
                            }
                        }
                        ?>

                        <!-- Panel header -->
                        <div class="taep-template-panel-header">
                            <div class="taep-template-panel-header-left">
                                <span class="taep-live-dot"></span>
                                <span class="taep-live-label"><?php esc_html_e( 'New', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                <h3 class="taep-dashboard-sub-heading"><?php esc_html_e( 'Templates Added', 'freemius-turbo-addons-elementor-pro' ); ?></h3>
                            </div>
                            <a href="#watch-guide-video" class="taep-how-to-btn taep-scroll-to-video">
                                <span class="taep-how-to-ring">
                                    <span class="taep-how-to-play"></span>
                                </span>
                                <span class="taep-how-to-text">
                                    <span class="taep-how-to-label"><?php esc_html_e( 'How to Use', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                    <span class="taep-how-to-sub"><?php esc_html_e( 'Watch tutorial', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                </span>
                            </a>
                        </div>
                        <hr>

                        <?php if ( ! empty( $templates ) ) :
                            // Sanitise all items
                            $tpl_items = [];
                            foreach ( $templates as $tpl ) {
                                $tpl_items[] = [
                                    'title'    => sanitize_text_field( $tpl['title']       ?? $tpl['name']    ?? '' ),
                                    'desc'     => sanitize_text_field( $tpl['description'] ?? '' ),
                                    'category' => sanitize_text_field( $tpl['category']    ?? '' ),
                                    'type'     => sanitize_text_field( $tpl['type']        ?? '' ),
                                    'batch'    => sanitize_text_field( $tpl['batch']       ?? $tpl['pro'] ?? '' ),
                                    'link'     => esc_url( $tpl['link']    ?? $tpl['preview'] ?? '#' ),
                                    'thumb'    => esc_url( $tpl['thumb']   ?? '' ),
                                ];
                            }
                            $first_tpl = $tpl_items[0];
                        ?>

                        <!-- Template slider card -->
                        <div class="taep-tpl-slider-card" id="taep-template-card">

                            <!-- LEFT: image slider -->
                            <div class="taep-tpl-slider-left">
                                <div class="taep-tpl-slides" id="taep-tpl-slides">
                                    <?php foreach ( $tpl_items as $idx => $tpl ) : ?>
                                    <div class="taep-tpl-slide <?php echo $idx === 0 ? 'active' : ''; ?>"
                                         data-index="<?php echo esc_attr( $idx ); ?>">
                                        <img src="<?php echo esc_url( $tpl['thumb'] ); ?>"
                                             alt="<?php echo esc_attr( $tpl['title'] ); ?>"
                                             class="taep-tpl-slide-img">
                                        <?php if ( strtoupper( $tpl['batch'] ) === 'PRO' || $tpl['batch'] === 'on' ) : ?>
                                        <span class="taep-template-pro-badge">PRO</span>
                                        <?php endif; ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Dot indicators -->
                                <?php if ( count( $tpl_items ) > 1 ) : ?>
                                <div class="taep-tpl-dots" id="taep-tpl-dots">
                                    <?php foreach ( $tpl_items as $idx => $tpl ) : ?>
                                    <button class="taep-tpl-dot <?php echo $idx === 0 ? 'active' : ''; ?>"
                                            data-index="<?php echo esc_attr( $idx ); ?>"
                                            aria-label="<?php echo esc_attr( $tpl['title'] ); ?>"></button>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- RIGHT: dynamic info (updates with slide) -->
                            <div class="taep-latest-template-info" id="taep-tpl-info">
                                <div class="taep-latest-template-meta" id="taep-tpl-meta">
                                    <?php if ( $first_tpl['category'] ) : ?>
                                    <span class="taep-template-badge taep-template-badge-category" id="taep-tpl-category">
                                        <?php echo esc_html( ucfirst( $first_tpl['category'] ) ); ?>
                                    </span>
                                    <?php endif; ?>
                                    <?php if ( $first_tpl['type'] ) : ?>
                                    <span class="taep-template-badge taep-template-badge-type" id="taep-tpl-type">
                                        <?php echo esc_html( ucfirst( $first_tpl['type'] ) ); ?>
                                    </span>
                                    <?php endif; ?>
                                </div>

                                <h4 class="taep-latest-template-name" id="taep-tpl-name">
                                    <?php echo esc_html( $first_tpl['title'] ); ?>
                                </h4>

                                <p class="taep-latest-template-desc" id="taep-tpl-desc">
                                    <?php 
                                    echo esc_html( $first_tpl['desc'] ?: sprintf(
                                        /* translators: %s: Template title. */
                                        __( 'A brand-new "%s" template is now available. Import it in one click and go live faster.', 'freemius-turbo-addons-elementor-pro' ),
                                        $first_tpl['title']
                                    ) ); ?>
                                </p>

                                <!-- Slide counter -->
                                <?php if ( count( $tpl_items ) > 1 ) : ?>
                                <div class="taep-tpl-counter">
                                    <span id="taep-tpl-current">1</span>
                                    <span class="taep-tpl-counter-sep">/</span>
                                    <span id="taep-tpl-total"><?php echo count( $tpl_items ); ?></span>
                                    <span class="taep-tpl-counter-label"><?php esc_html_e( 'templates', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                </div>
                                <?php endif; ?>

                                <div class="taep-latest-template-actions">
                                    <a href="<?php echo esc_url( $first_tpl['link'] ); ?>" target="_blank" rel="noopener"
                                       class="taep-template-btn taep-template-btn-preview" id="taep-tpl-preview-btn">
                                        <?php esc_html_e( 'Live Preview ⤴', 'freemius-turbo-addons-elementor-pro' ); ?>
                                    </a>
                                    <a href="https://turbo-addons.com/templates/" target="_blank" rel="noopener"
                                       class="taep-template-btn taep-template-btn-all">
                                        <?php esc_html_e( 'All Templates', 'freemius-turbo-addons-elementor-pro' ); ?>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Pass all template data to JS -->
                        <script>
                        window.taepTemplates = <?php echo wp_json_encode( $tpl_items ); ?>;
                        </script>

                        <?php else : ?>
                        <div class="taep-latest-template-fallback">
                            <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/banner-1544x500.png' ); ?>"
                                 alt="Turbo Addons Pro" style="width:100%;border-radius:8px;">
                            <div class="taep-dashboard-center-btn" style="margin-top:12px;">
                                <a href="https://turbo-addons.com/templates/" target="_blank" rel="noopener">
                                    <?php esc_html_e( 'Explore All Templates ⤴', 'freemius-turbo-addons-elementor-pro' ); ?>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ----------------------------Section 2: Review CTA --------------------------------->
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
                            <?php esc_html_e( 'Loving Turbo Addons Pro?', 'freemius-turbo-addons-elementor-pro' ); ?>
                        </h3>
                        <p class="taep-review-cta-desc">
                            <?php esc_html_e( "Your review helps thousands of WordPress users discover Turbo Addons. It takes 30 seconds and means the world to us.", 'freemius-turbo-addons-elementor-pro' ); ?>
                        </p>

                        <div class="taep-review-cta-actions">
                            <a href="https://wordpress.org/plugins/turbo-addons-elementor/#reviews"
                               target="_blank" rel="noopener"
                               class="taep-review-btn taep-review-btn-primary">
                                &#9733;&nbsp;<?php esc_html_e( 'Leave a Review', 'freemius-turbo-addons-elementor-pro' ); ?>
                            </a>
                            <a href="https://turbo-addons.com/get-support/"
                               target="_blank" rel="noopener"
                               class="taep-review-btn taep-review-btn-ghost">
                                <?php esc_html_e( 'Need Help?', 'freemius-turbo-addons-elementor-pro' ); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ---------------------------Section 3: Three info cards ---------------------------->
                <div class="taep-info-cards-grid">
                    <!-- ── Card 1: Support & Documentation ── -->
                    <div class="taep-info-card taep-info-card--support">
                        <div class="taep-info-card-icon-wrap taep-info-card-icon-wrap--blue">
                            <span class="taep-info-card-icon">📚</span>
                        </div>
                        <div class="taep-info-card-body">
                            <h3 class="taep-info-card-title"><?php esc_html_e( 'Docs & Support', 'freemius-turbo-addons-elementor-pro' ); ?></h3>
                            <p class="taep-info-card-desc"><?php esc_html_e( 'Everything you need — step-by-step guides, widget references, video tutorials, and a dedicated support team ready to help.', 'freemius-turbo-addons-elementor-pro' ); ?></p>
                            <ul class="taep-info-card-list">
                                <li>✅ <?php esc_html_e( 'Full widget documentation', 'freemius-turbo-addons-elementor-pro' ); ?></li>
                                <li>✅ <?php esc_html_e( 'Video tutorials', 'freemius-turbo-addons-elementor-pro' ); ?></li>
                                <li>✅ <?php esc_html_e( 'Priority Pro support', 'freemius-turbo-addons-elementor-pro' ); ?></li>
                            </ul>
                        </div>
                        <div class="taep-info-card-footer">
                            <a href="https://turbo-addons.com/docs/" target="_blank" rel="noopener" class="taep-info-card-btn taep-info-card-btn--primary">
                                <?php esc_html_e( 'Read Docs', 'freemius-turbo-addons-elementor-pro' ); ?> →
                            </a>
                            <a href="https://turbo-addons.com/get-support/" target="_blank" rel="noopener" class="taep-info-card-btn taep-info-card-btn--ghost">
                                <?php esc_html_e( 'Get Support', 'freemius-turbo-addons-elementor-pro' ); ?>
                            </a>
                        </div>
                    </div>

                    <!-- ── Card 2: Pro Features Highlight ── -->
                    <div class="taep-info-card taep-info-card--features">
                        <div class="taep-info-card-gradient-header">
                            <span class="taep-info-card-badge"><?php esc_html_e( 'PRO EXCLUSIVE', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                            <h3 class="taep-info-card-title taep-info-card-title--light"><?php esc_html_e( 'What Makes Pro Special', 'freemius-turbo-addons-elementor-pro' ); ?></h3>
                        </div>
                        <div class="taep-info-card-body">
                            <div class="taep-feature-chips">
                                <span class="taep-feature-chip">🛒 <?php esc_html_e( 'WooCommerce Builder', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                <span class="taep-feature-chip">🎠 <?php esc_html_e( '3D Carousel', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                <span class="taep-feature-chip">📄 <?php esc_html_e( 'PDF Flip Book', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                <span class="taep-feature-chip">🗺️ <?php esc_html_e( 'Tour Guide', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                <span class="taep-feature-chip">🔍 <?php esc_html_e( 'Advanced Search', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                <span class="taep-feature-chip">💬 <?php esc_html_e( 'WhatsApp Chat', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                <span class="taep-feature-chip">🎯 <?php esc_html_e( 'Image Hotspot', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                <span class="taep-feature-chip">📊 <?php esc_html_e( 'Dynamic Table', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                <span class="taep-feature-chip">🦸 <?php esc_html_e( 'Hero Slider', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                            </div>
                        </div>
                        <div class="taep-info-card-footer">
                            <a href="https://turbo-addons.com/widgets/" target="_blank" rel="noopener" class="taep-info-card-btn taep-info-card-btn--purple">
                                <?php esc_html_e( 'Explore All Widgets', 'freemius-turbo-addons-elementor-pro' ); ?> →
                            </a>
                        </div>
                    </div>

                    <!-- ── Card 3: Our Other Plugins ── -->
                    <div class="taep-info-card taep-info-card--plugins">
                        <div class="taep-info-card-body">
                            <h3 class="taep-info-card-title"><?php esc_html_e( 'More From Our Team', 'freemius-turbo-addons-elementor-pro' ); ?></h3>
                            <p class="taep-info-card-desc"><?php esc_html_e( 'Free plugins built by the same team — trusted by thousands of WordPress users.', 'freemius-turbo-addons-elementor-pro' ); ?></p>

                            <div class="taep-plugin-list">

                                <a href="https://wordpress.org/plugins/header-footer-builder-for-elementor/" target="_blank" rel="noopener" class="taep-plugin-item">
                                    <div class="taep-plugin-icon taep-plugin-icon--green">
                                        <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/handficon.gif' ); ?>"
                                        alt="<?php echo esc_attr( 'Turbo Addons Pro' ); ?>"
                                        style="width:100%;border-radius:8px;">
                                    </div>
                                    <div class="taep-plugin-info">
                                        <strong><?php esc_html_e( 'Header Footer Builder', 'freemius-turbo-addons-elementor-pro' ); ?></strong>
                                        <span><?php esc_html_e( 'Custom headers & footers for Elementor', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                    </div>
                                    <span class="taep-plugin-arrow">→</span>
                                </a>

                                <a href="https://wordpress.org/plugins/turbo-templates-library-for-elementor/" target="_blank" rel="noopener" class="taep-plugin-item">
                                    <div class="taep-plugin-icon taep-plugin-icon--blue">
                                        <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/turbo-temlates-lib-plug-ic.webp' ); ?>"
                                        alt="<?php echo esc_attr( 'Turbo Addons Pro' ); ?>"
                                        style="width:100%;border-radius:8px;">
                                    </div>
                                    <div class="taep-plugin-info">
                                        <strong><?php esc_html_e( 'Turbo Templates Library', 'freemius-turbo-addons-elementor-pro' ); ?></strong>
                                        <span><?php esc_html_e( '200+ ready-made Elementor templates', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                    </div>
                                    <span class="taep-plugin-arrow">→</span>
                                </a>

                                <a href="https://wordpress.org/plugins/whitespace-fixer-for-xml-sitemap/" target="_blank" rel="noopener" class="taep-plugin-item">
                                    <div class="taep-plugin-icon taep-plugin-icon--orange">
                                        <img src="<?php echo esc_url( TRAD_TURBO_ADDONS_PRO_PLUGIN_URL . 'admin/assets/images/trwhite_space_fix.webp' ); ?>"
                                        alt="<?php echo esc_attr( 'Turbo Addons Pro' ); ?>"
                                        style="width:100%;border-radius:8px;">
                                    </div>
                                    <div class="taep-plugin-info">
                                        <strong><?php esc_html_e( 'Whitespace Fixer for XML Sitemap', 'freemius-turbo-addons-elementor-pro' ); ?></strong>
                                        <span><?php esc_html_e( 'Fix XML sitemap whitespace errors instantly', 'freemius-turbo-addons-elementor-pro' ); ?></span>
                                    </div>
                                    <span class="taep-plugin-arrow">→</span>
                                </a>

                            </div>
                        </div>
                    </div>

                </div>

                 <!-- ----------------------------Section 4: Watch Video --------------------------------->
                <div class="taep-guide-video-wrap" id="watch-guide-video">

                    <!-- left blob -->
                    <div class="taep-video-blob taep-video-blob-l"></div>
                    <!-- right blob -->
                    <div class="taep-video-blob taep-video-blob-r"></div>

                    <div class="taep-video-inner">

                    <!-- LEFT: text -->
                    <div class="taep-video-text">
                        <span class="taep-video-eyebrow">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="vertical-align:middle;margin-right:5px;">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            <?php esc_html_e( 'Video Tutorial', 'freemius-turbo-addons-elementor-pro' ); ?>
                        </span>
                            <h2 class="taep-video-title">
                                <?php esc_html_e( 'Get Started in Minutes', 'freemius-turbo-addons-elementor-pro' ); ?>
                            </h2>
                            <p class="taep-video-desc">
                                <?php esc_html_e( 'Watch this quick walkthrough to learn how to set up Turbo Addons Pro, activate widgets, import and customize templates, and build stunning pages — no coding needed.', 'freemius-turbo-addons-elementor-pro' ); ?>
                            </p>
                            <ul class="taep-video-checklist">
                                <li>✅ <?php esc_html_e( 'Activate & configure Pro widgets', 'freemius-turbo-addons-elementor-pro' ); ?></li>
                                <li>✅ <?php esc_html_e( 'Import ready-made templates', 'freemius-turbo-addons-elementor-pro' ); ?></li>
                                <li>✅ <?php esc_html_e( 'How to prepare header & footer', 'freemius-turbo-addons-elementor-pro' ); ?></li>
                            </ul>
                            <a href="https://www.youtube.com/@TurboAddons" target="_blank" rel="noopener" class="taep-video-channel-btn">
                                <?php esc_html_e( 'Visit Our YouTube Channel ⤴', 'freemius-turbo-addons-elementor-pro' ); ?>
                            </a>
                        </div>

                        <!-- RIGHT: YouTube iframe embed -->
                        <div class="taep-video-frame-wrap">
                            <div class="taep-video-frame-glow"></div>
                            <div class="taep-video-frame">
                                <iframe
                                    src="https://www.youtube.com/embed/Z5v6LXkcWLo?rel=0&modestbranding=1"
                                    title="<?php esc_attr_e( 'Turbo Addons Pro — How to Use', 'freemius-turbo-addons-elementor-pro' ); ?>"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    loading="lazy">
                                </iframe>
                            </div>
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
                                wp_die( esc_html__( 'Nonce verification failed. Please try again.', 'freemius-turbo-addons-elementor-pro' ) );
                            }
                            $widgets = isset( $_POST['widgets'] ) && is_array( $_POST['widgets'] ) ? array_map( 'sanitize_key', wp_unslash( $_POST['widgets'] ) ) : [];
                            update_option( 'turbo_addons_widgets', $widgets );
                            echo '<div class="taep-alert-updated-div updated">
                                <p>' . esc_html__( 'Free widgets saved successfully.', 'freemius-turbo-addons-elementor-pro' ) . '</p>
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
                        echo '<span>' . esc_html__( 'Select All', 'freemius-turbo-addons-elementor-pro' ) . '</span>';
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
                            <input type="submit" name="save_free_changes" class="button taep-dashboard-elements-btn-submit" value="<?php esc_attr_e( 'Save Changes', 'freemius-turbo-addons-elementor-pro' ); ?>" />
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
                                wp_die( esc_html__( 'Nonce verification failed. Please try again.', 'freemius-turbo-addons-elementor-pro' ) );
                            }
                            $widgets_pro = isset( $_POST['widgets_pro'] ) && is_array( $_POST['widgets_pro'] ) ? array_map( 'sanitize_key', wp_unslash( $_POST['widgets_pro'] ) ) : [];
                            update_option( 'turbo_pro_addons_widgets', $widgets_pro );
                            echo '<div class="taep-alert-updated-div updated">
                                <p>' . esc_html__( 'Pro widgets saved successfully.', 'freemius-turbo-addons-elementor-pro' ) . '</p>
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
                        echo '<span>' . esc_html__( 'Select All', 'freemius-turbo-addons-elementor-pro' ) . '</span>';
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
                            <input type="submit" name="save_pro_changes" class="button taep-dashboard-elements-btn-submit" value="<?php esc_attr_e( 'Save Changes', 'freemius-turbo-addons-elementor-pro' ); ?>" />
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
                                wp_die( esc_html__( 'Nonce verification failed. Please try again.', 'freemius-turbo-addons-elementor-pro' ) );
                            }
                            $extensions = isset( $_POST['extensions'] ) && is_array( $_POST['extensions'] ) ? array_map( 'sanitize_key', wp_unslash( $_POST['extensions'] ) ) : [];
                            update_option( 'turbo_addons_extensions', $extensions );
                            $current_tab = 'extension-tab';
                            echo '<div class="taep-alert-updated-div updated">
                                <p>' . esc_html__( 'Extensions saved successfully.', 'freemius-turbo-addons-elementor-pro' ) . '</p>
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
                        echo '<li class="taep-widget-filter-tab-item active">' . esc_html__( 'Available Extensions', 'freemius-turbo-addons-elementor-pro' ) . '</li>';
                        echo '</ul>';

                        echo '<div class="taep-dashboard-select-widget-btn">';
                        echo '<label>';
                        echo '<input type="checkbox" id="taep-select-all-extensions" />';
                        echo '<span>' . esc_html__( 'Select All', 'freemius-turbo-addons-elementor-pro' ) . '</span>';
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
                            echo '<p>' . esc_html__( 'No extensions found. Please ensure the free plugin is active.', 'freemius-turbo-addons-elementor-pro' ) . '</p>';
                        }

                        echo '</div>'; // .taep-widget-list
                        echo '</div>'; // .taep-widget-tab-content
                        echo '</div>'; // .taep-widget-tabs-content
                        echo '</div>'; // .taep-widget-tabs-container
                        ?>
                        <input type="hidden" id="current_tab" name="current_tab" value="extension-tab">
                        <div class="taep-tab-filter-save-btn">
                            <input type="submit" name="save_pro_extensions" class="button taep-dashboard-elements-btn-submit" value="<?php esc_attr_e( 'Save Changes', 'freemius-turbo-addons-elementor-pro' ); ?>" />
                        </div>
                    </form>
                </div>
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
