<?php
namespace Fixolab\SmartCalendarEvents\Admin;
/**
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/admin
 */

class Post_Meta
{

    public function add_events_meta_box()
    {
        add_meta_box(
            'event_date',
            __('Event Date', 'smart-calendar-events'),
            array($this, 'event_date_meta_box_callback'),
            'calendar-events',
            'side',
            'default'
        );
    }

    public function event_date_meta_box_callback($post)
    {
        wp_nonce_field('event_date_meta_box', 'event_date_meta_box_nonce');

        $event_date = get_post_meta($post->ID, 'event_date', true);

        echo '<label for="event_date">';
        echo esc_html__('Date:', 'smart-calendar-events');
        echo '</label> ';
        echo '<input type="date" id="event_date" name="event_date" value="' . esc_attr($event_date) . '" />';
    }

    public function save_event_date_meta_box_data($post_id)
    {
        // Check if nonce field is set
        if (!isset($_POST['event_date_meta_box_nonce'])) {
            return;
        }

        // Verify nonce
        if (!wp_verify_nonce($_POST['event_date_meta_box_nonce'], 'event_date_meta_box')) {
            return;
        }

        // Check if autosave is in progress
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check if current user can edit post
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Check if event date is set in the post data
        if (!isset($_POST['event_date'])) {
            return;
        }

        // Sanitize event date
        $event_date = sanitize_text_field($_POST['event_date']);

        // Update post meta with sanitized event date
        update_post_meta($post_id, 'event_date', $event_date);
    }


    public function add_event_date_column($columns)
    {
        $columns['event_date'] = esc_html__('Event Date', 'smart-calendar-events');
        return $columns;
    }

    public function custom_event_date_column($column, $post_id)
    {
        if ('event_date' === $column) {
            $event_date = get_post_meta($post_id, 'event_date', true);
            echo $event_date;
        }
    }
}
