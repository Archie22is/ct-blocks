import { select, selectAll, on, getHeight, setStyle } from 'lib/dom'
import carousel from 'lib/carousel'
import { map, throttle } from 'lib/utils'

export default el => {
	const sliderEl = select('.js-slider', el)
	const imageEl = select('.js-image', el)
	// eslint-disable-next-line no-unused-vars
	let slider = null

	const setHeightButton = () => {
		const buttons = selectAll('.flickity-button', el)

		if (slider && imageEl && buttons) {
			const imageHeight = getHeight(imageEl)

			map(button => {
				setStyle('top', imageHeight / 2 + 'px', button)
			}, buttons)
		}
	}

	if (sliderEl) {
		slider = carousel(sliderEl)
	}

	on('load', setHeightButton, window)
	on('resize', throttle(setHeightButton, 300), window)
}
