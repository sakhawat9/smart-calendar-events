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
require_once __DIR__ . '/vendor/autoload.php';
use Fixolab\SmartCalendarEvents\Assets;
use Fixolab\SmartCalendarEvents\Admin;
use Fixolab\SmartCalendarEvents\Frontend;
/**
 * The main plugin class
 */
class Smart_Calendar_Events
{
    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0';

    /**
     * Class construcotr
     */
    public function __construct()
    {
        $this->define_constants();
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants()
    {
        define('SCE_VERSION', self::version);
        define('SCE_BASENAME', plugin_basename(__FILE__));
        define('SCE_FILE', __FILE__);
        define('SCE_PATH', __DIR__);
        define('SCE_DIR_PATH', plugin_dir_path(__FILE__));
        define('SCE_URL', plugins_url('', SCE_FILE));
        define('SCE_ASSETS', SCE_URL . '/assets');
        define('SCE_DIR_PATH_TEMPLATES', SCE_DIR_PATH . 'templates/');
    }
    
    /**
     * Initializes a singleton instance
     *
     * @return \Smart_Calendar_Events
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }
    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin()
    {
        new Assets();
        new Admin();
        new Frontend();
        load_plugin_textdomain('smart-calendar-events', false, dirname(SCE_BASENAME) . '/languages/');
    }

}

/**
 * Initializes the main plugin
 *
 * @return \Smart_Calendar_Events
 */
function smart_calendar_events_operations()
{
    return Smart_Calendar_Events::init();
}

// kick-off the plugin
smart_calendar_events_operations();
