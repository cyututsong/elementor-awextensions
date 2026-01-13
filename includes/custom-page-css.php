<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register AW Custom CSS control in Page Settings (Elementor Free)
 */
add_action( 'elementor/element/wp-page/document_settings/after_section_end', function( $element, $args ) {

    $element->start_controls_section(
        'aw_custom_css_section',
        [
            'label' => __( 'AW Custom CSS', 'elementor-awextension' ),
            'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
        ]
    );

    $element->add_control(
        'aw_custom_css',
        [
            'label'       => __( 'Custom CSS', 'elementor-awextension' ),
            'type'        => \Elementor\Controls_Manager::CODE,
            'language'    => 'css',
            'rows'        => 20,
            'description' => __( 'Add your page-specific CSS here.', 'elementor-awextension' ),
        ]
    );

    $element->end_controls_section();

}, 10, 2 );


/**
 * Output the CSS on frontend
 */
add_action( 'wp_head', function() {
    if ( is_singular() ) {
        $post_id = get_the_ID();
        $document = \Elementor\Plugin::$instance->documents->get( $post_id );

        if ( $document && method_exists( $document, 'get_settings' ) ) {
            $css = $document->get_settings( 'aw_custom_css' );
            if ( ! empty( $css ) ) {
                echo '<style id="aw-page-custom-css">' . $css . '</style>';
            }
        }
    }
});


/**
 * Output CSS in Elementor live preview iframe
 */
add_action( 'elementor/preview/enqueue_scripts', function() {
    if ( isset( $_GET['post'] ) ) {
        $post_id = intval( $_GET['post'] );
        $document = \Elementor\Plugin::$instance->documents->get( $post_id );

        if ( $document && method_exists( $document, 'get_settings' ) ) {
            $css = $document->get_settings( 'aw_custom_css' );
            if ( ! empty( $css ) ) {
                echo '<style id="aw-preview-custom-css">' . $css . '</style>';
            }
        }
    }
});
