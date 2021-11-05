<?php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function ct_blocks_image_slider_block_init() {
	register_block_type( __DIR__ );
}
add_action( 'init', 'ct_blocks_image_slider_block_init' );
