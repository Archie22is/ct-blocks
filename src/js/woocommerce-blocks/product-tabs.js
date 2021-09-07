import { select, selectAll, on, trigger } from 'lib/dom'
import Tabs from 'lib/tabs'

export default el => {
	const tabEl = select('.js-tabs', el)
	// eslint-disable-next-line no-unused-vars
	const tabState = new Tabs(tabEl)

	const mobileSelect = select('.js-mobile', el)
	const triggerEls = tabEl ? selectAll('[role="tab"]', tabEl) : []

	const syncChanges = () => {
		if (tabState) {
			on(
				'update',
				e => {
					mobileSelect.value = e.detail.currentIndex
				},
				tabEl
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
						tabEl
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
