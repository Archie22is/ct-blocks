/* global jQuery */
import {
  selectAll,
  select,
  addClass,
  on,
  getData,
  setStyle,
  remove,
  removeClass
} from 'lib/dom'
import { map } from '../lib/utils'
const $ = jQuery

const body = document.body
const overLayMarkup = '<div class="overlay-popup js-close-form"></div>'
// const closeMarkup = '<div class="close-button js-close-form">x</div>'

export default el => {
  // $(el).after(closeMarkup)
  const actionAttribute = getData('action-attribute', el)

  const buttonEls = selectAll('.button', body)

  if (buttonEls) {
    map(buttonEl => {
      const isActionButton = getData('action', buttonEl)
      if (isActionButton && isActionButton === actionAttribute) {
        on(
          'click',
          () => {
            addClass('is-show', el)

            if (!select('overlay-popup', body)) {
              $(body).prepend(overLayMarkup)
            }

            setStyle('overflow-y', 'hidden', body)

            const overlayEl = select('.js-close-form', body)

            if (overlayEl) {
              on(
                'click',
                e => {
                  remove(e.target)
                  removeClass('is-show', el)
                  setStyle('overflow-y', 'auto', body)
                },
                overlayEl
              )
            }
          },
          buttonEl
        )
      }
    }, buttonEls)
  }
}
