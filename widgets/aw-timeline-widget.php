<?php

/**
 * Timeline Widget for Elementor

 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class RTimeline_Widget extends Widget_Base {

    public function get_name() {
        return 'rtimeline';
    }

    public function get_title() {
        return 'Custom Timeline';
    }

    public function get_icon() {
        return 'eicon-time-line';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function register_controls() {


        /*=====================================
        =            CONTENT SECTION            =
        =====================================*/

        $this->start_controls_section(
            'timeline_content',
            [
                'label' => 'Timeline Items'
            ]
        );

        // Repeater for timeline items
        $repeater = new Repeater();

        $repeater->add_control(
            'timeline_title',
            [
                'label' => 'Title (H2)',
                'type' => Controls_Manager::TEXT,
                'default' => 'Timeline Heading',
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'timeline_description',
            [
                'label' => 'Description',
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Timeline description goes here...',
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'timeline_date',
            [
                'label' => 'Date',
                'type' => Controls_Manager::TEXT,
                'default' => 'January 1, 2025'
            ]
        );

        $repeater->add_control(
            'timeline_image',
            [
                'label' => 'Image',
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'timeline_list',
            [
                'label' => 'Timeline List',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ timeline_title }}}'
            ]
        );

        $this->end_controls_section();


        /*=====================================
        =            STYLE SECTION            =
        =====================================*/

        $this->start_controls_section(
            'timeline_style_section',
            [
                'label' => 'Typography & Colors',
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        /* TITLE STYLE */
        $this->add_control(
            'title_color',
            [
                'label' => 'Title Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rtimeline-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => 'Title Typography',
                'selector' => '{{WRAPPER}} .rtimeline-title',
            ]
        );

        /* DESCRIPTION STYLE */
        $this->add_control(
            'description_color',
            [
                'label' => 'Description Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rtimeline-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => 'Description Typography',
                'selector' => '{{WRAPPER}} .rtimeline-description',
            ]
        );

        /*  DATE STYLE */

        $this->add_control(
            'date_color',
            [
                'label' => 'Date Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rtimeline-date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'label' => 'Date Typography',
                'selector' => '{{WRAPPER}} .rtimeline-date',
            ]
        );

        $this->end_controls_section();


    }

 
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['timeline_list'] ) ) return;

        echo '<div class="rtimeline">';

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
    }


    // Enqueue CSS Only when the widget is used
    public function get_style_depends() {

        wp_register_style(
            'aw-timeline-style',
            plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/timeline.css',
            [],
            '1.0'
        );
        return [ 'aw-timeline-style' ];
    }


    // Enqueue JS Only when the widget is used
    public function get_script_depends() {

        wp_register_script(
            'aw-timeline-script',
            plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/timeline.js',
            [],
            '1.0',
            true // load in footer
        );

        return [ 'aw-timeline-script' ];
    }


}

