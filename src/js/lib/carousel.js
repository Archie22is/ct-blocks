import Flickity from 'flickity'
import {
  getModuleOptions,
  on,
  addClass,
  hasClass,
  appendHtml,
  removeClass
} from 'lib/dom'
import { throttle } from 'lib/utils'
require('flickity-as-nav-for')

const MODULE_NAME = 'carousel'
const INIT_CLASS = 'is-initialized'

const loadItem = itemEl => {
  if (hasClass('is-not-loaded', itemEl)) {
    const contextEls = itemEl.getElementsByTagName('noscript')
    if (contextEls && contextEls.length) {
      const context = contextEls[0].textContent || contextEls[0].innerHTML

      itemEl.innerHTML = ''
      appendHtml(itemEl, context)

      removeClass('is-not-loaded', itemEl)
    }
  }
}

export default (el, options = {}) => {
  const defaults = {
    prevNextButtons: true,
    pageDots: true,
    cellAlign: 'left',
    percentPosition: false,
    items: 1,
    lazyload: false,
    watchCSS: false,
    arrowShape: {
      x0: 10,
      x1: 50,
      y1: 50,
      x2: 55,
      y2: 45,
      x3: 20
    }
  }
  const args = getModuleOptions(MODULE_NAME, el, defaults)
  const finalArgs = { ...args, ...options }
  if (el.childElementCount > args.items) {
    const flickity = new Flickity(el, finalArgs)

    if (finalArgs.lazyload) {
      flickity.on('change', () => {
        const currentSlide = flickity.selectedElement

        loadItem(currentSlide)
      })
    }

    const resize = () => addClass(INIT_CLASS, el)
    const reset = () => removeClass(INIT_CLASS, el)
    const handler = () => {
      reset()
      flickity.resize()
      resize()
    }
    on('change', handler, window)
    on('resize', throttle(handler, 300), window)
    on('load', handler, window)

    return flickity
  }

  return null
}
