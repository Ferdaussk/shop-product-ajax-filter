<?php
/**

 */

// Display the filter form
function custom_search_filter_form() {
    ?>
    <form id="filter-form">
        <p>
            <label for="search">Search Products:</label>
            <input type="text" name="search" id="search" value="">
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
            <p id="price-range-display">Min: 0 - Max: 0</p>
        </p>
        <p>
            <button type="button" id="filter-button">Filter</button>
        </p>
    </form>
    <div id="filtered-products">
        <?php woocommerce_product_loop_start(); ?>
        <?php if (wc_get_loop_prop('total')) {
            while (have_posts()) {
                the_post();
                wc_get_template_part('content', 'product');
            }
        } ?>
        <?php woocommerce_product_loop_end(); ?>
    </div>
    <?php
}
add_action('woocommerce_before_shop_loop', 'custom_search_filter_form', 15);

// Handle AJAX filtering
add_action('wp_ajax_filter_products', 'filter_products');
add_action('wp_ajax_nopriv_filter_products', 'filter_products');

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
    if (!empty($_POST['min_price']) || !empty($_POST['max_price'])) {
        $meta_query = array();
        if (!empty($_POST['min_price'])) {
            $meta_query[] = array(
                'key'     => '_price',
                'value'   => sanitize_text_field($_POST['min_price']),
                'compare' => '>=',
                'type'    => 'NUMERIC',
            );
        }
        if (!empty($_POST['max_price'])) {
            $meta_query[] = array(
                'key'     => '_price',
                'value'   => sanitize_text_field($_POST['max_price']),
                'compare' => '<=',
                'type'    => 'NUMERIC',
            );
        }
        $args['meta_query'] = $meta_query;
    }

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

// Enqueue JavaScript and CSS
function enqueue_filter_script() {
    wp_enqueue_script('jquery-ui-slider');
    wp_enqueue_script('shop-filter', plugin_dir_url(__FILE__) . 'shop-filter.js', array('jquery', 'jquery-ui-slider'), null, true);
    wp_enqueue_style('jquery-ui-style', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    wp_localize_script('shop-filter', 'ajax_filter_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_filter_script');


