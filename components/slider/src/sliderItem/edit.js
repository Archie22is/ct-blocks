import { useBlockProps, InnerBlocks } from '@wordpress/block-editor'

export default function Edit () {
	const blockProps = useBlockProps({
		className: 'ct-blocks-slider-item'
	})

	return (
		<div {...blockProps}>
			<InnerBlocks
				template={[
					[
						'core/group',
						{ className: 'ct-blocks-slider-item__wrapper' },
						[
							['core/image'],
						]
					]
				]}
				allowedBlocks={['core/image']}
			/>
		</div>
	)
}
