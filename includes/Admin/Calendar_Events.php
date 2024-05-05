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
        $current_month = date('n');
        $current_year = date('Y');

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
?>
        <div class="wrap">
            <h1 class="text-2xl font-bold mb-4"><?php echo esc_html__('Calendar Events', 'smart-calendar-events'); ?></h1>
            <header class="flex justify-between items-center py-4 px-6 border border-gray-200">
                <h1 id="calendarMonth" class="text-lg font-bold"><time><?php echo date('F Y', mktime(0, 0, 0, $current_month, 1, $current_year)); ?></time></h1>
                <div class="flex items-center space-x-4">
                    <button id="prevMonth" type="button" class="flex items-center space-x-1 px-2 py-1 rounded-md border border-gray-300 bg-white text-sm text-gray-700 hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <button id="nextMonth" type="button" class="flex items-center space-x-1 px-2 py-1 rounded-md border border-gray-300 bg-white text-sm text-gray-700 hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <button type="button" class="px-4 py-2 rounded-md bg-blue-500 text-white text-sm font-semibold hover:bg-blue-600">
                        <a class="hover:text-white" href="<?php echo esc_url(admin_url('post-new.php?post_type=calendar-events')); ?>"><?php esc_html_e('Add event', 'smart-calendar-events'); ?></a>
                    </button>
                </div>
            </header>
            <?php
            include_once __DIR__ . '/views/calendar-template.php';
            ?>
        </div>
<?php
    }
}
