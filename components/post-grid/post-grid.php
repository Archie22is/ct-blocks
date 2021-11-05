<?php

function ct_blocks_render_post_grid($attributes) {
	$post_args = array(
		'post_type' => 'post',
		'posts_per_page' => 3
	);

	$post_query = new WP_Query($post_args);

	return get_block('post-grid', array(
		'class' => 'ct-blocks-post-grid',
		'query' => $post_query
	));
}

function ct_blocks_register_post_grid() {
	wp_register_script('ct-blocks-post-grid-editor', CODETOT_BLOCKS_PLUGIN_URI . '/components/post-grid/build/index.js', array(), null, true);

	$metadata = json_decode(file_get_contents(CODETOT_BLOCKS_DIR . 'components/post-grid/block.json'), true);
	$block_name = $metadata['name'];

	unset($metadata['name']);
	$metadata['render_callback'] = 'ct_blocks_render_post_grid';
	$metadata['editor_script'] = 'ct-blocks-post-grid-editor';

	register_block_type($block_name, $metadata);
}
add_action( 'init', 'ct_blocks_register_post_grid' );
