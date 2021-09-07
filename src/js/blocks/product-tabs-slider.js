import { select, selectAll, on, trigger, hasClass } from 'lib/dom'
import Tabs from 'lib/tabs'
import carousel from 'lib/carousel'

export default el => {
	const mobileSelect = select('.js-mobile', el)
	const triggerEls = el ? selectAll('[role="tab"]', el) : []

	const tabState = new Tabs(el, {
		lazyload: true,
		lazyloadCallback: (navItem, panelItem) => {
			const sliderEl = select('.js-slider', panelItem)

			// Check if slider exists
			if (hasClass('flickity-enabled', sliderEl)) {
				return
			}

			return carousel(sliderEl)
		}
	})

	const syncChanges = () => {
		if (tabState) {
			on(
				'update',
				e => {
					mobileSelect.value = e.detail.currentIndex
				},
				el
			)
		}
	}

	if (mobileSelect) {
		on(
			'change',
			e => {
				if (tabState) {
					trigger(
						{
							event: 'update',
							data: {
								currentIndex: parseInt(e.target.value)
							}
						},
						el
					)
				}
			},
			mobileSelect
		)

		on('load', syncChanges, window)

		if (triggerEls) {
			on('click', syncChanges, triggerEls)
		}
	}
}
