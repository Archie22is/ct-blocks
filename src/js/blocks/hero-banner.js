import { select, getData, addClass } from 'lib/dom'
import Flickity from 'flickity'
require('flickity-as-nav-for')

export default el => {
  const sliderEl = select('.js-slider', el)
  const sliderNavEl = select('.js-slider-nav', el)
  const sliderOptions = sliderEl ? getData('options', sliderEl) : {}
  const sliderNavOptions = sliderNavEl ? getData('options', sliderNavEl) : {}
  const defaultOptions = {
    on: {
      ready: function () {
        addClass('is-ready', sliderEl)
      }
    }
  }
  // eslint-disable-next-line no-unused-vars
  let slider = null

  if (sliderEl && sliderOptions) {
    slider = new Flickity(sliderEl, {
      ...JSON.parse(sliderOptions),
      ...defaultOptions
    })
  }

  if (sliderNavEl && sliderNavOptions) {
    slider = new Flickity(sliderNavEl, {
      ...JSON.parse(sliderNavOptions),
      ...defaultOptions
    })
  }
}
