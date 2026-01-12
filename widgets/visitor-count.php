<?php
use Elementor\Widget_Base;
use Elementor\Plugin;

if (!defined('ABSPATH')) exit;

class TRAD_Visitor_Count_Pro extends Widget_Base {

    public function get_name() {
        return 'trad_visitor_count';
    }

    public function get_title() {
        return __('Active Visitor Count', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-person trad-icon';
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
                function updateActiveUsers() {
                    fetch('<?php echo esc_url(admin_url('admin-ajax.php?action=trad_update_active_users')); ?>')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('trad-active-users-count').innerText = data.data.active_users;
                    })
                    .catch(error => console.error("AJAX Error:", error));
                }

                function removeActiveUser() {
                    navigator.sendBeacon('<?php echo esc_url(admin_url('admin-ajax.php?action=trad_remove_active_user')); ?>');
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
Plugin::instance()->widgets_manager->register_widget_type(new TRAD_Visitor_Count_Pro());
