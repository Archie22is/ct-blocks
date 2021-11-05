import { registerBlockType } from '@wordpress/blocks';
import './style.scss';
import Edit from './edit';
import save from './save';
registerBlockType( 'ct-blocks/image-slider', {
	edit: Edit,
	save,
} );
