/* eslint-disable no-unused-vars */
import {
  hasClass,
  removeClass,
  select,
  on,
  getData,
  loadNoscriptContent,
  inViewPort
} from 'lib/dom'
import { throttle } from 'lib/utils'
import Carousel from 'lib/carousel'

export default el => {
  let loaded = false
  const contentEl = select('.js-content', el)
  let slider = null

  const init = () => {
    if (!loaded && hasClass('has-lazyload', el)) {
      loadNoscriptContent(contentEl)
      removeClass('is-loading', el)
    }

    sliderInit()
  }

  const sliderInit = () => {
    if (slider) {
      slider.destroy()
    }

    const sliderEl = select('.js-slider', el)

    // Calculate minimum items for creating a slider
    const slidesCount = sliderEl.childElementCount
    const sliderColumn = getData('columns', sliderEl)
    const breakpoint =
      window
        .getComputedStyle(document.documentElement)
        .getPropertyValue('--m') || '1024px'

    if (window.matchMedia(`(min-width: ${breakpoint})`).matches) {
      if (parseInt(slidesCount) > parseInt(sliderColumn)) {
        slider = new Carousel(sliderEl)
      }
    } else if (parseInt(slidesCount) > 2) {
      slider = new Carousel(sliderEl)
    }
  }

  on(
    'resize',
    throttle(() => {
      if (inViewPort(el)) {
        init()

        loaded = true
      }
    }, 300),
    window
  )

  on(
    'load',
    throttle(() => {
      if (inViewPort(el) && !loaded) {
        init()

        loaded = true
      }
    }, 100),
    window
  )

  on(
    'scroll',
    throttle(() => {
      if (inViewPort(el) && !loaded) {
        init()

        loaded = true
      }
    }, 300),
    window
  )
}
