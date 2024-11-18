<?php
if (!defined('ABSPATH')) {
    exit;
}

class Shop_Filters_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'shop_filters_widget';
    }

    public function get_title() {
        return __('Shop Filters', 'shop-filters');
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
            'slider_min',
            [
                'label' => __('Minimum Value', 'text-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0,
            ]
        );
        
        $this->add_control(
            'slider_max',
            [
                'label' => __('Maximum Value', 'text-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1000,
            ]
        );
        
        $this->add_control(
            'slider_values',
            [
                'label' => __('Initial Values', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '0,1000',
                'description' => __('Enter two comma-separated values, e.g., "0,1000".'),
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $maxPriceFilter = $settings['slider_max'];
        $minPriceFilter = $settings['slider_min'];
        if (function_exists('get_woocommerce_currency')) {
            $currency = get_woocommerce_currency_symbol();
        }
        echo '<div class="shop-products-filter" max-price-filter="'.esc_attr( $maxPriceFilter ).'" min-price-filter="'.esc_attr( $minPriceFilter ).'" filter-price-currency="'.$currency.'"></div>';
        ?>
        <div class="sidebar-form">
            <form id="filter-form">
                <p>
                    <label for="search">Search Products:</label>
                    <input type="text" name="search" id="search" value="" placeholder="Search Products">
                </p>
                <p>
                    <label>Categories:</label>
                    <div id="category-filters">
                        <?php
                        $categories = get_terms('product_cat', array('hide_empty' => true));
                        foreach ($categories as $category) {
                            echo '<label><input type="checkbox" name="categories[]" value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</label>';
                        }
                        ?>
                    </div>
                </p>
                <p>
                    <label>Tags:</label>
                    <div id="tag-filters">
                        <?php
                        $tags = get_terms('product_tag', array('hide_empty' => true));
                        foreach ($tags as $tag) {
                            echo '<label><input type="checkbox" name="tags[]" value="' . esc_attr($tag->slug) . '">' . esc_html($tag->name) . '</label>';
                        }
                        ?>
                    </div>
                </p>
                <p>
                    <label for="price-slider">Price Range:</label>
                    <div id="price-slider"></div>
                    <input type="hidden" name="min_price" id="min_price" value="">
                    <input type="hidden" name="max_price" id="max_price" value="">
                    <p id="price-range-display">Min: <?php echo $currency; ?> 0 - Max: <?php echo $currency; ?> 0</p>
                </p>
                <p class="filter-items">
                    <label for="in_stock">In Stock:</label>
                    <input type="checkbox" name="in_stock" id="in_stock">
                </p>
                <p class="filter-items">
                    <label for="featured">Featured Products:</label>
                    <input type="checkbox" name="featured" id="featured">
                </p>
                <p class="filter-items">
                    <label for="on_sale">On Sale:</label>
                    <input type="checkbox" name="on_sale" id="on_sale">
                </p>
                <p class="filter-items">
                    <label for="recent_products">Recent Products:</label>
                    <input type="checkbox" name="recent_products" id="recent_products">
                </p>
                <p class="filter-items">
                    <label for="top_sale_products">Top Sale Products:</label>
                    <input type="checkbox" name="top_sale_products" id="top_sale_products">
                </p>
                <p class="filter-items">
                    <label for="yearly_products">Current Year:</label>
                    <input type="checkbox" name="yearly_products" id="yearly_products">
                </p>
                <p class="filter-items">
                    <label for="monthly_products">Current Month:</label>
                    <input type="checkbox" name="monthly_products" id="monthly_products">
                </p>
                <p class="filter-items">
                    <label for="weight">Weight (kg):</label>
                    <input type="number" name="min_weight" id="min_weight" placeholder="Min">
                    <input type="number" name="max_weight" id="max_weight" placeholder="Max">
                </p>
                <p class="filter-items">
                    <label for="variable_product">Variable Products:</label>
                    <input type="checkbox" name="variable_product" id="variable_product">
                </p>
                <p class="filter-items">
                    <label for="affiliate_product">Affiliate Products:</label>
                    <input type="checkbox" name="affiliate_product" id="affiliate_product">
                </p>
            </form>
        </div>
        <?php
    }
}

// add products style grid and list icon in sidebar-form. when clicked grid then aproducts style will be grid and same as for list