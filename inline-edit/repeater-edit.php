<?php
class Inline_Repeater_Widget extends \Elementor\Widget_Base {
    
        public function get_name() {
            return 'my_widget'; // Unique name for the widget
        }
    
        public function get_title() {
            return __( 'Inline Text Widget', 'my-elementor-widget' );
        }
    
        public function get_icon() {
            return 'eicon-text-area'; // You can choose any icon you prefer
        }
    
        public function get_categories() {
            return [ 'general' ];
        }
    
        // Register the widget controls
        protected function _register_controls() {
    
            $this->start_controls_section(
                'content_section',
                [
                    'label' => __( 'Content', 'my-elementor-widget' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
    
            $this->add_control(
                'inline_text',
                [
                    'label' => __( 'Inline Text', 'my-elementor-widget' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'Click to edit text', 'my-elementor-widget' ),
                    'placeholder' => __( 'Type your text here', 'my-elementor-widget' ),
                ]
            );
    
            $this->end_controls_section();
        }
    
        // Render the widget output
        protected function render() {
            $settings = $this->get_settings_for_display();
            $inline_text = $settings['inline_text']; // Default text from the control
        
            // Get the saved text from the database, if available
            $saved_text = get_option( 'widget_inline_text_' . $this->get_id(), $inline_text );
        
            echo '<div class="my-inline-text-widget" contenteditable="true">' . esc_html( $saved_text ) . '</div>';
        }
    
        // For editor preview
        protected function _content_template() {
            ?>
            <#
            var inlineText = settings.inline_text;
            #>
            <div class="my-inline-text-widget" contenteditable="true">{{{ inlineText }}}</div>
            <?php
        }
    
    // Register and enqueue the JavaScript file
    public function _register_scripts() {
        add_action('elementor/frontend/after_register_scripts', function () {
            wp_enqueue_script(
                'test-repeater-js',
                plugin_dir_url(__FILE__) . 'inline-edit/test.js',
                ['jquery'],
                '1.0',
                true
            );
        });
    }
}
