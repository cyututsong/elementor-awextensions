<?php
echo '<div class="rtimeline  rtimeline-style-' . esc_attr( $timeline_style ) . '">';

$i = 0; // counter for alternation

foreach ( $settings['timeline_list'] as $item ) {

    $image_url = isset($item['timeline_image']['url']) ? $item['timeline_image']['url'] : '';

    // Add alternating class
    $alignment = ($i % 2 == 0) ? 'left' : 'right';

    echo '<div class="rtimeline-item rtimeline-' . $alignment . '">';

    // IMAGE
    echo '<div class="rtime rtimeline-image">';
        if ( $image_url ) {
            echo '<img src="'.esc_url($image_url).'" alt="'.esc_attr($item['timeline_title']).'">';
        }
    echo '</div>';

    // TEXT CONTENT
    echo '<div class="rtime rtimeline-content animated-slow animated fadeInUp">';
        echo '<div class="rtimeline-date">'.esc_html($item['timeline_date']).'</div>';
        echo '<h2 class="rtimeline-title">'.esc_html($item['timeline_title']).'</h2>';
        echo '<p class="rtimeline-description">'.esc_html($item['timeline_description']).'</p>';
    echo '</div>';

    echo '</div>';

    $i++;
}

echo '</div>';
?>