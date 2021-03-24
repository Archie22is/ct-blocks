import { select, getData, addClass } from 'lib/dom'
import Flickity from 'flickity'

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
  let sliderNav = null

  if (sliderEl && sliderOptions) {
    slider = new Flickity(sliderEl, {
      ...JSON.parse(sliderOptions),
      ...defaultOptions
    })
  }

  if (sliderNavEl && sliderNavOptions) {
    sliderNav = new Flickity(sliderNavEl, {
      ...JSON.parse(sliderNavOptions),
      ...defaultOptions
    })
  }
}
