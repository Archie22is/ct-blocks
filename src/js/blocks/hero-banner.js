import { select, getData, addClass } from 'lib/dom'
import Flickity from 'flickity'

export default el => {
  const sliderEl = select('.js-slider', el)
  const sliderOptions = sliderEl ? getData('options', sliderEl) : {}
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
}
