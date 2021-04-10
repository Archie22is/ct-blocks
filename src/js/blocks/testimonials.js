import { select, on, inViewPort } from 'lib/dom'
import { throttle } from 'lib/utils'
import carousel from 'lib/carousel'

export default el => {
  const mainSliderEl = select('.js-slider-main', el)
  const navSliderEl = select('.js-slider-nav', el)
  const defaultSliderEl = select('.js-slider', el)

  // Instances
  // eslint-disable-next-line no-unused-vars
  let navSlider = null
  // eslint-disable-next-line no-unused-vars
  let mainSlider = null
  // eslint-disable-next-line no-unused-vars
  let slider = null
  let loaded = false

  const init = () => {
    if (loaded) {
      return
    }

    if (mainSliderEl && navSliderEl) {
      // eslint-disable-next-line no-unused-vars
      let navSlider = carousel(navSliderEl)
      // eslint-disable-next-line no-unused-vars
      let mainSlider = carousel(mainSliderEl)

      mainSlider.on('change', index => {
        navSlider.select(index)
      })
    } else if (defaultSliderEl) {
      // eslint-disable-next-line no-unused-vars
      let slider = carousel(defaultSliderEl)
    }

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
