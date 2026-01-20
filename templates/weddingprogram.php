<?php
echo '<div class="rtimeline  rtimeline-style-' . esc_attr( $timeline_style ) . '">';

foreach ( $settings['timeline_list'] as $item ) {

    echo '<div class="rtimeline-item">';

    // TEXT CONTENT
    echo '<div class="rtime rtimeline-content animated-slow animated fadeInUp">';
        echo '<div class="rtimeline-date">'.esc_html($item['timeline_date']).'</div>';
        echo '<h2 class="rtimeline-title">'.esc_html($item['timeline_title']).'</h2>';
        echo '<p class="rtimeline-description">'.esc_html($item['timeline_description']).'</p>';
    echo '</div>';

    echo '</div>';
}

echo '</div>';
?>