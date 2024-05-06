<?php

/**
 * The admin class
 *
 * @package smart-calendar-events
 */

namespace Fixolab\SmartCalendarEvents;

class Admin {

	/**
	 * Constructor method to initialize admin functionality.
	 */
	public function __construct() {
		new Admin\Menu();
		new Admin\Post_Type();
		new Admin\Ajax_Function();
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
	}

	/**
	 * Enqueue scripts and styles
	 *
	 * @return void
	 */
	public function enqueue_admin_assets( $hook ) {
		if ( $hook === 'calendar-events_page_calendar-events-submenu' || $hook === 'calendar-events_page_calendar-events-help' ) {
			wp_enqueue_style( 'sce-admin-style' );
			wp_enqueue_script( 'sce-admin-script' );
		}
	}
}
