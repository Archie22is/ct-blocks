import { select, toggleClass, on, addClass, removeClass } from 'lib/dom'
import { isMobile, debounce } from 'lib/utils'

const VISIBLE_CLASS = 'sidebar-category-visible'
const MOBILE_MENU_CLASS = 'mobile-menu-visible'

export default el => {
  const button = select('.js-trigger', el)
  const contentEl = select('.js-sidebar-block', el)
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

  const init = () => {
    const headerWidth = headerEl.innerWidth || headerEl.clientWidth
    const contentWidth = contentEl.innerWidth || contentEl.clientWidth

    if (headerWidth <= contentWidth || isMobile.any()) {
      addClass(MOBILE_MENU_CLASS, el)
    } else {
      removeClass(MOBILE_MENU_CLASS, el)
    }
  }

  init()

  on('resize', debounce(init, 400), window)
}
