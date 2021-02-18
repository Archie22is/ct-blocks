import Flickity from 'flickity'
import { on, select, setStyle, getHeight } from 'lib/dom'
import { throttle } from 'lib/utils'

export default el => {
  const wrapper = select('.js-wrapper', el)
  const sliderEl = select('.js-slider', el)
  const sliderOptions = {
    cellAlign: 'left',
    contain: true,
    autoPlay: 3000,
    prevNextButtons: false
  }
  let slider = null

  const update = () => {
    slider.resize()

    if (wrapper) {
      setStyle('min-height', getHeight(sliderEl) + 'px', wrapper)
    }
  }

  if (sliderEl) {
    // eslint-disable-next-line no-unused-vars
    slider = new Flickity(sliderEl, sliderOptions)

    on('load', throttle(update, 100), window)

    on('resize', throttle(update, 100), window)
  }
}
