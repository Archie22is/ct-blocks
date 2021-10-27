import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

export default function save(props) {
	const { attributes } = props;
	let blockProps = { ... useBlockProps.save() };

	return (
		<div blockProps>
			<div className={'wp-block-ct-blocks-code-toggle__header'}>
				<p className={'wp-block-ct-blocks-code-toggle__title'}>{attributes.title}</p>
			</div>
			<div className={'wp-block-ct-blocks-code-toggle__content'}>
				{ attributes.code ? <div className={'wp-block-ct-blocks-code-toggle__code'}><pre><code>{ attributes.code }</code></pre></div> : ''}
			</div>
		</div>
	);
}
