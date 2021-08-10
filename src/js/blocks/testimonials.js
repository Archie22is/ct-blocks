/* eslint-disable no-unused-vars */
import { select, on, inViewPort, hasClass, loadNoscriptContent } from 'lib/dom'
import { throttle } from 'lib/utils'
import carousel from 'lib/carousel'

const body = document.body

export default el => {
  const contentEl = select('.js-main-content', el)
  let sliderEl = select('.js-slider', el)
  let slider = null
  let loaded = false

  const resizeAfterLoadAssets = () => {
    if (!sliderEl) {
      return
    }

    const checkImageLoaded = () => {
      if (hasClass('is-assets-loaded', body)) {
        if (sliderEl) {
          sliderEl.resize()
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

    if (hasClass('is-not-loaded', contentEl)) {
      loadNoscriptContent(contentEl)
    }

    if (!sliderEl) {
      sliderEl = select('.js-slider', el)
    }

    console.log(sliderEl)

    slider = carousel(sliderEl)

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
