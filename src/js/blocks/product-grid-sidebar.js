import { select, toggleClass, on } from 'lib/dom'

const VISIBLE_CLASS = 'sidebar-category-visible'

export default el => {
  const button = select('.js-trigger', el)
  const content = select('.js-sidebar-block', el)

  if (button) {
    on(
      'click',
      e => {
        toggleClass(VISIBLE_CLASS, content)
      },
      button
    )
  }
}
