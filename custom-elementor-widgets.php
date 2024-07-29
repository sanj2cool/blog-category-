<?php
/*
Plugin Name: Custom Elementor Widgets
Description: Custom Elementor widgets for your site.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function register_custom_elementor_widgets() {
    require_once(__DIR__ . '/widgets/post-categories-grid.php');
}

add_action('elementor/widgets/widgets_registered', 'register_custom_elementor_widgets');
?>
