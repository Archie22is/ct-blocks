import Accordions from 'lib/accordions'

export default el => {
	return Accordions(el, {
		el: el,
		rowEl: '.js-row',
		navEl: '.js-trigger',
		contentEl: '.js-content',
		activeClass: 'is-active'
	})
}
