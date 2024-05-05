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
}
