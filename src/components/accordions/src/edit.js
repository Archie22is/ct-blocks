import { __ } from '@wordpress/i18n';
import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import './editor.scss';

/**
 * @return {WPElement} Element to render.
 */
export default function Edit() {
	return (
		<div { ...useBlockProps() }>
			<InnerBlocks
				template={[
					['ct-blocks/accordions-item']
				]}
				allowedBlocks={[
					'ct-blocks/accordions-item'
				]}
			/>
		</div>
	);
}
