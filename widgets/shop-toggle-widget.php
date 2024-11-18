<?php
if (!defined('ABSPATH')) {
    exit;
}

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

    protected function render() {
        ?>
        <div class="view-toggle">
            <label>
                <input type="radio" name="view_style" value="grid" checked>
                <span class="toggle-icon grid-icon" title="Grid View">
                    <i class="fas fa-th-large"></i> <!-- Grid icon -->
                </span>
            </label>
            <label>
                <input type="radio" name="view_style" value="list">
                <span class="toggle-icon list-icon" title="List View">
                    <i class="fas fa-list"></i> <!-- List icon -->
                </span>
            </label>
        </div>
        <?php
    }
    
}

// for grid and list text add icon not text 