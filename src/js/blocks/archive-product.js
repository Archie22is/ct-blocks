import { on, select, addClass, removeClass, getData } from 'lib/dom'
import { removeQueryArg, getQueryVar } from 'lib/utils'
import noUiSlider from 'nouislider'

const VISIBLE_CLASS = 'is-sidebar-visible'
const body = document.body

export default el => {
  const buttonClick = select('.js-sidebar-toggle', el)
  const modalSidebarClose = select('.js-sidebar-close', el)
  const priceFilterWidget = select('.widget_price_filter', el)
  const resetText = getData('reset-text', el) || 'Reset'

  if (buttonClick) {
    on(
      'click',
      () => {
        addClass(VISIBLE_CLASS, body)
      },
      buttonClick
    )
  }

  if (modalSidebarClose) {
    on(
      'click',
      () => {
        removeClass(VISIBLE_CLASS, body)
      },
      modalSidebarClose
    )
  }

  if (priceFilterWidget) {
    const rangeEl = select('.price_slider', priceFilterWidget)
    const minPriceEl = select('#min_price', priceFilterWidget)
    const maxPriceEl = select('#max_price', priceFilterWidget)
    const minPrice = minPriceEl ? parseInt(getData('min', minPriceEl)) : 0
    const filteredMinPrice = minPriceEl ? parseInt(minPriceEl.value) : minPrice
    const maxPrice = maxPriceEl ? parseInt(getData('max', maxPriceEl)) : 0
    const filteredMaxPrice = maxPriceEl ? parseInt(maxPriceEl.value) : maxPrice
    const visibleMinPrice = select('.from', priceFilterWidget)
    const visibleMaxPrice = select('.to', priceFilterWidget)
    const clearEl = select('.clear', priceFilterWidget)

    if (minPrice !== null && maxPrice && rangeEl) {
      // Clean old html
      rangeEl.innerHTML = ''
      rangeEl.className = 'widget__range js-slider'
      rangeEl.removeAttribute('style')
      noUiSlider.create(rangeEl, {
        start: [filteredMinPrice, filteredMaxPrice],
        step: 1000, // VND
        connect: true,
        range: {
          min: minPrice,
          max: maxPrice
        },
        format: {
          to: v => parseFloat(v).toFixed(0),
          from: v => parseFloat(v).toFixed(0)
        }
      })

      rangeEl.noUiSlider.on('update', values => {
        if (values[0]) {
          visibleMinPrice.innerHTML = values[0].replace(
            /\B(?=(\d{3})+\b)/g,
            ','
          )
          minPriceEl.value = values[0]
        }

        if (values[1]) {
          visibleMaxPrice.innerHTML = values[1].replace(
            /\B(?=(\d{3})+\b)/g,
            ','
          )
          maxPriceEl.value = values[1]
        }

        if (
          (parseInt(values[0]) !== minPrice ||
            parseInt(values[1]) !== maxPrice) &&
          clearEl
        ) {
          clearEl.innerHTML = ''
          let resetUrl = removeQueryArg('min_price')
          resetUrl = removeQueryArg('max_price', resetUrl)
          const resetButton = document.createElement('a')
          resetButton.className =
            'button button--link widget__button-clear js-clear-button'
          resetButton.href = resetUrl
          resetButton.innerHTML =
            '<span class="button__text">' + resetText + '</span>'

          clearEl.appendChild(resetButton)

          on(
            'click',
            e => {
              if (!getQueryVar('min_price') && !getQueryVar('max_price')) {
                // Link no change, just need to reset a state in slider only
                console.log('not reset')
                e.preventDefault()

                rangeEl.noUiSlider.reset()
              }
            },
            resetButton
          )
        }
      })
    }
  }
}
