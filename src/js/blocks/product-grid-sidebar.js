import { select, toggleClass, on, addClass } from 'lib/dom'
import { isMobile } from 'lib/utils'

const VISIBLE_CLASS = 'sidebar-category-visible'
const VISIBLE_MENU = 'menu-visible'

export default el => {
  const button = select('.js-trigger', el)
  const content = select('.js-sidebar-block', el)
  const headerEl = select('.product-grid-sidebar__header', el)

  if (button) {
    on(
      'click',
      e => {
        toggleClass(VISIBLE_CLASS, el)
      },
      button
    )
  }

  if (headerEl.offsetWidth < content.offsetWidth) {
    addClass(VISIBLE_MENU, el)
  }

  if (isMobile.any()) {
    addClass(VISIBLE_MENU, el)
  }
}
