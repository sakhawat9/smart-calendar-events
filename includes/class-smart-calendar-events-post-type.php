<?php if (!defined('ABSPATH')) {
	die;
} // Cannot access directly.


/**
 * Custom post class to register the events.
 */

 class Smart_Calendar_Events_Post_Type {
    /**
	 * Smart calender events post type
	 */
	function register_smart_calendar_events_post_type() {
		$labels = array(
			'name'               => esc_html__( 'Events', 'post type general name', 'smart-calendar-events' ),
			'singular_name'      => esc_html__( 'Event', 'post type singular name', 'smart-calendar-events' ),
			'menu_name'          => esc_html__( 'Events', 'admin menu', 'smart-calendar-events' ),
			'name_admin_bar'     => esc_html__( 'Event', 'add new on admin bar', 'smart-calendar-events' ),
			'add_new'            => esc_html__( 'Add New', 'event', 'smart-calendar-events' ),
			'add_new_item'       => esc_html__( 'Add New Event', 'smart-calendar-events' ),
			'new_item'           => esc_html__( 'New Event', 'smart-calendar-events' ),
			'edit_item'          => esc_html__( 'Edit Event', 'smart-calendar-events' ),
			'view_item'          => esc_html__( 'View Event', 'smart-calendar-events' ),
			'all_items'          => esc_html__( 'All Events', 'smart-calendar-events' ),
			'search_items'       => esc_html__( 'Search Events', 'smart-calendar-events' ),
			'parent_item_colon'  => esc_html__( 'Parent Events:', 'smart-calendar-events' ),
			'not_found'          => esc_html__( 'No events found.', 'smart-calendar-events' ),
			'not_found_in_trash' => esc_html__( 'No events found in Trash.', 'smart-calendar-events' )
		);
	
		$args = array(
			'labels'             => $labels,
			'description'        => esc_html__( 'Description.', 'smart-calendar-events' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'events' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			'register_meta_box_cb' => 'add_events_meta_box'
		);
	
		register_post_type( 'events', $args );
	}
 }