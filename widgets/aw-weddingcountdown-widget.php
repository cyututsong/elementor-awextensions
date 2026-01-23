<?php
/**
 * Wedding Countdown for Elementor
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Weddingcountdown_Widget extends Widget_Base {

    /*==============================
    =           META               =
    ==============================*/

    public function get_name() {
        return 'weddingcountdown';
    }

    public function get_title() {
        return __( 'Wedding Countdown', 'aw-wedding' );
    }

    public function get_icon() {
        return 'eicon-clock';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    /*==============================
    =         CONTROLS             =
    ==============================*/

    protected function register_controls() {

        /* -------- Content -------- */
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'aw-wedding' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'date',
            [
                'label'   => __( 'Wedding Date & Time', 'aw-wedding' ),
                'type'    => Controls_Manager::DATE_TIME,
                'default' => date( 'Y-m-d H:i:s' ),
                'render_type' => 'template',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'theme',
            [
                'label'   => __( 'Theme', 'aw-wedding' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'default' => __( 'Default', 'aw-wedding' ),
                    'dark'    => __( 'Dark', 'aw-wedding' ),
                    'light'   => __( 'Light', 'aw-wedding' ),
                ],
                'default' => 'default',
                'render_type'        => 'template',
                'frontend_available' => true,
            ]
        );


        $this->add_control(
            'countdown_style',
            [
                'label'   => 'Countdown Style',
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'  => 'Default',
                    'clock' => 'Clock Style',
                ],
            ]
        );       

        $this->end_controls_section();

        /* -------- Style -------- */
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Typography & Colors', 'aw-wedding' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'countdown_typography',
                'selector' => '{{WRAPPER}} .ctn',
            ]
        );

        $this->add_control(
            'time_color',
            [
                'label' => __( 'Time Color', 'aw-wedding' ),
                'type'  => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ctn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /*==============================
    =           RENDER             =
    ==============================*/

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $unique_id = 'countdown-' . $this->get_id();
        ?>

        <div
            id="<?php echo esc_attr( $unique_id ); ?>"
            class="countdown <?php echo esc_attr( $settings['theme'] ); ?>"
            data-end-date="<?php echo esc_attr( $settings['date'] ); ?>"
            data-style="<?php echo esc_attr( $settings['countdown_style'] ); ?>"
        >
            <?php esc_html_e( 'Loading countdown…', 'aw-wedding' ); ?>
            <noscript><?php esc_html_e( 'Please enable JavaScript to view the countdown.', 'aw-wedding' ); ?></noscript>
        </div>

        <?php
    }

    /*==============================
    =       ASSET LOADING          =
    ==============================*/

    public function get_style_depends() {
        wp_register_style(
            'aw-weddingtimer-style',
            plugin_dir_url( __DIR__ ) . 'assets/css/weddingtimer.css',
            [],
            '1.0'
        );

        return [ 'aw-weddingtimer-style' ];
    }

    public function get_script_depends() {
        wp_register_script(
            'aw-weddingtimer-script',
            plugin_dir_url( __DIR__ ) . 'assets/js/weddingtimer.js',
            [],
            '1.0',
            true
        );

        return [ 'aw-weddingtimer-script' ];
    }
}
