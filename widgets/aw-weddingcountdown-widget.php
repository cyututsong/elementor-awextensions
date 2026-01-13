<?php 
/**
 * Wedding Countdown for Elementor

 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;



class Weddingcountdown_Widget extends Widget_Base {


    public function get_name() {
        return 'weddingcountdown';
    }

    public function get_title() {
        return 'Wedding Countdown';
    }

    public function get_icon() {
        return 'eicon-clock';
    }

    public function get_categories() {
        return ['general'];
    }


    /*=====================================
    =       Adding controls          =
    =====================================*/    

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => 'Content',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'date',
            [
                'label' => 'Wedding Date & Time',
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'default' => $date = date('m/d/Y h:i:s a', time()),
            ]
        );

        $this->add_control(
            'theme',
            [
                'label' => 'Theme',
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => 'Default',
                    'dark' => 'Dark',
                    'light' => 'Light',
                ],
                'default' => 'default',
            ]
        );

        $this->end_controls_section();


        /*=====================================
        =            STYLE SECTION            =
        =====================================*/

        $this->start_controls_section(
            'weddingcountdown_style_section',
            [
                'label' => 'Typography & Colors',
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'wcountdown_typography',
                'label' => 'CountDown Typography',
                'selector' => '{{WRAPPER}} .ctn',
            ]
        );

        $this->add_control('time_color',
            [
                'label' => 'Time Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ctn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Generate unique ID for multiple countdowns
        $unique_id = uniqid('countdown_');

        echo '<div class="countdown ' . esc_attr($settings['theme']) . '" id="' . esc_attr($unique_id) . '" data-end-date="' . esc_attr($settings['date']) . '">
                Loading countdown...
                <noscript>Please enable JavaScript to view the countdown.</noscript>
              </div>';
    }




    // Enqueue CSS Only when the widget is used
    public function get_style_depends() {

        wp_register_style(
            'aw-weddingtimer-style',
            plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/weddingtimer.css',
            [],
            '1.0'
        );
        return [ 'aw-weddingtimer-style' ];

    }


    // Enqueue JS Only when the widget is used
    public function get_script_depends() {

        wp_register_script(
            'aw-weddingtimer-script',
            plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/weddingtimer.js',
            [],
            '1.0',
            true // load in footer
        );

        return [ 'aw-weddingtimer-script' ];
    }


}