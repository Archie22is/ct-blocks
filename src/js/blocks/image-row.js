import { select, addClass, hasClass } from 'lib/dom'
import carousel from 'lib/carousel'

export default el => {
  const sliderEl = select('.js-slider', el)
  const imageEl = select('.js-image', el)
  // eslint-disable-next-line no-unused-vars
  let slider = null

  const customOptions = {
    on: {
      ready: function () {
        const timer = setInterval(() => {
          if (hasClass('lazyloaded', imageEl)) {
            console.log('loaded')
            console.log(imageEl.className)
            slider.resize()
            addClass('is-ready', sliderEl)
            clearInterval(timer)
          }
        }, 500)
      }
    }
  }

  if (sliderEl) {
    slider = carousel(sliderEl, customOptions)
  }
}
