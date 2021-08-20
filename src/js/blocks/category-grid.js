/* eslint-disable no-unused-vars */
import {
  select,
  on,
  inViewPort,
  hasClass,
  loadNoscriptContent,
  removeClass
} from 'lib/dom'
import { throttle } from 'lib/utils'
import carousel from 'lib/carousel'

export default el => {
  const contentEl = select('.js-main-content', el)
  let sliderEl = select('.js-slider', el)
  let slider = null
  let loaded = false

  const init = () => {
    if (loaded) {
      return
    }

    if (hasClass('is-not-loaded', contentEl)) {
      loadNoscriptContent(contentEl)
      removeClass('is-loading', el)
    }

    if (!sliderEl) {
      sliderEl = select('.js-slider', el)
    }

    slider = carousel(sliderEl)

    loaded = true
  }

  on(
    'load',
    () => {
      if (inViewPort(el)) {
        init()
      }
    },
    window
  )

  on(
    'scroll',
    throttle(() => {
      if (inViewPort(el)) {
        init()
      }
    }, 100),
    window
  )
}
