<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_Dynamic_Table_Widget extends Widget_Base {

    public function get_name() {
        return 'csv-upload-widget';
    }

    public function get_title() {
        return __('CSV Upload & Display', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-upload';
    }

    public function get_categories() {
        return ['turbo-addons-pro'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'csv_section',
            [
                'label' => __('CSV Upload', 'turbo-addons-elementor-pro'),
            ]
        );

        $this->add_control(
            'csv_upload',
            [
                'label' => __('Upload CSV File', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::MEDIA,
                'media_types' => ['text/csv'],
            ]
        );

        $this->add_control(
            'display_format',
            [
                'label' => __('Display Format', 'turbo-addons-elementor-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'list' => __('List (ul>li)', 'turbo-addons-elementor-pro'),
                    'table' => __('Table', 'turbo-addons-elementor-pro'),
                ],
                'default' => 'list',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $csv_file = $settings['csv_upload']['url'] ?? '';
        $display_format = $settings['display_format'] ?? 'list';

        if (empty($csv_file)) {
            echo '<p style="color:red;">No CSV file uploaded!</p>';
            return;
        }

        // Fetch CSV Data
        $csv_data = $this->parse_csv($csv_file);

        if (!empty($csv_data)) {
            if ($display_format === 'list') {
                echo '<ul class="csv-list">';
                foreach ($csv_data as $row) {
                    echo '<li>';
                    foreach ($row as $cell) {
                        if ($this->is_image_url($cell)) {
                            echo '<img src="' . esc_url($cell) . '" alt="Image" style="max-width:100px; margin-right:10px;">';
                        } else {
                            echo esc_html($cell) . ' | ';
                        }
                    }
                    echo '</li>';
                }
                echo '</ul>';
            } else {
                echo '<table class="csv-table" border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse: collapse;">';
                echo '<thead><tr>';
                foreach ($csv_data[0] as $header) {
                    echo '<th>' . esc_html($header) . '</th>';
                }
                echo '</tr></thead>';
                echo '<tbody>';
                for ($i = 1; $i < count($csv_data); $i++) {
                    echo '<tr>';
                    foreach ($csv_data[$i] as $cell) {
                        if ($this->is_image_url($cell)) {
                            echo '<td><img src="' . esc_url($cell) . '" alt="Image" style="max-width:100px;"></td>';
                        } else {
                            echo '<td>' . esc_html($cell) . '</td>';
                        }
                    }
                    echo '</tr>';
                }
                echo '</tbody></table>';
            }
        } else {
            echo '<p style="color:red;">Invalid or empty CSV file.</p>';
        }
    }

    private function parse_csv($file_url) {
        $csv_data = [];
        $file_path = str_replace(get_site_url(), ABSPATH, $file_url); // Convert URL to file path

        global $wp_filesystem;

        // Initialize WP_Filesystem
        if ( empty( $wp_filesystem ) ) {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem();
        }

        if ( $wp_filesystem->exists( $file_path ) ) {
            $contents = $wp_filesystem->get_contents( $file_path );
            if ( $contents ) {
                $lines = explode( "\n", $contents );
                foreach ( $lines as $line ) {
                    $row = str_getcsv( $line, ',' );
                    if ( ! empty( $row ) ) {
                        $csv_data[] = $row;
                    }
                }
            }
        }

        return $csv_data;
    }


    private function is_image_url($url) {
        return preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $url);
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new TRAD_Dynamic_Table_Widget());
