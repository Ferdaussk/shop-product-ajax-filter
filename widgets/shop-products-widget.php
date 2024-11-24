<?php
if (!defined('ABSPATH')) {
    exit;
}
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
class Shop_Products_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'shop_products_widget';
    }

    public function get_title() {
        return __('Filtered Products', 'shop-products');
    }

    public function get_icon() {
        return 'eicon-products';
    }

    public function get_categories() {
        return ['woocommerce-elements'];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'wcspc_products_related_content_section',
			[
				'label' => esc_html__( 'Settings', 'text-domain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'wcspc_product_related_section_align',
			[
				'label' => __( 'Alignment', 'text-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'text-domain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'text-domain' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'text-domain' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'text-domain' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .products-grid ul.products' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'filter_default_products',
			[
				'label' => esc_html__( 'Default Products Per Page', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
				'default' => 10,
			]
		);
		$this->add_control(
			'filters_products',
			[
				'label' => esc_html__( 'Filters Products Per Page', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
				'default' => 10,
			]
		);
		$this->end_controls_section();
		
        // Style Title tab section
        $this->start_controls_section(
            'ajax_shop_filter_products_product_wrap_style_section',
            [
                'label' => __( 'General', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_wrap_section_align',
			[
				'label' => __( 'Content', 'text-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'text-domain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'text-domain' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'text-domain' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'text-domain' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products li .woocommerce-LoopProduct-link h2' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .products-grid .related.products ul.products li.product' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_wrap_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .products-grid .products .product',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_wrap_border',
				'selector' => '{{WRAPPER}} .products-grid .products .product',
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_wrap_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products .product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_wrap_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products .product' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_wrap_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products .product' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
		
        // Style Title tab section
        $this->start_controls_section(
            'ajax_shop_filter_products_product_title_style_section',
            [
                'label' => __( 'Product Title', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		// ==========
        $this->start_controls_tabs(
			'ajax_shop_filter_products_product_title_style_tabs'
		);
		
		// Normal tab
		$this->start_controls_tab(
			'ajax_shop_filter_products_product_title_style_normal_tab',
			[
				'label' => esc_html__( 'Normal',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_title_name_typography',
				'selector' => '{{WRAPPER}} .products-grid .products li .woocommerce-loop-product__title',
			]
		);
		
		$this->add_control(
			'ajax_shop_filter_products_product_title_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .products-grid .products li .woocommerce-loop-product__title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_title_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .products-grid .products li .woocommerce-loop-product__title',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_title_border',
				'selector' => '{{WRAPPER}} .products-grid .products li .woocommerce-loop-product__title',
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_title_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products li .woocommerce-loop-product__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_title_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products li .woocommerce-loop-product__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_title_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products li .woocommerce-loop-product__title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		// Hover tab
		$this->start_controls_tab(
			'ajax_shop_filter_products_product_title_tstm_style_hover_tab',
			[
				'label' => esc_html__( 'Hover',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_title_hover_typography',
				'selector' => '{{WRAPPER}} .products-grid .products li:hover .woocommerce-loop-product__title',
			]
		);
		
		$this->add_control(
			'ajax_shop_filter_products_product_title_content_hover_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .products-grid .products li:hover .woocommerce-loop-product__title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_title_content_name_hover_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .products-grid .products li:hover .woocommerce-loop-product__title',
			]
		);
		
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_title_hover_border',
				'selector' => '{{WRAPPER}} .products-grid .products li:hover .woocommerce-loop-product__title',
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_title_hover_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products li:hover .woocommerce-loop-product__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_title_hover_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products li:hover .woocommerce-loop-product__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_title_hover_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products li:hover .woocommerce-loop-product__title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// ============
        $this->end_controls_section();
		
        // Style Title tab section
        $this->start_controls_section(
            'ajax_shop_filter_products_product_prices_style_section',
            [
                'label' => __( 'Price', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		// ==========
        $this->start_controls_tabs(
			'ajax_shop_filter_products_product_prices_style_tabs'
		);
		
		// Regular tab
		$this->start_controls_tab(
			'ajax_shop_filter_products_product_prices_style_normal_tab',
			[
				'label' => esc_html__( 'Regular',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_prices_name_typography',
				'selector' => '{{WRAPPER}} .products-grid .products .price del, {{WRAPPER}} .products-grid .products .price',
			]
		);
		
		$this->add_control(
			'ajax_shop_filter_products_product_prices_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .products-grid .products .price del, {{WRAPPER}} .products-grid .products .price' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_prices_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .products-grid .products .price del, {{WRAPPER}} .products-grid .products .price',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_prices_border',
				'selector' => '{{WRAPPER}} .products-grid .products .price del, {{WRAPPER}} .products-grid .products .price',
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_prices_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products .price del, {{WRAPPER}} .products-grid .products .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_prices_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products .price del, {{WRAPPER}} .products-grid .products .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_prices_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products .price del, {{WRAPPER}} .products-grid .products .price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		// Sale tab
		$this->start_controls_tab(
			'ajax_shop_filter_products_product_prices_tstm_style_hover_tab',
			[
				'label' => esc_html__( 'Sale',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_prices_hover_typography',
				'selector' => '{{WRAPPER}} .products-grid .products .price ins',
			]
		);
		
		$this->add_control(
			'ajax_shop_filter_products_product_prices_content_hover_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .products-grid .products .price ins' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_prices_content_name_hover_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .products-grid .products .price ins',
			]
		);
		
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_prices_hover_border',
				'selector' => '{{WRAPPER}} .products-grid .products .price ins',
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_prices_hover_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products .price ins' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_prices_hover_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products .price ins' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_prices_hover_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .products .price ins' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// ============
        $this->end_controls_section();
		
        // Style Title tab section
        $this->start_controls_section(
            'ajax_shop_filter_products_product_btn_style_section',
            [
                'label' => __( 'Button', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		// ==========
        $this->start_controls_tabs(
			'ajax_shop_filter_products_product_btn_style_tabs'
		);
		
		// Normal tab
		$this->start_controls_tab(
			'ajax_shop_filter_products_product_btn_style_normal_tab',
			[
				'label' => esc_html__( 'Normal',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_btn_name_typography',
				'selector' => '{{WRAPPER}} .products-grid .related.products ul.products li.product .button',
			]
		);
		
		$this->add_control(
			'ajax_shop_filter_products_product_btn_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_btn_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .products-grid .related.products ul.products li.product .button',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_btn_border',
				'selector' => '{{WRAPPER}} .products-grid .related.products ul.products li.product .button',
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_btn_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_btn_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_btn_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		// Hover tab
		$this->start_controls_tab(
			'ajax_shop_filter_products_product_btn_tstm_style_hover_tab',
			[
				'label' => esc_html__( 'Hover',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_btn_hover_typography',
				'selector' => '{{WRAPPER}} .products-grid .related.products ul.products li.product .button:hover',
			]
		);
		
		$this->add_control(
			'ajax_shop_filter_products_product_btn_content_hover_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .button:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_btn_content_name_hover_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .products-grid .related.products ul.products li.product .button:hover',
			]
		);
		
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_btn_hover_border',
				'selector' => '{{WRAPPER}} .products-grid .related.products ul.products li.product .button:hover',
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_btn_hover_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_btn_hover_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_btn_hover_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// ============
        $this->end_controls_section();
		
        // Style Title tab section
        $this->start_controls_section(
            'ajax_shop_filter_products_product_sale_badge_style_section',
            [
                'label' => __( 'Sale Badge', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		// ==========
        $this->start_controls_tabs(
			'ajax_shop_filter_products_product_sale_badge_style_tabs'
		);
		
		// Normal tab
		$this->start_controls_tab(
			'ajax_shop_filter_products_product_sale_badge_style_normal_tab',
			[
				'label' => esc_html__( 'Normal',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_sale_badge_name_typography',
				'selector' => '{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale',
			]
		);
		
		$this->add_control(
			'ajax_shop_filter_products_product_sale_badge_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_sale_badge_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_sale_badge_border',
				'selector' => '{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale',
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_sale_badge_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_sale_badge_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_sale_badge_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		// Hover tab
		$this->start_controls_tab(
			'ajax_shop_filter_products_product_sale_badge_tstm_style_hover_tab',
			[
				'label' => esc_html__( 'Hover',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_sale_badge_hover_typography',
				'selector' => '{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale:hover',
			]
		);
		
		$this->add_control(
			'ajax_shop_filter_products_product_sale_badge_content_hover_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_sale_badge_content_name_hover_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale:hover',
			]
		);
		
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ajax_shop_filter_products_product_sale_badge_hover_border',
				'selector' => '{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale:hover',
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_sale_badge_hover_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_sale_badge_hover_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_product_sale_badge_hover_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .related.products ul.products li.product .onsale:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// ============
        $this->end_controls_section();
		
        // Style Title tab section
        $this->start_controls_section(
            'ajax_shop_filter_products_star_rating_style_section',
            [
                'label' => __( 'Star', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		// ==========
        $this->start_controls_tabs(
			'ajax_shop_filter_products_star_rating_style_tabs'
		);
		
		// Normal tab
		$this->start_controls_tab(
			'ajax_shop_filter_products_star_rating_style_normal_tab',
			[
				'label' => esc_html__( 'Rating Star',  'text-domain' ),
			]
		);
		$this->add_control(
			'ajax_shop_filter_products_star_rating_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .products-grid .star-rating span::before, {{WRAPPER}} .products-grid .star-rating span strong' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		
		// Hover tab
		$this->start_controls_tab(
			'ajax_shop_filter_products_star_rating_tstm_style_hover_tab',
			[
				'label' => esc_html__( 'Full Star',  'text-domain' ),
			]
		);
		$this->add_control(
			'ajax_shop_filter_products_star_rating_content_hover_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .products-grid .star-rating::before, {{WRAPPER}} .products-grid .star-rating span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// ============
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'ajax_shop_filter_products_star_rating_name_typography',
				'selector' => '{{WRAPPER}} .products-grid .star-rating',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'ajax_shop_filter_products_star_rating_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .products-grid .star-rating',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ajax_shop_filter_products_star_rating_border',
				'selector' => '{{WRAPPER}} .products-grid .star-rating',
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_star_rating_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .star-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_star_rating_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .star-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ajax_shop_filter_products_star_rating_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .products-grid .star-rating' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
	}

    protected function render() {
        $settings = $this->get_settings_for_display();
		$args = [
			'post_type'      => 'product',
			'posts_per_page' => $settings['filter_default_products'],
			'post_status'    => 'publish',
		];
		$query = new \WP_Query($args);
		?>
		<div id="filtered-products" class="products-grid">
			<?php if ($query->have_posts()) : ?>
				<?php woocommerce_product_loop_start(); ?>
				<?php
				while ($query->have_posts()) : $query->the_post();
					wc_get_template_part('content', 'product');
				endwhile;
				?>
				<?php woocommerce_product_loop_end(); ?>
			<?php else : ?>
				<p><?php esc_html_e('No products found', 'shop-filters'); ?></p>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>
		</div>
		<?php
	}
}
