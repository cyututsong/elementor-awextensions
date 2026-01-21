<?php
echo '<div class="rtimeline rtimeline-style-' . esc_attr( $timeline_style ) . '">';

foreach ( $settings['timeline_list'] as $item ) {

    /**
     * Get image URL (supports array, ID, or plain URL)
     */
    $image_url = '';

    if ( ! empty( $item['timeline_image'] ) ) {

        if ( is_array( $item['timeline_image'] ) ) {

            if ( ! empty( $item['timeline_image']['url'] ) ) {
                $image_url = $item['timeline_image']['url'];

            } elseif ( ! empty( $item['timeline_image']['id'] ) ) {
                $image_url = wp_get_attachment_image_url(
                    $item['timeline_image']['id'],
                    'full'
                );
            }

        } else {
            // Plain URL string
            $image_url = $item['timeline_image'];
        }
    }
    ?>

    <div class="rtimeline-item">

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
        <div class="rtime rtimeline-content animated-slow animated fadeInUp">
            <h2 class="rtimeline-title">
                <?php echo esc_html( $item['timeline_title'] ); ?>
            </h2>

            <div class="rtimeline-date">
                <?php echo esc_html( $item['timeline_date'] ); ?>
            </div>
        </div>

    </div>

    <?php
}

echo '</div>';
