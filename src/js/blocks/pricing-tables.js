import { select, on, inViewPort } from 'lib/dom'
import carousel from 'lib/carousel'

export default el => {
	const defaultSliderEl = select('.js-slider', el)
	// eslint-disable-next-line no-unused-vars
	let slider = null

	const init = () => {
		if (defaultSliderEl) {
			// eslint-disable-next-line no-unused-vars
			let slider = carousel(defaultSliderEl)
		}
	}

	on(
		'load',
		() => {
			if (inViewPort(el)) {
				init()
			}
		},
		window
	)
}
