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
            'perf_bar_settings', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

		// privacy section
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

        // budget section
        add_settings_section(
            'budget-section', // ID
            'Performance Budget', // Title
            array( $this, 'print_budget_info' ), // Callback
            'perf-bar-settings' // Page
        ); 

        add_settings_field(
            'loadTime', // ID
            'Load time', // Title 
            array( $this, 'loadTime_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'latency', // ID
            'Latency', // Title 
            array( $this, 'latency_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'frontEnd', // ID
            'Front End', // Title 
            array( $this, 'frontEnd_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );
		
		add_settings_field(
            'frontEnd', // ID
            'Front End', // Title 
            array( $this, 'frontEnd_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'backEnd', // ID
            'Back End', // Title 
            array( $this, 'backEnd_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

	}

	public function options_page () {

		$defaults = array('loadTime' => 5000, 'latency' => 50, 'frontEnd' => '', 'backEnd' => '');

		$this->options = get_option( 'perf_bar_settings' );

		foreach ($defaults as $key => $value) {
			if (!isset($this->options['budget'][$key])) {
				$this->options['budget'][$key] = $value;
			}
		}

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
		echo '<input type="checkbox" id="show_all" name="perf_bar_settings[show_all]" ' . (isset( $this->options['show_all'] ) ? 'checked' : '') . ' />';
    }

    public function print_section_info() {
    	echo 'How do you want the bar to show';
    }
	
	public function print_budget_info() {
    	echo 'Adjust the performance budget';
    }
    public function loadTime_callback () {
    	echo '<input type="text" id="loadTime" name="perf_bar_settings[budget][loadTime]" value="' . $this->options['budget']['loadTime'] . '" /> ms';
    }

	public function latency_callback () {
		echo '<input type="text" id="latency" name="perf_bar_settings[budget][latency]" value="' . $this->options['budget']['latency'] . '" /> ms';
	}

	public function frontEnd_callback () {
		echo '<input type="text" id="frontEnd" name="perf_bar_settings[budget][frontEnd]" value="' . $this->options['budget']['frontEnd'] . '" /> ms';
	}

	public function backEnd_callback () {
		echo '<input type="text" id="backEnd" name="perf_bar_settings[budget][backEnd]" value="' . $this->options['budget']['backEnd'] . '" /> ms';
	}


    public function sanitize( $input ) {
    	$rval = array('show_all' => $input['show_all']);
    	
    	if (isset($input['budget']['loadTime'])) {
    		$rval['budget']['loadTime'] = absint($input['budget']['loadTime']);
    	}

    	if (isset($input['budget']['latency'])) {
    		$rval['budget']['latency'] = absint($input['budget']['latency']);
    	}
    	
    	if (isset($input['budget']['frontEnd'])) {
    		$rval['budget']['frontEnd'] = absint($input['budget']['frontEnd']);
    	}

    	if (isset($input['budget']['backEnd'])) {
    		$rval['budget']['backEnd'] = absint($input['budget']['backEnd']);
    	}
    	return $rval;
    }
}
