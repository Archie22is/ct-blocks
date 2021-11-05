import { registerBlockType } from '@wordpress/blocks';
import './style.scss';
import Edit from './edit';

registerBlockType( 'ct-blocks/post-grid', {
	edit: Edit,
	save: () => {
		return null;
	}
} );
