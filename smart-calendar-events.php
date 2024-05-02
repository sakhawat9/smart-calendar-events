<?php
/*
Plugin Name: Smart Calendar Events
Description: Smart calendar events plugin for wordPress.
Version: 1.0
Requires at least: 5.2
Requires PHP: 7.2
Author: Foysal Imran 
Author URI: https://fixolab.com
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: smart-calendar-events
Domain Path: /languages
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Include the autoloader
// require_once __DIR__ . '/vendor/autoload.php';

define('SCE_BASENAME', plugin_basename(__FILE__));

require plugin_dir_path( __FILE__ ) . 'includes/class-smart-calendar-events.php.php';
/**
 * Begins execution of the plugin.
 * @since    1.0.0
 */
function smart_calendar_events_run() {

	$plugin = new Smart_Calendar_Events();
	$plugin->run();

}
smart_calendar_events_run();