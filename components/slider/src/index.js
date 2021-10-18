import { registerBlockType } from '@wordpress/blocks'
import Edit from './edit'
import Save from './Save'
import SliderItemEdit from './sliderItem/edit'
import SliderItemSave from './sliderItem/save'

registerBlockType('ct-blocks/slider-item', {
	edit: SliderItemEdit,
	save: SliderItemSave,
	parent: ['ct-blocks/slider']
})

registerBlockType('ct-blocks/slider', {
	edit: Edit,
	save: Save
})
