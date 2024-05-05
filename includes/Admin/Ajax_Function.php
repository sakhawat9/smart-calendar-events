<?php

namespace Fixolab\SmartCalendarEvents\Admin;

/**
 * Ajax_Function Class
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/admin
 */

class Ajax_Function
{
    /**
     * Constructor
     */
    public function __construct()
    {
        add_action('wp_ajax_get_month_events', [$this, 'get_month_events']);
        add_action('wp_ajax_nopriv_get_month_events', [$this, 'get_month_events']);
    }

    /**
     * Retrieves event titles for a specific date.
     *
     * @param array  $events An array of event posts.
     * @param string $date   The date to filter events by.
     * @return array An array of event titles.
     */
    public function get_event_titles_for_date($events, $date)
    {
        $titles = array();
        foreach ($events as $event) {
            $event_date = get_post_meta($event->ID, 'event_date', true);
            if ($event_date == $date) {
                $titles[] = $event;
            }
        }
        return $titles;
    }

    /**
     * Retrieves events for the selected month and year and updates the calendar.
     */
    public function get_month_events()
    {
        // Create nonce
        $nonce = wp_create_nonce( 'sce_event_nonce_action' );
        // Nonce verification
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'sce_event_nonce_action')) {
            wp_die('Nonce verification failed');
        }

        $current_month = isset($_POST['month']) ? $_POST['month'] : '';
        $current_year = isset($_POST['year']) ? $_POST['year'] : '';
        $start_date = gmdate('Y-m-01', strtotime($current_year . '-' . esc_attr($current_month) . '-01'));
        $end_date = gmdate('Y-m-t', strtotime($current_year . '-' . esc_attr($current_month) . '-01'));

        $args = array(
            'post_type'      => 'calendar-events',
            'posts_per_page' => -1,
            'meta_query'     => array(
                array(
                    'key'     => 'event_date',
                    'value'   => array($start_date, $end_date),
                    'compare' => 'BETWEEN',
                    'type'    => 'DATE',
                ),
            ),
        );

        $args = array(
            'post_type'      => 'calendar-events',
            'posts_per_page' => -1, // Consider limiting the number of posts
            'meta_query'     => array(
                'relation' => 'AND', // Adjust based on your needs
                array(
                    'key'     => 'event_date',
                    'value'   => $start_date,
                    'compare' => '>=',
                    'type'    => 'DATE',
                ),
                array(
                    'key'     => 'event_date',
                    'value'   => $end_date,
                    'compare' => '<=',
                    'type'    => 'DATE',
                ),
            ),
        );
        

        $events_query = new \WP_Query($args);
        $current_month_events = $events_query->posts;
        $num_days = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);

        ob_start();
        include_once __DIR__ . '/views/calendar-template.php';
        $output = ob_get_clean();

        echo wp_kses_post($output);

        wp_die();
    }
}
