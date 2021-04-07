import { on, addClass, removeClass, selectAll } from 'lib/dom'

const VISIBLE_CLASS = 'account-modal--visible'

export default el => {
  const openButtons = selectAll('.js-open-account-modal')
  const closeButtons = selectAll('.js-close-account-modal', el)
  const activate = () => addClass(VISIBLE_CLASS, el)
  const deactivate = () => removeClass(VISIBLE_CLASS, el)

  if (openButtons) {
    on('click', activate, openButtons)
  }

  if (closeButtons) {
    on('click', deactivate, closeButtons)
  }
}
