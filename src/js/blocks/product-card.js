/* global jQuery */
import { on, select } from 'lib/dom'

const $ = jQuery
const body = document.body

export default el => {
  const init = () => {
    const contextEls = el.getElementsByTagName('noscript')
    let loaded = false
    let loading = false

    if (!contextEls || !contextEls.length) {
      return false
    }

    const content = contextEls[0].textContent || contextEls[0].innerHTML
    const parentEl = select('.js-image-hover', el)

    on(
      'mouseover',
      () => {
        if (!loaded && !loading) {
          loading = true
          parentEl.innerHTML = content

          loaded = true
          loading = false
        }
      },
      el
    )
  }

  on('load', init, window)
  $(body).on('wc_fragments_loaded', init)
}
