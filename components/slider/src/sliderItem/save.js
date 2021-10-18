import { InnerBlocks, useBlockProps } from '@wordpress/block-editor'

const SliderItemSave = () => {
	const blockProps = useBlockProps.save()
	blockProps.className += ' ct-blocks-slider-item'

	return (
		<div {...blockProps}>
			<InnerBlocks.Content />
		</div>
	)
}

export default SliderItemSave
