import ServerSideRender from '@wordpress/server-side-render';
import { useBlockProps } from '@wordpress/block-editor';
import './editor.scss';

export default function Edit() {
	return (
		<div { ...useBlockProps() }>
			<ServerSideRender
				block="ct-blocks/post-grid"
			/>
		</div>
	);
}
