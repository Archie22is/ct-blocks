import { select, selectAll, addClass, hasClass } from 'lib/dom'
import { map } from 'lib/utils'
import carousel from 'lib/carousel'

const SLIDER_READY_CLASS = 'is-ready'

export default el => {
  const sliderEl = select('.js-slider', el)
  const imageEls = selectAll('.image__img', el)
  // eslint-disable-next-line no-unused-vars
  let slider = null

  const customOptions = {
    on: {
      ready: function () {
        addClass(SLIDER_READY_CLASS, sliderEl)
      }
    }
  }

  if (sliderEl) {
    if (imageEls.length) {
      const timer = setInterval(() => {
        let count = 0

        map(imageEl => {
          if (hasClass('lazyloaded', imageEl)) {
            count++
          }
        }, imageEls)

        if (count === imageEls.length) {
          slider = carousel(sliderEl, customOptions)

          clearInterval(timer)
        }
      }, 300)
    }
  }
}
