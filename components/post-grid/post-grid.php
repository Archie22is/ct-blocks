<?php

function ct_blocks_render_post_grid($attributes) {
	$category_id = absint($attributes['categoryId']);
	$class_name = esc_attr($attributes['className']);
	$anchor_name = esc_attr($attributes['anchorName']);
	$post_count = absint($attributes['postCount']) ?? 3;
	$column_number = absint($attributes['columns']) ?? 3;
	$showDate = $attributes['showDate'];
	$showCategory = $attributes['showCategory'];
	$showReadMore = $attributes['showReadMore'];
	$showThumbnail = $attributes['showThumbnail'];

	if ( !empty($category_id) && is_numeric($category_id) ) {
		$post_args['category__in'] = $category_id;
	}

	$post_args = array(
		'post_type' => 'post',
		'posts_per_page' => $post_count
	);

	$post_query = new WP_Query($post_args);

	return get_block('post-grid', array(
		'class' => 'default-section--no-container ct-blocks-post-grid ' . $class_name . ' count-' . $post_count,
		'id' => $anchor_name ?? '',
		'query' => $post_query,
		'columns' => $column_number,
		'card_style' => 'style-1'
	));
}

function ct_blocks_register_post_grid() {
	wp_register_script('ct-blocks-post-grid-editor', CODETOT_BLOCKS_PLUGIN_URI . '/components/post-grid/build/index.js', array(), null, true);

	$metadata = json_decode(file_get_contents(CODETOT_BLOCKS_DIR . 'components/post-grid/block.json'), true);
	$block_name = $metadata['name'];

	unset($metadata['name']);

	$metadata['attributes'] = array(
		'categoryId'    => array(
			'type'      => 'number',
			'default'   => '',
		),
		'className'    => array(
			'type'      => 'string',
			'default'   => '',
		),
		'anchorName'    => array(
			'type'      => 'string',
			'default'   => '',
		),
		'postCount'    => array(
			'type'      => 'number',
			'default'   => 3,
		),
		'columns'    => array(
			'type'      => 'number',
			'default'   => 3,
		),
		'showDate'    => array(
			'type'      => 'boolean',
			'default'   => true,
		),
		'showCategory'    => array(
			'type'      => 'boolean',
			'default'   => true,
		),
		'showReadMore'    => array(
			'type'      => 'boolean',
			'default'   => true,
		),
		'showThumbnail'    => array(
			'type'      => 'boolean',
			'default'   => true,
		),
	);
	$metadata['render_callback'] = 'ct_blocks_render_post_grid';
	$metadata['editor_script'] = 'ct-blocks-post-grid-editor';

	register_block_type($block_name, $metadata);
}
add_action( 'init', 'ct_blocks_register_post_grid' );
