/* eslint-disable no-unused-vars */
import {
	addClass,
	select,
	selectAll,
	getHeight,
	setStyle,
	on,
	inViewPort,
	hasClass,
	loadNoscriptContent,
	removeClass
} from 'lib/dom'
import { throttle, map } from 'lib/utils'
import carousel from 'lib/carousel'

export default el => {
	const contentEl = select('.js-main-content', el)
	let sliderEl = select('.js-slider', el)
	let slider = null
	let loaded = false

	const update = () => {
		const imageEl = select('.js-slider-item .image__img', sliderEl)

		if (imageEl) {
			const timer = setInterval(() => {
				if (hasClass('lazyloaded', imageEl)) {
					slider.resize()

					const buttons = selectAll('.flickity-button', el)

					if (slider && imageEl && buttons) {
						const imageHeight = getHeight(imageEl)

						map(button => {
							setStyle('top', imageHeight / 2 + 'px', button)
						}, buttons)
					}

					clearInterval(timer)
				}
			}, 500)
		}
	}

	const init = () => {
		if (loaded) {
			return
		}

		if (hasClass('is-not-loaded', contentEl)) {
			loadNoscriptContent(contentEl)
			removeClass('is-loading', el)
		}

		if (!sliderEl) {
			sliderEl = select('.js-slider', el)
		}

		const customOptions = {
			on: {
				ready: update
			}
		}

		slider = carousel(sliderEl, customOptions)

		loaded = true
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

	on(
		'scroll',
		throttle(() => {
			if (inViewPort(el)) {
				init()
			}
		}, 100),
		window
	)
}
