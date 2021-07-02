<?php

/**
 * @link              https://codetot.com
 * @since             1.0.0
 * @package           Codetot_Base
 *
 * @wordpress-plugin
 * Plugin Name:       CT Blocks
 * Plugin URI:        https://codetot.com
 * Description:       Brings 20+ blocks to your custom page with modern design and flexible.
 * Version:           4.2.3
 * Author:            CODE TOT JSC
 * Author URI:        https://codetot.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ct-blocks
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'CODETOT_BLOCKS_VERSION', '4.2.3' );
define( 'CODETOT_BLOCKS_PLUGIN_SLUG', 'ct-blocks' );
define( 'CODETOT_BLOCKS_PLUGIN_NAME', esc_html_x('CT Blocks', 'plugin name', 'ct-blocks'));
define( 'CODETOT_BLOCKS_DIR', plugin_dir_path(__FILE__));
define( 'CODETOT_BLOCKS_AUTHOR', 'Code Tot JSC' );
define( 'CODETOT_BLOCKS_AUTHOR_URI', 'https://codetot.com');
define( 'CODETOT_BLOCKS_PLUGIN_URI', plugins_url('ct-blocks'));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-activator.php
 */
function activate_codetot_blocks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-activator.php';
	Codetot_Base_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-deactivator.php
 */
function deactivate_codetot_blocks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-deactivator.php';
	Codetot_Base_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_codetot_blocks' );
register_deactivation_hook( __FILE__, 'deactivate_codetot_blocks' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ct-blocks.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_codetot_blocks() {
	$plugin = new Codetot_Base();
}

run_codetot_blocks();
