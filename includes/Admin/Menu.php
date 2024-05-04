<?php

namespace Fixolab\SmartCalendarEvents\Admin;
/**
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/admin
 */

class Menu
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_submenu_page'));
    }

    public function add_submenu_page()
    {
        $calendar_events = new Calendar_Events();

        add_submenu_page(
            'edit.php?post_type=calendar-events',
            __('Calendar Events', 'smart-calendar-events'),
            __('Calendar Events', 'smart-calendar-events'),
            'manage_options',
            'calendar-events-submenu',
            array($calendar_events, 'render_custom_admin_page')
        );
    }
}
