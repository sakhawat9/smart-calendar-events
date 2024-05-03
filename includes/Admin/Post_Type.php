<?php

namespace Fixolab\SmartCalendarEvents\Admin;

/**
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/admin
 */

class Post_Type
{
    public function __construct()
    {
        add_action('init', array($this, 'register_smart_calendar_events_post_type'));
    }

    public function register_smart_calendar_events_post_type()
    {
        if (post_type_exists('calendar-events')) {
            return;
        }

        $plugin_admin = new Post_Meta();

        $labels = array(
            'name'               => esc_html__('Calendar Events', 'post type general name', 'smart-calendar-events'),
            'singular_name'      => esc_html__('Calendar Event', 'post type singular name', 'smart-calendar-events'),
            'menu_name'          => esc_html__('Calendar Events', 'admin menu', 'smart-calendar-events'),
            'name_admin_bar'     => esc_html__('Calendar Event', 'add new on admin bar', 'smart-calendar-events'),
            'add_new'            => esc_html__('Add New', 'event', 'smart-calendar-events'),
            'add_new_item'       => esc_html__('Add New Calendar Event', 'smart-calendar-events'),
            'new_item'           => esc_html__('New Calendar Event', 'smart-calendar-events'),
            'edit_item'          => esc_html__('Edit Calendar Event', 'smart-calendar-events'),
            'view_item'          => esc_html__('View Calendar Event', 'smart-calendar-events'),
            'all_items'          => esc_html__('All Calendar Events', 'smart-calendar-events'),
            'search_items'       => esc_html__('Search Calendar Events', 'smart-calendar-events'),
            'parent_item_colon'  => esc_html__('Parent Calendar Events:', 'smart-calendar-events'),
            'not_found'          => esc_html__('No events found.', 'smart-calendar-events'),
            'not_found_in_trash' => esc_html__('No events found in Trash.', 'smart-calendar-events')
        );

        $args = array(
            'labels'             => $labels,
            'description'        => esc_html__('Description.', 'smart-calendar-events'),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_icon'          => 'dashicons-calendar',
            'query_var'          => true,
            'rewrite'            => array('slug' => 'calendar-events'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array('title', 'editor', 'thumbnail'),
            'register_meta_box_cb' => array($plugin_admin, 'add_events_meta_box'), // No longer needed
        );

        register_post_type('calendar-events', $args);

    }
}
