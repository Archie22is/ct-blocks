import { selectAll, on, trigger, addClass, removeClass } from './dom'
import { gsap } from 'gsap/all'

export default (el, customOptions = {}) => {
	const defaultOptions = {
		rowEl: '.ct-blocks-accordions-item',
		navEl: '.ct-blocks-accordions-item__header',
		contentEl: '.ct-blocks-accordions-item__content',
		activeClass: 'is-active'
	}

	const options = { ...defaultOptions, ...customOptions }
	const rowEls = selectAll(options.rowEl, el)
	const contentEls = selectAll(options.contentEl, el)
	const navItems = selectAll(options.navEl, el)

	const activateRow = rowIndex => {
		addClass(options.activeClass, rowEls[rowIndex])

		gsap.to(contentEls[rowIndex], {
			display: 'block',
			autoAlpha: 1,
			ease: 'power2.out'
		})
	}

	const deactivateRow = rowIndex => {
		gsap.to(
			contentEls[rowIndex],
			{ display: 'none', autoAlpha: 0, ease: 'power2.out', delay: 0.25 },
			{ duration: 0.5 }
		)

		removeClass(options.activeClass, rowEls[rowIndex])
	}

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
		el
	)

	on(
		'click',
		e => {
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
}
