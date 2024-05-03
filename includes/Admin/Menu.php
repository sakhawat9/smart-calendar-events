<?php

namespace Fixolab\SmartCalendarEvents\Admin;

class Menu
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_submenu_page'));
    }

    public function add_submenu_page()
    {
        add_submenu_page(
            'edit.php?post_type=calendar-events',
            __('Submenu Page Title', 'smart-calendar-events'),
            __('Submenu Page', 'smart-calendar-events'),
            'manage_options',
            'calendar-events-submenu',
            array($this, 'submenu_page_callback')
        );
    }

    public function submenu_page_callback()
    {
        // Content of your submenu page
        echo '<div class="wrap">';
        echo '<h1>Submenu Page</h1>';
        echo '<p>This is a submenu page under the custom post type.</p>';
        echo '</div>';
    }
}
