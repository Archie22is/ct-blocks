<?php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function ct_blocks_accordions_init() {

	// automatically load dependencies and version
	$asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');

	wp_register_script(
		'ct-blocks-accordions-js',
		plugins_url( 'build/index.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version']
	);

	wp_register_style(
		'ct_blocks_accordion_editor_css',
		plugins_url( '/build/index.css', __FILE__ ),
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . '/build/index.css' )
	);

	wp_register_style(
		'ct-blocks_accordions_css',
		plugins_url( '/build/style-index.css', __FILE__ ),
		array(),
		filemtime( plugin_dir_path( __FILE__ ) . '/build/style-index.css' )
	);

	register_block_type('ct-blocks/accordions-item', array(
		'title' => __('[CT] Accordions Item', 'ct-blocks'),
		'parent' => array('ct-blocks/accordions'),
		'icon' => 'smiley',
		'textdomain' => 'ct-blocks'
	));

	register_block_type( __DIR__ );

}
add_action( 'init', 'ct_blocks_accordions_init' );
