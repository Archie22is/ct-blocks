import { selectAll, getData, on, addClass, setStyle } from 'lib/dom'
import { map, throttle } from 'lib/utils'
import './postcss/legacy-blocks/_index.css'

const blocks = selectAll('[data-ct-block]')
const woocommerceBlocks = selectAll('[data-ct-woocommerce-block]')
const body = document.body

const initBlocks = () => {
	if (blocks && blocks.length) {
		map(block => {
			const blockName = getData('ct-block', block)
			if (!blockName) {
				return
			}

			require(`./js/blocks/${blockName}.js`).default(block)
		}, blocks)
	}
}

const initWooCommerceBlocks = () => {
	if (woocommerceBlocks && woocommerceBlocks.length) {
		map(block => {
			const blockName = getData('ct-woocommerce-block', block)
			if (!blockName) {
				return
			}

			require(`./js/woocommerce-blocks/${blockName}.js`).default(block)
		}, woocommerceBlocks)
	}
}

const initReveal = () => {
	const revealEls = selectAll('[data-reveal]', body)

	const revealActive = () => {
		map(revealEl => {
			let delayData = getData('reveal-delay', revealEl)
			let durationData = getData('reveal-duration', revealEl)
			delayData = delayData / 1000
			durationData = durationData / 1000

			if (delayData) {
				setStyle('transition-delay', delayData + 's', revealEl)
				setStyle('transition-duration', durationData + 's', revealEl)
			}
		}, revealEls)

		map(revealEl => {
			const revealElOffsetTop = revealEl.offsetTop

			if (window.pageYOffset > revealElOffsetTop - window.screen.height * 0.8) {
				addClass('js-reveal--active', revealEl)
			}
		}, revealEls)
	}

	revealActive()

	on(
		'scroll',
		throttle(() => {
			revealActive()
		}, 50),
		window
	)
}

document.addEventListener('DOMContentLoaded', () => {
	initBlocks()
	initWooCommerceBlocks()
	initReveal()
})
