<?php
echo '<div class="rtimeline rtimeline-style-' . esc_attr( $timeline_style ) . '">';

$index = 0; // Counter for left / right alignment

foreach ( $settings['timeline_list'] as $item ) {

    /**
     * Get image URL (supports Elementor image array)
     */
    $image_url = '';

    if ( ! empty( $item['timeline_image'] ) && is_array( $item['timeline_image'] ) ) {
        $image_url = ! empty( $item['timeline_image']['url'] )
            ? $item['timeline_image']['url']
            : '';
    }

    /**
     * Alternate alignment
     */
    $alignment = ( $index % 2 === 0 ) ? 'left' : 'right';
    ?>

    <div class="rtimeline-item rtimeline-<?php echo esc_attr( $alignment ); ?>">

        <!-- Image -->
        <div class="rtime rtimeline-image">
            <?php if ( $image_url ) : ?>
                <img
                    src="<?php echo esc_url( $image_url ); ?>"
                    alt="<?php echo esc_attr( $item['timeline_title'] ); ?>"
                >
            <?php endif; ?>
        </div>

        <!-- Content -->
        <div class="rtime rtimeline-content">

            <div class="rtimeline-date">
                <?php echo esc_html( $item['timeline_date'] ); ?>
            </div>

            <h2 class="rtimeline-title">
                <?php echo esc_html( $item['timeline_title'] ); ?>
            </h2>

            <p class="rtimeline-description">
                <?php echo esc_html( $item['timeline_description'] ); ?>
            </p>

        </div>

    </div>

    <?php
    $index++;
}

echo '</div>';
