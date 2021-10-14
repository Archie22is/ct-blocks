import { InnerBlocks, useBlockProps } from '@wordpress/block-editor'

const AccordionItemSave = () => {
	const blockProps = useBlockProps.save()
	blockProps.className += ' ct-blocks-accordions-item'

	return (
		<div {...blockProps}>
			<InnerBlocks.Content />
		</div>
	)
}

export default AccordionItemSave
