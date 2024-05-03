<?php 
/**
 * The Custom Post Meta Class.
 *
 * @package smart-calendar-events
 */

namespace Fixolab\SmartCalendarEvents;

class Custom_Event_Meta {
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post', array($this, 'save_event_date'));
    }

    public function add_meta_box() {
        add_meta_box(
            'event_date',
            __('Event Date', 'smart-calendar-events'),
            array($this, 'event_date_meta_box_callback'),
            'calendar-events',
            'side',
            'default'
        );
    }

    public function save_event_date($post_id) {
        wp_nonce_field('event_date_meta_box', 'event_date_meta_box_nonce');

        $event_date = get_post_meta($post_id, 'event_date', true);

        echo '<label for="event_date">';
        echo esc_html__('Date:', 'smart-calendar-events');
        echo '</label> ';
        echo '<input type="date" id="event_date" name="event_date" value="' . esc_attr($event_date) . '" />';
    }
}

new Custom_Event_Meta();