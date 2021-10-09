import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { Icon } from '@wordpress/components';

const iconEl = () => (
	<Icon icon= { <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg> } />
)

export default function Edit() {
	const blockProps = useBlockProps({
		className: 'ct-blocks-accordions-item'
	});

	return (
		<div { ...blockProps }>
			<InnerBlocks
				template={[
					['core/group', { className: 'ct-blocks-accordions-item__header'}, [
						['core/heading', { level: 3, content: 'Example question' }],
						['core/group', { className: 'ct-blocks-accordions-item__icon' }]
					]],
					['core/group', { className: 'ct-blocks-accordions-item__content'}, [
						['core/paragraph', { content: 'Example answer' }]
					]]
				]}
				allowedBlocks={[
					'core/paragraph',
					'core/heading'
				]}
			/>
		</div>
	)
}
