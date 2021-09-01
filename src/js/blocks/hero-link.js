import { select } from 'lib/dom'
import carousel from 'lib/carousel'

export default el => {
  const sliderEl = select('.js-slider', el)
  // eslint-disable-next-line no-unused-vars
  let slider = null

  if (sliderEl) {
    slider = carousel(sliderEl, {
      lazyload: true
    })
  }
}
