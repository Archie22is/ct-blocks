import {
  on,
  select,
  selectAll,
  addClass,
  removeClass,
  getData,
  trigger,
  inViewPort
} from 'lib/dom'
import { map } from 'lib/utils'
import { initStyle } from 'lib/scripts'
import noUiSlider from 'nouislider'

noUiSlider.cssClasses.target += ' pricing-calculator__range'

const ACTIVE_ITEM_CLASS = 'is-active'

export default el => {
  const sliderRangeEl = select('.js-rangeslider', el)
  const numberEl = select('.js-number', el)
  const itemEls = selectAll('.js-item', el)
  let currentNumber = null

  const options = sliderRangeEl
    ? {
        range: {
          min: parseInt(sliderRangeEl.min),
          max: parseInt(sliderRangeEl.max)
        },
        start: [parseInt(sliderRangeEl.min)],
        step: parseInt(sliderRangeEl.step),
        connect: true
      }
    : {}

  // eslint-disable-next-line no-unused-vars
  let sliderRange = sliderRangeEl
    ? noUiSlider.create(sliderRangeEl, options)
    : null

  if (inViewPort(el)) {
    initStyle(
      'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css'
    )
  }

  const updateItemInstance = () => {
    map(itemEl => {
      const min = parseInt(getData('min', itemEl))
      const max = parseInt(getData('max', itemEl))

      if (
        (currentNumber > min && currentNumber < max) ||
        currentNumber === min ||
        currentNumber === max
      ) {
        addClass(ACTIVE_ITEM_CLASS, itemEl)
      } else {
        removeClass(ACTIVE_ITEM_CLASS, itemEl)
      }
    }, itemEls)
  }

  on(
    'change',
    e => {
      numberEl.innerHTML = e.target.value

      currentNumber = parseInt(e.target.value)

      updateItemInstance()
    },
    sliderRangeEl
  )

  on(
    'load',
    e => {
      trigger('change', sliderRangeEl)
    },
    window
  )
}
