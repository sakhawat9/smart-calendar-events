<?php

namespace Fixolab\SmartCalendarEvents\Admin;

/**
 * Post Meta class
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/admin
 */

class Post_Meta
{
    /**
     * Constructor
     */
    public function __construct()
    {
        add_action('save_post', [$this, 'save_event_date_meta_box_data']);
    }

    /**
     * Add meta box for event date.
     */
    public function add_events_meta_box()
    {
        add_meta_box(
            'event_date',
            __('Event Date', 'smart-calendar-events'),
            array($this, 'event_date_meta_box_callback'),
            'calendar-events',
            'normal',
            'default'
        );
    }

    /**
     * Callback function to render the event date meta box content.
     *
     * @param WP_Post $post The current post object.
     */
    public function event_date_meta_box_callback($post)
    {
        wp_nonce_field('event_date_meta_box', 'event_date_meta_box_nonce');

        $event_date = get_post_meta($post->ID, 'event_date', true);

        echo '<label for="event_date">';
        echo esc_html__('Date:', 'smart-calendar-events');
        echo '</label> ';
        echo '<input type="date" id="event_date" name="event_date" value="' . esc_attr($event_date) . '" />';
    }

    /**
     * Save event date meta box data when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save_event_date_meta_box_data($post_id)
    {
        if (!isset($_POST['event_date_meta_box_nonce'])) {
            return;
        }
        // Verify nonce
        if (!wp_verify_nonce($_POST['event_date_meta_box_nonce'], 'event_date_meta_box')) {
            return;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        if (!isset($_POST['event_date'])) {
            return;
        }
        $event_date = sanitize_text_field($_POST['event_date']);
        update_post_meta($post_id, 'event_date', $event_date);
    }
}
