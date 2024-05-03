<?php

/**
 * The Custom Post Meta Class.
 *
 * @package smart-calendar-events
 */

namespace Fixolab\SmartCalendarEvents;

class Custom_Event_Admin_Page
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    public function add_admin_menu()
    {
        add_menu_page(
            'Events Calendar', // Page title
            'Events Calendar', // Menu title
            'manage_options', // Capability
            'events-calendar', // Menu slug
            array($this, 'display_admin_page'), // Callback function to display page content
            'dashicons-calendar', // Icon
            20 // Position
        );
    }

    public function display_admin_page()
    {
        // Display content of the custom admin page
?>
        <div class="wrap">
            <h1>Events Calendar</h1>
            <div id="calendar">
                <!-- Calendar content goes here -->
            </div>
        </div>
<?php
    }
}

new Custom_Event_Admin_Page();
