import { select, getData } from 'lib/dom'
import { loadImage } from 'lib/carousel'
import Flickity from 'flickity'

export default el => {
  const sliderEl = select('.js-slider', el)

  const options =
    sliderEl && getData('options', sliderEl)
      ? JSON.parse(getData('options', sliderEl))
      : {}
  // eslint-disable-next-line no-unused-vars
  let slider = null

  if (sliderEl) {
    slider = new Flickity(sliderEl, options)
    slider.on('change', index => {
      const currentSlide = slider.selectedElement
      loadImage(currentSlide)
    })
  }
}
