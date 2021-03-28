import { select, inViewPort, on, removeClass } from 'lib/dom'
import { initStyle } from 'lib/scripts'
import { throttle } from 'lib/utils'
import Plyr from 'plyr'

const LOADING_TIMEOUT = 1000
const LOADING_CLASS = 'is-loading'
const PLYR_STYLESHEET = 'https://cdn.plyr.io/3.6.4/plyr.css'

export default el => {
  const videoEl = select('.js-video', el)
  // eslint-disable-next-line no-unused-vars
  let player = null
  let loaded = false

  const init = () => {
    if (!videoEl) {
      return
    }

    initStyle(PLYR_STYLESHEET)
    player = new Plyr(videoEl)

    setTimeout(() => {
      removeClass(LOADING_CLASS, el)
    }, LOADING_TIMEOUT)
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
      if (!loaded && inViewPort(el)) {
        init()
      }
    }, 300),
    window
  )
}
