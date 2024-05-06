<?php

/**
 * The Frontend class
 *
 * @package smart-calendar-events
 */

namespace Fixolab\SmartCalendarEvents;

class Frontend {

	/**
	 * Constructor method to initialize frontend functionality.
	 */
	public function __construct() {
		add_filter( 'template_include', array( $this, 'load_event_template' ) );

		new Frontend\Shortcode();
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_assets' ) );
	}

	/**
	 * Enqueue frontend CSS styles.
	 */
	public function frontend_assets() {
		wp_enqueue_style( 'sce-frontend-style' );
	}

	/**
	 * Load custom templates for 'calendar-events' post type and its archive.
	 *
	 * @param string $template The template to include.
	 * @return string Custom template if available, otherwise the default template.
	 */
	public function load_event_template( $template ) {
		if ( is_singular( 'calendar-events' ) ) {
			$custom_template = SCE_DIR_PATH_TEMPLATES . 'single-calendar-events.php';
			if ( file_exists( $custom_template ) ) {
				return $custom_template;
			}
		}
		if ( is_post_type_archive( 'calendar-events' ) ) {
			return SCE_DIR_PATH_TEMPLATES . 'archive-calendar-events.php';
		}
		return $template;
	}
}
