<?php

namespace Fixolab\SmartCalendarEvents\Admin;

/**
 * Menu Class
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/admin
 */

class Menu
{
    /**
     * Constructor
     */
    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_submenu_page']);

        add_action('wp_ajax_get_month_events', [$this, 'get_month_events']);
        add_action('wp_ajax_nopriv_get_month_events', [$this, 'get_month_events']);
    }

    /**
     * Add submenu page under the Calendar Events menu.
     */
    public function add_submenu_page()
    {
        $calendar_events = new Calendar_Events();

        add_submenu_page(
            'edit.php?post_type=calendar-events',
            __('Calendar Events', 'smart-calendar-events'),
            __('Calendar Events', 'smart-calendar-events'),
            'manage_options',
            'calendar-events-submenu',
            array($calendar_events, 'get_current_month_events')
        );
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

    public function get_month_events()
    {
        $current_month = isset($_POST['month']) ? $_POST['month'] : '';
        $current_year = isset($_POST['year']) ? $_POST['year'] : '';

        $start_date = date('Y-m-01', strtotime($current_year . '-' . $current_month . '-01'));
        $end_date = date('Y-m-t', strtotime($current_year . '-' . $current_month . '-01'));

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

        ob_start();
        include_once __DIR__ . '/views/calendar-template.php';
        $output = ob_get_clean();

        echo $output;

        wp_die();
    }
}
