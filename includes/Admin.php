<?php
/**
 * The admin class
 *
 * @package smart-calendar-events
 */

namespace Fixolab\SmartCalendarEvents;


class Admin {
    /**
	 * Constructor
	 */
	public function __construct() {	
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ] );
		// add_action('wp_ajax_get_calendar_events', 'get_calendar_events');
		// add_action('wp_ajax_nopriv_get_calendar_events', 'get_calendar_events');
		
		new Admin\Menu();
		new Admin\Post_Type();
    }    

	/**
     * Enqueue scripts and styles
     *
     * @return void
     */
    public function enqueue_admin_assets() {
        wp_enqueue_style( 'sce-admin-style' );
        wp_enqueue_script( 'sce-admin-script' );

		// wp_localize_script(
		// 	'sce-admin-script',
		// 	'scevents',
		// 	array(
		// 		'ajaxurl' => admin_url('admin-ajax.php'),
		// 		'nonce'   => wp_create_nonce('scevents_nonce'),
		// 	)
		// );
    }

}