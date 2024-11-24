<?php
/**
 * Plugin Name: AA AAA My Inline Widget
 * Description: Custom Elementor widget with inline text editing.
 * Version: 1.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * Text Domain: my-elementor-widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


function bwd_load_textdomain() {
    load_plugin_textdomain('bwd-elementor-addons-pro', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    load_plugin_textdomain('bwd-elementor-addons', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'bwd_load_textdomain');


// Register the widget
function register_my_elementor_widget( $widgets_manager ) {
    require_once( __DIR__ . '/inline-edit/repeater-edit.php' );
    $widgets_manager->register( new \Inline_Repeater_Widget() );
}
add_action( 'elementor/widgets/register', 'register_my_elementor_widget' );

function my_elementor_widget_enqueue_scripts() {
    wp_enqueue_script( 'my-inline-edit-script', plugin_dir_url( __FILE__ ) . 'inline-edit/test.js', array( 'jquery' ), null, true );
    wp_localize_script( 'my-inline-edit-script', 'myElementorWidget', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'ajax_nonce' => wp_create_nonce( 'save_inline_text_nonce' ), // Nonce for security
    ) );
}
add_action( 'wp_enqueue_scripts', 'my_elementor_widget_enqueue_scripts' );



function save_inline_text() {
    // Verify nonce for security
    if ( ! isset( $_POST['security'] ) || ! wp_verify_nonce( $_POST['security'], 'save_inline_text_nonce' ) ) {
        wp_send_json_error( ['message' => 'Security check failed.'] );
    }

    // Validate widget ID and inline text
    if ( ! isset( $_POST['widget_id'] ) || ! isset( $_POST['inline_text'] ) ) {
        wp_send_json_error( ['message' => 'Missing required data.'] );
    }

    $widget_id = sanitize_text_field( $_POST['widget_id'] );
    $inline_text = sanitize_textarea_field( $_POST['inline_text'] );

    // Debug: Log the received data
    error_log("Received widget ID: " . $widget_id);
    error_log("Received text: " . $inline_text);

    // Save the text using update_option or post meta
    $option_name = 'widget_inline_text_' . $widget_id;
    $save_result = update_option( $option_name, $inline_text );  // Update option with new text

    if ( $save_result ) {
        wp_send_json_success( ['message' => 'Text saved successfully.'] );
    } else {
        wp_send_json_error( ['message' => 'Failed to save text.'] );
    }
}
add_action( 'wp_ajax_save_inline_text', 'save_inline_text' ); // For logged-in users
add_action( 'wp_ajax_nopriv_save_inline_text', 'save_inline_text' ); // For non-logged-in users (if needed)
