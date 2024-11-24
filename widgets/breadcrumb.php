<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WCSPC_PBreadcrumb extends Widget_Base {

	public function get_name() {
		return esc_html__( 'WooCPBreadcrumb', 'text-domain' );
	}

	public function get_title() {
		return esc_html__( 'Shop Breadcrumb', 'text-domain' );
	}

	public function get_icon() {
		return 'eicon-product-title';
	}

	public function get_categories() {
		return [ 'woocommerce-elements' ];
	}

	public function get_script_depends() {
		return [ 'woocommerce-elements' ];
	}

    protected function register_controls() {

        $this->start_controls_section(
            'filter_products_shop_breadcrumb-title-conent',
            [
                'label' => __( 'Breadcrumb', 'text-domain' ),
            ]
        );
        $this->add_responsive_control(
            'filter_products_shop_breadcrumb_align',
            [
                'label'        => __( 'Alignment', 'text-domain' ),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __( 'Left', 'text-domain' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'text-domain' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'text-domain' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-align-%s',
                'default'      => 'left',
                'selectors' => [
                    '{{WRAPPER}} .wcspc-archive-data-area' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
		
        // Style Title tab section
        $this->start_controls_section(
            'filter_products_shop_breadcrumb_style_section',
            [
                'label' => __( 'Title', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		// ==========
        $this->start_controls_tabs(
			'filter_products_shop_breadcrumb_style_tabs'
		);
		
		// Normal tab
		$this->start_controls_tab(
			'filter_products_shop_breadcrumb_style_normal_tab',
			[
				'label' => esc_html__( 'Roots',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_products_shop_breadcrumb_name_typography',
				'selector' => '{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb a',
			]
		);
		
		$this->add_control(
			'filter_products_shop_breadcrumb_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'filter_products_shop_breadcrumb_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb a',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'filter_products_shop_breadcrumb_border',
				'selector' => '{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb a',
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_breadcrumb_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_breadcrumb_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_breadcrumb_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		// Hover tab
		$this->start_controls_tab(
			'filter_products_shop_breadcrumb_tstm_style_hover_tab',
			[
				'label' => esc_html__( 'Current',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_products_shop_breadcrumb_hover_typography',
				'selector' => '{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb',
			]
		);
		
		$this->add_control(
			'filter_products_shop_breadcrumb_content_hover_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'filter_products_shop_breadcrumb_content_name_hover_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb',
			]
		);
		
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'filter_products_shop_breadcrumb_hover_border',
				'selector' => '{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb',
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_breadcrumb_hover_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_breadcrumb_hover_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_breadcrumb_hover_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bwd-woocommerce-breadcrumb .woocommerce-breadcrumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$archive_title = woocommerce_page_title(false);
		if ( function_exists( 'woocommerce_breadcrumb' ) ) {
			?>
			<div class="bwd-woocommerce-breadcrumb">
				<?php
				woocommerce_breadcrumb();
				?>
			</div>
			<?php
		}
	}
	
}
