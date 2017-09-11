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
		$function = array();
		$function['title'] = 'Quick Info';
		$function['data'] = '<div id="debug-my-site-short">' . Debug_My_Site_Core::short_debug_info() . '</div>
		<hr id="debug-my-site-hr">';
		return $function;
	}

	public static function long_debug_info() {
		$function = array();
		$function['title'] = 'Debug Information';
		$function['data'] = '<div id="debug-my-site-long">' . Debug_My_Site_Core::debug_info() . '</div>
		<hr id="debug-my-site-hr">';
		return $function;
	}


	public static function long_debug_info1() {
		_e( 'Debug Information', 'debug-my-site' ); ?>
		<div id="debug-my-site-long"><?php echo Debug_My_Site_Core::debug_info(); ?></div><?php
	}

	public static function enqueue_stuff() {
		$screenid = self::print_current_screen();
		if ( 'dashboard_page_' . __CLASS__ . '-dashboard' === $screenid ) {
			wp_register_script( 'bootstrap-min', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ) );
			wp_register_style( 'sample', plugins_url( 'sample.css', __FILE__ ) );
			wp_register_style( 'bootstrap-min', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
			wp_enqueue_script( 'bootstrap-min' );
			wp_enqueue_style( 'bootstrap-min' );
			wp_enqueue_style( 'sample' );
		}
	}

	public static function bootstrap_tabbed_table() {
		$tab1 = self::short_debug_info();
		$tab2 = self::long_debug_info();
		?>
		<div id="bootstrap-tabs" class="row">	
			<ul class="nav nav-tabs">
				<li class="active"><a href="#1" data-toggle="tab"><?php echo $tab1['title']; ?></a>
				</li>
				<li ><a href="#2" data-toggle="tab"><?php echo $tab2['title']; ?></a>
				</li>
				<li><a href="#3" data-toggle="tab">Solution</a>
				</li>
			</ul>

			<div class="tab-content ">
				<div class="tab-pane active" id="1">
					<h4><?php echo $tab1['data']; ?></h4>
					
				</div>
				<div class="tab-pane" id="2">
					<h4><?php echo $tab2['data']; ?></h4>
				</div>
				<div class="tab-pane" id="3">
					<h4>Hire a developer</h4>
				</div>
			</div>
			<hr/>

		</div>
		<?php
	}

}
