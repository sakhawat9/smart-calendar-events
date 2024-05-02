<?php

/**
 * Define the internationalization functionality
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/includes
 */

/**
 * Define the internationalization functionality.
 * @since      1.0.0
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/includes
 */
class Smart_Calendar_Events_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'smart-calendar-events',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
