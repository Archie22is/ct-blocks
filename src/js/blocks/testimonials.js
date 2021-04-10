import { select, on, inViewPort, hasClass } from 'lib/dom'
import { throttle } from 'lib/utils'
import carousel from 'lib/carousel'

const body = document.body

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

  const resizeAfterLoadAssets = () => {
    if (!mainSliderEl) {
      return
    }

    const checkImageLoaded = () => {
      if (hasClass('is-assets-loaded', body)) {
        if (mainSlider) {
          mainSlider.resize()
        }

        if (navSlider) {
          navSlider.resize()
        }

        clearInterval(checkImage)
      }
    }

    const checkImage = setInterval(checkImageLoaded, 300)
  }

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

        resizeAfterLoadAssets()
      }
    },
    window
  )

  on(
    'scroll',
    throttle(() => {
      if (inViewPort(el)) {
        init()

        resizeAfterLoadAssets()
      }
    }, 100),
    window
  )
}
