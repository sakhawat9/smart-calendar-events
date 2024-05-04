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
        add_filter('template_include', [$this, 'load_event_template']);
        $this->define_constants();

        add_action('plugins_loaded', [$this, 'init_plugin']);

        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
        add_action('wp_enqueue_scripts', [$this, 'frontend_enqueue_scripts']);
    }
    public function load_event_template($template)
    {
        if (is_singular('calendar-events')) {
            $custom_template = plugin_dir_path(__FILE__) . 'templates/single-calendar-events.php';
            if (file_exists($custom_template)) {
                return $custom_template;
            }
        }
        if (is_post_type_archive('calendar-events')) {
            return plugin_dir_path(__FILE__) . 'templates/archive-calendar-events.php';
        }
        return $template;
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
        define('SCE_URL', plugins_url('', SCE_FILE));
        define('SCE_ASSETS', SCE_URL . '/assets');
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
        new Fixolab\SmartCalendarEvents\Assets();
        new Fixolab\SmartCalendarEvents\Admin();
        new Fixolab\SmartCalendarEvents\Frontend();
    }
    public function admin_enqueue_scripts($hook)
    {
        if ($hook == 'calendar-events_page_calendar-events-submenu') {
            wp_enqueue_script('admin-page-tailwind', '//cdn.tailwindcss.com', [], '1.0', [
                'in_footer' => true,
                'strategy' => 'defer'
            ]);
        }
    }
    public function frontend_enqueue_scripts()
    {
        wp_enqueue_style('tailwind-css', '//cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
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
