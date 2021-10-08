import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

/**
 * @return {WPElement} Element to render.
 */
export default function Save() {
	return (
		<div { ...useBlockProps.save() }>
			<InnerBlocks.Content />
		</div>
	);
}
