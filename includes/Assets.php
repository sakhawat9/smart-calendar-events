<?php

namespace Fixolab\SmartCalendarEvents;

/**
 * Assets handlers class
 */
class Assets {


	/**
	 * Constructor method to initialize assets
	 */
	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_assets' ) );
	}

	/**
	 * All available scripts
	 *
	 * @return array
	 */
	public function get_scripts() {
		return array(
			'sce-admin-script' => array(
				'src'     => SCE_ASSETS . '/js/custom-script.min.js',
				'version' => filemtime( SCE_PATH . '/assets/js/custom-script.min.js' ),
				'deps'    => array( 'jquery' ),
			),
		);
	}

	/**
	 * All available styles
	 *
	 * @return array
	 */
	public function get_styles() {
		return array(
			'sce-admin-style'    => array(
				'src'     => SCE_ASSETS . '/css/admin.min.css',
				'version' => filemtime( SCE_PATH . '/assets/css/admin.min.css' ),
			),

			'sce-frontend-style' => array(
				'src'     => SCE_ASSETS . '/css/frontend.css',
				'version' => filemtime( SCE_PATH . '/assets/css/frontend.css' ),
			),
		);
	}

	/**
	 * Register scripts and styles
	 *
	 * @return void
	 */
	public function register_assets() {
		$scripts = $this->get_scripts();
		$styles  = $this->get_styles();

		foreach ( $scripts as $handle => $script ) {
			$deps = isset( $script['deps'] ) ? $script['deps'] : false;
			wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
		}

		foreach ( $styles as $handle => $style ) {
			$deps = isset( $style['deps'] ) ? $style['deps'] : false;
			wp_register_style( $handle, $style['src'], $deps, $style['version'] );
		}
	}
}
