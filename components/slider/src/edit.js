import { InnerBlocks, useBlockProps } from '@wordpress/block-editor'
import './editor.scss'

/**
 * @return {WPElement} Element to render.
 */
export default function Edit () {
	return (
		<div {...useBlockProps()}>
			<InnerBlocks
				template={[['ct-blocks/slider-item']]}
				allowedBlocks={['ct-blocks/slider-item']}
			/>
		</div>
	)
}
