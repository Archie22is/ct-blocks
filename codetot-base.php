<?php

/**
 * @link              https://codetot.com
 * @since             1.0.0
 * @package           Codetot_Base
 *
 * @wordpress-plugin
 * Plugin Name:       Code Tot - Theme Toolkit
 * Plugin URI:        https://codetot.com
 * Description:       The required plugin to run with theme "Code Tot".
 * Version:           1.1.1
 * Author:            CODE TOT JSC
 * Author URI:        https://codetot.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       codetot-base
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'CODETOT_BASE_VERSION', '1.1.1' );
define( 'CODETOT_BASE_DIR', plugin_dir_path(__FILE__));
define( 'CODETOT_BASE_AUTHOR', 'Code Tot JSC' );
define( 'CODETOT_BASE_AUTHOR_URI', 'https://codetot.com');
define( 'CODETOT_BASE_SETTINGS', 'codetot_base_settings');
define( 'CODETOT_BASE_PLUGIN_URI', plugins_url('codetot-base'));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-codetot-base-activator.php
 */
function activate_codetot_base() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-codetot-base-activator.php';
	Codetot_Base_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-codetot-base-deactivator.php
 */
function deactivate_codetot_base() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-codetot-base-deactivator.php';
	Codetot_Base_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_codetot_base' );
register_deactivation_hook( __FILE__, 'deactivate_codetot_base' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-codetot-base.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_codetot_base() {

	$plugin = new Codetot_Base();
	$plugin->run();

}
run_codetot_base();
