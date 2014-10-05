<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://lafikl.github.io/perfBar/
 * @since      1.0.0
 *
 * @package    Perf_Bar
 * @subpackage Perf_Bar/includes
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Perf_Bar
 * @subpackage Perf_Bar/admin
 * @author     Your Name <email@example.com>
 */
class Perf_Bar_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $name    The ID of this plugin.
	 */
	private $name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $name       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $name, $version ) {

		$this->name = $name;
		$this->version = $version;

	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Perf_Bar_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Perf_Bar_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$options = get_option( 'perf_bar_settings' );
		error_log('options');
		error_log(json_encode($options));
		$show_all = $options['show_all'];

		if ($show_all === 'on' || is_user_logged_in()) {

			wp_enqueue_script( $this->name, plugin_dir_url( __FILE__ ) . 'js/perfbar.js', '', $this->version, true );

			wp_register_script ( $this->name . '-boot', plugin_dir_url( __FILE__ ) . 'js/perf-bar-boot.js', '', $this->version, true);

			$defaults = array('loadTime' => 5000, 'latency' => 50, 'frontEnd' => '', 'backEnd' => '');

			foreach ($defaults as $key => $value) {
				if (!isset($options['budget'][$key])) {
					$options['budget'][$key] = $value;
				}
			}

			wp_localize_script( $this->name . '-boot' , 'budgets', $options['budget']);

			wp_enqueue_script( $this->name . '-boot' );

		}

	}

}
