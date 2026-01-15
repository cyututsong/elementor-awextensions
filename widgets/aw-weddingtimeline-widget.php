<?php

/**
 * Wedding Timeline Widget for Elementor
 * 
 */


if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;


class AW_WeddingTimeline_Widget extends Widget_Base {

    public function get_name() {
        return 'aw_weddingtimeline';
    }

    public function get_title() {
        return 'Wedding Timeline';
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
            'weddingtimeline_content',
            [
                'label' => 'Wedding Timeline Items'
            ]
        );

        $repeat->add_control(
            'weddingtimeline_title',
            [
                'label' => 'Title (H2)',
                'type' => Controls_Manager::TEXT,
                'default' => 'Wedding Timeline Heading',
                'label_block' => true
            ]
        );

        @repeat->add_control(
            'weddingtimeline_description',
            [
                'label' => 'Description',
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'This is the wedding timeline description.',
                'show_label' => false
            ]
        );

        $repaeat->add_control(
            'weddingtimeline_image',
            [
                'label' => 'Image',
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );


        $this->add_control(
            'weddingtimeline_list',
            [
                'label' => 'Timeline Items',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'weddingtimeline_title' => 'Engagement',
                        'weddingtimeline_description' => 'Our engagement day.',
                    ],
                    [
                        'weddingtimeline_title' => 'Bridal Shower',
                        'weddingtimeline_description' => 'Celebrating with friends and family.',
                    ],
                ],
                'title_field' => '{{{ weddingtimeline_title }}}',
            ]
        );  

        $this->end_controls_section();

        /*=====  End of CONTENT SECTION  ======*/




        /*===================================== 
        =            STYLE SECTION            =
        =====================================*/


        $this->start_controls_section(
            'weddingtimeline_style',
            [
                'label' => 'Style Settings',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();

        /*=====  End of STYLE SECTION  ======*/


    }


    protected function render() {
        $settings = $this->get_settings_for_display();

       if ( empty( $settings['weddingtimeline_list'] ) ) return;

        
        echo '<div class="aw-wedding-timeline-widget">';  
        
        $i = 0;


          foreach ( $settings['weddingtimeline_list'] as $item ) {

            $image_url = isset($item['weddingtimeline_image']['url']) ? $item['weddingtimeline_image']['url'] : '';

            // Add alternating class
            $alignment = ($i % 2 == 0) ? 'left' : 'right';

            echo '<div class="weddingtimeline-item rtimeline-' . $alignment . '">';

            // IMAGE
            echo '<div class="rtime weddingtimeline-image">';
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