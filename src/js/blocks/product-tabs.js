import {
  select,
  selectAll,
  on,
  trigger,
  scrollTop,
  getTopPosition
} from 'lib/dom'
import Tabs from 'lib/tabs'
import Carousel from 'lib/carousel'

export default el => {
  const tabOptions = {
    lazyloadCallback: (navItem, tabPanel) => {
      const sliderEl = select('.js-slider', tabPanel)
      // eslint-disable-next-line no-unused-vars
      let slider = null

      if (!sliderEl && !slider) {
        return false
      }

      slider = new Carousel(sliderEl)

      setTimeout(() => {
        slider.resize()
      }, 600)

      return true
    }
  }
  // eslint-disable-next-line no-unused-vars
  const tabState = new Tabs(el, tabOptions)

  const mobileSelect = select('.js-mobile', el)
  const triggerEls = el ? selectAll('[role="tab"]', el) : []

  const syncChanges = () => {
    if (tabState) {
      on(
        'update',
        e => {
          mobileSelect.value = e.detail.currentIndex
          const elPosition = getTopPosition(el)

          scrollTop(elPosition, function () {})
        },
        el
      )
    }
  }

  if (mobileSelect) {
    on(
      'change',
      e => {
        if (tabState) {
          trigger(
            {
              event: 'update',
              data: {
                currentIndex: parseInt(e.target.value)
              }
            },
            el
          )
        }
      },
      mobileSelect
    )

    on('load', syncChanges, window)

    if (triggerEls) {
      on('click', syncChanges, triggerEls)
    }
  }
}
