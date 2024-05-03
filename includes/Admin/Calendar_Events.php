<?php

namespace Fixolab\SmartCalendarEvents\Admin;

/**
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/admin
 */

class Calendar_Events
{
    public function render_custom_admin_page()
    {
        // Retrieve events for the current month
        $current_month_events = $this->get_current_month_events();

        // Get current month and year
        $current_month = date('n');
        $current_year = date('Y');

        // Get the number of days in the current month
        $num_days = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);

        // Output the calendar
        echo '<div class="wrap">';
        echo '<h1>' . __('Calendar Events', 'smart-calendar-events') . '</h1>';
        echo '<div id="calendar">';
        echo '<table class="event-calendar">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>' . __('Sunday', 'smart-calendar-events') . '</th>';
        echo '<th>' . __('Monday', 'smart-calendar-events') . '</th>';
        echo '<th>' . __('Tuesday', 'smart-calendar-events') . '</th>';
        echo '<th>' . __('Wednesday', 'smart-calendar-events') . '</th>';
        echo '<th>' . __('Thursday', 'smart-calendar-events') . '</th>';
        echo '<th>' . __('Friday', 'smart-calendar-events') . '</th>';
        echo '<th>' . __('Saturday', 'smart-calendar-events') . '</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Start the calendar loop
        echo '<tr>';
        $day_of_week = date('w', mktime(0, 0, 0, $current_month, 1, $current_year));
        for ($i = 0; $i < $day_of_week; $i++) {
            echo '<td></td>'; // Output empty cells for days before the first day of the month
        }

        // Loop through each day of the month
        for ($day = 1; $day <= $num_days; $day++) {
            $date = mktime(0, 0, 0, $current_month, $day, $current_year);
            $event_date = date('Y-m-d', $date);
            $event_titles = $this->get_event_titles_for_date($current_month_events, $event_date);

            echo '<td>';
            echo '<strong>' . $day . '</strong><br>';
            if (!empty($event_titles)) {
                echo '<ul>';
                foreach ($event_titles as $event) {
                    $event_url = get_permalink($event->ID); // Get the URL of the single event page
                    echo '<li><a href="' . esc_url($event_url) . '">' . esc_html($event->post_title) . '</a></li>';
                }
                echo '</ul>';
            }
            echo '</td>';

            // Start a new row for each week
            if (date('w', $date) == 6) {
                echo '</tr><tr>';
            }
        }

        // Close the calendar loop
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }

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



    public function get_current_month_events()
    {
        // Get current month and year
        $current_month = date('n');
        $current_year = date('Y');

        // Set start and end dates for the current month
        $start_date = date('Y-m-01', strtotime($current_year . '-' . $current_month . '-01'));
        $end_date = date('Y-m-t', strtotime($current_year . '-' . $current_month . '-01'));

        // Query events for the current month
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

        $events_query = new \WP_Query($args);

        return $events_query->posts;
    }
}
