<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit;

class TRAD_Table extends Widget_Base {

	public function get_name()          { return 'trad-table'; }
	public function get_title()         { return esc_html__( 'Table', 'turbo-addons-elementor-pro' ); }
	public function get_icon()          { return 'eicon-table trad-icon'; }
	public function get_categories()    { return [ 'turbo-addons-pro' ]; }
	public function get_keywords()      { return [ 'table', 'data table', 'sortable', 'responsive', 'comparison', 'turbo' ]; }

	protected function register_controls() {

		// ── HEADER ────────────────────────────────────────────────────────────
		$this->start_controls_section( 'section_header', [
			'label' => esc_html__( 'Table Header', 'turbo-addons-elementor-pro' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$header_repeater = new Repeater();

		$header_repeater->add_control( 'cell_text', [
			'label'       => esc_html__( 'Header Text', 'turbo-addons-elementor-pro' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Column', 'turbo-addons-elementor-pro' ),
			'label_block' => true,
			'dynamic'     => [ 'active' => true ],
		] );

		$header_repeater->add_control( 'cell_media_type', [
			'label'     => esc_html__( 'Media Type', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'none',
			'options'   => [
				'none'  => esc_html__( 'N/A', 'turbo-addons-elementor-pro' ),
				'icon'  => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
				'image' => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
			],
		] );

		$header_repeater->add_control( 'cell_icon', [
			'label'     => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [ 'value' => '', 'library' => '' ],
			'condition' => [ 'cell_media_type' => 'icon' ],
		] );

		$header_repeater->add_control( 'cell_icon_position', [
			'label'     => esc_html__( 'Icon Position', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'before',
			'options'   => [
				'before' => esc_html__( 'Before Text', 'turbo-addons-elementor-pro' ),
				'after'  => esc_html__( 'After Text', 'turbo-addons-elementor-pro' ),
			],
			'condition' => [ 'cell_media_type' => 'icon' ],
		] );

		$header_repeater->add_control( 'cell_image', [
			'label'     => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::MEDIA,
			'condition' => [ 'cell_media_type' => 'image' ],
		] );

		$header_repeater->add_control( 'cell_image_position', [
			'label'     => esc_html__( 'Image Position', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'before',
			'options'   => [
				'before' => esc_html__( 'Before Text', 'turbo-addons-elementor-pro' ),
				'after'  => esc_html__( 'After Text', 'turbo-addons-elementor-pro' ),
			],
			'condition' => [ 'cell_media_type' => 'image' ],
		] );

		$header_repeater->add_control( 'cell_colspan', [
			'label'   => esc_html__( 'Colspan', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => 1,
			'min'     => 1,
			'max'     => 20,
		] );

		$header_repeater->add_control( 'cell_align', [
			'label'   => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'left'   => [ 'title' => 'Left',   'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => 'Center', 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => 'Right',  'icon' => 'eicon-text-align-right' ],
			],
			'default' => 'left',
		] );

		$this->add_control( 'header_cells', [
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $header_repeater->get_controls(),
			'title_field' => '{{{ cell_text }}}',
			'default'     => [
				[ 'cell_text' => esc_html__( 'Name', 'turbo-addons-elementor-pro' ) ],
				[ 'cell_text' => esc_html__( 'Category', 'turbo-addons-elementor-pro' ) ],
				[ 'cell_text' => esc_html__( 'Price', 'turbo-addons-elementor-pro' ) ],
				[ 'cell_text' => esc_html__( 'Status', 'turbo-addons-elementor-pro' ) ],
			],
		] );

		$this->end_controls_section();

		// ── BODY ──────────────────────────────────────────────────────────────
		$this->start_controls_section( 'section_body', [
			'label' => esc_html__( 'Table Body', 'turbo-addons-elementor-pro' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$row_repeater  = new Repeater();
		$cell_repeater = new Repeater();

		$cell_repeater->add_control( 'cell_content', [
			'label'       => esc_html__( 'Cell Content', 'turbo-addons-elementor-pro' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Cell', 'turbo-addons-elementor-pro' ),
			'label_block' => true,
			'dynamic'     => [ 'active' => true ],
		] );

		$cell_repeater->add_control( 'cell_type', [
			'label'   => esc_html__( 'Cell Type', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'td',
			'options' => [
				'td' => esc_html__( 'Data (td)', 'turbo-addons-elementor-pro' ),
				'th' => esc_html__( 'Header (th)', 'turbo-addons-elementor-pro' ),
			],
		] );

		$cell_repeater->add_control( 'cell_media_type', [
			'label'   => esc_html__( 'Media Type', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'none',
			'options' => [
				'none'  => esc_html__( 'N/A', 'turbo-addons-elementor-pro' ),
				'icon'  => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
				'image' => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
			],
		] );

		$cell_repeater->add_control( 'cell_icon', [
			'label'     => esc_html__( 'Icon', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [ 'value' => '', 'library' => '' ],
			'condition' => [ 'cell_media_type' => 'icon' ],
		] );

		$cell_repeater->add_control( 'cell_icon_position', [
			'label'     => esc_html__( 'Icon Position', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'before',
			'options'   => [
				'before' => esc_html__( 'Before Text', 'turbo-addons-elementor-pro' ),
				'after'  => esc_html__( 'After Text', 'turbo-addons-elementor-pro' ),
			],
			'condition' => [ 'cell_media_type' => 'icon' ],
		] );

		$cell_repeater->add_control( 'cell_image', [
			'label'     => esc_html__( 'Image', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::MEDIA,
			'condition' => [ 'cell_media_type' => 'image' ],
		] );

		$cell_repeater->add_control( 'cell_image_position', [
			'label'     => esc_html__( 'Image Position', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'before',
			'options'   => [
				'before' => esc_html__( 'Before Text', 'turbo-addons-elementor-pro' ),
				'after'  => esc_html__( 'After Text', 'turbo-addons-elementor-pro' ),
			],
			'condition' => [ 'cell_media_type' => 'image' ],
		] );

		$cell_repeater->add_control( 'cell_link', [
			'label'       => esc_html__( 'Link', 'turbo-addons-elementor-pro' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => 'https://',
		] );

		$cell_repeater->add_control( 'cell_colspan', [
			'label'   => esc_html__( 'Colspan', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => 1,
			'min'     => 1,
			'max'     => 20,
		] );

		$cell_repeater->add_control( 'cell_rowspan', [
			'label'   => esc_html__( 'Rowspan', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => 1,
			'min'     => 1,
			'max'     => 20,
		] );

		$cell_repeater->add_control( 'cell_align', [
			'label'   => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'left'   => [ 'title' => 'Left',   'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => 'Center', 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => 'Right',  'icon' => 'eicon-text-align-right' ],
			],
			'default' => 'left',
		] );

		$cell_repeater->add_control( 'cell_bg_color', [
			'label'     => esc_html__( 'Cell Background', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'separator' => 'before',
		] );

		$cell_repeater->add_control( 'cell_text_color', [
			'label' => esc_html__( 'Cell Text Color', 'turbo-addons-elementor-pro' ),
			'type'  => Controls_Manager::COLOR,
		] );

		$row_repeater->add_control( 'row_cells', [
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $cell_repeater->get_controls(),
			'title_field' => '{{{ cell_content }}}',
			'default'     => [
				[ 'cell_content' => esc_html__( 'Item', 'turbo-addons-elementor-pro' ) ],
				[ 'cell_content' => esc_html__( 'Category', 'turbo-addons-elementor-pro' ) ],
				[ 'cell_content' => '$10.00' ],
				[ 'cell_content' => esc_html__( 'Active', 'turbo-addons-elementor-pro' ) ],
			],
		] );

		$row_repeater->add_control( 'row_bg_color', [
			'label'     => esc_html__( 'Row Background', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'separator' => 'before',
		] );

		$this->add_control( 'body_rows', [
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $row_repeater->get_controls(),
			'title_field' => esc_html__( 'Row', 'turbo-addons-elementor-pro' ),
			'default'     => [
				[
					'row_cells' => [
						[ 'cell_content' => 'Product A' ],
						[ 'cell_content' => 'Electronics' ],
						[ 'cell_content' => '$99.00' ],
						[ 'cell_content' => 'In Stock' ],
					],
				],
				[
					'row_cells' => [
						[ 'cell_content' => 'Product B' ],
						[ 'cell_content' => 'Clothing' ],
						[ 'cell_content' => '$49.00' ],
						[ 'cell_content' => 'Out of Stock' ],
					],
				],
				[
					'row_cells' => [
						[ 'cell_content' => 'Product C' ],
						[ 'cell_content' => 'Books' ],
						[ 'cell_content' => '$19.00' ],
						[ 'cell_content' => 'In Stock' ],
					],
				],
			],
		] );

		$this->end_controls_section();

		// ── SETTINGS ──────────────────────────────────────────────────────────
		$this->start_controls_section( 'section_settings', [
			'label' => esc_html__( 'Settings', 'turbo-addons-elementor-pro' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'sortable', [
			'label'        => esc_html__( 'Sortable Columns', 'turbo-addons-elementor-pro' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
			'description'  => esc_html__( 'Click column headers to sort.', 'turbo-addons-elementor-pro' ),
		] );

		$this->add_control( 'searchable', [
			'label'        => esc_html__( 'Search / Filter', 'turbo-addons-elementor-pro' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		$this->add_control( 'search_placeholder', [
			'label'     => esc_html__( 'Search Placeholder', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => esc_html__( 'Search...', 'turbo-addons-elementor-pro' ),
			'condition' => [ 'searchable' => 'yes' ],
		] );

		$this->add_control( 'show_footer', [
			'label'        => esc_html__( 'Show Footer', 'turbo-addons-elementor-pro' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		$this->add_control( 'striped', [
			'label'        => esc_html__( 'Striped Rows', 'turbo-addons-elementor-pro' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'hover_highlight', [
			'label'        => esc_html__( 'Hover Highlight', 'turbo-addons-elementor-pro' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'responsive', [
			'label'        => esc_html__( 'Responsive (Horizontal Scroll)', 'turbo-addons-elementor-pro' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'enable_pagination', [
			'label'        => esc_html__( 'Enable Pagination', 'turbo-addons-elementor-pro' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'no',
			'separator'    => 'before',
		] );

		$this->add_control( 'rows_per_page', [
			'label'     => esc_html__( 'Rows Per Page', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 5,
			'min'       => 1,
			'max'       => 100,
			'condition' => [ 'enable_pagination' => 'yes' ],
		] );

		$this->add_control( 'pagination_align', [
			'label'     => esc_html__( 'Pagination Alignment', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'flex-start' => [ 'title' => 'Left',   'icon' => 'eicon-text-align-left' ],
				'center'     => [ 'title' => 'Center', 'icon' => 'eicon-text-align-center' ],
				'flex-end'   => [ 'title' => 'Right',  'icon' => 'eicon-text-align-right' ],
			],
			'default'   => 'flex-end',
			'condition' => [ 'enable_pagination' => 'yes' ],
		] );

		$this->end_controls_section();

		// ── STYLE: Box ────────────────────────────────────────────────────────
		$this->start_controls_section( 'section_style_box', [
			'label' => esc_html__( 'Box', 'turbo-addons-elementor-pro' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'box_bg',
			'selector' => '{{WRAPPER}} .trad-table-wrap',
		] );

		$this->add_responsive_control( 'box_padding', [
			'label'      => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'box_border',
			'selector' => '{{WRAPPER}} .trad-table-wrap',
		] );

		$this->add_responsive_control( 'box_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;' ],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'box_shadow',
			'selector' => '{{WRAPPER}} .trad-table-wrap',
		] );

		$this->end_controls_section();

		// ── STYLE: Header ─────────────────────────────────────────────────────
		$this->start_controls_section( 'section_style_header', [
			'label' => esc_html__( 'Header', 'turbo-addons-elementor-pro' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'header_bg', [
			'label'     => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#3512bdff',
			'selectors' => [ '{{WRAPPER}} .trad-table thead th' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_control( 'header_color', [
			'label'     => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [ '{{WRAPPER}} .trad-table thead th' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'header_typo',
			'selector' => '{{WRAPPER}} .trad-table thead th',
		] );

		$this->add_responsive_control( 'header_padding', [
			'label'      => esc_html__( 'Cell Padding', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'default'    => [ 'top' => '14', 'right' => '16', 'bottom' => '14', 'left' => '16', 'unit' => 'px' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table thead th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_control( 'header_sort_icon_color', [
			'label'     => esc_html__( 'Sort Icon Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => 'rgba(255,255,255,0.6)',
			'selectors' => [ '{{WRAPPER}} .trad-table thead th .trad-sort-icon' => 'color: {{VALUE}};' ],
		] );

		$this->add_control( 'header_icon_heading', [
			'label'     => esc_html__( 'Header Cell Icon', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'header_icon_color', [
			'label'     => esc_html__( 'Icon Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [
				'{{WRAPPER}} .trad-table thead th .trad-cell-icon i'   => 'color: {{VALUE}};',
				'{{WRAPPER}} .trad-table thead th .trad-cell-icon svg' => 'fill: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'header_icon_size', [
			'label'      => esc_html__( 'Icon Size', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em' ],
			'range'      => [ 'px' => [ 'min' => 8, 'max' => 60 ] ],
			'default'    => [ 'size' => 16, 'unit' => 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .trad-table thead th .trad-cell-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .trad-table thead th .trad-cell-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'header_icon_spacing', [
			'label'     => esc_html__( 'Icon Spacing', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [ 'px' => [ 'min' => 0, 'max' => 20 ] ],
			'default'   => [ 'size' => 6 ],
			'selectors' => [ '{{WRAPPER}} .trad-table thead th .trad-cell-icon' => 'margin-right: {{SIZE}}px;' ],
		] );

		$this->add_control( 'header_img_heading', [
			'label'     => esc_html__( 'Header Cell Image', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'header_img_width', [
			'label'      => esc_html__( 'Image Width', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'range'      => [ 'px' => [ 'min' => 10, 'max' => 200 ] ],
			'default'    => [ 'size' => 24, 'unit' => 'px' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table thead th .trad-cell-img img' => 'width: {{SIZE}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'header_img_height', [
			'label'      => esc_html__( 'Image Height', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em' ],
			'range'      => [ 'px' => [ 'min' => 10, 'max' => 200 ] ],
			'selectors'  => [ '{{WRAPPER}} .trad-table thead th .trad-cell-img img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;' ],
		] );

		$this->add_responsive_control( 'header_img_border_radius', [
			'label'      => esc_html__( 'Image Border Radius', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table thead th .trad-cell-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'header_img_spacing', [
			'label'     => esc_html__( 'Image Spacing', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [ 'px' => [ 'min' => 0, 'max' => 20 ] ],
			'default'   => [ 'size' => 6 ],
			'selectors' => [ '{{WRAPPER}} .trad-table thead th .trad-cell-img' => 'margin-right: {{SIZE}}px;' ],
		] );

		$this->end_controls_section();

		// ── STYLE: Body ───────────────────────────────────────────────────────
		$this->start_controls_section( 'section_style_body', [
			'label' => esc_html__( 'Body', 'turbo-addons-elementor-pro' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'body_bg', [
			'label'     => esc_html__( 'Row Background', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [ '{{WRAPPER}} .trad-table tbody tr' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_control( 'body_odd_bg', [
			'label'     => esc_html__( 'Odd Row Background', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f8f7ff',
			'selectors' => [ '{{WRAPPER}} .trad-table--striped tbody tr:nth-child(odd)' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_control( 'body_hover_bg', [
			'label'     => esc_html__( 'Hover Row Background', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ede9ff',
			'selectors' => [ '{{WRAPPER}} .trad-table--hover tbody tr:hover' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_control( 'body_color', [
			'label'     => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-table tbody td' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'body_typo',
			'selector' => '{{WRAPPER}} .trad-table tbody td',
		] );

		$this->add_responsive_control( 'body_padding', [
			'label'      => esc_html__( 'Cell Padding', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'default'    => [ 'top' => '12', 'right' => '16', 'bottom' => '12', 'left' => '16', 'unit' => 'px' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table tbody td, {{WRAPPER}} .trad-table tbody th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_control( 'body_icon_heading', [
			'label'     => esc_html__( 'Body Cell Icon', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'body_icon_color', [
			'label'     => esc_html__( 'Icon Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .trad-table tbody .trad-cell-icon i'   => 'color: {{VALUE}};',
				'{{WRAPPER}} .trad-table tbody .trad-cell-icon svg' => 'fill: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'body_icon_size', [
			'label'      => esc_html__( 'Icon Size', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em' ],
			'range'      => [ 'px' => [ 'min' => 8, 'max' => 60 ] ],
			'default'    => [ 'size' => 16, 'unit' => 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .trad-table tbody .trad-cell-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .trad-table tbody .trad-cell-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'body_icon_spacing', [
			'label'     => esc_html__( 'Icon Spacing', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [ 'px' => [ 'min' => 0, 'max' => 20 ] ],
			'default'   => [ 'size' => 6 ],
			'selectors' => [ '{{WRAPPER}} .trad-table tbody .trad-cell-icon' => 'margin-right: {{SIZE}}px;' ],
		] );

		$this->add_control( 'body_img_heading', [
			'label'     => esc_html__( 'Body Cell Image', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'body_img_width', [
			'label'      => esc_html__( 'Image Width', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'range'      => [ 'px' => [ 'min' => 10, 'max' => 200 ] ],
			'default'    => [ 'size' => 32, 'unit' => 'px' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table tbody .trad-cell-img img' => 'width: {{SIZE}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'body_img_height', [
			'label'      => esc_html__( 'Image Height', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em' ],
			'range'      => [ 'px' => [ 'min' => 10, 'max' => 200 ] ],
			'selectors'  => [ '{{WRAPPER}} .trad-table tbody .trad-cell-img img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;' ],
		] );

		$this->add_responsive_control( 'body_img_border_radius', [
			'label'      => esc_html__( 'Image Border Radius', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table tbody .trad-cell-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'body_img_spacing', [
			'label'     => esc_html__( 'Image Spacing', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [ 'px' => [ 'min' => 0, 'max' => 20 ] ],
			'default'   => [ 'size' => 6 ],
			'selectors' => [ '{{WRAPPER}} .trad-table tbody .trad-cell-img' => 'margin-right: {{SIZE}}px;' ],
		] );

		$this->end_controls_section();

		// ── STYLE: Border ─────────────────────────────────────────────────────
		$this->start_controls_section( 'section_style_border', [
			'label' => esc_html__( 'Cell Border', 'turbo-addons-elementor-pro' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'cell_border_style', [
			'label'   => esc_html__( 'Border Style', 'turbo-addons-elementor-pro' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'solid',
			'options' => [ 'none' => 'None', 'solid' => 'Solid', 'dashed' => 'Dashed', 'dotted' => 'Dotted' ],
			'selectors' => [
				'{{WRAPPER}} .trad-table td, {{WRAPPER}} .trad-table th' => 'border-style: {{VALUE}};',
			],
		] );

		$this->add_control( 'cell_border_width', [
			'label'     => esc_html__( 'Border Width (px)', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [ 'px' => [ 'min' => 0, 'max' => 10 ] ],
			'default'   => [ 'size' => 1 ],
			'selectors' => [
				'{{WRAPPER}} .trad-table td, {{WRAPPER}} .trad-table th' => 'border-width: {{SIZE}}px;',
			],
		] );

		$this->add_control( 'cell_border_color', [
			'label'     => esc_html__( 'Border Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#e5e5e5',
			'selectors' => [
				'{{WRAPPER}} .trad-table td, {{WRAPPER}} .trad-table th' => 'border-color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();

		// ── STYLE: Search ─────────────────────────────────────────────────────
		$this->start_controls_section( 'section_style_search', [
			'label'     => esc_html__( 'Search Box', 'turbo-addons-elementor-pro' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [ 'searchable' => 'yes' ],
		] );

		$this->add_control( 'search_color', [
			'label'     => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-table-search' => 'color: {{VALUE}};' ],
		] );

		$this->add_control( 'search_bg', [
			'label'     => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [ '{{WRAPPER}} .trad-table-search' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'search_border',
			'selector' => '{{WRAPPER}} .trad-table-search',
		] );

		$this->add_responsive_control( 'search_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table-search' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'search_padding', [
			'label'      => esc_html__( 'Padding', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table-search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'search_margin', [
			'label'      => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'default'    => [ 'bottom' => '16', 'unit' => 'px' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table-search-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'search_width', [
			'label'      => esc_html__( 'Width', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em', 'rem' ],
			'range'      => [ 'px' => [ 'min' => 50, 'max' => 1000 ], '%' => [ 'min' => 10, 'max' => 100 ] ],
			'default'    => [ 'size' => 100, 'unit' => '%' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table-search' => 'width: {{SIZE}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'search_align', [
			'label'     => esc_html__( 'Alignment', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'flex-start' => [ 'title' => 'Left',   'icon' => 'eicon-text-align-left' ],
				'center'     => [ 'title' => 'Center', 'icon' => 'eicon-text-align-center' ],
				'flex-end'   => [ 'title' => 'Right',  'icon' => 'eicon-text-align-right' ],
			],
			'default'   => 'flex-start',
			'selectors' => [ '{{WRAPPER}} .trad-table-search-wrap' => 'display: flex; justify-content: {{VALUE}};' ],
		] );

		$this->end_controls_section();

		// ── STYLE: Pagination ─────────────────────────────────────────────────
		$this->start_controls_section( 'section_style_pagination', [
			'label'     => esc_html__( 'Pagination', 'turbo-addons-elementor-pro' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [ 'enable_pagination' => 'yes' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'pagination_typo',
			'selector' => '{{WRAPPER}} .trad-table-page-btn',
		] );

		$this->add_responsive_control( 'pagination_btn_size', [
			'label'     => esc_html__( 'Button Size', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [ 'px' => [ 'min' => 20, 'max' => 80 ] ],
			'default'   => [ 'size' => 34 ],
			'selectors' => [ '{{WRAPPER}} .trad-table-page-btn' => 'min-width: {{SIZE}}px; height: {{SIZE}}px;' ],
		] );

		$this->add_responsive_control( 'pagination_gap', [
			'label'     => esc_html__( 'Gap', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [ 'px' => [ 'min' => 0, 'max' => 20 ] ],
			'default'   => [ 'size' => 4 ],
			'selectors' => [ '{{WRAPPER}} .trad-table-pagination' => 'gap: {{SIZE}}px;' ],
		] );

		$this->add_responsive_control( 'pagination_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table-page-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'pagination_margin', [
			'label'      => esc_html__( 'Margin', 'turbo-addons-elementor-pro' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'default'    => [ 'top' => '12', 'unit' => 'px' ],
			'selectors'  => [ '{{WRAPPER}} .trad-table-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->start_controls_tabs( 'pagination_tabs' );

		$this->start_controls_tab( 'pagination_normal', [ 'label' => esc_html__( 'Normal', 'turbo-addons-elementor-pro' ) ] );
		$this->add_control( 'pagination_color', [
			'label'     => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-table-page-btn' => 'color: {{VALUE}};' ],
		] );
		$this->add_control( 'pagination_bg', [
			'label'     => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .trad-table-page-btn' => 'background-color: {{VALUE}};' ],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'pagination_border',
			'selector' => '{{WRAPPER}} .trad-table-page-btn',
		] );
		$this->end_controls_tab();

		$this->start_controls_tab( 'pagination_active', [ 'label' => esc_html__( 'Active / Hover', 'turbo-addons-elementor-pro' ) ] );
		$this->add_control( 'pagination_active_color', [
			'label'     => esc_html__( 'Text Color', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [
				'{{WRAPPER}} .trad-table-page-btn.trad-active'          => 'color: {{VALUE}};',
				'{{WRAPPER}} .trad-table-page-btn:hover:not(.trad-disabled)' => 'color: {{VALUE}};',
			],
		] );
		$this->add_control( 'pagination_active_bg', [
			'label'     => esc_html__( 'Background', 'turbo-addons-elementor-pro' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#3512bdff',
			'selectors' => [
				'{{WRAPPER}} .trad-table-page-btn.trad-active'          => 'background-color: {{VALUE}};',
				'{{WRAPPER}} .trad-table-page-btn:hover:not(.trad-disabled)' => 'background-color: {{VALUE}};',
			],
		] );
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$s            = $this->get_settings_for_display();
		$header_cells = ! empty( $s['header_cells'] ) ? $s['header_cells'] : [];
		$body_rows    = ! empty( $s['body_rows'] ) ? $s['body_rows'] : [];
		$sortable     = isset( $s['sortable'] ) && 'yes' === $s['sortable'];
		$searchable   = isset( $s['searchable'] ) && 'yes' === $s['searchable'];
		$show_footer  = isset( $s['show_footer'] ) && 'yes' === $s['show_footer'];
		$striped      = isset( $s['striped'] ) && 'yes' === $s['striped'];
		$hover        = isset( $s['hover_highlight'] ) && 'yes' === $s['hover_highlight'];
		$responsive   = isset( $s['responsive'] ) && 'yes' === $s['responsive'];
		$search_ph    = ! empty( $s['search_placeholder'] ) ? $s['search_placeholder'] : 'Search...';
		$pagination   = isset( $s['enable_pagination'] ) && 'yes' === $s['enable_pagination'];
		$rows_per_page = ! empty( $s['rows_per_page'] ) ? (int) $s['rows_per_page'] : 5;
		$pag_align    = ! empty( $s['pagination_align'] ) ? $s['pagination_align'] : 'flex-end';
		$widget_id    = 'trad-table-' . $this->get_id();
		Icons_Manager::enqueue_shim();

		$table_class = 'trad-table';
		if ( $striped ) $table_class .= ' trad-table--striped';
		if ( $hover )   $table_class .= ' trad-table--hover';
		if ( $sortable ) $table_class .= ' trad-table--sortable';
		?>
		<div class="trad-table-wrap" id="<?php echo esc_attr( $widget_id ); ?>"
			data-pagination="<?php echo $pagination ? 'yes' : 'no'; ?>"
			data-rows-per-page="<?php echo esc_attr( $rows_per_page ); ?>">

			<?php if ( $searchable ) : ?>
				<div class="trad-table-search-wrap">
					<input type="text" class="trad-table-search" placeholder="<?php echo esc_attr( $search_ph ); ?>" aria-label="<?php esc_attr_e( 'Search table', 'turbo-addons-elementor-pro' ); ?>">
				</div>
			<?php endif; ?>

			<div class="trad-table-scroll<?php echo $responsive ? ' trad-table-responsive' : ''; ?>">
				<table class="<?php echo esc_attr( $table_class ); ?>">

					<?php // THEAD ?>
					<?php if ( ! empty( $header_cells ) ) : ?>
						<thead>
							<tr>
								<?php foreach ( $header_cells as $cell ) :
									$text       = ! empty( $cell['cell_text'] ) ? $cell['cell_text'] : '';
									$colspan    = ! empty( $cell['cell_colspan'] ) && (int) $cell['cell_colspan'] > 1 ? ' colspan="' . (int) $cell['cell_colspan'] . '"' : '';
									$align      = ! empty( $cell['cell_align'] ) ? $cell['cell_align'] : 'left';
									$media_type = ! empty( $cell['cell_media_type'] ) ? $cell['cell_media_type'] : 'none';
									$has_icon   = 'icon' === $media_type && ! empty( $cell['cell_icon']['value'] );
									$has_img    = 'image' === $media_type && ! empty( $cell['cell_image']['url'] );
									$icon_pos   = ! empty( $cell['cell_icon_position'] ) ? $cell['cell_icon_position'] : 'before';
									$img_pos    = ! empty( $cell['cell_image_position'] ) ? $cell['cell_image_position'] : 'before';
									?>
									<th<?php echo $colspan; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> style="text-align:<?php echo esc_attr( $align ); ?>;" data-sort="<?php echo esc_attr( sanitize_title( $text ) ); ?>">
										<?php
										$has_img  = ! empty( $cell['cell_image']['url'] );
										$img_pos  = ! empty( $cell['cell_image_position'] ) ? $cell['cell_image_position'] : 'before';
										?>
										<?php if ( $has_icon && 'before' === $icon_pos ) : ?>
											<span class="trad-cell-icon"><?php Icons_Manager::render_icon( $cell['cell_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
										<?php elseif ( $has_img && 'before' === $img_pos ) : ?>
											<span class="trad-cell-img"><img src="<?php echo esc_url( $cell['cell_image']['url'] ); ?>" alt="<?php echo esc_attr( $text ); ?>" loading="lazy"></span>
										<?php endif; ?>
										<?php echo esc_html( $text ); ?>
										<?php if ( $has_icon && 'after' === $icon_pos ) : ?>
											<span class="trad-cell-icon"><?php Icons_Manager::render_icon( $cell['cell_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
										<?php elseif ( $has_img && 'after' === $img_pos ) : ?>
											<span class="trad-cell-img"><img src="<?php echo esc_url( $cell['cell_image']['url'] ); ?>" alt="<?php echo esc_attr( $text ); ?>" loading="lazy"></span>
										<?php endif; ?>
										<?php if ( $sortable ) : ?>
											<span class="trad-sort-icon" aria-hidden="true">⇅</span>
										<?php endif; ?>
									</th>
								<?php endforeach; ?>
							</tr>
						</thead>
					<?php endif; ?>

					<?php // TBODY ?>
					<tbody>
						<?php foreach ( $body_rows as $row ) :
							$row_cells = ! empty( $row['row_cells'] ) ? $row['row_cells'] : [];
							$row_bg    = ! empty( $row['row_bg_color'] ) ? 'background-color:' . esc_attr( $row['row_bg_color'] ) . ';' : '';
							?>
							<tr<?php echo $row_bg ? ' style="' . esc_attr( $row_bg ) . '"' : ''; ?>>
								<?php foreach ( $row_cells as $cell ) :
									$content    = ! empty( $cell['cell_content'] ) ? $cell['cell_content'] : '';
									$type       = ! empty( $cell['cell_type'] ) ? $cell['cell_type'] : 'td';
									$colspan    = ! empty( $cell['cell_colspan'] ) && (int) $cell['cell_colspan'] > 1 ? ' colspan="' . (int) $cell['cell_colspan'] . '"' : '';
									$rowspan    = ! empty( $cell['cell_rowspan'] ) && (int) $cell['cell_rowspan'] > 1 ? ' rowspan="' . (int) $cell['cell_rowspan'] . '"' : '';
									$align      = ! empty( $cell['cell_align'] ) ? $cell['cell_align'] : 'left';
									$link_url   = ! empty( $cell['cell_link']['url'] ) ? $cell['cell_link']['url'] : '';
									$link_ext   = ! empty( $cell['cell_link']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
									$media_type = ! empty( $cell['cell_media_type'] ) ? $cell['cell_media_type'] : 'none';
									$has_icon   = 'icon' === $media_type && ! empty( $cell['cell_icon']['value'] );
									$has_cell_img = 'image' === $media_type && ! empty( $cell['cell_image']['url'] );
									$cell_icon_pos = ! empty( $cell['cell_icon_position'] ) ? $cell['cell_icon_position'] : 'before';
									$cell_img_pos  = ! empty( $cell['cell_image_position'] ) ? $cell['cell_image_position'] : 'before';
									$cell_bg    = ! empty( $cell['cell_bg_color'] ) ? 'background-color:' . esc_attr( $cell['cell_bg_color'] ) . ';' : '';
									$cell_clr   = ! empty( $cell['cell_text_color'] ) ? 'color:' . esc_attr( $cell['cell_text_color'] ) . ';' : '';
									$cell_style = $cell_bg . $cell_clr . 'text-align:' . esc_attr( $align ) . ';';
									$allowed_types = [ 'td', 'th' ];
									$type = in_array( $type, $allowed_types, true ) ? $type : 'td';
									?>
									<<?php echo esc_attr( $type ); ?><?php echo $colspan . $rowspan; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> style="<?php echo esc_attr( $cell_style ); ?>">
										<?php
										$has_cell_img = ! empty( $cell['cell_image']['url'] );
										$cell_img_pos = ! empty( $cell['cell_image_position'] ) ? $cell['cell_image_position'] : 'before';
										?>
										<?php if ( $has_icon && 'before' === ( $cell['cell_icon_position'] ?? 'before' ) ) : ?>
											<span class="trad-cell-icon"><?php Icons_Manager::render_icon( $cell['cell_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
										<?php elseif ( $has_cell_img && 'before' === $cell_img_pos ) : ?>
											<span class="trad-cell-img"><img src="<?php echo esc_url( $cell['cell_image']['url'] ); ?>" alt="<?php echo esc_attr( $content ); ?>" loading="lazy"></span>
										<?php endif; ?>
										<?php if ( $link_url ) : ?>
											<a href="<?php echo esc_url( $link_url ); ?>"<?php echo $link_ext; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $content ); ?></a>
										<?php else : ?>
											<?php echo esc_html( $content ); ?>
										<?php endif; ?>
										<?php if ( $has_icon && 'after' === ( $cell['cell_icon_position'] ?? 'before' ) ) : ?>
											<span class="trad-cell-icon"><?php Icons_Manager::render_icon( $cell['cell_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
										<?php elseif ( $has_cell_img && 'after' === $cell_img_pos ) : ?>
											<span class="trad-cell-img"><img src="<?php echo esc_url( $cell['cell_image']['url'] ); ?>" alt="<?php echo esc_attr( $content ); ?>" loading="lazy"></span>
										<?php endif; ?>
									</<?php echo esc_attr( $type ); ?>>
								<?php endforeach; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>

					<?php // TFOOT ?>
					<?php if ( $show_footer && ! empty( $header_cells ) ) : ?>
						<tfoot>
							<tr>
								<?php foreach ( $header_cells as $cell ) :
									$text    = ! empty( $cell['cell_text'] ) ? $cell['cell_text'] : '';
									$colspan = ! empty( $cell['cell_colspan'] ) && (int) $cell['cell_colspan'] > 1 ? ' colspan="' . (int) $cell['cell_colspan'] . '"' : '';
									$align   = ! empty( $cell['cell_align'] ) ? $cell['cell_align'] : 'left';
									?>
									<th<?php echo $colspan; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> style="text-align:<?php echo esc_attr( $align ); ?>;"><?php echo esc_html( $text ); ?></th>
								<?php endforeach; ?>
							</tr>
						</tfoot>
					<?php endif; ?>

				</table>
			</div>

		<?php if ( $pagination ) : ?>
			<div class="trad-table-pagination" style="justify-content:<?php echo esc_attr( $pag_align ); ?>;"></div>
		<?php endif; ?>

		</div>
		<?php
	}
}

// Register the widget with Elementor.
Plugin::instance()->widgets_manager->register_widget_type( new TRAD_Table() );