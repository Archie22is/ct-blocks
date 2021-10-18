import { InnerBlocks, useBlockProps } from '@wordpress/block-editor'

/**
 * @return {WPElement} Element to render.
 */
export default function Save () {
	const blockProps = useBlockProps.save()
	blockProps.className += ' ct-blocks-slider'

	return (
		<div {...blockProps}>
			<InnerBlocks.Content />
		</div>
	)
}
