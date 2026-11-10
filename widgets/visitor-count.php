<?php
use Elementor\Widget_Base;
use Elementor\Plugin;

if (!defined('ABSPATH')) exit;

class TRAD_Visitor_Count_Pro extends Widget_Base {

    public function get_name() {
        return 'trad_visitor_count';
    }

    public function get_title() {
        return __('Active Visitor Count', 'freemius-turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-person trad-icon';
    }

    /**
     * Hidden from the editor panel without an active Pro license; existing
     * instances on pages keep rendering. @since 1.9.6
     */
    public function show_in_panel() {
        return function_exists( 'trad_pro_is_license_active' ) && trad_pro_is_license_active();
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    protected function render() {
        ?>
        <div class="trad-active-users">
            <p>Currently reading: <span id="trad-active-users-count">0</span> people</p>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Random per-tab visitor ID (no cookies, no PHP session).
                var vid = '';
                try { vid = sessionStorage.getItem('trad_vc_id') || ''; } catch (e) {}
                if (!/^[a-z0-9]{16,40}$/.test(vid)) {
                    vid = (Math.random().toString(36).slice(2) + Math.random().toString(36).slice(2) + Date.now().toString(36)).replace(/[^a-z0-9]/g, '').slice(0, 32);
                    try { sessionStorage.setItem('trad_vc_id', vid); } catch (e) {}
                }
                function updateActiveUsers() {
                    fetch('<?php echo esc_url(admin_url('admin-ajax.php?action=trad_update_active_users')); ?>&vid=' + vid)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('trad-active-users-count').innerText = data.data.active_users;
                    })
                    .catch(error => console.error("AJAX Error:", error));
                }

                function removeActiveUser() {
                    navigator.sendBeacon('<?php echo esc_url(admin_url('admin-ajax.php?action=trad_remove_active_user')); ?>&vid=' + vid);
                }

                // Polling every 5 seconds for more frequent updates
                setInterval(updateActiveUsers, 5000);
                updateActiveUsers(); // Initial update

                // Detect when the user leaves and remove them from active count
                window.addEventListener("beforeunload", removeActiveUser);
                document.addEventListener("visibilitychange", function() {
                    if (document.visibilityState === "hidden") {
                        removeActiveUser();
                    }
                });
            });
        </script>
        <?php
    }
}

// Register the widget
Plugin::instance()->widgets_manager->register(new TRAD_Visitor_Count_Pro());
