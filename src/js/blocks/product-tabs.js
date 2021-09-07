/* eslint-disable no-unused-vars */
/* global codetotConfig */
import {
	select,
	selectAll,
	on,
	trigger,
	getData,
	addClass,
	hasClass,
	removeClass,
	loadNoscriptContent,
	inViewPort
} from 'lib/dom'
import { map, throttle } from 'lib/utils'
import Tabs from 'lib/tabs'
require('whatwg-fetch')

const parseJSON = response => response.json()

export default el => {
	const contentEl = select('.js-main-content', el)
	let tabState = null
	let tabPanels = []
	let desktopTriggerEls = []
	let loaded = false

	const settings = getData('settings', el)
		? JSON.parse(getData('settings', el))
		: {}

	const getRestUrl = categoryId => {
		return `${codetotConfig.ajax.restUrl}/${settings.endpoint}/?category_id=${categoryId}&posts_per_page=${settings.postsPerPage}&query_type=${settings.queryType}`
	}

	const init = () => {
		if (loaded) {
			return true
		}

		if (contentEl && hasClass('is-not-loaded', contentEl)) {
			loadNoscriptContent(contentEl)
			removeClass('is-loading', el)
		}

		tabState = new Tabs(el)
		desktopTriggerEls = selectAll('[role="tab"]', el)
		tabPanels = selectAll('[role="tabpanel"]', el)

		trigger(
			{
				event: 'update',
				data: {
					currentIndex: 0
				}
			},
			el
		)

		if (desktopTriggerEls) {
			on(
				'click',
				e => {
					trigger(
						{
							event: 'update',
							data: {
								currentIndex: desktopTriggerEls.indexOf(e.target)
							}
						},
						el
					)
				},
				desktopTriggerEls
			)
		}

		loaded = true
	}

	on(
		'update',
		e => {
			const index = e.detail.currentIndex
			const currentTabEl = tabPanels[index]
			const categoryId = currentTabEl
				? getData('category-id', currentTabEl)
				: null
			const listEl = currentTabEl ? select('.js-grid', currentTabEl) : null

			if (listEl && hasClass('is-not-loaded', listEl) && categoryId) {
				addClass('is-loading', el)

				window
					.fetch(getRestUrl(categoryId))
					.then(parseJSON)
					.then(data => {
						if (data.html) {
							listEl.innerHTML = data.html
							removeClass('is-not-loaded', listEl)
						}

						removeClass('is-loading', el)
					})
			}
		},
		el
	)

	on(
		'load',
		throttle(() => {
			if (inViewPort(el) && !loaded) {
				init()
			}
		}, 100),
		window
	)

	on(
		'scroll',
		throttle(() => {
			if (inViewPort(el) && !loaded) {
				init()
			}
		}, 300),
		window
	)
}
