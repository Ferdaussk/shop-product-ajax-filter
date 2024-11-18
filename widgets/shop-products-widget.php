<?php
if (!defined('ABSPATH')) {
    exit;
}

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

    protected function render() {
        ?>
        <!-- <div id="filtered-products"> -->
        <div id="filtered-products" class="products-grid">
            <?php woocommerce_product_loop_start(); ?>
            <?php if (wc_get_loop_prop('total')) {
                while (have_posts()) {
                    the_post();
                    wc_get_template_part('content', 'product');
                }
            } else {
                echo '<p>No products found</p>';
            } ?>
            <?php woocommerce_product_loop_end(); ?>
        </div>
        <?php
    }
}
