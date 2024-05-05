<?php

/**
 * Calendar event
 *
 * @link       https://fixolab.com
 * @since      1.0.0
 *
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/Admin
 */

namespace Fixolab\SmartCalendarEvents\Admin;

/**
 * Calendar event class
 *
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/admin
 */

class Calendar_Events
{
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

    public function get_current_month_events()
    {
        // Create nonce
        $nonce = wp_create_nonce( 'sce_event_nonce_action' );
        $current_month = gmdate('n');
        $current_year = gmdate('Y');

        $start_date = gmdate('Y-m-01', strtotime($current_year . '-' . $current_month . '-01'));
        $end_date = gmdate('Y-m-t', strtotime($current_year . '-' . $current_month . '-01'));

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
        $current_month_events = $events_query->posts;
        $num_days = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
?>
        <div class="wrap">
            <?php
            include_once __DIR__ . '/views/calendar-header.php';
            include_once __DIR__ . '/views/calendar-template.php';
            ?>
        </div>
<?php
    }
}
