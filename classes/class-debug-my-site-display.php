<?php

/**
 *  Code used and altered from Caldera Forms (www.calderaforms.com) - Thanks Josh! (https://profiles.wordpress.org/shelob9/)
 */

defined( 'ABSPATH' ) || exit;

class Debug_My_Site_Display {

	/**
	 * Return an array of plugin names and versions
	 *
	 * @since 1.0.1
	 *
	 * @author pbrocks
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'add_dashboard_menu' ) );
		// add_action( 'admin_head', array( __CLASS__, 'print_current_screen' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_stuff' ) );
	}
	/**
	 * Add a page to the dashboard menu.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public static function add_dashboard_menu() {
		add_dashboard_page( __( __CLASS__, 'textdomain' ), __( __CLASS__, 'textdomain' ), 'manage_options', __CLASS__ . '-dashboard.php', array( __CLASS__, 'add_dashboard_page' ) );
	}


	/**
	 * Debug Information
	 *
	 * @since 1.0.0
	 *
	 * @param bool $html Optional. Return as HTML or not
	 *
	 * @return string
	 */
	public static function add_dashboard_page() {
		echo '<div class="wrap">';
		echo '<h2>' . __CLASS__ . '</h2>';
		$screen = get_current_screen();
		echo $screen->id;
		self::bootstrap_tabbed_table();
		echo '</div>';
	}

	public static function print_current_screen() {
		$screen = get_current_screen();
		return $screen->id;
	}
	/** * Add page templates. * * @param array $templates The list of page templates * * @return array  $templates  The modified list of page templates */
	public function print_in_head() {
		$screenid = self::print_current_screen();

		echo '<pre><h4 style="text-align: center; color: salmon;">';
		echo '<p> ' . $screenid;
		echo '</h4></pre>;';
	}

	public static function short_debug_info() {

	}

	public static function enqueue_stuff() {
		$screenid = self::print_current_screen();
		if ( 'dashboard_page_' . __CLASS__ . '-dashboard' === $screenid ) {
			wp_register_script( 'bootstrap-min', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ) );
			wp_register_style( 'bootstrap-min', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
			wp_enqueue_script( 'bootstrap-min' );
			wp_enqueue_style( 'bootstrap-min' );
		}
	}

	public static function bootstrap_tabbed_table() {
		?>
		<div id="bootstrap-tabs" class="row">	
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#1" data-toggle="tab">Overview</a>
				</li>
				<li><a href="#2" data-toggle="tab">Without clearfix</a>
				</li>
				<li><a href="#3" data-toggle="tab">Solution</a>
				</li>
			</ul>

			<div class="tab-content ">
				<div class="tab-pane active" id="1">
					<h4>Standard tab panel created on bootstrap using nav-tabs</h4>
				</div>
				<div class="tab-pane" id="2">
					<h4>Notice the gap between the content and tab after applying a background color</h4>
				</div>
				<div class="tab-pane" id="3">
					<h4>add clearfix to tab-content (see the css)</h4>
				</div>
			</div>
			<hr/>

		</div>
		<?php
	}

}
