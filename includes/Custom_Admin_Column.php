<?php 
/**
 * The Custom Post Meta Class.
 *
 * @package smart-calendar-events
 */

namespace Fixolab\SmartCalendarEvents;

class Custom_Event_Admin_Column {
    public function __construct() {
        add_filter('manage_events_posts_columns', array($this, 'add_event_date_column'));
        add_action('manage_events_posts_custom_column', array($this, 'display_event_date_column'), 10, 2);
    }

    public function add_event_date_column($columns) {
        $columns['event_date'] = esc_html__('Event Date', 'smart-calendar-events');
        return $columns;
    }

    public function display_event_date_column($column, $post_id) {
        if ('event_date' === $column) {
            $event_date = get_post_meta($post_id, 'event_date', true);
            echo $event_date;
        }
    }
}

new Custom_Event_Admin_Column();