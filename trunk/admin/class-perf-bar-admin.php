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

        add_settings_field(
            'respnseDuration', // ID
            'Response Duration', // Title 
            array( $this, 'respnseDuration_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'requestDuration', // ID
            'Request Duration', // Title 
            array( $this, 'requestDuration_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'redirectCount', // ID
            'Redirects', // Title 
            array( $this, 'redirectCount_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'loadEventTime', // ID
            'Load Event duration', // Title 
            array( $this, 'loadEventTime_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'domContentLoaded', // ID
            'DOM Content loaded', // Title 
            array( $this, 'domContentLoaded_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'processing', // ID
            'Processing Duration', // Title 
            array( $this, 'processing_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'numOfEl', // ID
            'DOM elements', // Title 
            array( $this, 'numOfEl_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'cssCount', // ID
            'CSS', // Title 
            array( $this, 'cssCount_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'jsCount', // ID
            'JavaScript', // Title 
            array( $this, 'jsCount_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'imgCount', // ID
            'Images', // Title 
            array( $this, 'imgCount_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'dataURIImagesCount', // ID
            'Data URI images', // Title 
            array( $this, 'dataURIImagesCount_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'inlineCSSCount', // ID
            'Inline CSS', // Title 
            array( $this, 'inlineCSSCount_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'inlineJSCount', // ID
            'Inline JavaScript', // Title 
            array( $this, 'inlineJSCount_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'thirdCSS', // ID
            '3rd Party CSS', // Title 
            array( $this, 'thirdCSS_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'thirdJS', // ID
            '3rd Party JavaScript', // Title 
            array( $this, 'thirdJS_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );

        add_settings_field(
            'globalJS', // ID
            'JavaScript Globals', // Title 
            array( $this, 'globalJS_callback' ), // Callback
            'perf-bar-settings', // Page
            'budget-section' // Section           
        );
	}

	public function options_page () {

		$defaults = array(
                        'loadTime' => array('max' => 5000, 'min' => '', 'disable' => false), 
                        'latency' => array('max' => 50, 'min' => '', 'disable' => false), 
                        'frontEnd' => array('max' => '', 'min' => '', 'disable' => false), 
                        'backEnd' => array('max' => '', 'min' => '', 'disable' => false));

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
                echo 'here';
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
    	echo 'Min: <input type="text" id="loadTime" name="perf_bar_settings[budget][loadTime][min]" value="' . $this->get_val($this->options, array('budget','loadTime','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][loadTime][max]" value="' . $this->get_val($this->options, array('budget','loadTime','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" value="true" name="perf_bar_settings[budget][loadTime][disable]" value="true" ' . ($this->get_val($this->options, array('budget','loadTime','disable')) ? 'checked' : '') . '>';
    }

	public function latency_callback () {
        echo 'Min: <input type="text" id="latency" name="perf_bar_settings[budget][latency][min]" value="' . $this->get_val($this->options, array('budget','latency','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][latency][max]" value="' . $this->get_val($this->options, array('budget','latency','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][latency][disable]" value="true" ' . ($this->get_val($this->options, array('budget','latency','disable')) ? 'checked' : '') . '>';
	}

	public function frontEnd_callback () {
		echo 'Min: <input type="text" id="frontEnd" name="perf_bar_settings[budget][frontEnd][min]" value="' . $this->get_val($this->options, array('budget','frontEnd','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][frontEnd][max]" value="' . $this->get_val($this->options, array('budget','frontEnd','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][frontEnd][disable]" value="true" ' . ($this->get_val($this->options, array('budget','frontEnd','disable')) ? 'checked' : '') . '>';
	}

	public function backEnd_callback () {
		echo 'Min: <input type="text" id="backEnd" name="perf_bar_settings[budget][backEnd][min]" value="' . $this->get_val($this->options, array('budget','backEnd','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][backEnd][max]" value="' . $this->get_val($this->options, array('budget','backEnd','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][backEnd][disable]" value="true" ' . ($this->get_val($this->options, array('budget','backEnd','disable')) ? 'checked' : '') . '>';
	}

    public function respnseDuration_callback () {
        echo 'Min: <input type="text" id="respnseDuration" name="perf_bar_settings[budget][respnseDuration][min]" value="' . $this->get_val($this->options, array('budget','respnseDuration','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][respnseDuration][max]" value="' . $this->get_val($this->options, array('budget','respnseDuration','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][respnseDuration][disable]" value="true" ' . ($this->get_val($this->options, array('budget','respnseDuration','disable')) ? 'checked' : '') . '>';
    }

    public function requestDuration_callback () {
        echo 'Min: <input type="text" id="requestDuration" name="perf_bar_settings[budget][requestDuration][min]" value="' . $this->get_val($this->options, array('budget','requestDuration','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][requestDuration][max]" value="' . $this->get_val($this->options, array('budget','requestDuration','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][requestDuration][disable]" value="true" ' . ($this->get_val($this->options, array('budget','requestDuration','disable')) ? 'checked' : '') . '>';
    }

    public function redirectCount_callback () {
        echo 'Min: <input type="text" id="redirectCount" name="perf_bar_settings[budget][redirectCount][min]" value="' . $this->get_val($this->options, array('budget','redirectCount','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][redirectCount][max]" value="' . $this->get_val($this->options, array('budget','redirectCount','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][redirectCount][disable]" value="true" ' . ($this->get_val($this->options, array('budget','redirectCount','disable')) ? 'checked' : '') . '>';
    }

    public function loadEventTime_callback () {
        echo 'Min: <input type="text" id="loadEventTime" name="perf_bar_settings[budget][loadEventTime][min]" value="' . $this->get_val($this->options, array('budget','loadEventTime','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][loadEventTime][max]" value="' . $this->get_val($this->options, array('budget','loadEventTime','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][loadEventTime][disable]" value="true" ' . ($this->get_val($this->options, array('budget','loadEventTime','disable')) ? 'checked' : '') . '>';
    }

    public function domContentLoaded_callback () {
        echo 'Min: <input type="text" id="domContentLoaded" name="perf_bar_settings[budget][domContentLoaded][min]" value="' . $this->get_val($this->options, array('budget','domContentLoaded','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][domContentLoaded][max]" value="' . $this->get_val($this->options, array('budget','domContentLoaded','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][domContentLoaded][disable]" value="true" ' . ($this->get_val($this->options, array('budget','domContentLoaded','disable')) ? 'checked' : '') . '>';
    }

    public function processing_callback () {
        echo 'Min: <input type="text" id="processing" name="perf_bar_settings[budget][processing][min]" value="' . $this->get_val($this->options, array('budget','processing','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][processing][max]" value="' . $this->get_val($this->options, array('budget','processing','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][processing][disable]" value="true" ' . ($this->get_val($this->options, array('budget','processing','disable')) ? 'checked' : '') . '>';
    }

    public function numOfEl_callback () {
        echo 'Min: <input type="text" id="numOfEl" name="perf_bar_settings[budget][numOfEl][min]" value="' . $this->get_val($this->options, array('budget','numOfEl','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][numOfEl][max]" value="' . $this->get_val($this->options, array('budget','numOfEl','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][numOfEl][disable]" value="true" ' . ($this->get_val($this->options, array('budget','numOfEl','disable')) ? 'checked' : '') . '>';
    }
    
    public function cssCount_callback () {
        echo 'Min: <input type="text" id="cssCount" name="perf_bar_settings[budget][cssCount][min]" value="' . $this->get_val($this->options, array('budget','cssCount','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][cssCount][max]" value="' . $this->get_val($this->options, array('budget','cssCount','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][cssCount][disable]" value="true" ' . ($this->get_val($this->options, array('budget','cssCount','disable')) ? 'checked' : '') . '>';
    }
    
    public function jsCount_callback () {
        echo 'Min: <input type="text" id="jsCount" name="perf_bar_settings[budget][jsCount][min]" value="' . $this->get_val($this->options, array('budget','jsCount','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][jsCount][max]" value="' . $this->get_val($this->options, array('budget','jsCount','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][jsCount][disable]" value="true" ' . ($this->get_val($this->options, array('budget','jsCount','disable')) ? 'checked' : '') . '>';
    }

    public function imgCount_callback () {
        echo 'Min: <input type="text" id="imgCount" name="perf_bar_settings[budget][imgCount][min]" value="' . $this->get_val($this->options, array('budget','imgCount','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][imgCount][max]" value="' . $this->get_val($this->options, array('budget','imgCount','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][imgCount][disable]" value="true" ' . ($this->get_val($this->options, array('budget','imgCount','disable')) ? 'checked' : '') . '>';
    }
    
    public function dataURIImagesCount_callback () {
        echo 'Min: <input type="text" id="dataURIImagesCount" name="perf_bar_settings[budget][dataURIImagesCount][min]" value="' . $this->get_val($this->options, array('budget','dataURIImagesCount','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][dataURIImagesCount][max]" value="' . $this->get_val($this->options, array('budget','dataURIImagesCount','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][dataURIImagesCount][disable]" value="true" ' . ($this->get_val($this->options, array('budget','dataURIImagesCount','disable')) ? 'checked' : '') . '>';
    }
    
    public function inlineCSSCount_callback () {
        echo 'Min: <input type="text" id="inlineCSSCount" name="perf_bar_settings[budget][inlineCSSCount][min]" value="' . $this->get_val($this->options, array('budget','inlineCSSCount','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][inlineCSSCount][max]" value="' . $this->get_val($this->options, array('budget','inlineCSSCount','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][inlineCSSCount][disable]" value="true" ' . ($this->get_val($this->options, array('budget','inlineCSSCount','disable')) ? 'checked' : '') . '>';
    }
    
    public function inlineJSCount_callback () {
        echo 'Min: <input type="text" id="inlineJSCount" name="perf_bar_settings[budget][inlineJSCount][min]" value="' . $this->get_val($this->options, array('budget','inlineJSCount','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][inlineJSCount][max]" value="' . $this->get_val($this->options, array('budget','inlineJSCount','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][inlineJSCount][disable]" value="true" ' . ($this->get_val($this->options, array('budget','inlineJSCount','disable')) ? 'checked' : '') . '>';
    }
    
    public function thirdCSS_callback () {
        echo 'Min: <input type="text" id="thirdCSS" name="perf_bar_settings[budget][thirdCSS][min]" value="' . $this->get_val($this->options, array('budget','thirdCSS','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][thirdCSS][max]" value="' . $this->get_val($this->options, array('budget','thirdCSS','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][thirdCSS][disable]" value="true" ' . ($this->get_val($this->options, array('budget','thirdCSS','disable')) ? 'checked' : '') . '>';
    }
    
    public function thirdJS_callback () {
        echo 'Min: <input type="text" id="thirdJS" name="perf_bar_settings[budget][thirdJS][min]" value="' . $this->get_val($this->options, array('budget','thirdJS','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][thirdJS][max]" value="' . $this->get_val($this->options, array('budget','thirdJS','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][thirdJS][disable]" value="true" ' . ($this->get_val($this->options, array('budget','thirdJS','disable')) ? 'checked' : '') . '>';
    }
    
    public function globalJS_callback () {
        echo 'Min: <input type="text" id="globalJS" name="perf_bar_settings[budget][globalJS][min]" value="' . $this->get_val($this->options, array('budget','globalJS','min')) . '" size="5" /></td>';
        echo '<td>Max: <input type="text" name="perf_bar_settings[budget][globalJS][max]" value="' . $this->get_val($this->options, array('budget','globalJS','max')) . '" size="5"></td>';
        echo '<td>Disable: <input type="checkbox" name="perf_bar_settings[budget][globalJS][disable]" ' . ($this->get_val($this->options, array('budget','globalJS','disable')) ? 'checked' : '') . '>';
    }

    public function get_val($obj, $keys) {
        $rval = '';
        $cur = $obj;
        $i = 0;
        foreach ($keys as $key => $value) {
            if (isset($cur[$value])) {
                $cur = $cur[$value];
                ++$i;
            } else {
                break;
            }
        }
        if ($i === count($keys)) {
            $rval = $cur;
        }
        return $rval;
    }
    
    public function sanitize( $input ) {
    	$rval = array('show_all' => $input['show_all']);
    	
        foreach ($input['budget'] as $key => $value) {
            if (isset($input['budget'][$key]['min']) && !empty($input['budget'][$key]['min'])) {
                $rval['budget'][$key]['min'] = $input['budget'][$key]['min'];
            }
            if (isset($input['budget'][$key]['max']) && !empty($input['budget'][$key]['max'])) {
                $rval['budget'][$key]['max'] = $input['budget'][$key]['max'];
            }
            if (isset($input['budget'][$key]['disable'])) {
                $rval['budget'][$key]['disable'] = $input['budget'][$key]['disable'];
            }
        }
    	return $rval;
    }
}
?>