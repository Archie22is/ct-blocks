<?php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */

function create_block_slider_init() {

	// automatically load dependencies and version
	$asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');

	wp_register_script(
		'ct-blocks-slider-js',
		plugins_url( 'build/index.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version']
	);

	wp_register_style(
		'ct-blocks-slider-editor-css',
		plugins_url( '/build/index.css', __FILE__ ),
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . '/build/index.css' )
	);

	register_block_type('ct-blocks/slider-item', array(
		'title' => __('[CT] Slider Item', 'ct-blocks'),
		'parent' => array('ct-blocks/slider'),
		'icon' => 'smiley',
		'textdomain' => 'ct-blocks'
	));

	register_block_type( __DIR__ );

}
add_action( 'init', 'create_block_slider_init' );

function ct_bones_slider_frontend_assets() {
	wp_enqueue_script(
		'ct-blocks-slider-frontend-js',
		plugins_url( '/build/slider.js', __FILE__ ),
		array(),
		filemtime( plugin_dir_path( __FILE__ ) . '/build/slider.js' )
	);

	wp_enqueue_style(
		'ct-blocks-slider-frontend-css',
		plugins_url( '/build/slider.css', __FILE__ ),
		array(),
		filemtime( plugin_dir_path( __FILE__ ) . '/build/slider.css' )
	);
}
add_action('wp_enqueue_scripts', 'ct_bones_slider_frontend_assets');
