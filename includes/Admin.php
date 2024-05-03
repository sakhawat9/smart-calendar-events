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
		add_action( 'admin_menu', [$this, 'wpdocs_register_my_custom_menu_page'] );
		
		new Admin\Post_Type();
    }
	function wpdocs_register_my_custom_menu_page(){
		add_menu_page( 
			__( 'Custom Menu Title', 'textdomain' ),
			'custom menu',
			'manage_options',
			'custompage',
			'my_custom_menu_page',
			plugins_url( 'myplugin/images/icon.png' ),
			6
		); 
	}
    
}