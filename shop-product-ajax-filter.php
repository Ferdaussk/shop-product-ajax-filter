<?php
/**
 * Plugin Name: Shop Product Ajax Filter
 * Description: Add Elementor widgets for WooCommerce shop filters and products.
 * Version: 1.0
 * Author: FERDAUS SK
 */

// Ensure Elementor is active
if (!defined('ABSPATH')) {
    exit;
}

// Include Elementor classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Register custom Elementor widgets
add_action('elementor/widgets/widgets_registered', function () {
    // Shop Filters Widget
    require_once plugin_dir_path(__FILE__) . 'widgets/shop-filters-widget.php';
    \Elementor\Plugin::instance()->widgets_manager->register(new \Shop_Filters_Widget());

    // Filtered Products Widget
    require_once plugin_dir_path(__FILE__) . 'widgets/shop-products-widget.php';
    \Elementor\Plugin::instance()->widgets_manager->register(new \Shop_Products_Widget());

    // Filtered Products Widget
    require_once plugin_dir_path(__FILE__) . 'widgets/shop-toggle-widget.php';
    \Elementor\Plugin::instance()->widgets_manager->register(new \Shop_Toggle_Widget());
});

// Enqueue scripts for widgets
function enqueue_elementor_widget_scripts() {
    wp_enqueue_script('jquery-ui-slider');
    wp_enqueue_script('shop-filter', plugin_dir_url(__FILE__) . 'shop-filter.js', array('jquery', 'jquery-ui-slider'), null, true);
    wp_enqueue_script('shop-toggle', plugin_dir_url(__FILE__) . 'toggle.js', array('jquery'), null, true);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4');
    wp_enqueue_style('shop-filter', plugin_dir_url(__FILE__) . 'shop-filter.css', null, null, 'all');
    wp_enqueue_style('jquery-ui-style', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    wp_localize_script('shop-filter', 'ajax_filter_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_elementor_widget_scripts');


add_action('wp_ajax_filter_products', 'filter_products');
add_action('wp_ajax_nopriv_filter_products', 'filter_products');
// Add custom filtering functionality based on new inputs
function filter_products() {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 10,
        'post_status' => 'publish',
    );

    // Search query
    if (!empty($_POST['search'])) {
        $args['s'] = sanitize_text_field($_POST['search']);
    }

    // Category filter
    if (!empty($_POST['categories'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => array_map('sanitize_text_field', $_POST['categories']),
            'operator' => 'IN',
        );
    }

    // Tag filter
    if (!empty($_POST['tags'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_tag',
            'field'    => 'slug',
            'terms'    => array_map('sanitize_text_field', $_POST['tags']),
            'operator' => 'IN',
        );
    }

    // Price range filter
    if (!empty($_POST['min_price'])) {
        $args['meta_query'][] = array(
            'key'     => '_price',
            'value'   => $_POST['min_price'],
            'compare' => '>=',
            'type'    => 'NUMERIC',
        );
    }
    if (!empty($_POST['max_price'])) {
        $args['meta_query'][] = array(
            'key'     => '_price',
            'value'   => $_POST['max_price'],
            'compare' => '<=',
            'type'    => 'NUMERIC',
        );
    }

    // In stock filter
    if (!empty($_POST['in_stock'])) {
        $args['meta_query'][] = array(
            'key'     => '_stock_status',
            'value'   => 'instock',
            'compare' => '=',
        );
    }

    // Featured products filter
    if (!empty($_POST['featured'])) {
        $args['meta_query'][] = array(
            'key'     => '_featured',
            'value'   => 'yes',
            'compare' => '=',
        );
    }

    // Sale filter
    if (!empty($_POST['on_sale'])) {
        $args['meta_query'][] = array(
            'key'     => '_sale_price',
            'value'   => '0',
            'compare' => '>',
            'type'    => 'NUMERIC',
        );
    }

    // Recent products filter (by publish date)
    if (!empty($_POST['recent_products'])) {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    }

    // Top Sale products filter (you may need to define criteria for "Top Sale" based on your setup)
    if (!empty($_POST['top_sale_products'])) {
        // Add criteria for top sale products, e.g., highest sales or custom meta
    }

    // Yearly products filter (based on publish year)
    if (!empty($_POST['yearly_products'])) {
        $args['date_query'] = array(
            array(
                'year' => date('Y'),
            ),
        );
    }

    // Monthly products filter (based on publish month)
    if (!empty($_POST['monthly_products'])) {
        $args['date_query'] = array(
            array(
                'month' => date('m'),
                'year'  => date('Y'),
            ),
        );
    }

    // Weight filter
    if (!empty($_POST['min_weight'])) {
        $args['meta_query'][] = array(
            'key'     => '_weight',
            'value'   => $_POST['min_weight'],
            'compare' => '>=',
            'type'    => 'NUMERIC',
        );
    }
    if (!empty($_POST['max_weight'])) {
        $args['meta_query'][] = array(
            'key'     => '_weight',
            'value'   => $_POST['max_weight'],
            'compare' => '<=',
            'type'    => 'NUMERIC',
        );
    }

    // Variable products filter
    if (!empty($_POST['variable_product'])) {
        $args['post_type'] = 'product_variation';
    }

    // Affiliate products filter
    if (!empty($_POST['affiliate_product'])) {
        $args['meta_query'][] = array(
            'key'     => '_product_url',
            'value'   => '',
            'compare' => '!=',
        );
    }

    // Run the custom query
    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            wc_get_template_part('content', 'product');
        }
    } else {
        echo '<p>No products found</p>';
    }
    wp_reset_postdata();

    echo ob_get_clean();
    wp_die();
}
