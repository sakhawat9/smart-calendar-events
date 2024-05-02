<?php

/**
 * @package    Smart_Calendar_Events
 * @subpackage Smart_Calendar_Events/includes
 */

class Smart_Calendar_Events
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Smart_Calendar_Events_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name = SCE_BASENAME;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     */
    public function __construct()
    {
        $this->define_constants();
        $this->load_dependencies();
        $this->define_common_hooks();
        // $this->define_admin_hooks();
        // $this->define_public_hooks();
        $this->set_locale();
    }

    /**
	 * Define constant if not already set
	 *
	 * @since 2.2.0
	 *
	 * @param string      $name Define constant.
	 * @param string|bool $value Define constant.
	 */
	public function define($name, $value)
	{
		if (!defined($name)) {
			define($name, $value);
		}
	}

    /**
     * Define constants
     */
    public function define_constants()
    {
        $this->define('SCE_VERSION', $this->version);
        $this->define('SCE_PLUGIN_NAME', $this->plugin_name);
        $this->define('SCE_PATH', plugin_dir_path(dirname(__FILE__)));
        $this->define('SCE_URL', plugin_dir_url(dirname(__FILE__)));
    }

    /**
     * Load the required dependencies for this plugin.
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once SCE_PATH . 'includes/class-smart-calendar-events-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once SCE_PATH . 'includes/class-smart-calendar-events-post-type.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once SCE_PATH . 'includes/class-smart-calendar-events-i18n.php';

        // /**
        //  * The class responsible for defining all actions that occur in the admin area.
        //  */
        // require_once SCE_PATH . 'admin/class-smart-calendar-events-admin.php';

        // /**
        //  * The class responsible for defining metabox config that occur in the admin area.
        //  */
        // require_once SCE_PATH . 'admin/helpers/class-smart-calendar-events-image-resizer.php';

        // /**
        //  * The class responsible for defining all actions that occur in the public-facing
        //  * side of the site.
        //  */
        // require_once SCE_PATH . 'public/class-smart-calendar-events-public.php';

        $this->loader = new Smart_Calendar_Events_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {

        $plugin_i18n = new Smart_Calendar_Events_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register common hooks.
     *
     * @since 1.0.0
     * @access private
     */
    private function define_common_hooks()
    {
        $common_hooks = new Smart_Calendar_Events_Post_Type(SCE_PLUGIN_NAME, SCE_VERSION);
        $this->loader->add_action('init', $common_hooks, 'register_smart_calendar_events_post_type', 10);
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }
}
