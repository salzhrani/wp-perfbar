<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://lafikl.github.io/perfBar/
 * @since      1.0.0
 *
 * @package    Perf_Bar
 * @subpackage Perf_Bar/includes
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Perf_Bar
 * @subpackage Perf_Bar/admin
 * @author     Your Name <email@example.com>
 */
class Perf_Bar_Admin {

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
	 * @var      string    $name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $name, $version ) {

		$this->name = $name;
		$this->version = $version;

	}

	public function add_admin_menu() {
		
		add_options_page( 'PerfBar', 'PerfBar', 'manage_options', 'perf-bar', array($this, 'options_page' ));

	}
	public function settings_init() {
		
		register_setting(
            'my_option_group', // Option group
            'my_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'visibility-section', // ID
            'Bar Visibility', // Title
            array( $this, 'print_section_info' ), // Callback
            'perf-bar-settings' // Page
        );  

        add_settings_field(
            'show_all', // ID
            'Show only to logged users', // Title 
            array( $this, 'private_callback' ), // Callback
            'perf-bar-settings', // Page
            'visibility-section' // Section           
        );       

	}

	public function options_page () {

		$this->options = get_option( 'my_option_name' );

		?> 
		<div class="wrap">
			<h2>PerfBar Settings</h2>
			<form method="post" action="options.php">
				<?php 
				settings_fields( 'my_option_group' );   
                do_settings_sections( 'perf-bar-settings' );
                submit_button(); 
                ?>
			</form>
		</div>
	
		<?php
	}

	public function private_callback() {
            echo '<input type="checkbox" id="show_all" name="my_option_name[show_all]" ' . (isset( $this->options['show_all'] ) ? 'checked' : '') . ' />';
    }

    public function print_section_info() {
    	echo 'How do you want the bar to show';
    }

    public function sanitize( $input ) {
    	return $input;
    }
}
