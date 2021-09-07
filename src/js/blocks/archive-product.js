import { on, select, addClass } from 'lib/dom'

const VISIBLE_CLASS = 'is-sidebar-visible'
const body = document.body

export default el => {
	const buttonClick = select('.js-sidebar-toggle', el)

	if (buttonClick) {
		on(
			'click',
			() => {
				addClass(VISIBLE_CLASS, body)
			},
			buttonClick
		)
	}
}
