<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography; 
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TRAD_Horizontal_Scroll extends \Elementor\Widget_Base {

    public function get_name() {
        return 'trad_horizontal_scroll';
    }

    public function get_title() {
        return __('Horizontal Scroll', 'turbo-addons-elementor-pro');
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {

        $this->start_controls_section('content_section', [
            'label' => __('Templates', 'turbo-addons-elementor-pro'),
        ]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('template_id', [
            'label' => __('Choose Template', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::SELECT2,
            'options' => $this->get_elementor_templates(),
            'label_block' => true,
        ]);

        $this->add_control('templates', [
            'label' => __('Templates List', 'turbo-addons-elementor-pro'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
        ]);

        $this->end_controls_section();
    }

    private function get_elementor_templates() {
        $templates = [];

        $args = [
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ];
        $posts = get_posts($args);

        foreach ($posts as $post) {
            $templates[$post->ID] = $post->post_title;
        }

        return $templates;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = 'trad-hscroll-' . $this->get_id();
        ?>
        <div class="trad-hscroll-wrapper" id="<?php echo esc_attr($id); ?>">
            <div class="trad-hscroll-inner">
                <?php
                foreach ($settings['templates'] as $index => $item) {
                    echo '<div class="trad-hscroll-slide">';
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($item['template_id']);
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <?php
    }
}

// Register the widget
Plugin::instance()->widgets_manager->register_widget_type(new TRAD_Horizontal_Scroll ());
