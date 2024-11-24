<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WCSPC_ArchiveCount extends Widget_Base {

	public function get_name() {
		return esc_html__( 'WooCShopCount', 'text-domain' );
	}

	public function get_title() {
		return esc_html__( 'Shop Count', 'text-domain' );
	}

	public function get_icon() {
		return 'bwdeb-elementor-bundle eicon-counter';
	}

	public function get_categories() {
		return [ 'woocommerce-elements' ];
	}

	public function get_script_depends() {
		return [ 'woocommerce-elements' ];
	}

    protected function register_controls() {

        $this->start_controls_section(
            'result_count_content',
            [
                'label' => __( 'Result Count', 'text-domain' ),
            ]
        );
        $this->add_control(
            'product_per_page',
            [
                'label' => __( 'Product Per Page', 'text-domain' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
                'separator' => 'after'
            ]
        );
        $this->add_responsive_control(
            'result_count_align',
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
            ]
        );
        $this->end_controls_section();
		
        // Style Title tab section
        $this->start_controls_section(
            'filter_products_shop_count_style_section',
            [
                'label' => __( 'Count', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		// ==========
        $this->start_controls_tabs(
			'filter_products_shop_count_style_tabs'
		);
		
		// Normal tab
		$this->start_controls_tab(
			'filter_products_shop_count_style_normal_tab',
			[
				'label' => esc_html__( 'Normal',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_products_shop_count_name_typography',
				'selector' => '{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count',
			]
		);
		
		$this->add_control(
			'filter_products_shop_count_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'filter_products_shop_count_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'filter_products_shop_count_border',
				'selector' => '{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count',
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_count_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_count_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_count_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		// Hover tab
		$this->start_controls_tab(
			'filter_products_shop_count_tstm_style_hover_tab',
			[
				'label' => esc_html__( 'Hover',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_products_shop_count_hover_typography',
				'selector' => '{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count:hover',
			]
		);
		
		$this->add_control(
			'filter_products_shop_count_content_hover_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'filter_products_shop_count_content_name_hover_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count:hover',
			]
		);
		
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'filter_products_shop_count_hover_border',
				'selector' => '{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count:hover',
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_count_hover_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_count_hover_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_count_hover_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wcspc_archive_result_count .woocommerce-result-count:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// ============
        $this->end_controls_section();

    }


    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        if( wcspc_is_preview_mode() ){
            echo '<div class="wcspc_archive_result_count">';
                $args = array(
                    'total'    => wp_count_posts( 'product' )->publish,
                    'per_page' => $settings['product_per_page'],
                    'current'  => 1,
                );
                wc_get_template( 'loop/result-count.php', $args );
            echo '</div>';
        } else{
            $total    = wc_get_loop_prop( 'total' );
            $par_page = !empty( $settings['product_per_page'] ) ? $settings['product_per_page'] : wc_get_loop_prop('per_page');
            echo '<div class="wcspc_archive_result_count">';
                $page = absint( empty( $_GET['product-page'] ) ? 1 : $_GET['product-page'] );
                wcspc_product_result_count( $total, $par_page, $page );
            echo '</div>';
        }
        

    }

}