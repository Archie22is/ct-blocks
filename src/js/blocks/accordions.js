import {
  select,
  selectAll,
  on,
  addClass,
  removeClass,
  closest,
  clickOrTouchStart,
  getHeight
} from 'lib/dom'
import { map } from 'lib/utils'

const VISIBLE_CLASS = 'is-active'

export default el => {
  const rowEls = selectAll('.js-row', el)
  let currentRow = null

  const update = () => {
    map(rowEl => {
      rowEl !== currentRow ? deactivate(rowEl) : activate(rowEl)
    }, rowEls)
  }

  const activate = rowEl => {
    const contentEl = select('.js-content', rowEl)
    const contentInner = select('.js-content-inner', rowEl)
    const height = contentInner ? contentInner.scrollHeight : 0

    if (getHeight(contentEl) > 0) {
      contentEl.setAttribute('style', `0`)
      removeClass(VISIBLE_CLASS, rowEl)
    } else {
      if (contentEl && height > 0) {
        contentEl.setAttribute('style', `height: ${height}px;`)
        addClass(VISIBLE_CLASS, rowEl)
      }
    }
  }

  const deactivate = rowEl => {
    const contentEl = select('.js-content', rowEl)

    if (contentEl) {
      contentEl.removeAttribute('style')
      removeClass(VISIBLE_CLASS, rowEl)
    }
  }

  if (rowEls) {
    map(rowEl => {
      const triggerEl = select('.js-trigger', rowEl)
      const process = e => {
        e.stopPropagation()

        currentRow = closest('.js-row', e.target)
        update()
      }

      on(clickOrTouchStart(), process, triggerEl)
    }, rowEls)
  }
}
