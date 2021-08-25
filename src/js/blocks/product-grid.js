/* eslint-disable no-unused-vars */
import {
  hasClass,
  removeClass,
  select,
  on,
  loadNoscriptContent,
  inViewPort
} from 'lib/dom'
import { throttle } from 'lib/utils'
import Carousel from 'lib/carousel'

export default el => {
  const loaded = false
  const contentEl = select('.js-content', el)
  let slider = null

  const init = () => {
    if (!loaded && hasClass('has-lazyload', el)) {
      loadNoscriptContent(contentEl)
      removeClass('is-loading', el)
    }

    const sliderEl = select('.js-slider', el)
    slider = new Carousel(sliderEl)
  }

  on(
    'load',
    throttle(() => {
      if (inViewPort(el) && !loaded) {
        init()
      }
    }, 100),
    window
  )

  on(
    'scroll',
    throttle(() => {
      if (inViewPort(el) && !loaded) {
        init()
      }
    }, 300),
    window
  )
}
