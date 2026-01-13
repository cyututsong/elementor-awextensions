<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Add Elementor Page Setting
add_action( 'elementor/element/wp-page/document_settings/after_section_end', function( $element, $args ) {
    $element->start_controls_section(
        'ft_music_section',
        [
            'label' => __( 'FT Music Player', 'ft-music' ),
            'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
        ]
    );

    $element->add_control(
        'ft_music_url',
        [
            'label'       => __( 'Audio URL', 'ft-music' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'placeholder' => __( 'Enter audio URL here', 'ft-music' ),
            'description' => __( 'Add the URL of the audio you want to play on this page.', 'ft-music' ),
        ]
    );

    $element->end_controls_section();
}, 10, 2 );


// Enqueue CSS & JS
function ft_music_enqueue_assets() {
    wp_enqueue_style( 
        'ft-music-style',
        plugins_url( 'assets/css/style.css', dirname(__FILE__) ),
        [],
        '1.0'
    );

    wp_enqueue_script( 
        'ft-music-script',
        plugins_url( 'assets/js/script.js', dirname(__FILE__) ),
        [],
        '1.0',
        true
    );

    wp_localize_script( 'ft-music-script', 'ftMusicData', array(
        'playIcon'  => plugins_url( 'icons/play.png', dirname(__FILE__) ),
        'pauseIcon' => plugins_url( 'icons/pause.png', dirname(__FILE__) ),
    ));
}
add_action( 'wp_enqueue_scripts', 'ft_music_enqueue_assets' );


// Display Audio Player in Footer
// Display Audio Player in Footer
add_action( 'wp_footer', function() {
    if ( ! is_singular() ) return;

    $post_id = get_the_ID();
    $settings = get_post_meta( $post_id, '_elementor_page_settings', true );

    if ( empty( $settings['ft_music_url'] ) ) return;

    $audio_url = esc_url( $settings['ft_music_url'] );
    ?>
    <audio id="bg-music" loop autoplay>
        <source src="<?php echo $audio_url; ?>" type="audio/mpeg">
        Your browser does not support the audio tag.
    </audio>

    <button id="music-toggle" class="music-btn">
        <img id="music-icon" src="<?php echo plugins_url( 'icons/pause.png', dirname(__FILE__) ); ?>" alt="Pause" />
    </button>
    <?php
});
