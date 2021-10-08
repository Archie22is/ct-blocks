import { registerBlockType } from '@wordpress/blocks';
import './style.scss';
import Edit from './edit';
import Save from './Save';
import AccordionItemEdit from './accordionsItem/edit';
import AccordionItemSave from './accordionsItem/save';

registerBlockType('ct-blocks/accordions-item', {
	edit: AccordionItemEdit,
	save: AccordionItemSave,
	parent: ['ct-blocks/accordions']
});

registerBlockType('ct-blocks/accordions', {
	edit: Edit,
	save: Save
});
