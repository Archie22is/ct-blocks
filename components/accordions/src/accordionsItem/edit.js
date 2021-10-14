import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

export default function Edit() {
	const blockProps = useBlockProps({
		className: 'ct-blocks-accordions-item',
	});

	return (
		<div {...blockProps}>
			<InnerBlocks
				template={[
					[
						'core/group',
						{ className: 'ct-blocks-accordions-item__header' },
						[
							['core/heading', { level: 3, content: 'Example question' }],
							['core/group', { className: 'ct-blocks-accordions-item__icon' }],
						],
					],
					[
						'core/group',
						{ className: 'ct-blocks-accordions-item__content' },
						[['core/paragraph', { content: 'Example answer' }]],
					],
				]}
				allowedBlocks={['core/paragraph', 'core/heading']}
			/>
		</div>
	);
}
