import { select, selectAll, on, getHeight, setStyle } from 'lib/dom'
import carousel from 'lib/carousel'
import { map, throttle } from 'lib/utils'

export default el => {
  const sliderEl = select('.js-slider', el)
  const imageEl = select('.js-slider-item', el)
  // eslint-disable-next-line no-unused-vars
  let slider = null

  if (sliderEl) {
    slider = carousel(sliderEl)
  }

  const setHeightButton = () => {
    const buttons = selectAll('.flickity-button', el)

    if (slider && imageEl && buttons) {
      const imageHeight = getHeight(imageEl)

      map(button => {
        setStyle('top', imageHeight / 2 + 'px', button)
      }, buttons)
    }
  }

  const setHeightSliderItem = () => {
    const sliderItemEls = selectAll('.js-slider-item', el)
    const flickityViewportEl = select('.flickity-viewport', el)

    if (slider && flickityViewportEl && sliderItemEls) {
      const flickityHeight = getHeight(flickityViewportEl)

      map(sliderItemEl => {
        setStyle('height', flickityHeight + 'px', sliderItemEl)
      }, sliderItemEls)
    }
  }

  on('load', (setHeightButton, setHeightSliderItem), window)
  on('resize', throttle(setHeightButton, 300), window)
}
