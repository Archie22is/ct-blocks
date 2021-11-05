<?php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function ct_blocks_image_slider_block_init() {
	register_block_type_from_metadata( plugin_dir_path( __FILE__ ) );
}
add_action( 'init', 'ct_blocks_image_slider_block_init' );

function ct_bones_image_slider_frontend_assets() {
	$asset_file = include( plugin_dir_path( __FILE__ ) . 'build/image-slider.asset.php');

	wp_enqueue_script(
		'ct-blocks-image-slider-frontend-js',
		plugins_url( '/build/image-slider.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version']
	);
}
add_action('wp_enqueue_scripts', 'ct_bones_image_slider_frontend_assets');
