<?php 
/**
 * Plugin Name: Elementor AW Extension
 * Description: An extension for Elementor Adding Awsome Features that you will love.
 * Version: 1.0.0
 * Author: DaddyRod
 * Author URI: https://daddyrod.com
 * License: GPL2
 */


if ( ! defined( 'ABSPATH' ) ) exit;

define( 'AW_EXTENSION_PATH', plugin_dir_path( __FILE__ ) );

require_once AW_EXTENSION_PATH . 'includes/custom-page-css.php';
require_once AW_EXTENSION_PATH . 'includes/custom-page-js.php';
require_once AW_EXTENSION_PATH . 'includes/floating-music.php';

function rtimeline_load_widget() {
    require_once AW_EXTENSION_PATH . 'widgets/aw-timeline-widget.php';
    \Elementor\Plugin::instance()->widgets_manager->register( new \RTimeline_Widget() );
}
add_action('elementor/widgets/register', 'rtimeline_load_widget');



function wcountdown_load_widget() {
    require_once AW_EXTENSION_PATH . 'widgets/aw-weddingcountdown-widget.php';
    \Elementor\Plugin::instance()->widgets_manager->register( new \Weddingcountdown_Widget() );
}
add_action('elementor/widgets/register', 'wcountdown_load_widget');