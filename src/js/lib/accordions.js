import { selectAll, on, trigger, addClass, removeClass } from 'lib/dom'

export default (el, customOptions = {}) => {
	const defaultOptions = {
		el: null,
		rowEl: '.ct-blocks-accordions-item',
		navEl: '.ct-blocks-accordions-item__header',
		contentEl: '.ct-blocks-accordions-item__content',
		activeClass: 'is-active'
	}

	const options = { ...defaultOptions, ...customOptions }
	const rowEls = selectAll(options.rowEl, el)
	const navItems = selectAll(options.navEl, el)

	const activateRow = rowIndex => {
		addClass(options.activeClass, rowEls[rowIndex])
	}

	const deactivateRow = rowIndex => {
		removeClass(options.activeClass, rowEls[rowIndex])
	}

	console.log(options.el)

	on(
		'update',
		e => {
			for (let index = 0; index < navItems.length; index++) {
				if (index === e.detail.currentIndex) {
					activateRow(index)
				} else {
					deactivateRow(index)
				}
			}
		},
		options.el
	)

	on(
		'click',
		e => {
			e.stopPropagation()

			const navItem = e.target

			trigger(
				{
					event: 'update',
					data: {
						currentIndex: navItems.indexOf(navItem)
					}
				},
				el
			)
		},
		navItems
	)

	return el
}
