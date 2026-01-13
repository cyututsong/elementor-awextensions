<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register AW Custom JS field in Page Settings
 */
add_action( 'elementor/element/wp-page/document_settings/after_section_end', function( $element, $args ) {

    $element->start_controls_section(
        'aw_custom_js_section',
        [
            'label' => __( 'AW Custom JS', 'elementor-awextension' ),
            'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
        ]
    );

    $element->add_control(
        'aw_custom_js',
        [
            'label'       => __( 'Custom JavaScript', 'elementor-awextension' ),
            'type'        => \Elementor\Controls_Manager::CODE,
            'language'    => 'javascript',
            'rows'        => 20,
            'description' => __( 'Add page-specific JavaScript (no <script> tags needed).', 'elementor-awextension' ),
        ]
    );

    $element->end_controls_section();

}, 10, 2 );


/**
 * Output JS on frontend
 */
add_action( 'wp_footer', function() {
    if ( is_singular() ) {
        $post_id  = get_the_ID();
        $document = \Elementor\Plugin::$instance->documents->get( $post_id );

        if ( $document && method_exists( $document, 'get_settings' ) ) {
            $js = $document->get_settings( 'aw_custom_js' );
            if ( ! empty( $js ) ) {
                echo '<script id="aw-page-custom-js">
' . $js . '
</script>';
            }
        }
    }
});


/**
 * Output JS in Elementor live preview
 */
add_action( 'elementor/preview/enqueue_scripts', function() {
    if ( isset( $_GET['post'] ) ) {
        $post_id  = intval( $_GET['post'] );
        $document = \Elementor\Plugin::$instance->documents->get( $post_id );

        if ( $document && method_exists( $document, 'get_settings' ) ) {
            $js = $document->get_settings( 'aw_custom_js' );
            if ( ! empty( $js ) ) {
                echo '<script id="aw-preview-custom-js">
' . $js . '
</script>';
            }
        }
    }
});
