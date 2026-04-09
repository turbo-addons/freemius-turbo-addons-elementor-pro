<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit;

class TRAD_Off_Canvas extends Widget_Base {

	public function get_name()          { return 'trad-off-canvas'; }
	public function get_title()         { return esc_html__( 'Off-Canvas', 'turbo-addons-elementor-pro' ); }
	public function get_icon()          { return 'eicon-sidebar trad-icon'; }
	public function get_categories()    { return [ 'turbo-addons-pro' ]; }
	public function get_keywords()      { return [ 'off-canvas', 'sidebar', 'drawer', 'panel', 'slide', 'turbo' ]; }
	public function get_script_depends(){ return [ 'trad-off-canvas' ]; }

	protected function get_saved_templates() {
		$templates = [];
		
		$query = new \WP_Query([
			'post_type'      => 'elementor_library',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		]);

		if ( $query->have_posts() ) {
			$templates[0] = esc_html__( 'Select Template', 'turbo-addons-elementor-pro' );
			while ( $query->have_posts() ) {
				$query->the_post();
				$templates[ get_the_ID() ] = get_the_title();
			}
			wp_reset_postdata();
		} else {
			$templates[0] = esc_html__( 'No templates found', 'turbo-addons-elementor-pro' );
		}
		
		return $templates;
	}

