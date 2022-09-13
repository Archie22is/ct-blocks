import { select, inViewPort, on, hasClass, removeClass, loadNoscriptContent } from 'lib/dom'
import { throttle } from 'lib/utils'
import carousel from 'lib/carousel'

const MOBILE_BREAKPOINT = 600

export default el => {
	const contentEl = select('.js-main-content', el)

	let sliderEl = null
	let slider = null
	let loaded = false

	const initLazyload = () => {
		if ( contentEl && hasClass('is-not-loaded', contentEl) ) {
			loadNoscriptContent( contentEl )

			removeClass('is-loading', el)
		}

		if (!sliderEl) {
			sliderEl = select('.js-slider', el)
		}

		if (!sliderEl) {
			loaded = true

			return
		}

		if ( !inViewPort( el ) ) {
			return
		}

		if (loaded) {
			return
		}

		slider = new carousel(sliderEl)

		loaded = true
	}

	initLazyload()

	on('scroll', throttle(initLazyload, 100), window)
}
