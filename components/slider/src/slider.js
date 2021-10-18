import {  select } from './lib/dom'
import { map } from './lib/utils'
import carousel from './lib/carousel'

const initSlider = () => {
	const blockEls = select('.ct-blocks-slider')

	// eslint-disable-next-line no-unused-vars
	let slider = null

	if(blockEls.length) {
		map(blockEl => {
			const newInstance = carousel(blockEl, {})
		}, blockEls)
	}
}

document.addEventListener('DOMContentLoaded', initSlider)