	protected function register_controls() {

		// ── TRIGGER SETTINGS ──────────────────────────────────────────────────
		$this->start_controls_section( 'section_trigger', [
			'label' => esc_html__( 'Trigger', 'turbo-addons-elementor-pro' ),
		] );

		$this->add_control( 'trigger_type', [
			'label'   => esc_html__( 'Trigger Type', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'button' => esc_html__( 'Button', 'turbo-addons-elementor-pro' ),
				'icon'   => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
				'custom' => esc_html__( 'Custom Selector', 'turbo-addons-elementor-pro' ),
			],
			'default' => 'button',
		] );

		$this->add_control( 'trigger_text', [
			'label'       => esc_html__( 'Button Text', 'turbo-addons-elementor-pro' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Open Panel', 'turbo-addons-elementor-pro' ),
			'condition'   => [ 'trigger_type' => 'button' ],
			'label_block' => true,
		] );

		$this->add_control( 'trigger_icon', [
			'label'     => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [ 'value' => 'fas fa-bars', 'library' => 'fa-solid' ],
			'condition' => [ 'trigger_type!' => 'custom' ],
		] );

		$this->add_control( 'icon_position', [
			'label'     => esc_html__( 'Icon Position', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'left'  => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
				'right' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
			],
			'default'   => 'left',
			'condition' => [ 'trigger_type' => 'button' ],
		] );

		$this->add_control( 'custom_selector', [
			'label'       => esc_html__( 'Custom Selector', 'turbo-addons-elementor-pro' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => '.my-trigger-class',
			'description' => esc_html__( 'Enter CSS selector (class or ID) of the element that will trigger the off-canvas', 'turbo-addons-elementor-pro' ),
			'condition'   => [ 'trigger_type' => 'custom' ],
			'label_block' => true,
		] );

		$this->end_controls_section();

		// ── CANVAS SETTINGS ───────────────────────────────────────────────────
		$this->start_controls_section( 'section_canvas', [
			'label' => esc_html__( 'Canvas Settings', 'turbo-addons-elementor-pro' ),
		] );

		$this->add_control( 'canvas_position', [
			'label'   => esc_html__( 'Position', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'left'   => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
				'right'  => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
				'top'    => esc_html__( 'Top', 'turbo-addons-elementor-pro' ),
				'bottom' => esc_html__( 'Bottom', 'turbo-addons-elementor-pro' ),
			],
			'default' => 'left',
		] );

		$this->add_control( 'animation_type', [
			'label'   => esc_html__( 'Animation', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'slide'  => esc_html__( 'Slide', 'turbo-addons-elementor-pro' ),
				'push'   => esc_html__( 'Push', 'turbo-addons-elementor-pro' ),
				'reveal' => esc_html__( 'Reveal', 'turbo-addons-elementor-pro' ),
			],
			'default' => 'slide',
		] );

		$this->add_responsive_control( 'canvas_width', [
			'label'      => esc_html__( 'Width', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'vw' ],
			'range'      => [
				'px' => [ 'min' => 200, 'max' => 1000, 'step' => 10 ],
				'%'  => [ 'min' => 10, 'max' => 100, 'step' => 1 ],
				'vw' => [ 'min' => 10, 'max' => 100, 'step' => 1 ],
			],
			'default'    => [ 'size' => 400, 'unit' => 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .trad-offcanvas-panel.trad-position-left' => 'width: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .trad-offcanvas-panel.trad-position-right' => 'width: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [ 'canvas_position' => [ 'left', 'right' ] ],
		] );

		$this->add_responsive_control( 'canvas_height', [
			'label'      => esc_html__( 'Height', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'vh' ],
			'range'      => [
				'px' => [ 'min' => 200, 'max' => 1000, 'step' => 10 ],
				'%'  => [ 'min' => 10, 'max' => 100, 'step' => 1 ],
				'vh' => [ 'min' => 10, 'max' => 100, 'step' => 1 ],
			],
			'default'    => [ 'size' => 400, 'unit' => 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .trad-offcanvas-panel.trad-position-top' => 'height: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .trad-offcanvas-panel.trad-position-bottom' => 'height: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [ 'canvas_position' => [ 'top', 'bottom' ] ],
		] );

		$this->end_controls_section();

		// ── CONTENT ───────────────────────────────────────────────────────────
		$this->start_controls_section( 'section_content', [
			'label' => esc_html__( 'Content', 'turbo-addons-elementor-pro' ),
		] );

		$this->add_control( 'content_type', [
			'label'   => esc_html__( 'Content Type', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'template' => esc_html__( 'Saved Template', 'turbo-addons-elementor-pro' ),
				'custom'   => esc_html__( 'Custom Content', 'turbo-addons-elementor-pro' ),
				'repeater' => esc_html__( 'Content Repeater', 'turbo-addons-elementor-pro' ),
			],
			'default' => 'repeater',
		] );

		$this->add_control( 'saved_template', [
			'label'     => esc_html__( 'Choose Template', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => $this->get_saved_templates(),
			'default'   => '0',
			'condition' => [ 'content_type' => 'template' ],
		] );

		$this->add_control( 'custom_content', [
			'label'       => esc_html__( 'Content', 'turbo-addons-elementor-pro' ),
			'type'        => Controls_Manager::WYSIWYG,
			'default'     => esc_html__( 'Add your content here. You can use any HTML or shortcodes.', 'turbo-addons-elementor-pro' ),
			'condition'   => [ 'content_type' => 'custom' ],
		] );

		// Repeater Content
		$repeater = new Repeater();

		$repeater->add_control( 'item_image', [
			'label'   => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [ 'url' => Utils::get_placeholder_image_src() ],
		] );

		$repeater->add_control( 'item_title', [
			'label'       => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Item Title', 'turbo-addons-elementor-pro' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'item_description', [
			'label'   => esc_html__( 'Description', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Add your description text here.', 'turbo-addons-elementor-pro' ),
		] );

		$repeater->add_control( 'item_button_text', [
			'label'   => esc_html__( 'Button Text', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Read More', 'turbo-addons-elementor-pro' ),
		] );

		$repeater->add_control( 'item_button_link', [
			'label'       => esc_html__( 'Button Link', 'turbo-addons-elementor-pro' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => esc_html__( 'https://your-link.com', 'turbo-addons-elementor-pro' ),
			'default'     => [ 'url' => '#' ],
		] );

		$this->add_control( 'content_items', [
			'label'       => esc_html__( 'Content Items', 'turbo-addons-elementor-pro' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'item_title'       => esc_html__( 'Item #1', 'turbo-addons-elementor-pro' ),
					'item_description' => esc_html__( 'Description for item 1', 'turbo-addons-elementor-pro' ),
				],
				[
					'item_title'       => esc_html__( 'Item #2', 'turbo-addons-elementor-pro' ),
					'item_description' => esc_html__( 'Description for item 2', 'turbo-addons-elementor-pro' ),
				],
			],
			'title_field' => '{{{ item_title }}}',
			'condition'   => [ 'content_type' => 'repeater' ],
		] );

		$this->add_control( 'repeater_layout', [
			'label'     => esc_html__( 'Layout', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'list' => esc_html__( 'List', 'turbo-addons-elementor-pro' ),
				'grid' => esc_html__( 'Grid', 'turbo-addons-elementor-pro' ),
			],
			'default'   => 'list',
			'condition' => [ 'content_type' => 'repeater' ],
		] );

		$this->add_responsive_control( 'grid_columns', [
			'label'     => esc_html__( 'Columns', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
			],
			'default'   => '2',
			'condition' => [
				'content_type'     => 'repeater',
				'repeater_layout' => 'grid',
			],
		] );

		$this->add_control( 'image_position', [
			'label'     => esc_html__( 'Image Position', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'top'  => esc_html__( 'Top', 'turbo-addons-elementor-pro' ),
				'left' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
				'right' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
			],
			'default'   => 'top',
			'condition' => [ 'content_type' => 'repeater' ],
		] );

		$this->add_responsive_control( 'item_gap', [
			'label'      => esc_html__( 'Item Gap', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
			'default'    => [ 'size' => 20 ],
			'selectors'  => [
				'{{WRAPPER}} .trad-offcanvas-items' => 'gap: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [ 'content_type' => 'repeater' ],
		] );

		$this->end_controls_section();

		// ── OVERLAY SETTINGS ──────────────────────────────────────────────────
		$this->start_controls_section( 'section_overlay', [
			'label' => esc_html__( 'Overlay', 'turbo-addons-elementor-pro' ),
		] );

		$this->add_control( 'enable_overlay', [
			'label'        => esc_html__( 'Enable Overlay', 'turbo-addons-elementor-pro' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'overlay_color', [
			'label'     => esc_html__( 'Overlay Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => 'rgba(0,0,0,0.5)',
			'condition' => [ 'enable_overlay' => 'yes' ],
		] );

		$this->add_control( 'close_on_overlay', [
			'label'        => esc_html__( 'Close on Overlay Click', 'turbo-addons-elementor-pro' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
			'condition'    => [ 'enable_overlay' => 'yes' ],
		] );

		$this->end_controls_section();

		// ── CLOSE BUTTON ──────────────────────────────────────────────────────
		$this->start_controls_section( 'section_close_button', [
			'label' => esc_html__( 'Close Button', 'turbo-addons-elementor-pro' ),
		] );

		$this->add_control( 'show_close_button', [
			'label'        => esc_html__( 'Show Close Button', 'turbo-addons-elementor-pro' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'close_button_position', [
			'label'     => esc_html__( 'Position', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'top-left'     => esc_html__( 'Top Left', 'turbo-addons-elementor-pro' ),
				'top-right'    => esc_html__( 'Top Right', 'turbo-addons-elementor-pro' ),
				'bottom-left'  => esc_html__( 'Bottom Left', 'turbo-addons-elementor-pro' ),
				'bottom-right' => esc_html__( 'Bottom Right', 'turbo-addons-elementor-pro' ),
			],
			'default'   => 'top-right',
			'condition' => [ 'show_close_button' => 'yes' ],
		] );

		$this->add_control( 'close_button_icon', [
			'label'     => esc_html__( 'Close Icon', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [ 'value' => 'fas fa-times', 'library' => 'fa-solid' ],
			'condition' => [ 'show_close_button' => 'yes' ],
		] );

		$this->add_control( 'close_on_esc', [
			'label'        => esc_html__( 'Close on ESC Key', 'turbo-addons-elementor-pro' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->end_controls_section();

		// ── STYLE: TRIGGER BUTTON ─────────────────────────────────────────────
		$this->start_controls_section( 'section_style_trigger', [
			'label'     => esc_html__( 'Trigger Button', 'turbo-addons-elementor-pro' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [ 'trigger_type!' => 'custom' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'trigger_typography',
			'selector'  => '{{WRAPPER}} .trad-offcanvas-trigger',
			'condition' => [ 'trigger_type' => 'button' ],
		] );

		$this->start_controls_tabs( 'trigger_tabs' );

		$this->start_controls_tab( 'trigger_normal', [ 'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ) ] );

		$this->add_control( 'trigger_text_heading', [
			'label'     => esc_html__( 'Text', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
		] );

		$this->add_control( 'trigger_text_color', [
			'label'     => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [ '{{WRAPPER}} .trad-offcanvas-trigger' => 'color: {{VALUE}};' ],
		] );

		$this->add_control( 'trigger_icon_heading', [
			'label'     => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'trigger_icon_color', [
			'label'     => esc_html__( 'Icon Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .trad-offcanvas-trigger i'   => 'color: {{VALUE}};',
				'{{WRAPPER}} .trad-offcanvas-trigger svg' => 'fill: {{VALUE}};',
			],
		] );

		$this->add_control( 'trigger_bg_heading', [
			'label'     => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'trigger_bg_color', [
			'label'     => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#1434B1',
			'selectors' => [ '{{WRAPPER}} .trad-offcanvas-trigger' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'trigger_border',
			'selector' => '{{WRAPPER}} .trad-offcanvas-trigger',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'trigger_hover', [ 'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ) ] );

		$this->add_control( 'trigger_hover_text_heading', [
			'label'     => esc_html__( 'Text', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
		] );

		$this->add_control( 'trigger_hover_color', [
			'label'     => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-offcanvas-trigger:hover' => 'color: {{VALUE}};' ],
		] );

		$this->add_control( 'trigger_hover_icon_heading', [
			'label'     => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'trigger_hover_icon_color', [
			'label'     => esc_html__( 'Icon Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .trad-offcanvas-trigger:hover i'   => 'color: {{VALUE}};',
				'{{WRAPPER}} .trad-offcanvas-trigger:hover svg' => 'fill: {{VALUE}};',
			],
		] );

		$this->add_control( 'trigger_hover_bg_heading', [
			'label'     => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'trigger_hover_bg', [
			'label'     => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-offcanvas-trigger:hover' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_control( 'trigger_hover_border', [
			'label'     => esc_html__( 'Border Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-offcanvas-trigger:hover' => 'border-color: {{VALUE}};' ],
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control( 'trigger_padding', [
			'label'      => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .trad-offcanvas-trigger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
			'separator'  => 'before',
		] );

		$this->add_responsive_control( 'trigger_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .trad-offcanvas-trigger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'trigger_shadow',
			'selector' => '{{WRAPPER}} .trad-offcanvas-trigger',
		] );

		$this->add_responsive_control( 'trigger_icon_size', [
			'label'     => esc_html__( 'Icon Size', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [ 'px' => [ 'min' => 10, 'max' => 100 ] ],
			'default'   => [ 'size' => 24, 'unit' => 'px' ],
			'selectors' => [
				'{{WRAPPER}} .trad-offcanvas-trigger i'   => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .trad-offcanvas-trigger svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
			],
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'trigger_icon_spacing', [
			'label'     => esc_html__( 'Icon Spacing', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
			'selectors' => [
				'{{WRAPPER}} .trad-icon-left .trad-trigger-icon'  => 'margin-right: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .trad-icon-right .trad-trigger-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
			],
			'condition' => [ 'trigger_type' => 'button' ],
		] );

		$this->add_responsive_control( 'trigger_vertical_align', [
			'label'     => esc_html__( 'Vertical Alignment', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'flex-start' => [
					'title' => esc_html__( 'Top', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-v-align-top',
				],
				'center'     => [
					'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-v-align-middle',
				],
				'flex-end'   => [
					'title' => esc_html__( 'Bottom', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-v-align-bottom',
				],
			],
			'default'   => 'center',
			'selectors' => [ '{{WRAPPER}} .trad-offcanvas-trigger' => 'align-items: {{VALUE}} !important;' ],
		] );

		$this->end_controls_section();

		// ── STYLE: REPEATER ITEMS ─────────────────────────────────────────────
		$this->start_controls_section( 'section_style_items', [
			'label'     => esc_html__( 'Items', 'turbo-addons-elementor-pro' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [ 'content_type' => 'repeater' ],
		] );

		// Item Container Heading
		$this->add_control( 'heading_item_container', [
			'label'     => esc_html__( 'Item Container', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'item_background',
			'selector' => '{{WRAPPER}} .trad-offcanvas-item',
		] );

		$this->add_responsive_control( 'item_padding', [
			'label'      => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [ '{{WRAPPER}} .trad-offcanvas-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'item_border',
			'selector' => '{{WRAPPER}} .trad-offcanvas-item',
		] );

		$this->add_responsive_control( 'item_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .trad-offcanvas-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'item_shadow',
			'selector' => '{{WRAPPER}} .trad-offcanvas-item',
		] );

		// Image Heading
		$this->add_control( 'heading_image', [
			'label'     => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'image_width', [
			'label'      => esc_html__( 'Width', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'px' => [ 'min' => 50, 'max' => 500 ],
				'%'  => [ 'min' => 10, 'max' => 100 ],
			],
			'selectors'  => [ '{{WRAPPER}} .trad-item-image img' => 'width: {{SIZE}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'image_height', [
			'label'      => esc_html__( 'Height', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 50, 'max' => 500 ] ],
			'selectors'  => [ '{{WRAPPER}} .trad-item-image img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;' ],
		] );

		$this->add_responsive_control( 'image_align', [
			'label'     => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right'  => [
					'title' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'selectors' => [ '{{WRAPPER}} .trad-item-image' => 'text-align: {{VALUE}};' ],
			'condition' => [ 'image_position' => 'top' ],
		] );

		$this->add_responsive_control( 'image_spacing', [
			'label'      => esc_html__( 'Spacing', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
			'selectors'  => [
				'{{WRAPPER}} .trad-image-top .trad-item-image'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .trad-image-left .trad-item-image'  => 'margin-right: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .trad-image-right .trad-item-image' => 'margin-left: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'image_border',
			'selector' => '{{WRAPPER}} .trad-item-image img',
		] );

		$this->add_responsive_control( 'image_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .trad-item-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		// Title Heading
		$this->add_control( 'heading_title', [
			'label'     => esc_html__( 'Title', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-item-title' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'selector' => '{{WRAPPER}} .trad-item-title',
		] );

		$this->add_responsive_control( 'title_align', [
			'label'     => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right'  => [
					'title' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'selectors' => [ '{{WRAPPER}} .trad-item-title' => 'text-align: {{VALUE}};' ],
		] );

		$this->add_responsive_control( 'title_spacing', [
			'label'      => esc_html__( 'Spacing', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
			'selectors'  => [ '{{WRAPPER}} .trad-item-title' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
		] );

		// Description Heading
		$this->add_control( 'heading_description', [
			'label'     => esc_html__( 'Description', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'description_color', [
			'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-item-description' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'description_typography',
			'selector' => '{{WRAPPER}} .trad-item-description',
		] );

		$this->add_responsive_control( 'description_align', [
			'label'     => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right'  => [
					'title' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'selectors' => [ '{{WRAPPER}} .trad-item-description' => 'text-align: {{VALUE}};' ],
		] );

		$this->add_responsive_control( 'description_spacing', [
			'label'      => esc_html__( 'Spacing', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
			'selectors'  => [ '{{WRAPPER}} .trad-item-description' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
		] );

		// Button Heading
		$this->add_control( 'heading_button', [
			'label'     => esc_html__( 'Button', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->start_controls_tabs( 'button_tabs' );

		$this->start_controls_tab( 'button_normal', [ 'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ) ] );

		$this->add_control( 'button_color', [
			'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-item-button' => 'color: {{VALUE}};' ],
		] );

		$this->add_control( 'button_bg_color', [
			'label'     => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-item-button' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'button_border',
			'selector' => '{{WRAPPER}} .trad-item-button',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'button_hover', [ 'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ) ] );

		$this->add_control( 'button_hover_color', [
			'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-item-button:hover' => 'color: {{VALUE}};' ],
		] );

		$this->add_control( 'button_hover_bg_color', [
			'label'     => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-item-button:hover' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_control( 'button_hover_border_color', [
			'label'     => esc_html__( 'Border Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-item-button:hover' => 'border-color: {{VALUE}};' ],
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'button_typography',
			'selector'  => '{{WRAPPER}} .trad-item-button',
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'button_align', [
			'label'     => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => esc_html__( 'Left', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right'  => [
					'title' => esc_html__( 'Right', 'turbo-addons-elementor-pro' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'selectors' => [ '{{WRAPPER}} .trad-item-content' => 'text-align: {{VALUE}};' ],
		] );

		$this->add_responsive_control( 'button_padding', [
			'label'      => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .trad-item-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'button_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .trad-item-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->end_controls_section();

		// ── STYLE: CANVAS PANEL ───────────────────────────────────────────────
		$this->start_controls_section( 'section_style_canvas', [
			'label' => esc_html__( 'Canvas Panel', 'turbo-addons-elementor-pro' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'canvas_background',
			'selector' => '{{WRAPPER}} .trad-offcanvas-panel',
		] );

		$this->add_responsive_control( 'canvas_padding', [
			'label'      => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'      => '10',
				'right'    => '10',
				'bottom'   => '10',
				'left'     => '10',
				'unit'     => 'px',
				'isLinked' => true,
			],
			'selectors'  => [ '{{WRAPPER}} .trad-offcanvas-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'canvas_border',
			'selector' => '{{WRAPPER}} .trad-offcanvas-panel',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'canvas_shadow',
			'selector' => '{{WRAPPER}} .trad-offcanvas-panel',
		] );

		$this->end_controls_section();

		// ── STYLE: CLOSE BUTTON ───────────────────────────────────────────────
		$this->start_controls_section( 'section_style_close', [
			'label'     => esc_html__( 'Close Button', 'turbo-addons-elementor-pro' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [ 'show_close_button' => 'yes' ],
		] );

		$this->start_controls_tabs( 'close_tabs' );

		$this->start_controls_tab( 'close_normal', [ 'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ) ] );

		$this->add_control( 'close_color', [
			'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [
				'{{WRAPPER}} .trad-offcanvas-close'     => 'color: {{VALUE}};',
				'{{WRAPPER}} .trad-offcanvas-close svg' => 'fill: {{VALUE}};',
			],
		] );

		$this->add_control( 'close_bg_color', [
			'label'     => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#0d44e9',
			'selectors' => [ '{{WRAPPER}} .trad-offcanvas-close' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'close_border',
			'selector' => '{{WRAPPER}} .trad-offcanvas-close',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'close_hover', [ 'label' => esc_html__( 'Hover', 'turbo-addons-elementor-pro' ) ] );

		$this->add_control( 'close_hover_color', [
			'label'     => esc_html__( 'Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .trad-offcanvas-close:hover'     => 'color: {{VALUE}};',
				'{{WRAPPER}} .trad-offcanvas-close:hover svg' => 'fill: {{VALUE}};',
			],
		] );

		$this->add_control( 'close_hover_bg', [
			'label'     => esc_html__( 'Background Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-offcanvas-close:hover' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_control( 'close_hover_border_color', [
			'label'     => esc_html__( 'Border Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-offcanvas-close:hover' => 'border-color: {{VALUE}};' ],
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control( 'close_hover_animation', [
			'label'     => esc_html__( 'Hover Animation', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'rotate',
			'options'   => [
				'none'   => esc_html__( 'None', 'turbo-addons-elementor-pro' ),
				'rotate' => esc_html__( 'Rotate', 'turbo-addons-elementor-pro' ),
				'scale'  => esc_html__( 'Scale', 'turbo-addons-elementor-pro' ),
				'pulse'  => esc_html__( 'Pulse', 'turbo-addons-elementor-pro' ),
			],
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'close_size', [
			'label'     => esc_html__( 'Size', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [ 'px' => [ 'min' => 10, 'max' => 100 ] ],
			'default'   => [ 'size' => 16, 'unit' => 'px' ],
			'selectors' => [
				'{{WRAPPER}} .trad-offcanvas-close'     => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .trad-offcanvas-close svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
			],
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'close_padding', [
			'label'      => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .trad-offcanvas-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'close_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .trad-offcanvas-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$widget_id = 'trad-offcanvas-' . $this->get_id();
		$trigger_type = $settings['trigger_type'];
		$canvas_position = $settings['canvas_position'];
		$animation_type = $settings['animation_type'];
		$icon_position = ! empty( $settings['icon_position'] ) ? $settings['icon_position'] : 'left';

		$wrapper_classes = [
			'trad-offcanvas-wrapper',
			'trad-position-' . $canvas_position,
			'trad-animation-' . $animation_type,
		];

		$trigger_classes = [
			'trad-offcanvas-trigger',
			'trad-icon-' . $icon_position,
		];

		$panel_classes = [
			'trad-offcanvas-panel',
			'trad-position-' . $canvas_position,
		];

		$close_position = ! empty( $settings['close_button_position'] ) ? $settings['close_button_position'] : 'top-right';
		$close_animation = ! empty( $settings['close_hover_animation'] ) ? $settings['close_hover_animation'] : 'rotate';

		?>
		<div class="<?php echo esc_attr( implode( ' ', $wrapper_classes ) ); ?>" id="<?php echo esc_attr( $widget_id ); ?>"
			data-position="<?php echo esc_attr( $canvas_position ); ?>"
			data-animation="<?php echo esc_attr( $animation_type ); ?>"
			data-close-animation="<?php echo esc_attr( $close_animation ); ?>"
			data-overlay="<?php echo esc_attr( $settings['enable_overlay'] === 'yes' ? 'true' : 'false' ); ?>"
			data-close-overlay="<?php echo esc_attr( $settings['close_on_overlay'] === 'yes' ? 'true' : 'false' ); ?>"
			data-close-esc="<?php echo esc_attr( $settings['close_on_esc'] === 'yes' ? 'true' : 'false' ); ?>"
			<?php if ( $trigger_type === 'custom' && ! empty( $settings['custom_selector'] ) ) : ?>
				data-custom-trigger="<?php echo esc_attr( $settings['custom_selector'] ); ?>"
			<?php endif; ?>>

			<?php if ( $trigger_type !== 'custom' ) : ?>
				<div class="trad-offcanvas-trigger-wrapper">
					<button class="<?php echo esc_attr( implode( ' ', $trigger_classes ) ); ?>" type="button">
						<?php if ( $trigger_type === 'button' && $icon_position === 'left' && ! empty( $settings['trigger_icon']['value'] ) ) : ?>
							<span class="trad-trigger-icon">
								<?php Icons_Manager::render_icon( $settings['trigger_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php endif; ?>

						<?php if ( $trigger_type === 'button' && ! empty( $settings['trigger_text'] ) ) : ?>
							<span class="trad-trigger-text"><?php echo esc_html( $settings['trigger_text'] ); ?></span>
						<?php endif; ?>

						<?php if ( $trigger_type === 'icon' || ( $trigger_type === 'button' && $icon_position === 'right' ) ) : ?>
							<?php if ( ! empty( $settings['trigger_icon']['value'] ) ) : ?>
								<span class="trad-trigger-icon">
									<?php Icons_Manager::render_icon( $settings['trigger_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</span>
							<?php endif; ?>
						<?php endif; ?>
					</button>
				</div>
			<?php endif; ?>

			<?php if ( $settings['enable_overlay'] === 'yes' ) : ?>
				<div class="trad-offcanvas-overlay" style="background-color: <?php echo esc_attr( $settings['overlay_color'] ); ?>;"></div>
			<?php endif; ?>

			<div class="<?php echo esc_attr( implode( ' ', $panel_classes ) ); ?>">
				<?php if ( $settings['show_close_button'] === 'yes' ) : ?>
					<button class="trad-offcanvas-close trad-close-<?php echo esc_attr( $close_position ); ?>" type="button">
						<?php Icons_Manager::render_icon( $settings['close_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</button>
				<?php endif; ?>

				<div class="trad-offcanvas-content">
					<?php
					if ( $settings['content_type'] === 'template' && ! empty( $settings['saved_template'] ) && $settings['saved_template'] !== '0' ) {
						echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $settings['saved_template'] );
					} elseif ( $settings['content_type'] === 'repeater' && ! empty( $settings['content_items'] ) ) {
						$layout = ! empty( $settings['repeater_layout'] ) ? $settings['repeater_layout'] : 'list';
						$image_position = ! empty( $settings['image_position'] ) ? $settings['image_position'] : 'top';
						$columns = ! empty( $settings['grid_columns'] ) ? $settings['grid_columns'] : '2';
						
						$items_classes = [
							'trad-offcanvas-items',
							'trad-layout-' . $layout,
							'trad-image-' . $image_position,
						];
						
						if ( $layout === 'grid' ) {
							$items_classes[] = 'trad-columns-' . $columns;
						}
						?>
						<div class="<?php echo esc_attr( implode( ' ', $items_classes ) ); ?>">
							<?php foreach ( $settings['content_items'] as $item ) : ?>
								<div class="trad-offcanvas-item">
									<?php if ( ! empty( $item['item_image']['url'] ) ) : ?>
										<div class="trad-item-image">
											<img src="<?php echo esc_url( $item['item_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['item_title'] ); ?>">
										</div>
									<?php endif; ?>
									
									<div class="trad-item-content">
										<?php if ( ! empty( $item['item_title'] ) ) : ?>
											<h3 class="trad-item-title"><?php echo esc_html( $item['item_title'] ); ?></h3>
										<?php endif; ?>
										
										<?php if ( ! empty( $item['item_description'] ) ) : ?>
											<div class="trad-item-description"><?php echo wp_kses_post( $item['item_description'] ); ?></div>
										<?php endif; ?>
										
										<?php if ( ! empty( $item['item_button_text'] ) ) : ?>
											<?php
											$target = ! empty( $item['item_button_link']['is_external'] ) ? ' target="_blank"' : '';
											$nofollow = ! empty( $item['item_button_link']['nofollow'] ) ? ' rel="nofollow"' : '';
											$button_url = ! empty( $item['item_button_link']['url'] ) ? $item['item_button_link']['url'] : '#';
											?>
											<a href="<?php echo esc_url( $button_url ); ?>" class="trad-item-button"<?php echo $target . $nofollow; ?>>
												<?php echo esc_html( $item['item_button_text'] ); ?>
											</a>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<?php
					} else {
						echo wp_kses_post( $settings['custom_content'] );
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}
}

// Register the widget with Elementor.
Plugin::instance()->widgets_manager->register_widget_type( new TRAD_Off_Canvas() );