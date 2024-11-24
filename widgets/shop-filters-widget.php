<?php
if (!defined('ABSPATH')) {
    exit;
}
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
class Shop_Filters_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'shop_filters_widget';
    }

    public function get_title() {
        return __('Shop Filters', 'text-domain');
    }

    public function get_icon() {
        return 'eicon-filter';
    }

    public function get_categories() {
        return ['woocommerce-elements'];
    }

    public function register_controls() {
        $this->start_controls_section( 
            'section_product',
            [
                'label' => __('Settings', 'text-domain'),
            ]
        );
		$this->add_control(
			'left_right_align_rtl_ltr',
			[
				'label'   => __( 'Alignment', 'text-domain' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'ltr' => [
						'title' => __( 'Left', 'text-domain' ),
						'icon'  => 'eicon-h-align-left',
					],
					'rtl' => [
						'title' => __( 'Right', 'text-domain' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
				'toggle'  => true,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter form#filter-form' => 'direction: {{VALUE}};',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
        
        $repeater = new Repeater();
        $repeater->add_control(
            'select_control',
            [
                'label'   => __( 'Select Option', 'text-domain' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'search' => __( 'Search', 'text-domain' ),
                    'categories' => __( 'Categories', 'text-domain' ),
                    'tags' => __( 'Tags', 'text-domain' ),
                    'price_range' => __( 'Price Range', 'text-domain' ),
                    'in_stock' => __( 'In Stock', 'text-domain' ),
                    'featured_roducts' => __( 'Featured Froducts', 'text-domain' ),
                    'on_sale' => __( 'On Sale', 'text-domain' ),
                    'recent_products' => __( 'Recent Products', 'text-domain' ),
                    'top_sale_products' => __( 'Top Sale Products', 'text-domain' ),
                    'yearly_products' => __( 'Current Year', 'text-domain' ),
                    'monthly_products' => __( 'Current Month', 'text-domain' ),
                    'weight' => __( 'Weight (kg)', 'text-domain' ),
                    'variable_products' => __( 'Variable Products', 'text-domain' ),
                    'affiliate_products' => __( 'Affiliate Products', 'text-domain' ),
                ],
                'default' => 'search',
            ]
        );
		$repeater->add_control(
			'filter_input_title',
			[
				'label' => esc_html__( 'Title', 'text-domain' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'text-domain' ),
				'label_off' => esc_html__( 'Hide', 'text-domain' ),
				'return_value' => 'yes',
				'default' => 'yes',
                'condition' => [
                    'select_control' => ['search','categories','tags','price_range','weight'], 
                ],
			]
		);
        // Price range
        $repeater->add_control(
            'price_range_slider_min',
            [
                'label' => __('Minimum Price', 'text-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0,
                'condition' => [
                    'select_control' => 'price_range', 
                ],
            ]
        );
        $repeater->add_control(
            'price_range_slider_max',
            [
                'label' => __('Maximum Price', 'text-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1000,
                'condition' => [
                    'select_control' => 'price_range', 
                ],
            ]
        );
        $this->add_control(
            'filter_repeater_control',
            [
                'label' => __( 'Repeater Control', 'text-domain' ),
                'type'  => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'select_control' => 'search',
                    ],
                    [
                        'select_control' => 'price_range',
                    ],
                    [
                        'select_control' => 'categories',
                    ],
                    [
                        'select_control' => 'tags',
                    ],
                ],
                'title_field' => '{{{ select_control }}}',
            ]
        );
        $this->end_controls_section();
		
        // Style Title tab section
        $this->start_controls_section(
            'shop_ajax_filter_title_style_section',
            [
                'label' => __( 'Title', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'shop_ajax_filter_heading_label_name_typography',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item h3',
			]
		);
		$this->add_control(
			'shop_ajax_filter_heading_label_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item h3' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shop_ajax_filter_heading_label_content_hover1_name_color',
			[
				'label' => esc_html__( 'Hover Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item h3:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shop_ajax_filter_heading_label_content_hover2_name_color',
			[
				'label' => esc_html__( 'Hover Background',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item h3:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'shop_ajax_filter_heading_label_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item h3',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'shop_ajax_filter_heading_label_border',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item h3',
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_heading_label_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_heading_label_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_heading_label_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
		
        // Style Title tab section
        $this->start_controls_section(
            'shop_ajax_filter_label_style_section',
            [
                'label' => __( 'Label', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'shop_ajax_filter_single_label_name_typography',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .filter-items label',
			]
		);
		$this->add_control(
			'shop_ajax_filter_single_label_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .filter-items label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shop_ajax_filter_single_label_content_hover1_name_color',
			[
				'label' => esc_html__( 'Hover Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .filter-items label:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shop_ajax_filter_single_label_content_hover2_name_color',
			[
				'label' => esc_html__( 'Hover Background',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .filter-items label:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'shop_ajax_filter_single_label_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .filter-items label',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'shop_ajax_filter_single_label_border',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .filter-items label',
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_single_label_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .filter-items label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_single_label_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .filter-items label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_single_label_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .filter-items label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
        
        $this->start_controls_section(
            'shop_ajax_filter_search_style_section',
            [
                'label' => __( 'Search', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'shop_ajax_filter_search_hover_typography',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #search',
			]
		);
		
		$this->add_control(
			'shop_ajax_filter_search_content_hover_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #search' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'shop_ajax_filter_search_content_name_hover_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #search',
			]
		);
		$this->add_control(
			'shop_ajax_filter_search_content_hover2_color',
			[
				'label' => esc_html__( 'Hover Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #search:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shop_ajax_filter_search_content_hover3_color',
			[
				'label' => esc_html__( 'Hover Background',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #search:hover' => 'background: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'shop_ajax_filter_search_hover_border',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #search',
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_search_hover_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_search_hover_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #search' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_search_hover_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #search' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
		
        // Style Title tab section
        $this->start_controls_section(
            'shop_ajax_filter_category_style_section',
            [
                'label' => __( 'Category', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		// ==========
        $this->start_controls_tabs(
			'shop_ajax_filter_category_style_tabs'
		);
		
		// Normal tab
		$this->start_controls_tab(
			'shop_ajax_filter_category_style_normal_tab',
			[
				'label' => esc_html__( 'Category',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'shop_ajax_filter_category_name_typography',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #category-filters label',
			]
		);
		
		$this->add_control(
			'shop_ajax_filter_category_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #category-filters label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shop_ajax_filter_category_content_hover1_name_color',
			[
				'label' => esc_html__( 'Hover Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #category-filters label:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shop_ajax_filter_category_content_hover2_name_color',
			[
				'label' => esc_html__( 'Hover Background',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #category-filters label:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'shop_ajax_filter_category_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #category-filters label',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'shop_ajax_filter_category_border',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #category-filters label',
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_category_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #category-filters label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_category_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #category-filters label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_category_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #category-filters label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		// Input tab
		$this->start_controls_tab(
			'shop_ajax_filter_category_tstm_style_hover_tab',
			[
				'label' => esc_html__( 'Input',  'text-domain' ),
			]
		);
		$this->add_responsive_control(
			'shop_ajax_filter_category_hover_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #category-filters input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_category_hover_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #category-filters input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// ============
        $this->end_controls_section();
		
        // Style Title tab section
        $this->start_controls_section(
            'shop_ajax_filter_price_range_style_section',
            [
                'label' => __( 'Price Range', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		// ==========
        $this->start_controls_tabs(
			'shop_ajax_filter_price_range_style_tabs'
		);
		
		// Normal tab
		$this->start_controls_tab(
			'shop_ajax_filter_price_range_style_normal_tab',
			[
				'label' => esc_html__( 'Label',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'shop_ajax_filter_price_range_name_typography',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #price-range-display',
			]
		);
		
		$this->add_control(
			'shop_ajax_filter_price_range_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #price-range-display' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shop_ajax_filter_price_range_content_hover1_name_color',
			[
				'label' => esc_html__( 'Hover Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #price-range-display:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shop_ajax_filter_price_range_content_hover2_name_color',
			[
				'label' => esc_html__( 'Hover Background',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #price-range-display:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'shop_ajax_filter_price_range_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #price-range-display',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'shop_ajax_filter_price_range_border',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #price-range-display',
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_price_range_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #price-range-display' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_price_range_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #price-range-display' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_price_range_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #price-range-display' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		// Slide tab
		$this->start_controls_tab(
			'shop_ajax_filter_price_range_tstm_style_hover_tab',
			[
				'label' => esc_html__( 'Slide',  'text-domain' ),
			]
		);
		$this->add_control(
            'range_height_control',
            [
                'label'   => __( 'Range Height', 'text-domain' ),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'range'   => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .ui-slider' => 'height: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'shop_ajax_filter_price_range_up_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .ui-slider-range',
			]
		);
		$this->add_control(
			'shop_ajax_filter_price_rangebg_content_name_bgcolor',
			[
				'label' => esc_html__( 'Back bg',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .ui-slider' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'range_circle_control',
			[
				'label'   => __( 'Circle', 'text-domain' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range'   => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .ui-slider .ui-slider-handle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		// $this->add_control(
		// 	'custom_range_slider_control',
		// 	[
		// 		'label'   => __( 'Circle Position', 'text-domain' ),
		// 		'type'    => \Elementor\Controls_Manager::SLIDER,
		// 		'range'   => [
		// 			'px' => [
		// 				'min' => -100,
		// 				'max' => 100,
		// 				'step' => 1,
		// 			],
		// 		],
		// 		'default' => [
		// 			'unit' => 'px',
		// 			'size' => 0, // Default value in the middle (0px)
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .bwd-ajax-shop-filter .ui-slider .ui-slider-handle' => 'left: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'shop_ajax_filter_price_range_circle_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter #price-slider span',
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// ============
        $this->end_controls_section();
		
        // Style Title tab section
        $this->start_controls_section(
            'shop_ajax_filter_tag_style_section',
            [
                'label' => __( 'Tag', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		// ==========
        $this->start_controls_tabs(
			'shop_ajax_filter_tag_style_tabs'
		);
		
		// Normal tab
		$this->start_controls_tab(
			'shop_ajax_filter_tag_style_normal_tab',
			[
				'label' => esc_html__( 'Tag',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'shop_ajax_filter_tag_name_typography',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #tag-filters label',
			]
		);
		
		$this->add_control(
			'shop_ajax_filter_tag_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #tag-filters label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shop_ajax_filter_tag_content_hover1_name_color',
			[
				'label' => esc_html__( 'Hover Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #tag-filters label:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shop_ajax_filter_tag_content_hover2_name_color',
			[
				'label' => esc_html__( 'Hover Background',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #tag-filters label:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'shop_ajax_filter_tag_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #tag-filters label',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'shop_ajax_filter_tag_border',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #tag-filters label',
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_tag_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #tag-filters label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_tag_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #tag-filters label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_tag_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #tag-filters label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		// Input tab
		$this->start_controls_tab(
			'shop_ajax_filter_tag_tstm_style_hover_tab',
			[
				'label' => esc_html__( 'Input',  'text-domain' ),
			]
		);
		$this->add_responsive_control(
			'shop_ajax_filter_tag_hover_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #tag-filters input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'shop_ajax_filter_tag_hover_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item #tag-filters input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// ============
        $this->end_controls_section();

        
        $this->start_controls_section(
            'shop_ajax_filter_weight_style_section',
            [
                'label' => __( 'Weight', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'shop_ajax_filter_weight_hover_typography',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .weight input',
			]
		);
		
		$this->add_control(
			'shop_ajax_filter_weight_content_hover_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .weight input' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'shop_ajax_filter_weight_content_name_hover_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .weight input',
			]
		);
		$this->add_control(
			'shop_ajax_filter_weight_content_hover2_color',
			[
				'label' => esc_html__( 'Hover Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .weight input:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shop_ajax_filter_weight_content_hover3_color',
			[
				'label' => esc_html__( 'Hover Background',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .weight input:hover' => 'background: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'shop_ajax_filter_weight_hover_border',
				'selector' => '{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .weight input',
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_weight_hover_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .weight input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_weight_hover_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .weight input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'shop_ajax_filter_weight_hover_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-ajax-shop-filter .filter-repeater-item .weight input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<div class="bwd-ajax-shop-filter sidebar-form">';
            echo '<form id="filter-form">';
                if ( ! empty( $settings['filter_repeater_control'] ) ) {
                    foreach ( $settings['filter_repeater_control'] as $item ) {
                        $maxPriceFilter = $item['price_range_slider_max'];
                        $minPriceFilter = $item['price_range_slider_min'];
                        if (function_exists('get_woocommerce_currency')) {
                            $currency = get_woocommerce_currency_symbol();
                        }
                        echo '<div class="filter-repeater-item elementor-repeater-item-' . esc_attr( $item['_id'] ).'">';
						$weightCheck = 'weight' === $item['select_control']?'(kg)':'';
                        $inputTitle = '<h3>' . str_replace("_", " ", esc_html( $item['select_control'] )).' '.$weightCheck.'</h3>';
                        if ( 'search' === $item['select_control'] ) {
							echo $item['filter_input_title']=='yes'?$inputTitle:'';
                            echo '<input type="text" name="search" id="search" value="" placeholder="Search Products">';
                        } elseif ( 'categories' === $item['select_control'] ) {
							echo $item['filter_input_title']=='yes'?$inputTitle:'';
                            echo '<div id="category-filters">';
                                $categories = get_terms('product_cat', array('hide_empty' => true));
                                foreach ($categories as $category) {
                                    echo '<label><input type="checkbox" name="categories[]" value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</label>';
                                }
                            echo '</div>';
                        } elseif ( 'tags' === $item['select_control'] ) {
							echo $item['filter_input_title']=='yes'?$inputTitle:'';
                            echo '<div id="tag-filters">';
                                $tags = get_terms('product_tag', array('hide_empty' => true));
                                foreach ($tags as $tag) {
                                    echo '<label><input type="checkbox" name="tags[]" value="' . esc_attr($tag->slug) . '">' . esc_html($tag->name) . '</label>';
                                }
                            echo '</div>';
                        } elseif ( 'price_range' === $item['select_control'] ) {
							echo $item['filter_input_title']=='yes'?$inputTitle:'';
                            echo '<div class="price_range">';
                                echo '<div class="shop-products-filter" max-price-filter="'.esc_attr( $maxPriceFilter ).'" min-price-filter="'.esc_attr( $minPriceFilter ).'" filter-price-currency="'.$currency.'"></div>';
                                echo '<div id="price-slider"></div>';
                                echo '<input type="hidden" name="min_price" id="min_price" value="">';
                                echo '<input type="hidden" name="max_price" id="max_price" value="">';
                                echo '<p id="price-range-display">Min: '.$currency.' '.$minPriceFilter.' - Max: '.$currency.' '.$maxPriceFilter.'</p>';
                            echo '</div>';
                        } elseif ( 'in_stock' === $item['select_control'] ) {
                            echo '<div class="in_stock filter-items">';
							echo '<label>';
                            echo '<input type="checkbox" name="in_stock" id="in_stock">'.str_replace("_", " ", esc_html( $item['select_control'] ));
							echo '</label>';
                            echo '</div>';
                        } elseif ( 'featured_roducts' === $item['select_control'] ) {
                            echo '<div class="featured_roducts filter-items">';
							echo '<label>';
                            echo '<input type="checkbox" name="featured" id="featured">'.str_replace("_", " ", esc_html( $item['select_control'] ));
							echo '</label>';
                            echo '</div>';
                        } elseif ( 'on_sale' === $item['select_control'] ) {
                            echo '<div class="on_sale filter-items">';
							echo '<label>';
                            echo '<input type="checkbox" name="on_sale" id="on_sale">'.str_replace("_", " ", esc_html( $item['select_control'] ));
							echo '</label>';
                            echo '</div>';
                        } elseif ( 'recent_products' === $item['select_control'] ) {
                            echo '<div class="recent_products filter-items">';
							echo '<label>';
                            echo '<input type="checkbox" name="recent_products" id="recent_products">'.str_replace("_", " ", esc_html( $item['select_control'] ));
							echo '</label>';
                            echo '</div>';
                        } elseif ( 'top_sale_products' === $item['select_control'] ) {
                            echo '<div class="top_sale_products filter-items">';
							echo '<label>';
                            echo '<input type="checkbox" name="top_sale_products" id="top_sale_products">'.str_replace("_", " ", esc_html( $item['select_control'] ));
							echo '</label>';
                            echo '</div>';
                        } elseif ( 'yearly_products' === $item['select_control'] ) {
                            echo '<div class="yearly_products filter-items">';
							echo '<label>';
                            echo '<input type="checkbox" name="yearly_products" id="yearly_products">'.str_replace("_", " ", esc_html( $item['select_control'] ));
							echo '</label>';
                            echo '</div>';
                        } elseif ( 'monthly_products' === $item['select_control'] ) {
                            echo '<div class="monthly_products filter-items">';
							echo '<label>';
                            echo '<input type="checkbox" name="monthly_products" id="monthly_products">'.str_replace("_", " ", esc_html( $item['select_control'] ));
							echo '</label>';
                            echo '</div>';
                        } elseif ( 'weight' === $item['select_control'] ) {
							echo $item['filter_input_title']=='yes'?$inputTitle:'';
                            echo '<div class="weight filter-items">';
                            echo '<input type="number" name="min_weight" id="min_weight" placeholder="Min">-';
                            echo '<input type="number" name="max_weight" id="max_weight" placeholder="Max">';
                            echo '</div>';
                        } elseif ( 'variable_products' === $item['select_control'] ) {
                            echo '<div class="variable_products filter-items">';
							echo '<label>';
                            echo '<input type="checkbox" name="variable_product" id="variable_product">'.str_replace("_", " ", esc_html( $item['select_control'] ));
							echo '</label>';
								echo '<ul><div id="variation-filters">';
									$all_variations = [];
									$products = wc_get_products(['status' => 'publish', 'limit' => -1]);
									foreach ($products as $product) {
										if ($product->is_type('variable')) {
											$variations = $product->get_available_variations();
											foreach ($variations as $variation) {
												$variation_attributes = $variation['attributes'];
												$formatted_attributes = [];
												foreach ($variation_attributes as $key => $value) {
													$attribute_name = wc_attribute_label(str_replace('attribute_', '', $key));
													$formatted_attributes[] = $attribute_name . ': ' . $value;
												}
												$variation_key = implode(' | ', $formatted_attributes);
												if (!array_key_exists($variation_key, $all_variations)) {
													$all_variations[$variation_key] = $variation['variation_id'];
												}
											}
										}
									}

									if (!empty($all_variations)) {
										foreach ($all_variations as $variation_label => $variation_id) {
											echo '<label>';
											echo '<input type="checkbox" name="variations[]" value="' . esc_attr($variation_id) . '">';
											echo esc_html($variation_label);
											echo '</label>';
										}
									} else {
										echo 'No unique variations found.';
									}
								echo '</div></ul>';
                            echo '</div>';
                        } elseif ( 'affiliate_products' === $item['select_control'] ) {
                            echo '<div class="affiliate_products filter-items">';
							echo '<label>';
                            echo '<input type="checkbox" name="affiliate_product" id="affiliate_product">'.str_replace("_", " ", esc_html( $item['select_control'] ));
							echo '</label>';
                            echo '</div>';
                        }
        
                        echo '</div>';
                    }
                }
            echo '</form>';
        echo '</div>';
    }
}
