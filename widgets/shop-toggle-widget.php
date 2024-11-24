<?php
if (!defined('ABSPATH')) {
    exit;
}
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Shop_Toggle_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'shop_toggle_widget';
    }

    public function get_title() {
        return __('Shop Toggle', 'shop-filters');
    }

    public function get_icon() {
        return 'eicon-filter';
    }

    public function get_categories() {
        return ['woocommerce-elements'];
    }

    public function register_controls() {
        $this->start_controls_section( 
            'section_style_icon_product',
            [
                'label' => __('Settings', 'text-domain'),
            ]
        );
        $this->add_responsive_control(
            'filter_products_grid_style_icon_align',
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
                ],
                'selectors' => [
                    '{{WRAPPER}} .filter-products-style-toggle.view-toggle' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'filter_products_grid_icon',
            [
                'label'       => __( 'First Icon (Grid View)', 'text-domain' ),
                'type'        => \Elementor\Controls_Manager::ICONS,
                'label_block' => true,
                'default'     => [
                    'value'   => 'fa fa-th-large',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->add_control(
            'filter_products_list_icon',
            [
                'label'       => __( 'Second Icon (List View)', 'text-domain' ),
                'type'        => \Elementor\Controls_Manager::ICONS,
                'label_block' => true,
                'default'     => [
                    'value'   => 'fa fa-list',
                    'library' => 'fa-solid',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Title tab section
        $this->start_controls_section(
            'filter_products_grid_style_style_section',
            [
                'label' => __( 'Grid Icon', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		// ==========
        $this->start_controls_tabs(
			'filter_products_grid_style_style_tabs'
		);
		
		// Normal tab
		$this->start_controls_tab(
			'filter_products_grid_style_style_normal_tab',
			[
				'label' => esc_html__( 'Normal',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_products_grid_style_name_typography',
				'selector' => '{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon',
			]
		);
		
		$this->add_control(
			'filter_products_grid_style_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'filter_products_grid_style_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'filter_products_grid_style_border',
				'selector' => '{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon',
			]
		);
		
		$this->add_responsive_control(
			'filter_products_grid_style_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_grid_style_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_grid_style_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		// Hover tab
		$this->start_controls_tab(
			'filter_products_grid_style_tstm_style_hover_tab',
			[
				'label' => esc_html__( 'Hover',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_products_grid_style_hover_typography',
				'selector' => '{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon:hover',
			]
		);
		
		$this->add_control(
			'filter_products_grid_style_content_hover_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'filter_products_grid_style_content_name_hover_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon:hover',
			]
		);
		
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'filter_products_grid_style_hover_border',
				'selector' => '{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon:hover',
			]
		);
		
		$this->add_responsive_control(
			'filter_products_grid_style_hover_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_grid_style_hover_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_grid_style_hover_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.grid-icon:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// ============
        $this->end_controls_section();
		
		
        // Style Title tab section
        $this->start_controls_section(
            'filter_products_list_style_style_section',
            [
                'label' => __( 'List Icon', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		// ==========
        $this->start_controls_tabs(
			'filter_products_list_style_style_tabs'
		);
		
		// Normal tab
		$this->start_controls_tab(
			'filter_products_list_style_style_normal_tab',
			[
				'label' => esc_html__( 'Normal',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_products_list_style_name_typography',
				'selector' => '{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon',
			]
		);
		
		$this->add_control(
			'filter_products_list_style_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'filter_products_list_style_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'filter_products_list_style_border',
				'selector' => '{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon',
			]
		);
		
		$this->add_responsive_control(
			'filter_products_list_style_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_list_style_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_list_style_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		// Hover tab
		$this->start_controls_tab(
			'filter_products_list_style_tstm_style_hover_tab',
			[
				'label' => esc_html__( 'Hover',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_products_list_style_hover_typography',
				'selector' => '{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon:hover',
			]
		);
		
		$this->add_control(
			'filter_products_list_style_content_hover_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'filter_products_list_style_content_name_hover_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon:hover',
			]
		);
		
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'filter_products_list_style_hover_border',
				'selector' => '{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon:hover',
			]
		);
		
		$this->add_responsive_control(
			'filter_products_list_style_hover_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_list_style_hover_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_list_style_hover_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .filter-products-style-toggle .toggle-icon.list-icon:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// ============
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $grid_icon = !empty($settings['filter_products_grid_icon']['value']) ? $settings['filter_products_grid_icon']['value'] : 'fa fa-th-large';
		$list_icon = !empty($settings['filter_products_list_icon']['value']) ? $settings['filter_products_list_icon']['value'] : 'fa fa-list';


global $processed_text_global;
    $my_widget_text = 'ggggg';
        $processed_text_global = $my_widget_text;

		
        ?>
        <div class="filter-products-style-toggle view-toggle">
            <label>
                <input type="radio" name="view_style" value="grid" checked>
                <span class="toggle-icon grid-icon" title="Grid View">
                    <i class="<?php echo esc_attr($grid_icon); ?>"></i>
                </span>
            </label>
            <label>
                <input type="radio" name="view_style" value="list">
                <span class="toggle-icon list-icon" title="List View">
                    <i class="<?php echo esc_attr($list_icon); ?>"></i>
                </span>
            </label>
        </div>
        <?php
    }
    // function filter_wproducts($my_widget_text){
	// 	echo 'DDDD'.$my_widget_text;
	// }
}

// for grid and list text add icon not text 