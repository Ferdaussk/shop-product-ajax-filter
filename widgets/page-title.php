<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WCSPC_PArchiveTitle extends Widget_Base {

	public function get_name() {
		return esc_html__( 'WooCPShopTitle', 'text-domain' );
	}

	public function get_title() {
		return esc_html__( 'Shop Title', 'text-domain' );
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
            'filter_products_shop_title_conent',
            [
                'label' => __( 'Title', 'text-domain' ),
            ]
        );
        $this->add_control(
            'filter_products_shop_title_html_tag',
            [
                'label'   => __( 'Title HTML Tag', 'text-domain' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1'   => __( 'H1', 'text-domain' ),
                    'h2'   => __( 'H2', 'text-domain' ),
                    'h3'   => __( 'H3', 'text-domain' ),
                    'h4'   => __( 'H4', 'text-domain' ),
                    'h5'   => __( 'H5', 'text-domain' ),
                    'h6'   => __( 'H6', 'text-domain' ),
                    'p'    => __( 'p', 'text-domain' ),
                    'div'  => __( 'div', 'text-domain' ),
                    'span' => __( 'span', 'text-domain' ),
                ],
                'default' => 'h2',
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'filter_products_shop_title_align',
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
            'filter_products_shop_title_style_section',
            [
                'label' => __( 'Title', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		// ==========
        $this->start_controls_tabs(
			'filter_products_shop_title_style_tabs'
		);
		
		// Normal tab
		$this->start_controls_tab(
			'filter_products_shop_title_style_normal_tab',
			[
				'label' => esc_html__( 'Normal',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_products_shop_title_name_typography',
				'selector' => '{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title',
			]
		);
		
		$this->add_control(
			'filter_products_shop_title_content_name_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'filter_products_shop_title_content_name_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'filter_products_shop_title_border',
				'selector' => '{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title',
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_title_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_title_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_title_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		// Hover tab
		$this->start_controls_tab(
			'filter_products_shop_title_tstm_style_hover_tab',
			[
				'label' => esc_html__( 'Hover',  'text-domain' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_products_shop_title_hover_typography',
				'selector' => '{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title:hover',
			]
		);
		
		$this->add_control(
			'filter_products_shop_title_content_hover_color',
			[
				'label' => esc_html__( 'Color',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'filter_products_shop_title_content_name_hover_bgcolor',
				'label' => esc_html__( 'Background', 'text-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title:hover',
			]
		);
		
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'filter_products_shop_title_hover_border',
				'selector' => '{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title:hover',
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_title_hover_padding',
			[
				'label' => esc_html__( 'Padding',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_title_hover_margin',
			[
				'label' => esc_html__( 'Margin',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_products_shop_title_hover_border_radius',
			[
				'label' => esc_html__( 'Border Radius',  'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wcspc-archive-data-area .wcspc-archive-title:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $html_tag = esc_html($settings['filter_products_shop_title_html_tag']);
        $archive_title = woocommerce_page_title(false);
        ?>
        <div class="wcspc-archive-data-area">
            <<?php echo $html_tag; ?> class="wcspc-archive-title">
                <?php echo esc_html($archive_title); ?>
            </<?php echo $html_tag; ?>>
        </div>
        <?php
    }
    
}
// add shop page title here