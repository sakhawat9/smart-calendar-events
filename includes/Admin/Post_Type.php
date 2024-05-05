<?php

namespace Fixolab\SmartCalendarEvents\Admin;

/**
 * Post Type class
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/admin
 */

class Post_Type
{
    /**
     * Constructor
     */
    public function __construct()
    {
        add_action('init', [$this, 'register_smart_calendar_events_post_type']);
        add_action('manage_calendar-events_posts_columns', [$this, 'add_custom_columns']);
        add_action('manage_calendar-events_posts_custom_column', [$this, 'render_custom_columns'], 10, 2);
    }

    /**
     * Register the custom post type for calendar events.
     */
    public function register_smart_calendar_events_post_type()
    {
        if (post_type_exists('calendar-events')) {
            return;
        }

        $plugin_admin = new Post_Meta();

        $labels = array(
            'name'               => esc_html__('Calendar Events', 'smart-calendar-events'),
            'singular_name'      => esc_html__('Calendar Event', 'smart-calendar-events'),
            'menu_name'          => esc_html__('Calendar Events', 'smart-calendar-events'),
            'name_admin_bar'     => esc_html__('Calendar Event', 'smart-calendar-events'),
            'add_new'            => esc_html__('Add New Event', 'smart-calendar-events'),
            'add_new_item'       => esc_html__('Add New Event', 'smart-calendar-events'),
            'new_item'           => esc_html__('New Event', 'smart-calendar-events'),
            'edit_item'          => esc_html__('Edit Event', 'smart-calendar-events'),
            'view_item'          => esc_html__('View Event', 'smart-calendar-events'),
            'all_items'          => esc_html__('All Events', 'smart-calendar-events'),
            'search_items'       => esc_html__('Search Events', 'smart-calendar-events'),
            'parent_item_colon'  => esc_html__('Parent Events:', 'smart-calendar-events'),
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
            'supports'           => array('title', 'editor', 'excerpt', 'thumbnail'),
            'register_meta_box_cb' => array($plugin_admin, 'add_events_meta_box'),
        );

        register_post_type('calendar-events', $args);
    }

    public function add_custom_columns($columns)
    {

        $columns = array(
            'cb' => $columns['cb'],
            'title' => __( 'Title', 'smart-calendar-events' ),
            'event_date' => __( 'Event Date', 'smart-calendar-events' ),
            'date' => __( 'Date', 'smart-calendar-events' ),
          );

          return $columns;
    }

    public function render_custom_columns($column, $post_id)
    {
        if ($column === 'event_date') {
            $event_date = get_post_meta($post_id, 'event_date', true);
            echo esc_html($event_date);
        }
    }
}
